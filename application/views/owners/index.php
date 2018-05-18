<?php
/**
 * This view displays the list of users.
 * @copyright  Copyright (c) 2014-2018 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/skeleton
 * @since      1.0.0
 */
?>

<!-- this is owner layout -->
<br>
<div id="container" class="container">
	<div class="row-fluid">
    <div class="col-12">
      <div class="row">
        <div class="col-9">
          <h2><?php echo $title;?></h2>
        </div>
        <div class="col-3">
         <!-- create new department -->
         <button type="button" class="btn btn-primary add-owner float-right" id="add-owner">
           <i class="mdi mdi-plus-circle"></i>&nbsp;Create owner
         </button>
       </div>
     </div>
   </div><br>
   <!-- <?php echo $flashPartialView;?> -->
   <div class="alert alert-info" style="display: none;"></div>
   <table id="owners" cellpadding="0" cellspacing="0" class="table table-striped table-bordered" width="100%">
    <thead>
      <tr>
        <th>ID</th>
        <th>Owner</th>
      </tr>
    </thead>
    <tbody id="showdata">

    </tbody>
  </table>
</div>
</div>
<div class="row-fluid"><div class="col-12">&nbsp;</div></div>

<!-- create -->
<div id="frmConfirmAdd" class="modal hide fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create new owner</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frm_create">
          <div class="form-inline">
            <label for="">Owner: </label> &nbsp;<input type="text" class="form-control" name="create_owner">
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
<!-- delete -->
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
        <p>Are you sure that you want to delete this owner?</p>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-primary" id="delete-comfirm">Yes</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
<!-- Edite -->
<div id="frmConfirmEdit" class="modal hide fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit owner</h5>
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
    var t = $('#owners').DataTable({order:[]});
    showAllOwner();

// showAllOwner function get owner data to table 
function showAllOwner()
{
  $("#showdata").html('<tr><td class="text-center text-info" colspan="10"><i class="mdi mdi-cached mdi-spin mdi-24px"></i>Loading... </td></tr>');
  $.ajax({
    type: 'ajax',
    url: '<?php echo base_url();?>/owner/showAllOwner',
    async: true,
    dataType: 'json',
    success: function(data){
      t.clear().draw();
      var n = 1;
      var i;
      for(i=0; i<data.length; i++){
        t.row.add( [
          n+'&nbsp;<a href="#" class="item-edit" dataid="'+data[i].idowner+'"><i class="mdi mdi-pencil" data-toggle="tooltip" title="Edit owner"></i></a>'+
          '&nbsp;<a href="#" class="item-delete text-danger" dataid="'+data[i].idowner+'"><i class="mdi mdi-delete" data-toggle="tooltip" title="Delete owner"></i></a>',
          data[i].owner
          ] ).draw( false );
        n++;
      }
    },
    error: function(){
      alert('Could not get Data from Database');
    }
  });

}

// create_owner with ajax
$("#add-owner").click(function(){
  $('#frmConfirmAdd').modal('show').on('shown.bs.modal', function(){
    $('input[name=create_owner]').focus();
  });
});
// save new owner button even
$("#create").click(function(){
  var ownerName = $('input[name=create_owner]');
  var result = '';
  if(ownerName.val()==''){
    ownerName.parent().parent().addClass('has-error');
  }else{
    ownerName.parent().parent().removeClass('has-error');
    result +='1';
  }
  if (result=='1') {
    $.ajax({
      url: "<?php echo base_url()?>owner/create",
      type: "POST",
      data: $('#frm_create').serialize(),
      dataType: 'json',
      success: function(data){
        if(data.status){
          $('#frm_create')[0].reset();
          $('#frmConfirmAdd').modal('hide');
          $('.alert-info').html('Owner was added successfully').fadeIn().delay(6000).fadeOut('slow');
          showAllOwner();
        }
      },
      error: function(){
        alert("Error ...");
      }
    });
  }
  
});

// delete owner by ajax
$('#showdata').on('click', '.item-delete', function(){
  var id = $(this).attr('dataid');
  $('#deleteModal').data('id', id).modal('show');
});
// comfirm delete button
$("#delete-comfirm").on('click',function(){
  var id = $('#deleteModal').data('id');
  $.ajax({
    url: "<?php echo base_url() ?>owner/deleteOwner",
    type: "POST",
    data: {idowner: id},
    dataType: "json",
    success: function(data){
      $('#deleteModal').modal('hide');
      $('.alert-info').html('Owner was deleted successfully').fadeIn().delay(6000).fadeOut('slow');
      showAllOwner();
    },
    error: function(){
      alert("Error....This owner have relationshipe with another field...");
      $('#deleteModal').modal('hide');
    }
  });
});


// update owner modal pop up by ajax
$('#showdata').on('click', '.item-edit', function(){
  var id = $(this).attr('dataid');
  $.ajax({
    type: 'POST',
    data: {idowner: id},
    url: '<?php echo base_url();?>/owner/showEditOwner',
    async: true,
    dataType: 'json',
    success: function(data){
      $('#frm_edit').html(data);
      $('#frmConfirmEdit').modal('show').on('shown.bs.modal', function(){
        $('input[name=update_owner]').focus();
      });
    },
    error: function(){
      alert('Could not get any data from Database');
    }
  });
});
// save update button 
$("#update").click(function(){
  var id = $('#frmConfirmEdit').data('id');
  var ownerName = $('input[name=update_owner]');
  var result = '';
  if(ownerName.val()==''){
    ownerName.parent().parent().addClass('has-error');
  }else{
    ownerName.parent().parent().removeClass('has-error');
    result +='1';
  }
  if (result=='1') {
    $.ajax({
      url: "<?php echo base_url()?>owner/update",
      type: "POST",
      data: $('#frm_edit').serialize(),
      dataType: 'json',
      success: function(data){
        if(data.status){
          $('#frm_edit')[0].reset();
          $('#frmConfirmEdit').modal('hide');
          $('.alert-info').html('Owner was updated successfully').fadeIn().delay(6000).fadeOut('slow');
          showAllOwner();
        }
      },
      error: function(){
        alert("Error update! this field has relationship with another field...");
        $('#frmConfirmEdit').modal('hide');
      }
    });
  }
});

});
</script>
