<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;

use App\Models\User;

class LoginUserController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Regenerate session ID to prevent session fixation attacks
    
            //create token
            $token = Auth::user()->createToken('my-api-token')->plainTextToken;
    
            //store token in sess
            session(['token' => $token]);
    
            return redirect('/myaccount');
        }
    
        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        // $request->user()->currentAccessToken()->delete();

        // return response()->json(['message' => 'Successfully logged out!!!!', 
        //                                 'message2' => 'Token deleted']);
        $request->user()->tokens()->delete();  

    // Invalidate the session
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login'); // Redirect to the welcome page
    }
}
