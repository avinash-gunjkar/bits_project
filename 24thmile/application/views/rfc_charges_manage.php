<div class="wshipping-content-block" style="padding: 40px 0px 0px 0px; ">
    <div class="container">
        <form action="" method="post">
            <div class="row"><?=json_encode(['Transaction'=>$sr_transaction,'Mode'=>$sr_mode,'Delivery Term'=>$sr_delivery_term,'Shipment'=>$sr_shipment]);?></div>
        <div class="row">
            <div class="col-md-3">

                <label class="mr-3">Transaction</label>
                <div class="radio">

                    <label class="mr-3 ml-3"><input type="radio" aria-describedby="transaction-error" name="transaction" id="transaction_export" value="Export" <?=$sr_transaction=='Export'?'checked':''?>> Export</label>&nbsp;
                    <label class="mr-3 ml-3"><input type="radio" aria-describedby="transaction-error" name="transaction" id="transaction_import" value="Import" <?=$sr_transaction=='Import'?'checked':''?>> Import</label>&nbsp;
                    <span id="transaction-error" class="error"></span>
                </div>
            </div>
            <div class="col-md-3">

                <label class="mr-3">Mode<sup>* </sup></label>
                <div class="radio">
                    <?php foreach ($modes as $mode) { ?>
                        <label class="mr-3 ml-3"><input type="radio" name="mode" aria-describedby="mode-error" class="mode" value="<?php echo $mode['id']; ?>" <?= $sr_mode == $mode['id'] ? 'checked' : ''; ?>> <?php echo $mode['type']; ?></label>&nbsp;
                    <?php } ?>
                    <span id="mode-error" class="error"></span>
                </div>

            </div>

            <div class="col-12 col-md-3 mb-2">
                <label>Delivery Term <sup>* </sup></label>
                <select name="delivery_term" class="custom-select">
                    <option value="">Select</option>
                    <?php foreach ($delivery_terms as $delivery_term) { ?>
                        <option value="<?php echo $delivery_term['id']; ?>" <?= $sr_delivery_term == $delivery_term['id'] ? 'selected' : ''; ?>><?php echo $delivery_term['name'] . ' (' . $delivery_term['description'] . ')'; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-12 col-md-3 mb-2">
                <label>Shipment Type <sup>* </sup></label>
                <div class="input-comment">
                    <select name="shipment" id="shipment" class="custom-select">
                        <option value="">Select</option>
                        <?php foreach ($shipments as $shipment) { ?>
                            <option value="<?php echo $shipment['id']; ?>" <?= ($shipment['id'] == '1' && in_array($requestDetails->mode_id, ['1', '2'])) ? 'disabled="true"' : '' ?> <?= $sr_shipment == $shipment['id'] ? 'selected' : ''; ?>><?php echo $shipment['type']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <button type="submit">Search</button>
        </form>
        <!-- <pre>
                            <?=print_r($rfc_charges_list);?>
                            </pre> -->
        <table class="table table-border ">
                <thead>
                    <tr>
                        <th>Sr.No.</th>
                        <th>RFC Category name</th>
                        <th>Pricing Lable</th>
                        <th>Unit</th>
                        <th>Transaction</th>
                        <th>Mode</th>
                        <th>Shipment</th>
                        <th>Delivery Term</th>
                    </tr>
                </thead>    
                <tbody>
                    <?php foreach($rfc_charges_list as $key=>$item){?>
                    <tr>
                        <td><?=$key+1;?></td>
                        <td class="text-left"><?=$item->rfc_category_name?></td>
                        <td class="text-left"><?=$item->pricing_label?></td>
                        <td class="text-left"><?=$item->unit?></td>
                        <td class="text-left"><?=$item->transaction?></td>
                        <td class="text-left"><?=$item->mode?></td>
                        <td class="text-left"><?=$item->shipment?></td>
                        <td class="text-left"><?=$item->name?></td>
                    </tr>
                    <?php }?>
                </tbody>        
        </table>
        
    </div>
</div>