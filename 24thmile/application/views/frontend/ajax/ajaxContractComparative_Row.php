<tr class="list-container-item container_<?= $containerCounter ?>">
    <td class="sr-no <?= $changeBorderClass ?>">

    </td>
    <td class="<?= $changeBorderClass ?>">
        <input type="hidden" name="route[<?= $containerCounter ?>][id]" value="<?= $item_details->id; ?>">
        <?= $item_details->loading_place; ?>
    </td>
    <td class="<?= $changeBorderClass ?>">
        <?= $item_details->loading_country; ?>

    </td>
    <td class="<?= $changeBorderClass ?>">
        <?= $item_details->port_loading_name; ?>
    </td>
    <td class="<?= $changeBorderClass ?>">
        <?= $item_details->discharge_place; ?>
    </td>
    <td class="<?= $changeBorderClass ?>">
        <?= $item_details->discharge_country; ?>
    </td>
    <td class="<?= $changeBorderClass ?>">
        <?= $item_details->port_discharge_name; ?>

    </td>
    <td class="<?= $changeBorderClass ?>">
        <?= $item_details->mode; ?>
    </td>
    <td class="<?= $changeBorderClass ?>">
        <?= $item_details->transaction; ?>
    </td>
    <td class="<?= $changeBorderClass ?>">
        <?= $item_details->container_stuffing; ?>
    </td>
    <td class="<?= $changeBorderClass ?>">
        <?= $item_details->cargo_status; ?>
    </td>
    <td class="<?= $changeBorderClass ?>">
        <?= $item_details->shipment; ?>
    </td>
    <td class="<?= $changeBorderClass ?>">
        <?= $item_details->currency; ?>
    </td>
    <td class="<?= $changeBorderClass ?>">
        <?= $item_details->volume_per_annum; ?>
    </td>
    <td class="<?= $changeBorderClass ?>">
        <?= $item_details->container_type; ?>
    </td>
    <td class="<?= $changeBorderClass ?>">
        <?= $item_details->ff_company_name; ?>
    </td>
    <?php $total = 0;
    foreach ($item_details->charges as $key_1 => $category) {
        echo "<td class='$changeBorderClass'>" . number_format($category->categoryTotal, 2) . "</td>";
        $total +=     $category->categoryTotal;
    } ?>
    <td class="<?= $changeBorderClass ?>"><?= number_format($total, 2) ?></td>
    <td class="<?= $changeBorderClass ?>"><?= number_format($item_details->counter_rate, 2) ?></td>
    <td class="<?= $changeBorderClass ?>">
        <a href="javascript:void(0);" onclick="$('#modal_<?= $containerCounter ?>').modal('show')" class="text-primary" title="View Charges">View Charges</a>
        <div class="modal fade" id="modal_<?= $containerCounter ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg mw-100 " role="document">
                <div class="modal-content">
                    <form method="post" action=''>
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">View Charges</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <table>
                                <thead>

                                    <th rowspan="2" class='header'>Loading Place</th>
                                    <th rowspan="2" class='header'>Loading Country</th>
                                    <th rowspan="2" class='header'>Port of Loading</th>
                                    <th rowspan="2" class='header'>Delivery Place</th>
                                    <th rowspan="2" class='header'>Destination Country</th>
                                    <th rowspan="2" class='header'>Port of Discharge</th>
                                    <th rowspan="2" class='header'>Mode</th>
                                    <th rowspan="2" class='header'>Transaction</th>
                                    <th rowspan="2" class='header'>Cargo Type</th>
                                    <th rowspan="2" class='header'>Cargo Nature</th>
                                    <th rowspan="2" class='header'>Shipment Type</th>
                                    <th rowspan="2" class='header'>Currency</th>
                                    <th rowspan="2" class='header'>Volume per Annum</th>
                                    <th rowspan="2" class='header'>Container Type</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="hidden" name="route_id" value="<?= $item_details->id; ?>">
                                            <input type="hidden" name="ff_company_id" value="<?= $item_details->ff_company_id; ?>">
                                            <?= $item_details->loading_place; ?>
                                        </td>
                                        <td>
                                            <?= $item_details->loading_country; ?>

                                        </td>
                                        <td>
                                            <?= $item_details->port_loading_name; ?>
                                        </td>
                                        <td>
                                            <?= $item_details->discharge_place; ?>
                                        </td>
                                        <td>
                                            <?= $item_details->discharge_country; ?>
                                        </td>
                                        <td>
                                            <?= $item_details->port_discharge_name; ?>

                                        </td>
                                        <td>
                                            <?= $item_details->mode; ?>
                                        </td>
                                        <td>
                                            <?= $item_details->transaction; ?>
                                        </td>
                                        <td>
                                            <?= $item_details->container_stuffing; ?>
                                        </td>
                                        <td>
                                            <?= $item_details->cargo_status; ?>
                                        </td>
                                        <td>
                                            <?= $item_details->shipment; ?>
                                        </td>
                                        <td>
                                            <?= $item_details->currency; ?>
                                        </td>
                                        <td>
                                            <?= $item_details->volume_per_annum; ?>
                                        </td>
                                        <td>
                                            <?= $item_details->container_type; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-lg-6">
                                    <table class="table charges" id="chargesTable_<?= $containerCounter ?>">
                                        <tbody>
                                            <?php
                                            $toalOfAllCharges = 0;
                                            $totalCounterOffer = 0;
                                            foreach ($item_details->charges as $key_1 => $category) {   ?>
                                                <?php if (!empty($category->subCategory)) {


                                                    echo "<tr class='breakupBtnContainer'>
                                                    <th style='background-color:#4285f426;color:#000;' class='text-left'>$category->rfc_category_name</th>
                                                    <th class='text-left'><span>" . number_format($category->categoryTotal, 2) . "</span>  </th>
                                                    <th><span id='category_$key_1' class='counter-offer-category-total pull-left'>Counter Offer: " . number_format($item_details->counter_rate?$category->categoryTotalCounterOffer:$category->categoryTotal, 2) . "</span> <a href='javascript:void(0)' class='pull-right break-up-btn text-primary' data-target='breakup-details-$key_1' role='button'>+ Break Up</a></th></tr>";
                                                    $toalOfAllCharges += $category->categoryTotal;

                                                    foreach ($category->subCategory as $key_2 => $subcat) {
                                                        $totalCounterOffer += $subcat->counter_offer;
                                                        echo "<tr class='breakup-details-$key_1' style='display:none;'><td class='text-left'>$subcat->rfcChargesTitle ($subcat->unit):</td><td class='text-left'>" . number_format($subcat->charges, 2) . " </td><td><lable>Counter Offer: </lable><input type='text' class='counter-offer decimal-numbers' name='rfc_charges[$key_1][subcategory][$key_2][counter_offer]' data-category='category_$key_1' value='".($item_details->counter_rate?$subcat->counter_offer:$subcat->charges)."'><input type='hidden' name='rfc_charges[$key_1][subcategory][$key_2][rfc_charges_id]'  value='$subcat->rfc_charges_id'></td></tr>";
                                                    }


                                                    if (isset($category->other_charges)) {
                                                        $totalCounterOffer += $category->counter_offer;
                                                        echo "<tr class='breakup-details-$key_1' style='display:none;'><td class='text-left'>Other:</td><td class='text-left'>" . number_format($category->other_charges, 2) . "</td><td><lable>Counter Offer: </lable><input type='text' class='counter-offer decimal-numbers' name='rfc_charges[$key_1][counter_offer]' data-category='category_$key_1' value='".($item_details->counter_rate?$category->counter_offer:$category->other_charges)."'><input type='hidden' name='rfc_charges[$key_1][id]'  value='$category->id'></td>";
                                                    }
                                                } ?>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class='text-left'>Total</th>
                                                <th class='text-left' colspan="2"><?= number_format($toalOfAllCharges, 2) ?></th>
                                            </tr>
                                            <tr>
                                                <th class='text-left'>Counter Offer</th>
                                                <th class='text-left' colspan="2"><input type="text" name="counter_rate" class='total-counter-offer' required readonly maxlength="15" value="<?= $item_details->counter_rate?$item_details->counter_rate:$toalOfAllCharges; ?>" class="form-control decimal-numbers"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="col-lg-6">
                                    <table class="table col-lg-6">
                                        <thead>
                                            <tr class='breakupBtnContainer'>
                                                <th style='background-color:#4285f426;color:#000;' class='text-left'> Riders</th>
                                                <th> <a href='javascript:void(0)' class='pull-right break-up-btn text-primary' data-target='rider-breakup-details' role='button'>+ Break Up</a></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($item_details->ridersLables as $key_1 => $rider) {   ?>
                                            <?php if (!empty($item_details->ridersLables)) {

                                                    if (in_array($rider->rider_charge_id, ['2', '3', '4'])) {
                                                        echo "<tr class='rider-breakup-details' style='display:none;'><td class='text-left'>" . (str_replace('{mode}', $item_details->mode, $rider->rider_title)) . ":</td><td class='text-left'>".printFormatedDate($rider->value_1)."</td></tr>";
                                                    } else {
                                                        echo "<tr class='rider-breakup-details' style='display:none;'><td class='text-left'>" . (str_replace('{mode}', $item_details->mode, $rider->rider_title)) . ":</td><td class='text-left'>$rider->value_1</td></tr>";
                                                    }
                                                }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" name="submitBtn" value="Send Counter Offer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </td>
</tr>