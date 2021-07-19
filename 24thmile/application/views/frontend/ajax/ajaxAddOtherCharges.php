<?php $uniqueRowKey = uniqid(); ?>
<tr class="otherCharges-row">
    <td class="otherCharges-counter"></td>
<input type="hidden" name="rfc_charges_other[<?=$uniqueRowKey?>][id]" value="<?=$other->id?>">
<input type="hidden" name="rfc_charges_other[<?=$uniqueRowKey?>][category_id]" value="<?=$other->category_id?>">
    <td><input  style="width: 100%" type="text" name="rfc_charges_other[<?=$uniqueRowKey?>][title]" value="<?=$other->title?>"></td>
    <td><input  class="text-right rfc-charges-value  decimal-numbers " type="text" name="rfc_charges_other[<?=$uniqueRowKey?>][rfc_charge]" value="<?=$other->charges?>"></td>
    <td>
        <select name="rfc_charges_other[<?=$uniqueRowKey?>][unit]" class="form-control">
            <?php foreach ($arr_unit as $unit){?>
            <option value="<?=$unit?>" <?=$other->unit==$unit?'selected':''?> >Per <?=$unit?></option>
            <?php }?>
           
        </select>
        <!--<input  class="form-control decimal-numbers varai-charge" type="text" name="billingItems[<?=$uniqueRowKey?>][varai_charge]" value="<?=$particular->unit?>">-->
    </td>
    <!--<td><input  class="form-control decimal-numbers detention-charge" type="text" name="billingItems[<?=$uniqueRowKey?>][detention_charge]" value="<?=$particular->detention_charge?>"></td>-->
    <td><input  class="qty decimal-numbers otherCharges-qty" type="text" name="rfc_charges_other[<?=$uniqueRowKey?>][qty]" min="1"  value="<?=$other->qty?$other->qty:1?>"></td>
    <td class="text-right"><input  class="input-field text-right  total  decimal-numbers " type="text" name="rfc_charges_other[<?=$uniqueRowKey?>][total]" readonly="" value="<?=$other->total?>"> </td>
    <td class="text-right <?= $other->counter_rate!=$other->total?' text-danger ':''?>"><?=$other->counter_rate?></td>
    <td><span class="fa fa-close fa-lg remove-item" style="cursor: pointer;" title="Remove"></span></td>
</tr>