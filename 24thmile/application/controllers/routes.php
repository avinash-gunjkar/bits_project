<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['migration'] = 'home/migrationProcess';
$route['default_controller'] = 'home/index';
$route['test'] = 'Welcome/index';
$route['citylist'] = 'Welcome/citylist';
$route['about-us'] = 'home/about_us';
$route['services'] = 'home/services';

$route['booking-tracking-status-report'] = 'home/booking_report';
$route['export-import-process-outsourcing-consultancy'] = 'home/export_import_process_outsourcing_consultancy';
$route['other-outsourcing-consultancy'] = 'home/other_outsourcing_consultancy';

$route['construction'] = 'index.html';
$route['news-event'] = 'home/news_event';
$route['our-clients'] = 'home/our_clients';
$route['terms-conditions'] = 'home/terms_conditions';
$route['process'] = 'home/process';
$route['contact-us'] = 'home/contact_us';
$route['signup'] = 'login/seller_registeration';
$route['send-otp'] = 'login/send_otp';
$route['signin'] = 'login/seller_login';
$route['signout'] = 'login/seller_logout';

$route['fs-request-list'] = 'seller/request_list';
$route['fs-delete-request'] = 'seller/deleteRfc';
$route['fs-booking-list'] = 'seller/booking_list';
$route['fs-ajaxRequestList'] = 'seller/ajaxRequestList';
$route['fs-ajaxBookingList'] = 'seller/ajaxBookingList';

$route['fs-track-shipment/(:num)'] = 'seller/track_shipment/$1';
$route['fs-track-shipment-edit/(:num)/(:num)'] = 'seller/track_shipment_edit/$1/$2';

$route['ff-booking-list'] = 'freightforwarder/booking_list';
$route['ff-ajaxBookingList'] = 'freightforwarder/ajaxBookingList';
$route['ff-track-shipment/(:num)'] = 'freightforwarder/track_shipment/$1';

$route['ff-request-list'] = 'freightforwarder/request_list';
$route['ff-download-rfc/(:num)'] = 'freightforwarder/downloadQuote/$1';
$route['ff-ajaxRequestList'] = 'freightforwarder/ajaxRequestList';
$route['view-request-details/(:num)'] = 'freightforwarder/view_request_details/$1';
$route['edit-request-details/(:num)'] = 'freightforwarder/edit_request_details/$1';

$route['freight-compare/(:num)'] = 'seller/freight_compare/$1';
$route['shipping-requirement'] = 'seller/shipping_requirement';
$route['edit-shipping-requirement/(:num)'] = 'seller/shipping_requirement/$1';
$route['partial-edit-shipping-requirement/(:num)'] = 'seller/partial_edit_shipping_requirement/$1';
$route['copy-to-new-request/(:num)'] = 'seller/copy_to_new_request/$1';
$route['fs-view-shipping-requirement/(:num)'] = 'seller/view_shipping_requirement/$1';
$route['cancel-shipping-requirement'] = 'seller/cancelShipingRequest';
$route['book-shipment/(:num)/(:any)'] = 'seller/book_shipment/$1/$2';
$route['book-shipment-ff/(:num)/(:any)'] = 'freightforwarder/book_shipment/$1/$2';
$route['view-respond/(:any)'] = 'seller/view_respond/$1';
$route['shipment-list'] = 'seller/shipment_list';
$route['shipment-tracking/(:num)/(:num)'] = 'seller/shipment_tracking/$1/$2';
$route['forgot-password'] = 'login/forgot';

$route['fs-my-profile'] = 'seller/profile';
$route['fs-company-profile'] = 'seller/company_profile';
$route['fs-kyc-documents'] = 'seller/kyc_document';

$route['ff-my-profile'] = 'freightforwarder/profile';
$route['ff-company-profile'] = 'freightforwarder/company_profile';
$route['ff-kyc-documents'] = 'freightforwarder/kyc_document';
$route['ff-dashboard'] = 'freightforwarder/dashboard';
$route['fs-dashboard'] = 'seller/dashboard';
$route['ff-shipping-documents'] = 'freightforwarder/shippingDocuments';
$route['fs-shipping-documents'] = 'seller/shippingDocuments';


$route['select-ff-shipping-requirement/(:num)'] = 'seller/select_ff/$1';
$route['select-ff-from-annual-contract/(:num)'] = 'seller/selectFF_fromAnnualContract/$1';
$route['quote-list/(:num)'] = 'seller/quoteList/$1';
$route['download-quote-comparative/(:num)'] = 'seller/downloadQuoteComparative/$1';
$route['view-quote/(:num)/(:num)'] = 'seller/viewQuote/$1/$2';
$route['remove-ff-from-comparative'] = 'seller/removeFF_fromComparative';
$route['download-quote/(:num)/(:num)'] = 'Seller/downloadQuote/$1/$2';
$route['confirm-shipment/(:num)/(:num)'] = 'seller/confirmShipment/$1/$2';
$route['company-details/(:num)'] = 'seller/companyDetails/$1';
$route['seller-company-details/(:num)'] = 'freightforwarder/sellerCompanyDetails/$1';

#projects
$route['fs-annual-contract-list'] = 'seller/annualContractList';
$route['fs-create-annual-contract'] = 'seller/createAnnualContract';
$route['fs-delete-annual-contract'] = 'seller/deleteAnnualContract';
$route['fs-cancel-annual-contract'] = 'seller/cancelAnnualContract';
$route['fs-edit-annual-contract/(:num)'] = 'seller/createAnnualContract/$1';
$route['fs-annual-contract-comparative/(:num)'] = 'seller/comparativeAnnualContract/$1';
$route['fs-download-annual-contract-comparative/(:num)'] = 'seller/downloadAnnualContractComparative/$1';
$route['fs-online-bidding-list'] = 'seller/onlineBiddingList';
$route['ff-annual-contract-list'] = 'freightforwarder/annualContractList';
$route['ff-online-bidding-list'] = 'freightforwarder/onlineBiddingList';
$route['annual-contract-select-ff/(:num)'] = 'seller/annualContract_select_ff/$1';

$route['ff-edit-annual-contract/(:num)'] = 'freightforwarder/editAnnualContract/$1';
$route['ff-view-annual-contract/(:num)'] = 'freightforwarder/editAnnualContract/$1';
$route['ff-download-annual-contract-template/(:num)'] = 'freightforwarder/downloadAnnualContractTemplate/$1';

$route['ajax-city-list'] = 'Cn_ajax/ajaxCityList';
$route['ajax-add-city'] = 'Cn_ajax/ajaxAddCity';
$route['ajax-port-list'] = 'Cn_ajax/ajaxPortList';
$route['ajax-add-port'] = 'Cn_ajax/ajaxAddPort';

#company branch
$route['company-branch/(branch|consignee)'] = 'branch/index/$1';
$route['add-branch/(branch|consignee)'] = 'branch/add/$1';
$route['edit-branch/(branch|consignee)/(:num)'] = 'branch/add/$1/$2';
$route['delete-branch/(branch|consignee)/(:num)'] = 'branch/delete_branch/$1/$2';

#company banks
$route['company-banks'] = 'company_banks/index';
$route['add-bank'] = 'company_banks/add/$1';
$route['edit-bank/(:num)'] = 'company_banks/add/$1';
$route['delete-bank/(:num)'] = 'company_banks/delete_bank/$1';

#compnay users 
$route['company-users'] = 'company_users/index';
$route['add-company-user'] = 'company_users/add';
$route['edit-company-user/(:num)'] = 'company_users/add/$1';
$route['delete-company-user/(:num)'] = 'company_users/delete_user/$1';

$route['my-quotes'] = 'freightforwarder/my_quotes';
$route['view-counter-offers/(:num)'] = 'freightforwarder/view_counter_offers/$1';
$route['shipment-list-ff'] = 'freightforwarder/shipment_list';
$route['shipment-tracking-ff/(:num)/(:num)'] = 'freightforwarder/shipment_tracking/$1/$2';

#ajax
$route['ajax-add-container'] = 'Cn_ajax/ajaxAddContainer';
$route['ajax-add-package'] = 'Cn_ajax/ajaxAddPackage';
$route['ajax-add-particular'] = 'Cn_ajax/ajaxAddParticular';
$route['ajax-add-other-charges'] = 'Cn_ajax/ajaxAddOtherCharges';

#coommunication 
$route['send-message'] = 'Cn_communication/sendMessage';
$route['get-message-list'] = 'Cn_communication/index';

$route['send-quotes/(:num)'] = 'freightforwarder/send_quotes/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

#reports
$route['fs-reports/(Export|Import)'] = 'seller/reports/$1';
$route['fs-reports/(Export|Import)/(send-report)'] = 'seller/reports/$1/$2';
$route['ff-reports/(Export|Import)'] = 'freightforwarder/reports/$1';
$route['ff-reports/(Export|Import)/(send-report)'] = 'freightforwarder/reports/$1/$2';

$route['view-shipment-tracking/(:num)/(:num)'] = 'seller/view_shipment_tracking/$1/$2';
$route['view-shipment-tracking-ff/(:num)/(:num)'] = 'freightforwarder/view_shipment_tracking/$1/$2';


### Document management system ###
//fs-document-master-list
$route['fs-document-master-list'] = 'seller_dms/document_master_list';
$route['fs-create-document-master-form'] = 'seller_dms/create_document_master_form';

//fs-dms/rfc_id/
$route['fs-dms/(:num)'] = 'seller_dms/index/$1';

//fs-dms/create/rfc_id/document_type
$route['fs-dms/create/(:num)/(:any)'] = 'seller_dms/create/$1/$2';

//fs-dms/edit/rfc_id/document_type/document_id
$route['fs-dms/edit/(:num)/(:any)/(:num)'] = 'seller_dms/edit/$1/$2/$3';

//fs-dms/download/rfc_id/document_type
$route['fs-dms/download/(:num)/(:any)'] = 'seller_dms/download/$1/$2';

//fs-dms/download/rfc_id/document_type
$route['fs-dms/deleteDocument/(:num)/(:any)'] = 'seller_dms/deleteDocument/$1/$2';

//fs-dms/rfc_id/
$route['ff-dms/(:num)'] = 'seller_dms/index/$1';

//ff-dms/rfc_id/
$route['ff-dms/(:num)'] = 'Freightforwarder_dms/index/$1';
//ff-dms/download/rfc_id/document_type
$route['ff-dms/download/(:num)/(:any)'] = 'Freightforwarder_dms/download/$1/$2';

############################[ admin routes ]####################################################
$route['admin/login'] = 'login/index';
$route['admin/logout'] = 'login/logout';
$route['admin/dashboard'] = 'admin/Cn_dashboard/index';

#user Management
$route['admin/users'] = 'admin/Cn_user/index';
$route['admin/user/changeStatus'] = 'admin/Cn_user/changeStatus';
$route['admin/add-user'] = 'admin/Cn_user/add';
$route['admin/edit-user/(:num)'] = 'admin/Cn_user/add/$1';

#company Management
$route['admin/company/(freight-forwarder|exporter-importer)'] = 'admin/Cn_company/index/$1';
$route['admin/company/(freight-forwarder|exporter-importer)/add'] = 'admin/Cn_company/createCompany/$1';
$route['admin/view-company-details/(:num)'] = 'admin/Cn_company/viewDetails/$1';
$route['admin/rfc-list'] = 'admin/Cn_company/rfcList';
$route['admin/rfc-list/(:num)'] = 'admin/Cn_company/rfcList/$1';
$route['admin/ajaxRFCList'] = 'admin/Cn_company/ajaxRFCList';
$route['admin/ajaxRFCList/(:num)'] = 'admin/Cn_company/ajaxRFCList/$1';
$route['admin/booking-list'] = 'admin/Cn_company/bookingList';
$route['admin/booking-list/(:num)'] = 'admin/Cn_company/bookingList/$1';

$route['admin/ajaxBookingList'] = 'admin/Cn_company/ajaxBookingList';
$route['admin/ajaxBookingList/(:num)'] = 'admin/Cn_company/ajaxBookingList/$1';

$route['admin/view-shipping-requirement/(:num)/(:num)'] = 'admin/Cn_company/viewShipRequirment/$1/$2';
$route['admin/view-comparative/(:num)/(:num)'] = 'admin/Cn_company/viewComparative/$1/$2';
$route['admin/view-tracking/(:num)/(:num)'] = 'admin/Cn_company/viewTracking/$1/$2';
$route['admin/company/changeStatus'] = 'admin/Cn_company/changeStatus';
$route['admin/company/changePublicStatus'] = 'admin/Cn_company/changePublicStatus';

$route['admin/kyc-approval'] = 'admin/Cn_kyc_approval/index';
$route['admin/kyc-approval-change-status'] = 'admin/Cn_kyc_approval/changeStatus';

#Freight Forwarder Management
$route['admin/freight-forwarder-list'] = 'admin/Cn_freightForwarder/index';
$route['admin/freight-forwarder/changeStatus'] = 'admin/Cn_freightForwarder/changeStatus';


#Freight Seller Management
$route['admin/freight-seller-list'] = 'admin/Cn_freightSeller/index';
$route['admin/freight-seller/changeStatus'] = 'admin/Cn_freightSeller/changeStatus';


#invoice
$route['invoice'] = 'Invoice/index';
$route['proforma'] = 'Invoice/index';
$route['create/(invoice|proforma)'] = 'Invoice/add/$1';
$route['edit/(invoice|proforma)/(:num)'] = 'Invoice/add/$1/$2';
$route['download/(invoice|proforma)/(:num)'] = 'Invoice/downloadInvoice/$1/$2';
$route['send-to-customer/(invoice|proforma)/(:num)'] = 'Invoice/sendToCustomer/$1/$2';
$route['send-for-approval'] = 'Invoice/sendForApproval';
$route['ajax-add-invoice-item-row'] = 'Cn_ajax/ajaxAddInvoiceItemRow';
$route['ajax-get-proforma-invoice-list'] = 'Cn_ajax/ajaxGetProformaInvoiceList';

#invoice approval
$route['invoice-approval'] = 'Invoice_approval/index';
$route['view-invoice-approval/(:num)'] = 'Invoice_approval/view/$1';


#Billing Unit
$route['admin/billing-unit'] = 'admin/Cn_billing_unit/index';
$route['admin/billing-unit/add'] = 'admin/Cn_billing_unit/add';
$route['admin/billing-unit/edit/(:num)'] = 'admin/Cn_billing_unit/add/$1';
$route['admin/billing-unit/changeStatus'] = 'admin/Cn_billing_unit/changeStatus';

#Spend LOV 
$route['admin/spend-lov'] = 'admin/Cn_spend_lov/index';
$route['admin/spend-lov/add'] = 'admin/Cn_spend_lov/add';
$route['admin/spend-lov/edit/(:num)'] = 'admin/Cn_spend_lov/add/$1';
$route['admin/spend-lov/changeStatus'] = 'admin/Cn_spend_lov/changeStatus';

#Incentive scheme 
$route['admin/incentive-scheme'] = 'admin/Cn_incentive_scheme/index';
$route['admin/incentive-scheme/add'] = 'admin/Cn_incentive_scheme/add';
$route['admin/incentive-scheme/edit/(:num)'] = 'admin/Cn_incentive_scheme/add/$1';
$route['admin/incentive-scheme/changeStatus'] = 'admin/Cn_incentive_scheme/changeStatus';


#Port Management
$route['admin/ports'] = 'admin/Cn_port/index';
$route['admin/ajaxPorts'] = 'admin/Cn_port/ajaxPorts';
// $route['admin/ports/add'] = 'admin/Cn_incentive_scheme/add';
// $route['admin/incentive-scheme/edit/(:num)'] = 'admin/Cn_incentive_scheme/add/$1';
// $route['admin/incentive-scheme/changeStatus'] = 'admin/Cn_incentive_scheme/changeStatus';

#News and Event Management
$route['admin/news-and-events'] = 'admin/Cn_news/index';
$route['admin/ajaxNewsAndEvents'] = 'admin/Cn_news/ajaxNewsAndEvents';
$route['admin/news-and-events/add'] = 'admin/Cn_news/add';
$route['admin/news-and-events/edit/(:num)'] = 'admin/Cn_news/add/$1';
$route['admin/news-and-events/changeStatus'] = 'admin/Cn_news/changeStatus';

#News and Event Management
$route['admin/testimonial'] = 'admin/Cn_testimonial/index';
$route['admin/ajaxTestimonial'] = 'admin/Cn_testimonial/ajaxTestimonial';
$route['admin/testimonial/add'] = 'admin/Cn_testimonial/add';
$route['admin/testimonial/edit/(:num)'] = 'admin/Cn_testimonial/add/$1';
$route['admin/testimonial/changeStatus'] = 'admin/Cn_testimonial/changeStatus';


#Settings 
$route['admin/settings/general'] = 'admin/Cn_settings/general';
$route['admin/settings/social'] = 'admin/Cn_settings/social';


#cronjobs
$route['send-reminder-rfc'] = 'Cn_cronjob/send_reminder_rfc';
$route['send-reminder-awarded'] = 'Cn_cronjob/send_reminder_awarded';
$route['fs-send-status-report'] = 'Cn_cronjob/send_status_report_fs';
$route['ff-send-status-report'] = 'Cn_cronjob/send_status_report_ff';

#captch
$route['captcha'] = 'Cn_captcha/index';
$route['validate-captcha-text'] = 'Cn_captcha/validateCaptchaText';
