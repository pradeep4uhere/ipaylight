<?php date_default_timezone_set('Asia/Kolkata');


function formatDate($date)
{
    return date('d M,Y',strtotime($date));
}



/**
 * 
 */
function getFormatDate($date, $format = 'M d, Y | h:i A') 
{
    return date($format,strtotime($date));
}


function getBreadcrum($action='Dashboard')
{  
    
   if($action == 'transactions'){               $HOME = 'Trasnaction Report'; }
   else if($action == 'settalment'){            $HOME = 'Trasnaction Report'; } 
   else if($action == 'paymentcreditreport'){   $HOME = 'Trasnaction Report'; } 
   else if($action == 'paymentdebitreport'){    $HOME = 'Trasnaction Report'; } 

   else if($action == 'paymentpage'){           $HOME = 'Payments'; } 
   else if($action == 'paymentlink'){           $HOME = 'Payments'; } 
   else if($action == 'wallettransfer'){        $HOME = 'Payments'; } 

   else if($action == 'contactlist'){           $HOME = 'Contacts'; } 
   else if($action == 'addcontact'){            $HOME = 'Contacts';}

   else if($action == 'mobilrecharge'){         $HOME = 'Bill Payment';}
   else if($action == 'phonebill'){             $HOME = 'Bill Payment';}
   else if($action == 'landlinebill'){          $HOME = 'Bill Payment';}
   else if($action == 'gasbill'){               $HOME = 'Bill Payment';}

   else if($action == 'messageadd'){            $HOME = 'Inbox';}
   else if($action == 'messageinbox'){          $HOME = 'Inbox';}
   else if($action == 'messagesent'){           $HOME = 'Inbox';}
   else if($action == 'messagedeleted'){        $HOME = 'Inbox';}

   else if($action == 'overview'){              $HOME = 'Support';}
   else if($action == 'allticket'){             $HOME = 'Support - Ticlet';}
   else if($action == 'createticket'){          $HOME = 'Support - Ticlet';}
   else if($action == 'faqs'){                  $HOME = 'Support';}

   else if($action == 'profile'){               $HOME = 'Profile Account';}
   else if($action == 'change-password'){       $HOME = 'Profile Account';}
   else if($action == 'kyc-update'){            $HOME = 'Profile Account';}
      
   else if($action == 'two-factor-auth'){       $HOME = 'Authentication';}
   else if($action == 'verify-mobile'){         $HOME = 'Authentication';}
   else if($action == 'verify-email'){          $HOME = 'Authentication';}
   else if($action == 'qrcode'){                $HOME = 'Authentication';}
   
   else { $HOME = getLocalText('Dashboard'); }
   $str = '<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1"><li class="breadcrumb-item text-muted">
            <a href="#" class="text-muted text-hover-primary">';
   $str.= $HOME;
   $str.= '</a></li><li class="breadcrumb-item">
            <span class="bullet bg-gray-300 w-5px h-2px"></span></li><li class="breadcrumb-item text-muted">';
            if(isset($action)){
                $str.= $action;
            }else{
                $str.= 'Home';
            }
   $str.= '</li></ul>';
   if($action!='Dashboard'){
    return $str;
   }
}

/**
 * Get Auth User Value
 */
if(!function_exists('getAuthValue')){
    function getAuthValue($key){
        if($key=='cancle_cheque'){
            return Auth::user()->$key;
        }else if($key=='picture'){
            return Auth::user()->$key;
        }else{
            return Str::ucFirst(Auth::user()->$key);
        }
    }
}





/**
 * Get App Name
 */
if(!function_exists('getAppName')){
    function getAppName(){
        return env('APP_NAME');
    }
}



/**
 * Get App Year & Version
 */
if(!function_exists('getAppVersion')){
    function getAppVersion(){
        return date('Y');
    }
}




/**
 * Get User Created On
 */
if(!function_exists('getUserCreatedOn')){
    function getUserCreatedOn(){
        return formatDate(Auth::user()->created_at);
    }
}


/**
 * Get Support Email Address
 */
if(!function_exists('getSupportEmail')){
    function getSupportEmail(){
        return env('SUPPORT_EMAIL_ADDRESS');
    }
}

/**
 * Get Support Email Address
 */
if(!function_exists('getSupportPhone')){
    function getSupportPhone(){
        return env('SUPPORT_MOBILE_NUMBER');
    }
}


if (!function_exists('getAuthRoleLayout')) {
    function getAuthRoleLayout($roleName=null)
    {
        $role = auth()->user()->role; // Assuming the user is authenticated
        return Str::ucfirst($role).".layouts.".Str::ucfirst($role).".dashboard";
    }
}


if (!function_exists('getAuthRoleListingLayout')) {
    function getAuthRoleListingLayout($roleName=null)
    {
        $role = auth()->user()->role; // Assuming the user is authenticated
        return Str::ucfirst($role).".layouts.".Str::ucfirst($role).".listing";
    }
}


/**
 * Generate Random String
 */
if (!function_exists('generateRandomAlphabetString')) {
    function generateRandomAlphabetString($length = 15) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }
}


/**
 * Get Profile Image
 */
if (!function_exists('getProfileImage')) {
    function getProfileImage($picture, $height = 50, $width = 50)
    {
        if ($picture) {
            $imageUrl = asset('storage/avatars/' . $picture);
            if ($picture != '') {
                echo '<img src="' . $imageUrl . '" alt="image" style="height:' . $height . 'px; width:' . $width . 'px;" />';
            } else {
                echo '<img src="assets/media/svg/avatars/blank.svg" style="height:100px;width:100px"/>';
            }
        } else {
            echo '<img src="assets/media/svg/avatars/blank.svg" style="height:' . $height . 'px; width:' . $width . 'px;" />';
        }
    }
}



/**
 * Get Profile Image
 */
if (!function_exists('getKYCImage')) {
    function getKYCImage($picture)
    {
        $imageUrl = asset('storage/ekyc/'.$picture);
        if ($picture != '') {
            echo '<img src="' . $imageUrl . '" alt="image" style="height:100px;width:100px" />';
        } else {
            echo '<img src="assets/media/svg/avatars/blank.svg" style="height:100px;width:100px"/>';
        }
    }
}


/**
 * Get Dynamic code
 */
if (!function_exists('generateRandomMerchantId')) {
function generateRandomMerchantId($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $merchantId = '';

    for ($i = 0; $i < $length; $i++) {
        $merchantId .= $characters[random_int(0, strlen($characters) - 1)];
    }

    return $merchantId;
}
}



/**
 * Get Dynamic code
 */
if (!function_exists('generateRefernceNumber')) {
    function generateRefernceNumber($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $merchantId = '';
    
        for ($i = 0; $i < $length; $i++) {
            $merchantId .= $characters[random_int(0, strlen($characters) - 1)];
        }
    
        return $merchantId;
    }
}


/**
 * Get Dynamic code
 */
if (!function_exists('generateTransactionNumber')) {
    function generateTransactionNumber($length = 10)
    {
        return time();
    }
}
    

/**
 * Get Agent code For User
 */
if (!function_exists('generateAgentCode')) {
    function generateAgentCode($id)
    {
        return 'PTACN' . str_pad($id, 10 - 5, '0', STR_PAD_LEFT);
    }
}



/**
 * Get Agent code For User
 */
if (!function_exists('generateNumberWithPad')) {
    function generateNumberWithPad($id)
    {
        return str_pad($id, 18 - 5, '0', STR_PAD_LEFT);
    }
}

/**
 * Get current Token
 */

if (!function_exists('createToken')) {
    function createToken($request)
    {
        //dd(env('API_TOKEN_KEY'));
        $token =  $request->user()->createToken(env('API_TOKEN_KEY'));
        return  $token->plainTextToken;
    }
}


/**
 * Get current Token
 */

 if (!function_exists('getInActiveStatusList')) {
    function getInActiveStatusList($selectedValue=0)
    {
        $options = [
            ['value' => '1', 'label' => 'Not Approved'],
            ['value' => '2', 'label' => 'KYC InComplete'],
            ['value' => '3', 'label' => 'InValid Bank Account'],
            ['value' => '4', 'label' => 'Email Not Verified'],
            ['value' => '5', 'label' => 'Mobile Not Verified']
        ];
    
        $dropdownHtml = '<select name="status_reason_code" aria-label="Select User Status" class="form-select form-select-solid fw-bolder bg-light-danger border-danger">';
    
        foreach ($options as $option) {
            $value = $option['value'];
            $label = $option['label'];
    
            $selected = ($selectedValue !== null && $selectedValue == $value) ? 'selected' : '';
    
            $dropdownHtml .= "<option value=\"$value\" $selected>$label</option>";
        }
    
        $dropdownHtml .= '</select>';
    
        return $dropdownHtml;
    }
}
      


/**
 * Get PAYMENT TYPE
 */

 if (!function_exists('getPaymentTypeList')) {
    function getPaymentTypeList()
    {
        $paymentTypeList = \Config::get('paymenttype.PAYMENT_TYPE');
        if($paymentTypeList){
            return $paymentTypeList;
        }else{
            return null;
        }
    }
}




/**
 * Get current Token
 */

 if (!function_exists('getPaymentTypeIcon')) {
    function getPaymentTypeIcon($paymentType)
    {
        $paymentTypeList = \Config::get('paymenttype.PAYMENT_TYPE');
        if($paymentTypeList){
            return $paymentTypeList[$paymentType]['icon'];
        }else{
            return null;
        }
    }
}


/**
 * Get current Token
 */

 if (!function_exists('getPaymentGatewayList')) {
    function getPaymentGatewayList($selectedValue=null)
    {
        $options = \Config::get('paymenttype.PAYMENT_GATEWAY');
        $dropdownHtml = '<select name="gateway_name" aria-label="Select Payment Gateway" data-control="select2" class="form-select form-select-solid fw-bolder">';
    
        foreach ($options as $option) {
            $value = $option['name'];
            $label = $option['name'];
            if($selectedValue!=''){
            $selected = ($selectedValue !== null && $selectedValue == $value) ? 'selected' : 'disabled';
            }else{
            $selected = ($selectedValue !== null && $selectedValue == $value) ? 'selected' : '';
            }
            $dropdownHtml .= "<option value=\"$value\" $selected>$label</option>";
        }
    
        $dropdownHtml .= '</select>';
    
        return $dropdownHtml;
    }
}




/**
 * Get Payment Gateway Icon
 */

 if (!function_exists('getPaymentGatewayIcon')) {
    function getPaymentGatewayIcon($targetName)
    {
        //dd($targetName);
        $paymentGateways = \Config::get('paymenttype.PAYMENT_GATEWAY');
        foreach ($paymentGateways as $key => $gateway) {
            if ($gateway['name'] === $targetName) {
                $index = $key;
                return $paymentGateways[$index]['icon'];
                //break;
            }
        }
    }
}


/**
 * Get Payment Gateway Icon
 */

 if (!function_exists('getPaymentTypeIcon')) {
    function getPaymentTypeIcon($targetName)
    {
        //dd($targetName);
        $paymentGateways = \Config::get('paymenttype.PAYMENT_TYPE');
        foreach ($paymentGateways as $key => $gateway) {
            if ($gateway['name'] === $targetName) {
                $index = $key;
                return $paymentGateways[$index]['icon'];
                //break;
            }
        }
    }
}


if (!function_exists('getStateOptions')) {
function getStateOptions($selectedState = null) {
    // Usage example:
    $indian_all_states  = array (
        'AP' => 'Andhra Pradesh',
        'AR' => 'Arunachal Pradesh',
        'AS' => 'Assam',
        'BR' => 'Bihar',
        'CT' => 'Chhattisgarh',
        'GA' => 'Goa',
        'GJ' => 'Gujarat',
        'HR' => 'Haryana',
        'HP' => 'Himachal Pradesh',
        'JK' => 'Jammu & Kashmir',
        'JH' => 'Jharkhand',
        'KA' => 'Karnataka',
        'KL' => 'Kerala',
        'MP' => 'Madhya Pradesh',
        'MH' => 'Maharashtra',
        'MN' => 'Manipur',
        'ML' => 'Meghalaya',
        'MZ' => 'Mizoram',
        'NL' => 'Nagaland',
        'OR' => 'Odisha',
        'PB' => 'Punjab',
        'RJ' => 'Rajasthan',
        'SK' => 'Sikkim',
        'TN' => 'Tamil Nadu',
        'TR' => 'Tripura',
        'TL' => 'Telangana',
        'UK' => 'Uttarakhand',
        'UP' => 'Uttar Pradesh',
        'WB' => 'West Bengal',
        'AN' => 'Andaman & Nicobar',
        'CH' => 'Chandigarh',
        'DN' => 'Dadra and Nagar Haveli',
        'DD' => 'Daman & Diu',
        'DL' => 'Delhi',
        'LD' => 'Lakshadweep',
        'PY' => 'Puducherry',
    );
    $options = '<option value="">Select a state...</option>';
    foreach ($indian_all_states as $code => $name) {
        $selected = ($selectedState && $selectedState === $code) ? 'selected' : '';
        $options .= "<option value=\"$code\" $selected>$name</option>";
    }
    return $options;
}
}




/**
 * Get Payment Gateway Rate For User From Database
 * @params $list from database
 * @params payment_type as key
 */
if (!function_exists('getPaymentSettingRate')) {
    function getPaymentSettingRate($paymentRateList = null, $key=null,$type=null,$baseRate=null) {
        if(!empty($paymentRateList)){
            return $paymentRateList[$key][$type];
        }else{
            return \Number::format((0.00 + $baseRate + 0.10),2);
        }
    }
}    


if (!function_exists('encryptUserProfileId')) {
    function encryptUserProfileId($userProfile)
    {
        return Crypt::encryptString($userProfile->id);
    }
}


if (!function_exists('encryptString')) {
    function encryptString($string)
    {
        return Crypt::encryptString($string);
    }
}



if (!function_exists('decryptString')) {
    function decryptString($string)
    {
        return Crypt::decryptString($string);
    }
}


/**
 * Get Gateway List Open to aLL
 */

 if (!function_exists('getPaymentGatewayListOptions')) {
    function getPaymentGatewayListOptions($selectedValue=null)
    {
        $options = \Config::get('paymenttype.PAYMENT_GATEWAY');
        $dropdownHtml = '<select name="gateway_name" aria-label="Select Payment Gateway" data-control="select2" class="form-select form-select-solid fw-bolder">';
    
        foreach ($options as $option) {
            $value = $option['name'];
            $label = $option['name'];
            if($selectedValue!=''){
            $selected = ($selectedValue !== null && $selectedValue == $value) ? 'selected' : '';
            }else{
            $selected = ($selectedValue !== null && $selectedValue == $value) ? 'selected' : '';
            }
            $dropdownHtml .= "<option value=\"$value\" $selected>$label</option>";
        }
    
        $dropdownHtml .= '</select>';
    
        return $dropdownHtml;
    }
}


if (!function_exists('getUserProfileRoutePrefix')) {
    function getUserProfileRoutePrefix($routeName=null)
    {
        if(getAuthValue('role')=='Distributor'){ 
            $routeRole = 'ds.'.$routeName; 
        }elseif(getAuthValue('role')=='Admin'){ 
            $routeRole = 'admin.'.$routeName; 
        }elseif(getAuthValue('role')=='Retailer'){ 
            $routeRole = 'ro.'.$routeName; 
        }else{
            $routeRole = 'admin'; 
        } 
        return $routeRole;
    }
}



if (!function_exists('getWalletBalance')) {
    function getWalletBalance()
    {
        return Auth::user()->Wallet->amount;
    }
}


/**
 * Get First Char Of the String
 */
if (!function_exists('getFirstChar')) {
    function getFirstChar($str)
    {
        return substr($str, 0, 1);
    }
}







/**
 * Get Random ClassName
 */
if (!function_exists('getRandomClassName')) {
    function getRandomClassName()
    {
        // List of class names
        $classNames = [
            'bg-light-danger'=>'text-danger', 
            'bg-light-info'=>'text-info', 
            'bg-light-primary'=>'text-primary', 
            'bg-light-success'=>'text-success', 
            'bg-light-warning'=>'text-warning'];
        // Get a random index
        $randomIndex = array_rand($classNames);
        // Return the randomly selected class name
        return [
            'key' => $randomIndex,
            'value' => $classNames[$randomIndex]
        ];
    }
}




/**
 * Get First Char Of the String
 */
if (!function_exists('getPaymentLinkURL')) {
    function getPaymentLinkURL($str)
    {
        return env('APP_URL').'/checkout/'.$str;
    }
}



/**
 * Loader Text
 */
if(!function_exists("loaderText")){ 
    function  loaderText(){  
        echo "<div style='
        height: 100%;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;'><div>
        <div style=' margin-left: 30%; /* Add margin to separate loader from text */
        font-size: 18px; font-size:20px'><img src=".asset('assets/media/loader.gif')." height='50px'></div>
        <div style=' margin-left: 35%; /* Add margin to separate loader from text */
        font-size: 18px; font-size:20px'>Please wait...</div>
        <div style='display: flex;
        justify-content: center;'>Do not reload or close the browser, Page will redirect</div>";
    }
}


if(!function_exists("generateRandomIPAddress")){ 
    function generateRandomIPAddress() {
    // Generate random numbers for each part of the IP address
    $part1 = rand(0, 255);
    $part2 = rand(0, 255);
    $part3 = rand(0, 255);
    $part4 = rand(0, 255);

    // Concatenate the parts with dots to form the IP address
    $ipAddress = $part1 . '.' . $part2 . '.' . $part3 . '.' . $part4;
    return $ipAddress;
    }
}

if(!function_exists("AmountToWords")){ 

function AmountToWords(float $number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
}
}





/**
 * Get current Token
 */

 if (!function_exists('getAllPaymentGatewayList')) {
    function getAllPaymentGatewayList($selectedValue=null)
    {
        $options = \Config::get('paymenttype.PAYMENT_GATEWAY');
        $dropdownHtml = '<select name="gateway_name" aria-label="Select Payment Gateway" data-hide-search="true" data-control="select2" class="form-select form-select-solid fw-bolder">';
        $dropdownHtml .= "<option value=\"\">All Gateways</option>";
        foreach ($options as $option) {
            $value = $option['name'];
            $label = $option['name'];
            if($selectedValue!=''){
            $selected = ($selectedValue !== null && $selectedValue == $value) ? 'selected' : 'disabled';
            }else{
            $selected = ($selectedValue !== null && $selectedValue == $value) ? 'selected' : '';
            }
            $dropdownHtml .= "<option value=\"$value\" $selected>$label</option>";
        }
    
        $dropdownHtml .= '</select>';
    
        return $dropdownHtml;
    }



}








// app/Helpers/dHelper.php
// app/Helpers/DashboardHelper.php

if (!function_exists('renderDashboardNotifications')) {
    function renderDashboardNotifications($userPermissionArr)
    {
        $notifications = [];

        if ($userPermissionArr['PermissionSetting']['Status'] === false) {
            $notifications[] = view('Retailer.elements.NotificationBanner.DangerBanner', [
                'title' => __('messages.PROFILE_IN_REVIEW_TITLE'),
                'message' => __('messages.PROFILE_IN_REVIEW'),
            ])->render();
        }

        if ($userPermissionArr['GatewayConfigured'] === false) {
            $notifications[] = view('Retailer.elements.NotificationBanner.DangerBanner', [
                'title' => __('messages.PROFILE_GATEWAY_CONFIGURATION_TITLE'),
                'message' => __('messages.PROFILE_GATEWAY_CONFIGURATION_DESCRIPTION'),
            ])->render();
        }

        return implode('', $notifications);
    }
}




if (!function_exists('getSettalmentAmount')) {
    function getSettalmentAmount()
    {
        $setalmentAmount = 0;
        $setalmentAmount = \App\Helpers\CustomHelper::getAllSettalmentAmount(getAuthValue('id'));
        return $setalmentAmount;

    }
}


if (!function_exists('getInstantSettalmentAmount')) {
    function getInstantSettalmentAmount($amount)
    {
        $floatAmount = (float) str_replace(',', '', $amount);
        $instantSettalmentFee = 0.20;
        $setalmentAmount = (float)$floatAmount - ((float)$floatAmount * (float)$instantSettalmentFee);
        return $setalmentAmount;
    }
}




if (!function_exists('getFloatAmount')) {
    function getFloatAmount($amount)
    {
        $floatAmount = (float) str_replace(',', '', $amount);
        return $floatAmount;
    }
}





if (!function_exists('convertToDays')) {
    function convertToDays($input) {
        if (preg_match('/^T(\d+)$/', $input, $matches)) {
            $days = intval($matches[1]);
            return "T+" . $days . " Days";
        }
        return $input;
    }
}



/**
 * Formate Settalment Time
 */
 if (!function_exists('getSettalmentTimeFormate')) {
    function getSettalmentTimeFormate($input) {
        if(is_numeric($input)){
            if($input<=720){
                return "In ".$input." Min";
            }else{
                return "At ".convertToAMPM($input);
            }
        }else{
            return "At ".convertToAMPM($input);
        }
    }
}



/**
 * Method for get the current date after Formate
 * @return string   
 */
if (!function_exists('convertToAMPM')) {
     function convertToAMPM($time) {
        // Explode the time string into hours and minutes
        $parts = explode(':', $time);
        $hours = intval($parts[0]);
        $minutes = intval($parts[1]);

        // Determine if it's AM or PM
        $ampm = $hours >= 12 ? 'PM' : 'AM';

        // Convert hours to 12-hour format
        if ($hours > 12) {
            $hours -= 12;
        } elseif ($hours === 0) {
            $hours = 12; // Midnight (12:00 AM)
        }

        // Format the time
        return sprintf('%d:%02d %s', $hours, $minutes, $ampm);
    }
}


/**
 * Get Announcement For User
 */
if (!function_exists('getAnnouncement')) {
    function getAnnouncement()
    {
        $setalmentAmount = 0;
        $setalmentAmount = \App\Helpers\CustomHelper::getAnnouncement(getAuthValue('id'));
        return $setalmentAmount;

    }
}



/**
 * Method Name: GetTicket Number
 * @param Ticket $ticketObj
 * @return string
 */
if (!function_exists('getTicketNumber')) {
    function getTicketNumber($ticketItem)
    {
        $ticketNumber = 'TKT-' .date('Ymd',strtotime($ticketItem->created_at)). $ticketItem->id;
        return $ticketNumber;

    }
}






       
/**
 * Get current Token
 */

 if (!function_exists('getComplaintIssueList')) {
    function getComplaintIssueList($selectedValue=0)
    {
        $options = [
            ['value' => 'Account Not Approved', 'label' => 'Account Not Approved'],
            ['value' => 'KYC InComplete', 'label' => 'KYC InComplete'],
            ['value' => 'InValid Bank Account', 'label' => 'InValid Bank Account'],
            ['value' => 'Email Not Verified', 'label' => 'Email Not Verified'],
            ['value' => 'Mobile Not Verified', 'label' => 'Mobile Not Verified'],
            ['value' => 'Transaction Issue', 'label' => 'Transaction Issue'],
            ['value' => 'Settalment  Issue', 'label' => 'Settalment  Issue'],
            ['value' => 'Wallet Not Credited', 'label' => 'Wallet Not Credited'],
            ['value' => 'Wallet Transfer', 'label' => 'Wallet Transfer'],
            ['value' => 'Payment Link Related', 'label' => 'Payment Link Related'],
            ['value' => 'Payout Related', 'label' => 'Payout Related'],
            ['value' => 'Other', 'label' => 'Other'],
        ];
    
        $dropdownHtml = '<select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Your Query Type" name="issue_type">';
    
        foreach ($options as $option) {
            $value = $option['value'];
            $label = $option['label'];
    
            $selected = ($selectedValue !== null && $selectedValue == $value) ? 'selected' : '';
    
            $dropdownHtml .= "<option value=\"$value\" $selected>$label</option>";
        }
    
        $dropdownHtml .= '</select>';
    
        return $dropdownHtml;
    }
}










    
/**
 * Get Local Text
 * @param StringText
 * @return Converted Local Languaage
 */

 if (!function_exists('getLocalText')) {
    function getLocalText($string)
    {
       $localText = '';
       if (strpos($string, ' ') !== false) {
            $string = str_replace(' ', '_', $string);
        }
       $localText = __('messages.' . strtolower($string));
       return $localText;
    }
}




if (!function_exists('getAuthRoutePrefix')) {
    function getAuthRoutePrefix($roleName=null)
    {
        $role = auth()->user()->role; // Assuming the user is authenticated
        if($role=='distributor'){
            return 'ds';
        }elseif($role=='retailer'){
            return 'ro';
        }elseif($role=='admin'){
            return 'admin';
        }else{
            return '';
        }
    }
}





/**
 * Get Payout List
 */

 if (!function_exists('getPayoutList')) {
    function getPayoutList()
    {
        $paymentTypeList = \Config::get('global.PAYOUT_LIST');
        if($paymentTypeList){
            return $paymentTypeList;
        }else{
            return null;
        }
    }
}


/**
 * Method Name : getMasterBankList()
 * @return arrayList Of Master Banks
 */
if (!function_exists('getMasterBankList')) {
    function getMasterBankList()
    {
        $bankList = [];
        $bankList = \App\Helpers\CustomHelper::getAllMasterBank();
        return $bankList;

    }
}




/**
 * Method Name : getMasterBankList()
 * @return arrayList Of Master Banks
 */
if (!function_exists('getMasterBankName')) {
    function getMasterBankName($bank_id)
    {
        $bankList = [];
        $bankList = \App\Helpers\CustomHelper::getAllMasterBank();
        foreach($bankList as $item){
            if($item['id']==$bank_id){
                return $item['bank_name'];
            }
        }

    }
}




/**
 * Method Name : getMasterBankList()
 * @return arrayList Of Master Banks
 */
 if (!function_exists('getMasterBankSelectList')) {
    function getMasterBankSelectList($selectedValue=null)
    {
        $options = getMasterBankList();
    
        $dropdownHtml = '<select class="selectBank form-select form-select-solid" data-control="select2" data-hide-search="false" data-placeholder="Status" data-kt-ecommerce-order-filter="status" name="bank_name" onchange="getIFSCCode(this.value)">';
    
        foreach ($options as $option) {
            $value = $option['id'];
            $label = $option['bank_name'];
            $ifscode = $option['ifsc_code'];
            $selected = ($selectedValue !== null && $selectedValue == $value) ? 'selected' : '';
            $dropdownHtml .= "<option data-ifsc-code=\"$ifscode\" value=\"$value\" $selected>$label</option>";
        }
    
        $dropdownHtml .= '</select>';
    
        return $dropdownHtml;
    }
}





/**
 * Method Name : getMasterBankList()
 * @return arrayList Of Master Banks
 */
if (!function_exists('isSuperDistributor')) {
    function isSuperDistributor()
    {
        if(getAuthValue('role')=='Superdistributor'){
            return true;
        }else{
            return false;
        }
    }
}
      



/**
 * Method Name: getFinicialYear
 * @return string
 */
if (!function_exists('getFiscalYear')) {
    function getFiscalYear() {
        $currentYear = date('y');
        $currentMonth = date('n'); // numeric representation of a month, without leading zeros (1-12)
        
        if ($currentMonth >= 4 && $currentMonth <= 12) {
            // From April to December
            $startYear = $currentYear;
            $endYear = $currentYear + 1;
        } else {
            // From January to March
            $startYear = $currentYear - 1;
            $endYear = $currentYear;
        }
        
        return $startYear.'-'.$endYear;
    }
}






if (!function_exists('getDefaultPayoutServiceName')) {
    function getDefaultPayoutServiceName()
    {
        $payoutname = 'CF';
        //$setalmentAmount = \App\Helpers\CustomHelper::getAllSettalmentAmount(getAuthValue('id'));
        return $payoutname;

    }
}

