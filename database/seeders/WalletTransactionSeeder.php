<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Wallet;

class WalletTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Retrieve all users from the database
         $users = User::all();

         // Iterate over each user and create a wallet transaction
         foreach ($users as $user) {
             // Generate a random amount for the transaction (example)
             $amount = rand(100, 10000) / 100; // Example: Generates a random amount between 1 and 100
             $amount = sprintf('%.2f', $amount);
             // Create a wallet transaction record for the user
             Wallet::create([
                 'user_id' => $user->id,
                 'transaction_id' => uniqid('wtxn_'),
                 'amount' => $amount,
                 'type' => 'credit', // Example: Credit the wallet with random amounts
                 'description' => 'Initial wallet credit',
             ]);
         }
    }
}
