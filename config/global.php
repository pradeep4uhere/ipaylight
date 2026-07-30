<?php 
$public_path        = public_path();           // /var/www/html/marketadmin/public
$files_path         = $public_path.'/files';
$base_path          = base_path();               // /var/www/html/marketadmin
$public_url         = env('APP_URL');    // http://marketadmin.localhost/
return [

/*
* Theme files Path
*/
'THEME_PATH'     	=>  $public_url,
'PROFILE_PICTURE_PATH' => 'avatars',  //Path will be storage/app/public/avatars
'PROFILE_EKYC_PATH' => 'ekyc',
'FAQ_FILE_PATH'=>'faq',
'FAQ_CATEGORY_LIST'=>[
    'Merchant'=>[   'Transactions'=>'Transactions',
                    'Settlements'=>'Settlements',
                    'Product'=>'Product',
                    'Partner_Program'=>'Partner Program',
                    'Miscellaneous'=>'Miscellaneous',
                    'Integration_Assistance'=>'Integration Assistance',
                    'Finance'=>'Finance',
                    'Account_Configuration'=>'Account Configuration',
                    'Account_Activation'=>'Account Activation'
                ],
    'User'  =>   [
                    'Dispute_Resolution'=>'Dispute Resolution',
                    'Fraud'=>'Fraud',
                    'Refunds'=>'Refunds',
                    'Order_Cancellation'=>'Order Cancellation',
                    'Payments'=>'Payments'
        ],
    'Prospects'=>[
                    'Referral_Program'=>'Referral Program',
                    'Pricing'=>'Pricing',
                    'Payments_Settlements'=>'Payments & Settlements',
                    'Integrations'=>'Integrations',
                    'Getting_Started'=>'Getting Started',
                    'About_paygenius'=>'About Paygenius'
                ],                    

    'Gateway'=> [
                    'Summary'=>'Summary',
                    'Transactions'=>'Transactions',
                    'General_FAQs'=>'General FAQs',
                    'Integrations'=>'Integrations',
                    'Orders and Payments'=>'Orders and Payments',
                    'Transaction Reports'=>'Transaction Reports',
                    'Settlements'=>'Settlements',
                    'Offers'=>'Offers',
                    'QR Code'=>'QR Code',
                    'Product Walkthrough'=>'Product Walkthrough',

                
                ],
    'Payouts'=>[
                    'Payouts'=>'Payouts',  
                    'General FAQs'=>'General FAQs',
                    'Reports'=>'Reports',
                    'Dashboard'=>'Dashboard',
                    'Compliance'=>'Compliance'


    ],
    'Retailer'=>[
        'Register'=>'Register',
        'KYC'=>'KYC',
        'Commission'=>'Commission',
        'Payment_link'=>'Pyament Link',
        'Dashboard'=>'Dashboard',
        'Reports'=>'Reports',
        'Compliance'=>'Compliance',
        'General_FAQs'=>'General FAQs',
        'Integrations'=>'Integrations',
        'Orders and Payments'=>'Orders and Payments',
        'Transaction Reports'=>'Transaction Reports',
        'Settlements'=>'Settlements',
        'Offers'=>'Offers',
        'QR Code'=>'QR Code',
        ],
    'Distributor'=>[
                    'Register'=>'Register',
                    'KYC'=>'KYC',
                    'Commission'=>'Commission',
                    'Payment_link'=>'Pyament Link',
                    'Dashboard'=>'Dashboard',
                    'Reports'=>'Reports',
                    'Compliance'=>'Compliance',
                    'General_FAQs'=>'General FAQs',
                    'Integrations'=>'Integrations',
                    'Orders and Payments'=>'Orders and Payments',
                    'Transaction Reports'=>'Transaction Reports',
                    'Settlements'=>'Settlements',
                    'Offers'=>'Offers',
                    'QR Code'=>'QR Code',
                    ],
    'SuperDistribnutopr'=>[
                    'Register'=>'Register',
                    'KYC'=>'KYC',
                    'Commission'=>'Commission',
                    'Payment_link'=>'Pyament Link',
                    'Dashboard'=>'Dashboard',
                    'Reports'=>'Reports',
                    'Compliance'=>'Compliance',
                    'General_FAQs'=>'General FAQs',
                    'Integrations'=>'Integrations',
                    'Orders and Payments'=>'Orders and Payments',
                    'Transaction Reports'=>'Transaction Reports',
                    'Settlements'=>'Settlements',
                    'Offers'=>'Offers',
                    'QR Code'=>'QR Code',
        ]
],
'PAYOUT_LIST'=>[
    'CF'=>'Payout-1',
    'RZ'=>'Payout-2',
    'EB'=>'Payout-3',
    'PT'=>'Payout-4',
    'PU'=>'Payout-5'
],
'GATWAYS_URL'=>[
    'CASHFREE'=>[
        'TEST_API_ENDPOINT'=>'https://sandbox.cashfree.com/pg',
        'PROD_API_ENDPOINT'=>'https://api.cashfree.com/pg'
    ],
    'PHONEPE'=>[
        'TEST_API_ENDPOINT'=>'https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/',
        'PROD_API_ENDPOINT'=>'https://api.phonepe.com/apis/hermes/pg/v1/',
        'TEST_MERCHANT_ID'=>'PHONEPEPGUAT8',
        'PROD_MERCHANT_ID'=>'M223QYOU6Y11Z'
    ],
    'PAYGENIUS'=>[
        'UAT'=>
                [        
                    'CLIENT_ID'=>'1234567890',  
                    'TOKEN'=>'https://dev.api.runpaisa.com/token',
                    'ORDER'=>'https://test.api.pg.runpaisa.com/order',
                    'ORDER_STATUS'=>'https://test.api.pg.runpaisa.com/status',
                    'PAYOUT'=>'https://dev.api.payout.runpaisa.com/payment',
                    'PAYOUT_STATUS'=>'https://dev.api.payout.runpaisa.com/status',
                    'WALLET_BALANCE'=>'https://dev.api.payout.runpaisa.com/getBalance'

                ],
        'PROD'=>
                [        
                    'CLIENT_ID'=>'1234567890',  
                    'TOKEN'=>'https://api.runpaisa.com/token',
                    'ORDER'=>'https://api.pg.runpaisa.com/order',
                    'ORDER_STATUS'=>'https://api.pg.runpaisa.com/status',
                    'PAYOUT'=>'https://api.payout.runpaisa.com/payment',
                    'PAYOUT_STATUS'=>'https://dev.api.payout.runpaisa.com/status',
                    'WALLET_BALANCE'=>'https://api.payout.runpaisa.com/getBalance'
                ]
        ]
    ]
];

/*PhonePe*/
//aeed1568-1a76-4fa4-9f47-3e1c81232660