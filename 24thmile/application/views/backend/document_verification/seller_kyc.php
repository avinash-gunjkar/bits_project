
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
                <h5 class="breadcrumbs-title">Document Verification</h5>
                <ol class="breadcrumbs">
                    <li><a href="<?php echo base_url()?>">Dashboard</a></li>
                    <li><a >Master</a></li>
                    <li class="active">Document Verification</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->

        <!--start container-->
              <div id="card-widgets">
                        <div class="row">
                            <div class="col s4 m4 l4 offset-s2 offset-l2">
                              <form class="col s12" id="documentverification_add_form" action="<?php echo base_url('documentverification/sellerAddDocuments');?>" method="POST">
                                  <ul id="task-card" class="collection with-header">
                                      <li class="collection-header cyan">
                                          <h5 class="task-card-title">Document List</h5>
                                      </li>
                                        <?php   
                                          foreach ($documentverification_list as $documentverification) {
                                           if (in_array($documentverification['id'], $checked_document_id))
                                                {
                                                $checked ="checked='true'";
                                                }
                                              else
                                                {
                                                $checked ="";
                                                }

                                         ?> 
                                              <li class="collection-item dismissable">
                                                  <input type="checkbox" id="<?php echo $documentverification['id'] ?>" class="select_doc" data-doc-name="<?php echo $documentverification['name']; ?>" name="document[]" value="<?php echo $documentverification['id'] ?>"  <?php  echo $checked; ?> />
                                                  <label for="<?php echo $documentverification['id'] ?>" ><?php echo $documentverification['name']; ?>
                                                  </label>
                                              </li>
                                        <?php }

                                       ?>
                                  </ul>
                                  <div class="input-field col s12">
                                    <button class="btn cyan waves-effect waves-light right" type="submit" name="doSubmit"  value="doSubmit" id="select_doc">Add Documents<i class="mdi-av-fast-forward right"></i>
                                    </button>
                                </div>
                              </form>
                            </div>
                            <div class="col s4 m4 l4">
                               
                                    <div class="collection-header cyan">
                                        <h5 class="task-card-title" style="padding: 20px;
                                        color: #fff;margin-bottom: 0px;">Selected Document List </h5>
                                    </div>
                                <ul id="selected_doc_list" class="collection with-header" style="margin-top: 0px;">

                                  
                              
                                </ul>
                            </div>


          </div> 
        </div>
        <!--end container-->
      </section>
      <!-- END CONTENT -->

      <!-- //////////////////////////////////////////////////////////////////////////// -->


<script type="text/javascript">


  $( document ).ready(function() {

    var base_url = "<?php echo base_url('documentverification/getSelectedDocumentsIsArray'); ?>";
    $.ajax({
            url: base_url,
            type: 'POST',
            dataType: 'json',
            data: null,
        })
        .done(this,function(respo) {
            console.log(respo);
            selected_doc = respo;
            renderSelectedDoc(selected_doc);
        })
  });


  var selected_doc = [];

    $('.select_doc').click(function(){
      if($(this).prop("checked") == true){
       selected_doc.push({value:this.id,name:$(this).data('docName')});

       renderSelectedDoc(selected_doc);
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

        renderSelectedDoc(selected_doc);
        
        console.log("after -> ",selected_doc);      }
    });

    function renderSelectedDoc(docList) {
      $("#selected_doc_list").empty();
      $("#selected_doc_list p").remove();
      var html = '';

      console.log("render -> ",docList);
      $.map(docList, function(ele, index){
          console.log('ele.name ->', ele.name);
          console.log('index ->', index);
          html += '<li class="collection-item dismissable"><input type="checkbox" class="select_doc" checked="true" ><label>'+ele.value+'-'+ele.name+'</label></li>'
      });

        $("#selected_doc_list").append(html);
    }

    $('#documentverification_add_form').submit(function(e) {
        e.preventDefault();
        var action = $(this).attr('action');
        var FORMDATA = $(this).serialize();
        $.ajax({
            url: action,
            type: 'POST',
            dataType: 'json',
            data: FORMDATA,
        })
        .done(this,function(respo) {

            if(respo.status==1){
                Materialize.toast('<span>Company add successfully.</span>', 5000);
                $("#documentverification_add_form")[0].reset();
 
            }else{
                Materialize.toast('<span>Failed to add company.</span>', 5000)
            }
        })
        .fail(function(respo) {
            console.log("error",respo);
        })
        .always(function(respo) {
            console.log("complete",respo);
        });
        
    });


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
</script>