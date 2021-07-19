
<style>
.comment-group {
    border-bottom:none;
	padding: none;
}
.comment-img {
    position: initial !important;
}
.comment-img img {
    max-width: 80%;
    border-radius: 0%;
}
.section-title {
    text-align: left;
    padding-bottom: 0px;
    padding-top: 45px;
}
.wshipping-content-block {
    padding: 0px 0px;
}

@media (min-width: 840px){
	.mdl-grid {
		padding: 8px;
		width: 100% !important;
	}
}
</style>
   <!-- Tracking start -->
   <div class="wshipping-content-block">
      
	   <div class="container">
       <div class="row">
           <?php //vdebug($ff_list); ?>
          <div class="col-12 col-lg-12">
              <div class="tracking-block">
                  <div class="tab-content">
                      <div id="message-block">
                          <?=$this->session->flashdata('message')?>
                          
                      </div>
                      
<!--                       <div class="frightImgBg">
                       </div>-->
		  <h3 class="heading3-border">Select Freight Comparative </h3>
                  <form method="post" action="">
                      
                      <div class="input-group mb-3">
                          <select class=" chosen-select col" multiple="" name="sr_sector[]" data-placeholder="Select some sectors">
                                  <?php foreach($sectors as $sector){ ?>
                              <option <?= in_array($sector['id'], $filterData['sectors'])?'selected':''?> value="<?php echo $sector['id']; ?>"><?php echo $sector['name']; ?></option>
                                 <?php } ?>
                              </select>
                          <input type="text" class="form-control" name="location" maxlength="15" placeholder="Location e.g. India" value="<?=$filterData['location']?>">
                          <input type="text" class="form-control" name="name" maxlength="15" placeholder="Company Name" value="<?=$filterData['name']?>">
                            <div class="input-group-append">
                                <input type="submit" class="btn btn-submit btn-sm" name="btn_submit" value="Search" > 
                                &nbsp;
                                <a href="" class="btn btn-sm btn-secondary" >Reset</a>
                            </div>
                          </div>
                       <div class="clearfix mb-3">
                            <input type="submit" class="btn btn-submit btn-sm" name="btn_submit" value="<?=($skipComparative)?'Save & Continue':'Request for Quote'?>">
                            &nbsp;
                            <a href="<?= base_url('fs-request-list');?>" class="btn btn-secondary btn-sm">Cancel</a>
                        </div>
                      <table class="table table-bordered">
                          <thead>
                              <tr>
                                  <th></th>
                                  <th>FF-Company Name</th>
                                  <th>Contact Person</th>
                                  <th>Address</th>
                                  <!--<th>Transaction Currency</th>-->
                              </tr>
                          </thead>
                          <tbody >
                               <?php foreach ($ff_list as $ff){?>
                              <tr>
                                  <td>
                                      <?php if($skipComparative){ ?>
                                      <input  type="radio" name="ff_company_id" value="<?=$ff->company_id?>" <?= in_array($ff->company_id, $selectedFFids)?'checked disabled':''?>></td>
                                        <?php }else{?>
                                      <input  type="checkbox" name="ff_company_id[]" value="<?=$ff->company_id?>" <?= in_array($ff->company_id, $selectedFFids)?'checked disabled':''?>></td>
                                        <?php }?>
                                      
                                  <td class="text-capitalize"><a href="<?= base_url('company-details/'.$ff->company_id)?>" target="_blank"><?=$ff->company_name?></a></td>
                                  <td class="text-capitalize">
                                      <!--<p>Name: <?=$ff->salutation.' '.$ff->firstname.' '.$ff->lastname?></p>-->
                                      <p>Email: <?=$ff->email?></p>
                                      <p>Phone: <?=$ff->country_code.' '.$ff->phone?></p>
                                  </td>
                                  <td>
<!--                                      <p>Industry Types: <?=$ff->industryTypes?></p>-->
                                      <p>Sectors: <?=$ff->sectors?></p>
                                      <p>Address: <?=$ff->city_name?></p>
                                     
                                  </td>
                                  <!--<td><?=$ff->transaction_currency?></td>-->
                              </tr>
                              <?php }?>
                              <?php if(empty($ff_list)){ ?>
                              <tr>
                                  <td colspan="5">Data not available.</td>
                              </tr>
                              <?php }?>
                          </tbody>
                      </table>
                     
                     
                        <div class="clearfix">
                            <input type="submit" class="btn btn-submit btn-sm" name="btn_submit" value="<?=($skipComparative)?'Save & Continue':'Request for Quote'?>">
                            &nbsp;
                            <a href="<?= base_url('fs-annual-contract-list');?>" class="btn btn-secondary btn-sm">Cancel</a>
                        </div>
                      
                      </form>
          </div>
          </div>
          </div>
       </div>
     </div>
   </div>
   <!-- Blog content end --> 
   </section><!-- sidebar_dashboard-->
</div> <!-- sidebar_dashboard-->
<script src="<?php echo base_url('assets/frontend/js/vendor/jquery-2.2.4.min.js');?>"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.css" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.js"></script>
<script type="text/javascript">
 $(".chosen-select").chosen();
</script>