<?php 
return [

    /**
     * Global Array for All Types Of Payment Gateway
     */
    'PAYMENT_GATEWAY' =>
    [
        ['name'=> 'PAYGENIUS', 'icon'=>'paygenius.png'],
        ['name'=> 'RAZORPAY', 'icon'=>'razorpay.jpeg'],
        ['name'=> 'EASEBUZZ', 'icon'=>'easebuzz.png'],
        ['name'=> 'CASHFREE', 'icon'=>'cashfree.png'],
        ['name'=> 'HDFC',     'icon'=>'hdfc.png'],
        ['name'=> 'ICICI',    'icon'=>'icici.png'],
        ['name'=> 'PAYTM',    'icon'=>'paytmpg.png'],
        ['name'=> 'PHONEPE',  'icon'=>'phonepe.jpeg'],
        ['name'=> 'PAYU'   ,  'icon'=>'payu.png']
    ],




    /**
     * Global Array for All Types Of Payment
     * for any gateways, you can add addon here ion future need to 
     * add extra  payment type for the webiste or payment gateways
     */
    
    'PAYMENT_TYPE'=>
    
    [
        
        /**
         * All Type Of Debit Card 
         */
        'DEBIT_CARD'=>
        [
            'name'=>'Debit Card',
            'is_active'=>'Y',
            'base_price'=>'0.00',
            'icon'=>'visa-icon.png'
        ],



        /**
         * All Type Of Debit Card 
         */
        'CREDIT_CARD'=>
        [
            'name'=>'Credit Card',
            'is_active'=>'Y',
            'base_price'=>'0.00',
            'icon'=>'credit_card.png'
        ],


        /**
         * All Type Of Debit Card 
         */
        'BUSINES_CARD'=>
        [
            'name'=>'Business Card',
            'is_active'=>'Y',
            'base_price'=>'0.00',
            'icon'=>'business.jpeg'
        ],

         /**
         * All Type Of Debit Card 
         */
        'CORPORTE_CARD'=>
        [
            'name'=>'Corporate Card',
            'is_active'=>'Y',
            'base_price'=>'0.00',
            'icon'=>'corporate.jpeg'
        ],


         /**
         * All Type Of Debit Card 
         */
        'AMERICAN_EXPRESS_CARD'=>
        [
            'name'=>'American Express Card',
            'is_active'=>'Y',
            'base_price'=>'0.00',
            'icon'=>'amex_card.webp'
        ],


        /**
         * All Type Of Debit Card 
         */
        'DINNAR_CARD'=>
        [
            'name'=>'Dinner Card',
            'is_active'=>'Y',
            'base_price'=>'0.00',
            'icon'=>'dinner.png'
        ],


        /**
         * All Type Of Rupay Debit Card 
         */
        'RUPAY_DEBIT_CARD'=>
        [
            'name'=>'Rupay Debit Card',
            'is_active'=>'Y',
            'base_price'=>'0.00',
            'icon'=>'rupay.png'
        ],



        /**
         * All Type Of Rupay Credit Card 
         */
        'RUPAY_CREDIT_CARD'=>
        [
            'name'=>'Rupay Credit Card',
            'is_active'=>'Y',
            'base_price'=>'0.00',
            'icon'=>'rupay.png'
        ],


         /**
         * All Type Of Wallets
         */
        'WALLETS'=>
        [
            'name'=>'Wallets',
            'is_active'=>'Y',
            'base_price'=>'0.00',
            'icon'=>'paytm.png'
        ],



         /**
         * All Type Of Debit Card 
         */
        'UPI'=>
        [
            'name'=>'UPI',
            'is_active'=>'Y',
            'base_price'=>'0.00',
            'icon'=>'upi.png'
        ],


        /**
         * All Type Of Debit Card 
         */
        'AMAZON_PAY'=>
        [
            'name'=>'Amazon Pay',
            'is_active'=>'Y',
            'base_price'=>'0.00',
            'icon'=>'amazon_pay.png'
        ],

       


         /**
         * All Type Of Debit Card 
         */
        'NETBANKING'=>
        [
            'name'=>'Netbanking',
            'is_active'=>'Y',
            'base_price'=>'0.00',
            'icon'=>'visa-icon.png'
        ]
        

    ]
        
];