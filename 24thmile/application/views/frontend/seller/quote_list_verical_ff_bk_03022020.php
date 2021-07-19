
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
                   <?php  $rfcCategory = $this->freight_model->getRfcChargesCategory($requestDetails->delivery_term_id,$requestDetails->request_id,0);?>
                  <form method="post" action="">
                      <div class="table-responsive">
                      <table class="table table-bordered">
                          <thead>
                              <tr>
                                  <th>FF Name</th>
                                <?php foreach ($rfcCategory as $category){   ?>
                                  <?php if(!empty($category->subCategory)){ 
                                    
                                        ?>
                                  <?php if(in_array($category->id, ['3','6'])){?>
                           
                                    <?php if($category->id == 3 && $requestDetails->mode_id == 3) {//sea
                                        foreach ($category->subCategory as $subCategory){ $subcategory.="<th>$subCategory->sub_account</th>"; }
                                        ?>
                                    <th colspan="<?=count($category->subCategory)?>"><?=$category->rfc_category_name?></th>
                                    <?php }?>
                                    
                                    <?php if($category->id == 6  && $requestDetails->mode_id == 2) {//air
                                        foreach ($category->subCategory as $subCategory){ $subcategory.="<th>$subCategory->sub_account</th>"; }?>
                                    <th colspan="<?=count($category->subCategory)?>"><?=$category->rfc_category_name?></th>
                                    <?php }?>
                                    
                           <?php }else{ foreach ($category->subCategory as $subCategory){ $subcategory.="<th>$subCategory->sub_account</th>"; }?>
                            <th colspan="<?=count($category->subCategory)?>"><?=$category->rfc_category_name?></th>
                           <?php }?>
                                  
                                  <?php }?>
                                  <?php }?>
                            <th rowspan="2">Total Quote Value</th>
                              </tr>
                              <?=$subcategory?"<tr><th></th>$subcategory</tr>":''; ?>
                             
                              
                          </thead>
                          <tbody>
                              
                               <?php foreach ($ff_list as $key=>$ff){ 
                                 $rfc_charges =  $this->freight_model->getRfcChargesCategory($requestDetails->delivery_term_id,$ff->request_id,$ff->ff_id);?>
                              <?= vdebug($rfc_charges)?>
                                  <tr>
                                 
                                  <td><?=$ff->company_name?></td>
                                  <?php foreach ($rfc_charges as $rfc){?>
                                    <?php foreach ($rfc->subCategory as $subrfc){?>
                                  <?php if($rfc->id == '1' && in_array($requestDetails->shipment_id, ['1'])){ ?>
                                    <?php if($subrfc->id=='1'){ $particular =  $this->freight_model->getRfcChargesCategory($requestDetails->delivery_term_id,$ff->request_id,$ff->ff_id); ?>
                                    <?php }?>
                                    <?php if($subrfc->id=='2'){?>
                                    <?php }?>
                                  <?php }else if(in_array($rfc->id, ['3','6'])){?>
                           
                                    <?php if($rfc->id == 3 && $requestDetails->mode_id == 3) {//sea?>
                                    <td><?=$subrfc->charges?></td>
                                    <?php }?>
                                    
                                    <?php if($rfc->id == 6  && $requestDetails->mode_id == 2) {//air?>
                                    <td><?=$subrfc->charges?></td>
                                    <?php }?>
                                    
                                    <?php }else{?>
                                     <td><?=$subrfc->charges?></td>
                                    <?php }?>
                            
                                    
                                    
                                    <?php }?>
                                  <?php }?>
                                     <td><?= number_format($ff->total_quote_amount,2);?></td>
                                   </tr>
                                  <?php }?>
                          </tbody>
                          
                      </table>
                      </div>
                     
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