<head>
  <link href="<?php echo base_url('assets/backend/js/plugins/data-tables/css/jquery.dataTables.min.css')?>" type="text/css" rel="stylesheet">

</head>

<!-- START CONTENT -->
      <section id="content">
        
        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper">
            <!-- Search for small screen -->
            <div class="header-search-wrapper grey hide-on-large-only">
                <i class="mdi-action-search active"></i>
                <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
            </div>
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">Freights</h5>
                <ol class="breadcrumbs">
                    <li><a href="<?php echo base_url()?>">Dashboard</a></li>
                    <li><a >Master</a></li>
                    <li class="active">Freights</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->
        

        <!--start container-->
        <div class="container">
          <div class="section">

            <div class="right pt-10" style="padding: 10px">
                <a href="<?php echo base_url('freight')?>" class="btn waves-effect waves-light " type="submit" name="action">View All Template<i class="mdi-image-remove-red-eye right"></i></a>  
            </div>
             <!--DataTables example-->
 
          <div class="container">
            <form class="col s12" id="template_add_form" action="<?php echo base_url('freight/add');?>" method="POST">
				<div class="col-sm-12">
					<div class="col-sm-4 col-md-4 input-field">
						<p>
							<input class="with-gap" name="transaction"  type="radio" id="test3" value="Import"/>
							<label for="test3">Import</label>
							<input class="with-gap" name="transaction" type="radio" id="test4" value="Export"/>
							<label for="test4">Export</label>
						</p>
				   </div>
				   <div class="col-sm-4 col-md-4 input-field">
						<select class="mdb-select md-form dataField particular_id" name="sector" id="sector">
							 <option value="#" disabled selected>Select Sector</option>
							 <?php foreach($sector_data as $sector_data){ ?>
							 <option value="<?php echo $sector_data['id']; ?>"><?php echo $sector_data['name']; ?></option>
							 <?php } ?>
						</select>
				   </div>
				</div>
			   <br/>
              <?php 
              foreach ($rfccategory_list as $rfccategory) {
            ?>
                <div class="card-panel">
                  <h5><?php echo $rfccategory['rfc_category_name']; ?></h5>
                    <table id="rfc_cat_opt_table<?php echo $rfccategory['id'];  ?>" class=" table order-list">
                    <tbody id="tbdids">
                        <tr class="fieldRow">
                            <td class="col-sm-4 input-field">
                              <select class="mdb-select md-form dataField particular_id" name="particular">
                                <option value="#" disabled selected>Select particluars</option>

                                 <?php 
                                 if(!empty($rfccategory['particular_list'])){
                                 for ($i=0; $i < count($rfccategory['particular_list']) ; $i++) { ?>
                                <option value="<?php echo $rfccategory['particular_list'][$i]['id']; ?>" ><?php echo $rfccategory['particular_list'][$i]['particular']; ?></option> 
                              <?php }} ?>
                              </select>
                            </td>
                            <td class="col-sm-4 input-field">
                              <select class="mdb-select md-form dataField container_id" name="container_id">
                                <option value="#" disabled selected>Select Container</option>
                                 <?php 
                                 if(!empty($rfccategory['particular_list'])){
                                 for ($i=0; $i < count($rfccategory['particular_list']) ; $i++) { ?>
                                <option value="<?php echo $rfccategory['particular_list'][$i]['container_id']; ?>"><?php echo $rfccategory['particular_list'][$i]['type']; ?></option> 
                              <?php }} ?>
                            </select>
                            </td>
                            <td class="col-sm-4 input-field">
                            <input name="unit" type="text" class="validate dataField unit" value="">
                            <label for="unit" data-error="">Unit</label>
                            </td>
                           
                            <td class="col-sm-2"><a class="deleteRow"></a>
                            </td>
                        </tr>
                        <input type="hidden" name="rfc_category_id"  class="dataField" value="<?php echo $rfccategory['id']; ?>" >
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" style="text-align: left;">
                                <button type="button" class="btn cyan addrow waves-effect waves-light right" data-rfc_cat="<?php echo $rfccategory['id']; ?>">Add Row</button>
                            </td>
                        </tr>
                        <tr>
                        </tr>
                    </tfoot>
                </table>
              </div>
              <?php } ?>

              <div class="row">
                  <div class="input-field col s12">
                    <button class="btn cyan waves-effect waves-light right" type="doSubmit" name="doSubmit"  value="doSubmit" name="action">Add Freight Template<i class="mdi-content-send right"></i>
                    </button>
                  </div>
              </div>
          </form>
            </div>
          </div> 
        </div>
        <!--end container-->
      </section>
      <!-- END CONTENT -->

      <!-- //////////////////////////////////////////////////////////////////////////// -->

<script type="text/javascript">
    
    $('.toggleActive').click(function(event) { 
      var id = $(this).attr('id').split('-')[1];
      var isActive = $(this).prop("checked") ? 1 : 0 ;
      var BasePath = "<?php echo base_url('sector/changeStatus');?>"
      changeStatus(BasePath,id,isActive); 
       
     }); 

    function changeStatus(BasePath,id,isActive) {  
      $.ajax({
        url: BasePath,
        type: 'POST',
        dataType: 'json',
        data: {
            id: id,
            isActive: isActive
            },
      })
      .done(function(respo) {
        Materialize.toast('<span>'+respo.msg+'</span>', 5000);  
        console.log("success",respo);
      })
      .fail(function(respo) {
        console.error("error",respo);
      })
      .always(function() {
        console.log("complete");
      });
      
    }

 


  $("#template_add_form").on('submit', function(event) {
    // console.log($(this).serialize());
    

    formData = [];

    event.preventDefault();
    var $cardPanel = $(this).find('.card-panel');


    $.each($cardPanel, function(index, val) {

      rfcObj ={

      };
        var rfccategory_id = $(this).find('table tbody input:hidden').val();
        var transaction = $("input[name='transaction']:checked").val();
        var sector = $('#sector').val();
        rfcObj.rfccategory_id = rfccategory_id;
        rfcObj.transaction = transaction;
        rfcObj.sector = sector;
        rfcObj.tempalte = []; 

        var $fieldRow = $(this).find('table tr.fieldRow ');
        $.each($fieldRow, function(indexsss, val) {
            var $inputField = $(this).find('.input-field input:text, .input-field select '); 

           // var $inputField = $(this).find('input[type="text"]'); 
           console.log('$inputField', $inputField);
                var tempalte ={};
               $.each($inputField, function(index, val) {
                  // console.log('name ------>', $(this).attr('name'),'value ---->',$(this).val());
                  if($(this).parent().hasClass('particular_id')){
                    if ($(this).val() != '#') {
                      tempalte.particular_id = $(this).val(); 
                    }
                  } 

                  if($(this).parent().hasClass('container_id')){
                    if ($(this).val() != '#') {
                      tempalte.container_id = $(this).val();
                    }
                  } 

                  // console.log('Check---->',$(this).parent().hasClass('particular_id'),$(this));
                  // debugger;

                  if($(this).hasClass('unit')){
                    if ($(this).val() != '') {
                      tempalte.unit = $(this).val();
                    }
                  } 

               });
                  
                  if(tempalte.particular_id && tempalte.container_id && tempalte.unit)
                  rfcObj.tempalte.push(tempalte);
        });

          formData.push(rfcObj);
        
    }); 

               $.ajax({
              url: '<?php echo base_url('freight/addTemplate'); ?>',
              type: 'POST',
              dataType: 'json',
              data: {formData: formData},
            })
            .done(function(respo) {
              console.log("success",respo);
            })
            .fail(function(respo) {
              console.log("error", respo);
            })
            .always(function(respo) {
              console.log("complete", respo);
            });
        console.log('Last form Data------>',formData);






  });

</script>