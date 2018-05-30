<!-- edit by @author Bunla Rath <bunla.rath@student.passerellesnumeriques.org> -->

<div id="container" class="container">
  <div class="row-fluid">
   <div class="col-12">
     <div class="row">
      <div class="col-9">
        <h2><?php echo $title;?></h2>
      </div>
      <!-- create new material -->
      <div class="col-3">
        <button type="button" class="btn btn-primary add-material float-right" id="add-material">
          <i class="mdi mdi-plus-circle"></i>&nbsp;Create material
        </button>
      </div>
    </div>
  </div><br>
  <div class="alert alert-info" style="display: none;"> <!--Pop up alert massage-->

  </div>
  <table id="material" cellpadding="0" cellspacing="0" class="table table-striped table-bordered" width="100%">
    <thead>
      <tr>
        <th>ID</th>
        <th>Material</th>
      </tr>
    </thead>
    <tbody id="showdata"> <!--Display data from material controller-->

    </tbody>
  </table>
</div>
</div>
<div class="row-fluid"><div class="col-12">&nbsp;</div></div>

<!-- Pop up modal create new material -->
<div id="frmConfirmAdd" class="modal hide fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create new material</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frm_create">
          <div class="form-inline">
            <label for="">Material: </label> &nbsp;<input type="text" class="form-control" name="create_material">
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

<!-- Pop up modal delete material -->
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
<!-- Pop up modal edit material -->
<div id="frmConfirmEdit" class="modal hide fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit material</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frm_edit">
          <div class="form-inline"> <!--Show exist data-->

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
  $(document).ready(function()
  {
    var t = $('#material').DataTable({order:[]});
    showAllMaterial();

// Show all material by ajax 
function showAllMaterial()
{
  $("#showdata").html('<tr><td class="text-center text-info" colspan="10"><i class="mdi mdi-cached mdi-spin mdi-24px"></i>Loading... </td></tr>');
  $.ajax({
    type: 'ajax',
    url: '<?php echo base_url();?>materials/showAllmaterial', //url access to showAllmaterial in controller
    async: true,
    dataType: 'json',
    success: function(data)
    {
      t.clear().draw();
      var n =1;
      var i;
      for(i=0; i<data.length; i++)
      {
        t.row.add( [
          n+'&nbsp;<a href="#" class="item-edit" dataid="'+data[i].idmaterial+'"><i class="mdi mdi-pencil" data-toggle="tooltip" title="Edit material"></i></a>'+
          '&nbsp;<a href="#" class="item-delete text-danger" dataid="'+data[i].idmaterial+'"><i class="mdi mdi-delete" data-toggle="tooltip" title="Delete material"></i></a>',
          data[i].material
          ] ).draw( false );
        n++;
      }
    },
    error: function()
    {
      alert('Could not get Data from Database');
    }
  });
}

  //  Combine btn onclick OK with key Enter when create
  $('#frmConfirmAdd').keypress(function(e){
         if(e.which === 13) //Enter key pressed
         {
          e.preventDefault();
            $('#create').click();//Trigger search button click event
          }
        });

    //  Combine btn onclick OK with key Enter when delete  
    $('#deleteModal').keypress(function(e)
    {
         if(e.which === 13) //Enter key pressed
         {
          e.preventDefault();
            $('#delete-comfirm').click();//Trigger search button click event
          }
        });

     //  Combine btn onclick OK with key Enter when update  
     $('#frmConfirmEdit').keypress(function(e)
     {
         if(e.which === 13) //Enter key pressed
         {
          e.preventDefault();
            $('#update').click();//Trigger search button click event
          }
        });

// create_material with ajax
$("#add-material").click(function()
{
  $('#frmConfirmAdd').modal('show').on('shown.bs.modal', function()
  {
    $('input[name=create_material]').focus();
  });
});

// save new material button even
$("#create").click(function()
{
  var materialName = $('input[name=create_material]');
  var result = '';
  if(materialName.val()=='')
  {
    materialName.parent().parent().addClass('has-error');
  }else{
    materialName.parent().parent().removeClass('has-error');
    result +='1';
  }
  if (result=='1') 
  {
    $.ajax({
      url: "<?php echo base_url()?>materials/create", // url access to create material in controller
      type: "POST",
      data: $('#frm_create').serialize(),
      dataType: 'json',
      success: function(data)
      {
        if(data.status)
        {
          $('#frm_create')[0].reset();
          $('#frmConfirmAdd').modal('hide');
          $('.alert-info').html('Material was added successfully').fadeIn().delay(6000).fadeOut('slow');
          showAllMaterial();
        }
      },
      error: function()
      {
        alert("Error ...");
      }
    });
  }
});

// delete material by ajax
$('#showdata').on('click', '.item-delete', function()
{
  var id = $(this).attr('dataid');
  $('#deleteModal').data('id', id).modal('show');
});

// comfirm delete button
$("#delete-comfirm").on('click',function()
{
  var id = $('#deleteModal').data('id');
  $.ajax({
    url: "<?php echo base_url() ?>materials/deleteMaterial", // url access to deleteMaterial in controller
    type: "POST",
    data: {idmaterial: id},
    dataType: "json",
    success: function(data){
      $('#deleteModal').modal('hide');
      $('.alert-info').html('Material was deleted successfully').fadeIn().delay(6000).fadeOut('slow');
      showAllMaterial();
    },
    error: function()
    {
      $('#deleteModal').modal('hide');
      alert("Error delete! this material is has relationship with another...");
    }
  });
});

// update material modal pop up by ajax
$('#showdata').on('click', '.item-edit', function()
{
  var id = $(this).attr('dataid');
  $.ajax({
    type: 'POST',
    data: {idmaterial: id},
    url: '<?php echo base_url();?>materials/showEditMaterial', // url access to showEditMaterial in controller
    async: true,
    dataType: 'json',
    success: function(data)
    {
      $('#frm_edit').html(data);
      $('#frmConfirmEdit').modal('show').on('shown.bs.modal', function()
      {
        $('input[name=update_material]').focus();
      });
    },
    error: function()
    {
      alert('Could not get any data from Database');
    }
  });
});

// save update button 
$("#update").click(function()
{
  var id = $('#frmConfirmEdit').data('id');
  var materialName = $('input[name=update_material]');
  var result = '';
  if(materialName.val()=='')
  {
    materialName.parent().parent().addClass('has-error');
  }else{
    materialName.parent().parent().removeClass('has-error');
    result +='1';
  }
  if (result=='1') 
  {
    $.ajax({
      url: "<?php echo base_url()?>materials/update",  // url access to update material in controller
      type: "POST",
      data: $('#frm_edit').serialize(),
      dataType: 'json',
      success: function(data)
      {
        if(data.status)
        {
          $('#frm_edit')[0].reset();
          $('#frmConfirmEdit').modal('hide');
          $('.alert-info').html('Material was updated successfully').fadeIn().delay(6000).fadeOut('slow');
          showAllMaterial();
        }
      },
      error: function()
      {
        $('#frmConfirmEdit').modal('hide');
        alert("Error update! This field has relationship with another ...");
      }
    });
  }
});
});

</script>