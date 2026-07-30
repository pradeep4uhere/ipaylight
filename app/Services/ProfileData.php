<?php // app/Services/ProfileData.php

namespace App\Services;

use App\Models\User;
use App\Models\Wallet;

class ProfileData
{
    public function getUserProfile($userId)
    {
        // Fetch user data based on the user ID
        //$user = User::with('Wallet')->find($userId);
        //dd($user);
        //return $user;
    }

}
