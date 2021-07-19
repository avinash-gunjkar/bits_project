<div>
    <h3><?=$heading?></h3>
<table style=" border-collapse: collapse; border: 1px solid black;width:100%">
    <thead>
        <tr>
            <th style="border: 1px solid #000; color:#fff;background-color:#000;">#</th>
            <th style="border: 1px solid #000; color:#fff;background-color:#000;">Invoice No.</th>
            <th style="border: 1px solid #000; color:#fff;background-color:#000;">Company Name</th>
            <th style="border: 1px solid #000; color:#fff;background-color:#000;">Customer Name</th>
            <th style="border: 1px solid #000; color:#fff;background-color:#000;">Amount</th>
            <th style="border: 1px solid #000; color:#fff;background-color:#000;">CGST</th>
            <th style="border: 1px solid #000; color:#fff;background-color:#000;">SGST</th>
            <th style="border: 1px solid #000; color:#fff;background-color:#000;">IGST</th>
            <th style="border: 1px solid #000; color:#fff;background-color:#000;">Total</th>
            <th style="border: 1px solid #000; color:#fff;background-color:#000;">Currency</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($invoices as $key=>$invoice){ ?>
        <tr>
            <td style="border: 1px solid #000;"><?=$key+1?></td>
            <td style="border: 1px solid #000;"><?=$invoice->inv_unique_id?></td>
            <td style="border: 1px solid #000;"><?=$invoice->company_name?></td>
            <td style="border: 1px solid #000;"><?=$invoice->customer_name?></td>
            <td style="border: 1px solid #000;"><?=$invoice->total_amount?></td>
            <?php if($invoice->tax_type == 'IGST'){?>
                <td style="border: 1px solid #000;">- -</td>
                <td style="border: 1px solid #000;">- -</td>
                <td style="border: 1px solid #000;"><?=$invoice->igst_tax?></td>
            <?php }else{ ?>
                <td style="border: 1px solid #000;"><?=$invoice->cgst_tax?></td>
                <td style="border: 1px solid #000;"><?=$invoice->sgst_tax?></td>
                <td style="border: 1px solid #000;">- -</td>
            <?php } ?>
            
            <td style="border: 1px solid #000;"><?=$invoice->grand_total?></td>
            <td style="border: 1px solid #000;"><?=$invoice->transaction_currency?></td>
        </tr>
           
        <?php }?>
        <?php if(empty($invoices)){?>
                <tr><td colspan="10" style="border: 1px solid #000;" >No any data available.</td></tr>
            <?php }?>
    </tbody>

</table>
</div>