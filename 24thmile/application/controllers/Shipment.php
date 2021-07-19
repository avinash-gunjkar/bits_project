<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipment extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("Pdf");
		$this->load->model ('Shipment_model', 'SHIPMENT', TRUE); 
		
	}
	
	public function index()
	{	$data['shipment_list'] = $this->SHIPMENT->getList();
		$data['page'] = 'backend/shipment/index';
		$this->load->view('backend/layout_main', $data);
	}
	
	public function booked_shipments()
	{	$data['booked_shipment'] = $this->SHIPMENT->getBookedShipmentList();
		$data['page'] = 'backend/shipment/booked_shipments';
		$this->load->view('backend/layout_main', $data);
	}
 

	public function add()
	{	
		$err='';
        $msg='';
		if($this->input->post() && $this->input->is_ajax_request()){
			$shipment_type = $this->input->post('shipment_type');

			if(!$shipment_type){
				$err = "Shipment Type is Not provided";
			}

			if(empty($err) && $err==''){
				$dbOject = array(
								'type' => $shipment_type,
								'created_at' => date("Y-m-d H:i:s"),
								'updated_at' => date("Y-m-d H:i:s")
								);
				
				if($this->SHIPMENT->insert($dbOject)){
					$msg = "Shipment <b>".$shipment_type."</b> added successfully.";
					echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>$shipment_type)); 
					return true;
				}
			}else{
				echo json_encode(array('status'=>0,'msg'=>$err,'data'=>null)); 
				return true;
			}
		}
		$data['page'] = 'backend/shipment/add';
		$this->load->view('backend/layout_main', $data);		
	}
	
	public function raise_invoice()
	{	
		$err='';
        $msg='';
		
		if($this->input->post() && $this->input->is_ajax_request()){
			
			$book_id = $this->input->post('book_id');
			$total_amount = $this->input->post('total_amount');
			$raise_amount = $this->input->post('raise_amount');
			$raise_against = $this->input->post('raise_against');
			$balance_amount = $this->input->post('balance_amount');
			$payment_type = $this->input->post('payment_type');
			$gstin_number = $this->input->post('gstin_number');
			$invoice_type = $this->input->post('invoice_type');

			if(!$raise_amount){
				$err = "Raised amount should not be empty";
			}

			if(empty($err) && $err==''){
				
				$fileinvoicePath = 'rfc-'.$book_id.'-'.date('Ymdhm').'.pdf';
				
				$dbOject = array(
							'book_id' => $book_id,
							'raise_against' => $raise_against,
							'raise_amount' => $raise_amount,
							'total_amount' => $total_amount,
							'balance_amount' => $balance_amount,
							'payment_type' => $payment_type,
							'gstin' => $gstin_number,
							'invoice_type' => $invoice_type,
							'invoice_url' => base_url('uploads/Invoices/'.$fileinvoicePath),
							'created_at' => date("Y-m-d H:i:s"),
							'updated_at' => date("Y-m-d H:i:s")
							);
							
				$insert_id = $this->SHIPMENT->insertRaiseInvoice($dbOject);
				
				if($insert_id){
					
					$this->create_pdf($book_id, $insert_id, $fileinvoicePath);
					
					$msg = "Invoice Raised for Amount <b>".$raise_amount."</b> .";
					echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>$raise_amount)); 
					return true;
				}
			}else{
				echo json_encode(array('status'=>0,'msg'=>$err,'data'=>null)); 
				return true;
			}
		}
		
		$data['page'] = 'backend/shipment/raise_invoice';
		$this->load->view('backend/layout_main', $data);		
	}

	public function edit($id)
	{ 
		
		if($this->input->post() && $this->input->is_ajax_request()){
			$shipment_id = $this->input->post('shipment_id');
			$shipment_type = $this->input->post('shipment_type');
			if ($this->input->post('isActive') == 'on') {
				$isActive = 1;
			}
			else{
				$isActive = 0;
			}

			$dbOject = array(
								'type' => $shipment_type,
								'isActive' => $isActive, 
								'updated_at' => date("Y-m-d H:i:s")
							);

			if($this->SHIPMENT->update($shipment_id,$dbOject)){
				$msg = 'Shipment '.$shipment_type .' updated successfully.';
				echo json_encode(array('status'=>1,'msg'=>$msg,'data'=>$shipment_type)); 
				return true;
			}else{
				$msg = 'Shipment '.$shipment_type .' failed to updated.';				
				echo json_encode(array('status'=>0,'msg'=>$msg,'data'=>$shipment_type)); 
				return true;
			}
		}

		$shipment_data = $this->SHIPMENT->getRecord($id);
		if($shipment_data){
			$data['shipment_data'] = $shipment_data;
			$data['page'] = 'backend/shipment/edit';
			$this->load->view('backend/layout_main', $data);
		}else{
			$data['page'] = 'backend/shipment/edit';
			$this->load->view('backend/layout_main', $data);
		}
	}

	public function changeStatus()
	{
		$id = $this->input->post('id');
		$isActive = $this->input->post('isActive');

		$dbOject = array(
						'isActive' => $isActive, 
						'updated_at' => date("Y-m-d H:i:s") 
						);
	
		$mesg_sub = $isActive == 1 ? 'Activated' : 'Deactivated';
		$shipment_data = $this->SHIPMENT->getRecord($id);	
		$msg = $shipment_data['type'].' '.$mesg_sub ;	
		if($this->SHIPMENT->update($id,$dbOject)){			
			echo json_encode(array('status'=>1,'msg'=>$msg));
		}else{
			 echo json_encode(array('status'=>0,'msg'=>$msg));			 
		}

	}
	
	 public function create_pdf($book_id,$invoice_id,$filename) {
		 $shpmData = array();
		$shpmData = $this->SHIPMENT->getBookedShipmentList($book_id);
		$invoiceData = $this->SHIPMENT->getBookedShipmentInvoice($book_id, $invoice_id);
		//echo '<pre>';print_r($shpmData);die;
		// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 061', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();
$company_name = $shpmData->company_name;
$cust_name = $shpmData->salutation .' '.$shpmData->firstname .' '.$shpmData->lastname;
$cust_address = $shpmData->pickup_address_1;
$cust_state = $shpmData->pickup_state;
$cust_city = $shpmData->pickup_city;
$cust_pin = $shpmData->pickup_pin;
$cust_phone = $shpmData->phone;
$tomail = $shpmData->femail;

$raise_against = $invoiceData->raise_against;
$raise_amount = $invoiceData->raise_amount;
$total_amount = $invoiceData->total_amount;
$balance_amount = $invoiceData->balance_amount;
$gstin = $invoiceData->gstin;
$invno = $invoiceData->id;
$consgno = $invoiceData->book_id;
$payment_type = $invoiceData->payment_type;
$invoice_type = $invoiceData->invoice_type;
$cgst = ($raise_amount*(9/100));
$sgst = ($raise_amount*(9/100));
$gst =($cgst+$sgst);
$grand_total = $gst+$raise_amount;


$logopath = base_url('assets/frontend/images/logo-v6.png');

$html = <<<EOF
<style>
 .invoice-box {
        max-width: 1000px;
        margin: auto;
        padding: 40px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 14px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        //text-align: left;
    }
    
    .invoice-box table td {
        padding: 15px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: left;
    }
    
    .invoice-box table tr.top table td {
        padding: 50px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        color: #333;
		text-align:center;
    }
    
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
   
</style>

<div class="invoice-box">
        <table cellpadding="8" cellspacing="3">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title" align="center">
                                <img src="$logopath" style="width:200px;">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
							<td width="10%" align="left" style="font-size:13px;">Customer: <br>Company: <br>Address:<br>City:<br>State:<br>Tel/Fax:<br>GST No.:
                            </td>
                            <td width="60%" align="left" style="font-size:13px;">$cust_name<br>$company_name<br>$cust_address,<br> $cust_city - $cust_pin <br> $cust_state ;<br> $cust_phone <br> $gstin
                            </td>
                            <td width="30%" align="right">
								$invoice_type Invoice No #: $invno<br>
                                Date: January 1, 2015<br>
                                Delivery: Immediate<br>
                                Payment: $payment_type
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td width="10%" style="border:1px solid #efefef;">
                    Sr. No.
                </td>
                <td width="60%" style="border:1px solid #efefef;">
                    Particular
                </td>
                <td align="right" width="30%" style="border:1px solid #efefef;">
                    Total(value in INR)
                </td>
            </tr>
            
            <tr class="details">
                <td style="border:1px solid #efefef;">
                    1
                </td>
                <td style="border:1px solid #efefef;">
                    $raise_against						
                </td>
                <td align="right" style="border:1px solid #efefef;">
                    $raise_amount
                </td>
            </tr>
			<tr class="total">
                <td></td>
                <td align="right">Sub Total</td>
                <td align="right" style="border:1px solid #efefef;">
                   $cgst
                </td>
            </tr>
            <tr class="total">
                <td></td>
                <td align="right">SGST (9%) </td>
                <td align="right" style="border:1px solid #efefef;">
                   $sgst
                </td>
            </tr>
			<tr class="total">
                <td></td>
                <td align="right">CGST (9%) </td>
                <td align="right" style="border:1px solid #efefef;">
                   $gst
                </td>
            </tr>
			<tr class="total">
                <td></td>
                <td align="right"><b>Grand Total</b></td>
                <td align="right" style="border:1px solid #efefef;">
                   <b>$grand_total</b>
                </td>
            </tr>
			<tr class="information">
                <td colspan="2">
                    <table width="100%">
                        <tr>
							<td width="60%" align="left" style="font-size:13px;">
								TEMGIRE Consultancy Services Pvt Ltd <br>HDFC Bank Ltd<br>S.No.56/1, Kawade Nagar<br>New Sangavi, Pune-411027. INDIA<br>CA No. 50200033008212; <br>IFSC: HDFC0000900<br>PAN: AAFCT4541F; TAN: PNET10300D<br>GSTIN: 27AAFCT4541F1ZE<br>MSME No. 547532579593<br>SAC Code: 9971
                            </td>
							<td width="40%" align="left" style="font-size:13px;">
								
                            </td>
							<td width="40%" align="left" style="font-size:13px;">
								
                            </td>
                        </tr>
						<tr>
							<td align="left">
								
                            </td>
						</tr>
						<tr>
							<td colspan="3" align="center" style="border:1px solid #efefef;">
								• Office Address • <br>
								<span style="font-size:12px;">103, Chandrang Silver, Javalkarnagar, Pimple Gurav, Pune-411061. INDIA.<br>
								Phone: +91 77090 65277; Mobile: +91 73500 17207; E-mail: info@temgire.com <br>
								CIN U74999PN2015PTC156121</span>
                            </td>
						</tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
EOF;
		//echo $tbl;die;
		$pdf->writeHTML($html, true, false, false, false, '');
		
		$dir_filepath = FCPATH.'/uploads/Invoices/'.$filename;
		@ob_clean();
		$pdf->Output($dir_filepath, 'F');
		$filepth = base_url('uploads/Invoices/'.$filename);
		$this->sendInvoiceMail($filepth,$tomail);
		return true;
		//$pdf->Output('example_048.pdf', 'I');	

    }
	
	function sendInvoiceMail($filepth,$to)
    {
		$this->load->library('email');
		$subject = "24thmile Payment Invoice";
		$message = "Dear Customer,<br/><br/> We are personally update you regarding your outstanding balance as per attached Invoice below: <br/><br/><small>if attachement is missing please <a href=".$filepth." target='_blank'>click here</a></small><br/><br/><br/>  Thanks <br/> 24thmile Team";
					
		$config['protocol']    = 'smtp';
		$config['smtp_host']    = 'ssl://smtp.gmail.com';
		$config['smtp_port']    = '465';
		$config['smtp_timeout'] = '7';
		$config['smtp_user']    = 'info.24thmile@gmail.com';
		$config['smtp_pass']    = 'info@24th';
		$config['charset']    = 'utf-8';
		$config['newline']    = "\r\n";
		$config['mailtype'] = 'html';

		$this->email->initialize($config);
		
        $this->email->from('info.24thmile@gmail.com', '24thMile');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
		$this->email->attach($filepth);
        $this->email->send();
		return true;
    }
}