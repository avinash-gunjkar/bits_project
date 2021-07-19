<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>invoice</title>
<style>
*{ margin:0px; padding:0px; box-sizing:border-box;}
body{ font-size:10px; font-family: Arial, Helvetica, sans-serif; color:#333;}
.main { width:90%; margin:50px;}
.table { width:100%;}
.table table { border-collapse:collapse; width:100%}
.table table th, .table table td { padding:6px 5px;}
.table table tr.border{ border-bottom:solid 1px #cccccc;}
.table table td h1{ margin:10px 0px; font-weight:300;}
.cmtname { text-transform:uppercase;}
.text-center { text-align:center;}
.text-right { text-align: right;}
p{ margin-bottom:5px;}
.bg { background:#CCC;}
</style>
</head>
<body>
<div class="main">
	<div class="table">
    <?php //vdebug($invoice_details)?>
    	<table>
        	<tr class="border">
                    <td colspan="4"><img src="<?=APPPATH.'../assets/frontend/images/tecs-pdf-logo.png'?>" style="width:300px; "> </td>	
                </tr>
        	<tr class="border">
                    <td colspan="4" class="text-right"><h1><?= ucwords($invoice_details->inv_type)?></h1></td>	
                </tr>
            </table>
            <table>
            <colgroup>
            	<col width="22%" />
                <col width="55%" />
                <col width="12%" />
                <col width="15%" />
            </colgroup>
            <tr class="border">
            	<td> Invoice No.: <?=$invoice_details->inv_unique_id?></td>
                <td colspan="3"> Date:<?= printFormatedDate($invoice_details->invoice_date)?></td>	
            </tr>
            
            <tr class="border">
            	<td> Customer</td>
                <td> <strong><?=$invoice_details->customer_name?></strong> </td>
                <td colspan="2"> </td>	
            </tr>
            <tr>
            	<td> Company Name</td>
                <td class="cmtname"><?=$invoice_details->company_name?></td>
                <td colspan="">Terms</td>
                <td colspan=""><?=$invoice_details->term?></td>
            </tr>
            
             <tr>
            	<td> Address</td>
                <td class=""><?=$invoice_details->address?></td>
                <td colspan=""></td>
                <td colspan=""></td>
            </tr>
            
             <tr>
            	<td>City</td>
                <td class=""><?=$invoice_details->city_name?> &nbsp; Pin: <?=$invoice_details->pincode?>
                </td>
                <td colspan=""></td>
                <td colspan=""></td>
            </tr>
            
             <tr>
            	<td>Contact No </td>
                <td class=""><?=$invoice_details->contact_no?></td>
                
            </tr>
             <tr class="border">
            	<td> GST/TAX No. </td>
                <td class=""><?=$invoice_details->gst_tax_no?></td>
                <td colspan=""></td>
                <td colspan=""></td>
            </tr>
            </table>
            
            <table>
              <tr class="bg">
            	<th class="text-center">Sr No.</th>
                <th class="text-center">Particular</th>
                <th class="text-center">Amount (<?=$invoice_details->transaction_currency?>)</th>
             
            </tr>
            <?php foreach ($invoice_details->billingItems as $key=>$item){?>
              <tr class="">
            	<td class="text-center"><?=$key+1?></td>
                <td class=""><?=$item->particular?></td>	
                <td class="text-right"><?= number_format($item->amount,2)?></td>	
            </tr>
            <?php }?>
<!--               <tr class="border bg">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-right"><strong>Sub Total</strong></td>
                    <td class="text-right"><strong><?=$invoice_details->inv_amount?></strong></td>
                </tr>
               <tr class="border bg">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-right"><strong>CGST</strong></td>
                    <td class="text-right"><strong><?=$invoice_details->cgst_tax?></strong></td>
                </tr>
               <tr class="border bg">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-right"><strong>SGST</strong></td>
                    <td class="text-right"><strong><?=$invoice_details->sgst_tax?></strong></td>
                </tr>-->
               <tr class="border bg">
                   
                   <td class="text-right" colspan="2">Amount in words:<?=getIndianCurrencyInWords($invoice_details->total_amount)?><strong>Total (<?=$invoice_details->transaction_currency?>)</strong></td>
                   <td class="text-right"><strong><?= number_format($invoice_details->total_amount,2)?></strong></td>
                </tr>
            </table>
            <table>
            
           
               <tr class="">
            	<td class="">TEMGIRE Consultancy Services (P) Limited</td>
                <td class=""> </td>
                <td class=""></td>
                <td colspan="" class=""></td>
            </tr>
              
               <tr class="">
            	<td class="">HDFC Bank Ltd</td>
                <td class=""> </td>
                <td class=""></td>
                <td colspan="" class=""></td>
            </tr>
            
               <tr class="">
            	<td class="">IFSC: HDFC0000900</td>
                <td class=""> </td>
                <td class=""></td>
                <td colspan="" class=""></td>
            </tr>
             
               <tr class="border">
            	<td class="">Account No: 50200033008212</td>
                <td class=""></td>
                <td class=""></td>
                <td colspan="" class=""></td>
            </tr>
            
             
            <tr class="">
            	<td class="" colspan="2">
                    <p>TAN: PNET10300D</p>								
                    <p>PAN: AAFCT4541F</p>						
                    <p>GSTIN: 27AAFCT4541F1ZE</p>									
                    <p>SAC Code: 9971</p>								
                    <p>LUT No: AD271019002979R</p>									
                    <p>MSME No: 547532579593</p>
		</td>
                                
                <td class="text-center">Authorised Signatory</td>
                
            </tr>
            
            
            
            <tr>
            	<td class="text-center bg" colspan="4">
                    <p><strong>• Registered Office •</strong></p>
                    <p>103, Chandrarang Silver, Javalkarnagar, Pimple Gurav, Pune-411061. INDIA</p>
                    <p> Phone: +91 77090 65277; Mobile: +91 84592 73468;</p>
                    <p> E-mail: sales@24thmile.com</p>
                    <p> CIN U74999PN2015PTC156121</p>
                </td>
            
            </tr>
            
        </table>
    </div>
</div>

</body>
</html>