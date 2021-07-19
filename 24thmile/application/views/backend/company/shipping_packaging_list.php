<div class="multi-packaging hideFCL" style="<?= $requestDetails->shipment_id == '1' || empty($requestDetails->shipment_id) ? 'display:none;' : ''; ?>">
<h4 class="header2"><b>Packing list</b></h4>
<div class="multi-packaging ">
    <?php if (!empty($requestDetails->package)) { ?>
        <table class="table">
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
                    <th>SO# Number</th>
                    <th>SO# Line Item</th>
                </tr>
            </thead>
            <tbody>
                <?php $sumVolume = 0;
                $sumNetWeight = 0;
                $sumGrossWeight = 0;
                $totalOfMaxWeight = 0;
                foreach ($requestDetails->package as $key => $row) {
                    $sumVolume += ($row->volume * $row->number_of_container);
                    $sumVolumetricWeight += ($row->volumetric_weight * $row->number_of_container);
                    $sumNetWeight += ($row->net_weight * $row->number_of_container);
                    $sumGrossWeight += ($row->gross_weight * $row->number_of_container);
                    $totalOfMaxWeight += max([$row->volumetric_weight, $row->gross_weight]) * $row->number_of_container;
                ?>
                    <tr>
                        <td><?= $key + 1 ?>
                            <input type="hidden" name="items[<?= $key ?>][item_id]" value="<?= $row->id; ?>">
                            <input type="hidden" name="items[<?= $key ?>][item_type]" value="package">
                        </td>
                        <td><?= $row->hs_code ? $row->hs_code : '- -' ?></td>
                        <td><?= $row->type_of_packing_name ? $row->type_of_packing_name : '- -' ?></td>
                        <td><?= $row->number_of_container . " $row->unit"; ?></td>
                        <td><?= $row->length . ' x ' . $row->width . ' x ' . $row->height; ?></td>
                        <td><?= $row->volume; ?></td>
                        <td><?= $row->volumetric_weight; ?></td>
                        <td><?= $row->net_weight; ?></td>
                        <td><?= $row->gross_weight; ?></td>
                        <td><?= $row->material_description ? $row->material_description : '- -' ?></td>
                        <td><?= $row->so_number; ?></td>
                        <td><?= $row->so_line_item; ?></td>
                    </tr>
                <?php } ?>

                <?php if (!empty($requestDetails->package)) { ?>
                    <tr class="font-weight-bold">
                        <td class="text-left" colspan="5">Summary:</td>
                        <td><?= number_format($sumVolume,1,'.','') ?></td>
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
    <?php }else{?>

        
<center>
        <span style="color: #9e9e9e;">Packing list is Empty.</span>
</center>
<?php } ?>
</div>
</div>