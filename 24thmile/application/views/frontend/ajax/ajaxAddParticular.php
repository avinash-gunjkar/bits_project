<tr class="particular-row">
    <td class="particular-counter"></td>
    <td><input  class="form-control" type="text" name="billingItems[<?=$particularCounter?>][vehicle]" value="<?=$particular->vehicle?>"></td>
    <td><input  class="form-control decimal-numbers transport-charge" type="text" name="billingItems[<?=$particularCounter?>][transport_charge]" value="<?=$particular->transport_charge?>"></td>
    <td><input  class="form-control decimal-numbers varai-charge" type="text" name="billingItems[<?=$particularCounter?>][varai_charge]" value="<?=$particular->varai_charge?>"></td>
    <td><input  class="form-control decimal-numbers detention-charge" type="text" name="billingItems[<?=$particularCounter?>][detention_charge]" value="<?=$particular->detention_charge?>"></td>
    <td><input  class="form-control only-numbers qty" type="number" name="billingItems[<?=$particularCounter?>][qty]" min="1"  value="<?=$particular->qty?>"></td>
    <td><input  class="form-control cost" type="text" name="billingItems[<?=$particularCounter?>][cost]" readonly="" value="<?=$particular->cost?>"> </td>
    <td><span class="fa fa-close fa-lg remove-item" style="cursor: pointer;" title="Remove"></span></td>
</tr>