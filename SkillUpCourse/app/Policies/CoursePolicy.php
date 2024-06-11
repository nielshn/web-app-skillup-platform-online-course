<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }


    public function view(User $user, Course $course)
    {
        return true;
    }


    public function create(User $user)
    {
        return $user->hasRole('teacher') || $user->hasRole('owner');
    }


    public function update(User $user, Course $course)
    {
        return $user->hasRole('teacher') && $course->teacher_id == $user->teacher->id || $user->hasRole('owner');
    }


    public function delete(User $user, Course $course)
    {
        return $user->hasRole('teacher') && $course->teacher_id == $user->teacher->id || $user->hasRole('owner');
    }

    public function restore(User $user, Course $course)
    {
        //
    }


    public function forceDelete(User $user, Course $course)
    {
        //
    }
}
