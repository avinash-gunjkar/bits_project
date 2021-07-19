
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
                <h5 class="breadcrumbs-title">Sector wise Documents</h5>
                <ol class="breadcrumbs">
                    <li><a href="<?php echo base_url()?>">Dashboard</a></li>
                    <li><a >Master</a></li>
                    <li class="active">Sector wise Documents</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->

        <!--start container-->
              <div id="card-widgets">
                    <div class="row"  style="margin-top: 60px;">
                         <div class="col s12 m8 l8  offset-l2 offset-m2">
                            <select class="mdb-select md-form" name="sector" id="sector">
                              <option value="" disabled selected>Choose your sector</option>
                              <?php foreach($sector_list as $sector){ ?>
                              <option value="<?php echo $sector['id']; ?>"><?php echo $sector['name']; ?></option>
                            <?php } ?>
                            </select>
                           </div>
                    </div>

                    <div class="row">
                        <div class="col s6 m6 l6 offset-s3 offset-l3" id="document_selection_area" style="display: none;">
                          <form class="col s12" id="sectorwise_add_form" action="<?php echo base_url('sectorwisedocument/sectorwiseAddDocuments');?>" method="POST">
                              <ul id="task-card" class="collection with-header">
                                  <li class="collection-header cyan">
                                      <h5 class="task-card-title">Sector wise Document List</h5>
                                  </li>
                                    <?php   
                                    // print_r($sector_wise_document_list);die;
                                      foreach ($sector_wise_document_list as $documentverification) {

                                     ?> 
                                          <li class="collection-item dismissable">
                                              <input type="checkbox" id="<?php echo $documentverification['id'] ?>" class="select_doc" data-doc-name="<?php echo $documentverification['name']; ?>" name="document[]" value="<?php echo $documentverification['id'] ?>"  <?php // echo $checked; ?> />
                                              <label for="<?php echo $documentverification['id'] ?>" ><?php echo $documentverification['name']; ?>
                                              </label>
                                          </li>
                                    <?php }

                                   ?>
                              </ul>
                                <input type="hidden" name="sector_id" id="sector_id" value="">
                              <div class="input-field col s12">
                                <button href="#modal1" class="btn cyan waves-effect waves-red waves-light right modal-close" type="submit" name="doSubmit"  value="doSubmit" id="select_doc">Save Documents<i class="mdi-av-fast-forward right"></i>
                                </button>
                            </div>
                          </form>
                        </div>
              </div> 
            </div>
            <!--end container-->
          </section>
      <!-- END CONTENT -->

        <div id="modal1" class="modal">
                  <div class="modal-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                      Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                  </div>
                  <div class="modal-footer">
                    <a href="#" class="waves-effect waves-red btn-flat modal-action modal-close">Disagree</a>
                    <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Agree</a>
                  </div>
    </div>

      <!-- //////////////////////////////////////////////////////////////////////////// -->


<script type="text/javascript">




  var selected_doc = [];

    $('.select_doc').click(function(){
      if($(this).prop("checked") == true){
       selected_doc.push({value:this.id,name:$(this).data('docName')});

       
      }
      else if($(this).prop("checked") == false){
        var removeItem = this.id;
        console.log("before -> ",selected_doc);
        $.each(selected_doc,function(index,ele){
          

          if(ele.value == removeItem){

            console.log("each index ==>",index);
          console.log("each ele ==>",ele);
            selected_doc.splice(index,1);
            return false;
          }

        });


        
        console.log("after -> ",selected_doc);      }
    });


    // $('#sectorwise_add_form').submit(function(e) {
    //     e.preventDefault();
    //     var action = $(this).attr('action');
    //     var FORMDATA = $(this).serialize();
    //     $.ajax({
    //         url: action,
    //         type: 'POST',
    //         dataType: 'json',
    //         data: FORMDATA,
    //     })
    //     .done(this,function(respo) {

    //         if(respo.status==1){
    //             Materialize.toast('<span>Sectorwise documents add successfully.</span>', 5000);
    //             $("#sectorwise_add_form")[0].reset();
 
    //         }else{
    //             Materialize.toast('<span>Failed to add company.</span>', 5000)
    //         }
    //     })
    //     .fail(function(respo) {
    //         console.log("error",respo);
    //     })
    //     .always(function(respo) {
    //         console.log("complete",respo);
    //     });    
    // });


    $('.toggleActive').click(function(event) { 
      var id = $(this).attr('id').split('-')[1];
      var isActive = $(this).prop("checked") ? 1 : 0 ;       
      var BasePath = "<?php echo base_url('document/changeStatus');?>"
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


      $('#sector').change(function(){
      $('#document_selection_area').show();
      var sector = $(this).val();
      $('#sector_id').val(sector);

       var base_url = "<?php echo base_url('sectorwisedocument/getSelectedDocumentsIsArray'); ?>";
        $.ajax({
                url: base_url,
                type: 'POST',
                dataType: 'json',
                data: {sector_id:sector},
            })
            .done(this,function(respo) {
                console.log(respo); 
                makeSelected(respo)
            })


    });

    function makeSelected(docList)
    {

      $('#sectorwise_add_form li input').each(function (index, value) 
      {

        $('.select_doc').prop('checked', '');
          $.each(docList,function(i) 
          {
            name    = docList[i].name;
           
            if (name) {
              $('input:checkbox[data-doc-name="'+ name +'"]').prop('checked','checked');
            }
          });
      });
   }

   $('#sectorwise_add_form').submit(function(e) {
        e.preventDefault();
        var action = $(this).attr('action');
        var FORMDATA = $(this).serialize();
        $.ajax({
            url: action,
            type: 'POST',
            dataType: 'json',
            data: FORMDATA,
        })
        .done(function(respo) {
            Materialize.toast('<span>'+respo.msg+'</span>', 5000);
        })
        .fail(function(respo) {
            console.log("error",respo);
        })
        .always(function(respo) {
            console.log("complete",respo);
        });
        
    });
</script>