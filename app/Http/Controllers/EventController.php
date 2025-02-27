<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

use App\Models\User;
use App\Models\EventTopicLessonInstructor;

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
        $user = User::findOrFail($userId);
    
    $result = [
        'user_id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'events' => []
    ];
    
    // Get all the user's events
    $events = $user->events;
    \Log::info('User events: ' . $events->pluck('id')->implode(', '));
    
    foreach ($events as $event) {
        $eventData = [
            'event_id' => $event->id,
            'topics' => []
        ];
        
        // Get the event-topic-lesson-instructor records for this event
        $etliRecords = EventTopicLessonInstructor::where('event_id', $event->id)
            ->get()
            ->groupBy('topic_id');
        
        foreach ($etliRecords as $topicId => $records) {
            $topicData = [
                'topic_id' => $topicId,
                'lessons' => []
            ];
            
            // Group records by lesson
            $lessonGroups = $records->groupBy('lesson_id');
            
            foreach ($lessonGroups as $lessonId => $lessonRecords) {
                // Get the first record for this lesson (assuming one instructor per lesson)
                $firstRecord = $lessonRecords->first();
                
                $topicData['lessons'][] = [
                    'lesson_id' => $lessonId,
                    'instructor' => [
                        'instructor_id' => $firstRecord->instructor_id
                    ]
                ];
            }
            
            $eventData['topics'][] = $topicData;
        }
        
        $result['events'][] = $eventData;
    }
    
    return response()->json($result);
    }

}