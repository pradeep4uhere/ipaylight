<?php

namespace App\Services;
use TCPDF;
use App\Models\Transaction;
use Log;
use Illuminate\Support\Facades\Storage;



class PdfGenerator
{
    protected $pdf;

    public function __construct()
    {
        $this->pdf = new TCPDF();
    }

    public function generatePdf($html, $filename = 'document.pdf', $output = 'D')
    {
        // Create a new TCPDF instance
        $pdf = new \TCPDF();
        // Set document information
        //$this->pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Invoice');
        //$this->pdf->SetSubject('Document');
        //$this->pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // Set default header data
        //$this->pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING);

        // Set margins
        $pdf->SetMargins(10, 10, 10, false);
        // Add a page
        $pdf->AddPage();
        $pdf->SetFont('times', '', 10); // Font: Times, Size: 12 points

        // Write HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        // Close and output PDF
        
        $pdfContent = $pdf->Output($filename, $output);
        return   $pdfContent;
    }


    private function getInvoiceNumber($transactionArr){
        $TransID = str_pad($transactionArr['id'], 10 - 4, '0', STR_PAD_LEFT);
        $invoiceNumber = $TransID;
        return 'PG-'.getFiscalYear().'-'.$invoiceNumber;

    }


    public function pdfGenerationAndSave($transaction_id){
        try{
            //echo $transaction_id; die;
            //$transaction_id = decryptString($transactionId);
            $transactionArr = Transaction::with('User')->find($transaction_id)->toArray();
            //dd($transactionArr);
            $taxamount = $transactionArr['amount'] * ($transactionArr['rate_fee']/100); 
            //Total GST 
            $totalTaxableAmount = $taxamount;
            $TaxableAmount = $taxamount*100/118;
            $chargeableAmount = $TaxableAmount;
            $gstAmount = $taxamount -  $TaxableAmount;
            $IGSTAmountOnTaxableAmount = $TaxableAmount *0.18;
            if($transactionArr['user']['state']=='DL'){
                $IGSTAmount = 0;
                $CGSTAmouunt = $gstAmount/2;
                $SGSTAmouunt = $gstAmount/2;
                $cgst = $CGSTAmouunt;
            }else{
                $CGSTAmouunt = 0;
                $SGSTAmouunt = 0;
                $IGSTAmount = $IGSTAmountOnTaxableAmount;
                $cgst = $CGSTAmouunt;
            }

            $TotalInvoiceValue = $totalTaxableAmount;
            $SGSTAmount = 0;
            $taxamountWithGst = 0;
            //total Amount 
            $totalAmount = $TotalInvoiceValue;
           
            $StateCode = '07';

            $totalNonTaxableAmount = 0;
            $invoiceArr = [
                'User'=>[
                    'Name'=> $transactionArr['user']['name'].' '.$transactionArr['user']['last_name'],
                    'Mobile'=>$transactionArr['user']['mobile'],
                    'Email'=>$transactionArr['user']['email'],
                    'Address'=>$transactionArr['user']['address'],  
                    'Zipcode'=>$transactionArr['user']['zipcode'],  
                    'City'=> $transactionArr['user']['city'],  
                    'StateCode'=>$StateCode
                ],
                'Company'=>[
                    'CompanyName'=>env('COMPANY_NAME'),
                    'CompanyAddress'=>env('COMPANY_ADDRESS'),
                    'CompanyGSTIN'=>env('COMPANY_GSTIN'),
                    'CompanyCIN'=>env('COMPANY_CIN'),
                    'CompanyPAN'=>env('COMPANY_PAN'),
                    'CompanyStateCode'=>env('COMPANY_STATE_CODE'),
                    'CompanyWebAddress'=>env('COMPANY_WEB_ADDRESS'),
                    'CompanyEmail'=>env('COMPANY_EMAIL_ADDRESS'),
                    'CompanyMobile'=>env('COMPANY_MOBILE'),
                    'CompanyWhatsapp'=>env('COMPANY_WHATSAPP'),
                ],
                'Price'=>$transactionArr['amount'],
                'chargeableAmount'=>$chargeableAmount,
                'TaxableAmount'=>$TaxableAmount,
                'CGSTAmouunt'=>$CGSTAmouunt,
                'SGSTAmouunt'=>$SGSTAmouunt,
                'IGSTAmount'=>$IGSTAmount,
                'TotalInvoiceValue'=>$TotalInvoiceValue,
                'SGST_RATE'=>number_format($transactionArr['rate_fee'],2),
                'CGST'=>$cgst,
                'InvoicePeriod'=>getFormatDate($transactionArr['created_date'],'M, Y'),
                'InvoiceDate'=>getFormatDate($transactionArr['created_date'],'d, M Y'),
                'InvoiceNumber'=>$this->getInvoiceNumber($transactionArr),
                'TotalNonTaxableAmount'=>number_format(round($totalNonTaxableAmount),2),
                'TotalTaxableAmount'=>number_format(round($totalAmount),2),
                'TotalAmount'=>number_format(round($totalAmount),2),
                'AmountToWord'=> ucwords(AmountToWords(round($totalAmount))),
                "ProductDescription"=>"",
                "Quantity"=>1,
                "AppName"=>env('APP_NAME'),
                "Web"=>env('APP_WEBISTE_URL'),
                "Email"=>env('APP_EMAIL'),
                "Mobile"=>env('APP_MOBILE'),
                "Whatsapp"=>env('APP_WHATSAPP'),
                "Address"=>env('APP_ADDRESS')
            ];
            $invoiceNumber = $this->getInvoiceNumber($transactionArr);
            $html = view('Invoices.invoices',['data'=>$invoiceArr])->render();  
             // Generate the PDF content
            $pdfSaveContent = $this->generatePdf($html, 'invoice_' . $invoiceNumber . '.pdf','D'); 
            Log::info('Generated PDF Content: ' . substr($pdfSaveContent, 0, 200)); 
            
            // Define the path where you want to save the PDF
            $monthDir = date('M').'-'.date('Y');
            $filename = 'invoice_'. $invoiceNumber .'.pdf';
            //$encryptFileName = encryptString($filename);
            $encryptFileName = $filename;
            $filePath = storage_path('app/public/invoices/'.$monthDir.'/'. $encryptFileName);

            // Ensure the directory exists
            $monthDir = date('M',strtotime($transactionArr['created_date'])).'-'.date('Y',strtotime($transactionArr['created_date']));
            if (!Storage::exists('public/invoices/'.$monthDir)) {
                Storage::makeDirectory('public/invoices/'.$monthDir);
            }
            Log::info('PDF File Path: ' . $filePath);
            // Save the PDF content to the specified path
            if (file_put_contents($filePath, $pdfSaveContent) === false) {
                Log::error('Failed to save PDF file.');
            }
            $pdfSaveContent = $this->generatePdf($html, 'invoice_' . $invoiceNumber . '.pdf'); 


        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return response()->json(['error' => 'PDF generation failed'], 500);
        }
    }
}
