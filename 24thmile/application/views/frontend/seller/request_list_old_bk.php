
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
       <div class="row promo-box" style="background-image: url('<?php echo base_url('assets/frontend/images/bg-header.jpg'); ?>');background-repeat: no-repeat;background-position: center;">
		   <div class="container">
			   <div class="row">
				  <div class="col-12 col-lg-4">
					<br/>
					<span style="font-size:22px;color: #f25859;"><?php echo $myProfile->company_name; ?></span>
					<span class="text-white">( <i><?php echo ($myProfile->role == 2) ? 'Seller':'Freight Forwarder'; ?></i> ) </span>
	<!-- 				 <div class="section-title wow fadeInUp">
						<div class="comment-img">
						<?php if($myProfile->profile_pic){ ?>
						<img src="<?php //echo $myProfile->profile_pic; ?>" alt="" />
						<?php }else{ ?>
						<img src="<?php //echo base_url('assets/frontend/images/comment-pic1.jpg'); ?>" alt="" />
						<?php } ?>
						</div>
						 <h4 class="text-white" style="margin-top:0px !important;margin-bottom:40px !important;"><?php //echo $myProfile->company_name; ?></h4>
					 </div> -->
				  </div>
				  <div class="col-12 col-lg-8">
					 <div class="wow fadeInUp pt10 pull-right">
						<a href="<?php echo base_url('my-profile'); ?>"><span class="custom-btn-reg cbtn-white text-uppercase cbtn-shadow" style="margin-top: 20px;">My Profile</span></a>
						<a href="<?php echo base_url('request-list'); ?>"><span class="custom-btn-reg cbtn-yellow text-uppercase cbtn-shadow" style="margin-top: 20px;">RFC</span></a>
						<a href="<?php echo base_url('shipment-list'); ?>"><span class="custom-btn-reg cbtn-white text-uppercase cbtn-shadow" style="margin-top: 20px;">Shipments</span></a>
					 </div>
				  </div>
			   </div>
		   </div>
       </div>
	   <br/>
	   <div class="container">
       <div class="row">
          <div class="col-12 col-lg-12">
		  <h3 class="heading3-border text-uppercase">Request for Freight Comparative </h3><a style="float:right;" href="<?php echo base_url('shipping-requirement'); ?>" class="mdl-button  mdl-button--raised mdl-button--colored">Request For Freight</a>
		  <div class="table-responsive">
		  <?php //echo '<pre>'; print_r($FreightEnquiry);?>
             <table id="request_list" class="mdl-data-table" style="width:100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Shipment</th>
							<th>Mode</th>
							<th>Consignor</th>
							<th>Consignee</th>
							<th>Shipment Value</th>
							<th>Delivery Term</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($FreightEnquiry as $FreightEnq){ ?>
						<tr>
							<td>#<?php echo 'FE-'.$FreightEnq->fe_id; ?></td>
							<td><?php echo $FreightEnq->type; ?></td>
							<td><?php echo wordwrap($FreightEnq->pickup_address_1,15,"<br>\n"); ?></td>
							<td><?php echo wordwrap($FreightEnq->delivery_address_1,15,"<br>\n"); ?></td>
							<td><?php echo $FreightEnq->shipment; ?></td>
							<td><?php echo $FreightEnq->shipment_value." ".$FreightEnq->shipment_value_currency; ?></td>
							<td><?php echo $FreightEnq->name; ?></td>
							<td><a href="<?php echo base_url('freight-compare/'.$FreightEnq->fe_id); ?>" style="    background-color: green;" class="mdl-button  mdl-button--raised mdl-button--colored">Get Quotes</a></td>
						</tr>
						<?php } ?>
					</tbody>
					<tfoot>
						<tr>
							<th>ID</th>
							<th>Shipment</th>
							<th>Mode</th>
							<th>Consignor</th>
							<th>Consignee</th>
							<th>Shipment Value</th>
							<th>Delivery Term</th>
							<th>Action</th>
						</tr>
					</tfoot>
				</table>
			</div>
          </div>
       </div>
     </div>
   </div>
   <!-- Blog content end --> 
   <br/>
   <br/>