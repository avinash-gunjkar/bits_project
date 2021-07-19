<table id="request_list" class="mdl-data-table table-responsive" style="width:100%">
<thead>
	<tr>
		<th colspan="2">Basic Info</th>
		<th colspan="8">Order Details</th>
		<th colspan="3">Stakeholders</th>
		<th colspan="16">Shipment Details</th>
		<th colspan="4">Compliance Details</th>
		<th colspan="5">FF Invoice Details</th>
	</tr>
	<tr>
		<!--Basic Info-->
		<th>Sr.no.</th>
		<th>Date of Report</th>

		<!--Order Details-->
		<th>RFC ID</th>
		<th>RFC Date</th>
		<th>PO Number</th>
		<th>PO Line Item</th>
		<th>Invoice Number</th>
		<th>Invoice Date</th>
		<th>Invoice Value</th>
		<th>Invoice Currency</th>

		<!--Stakeholders-->
		<th>Consignor</th>
		<th>Consignee</th>
		<th>Freight Forwarder</th>

		<!--Shipment details-->
		<th>Transaction</th>
		<th>Mode</th>
		<th>D.Term</th>
		<th>Shipment</th>
		<th>G.W. (KG)</th>
		<th>BL/AWB Number</th>
		<th>BL/AWB Date</th>
		<th>Port Of Loading</th>
		<th>Port Of discharge</th>
		<th>ETD Origin Port</th>
		<th>ETA Destination Port</th>
		<th>BOE Number</th>
		<th>BOE Date</th>
		<th>BOE Type</th>
		<th>Delivery Date</th>
		<th>Status of Shipment</th>

		<!--Compliance detials-->
		<th>License Number, if any</th>
		<th>Custom Duty (INR)</th>
		<th>Duty NEFT Details</th>
		<th>Document submitted to Bank</th>

		<!-- FF Invoice Details-->
		<th>Quote Amount</th>
		<th>FF Invoice Number</th>
		<th>FF Invoice Value</th>
		<th>FF invoice Due Date</th>
		<th>FF Payment Status</th>
	</tr>
	</thead>
	<tbody>
		<?php foreach ($shippig_requirment_list as $key => $requirment) {
			$skipComparative = ($requirment->delivery_term_id == 1 && $requirment->transaction == 'Export') || (in_array($requirment->delivery_term_id, ['5', '6', '7']) && $requirment->transaction == 'Import');
		?>
			<tr>

				<!--Basic Info-->
				<td><?= $key + 1; ?></td>
				<td><?=printFormatedDate(date('Y-m-d'))?></td>

				<!--Order Details-->
				<td><?= $requirment->request_id; ?></td>
				<td><?= printFormatedDate($requirment->created_at); ?></td>
				<td><?=$requirment->so_number?></td>
				<td><?=$requirment->so_line_item?></td>
				<td><?= $requirment->commercial_invoice_number ?></td>
				<td><?= printFormatedDate($requirment->commercial_invoice_date) ?></td>
				<td><?= number_format($requirment->commercial_invoice_value,2) ?></td>
				<td><?= $requirment->commercial_invoice_currency ?></td>

				<!--Stakeholders-->
				<td><?php echo wordwrap($requirment->consignor_company_name, 15, "<br>"); ?></td>
				<td><?php echo wordwrap($requirment->consignee_company_name, 15, "<br>"); ?></td>
				<td><?=$requirment->ff_company_name?></td>

				<!--Shipment details-->
				<td><?= $requirment->transaction; ?></td>
				<td><?= $requirment->mode; ?></td>
				<td><?= $requirment->delivery_term_name; ?></td>
				<td><?= $requirment->shipment; ?></td>
				<td><?= $requirment->totalGW;?></td>
				<td><?= $requirment->bill_of_lading_number ?></td>
				<td><?= $requirment->bill_of_lading_date ? printFormatedDate($requirment->bill_of_lading_date) : '- -'; ?></td>
				<td><?= $requirment->port_loading_name ?></td>
				<td><?= $requirment->port_discharge_name ?></td>
				<td><?= $requirment->ETD ? printFormatedDate($requirment->ETD) : '- -'; ?></td>
				<td><?= $requirment->ETA ? printFormatedDate($requirment->ETA) : '- -'; ?></td>
				<td><?= $requirment->bill_of_entry_no ?></td>
				<td><?= $requirment->shipping_bill_date ? printFormatedDate($requirment->shipping_bill_date) : '- -'; ?></td>
				<td><?php if(strcasecmp($requirment->boe_type,'Regular')==0){
					
					echo $requirment->import_under_schment;
				}else{
					echo "Inbond:$requirment->import_under_schment_inbond <br> Exbond:$requirment->import_under_schment_exbond";
				}?>
				</td>
				<td><?= $requirment->deliverCompletedDate ? printFormatedDate($requirment->deliverCompletedDate) : '- -'; ?></td>
				<td><?php if($requirment->status=='5'){
					echo $requirment->tracking_status_title ? $requirment->tracking_status_title : '- -'; 
				}else{
					echo $requirment->status_title ? $requirment->status_title : '- -'; 
				}
				 
				 ?></td>

				<!--Compliance detials-->
				<td>
				<?php if(strcasecmp($requirment->boe_type,'Regular')==0){
					//import_under_schment_exbond
					echo $requirment->import_u_s_l_no;
				}else{
					echo "Inbond:$requirment->import_u_s_l_no_inbond <br> Exbond:$requirment->import_u_s_l_no_exbond";
				}?>
				</td>
				<td>
					<?php if(strcasecmp($requirment->boe_type,'Regular')==0){
						echo $requirment->import_duty_amount;
					}else{
						
						echo "Inbond:$requirment->import_duty_amount_inbond <br> Exbond:$requirment->import_duty_amount_exbond";
					}?>
				</td>
				<td>
					<?php if(strcasecmp($requirment->boe_type,'Regular')==0){
						echo $requirment->neft_payment_details;
					}else{
						
						echo "Inbond:$requirment->neft_payment_details_inbond <br> Exbond:$requirment->neft_payment_details_exbond";
					}?>
				</td>
				<td><?= printFormatedDate($requirment->document_submited_to_bank_date)?></td>

				<!-- FF Invoice Details-->
				<td><?= number_format($requirment->total_quote_amount,2) ?></td>
				<td><?= $requirment->invoice_number ?></td>
				<td><?= number_format($requirment->Invoice_amount,2) ?></td>
				<td><?= printFormatedDate($requirment->payment_due_date)?></td>
				<td><?= $requirment->bill_amount_received == '1' ? 'Received' : ($skipComparative ? 'Not Applicable' : 'Pending') ?></td>

			</tr>
		<?php } ?>
	</tbody>
</table>