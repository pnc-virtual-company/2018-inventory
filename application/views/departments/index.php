<?php
   /**
    * This view displays the list of users.
    * @copyright  Copyright (c) 2014-2018 Benjamin BALET
    * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
    * @link       https://github.com/bbalet/skeleton
    * @since      1.0.0
    */
   ?>
<div id="container" class="container">
<div class="row-fluid">
   <div class="col-12">
      <h2><?php echo $title;?></h2>
      <?php echo $flashPartialView;?>
      <table id="users" cellpadding="0" cellspacing="0" class="table table-striped table-bordered" width="100%">
         <thead>
            <tr>
               <th class="text-right">ID</th>
               <th>Departments</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach ($departments as $department):?>
            <tr>
               <td data-order="<?php echo $department->iddepartment; ?>" data-id="<?php echo $department->iddepartment;?>"  class="text-right">
                  <!-- <a href="<?php echo base_url();?>users/edit/<?php echo $department->iddepartment ?>" title="Edit user"><i class="mdi mdi-pencil"></i></a> -->
                  <a href="#" class="confirm-edit" title="edit department"><i class="mdi mdi-pencil"></i></a>
                  <a href="#" class="confirm-delete" title="Delete department"><i class="mdi mdi-delete"></i></a>
                  <?php echo $department->iddepartment ?>&nbsp;
               </td>
               <td><?php echo $department->department?></td>
            </tr>
            <?php endforeach ?>
         </tbody>
      </table>
   </div>
</div>
<div class="row-fluid">
   <div class="col-12">&nbsp;</div>
</div>
<!-- create new department -->
<div class="container">
   <div class="row-fluid">
      <div class="col-12">
         <button type="button" class="btn btn-primary" id="crateDepartment">
         <i class="mdi mdi-plus-circle"></i>&nbsp;Create department
         </button>
      </div>
   </div>
</div>
<!-- delete  -->
<div id="frmConfirmDelete" class="modal hide fade" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <p>Are you sure that you want to delete this department?</p>
         </div>
         <div class="modal-footer">
            <a href="#" class="btn btn-primary" data-dismiss="modal">Yes</a>
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
         </div>
      </div>
   </div>
</div>
<!-- create -->
<div id="frmConfirmCreate" class="modal hide fade" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Create Department</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="" id="frm-create">
               <div class="form-inline">
                  <label for="">Department</label> &nbsp;<input type="text" class="form-control">
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <a href="#" class="btn btn-primary" id="saveDepartment">OK</a>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
         </div>
      </div>
   </div>
</div>
<!-- edit -->
<div id="frmConfirmEdit" class="modal hide fade" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Edit Department</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="form-inline">
               <label for="">Department</label> &nbsp;<input type="text" class="form-control">
            </div>
         </div>
         <div class="modal-footer">
            <a href="#" class="btn btn-primary" data-dismiss="modal">OK</a>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
         </div>
      </div>
   </div>
</div>
<link href="<?php echo base_url();?>assets/DataTable/DataTables-1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/DataTable//DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/DataTable//DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
   $(document).ready(function() {
     //Transform the HTML table in a fancy datatable
     $('#users').dataTable({
       stateSave: true,
     });
     $("#users tbody").on('click', '.confirm-delete',  function(){
       var id = $(this).parent().data('id');
       $('#frmConfirmDelete').modal('show');
     });
   
   // edit
   $("#users tbody").on('click', '.confirm-edit',  function(){
   var id = $(this).parent().data('id');
   $('#frmConfirmEdit').modal('show');
   });
   
   // create
   $("#crateDepartment").click( function(){
   $('#frmConfirmCreate').modal('show');
   // $('[data_toggle = "tooltip"]').tooltip();
   });
   // create departments by using ajax
   $('#saveDepartment').on('click', function(){
       $.ajax({
           url: "<?php base_url() ?> Departments/create_department",
           type: "POST",
           data: $('#frm-create').serialize(),
           dataType: 'json',
           success: function(data){
             alert('data.department');
           },
           error: function(){
             alert('Error');
           }
       });
   });
   
   
   });
</script>