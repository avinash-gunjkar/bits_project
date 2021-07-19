<div class="multi-container hideLCL" style="<?= $requestDetails->shipment_id == '2' ? 'display:none;' : ''; ?>">
    <h4 class="header2"><b>Material Detail</b></h4>
                                            <?php if (!empty($requestDetails->container)) { ?>
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Sr. No.</th>
                                                            <th>Size</th>
                                                            <th>Container Type</th>
                                                            <th>HSN Code</th>
                                                            <th>Packing</th>
                                                            <th>Qty</th>
                                                            <th>G.W.(Kg)</th>
                                                            <th>Description</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $totalContainers = 0;
                                                        foreach ($requestDetails->container as $key => $row) {
                                                            $totalContainers += $row->number_of_container;
                                                            $sumGrossWeight += ($row->gross_weight * $row->number_of_container);
                                                            $arrContainerType[$row->id] = $row->container_size_title . ' ' . $row->container_type_name;
                                                            ?>

                                                            <tr>
                                                                <td><?= $key + 1 ?>
                                                                    <input type="hidden" name="items[<?= $key ?>][item_id]" value="<?= $row->id; ?>">
                                                                    <input type="hidden" name="items[<?= $key ?>][item_type]" value="container">
                                                                </td>
                                                                <td><?= $row->container_size_title ? $row->container_size_title : '- -' ?></td>
                                                                <td><?= $row->container_type_name ? $row->container_type_name . " ($row->containerDesc)" : '- -' ?></td>
                                                                <td><?= $row->hs_code ? $row->hs_code : '- -' ?></td>
                                                                <td><?= $row->type_of_packing_name ? $row->type_of_packing_name : '- -' ?></td>
                                                                <td><?= $row->number_of_container ? $row->number_of_container." $row->unit" : '- -' ?></td>
                                                                <td><?= $row->gross_weight ? $row->gross_weight : '- -' ?></td>
                                                                <td><?= $row->material_description ? $row->material_description : '- -' ?></td>
                                                            </tr>

                                                        <?php } ?>
                                                        <?php if (!empty($requestDetails->container)) { ?>
                                                            <tr>
                                                                <td colspan="5" class="text-left">Summary</td>
                                                                <td><?= $totalContainers ?></td>
                                                                <td><?= $sumGrossWeight ?></td>
                                                                <td ></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            <?php } ?>

                                        </div>