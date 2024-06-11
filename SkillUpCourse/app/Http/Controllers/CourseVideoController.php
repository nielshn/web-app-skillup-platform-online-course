<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseVideoRequest;
use App\Models\Course;
use App\Models\CourseVideo;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CourseVideoController extends Controller
{

    public function index()
    {
        $successMessage = Session::get('success');
        $errorMessage = Session::get('error');
        return view('admin.courses.show', compact('successMessage', 'errorMessage'));
    }


    public function create(Course $course, CourseVideo $courseVideo)
    {
        return view('admin.course_videos.create', compact('course', 'courseVideo'));
    }

    public function store(StoreCourseVideoRequest $request, Course $course)
    {
        $teacher = Teacher::where(['user_id' => Auth::user()->id])->first();

        if (!$teacher) {
            Session::flash('error', 'Only Teachers can manage Video Course');
            return redirect()->route('admin.courses.index');
        }

        DB::transaction(function () use ($request, $course) {
            $validated = $request->validated();

            $validated['course_id'] = $course->id;
            $courseVideo = CourseVideo::create($validated);
        });
        return redirect()->route('admin.courses.show', $course->id);
    }

    public function show(CourseVideo $courseVideo)
    {
    }

    public function edit(CourseVideo $courseVideo)
    {
        return view('admin.course_videos.edit', compact('courseVideo'));
    }

    public function update(StoreCourseVideoRequest $request, CourseVideo $courseVideo)
    {
        $teacher = Teacher::where(['user_id' => Auth::user()->id])->first();

        if (!$teacher) {
            Session::flash('error', 'Only Teachers can manage Video Course');
            return redirect()->route('admin.courses.index');
        }

        DB::transaction(function () use ($request, $courseVideo) {

            $validated = $request->validated();

            $courseVideo->update($validated);
        });

        Session::flash('success', 'Course Video has been updated successfully');
        return redirect()->route('admin.courses.show', $courseVideo->course_id);
    }

    public function destroy(CourseVideo $courseVideo)
    {
        $teacher = Teacher::where(['user_id' => Auth::user()->id])->first();

        if (!$teacher) {
            Session::flash('error', 'Only Teachers can manage Video Course');
            return redirect()->route('admin.courses.index');
        }

        DB::beginTransaction();
        try {
            $courseVideo->delete();
            DB::commit();
            Session::flash('success', 'Course Video has been updated successfully');
            return redirect()->route('admin.courses.show', $courseVideo->course_id);
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', $e->getMessage());
            return redirect()->route('admin.courses.show', $courseVideo->course_id);
        }
    }
}
