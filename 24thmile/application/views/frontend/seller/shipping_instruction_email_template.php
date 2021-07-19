
<div class="container">

<div class="form-group">
    <div class="row">
        <div class="col-12 col-lg-2">
                       <label>RFC ID : </label>
                      <?=$requestDetails->request_id?>
               </div>
        
    </div>
       <div class="row">
               <div class="col-12 col-lg-2">
                       <label>Mode : </label>
                      <?=$requestDetails->mode?>
               </div>
               <div class="col-12 col-lg-2">
                       <label>Transaction : </label>
                      <?=$requestDetails->transaction?>
               </div>
           <div class="col-12 col-lg-2">
                       <label>Delivery Term :</label>
                      <?=$requestDetails->delivery_term_name?>
               </div>
           <div class="col-12 col-lg-2">
                <label>Shipment Type :</label><?=$requestDetails->shipment?>

               </div>
           <div class="col-12 col-lg-2">
                <label>Cargo :</label>
                 <?= $requestDetails->container_stuffing?>    
               </div>

           <div class="col-12 col-lg-2">
                <label>Cargo Nature :</label>
                 <?= $requestDetails->cargo_status?>    
               </div>
           <?php if(!empty($requestDetails->stuffing)){?>
           <div class="col-12 col-lg-2">
                <label><?=($requestDetails->transaction == "Import")?"De-stuffing":"Stuffing"?> :</label>
                 <?= $requestDetails->stuffing?>    
               </div>
           <?php }?>
       </div>

<div class="row">
 <div class="col-lg-6 rright">
     <h3><b>Pick-up Address</b></h3>
   <div class="form-row mb-1">
        <label>Contact Person Name :</label>
        <?= $requestDetails->consignor_name; ?>
    </div>
      <div class="form-row mb-1">
           <label>Contact Number :</label>
           <?= $requestDetails->consignor_country_code.' '.$requestDetails->consignor_phone; ?>

   </div>
    <div class="form-row mb-1">
        <label>Address :</label> <?= $requestDetails->consignor_address_line_1 .' '.$requestDetails->consignor_address_line_2; ?> 
        <?= $requestDetails->consignor_city_name; ?> <?= $requestDetails->consignor_pincode?' Pin Code:'.$requestDetails->consignor_pincode:''; ?>
    </div>


</div>
<div class="col-lg-6 rright">
     <h3><b>Deliver Address</b></h3>
   <div class="form-row mb-1">
        <label>Contact Person Name :</label> <?= $requestDetails->consignee_name; ?>
    </div>
      <div class="form-row mb-1">
           <label>Contact Number :</label> <?= $requestDetails->consignee_country_code.' '.$requestDetails->consignee_phone; ?>

   </div>
    <div class="form-row mb-1">
        <label>Address :</label> <?= $requestDetails->consignee_address_line_1.' '.$requestDetails->consignee_address_line_2; ?> 
        <?= $requestDetails->consignee_city_name; ?> <?= $requestDetails->consignee_pincode?' Pin Code: '.$requestDetails->consignee_pincode:''; ?>
    </div>

</div>
</div>

</div>
<div class="form-group" style="margin-top: 20px;">
    <div class="row">
           <div class="col-12 col-lg-4">
               <div class="edibx1">
                  <label>Shipment Value: </label> <?= $requestDetails->shipment_value_currency.' '.$requestDetails->shipment_value; ?>

           </div>
           </div>
           <div class="col-12 col-lg-4">
               <div class="edibx1">
            <label>Port Of Loading :</label> <?=$requestDetails->loading_port?>

           </div>
           </div>
           <div class="col-12 col-lg-4">
               <div class="edibx1">
                  <label>Port Of Discharge :</label> <?= $requestDetails->discharge_port?>

           </div>
           </div>

        <div class="col-12 col-lg-4">
                                <div class="edibx1">
                                <label>Pick-up Date and Time:</label> <?= printFormatedDateTime($requestDetails->pick_up_datetime); ?>   
                            </div>
                            </div>
        <div class="col-12 col-lg-12">
             <label>Any other specific instructions:</label>
            <?= $requestDetails->shipping_instruction?$requestDetails->shipping_instruction:'NA' ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-lg-12">
    <div class="edibx1">
        <label>Any Special Consideration for LCL:</label>
         <div class="input-comment">
            <?= $requestDetails->special_consideration_lcl; ?>
         </div>    
    </div>
    </div>
</div>

<h3><b>Material Detail</b></h3>
 <div class="multi-container hideLCL" style="<?= $requestDetails->shipment_id=='2'?'display:none;':''; ?>">
<?php if(!empty($requestDetails->container)){ ?>
<table class="table">
    <thead>
        <tr>
            <th>Container</th>
            <th>Size</th>
            <th>Container Type</th>
            <th>Qty</th>
            <th>G.W.(Kg)</th>
            <th>Packing</th>
            <th>HSN Code</th>
            <th>Material Type</th>
            <th>Description</th>
            <th>Remark</th>
        </tr>
    </thead>
    <tbody>
<?php $totalContainers = 0;
    foreach ($requestDetails->container as $key=>$row){
        $totalContainers +=$row->number_of_container;
    $sumGrossWeight += $row->gross_weight;?>

        <tr>
            <td>Container <?=$key+1?>
            <input type="hidden" name="items[<?=$key?>][item_id]" value="<?=$row->id;?>">
            <input type="hidden" name="items[<?=$key?>][item_type]" value="container">
            </td>
            <td><?=$row->container_size_title?$row->container_size_title:'- -'?></td>
            <td><?=$row->container_type_name?$row->container_type_name:'- -'?></td>
            <td><?=$row->number_of_container?$row->number_of_container:'- -'?></td>
            <td><?=$row->gross_weight?$row->gross_weight:'- -'?></td>
            <td><?=$row->type_of_packing_name?$row->type_of_packing_name:'- -'?></td>
            <td><?=$row->hs_code?$row->hs_code:'- -'?></td>
            <td><?=$row->material_type?$row->material_type:'- -'?></td>
            <td><?=$row->material_description?$row->material_description:'- -'?></td>
            <td><?=$row->remarks?$row->remarks:'- -'?></td>
        </tr>

<?php }?>
         <?php if(!empty($requestDetails->container)){?>
        <tr><td colspan="3" class="text-left">Summary</td>
            <td><?=$totalContainers?></td>
            <td><?=$sumGrossWeight?></td>
            <td colspan="5"></td>
        </tr>
        <?php }?>
         </tbody>
</table>
<?php }?>

</div>


<div class="multi-packaging hideFCL" style="<?= $requestDetails->shipment_id=='1'||empty($requestDetails->shipment_id)?'display:none;':''; ?>">
<?php  if(!empty($requestDetails->package)){ ?>
<table class="table">
    <thead>
        <tr>
            <th>Package</th>
            <th>Material Type</th>
            <th>Description</th>
            <th>HSN Code</th>
            <th>Packing</th>
            <th>Remark</th>
            <th>L x W x H (Cm)</th>
            <th>Volume(CBM)</th>
            <th>Volumetric Weight(Kg)</th>
            <th>N.W.(Kg)</th>
            <th>G.W.(Kg)</th>
        </tr>
    </thead>
    <tbody>
<?php  $sumVolume = 0;$sumNetWeight =0;$sumGrossWeight =0;
foreach ($requestDetails->package as $key=>$row){
    $sumVolume += $row->volume;
    $sumVolumetricWeight += $row->volumetric_weight;
    $sumNetWeight += $row->net_weight;
    $sumGrossWeight += $row->gross_weight;
    ?>
<tr>
            <td>Package <?=$key+1?>
            <input type="hidden" name="items[<?=$key?>][item_id]" value="<?=$row->id;?>">
            <input type="hidden" name="items[<?=$key?>][item_type]" value="container">
            </td>
            <td><?= $row->material_type?$row->material_type:'- -' ?></td>
            <td><?= $row->material_description?$row->material_description:'- -' ?></td>
            <td><?= $row->hs_code?$row->hs_code:'- -' ?></td>
            <td><?= $row->type_of_packing_name?$row->type_of_packing_name:'- -' ?></td>
            <td><?= $row->remarks?$row->remarks:'- -' ?></td>
            <td><?= $row->length.' x '.$row->width.' x '.$row->height; ?></td>
            <td><?= $row->volume; ?></td>
            <td><?= $row->volumetric_weight; ?></td>
            <td><?= $row->net_weight; ?></td>
            <td><?= $row->gross_weight; ?></td>
</tr>
<?php }?>

<?php if(!empty($requestDetails->package)) {?>
<tr class="font-weight-bold">
    <td class="text-left" colspan="7">Summary:</td>
    <td><?=$sumVolume?></td>
    <td><?=$sumVolumetricWeight?></td>
    <td><?=$sumNetWeight?></td>
    <td><?=$sumGrossWeight?></td>
</tr>
 <?php }?>
</tbody>
</table>
<?php }?>

</div>

    
</div>