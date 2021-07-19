<table id="request_list" style="border:1px solid #000">
    <thead>

        <tr>
            <th rowspan="2">ID</th>
            <th rowspan="2">Loading Place</th>
            <th rowspan="2">Loading Country</th>
            <th rowspan="2">Port of Loading</th>
            <th rowspan="2">Delivery Place</th>
            <th rowspan="2">Destination Country</th>
            <th rowspan="2">Port of Discharge</th>
            <th rowspan="2">Mode</th>
            <th rowspan="2">Transaction</th>
            <th rowspan="2">Cargo Type</th>
            <th rowspan="2">Cargo Nature</th>
            <th rowspan="2">Shipment Type</th>
            <th rowspan="2">Currency</th>
            <th rowspan="2">Volume per Annum</th>
            <th rowspan="2">Container Type</th>
            <th rowspan="2" class='header'>Service Provider</th>
            <?php foreach ($rfcCategory as $category) {
                $colspan = count($category->subCategory);
                if(isset($category->other_charges)){
					$colspan = $colspan+1;
				}
                echo "<th colspan='$colspan'>$category->rfc_category_name</th>";
            } ?>
           <th rowspan="2"  class='header'>Total</th>
            <?php 
				$colspan = count($riderLables);
				echo "<th colspan='$colspan'>Riders</th>";
			?>
             
        </tr>
        <tr>

            <?php foreach ($rfcCategory as $category) {
                foreach ($category->subCategory as $subCategory) {

                    echo "<th>" . str_replace('&', 'and', $subCategory->rfcChargesTitle) . " ($subCategory->unit)</th>";
                }
                if(isset($category->other_charges)){
					echo "<th>Other</th>";
				}
            } ?>
            <?php foreach($riderLables as $rider){
				//$colspan = count($category->subCategory);
				//$annualContractDetails->routes[0]->mode;
				echo "<th>".(str_replace('{mode}',$annualContractDetails->routes[0]->mode,$rider->rider_title))."</th>";
			}?>
        </tr>


    </thead>
    <tbody>
        <?php if ($annualContractDetails->routes) {
            foreach ($annualContractDetails->routes as $item_details) { ?>
                <tr>
                    <td>
                        <?= $item_details->id ?>
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
                        <?= $item_details->volume_per_annum; ?>
                    </td>
                    <td>
                        <?= $item_details->container_type; ?>
                    </td>
                    <td class="<?= $changeBorderClass ?>">
                        <?= $item_details->ff_company_name; ?>
                    </td>
                    <?php
                    $toalOfAllCharges = 0;
                    foreach ($item_details->charges as $key1 => $category) {
                        $toalOfAllCharges += $category->categoryTotal;
                        foreach ($category->subCategory as $key2 => $subCategory) {
                            // $id = $item_details->charges[$counterIndex]->id;
                            $charges = $subCategory->charges;
                           
                            echo "<td>$charges</td>";
                            $counterIndex++;
                        }

                        if(isset($category->other_charges)){
                            echo "<th>$category->other_charges</th>";
                        }
                    } ?>
                    <td><?= $toalOfAllCharges ?></td>

                    <?php foreach($item_details->ridersLables as $rider){
				//$colspan = count($category->subCategory);
				//$annualContractDetails->routes[0]->mode;
				echo "<th>$rider->value_1</th>";
			}?>
                </tr>
        <?php }
        } ?>
    </tbody>

</table>