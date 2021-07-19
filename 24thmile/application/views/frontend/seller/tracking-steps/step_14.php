 <fieldset <?php echo ($currentStep->step_id == $stepData[$key]->id) ? 'style="opacity: 1; display: block;"' : '' ?>>
     <div class="shipping-form">
               <div class="row">
                   <div class="col-12 col-lg-12">
                       <label>Reached at Origin Port on Date: </label>
                            <span><?=$shipmentProcessData[$key]->action_date?printFormatedDate($shipmentProcessData[$key]->action_date):'- -'; ?></span>
                      </div>
                         <div class="col-12 col-lg-12">  
                            <div class="form-group">
                                <label>Remark:</label>
                                <?=$shipmentProcessData[$key]->corrections?$shipmentProcessData[$key]->corrections:'- -'?>
                            </div>
                            </div>
               </div>
            </div>
 <?php 
        if(!empty($shipmentProcessData[$key]->step_id)){
       if(isset($shipmentProcessData[$key]->step_id) && $stepData[$key]->id == $shipmentProcessData[$key]->step_id && $shipmentProcessData[$key]->status != 1){ ?>
    <!--						 <input type="hidden" name="step_id_3" value="<?php echo $stepData[$key]->id; ?>">
                <input type="submit" id="step3_import" class="btn btn-default-cust btn-submit pull-right" value="Submit" />-->
        <?php } 
               }else{ ?>
    <!--						<input type="hidden" name="step_id_3" value="<?php echo $stepData[$key]->id; ?>">
               <input type="submit" name="step3_import" class="btn btn-default-cust btn-submit pull-right" value="Submit" />-->
               <?php } ?>
               <?php if(isset($shipmentProcessData[$key]->step_id) && $stepData[$key]->id == $shipmentProcessData[$key]->step_id && $shipmentProcessData[$key]->status == 1){ ?>
               <!--<input type="button" name="next" class="next btn btn-default-cust action-button pull-right" value="Next" />-->
               <?php } ?>			   
       </fieldset>