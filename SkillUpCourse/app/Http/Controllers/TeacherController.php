<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherRequest;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class TeacherController extends Controller
{

    public function index(Request $request)
    {
        $successMessage = Session::get('success');
        $errorMessage = Session::get('error');

        $search = $request->input('search');
        $query = Teacher::with('user')->orderBy('id', 'desc');

        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $teachers = $query->paginate(2);

        return view('admin.teachers.index', [
            'teachers' => $teachers,
            'successMessage' => $successMessage,
            'errorMessage' => $errorMessage,
            'search' => $search
        ]);
    }


    public function create()
    {
        return view('admin.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeacherRequest $request)
    {
        $validated = $request->validated();

        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Data tidak ditemukan'
            ]);
        }

        if ($user->hasRole('teacher')) {
            return back()->withErrors([
                'email' => 'Email sudah terdaftar sebagai guru'
            ]);
        }

        DB::transaction(function () use ($user, $validated) {
            $validated['user_id'] = $user->id;
            $validated['is_active'] = true;

            Teacher::create($validated);

            if ($user->hasRole('student')) {
                $user->removeRole('student');
            }
            $user->assignRole('teacher');
        });

        Session::flash('success', 'Teacher has been created successfully');
        return redirect()->route('admin.teachers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        try {
            DB::transaction(function () use ($teacher) {
                $courses = $teacher->courses;
                foreach ($courses as $course) {
                    if ($course->thumbnail) {
                        Storage::disk('public')->delete($course->thumbnail);
                    }
                    $course->delete();
                }

                $teacher->delete();

                $user = User::find($teacher->user_id);
                $user->removeRole('teacher');
                $user->assignRole('student');
            });

            Session::flash('success', 'Teacher and related courses have been deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'System error! ' . $e->getMessage());
        }

        return redirect()->back();
    }
}
