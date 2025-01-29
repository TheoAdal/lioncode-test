<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function getUserEvents($user_id)
    {
        // Παίρνουμε τον χρήστη με τα events του
        $user = User::with('events')->find($user_id);
    
        // Αν δεν υπάρχει ο χρήστης, επιστρέφουμε μήνυμα λάθους
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
    
        // Δημιουργούμε το response με το όνομα, email και τα events
        $response = [
            'name' => $user->name,
            'email' => $user->email,
            'events' => $user->events,
        ];
    
        return response()->json($response, 200);
    }
    
    public function getEventDetails($event_id)
    {
        
    }

}
