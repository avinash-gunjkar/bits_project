   <style type="text/css">
  .input-field div.error{
    position: relative;
    top: -1rem;
    left: 0rem;
    font-size: 0.8rem;
    color:#FF4081;
    -webkit-transform: translateY(0%);
    -ms-transform: translateY(0%);
    -o-transform: translateY(0%);
    transform: translateY(0%);
  }
  .input-field label.active{
      width:100%;
  }
[type="checkbox"]+label {
    padding-left: 22px !important;
}
td, th {
    padding: 7px 8px !important;
	border:1px solid #ccc;
}
  </style>


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
                <h5 class="breadcrumbs-title">Edit Role</h5>
                <ol class="breadcrumbs">
                  <li><a href="index.html">Dashboard</a>
                  </li>
                  <li><a href="#">Role</a>
                  </li>
                  <li class="active">Edit Role</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->


        <!--start container-->
        <div class="container">
          <div class="section"> 
            <p class="caption">Edit Role</p>

            <div class="divider"></div>
            <!--Basic Form-->
            <div id="basic-form" class="section">
              <div class="row">
				<div class="col s12 m12 l8">
                  <div class="card-panel">
                    <!-- <h4 class="header2">Basic Form</h4> -->
                    <div class="row">
                      <form class="col s12" id="sector_add_form" action="<?php echo base_url('role/edit');?>" method="POST">
						<div class="row">
						<h5 style="text-align:center;"><?php echo $role_data['role']; ?> - Access Rights</h5>
						  <table width="100%" >
							<tr>
								<th>Modules</th>
								<th>Create</th>
								<th>Edit</th>
								<th>Delete</th>
								<th>View</th>
							</tr>
							<?php foreach($modules as $module){ ?>
							<tr>
								<td width="40%"><?php echo $module->module; ?></td>
								<td width="15%" align="center">
									<input type="checkbox" id="create" />
									<label for="create"></label>&nbsp;
								</td>
								<td width="15%" align="center">
									<input type="checkbox" id="edit" />
									<label for="edit"></label>&nbsp;
								</td>
								<td width="15%" align="center">
									<input type="checkbox" id="delete" />
									<label for="delete"></label>&nbsp;
								</td>
								<td width="15%" align="center">
									<input type="checkbox" id="view" />
									<label for="view"></label>&nbsp;
								</td>	
							</tr>
							<?php } ?>
						  </table>
                        </div>
						<div class="row">
						  <div class="input-field col s12">
							  <button class="btn cyan waves-effect waves-light right" type="submit" name="doSubmit"  value="doSubmit" name="action">Update Role Access<i class="mdi-content-send right"></i>
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

<!-- //////////////////////////////////////////////////////////////////////////// -->

<script type="text/javascript">
    $('#sector_edit_form').submit(function(e) {
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
            window.location.href = "<?php echo base_url('sector') ?>";
        })
        .fail(function(respo) {
            console.log("error",respo);
        })
        .always(function(respo) {
            console.log("complete",respo);
        });
    });    
</script>

