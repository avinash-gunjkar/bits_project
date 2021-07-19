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

    table.table tbody tr th {
        text-align: left;
    }

    @media (min-width: 840px) {
        .mdl-grid {
            padding: 8px;
            width: 100% !important;
        }
    }

    .breakup-details p {
        margin: 0;
    }

    label {
        font-weight: bold;
        margin-right: 10px;
    }

    input.underline {

        border: none;
        border-bottom: 1px solid #c8c8c8;
        border-radius: 0;
        outline: none;
    }

    input.underline:focus {
        border: none;
        border-bottom: 1px solid #c8c8c8;
        border-radius: 0;
        outline: 0;
        box-shadow: none;
    }

    span.dash-space {
        width: 300px;
        display: inline-block;
        border-bottom: 1px dashed #000;
    }

    ol li {
        margin-bottom: 5px;
    }
</style>
<!-- Tracking start -->
<div class="wshipping-content-block">

    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="tracking-block">
                    <div class="tab-content">
                    <?php

                        $other_details = $documentData->other_details;
                        $consignor = (object) $other_details->consignor;
                        
                        ?>
                        <center>
                            <h3 class="heading3-border">DECLARATION FORM</h3>
                            <h5 class="heading5-border">(See Rule 10 of Customs Valuation Rules,1988)</h5>
                            <small>
                                Note : This declaration shall not be required for goods imported as passengers baggage,goods imported for personal use
                                upto value of Rs.1000/-,Sample of no commercial value,or where the goods are subject to specific rate of duty.
                            </small>
                        </center>
                        <form id="documentForm" action="" method="POST" enctype="multipart/form-data">
                            <ol>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Importer's name and Address:</div>
                                        <div class="col-lg-9"><input type="text" class="form-control underline" name="other_details[importer_name_address]" value="<?= $other_details->importer_name_address ?>"></div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Supplier's name and Address:</div>
                                        <div class="col-lg-9"> <hr style="margin: 1.5rem 1rem 0 0;"></div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Name and Address of the Agent,if any:</div>
                                        <div class="col-lg-9"> <hr style="margin: 1.5rem 1rem 0 0;"></div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Description of Goods:</div>
                                        <div class="col-lg-9"> <hr style="margin: 1.5rem 1rem 0 0;"></div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Country of Origin:</div>
                                        <div class="col-lg-9"> <hr style="margin: 1.5rem 1rem 0 0;"></div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Port of Shipment:</div>
                                        <div class="col-lg-9"> <hr style="margin: 1.5rem 1rem 0 0;"></div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">AWB/BL Number and Date:</div>
                                        <div class="col-lg-9"> <hr style="margin: 1.5rem 1rem 0 0;"></div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">IGM Number and date:</div>
                                        <div class="col-lg-9"> <hr style="margin: 1.5rem 1rem 0 0;"></div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Contract Number and Date:</div>
                                        <div class="col-lg-9"> <hr style="margin: 1.5rem 1rem 0 0;"></div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Nature of Payments:</div>
                                        <div class="col-lg-9"> <hr style="margin: 1.5rem 1rem 0 0;"></div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Invoice Number and Date:</div>
                                        <div class="col-lg-9"> <hr style="margin: 1.5rem 1rem 0 0;"></div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Invoice Value:</div>
                                        <div class="col-lg-9"> <hr style="margin: 1.5rem 1rem 0 0;"></div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Terms of Payments:</div>
                                        <div class="col-lg-9"> <hr style="margin: 1.5rem 1rem 0 0;"></div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Currency of Payment:</div>
                                        <div class="col-lg-9"> <hr style="margin: 1.5rem 1rem 0 0;"></div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Exchange rate:</div>
                                        <div class="col-lg-9"> <hr style="margin: 1.5rem 1rem 0 0;"></div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Term of Delivery:</div>
                                        <div class="col-lg-9"> <hr style="margin: 1.5rem 1rem 0 0;"></div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Relationship between buyer and seller [Rule 2, (2)]:</div>
                                        <div class="col-lg-9"> <hr style="margin: 1.5rem 1rem 0 0;"></div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">If related, what is the basis of declared value:</div>
                                        <div class="col-lg-9"> <hr style="margin: 1.5rem 1rem 0 0;"></div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Conditions or Restriction attached with the sale[Rule 4, (2)]:</div>
                                        <div class="col-lg-9"> <hr style="margin: 1.5rem 1rem 0 0;"></div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Valuation Method Applicable [See Rule 4 to 8]:</div>
                                        <div class="col-lg-9"> <hr style="margin: 1.5rem 1rem 0 0;"></div>
                                    </div>

                                </li>

                                <li>
                                    <div class="row">
                                        <div class="col-lg-12">Cost and Services not included in the invoice value [Rule 9]:</div>

                                    </div>
                                    <ol type="a">
                                        <li>
                                            <div class="row">
                                                <div class="col-lg-3">Brokerage and Commissions:</div>
                                                <div class="col-lg-9"> <hr style="margin: 1.5rem 1rem 0 0;"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-lg-3">Cost of Container:</div>
                                                <div class="col-lg-9"> <hr style="margin: 1.5rem 1rem 0 0;"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-lg-3">Packing Cost:</div>
                                                <div class="col-lg-9"> <hr style="margin: 1.5rem 1rem 0 0;"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-lg-3">Cost of Goods and services supplied by the buyer:</div>
                                                <div class="col-lg-9"> <hr style="margin: 1.5rem 1rem 0 0;"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-lg-3">Royalties and Licence Fees:</div>
                                                <div class="col-lg-9"> <hr style="margin: 1.5rem 1rem 0 0;"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-lg-3">Value of proceeds which accrue to seller:</div>
                                                <div class="col-lg-9"> <hr style="margin: 1.5rem 1rem 0 0;"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-lg-3">Freight:</div>
                                                <div class="col-lg-9"> <hr style="margin: 1.5rem 1rem 0 0;"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-lg-3">Insurance:</div>
                                                <div class="col-lg-9"> <hr style="margin: 1.5rem 1rem 0 0;"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-lg-3">Loading, Unloading, Handling Charges:</div>
                                                <div class="col-lg-9"> <hr style="margin: 1.5rem 1rem 0 0;"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-lg-3">Landing Charges:</div>
                                                <div class="col-lg-9"> <hr style="margin: 1.5rem 1rem 0 0;"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-lg-3">Other payments if any:</div>
                                                <div class="col-lg-9"> <hr style="margin: 1.5rem 1rem 0 0;"></div>
                                            </div>
                                        </li>
                                    </ol>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-3">Assessable value in Rs.:</div>
                                        <div class="col-lg-9"> <hr style="margin: 1.5rem 1rem 0 0;"></div>
                                    </div>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-12">Previous import of identical/similar goods,if any:</div>

                                    </div>
                                    <ol type="a">
                                        <li>
                                            <div class="row">
                                                <div class="col-lg-3">Bill of Entry Number and Date:</div>
                                                <div class="col-lg-9"> <hr style="margin: 1.5rem 1rem 0 0;"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-lg-3">IGM Number and Date:</div>
                                                <div class="col-lg-9"> <hr style="margin: 1.5rem 1rem 0 0;"></div>
                                            </div>
                                        </li>
                                    </ol>

                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            Any other relevant information (Attached separated sheet, if necessary):
                                        </div>
                                    </div>
                                </li>

                            </ol>
                            <center>
                                <h3 class="heading3-border">DECLARATION</h3>
                            </center>
                            <ol>
                                <li>I / We hereby declare that the information furnished above are true,complete and correct in every suspect.</li>
                                <li>I / WE also undertake to bring to the notice of proper office any particulars which subsequently come to my / our knowledge which will have a bearing on valuation.</li>
                            </ol>

                            <br>
                            <div class="col-lg-12">
                                <div>
                                    <label for="">Place:</label>
                                </div>
                                <div>
                                    <label for="">Date:</label>
                                    <label for="" class="pull-right">Signature of Importer</label>
                                </div>
                            </div>

                            <center>
                                <h3 class="heading3-border"><u>FOR CUSTOM HOUSE USE</u></h3>
                            </center>

                            <ol>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-4">Bill of Entry Number and Date :</div>
                                        <div class="col-lg-8">
                                            <hr style="margin: 1.5rem 1rem 0 0;">
                                        </div>
                                        <!-- <div class="col-lg-9"><input type="text" class="form-control underline" name="other_details[bill_of_entry_number_and_date]" value="<?= $other_details->bill_of_entry_number_and_date ?>"></div> -->
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-4">Valuation Method Applied (See Rule 4 to 8) :</div>
                                        <div class="col-lg-8">
                                            <hr style="margin: 1.5rem 1rem 0 0;">
                                        </div>
                                        <!-- <div class="col-lg-9"><input type="text" class="form-control underline" name="other_details[importer_name_address]" value="<?= $other_details->importer_name_address ?>"></div> -->
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-4">If declared value not accepted, brief reasons:</div>
                                        <div class="col-lg-8">
                                            <hr style="margin: 1.5rem 1rem 0 0;">
                                        </div>
                                        <!-- <div class="col-lg-9"><input type="text" class="form-control underline" name="other_details[importer_name_address]" value="<?= $other_details->importer_name_address ?>"></div> -->
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-4">Reference number and Date of any previous decisions/ruling:</div>
                                        <div class="col-lg-8">
                                            <hr style="margin: 1.5rem 1rem 0 0;">
                                        </div>
                                        <!-- <div class="col-lg-9"><input type="text" class="form-control underline" name="other_details[importer_name_address]" value="<?= $other_details->importer_name_address ?>"></div> -->
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-lg-4">Value Assessed:</div>
                                        <div class="col-lg-8">
                                            <hr style="margin: 1.5rem 1rem 0 0;">
                                        </div>
                                        <!-- <div class="col-lg-9"><input type="text" class="form-control underline" name="other_details[importer_name_address]" value="<?= $other_details->importer_name_address ?>"></div> -->
                                    </div>
                                </li>
                            </ol>
                            <div class="col-lg-12">
                                <br>
                                <br>
                                <br>
                                <label for="" class="pull-right">A/O Assistant Commissioner</label>

                            </div>

                            <br>
                            <br>
                            <br>
                            <center>
                                <h3 class="heading3-border">DECLARATION</h3>
                                <h5 class="heading5-border">DECLARATION TO BE SIGNED BY AN IMPORTER CLEARING GOODS WITH THE HELP OF A CUSTOMS HOUSE AGENT</h5>

                            </center>

                            <ol>
                                <li>
                                    <p>I/We declare to the best of my/our knowledge and belief that the contents of invoice (s)</p>
                                    <p>No.(s) <span class="dash-space"></span> dated <span class="dash-space"></span></p>
                                    <p>M/s<span class="dash-space"></span><span class="dash-space"></span></p>
                                    <p>and of other documents relating to the goods covered by the said invoice(s) and presented herewith are true and correct in every respect. </p>
                                </li>
                                <li>
                                    I/We declare that I/We have not received & do not know of any other document or information showing price, value quantity or description of said goods and that if at any time hereafter I/We will immediately make the same know to the controller of customs.
                                </li>
                                <li>I/We declare that goods covered by the bill of entry have been imported on an out-right purchase/consignment account.</li>
                                <li>
                                    I/We am/are not connected with the suppliers/manufacturers as
                                    <ol type="a">
                                        <li>Agent/Distributors/Indenter/Branch Subsidiary Concessionaire and</li>
                                        <li>Collaborator entitled to the use of trade mark, patent or design:</li>
                                        <li>Otherwise than as ordinary importers or buyers:</li>
                                    </ol>
                                </li>
                                <li>I/We declare the method of invoicing has not charged since the date on which my/our books of accounts and/or agreement with the suppliers examined previously by Customs House.</li>
                            </ol>
                            <div class="col-lg-12">
                                N. B. - Strike out whichever is inapplicable.
                            </div>

                            <div>
                                <br>
                                <br>
                                <label for="" class="pull-right">Signature of Importer</label>
                            </div>
                            <br>
                            <br>
                            <br>
                            <br>
                            <center>
                                <input type="submit" value="Save" name="submitBtn" class="btn btn-success">
                                <!-- <input type="submit" value="Create Document" name="submitBtn" id="createDocumentBtn" class="btn btn-success"> -->
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog content end -->
</section><!-- sidebar_dashboard-->
</div> <!-- sidebar_dashboard-->