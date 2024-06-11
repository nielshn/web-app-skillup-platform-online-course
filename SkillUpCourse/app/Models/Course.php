<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'path_trailer',
        'about',
        'thumbnail',
        'category_id',
        'teacher_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
        'updated_at' => 'datetime:Y-m-d H:m:s',
        'deleted_at' => 'datetime:Y-m-d H:m:s',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function course_videos()
    {
        return $this->hasMany(CourseVideo::class);
    }

    public function course_keypoints()
    {
        return $this->hasMany(CourseKeypoint::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_students')
            ->withTimestamps();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'course_id')->orderBy('id', 'DESC');
    }

    public function course_images()
    {
        return $this->hasMany(CourseImage::class, 'course_id')->orderBy('id', 'DESC');
    }
    public function averageRating()
    {
        $totalRating = 0;
        $totalReviews = $this->reviews()->count();

        if ($totalReviews > 0) {
            foreach ($this->reviews as $review) {
                $totalRating += $review->rating;
            }

            return $totalRating / $totalReviews;
        }

        return 0;
    }
}
