<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;

use App\Models\User;

use App\Models\Event;
use App\Models\Topic;
use App\Models\Lesson;
use App\Models\Instructor;


class EventController extends Controller
{
    //α) Όλα τα EVENTS που αντιστοιχούν σε ένα χρήστη (table user_event)-όπου user_id το συμπλήρωνες εσύ στη DB.
    public function getUserEvents($user_id)
    {
        //find user with function events in User model 
        $user = User::with('events')->find($user_id);
    
        //no user-> false message
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
    
        //yes-> return data
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
        Log::info("Fetching events for user ID: {$userId}");

        $events = Event::whereHas('users', function ($query) use ($userId) {
        $query->where('user_id', $userId);
        })->with([
            'topics' => function ($query) {
                $query->with([
                    'lessons' => function ($lessonQuery) {
                        $lessonQuery->select('lesson_id');
                        $lessonQuery->distinct();  // Avoid lesson duplicates
                    },
                    'instructors' => function ($instructorQuery) {
                        $instructorQuery->select('instructor_id');
                        $instructorQuery->distinct(); // Avoid instructor duplicates
                    }
                ])->distinct(); // Avoid topic duplicates
            }
        ])->distinct()->get();
        
        Log::info("Fetched " . $events->count() . " events for user ID: {$userId}");
        
        return response()->json($events);
    }

}