<tr class="list-container-item container_<?= $containerCounter ?>">
<td>
<div class="container-header">
        <span class="fa fa-close fa-lg remove" style="cursor: pointer;" title="Remove"></span>
        <strong class="container-counter"></strong>
</div>
    </td>
    <td>
        <input type="hidden" name="route[<?= $containerCounter ?>][id]" value="<?= $item_details->id; ?>">
        <input type="text" name="route[<?= $containerCounter ?>][loading_place]" value="<?= $item_details->loading_place; ?>">
    </td>
    <td>
        <input type="text" name="route[<?= $containerCounter ?>][loading_country]" value="<?= $item_details->loading_country; ?>">

    </td>
    <td>
        <input type="text" name="route[<?= $containerCounter ?>][port_loading_name]" value="<?= $item_details->port_loading_name; ?>">

    </td>
    <td>
        <input type="text" name="route[<?= $containerCounter ?>][discharge_place]" value="<?= $item_details->discharge_place; ?>">

    </td>
    <td>
        <input type="text" name="route[<?= $containerCounter ?>][discharge_country]" value="<?= $item_details->discharge_country; ?>">

    </td>
    <td>
        <input type="text" name="route[<?= $containerCounter ?>][port_discharge_name]" value="<?= $item_details->port_discharge_name; ?>">

    </td>
    <td>
        <!-- <input type="text" name="route[<?= $containerCounter ?>][mode]" value="<?= $item_details->mode; ?>"> -->
    <select name="route[<?= $containerCounter ?>][mode_id]" >
    <option value="">Select</option>
    <?php foreach($modeList as $mode){
        $selected = $mode['id']==$item_details->mode_id?' selected ':'';
        $modeId = $mode['id'];
        $modeType = $mode['type'];
      echo "<option value='$modeId' $selected >$modeType</option>"; 
         }?>
    </select>
    </td>
    <td>
        <!-- <input type="text" name="route[<?= $containerCounter ?>][transaction]" value="<?= $item_details->transaction; ?>"> -->
        <select name="route[<?= $containerCounter ?>][transaction]" >
    <option value="">Select</option>
    <?php foreach($transactionList as $transaction){
        $selected = strcasecmp($transaction,$item_details->transaction)==0?' selected ':'';
      echo "<option value='$transaction' $selected >$transaction</option>"; 
         }?>
    </select>
    </td>
    <td>
        <!-- <input type="text" name="route[<?= $containerCounter ?>][container_stuffing]" value="<?= $item_details->container_stuffing; ?>"> -->
        <select name="route[<?= $containerCounter ?>][container_stuffing]" >
    <option value="">Select</option>
    <?php foreach($cargoTypeList as $cargoType){
        $selected = strcasecmp($cargoType,$item_details->container_stuffing)==0?' selected ':'';
      echo "<option value='$cargoType' $selected >$cargoType</option>"; 
         }?>
    </select>
    </td>
    <td>
        <!-- <input type="text" name="route[<?= $containerCounter ?>][cargo_status]" value="<?= $item_details->porcargo_status_discharge_name; ?>"> -->
        <select name="route[<?= $containerCounter ?>][cargo_status]" >
    <option value="">Select</option>
    <?php foreach($cargoNatureList as $cargoNature){
        $selected = strcasecmp($cargoNature,$item_details->cargo_status)==0?' selected ':'';
      echo "<option value='$cargoNature' $selected >$cargoNature</option>"; 
         }?>
    </select>
    </td>
    <td>
        <!-- <input type="text" name="route[<?= $containerCounter ?>][shipment]" value="<?= $item_details->shipment; ?>"> -->
        <select name="route[<?= $containerCounter ?>][shipment_id]" >
    <option value="">Select</option>
    <?php foreach($shipmentList as $shipment){
        $shipmentId = $shipment['id'];
        $shipmentType = $shipment['type'];
        $selected = $shipmentId==$item_details->shipment_id?' selected ':'';
      echo "<option value='$shipmentId' $selected >$shipmentType</option>"; 
         }?>
    </select>
    </td>
    <td>
        <input type="text" name="route[<?= $containerCounter ?>][currency]" value="<?= $item_details->currency; ?>">

    </td>
    <td>
        <input type="text" name="route[<?= $containerCounter ?>][commodity]" value="<?= $item_details->commodity; ?>">

    </td>
    <td>
        <input type="text" name="route[<?= $containerCounter ?>][container_type]" value="<?= $item_details->container_type; ?>">

    </td>
    <td>
        <input type="text" name="route[<?= $containerCounter ?>][volume_per_annum]" value="<?= $item_details->volume_per_annum; ?>">

    </td>
    <td>
        <input type="text" name="route[<?= $containerCounter ?>][tentative_gross_wt]" value="<?= $item_details->tentative_gross_wt; ?>">

    </td>
   
</tr>