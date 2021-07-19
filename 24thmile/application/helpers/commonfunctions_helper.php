<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function cleanString($string)
{
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

    return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}

function slugifyString($string)
{
    $str =  preg_replace('/\s+/', '-', $string); //replace space with -
    $str =  preg_replace('/[^\w\-]+/', '', $str); //remove all non-word character
    $str =  preg_replace('/\-\-+/', '-', $str); //replace multiple -  with single -
    $str =  preg_replace('/^-+/', '', $str); //trim - from start of text
    $str =  preg_replace('/-+$/', '', $str); //trim - from end of text

    return strtolower($str);
}

function printFormatedDate($date)
{
    trim($date);
    if (empty($date)) {
        return null;
    }
    return date('d-M-Y', strtotime($date));
}

function printFormatedDateTime($dateTime)
{
    $dateTime = trim($dateTime);
    if (empty($dateTime)) {
        return null;
    }
    return date('d-M-Y h:i a', strtotime($dateTime));
}

function getMysqlDateFormat($date)
{
    trim($date);
    if (empty($date)) {
        return null;
    }
    $date = str_replace('-', ' ', $date);
    $date = str_replace('-', '/', $date);
    return date('Y-m-d', strtotime($date));
}

function getMysqlDateTimeFormat($dateTime)
{
    trim($dateTime);
    if (empty($dateTime)) {
        return null;
    }
    $dateTime = str_replace(',', ' ', $dateTime);
    return date('Y-m-d H:i:s', strtotime($dateTime));
}

function printFloatQuantity($number)
{
    if ((int)$number - $number) {
        return $number;
    }
    return (int)$number;
}

function getGlobalValues()
{
    $global = array();
    $query = get_instance()->db->get('tbl_settings');
    $global = $query->result_array();
    $globalData = array();
    foreach ($global as $rowData) {
        $globalData[$rowData['setting_name']] = $rowData['setting_value'];
    }
    return $globalData;
}

function getTermsNConditions()
{
    // return "<ol>
    //             <li>Detention & other incidental charges extra at actual with prior approval- War & Port Congestion Surcharges.</li>
    //             <li>Marine Insurance, Certificate of Origin Charges & Import Duty will be extra at actual.</li>
    //             <li>Statutory Approval/Required documents will be in Scope of Customer.</li>
    //             <li>Chargeable weight: Whicher is higher against Actual & Dimension weight.</li>
    //             <li>While processing Shipment instructions, Customer should be able to remove (deduct) not required services for example Local Transport.</li>
    //             <li>Exchange rate is subject to change on the date of Bill of Lading/Air Way Bill and it should be agreed by Customer & Freight Forwarder.</li>
    //             <li>Any additional activity / service if availed will be charged extra at actual which not mentioned Freight Forwarder offer subject to approval by Customer.</li>
    //             <li>VGM weighing should be done by Seller.</li>
    //             <li>Taxes extra at actual on all above charges.</li>
    //             <li>Any changes in Cargo or any other details may lead to change in Costing.</li>
    //             <li>All the clearance documents should be provided by the Customer.</li>
    //         </ol>";

    // return "
    // <ol>
    //     <li>Carrier will collect only statutory charges at destination like; Delivery Order fees & D-THC from the consignee; if not paid by Shipper. </li>
    //     <li>All surcharges shall be included in the freight.</li>
    //     <li>Detention / Demurrage (if any) shall be paid by consignee at discharge port (in conjunction with delivery terms) in the event of delay beyond agreed free time. </li>
    //     <li>Detention / Demurrage (if any) shall be paid by shipper at load port (in conjunction with delivery terms) in the event of delay beyond agreed free time. </li>
    //     <li>Bill of lading/Airway bill/Consignment note should be issued strictly as per the instruction from Shipper, upon seeking draft approval.</li>
    //     <li>Bill of Lading to be issued in 3 days-time from vessel sailing along with freight certificates and other vessel certificates. (Applicable to shipment by ocean)</li>
    //     <li>Airway bill/Consignment note to be issued on the same day of uplifting the goods (Applicable to shipment by air/road)</li>
    //     <li>Multi-modal transport document if issued, shall be in compliance with UCPDC 600 requirement (example: issued by agent on behalf of carrier)</li>
    //     <li>Tracking report to be updated on 24thmile.com </li>
    //     <li>Any GRI/hike announced by carrier will not be considered during the validity of price.</li>
    //     <li>Freight to be billed in INR after applying exchange as on the date of sailing. A copy of bank advice in support of exchange rate to be attached along with freight bill.</li>
    //     <li>A single D/O shall be issued for each booking given by Shipper. D/O shall be issued within 3 days of booking, strictly after ensuring inventory of sea worthy containers in the yard. In the event where containers are not issued within 5 days; Shipper shall have the right to source the containers from any other forwarder and the extra freight if any, shall be recovered from the forwarder who has been awarded the freight order, unless excused by the Force Majeure Clause. Routing, transit time, Port cut-off & SI cut-off VGM cut off to be given along with Delivery Order. (Applicable to shipment in container)</li>
    //     <li>Containers shall be in sea worthy condition. Wherever Open Top containers issued, the forwarder shall ascertain count of roof bows & tarp condition when DO issued. DO shall remain valid for 5 days from the date of issuance to Shipper. (Applicable to shipment in container)</li>
    //     <li>Carrier/Freight Forwarder shall be willing to release the delivery order at destination under consignee bank guarantee wherever specifically requested by Shipper.</li>
    //     <li>Master B/L to be sought from the Carrier in the event where shipment is handled on FCL basis. House B/L may be sought from the Consolidator in the event where shipment is handled on LCL/FCL or FCL/LCL or LCL/LCL basis. In any case, the Freight Forwarder shall ensure that a single delivery order is to be released at the destination. </li>
    //     <li>The Shipper/Consignee (in conjunction with delivery terms) shall have the prerogative to take the laden containers to jobsite/works for de-stuffing & return back the empty containers within the stipulated free time. </li>
    //     <li>The Shipper shall provide the weighment certificate in the event of containers stuffed from factory.</li>
    //     <li>Insurance & Taxes will be applicable in addition.</li>
    // </ol>
    // ";


    return "
    <ol>
    <li>Carrier shall perform its services in return for the agreed payment as per RFC Tariff/ Cost Outlay; Exporter-Importer shall timely pay the Carrier its agreed remuneration and outlays, including freights, customs charges and other expenses. </li>
    <li>Carrier shall submit Freight & Customs Clearance bills within 7 days of shipment clearance with accompany of all the supporting documents & receipts in original.</li>
    <li>Carrier expenses shall be billed as per approved Tariff/ Cost Outlay, any other at Actual Charges apart from Tariff / Cost Outlay shall need prior approval from Exporter/Importer and it shall accompany all the supporting receipts in original.</li>
    <li>All surcharges shall be included in the freight and Freight to be billed in Local Currency after applying exchange as on the date of sailing. A copy of bank advice in support of exchange rate to be attached along with freight bill, if applicable.</li>
    <li>Tracking report and necessary shipping documents shall be updated on 24thmile.com by Exporter-Importer and Carrier.</li>
    <li>Detention / Demurrage (if any) shall be paid by consignee at discharge port or shipper at load port (in conjunction with delivery terms) in the event of delay beyond agreed free time.</li>
    <li>Vehicle arrangement for Delivery/ Pick Up should be done only after confirmation with Exporter-Importer authorized person as soon as clearance happens/ material readiness within the stipulated free time for detention/ demmurage.</li>
    <li>A single Delivery Order/ Container Release Order shall be issued for each awarded shipment. Delivery Order/ Container Release Order and Actual issuance of Container shall be done strictly within 3 days of arrival/ booking, otherwise Shipper shall have the right to source the containers from any other forwarder and the extra freight if any, shall be recovered from the forwarder who has been awarded the freight order, unless excused by the Force Majeure Clause. (Applicable to shipment in container)</li>
    <li>Routing, transit time, Port cut-off & SI cut-off VGM cut off date and time, Vessel name, ETD & ETA at ports and other necessary information to be given along with Delivery Order. (Applicable to shipment in container)</li>
    <li>Carrier/Freight Forwarder shall be willing to release the delivery order at destination under consignee bank guarantee wherever specifically requested by Shipper.</li>
    <li>Multi-modal transport document if issued, shall be in compliance with UCPDC 600 requirement (example: issued by agent on behalf of carrier)</li>
    <li>Carrier will collect only statutory charges at destination like; Delivery Order fees & Destination-THC from the consignee; only if not paid by Shipper.</li>
    <li>Any GRI/ hike announced by carrier will not be considered during the validity of price or during shipment execution.</li>
    <li>Bill of lading/ Airway bill/ Consignment note should be issued strictly as per the instruction from Shipper, upon seeking draft approval.</li>
    <li>Bill of Lading to be issued in 3 days-time from vessel sailing along with freight certificates and other vessel certificates. (Applicable to shipment by ocean)</li>
    <li>Airway bill/ Consignment note to be issued on the same day of uplifting the goods (Applicable to shipment by air/road)</li>
    <li>Master B/L to be sought from the Carrier in the event where shipment is handled on FCL basis. House B/L may be sought from the Consolidator in the event where shipment is handled on LCL/FCL or FCL/LCL or LCL/LCL basis. In any case, the Freight Forwarder shall ensure that a single delivery order is to be released at the destination.</li>
    <li>Original Bill of Lading or Telex release Bill of Lading shall be issued by carrier with the prior approval from Shipper.</li>
    <li>Containers shall be in sea worthy condition. Wherever Open Top containers issued, the forwarder shall ascertain count of roof bows & tarp condition when Delivery Order or Container Release Order is issued. Delivery Order or Container Release Order shall remain valid for 5 days from the date of issuance to Shipper. (Applicable to shipment in container)</li>
    <li>The Shipper shall provide the weighment certificate in the event of containers stuffed from factory or instruct Carrier for weighment certificate well in advance.</li>
    <li>Applicable Insurance and Taxes shall be considered in addition.</li>
    </ol>
    ";
}

function getCountryDialCodes()
{
    return get_instance()->db->select('countryName,dial_code')->from('tbl_countries')->where('dial_code IS NOT NULL', null, false)->order_by('dial_code')->get()->result();
}
function getCountryCurrency()
{
    return get_instance()->db->select('DISTINCT(currency)')->from('tbl_countries')->where('currency IS NOT NULL', null, false)->where('currency !=""')->order_by('currency')->get()->result();
}

function getSocialLinks()
{


    $socialLinksResult = get_instance()->db->select('*')->from('tbl_social')->where('status', '1')->order_by('rank desc')->get()->result_array();

    return $socialLinksResult;
}

function is_ff_kyc_approved()
{
    $CI = get_instance();
    $documentId = [1, 2, 4, 5, 10];
    $company_id =  $CI->seller_session_data['company_id'];
    $result = $CI->db->select('*')->from('tbl_company_mapp_documents')
        ->where('company_id', $company_id)
        ->where_in('type', [1, 2, 4, 5, 10])
        ->get()
        ->result_array();

    $isNotApproved = false;
    if (empty($result)) {
        $isNotApproved = true;
    }
    foreach ($result as $row) {
        if (!in_array($row['type'], $documentId)) {
            $isNotApproved = true;
            break;
        }

        if ($row['status'] == '0') {
            $isNotApproved = true;
            break;
        }
    }
    if ($isNotApproved) {
        $CI->session->set_flashdata('error', 'Your KYC document is not Approved / Pending.');
        redirect(base_url('ff-company-profile'));
        exit;
    }
    return false;
}

function is_fs_kyc_approved()
{
    $CI = get_instance();
    $documentId = [1, 2, 4, 5, 6, 9, 11];
    $company_id =  $CI->seller_session_data['company_id'];
    $result = $CI->db->select('*')->from('tbl_company_mapp_documents')
        ->where('company_id', $company_id)
        ->where_in('type', $documentId)
        ->get()
        ->result_array();
    $isNotApproved = false;

    if (empty($result)) {
        $isNotApproved = true;
    }

    foreach ($result as $row) {
        if (!in_array($row['type'], $documentId)) {
            $isNotApproved = true;
            break;
        }

        if ($row['status'] == '0') {
            $isNotApproved = true;
            break;
        }
    }

    if ($isNotApproved) {
        $CI->session->set_flashdata('error', 'Your KYC document is not Approved / Pending.');
        redirect(base_url('fs-company-profile'));
        exit;
    }
    return false;
}

function getLoginUserDetails()
{

    // Get a reference to the controller object
    $CI = get_instance();

    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('seller_model');

    // Call a function of the model
    return $CI->seller_model->getLogedinUserDetails($CI->session->userdata('seller_logged_in')['id']);
}

function checkAppPermission($app_id, $user_id, $user_role)
{
    if ($user_role == '1') {
        return true;
    } else {
        return get_instance()->db->select('*')->from('tbl_mst_app_user_privileges')->where('status', '1')->where('app_id', $app_id)->where('to_user_id', $user_id)->get()->row();
    }

    return false;
}

function checkAdminSession($app_id)
{
    $CI = get_instance();
    $admin_session = $CI->session->userdata('logged_in');
    if (empty($admin_session)) {
        redirect(base_url('admin/login'));
    }

    if (in_array($admin_session['role'], ['2', '3', '4'])) {
        //don't access for FS,FF,Burer
        $CI->session->set_flashdata('error', 'Access denied.');
        redirect(base_url('admin/login'));
    }

    if (!checkAppPermission($app_id, $admin_session['id'], $admin_session['role']) && !empty($app_id)) {
        $CI->session->set_flashdata('error', 'Access denied.');
        redirect(base_url('admin/dashboard'));
    }

    return $admin_session;
}

function getApplist()
{
    $CI = get_instance();
    $admin_session = $CI->session->userdata('logged_in');
    $CI->load->model('app_previlages');
    $app_list =  $CI->app_previlages->getAppGrpList($status = '1', $CI->app_previlages->getAppUserAppPrivilageIdList($admin_session['id']));

    return  $app_list;
}




function getIndianCurrencyInWords($number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(
        0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety'
    );
    $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
    while ($i < $digits_length) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str[] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal) ? " . " . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
    // return $Rupees;
}

function getAmountInWords($number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(
        0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety'
    );
    $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
    while ($i < $digits_length) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str[] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
   // return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
     return $Rupees;
}

function sendEmail($to, $subject, $messageBody, $arrAttachments = array(), $attachmentName = '', $email_cc = '')
{
    // Get a reference to the controller object
    $CI = get_instance();

    $globalData = getGlobalValues();
    $mailTemplate = '';
    $mailTemplate = '
        <html lang="en">
            <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>' . $subject . '</title>
            <style type="text/css">

            @media only screen and (max-width : 780px) {
                        .wrpper	{ width:100% !important; padding:0px 10px;}
                        a.logo {float:none !important; display:block!important; width:100% }
                        header a {  margin: 0px !important;  padding: 3px  5px !important;  float:none;  width: 100%; font-size:12px}
                        footer{ padding:10px !important;}
                        p{ font-size:14px;}
                        body{ margin:0px; padding:0px;}
                        *{ box-sizing:border-box;}
                        }
            </style>
            </head>
                <body>
                <div class="wrpper" style="width:90%;margin: 0px auto; font-family:Arial, Helvetica, sans-serif">

                <header style="text-align:center;">
                <div style="float:left; width:100%; background:#fff; padding-bottom:10px; margin-bottom:20px;margin-top:10px;"> 
                    <div style="text-align: center; width:100%;"> 
                    <img src="' . base_url('assets/frontend/images/24thmile_170_48.png') . '" alt="' . $globalData['site_title'] . '"> 
                    </div>
                </div>
                </header>
                    <div style="width:100%; float:left;min-height:100px;font-size:14px;">' . $messageBody . '<br><br><br>' . $globalData['email_footer'] . '
                        
                    </div>
                       <div style="width:100%;text-align:center;color:#cdcdcd;margin-top:50px;font-size:12px;float:left">Please do not reply to this email address as customer queries are not monitored.</div> 
                    <div style="width:100%; float:left; padding:15px 10px; min-height:50px;color:#cdcdcd;font-size:12px; margin:50px 0px 0px 0px; box-sizing:border-box; border-top: solid 1px #ccc; text-align:center;">
                         &copy; 2020 All Rights Reserved.
                    </div>
                </div>

                </body>
            </html>
            ';
    //            $headers = 'MIME-Version: 1.0' . "\r\n";
    //            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    //            $headers .= 'From: ' . $globalData['site_title'] . '<' . $globalData['site_email'] . '>' . "\r\n";



    // $config['protocol']    = 'smtp';
    // $config['smtp_host']    = 'ssl://smtp.gmail.com';
    // $config['smtp_port']    = '465';
    // $config['smtp_timeout'] = '7';
    // $config['smtp_user']    = 'info.24thmile@gmail.com';
    // $config['smtp_pass']    = 'info@24th';
    // $config['smtp_user']    = 'sales@24thmile.com';
    // $config['smtp_pass']    = '1234567890';
    $config['charset']    = 'utf-8';
    $config['newline']    = "\r\n";
    $config['mailtype'] = 'html';
    $CI->email->clear(TRUE);
    $CI->email->initialize($config);

    $CI->email->from('sales@24thmile.com', '24thMile');
    $CI->email->to($to);
    if ($email_cc) {
        $CI->email->cc($email_cc);
    }
    $CI->email->bcc(["tushar.dhake@24thmile.com", "sales@24thmile.com","operations@24thmile.com"]);
    $CI->email->subject($subject);
    $CI->email->message($mailTemplate);
    if (!empty($arrAttachments)) {
        foreach ($arrAttachments as $attachpath) {
            if (!empty($attachmentName)) {
                $CI->email->attach($attachpath, 'attachment', $attachmentName);
            } else {
                $CI->email->attach($attachpath);
            }
        }
    }
    return $CI->email->send();


    // return @mail($to, $subject, $mailTemplate, $headers); 

}

function sendEmail_verificationCode($to, $verificationCode)
{
    $globalData = getGlobalValues();
    $subject =  $globalData['site_title'] . ' Verification Code';
    $messageBody = "<p><b>$verificationCode</b> is your 24thmile verification code.</p>";

    return sendEmail($to, $subject, $messageBody);
}

function sendEmail_Signup($fname, $userEmail,$mobile='')
{
    $globalData = getGlobalValues();
    $subject = $globalData['site_title'] . ' Signup';
    //    $messageBody='<p style="color:#000;">Thank you for registering yourself on '.$globalData['site_title'].'</p>
    //                    <p style="margin:0px 0px 0px 0px; color:#000;">Your Login Details - </p>
    //                    <p  style="margin:5px 0px 0px 0px; color:#000;">User Name : <strong>'. $userEmail.'</strong> </p>
    //                   <p  style="margin:5px 0px 20px 0px; color:#000;">Password  : <strong>'.$password.'</strong> </p>
    //                     <p > Don\'t disclose your password to anyone.</p>';

    $subject = $globalData['site_title'] . 'Verify Your Email Address';
    $messageBody = 'Dear ' . $fname . ',<br/><br/> You have entered the details as below and Please click on the below activation link to verify your email address.
    Name: ' . $fname . '<br>
    Contact: ' . $mobile . '<br>
    Email Address: ' . $userEmail . '<br>
    <br/><br/> <a target="_blank" href="' . base_url('login/verify/' . sha1($userEmail)) . '">' . base_url('login/verify/' . sha1($userEmail)) . '</a>   ';


    return sendEmail($userEmail, $subject, $messageBody);
}


function sendEmail_Usercreate($fname, $userEmail, $password)
{
    $globalData = getGlobalValues();
    $subject = $globalData['site_title'] . ' Signup';
    $messageBody = '<p style="color:#000;">Thank you for registering yourself on ' . $globalData['site_title'] . '</p>
                   <p style="margin:0px 0px 0px 0px; color:#000;">Your Login Details - </p>
                   <p  style="margin:5px 0px 0px 0px; color:#000;">User Name : <strong>' . $userEmail . '</strong> </p>
                  <p  style="margin:5px 0px 20px 0px; color:#000;">Password  : <strong>' . $password . '</strong> </p>
                    <p > Don\'t disclose your password to anyone.</p>';
    $messageBody .= '<br/><br/> Please click on the below activation link to verify your email address.<br/><br/> <a target="_blank" href="' . base_url('login/verify/' . sha1($userEmail)) . '">' . base_url('login/verify/' . sha1($userEmail)) . '</a>   ';

    //  $subject = $globalData['site_title'].'Verify Your Email Address';
    //     $messageBody = 'Dear '.$fname.',<br/><br/> Please click on the below activation link to verify your email address.<br/><br/> <a target="_blank" href="'.base_url('login/verify/' . sha1($userEmail)).'">'.base_url('login/verify/' . sha1($userEmail)).'</a>   ';


    return sendEmail($userEmail, $subject, $messageBody);
}

function sendEmail_forgotPassword($fname, $lname, $userEmail)
{
    $globalData = getGlobalValues();
    $subject = $globalData['site_title'] . ' Forgot Passward';
    //    $messageBody='<p style="color:#000;">Please find below updated details to login with system.</p>
    //                    <p style="margin:0px 0px 0px 0px; color:#000;">Your Login Details - </p>
    //                    <p  style="margin:5px 0px 0px 0px; color:#000;">User Name : <strong>'. $userEmail.'</strong> </p>
    //                   <p  style="margin:5px 0px 20px 0px; color:#000;">Password  : <strong>'.$password.'</strong> </p>
    //                     <p > Don\'t disclose your password to anyone.</p>';
    //    $subject = 'Forgot Password';

    $messageBody = 'Dear ' . $fname . ' ' . $lname . ',<br/><br/> Please click on the below activation link to reset your password.<br/><br/> <a target="_blank" href="' . base_url('login/change_password?reset_code=' . base64_encode($userEmail)) . '">' . base_url('login/change_password?reset_code=' . base64_encode($userEmail)) . '</a> ';


    return sendEmail($userEmail, $subject, $messageBody);
}

function sendEmail_changePassword($fname, $lname, $userEmail, $password)
{
    $globalData = getGlobalValues();
    $subject = $globalData['site_title'] . ' Change Password';
    //    $messageBody='<p style="color:#000;">Please find below updated details to login with system.</p>
    //                    <p style="margin:0px 0px 0px 0px; color:#000;">Your Login Details - </p>
    //                    <p  style="margin:5px 0px 0px 0px; color:#000;">User Name : <strong>'. $userEmail.'</strong> </p>
    //                   <p  style="margin:5px 0px 20px 0px; color:#000;">Password  : <strong>'.$password.'</strong> </p>
    //                     <p > Don\'t disclose your password to anyone.</p>';
    $messageBody = 'Dear ' . $fname . ' ' . $lname . ',<br/><br/>  Your new password is <b> ' . $password . '</b> ';

    return sendEmail($userEmail, $subject, $messageBody);
}


function sendEmail_contactUs($name, $email, $message)
{
    $globalData = getGlobalValues();
    $subject = $globalData['site_title'] . ' Contact Us';
    $messageBody = 'Hello Admin,
                 <p style="margin:5px 0px 0px 0px; color:#000;">User trying to reach you. Please look following contact details.</p>   
                    
                    <p  style="margin:5px 0px 0px 0px; color:#000;">Name : ' . $name . ' </p>
                   <p  style="margin:5px 0px 0px 0px; color:#000;">email  : ' . $email . ' </p>
                   <p  style="margin:5px 0px 0px 0px; color:#000;">Message  : ' . $message . ' </p>
                     ';
    sendMail_contactusReply($email, $name);
    return sendEmail($globalData['site_email'], $subject, $messageBody);
}

function sendMail_contactusReply($to, $name)
{
    $globalData = getGlobalValues();
    $subject = $globalData['site_title'] . ' Contact Us';
    $messageBody = 'Dear ' . $name . ',
                    <p></p>
                 <p>Thank you for contacting us. We contact you soon in next working days.</p>   
                  ';

    return sendEmail($to, $subject, $messageBody);
}

function sendEmail_rfcSend($email, $name, $url, $request_id)
{
    $globalData = getGlobalValues();
    $subject = $globalData['site_title'] . " Freight request comparative (RFC ID:$request_id).";
    $messageBody = "Dear $name";
    $messageBody .= "<br><br>$url";

    return sendEmail($email, $subject, $messageBody);
}

function sendEmail_quoteAccept($email, $name, $url, $request_id)
{
    $globalData = getGlobalValues();
    $subject = $globalData['site_title'] . " Quote Accepted (RFC ID:$request_id).";
    $messageBody = "Dear $name";
    $messageBody .= "<p>You have been shortlisted. You will receive shipping instructions shortly.</p>";
    $messageBody .= "<br><br>$url<br>";

    return sendEmail($email, $subject, $messageBody);
}

function sendEmail_regretMail($email)
{
    $globalData = getGlobalValues();
    $subject = $globalData['site_title'];
    $messageBody = "Dear Service Provider,";
    $messageBody .= "<p>We regret to inform you that this shipmement has been processed. You are requested to give us your best next RFC.</p>";
    $messageBody .= "<br><br><br>";
    return sendEmail($email, $subject, $messageBody);
}
function sendEmail_SendCounterOffer($email, $name, $url, $request_id)
{
    $globalData = getGlobalValues();
    $subject = $globalData['site_title'] . " Counter offer updated (RFC ID:$request_id).";
    $messageBody = "Dear $name";
    $messageBody .= "<p>Counter offer updated for more details click following link..</p>";
    $messageBody .= "<br><br>$url<br>";

    return sendEmail($email, $subject, $messageBody);
}

function sendEmail_ShippingInstructions($email, $name, $shipping_instruction, $request_id)
{
    $globalData = getGlobalValues();
    $subject = $globalData['site_title'] . " Shipment Instructions(RFC ID:$request_id).";
    $messageBody = "Dear $name";
    $messageBody .= $shipping_instruction;
    $messageBody .= "<br><br><br>";

    return sendEmail($email, $subject, $messageBody);
}

function sendEmail_quoteSendToSeller($email, $name, $url, $request_id, $comment = '')
{
    return false;// stop email send
    $globalData = getGlobalValues();
    $subject = $globalData['site_title'] . " Quote Sent(RFC ID:$request_id).";
    $messageBody = "Dear $name";
    $messageBody .= "<br><br>$url<br>";
    if (!empty($comment)) {
        $messageBody .= "<br><br>$comment<br>";
    }

    return sendEmail($email, $subject, $messageBody);
}

function sendEmail_exportStep1_upload_doc($email, $name, $url, $request_id)
{
    return false;// stop email send
    // fs upload preshipment documents
    $globalData = getGlobalValues();
    $subject = $globalData['site_title'] . " Quote Sent(RFC ID:$request_id).";
    $messageBody = "Dear $name";
    $messageBody .= "<p>Pre-Shipment Documents have been uploaded. Please have a look and ensure that all documents are inline. 
    Please revert with 'Checklist for Shipping Bill'.</p><br><br>$url<br>";

    return sendEmail($email, $subject, $messageBody);
}

function sendEmail_invoice($email_cc, $invoiceDetails, $attachments)
{
    // fs upload preshipment documents
    $email = $invoiceDetails->email;
    $globalData = getGlobalValues();
    $subject = $globalData['site_title'] . ' ' . ucwords($invoiceDetails->inv_type) . " ($invoiceDetails->inv_unique_id).";
    $messageBody = "Dear " . ucwords($invoiceDetails->customer_name);
    $messageBody .= "<p>Invoice details attachement.</p>";

    return sendEmail($email, $subject, $messageBody, $attachments, $invoiceDetails->inv_unique_id . '.pdf', $email_cc);
}

function sendEmail_report($email, $name, $reportType, $from_date, $to_date, $attachments)
{
    // fs upload preshipment documents
    //    $email = $userDetails->email;
    $reportType = ucwords($reportType);
    $globalData = getGlobalValues();
    $subject = $globalData['site_title'] . ' ' . $reportType . " Report From $from_date to $to_date";
    $messageBody = "Dear " . ucwords($name);
    $messageBody .= "<br><br><p>$reportType Report attachment.</p>";

    return sendEmail($email, $subject, $messageBody, $attachments, $reportType . '_report_' . date('Ymd') . '.xls');
}

function sendEmail_reminder_rfc($email, $name, $table)
{
    $globalData = getGlobalValues();
    $subject = $globalData['site_title'] . " Pending reply to Freight Inquiries.";
    $messageBody = "Dear $name";
    $messageBody .= "<br><br>Please refer below Pending Freight Quote list from your end as on date. Kindly update the Quotation on priority so that Exporter-Importer can award the shipment to you.<br><br>";
    $messageBody .= $table;
    $cc = "tushar.dhake@24thmile.com";
    return sendEmail($email, $subject, $messageBody, [], '', $cc);
}

function sendEmail_reminder_awarded($email, $name, $table)
{
    $globalData = getGlobalValues();
    $subject = $globalData['site_title'] . " Reminder for accept shipment.";
    $messageBody = "Dear $name";
    $messageBody .= "<br><br>Please refer below Pending Freight Quote list from your end as on date.<br><br>";
    $messageBody .= $table;
    $cc = "tushar.dhake@24thmile.com";
    return sendEmail($email, $subject, $messageBody, [], '', $cc);
}

function sendEmail_dailyInvoiceReport($date, $report, $attachments)
{
    $globalData = getGlobalValues();
    $subject = $globalData['site_title'] . " Invoice/Proforma report(" . printFormatedDate($date) . ")";
    $messageBody = "Dear Admin";
    $messageBody .= " <br><br>Invoice/Proforma report of date " . printFormatedDate($date) . "<br><br>";
    $messageBody .= $report;
    $to = ["vt@temgire.com", "tushar.dhake@24thmile.com"];
    // $to ="someshwar@essensys.co.in";
    return sendEmail($to, $subject, $messageBody, $attachments, 'invoice_report_' . date('Ymd', strtotime($date)) . '.xls');
}

function sendEmail_inquiry($data)
{
    $globalData = getGlobalValues();
    $subject = $globalData['site_title'] . " Inquiry";
    $messageBody = "Dear Admin";
    $messageBody .= " <br><br><b>Inquiry Details</b><br><br>";
    $messageBody .= "<p><b>Fulll Name:</b> <span>" . $data['fullname'] . "</span></p>";
    $messageBody .= "<p><b>Email:</b> <span>" . $data['email'] . "</span></p>";
    $messageBody .= "<p><b>Mobile:</b> <span>" . $data['mobile'] . "</span></p>";
    $messageBody .= "<p><b>Origin:</b> <span>" . $data['source'] . "</span></p>";
    $messageBody .= "<p><b>Destination:</b> <span>" . $data['destination'] . "</span></p>";
    $messageBody .= "<p><b>Shipping Type:</b> <span>" . $data['shipping_type'] . "</span></p>";
    $messageBody .= "<p><b>Shipping Date:</b> <span>" . ($data['date_of_shipping'] ? printFormatedDate($data['date_of_shipping']) : '') . "</span></p>";
    $messageBody .= "<p><b>Message:</b> <span>" . $data['message'] . "</span></p>";

    $to = ["sales@24thmile.com"];
    sendEmail_replayInquiry($data['email'], $data['fullname']);
    return sendEmail($to, $subject, $messageBody);
}

function sendEmail_replayInquiry($to, $name)
{
    $globalData = getGlobalValues();
    $subject = $globalData['site_title'] . ' - Thank you for contacting us.';
    $messageBody = '<p>Hi,</p>
                   <p> Greetings from 24thmile and have a wonderful day!!!</p>
                    
                    <p>Thanks for reaching out to us! We have received your message and our customer support representative will get back to you within 24 hours.</p>
                    
                    <p>Please explore our Secure Digital Platform for Total Export-Import Management Services by signing up at <a  target="_blank" href="https://www.24thmile.com/signup">https://www.24thmile.com/signup</a> </p>
                    
                    <p>Until then, if need immediate assistance you can also reach us at <a href="mailto:sales@24thmile.com">sales@24thmile.com</a> Contact: +91 7709065277
                    </p>
                  
                  ';
    $email_cc = 'sales@24thmile.com';
    return sendEmail($to, $subject, $messageBody, [], '', $email_cc);
}

function sendEmail_feedback($data)
{
    $globalData = getGlobalValues();
    $subject = $globalData['site_title'] . " Feedback";
    $messageBody = "Dear Admin";
    $messageBody .= " <br><br><b>Feedback Details</b><br><br>";
    $messageBody .= "<p><b>Fulll Name:</b> <span>" . $data['fullname'] . "</span></p>";
    $messageBody .= "<p><b>Company Name:</b> <span>" . $data['company_name'] . "</span></p>";
    $messageBody .= "<p><b>Email-ID:</b> <span>" . $data['email'] . "</span></p>";
    $messageBody .= "<p><b>Mobile:</b> <span>" . $data['country_dial_code'] . ' ' . $data['mobile'] . "</span></p>";
    $messageBody .= "<p><b>Message:</b> <span>" . $data['message'] . "</span></p>";

    $to = ["sales@24thmile.com"];
    sendEmail_replayFeedback($data['email'], $data['fullname']);
    return sendEmail($to, $subject, $messageBody);
}

function sendEmail_replayFeedback($to, $name)
{
    $globalData = getGlobalValues();
    $subject = $globalData['site_title'] . '  - Thank you for contacting us.';
    $messageBody = '<p>Hi,</p>
                   <p> Greetings from 24thmile and have a wonderful day!!!</p>
                    
                    <p>Thanks for reaching out to us! We have received your message and our customer support representative will get back to you within 24 hours.</p>
                    
                    <p>Please explore our Secure Digital Platform for Total Export-Import Management Services by signing up at <a  target="_blank" href="https://www.24thmile.com/signup">https://www.24thmile.com/signup</a> </p>
                    
                    <p>Until then, if need immediate assistance you can also reach us at <a href="mailto:sales@24thmile.com">sales@24thmile.com</a> Contact: +91 7709065277
                    </p>
                  
                  ';

    $email_cc = 'sales@24thmile.com';
    return sendEmail($to, $subject, $messageBody, [], '', $email_cc);
}
function sendEmail_pending_kyc($listTable)
{
    $globalData = getGlobalValues();
    $date = printFormatedDate(date('Y-m-d'));
    $subject = $globalData['site_title'] . '  - Pending KYC REPORT (' . $date . ')';
    $messageBody = "<p>Hello Admin,</p>
                   <br><br>
                   $listTable
                  
                  ";

    $to = ['vt@temgire.com', 'sales@24thmile.com', 'info@temgire.com'];

    return sendEmail($to, $subject, $messageBody, [], '', '');
}

function printDocumentLink($documentLink)
{
    if (empty($documentLink)) {
        return "<span>NA</span>";
    }
    $filename = array_pop(explode('/', $documentLink));
    $fileName_langth = 15;
    $filename_short = strlen($filename) > $fileName_langth ? substr($filename, 0, $fileName_langth) . '...' : $filename;
    return $filename_short . "&nbsp;<a title='" . $filename . "' target='_blank' href='$documentLink' class='fa fa-download fa-lg text-primary mdi-file-file-download' title='Download'></a>";
}

function  getDocumentName($key)
{
    $documentNameList = [
        //FS side documents
        'Custom_Invoice' => 'Custom Invoice', //Export step1
        'packing_List' => 'Packing List', //Export step1  , Import Step1
        'other_documents_1' => 'Other Documents 1', //Export step1
        'other_documents_2' => 'Other Documents 2', //Export step1
        'other_documents_3' => 'Other Documents 3', //Export step1
        'post_shipment_doc1' => 'Final BL / AWB', //Export step7
        'post_shipment_doc2' => 'Commercial Invoice', //Export step7
        'post_shipment_doc3' => 'Packing List', //Export step7
        'post_shipment_doc4' => 'Certificate of Origin', //Export step7
        'post_shipment_doc5' => 'Marin Insurance', //Export step7
        'post_shipment_doc6' => 'Other Document', //Export step7
        'final_billl_of_lading' => 'Final BL / AWB', //Import step1
        'commercial_invoice' => 'Commercial Invoice', //Import step1
        'certificate_of_origin' => 'Certificate of Origin', //Import step1
        'other_documents' => 'Other Documents', //Import step1
        //FF side documents
        'Shipping_bill_checklist' => 'Shipping Bill Checklist', //Export step2
        'Final_shipping_bill' => 'Final Shipping Bill', //Export step3
        'Bill_of_lading' => 'Draft BL / AWB', //Export step5
        'vgm_document' => 'VGM', //Export step5
        'Final_Bill_of_lading' => 'Final BL / AWB', //Export step6 , Import Setp 5
        'invoice_confirm' => 'FF Invoice', //Export step6, Import step8
        'bill_of_entry' => 'Draft Bill of Entry', //Import step6
        'final_bill_of_entry' => 'Final Bill of Entry', //Import step7 
    ];

    if ($documentNameList[$key]) {

        return $documentNameList[$key];
    }


    return "Document";
}

function password_generate($chars)
{
    $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
    return substr(str_shuffle($data), 0, $chars);
}

function getPackingUnitList($code=''){
    $list = [
        "NUM"=>"Number",
        "PC"=>"Piece",
        "BAG"=>"Bag",
        "BKT"=>"Bucket",
        "ROL"=>"Roll",
        "TUBE"=>"Tube",
        "SHT"=>"Sheet",
        "GAL"=>"Gallon",
        "CRD"=>"Card",
        "BOX"=>"Box",
        "CS"=>"Case",
        "CTN"=>"Carton",
        "EA"=>"Each",
        "DZ"=>"Dozen",
        "KIT"=>"Kit",
        "LOT"=>"Lot",
        "CM"=>"Centimeters",
        "M"=>"Meter",
        "KM"=>"Kilometer",
        "FT"=>"Feet",
        "SQFT"=>"Sq. Feet",
        "PR"=>"Pair",
        "SET"=>"Set",
        "BND"=>"Bundle",
        "DRM"=>"Drum",
        "OTH"=>"Others",
    ];
    if($code){
        return $list[$code]?$list[$code]:'';
    }
    return $list;
}

function getFinancialYearList(){
    $list = [];
    $fromYear=2018;
    $currentYear = getCurrentFinancialYear();
    while($fromYear<=$currentYear){
        $temp = new stdClass;
        $temp->label =  "$fromYear-".(($fromYear % 100)+1);
        $temp->value =  $fromYear++;
        $list[]=$temp;
    }
    return $list;
}

function getCurrentFinancialYear(){
    $currentYear = (int)date('Y');
	$financeYearStartDate = $currentYear.'-04-01';
	$financeYearEndDate = ($currentYear+1).'-03-31';
	$currentDate = date('Y-m-d');	
	if(strtotime($currentDate) < strtotime($financeYearStartDate)){

		$currentYear = $currentYear-1;
		$financeYearStartDate = $currentYear.'-04-01';
		$financeYearEndDate = ($currentYear+1).'-03-31';
    }
    return $currentYear;
}

function getIdFromValue($array,$searchValue,$searchKey,$retrunKey){
    foreach ($array as $key=>$row){
        $row = (array)$row;
        if(strcasecmp($row[$searchKey],$searchValue)==0){
            return $row[$retrunKey];
        }
    }
    return;
}

function getPhysicalPathFromUrl($url){
    $path = str_replace(base_url(),'../',$url);
    return APPPATH.$path;
}


function checkDocumentPermission($documentType,$transaction,$mode,$shipment,$userType){
//view,edit,0-NA
$arr_trnsaction=[
'Export'=>[
    'custom-invoice'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'packing-list-pre-shipment'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'shiping-marks-pre-shipment'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'tax-invoice-with-lut-bond'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'tax-invoice-without-lut-bond'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'container-packing-list-pre-shipment'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>false,'LCL'=>false],'EXIM'=>'edit','FF'=>'view'],
    'evd-form'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'sdf-form'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'fema-declaration'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'non-dg-declaration'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'self-sealed-declaration'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'draft-certificate-of-origin'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'declaration-of-origin'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'vgm-declaration'=>['Sea'=>['LCL'=>false,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>false],'Road'=>['FCL'=>true,'LCL'=>false],'EXIM'=>'edit','FF'=>'view'],
    'draft-bill-of-lading-pre-shipment'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'forwarding-insructions'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>false,'FF'=>'edit'],
    
    'commercial-invoice'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'packing-list-post-shipment'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'final-certificate-of-origin-post-shipment'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'final-bill-of-lading-post-shipment'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'view','FF'=>'edit'],

    'marine-insurance-instructions'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'ecgc-instructions'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'ecgc-form'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'sli-format'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'new-sli'=>['Sea'=>['LCL'=>false,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>false],'Road'=>['FCL'=>true,'LCL'=>false],'EXIM'=>'edit','FF'=>'view'],
    'pre-shipment-covering-letter-for-cha-or-ff'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'post-shipment-covering-letter-for-client'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'post-shipment-covering-letter-for-bank'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'bill-of-exchange'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'second-bill-of-exchange'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'scomet-letter'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'authorisation-letter-to-custom-house-agent'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],

],
'Import'=>[
    'draft-bill-of-lading-pre-shipment'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'view','FF'=>'edit'],
    'gatt-declaration'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>false],
    'final-bill-of-lading-post-shipment'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],

    'marine-insurance-instructions'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'sli-format'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'new-sli'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'pre-shipment-covering-letter'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'fema-and-ogl-for-bank'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'covering-letter-for-advance-remittance'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'covering-letter-for-import-clearance'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'covering-letter-for-import-document-sbumission-to-bank'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>true,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
    'authorisation-letter-to-custom-house-agent'=>['Sea'=>['LCL'=>true,'FCL'=>true],'Air'=>['FCL'=>false,'LCL'=>true],'Road'=>['FCL'=>true,'LCL'=>true],'EXIM'=>'edit','FF'=>'view'],
],
];


return $arr_trnsaction[$transaction][$documentType][$mode][$shipment]?$arr_trnsaction[$transaction][$documentType][$userType]:0;


}



// function getPackingTypeList(){
//     return [
//         "Role"=>"Role",
//         "Wrap"=>"Wrap",
//         "Wooden Box"=>"Wooden Box",
//     ];
// }
function getPackingTypeList()
{
    $CI = get_instance();
   
    $CI->load->model('packing_model');
    $packinglist =  $CI->packing_model->getList($status = '1');

    return  $packinglist;
}

function getPrecarriageByList(){
    return [
        "Road"=>"Road",
        "Rail"=>"Rail",
        "Water"=>"Water",
        "Air"=>"Air",
    ];
}


function formated_ad_code($str) {
    $str = str_replace('-','',$str);
    if(strlen($str)<8){
        return $str;
    }
    $pos = 7;
    $insertstr = "-";
    if (!is_array($pos)) {
        $pos = array($pos);
    } else {
        asort($pos);
    }
    $insertionLength = strlen($insertstr);
    $offset = 0;
    foreach ($pos as $p) {
        $str = substr($str, 0, $p + $offset) . $insertstr . substr($str, $p + $offset);
        $offset += $insertionLength;
    }
    return $str;
}
