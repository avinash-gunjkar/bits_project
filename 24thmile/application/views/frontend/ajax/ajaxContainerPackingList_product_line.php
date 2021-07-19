<tr>
<td class="fixed-width-60"><input type="text" maxlength="30" class="form-control requiredClass" name="items[<?=$uuid1?>][products][<?=$uuid2?>][container_no]" value="<?= $item->container_no ?>" ></td>
    <td  class="fixed-width-60"><input type="text" maxlength="30" class="form-control requiredClass" name="items[<?=$uuid1?>][products][<?=$uuid2?>][seal_no]" value="<?= $item->seal_no ?>" ></td>
    <td  class="fixed-width-600"><input type="text" maxlength="50" class="form-control requiredClass" name="items[<?=$uuid1?>][products][<?=$uuid2?>][description]" value="<?= $item->description ?>"></td>
    <td  class="fixed-width-60"><input type="text" class="decimal-numbers qty form-control requiredClass" maxlength="12" name="items[<?=$uuid1?>][products][<?=$uuid2?>][qty]" placeholder="0.00" value="<?= number_format($item->qty,2,'.','') ?>"></td>
    <td  class="fixed-width-80">
        <select name="items[<?=$uuid1?>][products][<?=$uuid2?>][unit]" id="">
            <?php foreach (getPackingUnitList() as $unitCode => $unitValue) { ?>
                <option value="<?= $unitCode ?>" <?= $unitCode == $item->unit ? ' selected ' : '' ?>><?= $unitValue ?></option>
            <?php } ?>
        </select>
        <a class="btn delete-product-row-btn" title="Delete"><i class="fa fa-trash "></i></a>
    </td>
</tr>