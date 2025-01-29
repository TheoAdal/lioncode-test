<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = 'topics';

    protected $fillable = ['name', 'event_id'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'event_topic_lesson_instructor', 'topic_id', 'lesson_id')
                    ->withPivot( 'instructor_id')
                    ->withTimestamps();
    }          
    
    public function events()
{
    return $this->belongsToMany(Event::class, 'event_topic_lesson_instructor', 'topic_id', 'event_id')
        ->withPivot('lesson_id', 'instructor_id');
}
}

