<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';

    public function users()
    {
        return $this->belongsToMany(User::class, 'event_user');
    }

    public function topics()
    {
        //an event can have multiple topics
        return $this->belongsToMany(Topic::class, 'event_topic_lesson_instructor', 'event_id', 'topic_id')
                    ->with(['lessons', 'instructors']);
    }
}
