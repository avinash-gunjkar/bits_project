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
            <!--DataTables example-->

            <br/><br/>
           
            <br/><br/>

 
          <div class="container">
            <form class="col s12" id="template_add_form" action="<?php echo base_url('freight/add');?>" method="POST">
              <?php 
              foreach ($rfccategory_list as $rfccategory) {
            ?>
                <div class="card-panel">
                  <h5><?php echo $rfccategory['rfc_category_name']; ?></h5>
                    <table id="rfc_cat_opt_table<?php echo $rfccategory['id'];  ?>" class=" table order-list">
                    <tbody>
                        <tr class="fieldRow">
                            <td class="col-sm-4 input-field">
                              <select class="mdb-select md-form dataField particular_id" name="particular">
                                <option value="" disabled selected>Select particluars</option>

                                 <?php 
                                 if(!empty($rfccategory['particular_list'])){
                                 for ($i=0; $i < count($rfccategory['particular_list']) ; $i++) { ?>
                                <option value="<?php echo $rfccategory['particular_list'][$i]['id']; ?>" ><?php echo $rfccategory['particular_list'][$i]['particular']; ?></option> 
                              <?php }} ?>
                              </select>
                            </td>
                            <td class="col-sm-4 input-field">
                              <select class="mdb-select md-form dataField container_id" name="container_id">
                                <option value="" disabled selected>Select Container</option>
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
                                <button type="button" class="btn cyan addrow waves-effect waves-light right" data-rfc_cat="<?php echo $rfccategory['id']; ?>" >Add Row</button>
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
                    <button class="btn cyan waves-effect waves-light right" type="submit" name="doSubmit"  value="doSubmit" name="action">Add Sector<i class="mdi-content-send right"></i>
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

    formData = [];

    // event.preventDefault();
    var $cardPanel = $(this).find('.card-panel');

    $.each($cardPanel, function(index, val) {
      rfcObj ={
      };

        var rfccategory_id = $(this).find('table tbody input:hidden').val();
        rfcObj.rfccategory_id = rfccategory_id;
        rfcObj.tempalte = [];

        var $fieldRow = $(this).find('table tr.fieldRow ');
        $.each($fieldRow, function(indexsss, val) 
        {
           var $particular_id = $(this).find('.input-field select.particular_id'); 
           var $container_id = $(this).find('.input-field select.container_id'); 
                var tempalte ={};

                  console.log('Check---->',$particular_id,$container_id);

               rfcObj.tempalte.push(tempalte);
        });

          formData.push(rfcObj);   
    }); 
        console.log('Last form Data------>',formData);

  });

</script>