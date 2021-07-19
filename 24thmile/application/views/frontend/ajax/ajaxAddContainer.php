<div class="form-group hideLCL list-container-item container_<?= $containerCounter ?>" style=" border: 1px solid #ccc;position: relative">
   
    <div class="container-header">
    
    <span class="fa fa-close fa-lg remove-container" style="position: absolute;right: 10px;cursor: pointer;" title="Remove"></span>
    <strong class="container-counter"></strong>
   
    </div>
   
    <div style="padding: 10px;">
    <input type="hidden" name="container[<?= $containerCounter ?>][item_id]" value="<?= $item_details->id; ?>">
    <input type="hidden" name="container[<?= $containerCounter ?>][item_type]" value="container">
    <div class="row">
        <div class="col-12 col-lg-1">
            <label>Size <sup>* </sup></label>
            <div class="input-comment">
                <select class="custom-select requiredClass " name="container[<?= $containerCounter ?>][container_size]">
                    <option value="">Select</option>
                    <?php foreach ($containerSizeList as $containerSizeSize) { ?>
                        <option value="<?= $containerSizeSize['id'] ?>" <?= $item_details->container_size == $containerSizeSize['id'] ? 'selected' : ''; ?>><?= $containerSizeSize['size'] ?></option>
                    <?php } ?>
                </select>

            </div>
        </div>
        <div class="col-12 col-lg-2">
            <label>Container Type <sup>* </sup></label>
            <div class="input-comment">
                <select name="container[<?= $containerCounter ?>][container_type]" class="custom-select requiredClass">
                    <option value="">Select</option>
                    <?php foreach ($container_types as $container_type) { ?>
                        <option value="<?php echo $container_type['id']; ?>" <?= $item_details->container_type == $container_type['id'] ? 'selected' : ''; ?>><?php echo $container_type['type'] . ' (' . $container_type['description'] . ')'; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-12 col-lg-2">
            <label>HSN Code<sup>*</sup></label>
            <div class="input-comment">
                <input type="text" class="form-control requiredClass" name="container[<?= $containerCounter ?>][hs_code]" value="<?= $item_details->hs_code; ?>" maxlength="8" />

            </div>
        </div>

        <div class="col-12 col-lg-1">
            <label>Packing <sup>* </sup></label>
            <div class="input-comment">
                <select class="custom-select requiredClass" name="container[<?= $containerCounter ?>][type_of_packing]">
                    <option value="">Select</option>
                    <?php foreach ($packingList as $packing) { ?>
                        <option value="<?= $packing['id'] ?>" <?= $item_details->type_of_packing == $packing['id'] ? 'selected' : ''; ?>><?= $packing['type'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="col-12 col-lg-2">
            <label>Container Qty <sup>* </sup></label>
            
            <div class="input-group mb-3">
            <input type="number" class="form-control only-numbers requiredClass" name="container[<?= $containerCounter ?>][number_of_container]" value="<?= $item_details->number_of_container ? $item_details->number_of_container : '1'; ?>" min="1" />
                <div class="input-group-append">
                    <select name="package[<?= $packageCounter ?>][unit]" class="custom-select" >
                        <option value="NUM" selected >Number</option>
                    </select>
                </div>
               
            </div>
        </div>
        
        

        <!--                                       <div class="col-12 col-lg-2">
                                                   <label>Material Type</label>
                                                     <div class="input-comment">
                                                         <input class="form-control" name="container[<?= $containerCounter ?>][material_type]" type="text" value="<?= $item_details->material_type; ?>"/>
                                                    </div>
                                           </div>-->

        <div class="col-12 col-lg-3">
            <label>Material Description</label>
            <div class="input-comment">
                <input class="form-control" name="container[<?= $containerCounter ?>][material_description]" value="<?= $item_details->material_description; ?>" />
                <!--<textarea class="form-control" name="container[<?= $containerCounter ?>][material_description]" style="height: 50px;"><?= $item_details->material_description; ?></textarea>-->
            </div>
        </div>

        <div class="col-12 col-lg-2">
            <label>Gross Weight <sup>* </sup></label>
            <div class="input-group mb-3">
                <input type="text" class="form-control decimal-numbers requiredClass" name="container[<?= $containerCounter ?>][gross_weight]" value="<?= $item_details->gross_weight; ?>" aria-describedby="container[<?= $containerCounter ?>][gross_weight]-error" />
                <div class="input-group-append">
                    <span class="input-group-text">Kg</span>
                    <input type="hidden" name="container[<?= $containerCounter ?>][gross_weight_uom]" value="Kg" />
                </div>
            </div>
            <span id="container[<?= $containerCounter ?>][gross_weight]-error" class="error"></span>
        </div>


        <div class="col-12 col-lg-2">
            <label>Remark</label>
            <div class="input-comment">
                <input type="text" class="form-control" name="container[<?= $containerCounter ?>][remarks]" value="<?= $item_details->remarks; ?>" />

            </div>
        </div>

    </div>
    <div class="row">
    <div class="col-12 col-lg-12 multi-packaging ">
        <strong>Packing List</strong>

         <div class=" fileUpload btn btn-secondary btn-sm">
            <span>Import from Excel File</span>
            <!-- <input type="file"   name="import_excel_packing_list" class="upload import_excel_packing_list"/> -->
            <input type="file" id="import_excel_packing_list_<?= $containerCounter ?>" data-containercounter="<?= $containerCounter ?>" name="import_excel_packing_list" class="upload import_excel_packing_list" />
        </div>
        <a href="<?= base_url('assets/frontend/excel-file-templates/package-list-template.xlsx') ?>" class=" btn btn-sm btn-success">Download Packing List Template</a>
        <a href="javascript:void(0);" class="pull-right text-primary add-container-package" data-containercounter="<?= $containerCounter ?>" ><i class="fa fa-plus"></i> Add Package</a>
        <?php if(!empty($item_details->package)){?>
        <?php foreach($item_details->package as $key2=>$item){
             $this->load->view('frontend/ajax/ajaxAddContainerPackage', ['packageCounter' => $key2 + 1,'containerCounter'=>$containerCounter, 'item_details' => $item, 'packingList' => $packingList]);
         }
         ?>
        <?php }?>
    </div>
    </div>
</div>
</div>