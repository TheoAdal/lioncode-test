<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $table = 'instructors';

    protected $fillable = ['name', 'email', 'phone'];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_topic_lesson_instructor', 'instructor_id', 'event_id');
    }
}
