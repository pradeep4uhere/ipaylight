<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Csv\Writer;
use League\Csv\Reader;
use App\Models\User;
use App\Models\Transaction;
use App\Models\WalletTransaction;
use App\Models\PayoutTransfer;
use Illuminate\Support\Facades\Auth;

use DateTime; // Make sure to include this
use Carbon\Carbon;

class CsvExportController extends Controller
{
    
    /****************************************All Export From Admin Module*******************/
    /**
     * Generate and download CSV file.
     *
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function exportAdminTransaction(Request $request)
    {
        if($request->isMethod('post')){
            $days = $request->get('days');
            $date_range = $request->get('date_range');
            $gateway_name = $request->get('gateway_name');
            $status = $request->get('status');
            $query = Transaction::with(['User','Gateway'])
            ->join('gateways', 'transactions.gateway_id', '=', 'gateways.id')
            ->orderBy('transactions.id', 'DESC');

            if($date_range!=''){
                // Split the date range by ' to ' to get start and end dates
                list($startDateStr, $endDateStr) = explode(' to ', $date_range);

                // Convert string to DateTime objects
                $startDate = new DateTime($startDateStr);
                $endDate = new DateTime($endDateStr);

                // Format DateTime objects if needed
                $startDateFormatted = $startDate->format('Y-m-d');
                $endDateFormatted = $endDate->format('Y-m-d');
                $query->whereBetween('transactions.created_at', [$startDateFormatted, $endDateFormatted]);
            }elseif($days!=''){
                // Get the current date and time
                $endDate = Carbon::now();
                // Subtract 7 days from the current date
                $startDate = Carbon::now()->subDays($days);
                $query->whereBetween('transactions.created_at', [$startDate, $endDate]);
            }else{

            }
            // Check for gateway_name parameter
            if ($gateway_name!='') {
                $query->where('gateways.gateway_name', $gateway_name);
            }

            // Check for gateway_name parameter
            if ($status!='' ) {
                $query->where('transactions.status', $status);
            }

            $transactionList = $query->get();

        }else{
            $transactionList = Transaction::with(['User','Gateway'])->orderBy('id', 'DESC')->get();
        }

        // Format the date before exporting to CSV
        $transactionList->transform(function ($transaction) {
            $transaction->created_at = Carbon::parse($transaction->created_at)->format('m/d/Y h:i:s A');
            return $transaction;
        });

        //dd($query);

        $data[] = [
            'ID',
            'Payment Date',
            'Entity',
            'Payment ID',
            'Transaction ID',
            'Reference Key',
            'Product Info',
            'CustomerId',
            'Gateway Name',
            'Rate Fee',
            'Deposite Amount',
            'Payment Type',
            'Amount',
            'Currency',
            'Status',
            'Order ID',
            'Method',
            'Payment Mode',
            'Amount Refunded',
            'Refund Status',
            'Captured',
            'Description',
            'Payment Link',
            'Card ID',
            'Card',
            'Bank Name',
            'Wallet',
            'VPA',
            'Customer Name',
            'Customer Email',
            'Customer Mobile',
            'Fee',
            'Tax',
            'Error Code',
            'Error Description',
            'Error Source',
            'Error Step',
            'Error Reason',
            'Notes',
            'Payment Date',
            'IP Address',
            'User Browser',
            'User Agent',
            'zipCode',
            'cityName',
            'latitude',
            'longitude',
            'timezone',
            'regionName',
            'countryName',
            'ipAddress'



        

        ];
        foreach($transactionList as $item){
           
            $location = json_decode($item['location'],true);
            $data[] = [
                $item->id,
                '`'.$item->created_at,
                $item->entity,
                $item->gateway_payment_id,
                $item->txn_id,
                $item->payment_ref_key,
                $item->product_info,
                $item->customer_id,
                $item->gateway_name,
                $item->rate_fee,
                $item->deposite_amount,
                $item->payment_type,
                $item->amount,
                $item->currency,
                $item->status,
                $item->order_id,
                $item->method,
                $item->payment_mode,
                $item->amount_refunded,
                $item->refund_status,
                $item->captured,
                $item->description,
                $item->link_text,
                $item->card_id,
                $item->card,
                $item->bank,
                $item->wallet,
                $item->vpa,
                $item->customer_name,
                $item->customer_email,
                $item->customer_mobile,
                $item->fee,
                $item->tax,
                $item->error_code,
                $item->error_description,
                $item->error_source,
                $item->error_step,
                $item->error_reason,
                $item->notes,
                $item->created_date,
                $item->ip_address,
                $item->user_browser,
                $item->userAgent,
                $location['zipCode'],
                $location['cityName'],
                $location['latitude'],
                $location['longitude'],
                $location['timezone'],
                $location['regionName'],
                $location['countryName'],
                $location['ip'],
            ];
        }

        
        $fileName = "Transasction_".time().'.csv';
        $csv = Writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertAll($data);

        // Set headers
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="export.csv"',
        ];

        return response()->streamDownload(function () use ($csv) {
            echo $csv;
        }, $fileName, $headers);
    }



    public function exportAdminWalletTransaction(Request $request){
        if($request->isMethod('post')){
            
            $days = $request->get('days');
            $date_range = $request->get('date_range');
            $gateway_name = $request->get('gateway_name');
            $status = $request->get('status');
            $query = Transaction::with(['User','Gateway'])
            ->join('gateways', 'transactions.gateway_id', '=', 'gateways.id')
            ->orderBy('transactions.id', 'DESC');
        }else{
            $walletTransaction = WalletTransaction::with('User')->orderBy('id','DESC')->get();
        }
        //dd($walletTransaction);
        $data[] = [
            'ID',
            'Date',
            'User',
            'AgentCode',
            'Amount',
            'OpenBalance',
            'CloseBalance',
            'Description',
            'ReferenceNumber',
            'TransactionType',
            'transactionID',
            'Status'
        ];

        if($walletTransaction){
            foreach($walletTransaction as $item){
                $data[] = [
                    $item->id,
                    $item->created_at,
                    $item->user->name,
                    $item->user->agent_code,
                    $item->created_at,
                    $item->amount,
                    $item->open_balance,
                    $item->close_balance,
                    $item->description,
                    $item->reference_number,
                    $item->transaction_type,
                    generateNumberWithPad($item->transaction_id,18),
                    $item->transaction_status
                ];
            }
        }
        //dd($data);
        $fileName = "Wallet_Transasction_".time().'.csv';
        $csv = Writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertAll($data);

        // Set headers
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="export.csv"',
        ];

        return response()->streamDownload(function () use ($csv) {
            echo $csv;
        }, $fileName, $headers);

    }

    /****************************************All Export From Admin Module*******************/

    /**
     * Generate and Download CSV file
     * This will Export  all payout Transaction List
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function exportPayoutTransaction(Request $request){
        $user = Auth::user();
        $user_id = $user->id;
        $transactionList = PayoutTransfer::with('BeneficiaryAccount','UserContact')->where('user_id',$user_id)->orderBy('id','DESC')->get();
         // Format the date before exporting to CSV
         $transactionList->transform(function ($transaction) {
            $transaction->created_at = Carbon::parse($transaction->created_at)->format('m/d/Y h:i:s A');
            return $transaction;
        });
        //$sql = $query->toSql();
       //dd($transactionList[0]);

        $data[] = [
            'ID',
            'AgentCode',
            'UserContact_ID',
            'UserContact Name',
            'UserContact Email',
            'UserContact Mobile',
            'BeneficiaryID',
            'Customer Name',
            'Bank Name',
            'Account Number',
            'IFSC Code',
            'Payment Date',
            'Transaction ID',
            'Reference Key',
            'UTR Number',
            'Amount',
            'Fee',
            'Tax',
            'Descriptions',
            'Failed Reason',
            'Status',
        ];
        foreach($transactionList as $item){
            $data[] = [
                $item->id,
                $item->user->agent_code,
                $item['UserContact']['contact_id'],
                $item['UserContact']['first_name'].' '.$item['UserContact']['last_name'],
                $item['UserContact']['email'],
                $item['UserContact']['mobile_number'],
                $item['BeneficiaryAccount']['beneficiary_id'],
                $item['BeneficiaryAccount']['beneficiary_name'],
                $item['BeneficiaryAccount']['bank_name'],
                $item['BeneficiaryAccount']['account_number'],
                $item['BeneficiaryAccount']['ifsc_code'],
                '`'.$item->created_at,
                $item->transfers_reference_id,
                $item->payout_id,
                $item->utr_number,
                $item->amount,
                $item->fee,
                $item->tax,
                $item->descriptions,
                $item->failed_reason,
                $item->status,
            ];
        }
        //dd($data);
        
        $fileName = "Payout_Transasction_".time().'.csv';
        $csv = Writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertAll($data);

        // Set headers
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="export.csv"',
        ];

        return response()->streamDownload(function () use ($csv) {
            echo $csv;
        }, $fileName, $headers);
      

    }










    /**
     * Generate and download CSV file.
     * This is Export From Distributor Profile
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function exportTransaction(Request $request)
    {
    
        $userIds = User::where('parent_id', getAuthValue('id'))->pluck('id');
        if($request->isMethod('post')){
            $days = $request->get('days');
            $date_range = $request->get('date_range');
            $gateway_name = $request->get('gateway_name');
            $status = $request->get('status');
            $gateway_name = $request->get('gateway_name');
            $past_date = $request->get('past_date');
            $date_range_advance = $request->get('date_range_advance');  
            //dd($request->all());
            $query = Transaction::with(['User','Gateway'])
            ->join('gateways', 'transactions.gateway_id', '=', 'gateways.id')
            ->orderBy('transactions.id', 'DESC');
            
            if(strtolower(Auth::user()->role) == "retailer"){
                $userIds = Auth::user()->id; 
                $query->where('user_id',$userIds);
            }else{
                $query->whereIn('user_id', $userIds);
            }

            if($date_range!=''){
                // Split the date range by ' to ' to get start and end dates
                list($startDateStr, $endDateStr) = explode(' to ', $date_range);

                // Convert string to DateTime objects
                $startDate = new DateTime($startDateStr);
                $endDate = new DateTime($endDateStr);

                // Format DateTime objects if needed
                $startDateFormatted = $startDate->format('Y-m-d');
                $endDateFormatted = $endDate->format('Y-m-d');
                $query->whereBetween('transactions.created_at', [$startDateFormatted, $endDateFormatted]);
            }else if($days!=''){
                // Get the current date and time
                $endDate = Carbon::now();
                // Subtract 7 days from the current date
                $startDate = Carbon::now()->subDays($days);
                $query->whereBetween('transactions.created_at', [$startDate, $endDate]);
            }else{

            }
            // Advance Search Filter Start Here
            if ($gateway_name != '') {
                $query->where('gateways.gateway_name', $gateway_name);
                $searchFilter['GatewayName']= $gateway_name;
            }

            // Check for gateway_name parameter
            if ($status!='' ) {
                $query->where('transactions.status', $status);
            }

            if($past_date!=''){
                $pattern = '/^\d{4}-\d{4}$/';
                if($past_date==0){
                    $query->whereDate('transactions.created_at', '=', date('Y-m-d'));
                }else if(preg_match($pattern, $past_date)) {
                    // Get the current date
                    $currentYear = date('Y');
                    $currentMonth = date('m');
                    $currentDay = date('d');

                    // Determine the start date of the financial year
                    if ($currentMonth >= 4) {
                        // If the current month is April (4) or later, the financial year starts in the current year
                        $financialYearStart = $currentYear . '-04-01';
                    } else {
                        // Otherwise, the financial year starts in the previous year (April of the previous year)
                        $financialYearStart = ($currentYear - 1) . '-04-01';
                    }

                    // Determine the end date of the financial year
                    $yearStart = intval(substr($financialYearStart, 0, 4));
                    $yearEnd = $yearStart + 1;
                    $financialYearEnd = $yearEnd . '-03-31';
                    // Format the financial year
                    $query->whereDate('transactions.created_at', '>=', $financialYearStart);
                    $query->whereDate('transactions.created_at', '<=', $financialYearEnd);
                    
                }else{
                    // Get today's date
                    $endDate = new DateTime();
                    // Calculate the start date for the last 90 days
                    $startDate = (new DateTime())->modify($past_date);
                    // Format the dates
                    $startDateFormatted = $startDate->format('Y-m-d');
                    $endDateFormatted = $endDate->format('Y-m-d');
                    $query->whereDate('transactions.created_at', '>=', $startDateFormatted);
                    $query->whereDate('transactions.created_at', '<=', $endDateFormatted);
                }
                $searchFilter['PastDate']= $past_date;
            }

            if($date_range_advance!=''){
                // Split the date range by ' to ' to get start and end dates
                list($startDateStr, $endDateStr) = explode(' to ', $date_range_advance);
                // Convert string to DateTime objects
                $startDate = new DateTime($startDateStr);
                $endDate = new DateTime($endDateStr);

                // Format DateTime objects if needed
                $startDateFormatted = $startDate->format('Y-m-d');
                $endDateFormatted = $endDate->format('Y-m-d');
                $query->whereDate('transactions.created_at', '>=', $startDateFormatted);
                $query->whereDate('transactions.created_at', '<=', $endDateFormatted);
            }

            $transactionList = $query->get();
            $sql = $query->toSql();
            //dd($sql);

        }else{
            if(Auth::user()->role =='retailer'){
                $userIds = Auth::user()->id;
                $transactionList = Transaction::with('User')->where('user_id',$userIds)->orderBy('id', 'DESC')->get();
            }else{
                $transactionList = Transaction::with('User')->whereIn('user_id',$userIds)->orderBy('id', 'DESC')->get();
            }
        }

        // Format the date before exporting to CSV
        $transactionList->transform(function ($transaction) {
            $transaction->created_at = Carbon::parse($transaction->created_at)->format('m/d/Y h:i:s A');
            return $transaction;
        });
        //$sql = $query->toSql();
        

        $data[] = [
            'ID',
            'AgentCode',
            'Customer Name',
            'Customer Email',
            'Customer Mobile',
            'Payment Date',
            'Entity',
            'Payment ID',
            'Transaction ID',
            'Reference Key',
            'Product Info',
            'CustomerId',
            'Gateway Name',
            'Rate Fee',
            'Deposite Amount',
            'Payment Type',
            'Amount',
            'Currency',
            'Status',
            'Order ID',
            'Method',
            'Payment Mode',
            'Amount Refunded',
            'Refund Status',
            'Captured',
            'Description',
            'Payment Link',
            'Card ID',
            'Card',
            'Bank Name',
            'Wallet',
            'VPA',
            'Fee',
            'Tax',
            'Error Code',
            'Error Description',
            'Error Source',
            'Error Step',
            'Error Reason',
            'Notes',
            'Payment Date',
            'IP Address',
            'User Browser',
            'User Agent',
            'zipCode',
            'cityName',
            'latitude',
            'longitude',
            'timezone',
            'regionName',
            'countryName',
            'ipAddress',
            'createdDate'



        

        ];
        foreach($transactionList as $item){
           
            $location = json_decode($item['location'],true);
            $data[] = [
                $item->id,
                $item->user->agent_code,
                $item->customer_name,
                $item->customer_email,
                $item->customer_mobile,
                '`'.$item->created_at,
                $item->entity,
                $item->gateway_payment_id,
                $item->txn_id,
                $item->payment_ref_key,
                $item->product_info,
                $item->customer_id,
                $item->gateway_name,
                $item->rate_fee,
                $item->deposite_amount,
                $item->payment_type,
                $item->amount,
                $item->currency,
                $item->status,
                $item->order_id,
                $item->method,
                $item->payment_mode,
                $item->amount_refunded,
                $item->refund_status,
                $item->captured,
                $item->description,
                $item->link_text,
                $item->card_id,
                $item->card,
                $item->bank,
                $item->wallet,
                $item->vpa,
               
                $item->fee,
                $item->tax,
                $item->error_code,
                $item->error_description,
                $item->error_source,
                $item->error_step,
                $item->error_reason,
                $item->notes,
                $item->created_date,
                $item->ip_address,
                $item->user_browser,
                $item->userAgent,
                $location['zipCode'],
                $location['cityName'],
                $location['latitude'],
                $location['longitude'],
                $location['timezone'],
                $location['regionName'],
                $location['countryName'],
                $location['ip'],
                $item->created_at,
            ];
        }

        
        $fileName = "Transasction_".time().'.csv';
        $csv = Writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertAll($data);

        // Set headers
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="export.csv"',
        ];

        return response()->streamDownload(function () use ($csv) {
            echo $csv;
        }, $fileName, $headers);
    }





    /**
     * Method Name:: exportWalletTransaction()
     * This method export all wallet transctions
     */
    public function exportWalletTransaction(Request $request){
        if($request->isMethod('post')){
            $user_id = getAuthValue('id');
            $reference_number = $request->get('reference_number');
            $transaction_id = $request->get('transaction_id');
            $date_range = $request->get('date_range');
            $transaction_type = $request->get('transaction_type');
            $status = $request->get('status');
            $query = WalletTransaction::where('sender_id', $user_id)->OrderBy('id', 'DESC');
            if($reference_number!=''){
                $query->where('reference_number',$reference_number);
            }
            if($transaction_id!=''){
                $query->where('transaction_id',$transaction_id);
            }
            if($transaction_type!=''){
                if($transaction_type!='all'){
                    $query->where('transaction_type',$transaction_type);
                }
            }
            if($status!=''){
                if($status!='all'){
                    $query->where('status',$status);
                }
            }
            if($date_range!=''){
                // Split the date range by ' to ' to get start and end dates
                list($startDateStr, $endDateStr) = explode(' - ', $date_range);
                // Convert string to DateTime objects
                $startDate = new DateTime($startDateStr);
                $endDate = new DateTime($endDateStr);

                // Format DateTime objects if needed
                $startDateFormatted = $startDate->format('Y-m-d');
                $endDateFormatted = $endDate->format('Y-m-d');
                $query->whereDate('created_at', '>=', $startDateFormatted);
                $query->whereDate('created_at', '<=', $endDateFormatted);
            }
            //dd($query->toSql());
            $walletTransaction = $query->get();

        }else{
            $walletTransaction = WalletTransaction::where('sender_id',getAuthValue('id'))->orderBy('id','DESC')->get();
        }
        $data[] = [
            'ID',
            'Date',
            'Amount',
            'OpenBalance',
            'CloseBalance',
            'Description',
            'ReferenceNumber',
            'TransactionType',
            'transactionID',
            'Status'
        ];

        if($walletTransaction){
            foreach($walletTransaction as $item){
                $data[] = [
                    $item->id,
                    $item->created_at,
                    $item->amount,
                    $item->open_balance,
                    $item->close_balance,
                    $item->description,
                    $item->reference_number,
                    $item->transaction_type,
                    generateNumberWithPad($item->transaction_id,18),
                    $item->transaction_status
                ];
            }
        }

        $fileName = "Wallet_Transasction_".time().'.csv';
        $csv = Writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertAll($data);

        // Set headers
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="export.csv"',
        ];

        return response()->streamDownload(function () use ($csv) {
            echo $csv;
        }, $fileName, $headers);

    }
}
