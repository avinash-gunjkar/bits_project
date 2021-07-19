<fieldset <?php echo ($currentStep->step_id == $stepData[$key]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
  <div class="shipping-form">
    <div class="row">
      <div class="col-12 col-lg-12">
        <div class="form-group">
          <label> Custom Cleared at Destination Port Date:</label>
          <span><?= $shipmentProcessData[$key]->action_date ? printFormatedDate($shipmentProcessData[$key]->action_date) : '- -'; ?></span>

        </div>
      </div>
      <div class="col-12 col-lg-12">
        <div class="form-group">
          <label>Remark:</label>
          <?= $shipmentProcessData[$key]->corrections ? $shipmentProcessData[$key]->corrections : '- -' ?>
        </div>
      </div>
    </div>
  </div>

</fieldset>