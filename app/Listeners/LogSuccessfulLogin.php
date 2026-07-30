<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Login;
use App\Models\LoginHistory;
use Jenssegers\Agent\Facades\Agent;
use Illuminate\Support\Facades\Request;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Log;
use App\Models\User;



class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        // Get user's IP address
        $ipAddress = Request::ip();
        if(env('APP_ENV')=='local'){
            $ipAddress = '223.233.79.199';
        }
        //dd($ipAddress);
        // Get user's browser information
        $browser = Agent::browser();

        // Retrieve user's location using the Location facade
        $location = Location::get($ipAddress);
        $locationArr = $location->toArray();

        // Get user's device information
        $device = Agent::device();

        // Create a new login history record
        try {
            LoginHistory::create([
                'user_id' => $event->user->id,
                'login_at' => now(),
                'ip_address' => $ipAddress,
                'browser' => $browser,
                'location' => json_encode($locationArr),
                'device' => $device,
                // Add any other relevant information you want to track
            ]);
            //Update User Table For Last Login Activities
            $user = User::find($event->user->id);
            $user->last_login_at = date('Y-m-d H:i:s');
            $user->save();

        } catch (\Exception $e) {
            // Log the error message
            Log::error('Error creating login history: ' . $e->getMessage());
            // Optionally, you can handle the error in a different way, such as sending an email to the administrator or displaying a user-friendly error message
            // Example: return response()->json(['error' => 'An error occurred while logging in. Please try again later.'], 500);
        }
    }
}
