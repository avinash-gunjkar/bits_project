
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
          <div class="col-12 col-lg-12">
              <div class="tracking-block">
                  <div class="tab-content">
		  <h3 class="heading3-border">Freight Comparative </h3>
                  <form method="post" action="">
                      <table class="table table-bordered">
                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Company Name</th>
                                  <th>Contact Details</th>
                                  <th>Address</th>
                                  <th>Total Quote Amount</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody >
                             
                              <?php  $transactionCurrencyHtml = $requestDetails->transaction_currency?$requestDetails->transaction_currency.' ':'INR '; ?>
                               <?php foreach ($ff_list as $key=>$ff){?>
                              <tr>
                                  <td ><?=$key+1?></td>
                                  <td class="text-capitalize text-left"><a href="<?= base_url('company-details/'.$ff->company_id)?>" target="_blank"><?=$ff->company_name?></a></td>
                                  <td class="text-capitalize">
                                       <p>Name: <?=$ff->salutation.' '.$ff->firstname.' '.$ff->lastname?></p>
                                      <p>Phone: <?=$ff->country_code.' '.$ff->phone?></p>
                                  </td>
                                  <td class="text-left">
                                      <p><?=$ff->address_line_1.' '.$ff->address_line_2?></p>
                                      
                                      <p><?=$ff->city_name?></p>
                                  </td>
                                  <td class="text-right"><?= $ff->quote_submit_status=='1'? $transactionCurrencyHtml.number_format($ff->total_quote_amount,2):'- -'?></td>
                                 
                                  <td>
                                      <?php if($ff->quote_submit_status=='1'){?>
                                      <a href="<?= base_url('view-quote/'.$ff->request_id.'/'.$ff->ff_id)?>" class="btn btn-primary btn-sm">View Quote</a>
                                      <?php }else{ ?>
                                      <a href="javascript:void(0);" class="btn btn-danger btn-sm">Quote Pending</a>
                                      <?php } ?>
                                  </td>
                              </tr>
                              <?php }?>
                              <?php if(empty($ff_list)){ ?>
                              <tr>
                                  <td colspan="6">Data not available.</td>
                              </tr>
                              <?php }?>
                          </tbody>
                      </table>
                     
                     
                        <div class="col-12 col-lg-12">
                            
                            <a href="<?= base_url('fs-request-list');?>" class="btn btn-secondary btn-sm">Go Back</a>
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