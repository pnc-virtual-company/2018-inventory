<!-- Edit by @author Dalin LOEM <dalin.loem@student.passerellesnumeriques.org>  -->

<div id="container" class="container">
  <div class="row-fluid">
   <div class="col-12">   
     <div class="row">
       <div class="col-9">
         <h2><?php echo $title;?></h2>
       </div>
       <!-- create new department -->
       <div class="col-3">
        <button type="button" class="btn btn-primary add-department float-right" id="add-department">
          <i class="mdi mdi-plus-circle"></i>&nbsp;Create department
        </button>
      </div>
    </div>
  </div><br>
  <div class="alert alert-info" style="display: none;"> <!--Pop up message create-->
    
  </div>
  <table id="department" cellpadding="0" cellspacing="0" class="table table-striped table-bordered" width="100%">
    <thead>
      <tr>
        <th>ID</th>
        <th>Department</th>
      </tr>
    </thead>
    <tbody id="showdata"> <!--Display department data-->

    </tbody>
  </table>
</div>
</div>
<div class="row-fluid"><div class="col-12">&nbsp;</div></div>

<!-- Pop up model create new department -->
<div id="frmConfirmAdd" class="modal hide fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create new department</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frm_create">
          <div class="form-inline">
            <label for="">Department: </label> &nbsp;<input type="text" class="form-control" name="create_department">
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

<!-- Pop up modal delete department -->
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
        <p>Are you sure that you want to delete this department?</p>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-primary" id="delete-comfirm">Yes</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>

<!-- Pop up modal edit department -->
<div id="frmConfirmEdit" class="modal hide fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit department</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frm_edit">
          <div class="form-inline"> <!--Show data exist--> 

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
    var t = $('#department').DataTable({order:[]});
    showAllDepartments();

// Show all department by ajax 
function showAllDepartments()
{
  $("#showdata").html('<tr><td class="text-center text-info" colspan="10"><i class="mdi mdi-cached mdi-spin mdi-24px"></i>Loading... </td></tr>');
  $.ajax({
    type: 'ajax',
    url: '<?php echo base_url();?>departments/showAllDepartments', // url access to show all departments in controller
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
          n+'&nbsp;<a href="#" class="item-edit" dataid="'+data[i].iddepartment+'"><i class="mdi mdi-pencil" data-toggle="tooltip" title="Edit department"></i></a>'+
          '&nbsp;<a href="#" class="item-delete text-danger" dataid="'+data[i].iddepartment+'"><i class="mdi mdi-delete" data-toggle="tooltip" title="Delete department"></i></a>',
          data[i].department
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
  $('#frmConfirmAdd').keypress(function(e)
  {
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
            $('#delete-comfirm').click(); //Trigger search button click event
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

// Create department with ajax
$("#add-department").click(function()
{
  $('#frmConfirmAdd').modal('show').on('shown.bs.modal', function()
  {
    $('input[name=create_department]').focus();
  });
});

// Save new department button even
$("#create").click(function()
{
  var departmentName = $('input[name=create_material]');
  var result = '';
  if(departmentName.val()=='')
  {
    departmentName.parent().parent().addClass('has-error');
  }else{
    departmentName.parent().parent().removeClass('has-error');
    result +='1';
  }
  if (result=='1') 
  {
    $.ajax({
      url: "<?php echo base_url()?>departments/create",
      type: "POST",
      data: $('#frm_create').serialize(),
      dataType: 'json',
      success: function(data)
      {
        if(data.status)
        {
          $('#frm_create')[0].reset();
          $('#frmConfirmAdd').modal('hide');
          $('.alert-info').html('Department was added successfully').fadeIn().delay(6000).fadeOut('slow');
          showAllDepartments();
        }
      },
      error: function()
      {
        alert("Error ...");
      }
    });
  }
});

// Delete department by ajax
$('#showdata').on('click', '.item-delete', function()
{
  var id = $(this).attr('dataid');
  $('#deleteModal').data('id', id).modal('show');
});

// Comfirm delete department by button delete
$("#delete-comfirm").on('click',function()
{
  var id = $('#deleteModal').data('id');
  $.ajax({
    url: "<?php echo base_url() ?>departments/deleteDepartment", // url access to delete department in controller
    type: "POST",
    data: {iddepartment: id},
    dataType: "json",
    success: function(data)
    {
      $('#deleteModal').modal('hide');
      $('.alert-info').html('Department was deleted successfully').fadeIn().delay(6000).fadeOut('slow');
      showAllDepartments();
    },
    error: function()
    {
      $('#deleteModal').modal('hide');
      alert("Error delete! this field is has relationship with another...");
    }
  });
});

// Update department modal pop up by ajax
$('#showdata').on('click', '.item-edit', function()
{
  var id = $(this).attr('dataid');
  $.ajax({
    type: 'POST',
    data: {iddepartment: id},
    url: '<?php echo base_url();?>departments/showEditDepartment',  // url access show edit department in controller
    async: true,
    dataType: 'json',
    success: function(data)
    {
      $('#frm_edit').html(data);
      $('#frmConfirmEdit').modal('show').on('shown.bs.modal', function()
      {
        $('input[name=update_department]').focus();
      });
    },
    error: function()
    {
      alert('Could not get any data from Database');
    }
  });
});

// Save update department by button update 
$("#update").click(function(){
  var id = $('#frmConfirmEdit').data('id');
  var departmentName = $('input[name=update_department]');
  var result = '';
  if(departmentName.val()=='')
  {
    departmentName.parent().parent().addClass('has-error');
  }else{
    departmentName.parent().parent().removeClass('has-error');
    result +='1';
  }
  if (result=='1') 
  {
    $.ajax({
      url: "<?php echo base_url()?>departments/update",  // url access to update department in controller
      type: "POST",
      data: $('#frm_edit').serialize(),
      dataType: 'json',
      success: function(data){
        if(data.status)
        {
          $('#frm_edit')[0].reset();
          $('#frmConfirmEdit').modal('hide');
          $('.alert-info').html('Department was updated successfully').fadeIn().delay(6000).fadeOut('slow');
          showAllDepartments();
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
