<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $successMessage = Session::get('success');
        $errorMessage = Session::get('error');

        $search = $request->input('search');
        $user = Auth::user();
        $query = Course::with(['category', 'teacher', 'students'])->orderByDesc('id');

        if ($user->hasRole('teacher')) {
            $query->whereHas('teacher', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        $courses = $query->paginate(3);

        return view('admin.courses.index', compact('courses', 'successMessage', 'errorMessage', 'search'));
    }



    public function create()
    {
        $categories = Category::all();
        return view('admin.courses.create', compact('categories'));
    }

    public function store(StoreCourseRequest $request)
    {
        $teacher = Teacher::where(['user_id' => Auth::user()->id])->first();

        if (!$teacher) {
            Session::flash('error', 'Only Teachers can manage Course.');
            return redirect()->route('admin.courses.index');
        }

        DB::transaction(function () use ($teacher, $request) {
            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }
            $validated['slug'] = Str::slug($validated['name']);
            $validated['teacher_id']  = $teacher->id;

            $course = Course::create($validated);
            if (!empty($validated['course_keypoints'])) {
                foreach ($validated['course_keypoints'] as $keypointText) {
                    $course->course_keypoints()->create([
                        'name' => $keypointText,
                    ]);
                }
            }
        });

        Session::flash('success', 'Course has been created successfully');
        return redirect()->route('admin.courses.index');
    }

    public function show(Course $course)
    {
        return view('admin.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $categories = Category::all();
        return view('admin.courses.edit', compact('course', 'categories'));
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $teacher = Teacher::where(['user_id' => Auth::user()->id])->first();

        if (!$teacher) {
            Session::flash('error', 'Only Teachers can manage Course');
            return redirect()->route('admin.courses.index');
        }

        DB::transaction(function () use ($course, $request) {
            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $validated['slug'] = Str::slug($validated['name']);

            $course->update($validated);

            if (!empty($validated['course_keypoints'])) {
                $course->course_keypoints()->delete();
                foreach ($validated['course_keypoints'] as $keypointText) {
                    $course->course_keypoints()->create([
                        'name' => $keypointText,
                    ]);
                }
            }
        });

        Session::flash('success', 'Course has been updated successfully');
        return redirect()->route('admin.courses.show', $course);
    }

    public function destroy(Course $course)
    {
        DB::beginTransaction();

        try {
            if ($course->thumbnail) {
                Storage::disk('public')->delete($course->thumbnail);
            }

            $course->delete();

            DB::commit();
            Session::flash('success', 'Course has been deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'System error! ' . $e->getMessage());
        }

        return redirect()->route('admin.courses.index');
    }
}
