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
        // Log::info("Fetching events for user ID: {$userId}");

        //find user->event->topics->lessons->instructors
        $user = User::with([
            'events' => function ($query) {
                $query->with([
                    'topics' => function ($topicQuery) {
                        $topicQuery->with([
                            'lessons' => function ($lessonQuery) {
                                $lessonQuery->select('lessons.id')->distinct();
                            },
                            'instructors' => function ($instructorQuery) {
                                $instructorQuery->select('instructors.id')->distinct();
                            }
                        ]);
                    }
                ]);
            }
        ])->find($userId);

        //no user response
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        //response structure
        $response = [
            'user' => [
                'User_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
            'events' => $user->events->map(function ($event) {
                return [
                    'Event_id' => $event->id,
                    'topics' => $event->topics->map(function ($topic) {
                        return [
                            'Topic_id' => $topic->id,
                            'lessons' => $topic->lessons->map(function ($lesson) {
                                return [
                                    'Lesson_id' => $lesson->id,
                                ];
                            }),
                            'instructors' => $topic->instructors->map(function ($instructor) {
                                return [
                                    'Instructors_id' => $instructor->id,
                                ];
                            }),
                        ];
                    }),
                ];
            }),
        ];

        // Log::info("Fetched " . $user->events->count() . " events for user ID: {$userId}");

        return response()->json($response, 200);
    }

}