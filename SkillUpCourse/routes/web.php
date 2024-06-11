<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseImageController;
use App\Http\Controllers\CourseVideoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SubscribeTransactionController;
use App\Http\Controllers\TeacherController;
use App\Models\CourseImage;
use Illuminate\Support\Facades\Route;

// web.php

Route::get('/index', [FrontController::class, 'index'])->name('front.index');
Route::get('/all-courses', [FrontController::class, 'allCourses'])->name('front.all_courses');
Route::get('/details/{course:slug}', [FrontController::class, 'details'])->name('front.details');
Route::get('/category/{category:slug}', [FrontController::class, 'category'])->name('front.category');
Route::get('/pricing', [FrontController::class, 'pricing'])->name('front.pricing');
Route::get('/load-more-faqs', [FrontController::class, 'loadMoreFaqs'])->name('load-more-faqs');
Route::get('/load-more-reviews/{course}', [FrontController::class, 'loadMoreReviews'])->name('load-more-reviews');

Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard/export', [DashboardController::class, 'export'])->name('dashboard.export');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/checkout', [FrontController::class, 'checkout'])
        ->name('front.checkout')
        ->middleware('role:student');

    Route::post('/checkout/store', [FrontController::class, 'checkout_store'])
        ->name('front.checkout.store')
        ->middleware('role:student');


    Route::get('/checkout/details', [FrontController::class, 'checkoutDetails'])
        ->name('front.checkout.details')
        ->middleware('role:student');

    Route::get('/export-pdf/{transaction}', [FrontController::class, 'exportPdf'])
        ->name('export.pdf')
        ->middleware('role:student');

    Route::get('/checkout-view-details', [FrontController::class, 'checkoutViewDetails'])
        ->name('front.checkout_view_details')
        ->middleware('role:student');


    Route::get('/my-courses', [FrontController::class, 'myCourses'])
        ->name('front.my_courses')
        ->middleware('role:student');

    Route::get('/load-more-courses', [FrontController::class, 'loadMoreMyCourses'])->name('load_more_courses');

    Route::get('/learning/{course}/{courseVideoId}', [FrontController::class, 'learning'])
        ->name('front.learning')
        ->middleware('role:student|teacher|owner');

    Route::post('/course-videos/{video}/watched', [FrontController::class, 'markVideoAsWatched'])
        ->name('course-videos.watched')
        ->middleware('role:student|teacher|owner');




    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('categories', CategoryController::class)
            ->middleware('role:owner');

        Route::resource('faqs', FAQController::class)
            ->middleware('role:owner');


        Route::resource('teachers', TeacherController::class)
            ->middleware('role:owner');
        Route::resource('courses', CourseController::class)
            ->middleware('role:owner|teacher');

        Route::resource('subscribe_transactions', SubscribeTransactionController::class)
            ->middleware('role:owner');

        Route::get('/add/video/{course:id}', [CourseVideoController::class, 'create'])
            ->middleware('role:owner|teacher')
            ->name('course.add_video');

        Route::post('/add/video/save/{course:id}', [CourseVideoController::class, 'store'])
            ->middleware('role:owner|teacher')
            ->name('course.add_video.save');

        Route::resource('course_videos', CourseVideoController::class)
            ->middleware('role:owner|teacher');


        Route::get('/add/image/{course:id}', [CourseImageController::class, 'create'])
            ->middleware('role:owner|teacher')
            ->name('course.add_image');

        Route::post('/add/image/save/{course:id}', [CourseImageController::class, 'store'])
            ->middleware('role:owner|teacher')
            ->name('course.add_image.save');

        Route::resource('course_images', CourseImageController::class)
            ->middleware('role:owner|teacher');

        Route::resource('reviews', ReviewController::class)
            ->middleware('role:owner|teacher|student');
        Route::post('/course/{course}/reviews', [ReviewController::class, 'store'])->name('reviews.add');
    });
});

require __DIR__ . '/auth.php';
