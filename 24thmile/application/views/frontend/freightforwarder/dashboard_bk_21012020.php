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
    border-radius: 0% !important;
}
.section-title {
    text-align: left;
    padding-bottom: 0px;
   padding-top: 45px;
}
.wshipping-content-block {
    padding: 0px 0px;
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
			<!-- 		 <div class="section-title wow fadeInUp">
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
					 <div class="wow fadeInUp pt10 pull-right" >
						<a href="<?php echo base_url('freight-forwarder-dashboard'); ?>"><span class="custom-btn-reg cbtn-yellow text-uppercase cbtn-shadow" style="margin-top: 20px;">Dashboard</span></a>
						<a href="<?php echo base_url('freight-forwarder-profile'); ?>"><span class="custom-btn-reg cbtn-white text-uppercase cbtn-shadow" style="margin-top: 20px;">My Profile</span></a>
						<a href="<?php echo base_url('my-quotes'); ?>"><span class="custom-btn-reg cbtn-white text-uppercase cbtn-shadow" style="margin-top: 20px;">My Quotes</span></a>
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
             <div class="row">
			  <!-- Textbox Start -->
			  <div class="col-12 col-sm-3 col-lg-3">
				<div class="text-box text-center card-box" style="background-color: #ff5f9b;">
				<p style="font-size: 19px;"><?php echo $report_val->tot_ship_value; ?></p>
				<p style="font-size: 19px;">Total Shipment Amount</p>
				</div>
			  </div>
			  <div class="col-12 col-sm-3 col-lg-3">
				<div class="text-box text-center card-box" style="background-color: #a78891;">
				<p style="font-size: 19px;"><?php echo $report_val->tot_inv_amount; ?></p>
				<p style="font-size: 19px;">Total Invoice Amount </p></div>
			  </div>
			  <div class="col-12 col-sm-3 col-lg-3">
				<div class="text-box text-center card-box" style="background-color: #d25c7e;">
				<p style="font-size: 19px;"><?php echo $report_val->tot_meis_amount; ?></p>
				<p style="font-size: 19px;">Total MEIS Amount</p></div>
			  </div>
			  <!-- Textbox End -->
		   </div>
			<br/> 
          </div>
		  <div class="col-12 col-lg-12">
			 <div class="table-responsive">
                <table class="table card-box">
                 <thead>
                 <tr>
                            <th>Consignment No</th>
                            <th>Custom Invoice No</th>
                            <th>Commercial Invoice No</th>
                            <th>Com. Inv. Date</th>
							<th>Customer</th>
							<th>Currency</th>
							<th>Shipment Value</th>
                            <th>SB No.</th>
                            <th>SB Date</th>
							<th>BL No.</th>
                            <th>BL Date</th>
                            <th>ERBC No</th>
                            <th>DBK Amt.</th>
                            <th>DBK Status</th>
							<th>MEIS Rate</th>
							<th>MEIS Amt</th>
							<th>MEIS Status</th>
                            <th>Service Provider</th>
							<th>Bill Amt</th>
							<th>Bill Status</th>
                            <th>Action</th>
                        </tr>
               </thead>
               <tbody>
				<?php //echo '<pre>';print_r($report_data); 
					foreach ($report_data as $report_d) { ?> 
					<tr>
						<td><?php echo $report_d->booked_id; ?></td>
						<td><?php echo $report_d->custom_invoice_number; ?></td>
						<td><?php echo $report_d->commercial_invoice_number; ?></td>
						<td><?php echo date('d-M-Y',strtotime($report_d->commercial_invoice_date)); ?></td>
						<td><?php echo $report_d->firstname .' '.$report_d->lastname; ?></td>
						<td><?php echo $report_d->shipment_value_currency; ?></td>
						<td><?php echo $report_d->shipment_value; ?></td>
						<td><?php echo $report_d->shipping_bill_number; ?></td>
						<td><?php echo date('d-M-Y',strtotime($report_d->shipping_bill_date)); ?></td>
						<td><?php echo $report_d->bill_of_lading_number; ?></td>
						<td><?php echo date('d-M-Y',strtotime($report_d->bill_of_lading_date)); ?></td>
						<td><?php echo $report_d->ERBC_number; ?></td>
						<td><?php echo $report_d->DBK_amount; ?></td>
						<td><?php echo ($report_d->DBK_status == 1) ? 'Received' : 'Not Received'; ?></td>
						<td><?php echo $report_d->MEIS_rate; ?></td>
						<td><?php echo $report_d->MEIS_amount; ?></td>
						<td><?php echo ($report_d->MEIS_status == 1) ? 'Received' : 'Not Received'; ?></td>
						<td><?php echo $report_d->ffname .' '.$report_d->flname; ?></td>
						<td><?php echo $report_d->Bill_amount; ?></td>
						<td><?php echo ($report_d->Bill_status == 1) ? 'Received' : 'Not Received'; ?></td>
						<td></td>
					</tr>
					<?php  } ?>
                 
               </tbody>
              </table>
              </div>
			  <br/> <br/>
          </div>
		  </div>
       </div>
     </div>
   </div>
   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
   <!-- Blog content end --> 
   <script>
   $(window).scroll(function(e){
	  var $el = $('.promo-box'); 
	  var isPositionFixed = ($el.css('position') == 'fixed');
	  if ($(this).scrollTop() > 5 && !isPositionFixed){
		$('.promo-box').css({'position': 'fixed', 'top': '0px', 'box-shadow': '0 10px 25px 0 rgba(0,0,0,0.1)'});
		$('#header.is-sticky').hide();
	  }
	  if ($(this).scrollTop() < 5 && isPositionFixed)
	  {
		$('.promo-box').css({'position': 'static', 'top': '36%', 'box-shadow': 'none'});
		$('#header.is-sticky').show();
	  }
	});
   </script>