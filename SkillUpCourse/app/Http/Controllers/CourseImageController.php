<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageCourseRequest;
use App\Models\Course;
use App\Models\CourseImage;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CourseImageController extends Controller
{
    public function index()
    {
        $successMessage = Session::get('success');
        $errorMessage = Session::get('error');
        return view('admin.courses.show', compact('successMessage', 'errorMessage'));
    }


    public function create(Course $course)
    {
        return view('admin.course_images.create', compact('course'));
    }

    public function store(StoreImageCourseRequest $request, Course $course)
    {
        $teacher = Teacher::where(['user_id' => Auth::user()->id])->first();

        if (!$teacher) {
            Session::flash('error', 'Only Teachers can manage Image Course.');
            return redirect()->route('admin.courses.index');
        }
        DB::transaction(function () use ($request, $course) {
            $validated = $request->validated();

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('courseImages', 'public');
                $validated['image'] = $imagePath;
                $validated['course_id'] = $course->id;
            }

            CourseImage::create($validated);
        });
        Session::flash('success', 'Course Images created successfully');
        return redirect()->route('admin.courses.show', $course->id);
    }

    public function show(CourseImage $courseImage)
    {
    }


    public function edit(CourseImage $courseImage)
    {
        return view('admin.course_images.edit', compact('courseImage'));
    }


    public function update(StoreImageCourseRequest $request, CourseImage $courseImage)
    {
        $teacher = Teacher::where(['user_id' => Auth::user()->id])->first();

        if (!$teacher) {
            Session::flash('error', 'Only Teachers can manage Image Course');
            return redirect()->route('admin.courses.index');
        }

        DB::transaction(function () use ($request, $courseImage) {
            $validated = $request->validated();
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('courseImages', 'public');
                $validated['image'] = $imagePath;
            }
            $courseImage->update($validated);
        });

        Session::flash('success', 'Course Images updated successfully');
        return redirect()->route('admin.courses.show', $courseImage->course_id);
    }


    public function destroy(CourseImage $courseImage)
    {
        $teacher = Teacher::where(['user_id' => Auth::user()->id])->first();

        if (!$teacher) {
            Session::flash('error', 'Only Teachers can manage Image Course');
            return redirect()->route('admin.courses.index');
        }


        DB::beginTransaction();
        try {
            $courseImage->delete();
            DB::commit();
            Session::flash('success', 'Course Image deleted successfully');
            return redirect()->route('admin.courses.show', $courseImage->course_id);
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', $e->getMessage());
            return redirect()->route('admin.courses.show', $courseImage->course_id);
        }
    }
}
