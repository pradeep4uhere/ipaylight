<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample data for permissions
        $permissions = [
            [
                'permission_title' => 'Generate Payment Link',
                'permission_descriptions' => 'Allow to generate payment links',
                'permission_key' => 'GENERATE_PAYMENT_LINK',
                'permission_type'=>'ACTION',
                'status' => 'active',
            ],
            [
                'permission_title'=>'Accept Payment On Payment Link',
                'permission_descriptions'=>'Retailer has allow to accept payment on generated Payment Link.',
                'permission_key'=>'ACCEPT_PAYMENT_ON_PAYMENT_LINK',
                'permission_type'=>'ACTION',
                'status' => 'active',
            ],
            [
                'permission_title' => 'Add New Contact',
                'permission_descriptions' => 'Allow to Add New Contact',
                'permission_key' => 'ADD_NEW_CONTACT',
                'permission_type'=>'ACTION',
                'status' => 'active',
            ],
            [
                'permission_title' => 'Add New Beneficiaries',
                'permission_descriptions' => 'Allow to add new beneficiaries',
                'permission_key' => 'ADD_NEW_BENIFICERIES',
                'permission_type'=>'ACTION',
                'status' => 'active',
            ],
            [
                'permission_title' => 'Wallet to Wallet Transfer',
                'permission_descriptions' => 'Allow wallet to wallet transfers',
                'permission_key' => 'WALLET_TO_WALLET_TRANSFER',
                'permission_type'=>'ACTION',
                'status' => 'active',
            ],
            [
                'permission_title' => 'Wallet to Bank Transfer',
                'permission_descriptions' => 'Allow wallet to bank transfers',
                'permission_key' => 'WALLET_TO_BANK_TRANSFER',
                'permission_type'=>'ACTION',
                'status' => 'active',
            ],
            [
                'permission_title' => 'Successful Payments',
                'permission_descriptions' => 'Receive a notification for every successful payment.',
                'permission_key' => 'EMAIL_SUCCESSFULL_PAYMENT',
                'permission_type'=>'EMAIL',
                'status' => 'active',
            ],
            [
                'permission_title' => 'Payouts',
                'permission_descriptions' => 'Receive a notification for every payout initiated.',
                'permission_key' => 'EMAIL_PAYOUT_INITIATED',
                'permission_type'=>'EMAIL',
                'status' => 'active',
            ],
            [
                'permission_title' => 'Settalment Proccessed',
                'permission_descriptions' => 'Receive a email notification each time you get your settalment.',
                'permission_key' => 'EMAIL_SETTALMENT_PROCCESSED',
                'permission_type'=>'EMAIL',
                'status' => 'active',
            ],
            [
                'permission_title' => 'Wallet Credit',
                'permission_descriptions' => 'Receive a email notification if your wallet is credited.',
                'permission_key' => 'EMAIL_ON_WALLET_CREDIT',
                'permission_type'=>'EMAIL',
                'status' => 'active',
            ],
            [
                'permission_title' => 'All Latest News and Update',
                'permission_descriptions' => 'Receive email notification of latest news and update into the system.',
                'permission_key' => 'EMAIL_ON_UPDATE',
                'permission_type'=>'EMAIL',
                'status' => 'active',
            ],
            [
                'permission_title' => 'Support Ticket',
                'permission_descriptions' => 'Receive email notifications for each Support Ticket action.',
                'permission_key' => 'EMAIL_ON_SUPPORT_TICKET',
                'permission_type'=>'EMAIL',
                'status' => 'active',
            ],
        ];
        // Insert data into permissions table
        DB::table('permissions')->insert($permissions);

    }
}
