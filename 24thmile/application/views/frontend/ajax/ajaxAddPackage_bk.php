<tr>
    <td><strong class="package-counter"></strong></td>
    <td>
        <input type="hidden" name="package[<?= $packageCounter ?>][item_id]" value="<?= $item_details->id; ?>">
        <input type="hidden" name="package[<?= $packageCounter ?>][item_type]" value="package">
        <input type="text" class="form-control requiredClass only-numbers" name="package[<?= $packageCounter ?>][hs_code]" value="<?= $item_details->hs_code; ?>" maxlength="8" />
    </td>
    <td>
        <select name="package[<?= $packageCounter ?>][type_of_packing]" class="custom-select requiredClass">
            <option value="">Select</option>
            <?php foreach ($packingList as $packing) { ?>
                <option value="<?= $packing['id'] ?>" <?= $item_details->type_of_packing == $packing['id'] ? 'selected' : ''; ?>><?= $packing['type'] ?></option>
            <?php } ?>
        </select>
    </td>
    <td>
        <div class="input-group mb-3">
            <input type="number" class="form-control decimal-numbers requiredClass" name="package[<?= $packageCounter ?>][number_of_container]" value="<?= $item_details->number_of_container ? $item_details->number_of_container : '1'; ?>" min="1" aria-describedby="package[<?= $packageCounter ?>][number_of_container]-error" />
            <div class="input-group-append">
                <select name="package[<?= $packageCounter ?>][unit]" class="custom-select">
                    <?php foreach (getPackingUnitList() as $unitCode => $unitValue) { ?>
                        <option value="<?= $unitCode ?>" <?= $item_details->unit == $unitCode ? 'selected' : ''; ?>><?= $unitValue ?></option>
                    <?php } ?>
                </select>
            </div>

        </div>
        <span id="package[<?= $packageCounter ?>][number_of_container]-error" class="error"></span>
    </td>
    <td>
        <input type="text" class="form-control length decimal-numbers requiredClass" placeholder="L" name="package[<?= $packageCounter ?>][length]" value="<?= $item_details->length; ?>" aria-describedby="package[<?= $packageCounter ?>][length]-error" />
        <input type="text" class="form-control width decimal-numbers requiredClass" placeholder="W" name="package[<?= $packageCounter ?>][width]" value="<?= $item_details->width; ?>" aria-describedby="package[<?= $packageCounter ?>][length]-error" />
        <input type="text" class="form-control height decimal-numbers requiredClass" placeholder="H" name="package[<?= $packageCounter ?>][height]" value="<?= $item_details->height; ?>" aria-describedby="package[<?= $packageCounter ?>][length]-error" />
        <input type="hidden" value="Cm" name="package[<?= $packageCounter ?>][length_uom]" />
        <input type="hidden" value="Cm" name="package[<?= $packageCounter ?>][width_uom]" />
        <input type="hidden" value="Cm" name="package[<?= $packageCounter ?>][height_uom]" />
        
        <span id="package[<?= $packageCounter ?>][length]-error" class="error"></span>
    </td>
    <td>
        <input type="text" class="form-control volume" placeholder="V" readonly="" name="package[<?= $packageCounter ?>][volume]" value="<?= $item_details->volume; ?>" />
        <input type="hidden" value="Cbm" name="package[<?= $packageCounter ?>][volume_uom]" />
        
    </td>
    <td>
        <input type="text" class="form-control volumetric-weight" placeholder="VW" readonly="" name="package[<?= $packageCounter ?>][volumetric_weight]" value="<?= $item_details->volumetric_weight; ?>" />
        <input type="hidden" value="Kg" name="package[<?= $packageCounter ?>][volume_uom]" />
                
    </td>
    <td>
        
        <input type="text" class="form-control decimal-numbers requiredClass" name="package[<?= $packageCounter ?>][net_weight]" value="<?= $item_details->net_weight; ?>" aria-describedby="package[<?= $packageCounter ?>][net_weight]-error" />
        <input type="hidden" name="package[<?= $packageCounter ?>][net_weight_uom]" value="KG" />
        <span id="package[<?= $packageCounter ?>][net_weight]-error" class="error"></span>
    </td>
    <td>
        <input type="text" class="form-control decimal-numbers requiredClass" name="package[<?= $packageCounter ?>][gross_weight]" value="<?= $item_details->gross_weight; ?>" aria-describedby="package[<?= $packageCounter ?>][gross_weight]-error" />
        <input type="hidden" name="package[<?= $packageCounter ?>][gross_weight_uom]" value="KG" />
        <span id="package[<?= $packageCounter ?>][gross_weight]-error" class="error"></span>
    </td>
    <td>

        <input class="form-control" name="package[<?= $packageCounter ?>][material_description]" value="<?= $item_details->material_description; ?>" />
    </td>

    <td>
        <input type="number" class="form-control decimal-numbers" name="package[<?= $packageCounter ?>][so_number]" value="<?= $item_details->so_number; ?>" min="1" aria-describedby="package[<?= $packageCounter ?>][so_number]-error" />
    </td>
    <td>
        <input type="number" class="form-control decimal-numbers" name="package[<?= $packageCounter ?>][so_line_item]" value="<?= $item_details->so_line_item; ?>" min="1" aria-describedby="package[<?= $packageCounter ?>][so_line_item]-error" />

    </td>
    <td>
        <span class="fa fa-close fa-lg remove-item" style="cursor: pointer;" title="Remove"></span>
    </td>
</tr>