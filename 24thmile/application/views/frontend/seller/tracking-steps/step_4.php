<fieldset <?php echo ($currentStep->step_id == $stepData[$key]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>

<div class="shipping-form">
<div class="row">

<div class="col-12 col-lg-12">
		<label>Reached in Custom Clearance on Date:</label>
		<?php if (!empty($shipmentProcessData[$key]->action_date)) { ?>
			<span><?= printFormatedDate($shipmentProcessData[$key]->action_date); ?> </span>
		<?php } else { ?>
			<span>- -</span>
		<?php } ?>
	</div>
<div class="col-12 col-lg-12">
		<label>Remark:</label>
		<span><?=$shipmentProcessData[$key]->corrections?$shipmentProcessData[$key]->corrections:'- -'?></span>
	</div>

</div>
</div>

</fieldset>