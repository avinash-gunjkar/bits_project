
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

.dataTables_length .form-control.input-sm { margin:0px 10px;}

@media (min-width: 840px){
	.mdl-grid {
		padding: 8px 0px;
		width: 100% !important;
	}
}
table.table tbody tr td a {
	
        margin: 5px;
        
}
table.table tbody tr td a::after {
	content: ",  ";
        
}
table.table tbody tr td a:last-of-type::after {
	content: "";
}
table.table tr th{
    text-align: left;
}
table.table tr td{
    text-align: left;
}
</style>
   <!-- Tracking start -->
   <div class="wshipping-content-block">
      
	   <div class="container">
       <div class="row">
          <div class="col-12 col-lg-12">
              <div class="tracking-block">
                  <div class="tab-content">
		  <h3 class="heading3-border">Shipping Documents </h3>
          
                  <form  method="GET" action="">
                      <div class="row justify-content-center">
                          <lable><strong>RFC ID</strong></lable><div class="col-lg-2 mb-2"><input type="text" value="<?=$this->input->get('rfc_id')?>" class="form-control" name="rfc_id" title="RFC ID" placeholder="Enter RFC ID" ></div>
                          <div class="col-lg-3 mb-2"><input type="submit" class="btn btn-primary btn-sm" name="submit" value="Search" ></div>
                      </div>
                  </form>
		  <div class="table-responsive">
                      <table class="table table-bordered">
                          <thead>
                              <tr>
                                  <th style="width: 200px;">Tracking Step</th>
                                  <th>Documents</th>
                              </tr>
                          </thead>
                          <tbody>
                              
                          <?php 
                          $loadedOn_arr[3] = 'Vessel';
                          $loadedOn_arr[2] = 'Flight';
                          $loadedOn_arr[1] = 'Truck';
                          foreach ($shipmentProcessData as $step){ ?>
                          <tr>
                              <td><?=$step->step_name?> <?= (in_array($step->id ,['16','6'])) ? $loadedOn_arr[$requestDetails->mode_id] : '' ?></td>
                              <td><?php 
                                $documentList = (array) json_decode($step->documents);
                                foreach ( $documentList as $key=>$value){
                                    echo "<a href='$value' target='_blank'>".getDocumentName($key)."</a>";
                                }
                              ?></td>
                          </tr>
                          <?php }?>
                          <?php if(empty($shipmentProcessData)){
                              echo "<tr><td colspan='2'>Documents not available.</td></tr>";
                          }?>
                          </tbody>
                      </table>
                    </div>
          </div>
          </div>
          </div>
       </div>
     </div>
   </div>
   <!-- Blog content end --> 
   </section><!-- sidebar_dashboard-->
</div> <!-- sidebar_dashboard-->