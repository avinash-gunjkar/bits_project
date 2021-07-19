<div class="multi-container hideLCL" style="<?= $requestDetails->shipment_id == '2' ? 'display:none;' : ''; ?>">
    <h3 class="hideLCL"><b>Material Detail</b></h3>
    <?php if (!empty($requestDetails->container)) { ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Size</th>
                    <th>Container Type</th>
                    <th>HSN Code</th>
                    <th>Packing</th>
                    <th>Container Qty</th>
                    <th>G.W.(Kg)</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php $totalContainers = 0;
                // vdebug($requestDetails->container);
                foreach ($requestDetails->container as $key => $row) {
                    $totalContainers += $row->number_of_container;
                    $sumGrossWeight_container += ($row->gross_weight * $row->number_of_container); 
                    $arrContainerType[$row->id] = $row->container_size_title . ' ' . $row->container_type_name;
                    ?>

                    <tr>
                        <td><?= $key + 1 ?>
                            <input type="hidden" name="items[<?= $key ?>][item_id]" value="<?= $row->id; ?>">
                            <input type="hidden" name="items[<?= $key ?>][item_type]" value="container">
                        </td>
                        <td>
                            <?= $row->container_size_title ? $row->container_size_title : '- -' ?>
                            <?php if ($row->package) { ?>
                                <a href="javascript:void(0);" onclick="$('#modal_<?= $key ?>').modal('show')" class="fa fa-cubes text-primary" title="Packing List"></a>
                                <div class="modal fade" id="modal_<?= $key ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg mw-100 w-75" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><?= $row->container_size_title ?> Packing List</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <?php if (!empty($row->package)) { ?>
                                                    <table class="table table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>Sr. No.</th>
                                                                <!--<th>Material Type</th>-->
                                                                <th>HSN Code</th>
                                                                <th>Packing</th>
                                                                <th>Qty</th>
                                                                <!-- <th>Remark</th> -->
                                                                <th>L x W x H (Cm)</th>
                                                                <th>Volume(CBM)</th>
                                                                <th>Volumetric Weight(Kg)</th>
                                                                <th>N.W.(Kg)</th>
                                                                <th>G.W.(Kg)</th>
                                                                <th>Description</th>
                                                                <th><?=strcasecmp($requestDetails->transaction,'Import')==0?'PO# Number':'SO# Number'?></th>
                                                                <th><?=strcasecmp($requestDetails->transaction,'Import')==0?'PO# Line Item':'SO# Line Item'?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $sumVolume = 0;
                                                            $sumNetWeight = 0;
                                                            $sumGrossWeight = 0;
                                                            $sumVolumetricWeight = 0;
                                                            foreach ($row->package as $key2 => $row2) {
                                                                $sumVolume += ($row2->volume * $row2->number_of_container);
                                                                $sumVolumetricWeight += ($row2->volumetric_weight * $row2->number_of_container);
                                                                $sumNetWeight += ($row2->net_weight * $row2->number_of_container);
                                                                $sumGrossWeight += ($row2->gross_weight * $row2->number_of_container);
                                                            ?>
                                                                <tr>
                                                                    <td><?= $key2 + 1 ?>
                                                                        <input type="hidden" name="items[<?= $key2 ?>][item_id]" value="<?= $row2->id; ?>">
                                                                        <input type="hidden" name="items[<?= $key2 ?>][item_type]" value="package">
                                                                    </td>
                                                                    <td><?= $row2->hs_code ? $row2->hs_code : '- -' ?></td>
                                                                    <td><?= $row2->type_of_packing_name ? $row2->type_of_packing_name : '- -' ?></td>
                                                                    <td><?= $row2->number_of_container . " $row2->unit"; ?></td>
                                                                    <td><?= $row2->length . ' x ' . $row2->width . ' x ' . $row2->height; ?></td>
                                                                    <td><?= $row2->volume; ?></td>
                                                                    <td><?= $row2->volumetric_weight; ?></td>
                                                                    <td><?= $row2->net_weight; ?></td>
                                                                    <td><?= $row2->gross_weight; ?></td>
                                                                    <td><?= $row2->material_description ? $row2->material_description : '- -' ?></td>
                                                                    <td><?= $row2->so_number; ?></td>
                                                                    <td><?= $row2->so_line_item; ?></td>
                                                                </tr>
                                                            <?php } ?>

                                                            <?php if (!empty($requestDetails->package)) { ?>
                                                                <tr class="font-weight-bold">
                                                                    <td class="text-left" colspan="5">Summary:</td>
                                                                    <td><?= number_format($sumVolume, 3, '.', '') ?></td>
                                                                    <td><?= number_format($sumVolumetricWeight) ?></td>
                                                                    <td><?= number_format($sumNetWeight) ?></td>
                                                                    <td><?= number_format($sumGrossWeight) ?></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                <?php } ?>
                                            </div>
                                            <div class="modal-footer">

                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </td>
                        <td><?= $row->container_type_name ? $row->container_type_name . " ($row->containerDesc)" : '- -' ?></td>
                        <td><?= $row->hs_code ? $row->hs_code : '- -' ?></td>
                        <td><?= $row->type_of_packing_name ? $row->type_of_packing_name : '- -' ?></td>
                        <td><?= $row->number_of_container ? $row->number_of_container . " $row->unit" : '- -' ?></td>
                        <td><?= $row->gross_weight ? $row->gross_weight : '- -' ?></td>
                        <td><?= $row->material_description ? $row->material_description : '- -' ?></td>
                    </tr>

                <?php } ?>
                <?php if (!empty($requestDetails->container)) { ?>
                    <tr>
                        <td colspan="5" class="text-left">Summary</td>
                        <td><?= $totalContainers ?></td>
                        <td><?= $sumGrossWeight_container ?></td>
                        <td></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>

</div>