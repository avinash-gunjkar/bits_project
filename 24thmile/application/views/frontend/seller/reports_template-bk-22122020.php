<table>
	<tr>
		<td colspan="2">Date</td>
		<td colspan="3" style="text-align: left"><?= printFormatedDate(date('Y-m-d')) ?></td>

	</tr>
	<tr>
		<td colspan="2">ID No.</td>
		<td colspan="3" style="text-align: left"><?= $fs_details->user_id ?></td>
	</tr>
	<tr>
		<td colspan="5" style="text-align: left"><?= $fs_details->name ?></td>
	</tr>
	<tr>
		<td colspan="3" style="text-align: left"><?= $reportType ?> Shipment Status: </td>
		<td colspan="5" style="text-align: left">Period From <?= printFormatedDate($from_dt) ?> to <?= printFormatedDate($to_dt) ?></td>
	</tr>
</table>
<table id="request_list" style="border:1px solid #000">
	<thead>
		<tr>
			<th class="text-left">Sr. No.</th>
			<th class="text-left" style="font-weight: bold">RFC ID</th>
			<th class="text-left">RFC Date</th>
			<th class="text-left">Mode</th>
			<th class="text-left">D.Term</th>
			<th class="text-left">Shipment</th>
			<th class="text-right">Invoice Value</th>
			<?php if ($reportType == 'Export') { ?>
				<th class="text-left">Custom Inv</th>
				<th class="text-left">Custom Inv Date</th>
				<th class="text-left">Custom Inv Value</th>
				<th class="text-left">Custom Inv Currency</th>
				<th class="text-left">Consignor</th>
				<th class="text-right">DBK in (INR)</th>
				<th class="text-right">DBK Payment Status</th>
				<th class="text-right">MEIS Incentive</th>
				<th class="text-right">MEIS Payment</th>
				<th class="text-left">SB Number</th>
				<th class="text-left">SB Date</th>
			<?php } ?>
			<?php if ($reportType == 'Import') { ?>
				<th class="text-left">Comm Inv</th>
				<th class="text-left">Comm Inv Date</th>
				<th class="text-left">Comm Inv Value</th>
				<th class="text-left">Comm Inv Currency</th>
				<th class="text-left">Consignee</th>
				<th class="text-left">Importer Under any Incentive Scheme</th>
				<!-- <th class="text-left">Foreign Trade Policy Compliance, if any </th> -->
				<th class="text-left">Closed Advance License/EPCG or other license if any </th>
				<th class="text-left">BOE Number</th>
				<th class="text-left">BOE Date</th>
			<?php } ?>
			<th class="text-right">BL/AWB Number</th>
			<th class="text-right">BL/AWB Date</th>
			<th class="text-right">FF Name</th>
			<th class="text-right">FF Invoice Value</th>
			<th class="text-right">FF Payment Status</th>
			<th class="text-right">Status</th>

		</tr>
	</thead>
	<tbody>
		<?php foreach ($shippig_requirment_list as $key => $requirment) {
			$skipComparative = ($requirment->delivery_term_id == 1 && $requirment->transaction == 'Export') || (in_array($requirment->delivery_term_id, ['5', '6', '7']) && $requirment->transaction == 'Import');
		?>
			<tr>
				<td class="text-left"><?php echo $key + 1; ?></td>
				<td class="text-left"><?php echo $requirment->request_id; ?></td>
				<td class="text-left"><?= printFormatedDate($requirment->created_at); ?></td>
				<td class="text-left"><?php echo $requirment->mode; ?></td>
				<td class="text-left"><?php echo $requirment->delivery_term_name; ?></td>
				<td class="text-left"><?php echo $requirment->shipment; ?></td>
				<!-- <td class="text-right"><?php echo $requirment->shipment_value_currency . ' ' . number_format($requirment->shipment_value) ?></td> -->
				<td class="text-right"><?php echo number_format($requirment->Invoice_amount) ?></td>
				<?php if ($reportType == 'Export') { ?>
					<td class="text-left"><?= $requirment->custom_invoice_number ?></td>
					<td class="text-left"><?= printFormatedDate($requirment->custom_invoice_date) ?></td>
					<td class="text-left"><?= $requirment->custom_invoice_value ?></td>
					<td class="text-left"><?= $requirment->custom_invoice_currency ?></td>
					<td class="text-left"><?php echo wordwrap($requirment->consignor_company_name, 15, "<br>"); ?></td>
					<td class="text-right"><?php echo number_format($requirment->DBK_amount) ?></td>
					<td class="text-right"><?= $requirment->DBK_status == '1' ? 'Received' : 'Pending' ?></td>
					<td class="text-right"><?php echo number_format($requirment->MEIS_amount) ?></td>
					<td class="text-right"><?= $requirment->MEIS_status == '1' ? 'Received' : 'Pending' ?></td>
					<td class="text-right"><?= $requirment->shipping_bill_number ?></td>
					<td class="text-right"><?= $requirment->shipping_bill_date ? printFormatedDate($requirment->shipping_bill_date) : '- -'; ?></td>

				<?php } ?>
				<?php if ($reportType == 'Import') { ?>
					<td class="text-left"><?= $requirment->commercial_invoice_number ?></td>
					<td class="text-left"><?= printFormatedDate($requirment->commercial_invoice_date) ?></td>
					<td class="text-left"><?= $requirment->commercial_invoice_value ?></td>
					<td class="text-left"><?= $requirment->commercial_invoice_currency ?></td>
					<td class="text-left"><?php echo wordwrap($requirment->consignee_company_name, 15, "<br>"); ?></td>
					<td class="text-left"><?= $requirment->import_under_schment ?></td>
					<td class="text-left"><?= $requirment->foreign_trade_policy_compliance ? 'Done' : 'Pending' ?></td>
					<td class="text-right"><?= $requirment->bill_of_entry_no ?></td>
					<td class="text-right"><?= $requirment->bill_of_entry_date ? printFormatedDate($requirment->bill_of_entry_date) : '- -'; ?></td>

				<?php } ?>
				<td class="text-right"><?= $requirment->bill_of_lading_number ?></td>
				<td class="text-right"><?= $requirment->bill_of_lading_date ? printFormatedDate($requirment->bill_of_lading_date) : '- -'; ?></td>

				<td class="text-right"><?= $requirment->ff_company_name ?></td>
				<td class="text-right"><?php echo number_format($requirment->Invoice_amount) ?></td>
				<td class="text-right"><?= $requirment->bill_amount_received == '1' ? 'Received' : ($skipComparative ? 'Not Applicable' : 'Pending') ?></td>
				<td class="text-right"><?php echo $requirment->status_title ? $requirment->status_title : '- -'; ?>
				</td>



			</tr>
		<?php } ?>
	</tbody>

</table>