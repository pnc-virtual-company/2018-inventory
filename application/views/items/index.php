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

.badge.badge-success {
    background-color: #12b738;
}

.badge.badge-danger {
  background-color: #ec1126;
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

.remove_filter { cursor: pointer; }

#inputFilter {
  padding-left: 2px;
  padding-top: 4px;
  padding-bottom: 4px;
  padding-right: 2px;
  min-height: 1.5em !important;
  min-width: 5em !important;
}

#inputFilter > span{
  padding-left: 4px;
  padding-right: 4px;
  margin-top: 0;
}

.filter-column-name, .filter-column-value { cursor: pointer; }

#addFilter-icon, #clearFilter { cursor: pointer; }
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
          <div class="card" data-value=''>
      			<div id="inputFilter" class="card-body input-tag">
      			</div>
      		</div>
          <!-- <div type="text" class="form-control card-body" id="inputFilter" type="text"></div> -->
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
            <th>Status</th>
            <th>Department</th>
            <th>Location</th>
            <th>User</th>
            <th>Owner</th>
            <th>Borrow Status</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody id="showdata">
          <!-- it will show data into tbody by ajax below -->
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php
$role = $this->session->Role;
if ($role == 1 || $role == 8) {
    ?>
<div id="container">
  <div class="row-fluid">
    <div class="col-12">
      <div class="row">
        <div class="col1">
          &nbsp;
            <a href="<?php echo base_url(); ?>items/export" class="btn btn-primary"><i class="mdi mdi-file-excel"></i>&nbsp;Export this list</a>
        </div>
        <div class="col1">
            <p>&nbsp;<button id="cmdPrintStickers" class="btn btn-primary"><i class="mdi mdi-printer"></i>&nbsp;Print stickers</button></p>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
}
?>

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
              <td>Status </td>
              <td id="detail-status"></td>
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
              <td>Borrow Status </td>
              <td id="detail-borrowstatus"></td>
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
          <li class="list-group-item list-group-item-action" id="select_status">Status</li>
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

<!-- select the status modal-->
<div class="modal fade hide" id="selectStatus">
 <div class="modal-dialog modal-lg modal-dialog-centered">
   <div class="modal-content">
     <!-- Modal Header -->
     <div class="modal-header">
       <h4 class="modal-title">Select a value</h4>
       <button type="button" class="close" data-dismiss="modal">&times;</button>
     </div>
     <!-- Modal body -->
     <div class="modal-body ">
      <div class="statuslist">
        <table id="status" cellpadding="0" cellspacing="0" class="table table-bordered table-hover" style="cursor:pointer;" width="100%">
          <thead>
            <tr>
              <th>Value</th>
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
<script src="<?php echo base_url();?>assets/js/item-script.js"
  hasPrivilege="<?php echo $role == 1 || $role == 8 ? 'true' : 'false'; ?>"
  baseUrl="<?php echo base_url(); ?>"></script>
