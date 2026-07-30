<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class MasterBanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banks = [
            [
                'bank_name' => 'State Bank of India',
                'ifsc_code' => 'SBIN0000001',
                'status' => 'Active',
                'icon' => 'sbi_icon.png',
                'is_credit_card' => true,
                'bank_code' => 'SBI',
                'transfer_method_type' => 'NEFT'
            ],
            [
                'bank_name' => 'HDFC Bank',
                'ifsc_code' => 'HDFC0000001',
                'status' => 'Active',
                'icon' => 'hdfc_icon.png',
                'is_credit_card' => true,
                'bank_code' => 'HDFC',
                'transfer_method_type' => 'IMPS'
            ],
            [
                'bank_name' => 'ICICI Bank',
                'ifsc_code' => 'ICIC0000001',
                'status' => 'Active',
                'icon' => 'icici_icon.png',
                'is_credit_card' => true,
                'bank_code' => 'ICICI',
                'transfer_method_type' => 'RTGS'
            ],
            [
                'bank_name' => 'Axis Bank',
                'ifsc_code' => 'UTIB0000001',
                'status' => 'Active',
                'icon' => 'axis_icon.png',
                'is_credit_card' => true,
                'bank_code' => 'AXIS',
                'transfer_method_type' => 'NEFT'
            ],
            [
                'bank_name' => 'Punjab National Bank',
                'ifsc_code' => 'PUNB0000001',
                'status' => 'Active',
                'icon' => 'pnb_icon.png',
                'is_credit_card' => true,
                'bank_code' => 'PNB',
                'transfer_method_type' => 'IMPS'
            ],
            [
                'bank_name' => 'Bank of Baroda',
                'ifsc_code' => 'BARB0DBANKX',
                'status' => 'Active',
                'icon' => 'bob_icon.png',
                'is_credit_card' => false,
                'bank_code' => 'BOB',
                'transfer_method_type' => 'RTGS'
            ],
            [
                'bank_name' => 'Canara Bank',
                'ifsc_code' => 'CNRB0000001',
                'status' => 'Active',
                'icon' => 'canara_icon.png',
                'is_credit_card' => false,
                'bank_code' => 'CANARA',
                'transfer_method_type' => 'NEFT'
            ],
            [
                'bank_name' => 'Kotak Mahindra Bank',
                'ifsc_code' => 'KKBK0000001',
                'status' => 'Active',
                'icon' => 'kotak_icon.png',
                'is_credit_card' => true,
                'bank_code' => 'KOTAK',
                'transfer_method_type' => 'IMPS'
            ],
            [
                'bank_name' => 'Union Bank of India',
                'ifsc_code' => 'UBIN0000001',
                'status' => 'Active',
                'icon' => 'union_icon.png',
                'is_credit_card' => false,
                'bank_code' => 'UBI',
                'transfer_method_type' => 'RTGS'
            ],
            [
                'bank_name' => 'IndusInd Bank',
                'ifsc_code' => 'INDB0000001',
                'status' => 'Active',
                'icon' => 'indusind_icon.png',
                'is_credit_card' => true,
                'bank_code' => 'INDUSIND',
                'transfer_method_type' => 'NEFT'
            ],
            
            [
                'bank_name' => 'Yes Bank',
                'ifsc_code' => 'YESB0000001',
                'status' => 'Active',
                'icon' => 'yesbank_icon.png',
                'is_credit_card' => true,
                'bank_code' => 'YESBANK',
                'transfer_method_type' => 'IMPS'
            ],
            [
                'bank_name' => 'IDFC First Bank',
                'ifsc_code' => 'IDFB0000001',
                'status' => 'Active',
                'icon' => 'idfc_icon.png',
                'is_credit_card' => true,
                'bank_code' => 'IDFC',
                'transfer_method_type' => 'NEFT'
            ],
            [
                'bank_name' => 'Bank of India',
                'ifsc_code' => 'BKID0000001',
                'status' => 'Active',
                'icon' => 'boi_icon.png',
                'is_credit_card' => false,
                'bank_code' => 'BOI',
                'transfer_method_type' => 'RTGS'
            ],
            [
                'bank_name' => 'Central Bank of India',
                'ifsc_code' => 'CBIN0000001',
                'status' => 'Active',
                'icon' => 'centralbank_icon.png',
                'is_credit_card' => false,
                'bank_code' => 'CENTRALBANK',
                'transfer_method_type' => 'NEFT'
            ],
            [
                'bank_name' => 'Indian Bank',
                'ifsc_code' => 'IDIB0000001',
                'status' => 'Active',
                'icon' => 'indianbank_icon.png',
                'is_credit_card' => false,
                'bank_code' => 'INDIANBANK',
                'transfer_method_type' => 'IMPS'
            ],
            // Add more bank entries as needed
        ];

        DB::table('master_banks')->insert($banks);
    }
}
