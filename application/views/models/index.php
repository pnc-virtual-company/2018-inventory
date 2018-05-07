<div class="container">
  <h2><?php echo $title; ?></h2>
</div>
<br>
<br>
<div class="container">
  <div class="row-fluid">
   <div class="col-md-12 col-sm-4">
     <table id="location" cellpadding="0" cellspacing="0" class="table table-striped table-bordered" width="100%">
       <thead>
         <tr>
           <th class="text-right">Model ID</th>
           <th>Model Name</th>
         </tr>
       </thead>
       <tbody>
         <?php foreach ($users as $user):?>
          <tr>
            <td data-order="<?php echo $user['id']; ?>" data-id="<?php echo $user['id'];?>"  class="text-right">
              <a href="#" class="Edit-model" data-toggle="modal"
              data-target="#myModalEdit" title="Edit model"><i class="mdi mdi-pencil"></i></a>
              <a href="#" class="confirm-delete" data-toggle="modal"
              data-target="#myModaldelete" title="Delete model"><i class="mdi mdi-delete"></i></a>
              <?php echo $user['id'] ?>&nbsp;
            </td>
            <td>Laptop models 3</td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            <i class="mdi mdi-plus-circle"></i>&nbsp;Create model
          </button>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4 text-right">
          <button type="button" class="btn btn-danger">
            <a class="text-white" href="<?php echo base_url() ?>brand"><i class="mdi mdi-arrow-left-thick"></i>&nbsp;Back to brands</a>
          </button>
        </div>
      </div> 
    </div> 
  </div>
</div>
<br>
</div>
<!-- Modal Create new model-->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4>Create new model</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-2">
              <label class="control-label text-center" for="location">Model</label>
            </div>
            <div class="col-md-10 ">
              <div class="input-group">
               <input type="text" name="location" id="location" required />
             </div>
           </div>
         </div>
       </div>
     </div>
     <div class="modal-footer">
      <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
    </div>
  </div>
</div>
</div>
<!-- Modal delete model-->
<div class="modal fade" id="myModaldelete" role="dialog">
  <div class="modal-dialog modal-dialog-centered">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4>Confirm Model</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure that you want to delete this Model?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Modal Edit model -->
<div class="modal fade" id="myModalEdit" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4>Edit Model</h4>
      </div>
      <div class="modal-body">
       <div class="form-group">
        <div class="row">
          <div class="col-md-2">
            <label class="control-label text-center" for="location">model</label>
          </div>
          <div class="col-md-10 ">
            <div class="input-group input-control">
             <input type="text" name="location" id="location" required />
           </div>
         </div>
       </div>
     </div>
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
  </div>
</div>
</div>
</div>
<!-- javaScript -->
<link href="<?php echo base_url();?>assets/DataTable/DataTables-1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/DataTable//DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/DataTable//DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    //Transform the HTML table in a fancy datatable
    $('#location').dataTable({
      stateSave: true,
    });
    $("#users tbody").on('click', '.confirm-delete',  function(){
      var id = $(this).parent().data('id');
      var link = "<?php echo base_url();?>location/delete/" + id;
      $("#lnkDeleteUser").attr('href', link);
      $('#frmConfirmDelete').modal('show');
    });

    $("#users tbody").on('click', '.reset-password',  function(){
      var id = $(this).parent().data('id');
      var link = "<?php echo base_url();?>users/reset/" + id;
      $("#formResetPwd").prop("action", link);
      $('#frmResetPwd').modal('show');
    });
  });
</script>

