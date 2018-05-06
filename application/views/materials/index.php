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
<div id="container" class="container">
  <div class="row-fluid">
    <div class="col-12">

      <h2><?php echo $title;?></h2>
      <!-- <?php echo $flashPartialView;?> -->
      <div class="alert alert-success" style="display: none;"></div>
      <table id="material" cellpadding="0" cellspacing="0" class="table table-striped table-bordered" width="100%">
        <thead>
          <tr>
            <th class="text-right">ID</th>
            <th>Materials</th>
          </tr>
        </thead>
        <tbody id="showdata">


        </tbody>
      </table>
    </div>
  </div>
  <div class="row-fluid"><div class="col-12">&nbsp;</div></div>
  <!-- create new material -->
  <div class="container">
    <div class="row-fluid">
      <div class="col-12">
       <button type="button" class="btn btn-primary add-material" id="add-material">
         <i class="mdi mdi-plus-circle"></i>&nbsp;Create material
       </button>
     </div>
   </div>
 </div>

 <!-- create -->
 <div id="frmConfirmAdd" class="modal hide fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create material</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frm_create">
          <div class="form-inline">
            <label for="">material: </label> &nbsp;<input type="text" class="form-control" name="create_material">
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
        <p>Are you sure that you want to delete this material?</p>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-primary" id="delete-comfirm">Yes</a>
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
        <h5 class="modal-title">Edit material</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="frm_edit">

      </form>
      <div class="modal-footer">
        <a href="#" class="btn btn-primary " id="update">OK</a>
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
    var t = $('#material').DataTable();
    showAllMaterial();

// showAllMaterial function get material data to table 
function showAllMaterial()
{
  $.ajax({
    type: 'ajax',
    url: '<?php echo base_url();?>materials/showAllmaterial',
    async: true,
    dataType: 'json',
    success: function(data){
      t.clear().draw();
      var n =1;
      var i;
      for(i=0; i<data.length; i++){
        t.row.add( [
          '<a href="#" class="item-edit" dataid="'+data[i].idmaterial+'"><i class="mdi mdi-pencil"></i></a>'+
          '<a href="#" class="item-delete" dataid="'+data[i].idmaterial+'"><i class="mdi mdi-delete"></i></a>'+n,
          data[i].material
          ] ).draw( false );
        n++;
      }
    },
    error: function(){
      alert('Could not get Data from Database');
    }
  });

}

// create_material with ajax
$("#add-material").click(function(){
  $('#frmConfirmAdd').modal('show');
});

// save new material button even
$("#create").click(function(){
  var materialName = $('input[name=create_material]');
  var result = '';
  if(materialName.val()==''){
    materialName.parent().parent().addClass('has-error');
  }else{
    materialName.parent().parent().removeClass('has-error');
    result +='1';
  }
  if (result=='1') {
    $.ajax({
      url: "<?php echo base_url()?>materials/create",
      type: "POST",
      data: $('#frm_create').serialize(),
      dataType: 'json',
      success: function(data){
        if(data.status){
          $('#frm_create')[0].reset();
          $('#frmConfirmAdd').modal('hide');
          $('.alert-success').html('material add successfully').fadeIn().delay(4000).fadeOut('slow');
          showAllMaterial();
        }
      },
      error: function(){
        alert("Error ...");
      }
    });
    // alert(materialName.val());
  }
});
// delete material by ajax
$('#showdata').on('click', '.item-delete', function(){
  var id = $(this).attr('dataid');
  $('#deleteModal').data('id', id).modal('show');
});

// comfirm delete button
$("#delete-comfirm").on('click',function(){
  var id = $('#deleteModal').data('id');
  $.ajax({
    url: "<?php echo base_url() ?>materials/deleteMaterial",
    type: "POST",
    data: {idmaterial: id},
    dataType: "json",
    success: function(data){
      $('#deleteModal').modal('hide');
      $('.alert-success').html('Material delete successfully').fadeIn().delay(4000).fadeOut('slow');
      showAllMaterial();
    },
    error: function(){
      $('#deleteModal').modal('hide');
      alert("Error delete! this material is has relationship with another...");

    }
  });
});


// update material modal pop up by ajax
$('#showdata').on('click', '.item-edit', function(){
  var id = $(this).attr('dataid');
  $.ajax({
    type: 'POST',
    data: {idmaterial: id},
    url: '<?php echo base_url();?>materials/showEditMaterial',
    async: true,
    dataType: 'json',
    success: function(data){
      $('#frm_edit').html(data);
      $('#frmConfirmEdit').modal('show');
    },
    error: function(){
      alert('Could not get any data from Database');
    }
  });
});

// save update button 
$("#update").click(function(){
  var id = $('#frmConfirmEdit').data('id');
  var materialName = $('input[name=update_material]');
  var result = '';
  if(materialName.val()==''){
    materialName.parent().parent().addClass('has-error');
  }else{
    materialName.parent().parent().removeClass('has-error');
    result +='1';
  }
  if (result=='1') {
    $.ajax({
      url: "<?php echo base_url()?>materials/update",
      type: "POST",
      data: $('#frm_edit').serialize(),
      dataType: 'json',
      success: function(data){
        if(data.status){
          $('#frm_edit')[0].reset();
          $('#frmConfirmEdit').modal('hide');
          $('.alert-success').html('material update successfully').fadeIn().delay(4000).fadeOut('slow');
          showAllMaterial();
        }
      },
      error: function(){
        $('#frmConfirmEdit').modal('hide');
        alert("Error update! This field has relationship with another ...");
      }
    });
  }
});

});
</script>