<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice</title>

    <style>
       
        html,
        body {
            margin: 0px;
            padding: 0px;
            font-family: sans-serif;
        }
        .text-gray-800 {
            color: #3f4254 !important;
        }
        h1,h2,h3,h4,h5,h6,p,span,label {
            font-family: sans-serif;
        }
        table {
            width: 794px;
            border-collapse: collapse;
            margin-bottom: 0px !important;
            border-radius: 9px 9px 9px 9px;
            -moz-border-radius: 9px 9px 9px 9px;
            -webkit-border-radius: 9px 9px 9px 9px;
            border: 0px solid #009ef7;
        }
        table thead th {
            height: 25px;
            text-align: left;
            font-size: 10px;
            font-family: sans-serif;
            color:#FFF
           
        }
        table, th, td {
            border: 0px solid #ddd;
            padding: 8px;
            font-size: 10px;
        }

        .heading {
            font-size: 16px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }
        .small-heading {
            font-size: 10px;
            font-family: sans-serif;
        }
        .total-heading {
            font-size: 10px;
            font-weight: 700;
            font-family: sans-serif;
        }
       

        .text-start {
            text-align: left;
        }
        .text-end {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }
        .no-border {
            border: 0px solid #fff !important;
        }
        .bg-blue {
            background-color: #009ef7;
            color: #fff;
        }
        .text-center {
                text-align: center !important;
            }
        .fs-8 {
            font-size: .85rem !important;
        }
        .mt-5 {
            margin-top: 1.25rem !important;
        }
        .fw-bolder {
            font-weight: 600 !important;
        }
        .mb-5 {
            margin-bottom: 3rem !important;
        }

        .container {
            width: 894px; /* Width of an A4 page in pixels */
            margin: 0 auto;
            padding: 20px;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-table th, .invoice-table td {
            border: 0px solid #ddd;
            padding: 8px;
        }
        .invoice-table th {
            background-color: #f2f2f2;
            color: black;
            text-align: left;
        }

    </style>
</head>
<body>
<div class="heading" style="font-size:14px; text-align:cener; width:100%; margin-bottom:20px; padding-bottom:20px">
    <span style="text-align:center;font-size:14px;"><strong>TAX INVOICE</strong></sapn><br/>
    <span style="text-align:center;font-size:11px">Original for Recipient</span><br/><br/>
<div>
<table cellspacing="0" cellpadding="5"  class="invoice-table" style="margin-bottom:10px; margin-top:10px;">
    <thead>
        <tr>
            <th style="width: 50%; text-align: left;" colspan="2">
                <img src="https://paygenius.in/logo.svg" height="30px"/>
            </th>
            <th style="width: 50%; text-align: right;" colspan="2">
                <span>Invoice No: #{{$data['InvoiceNumber']}}</span><br>
                <span>Period: {{$data['InvoicePeriod']}}</span><br>
                <span>Date: {{$data['InvoiceDate']}}</span><br>
                <span>Is Reverse Charges Applicable: No</span>
            </th>
        </tr>
        <tr style="background-color: #009ef7;color:#FFF">
            <th style="width: 50%;font-weight:bold;" colspan="2">Company Details</th>
            <th style="width: 50%;font-weight:bold;" colspan="2">Customer Details</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="2" style="text-align:left"><br/>
            <span style="text-align:left;padding:1px;margin:0px;font-weight:bold;font-size:11px">{{$data['Company']['CompanyName']}}</span><br/>
            <span style="text-align:left;padding:1px;margin:0px;font-size:10px">GSTIN : {{$data['Company']['CompanyGSTIN']}}</span><br/>
            <span style="text-align:left;padding:1px;margin:0px;font-size:10px">CIN : {{$data['Company']['CompanyCIN']}}</span><br/>
            <span style="text-align:left;padding:1px;margin:0px;font-size:10px">PAN : {{$data['Company']['CompanyPAN']}}</span><br/>
            <span style="text-align:left;padding:1px;margin:0px;font-size:10px">STATE CODE: {{$data['User']['StateCode']}}</span><br/>
            <span style="text-align:left;padding:1px;margin:0px;font-size:10px"> Place of Supply: Delhi</span>
           
            </td>
            <td colspan="2" style="text-align:left"><br/>
                <span style="text-align:left;padding:1px;margin:0px;font-weight:bold;font-size:11px">{{$data['User']['Name']}}</span><br/>
                <span style="text-align:left;padding:1px;margin:0px;font-size:10px">Mobile: +91-{{$data['User']['Mobile']}}</span><br/>
                <span style="text-align:left;padding:1px;margin:0px;font-size:10px">Email: {{$data['User']['Email']}}</span><br/>
                <span style="text-align:left;padding:1px;margin:0px;font-size:10px">Address: #{{$data['User']['Address']}}</span><br/>
                <span style="text-align:left;padding:1px;margin:0px;font-size:10px">{{$data['User']['City']}}, ZipCode: {{$data['User']['Zipcode']}}, India</span>
            </td>
        </tr>
    </tbody>
</table>
<div class="heading">
    <span style="text-align:center;font-size:14px"></sapn><br/>
<div>
<table cellspacing="0" cellpadding="3" class="invoice-table" style="margin-top:10px;width:100%">
    <thead>
        <tr style="background-color: #009ef7; color:#FFF">
            <th style="width: 5%;">ID</th>
            <th style="width: 25%;text-align: center;">Description</th>
            <th style="width: 10%;text-align: center;"> HSN/SAC</th>
            <th style="width: 10%;text-align: center;">  GST %</th>
            <th style="width: 10%;text-align: center;">Service Charge</th>
            <th style="width: 25%;text-align: center;">Transacted  Amount</th>
            <th style="width: 15%;text-align: center;">Charges (Taxable)</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="width: 5%;">1.</td>
            <td style="width: 25%;text-align: center;">Platform Charges </td>
            <td style="width: 10%;text-align: center;">997158</td>
            <td style="width: 10%;text-align: center;">18%</td>
            <td style="width: 10%;text-align: center;">{{$data['SGST_RATE']}}%</td>
            <td style="width: 25%;text-align: center;">{{number_format($data['Price'],2)}}</td>
            <td style="width: 15%;text-align: center;">{{number_format($data['chargeableAmount'],2)}}</td>
        </tr>
        <tr>
            <td style="width: 5%;">&nbsp;</td>
            <td style="width: 25%;text-align: center;">&nbsp;</td>
            <td style="width: 10%;text-align: center;">&nbsp;</td>
            <td style="width: 10%;text-align: center;">&nbsp;</td>
            <td style="width: 10%;text-align: center;">&nbsp;</td>
            <td style="width: 25%;text-align: center;">&nbsp;</td>
            <td style="width: 15%;text-align: center;">&nbsp;</td>
        </tr>
       
        <tr>
            <td style="width: 5%;">&nbsp;</td>
            <td style="width: 25%;text-align: center;">&nbsp;</td>
            <td style="width: 10%;text-align: center;">&nbsp;</td>
            <td style="width: 10%;text-align: center;">&nbsp;</td>
            <td style="width: 10%;text-align: center;">&nbsp;</td>
            <td style="width: 25%;text-align: center;">&nbsp;</td>
            <td style="width: 15%;text-align: center;">&nbsp;</td>
        </tr>
        <tr>
            <td style="width: 5%;">&nbsp;</td>
            <td style="width: 25%;text-align: center;">&nbsp;</td>
            <td style="width: 10%;text-align: center;">&nbsp;</td>
            <td style="width: 10%;text-align: center;">&nbsp;</td>
            <td style="width: 10%;text-align: center;">&nbsp;</td>
            <td style="width: 25%;text-align: center;">&nbsp;</td>
            <td style="width: 15%;text-align: center;">&nbsp;</td>
        </tr>
        <tr>
            <td style="width: 5%;">&nbsp;</td>
            <td style="width: 25%;text-align: center;">&nbsp;</td>
            <td style="width: 10%;text-align: center;">&nbsp;</td>
            <td style="width: 10%;text-align: center;">&nbsp;</td>
            <td style="width: 10%;text-align: center;">&nbsp;</td>
            <td style="width: 25%;text-align: center;">&nbsp;</td>
            <td style="width: 15%;text-align: center;">&nbsp;</td>
        </tr>
        
        <tr>
            <td style="width: 5%;">&nbsp;</td>
            <td style="width: 25%;text-align: center;">&nbsp;</td>
            <td style="width: 10%;text-align: center;">&nbsp;</td>
            <td style="width: 10%;text-align: center;">&nbsp;</td>
            <td style="width: 10%;text-align: center;">&nbsp;</td>
            <td style="width: 25%;text-align: center;">&nbsp;</td>
            <td style="width: 15%;text-align: center;">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="5" style="text-align: right;">Taxable Sub Total</td>
            <td colspan="1" style="text-align: right;">&nbsp;</td>
            <td style="text-align: right;">{{number_format($data['TaxableAmount'],2)}}</td>
        </tr>
        <tr>
            <td colspan="5" style="text-align: right;">Add: CGST Payable</td>
            <td colspan="1" style="text-align: right;">9%</td>
            <td style="text-align: right;">{{number_format($data['CGSTAmouunt'],2)}}</td>
        </tr>
       
        <tr>
            <td colspan="5" style="text-align: right;">Add: SGST Payable</td>
            <td colspan="1" style="text-align: right;">9%</td>
            <td style="text-align: right;">{{number_format($data['SGSTAmouunt'],2)}}</td>
        </tr>
        <tr>
            <td colspan="5" style="text-align: right;">Add: IGST Payable</td>
            <td colspan="1" style="text-align: right;">18%</td>
            <td style="text-align: right;">{{number_format($data['IGSTAmount'],2)}}</td>
        </tr>
        <tr>
            <td colspan="6" style="text-align: right;">Total Invoice Value - <small>Inc. all vat/tax</small>:</td>
            <td style="text-align: right;">Rs. {{number_format($data['TotalInvoiceValue'],2)}}</td>
        </tr>
        <tr>
            <td colspan="8" style="text-align:left;"><br/>
                <span><b>Amount In Words:</b> {{$data['AmountToWord']}}</span>
            </td>
        </tr>
        <tr>
            <td colspan="5" style="text-align: left;"><br/>
            <span style="text-align:left;padding:1px;margin:0px;font-size:10px;font-weight:bold">A/C Holder Name:<br/></span>	
            <span style="text-align:left;padding:1px;margin:0px;font-size:10pxfont-weight:bold">Paygenius Payment Solutions Private Limited<br/></span>	 	 	 	 	 
            <span style="text-align:left;padding:1px;margin:0px;font-size:10px">Name of Bank: IDFC First Bank<br/></span>	 
            <span style="text-align:left;padding:1px;margin:0px;font-size:10px">Account Number: 10185352037<br/></span>	 
            <span style="text-align:left;padding:1px;margin:0px;font-size:10px">Account Type: Current Account<br/></span>	 
            <span style="text-align:left;padding:1px;margin:0px;font-size:10px">IFSC Code: IDFB0020101<br/></span>	 
            <span style="text-align:left;padding:1px;margin:0px;font-size:10px">Branch: Barakhamba Road, New Delhi</span>	 	
            </td>
            <td colspan="2" style="text-align:center;vertical-align: bottom;"><br/>
                <span style="text-align:left;padding:1px;margin:0px;font-size:10px;">For and on behalf of</span><br/>
                <span style="text-align:left;padding:1px;margin:0px;font-size:10px;">Paygenius Payment Solutions Private Limited</span><br/>
                <span style="text-align:left;padding:1px;margin:0px;font-size:10px;"><img src="http://paygenius.in/assets/media/stamp.png" height="80px"/></span>
            </td>
        </tr>
        <tr>
            <td colspan="7" style="text-align:left;"><br/>
                <span style="text-align:left;padding:1px;margin:0px;font-size:10px;">Terms / Declaration</span><br/>
                <span style="text-align:left;padding:1px;margin:0px;font-size:10px;">Any Discripancies in the invoice should be brought to our notice within 15 days the date of receipts of Invoice.</span>
            </td>
        </tr>
        <tr>
            <td colspan="7">
                <div class="text-center" style="font-size: 8px;">
                    {{$data['AppName']}}. All Rights Reserved<br>
                    Reg Address: {{$data['Address']}}<br>
                    Web: {{$data['Company']['CompanyWebAddress']}} | Email: {{$data['Company']['CompanyEmail']}} | Mobile: +91-{{$data['Company']['CompanyMobile']}} | Whatsapp: +91-{{$data['Company']['CompanyWhatsapp']}}
                </div>
            </td>
        </tr>
    </tbody>
</table>

</body>
</html>