<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'course_images';
    protected $fillable = [
        'image', 'course_id'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
