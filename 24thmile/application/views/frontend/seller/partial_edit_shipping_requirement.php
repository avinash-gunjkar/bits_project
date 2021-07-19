<style>
    .comment-group {
        border-bottom: none;
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

    .from-user {
        background-color: #d5ffd5;
        padding: 5px;
        margin-bottom: 5px;
        margin-left: 50px;
        margin-top: 5px;
    }

    .to-user {
        background-color: #f9f6f6;
        padding: 5px;
        margin-bottom: 5px;
        margin-top: 5px;
        margin-right: 50px;
    }

    .communication-box {
        background-color: #f0f0f0;
        max-height: 200px;
        overflow-y: scroll;
    }

    @media (min-width: 840px) {
        .mdl-grid {
            padding: 8px;
            width: 100% !important;
        }
    }
    .modal-dialog ul.nav-tabs{border-color:#dee2e6;}
</style>
<!-- Tracking start -->
<div class="wshipping-content-block">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="tracking-block">
                    <div class="tab-content">

                        <h3 class="heading3-border">Request for Freight Comparative (RFC) </h3>


                        <!-- <div class="wshipping-content-block shipping-block">
                            <div class="container">
                                <div class="row"> -->
                        <div class="shipping-form-block">

                            <?php $transactionCurrencyHtml =  "&nbsp;(" . ($requestDetails->transaction_currency ? $requestDetails->transaction_currency : 'INR') . ")"; ?>

                            <form id="frmRequirement" name="frmRequirement" method="post" action="<?= base_url('partial-edit-shipping-requirement/' . $requestDetails->request_id); ?>" enctype="multipart/form-data">

                                <input type="hidden" name="request_id" value="<?= $requestDetails->request_id ?>" />
                                <div class="shipping-form">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="text-left">
                                                    <address class="mb-1"><label>RFC ID:</label> <?= $requestDetails->request_id ?></address>
                                                    <address class="mb-1"><label>RFC Date : </label>
                                                        <?= printFormatedDate($requestDetails->created_at) ?></address>
                                                    <address class="mb-1"><label>Freight Forwarder : </label>
                                                        <a href="<?= base_url('company-details/' . $ff_details->company_id) ?>" target="_blank"><?= $ff_details->name ?></a>
                                                    </address>
                                                    <address>
                                                        <label>Shipment Status:</label>
                                                        <span class='status badge <?= str_replace(' ', '-', strtolower($requestDetails->status_title)) ?>'><?= $requestDetails->status_title ? $requestDetails->status_title : '- -' ?></span>
                                                        <span class="text-warning"> <?= $requestDetails->status == 4 ? ' - Decision (Accept / Reject) Pending By Freight Forwarder' : '' ?></span>
                                                    </address>
                                                </td>
                                                <td class="text-left">
                                                    <address class="mb-1">
                                                        <label>Transaction : </label>
                                                        <?= $requestDetails->transaction ?>
                                                    </address>
                                                    <address class="mb-1">
                                                        <label>Mode : </label>
                                                        <?= $requestDetails->mode ?>
                                                    </address>
                                                    <address class="mb-1">
                                                        <label>Delivery Term :</label>
                                                        <?= $requestDetails->delivery_term_name ?>
                                                    </address>
                                                    <address class="mb-1">
                                                        <label>Shipment Type :</label><?= $requestDetails->shipment ?>
                                                    </address>
                                                </td>
                                                <td class="text-left">
                                                    <address class="mb-1">
                                                        <label>Cargo Type:</label> <?= $requestDetails->container_stuffing ?>
                                                    </address>
                                                    <address class="mb-1">
                                                        <label>Cargo Nature :</label>
                                                        <?= $requestDetails->cargo_status ?>

                                                    </address>
                                                    <?php if (!empty($requestDetails->stuffing)) { ?>
                                                        <address class="mb-1">
                                                            <label><?=($requestDetails->transaction == "Import")?"De-stuffing":"Stuffing"?> :</label>
                                                            <?= $requestDetails->stuffing ?>
                                                        </address>

                                                    <?php } ?>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>

                                    <div class="clearfix"></div>
                                            <div class="container">
                                            <div class="row">
                                               
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class=" fileUpload btn btn-secondary btn-sm">
                                                        <span>Attach MSDS</span>
                                                        <input type="file" id="attach_msds" name="attach_msds" class="upload attach_msds" />

                                                    </div>

                                                    <div class="selected-file-name"><?= printDocumentLink($requestDetails->msds_doc) ?></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class=" fileUpload btn btn-secondary btn-sm">
                                                        <span>Attach Product Specification</span>
                                                        <input type="file" id="attach_product_specification" name="attach_product_specification" class="upload attach_product_specification" />
                                                    </div>
                                                    <div class="selected-file-name"><?= printDocumentLink($requestDetails->product_specification_doc) ?></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class=" fileUpload btn btn-secondary btn-sm">
                                                        <span>Attach Other Documents1</span>
                                                        <input type="file" id="attach_other_documents_1" name="attach_other_documents_1" class="upload attach_other_documents_1" />
                                                    </div>
                                                    <div class="selected-file-name"><?= printDocumentLink($requestDetails->other_doc_1) ?></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <div class=" fileUpload btn btn-secondary btn-sm">
                                                        <span>Attach Other Documents2</span>
                                                        <input type="file" id="attach_other_documents_2" name="attach_other_documents_2" class="upload attach_other_documents_2" />
                                                    </div>
                                                    <div class="selected-file-name"><?= printDocumentLink($requestDetails->other_doc_2) ?></div>
                                                </div>
                                            </div>
                                            </div>
                                            </div>
                                    <div class="form-group">


                                        <div class="row">
                                            <div class="col-lg-6 mt-0">
                                                <h3><b>Consignor/Pick up</b> <a href="javascript:void(0);" onclick="$('#selectBranchAddress').modal('show')" class="btn btn-primary btn-sm ">Select Address</a></h3>
                                                <div class="form-row mb-3 ">
                                                    <div class="col-6">
                                                        <label>Company Name <sup>*</sup></label>
                                                        <input type="text" class="form-control" name="consignor_company_name" id="consignor_company_name" placeholder="Company Name" maxlength="50" value="<?= $requestDetails->consignor_company_name ? $requestDetails->consignor_company_name : $sellerCompanyDetails->name; ?>">

                                                    </div>
                                                    <div class="col-6">
                                                        <label>Email <sup>*</sup></label>

                                                        <input type="text" class="form-control" name="consignor_email" id="consignor_email" aria-describedby="consignor_email-error" placeholder="Email" maxlength="50" value="<?= $requestDetails->consignor_email ? $requestDetails->consignor_email : $this->seller_session_data['email']; ?>">

                                                        <span id="consignor_email-error" class="error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-row mb-3">
                                                    <div class="col-6">
                                                        <label>Address line 1 <sup>*</sup></label>
                                                        <input type="text" class="form-control" name="consignor_address_line_1" id="consignor_address_line_1" placeholder="Address line 1" maxlength="50" value="<?= $requestDetails->consignor_address_line_1; ?>">
                                                    </div>
                                                    <div class="col-6">
                                                        <label>Address line 2</label>
                                                        <input type="text" class="form-control" name="consignor_address_line_2" id="consignor_address_line_2" placeholder="Address line 2" maxlength="50" value="<?= $requestDetails->consignor_address_line_2; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-row mb-3 from-profileCitySearch">
                                                    <div class="col-6">
                                                        <label>City, State, Country <sup>*</sup></label>
                                                        <input type="text" class="form-control search-box" name="consignor_city_name" id="consignor_city_name" placeholder="Type City Name" autocomplete="off" value="<?= $requestDetails->consignor_city_name; ?>">
                                                        <div class="suggesstion-box" style="padding:0px;border:#F0F0F0 1px solid; display:none;"></div>
                                                        <input type="hidden" class="cityId" id="consignor_city_id" name="consignor_city_id" value="<?= $requestDetails->consignor_city_id; ?>">
                                                        <input type="hidden" class="stateId" id="consignor_state_id" name="consignor_state_id" value="<?= $requestDetails->consignor_state_id; ?>">
                                                        <input type="hidden" class="countryId" id="consignor_country_id" name="consignor_country_id" value="<?= $requestDetails->consignor_country_id; ?>">
                                                    </div>
                                                    <div class="col-6">


                                                        <label>Pin Code <sup>*</sup></label>
                                                        <input type="text" class="form-control" name="consignor_pincode" id="consignor_pincode" placeholder="Pin Code" maxlength="10" value="<?= $requestDetails->consignor_pincode; ?>">
                                                    </div>
                                                </div>



                                                <div class="form-row mb-3 ">
                                                    <div class="col-6">
                                                        <label>Contact Person Name <sup>*</sup></label>
                                                        <input type="text" class="form-control" name="consignor_name" id="consignor_name" placeholder="Contact Person Name" maxlength="50" value="<?= $requestDetails->consignor_name; ?>">
                                                    </div>
                                                    <div class="col-6">
                                                        <label>Contact Number <sup>*</sup></label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <select class="input-group-text custom-select" name="consignor_country_code" id="consignor_country_code">
                                                                    <?php foreach (getCountryDialCodes() as $countryDial) { ?>
                                                                        <option value="<?= $countryDial->dial_code ?>" <?= $requestDetails->consignor_country_code == $countryDial->dial_code || (empty($requestDetails->consignor_country_code) && $countryDial->dial_code == '+91') ? ' selected ' : '' ?>><?= $countryDial->dial_code ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <input type="text" class="form-control" id="consignor_phone" name="consignor_phone" aria-describedby="consignor_phone-error" placeholder="Contact Number" maxlength="15" value="<?= $requestDetails->consignor_phone; ?>">
                                                        </div>
                                                        <span id="consignor_phone-error" class="error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-row mb-3 ">
                                                    <div class="col-6">
                                                        <label><input type="checkbox" id="is_other_consignor" name="is_other_consignor" value="Yes" <?= $requestDetails->is_other_consignor == 'Yes' ? 'checked' : '' ?>> Seller if other than Consignor</label>
                                                    </div>
                                                </div>
                                                <div id="consignor_other_details" style=" <?= $requestDetails->is_other_consignor != 'Yes' ? 'display:none;' : '' ?>">
                                                    <div class="clearfix"></div>
                                                    <div class="form-row mb-3 ">
                                                        <div class="col-6">
                                                            <label>Company Name <sup>*</sup></label>
                                                            <input type="text" class="form-control" name="consignor_other[company_name]" id="consignor_other_company_name" placeholder="Company Name" maxlength="50" value="<?= $requestDetails->consignor_other->company_name ?>">

                                                        </div>
                                                        <div class="col-6">
                                                            <label>Email <sup>*</sup></label>

                                                            <input type="text" class="form-control" name="consignor_other[email]" id="consignor_other_email" aria-describedby="consignor_other_email-error" placeholder="Email" maxlength="50" value="<?= $requestDetails->consignor_other->email; ?>">

                                                            <span id="consignor_other_email-error" class="error"></span>
                                                        </div>
                                                    </div>

                                                    <div class="form-row mb-3">
                                                        <div class="col-6">
                                                            <label>Address line 1 <sup>*</sup></label>
                                                            <input type="text" class="form-control" name="consignor_other[address_line_1]" id="consignor_other_address_line_1" placeholder="Address line 1" maxlength="50" value="<?= $requestDetails->consignor_other->address_line_1; ?>">
                                                        </div>
                                                        <div class="col-6">
                                                            <label>Address line 2</label>
                                                            <input type="text" class="form-control" name="consignor_other[address_line_2]" id="consignor_other_address_line_2" placeholder="Address line 2" maxlength="50" value="<?= $requestDetails->consignor_other->address_line_2; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-row mb-3 from-other-profileCitySearch">
                                                        <div class="col-6">
                                                            <label>City, State, Country <sup>*</sup></label>
                                                            <input type="text" class="form-control search-box" name="consignor_other[city_name]" id="consignor_other_city_name" placeholder="Type City Name" autocomplete="off" value="<?= $requestDetails->consignor_other->city_name; ?>">
                                                            <div class="suggesstion-box" style="padding:0px;border:#F0F0F0 1px solid; display:none;"></div>
                                                            <input type="hidden" class="cityId" id="consignor_other_city_id" name="consignor_other[city_id]" value="<?= $requestDetails->consignor_other->city_id; ?>">
                                                            <input type="hidden" class="stateId" id="consignor_other_state_id" name="consignor_other[state_id]" value="<?= $requestDetails->consignor_other->state_id; ?>">
                                                            <input type="hidden" class="countryId" id="consignor_other_country_id" name="consignor_other[country_id]" value="<?= $requestDetails->consignor_other->country_id; ?>">
                                                        </div>
                                                        <div class="col-6">


                                                            <label>Pin Code <sup>*</sup></label>
                                                            <input type="text" class="form-control" name="consignor_other[pincode]" id="consignor_other_pincode" placeholder="Pin Code" maxlength="10" value="<?= $requestDetails->consignor_other->pincode; ?>">
                                                        </div>
                                                    </div>



                                                    <div class="form-row mb-3 ">
                                                        <div class="col-6">
                                                            <label>Contact Person Name <sup>*</sup></label>
                                                            <input type="text" class="form-control" name="consignor_other[name]" id="consignor_other_name" placeholder="Contact Person Name" maxlength="50" value="<?= $requestDetails->consignor_other->name; ?>">
                                                        </div>
                                                        <div class="col-6">
                                                            <label>Contact Number <sup>*</sup></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <select class="input-group-text custom-select" name="consignor_other[country_code]" id="consignor_other_country_code">
                                                                        <?php foreach (getCountryDialCodes() as $countryDial) { ?>
                                                                            <option value="<?= $countryDial->dial_code ?>" <?= $requestDetails->consignor_other->country_code == $countryDial->dial_code || (empty($requestDetails->consignor_other->country_code) && $countryDial->dial_code == '+91') ? ' selected ' : '' ?>><?= $countryDial->dial_code ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                                <input type="text" class="form-control" id="consignor_other_phone" name="consignor_other[phone]" aria-describedby="consignor_other_phone-error" placeholder="Contact Number" maxlength="15" value="<?= $requestDetails->consignor_other->phone; ?>">
                                                            </div>
                                                            <span id="consignor_other_phone-error" class="error"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mt-0">
                                                <h3><b>Consignee/Deliver To</b> <a href="javascript:void(0);" onclick="$('#selectConsigneeAddress').modal('show')" class="btn btn-primary btn-sm ">Select Address</a></h3>
                                                <div class="form-row mb-3">
                                                    <div class="col-6">
                                                        <label>Company Name <sup>*</sup></label>
                                                        <input type="text" class="form-control" name="consignee_company_name" id="consignee_company_name" placeholder="Company Name" maxlength="50" value="<?= $requestDetails->consignee_company_name; ?>">
                                                    </div>
                                                    <div class="col-6">
                                                        <label>Email <sup>*</sup></label>

                                                        <input type="text" class="form-control" name="consignee_email" aria-describedby="consignee_email-error" placeholder="Email" maxlength="50" value="<?= $requestDetails->consignee_email; ?>">

                                                        <span id="consignee_email-error" class="error"></span>
                                                    </div>
                                                </div>

                                                <div class="form-row mb-3">
                                                    <div class="col-6">
                                                        <label>Address line 1 <sup>*</sup></label>
                                                        <input type="text" class="form-control" name="consignee_address_line_1" id="consignee_address_line_1" placeholder="Address line 1" maxlength="50" value="<?= $requestDetails->consignee_address_line_1; ?>"></div>
                                                    <div class="col-6">

                                                        <label>Address line 2</label>
                                                        <input type="text" class="form-control" name="consignee_address_line_2" id="consignee_address_line_2" placeholder="Address line 2" maxlength="50" value="<?= $requestDetails->consignee_address_line_2; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-row mb-3 to-profileCitySearch">
                                                    <div class="col-6">
                                                        <label>City, State, Country <sup>*</sup></label>
                                                        <input type="text" class="form-control search-box" name="consignee_city_name" id="consignee_city_name" placeholder="Type City Name" autocomplete="off" value="<?= $requestDetails->consignee_city_name; ?>">
                                                        <div class="suggesstion-box" style="padding:0px;border:#F0F0F0 1px solid; display:none;"></div>
                                                        <input type="hidden" class="cityId" id="consignee_city_id" name="consignee_city_id" value="<?= $requestDetails->consignee_city_id; ?>">
                                                        <input type="hidden" class="stateId" id="consignee_state_id" name="consignee_state_id" value="<?= $requestDetails->consignee_state_id; ?>">
                                                        <input type="hidden" class="countryId" id="consignee_country_id" name="consignee_country_id" value="<?= $requestDetails->consignee_country_id; ?>">
                                                    </div>
                                                    <div class="col-6">
                                                        <label>Pin Code <sup>*</sup></label>
                                                        <input type="text" class="form-control" name="consignee_pincode" id="consignee_pincode" placeholder="Pin Code" maxlength="10" value="<?= $requestDetails->consignee_pincode; ?>">
                                                    </div>


                                                </div>


                                                <div class="form-row mb-3">
                                                    <div class="col-6">
                                                        <label>Contact Person Name <sup>*</sup></label>
                                                        <input type="text" class="form-control" name="consignee_name" id="consignee_name" placeholder="Contact Person Name" maxlength="50" value="<?= $requestDetails->consignee_name; ?>">
                                                    </div>
                                                    <div class="col-6">
                                                        <label>Contact Number <sup>*</sup></label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <select class="input-group-text custom-select" name="consignee_country_code" id="contact_country_code">
                                                                    <?php foreach (getCountryDialCodes() as $countryDial) { ?>
                                                                        <option value="<?= $countryDial->dial_code ?>" <?= $requestDetails->consignee_country_code == $countryDial->dial_code || (empty($requestDetails->consignee_country_code) && $countryDial->dial_code == '+91') ? ' selected ' : '' ?>><?= $countryDial->dial_code ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <input type="text" class="form-control" name="consignee_phone" aria-describedby="consignee_phone-error" placeholder="Contact Number" maxlength="15" value="<?= $requestDetails->consignee_phone; ?>">
                                                        </div>
                                                        <span id="consignee_phone-error" class="error"></span>
                                                    </div>
                                                </div>
                                                <div class="form-row mb-3 ">
                                                    <div class="col-6">
                                                        <label><input type="checkbox" id="is_other_consignee" name="is_other_consignee" value="Yes" <?= $requestDetails->is_other_consignee == 'Yes' ? 'checked' : '' ?>> Buyer if other than Consignee</label>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div id="consignee_other_details" style="<?= $requestDetails->is_other_consignee != 'Yes' ? 'display:none;' : '' ?>">
                                                    <div class="form-row mb-3">
                                                        <div class="col-6">
                                                            <label>Company Name <sup>*</sup></label>
                                                            <input type="text" class="form-control" name="consignee_other[company_name]" id="consignee_other_company_name" placeholder="Company Name" maxlength="50" value="<?= $requestDetails->consignee_other->name; ?>">
                                                        </div>
                                                        <div class="col-6">
                                                            <label>Email <sup>*</sup></label>

                                                            <input type="text" class="form-control" name="consignee_other[email]" aria-describedby="consignee_other_email-error" placeholder="Email" maxlength="50" value="<?= $requestDetails->consignee_other->email; ?>">

                                                            <span id="consignee_other_email-error" class="error"></span>
                                                        </div>
                                                    </div>

                                                    <div class="form-row mb-3">
                                                        <div class="col-6">
                                                            <label>Address line 1 <sup>*</sup></label>
                                                            <input type="text" class="form-control" name="consignee_other[address_line_1]" id="consignee_other_address_line_1" placeholder="Address line 1" maxlength="50" value="<?= $requestDetails->consignee_other->address_line_1; ?>"></div>
                                                        <div class="col-6">

                                                            <label>Address line 2</label>
                                                            <input type="text" class="form-control" name="consignee_other[address_line_2]" id="consignee_other_address_line_2" placeholder="Address line 2" maxlength="50" value="<?= $requestDetails->consignee_other->address_line_2; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-row mb-3 to-other-profileCitySearch">
                                                        <div class="col-6">
                                                            <label>City, State, Country <sup>*</sup></label>
                                                            <input type="text" class="form-control search-box" name="consignee_other[city_name]" id="consignee_other_city_name" placeholder="Type City Name" autocomplete="off" value="<?= $requestDetails->consignee_other->city_name; ?>">
                                                            <div class="suggesstion-box" style="padding:0px;border:#F0F0F0 1px solid; display:none;"></div>
                                                            <input type="hidden" class="cityId" id="consignee_other_city_id" name="consignee_other[city_id]" value="<?= $requestDetails->consignee_other->city_id; ?>">
                                                            <input type="hidden" class="stateId" id="consignee_other_state_id" name="consignee_other[state_id]" value="<?= $requestDetails->consignee_other->state_id; ?>">
                                                            <input type="hidden" class="countryId" id="consignee_other_country_id" name="consignee_other[country_id]" value="<?= $requestDetails->consignee_other->country_id; ?>">
                                                        </div>
                                                        <div class="col-6">
                                                            <label>Pin Code <sup>*</sup></label>
                                                            <input type="text" class="form-control" name="consignee_other[pincode]" id="consignee_other_other_pincode" placeholder="Pin Code" maxlength="10" value="<?= $requestDetails->consignee_other->pincode; ?>">
                                                        </div>
                                                    </div>


                                                    <div class="form-row mb-3">
                                                        <div class="col-6">
                                                            <label>Contact Person Name <sup>*</sup></label>
                                                            <input type="text" class="form-control" name="consignee_other[name]" id="consignee_other_name" placeholder="Contact Person Name" maxlength="50" value="<?= $requestDetails->consignee_other->name; ?>">
                                                        </div>
                                                        <div class="col-6">
                                                            <label>Contact Number <sup>*</sup></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <select class="input-group-text custom-select" name="consignee_other[country_code]" id="contact_other_country_code">
                                                                        <?php foreach (getCountryDialCodes() as $countryDial) { ?>
                                                                            <option value="<?= $countryDial->dial_code ?>" <?= $requestDetails->consignee_other->country_code == $countryDial->dial_code || (empty($requestDetails->consignee_other->country_code) && $countryDial->dial_code == '+91') ? ' selected ' : '' ?>><?= $countryDial->dial_code ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                                <input type="text" class="form-control" name="consignee_other[phone]" aria-describedby="consignee_other_phone-error" placeholder="Contact Number" maxlength="15" value="<?= $requestDetails->consignee_other->phone; ?>">
                                                            </div>
                                                            <span id="consignee_other_phone-error" class="error"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="form-group" style="margin-top: 20px;">
                                            <div class="row mb-3">
                                                <div class="col-3">
                                                    <label>Shipment Value</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <select class="input-group custom-select" name="shipment_value_currency" style="width: 80px;" aria-describedby="shipment_value_currency-error">
                                                                <option selected disabled>Currency</option>
                                                                <?php foreach (getCountryCurrency() as $countryCurrency) { ?>
                                                                    <option value="<?=$countryCurrency->currency?>" <?= $requestDetails->shipment_value_currency == $countryCurrency->currency ? 'selected' : ''; ?>><?= $countryCurrency->currency ?></option>
                                                                <?php } ?>

                                                            </select>
                                                        </div>

                                                        <input type="text" aria-describedby="shipment_value-error" class="form-control decimal-numbers" name="shipment_value" id="shipment_value" value="<?= $requestDetails->shipment_value ?>" />
                                                    </div>
                                                    <span id="shipment_value_currency-error" class="error"></span> &nbsp;
                                                    <span id="shipment_value-error" class="error"></span>
                                                </div>

                                                <div class="col-3">
                                                    <label>Tentative Date of Dispatch <sup>*</sup></label>
                                                    <div class="input-comment">
                                                        <input type="text" name="tentativ_date_dispatch" id="tentativ_date_dispatch" class="form-control future-date-picker" placeholder="DD-MMM-YYYY" value="<?= printFormatedDate($requestDetails->tentativ_date_dispatch); ?>" />
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <label>Offer response on or before <sup>*</sup></label>
                                                    <input type="text" class="form-control future-date-picker" name="response_end_date" placeholder="DD-MMM-YYYY" value="<?= printFormatedDate($requestDetails->response_end_date) ?>" />

                                                </div>
                                                <div class="col-3">
                                                    <label>Expected Payment Term </label>
                                                    <input type="text" list="payment_term_list" autocomplete="off" class="form-control" name="payment_term" value="<?= $requestDetails->payment_term ?>" maxlength="50" />
                                                    <datalist id="payment_term_list">
                                                        <option value="100% Advance">100% Advance</option>
                                                        <option value="50% Advance 50% Against Delivery">50% Advance 50% Against Delivery</option>
                                                        <option value="15 days from Service Invoice date">15 days from Service Invoice date</option>
                                                        <option value="30 days from Service Invoice date">30 days from Service Invoice date</option>
                                                        <option value="45 days from Service Invoice date">45 days from Service Invoice date</option>
                                                        <option value="60 days from Service Invoice date">60 days from Service Invoice date</option>
                                                        <option value="90 days from Service Invoice date">90 days from Service Invoice date</option>
                                                        <option value="">Other</option>
                                                    </datalist>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row mb-3 mode-sea" style="<?= in_array($requestDetails->mode_id, ['2', '3']) ? '' : 'display:none;' ?> ">

                                            <div class="col-12 col-lg-4 loading-port-search ">
                                                <label>Port of Loading<sup>*</sup></label>
                                                <div class="input-comment">
                                                    <input type="text" class="form-control search-box" name="port_loading_name" id="port_loading_name" placeholder="Type port name" autocomplete="off" value="<?= $requestDetails->port_loading_name; ?>" />
                                                    <div class="suggesstion-box" style="padding:0px;border:#F0F0F0 1px solid; display:none;"></div>
                                                    <input type="hidden" class="port_loading_id" id="port_loading_id" name="port_loading_id" value="<?= $requestDetails->port_loading_id; ?>">

                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-4 discharge-port-search">
                                                <label>Port of Discharge<sup>*</sup></label>
                                                <div class="input-comment">
                                                    <input type="text" class="form-control search-box" name="port_discharge_name" id="port_discharge_name" placeholder="Type port name" autocomplete="off" value="<?= $requestDetails->port_discharge_name; ?>" />
                                                    <div class="suggesstion-box" style="padding:0px;border:#F0F0F0 1px solid; display:none;"></div>
                                                    <input type="hidden" class="port_discharge_id" id="port_discharge_id" name="port_discharge_id" value="<?= $requestDetails->port_discharge_id; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-12 col-lg-12">
                                                <label>Any Special Consideration for Shipment</label>
                                                <div class="input-comment">
                                                    <textarea class="form-control" name="special_consideration_lcl" id="special_consideration_lcl" placeholder="Refrigerated container,  specific temperature, multiple type of goods,  special packing requirement."><?= $requestDetails->special_consideration_lcl; ?></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- <h3><b>Material Detail</b></h3> -->

                                        <?php $this->load->view('frontend/seller/shipping_container_list', ['requestDetails' => $requestDetails]); ?>
                                        <?php $this->load->view('frontend/seller/shipping_packaging_list', ['requestDetails' => $requestDetails]); ?>



                                        <div class="col-lg-12 text-center mt-5">
                                            <a href="javascript:void(0)" onclick="window.history.back();" class="btn btn-secondary btn-md">Go Back</a>
                                            <input type="submit" name="submit" class="btn btn-submit btn-md" value="Save" />


                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- </div>
                            </div>
                        </div> -->



                    </div>

                </div>


            </div>
        </div>

    </div>
</div>
<!-- Blog content end -->
</section><!-- sidebar_dashboard-->
</div> <!-- sidebar_dashboard-->

<script src="<?php echo base_url('assets/frontend/js/vendor/jquery-2.2.4.min.js'); ?>"></script>

<!--Start:: add City Modal -->
<div class="modal fade" id="addNewCityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add City</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addCityFrm" name="addCityFrm" method="post" action="">
                    <div class="form-group">
                        <input type="hidden" name="city_prefix" value="" id="city_prefix">
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="country">Country</label>
                                <input type="text" class="form-control alpha-num-space" placeholder="Country" id="country" name="country" maxlength="50" required="">
                            </div>
                            <div class="col-lg-4">
                                <label for="state">State</label>
                                <input type="text" class="form-control alpha-num-space" placeholder="State" id="state" name="state" maxlength="50" required>
                            </div>
                            <div class="col-lg-4">
                                <label for="city">City</label>
                                <input type="text" class="form-control alpha-num-space" placeholder="City" id="city" name="city" maxlength="50" required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--End:: add City Modal -->

<!--Start:: add Port Modal -->
<div class="modal fade" id="addNewPortModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Port</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addPortFrm" name="addPortFrm" method="post" action="">
                    <div class="form-group">
                        <input type="hidden" name="port_type" value="" id="port_type">
                        <input type="hidden" name="port_prefix" value="" id="port_prefix">
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="port_name">Port Name</label>
                                <input type="text" class="form-control alpha-num-space" placeholder="Port Name" id="port_name" name="port_name" maxlength="50" required="">
                            </div>
                            <div class="col-lg-4">
                                <label for="port_city">City</label>
                                <input type="text" class="form-control alpha-num-space" placeholder="City" id="port_city" name="port_city" maxlength="50">
                            </div>
                            <div class="col-lg-4">
                                <label for="iso_country">Country Code</label>
                                <input type="text" class="form-control alpha-num-space text-uppercase" placeholder="IN" id="iso_country" name="iso_country" required="" maxlength="3">
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--End:: add port Modal -->


<!--Start:: Select address from branch -->

<div class="modal fade" id="selectBranchAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg mw-100 w-75" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Select Consignor/Pick up Address</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" role="tablist">

                    <li class="nav-item"><a class="nav-link text-primary active" data-toggle="tab" href="#tabConsignorAddress1" aria-controls="selectFF">Branch Address </a></li>
                    <li class="nav-item"><a class="nav-link text-primary " data-toggle="tab" href="#tabConsignorAddress2" aria-controls="useContract">Consignee Address </a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="tabConsignorAddress1">
                    <table class="mdl-data-table dataTable " style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Branch Name</th>
                                    <th>Address</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Fax</th>
                                    <th>Contact Person</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($compnayBranch as $key => $branch) { ?>
                                    <tr style="cursor: pointer">
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $branch->branch_name ?></td>
                                        <td><?= $branch->address_line_1 ?><br><?= $branch->address_line_2 ?></td>
                                        <td><?= $branch->email ?></td>
                                        <td><?= $branch->phone ?></td>
                                        <td><?= $branch->fax ?></td>
                                        <td><?= $branch->contact_person ?></td>
                                        <td><input type="button" class="btn btn-sm btn-primary btn-select" onclick="selectAddress(<?= $key ?>,'#consignor')" value="Select" /></td>
                                    </tr>
                                <?php } ?>
                                <?php if (empty($compnayBranch)) { ?>
                                    <tr>
                                        <td colspan="8">No data available in table</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="tabConsignorAddress2">
                    <table class="mdl-data-table dataTable " style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Company Name</th>
                                    <th>Address</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Fax</th>
                                    <th>Contact Person</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($consigneeAddressList as $key => $branch) { ?>
                                    <tr style="cursor: pointer">
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $branch->branch_name ?></td>
                                        <td><?= $branch->address_line_1 ?><br><?= $branch->address_line_2 ?></td>
                                        <td><?= $branch->email ?></td>
                                        <td><?= $branch->phone ?></td>
                                        <td><?= $branch->fax ?></td>
                                        <td><?= $branch->contact_person ?></td>
                                        <td><input type="button" class="btn btn-sm btn-primary btn-select" onclick="selectConsigneeAddress(<?= $key ?>,'#consignor')" value="Select" /></td>
                                    </tr>
                                <?php } ?>
                                <?php if (empty($compnayBranch)) { ?>
                                    <tr>
                                        <td colspan="8">No data available in table</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--End:: Select address from branch -->
<!--Start:: Select address from consignee -->

<div class="modal fade" id="selectConsigneeAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg mw-100 w-75" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Select Consignee/Deliver To Address</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" role="tablist">

                    <li class="nav-item"><a class="nav-link text-primary active" data-toggle="tab" href="#tabConsigneeAddress1" aria-controls="selectFF">Branch Address </a></li>
                    <li class="nav-item"><a class="nav-link text-primary " data-toggle="tab" href="#tabConsigneeAddress2" aria-controls="useContract">Consignee Address </a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="tabConsigneeAddress1">
                    <table class="mdl-data-table dataTable " style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Branch Name</th>
                                    <th>Address</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Fax</th>
                                    <th>Contact Person</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($compnayBranch as $key => $branch) { ?>
                                    <tr style="cursor: pointer">
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $branch->branch_name ?></td>
                                        <td><?= $branch->address_line_1 ?><br><?= $branch->address_line_2 ?></td>
                                        <td><?= $branch->email ?></td>
                                        <td><?= $branch->phone ?></td>
                                        <td><?= $branch->fax ?></td>
                                        <td><?= $branch->contact_person ?></td>
                                        <td><input type="button" class="btn btn-sm btn-primary btn-select" onclick="selectAddress(<?= $key ?>,'#consignee')" value="Select" /></td>
                                    </tr>
                                <?php } ?>
                                <?php if (empty($compnayBranch)) { ?>
                                    <tr>
                                        <td colspan="8">No data available in table</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="tabConsigneeAddress2">
                        <table class="mdl-data-table dataTable " style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Branch Name</th>
                                    <th>Address</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Fax</th>
                                    <th>Contact Person</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($consigneeAddressList as $key => $branch) { ?>
                                    <tr style="cursor: pointer">
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $branch->branch_name ?></td>
                                        <td><?= $branch->address_line_1 ?><br><?= $branch->address_line_2 ?></td>
                                        <td><?= $branch->email ?></td>
                                        <td><?= $branch->phone ?></td>
                                        <td><?= $branch->fax ?></td>
                                        <td><?= $branch->contact_person ?></td>
                                        <td><input type="button" class="btn btn-sm btn-primary btn-select" onclick="selectConsigneeAddress(<?= $key ?>,'#consignee')" value="Select" /></td>
                                    </tr>
                                <?php } ?>
                                <?php if (empty($compnayBranch)) { ?>
                                    <tr>
                                        <td colspan="8">No data available in table</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--End:: Select address from consignee -->

<script src="<?php echo base_url('assets/frontend/js/vendor/jquery.validate.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link href="<?php echo base_url('assets/frontend/js/bs4-pop/bs4.pop.css'); ?>" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('assets/frontend/js/bs4-pop/bs4.pop.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    var session_user_id = '<?= $this->session->userdata("seller_logged_in")['id']; ?>';


    $('#addNewCityModal button[type="submit"]').click(function(e) {
        var city_prefix = $('#city_prefix').val();
        var city = $('#addNewCityModal #city').val();
        var state = $('#addNewCityModal #state').val();
        var country = $('#addNewCityModal #country').val();
        e.preventDefault();
        $('#addCityFrm').validate({
            rules: {
                country: {
                    required: true
                },
                state: {
                    required: true
                },
                city: {
                    required: true
                },
            }
        });
        if (!$('#addCityFrm').valid()) {
            return false;
        }
        $.ajax({
            type: 'post',
            url: '<?php echo base_url('ajax-add-city'); ?>',
            //dataType:'json',
            data: {
                country: country,
                state: state,
                city: city,
                session_user_id: session_user_id
            },
            success: function(response) {
                var json_response = JSON.parse(response);
                console.log(city_prefix, json_response);
                $('#' + city_prefix + '_city_id').val(json_response.city_id);
                $('#' + city_prefix + '_state_id').val(json_response.state_id);
                $('#' + city_prefix + '_country_id').val(json_response.country_id);
                $('#' + city_prefix + '_city_name').val(json_response.city_name);
                $('#addNewCityModal').modal('hide');
            }
        });
    });


    $('#addNewPortModal button[type="submit"]').click(function(e) {
        var port_prefix = $('#addNewPortModal #port_prefix').val();
        var port_type = $('#addNewPortModal #port_type').val();
        var port_name = $('#addNewPortModal #port_name').val();
        var port_city = $('#addNewPortModal #port_city').val();
        var iso_country = $('#addNewPortModal #iso_country').val();
        e.preventDefault();
        $('#addPortFrm').validate({
            rules: {
                port_name: {
                    required: true
                },
                iso_country: {
                    required: true
                },
            }
        });
        if (!$('#addPortFrm').valid()) {
            return false;
        }
        $.ajax({
            type: 'post',
            url: '<?php echo base_url('ajax-add-port'); ?>',
            //dataType:'json',
            data: {
                port_name: port_name,
                port_city: port_city,
                iso_country: iso_country,
                port_type: port_type,
                session_user_id: session_user_id
            },
            success: function(response) {
                var json_response = JSON.parse(response);
                console.log(port_prefix, json_response);
                $('#' + port_prefix + '_name').val(json_response.port_name);
                $('#' + port_prefix + '_id').val(json_response.port_id);
                $('#addNewPortModal').modal('hide');
            }
        });
    });

    //$(document).ready(function(){
    $('#is_other_consignor').click(function() {
        if ($('#is_other_consignor:checked').val() == 'Yes') {
            $('#consignor_other_details').show()
        } else {
            $('#consignor_other_details').hide()
        }
    });
    // $('#consignor_other').click();

    $('#is_other_consignee').click(function() {
        if ($('#is_other_consignee:checked').val() == 'Yes') {
            $('#consignee_other_details').show()
        } else {
            $('#consignee_other_details').hide()
        }
    });
    // $('#consignee_other').click();
    //})

    var branchlist = <?= json_encode($compnayBranch) ?>;
    var consignorAddresslist = <?= json_encode($consigneeAddressList) ?>;

    function selectAddress(index,addressType) {

$(addressType+'_company_name').val(branchlist[index].branch_name);
$(addressType+'_address_line_1').val(branchlist[index].address_line_1);
$(addressType+'_address_line_2').val(branchlist[index].address_line_2);
$(addressType+'_city_name').val(branchlist[index].city_name);
$(addressType+'_city_id').val(branchlist[index].city_id);
$(addressType+'_state_id').val(branchlist[index].state_id);
$(addressType+'_country_id').val(branchlist[index].country_id);
$(addressType+'_name').val(branchlist[index].contact_person);
$(addressType+'_pincode').val(branchlist[index].pincode);
$(addressType+'_phone').val(branchlist[index].phone);
$(addressType+'_country_code').val(branchlist[index].contact_country_code);
$(addressType+'_email').val(branchlist[index].email);
if(addressType=='#consignee'){
    $('#selectConsigneeAddress').modal('hide');
}else{
    $('#selectBranchAddress').modal('hide');
}

}

function selectConsigneeAddress(index,addressType) {

$(addressType+'_company_name').val(consignorAddresslist[index].branch_name);
$(addressType+'_address_line_1').val(consignorAddresslist[index].address_line_1);
$(addressType+'_address_line_2').val(consignorAddresslist[index].address_line_2);
$(addressType+'_city_name').val(consignorAddresslist[index].city_name);
$(addressType+'_city_id').val(consignorAddresslist[index].city_id);
$(addressType+'_state_id').val(consignorAddresslist[index].state_id);
$(addressType+'_country_id').val(consignorAddresslist[index].country_id);
$(addressType+'_name').val(consignorAddresslist[index].contact_person);
$(addressType+'_pincode').val(consignorAddresslist[index].pincode);
$(addressType+'_phone').val(consignorAddresslist[index].phone);
$(addressType+'_country_code').val(consignorAddresslist[index].contact_country_code);
$(addressType+'_email').val(consignorAddresslist[index].email);
if(addressType=='#consignee'){
    $('#selectConsigneeAddress').modal('hide');
}else{
    $('#selectBranchAddress').modal('hide');
}
}
</script>
<!--[strat::city]-->
<style type="text/css">
    #country-list {
        float: left;
        list-style: none;
        margin: 0;
        padding: 0;
        width: 740px;
        z-index: 1010;
        position: absolute;
    }

    #country-list li {
        padding: 10px;
        background: #FAFAFA;
        border-bottom: #F0F0F0 1px solid;
    }

    #country-list li:hover {
        background: #F0F0F0;
    }
</style>
<script type="text/javascript">
    $('.from-profileCitySearch input.search-box').on('keyup', function(e) {
        var keyword = $(this).val();

        console.log(keyword);
        if (keyword !== "") {
            $.ajax({
                type: "POST",
                url: $('#base_url').val() + "ajax-city-list",
                data: 'keyword=' + keyword,
                beforeSend: function() {
                    $("#search-box").css("background", "#FFF url(" + $('#base_url').val() + "media/images/ajax-loader.gif) no-repeat 165px");
                },
                success: function(data) {
                    $(".from-profileCitySearch .cityId").val('');
                    $(".from-profileCitySearch .stateId").val('');
                    $(".from-profileCitySearch .countryId").val('');
                    $(".from-profileCitySearch .suggesstion-box").show();
                    $(".from-profileCitySearch .suggesstion-box").html(data);
                    $("#search-box").css("background", "#FFF");
                }
            });
        } else {
            $(".from-profileCitySearch .cityId").val('');
            $(".from-profileCitySearch .stateId").val('');
            $(".from-profileCitySearch .countryId").val('');
            $(".from-profileCitySearch .suggesstion-box").hide();
        }
    });

    $('.from-profileCitySearch input.search-box').on('blur', function(e) {
        ($(".from-profileCitySearch .cityId").val()) ? '' : $(".from-profileCitySearch input.search-box").val('');

    });

    $(document).on('click', '.from-profileCitySearch .suggesstion-box ul li', function(e) {

        if ($(this).attr('data-cityId') != '0') {

            $(".from-profileCitySearch .cityId").val($(this).attr('data-cityId'));
            $(".from-profileCitySearch .stateId").val($(this).attr('data-stateId'));
            $(".from-profileCitySearch .countryId").val($(this).attr('data-countryId'));
            $("#transaction_currency").val($(this).attr('data-currency'));

            $('.from-profileCitySearch input.search-box').val($(this).text());

        } else {
            $('#addNewCityModal #city_prefix').val('consignor');
            $('#addNewCityModal').modal('show');
        }
        $(".from-profileCitySearch .suggesstion-box").hide();

    });


    $('.to-profileCitySearch input.search-box').on('keyup', function(e) {
        var keyword = $(this).val();
        console.log(keyword);
        if (keyword !== "") {
            $.ajax({
                type: "POST",
                url: $('#base_url').val() + "ajax-city-list",
                data: 'keyword=' + keyword,
                beforeSend: function() {
                    $("#search-box").css("background", "#FFF url(" + $('#base_url').val() + "media/images/ajax-loader.gif) no-repeat 165px");
                },
                success: function(data) {
                    $(".to-profileCitySearch .cityId").val('');
                    $(".to-profileCitySearch .stateId").val('');
                    $(".to-profileCitySearch .countryId").val('');
                    $(".to-profileCitySearch .suggesstion-box").show();
                    $(".to-profileCitySearch .suggesstion-box").html(data);
                    $("#search-box").css("background", "#FFF");
                }
            });
        } else {
            $(".to-profileCitySearch .cityId").val('');
            $(".to-profileCitySearch .stateId").val('');
            $(".to-profileCitySearch .countryId").val('');
            $(".to-profileCitySearch .suggesstion-box").hide();
        }
    });

    $('.to-profileCitySearch input.search-box').on('blur', function(e) {
        ($(".to-profileCitySearch .cityId").val()) ? '' : $(".to-profileCitySearch input.search-box").val('');

    });

    $(document).on('click', '.to-profileCitySearch .suggesstion-box ul li', function(e) {
        if ($(this).attr('data-cityId') != '0') {

            $(".to-profileCitySearch .cityId").val($(this).attr('data-cityId'));
            $(".to-profileCitySearch .stateId").val($(this).attr('data-stateId'));
            $(".to-profileCitySearch .countryId").val($(this).attr('data-countryId'));
            $("#transaction_currency").val($(this).attr('data-currency'));

            $('.to-profileCitySearch input.search-box').val($(this).text());

        } else {
            $('#addNewCityModal #city_prefix').val('consignee');
            $('#addNewCityModal').modal('show');
        }
        $(".to-profileCitySearch .suggesstion-box").hide();
    });

    $('.loading-port-search input.search-box').on('keyup', function(e) {
        var keyword = $(this).val();
        console.log(keyword);
        if (keyword !== "") {
            $.ajax({
                type: "POST",
                url: $('#base_url').val() + "ajax-port-list",
                data: 'keyword=' + keyword + '&type=' + $('.mode:checked').val(),
                beforeSend: function() {
                    $("#search-box").css("background", "#FFF url(" + $('#base_url').val() + "media/images/ajax-loader.gif) no-repeat 165px");
                },
                success: function(data) {
                    $(".loading-port-search .port_loading_id").val('');
                    $(".loading-port-search .port_loading_name").val('');
                    $(".loading-port-search .suggesstion-box").show();
                    $(".loading-port-search .suggesstion-box").html(data);
                    $("#search-box").css("background", "#FFF");


                }
            });
        } else {
            $(".loading-port-search .port_loading_id").val('');
            $(".loading-port-search .port_loading_name").val('');
            $(".loading-port-search .suggesstion-box").hide();
        }
    });

    $('.loading-port-search input.search-box').on('blur', function(e) {
        ($(".loading-port-search .port_loading_id").val()) ? '' : $(".loading-port-search input.search-box").val('');

    });

    $(document).on('click', '.loading-port-search .suggesstion-box ul li', function(e) {
        if ($(this).attr('data-portId') != '0') {

            $(".loading-port-search .port_loading_id").val($(this).attr('data-portId'));

            $('.loading-port-search input.search-box').val($(this).text());

        } else {
            $('#addNewPortModal #port_type').val($('.mode:checked').val());
            $('#addNewPortModal #port_prefix').val('port_loading');
            $('#addNewPortModal').modal('show');
        }

        $(".loading-port-search .suggesstion-box").hide();
    });

    $('.discharge-port-search input.search-box').on('keyup', function(e) {
        var keyword = $(this).val();
        console.log(keyword);
        if (keyword !== "") {
            $.ajax({
                type: "POST",
                url: $('#base_url').val() + "ajax-port-list",
                data: 'keyword=' + keyword + '&type=' + $('.mode:checked').val(),
                beforeSend: function() {
                    $("#search-box").css("background", "#FFF url(" + $('#base_url').val() + "media/images/ajax-loader.gif) no-repeat 165px");
                },
                success: function(data) {
                    $(".discharge-port-search .port_discharge_id").val('');
                    $(".discharge-port-search .port_discharge_name").val('');
                    $(".discharge-port-search .suggesstion-box").show();
                    $(".discharge-port-search .suggesstion-box").html(data);
                    $("#search-box").css("background", "#FFF");
                }
            });
        } else {
            $(".discharge-port-search .port_discharge_id").val('');
            $(".discharge-port-search .port_discharge_name").val('');
            $(".discharge-port-search .suggesstion-box").hide();
        }
    });

    $('.discharge-port-search input.search-box').on('blur', function(e) {
        ($(".discharge-port-search .port_discharge_id").val()) ? '' : $(".discharge-port-search input.search-box").val('');

    });

    $(document).on('click', '.discharge-port-search .suggesstion-box ul li', function(e) {
        if ($(this).attr('data-portId') != '0') {

            $(".discharge-port-search .port_discharge_id").val($(this).attr('data-portId'));

            $('.discharge-port-search input.search-box').val($(this).text());

        } else {
            $('#addNewPortModal #port_type').val($('.mode:checked').val());
            $('#addNewPortModal #port_prefix').val('port_discharge');
            $('#addNewPortModal').modal('show');
        }
        $(".discharge-port-search .suggesstion-box").hide();
    });


    $('.from-other-profileCitySearch input.search-box').on('keyup', function(e) {
        var keyword = $(this).val();

        console.log(keyword);
        if (keyword !== "") {
            $.ajax({
                type: "POST",
                url: $('#base_url').val() + "ajax-city-list",
                data: 'keyword=' + keyword,
                beforeSend: function() {
                    $("#search-box").css("background", "#FFF url(" + $('#base_url').val() + "media/images/ajax-loader.gif) no-repeat 165px");
                },
                success: function(data) {
                    $(".from-other-profileCitySearch .cityId").val('');
                    $(".from-other-profileCitySearch .stateId").val('');
                    $(".from-other-profileCitySearch .countryId").val('');
                    $(".from-other-profileCitySearch .suggesstion-box").show();
                    $(".from-other-profileCitySearch .suggesstion-box").html(data);
                    $("#search-box").css("background", "#FFF");
                }
            });
        } else {
            $(".from-other-profileCitySearch .cityId").val('');
            $(".from-other-profileCitySearch .stateId").val('');
            $(".from-other-profileCitySearch .countryId").val('');
            $(".from-other-profileCitySearch .suggesstion-box").hide();
        }
    });

    $('.from-other-profileCitySearch input.search-box').on('blur', function(e) {
        ($(".from-other-profileCitySearch .cityId").val()) ? '' : $(".from-other-profileCitySearch input.search-box").val('');

    });

    $(document).on('click', '.from-other-profileCitySearch .suggesstion-box ul li', function(e) {

        if ($(this).attr('data-cityId') != '0') {

            $(".from-other-profileCitySearch .cityId").val($(this).attr('data-cityId'));
            $(".from-other-profileCitySearch .stateId").val($(this).attr('data-stateId'));
            $(".from-other-profileCitySearch .countryId").val($(this).attr('data-countryId'));
            // $("#transaction_currency").val($(this).attr('data-currency'));

            $('.from-other-profileCitySearch input.search-box').val($(this).text());

        } else {
            $('#addNewCityModal #city_prefix').val('consignor_other');
            $('#addNewCityModal').modal('show');
        }
        $(".from-other-profileCitySearch .suggesstion-box").hide();

    });


    $('.to-other-profileCitySearch input.search-box').on('keyup', function(e) {
        var keyword = $(this).val();
        console.log(keyword);
        if (keyword !== "") {
            $.ajax({
                type: "POST",
                url: $('#base_url').val() + "ajax-city-list",
                data: 'keyword=' + keyword,
                beforeSend: function() {
                    $("#search-box").css("background", "#FFF url(" + $('#base_url').val() + "media/images/ajax-loader.gif) no-repeat 165px");
                },
                success: function(data) {
                    $(".to-other-profileCitySearch .cityId").val('');
                    $(".to-other-profileCitySearch .stateId").val('');
                    $(".to-other-profileCitySearch .countryId").val('');
                    $(".to-other-profileCitySearch .suggesstion-box").show();
                    $(".to-other-profileCitySearch .suggesstion-box").html(data);
                    $("#search-box").css("background", "#FFF");
                }
            });
        } else {
            $(".to-other-profileCitySearch .cityId").val('');
            $(".to-other-profileCitySearch .stateId").val('');
            $(".to-other-profileCitySearch .countryId").val('');
            $(".to-other-profileCitySearch .suggesstion-box").hide();
        }
    });

    $('.to-other-profileCitySearch input.search-box').on('blur', function(e) {
        ($(".to-other-profileCitySearch .cityId").val()) ? '' : $(".to-other-profileCitySearch input.search-box").val('');

    });

    $(document).on('click', '.to-other-profileCitySearch .suggesstion-box ul li', function(e) {
        if ($(this).attr('data-cityId') != '0') {

            $(".to-other-profileCitySearch .cityId").val($(this).attr('data-cityId'));
            $(".to-other-profileCitySearch .stateId").val($(this).attr('data-stateId'));
            $(".to-other-profileCitySearch .countryId").val($(this).attr('data-countryId'));
            //         $("#transaction_currency").val($(this).attr('data-currency'));

            $('.to-other-profileCitySearch input.search-box').val($(this).text());

        } else {
            $('#addNewCityModal #city_prefix').val('consignee_other');
            $('#addNewCityModal').modal('show');
        }
        $(".to-other-profileCitySearch .suggesstion-box").hide();
    });
</script>
<!--[end::city]-->


<script type="text/javascript">
    jQuery.validator.addClassRules("requiredClass", {
        required: true,
    });
    $("#frmRequirement").validate({

        onfocusout: function(e) {
            $(e).valid()
        },
        rules: {
            mode: {
                required: true,
            },
            delivery_term: {
                required: true,
            },
            transaction: {
                required: true,
            },
            shipment: {
                required: true,
            },
            stuffing: {
                required: {

                    depends: function(element) {
                        return $('#shipment').val() == '1';
                    }
                }
            },
            shipment_value_currency: {
                required: true,
            },
            container_stuffing: {
                required: true,
            },
            cargo_status: {
                required: true,
            },
            consignor_name: {
                required: true,
            },
            consignor_company_name: {
                required: true,
            },
            consignor_email: {
                email: true,
            },
            consignor_phone: {
                required: true,
            },
            consignor_address_line_1: {
                required: true,
            },
            consignor_city_name: {
                required: true,
            },
            consignor_pincode: {
                required: true,
            },
            consignee_name: {
                required: true,
            },
            consignee_company_name: {
                required: true,
            },
            consignee_email: {
                email: true,
            },
            consignee_phone: {
                required: true,
            },
            consignee_address_line_1: {
                required: true,
            },
            consignee_city_name: {
                required: true,
            },
            consignee_pincode: {
                required: true,
            },
            shipment_value: {
                required: true,
            },
            tentativ_date_dispatch: {
                required: true,
            },
            tentativ_date_delivery: {
                required: true,
            },
            response_end_date: {
                required: true,
            },
            port_loading_name: {
                required: {

                    depends: function(element) {
                        return $('.mode:checked').val() == '2' || $('.mode:checked').val() == '3';
                    }
                },
            },
            port_discharge_name: {
                required: {

                    depends: function(element) {
                        return $('.mode:checked').val() == '2' || $('.mode:checked').val() == '3';
                    }
                },
            },
            'consignor_other[company_name]': {
                required: {

                    depends: function(element) {
                        return $('#is_other_consignor').val() == 'Yes';
                    }
                },
            },
            'consignor_other[email]': {
                required: {

                    depends: function(element) {
                        return $('#is_other_consignor').val() == 'Yes';
                    }
                },
            },
            'consignor_other[address_line_1]': {
                required: {

                    depends: function(element) {
                        return $('#is_other_consignor').val() == 'Yes';
                    }
                },
            },
            'consignor_other[city_name]': {
                required: {

                    depends: function(element) {
                        return $('#is_other_consignor').val() == 'Yes';
                    }
                },
            },
            'consignor_other[pincode]': {
                required: {

                    depends: function(element) {
                        return $('#is_other_consignor').val() == 'Yes';
                    }
                },
            },
            'consignor_other[phone]': {
                required: {

                    depends: function(element) {
                        return $('#is_other_consignor').val() == 'Yes';
                    }
                },
            },
            'consignor_other[name]': {
                required: {

                    depends: function(element) {
                        return $('#is_other_consignor').val() == 'Yes';
                    }
                },
            },
            'consignee_other[company_name]': {
                required: {

                    depends: function(element) {
                        return $('#is_other_consignee').val() == 'Yes';
                    }
                },
            },
            'consignee_other[email]': {
                required: {

                    depends: function(element) {
                        return $('#is_other_consignee').val() == 'Yes';
                    }
                },
            },
            'consignee_other[address_line_1]': {
                required: {

                    depends: function(element) {
                        return $('#is_other_consignee').val() == 'Yes';
                    }
                },
            },
            'consignee_other[city_name]': {
                required: {

                    depends: function(element) {
                        return $('#is_other_consignee').val() == 'Yes';
                    }
                },
            },
            'consignee_other[pincode]': {
                required: {

                    depends: function(element) {
                        return $('#is_other_consignee').val() == 'Yes';
                    }
                },
            },
            'consignee_other[phone]': {
                required: {

                    depends: function(element) {
                        return $('#is_other_consignee').val() == 'Yes';
                    }
                },
            },
            'consignee_other[name]': {
                required: {

                    depends: function(element) {
                        return $('#is_other_consignee').val() == 'Yes';
                    }
                },
            },

        },
        messages: {}
    });
</script>