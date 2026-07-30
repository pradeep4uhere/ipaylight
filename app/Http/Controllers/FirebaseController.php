<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class FirebaseController extends Controller
{
    public function sendNotification(Request $request)
    {
        try {
            // Initialize Firebase Admin SDK
            $firebase = (new Factory)
                ->withServiceAccount(storage_path(env('FIREBASE_CREDENTIALS')))
                ->createFirebase();

            // Get an instance of Messaging
            $messaging = $firebase->getMessaging();

            // Get device token from request (or elsewhere)
            $deviceToken = $request->get('deviceToken');

            // Validate or handle missing device token (optional)

            // Create notification content
            $notification = createNotification('Your Title', 'Your Message Body');

            // Construct a message
            $message = CloudMessage::fromArray([
                ...$notification, // Spread the notification content
                'token' => $deviceToken,
            ]);

            // Send the message
            $messaging->send($message);

            return response()->json(['message' => 'Notification sent']);
        } catch (\Exception $e) {
            // Handle exception (log error, return error message)
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
