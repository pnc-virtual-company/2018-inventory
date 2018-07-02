<style>
.highlight { background-color: #007bff; color:#fff;}
.dt-buttons .buttons-colvis{
  background:#007bff;
  color: #fff;
  border: 1px solid #9990;
  border-radius: 2px;
}
.dt-buttons>.buttons-colvis:hover{
  background:#0872e4 !important;
  color: #fff;
  border: 1px solid #6660  !important;
  border-radius: 2px;
}
.dt-button-collection .dt-button{
  border: 1px solid #6660  !important;
  border-radius: 3px !important;
}
.dt-button-collection .dt-button:hover{
  background: #007bff !important;
  color: #fff !important;
  border-radius: 2px !important;
}
.badge{
  padding: 5px;
  margin-top: 2px;
}

.list-group-item{
  cursor: pointer;
}

#filterbutton{
  color: black !important;
}

#formfilter{
  width: max-content;
  max-width: 100%;
}
</style>
<br>
<div id="container">
    <div class="row-fluid">
        <div class="col-12">
      <div class="row">
        <div class="col-10">
          <h2><?php echo $title;?></h2>
        </div>
        <div class="col-2">
          <!-- this use for validate on user login into system if they take a role as user or admin -->
            <?php
            $role = $this->session->Role;
            if ($role == 1 || $role == 8) {
                ?>
            <a href="<?php echo base_url(); ?>items/create" class="btn btn-primary float-right"><i class="mdi mdi-plus-circle"></i>&nbsp;Create a new item</a>
                <?php
            }
            ?>
        </div>
      </div>
    </div>
    <br>
    <div class="col-12">
      <div class="form-group" id="formfilter">
        <div class="input-group">
          <div class="input-group-append">
            <button id="filterbutton" class="btn btn-default" type="button" disabled>Filter</button>
          </div>
          <div type="text" class="form-control" id="inputFilter" type="text"></div>
          <div class="input-group-append">
            <button id="addFilter" class="btn btn-primary" type="button" ><i class="mdi mdi-plus"></i>
            </button>
            <button id="clearFilter" class="btn btn-danger" type="button" ><i class="mdi mdi-close"></i></button>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid"><?php echo $flashPartialView;?></div>
    <div class="alert alert-info" style="display: none;"></div>
    <div class="table-responsive">
      <table id="items" cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover display" width="100%">
        <colgroup>
          <col span="1" style="background-color:#eff3f7;">
        </colgroup>
        <thead>
          <tr>
            <th class="permanent">Identifier</th>
            <th>Name</th>
            <th>Category</th>
            <th>Material</th>
            <th>Condition</th>
            <th>Department</th>
            <th>Location</th>
            <th>User</th>
            <th>Owner</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody id="showdata">
          <!-- it will show data into tbody by ajax below -->
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="row-fluid">
  <div class="col-12">
    <?php
    $role = $this->session->Role;
    if ($role == 1 || $role == 8) {
        ?>
      <a href="<?php echo base_url(); ?>items/export" class="btn btn-primary"><i class="mdi mdi-file-excel"></i>&nbsp;Export this list</a>
        <?php
    }
    ?>
    &nbsp;
  </div>
</div>

<!--modal for delete an item it will alert when click on delete icon -->
<div id="deleteModal" class="modal hide fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure that you want to delete this item</p>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-primary" id="delete-comfirm">Yes</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>


<!-- modal for view detail of each item when click on eye icon -->
<div id="viewDetailModal" class="modal hide fade " tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content ">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title">Item detail:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body bg-light">
        <table width="100%" class="table table-hover table-sm">
          <colgroup>
            <col span="1" style="background-color:#eff3f7;">
          </colgroup>
          <tbody id="frm_view">
            <tr>
              <td>Name </td>
              <td id="detail-name"></td>
            </tr>
            <tr>
              <td>Description </td>
              <td id="detail-description"></td>
            </tr>
            <tr>
              <td>Label </td>
              <td id="detail-label"></td>
            </tr>
            <tr>
              <td>Cost of item </td>
              <td>
                <span>$</span>
                <span id="detail-cost"></span>
              </td>
            </tr>
            <tr>
              <td>Condition </td>
              <td id="detail-condition"></td>
            </tr>
            <tr>
              <td>Type </td>
              <td id="detail-type"></td>
            </tr>
            <tr>
            <tr>
              <td>Brand </td>
              <td id="detail-brand"></td>
            </tr>
            <tr>
              <td>Model </td>
              <td id="detail-model"></td>
            </tr>
            <tr>
              <td>Material </td>
              <td id="detail-material"></td>
            </tr>
            <tr>
              <td>Location </td>
              <td id="detail-location"></td>
            </tr>
            <tr>
              <td>Department </td>
              <td id="detail-department"></td>
            </tr>
            <tr>
              <td>Username </td>
              <td id="detail-username"></td>
            </tr>
            <tr>
              <td>Owner </td>
              <td id="detail-owner"></td>
            </tr>
            <tr>
              <td>Status </td>
              <td id="detail-status"></td>
            </tr>
            <!-- for show data detail from controller -->

          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>


<!-- filter modal add-->
<div id="filteradd" class="modal hide fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Select the column you want to filter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="list-group">
          <li class="list-group-item list-group-item-action" id="select_category">Category</li>
          <li class="list-group-item list-group-item-action" id="select_material">Material</li>
          <li class="list-group-item list-group-item-action" id="select_condition">Condition</li>
          <li class="list-group-item list-group-item-action" id="select_department">Department</li>
          <li class="list-group-item list-group-item-action" id="select_location">Location</li>
          <li class="list-group-item list-group-item-action" id="select_user">User</li>
          <li class="list-group-item list-group-item-action" id="select_owner">Owner</li>
          <li class="list-group-item list-group-item-action" id="select_date">Date</li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<!-- select the category modal-->
<div class="modal  fade hide" id="selectCategory">
 <div class="modal-dialog modal-lg modal-dialog-centered">
   <div class="modal-content">
     <!-- Modal Header -->
     <div class="modal-header">
       <h4 class="modal-title">Select a value</h4>
       <button type="button" class="close" data-dismiss="modal">&times;</button>
     </div>
     <!-- Modal body -->
     <div class="modal-body ">
      <div class="catlist">
        <table id="category" cellpadding="0" cellspacing="0" class="table table-bordered table-hover" style="cursor:pointer;" width="100%">
          <thead>
            <tr>
              <th>Value</th>
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
      <h4 class="modal-title">Select a value</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <!-- Modal body -->
    <div class="modal-body ">
      <div class="matlist">
        <table id="material" cellpadding="0" cellspacing="0" class="table table-bordered table-hover" style="cursor:pointer;" width="100%">
          <thead>
            <tr>
              <th>Value</th>
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


<!-- condition modal-->
<div id="conditionModal" class="modal hide fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Select the condition</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="list-group conditionList">
          <li class="list-group-item list-group-item-action" value="New" id="set_New">New</li>
          <li class="list-group-item list-group-item-action" value="Fair" id="set_Fair">Fair</li>
          <li class="list-group-item list-group-item-action" value="Damaged" id="set_Damaged">Damaged</li>
          <li class="list-group-item list-group-item-action" value="Broken" id="set_Broken">Broken</li>

        </ul>
      </div>
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
       <h4 class="modal-title">Select a value</h4>
       <button type="button" class="close" data-dismiss="modal">&times;</button>
     </div>
     <!-- Modal body -->
     <div class="modal-body ">
      <div class="deplist">
        <table id="department" cellpadding="0" cellspacing="0" class="table table-bordered table-hover" style="cursor:pointer;" width="100%">
          <thead>
            <tr>
              <th>Value</th>
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
       <h4 class="modal-title">Select a value</h4>
       <button type="button" class="close" data-dismiss="modal">&times;</button>
     </div>
     <!-- Modal body -->
     <div class="modal-body ">
      <div class="loclist">
        <table id="location" cellpadding="0" cellspacing="0" class="table table-bordered table-hover" style="cursor:pointer;" width="100%">
          <thead>
            <tr>
              <th>Value</th>
            </tr>
          </thead>
          <tbody id="displayLoc">

          </tbody>
        </table>
      </div>
    </div>
    <!-- Modal footer -->
    <div class="modal-footer">
     <button type="button" class="btn btn-primary" id="locset">OK</button>
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
       <h4 class="modal-title">Select a value</h4>
       <button type="button" class="close" data-dismiss="modal">&times;</button>
     </div>
     <!-- Modal body -->
     <div class="modal-body ">
      <div class="userlist">
        <table id="user" cellpadding="0" cellspacing="0" class="table table-bordered table-hover" style="cursor:pointer;" width="100%">
          <thead>
            <tr>
              <th>Users</th>
            </tr>
          </thead>
          <tbody id="displayUser">

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
       <h4 class="modal-title">Select a value</h4>
       <button type="button" class="close" data-dismiss="modal">&times;</button>
     </div>
     <!-- Modal body -->
     <div class="modal-body ">
      <div class="ownerlist">
        <table id="owners" cellpadding="0" cellspacing="0" class="table table-bordered table-hover" style="cursor:pointer;" width="100%">
          <thead>
            <tr>
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

<!-- condition modal-->
<div id="dateModal" class="modal hide fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Select a date</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <br>
        <div class="form-inline">
          <div class="form-group">
            <label for="conditionDate">Date is &nbsp;</label>
            <select class="form-control" id="conditionDate">
              <option value=">">Greater than</option>
              <option value=">=">Greater or equal to</option>
              <option value="==">Equal to</option>
              <option value="<">Lesser than</option>
              <option value="<=">Lesser or equal to</option>
            </select>
          </div>
          <label for="datecondition" >&nbsp; To &nbsp;</label>
          <input type="text" class="form-control datepicker" id='datecondition'>
        </div>
        <br>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-primary" id="saveDate">Yes</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>


<link href="<?php echo base_url();?>assets/DataTable/DataTables-1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<!-- columns visibility and reorder datatable -->
<link rel="stylesheet" href="https://cdn.datatables.net/colreorder/1.4.1/css/colReorder.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
<!-- fixcolumns -->
<link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.2.4/css/fixedColumns.dataTables.min.css">
<!--Datepicker widget needs its CSS and JS files to work //-->
<link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap-datepicker-1.7.1/css/bootstrap-datepicker.min.css">


<script type="text/javascript" src="<?php echo base_url();?>assets/DataTable//DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/DataTable//DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<!-- columns visibility and reorder datatable -->
<script src="https://cdn.datatables.net/colreorder/1.4.1/js/dataTables.colReorder.min.js"></script>
<!-- fixed columns -->
<script src="https://cdn.datatables.net/fixedcolumns/3.2.4/js/dataTables.fixedColumns.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
<script src="<?php echo base_url();?>assets/bootstrap-datepicker-1.7.1/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){

  // to make column reorder in table list item
  var t = $('#items').DataTable({
    order:[] ,
    colReorder: true,
    responsive: true,
    'ajax':
    {
      'type': 'GET',
      'url':'<?php echo base_url();?>items/showAllitems', //access to controller for get data from database
      'dataType':'json'
    },
    "colReorder":
    {
      fixedColumnsLeft:1,
    },
    "dom":"Bfrtip",
    stateSave: true,
    "buttons":
    [{
      extend:'colvis',
      columns:':not(.permanent)'
    }]
  });
  showAllitems(); //call function to use

  // showAllitems function get data from database in items show in table
  function showAllitems()
  {
    // show spin waiting for the result by ajax
    $("#showdata").html('<tr> <td class="text-center text-info"colspan="10"><i class="mdi mdi-cached mdi-spin mdi-24px"></i> Loading...</td></tr>');
    $.ajax({
      type: 'ajax',
      url: '<?php echo base_url();?>items/showAllitems',
      async: true,
      dataType: 'json',
      success: function(data){
        t.clear().draw(); //this funciton is for make a result don't have dupplicate result
        var n = 1; //variable for count number
        var i;
        var status="";
        for(i=0; i<data.length; i++) //validate for status available
        {
          if (data[i].status=='0')
          {
            status='<span class="badge badge-success">Available</span>';
            <?php $role = $this->session->Role; ?>
            t.row.add( [
              data[i].itemcodeid+
              '&nbsp;<?php
                if ($role == 1 || $role == 8) {
                    ?><a href="<?php echo base_url() ?>items/edit/'+data[i].iditem+'" class="item-edit" dataid="'+data[i].iditem+'" data-toggle="tooltip" title="Edit item"><i class="mdi mdi-pencil"></i></a>'+
                '<a href="#" class="item-delete text-danger" dataid="'+data[i].iditem+'"><i class="mdi mdi-delete" data-toggle="tooltip" title="Delete item"></i></a> <?php
                } ?>'+
                '&nbsp;<a href="#" class="item-view" dataid="'+data[i].iditem+'" data-toggle="tooltip" title="Show item detail"><i class="mdi mdi-eye text-primary"></i></a>'+
                '&nbsp;<a href="<?php echo base_url();?>items/borrower/'+data[i].iditem+'" class="item" dataid="'+data[i].iditem+'"><i class="mdi mdi-basket-fill" id="borrow" data-toggle="tooltip" title="Borrow"></i></a>',

                data[i].item,data[i].cat,data[i].mat,data[i].condition,data[i].depat,data[i].locat,data[i].nameuser,data[i].owner,status
                ] ).draw( false );
            n++;

          }else if(data[i].status =='1'){ //validate for status borrowed

            status='<span class="badge badge-warning">Borrowed</span>';
            <?php $role = $this->session->Role; ?>
            t.row.add( [
              data[i].itemcodeid+
              '&nbsp;<?php
                if ($role == 1 || $role == 8) {
                    ?><a href="<?php echo base_url() ?>items/edit/'+data[i].iditem+'" class="item-edit" dataid="'+data[i].iditem+'" data-toggle="tooltip" title="Edit item"><i class="mdi mdi-pencil"></i></a>'+
               '<a href="#" class="item-delete text-danger" dataid="'+data[i].iditem+'"><i class="mdi mdi-delete" data-toggle="tooltip" title="Delete item"></i></a> <?php
                } ?>'+
               '&nbsp;<a href="#" class="item-view" dataid="'+data[i].iditem+'" data-toggle="tooltip" title="Show item detail"><i class="mdi mdi-eye text-primary"></i></a>'+
               '&nbsp; <?php
                if ($role == 1 || $role == 8) {
                    ?> <a href="<?php echo base_url(); ?>items/returnItem/'+data[i].iditem+'" class="item" dataid="'+data[i].iditem+'"><i class="mdi mdi-redo-variant" id="return" data-toggle="tooltip" title="Return"></i></a><?php
                } ?>',

                   //display the data that get from database to table tbody

                   data[i].item,data[i].cat,data[i].mat,data[i].condition,data[i].depat,data[i].locat,data[i].nameuser,data[i].owner,status
                   ] ).draw( false );
              n++; //count number on id
          }else { //validate for status late

            <?php $role = $this->session->Role; if ($role == 1 || $role == 8) {
                    ?> //validate role if normal user will not display late status
              status='<span class="badge badge-danger">Late</span>';
                <?php
                } else {
                    ?> //for normal user will display borrowed status instead of late status
                status='<span class="badge badge-warning">Borrowed</span>';
                <?php
                } ?>

              t.row.add( [
                data[i].itemcodeid+
                '&nbsp;<?php
                if ($role == 1 || $role == 8) {
                    ?><a href="<?php echo base_url() ?>items/edit/'+data[i].iditem+'" class="item-edit" dataid="'+data[i].iditem+'" data-toggle="tooltip" title="Edit item"><i class="mdi mdi-pencil"></i></a>'+
                 '<a href="#" class="item-delete text-danger" dataid="'+data[i].iditem+'"><i class="mdi mdi-delete" data-toggle="tooltip" title="Delete item"></i></a> <?php
                } ?>'+
                 '&nbsp;<a href="#" class="item-view" dataid="'+data[i].iditem+'" data-toggle="tooltip" title="Show item detail"><i class="mdi mdi-eye text-primary"></i></a>'+
                 '&nbsp; <?php
                    if ($role == 1 || $role == 8) {
                        ?> <a href="<?php echo base_url(); ?>items/returnItem/'+data[i].iditem+'" class="item" dataid="'+data[i].iditem+'"><i class="mdi mdi-redo-variant" id="return" data-toggle="tooltip" title="Return"></i></a><?php
                    } ?>',

                   data[i].item,data[i].cat,data[i].mat,data[i].condition,data[i].depat,data[i].locat,data[i].nameuser,data[i].owner,status
                   ] ).draw( false );
              n++;
            }

          }
        },
        error: function()
        {
          alert('Could not get Data from Database');
        }
      });
}

  //  Combine btn onclick OK with key Enter when delete
  $('#deleteModal').keypress(function(e){
    if(e.which === 13){//Enter key pressed
      e.preventDefault();
      $('#delete-comfirm').click();//Trigger search button click event
    }
  });

  // delete item by ajax when click on icon delete
  $('#showdata').on('click', '.item-delete', function(){
    var id = $(this).attr('dataid');
    $('#deleteModal').data('id', id).modal('show');
  });

  // load modal confirmation when click delete icon
  $("#delete-comfirm").on('click',function(){
    var id = $('#deleteModal').data('id');
    $.ajax({
      url: "<?php echo base_url() ?>items/deleteItems", // access to controller to delete from database
      type: "POST",
      data: {iditem: id},
      dataType: "json",
      success: function(data){
        $('#deleteModal').modal('hide');
        //alert message when delete successfully
        $('.alert-info').html('Item was deleted successfully').fadeIn().delay(4000).fadeOut('slow');
        showAllitems();
      },
      error: function(){
        $('#deleteModal').modal('hide');
        alert("Error delete! this item is has relationship with another...");
      }
    });
  });

  // load modal for show the detail an item when click on eye icon to show detail of each item that clicked
  $('#showdata').on('click', '.item-view', function(){
    var id = $(this).attr('dataid');
    $.ajax({
     type: 'POST',
     data: {iditem: id},
     url: '<?php echo base_url();?>/items/showDetailItem', //access to controller to get all the detail item from database
     async: true,
     dataType: 'json',
     success: function(data){
      // $('#frm_view').html(data);
      $('#detail-name').html(data.name);
      $('#detail-description').html(data.description);
      $('#detail-label').html(data.code);
      $('#detail-cost').html(data.cost ? data.cost : 0);
      $('#detail-condition').html(data.condition);
      $('#detail-type').html(data.cat);
      $('#detail-brand').html(data.brand);
      $('#detail-model').html(data.model);
      $('#detail-material').html(data.mat);
      $('#detail-location').html(data.locat);
      $('#detail-department').html(data.depat);
      $('#detail-username').html(data.nameuser);
      $('#detail-owner').html(data.owner);
      $('#detail-status').html(data.status);
      $('#viewDetailModal').modal('show');
    },
    error: function(){
     alert('Could not get any data from Database');
   }
 });
  });



  $("#clearFilter").click(function(){
    $('#inputFilter').html('');
  });

  $(".remove_filter").click(function(){
    $(this).parent().fadeOut('slow');
  });

  $("#addFilter").click(function(){
    $('#filteradd').modal('show');
  });

  $("#select_category").click(function(){
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url();?>/items/showAllCategories',
      async: true,
      dataType: 'json',
      success: function(data){
        $('#selectCategory').modal('show');
        $('#filteradd').modal('hide');
        var c = $('#category').DataTable();
        c.clear().draw();
        var i;
        var n = 1;
        for(i=0; i<data.length; i++){
          c.row.add ( [
            data[i].category
            ] ).draw( false );
          n++;
        }
      },
      error: function(){
        alert('Could not get Data from Database');
      }
    });
  });

  var valueFilter = '';
  $(document).on("click", "#category tbody tr", function() {
    $('#category tbody tr').removeClass("highlight");
    $(this).addClass("highlight");
    valueFilter = $(this).find("td:eq(0)").html();
    $('#inputFilter').append('<span class="badge badge-pill badge-info ">Category: '+valueFilter+'&nbsp;<i class="mdi mdi-close-circle remove_filter"></i></span>&nbsp;');
    $("#selectCategory").modal("hide");
  });


  // material function
  $("#select_material").click(function(){
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url();?>/items/showAllMaterials',
      async: true,
      dataType: 'json',
      success: function(data){
        $('#selectMaterial').modal('show');
        $('#filteradd').modal('hide');
        var c = $('#material').DataTable();
        c.clear().draw();
        var i;
        var n = 1;
        for(i=0; i<data.length; i++){
          c.row.add ( [
            data[i].material
            ] ).draw( false );
          n++;
        }
      },
      error: function(){
        alert('Could not get Data from Database');
      }
    });
  });

  $(document).on("click", "#material tbody tr", function() {
    $('#material tbody tr').removeClass("highlight");
    $(this).addClass("highlight");
    valueFilter = $(this).find("td:eq(0)").html();
    $('#inputFilter').append('<span class="badge badge-pill badge-info ">Material: '+valueFilter+'&nbsp;<i class="mdi mdi-close-circle remove_filter"></i></span>&nbsp;');
    $("#selectMaterial").modal("hide");
  });

  // select condition function
  $("#select_condition").click(function(){
    $('#conditionModal').modal('show');
    $('#filteradd').modal('hide');
  });
  $('.conditionList li').click(function(){
    $('.conditionList li').removeClass("highlight");
    $(this).addClass("highlight");
    var valueFilter = $(this).attr("value");
    $('#inputFilter').append('<span class="badge badge-pill badge-info ">Condition: '+valueFilter+'&nbsp;<i class="mdi mdi-close-circle remove_filter"></i></span>&nbsp;');
    $("#conditionModal").modal("hide");
    $('.conditionList li').removeClass("highlight");
  })

       //select department function
       $("#select_department").click(function(){
        $.ajax({
          type: 'POST',
          url: '<?php echo base_url();?>/items/showAllDepartments',
          async: true,
          dataType: 'json',
          success: function(data){
            $('#selectDepartment').modal('show');
            $('#filteradd').modal('hide');
            var c = $('#department').DataTable();
            c.clear().draw();
            var i;
            var n = 1;
            for(i=0; i<data.length; i++){
              c.row.add ( [
                data[i].department
                ] ).draw( false );
              n++;
            }
          },
          error: function(){
            alert('Could not get Data from Database');
          }
        });
      });

       $(document).on("click", "#department tbody tr", function() {
        $('#department tbody tr').removeClass("highlight");
        $(this).addClass("highlight");
        valueFilter = $(this).find("td:eq(0)").html();
        $('#inputFilter').append('<span class="badge badge-pill badge-info ">Department: '+valueFilter+'&nbsp;<i class="mdi mdi-close-circle remove_filter"></i></span>&nbsp;');
        $("#selectDepartment").modal("hide");
      });


  // location function
  $("#select_location").click(function(){
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url();?>/items/showAllLocations',
      async: true,
      dataType: 'json',
      success: function(data){
        $('#selectLocation').modal('show');
        $('#filteradd').modal('hide');
        var c = $('#location').DataTable();
        c.clear().draw();
        var i;
        var n = 1;
        for(i=0; i<data.length; i++){
          c.row.add ( [
            data[i].location
            ] ).draw( false );
          n++;
        }
      },
      error: function(){
        alert('Could not get Data from Database');
      }
    });
  });

  $(document).on("click", "#location tbody tr", function() {
    $('#department tbody tr').removeClass("highlight");
    $(this).addClass("highlight");
    valueFilter = $(this).find("td:eq(0)").html();
    $('#inputFilter').append('<span class="badge badge-pill badge-info ">Location: '+valueFilter+'&nbsp;<i class="mdi mdi-close-circle remove_filter"></i></span>&nbsp;');
    $("#selectLocation").modal("hide");
  });


  // user function
  $("#select_user").click(function(){
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url();?>/items/showAllUsers',
      async: true,
      dataType: 'json',
      success: function(data){
        $('#selectUser').modal('show');
        $('#filteradd').modal('hide');
        var c = $('#user').DataTable();
        c.clear().draw();
        var i;
        var n = 1;
        for(i=0; i<data.length; i++){
          c.row.add ( [
            data[i].firstname+' '+data[i].lastname
            ] ).draw( false );
          n++;
        }
      },
      error: function(){
        alert('Could not get Data from Database');
      }
    });
  });

  $(document).on("click", "#user tbody tr", function() {
    $('#user tbody tr').removeClass("highlight");
    $(this).addClass("highlight");
    valueFilter = $(this).find("td:eq(0)").html();
    $('#inputFilter').append('<span class="badge badge-pill badge-info ">User: '+valueFilter+'&nbsp;<i class="mdi mdi-close-circle remove_filter"></i></span>&nbsp;');
    $("#selectUser").modal("hide");
  });

    // owner function
    $("#select_owner").click(function(){
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>/items/showAllOwners',
        async: true,
        dataType: 'json',
        success: function(data){
          $('#selectOwner').modal('show');
          $('#filteradd').modal('hide');
          var c = $('#owners').DataTable();
          c.clear().draw();
          var i;
          var n = 1;
          for(i=0; i<data.length; i++){
            c.row.add ( [
              data[i].owner
              ] ).draw( false );
            n++;
          }
        },
        error: function(){
          alert('Could not get Data from Database');
        }
      });
    });

    $(document).on("click", "#owners tbody tr", function() {
      $('#owners tbody tr').removeClass("highlight");
      $(this).addClass("highlight");
      valueFilter = $(this).find("td:eq(0)").html();
      $('#inputFilter').append('<span class="badge badge-pill badge-info ">Owner: '+valueFilter+'&nbsp;<i class="mdi mdi-close-circle remove_filter"></i></span>&nbsp;');
      $("#selectOwner").modal("hide");
    });


  // select condition function
  $("#select_date").click(function(){
    $('#dateModal').modal('show');
    $('#filteradd').modal('hide');
  });
  $('#saveDate').click(function(){
    var dateValCondition = $('#conditionDate').val();
    var valueFilter = $('#datecondition').val();
    $('#inputFilter').append('<span class="badge badge-pill badge-info ">Date '+dateValCondition+' '+valueFilter+'&nbsp;<i class="mdi mdi-close-circle remove_filter"></i></span>&nbsp;');
    $('#datecondition').val('');
    $("#dateModal").modal("hide");
  })

// date picker
$('.datepicker').datepicker({
  orientation:"bottom",
  todayBtn: true,
  todayHighlight: true,
  autoclose:true,
});
});
</script>
