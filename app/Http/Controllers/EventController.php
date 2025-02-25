<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

use App\Models\User;

class EventController extends Controller
{
    //α) Όλα τα EVENTS που αντιστοιχούν σε ένα χρήστη (table user_event)-όπου user_id το συμπλήρωνες εσύ στη DB.
    public function getUserEvents($user_id)
    {
        //find user with function events in User model 
        $user = User::with('events')->find($user_id);
    
        //no user response-> false message
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
    
        //yes user response-> return data
        $response = [
            'name' => $user->name,
            'email' => $user->email,
            'events' => $user->events,
        ];
    
        return response()->json($response, 200);
    }
    

    // β) Δεύτερο βήμα σε κάθε event της πάνω κλήσης θέλουμε τα TOPICS με τα αντίστοιχα LESSONS και τους αντίστοιχους INSTRUCTORS. (πληροφορία event_topic_lesson_instructor).
    public function getUserEventsTopicsLessonsInstructors($userId)
    {
        $user = User::with([
            'events.eventTopics.lesson.instructor'
        ])->find($userId);
        
        return response()->json([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'events' => $user->events->map(function ($event) {
                return [
                    'event_id' => $event->id,
                    'topics' => $event->topics->groupBy('id')->map(function ($lessons, $topicId) {
                        return [
                            'topic_id' => $topicId,
                            'lessons' => $lessons->flatMap(function ($topic) {
                                return $topic->lessons->map(function ($lesson) {
                                    return [
                                        'lesson_id' => $lesson->id,
                                        'instructor' => [
                                            'instructor_id' => optional($lesson->instructor)->id
                                        ]
                                    ];
                                });
                            })->values()
                        ];
                    })->values()
                ];
            })
        ]);
    }

}