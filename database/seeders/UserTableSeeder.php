<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Wallet;
use App\Models\User;
use DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = [
            [
                'name' => 'Admin User',
                'username' => 'adminuser',
                'email' => 'admin@gmail.com',
                'mobile' => '9015446567',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'status' => 'active'
            ],
            [
                'name' => 'Retailer User',
                'username' => 'rouser',
                'mobile' => '9015446568',
                'email' => 'ro@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'retailer',
                'status' => 'active'
            ],
            [
                'name' => 'User',
                'username' => 'user',
                'mobile' => '9015490154',
                'email' => 'user@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'status' => 'active'
            ],
            [
                'name' => 'Distributor',
                'username' => 'dsuser',
                'mobile' => '9015590155',
                'email' => 'ds@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'distributor',
                'status' => 'active'
            ]
        ];


        foreach ($users as $userData) {
            $user = User::create($userData);
            // Create wallet for each user
            Wallet::create([
                'user_id' => $user->id,
                'transaction_id' => uniqid('wtxn_'), // Generate a unique transaction ID
                'amount' => 0.00, // Set initial amount as needed
                'type' => 'credit', // Set initial type as needed
                'description' => 'Initial wallet balance', // Set initial description as needed
            ]);
        }
      
    }
}