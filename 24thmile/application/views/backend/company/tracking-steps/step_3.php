<fieldset <?php echo ($currentStep->step_id == $stepData[$key]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
  <?php $preshipdocs = isset($shipmentProcessData[$key]->documents) ? json_decode($shipmentProcessData[$key]->documents) : '';
  $showDownloadbtn = $shipmentProcessData[$key]->status == 2 || $shipmentProcessData[$key]->status == 1;
  $status = "<span class='badge badge-danger'>Upload Pending</span>";
  if (!empty($shipmentProcessData[$key])) {
    if (!empty($shipmentProcessData[$key]->status == 1)) {
      $status = "<span class='badge badge-success'>Approved</span>";
    } else if (!empty($shipmentProcessData[$key]->status == 2)) {
      $status = "<span class='badge badge-info'>Uploaded</span>";
    } else if (!empty($shipmentProcessData[$key]->status == 3)) {
      $status = "<span class='badge badge-warning'>Reupload</span>";
    } else {
      $status = "<span class='badge badge-danger'>Upload Pending</span>";
    }
  } ?>
  <div class="row">
    <div class="col l4">
      <div class="form-group">
        <label>Final Shipping Bill:</label>
        <p><?= printDocumentLink($preshipdocs->Final_shipping_bill) ?></p>
      </div>
    </div>

    <div class="col l4">
      <div class="form-group">
        <label>Shipping Bill Number :</label>
        <p><?php echo isset($bookedShipment->shipping_bill_number) ? $bookedShipment->shipping_bill_number : '- -'; ?></p>
      </div>
    </div>
    <div class="col l4">
      <div class="form-group">
        <label>Shipping Bill Date:</label>
        <p><?php echo isset($bookedShipment->shipping_bill_date) ? date('d-M-Y', strtotime($bookedShipment->shipping_bill_date)) : '- -'; ?></p>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col l4">
      <div class="form-group">
        <label>DBK Amount (INR):</label>
        <p><?php echo isset($bookedShipment->DBK_amount) ? $bookedShipment->DBK_amount : '- -'; ?></p>
      </div>
    </div>
    <div class="col l4">
      <div class="form-group">
        <label>FOB Value (INR):</label>
        <p><?php echo isset($bookedShipment->fob_value) ? $bookedShipment->fob_value : '- -'; ?></p>
      </div>
    </div>
    <div class="col l4">
      <div class="form-group">
        <label>MEIS Rate(%):</label>
        <p><?php echo isset($bookedShipment->MEIS_rate) ? $bookedShipment->MEIS_rate : '- -'; ?></p>
      </div>
    </div>
    <div class="col l4">
      <div class="form-group">
        <label>MEIS Amount (INR):</label>
        <p><?php echo isset($bookedShipment->MEIS_amount) ? $bookedShipment->MEIS_amount : '- -'; ?></p>
      </div>
    </div>

    <div class="col l4">
      <label>Reached at Loading Port Date:</label>
      <?php if (!empty($shipmentProcessData[$key]->action_date)) { ?>
        <p><?= printFormatedDate($shipmentProcessData[$key]->action_date); ?> </p>
      <?php } else { ?>
        <p>- -</p>
      <?php } ?>
    </div>
   
    <div class="col l12">
      <label>Remark:</label>
      <?php if (!empty($shipmentProcessData[$key]->corrections)) { ?>
        <span><?= $shipmentProcessData[$key]->corrections ?> </span>
      <?php } else { ?>
        <span>- -</span>
      <?php } ?>
    </div>
  </div>
  <?php if ($shipmentProcessData[$key]->status == 1 || $shipmentProcessData[$key]->status == 2) { ?>
    <!-- <div class="col l12">
      <span class="text-info">Email has been sent to Freight Forwarder.</span>
    </div> -->
  <?php } ?>
  <!--<input type="button" name="previous" class="previous btn btn-default-cust action-button" value="Previous" />-->
  <?php
  if (!empty($shipmentProcessData[$key]->step_id)) {
    if (isset($shipmentProcessData[$key]->step_id) && $stepData[$key]->id == $shipmentProcessData[$key]->step_id && $shipmentProcessData[$key]->status != 1) { ?>
      <!-- <input type="hidden" name="step_id_3" value="<?php echo $stepData[$key]->id; ?>"> -->
      <!-- <input type="submit" id="step3_export" class="btn btn-default-cust action-button pull-right" value="Submit" /> -->
    <?php }
  } else { ?>
    <!--						<input type="hidden" name="step_id_3" value="<?php echo $stepData[$key]->id; ?>">
						<input type="submit" name="step3_export" class="btn btn-default-cust action-button pull-right" value="Submit" />-->
  <?php } ?>
  <?php if (isset($shipmentProcessData[$key]->step_id) && $stepData[$key]->id == $shipmentProcessData[$key]->step_id && $shipmentProcessData[$key]->status == 1) { ?>
    <!--<input type="button" name="next" class="next btn btn-default-cust action-button pull-right" value="Next" />-->
  <?php } ?>

</fieldset>