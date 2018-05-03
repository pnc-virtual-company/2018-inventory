<?php
/**
 * This view displays the list of users.
 * @copyright  Copyright (c) 2014-2018 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/skeleton
 * @since      1.0.0
 */
?>
<!-- this is location layout -->
<div id="container" class="container">
    <div class="row-fluid">
        <div class="col-12">

      <h2><?php echo $title;?></h2>

      <?php echo $flashPartialView;?>

      <table id="location" cellpadding="0" cellspacing="0" class="table table-striped table-bordered" width="100%">
        <thead>
          <tr>
            <th class="text-right">ID</th>
            <th>location</th>
          </tr>
        </thead>
        <tbody>

          <?php 
            $id = 1;
             foreach ($locat as $location):?>
            <tr>
              <td data-order="<?php echo $location->idlocation; ?>" data-id="<?php echo $location->idlocation;?>"  class="text-right">
                <!-- <a href="<?php echo base_url();?>users/edit/<?php echo $user['id'] ?>" title="Edit user"><i class="mdi mdi-pencil"></i></a> -->
                <a href="#" class="confirm-edit" title="edit owner"><i class="mdi mdi-pencil"></i></a>
                <a href="#" class="confirm-delete" title="Delete owner"><i class="mdi mdi-delete"></i></a>
                <?php echo $id++ ?>&nbsp;
              </td>
              <td> <?php echo $location->location; ?></td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="row-fluid"><div class="col-12">&nbsp;</div></div>
  
  <!-- create new location -->
  <div class="container">
    <div class="row-fluid">
      <div class="col-12">
       <button type="button" class="btn btn-primary add-location" >
         <i class="mdi mdi-plus-circle"></i>&nbsp;Create location
       </button>
     </div>
   </div>
 </div>

 <!-- create -->
 <div id="frmConfirmAdd" class="modal hide fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create location</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="frm_create">
        <div class="modal-body">
          <div class="form-inline">
            <label for="">location: </label> &nbsp;<input type="text" class="form-control" name="create_location">
          </div>
        </div>
      </form>
      <div class="modal-footer">
        <a href="#" class="btn btn-primary create" type="submit">OK</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<!-- delete -->
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
        <p>Are you sure that you want to delete this location?</p>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-primary" data-dismiss="modal">Yes</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
<!-- edit -->
<div id="frmConfirmEdit" class="modal hide fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit location</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-inline">
          <label for="">location</label> &nbsp;<input type="text" class="form-control">
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
    $('#location').dataTable({
      stateSave: true,
    });
    $(".add-location").click(function(){
      $('#frmConfirmAdd').modal('show');
    });
    $(".create").click(function(){
      $.ajax({
        url: "<?php echo base_url() ?>locations/create",
        type: "POST",
        data: $('#frm_create').serialize(),
        dataType: 'json',
        success: function(data){
          alert("working...");
        },
        error: function(){
          alert("Error ...");
        }
      });
    });
    // $("#location tbody").on('click', '.confirm-delete',  function(){
    //   var id = $(this).parent().data('id');
    //             $('#frmConfirmDelete').modal('show');
    //           });
// edit
// $("#location tbody").on('click', '.confirm-edit',  function(){
//   var id = $(this).parent().data('id');
//   var link = "<?php echo base_url();?>users/delete/" + id;
//   $("#lnkDeleteUser").attr('href', link);
//   $('#frmConfirmEdit').modal('show');
// });
});
</script>
