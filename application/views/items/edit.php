
<style>
.highlight { background-color: #007bff; color:#fff;}
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
tr:hover{cursor: pointer;}

.selection .select2-selection {
  height: 37px;
  padding-top: 3px;
}

.selection .select2-selection .select2-selection__arrow {
  height: 37px;
}
</style>
<div class="container bg-light">
  <div class="row-fluid">
    <?php
    foreach ($itemEdit as $value) {
        ?>
      <form id="frm_create" action="<?php echo base_url(); ?>items/itemUpdate/<?php echo $value->iditem ?>" method="POST">
        <div class="col-12">
          <h2><?php echo $title.' ( '.$value->item.' )'; ?></h2>
          <div class="form-group">
            <label class="control-label" for="itemname">Name</label>
            <input type="text" class="form-control" name="nameitem" id="itemname" value="<?php echo htmlspecialchars($value->item) ?>" required autofocus/>
          </div>
          <!-- description input -->
          <div class="form-group">
            <label class="control-label" for="itemdes">Item description</label>
            <textarea type="text" class="form-control" name="desitem" id="itemdes" style="resize: none; "/><?php echo htmlspecialchars($value->description) ?></textarea>
          </div>

          <div class="row">
            <div class="col-8">
              <!-- category input -->
              <div class="form-group">
                <label class="control-label" for="inputcat">Category</label>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" aria-label="category" aria-describedby="basic-addon2" id="inputcat" value="<?php echo $value->cat?>" disabled>
                  <div class="input-group-append">
                    <input type="hidden" id="inputcatid" name="catitem" value="<?php echo $value->catid?>">
                    <input type="hidden" id="inputcatacr" name="catacritem" value="<?php echo $value->acronym?>">
                    <button id="select_category" class="btn btn-outline-primary" type="button" >Select</button>
                  </div>
                </div>
              </div>

              <!-- material input -->
              <div class="form-group">
                <label class="control-label" for="inputmat">Material</label>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" aria-label="material" aria-describedby="basic-addon2" id="inputmat" value="<?php echo $value->mat?>" disabled>
                  <input type="hidden" id="inputmatid" name="matitem" value="<?php echo $value->matid?>">
                  <div class="input-group-append">
                    <button id="select_material" class="btn btn-outline-primary" type="button" >Select</button>
                  </div>
                </div>
              </div>

              <!-- department input -->
              <div class="form-group">
                <label class="control-label" for="inputdep">Department</label>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" aria-label="department" aria-describedby="basic-addon2" id="inputdep" value="<?php echo $value->depat; ?>" disabled>
                  <input type="hidden" id="inputdepid" name="depitem" value="<?php echo $value->depatid?>">
                  <div class="input-group-append">
                    <button id="select_department" class="btn btn-outline-primary" type="button" >Select</button>
                  </div>
                </div>
              </div>

              <!-- location input -->
              <div class="form-group">
                <label class="control-label" for="inputloc">Location</label>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" aria-label="user" aria-describedby="basic-addon2" id="inputloc" value="<?php echo $value->locat; ?>" disabled>
                  <input type="hidden" id="inputlocid" name="locitem" value="<?php echo $value->locatid; ?>">
                  <div class="input-group-append">
                    <button id="select_location" class="btn btn-outline-primary" type="button" >Select</button>
                  </div>
                </div>
              </div>


              <!-- brand input -->
              <div class="form-group">
                <label class="control-label" for="inputbrand">Brand</label>
                <div class="input-group mb-3">
                  <input type="text" class="form-control"  aria-label="model" aria-describedby="basic-addon2" id="inputbrand" value="<?php echo $value->brand; ?>" disabled>
                  <div class="input-group-append">
                    <button id="select_brand" class="btn btn-outline-primary" type="button" >Select</button>
                  </div>
                </div>
              </div>


              <!-- model input -->
              <div class="form-group">
                <label class="control-label" for="inputmodel">Model</label>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Please select item model..." aria-label="model" aria-describedby="basic-addon2" id="inputmodel" value="<?php echo $value->model; ?>" disabled>
                  <input type="hidden" id="inputmodid" name="moditem" value="<?php echo $value->modelid; ?>">
                  <div class="input-group-append">
                    <button id="select_model" class="btn btn-outline-primary " type="button">Select</button>
                  </div>
                </div>
                <div class="text-warning alert-model" style="display: none;"></div>
              </div>

              <!-- user input -->
              <div class="form-group">
                <label class="control-label" for="inputuser">User</label>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" aria-label="user" aria-describedby="basic-addon2" id="inputuser" value="<?php echo $value->nameuser; ?>" disabled>
                  <input type="hidden" id="inputuserid" name="useritem" value="<?php echo $value->userid; ?>">
                  <div class="input-group-append">
                    <button id="select_user" class="btn btn-outline-primary" type="button" >Select</button>
                  </div>
                </div>
              </div>

              <!-- owner input -->
              <div class="form-group">
                <label class="control-label" for="inputowner">Owner</label>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" aria-label="owner" aria-describedby="basic-addon2" id="inputowner"  value="<?php echo $value->owner; ?>" disabled>
                  <input type="hidden" id="inputownerid" name="ownitem"  value="<?php echo $value->ownerid; ?>">
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
                  <option value="New" <?php if ($value->condition == 'New') {
            echo 'selected';
        } ?>>New</option>
                  <option value="Fair" <?php if ($value->condition == 'Fair') {
            echo 'selected';
        } ?>>Fair</option>
                  <option value="Damaged"  <?php if ($value->condition == 'Damaged') {
            echo 'selected';
        } ?>>Damaged</option>
                  <option value="Broken" <?php if ($value->condition == 'Broken') {
            echo 'selected';
        } ?>>Broken</option>
                </select>
              </div>
              <div class="form-group">
                <label for="sel1">Status:</label>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" aria-label="status" aria-describedby="basic-addon2" id="inputstatus"  value="<?php echo $value->status; ?>" disabled>
                  <input type="hidden" id="inputstatusid" name="statusitem"  value="<?php echo $value->statusid; ?>">
                  <div class="input-group-append">
                    <button id="select_status" class="btn btn-outline-primary" type="button" >Select</button>
                  </div>
                </div>
              </div>
              <?php  $condition = $value->date; ?>
              <!-- item date -->
              <div class="form-group">
                <label for="inputdate">Date:</label>
                <input type="date" class="form-control" aria-label="date" aria-describedby="basic-addon2" id="inputdate" name="dateitem" value="<?php echo $value->date; ?>">
              </div>

              <!-- item cost -->
              <div class="form-group">
                <label for="inputcost">Cost:</label>
                <div class="input-group mb-3">
                  <div class="input-group-append">
                    <button disabled class="btn btn-outline-info text-dark" type="button" >$</button>
                  </div>
                  <input type="number" class="form-control" aria-label="cost" aria-describedby="basic-addon2" id="inputcost" name="costitem" value="<?php echo $value->cost; ?>">
                </div>
              </div>

              <!-- item label -->
              <div class="form-group">
                <label for="inputcost">Label:</label>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" aria-label="cost" aria-describedby="basic-addon2" id="inputlabel" name="labelitem" disabled value="<?php echo $value->code; ?>">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

        <?php
    }//end foreach
    ?>
    <div class="row-fluid">
      <div class="col-12">
        <button id="send" class="btn btn-primary" type="submit">
          <i class="mdi mdi-check"></i> Update
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
<!-- select the status modal-->
<div class="modal  fade hide" id="selectStatus">
 <div class="modal-dialog modal-lg modal-dialog-centered">
   <div class="modal-content">
     <!-- Modal Header -->
     <div class="modal-header">
       <h4 class="modal-title">Select status</h4>
       <button type="button" class="close" data-dismiss="modal">&times;</button>
     </div>
     <!-- Modal body -->
     <div class="modal-body ">
      <div class="statuslist">
        <table id="status" cellpadding="0" cellspacing="0" class="table table-bordered" width="100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody id="displayStatus">

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
  var catname='', catid ='';
  var matname, matid ='';
  var depname, depid ='';
  var locname, locid ='';
  var username, userid ='';
  var ownername, ownerid ='';
  var brandname;
  var brandid ='<?php foreach ($itemEdit as $value) {
        echo $value->brandid;
    }?>';
  var modelname, modelid ='';
  $(function(){
    $('#sel1').select2({
      minimumResultsForSearch: Infinity
    });
    // cate function
    $("#select_category").click(function(){
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>/category/getAll',
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
      fetch(`<?php echo base_url();?>/category/getAcronym/${catid}`, { credentials: 'include' })
      .then(response => response.json())
      .then(acronym => {
        $('#inputcatacr').val(acronym);
        updateLabel();
      });
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
      updateLabel();
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
      userid= $(this).find("td:eq(0)").html();
      username= $(this).find("td:eq(1)").html();
      $('#inputuser').val('');
      $('#inputuser').val(username);
      $('#inputuserid').val('');
      $('#inputuserid').val(userid);
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
      $('#inputmodel').val('');
      $('#inputmodid').val('');
      $('#inputbrand').val(brandname);
      $("#selectBrand").modal("hide");
    });

    // $('.alert-model').html("You cannot select model without selected any item's brand. ").fadeIn();

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

    // cate function
    $("#select_status").click(function(){
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>/status/showAllStatus',
        async: true,
        dataType: 'json',
        success: function(data){
          $('#selectStatus').modal('show');
          var c = $('#status').DataTable({
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
              data[i].idstatus,
              data[i].status
              ] ).draw( false );
            n++;
          }
        }
      });
    });

    $(document).on("click", "#status tbody tr", function() {
      $('#status tbody tr').removeClass("highlight");
      $(this).addClass("highlight");
      catid= $(this).find("td:eq(0)").html();
      catname= $(this).find("td:eq(1)").html();
      $('#inputstatus').val('');
      $('#inputstatus').val(catname);
      $('#inputstatusid').val('');
      $('#inputstatusid').val(catid);
      $("#selectStatus").modal("hide");
    });

    function updateLabel(){
      let label = `${$('#inputcatacr').val()}-${$('#inputloc').val()}-<?php echo $value->iditem; ?>`;
      $('#inputlabel').val(label);
    }

  });
</script>
