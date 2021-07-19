$(document).ready(function () {
    var counter = 0;

    $(".addrow").on("click", function () {
        // var newRow = $("<tr>");
        var rfc_cat = $(this).data('rfc_cat');

       var baseurl = $('#BASEURL').val();
       console.log()
        // var url = window.location.hostname;
        var furl = baseurl+'/freight/addRow';
        console.log('----->',furl);

        $.ajax({
            type: 'POST',
            url: furl,
            data: {rfc_cat:rfc_cat},
            success:function(response){
                var $tableid = '#rfc_cat_opt_table'+rfc_cat;
                $($tableid +' tbody').append(response);
                  $('select').material_select();
                counter++;
            }
        });
    });




    $("table.order-list").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();       
        counter -= 1
    });


});



function calculateRow(row) {
    var price = +row.find('input[name^="price"]').val();

}

function calculateGrandTotal() {
    var grandTotal = 0;
    $("table.order-list").find('input[name^="price"]').each(function () {
        grandTotal += +$(this).val();
    });
    $("#grandtotal").text(grandTotal.toFixed(2));
}

$('.date-picker').datetimepicker({
           format: 'd-M-Y' ,
           timepicker:false,
           scrollInput :false
}); 

 
$(document).ready(function(){
    $('#progressbar li.active .step-label, #progressbar li.active:before').click(function(){
        $(this).parent('li').find('fieldset').toggle();
    });
});


$('.pannelGroup .heading').on('click', function(){
  $(this).parent('.pannelGroup').toggleClass('show'); 
});

$(document).on('mouseover','.drplist',function(){
   var $actionsBtn = $(this);
   var $menuList = $actionsBtn.find('ul.d-list');
   $menuList.height();
   $menuList.css({top:(-($menuList.height() - $actionsBtn.height())/2)+'px'});

});

function slugify(input) {
    return input.toString().toLowerCase().replace(/\s+/g, '-') //replace space with -
  .replace(/[^\w\-]+/g, '') //remove all non-word character
  .replace(/\-\-+/g, '-') //replace multiple -  with single -
  .replace(/^-+/, '') //trim - from start of text
  .replace(/-+$/, ''); //trim - from end of text
  }