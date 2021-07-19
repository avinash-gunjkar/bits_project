      <!-- START CONTENT -->
      <section id="content">

        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper">
           
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title"><?= $page_title ?></h5>
                <ol class="breadcrumbs">
                  <li><a href="<?=base_url('admin/dashboard')?>">Dashboard</a>
                  </li>
                  <li><a href="#">Master</a>
                  </li>
                  <li class="active"><?= $page_title ?></li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->

        <!--start container-->
        <div class="container">
          <div class="section">
            <!-- <p class="caption">Add Unit</p> -->
            <div class="divider"></div>
            <!--Basic Form-->
            <div id="basic-form" class="section">
              <div class="row">
                <div class="col s12 m12 l8 offset-l2">
                  <div class="card-panel">
                    <!-- <h4 class="header2">Basic Form</h4> -->
                    <div class="row">
                      <form class="col s12" id="formData" action="<?php echo base_url('admin/testimonial/add');?>" method="POST" enctype="multipart/form-data">
                        <div class="row">
                          <div class="input-field col s12">
                            <input type="hidden" name="id" value="<?=$recordDetails->id?>">
                            <input id="title" name="title" type="text" class="validate" maxlength="80" value="<?=$recordDetails->title?>" >
                            <label for="unit_type">Title</label>
                          </div>
                          
                          <div class="file-field input-field col s12">
                        <div class="btn">
                          <span>Image</span>
                          <input type="hidden" name="old_image" value="<?=$recordDetails->image?>">
                          <input type="file" name="image" accept="image/*" id="image">
                        </div>
                        <div class="file-path-wrapper">
                          <input class="file-path validate" type="text" placeholder="">
                        </div>
                        
                      </div>
                      <?php  if(is_file('uploads/news/'.$recordDetails->image)){?>
                        <div class="col s12">
                        <img src="<?=base_url('uploads/news/'.$recordDetails->image);?>" style="max-height: 200px;max-width:200px;object-fit:contain; ">
                        <span>
                      <input type="checkbox" name="flagDeleteImage" id="flagDeleteImage">
                      <label for="flagDeleteImage">Delete Image</label>
                    </span>
                  </div>
                        <?php }?>
                          <div class=" col s12">
                          <label for="description">Description</label>
                            <textarea name="description"  id="description" cols="30" rows="10"><?=$recordDetails->description?></textarea>
                          </div>
                       </div>
                          <div class="row">
                            <div class="input-field col s12">
                            <a class="btn waves-effect grey " href="<?=base_url('admin/news-and-events')?>">Cancel</a>
                              <button class="btn cyan waves-effect waves-light right" type="submit" name="doSubmit"  value="doSubmit" name="action">Save<i class="mdi-content-send right"></i>
                              </button>
                            </div>
                          </div>
                      </form>
                    </div>
                  </div>
                </div> 
              </div>
            </div>         
         </div>
      </div>
  </section>
  <!-- END CONTENT -->
  <script src="<?=base_url('assets/backend/js/plugins/jquery-validation/jquery.validate.min.js');?>"></script>
   <script type="text/javascript">
     $("#formData").validate({
       rules: {
         name: {
           required: true,
         }
       },
       //For custom messages
       messages: {
        name: {
           required: "This field is required.",
         }
       },
       errorElement: 'div',
       errorPlacement: function(error, element) {
         var placement = $(element).data('error');
         if (placement) {
           $(placement).append(error)
         } else {
           error.insertAfter(element);
         }
       }
     });
   </script>
   <!-- start::bootstrap WYSIHTML5 - text editor -->
     <script type="text/javascript">
	
	  $("#description").editor();
</script>
<!-- end::bootstrap WYSIHTML5 - text editor -->
   <!-- END CONTENT -->

