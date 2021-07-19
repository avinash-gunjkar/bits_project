<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url('assets/frontend/images/Logo-Temgire.png'); ?>" />
    <!-- <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/bootstrap.min.css'); ?>" /> -->
    <title>Document</title>
    <style>
        /** 
        Set the margins of the page to 0, so the footer and the header
        can be of the full height and width !
     **/
        @page {
            margin: 2cm;
            orientation: landscape;
            /* margin-left: 2cm;
            margin-right: 2cm;
            margin-top:300px;*/
            /* margin-bottom: 180px; */
            /* page-break-after: always; */

        }




        * {
            border-collapse: collapse;
        }

        /** Define now the real margins of every page in the PDF **/
        body {
            /* margin-top: 7cm; */
            /* margin-left: 2cm;
            margin-right: 2cm; */
            /* margin-bottom: 8cm;  */
            /* padding-top: 380px; */
            /* margin-bottom: 0px; */
            /* padding-bottom: 70px; */
            /* padding-left: 70px;
            padding-right: 70px; */
        }

        /** Define the header rules **/
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0cm;
            height: 200px;

            padding-left: 70px;
            padding-right: 70px;
            /* Extra personal styles */
            /*background-color: #03a9f4;*/
            /* color: white;
            text-align: left;
            line-height: 1.5cm; */
        }

        /** Define the footer rules **/
        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            /* height: 70px; */
            padding-left: 70px;
            padding-right: 70px;
            /* page-break-before: always; */
            /* Extra personal styles */
            /* background-color: #03a9f4; */
            /* color: white; */
            /* text-align: center;
            line-height: 0.15cm; */

        }


        /* table tr {
            page-break-inside: auto;
        } */

        /* table tr td {
            page-break-inside: auto;
        } */

        /**{ margin:0px; padding:0px; box-sizing:border-box;}*/
        body {
            font-size:30px;
            font-family: Arial, Helvetica, sans-serif;
            color: #333;
        }

        /*.main { width:90%; margin:50px;}*/
        .table {
            width: 100%;
            margin-top: 10px;
            margin-bottom: 10px;
            border-collapse: collapse;
            table-layout: fixed;

        }

        .table tr td {
            vertical-align: top;
            padding: 5px;
        }

        .table table {
            border-collapse: collapse;
            width: 100%
        }

        .table table th,
        .table table td {
            padding: 6px 5px;
        }

        .table table tr.border {
            border-bottom: solid 1px #cccccc;
        }

        .table-bordered tr td {
            border: solid 1px #cccccc;
        }

        .table table td h1 {
            margin: 10px 0px;
            font-weight: 300;
        }



        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        p {
            margin: 0px;
        }


        h1 {
            font-weight: bold;
        }

        label {
            font-weight: bold;
        }

        table.table.no-border td,
        table.table.no-border {
            border: none;
        }

        .fix-width-60 {
            width: 5%;
        }

        .fix-width-80 {
            width: 7%;
        }

        .fix-width-600 {
            width: 45%;
        }

        ol {
            padding-left: 10px;
            margin: 0;
        }

        .hide-extra-content {
            max-height: 50px;
            min-height: 50px;
            overflow: hidden;
        }
    </style>
</head>

<body>
    <?php
    $other_details = $documentData->other_details;
    $items = $documentData->items;
    ?>


    <?php $totalContainer = count((array)$items);
    if (!empty($items)) { ?>
        <?php $containerCounter = 0;

        foreach ($items as $container_uid => $container) {

            $containerCounter = $containerCounter + 1; ?>
            

                <?php if (!empty($container->packages)) { ?>

                    <?php $counter = 0;
                    $packageCounter = 0;
                    $totalPackages = count((array)$container->packages);
                    foreach ($container->packages as $package_uid => $package) {
                        $packageCounter = $packageCounter + 1;
                    ?>

                <div style="border: 1px solid #cccccc;">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <label for="">From,</label>
                                        <div><?= $other_details->shipping_marks_from ?></div>
                                    </td>
                                    <td>
                                        <label for="">To,</label>
                                        <div><?= $other_details->shipping_marks_to ?></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center;">
                                        <h1>SHIPPING MARKS</h1>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <img class="checkbox-img" src="<?=  APPPATH . '../assets/frontend/images/box-handaling-instructions.png' ?>" >
                                    </td>
                                    <td>
                                        <label for="">Package Number</label>
                                        <div><?= $package->package_number ?></div>
                                        <label for="">Package Details</label>
                                        <div>
                                            <label for="">Net Weight:</label> <span><?= number_format($package->net_wt, 2) ?> Kg</span><br>
                                            <label for="">Gross Weight:</label> <span><?= number_format($package->gross_wt, 2) ?> Kg</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>

                        </table>

            </div>

            <?php if ($packageCounter < $totalPackages) { ?>
                <div style="page-break-before: always;"></div>
            <?php } ?>

                    <?php } ?>
                <?php } ?>


            <?php if ($containerCounter < $totalContainer) { ?>
                <div style="page-break-before: always;"></div>
            <?php } ?>
        <?php } ?>

    <?php } ?>

</body>

</html>