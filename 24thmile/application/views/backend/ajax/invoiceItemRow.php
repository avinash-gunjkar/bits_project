<tr class="item-row <?=$invoice_id?' proforma-'.$invoice_id.' ':''?>">
    <?php $counter = uniqid();?>
    <td class="item-counter"></td>
    <td style="width:150px;">
        <input type="hidden" name="billingItems[<?=$counter?>][item_id]" value="<?=$item->id?>" />
        <input type="text" name="billingItems[<?=$counter?>][name]" required="" aria-required="true" class="validate" id="billingItems_name_<?=$counter?>" value="<?=$item->particular?>" style="width:400px;" maxlength="100"/>
    </td>

    <td>
        <input type="text" name="billingItems[<?=$counter?>][amount]" required="" aria-required="true" class="validate amount required_field" id="billingItems_amount_<?=$counter?>" value="<?=$item->amount?>" style="width:100px;" maxlength="10"
         oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" onchange="calculateTax();"/>
    </td>
    
    <td><span class="mdi-content-clear remove-item" style="cursor: pointer;" title="Remove"></span></td>
</tr>