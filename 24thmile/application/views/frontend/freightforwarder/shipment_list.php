
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
       <div class="row" style="background-image: url('<?php echo base_url('assets/frontend/images/bg-header.jpg'); ?>');background-repeat: no-repeat;background-position: center;">
		   <div class="container">
			   <div class="row">
				  <div class="col-12 col-lg-4">
					<br/>
					<span style="font-size:22px;color: #f25859;"><?php echo $myProfile->company_name; ?></span>
					<span class="text-white">( <i><?php echo ($myProfile->role == 2) ? 'Seller':'Freight Forwarder'; ?></i> ) </span>
<!-- 					 <div class="section-title wow fadeInUp">
						<div class="comment-img">
						<?php if($myProfile->profile_pic){ ?>
						<img src="<?php //echo $myProfile->profile_pic; ?>" alt="" />
						<?php }else{ ?>
						<img src="<?php //echo base_url('assets/frontend/images/comment-pic1.jpg'); ?>" alt="" />
						<?php } ?>
						</div>
						 <h4 class="text-white" style="margin-top:0px !important;margin-bottom:40px !important;"><?php//echo $myProfile->company_name; ?></h4>
					 </div> -->
				  </div>
				  <div class="col-12 col-lg-8">
					 <div class="wow fadeInUp pt10 pull-right">
						<a href="<?php echo base_url('freight-forwarder-dashboard'); ?>"><span class="custom-btn-reg cbtn-white text-uppercase cbtn-shadow" style="margin-top: 20px;">Dashboard</span></a>
						<a href="<?php echo base_url('freight-forwarder-profile'); ?>"><span class="custom-btn-reg cbtn-white text-uppercase cbtn-shadow" style="margin-top: 20px;">My Profile</span></a>
						<a href="<?php echo base_url('my-quotes'); ?>"><span class="custom-btn-reg cbtn-yellow text-uppercase cbtn-shadow" style="margin-top: 20px;">My Quotes</span></a>
						<a href="<?php echo base_url('shipment-list-ff'); ?>"><span class="custom-btn-reg cbtn-white text-uppercase cbtn-shadow" style="margin-top: 20px;">Shipments</span></a>
					 </div>
				  </div>
			   </div>
		   </div>
       </div>
	   <br/>
	   <div class="container">
       <div class="row">
          <div class="col-12 col-lg-12">
		  <h3 class="heading3-border text-uppercase">Shipment List</h3>
		  <div class="table-responsive">
		  <?php //echo '<pre>'; print_r($bookedShipment);?>
             <table id="request_list" class="mdl-data-table" style="width:100%" >
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
						<?php foreach($bookedShipment as $bookedShip){
							
						if($bookedShip->transaction == 'Export'){
							$trans = 1;
						}else{
							$trans = 2;
						}
						
						?>
						<tr>
							<td>#<?php echo 'RFC-'.$bookedShip->rfc_id; ?></td>
							<td><?php echo $bookedShip->type; ?></td>
							<td><?php echo wordwrap($bookedShip->pickup_address_1,15,"<br>\n"); ?></td>
							<td><?php echo wordwrap($bookedShip->delivery_address_1,15,"<br>\n"); ?></td>
							<td><?php echo $bookedShip->shipment; ?></td>
							<td><?php echo $bookedShip->shipment_value." ".$bookedShip->shipment_value_currency; ?></td>
							<td><?php echo $bookedShip->name; ?></td>
							<td>
								<div class="language">
								   <ul>
									<li class=""><a href="#" title="" class="dropdown-toggle btn btn-primary" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Action</a>
									  <ul class="dropdown-menu" style="top: 0% !important;">
										<li><a href="<?php echo base_url('view-shipment-tracking-ff/'.$trans.'/'.$bookedShip->booked_id); ?>" title="">View Details</a></li>
										<li><a href="<?php echo base_url('shipment-tracking-ff/'.$trans.'/'.$bookedShip->booked_id); ?>" title="">Shipment Tracking</a></li>
										<li><a href="#" title=""></a></li>
									 </ul>
									</li>
								   </ul>
								</div>
							</td>
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