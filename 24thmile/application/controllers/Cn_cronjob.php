<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cn_cronjob extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();


        $this->load->model('seller_model');
        $this->load->model('company_model');
        $this->load->model('freight_model');
    }

    public function send_reminder_rfc()
    {
        //Pending reply to Freight Inquiries.
        $query = "
        SELECT `t1`.`ff_company_id` FROM `tbl_seller_requirement_mapp_ff` AS `t1`
        WHERE `t1`.`created_at` < now()- INTERVAL 1 DAY and `quote_status`='2' GROUP BY  `t1`.`ff_company_id` ";
        $result = $this->db->query($query);

        foreach ($result->result() as $row) {
            // echo "<pre style='border:1px solid #000;padding:10px;'>";
            // print_r($row);
            // echo "</pre>";
            $query_ff = "
            SELECT * FROM `tbl_users`
            WHERE  `company_id` = $row->ff_company_id AND `role`='3' AND `isActive`='1' AND `company_role`='super_user' ";
            $result_ff = $this->db->query($query_ff);
            $ff_details = $result_ff->row();

            $query2 = "
            SELECT `t3`.name as exporter_importer_name,`t1`.* FROM `tbl_seller_requirement_mapp_ff` AS `t1`
            INNER JOIN `tbl_seller_requirement` AS `t2` ON `t1`.`request_id` = `t2`.`id` 
            INNER JOIN `tbl_company` AS `t3` ON `t2`.`fs_company_id` = `t3`.`id` 
            WHERE `t1`.`created_at` < now()- INTERVAL 1 DAY and `quote_status`='2' AND  `t1`.`ff_company_id` = $row->ff_company_id ";
            $result2 = $this->db->query($query2);
            $pendingRfcList = $result2->result();
            $table = $this->load->view('backend/cronjob-templates/pending-rfc-request',['list'=>$pendingRfcList],true);
            
            $name = $ff_details->salutation . ' ' . $ff_details->firstname . ' ' . $ff_details->lastname;
            //$url = base_url('edit-request-details/' . $row->request_id);
            sendEmail_reminder_rfc($ff_details->email, $name, $table);
        }
    }

    public function send_reminder_awarded()
    {
        //Reminder for accept shipment.
        $query = "
        SELECT `t1`.`ff_company_id` FROM `tbl_seller_requirement_mapp_ff` AS `t1`
        WHERE `t1`.`awarded_dt` < now()- INTERVAL 1 DAY and `quote_status`='4' GROUP BY  `t1`.`ff_company_id` ";
        $result = $this->db->query($query);


        foreach ($result->result() as $row) {
            //  echo "<pre style='border:1px solid #000;padding:10px;'>";
            //             print_r($row);
            //             echo "</pre>";

            $query_ff = "
            SELECT * FROM `tbl_users`
            WHERE  `company_id` = $row->ff_company_id AND `role`='3' AND `isActive`='1' AND `company_role`='super_user' ";
            $result_ff = $this->db->query($query_ff);
            $ff_details = $result_ff->row();

            $query2 = "
            SELECT `t3`.name as exporter_importer_name,`t1`.* FROM `tbl_seller_requirement_mapp_ff` AS `t1`
            INNER JOIN `tbl_seller_requirement` AS `t2` ON `t1`.`request_id` = `t2`.`id` 
            INNER JOIN `tbl_company` AS `t3` ON `t2`.`fs_company_id` = `t3`.`id` 
            WHERE `t1`.`created_at` < now()- INTERVAL 1 DAY and `quote_status`='4' AND  `t1`.`ff_company_id` = $row->ff_company_id ";
            $result2 = $this->db->query($query2);
            $pendingRfcList = $result2->result();
            $table = $this->load->view('backend/cronjob-templates/pending-rfc-request',['list'=>$pendingRfcList],true);
            
            $name = $ff_details->salutation . ' ' . $ff_details->firstname . ' ' . $ff_details->lastname;
            $url = base_url('edit-request-details/' . $ff_details->request_id);
             @sendEmail_reminder_awarded($ff_details->email, $name, $table);
            
        }
    }

    public function send_status_report_fs()
    {
        //get fs list
        $query = "
        SELECT `t2`.`company_id`,`t2`.`salutation`,`t2`.`firstname`,`t2`.`lastname`,`t2`.`email` FROM `tbl_users` AS `t2`
         WHERE  `t2`.`role`='2' AND `t2`.`isActive`='1' ";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {

            // echo "<pre style='border:1px solid #000;padding:10px;'>";
            // print_r($row);
            // echo "</pre>";
            //send export report
            $transaction = "Export";

            $data['company_id'] = $row->company_id;
            $data['reportType'] = $transaction;

            $toDate = $_GET['to_dt'] ? getMysqlDateFormat($_GET['to_dt']) : date('Y-m-d');
            $fromDate = $_GET['from_dt'] ? getMysqlDateFormat($_GET['from_dt']) : date('Y-m-d', strtotime('-7 days ' . $toDate));

            $data['from_dt'] = printFormatedDate($fromDate);
            $data['to_dt'] = printFormatedDate($toDate);

            $data['shippig_requirment_list'] = $this->seller_model->getReportList($row->company_id, $transaction, $fromDate, $toDate);
            $data['fs_details'] = $this->seller_model->getFS_DetailsByCompanyId($row->company_id);
            if (!empty($data['shippig_requirment_list'])) {
                $this->fs_send_report($data);
            }
            //send import report
            $transaction = "Import";

            $data['reportType'] = $transaction;

            $data['shippig_requirment_list'] = $this->seller_model->getReportList($row->company_id, $transaction, $fromDate, $toDate);
            // $data['fs_details'] = $this->seller_model->getFS_DetailsByCompanyId($row->company_id);
            if (!empty($data['shippig_requirment_list'])) {
                $this->fs_send_report($data);
            }
        }
    }

    public function fs_send_report($data)
    {


        $this->load->library('Excel');
        PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
        //              $this->load->library('Excel_io_factory');
        $objPHPExcel = new PHPExcel();
        $filename = $data['reportType'] . "_report_" . date('Ymd') . ".xls";


        $tmpfile = tempnam(sys_get_temp_dir(), 'html');
        file_put_contents($tmpfile, $this->load->view('frontend/seller/reports_template', $data, true));
        $excelHTMLReader = PHPExcel_IOFactory::createReader('HTML');
        $excelHTMLReader->loadIntoExisting($tmpfile, $objPHPExcel);
        $objPHPExcel->getActiveSheet()->setTitle('Report'); // Change sheet's title if you want
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $lastCol = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
        $lastRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
        $objPHPExcel->getActiveSheet()->getStyle("A6:$lastCol" . '6')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("A6:$lastCol" . $lastRow)->applyFromArray($styleArray);
        unset($styleArray);

        foreach (range('A', 'P') as $columnID) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }


        unlink($tmpfile); // delete temporary file because it isn't needed anymore

        $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $tmpfileExcelfile = tempnam(sys_get_temp_dir(), 'report');
        $writer->save($tmpfileExcelfile);
        $arrAttachments = array();
        $arrAttachments = [$tmpfileExcelfile];

        $fs_details = $this->seller_model->getFS_DetailsByCompanyId($data['company_id']);
        $mailSend = @sendEmail_report($fs_details->email, $fs_details->name, $data['reportType'], $data['from_dt'], $data['to_dt'], $arrAttachments);
        $arrAttachments = null;
        unlink($tmpfileExcelfile);
    }


    public function send_status_report_ff()
    {
        //get fs list
        $query = "
        SELECT `t2`.`company_id`,`t2`.`salutation`,`t2`.`firstname`,`t2`.`lastname`,`t2`.`email` FROM `tbl_users` AS `t2`
         WHERE  `t2`.`role`='3' AND `t2`.`isActive`='1' ";
        $result = $this->db->query($query);
        foreach ($result->result() as $row) {

            //send export report
            $transaction = "Export";

            $data['company_id'] = $row->company_id;
            $data['reportType'] = $transaction;

            $toDate = $_GET['to_dt'] ? getMysqlDateFormat($_GET['to_dt']) : date('Y-m-d');
            $fromDate = $_GET['from_dt'] ? getMysqlDateFormat($_GET['from_dt']) : date('Y-m-d', strtotime('-7 days ' . $toDate));

            $data['from_dt'] = printFormatedDate($fromDate);
            $data['to_dt'] = printFormatedDate($toDate);

            $data['shippig_requirment_list'] = $this->freight_model->getReportList($row->company_id, $transaction, $fromDate, $toDate);
            $data['ff_details'] = $this->seller_model->getFF_DetailsByCompanyId($row->company_id);

            if (!empty($data['shippig_requirment_list'])) {

                $this->ff_send_report($data);
            }

            //send import report
            $transaction = "Import";

            $data['reportType'] = $transaction;

            $data['shippig_requirment_list'] = $this->freight_model->getReportList($row->company_id, $transaction, $fromDate, $toDate);
            // $data['ff_details'] = $this->seller_model->getFF_DetailsByCompanyId($row->company_id);
            if (!empty($data['shippig_requirment_list'])) {
                $this->ff_send_report($data);
            }
        }
    }

    public function ff_send_report($data)
    {

        $this->load->library('Excel');
        PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
        //              $this->load->library('Excel_io_factory');
        $objPHPExcel = new PHPExcel();
        $filename = $data['reportType'] . "_report_" . date('Ymd') . ".xls";


        $tmpfile = tempnam(sys_get_temp_dir(), 'html');
        file_put_contents($tmpfile, $this->load->view('frontend/freightforwarder/reports_template', $data, true));
        $excelHTMLReader = PHPExcel_IOFactory::createReader('HTML');
        $excelHTMLReader->loadIntoExisting($tmpfile, $objPHPExcel);
        $objPHPExcel->getActiveSheet()->setTitle('Report'); // Change sheet's title if you want
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $lastCol = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
        $lastRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
        $objPHPExcel->getActiveSheet()->getStyle("A6:$lastCol" . '6')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle("A6:$lastCol" . $lastRow)->applyFromArray($styleArray);
        unset($styleArray);

        foreach (range('A', 'P') as $columnID) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }


        unlink($tmpfile); // delete temporary file because it isn't needed anymore

        $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $tmpfileExcelfile = tempnam(sys_get_temp_dir(), 'report');
        $writer->save($tmpfileExcelfile);
        $arrAttachments = array();
        $arrAttachments = [$tmpfileExcelfile];

        $ff_details = $this->seller_model->getFF_DetailsByCompanyId($data['company_id']);
        $mailSend = sendEmail_report($ff_details->email, $ff_details->name, $data['reportType'], $data['from_dt'], $data['to_dt'], $arrAttachments);
        $arrAttachments = null;
        unlink($tmpfileExcelfile);
    }

    public function sendDailyInvoiceReport(){
       
        $report = '';
        $date = date('Y-m-d',strtotime("-1 days"));
        $query = "
        SELECT * FROM `tbl_revenue_inv_list` WHERE inv_type = 'invoice' AND CAST(ondatetime AS DATE) = '$date'";
        $result = $this->db->query($query);

        $data['heading'] = "Invoice";
        $data['invoices'] = $result->result();
       

        $report = $this->load->view('backend/cronjob-templates/invoice-template',$data,true);

        $query = "
        SELECT * FROM `tbl_revenue_inv_list` WHERE inv_type = 'proforma' AND CAST(ondatetime AS DATE) = '$date'";
        $result = $this->db->query($query);

        $data['heading'] = "Proforma Invoice";
        $data['invoices'] = $result->result();
        $report .= $this->load->view('backend/cronjob-templates/invoice-template',$data,true);



        $this->load->library('Excel');
        PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
        //              $this->load->library('Excel_io_factory');
        $objPHPExcel = new PHPExcel();
        $filename = "invoice_report_" . date('Ymd',strtotime($date)) . ".xls";


			$tmpfile = tempnam(sys_get_temp_dir(), 'html');
			file_put_contents($tmpfile, $report);
			$excelHTMLReader = PHPExcel_IOFactory::createReader('HTML');
			$excelHTMLReader->loadIntoExisting($tmpfile, $objPHPExcel);
			$objPHPExcel->getActiveSheet()->setTitle('Report'); // Change sheet's title if you want
			$styleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			);

			$lastCol = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
			$lastRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
			$objPHPExcel->getActiveSheet()->getStyle("A1:$lastCol" . '6')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle("A1:$lastCol" . $lastRow)->applyFromArray($styleArray);
			unset($styleArray);

			foreach (range('A', 'P') as $columnID) {
				$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
			}


			unlink($tmpfile); // delete temporary file because it isn't needed anymore

            $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $tmpfileExcelfile = tempnam(sys_get_temp_dir(), 'report');
            $writer->save($tmpfileExcelfile);
            $arrAttachments = [$tmpfileExcelfile];

       echo sendEmail_dailyInvoiceReport($date, $report,$arrAttachments);
       unlink($tmpfileExcelfile);
    

    }

    public function sendDailyReportPendingKYC(){
        $data['heading']='Pending KYC list.';
        $data['list'] = $this->company_model->getKycDocumentList(['status'=>'0']);
       
       $listTable = $this->load->view('backend/cronjob-templates/pending-kyc',$data,true);
      
       sendEmail_pending_kyc($listTable);
    }
}
