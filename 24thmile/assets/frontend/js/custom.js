$('.fileUpload input[type="file"]').change(function () {
    var fullPath = $(this).val();
    var filename = fullPath.replace(/^.*[\\\/]/, '');
    $(this).parent().siblings('.selected-file-name').html(filename);
    console.log(filename);
});

// $('#step3_export_act_date').datepicker({
// 	dateFormat: 'dd-M-yy',
// 	timeFormat: "hh:MMM tt",
// 	onSelect: function(datetext){
// 		var d = new Date(); // for now
// 		console.log('date=>',d);
// 		var h = d.getHours();
// 			h = (h < 10) ? ("0" + h) : h ;

// 			var m = d.getMinutes();
// 		m = (m < 10) ? ("0" + m) : m ;

// 		var s = d.getSeconds();
// 		s = (s < 10) ? ("0" + s) : s ;

// 			datetext = datetext + " " + h + ":" + m + ":" + s;
// 			console.log('datetm=>',datetext);
// 		$('#step3_export_act_date').val(datetext);
// 	},
// 	maxDate: 0
// });
// $('#step4_export_act_date').datepicker({
// 	dateFormat: 'dd-M-yy',
// 	timeFormat: "hh:mm tt",
// 	onSelect: function(datetext){
// 		var d = new Date(); // for now
// 		console.log('date=>',d);
// 		var h = d.getHours();
// 			h = (h < 10) ? ("0" + h) : h ;

// 			var m = d.getMinutes();
// 		m = (m < 10) ? ("0" + m) : m ;

// 		var s = d.getSeconds();
// 		s = (s < 10) ? ("0" + s) : s ;

// 			datetext = datetext + " " + h + ":" + m + ":" + s;
// 			console.log('datetm=>',datetext);
// 		$('#step4_export_act_date').val(datetext);
// 	},
// 	maxDate: 0
// });
// $('#step6_export_etd_date').datepicker({
// 	dateFormat: 'dd-M-yy',
// 	timeFormat: "hh:mm tt",
// 	onSelect: function(datetext){
// 		var d = new Date(); // for now
// 		console.log('date=>',d);
// 		var h = d.getHours();
// 			h = (h < 10) ? ("0" + h) : h ;

// 			var m = d.getMinutes();
// 		m = (m < 10) ? ("0" + m) : m ;

// 		var s = d.getSeconds();
// 		s = (s < 10) ? ("0" + s) : s ;

// 			datetext = datetext + " " + h + ":" + m + ":" + s;
// 			console.log('datetm=>',datetext);
// 		$('#step6_export_etd_date').val(datetext);
// 	},
// 	minDate: 0
// });
// $('#step6_export_lov_date').datepicker({
// 	dateFormat: 'dd-M-yy',
// 	timeFormat: "hh:mm tt",
// 	onSelect: function(datetext){
// 		var d = new Date(); // for now
// 		console.log('date=>',d);
// 		var h = d.getHours();
// 			h = (h < 10) ? ("0" + h) : h ;

// 			var m = d.getMinutes();
// 		m = (m < 10) ? ("0" + m) : m ;

// 		var s = d.getSeconds();
// 		s = (s < 10) ? ("0" + s) : s ;

// 			datetext = datetext + " " + h + ":" + m + ":" + s;
// 			console.log('datetm=>',datetext);
// 		$('#step6_export_lov_date').val(datetext);
// 	},
// 	maxDate: 0
// });
// $('#step6_export_eta_date').datepicker({
// 	dateFormat: 'dd-M-yy',
// 	timeFormat: "hh:mm tt",
// 	onSelect: function(datetext){
// 		var d = new Date(); // for now
// 		console.log('date=>',d);
// 		var h = d.getHours();
// 			h = (h < 10) ? ("0" + h) : h ;

// 			var m = d.getMinutes();
// 		m = (m < 10) ? ("0" + m) : m ;

// 		var s = d.getSeconds();
// 		s = (s < 10) ? ("0" + s) : s ;

// 			datetext = datetext + " " + h + ":" + m + ":" + s;
// 			console.log('datetm=>',datetext);
// 		$('#step6_export_eta_date').val(datetext);
// 	},
// 	minDate: 0
// });
// $('#step8_export_rdp_date').datepicker({
// 	dateFormat: 'dd-M-yy',
// 	timeFormat: "hh:mm tt",
// 	onSelect: function(datetext){
// 		var d = new Date(); // for now
// 		console.log('date=>',d);
// 		var h = d.getHours();
// 			h = (h < 10) ? ("0" + h) : h ;

// 			var m = d.getMinutes();
// 		m = (m < 10) ? ("0" + m) : m ;

// 		var s = d.getSeconds();
// 		s = (s < 10) ? ("0" + s) : s ;

// 			datetext = datetext + " " + h + ":" + m + ":" + s;
// 			console.log('datetm=>',datetext);
// 		$('#step8_export_rdp_date').val(datetext);
// 	},
// 	maxDate: 0
// });
// $('#step9_export_ccd_date').datepicker({
// 	dateFormat: 'dd-M-yy',
// 	timeFormat: "hh:mm tt",
// 	onSelect: function(datetext){
// 		var d = new Date(); // for now
// 		console.log('date=>',d);
// 		var h = d.getHours();
// 			h = (h < 10) ? ("0" + h) : h ;

// 			var m = d.getMinutes();
// 		m = (m < 10) ? ("0" + m) : m ;

// 		var s = d.getSeconds();
// 		s = (s < 10) ? ("0" + s) : s ;

// 			datetext = datetext + " " + h + ":" + m + ":" + s;
// 			console.log('datetm=>',datetext);
// 		$('#step9_export_ccd_date').val(datetext);
// 	},
// 	maxDate: 0
// });
// $('#step10_export_delivery_date').datepicker({
// 	dateFormat: 'dd-M-yy',
// 	timeFormat: "hh:mm tt",
// 	onSelect: function(datetext){
// 		var d = new Date(); // for now
// 		console.log('date=>',d);
// 		var h = d.getHours();
// 			h = (h < 10) ? ("0" + h) : h ;

// 			var m = d.getMinutes();
// 		m = (m < 10) ? ("0" + m) : m ;

// 		var s = d.getSeconds();
// 		s = (s < 10) ? ("0" + s) : s ;

// 			datetext = datetext + " " + h + ":" + m + ":" + s;
// 			console.log('datetm=>',datetext);
// 		$('#step10_export_delivery_date').val(datetext);
// 	},
// 	minDate: 0
// });
// $('#step11_export_erbc_date').datepicker({
// 	dateFormat: 'dd-M-yy',
// 	timeFormat: "hh:mm tt",
// 	onSelect: function(datetext){
// 		var d = new Date(); // for now
// 		console.log('date=>',d);
// 		var h = d.getHours();
// 			h = (h < 10) ? ("0" + h) : h ;

// 			var m = d.getMinutes();
// 		m = (m < 10) ? ("0" + m) : m ;

// 		var s = d.getSeconds();
// 		s = (s < 10) ? ("0" + s) : s ;

// 			datetext = datetext + " " + h + ":" + m + ":" + s;
// 			console.log('datetm=>',datetext);
// 		$('#step11_export_erbc_date').val(datetext);
// 	},
// 	minDate: 0
// });

/************* Import Dates Start ***********************************************************/

// $('#step3_import_act_date').datetimepicker();  
$('#step3_import_act_date').datetimepicker({
    format: 'DD/MM/YYYY'
});
$('#step4_import_act_date').datetimepicker({
    format: 'DD/MM/YYYY'
});
$('#step6_import_etd_date').datetimepicker({
    format: 'DD/MM/YYYY'
});
$('#step7_import_lov_date').datetimepicker({
    format: 'DD/MM/YYYY'
});
$('#step9_import_eta_date').datetimepicker({
    format: 'DD/MM/YYYY'
});
$('#step10_import_rdp_date').datetimepicker({
    format: 'DD/MM/YYYY'
});
$('#step11_import_ccd_date').datetimepicker({
    format: 'DD/MM/YYYY'
});
$('#step12_date').datetimepicker({
    format: 'DD/MM/YYYY'
});
$('.date-picker').datetimepicker({
    format: 'd-M-Y',
    scrollInput: false,
    timepicker: false
});
$('.future-date-picker').datetimepicker({
    format: 'd-M-Y',
    minDate: new Date(),
    scrollInput: false,
    timepicker: false
});
$('.pickup_datetimepicker').datetimepicker({
    format: 'd-M-Y H:i',
    minDate: new Date(),
    scrollInput: false
});


// $('#step1_export_custom_invoice_date').datepicker({
// 	dateFormat: 'dd-M-yy',
// 	onSelect: function(datetext){
// 		var d = new Date(); // for now
// 		console.log('date=>',d);
// 		var h = d.getHours();
// 			h = (h < 10) ? ("0" + h) : h ;

// 			var m = d.getMinutes();
// 		m = (m < 10) ? ("0" + m) : m ;

// 		var s = d.getSeconds();
// 		s = (s < 10) ? ("0" + s) : s ;

// 			datetext = datetext;
// 			console.log('datetm=>',datetext);
// 		$('#step1_export_custom_invoice_date').val(datetext);
// 	},
// 	maxDate: 0
// });

// $('#step2_export_SB_date').datepicker({
// 	dateFormat: 'dd-M-yy',
// 	onSelect: function(datetext){
// 		var d = new Date(); // for now
// 		console.log('date=>',d);
// 		var h = d.getHours();
// 			h = (h < 10) ? ("0" + h) : h ;

// 			var m = d.getMinutes();
// 		m = (m < 10) ? ("0" + m) : m ;

// 		var s = d.getSeconds();
// 		s = (s < 10) ? ("0" + s) : s ;

// 			datetext = datetext;
// 			console.log('datetm=>',datetext);
// 		$('#step2_export_SB_date').val(datetext);
// 	},
// 	maxDate: 0
// });

// $('#step5_export_bol_date').datepicker({
// 	dateFormat: 'dd-M-yy',
// 	onSelect: function(datetext){
// 		var d = new Date(); // for now
// 		console.log('date=>',d);
// 		var h = d.getHours();
// 			h = (h < 10) ? ("0" + h) : h ;

// 			var m = d.getMinutes();
// 		m = (m < 10) ? ("0" + m) : m ;

// 		var s = d.getSeconds();
// 		s = (s < 10) ? ("0" + s) : s ;

// 			datetext = datetext;
// 			console.log('datetm=>',datetext);
// 		$('#step5_export_bol_date').val(datetext);
// 	},
// 	maxDate: 0
// });

// $('#step7_export_commercial_invoice_date').datepicker({
// 	dateFormat: 'dd-M-yy',
// 	onSelect: function(datetext){
// 		var d = new Date(); // for now
// 		console.log('date=>',d);
// 		var h = d.getHours();
// 			h = (h < 10) ? ("0" + h) : h ;

// 			var m = d.getMinutes();
// 		m = (m < 10) ? ("0" + m) : m ;

// 		var s = d.getSeconds();
// 		s = (s < 10) ? ("0" + s) : s ;

// 			datetext = datetext;
// 			console.log('datetm=>',datetext);
// 		$('#step7_export_commercial_invoice_date').val(datetext);
// 	},
// 	maxDate: 0
// });

/*Start::file preview */
$('input[type="file"].preview').change(function () {

    var previewTarget = $(this).attr('data-previewTarget');
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(previewTarget).attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    }
});
/*End::file preview */



$(document).on("keypress", '.only-numbers', function (e) {

    var ok = /[0-9]/.test(String.fromCharCode(e.charCode));
    if (e.charCode == 0)
        ok = true;
    if (!ok)
        e.preventDefault();
});

$(document).on("keypress", '.only-alphabet', function (e) {

    var ok = /[A-Za-z]/.test(String.fromCharCode(e.charCode));
    if (e.charCode == 0)
        ok = true;
    if (!ok)
        e.preventDefault();
});

$(document).on("keypress", '.alpha-numeric', function (e) {

    var ok = /[A-Za-z0-9]/.test(String.fromCharCode(e.charCode));
    if (e.charCode == 0)
        ok = true;
    if (!ok)
        e.preventDefault();
});

$(document).on("keypress", '.alpha-num-space', function (e) {
    var ok = /[A-Za-z0-9 ]/.test(String.fromCharCode(e.charCode));
    if (e.charCode == 0)
        ok = true;
    if (!ok)
        e.preventDefault();
});
$(document).on("keypress", '.numeric-with-special-characters', function (e) {
    var ok = /[0-9\/\-_]/.test(String.fromCharCode(e.charCode));
    if (e.charCode == 0)
        ok = true;
    if (!ok)
        e.preventDefault();
});

$(document).on("input paste drop", '.decimal-numbers', function (e) {
    this.value = this.value.replace(/[^0-9.]/g, '');
    this.value = this.value.replace(/(\..*)\./g, '$1');
});

$(".decimal-numbers").numeric({ decimalPlaces: 2 });

$(document).on("input paste drop", '.only-numbers', function (e) {
    this.value = this.value.replace(/[^0-9]/g, '');
    // this.value = this.value.replace(/(\..*)\./g, '$1');
});



// $(document).on("paste drop",'.only-alphabet,.alpha-numeric,.alpha-num-space,.numeric-with-special-characters,.decimal-numbers',function(e){
// 	e.preventDefault();
// });

$(document).on('submit', 'form', function (e) {

    if ($(this).hasClass('not-hide-submit-btn')) {
        return;
    }
    if ($(this).valid()) {

        $(this).find('input[type="submit"],button[type="submit"]').css('display', 'none');
        $(this).find('input[type="submit"],button[type="submit"]').after('<div class="css-animated-loader"></div>');

    }

});

$(document).ready(function () {
    $('#progressbar li.active .step-label, #progressbar li.active:before').click(function () {
        $(this).parent('li').find('fieldset').toggle();
    });
});


$('.pannelGroup .heading').on('click', function () {
    $(this).parent('.pannelGroup').toggleClass('show');
});

$(document).on('mouseover', '.drplist', function () {
    var $actionsBtn = $(this);
    var $menuList = $actionsBtn.find('ul.d-list');
    $menuList.height();
    $menuList.css({ top: (-($menuList.height() - $actionsBtn.height()) / 2) + 'px' });

});

function slugify(input) {
    return input.toString().toLowerCase().replace(/\s+/g, '-') //replace space with -
        .replace(/[^\w\-]+/g, '') //remove all non-word character
        .replace(/\-\-+/g, '-') //replace multiple -  with single -
        .replace(/^-+/, '') //trim - from start of text
        .replace(/-+$/, ''); //trim - from end of text
}


function numberWithCommas(x) {
    //return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

function initDatetimePicker() {
    $('.date-picker').datetimepicker({
        format: 'd-M-Y',
        scrollInput: false,
        timepicker: false
    });
}


$('.date-picker').attr('autocomplete','off');

var currencyList = [];
currencyList['AED'] = { "currency": "Dirham", "sub-currency": "Fils" };
currencyList['AFN'] = { "currency": "Afghani", "sub-currency": "Puls" };
currencyList['ALL'] = { "currency": "Lek", "sub-currency": "Qindarka" };
currencyList['AMD'] = { "currency": "Dram", "sub-currency": "Luma" };
currencyList['ANG'] = { "currency": "Guilder", "sub-currency": "Cents" };
currencyList['AOA'] = { "currency": "Kwanza", "sub-currency": "Lwei" };
currencyList['ARS'] = { "currency": "Peso", "sub-currency": "Centavos" };
currencyList['ATS'] = { "currency": "Euro", "sub-currency": "Cents" };
currencyList['AUD'] = { "currency": "Australian Dollar", "sub-currency": "Cents" };
currencyList['AWG'] = { "currency": "Guilder", "sub-currency": "Cents" };
currencyList['AZN'] = { "currency": "Manat", "sub-currency": "Gopik" };
currencyList['BAM'] = { "currency": "Mark", "sub-currency": "Fennig" };
currencyList['BBD'] = { "currency": "Dollar", "sub-currency": "Cents" };
currencyList['BDT'] = { "currency": "Taka", "sub-currency": "Paisa" };
currencyList['BEF'] = { "currency": "Euro", "sub-currency": "Cents" };
currencyList['BGN'] = { "currency": "Leva", "sub-currency": "Stotinki" };
currencyList['BHD'] = { "currency": "Dinar", "sub-currency": "Fils" };
currencyList['BIF'] = { "currency": "Franc", "sub-currency": "Centimes" };
currencyList['BMD'] = { "currency": "Dollar", "sub-currency": "Cents" };
currencyList['BND'] = { "currency": "Ringgit", "sub-currency": "Sen" };
currencyList['BOB'] = { "currency": "Boliviano", "sub-currency": "Centavos" };
currencyList['BRL'] = { "currency": "Real", "sub-currency": "Centavos" };
currencyList['BSD'] = { "currency": "Dollar", "sub-currency": "Cents" };
currencyList['BTN'] = { "currency": "Ngultrum", "sub-currency": "Chetrum" };
currencyList['BWP'] = { "currency": "Pula", "sub-currency": "Thebe" };
currencyList['BYR'] = { "currency": "Ruble", "sub-currency": "Kopecks" };
currencyList['BZD'] = { "currency": "Dollar", "sub-currency": "Cents" };
currencyList['CAD'] = { "currency": "Dollar", "sub-currency": "Cents" };
currencyList['CDF'] = { "currency": "Franc", "sub-currency": "Centimes" };
currencyList['CFA'] = { "currency": "Franc", "sub-currency": "Centimes" };
currencyList['CFP'] = { "currency": "Franc", "sub-currency": "Centimes" };
currencyList['CHF'] = { "currency": "Swiss Franc", "sub-currency": "Centimes" };
currencyList['CLP'] = { "currency": "Peso", "sub-currency": "Centavos" };
currencyList['CNY'] = { "currency": "Yuan Renminbi", "sub-currency": "Fen" };
currencyList['COP'] = { "currency": "Peso", "sub-currency": "Centavos" };
currencyList['CRC'] = { "currency": "Colon", "sub-currency": "Centimos" };
currencyList['CUP'] = { "currency": "Peso", "sub-currency": "Centavos" };
currencyList['CVE'] = { "currency": "Escudo", "sub-currency": "Centavos" };
currencyList['CYP'] = { "currency": "Euro", "sub-currency": "Cents" };
currencyList['CZK'] = { "currency": "Koruna", "sub-currency": "Haleru" };
currencyList['DJF'] = { "currency": "Franc", "sub-currency": "Centimes" };
currencyList['DKK'] = { "currency": "Krone", "sub-currency": "øre" };
currencyList['DMK'] = { "currency": "Euro", "sub-currency": "Euro-Cents" };
currencyList['DOP'] = { "currency": "Peso", "sub-currency": "Centavos" };
currencyList['DZD'] = { "currency": "Dinar", "sub-currency": "Centimes" };
currencyList['EEK'] = { "currency": "Euro", "sub-currency": "Euro-Cents" };
currencyList['EGP'] = { "currency": "Pound", "sub-currency": "Piasters" };
currencyList['ERN'] = { "currency": "Nakfa", "sub-currency": "Cents" };
currencyList['ESP'] = { "currency": "Euro", "sub-currency": "Euro-Cents" };
currencyList['ETB'] = { "currency": "Birr", "sub-currency": "Cents" };
currencyList['EUR'] = { "currency": "Euro", "sub-currency": "Cents" };
currencyList['FIM'] = { "currency": "Euro", "sub-currency": "Euro-Cents" };
currencyList['FJD'] = { "currency": "Dollar", "sub-currency": "Cents" };
currencyList['FKP'] = { "currency": "Pound", "sub-currency": "Pence" };
currencyList['GBP'] = { "currency": "Pound Sterling", "sub-currency": "Pence" };
currencyList['GEL'] = { "currency": "Lari", "sub-currency": "Tetri" };
currencyList['GHS'] = { "currency": "New Cedi", "sub-currency": "Psewas" };
currencyList['GIP'] = { "currency": "Pound", "sub-currency": "Pence" };
currencyList['GMD'] = { "currency": "Dalasi", "sub-currency": "Butut" };
currencyList['GNF'] = { "currency": "Syli", "sub-currency": "Centimes" };
currencyList['GRD'] = { "currency": "Euro", "sub-currency": "Euro-Cents" };
currencyList['GTQ'] = { "currency": "Quetzal", "sub-currency": "Centavos" };
currencyList['GYD'] = { "currency": "Dollar", "sub-currency": "Cents" };
currencyList['HKD'] = { "currency": "Dollar", "sub-currency": "Cents" };
currencyList['HNL'] = { "currency": "Lempira", "sub-currency": "Centavos" };
currencyList['HRK'] = { "currency": "Kuna", "sub-currency": "Lipas" };
currencyList['HTG'] = { "currency": "Gourde", "sub-currency": "Centimes" };
currencyList['HUF'] = { "currency": "Forint", "sub-currency": "" };
currencyList['IDR'] = { "currency": "Rupiah", "sub-currency": "Sen" };
currencyList['IED'] = { "currency": "Euro", "sub-currency": "Euro-Cents" };
currencyList['ILS'] = { "currency": "New Shekel", "sub-currency": "Agora" };
currencyList['INR'] = { "currency": "Rupee", "sub-currency": "Paise" };
currencyList['IQD'] = { "currency": "Dinar", "sub-currency": "Fils" };
currencyList['IRR'] = { "currency": "Rial", "sub-currency": "Rials" };
currencyList['ISK'] = { "currency": "Krona", "sub-currency": "Aurar" };
currencyList['ITL'] = { "currency": "Euro", "sub-currency": "Euro-Cents" };
currencyList['JMD'] = { "currency": "Dollar", "sub-currency": "Cents" };
currencyList['JOD'] = { "currency": "Dinar", "sub-currency": "Fils" };
currencyList['JPY'] = { "currency": "Yen", "sub-currency": "Sen" };
currencyList['KES'] = { "currency": "Shilling", "sub-currency": "Cents" };
currencyList['KGS'] = { "currency": "Som", "sub-currency": "Tyyn" };
currencyList['KHR'] = { "currency": "New Riel", "sub-currency": "Sen" };
currencyList['KID'] = { "currency": "Kyat", "sub-currency": "Paise" };
currencyList['KMF'] = { "currency": "Franc", "sub-currency": "Centimes" };
currencyList['KPW'] = { "currency": "Won", "sub-currency": "Chon" };
currencyList['KRW'] = { "currency": "Won", "sub-currency": "Chon" };
currencyList['KWD'] = { "currency": "Dinar", "sub-currency": "Fils" };
currencyList['KYD'] = { "currency": "Dollar", "sub-currency": "Cents" };
currencyList['KZT'] = { "currency": "Tenge", "sub-currency": "Tiyn" };
currencyList['LAK'] = { "currency": "New Kip", "sub-currency": "At" };
currencyList['LBP'] = { "currency": "Pound", "sub-currency": "piastres" };
currencyList['LKR'] = { "currency": "Rupee", "sub-currency": "Cents" };
currencyList['LRD'] = { "currency": "Dollar", "sub-currency": "Cents" };
currencyList['LSL'] = { "currency": "Loti", "sub-currency": "Lisente" };
currencyList['LTL'] = { "currency": "Litas", "sub-currency": "Centu" };
currencyList['LUF'] = { "currency": "Euro", "sub-currency": "Euro-Cents" };
currencyList['LVL'] = { "currency": "Euro", "sub-currency": "Euro-Cents" };
currencyList['LYD'] = { "currency": "Dinar", "sub-currency": "Dirhams" };
currencyList['MAD'] = { "currency": "Dirham", "sub-currency": "Centimes" };
currencyList['MDL'] = { "currency": "Leu", "sub-currency": "" };
currencyList['MGA'] = { "currency": "Ariayry", "sub-currency": "Centimes" };
currencyList['MKD'] = { "currency": "Denar", "sub-currency": "Deni" };
currencyList['MMK'] = { "currency": "Kyat", "sub-currency": "Pya" };
currencyList['MNT'] = { "currency": "Tugrik", "sub-currency": "Mongos" };
currencyList['MOP'] = { "currency": "Pataca", "sub-currency": "Avos" };
currencyList['MRO'] = { "currency": "Ouguiya", "sub-currency": "Khoums" };
currencyList['MTL'] = { "currency": "Euro", "sub-currency": "Euro-Cents" };
currencyList['MUR'] = { "currency": "Rupee", "sub-currency": "Cents" };
currencyList['MVR'] = { "currency": "Rufiyaa", "sub-currency": "Lari" };
currencyList['MWK'] = { "currency": "Kwacha", "sub-currency": "Tambala" };
currencyList['MXN'] = { "currency": "Nuevo Peso", "sub-currency": "Centavos" };
currencyList['MYR'] = { "currency": "Ringgit", "sub-currency": "Sen" };
currencyList['MZN'] = { "currency": "Metical", "sub-currency": "Centavos" };
currencyList['NAD'] = { "currency": "Dollar", "sub-currency": "Cents" };
currencyList['NGN'] = { "currency": "Naira", "sub-currency": "Kobo" };
currencyList['NIO'] = { "currency": "Gold Cordoba", "sub-currency": "Centavos" };
currencyList['NLG'] = { "currency": "Euro", "sub-currency": "Euro-Cents" };
currencyList['NOK'] = { "currency": "Krone", "sub-currency": "øre" };
currencyList['NPR'] = { "currency": "Rupee", "sub-currency": "Paise" };
currencyList['NZD'] = { "currency": "New Zealand Dollar", "sub-currency": "Cents" };
currencyList['OMR'] = { "currency": "Rial", "sub-currency": "Baizas" };
currencyList['PAB'] = { "currency": "Balboa", "sub-currency": "Centesimos" };
currencyList['PEN'] = { "currency": "Nuevo Sol", "sub-currency": "Centimos" };
currencyList['PGK'] = { "currency": "Kina", "sub-currency": "Toeas" };
currencyList['PHP'] = { "currency": "Peso", "sub-currency": "Centavos" };
currencyList['PKR'] = { "currency": "Rupee", "sub-currency": "Paisa" };
currencyList['PLN'] = { "currency": "Zloty", "sub-currency": "Groszy" };
currencyList['PTE'] = { "currency": "Euro", "sub-currency": "Euro-Cent" };
currencyList['PYG'] = { "currency": "Guarani", "sub-currency": "Centimos" };
currencyList['QAR'] = { "currency": "Riyal", "sub-currency": "Dirhams" };
currencyList['RON'] = { "currency": "Leu", "sub-currency": "Bani" };
currencyList['RSD'] = { "currency": "Dinar", "sub-currency": "Para" };
currencyList['RUB'] = { "currency": "Ruble", "sub-currency": "Kopecks" };
currencyList['RWF'] = { "currency": "Franc", "sub-currency": "Centimes" };
currencyList['SAR'] = { "currency": "Riyal", "sub-currency": "Halalat" };
currencyList['SBD'] = { "currency": "Dollar", "sub-currency": "Cents" };
currencyList['SCR'] = { "currency": "Rupee", "sub-currency": "Cents" };
currencyList['SDG'] = { "currency": "Dinar", "sub-currency": "Piastres" };
currencyList['SEK'] = { "currency": "Krona", "sub-currency": "öre" };
currencyList['SGD'] = { "currency": "Dollar", "sub-currency": "Cents" };
currencyList['SHP'] = { "currency": "Pound", "sub-currency": "New Pence" };
currencyList['SIT'] = { "currency": "Euro", "sub-currency": "Euro-Cents" };
currencyList['SKK'] = { "currency": "Euro", "sub-currency": "Euro-Cents" };
currencyList['SLL'] = { "currency": "Leone", "sub-currency": "Cents" };
currencyList['SOS'] = { "currency": "Shilling", "sub-currency": "Cesntesimi" };
currencyList['SRD'] = { "currency": "Guilder", "sub-currency": "Cents" };
currencyList['STN'] = { "currency": "Dobra", "sub-currency": "Centimos" };
currencyList['STD'] = { "currency": "Dobra", "sub-currency": "Cêntimo" };
currencyList['SVC'] = { "currency": "Colon", "sub-currency": "Centavos" };
currencyList['SYP'] = { "currency": "Pound", "sub-currency": "Piasters" };
currencyList['SSP'] = { "currency": "Pound", "sub-currency": "Piastre" };
currencyList['SZL'] = { "currency": "Lilangeni", "sub-currency": "Cents" };
currencyList['THB'] = { "currency": "Baht", "sub-currency": "Sastangs" };
currencyList['TJS'] = { "currency": "Somoni", "sub-currency": "Dirams" };
currencyList['TMM'] = { "currency": "Manat", "sub-currency": "Tenga" };
currencyList['TND'] = { "currency": "Dinar", "sub-currency": "Millimes" };
currencyList['TMT'] = { "currency": "Turkmenistan New Manat", "sub-currency": "TengTennesia" };
currencyList['TOP'] = { "currency": "Pa'anga", "sub-currency": "Seniti" };
currencyList['TRY'] = { "currency": "Lira", "sub-currency": "Kurus" };
currencyList['TTD'] = { "currency": "Dollar", "sub-currency": "Cents" };
currencyList['TWD'] = { "currency": "New Dollar", "sub-currency": "Cents" };
currencyList['TZS'] = { "currency": "Shilling", "sub-currency": "Cents" };
currencyList['UAH'] = { "currency": "Hryvnia", "sub-currency": "Kopiykas" };
currencyList['UGX'] = { "currency": "Shilling", "sub-currency": "Cents" };
currencyList['USD'] = { "currency": "US Dollar", "sub-currency": "Cents" };
currencyList['UYI'] = { "currency": "Peso uruguayo", "sub-currency": "Centesimos" };
currencyList['UYU'] = { "currency": "Peso uruguayo", "sub-currency": "Centesimos" };
currencyList['UZS'] = { "currency": "Som", "sub-currency": "Tiyin" };
currencyList['VAL'] = { "currency": "Euro", "sub-currency": "Cents" };
currencyList['VEB'] = { "currency": "Bolivar", "sub-currency": "Centimos" };
currencyList['VEF'] = { "currency": "Bolivar", "sub-currency": "Céntimo" };
currencyList['VND'] = { "currency": "New Dong", "sub-currency": "Hao" };
currencyList['VUV'] = { "currency": "Vatu", "sub-currency": "Centimes" };
currencyList['WST'] = { "currency": "Tala", "sub-currency": "Sene" };
currencyList['XAF'] = { "currency": "Franc", "sub-currency": "Centimes" };
currencyList['XCD'] = { "currency": "Dollar", "sub-currency": "Cents" };
currencyList['XOF'] = { "currency": "Franc", "sub-currency": "Centimes" };
currencyList['XPF'] = { "currency": "Franc", "sub-currency": "Centimes" };
currencyList['YER'] = { "currency": "Rial", "sub-currency": "Fils" };
currencyList['YUG'] = { "currency": "Dinar", "sub-currency": "Paras" };
currencyList['ZAR'] = { "currency": "Rand", "sub-currency": "Cents" };
currencyList['ZMK'] = { "currency": "Kwacha", "sub-currency": "Ngwee" };
currencyList['ZWD'] = { "currency": "Zimbabwe Dollar", "sub-currency": "Cents" };
currencyList['ZWL'] = { "currency": "Zimbabwe Dollar", "sub-currency": "Cents" };




function _amountInWords(amount) {
    var words = new Array();
    words[0] = 'Zero'; words[1] = 'One'; words[2] = 'Two'; words[3] = 'Three'; words[4] = 'Four'; words[5] = 'Five'; words[6] = 'Six'; words[7] = 'Seven'; words[8] = 'Eight'; words[9] = 'Nine'; words[10] = 'Ten'; 
    words[11] = 'Eleven'; words[12] = 'Twelve'; words[13] = 'Thirteen'; words[14] = 'Fourteen'; words[15] = 'Fifteen'; words[16] = 'Sixteen'; words[17] = 'Seventeen'; words[18] = 'Eighteen'; words[19] = 'Nineteen'; words[20] = 'Twenty';
     words[30] = 'Thirty'; words[40] = 'Forty'; words[50] = 'Fifty'; words[60] = 'Sixty'; words[70] = 'Seventy'; words[80] = 'Eighty'; words[90] = 'Ninety'; 
     words[100] = 'One Hundred'; words[200] = 'Two Hundred'; words[300] = 'Three Hundred'; words[400] = 'Four Hundred'; 
     words[500] = 'Five Hundred'; words[600] = 'Six Hundred'; words[700] = 'Seven Hundred'; words[800] = 'Eight Hundred'; 
     words[900] = 'Nine Hundred'; 
    var op;
    amount = amount.toString();
    var atemp = amount.split('.');
    var number = atemp[0].split(',').join('');
    var n_length = number.length;
    var words_string = '';
    if (n_length <= 11) {
        var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        var received_n_array = new Array();
        for (var i = 0; i < n_length; i++) {
            received_n_array[i] = number.substr(i, 1);
        }
        for (var i = 11 - n_length, j = 0; i < 11; i++, j++) {
            n_array[i] = received_n_array[j];
        }
        for (var i = 0, j = 1; i < 11; i++, j++) {
            if (i == 0 || i == 3 || i == 6 || i == 9) {
                if (n_array[i] == 1) {
                    n_array[j] = 10 + parseInt(n_array[j]);
                    n_array[i] = 0;
                }
            }
        }
        value = '';
        for (var i = 0; i < 11; i++) {
            if (i == 0 || i == 3 || i == 6 || i == 9) {
                value = n_array[i] * 10;
            }
            else if (i == 2 || i == 5 || i == 8) {
                value = n_array[i] * 100;
            } else {
                value = n_array[i];
            }

            if (value != 0) {
                words_string += words[value] + ' ';
            }
            if ((i == 1 && value != 0) && (n_array[i - 1] > 0)) {
                words_string += 'Billion ';
            } else if ((i == 1) && value != 0) {
                words_string += 'Biillion ';
            }
            if ((i == 4) && value == 0 && (n_array[i - 1] > 0 || n_array[i - 2] > 0)) {
                words_string += 'Million ';
            } else if ((i == 4) && value != 0) {
                words_string += 'Million ';
            }
            if ((i == 7) && value == 0 && (n_array[i - 1] > 0 || n_array[i - 2] > 0)) {
                words_string += 'Thousand ';
            } else if ((i == 7) && value != 0) {
                words_string += 'Thousand ';
            }
        }
        words_string = words_string.split(' ').join(' ');
    }
    return words_string;
}

function amountInWords(n,currencyCode) {
    
    var cur = currencyCode;//currencyList[currencyCode]['currency']; 
    var frac = "";//currencyList[currencyCode]['sub-currency'];
    nums = n.toFixed(2).toString().split('.')
    var whole = _amountInWords(nums[0])
    if (nums[1] == null) nums[1] = 0;
    if (nums[1].length == 1) nums[1] = nums[1] + '0';
    if (nums[1].length > 2) { nums[1] = nums[1].substring(2, length - 1) }
    if (nums.length == 2) {
        if (nums[0] <= 12) { nums[0] = nums[0] * 10 } else { nums[0] = nums[0] };
        var fraction = _amountInWords(nums[1])
        if (whole == '' && fraction == '') { op = 'Zero'; }
        if (whole == '' && fraction != '') { op = frac + ' ' + fraction + ''; }
        if (whole != '' && fraction == '') { op = cur + ' ' + whole + ''; }
        if (whole != '' && fraction != '') { op = cur + ' ' + whole + ' and ' + frac + ' ' + fraction + ''; }
        amt = n;
        if (amt > 99999999999.99) { op = 'Oops!!! The amount is too big to convert'; }
        if (isNaN(amt) == true) { op = 'Error : Amount in number appears to be incorrect. Please Check.'; }
        console.log(op);
        return op;
    }
}


function addHyphen (element) {
    let ele = document.getElementById(element.id);
    ele = ele.value.split('-').join('');    // Remove dash (-) if mistakenly entered.

    let finalVal = ele.match(/.{1,7}/g).join('-');
    document.getElementById(element.id).value = finalVal;
}