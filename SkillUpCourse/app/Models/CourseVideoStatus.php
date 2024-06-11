<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseVideoStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_video_id',
        'user_id',
        'watched'
    ];

    public function courseVideo()
    {
        return $this->belongsTo(CourseVideo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
