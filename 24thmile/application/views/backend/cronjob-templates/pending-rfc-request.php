<div>
    
<table style=" border-collapse: collapse; border: 1px solid black;width:100%">
    <thead>
        <tr>
            <th style="border: 1px solid #000; color:#fff;background-color:#000;">#</th>
            <th style="border: 1px solid #000; color:#fff;background-color:#000;">Exporter-Importer</th>
            <th style="border: 1px solid #000; color:#fff;background-color:#000;">RFC ID</th>
            <th style="border: 1px solid #000; color:#fff;background-color:#000;">Edit Request</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($list as $key=>$item){ ?>
        <tr>
            <td style="border: 1px solid #000;"><?=$key+1?></td>
            <td style="border: 1px solid #000;"><?=$item->exporter_importer_name?></td>
            <td style="border: 1px solid #000;"><?=$item->request_id?></td>
            <td style="border: 1px solid #000;"><a href="<?=base_url('edit-request-details/' . $item->request_id)?>" target="_blank">Edit</a></td>
        </tr>
           
        <?php }?>
        <?php if(empty($list)){?>
            <tr><td colspan="10" style="border: 1px solid #000;" >No any data available.</td></tr>
            <?php }?>
    </tbody>

</table>
</div>