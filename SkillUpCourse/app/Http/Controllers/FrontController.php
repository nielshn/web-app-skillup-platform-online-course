<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscribeTransactionRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\SubscribeTransaction;
use App\Models\Notification; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    private function getUserNotifications()
    {
        $notifications = Notification::where('user_id', auth()->id())
            ->orderByDesc('created_at')
            ->get();
        $unreadNotifications = $notifications->where('status', 'unread');
        
        return compact('notifications', 'unreadNotifications');
    }

    public function index()
    {
        $categories = Category::paginate(8);
        $courses = Course::with(['category', 'teacher', 'students'])->orderByDesc('id')->get();
        $notificationsData = $this->getUserNotifications();
        
        return view('front.index', compact('courses', 'categories') + $notificationsData);
    }

    public function details(Course $course)
    {
        $notificationsData = $this->getUserNotifications();
        
        return view('front.details', compact('course') + $notificationsData);
    }

    public function category(Category $category)
    {
        $courses = $category->courses()->get();
        $notificationsData = $this->getUserNotifications();
        
        return view('front.category', compact('category', 'courses') + $notificationsData);
    }

    public function pricing()
    {
        $user = Auth::user();
        if ($user->hasActiveSubscription()) {
            return redirect()->route('front.index');
        }
        $notificationsData = $this->getUserNotifications();
        
        return view('front.pricing', $notificationsData);
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

            // Tambahkan notifikasi "Pembayaran diproses"
            $notificationController->createPaymentNotification($user);
        });

        return redirect()->route('dashboard');
    }

    public function learning(Course $course, $courseVideoId)
    {
        $user = Auth::user();
        if (!$user->hasActiveSubscription()) {
            return redirect()->route('front.pricing');
        }

        $video = $course->course_videos->firstWhere('id', $courseVideoId);

        $user->courses()->syncWithoutDetaching($course->id);

        $notificationsData = $this->getUserNotifications();

        return view('front.learning', compact('course', 'video') + $notificationsData);
    }

    public function checkoutDetails()
    {
        $transactions = SubscribeTransaction::where('user_id', Auth::id())->get();
        $notificationsData = $this->getUserNotifications();

        return view('front.checkout_details', compact('transactions') + $notificationsData);
    }

    public function checkoutViewDetails()
    {
        $transactions = SubscribeTransaction::where('user_id', Auth::id())->latest()->first();
        $notificationsData = $this->getUserNotifications();
        
        return view('front.checkout_view_details', compact('transactions') + $notificationsData);
    }
}
