<?php
/**
 * This view allows to create a new employee
 *
 * @copyright  Copyright (c) 2014-2017 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/skeleton
 * @since      0.1.0
 */
?>
<style>
.highlight { background-color: #007bff; color:#fff;}
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
tr:hover{ cursor: pointer;}
</style>
<div class="container bg-light">
  <div class="row-fluid">
    <form id="frm_create" action="<?php echo base_url();?>items/itemcreate" method="POST">
      <div class="col-12">
        <h2>Create a new item</h2>
        <div><?php echo $flashPartialView;?></div>
        <div class="form-group">
          <label class="control-label" for="itemname">Name</label>
          <input type="text" class="form-control" name="nameitem" id="itemname" placeholder="Enter Item name" required autofocus />
        </div>
        <!-- description input -->
        <div class="form-group">
          <label class="control-label" for="itemdes">Item description</label>
          <textarea type="text" class="form-control" name="desitem" id="itemdes" placeholder="Enter Item description" style="resize: none; "/></textarea>
        </div>
        <div class="row">
          <div class="col-8">
            <!-- category input -->
            <div class="form-group">
              <label class="control-label" for="inputcat">Category</label>
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Select category" aria-label="category" aria-describedby="basic-addon2" id="inputcat" disabled>
                <div class="input-group-append">
                  <input type="hidden" id="inputcatid" name="catitem">
                  <button id="select_category" class="btn btn-outline-primary" type="button" >Select</button>
                </div>
              </div>
            </div>

            <!-- material input -->
            <div class="form-group">
              <label class="control-label" for="inputmat">Material</label>
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Select material" aria-label="material" aria-describedby="basic-addon2" id="inputmat" disabled>
                <input type="hidden" id="inputmatid" name="matitem">
                <div class="input-group-append">
                  <button id="select_material" class="btn btn-outline-primary" type="button" >Select</button>
                </div>
              </div>
            </div>

            <!-- department input -->
            <div class="form-group">
              <label class="control-label" for="inputdep">Department</label>
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Select department" aria-label="department" aria-describedby="basic-addon2" id="inputdep" disabled>
                <input type="hidden" id="inputdepid" name="depitem">
                <div class="input-group-append">
                  <button id="select_department" class="btn btn-outline-primary" type="button" >Select</button>
                </div>
              </div>
            </div>

            <!-- location input -->
            <div class="form-group">
              <label class="control-label" for="inputloc">Location</label>
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Select location" aria-label="user" aria-describedby="basic-addon2" id="inputloc" disabled>
                <input type="hidden" id="inputlocid" name="locitem">
                <div class="input-group-append">
                  <button id="select_location" class="btn btn-outline-primary" type="button" >Select</button>
                </div>
              </div>
            </div>


            <!-- brand input -->
            <div class="form-group">
              <label class="control-label" for="inputbrand">Brand</label>
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Select brand" aria-label="model" aria-describedby="basic-addon2" id="inputbrand" disabled>
                <div class="input-group-append">
                  <button id="select_brand" class="btn btn-outline-primary" type="button" >Select</button>
                </div>
              </div>
            </div>


            <!-- model input -->
            <div class="form-group">
              <label class="control-label" for="inputmodel">Model</label>
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Select model" aria-label="model" aria-describedby="basic-addon2" id="inputmodel" disabled>
                <input type="hidden" id="inputmodid" name="moditem">
                <div class="input-group-append">
                  <button id="select_model" class="btn btn-outline-primary " type="button" disabled>Select</button>
                </div>
              </div>
              <div class="text-warning alert-model" style="display: none;"></div>
            </div>

            <!-- user input -->
            <div class="form-group">
              <label class="control-label" for="inputuser">User</label>
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Select user" aria-label="user" aria-describedby="basic-addon2" id="inputuser" disabled>
                <input type="hidden" id="inputuserid" name="useritem">
                <div class="input-group-append">
                  <button id="select_user" class="btn btn-outline-primary" type="button" >Select</button>
                </div>
              </div>
            </div>

            <!-- owner input -->
            <div class="form-group">
              <label class="control-label" for="inputowner">Owner</label>
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Select owner" aria-label="owner" aria-describedby="basic-addon2" id="inputowner" disabled>
                <input type="hidden" id="inputownerid" name="ownitem">
                <div class="input-group-append">
                  <button id="select_owner" class="btn btn-outline-primary" type="button" >Select</button>
                </div>
              </div>
            </div>


          </div>
          <div class="col-4">
            <!-- item condition -->
            <div class="form-group">
              <label for="sel1">Condition:</label>
              <select class="form-control" id="sel1" name="conditionitem">
                <option value="New">New</option>
                <option value="Fair">Fair</option>
                <option value="Damaged">Damaged</option>
                <option value="Broken">Broken</option>
              </select>
            </div>

            <!-- item date -->
            <div class="form-group">
              <label for="inputdate">Date:</label>
              <input type="date" class="form-control" aria-label="date" aria-describedby="basic-addon2" id="inputdate" name="dateitem">
            </div>

            <!-- item cost -->
            <div class="form-group">
              <label for="inputcost">Cost:</label>
              <div class="input-group mb-3">
                <div class="input-group-append">
                  <button disabled class="btn btn-outline-info text-dark" type="button" >$</button>
                </div>
                <input type="number" class="form-control" placeholder="Enter the item price..." aria-label="cost" aria-describedby="basic-addon2" id="inputcost" name="costitem" >
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row-fluid">
      <div class="col-12">
        <button id="send" class="btn btn-primary" type="submit">
          <i class="mdi mdi-check"></i> Create
        </button>
        &nbsp;
        <a href="<?php echo base_url(); ?>items" class="btn btn-danger">
          <i class="mdi mdi-close"></i>&nbsp;Cancel
        </a>
      </div>
    </div>
  </form>

  <div class="row-fluid"><div class="col-12">&nbsp;</div></div>

  <div class="col-12">
    <!-- select the category modal-->
    <div class="modal  fade hide" id="selectCategory">
     <div class="modal-dialog modal-lg modal-dialog-centered">
       <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-header">
           <h4 class="modal-title">Select category</h4>
           <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <!-- Modal body -->
         <div class="modal-body ">
          <div class="catlist">
            <table id="category" cellpadding="0" cellspacing="0" class="table table-bordered" width="100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Categories</th>
                </tr>
              </thead>
              <tbody id="displayCat">

              </tbody>
            </table>
          </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
       </div>
     </div>
   </div>
 </div>
 <!-- select the material modal -->
 <div class="modal  fade hide" id="selectMaterial">
   <div class="modal-dialog modal-lg modal-dialog-centered">
     <div class="modal-content">
       <!-- Modal Header -->
       <div class="modal-header">
         <h4 class="modal-title">Select material</h4>
         <button type="button" class="close" data-dismiss="modal">&times;</button>
       </div>
       <!-- Modal body -->
       <div class="modal-body ">
        <div class="matlist">
          <table id="material" cellpadding="0" cellspacing="0" class="table table-bordered" width="100%">
            <thead>
              <tr>
                <th>ID</th>
                <th>Materials</th>
              </tr>
            </thead>
            <tbody id="displayMat">

            </tbody>
          </table>
        </div>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
       <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
     </div>
   </div>
 </div>
</div>

<!-- select the department modal -->
<div class="modal  fade hide" id="selectDepartment">
 <div class="modal-dialog modal-lg modal-dialog-centered">
   <div class="modal-content">
     <!-- Modal Header -->
     <div class="modal-header">
       <h4 class="modal-title">Select department</h4>
       <button type="button" class="close" data-dismiss="modal">&times;</button>
     </div>
     <!-- Modal body -->
     <div class="modal-body ">
      <div class="deplist">
        <table id="department" cellpadding="0" cellspacing="0" class="table table-bordered" width="100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>Departments</th>
            </tr>
          </thead>
          <tbody id="displayDep">

          </tbody>
        </table>
      </div>
    </div>
    <!-- Modal footer -->
    <div class="modal-footer">
     <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
   </div>
 </div>
</div>
</div>


<!-- select the location modal -->
<div class="modal  fade hide" id="selectLocation">
 <div class="modal-dialog modal-lg modal-dialog-centered">
   <div class="modal-content">
     <!-- Modal Header -->
     <div class="modal-header">
       <h4 class="modal-title">Select location</h4>
       <button type="button" class="close" data-dismiss="modal">&times;</button>
     </div>
     <!-- Modal body -->
     <div class="modal-body ">
      <div class="loclist">
        <table id="location" cellpadding="0" cellspacing="0" class="table table-bordered" width="100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>Locations</th>
            </tr>
          </thead>
          <tbody id="displayLoc">

          </tbody>
        </table>
      </div>
    </div>
    <!-- Modal footer -->
    <div class="modal-footer">
     <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
   </div>
 </div>
</div>
</div>

<!-- select the user modal -->
<div class="modal  fade hide" id="selectUser">
 <div class="modal-dialog modal-lg modal-dialog-centered">
   <div class="modal-content">
     <!-- Modal Header -->
     <div class="modal-header">
       <h4 class="modal-title">Select user</h4>
       <button type="button" class="close" data-dismiss="modal">&times;</button>
     </div>
     <!-- Modal body -->
     <div class="modal-body ">
      <div class="userlist">
        <table id="user" cellpadding="0" cellspacing="0" class="table table-bordered" width="100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>Users</th>
            </tr>
          </thead>
          <tbody id="displayLoc">

          </tbody>
        </table>
      </div>
    </div>
    <!-- Modal footer -->
    <div class="modal-footer">
     <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
   </div>
 </div>
</div>
</div>


<!-- select the owner modal -->
<div class="modal  fade hide" id="selectOwner">
 <div class="modal-dialog modal-lg modal-dialog-centered">
   <div class="modal-content">
     <!-- Modal Header -->
     <div class="modal-header">
       <h4 class="modal-title">Select Owner</h4>
       <button type="button" class="close" data-dismiss="modal">&times;</button>
     </div>
     <!-- Modal body -->
     <div class="modal-body ">
      <div class="ownerlist">
        <table id="owners" cellpadding="0" cellspacing="0" class="table table-bordered" width="100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>Owner</th>
            </tr>
          </thead>
          <tbody id="displayOwn">

          </tbody>
        </table>
      </div>
    </div>
    <!-- Modal footer -->
    <div class="modal-footer">
     <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
   </div>
 </div>
</div>
</div>


<!-- select the brand modal -->
<div class="modal  fade hide" id="selectBrand">
 <div class="modal-dialog modal-lg modal-dialog-centered">
   <div class="modal-content">
     <!-- Modal Header -->
     <div class="modal-header">
       <h4 class="modal-title">Select  Brand</h4>
       <button type="button" class="close" data-dismiss="modal">&times;</button>
     </div>
     <!-- Modal body -->
     <div class="modal-body ">
      <div class="brandlist">
        <table id="brands" cellpadding="0" cellspacing="0" class="table table-bordered" width="100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>Brand</th>
            </tr>
          </thead>
          <tbody id="displayOwn">

          </tbody>
        </table>
      </div>
    </div>
    <!-- Modal footer -->
    <div class="modal-footer">
     <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
   </div>
 </div>
</div>
</div>


<!-- select the brand modal -->
<div class="modal  fade hide" id="selectModel">
 <div class="modal-dialog modal-lg modal-dialog-centered">
   <div class="modal-content">
     <!-- Modal Header -->
     <div class="modal-header">
       <h4 class="modal-title">Select Model</h4>
       <button type="button" class="close" data-dismiss="modal">&times;</button>
     </div>
     <!-- Modal body -->
     <div class="modal-body ">
      <div class="modellist">
        <table id="models" cellpadding="0" cellspacing="0" class="table table-bordered" width="100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>Models</th>
            </tr>
          </thead>
          <tbody id="displayMod">

          </tbody>
        </table>
      </div>
    </div>
    <!-- Modal footer -->
    <div class="modal-footer">
     <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
   </div>
 </div>
</div>
</div>


</div>



</div>
<!-- link bootstrap4 and javaScipt -->
<link href="<?php echo base_url();?>assets/DataTable/DataTables-1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/DataTable//DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/DataTable//DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $(function(){
    var catname, catid ='';
    var matname, matid ='';
    var depname, depid ='';
    var locname, locid ='';
    var username, userid ='';
    var ownername, ownerid ='';
    var brandname, brandid ='';
    var modelname, modelid ='';
    // cate function
    $("#select_category").click(function(){
      // var catid='';
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>/category/showAllCategory',
        async: true,
        dataType: 'json',
        success: function(data){
          $('#selectCategory').modal('show');
          var c = $('#category').DataTable({
            destroy: true,
            responsive: true,
            pageLength: 5,
            info: false,
            lengthChange: false
          });
          c.clear().draw();
          var i;
          var n = 1;
          for(i=0; i<data.length; i++){
            c.row.add ( [
              data[i].idcategory,
              data[i].category
              ] ).draw( false );
            n++;
          }
        }
      });
    });

    $(document).on("click", "#category tbody tr", function() {
      $('#category tbody tr').removeClass("highlight");
      $(this).addClass("highlight");
      catid= $(this).find("td:eq(0)").html();
      catname= $(this).find("td:eq(1)").html();
      $('#inputcat').val('');
      $('#inputcat').val(catname);
      $('#inputcatid').val('');
      $('#inputcatid').val(catid);
      $("#selectCategory").modal("hide");
    });


    // material function
    $("#select_material").click(function(){
          // var catid='';
          $.ajax({
            type: 'POST',
            url: '<?php echo base_url();?>/materials/showAllMaterial',
            async: true,
            dataType: 'json',
            success: function(data){
              $('#selectMaterial').modal('show');
              var c = $('#material').DataTable({
                destroy: true,
                responsive: true,
                pageLength: 5,
                info: false,
                lengthChange: false
              });
              c.clear().draw();
              var i;
              var n = 1;
              for(i=0; i<data.length; i++){
                c.row.add ( [
                  data[i].idmaterial,
                  data[i].material
                  ] ).draw( false );
                n++;
              }
            }
          });
        });

    $(document).on("click", "#material tbody tr", function() {
      $('#material tbody tr').removeClass("highlight");
      $(this).addClass("highlight");
      matid= $(this).find("td:eq(0)").html();
      matname= $(this).find("td:eq(1)").html();
      $('#inputmat').val('');
      $('#inputmat').val(matname);
      $('#inputmatid').val('');
      $('#inputmatid').val(matid);
      $("#selectMaterial").modal("hide");
    });

    // department function
    $("#select_department").click(function(){
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>/departments/showAllDepartments',
        async: true,
        dataType: 'json',
        success: function(data){
          $('#selectDepartment').modal('show');
          var c = $('#department').DataTable({
            destroy: true,
            responsive: true,
            pageLength: 5,
            info: false,
            lengthChange: false
          });
          c.clear().draw();
          var i;
          var n = 1;
          for(i=0; i<data.length; i++){
            c.row.add ( [
              data[i].iddepartment,
              data[i].department
              ] ).draw( false );
            n++;
          }
        }
      });
    });

    $(document).on("click", "#department tbody tr", function() {
      $('#department tbody tr').removeClass("highlight");
      $(this).addClass("highlight");
      depid= $(this).find("td:eq(0)").html();
      depname= $(this).find("td:eq(1)").html();
      $('#inputdep').val('');
      $('#inputdep').val(depname);
      $('#inputdepid').val('');
      $('#inputdepid').val(depid);
      $("#selectDepartment").modal("hide");
    });


    // location function
    $("#select_location").click(function(){
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>/locations/showAlllocat',
        async: true,
        dataType: 'json',
        success: function(data){
          $('#selectLocation').modal('show');
          var c = $('#location').DataTable({
            destroy: true,
            responsive: true,
            pageLength: 5,
            info: false,
            lengthChange: false
          });
          c.clear().draw();
          var i;
          var n = 1;
          for(i=0; i<data.length; i++){
            c.row.add ( [
              data[i].idlocation,
              data[i].location
              ] ).draw( false );
            n++;
          }
        }
      });
    });

    $(document).on("click", "#location tbody tr", function() {
      $('#department tbody tr').removeClass("highlight");
      $(this).addClass("highlight");
      locid= $(this).find("td:eq(0)").html();
      locname= $(this).find("td:eq(1)").html();
      $('#inputloc').val('');
      $('#inputloc').val(locname);
      $('#inputlocid').val('');
      $('#inputlocid').val(locid);
      $("#selectLocation").modal("hide");
    });

    // user function
    $("#select_user").click(function(){
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>/users/showAllUsers',
        async: true,
        dataType: 'json',
        success: function(data){
          $('#selectUser').modal('show');
          var c = $('#user').DataTable({
            destroy: true,
            responsive: true,
            pageLength: 5,
            info: false,
            lengthChange: false
          });
          c.clear().draw();
          var i;
          var n = 1;
          for(i=0; i<data.length; i++){
            c.row.add ( [
              data[i].id,
              data[i].firstname+' '+data[i].lastname
              ] ).draw( false );
            n++;
          }
        }
      });
    });

    $(document).on("click", "#user tbody tr", function() {
      $('#user tbody tr').removeClass("highlight");
      $(this).addClass("highlight");
      locid= $(this).find("td:eq(0)").html();
      locname= $(this).find("td:eq(1)").html();
      $('#inputuser').val('');
      $('#inputuser').val(locname);
      $('#inputuserid').val('');
      $('#inputuserid').val(locid);
      $("#selectUser").modal("hide");
    });


    // owner function
    $("#select_owner").click(function(){
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>/owner/showAllOwner',
        async: true,
        dataType: 'json',
        success: function(data){
          $('#selectOwner').modal('show');
          var c = $('#owners').DataTable({
            destroy: true,
            responsive: true,
            pageLength: 5,
            info: false,
            lengthChange: false
          });
          c.clear().draw();
          var i;
          var n = 1;
          for(i=0; i<data.length; i++){
            c.row.add ( [
              data[i].idowner,
              data[i].owner
              ] ).draw( false );
            n++;
          }
        }
      });
    });

    $(document).on("click", "#owners tbody tr", function() {
      $('#owners tbody tr').removeClass("highlight");
      $(this).addClass("highlight");
      ownerid= $(this).find("td:eq(0)").html();
      ownername= $(this).find("td:eq(1)").html();
      $('#inputowner').val('');
      $('#inputowner').val(ownername);
      $('#inputownerid').val('');
      $('#inputownerid').val(ownerid);
      $("#selectOwner").modal("hide");
    });



    // brand function
    $("#select_brand").click(function(){
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>/brand/showAllBrand',
        async: true,
        dataType: 'json',
        success: function(data){
          $('#selectBrand').modal('show');
          var c = $('#brands').DataTable({
            destroy: true,
            responsive: true,
            pageLength: 5,
            info: false,
            lengthChange: false
          });
          c.clear().draw();
          var i;
          var n = 1;
          for(i=0; i<data.length; i++){
            c.row.add ( [
              data[i].idbrand,
              data[i].brand
              ] ).draw( false );
            n++;
          }
        }
      });
    });

    $(document).on("click", "#brands tbody tr", function() {
      $('#brands tbody tr').removeClass("highlight");
      $(this).addClass("highlight");
      brandid= $(this).find("td:eq(0)").html();
      brandname= $(this).find("td:eq(1)").html();
      $('#inputbrand').val('');
      $("#select_model").removeAttr('disabled');
      $('.alert-model').fadeOut('slow');
      $('#inputbrand').val(brandname);
      $("#selectBrand").modal("hide");
    });

    $('.alert-model').html("You cannot select model without selected any item's brand. ").fadeIn();

    // model function
    $("#select_model").click(function(){
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>/models/showAllModelsByBrandId/'+brandid,
        async: true,
        dataType: 'json',
        success: function(data){
          $('#selectModel').modal('show');
          var c = $('#models').DataTable({
            destroy: true,
            responsive: true,
            pageLength: 5,
            info: false,
            lengthChange: false
          });
          c.clear().draw();
          var i;
          var n = 1;
          for(i=0; i<data.length; i++){
            c.row.add ( [
              data[i].idmodel,
              data[i].model
              ] ).draw( false );
            n++;
          }
        }
      });

    });

    $(document).on("click", "#models tbody tr", function() {
      $('#models tbody tr').removeClass("highlight");
      $(this).addClass("highlight");
      modelid= $(this).find("td:eq(0)").html();
      modelname= $(this).find("td:eq(1)").html();
      $('#inputmodel').val('');
      $('#inputmodel').val(modelname);
      $('#inputmodid').val('');
      $('#inputmodid').val(modelid);
      $("#selectModel").modal("hide");
    });


  });
</script>
