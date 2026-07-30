<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\PdfGenerator;
use App\Models\Transaction;
use PDF; // Import the alias
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Log;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class PDFController extends Controller
{

    /**
     * Admin Method; getAllInvoiceList()
     * This Methods accessible form admin
     */
    public function getAllInvoiceList(){
        // Path to the directory you want to list
        $directoryPath = storage_path('app/public/invoices'); // Example directory path
        // Get directories using glob
        $directories = glob($directoryPath . '/*', GLOB_ONLYDIR);
        return view('Invoices.invoicesList', compact('directories')); 
    }


    public function getAllInvoiceFileList(Request $request,$dirName){
        $dirName = decryptString($dirName);
        // Path to the directory you want to list
        $directoryPath = storage_path('app/public/invoices/' . $dirName); // Example directory path
        // Get files in the directory
        $files = File::files($directoryPath);
        $fileDetails = [];
        foreach($files as $file){
            $fileSizeKB = round($file->getSize() / 1024, 2); // Convert bytes to KB and round to 2 decimal places
            $lastModified = Carbon::createFromTimestamp($file->getMTime())->format('Y-m-d H:i:s');
            //$decryprtFileName = decryptString($file->getFilename()); 
            $fileDetails[] = [
                'filename' => $file->getFilename(),
                'pathname' => $file->getPathname(),
                'viewpath' => '/storage/invoices/'.$dirName.'/'.$file->getFilename(),
                'size' => $fileSizeKB,
                'lastModified' => $lastModified, // UNIX timestamp
            ];
        }
        //dd($fileDetails);
        return view('Invoices.invoicesFileList',[
            'fileDetails'=>$fileDetails,
            'dirName'=>$dirName
        ]);
    }



    public function viewPDF(Request $request, $filename)
    {
        $fileNameString = decryptString($filename);
        $fileNameArr = explode('|',$fileNameString);
        $dirName = $fileNameArr[0];
        $fileName = $fileNameArr[1];
        // Determine the path to the PDF file
        $filePath = storage_path('app/public/invoices/' . $dirName .'/' .$fileName);
        // Check if the file exists
        if (!Storage::exists('public/invoices/' . $dirName . '/' . $filename)) {
            abort(404, 'File not found.');
        }
        $pdfUrl = route('view.pdf', ['filename' => $fileName]);
        // Return a view with the PDF file embedded in an <iframe>
        return view('Invoices.viewInvoice', ['pdfUrl' => asset('storage/invoices/' . $filename)]);
    }
    










    private function getInvoiceNumber($transactionArr){
        $TransID = str_pad($transactionArr['id'], 10 - 4, '0', STR_PAD_LEFT);
        $invoiceNumber = $TransID;
        return 'PG/'.getFiscalYear().'/'.$invoiceNumber;

    }

    public function pdfGenerationTesting(PdfGenerator $pdfGenerator, $transactionId){
        try{
            $transaction_id = decryptString($transactionId);
            
            $pdfContent = $pdfGenerator->pdfGenerationAndSave($transaction_id);
            die;


            // //dd($transactionArr);
            // $taxamount = $transactionArr['amount'] * ($transactionArr['rate_fee']/100); 
            // $gstAmountOnTax = $taxamount*0.18;

            // $SGSTAmount = $taxamount - $gstAmountOnTax;
            // $taxamountWithGst = $SGSTAmount * 0.18;

            // //Calculation For CGST 
            // $cgst = $gstAmountOnTax  - $taxamountWithGst;

            // //total Amount 
            // $totalAmount = $transactionArr['amount'] - $taxamountWithGst - $SGSTAmount - $cgst;

            // $totalNonTaxableAmount = 0;
            // $invoiceArr = [
            //     'User'=>[
            //         'Name'=> $transactionArr['user']['name'].' '.$transactionArr['user']['last_name'],
            //         'Mobile'=>$transactionArr['user']['mobile'],
            //         'Email'=>$transactionArr['user']['email'],
            //         'Address'=>$transactionArr['user']['address'],  
            //         'Zipcode'=>$transactionArr['user']['zipcode'],  
            //         'City'=> $transactionArr['user']['city'],  
            //         'StateCode'=>$transactionArr['user']['state']
            //     ],
            //     'Company'=>[
            //         'CompanyName'=>env('COMPANY_NAME'),
            //         'CompanyAddress'=>env('COMPANY_ADDRESS'),
            //         'CompanyGSTIN'=>env('COMPANY_GSTIN'),
            //         'CompanyCIN'=>env('COMPANY_CIN'),
            //         'CompanyPAN'=>env('COMPANY_PAN'),
            //         'CompanyStateCode'=>env('COMPANY_STATE_CODE'),
            //         'CompanyWebAddress'=>env('COMPANY_WEB_ADDRESS'),
            //         'CompanyEmail'=>env('COMPANY_EMAIL_ADDRESS'),
            //         'CompanyMobile'=>env('COMPANY_MOBILE'),
            //         'CompanyWhatsapp'=>env('COMPANY_WHATSAPP'),
            //     ],
            //     'Price'=>$transactionArr['amount'],
            //     'IGST'=>number_format(round($taxamountWithGst),2), //This is With GST 0.18
            //     'SGST'=>number_format(round($SGSTAmount),2),
            //     'SGST_RATE'=>number_format($transactionArr['rate_fee'],2),
            //     'CGST'=>$cgst,
            //     'InvoicePeriod'=>getFormatDate($transactionArr['created_date'],'M, Y'),
            //     'InvoiceDate'=>getFormatDate($transactionArr['created_date'],'d, M Y'),
            //     'InvoiceNumber'=>$this->getInvoiceNumber($transactionArr),
            //     'TotalNonTaxableAmount'=>number_format(round($totalNonTaxableAmount),2),
            //     'TotalTaxableAmount'=>number_format(round($totalAmount),2),
            //     'TotalAmount'=>number_format(round($totalAmount),2),
            //     'AmountToWord'=> ucwords(AmountToWords(round($totalAmount))),
            //     "ProductDescription"=>"",
            //     "Quantity"=>1,
            //     "AppName"=>env('APP_NAME'),
            //     "Web"=>env('APP_WEBISTE_URL'),
            //     "Email"=>env('APP_EMAIL'),
            //     "Mobile"=>env('APP_MOBILE'),
            //     "Whatsapp"=>env('APP_WHATSAPP'),
            //     "Address"=>env('APP_ADDRESS')
            // ];
            // $invoiceNumber = $this->getInvoiceNumber($transactionArr);
            // $html = view('Invoices.invoices',['data'=>$invoiceArr])->render();  
            // $pdfContent = $pdfGenerator->generatePdf($html, 'invoice_' . $invoiceNumber . '.pdf');


        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return response()->json(['error' => 'PDF generation failed'], 500);
        }
    }

}
