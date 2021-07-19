<tr>
<td><strong class="container-counter"></strong></td>
<td>
<input type="hidden" name="container[<?= $containerCounter ?>][item_id]" value="<?= $item_details->id; ?>">
    <input type="hidden" name="container[<?= $containerCounter ?>][item_type]" value="container">
    <select class="custom-select requiredClass " name="container[<?= $containerCounter ?>][container_size]">
                    <option value="">Select</option>
                    <?php foreach ($containerSizeList as $containerSizeSize) { ?>
                        <option value="<?= $containerSizeSize['id'] ?>" <?= $item_details->container_size == $containerSizeSize['id'] ? 'selected' : ''; ?>><?= $containerSizeSize['size'] ?></option>
                    <?php } ?>
                </select>
</td>
<td>
<select name="container[<?= $containerCounter ?>][container_type]" class="custom-select requiredClass">
                    <option value="">Select</option>
                    <?php foreach ($container_types as $container_type) { ?>
                        <option value="<?php echo $container_type['id']; ?>" <?= $item_details->container_type == $container_type['id'] ? 'selected' : ''; ?>><?php echo $container_type['type'] . ' (' . $container_type['description'] . ')'; ?></option>
                    <?php } ?>
                </select>
</td>
<td>
<input type="text" class="form-control requiredClass" name="container[<?= $containerCounter ?>][hs_code]" value="<?= $item_details->hs_code; ?>" maxlength="8" />
</td>
<td>
<select class="custom-select requiredClass" name="container[<?= $containerCounter ?>][type_of_packing]">
                    <option value="">Select</option>
                    <?php foreach ($packingList as $packing) { ?>
                        <option value="<?= $packing['id'] ?>" <?= $item_details->type_of_packing == $packing['id'] ? 'selected' : ''; ?>><?= $packing['type'] ?></option>
                    <?php } ?>
                </select>
</td>
<td>
<div class="input-group mb-3">
            <input type="number" class="form-control only-numbers requiredClass" name="container[<?= $containerCounter ?>][number_of_container]" value="<?= $item_details->number_of_container ? $item_details->number_of_container : '1'; ?>" min="1" />
                <div class="input-group-append">
                    <select name="package[<?= $packageCounter ?>][unit]" class="custom-select" >
                    <?php foreach(getPackingUnitList() as $unitCode=>$unitValue){?>
                        <option value="<?=$unitCode?>" <?= $item_details->unit == $unitCode ? 'selected' : ''; ?>><?=$unitValue?></option>
                        <?php }?>
                    </select>
                </div>
               
            </div>
</td>
<td>
<input class="form-control" name="container[<?= $containerCounter ?>][material_description]" value="<?= $item_details->material_description; ?>" />
</td>
<td>
    <input type="text" class="form-control decimal-numbers requiredClass" name="container[<?= $containerCounter ?>][gross_weight]" value="<?= $item_details->gross_weight; ?>" aria-describedby="container[<?= $containerCounter ?>][gross_weight]-error" />
    <input type="hidden" name="container[<?= $containerCounter ?>][gross_weight_uom]" value="Kg" />
</td>
<td>
<input type="text" class="form-control" name="container[<?= $containerCounter ?>][remarks]" value="<?= $item_details->remarks; ?>" />
</td>
<td>
<span class="fa fa-close fa-lg remove-item" style="cursor: pointer;" title="Remove"></span>
</td>

</tr>