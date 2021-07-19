<div>
    <h3><?=$heading?> &nbsp; <a href="<?=base_url('admin/kyc-approval?filter_company_name=&filter_status=0')?>">Go to KYC Approval</a></h3>
<table style=" border-collapse: collapse; border: 1px solid black;width:100%">
    <thead>
        <tr>
            <th style="border: 1px solid #000; color:#fff;background-color:#000;">#</th>
            <th style="border: 1px solid #000; color:#fff;background-color:#000;">Company Name</th>
            <th style="border: 1px solid #000; color:#fff;background-color:#000;">Document Name</th>
            <th style="border: 1px solid #000; color:#fff;background-color:#000;">Status</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($list as $key=>$item){ ?>
        <tr>
            <td style="border: 1px solid #000;"><?=$key+1?></td>
            <td style="border: 1px solid #000;"><?=$item->name?></td>
            <td style="border: 1px solid #000;"><?=$item->document_name?></td>
            <td style="border: 1px solid #000;"><?=$item->document_status?'Approved':'Pending'?></td>
            
        </tr>
           
        <?php }?>
        <?php if(empty($list)){?>
            <tr><td colspan="10" style="border: 1px solid #000;" >No any data available.</td></tr>
            <?php }?>
    </tbody>

</table>
</div>