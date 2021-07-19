<tr class="list-container-item container_<?= $containerCounter ?>">
    <td class='sr-no'>

    </td>
    <td>
        <input type="hidden" name="route[<?= $containerCounter ?>][id]" value="<?= $item_details->id; ?>">
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
        <?= $item_details->commodity; ?>
    </td>
    <td>
        <?= $item_details->container_type; ?>
    </td>
    <td>
        <?= $item_details->volume_per_annum; ?>
    </td>
    <td>
        <?= $item_details->tentative_gross_wt; ?>
    </td>
    <?php $total = 0;
    foreach ($item_details->charges as $key_1 => $category) {
        echo "<td>".number_format($category->categoryTotal,2)."</td>";
        $total +=     $category->categoryTotal;
    } ?>
    <td><?=number_format($total,2);?></td>
    <td><?=number_format($item_details->counter_rate,2);?></td>
    <td>
        <a href="javascript:void(0);" onclick="$('#modal_<?= $containerCounter ?>').modal('show')" class="text-primary" title="View Charges">View Charges</a>
        <div class="modal fade" id="modal_<?= $containerCounter ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg mw-100 " role="document">
                <div class="modal-content">
                    <form method="post" action="">
                        <input type="hidden" name="route_id" value="<?= $item_details->id; ?>">
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
                                    <th rowspan="2" class='header'>Commodity</th>
                                    <th rowspan="2" class='header'>Container Type</th>
                                    <th rowspan="2" class='header'>Annual Volume per Container Type</th>
                                    <th rowspan="2" class='header'>Tentative Gross Wt.</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>

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
                                            <?= $item_details->commodity; ?>
                                        </td>
                                        <td>
                                            <?= $item_details->container_type; ?>
                                        </td>
                                        <td>
                                            <?= $item_details->volume_per_annum; ?>
                                        </td>
                                        <td>
                                            <?= $item_details->tentative_gross_wt; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-lg-6">
                                    <table id="chargesTable_<?= $containerCounter ?>" class="table">
                                        <tbody>
                                            <?php
                                            $toalOfAllCharges = 0;
                                            $copyArrowHtml = '';
                                            foreach ($item_details->charges as $key_1 => $category) {
                                                if (!empty($category->subCategory)) {


                                                    echo "<tr class='breakupBtnContainer'><th style='background-color:#4285f426;color:#000;' class='text-left'>$category->rfc_category_name</th><th class='text-left'><span id='category_$key_1' class='category-total'>".number_format($category->categoryTotal,2)."</span></th><th><span class='counter-offer-category-total pull-left'>Counter Offer: " . number_format($category->categoryTotalCounterOffer, 2) . "</span> <a href='javascript:void(0)' class='pull-right break-up-btn text-primary' data-target='breakup-details-$key_1' role='button'>+ Break Up</a></th></tr>";
                                                    $toalOfAllCharges += $category->categoryTotal;

                                                    foreach ($category->subCategory as $key_2 => $subcat) {
                                                        $copyArrowHtml = '';
                                                        if($subcat->charges != $subcat->counter_offer){
                                                            $copyArrowHtml="<a href='javascript:void(0)' class='fa fa-angle-double-left fa-lg text-info copy-counter-offer-single' title='Copy'></a>";
                                                        }

                                                        echo "<tr class='breakup-details-$key_1' style='display:none;'><td class='text-left'>$subcat->rfcChargesTitle  ($subcat->unit):</td><td class='text-left'><input type='text' name='rfc_charges[$key_1][subcategory][$key_2][charges]' data-category='category_$key_1' class='form-control decimal-numbers charges' value='$subcat->charges'><input type='hidden' name='rfc_charges[$key_1][subcategory][$key_2][rfc_charges_id]'  value='$subcat->rfc_charges_id'></td><td>$copyArrowHtml Counter Offer: <span class='counter-rate'>$subcat->counter_offer</span> </td></tr>";
                                                    }

                                                    if (isset($category->other_charges)) {
                                                        $copyArrowHtml = '';
                                                        if($category->other_charges != $category->counter_offer){
                                                            $copyArrowHtml="<a href='javascript:void(0)' class='fa fa-angle-double-left fa-lg text-info copy-counter-offer-single' title='Copy'></a>";
                                                        }
                                                        echo "<tr class='breakup-details-$key_1' style='display:none;'><td class='text-left'>Other:</td><td class='text-left'><input type='text' name='rfc_charges[$key_1][other_charges]' data-category='category_$key_1' class='form-control decimal-numbers charges' value='$category->other_charges'><input type='hidden' name='rfc_charges[$key_1][id]'  value='$category->id'></td><td>$copyArrowHtml Counter Offer: <span class='counter-rate'>$category->counter_offer</span> </td></tr>";
                                                    }

                                                    // echo "<tr  ><th></th><th>$th1</th> </tr>";

                                                }
                                            } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class='text-left'>Total</th>
                                                <th class='text-left total-charges' colspan="2"><?= number_format($toalOfAllCharges,2) ?></th>
                                            </tr>
                                            <tr>
                                                <th class='text-left'>Counter Offer</th>
                                                <th class='text-left' colspan="2"><?= number_format($item_details->counter_rate,2) ?></th>
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
                                            foreach ($item_details->ridersLables as $riderKey_1 => $rider) {   ?>
                                            <?php if (!empty($item_details->ridersLables)) {

                                                if($rider->rider_charge_id=='1'){
                                                    echo "<tr class='rider-breakup-details' style='display:none;'><td class='text-left'>". (str_replace('{mode}', $item_details->mode, $rider->rider_title)) . ":</td>
                                                    <td class='text-left'>
                                                    <input type='hidden' name='riders[$riderKey_1][rider_charge_id]' value='$rider->rider_charge_id'>
                                                     <div class='input-comment dropdown'>
                                                        <input required type='text' id='payment_term_$containerCounter' data-toggle='dropdown' autocomplete='off' class='form-control dropdown-toggle' placeholder='Payment Term...' name='riders[$riderKey_1][value_1]' value='$rider->value_1' maxlength='50' />
                                                        <ul class='dropdown-menu' role='menu' style='width:250px;'>
                                                            <li class='mx-2' onclick='$(\"#payment_term_$containerCounter\").val($(this).text())'>100% Advance</li>
                                                            <li class='mx-2' onclick='$(\"#payment_term_$containerCounter\").val($(this).text())'>50% Advance 50% Against Delivery</li>
                                                            <li class='mx-2' onclick='$(\"#payment_term_$containerCounter\").val($(this).text())'>15 days from Service Invoice date</li>
                                                            <li class='mx-2' onclick='$(\"#payment_term_$containerCounter\").val($(this).text())'>30 days from Service Invoice date</li>
                                                            <li class='mx-2' onclick='$(\"#payment_term_$containerCounter\").val($(this).text())'>45 days from Service Invoice date</li>
                                                            <li class='mx-2' onclick='$(\"#payment_term_$containerCounter\").val($(this).text())'>60 days from Service Invoice date</li>
                                                            <li class='mx-2' onclick='$(\"#payment_term_$containerCounter\").val($(this).text())'>90 days from Service Invoice date</li>
                                                            <li class='mx-2'>Other</li>
                                                        </ul>
                                                    </div>
                                                    </td></tr>
                                                    ";
                                                }else if(in_array($rider->rider_charge_id,['2','3','4'])){
                                                    echo "<tr class='rider-breakup-details'  style='display:none;'><td class='text-left'>" . (str_replace('{mode}', $item_details->mode, $rider->rider_title)) . ":</td><td class='text-left'><input type='text' class='form-control date-picker' placeholder='DD-MM-YYYY' name='riders[$riderKey_1][value_1]' value='".printFormatedDate($rider->value_1)."'><input type='hidden' name='riders[$riderKey_1][rider_charge_id]' value='$rider->rider_charge_id'></td></tr>";
                                                }else{

                                                    echo "<tr class='rider-breakup-details' style='display:none;'><td class='text-left'>" . (str_replace('{mode}', $item_details->mode, $rider->rider_title)) . ":</td><td class='text-left'><input type='text' class='form-control' name='riders[$riderKey_1][value_1]' value='$rider->value_1'><input type='hidden' name='riders[$riderKey_1][rider_charge_id]' value='$rider->rider_charge_id'></td></tr>";
                                                }
                                                }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>




                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" name="submitBtn" value="Update Charges">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </td>
</tr>

