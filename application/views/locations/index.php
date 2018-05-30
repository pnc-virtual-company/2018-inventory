<?php
// Edit by @author Sinat NEAM <sinat.neam@student.passerellesnumeriques.org> 
?>

<div id="container" class="container">
  <div class="row-fluid">
    <div class="col-12">
      <div class="row">
        <div class="col-9">
          <h2><?php
echo $title;
?></h2>
        </div>
        <!-- Create new location -->
        <div class="col-3">
         <button type="button" class="btn btn-primary add-location float-right" id="add-location">
           <i class="mdi mdi-plus-circle"></i>&nbsp;Create location
         </button>
       </div>
     </div>
   </div><br>
   <div class="alert alert-info" style="display: none;"> <!--Show exist data-->
     
   </div>
   <table id="location" cellpadding="0" cellspacing="0" class="table table-striped table-bordered" width="100%">
    <thead>
      <tr>
        <th>ID</th>
        <th>Location</th>
      </tr>
    </thead>
    <tbody id="showdata"> <!--Display list location-->

    </tbody>
  </table>
</div>
</div>
<div class="row-fluid"><div class="col-12">&nbsp;</div></div>

<!--  Pop up modal create location -->
<div id="frmConfirmAdd" class="modal hide fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create new location</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frm_create">
          <div class="form-inline">
            <label for="">Location: </label> &nbsp;<input type="text" class="form-control" name="create_location">
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

<!-- Pop up modal delete location -->
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
        <p>Are you sure that you want to delete this location?</p>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-primary" id="delete-comfirm">Yes</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>

<!-- Pop up edit location -->
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
        <form id="frm_edit"> <!--Show exist data from controller-->

            </form>
          </div>
          <div class="modal-footer">
            <a href="#" class="btn btn-primary create" id="update">OK</a>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
    
    <link href="<?php echo base_url(); ?>assets/DataTable/DataTables-1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/DataTable//DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/DataTable//DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
      $(document).ready(function()
      {
        var t = $('#location').DataTable({order:[]});
        showAlllocat();

// Show all location by ajax
function showAlllocat()
{
  $("#showdata").html('<tr><td class="text-center text-info" colspan="10"><i class="mdi mdi-cached mdi-spin mdi-24px"></i>Loading... </td></tr>');
  $.ajax({
    type: 'ajax',
    url: '<?php echo base_url(); ?>/locations/showAlllocat', // url access to show all location in controller
    async: true,
    dataType: 'json',
    success: function(data)
    {
      t.clear().draw();
      var n = 1;
      var i;
      for(i=0; i<data.length; i++)
      {
        t.row.add( [
          n+'&nbsp;<a href="#" class="item-edit" dataid="'+data[i].idlocation+'"><i class="mdi mdi-pencil" data-toggle="tooltip" title="Edit location"></i></a>'+
          '&nbsp;<a href="#" class="item-delete text-danger" dataid="'+data[i].idlocation+'"><i class="mdi mdi-delete" data-toggle="tooltip" title="Delete location"></i></a>',
          data[i].location
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

// create_location by ajax
$("#add-location").click(function()
{
  $('#frmConfirmAdd').modal('show').on('shown.bs.modal', function()
  {
    $('input[name=create_location]').focus();
  });
});

// Save new location by button even
$("#create").click(function()
{
  var locationName = $('input[name=create_location]');
  var result = '';
  if(locationName.val()=='')
  {
    locationName.parent().parent().addClass('has-error');
  }else{
    locationName.parent().parent().removeClass('has-error');
    result +='1';
  }
  if (result=='1') 
  {
    $.ajax({
      url: "<?php echo base_url(); ?>locations/create", // url access to create location in controller
      type: "POST",
      data: $('#frm_create').serialize(),
      dataType: 'json',
      success: function(data)
      {
        if(data.status)
        {
          $('#frm_create')[0].reset();
          $('#frmConfirmAdd').modal('hide');
          $('.alert-info').html('Location was added successfully').fadeIn().delay(6000).fadeOut('slow');
          showAlllocat();
        }
      },
      error: function()
      {
        alert("Error ...");
      }
    });
  }
});

// Delete locatiom by ajax
$('#showdata').on('click', '.item-delete', function()
{
  var id = $(this).attr('dataid');
  $('#deleteModal').data('id', id).modal('show');
});

// Confirm delete by button even
$("#delete-comfirm").on('click',function()
{
  var id = $('#deleteModal').data('id');
  $.ajax({
    url: "<?php echo base_url(); ?>locations/deletelocat",  // url access to delete location in controller
    type: "POST",
    data: {idlocation: id},
    dataType: "json",
    success: function(data)
    {
      $('#deleteModal').modal('hide');
      $('.alert-info').html('Location was Deleted Successfully').fadeIn().delay(6000).fadeOut('slow');
      showAlllocat();
    },
    error: function()
    {
      alert("Error....This location have relationshipe with another field...");
      $('#deleteModal').modal('hide');
    }
  });
});

// Update location modal pop up by ajax
$('#showdata').on('click', '.item-edit', function()
{
  var id = $(this).attr('dataid');
  $.ajax({
    type: 'POST',
    data: {idlocation: id},
    url: '<?php echo base_url(); ?>/locations/showEditlocat',  //url access to show edit location in controller
    async: true,
    dataType: 'json',
    success: function(data)
    {
      $('#frm_edit').html(data);
      $('#frmConfirmEdit').modal('show').on('shown.bs.modal', function()
      {
        $('input[name=update_location]').focus();
      });
    },
    error: function()
    {
      alert('Could not get any data from Database');
    }
  });
});

// Save  update by button even
$("#update").click(function()
{
  var id = $('#frmConfirmEdit').data('id');
  var locationName = $('input[name=update_location]');
  var result = '';
  if(locationName.val()=='')
  {
    locationName.parent().parent().addClass('has-error');
  }else{
    locationName.parent().parent().removeClass('has-error');
    result +='1';
  }
  if (result=='1') 
  {
    $.ajax({
      url: "<?php echo base_url();?>locations/update",
      type: "POST",
      data: $('#frm_edit').serialize(),
      dataType: 'json',
      success: function(data)
      {
        if(data.status){
          $('#frm_edit')[0].reset();
          $('#frmConfirmEdit').modal('hide');
          $('.alert-info').html('Location was Updated Successfully').fadeIn().delay(6000).fadeOut('slow');
          showAlllocat();
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