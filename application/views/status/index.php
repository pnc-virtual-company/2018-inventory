<?php
/**
 * This view displays the list of users.
 *
 * @copyright  Copyright (c) 2014-2018 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/skeleton
 * @since      1.0.0
 */
?>

<!-- this is status layout -->
<br>
<div id="container" class="container">
    <div class="row-fluid">
    <div class="col-12">
      <div class="row">
        <div class="col-9">
          <h2><?php echo $title;?></h2>
        </div>
        <div class="col-3">
         <!-- create new status -->
         <button type="button" class="btn btn-primary add-status float-right" id="add-status">
           <i class="mdi mdi-plus-circle"></i>&nbsp;Create status
         </button>
       </div>
     </div>
   </div><br>
   <!-- <?php echo $flashPartialView;?> -->
   <div class="alert alert-info" style="display: none;"></div>
   <table id="status" cellpadding="0" cellspacing="0" class="table table-striped table-bordered" width="100%">
    <thead>
      <tr>
        <th>ID</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody id="showdata">

    </tbody>
  </table>
</div>
</div>
<div class="row-fluid"><div class="col-12">&nbsp;</div></div>

<!-- Modal for create status -->
<div id="frmConfirmAdd" class="modal hide fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create new status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frm_create">
          <div class="form-inline">
            <label for="">Status: </label> &nbsp;<input type="text" class="form-control" name="create_status">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-primary create" id="create">OK</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal for confirmation delete status -->
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
        <p>Are you sure that you want to delete this status?</p>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-primary" id="delete-comfirm">Yes</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal for Edit status -->
<div id="frmConfirmEdit" class="modal hide fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frm_edit">
          <div class="form-inline">

          </div>
        </form>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-primary create" id="update">OK</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<link href="<?php echo base_url();?>assets/DataTable/DataTables-1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/DataTable//DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/DataTable//DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    var t = $('#status').DataTable({order:[]});
    showAllStatus(); //call function for show all the status

  // showAllStatus function get status data to table
  function showAllStatus()
  {
    // spin for waiting the result that get from database by ajax
    $("#showdata").html('<tr><td class="text-center text-info" colspan="10"><i class="mdi mdi-cached mdi-spin mdi-24px"></i>Loading... </td></tr>');
    $.ajax({
      type: 'ajax',
      //access to controller to get data query to show list status
      url: '<?php echo base_url();?>/status/showAllStatus',
      async: true,
      dataType: 'json',
      success: function(data){
        t.clear().draw();
        var i;
        for(i=0; i<data.length; i++){
          t.row.add( [
            data[i].idstatus+
            (data[i].idstatus === '0' ? '' :
            '&nbsp;<a href="#" class="item-edit" dataid="'+data[i].idstatus+'"><i class="mdi mdi-pencil" data-toggle="tooltip" title="Edit status"></i></a>'+
            '&nbsp;<a href="#" class="item-delete text-danger" dataid="'+data[i].idstatus+'"><i class="mdi mdi-delete" data-toggle="tooltip" title="Delete status"></i></a>'),
            data[i].status
            ] ).draw( false );
        }
      }
    });

  }
  Offline.on('up', function() {
    showAllStatus();
  });

  //  Combine btn onclick OK with key Enter when create
  $('#frmConfirmAdd').keypress(function(e)
  {
    if(e.which === 13)
    {//Enter key pressed
      e.preventDefault();
      $('#create').click();//Trigger search button click event
    }
  });

  //  Combine btn onclick OK with key Enter when delete
  $('#deleteModal').keypress(function(e)
  {
    if(e.which === 13)
    {//Enter key pressed
      e.preventDefault();
      $('#delete-comfirm').click();//Trigger search button click event
    }
  });

  //  Combine btn onclick OK with key Enter when update
  $('#frmConfirmEdit').keypress(function(e)
  {
    if(e.which === 13)
    {//Enter key pressed
      e.preventDefault();
      $('#update').click();//Trigger search button click event
    }
  });

  // create_status form with ajax after display in datatable
  $("#add-status").click(function(){
    $('#frmConfirmAdd').modal('show').on('shown.bs.modal', function(){
      $('input[name=create_status]').focus();
    });
  });

  // btn save after create an status
  $("#create").click(function()
  {
    var statusName = $('input[name=create_status]');
    var result = '';
    if(statusName.val()=='')
    {
      statusName.parent().parent().addClass('has-error');
    }else{
      statusName.parent().parent().removeClass('has-error');
      result +='1';
    }
    if (result=='1')
    {
      $.ajax({
        url: "<?php echo base_url()?>status/create", //access to controller to get data from database
        type: "POST",
        data: $('#frm_create').serialize(),
        dataType: 'json',
        async: true
      }).always(function(data) {
        $('#frm_create')[0].reset();
        $('#frmConfirmAdd').modal('hide');
        // alert message to show the user to know
        $('.alert-info').html('Status was added successfully').fadeIn().delay(6000).fadeOut('slow');
        showAllStatus();//call function to show status
      });
    }
  });

  // delete status by ajax
  $('#showdata').on('click', '.item-delete', function(){
    var id = $(this).attr('dataid');
    $('#deleteModal').data('id', id).modal('show');
  });

  // comfirm delete button to make sure user want to delete or not
  $("#delete-comfirm").on('click',function(){
    var id = $('#deleteModal').data('id');
    $.ajax({
      url: "<?php echo base_url() ?>status/deleteStatus",//access to controller to get the delete the data from database
      type: "POST",
      data: {idstatus: id},
      dataType: "json",
      success: function(data)
      {
        $('#deleteModal').modal('hide');
        // alert message to show user with limit the transition time by fadein and fadeout
        $('.alert-info').html('Status was deleted successfully').fadeIn().delay(6000).fadeOut('slow');
        showAllStatus(); //call function to show status
      },
      error: function()
      {
        alert("Error....This status have relationshipe with another field...");
        $('#deleteModal').modal('hide');
      }
    });
  });


  // modal script for update status with ajax
  $('#showdata').on('click', '.item-edit', function(){
    var id = $(this).attr('dataid');
    $.ajax({
      type: 'POST',
      data: {idstatus: id},
      url: '<?php echo base_url();?>/status/showEditStatus', //access to get data edit to database
      async: true,
      dataType: 'json',
      success: function(data)
      {
        $('#frm_edit').html(data);
        $('#frmConfirmEdit').modal('show').on('shown.bs.modal', function(){
          $('input[name=update_status]').focus();
        });
      }
    });
  });

  // save update button
  $("#update").click(function(){
    var id = $('#frmConfirmEdit').data('id');
    var statusName = $('input[name=update_status]');
    var result = '';
    if(statusName.val()=='')
    {
      statusName.parent().parent().addClass('has-error');
    }else{
      statusName.parent().parent().removeClass('has-error');
      result +='1';
    }
    if (result=='1')
    {
      $.ajax({
        url: "<?php echo base_url()?>status/update",
        type: "POST",
        data: $('#frm_edit').serialize(),
        dataType: 'json',
        success: function(data)
        {
          if(data.status){
            $('#frm_edit')[0].reset();
            $('#frmConfirmEdit').modal('hide');
            $('.alert-info').html('Status was updated successfully').fadeIn().delay(6000).fadeOut('slow');
            showAllStatus();
          }
        },
        error: function()
        {
          alert("Error update! this field has relationship with another field...");
          $('#frmConfirmEdit').modal('hide');
        }
      });
    }
  });

});
</script>
