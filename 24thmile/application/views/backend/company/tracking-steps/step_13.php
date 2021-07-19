 <fieldset <?php echo ($currentStep->step_id == $stepData[$key]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
				  
            <div class="shipping-form">
               <div class="row">
               <?php if (in_array($bookedShipment->delivery_term_id, ['1'])) { ?>
                      <div class="col l4">
                             <div class="form-group">
                                    <label style="display: inline">Vehicle Details :</label>
                                    <?= $bookedShipment->vehicle_details ? $bookedShipment->vehicle_details : '- -' ?>
                             </div>
                      </div>
                      <div class="col l4">
                             <div class="form-group">
                                    <label style="display: inline">Transporter Contact Details :</label>
                                    <?= $bookedShipment->driver_contact_details ? $bookedShipment->driver_contact_details : '- -' ?>
                             </div>
                      </div>
               <?php } ?>
                   <div class="col l12">
                       <label>Shipment Lifted on Date: </label>
                            <span><?=$shipmentProcessData[$key]->action_date?printFormatedDate($shipmentProcessData[$key]->action_date):'- -'; ?></span>
                      </div>
                         <div class="col l12">  
                            <div class="form-group">
                                <label>Remark:</label>
                                <?=$shipmentProcessData[$key]->corrections?$shipmentProcessData[$key]->corrections:'- -'?>
                            </div>
                            </div>
               </div>
            </div>
            <!--<input type="button" name="previous" class="previous btn btn-default-cust action-button" value="Previous" />-->
            <?php 
            if(!empty($shipmentProcessData[$key]->step_id)){
           if(isset($shipmentProcessData[$key]->step_id) && $stepData[$key]->id == $shipmentProcessData[$key]->step_id && $shipmentProcessData[$key]->status != 1){ ?>
                    <!--<input type="hidden" name="step_id_2" value="<?php echo $stepData[$key]->id; ?>">-->
                    <!--<input type="submit" name="step2_import" class="btn btn-default-cust btn-submit pull-right" value="Submit" />-->
            <?php } 
                   }else{ ?>
                   <!--<input type="hidden" name="step_id_2" value="<?php echo $stepData[$key]->id; ?>">-->
                   <!--<input type="submit" name="step2_import" class="btn btn-default-cust btn-submit pull-right" value="Submit" />-->
                   <?php } ?>
                   <?php if(isset($shipmentProcessData[$key]->step_id) && $stepData[$key]->id == $shipmentProcessData[$key]->step_id && $shipmentProcessData[$key]->status == 1){ ?>
                   <!--<input type="button" name="next" class="next btn btn-default-cust action-button pull-right" value="Next" />-->
                   <?php } ?>
      </fieldset>