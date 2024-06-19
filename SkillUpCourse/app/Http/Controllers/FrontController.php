<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscribeTransactionRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseImage;
use App\Models\CourseStudent;
use App\Models\SubscribeTransaction;
use App\Models\Notification;
use App\Models\CourseVideo;
use App\Models\CourseVideoStatus;
use App\Models\FAQ;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Session\Session;

class FrontController extends Controller
{

    private function getFaqsAndReviews()
    {
        $faqs = FAQ::orderByDesc('id')->take(4)->get();
        $allFaqs = FAQ::orderByDesc('id')->get();
        $reviews = Review::select('id', 'user_id', 'course_id', 'rating', 'note', 'created_at')
            ->distinct('user_id')
            ->with('user')
            ->orderByDesc('created_at')
            ->get();
        return compact('faqs', 'allFaqs', 'reviews');
    }

    private function getUserNotifications()
    {
        $notifications = Notification::where('user_id', auth()->id())
            ->orderByDesc('created_at')
            ->get();
        $unreadNotifications = $notifications->where('status', 'unread');

        return compact('notifications', 'unreadNotifications');
    }

    private function getAllCourses()
    {
        $courses = Course::with(['category', 'teacher', 'students'])
            ->withCount(['students'])
            ->get()
            ->sortByDesc(function ($course) {
                return $course->averageRating();
            });
        return $courses;
    }

    public function index()
    {
        $courses = $this->getAllCourses();
        $categories = Category::orderByDesc('id')->get();
        $faqsAndReviews = $this->getFaqsAndReviews();
        $notificationsData = $this->getUserNotifications();

        return view('front.index', compact('courses', 'categories') + $faqsAndReviews + $notificationsData);
    }

    public function allCourses(Request $request)
    {
        $search = $request->input('search');
        $categoryId = $request->input('category');

        $courses = $this->getAllCourses();

        if ($search) {
            $courses = $courses->filter(function ($course) use ($search) {
                return stripos($course->name, $search) !== false;
            });
        }

        if ($categoryId) {
            $courses = $courses->filter(function ($course) use ($categoryId) {
                return $course->category_id == $categoryId;
            });
        }

        $categories = Category::orderByDesc('id')->get();
        $faqsAndReviews = $this->getFaqsAndReviews();
        $notificationsData = $this->getUserNotifications();

        return view('front.all_courses', compact('courses', 'categories') + $faqsAndReviews + $notificationsData);
    }

    public function loadMoreFaqs(Request $request)
    {
        $skip = $request->query('skip', 0);
        $faqs = FAQ::orderByDesc('id')
            ->skip($skip)
            ->take(4)
            ->get();
        return response()->json($faqs);
    }

    public function myCourses(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'You are not logged in yet');
        }

        $search = $request->input('search');
        $categoryId = $request->input('category');

        $query = Course::query()
            ->whereHas('students', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->with('category');

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $initialCourses = $query->orderByDesc('id')->take(4)->get()->sortByDesc(function ($course) {
            return $course->averageRating();
        });

        $allCourses = $query->orderByDesc('id')->get()->sortByDesc(function ($course) {
            return $course->averageRating();
        });

        $categories = Category::orderByDesc('id')->get();
        $faqsAndReviews = $this->getFaqsAndReviews();
        $notificationsData = $this->getUserNotifications();

        return view('front.my_courses', compact('initialCourses', 'categories', 'allCourses') + $faqsAndReviews + $notificationsData);
    }

    public function loadMoreMyCourses(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([], 401); // Unauthorized
        }

        $skip = $request->input('skip', 0);
        $take = 4;

        $search = $request->input('search', '');
        $categoryId = $request->input('category', null);

        $query = Course::query()
            ->whereHas('students', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->with('category');

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $myCourses = $query->orderByDesc('id')
            ->skip($skip)
            ->take($take)
            ->get()
            ->sortByDesc(function ($course) {
                return $course->averageRating();
            });

        return response()->json($myCourses);
    }


    public function loadMoreReviews(Request $request, Course $course)
    {
        $skip = $request->query('skip', 0);
        $reviews = Review::where('course_id', $course->id)
            ->orderByDesc('created_at')
            ->skip($skip)
            ->take(4)
            ->get();
        return response()->json($reviews);
    }

    public function details(Course $course)
    {
        $courseImage = $course->course_images()->orderByDesc('id')->get();
        $faqsAndReviews = $this->getFaqsAndReviews();
        $reviews = Review::where('course_id', $course->id)->orderByDesc('created_at')->take(3)->get();
        $allReviews = Review::where('course_id', $course->id)->orderByDesc('created_at')->get();
        $notificationsData = $this->getUserNotifications();

        return view('front.details', compact('course', 'courseImage', 'reviews', 'allReviews') + $faqsAndReviews + $notificationsData);
    }

    public function category(Category $category, Request $request)
    {
        $search = $request->input('search');
        $query = $category->courses()->orderByDesc('id');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('slug', 'like', '%' . $search . '%');
            });
        }

        $courses = $query->paginate(2);
        $faqsAndReviews = $this->getFaqsAndReviews();
        $notificationsData = $this->getUserNotifications();

        return view('front.category', compact('category', 'courses', 'search') + $faqsAndReviews + $notificationsData);
    }

    public function pricing()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'You are not logged in yet');
        }

        if ($user->hasActiveSubscription()) {
            return redirect()->route('front.index')->with('error', 'You already have a subscription');
        }

        $faqsAndReviews = $this->getFaqsAndReviews();
        $notificationsData = $this->getUserNotifications();

        return view('front.pricing', $faqsAndReviews + $notificationsData);
    }

    public function checkout()
    {
        $user = Auth::user();

        if ($user->hasActiveSubscription()) {
            return redirect()->route('front.index');
        }

        $notificationsData = $this->getUserNotifications();
        return view('front.checkout', $notificationsData);
    }

    public function checkout_store(StoreSubscribeTransactionRequest $request, NotificationController $notificationController)
    {
        $user = Auth::user();

        if ($user->hasActiveSubscription()) {
            return redirect()->route('front.index');
        }

        DB::transaction(function () use ($request, $user, $notificationController) {
            $validated = $request->validated();

            if ($request->hasFile('proof')) {
                $proofPath = $request->file('proof')->store('proofs', 'public');
                $validated['proof'] = $proofPath;
            }

            $validated['user_id'] = $user->id;
            $validated['total_amount'] = 429000;
            $validated['is_paid'] = false;

            $transaction = SubscribeTransaction::create($validated);
            $notificationController->createPaymentNotification($user);
        });

        return redirect()->route('dashboard');
    }



    public function learning(Course $course, $courseVideoId)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'You are not logged in yet');
        }

        if (!$user->hasActiveSubscription()) {
            return redirect()->route('front.pricing')->with('error', 'You are not subscribed to this subscription');
        }

        $courseImage = $course->course_images()->orderByDesc('id')->get();
        $faqs = FAQ::orderByDesc('id')->take(4)->get();
        $allFaqs = FAQ::orderByDesc('id')->get();

        $video = $course->course_videos()->firstWhere('id', $courseVideoId);
        $user->courses()->syncWithoutDetaching($course->id);

        $notificationsData = $this->getUserNotifications();

        // Retrieve reviews for the course
        $reviews = Review::where('course_id', $course->id)->orderByDesc('created_at')->take(4)->get();
        $allReviews = Review::where('course_id', $course->id)->orderByDesc('created_at')->get();

        // Retrieve video statuses for the logged-in user
        $videoStatuses = CourseVideoStatus::where('user_id', $user->id)->pluck('watched', 'course_video_id')->toArray();

        return view('front.learning', compact('course', 'video', 'courseImage', 'faqs', 'allFaqs', 'reviews', 'allReviews', 'videoStatuses') + $notificationsData);
    }


    public function markVideoAsWatched($videoId)
    {
        $user = Auth::user();
        $video = CourseVideo::find($videoId);

        if ($video) {
            // Cari atau buat status video berdasarkan course_video_id dan user_id
            $status = CourseVideoStatus::firstOrCreate(
                ['course_video_id' => $video->id, 'user_id' => $user->id],
                ['watched' => true]
            );

            $status->watched = true;
            $status->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

    public function checkoutDetails()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'You are not logged in yet');
        }

        $transactions = SubscribeTransaction::where('user_id', $user->id)->get();
        $notificationsData = $this->getUserNotifications();

        return view('front.checkout_details', compact('transactions') + $notificationsData);
    }

    public function checkoutViewDetails()
    {
        $transactions = SubscribeTransaction::where('user_id', Auth::id())->latest()->first();
        $notificationsData = $this->getUserNotifications();

        return view('front.checkout_view_details', compact('transactions') + $notificationsData);
    }

    public function exportPdf(SubscribeTransaction $transaction)
    {
        $data = [
            'transactions' => $transaction,
        ];

        $pdf = PDF::loadView('front.checkout_details_pdf', $data);
        return $pdf->download('checkout_details.pdf');
    }
}
