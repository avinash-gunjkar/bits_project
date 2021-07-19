<div class="form-group list-package-item ">
    <div class="package-header">
        <span class="fa fa-close fa-lg remove-package" style="position: absolute;right: 10px;cursor: pointer;" title="Remove"></span>
        <strong class="package-counter"></strong>
    </div>
<div style="padding: 10px;">
    <input type="hidden" name="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][item_id]" value="<?= $item_details->id; ?>">
    <input type="hidden" name="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][item_type]" value="package">
    <input type="hidden" name="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][parent_id]" value="<?= $item_details->parent_id; ?>">
    <div class="row">
        <div class="col-12 col-lg-1 mb-3">
            <label>HSN Code <sup>* </sup></label>
            <div class="input-comment">
                <input type="text" class="form-control requiredClass only-numbers" name="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][hs_code]" value="<?= $item_details->hs_code; ?>" maxlength="8" />

            </div>
        </div>

        <div class="col-12 col-lg-2 mb-3">
            <label>Packing Type <sup>* </sup></label>
            <div class="input-comment">
                <select name="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][type_of_packing]" class="custom-select requiredClass">
                    <option value="">Select</option>
                    <?php foreach ($packingList as $packing) { ?>
                        <option value="<?= $packing['id'] ?>" <?= $item_details->type_of_packing == $packing['id'] ? 'selected' : ''; ?>><?= $packing['type'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="col-12 col-lg-2 mb-3">
            <label>Package Qty <sup>* </sup></label>
            <div class="input-group mb-3">
                <input type="number" class="form-control qty decimal-numbers requiredClass"  name="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][number_of_container]"  value="<?= $item_details->number_of_container ? $item_details->number_of_container : '1'; ?>" min="1" aria-describedby="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][number_of_container]-error" />
                <div class="input-group-append">
                    <select name="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][unit]" class="custom-select" >
                    <?php foreach(getPackingUnitList() as $unitCode=>$unitValue){?>
                        <option value="<?=$unitCode?>" <?= $item_details->unit == $unitCode ? 'selected' : ''; ?> ><?=$unitValue?></option>
                        <?php }?>
                    </select>
                </div>
               
            </div>
            <span id="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][number_of_container]-error" class="error"></span>
        </div>


        <div class="col-12 col-lg-3 converter-target-div">
            <div class="input-group">
                <label>L x W x H</label>
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control length decimal-numbers requiredClass" placeholder="L" name="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][length]" value="<?= $item_details->length; ?>" aria-describedby="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][length]-error" />
                <input type="text" class="form-control width decimal-numbers requiredClass" placeholder="W" name="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][width]" value="<?= $item_details->width; ?>" aria-describedby="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][length]-error" />
                <input type="text" class="form-control height decimal-numbers requiredClass" placeholder="H" name="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][height]" value="<?= $item_details->height; ?>" aria-describedby="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][length]-error" />

                <div class="input-group-append">
                    <input type="hidden" value="Cm" name="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][length_uom]" />
                    <span class="input-group-text">Cm</span>
                </div>
                <input type="hidden" value="Cm" name="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][width_uom]" />
                <input type="hidden" value="Cm" name="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][height_uom]" />
            </div>
            <span id="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][length]-error" class="error"></span>
        </div>
        <div class="col-12 col-lg-2">
            <label>Volume</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control volume" placeholder="V" readonly="" name="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][volume]" value="<?= $item_details->volume; ?>" />
                <div class="input-group-append">
                    <input type="hidden" value="Cbm" name="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][volume_uom]" />
                    <span class="input-group-text">CBM</span>
                </div>

            </div>
        </div>
        <div class="col-12 col-lg-2">
            <label>Volumetric Weight</label> <span class="fa fa-question " style="cursor: pointer" title="Determine the volumetric weight:Divide the cubic size* of the package by 5,000 (in cm) / 305 (ininch) todetermine the volumetric weight in kilograms. Increase fractions of aweight to the next full kilogram.  Multiple-piece shipment volumetricweight is the sum of all volumetric weight of all packages within theshipment."></span>
            <div class="input-group mb-3">
                <input type="text" class="form-control volumetric-weight" placeholder="VW" readonly="" name="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][volumetric_weight]" value="<?= $item_details->volumetric_weight; ?>" />
                <div class="input-group-append">
                    <input type="hidden" value="Kg" name="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][volume_uom]" />
                    <span class="input-group-text">Kg</span>
                </div>

            </div>
        </div>
        <div class="col-12 col-lg-2">
            <label>Net Weight per Package<sup>* </sup></label>
            <div class="input-group mb-3">
                <input type="text" class="form-control net-weight decimal-numbers requiredClass" name="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][net_weight]" value="<?= $item_details->net_weight; ?>" aria-describedby="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][net_weight]-error" />
                <div class="input-group-append">
                    <span class="input-group-text">Kg</span>
                    <input type="hidden" name="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][net_weight_uom]" value="KG" />
                </div>
            </div>
            <span id="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][net_weight]-error" class="error"></span>
        </div>
        <div class="col-12 col-lg-2">
            <label>Gross Weight per Package<sup>* </sup></label>
            <div class="input-group mb-3">
                <input type="text" class="form-control gross-weight decimal-numbers requiredClass" name="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][gross_weight]" value="<?= $item_details->gross_weight; ?>" aria-describedby="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][gross_weight]-error" />
                <div class="input-group-append">
                    <span class="input-group-text">Kg</span>
                    <input type="hidden" name="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][gross_weight_uom]" value="KG" />
                </div>
            </div>
            <span id="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][gross_weight]-error" class="error"></span>
        </div>

        <div class="col-12 col-lg-1 mb-3">
            <label>Unit Qty </label>
            <div class="input-comment">
                <input class="form-control decimal-numbers" maxlength="8" name="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][unit_qty]" value="<?= $item_details->unit_qty; ?>" />
                <!--<textarea class="form-control" name="package[<?= $packageCounter ?>][material_description]"><?= $item_details->material_description; ?></textarea>-->
            </div>
        </div>

        <!-- <div class="col-12 col-lg-4 mb-3">
            <label>Material Description </label>
            <div class="input-comment">
                <input class="form-control" name="package[<?= $packageCounter ?>][material_description]" value="<?= $item_details->material_description; ?>" />
                <textarea class="form-control" name="package[<?= $packageCounter ?>][material_description]"><?= $item_details->material_description; ?></textarea>

            </div>
        </div> -->

        <div class="col-12 col-lg-2 mb-3">
            <label class='order-number'><?= strcasecmp($transaction,'Import')==0?'PO# Number':'SO# Number'?></label>
            <div class="input-group mb-3">
                <input type="text" class="form-control"  name="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][so_number]"  value="<?= $item_details->so_number; ?>" min="1" aria-describedby="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][so_number]-error" />
            </div>
            <span id="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][so_number]-error" class="error"></span>
        </div>
        <div class="col-12 col-lg-2 mb-3">
            <label class="order-line-item"><?= strcasecmp($transaction,'Import')==0?'PO# Line Item':'SO# Line Item'?></label>
            <div class="input-group mb-3">
                <input type="text" class="form-control"  name="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][so_line_item]"  value="<?= $item_details->so_line_item; ?>" min="1" aria-describedby="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][so_line_item]-error" />
            </div>
            <span id="container[<?= $containerCounter ?>][package][<?= $packageCounter ?>][so_line_item]-error" class="error"></span>
        </div>
    </div>
</div>
</div>