<!-- Edit by @author Sinat Neam <sinat.neam@student.passerellesnumeriques.org>  -->

<div id="container" class="container">
  <div class="row-fluid">
    <div class="col-12">
      <div class="row">
        <div class="col-9">
          <h2>List of models from <span style="color: green; font-size: 30px;">(<?php echo $title; ?>)</span> </h2> 
        </div>
        <div class="col-3">
          <button type="button" class="btn btn-primary float-right" id="create_model">
            <i class="mdi mdi-plus-circle"></i>&nbsp;Create model
          </button>
        </div>
      </div>
    </div><br>
    <div class="alert alert-info" style="display: none;"> <!--Show alert message create, update, delete-->

    </div>
    <table id="models" cellpadding="0" cellspacing="0" class="table table-striped table-bordered" width="100%">
     <thead>
      <tr>
       <th>ID</th>
       <th>Model</th>
     </tr>
   </thead>
   <tbody id="model_row"> <!--Show exist data from controller-->

   </tbody>
 </table>
</div>
</div>
<div class="row-fluid">
 <div class="col-12">&nbsp;</div>
</div>
<div class="container">
  <div class="row-fluid">
    <div class="col-12">
      <a href="<?php echo base_url(); ?>brand" class="btn btn-info float-left">
        <i class="mdi mdi-arrow-left" ></i>&nbsp;Back to brand
      </a>
    </div>
  </div>
</div>

<!-- Pop up modal create model -->
<div id="frmConfirmCreate" class="modal hide fade" tabindex="-1" role="dialog">
 <div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
   <div class="modal-header">
    <h5 class="modal-title">Create new model</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <form action="" id="frm-create">
     <div class="form-inline">
      <label for="">Model: </label> &nbsp;<input type="text" name="model" class="form-control">
      <input type="hidden" value="<?php echo $idbrand; ?>" name="brandid">
    </div>
  </form>
</div>
<div class="modal-footer">
  <a href="#" class="btn btn-primary" id="saveModel">OK</a>
  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
</div>
</div>
</div>
</div>

<!-- Pop up modal delete model -->
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
    <p>Are you sure that you want to delete this model?</p>
  </div>
  <div class="modal-footer">
    <a class="btn btn-primary" data-dismiss="modal" id="delete-comfirm" >Yes</a>
    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
  </div>
</div>
</div>
</div>

<!-- Pop up modal edit model -->
<div id="frmConfirmEdit" class="modal hide fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit model</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frm_edit">
          <div class="form-inline"> <!--Display edit list from controller-->

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

<link href="<?php echo base_url(); ?>assets/DataTable/DataTables-1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/DataTable//DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/DataTable//DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script>
 $(document).ready(function() 
 {
  var t = $('#models').DataTable({order:[]});
  showAllModels();

// Show all model by ajax 
   function showAllModels()
   {
    $("#model_row").html('<tr><td class="text-center text-info" colspan="10"><i class="mdi mdi-cached mdi-spin mdi-24px"></i>Loading... </td></tr>');
    $.ajax({
     type: 'ajax',
     url: '<?php echo base_url(); ?>models/showAllModelsByBrandId/<?php echo $idbrand; ?>', // url access to show all model by brand id in controller
     async: true,
     dataType: 'json',
     success: function(data)
     {
      t.clear().draw();
      var i;
      var n = 1;
      for(i=0; i<data.length; i++)
      {
       t.row.add( [
        n+'&nbsp;<a href="#" class="item-edit" dataid="'+data[i].idmodel+'"><i class="mdi mdi-pencil" data-toggle="tooltip" title="Edit model"></i></a>'+
        '<a href="#" class="item-delete text-danger" dataid="'+data[i].idmodel+'"><i class="mdi mdi-delete" data-toggle="tooltip" title="Delete model"></i></a>',
        data[i].model
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
    $('#frmConfirmCreate').keypress(function(e)
    {
           if(e.which === 13) //Enter key pressed
           {
            e.preventDefault();
              $('#saveModel').click();//Trigger search button click event
            }
          });

      //  Combine btn onclick OK with key Enter when delete  
      $('#frmConfirmDelete').keypress(function(e)
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

       // Create model by ajax
       $("#create_model").click( function()
       {
         $('#frmConfirmCreate').modal('show').on('shown.bs.modal', function()
         {
          $('input[name=model]').focus();
        });
       });

      // Create model by using ajax
         $('#saveModel').on('click', function()
         {
          var model = $('input[name=model]');
          var result = '';
          if(model.val()=='')
          {
            model.parent().parent().addClass('has-error');
          }else{
            model.parent().parent().removeClass('has-error');
            result +='1';
          }
          if(result=='1')
          {
           $.ajax({
             url: "<?php echo base_url(); ?>models/create_model",  // url access to create model in controller
             type: "POST",
             data: $('#frm-create').serialize(),
             dataType: 'json',
             success: function(data)
             {
               if(data.status)
               {
                $('#frm-create')[0].reset();
                $('#frmConfirmCreate').modal('hide');
                $('.alert-info').html('Model was created successfully').fadeIn().delay(6000).fadeOut('slow');
                showAllModels();
              }
            },
            error: function()
            {
             alert('Error can not create...');
           }
         });
         }
       });

        // Delte model by ajax
        $('#model_row').on('click', '.item-delete', function()
        {
         var id = $(this).attr('dataid');
         $('#frmConfirmDelete').data('id', id).modal('show');
       });

         // Comfirm delete by button even
         $("#delete-comfirm").on('click',function()
         {
           var id = $('#frmConfirmDelete').data('id');     
           $.ajax({
             url: "<?php echo base_url(); ?>models/deleteModel", // url access to delete model in controller
             type: "POST",
             data: {idmodel: id},
             dataType: "json",
             success: function(data)
             {
                 $('#frmConfirmDelete').modal('hide');
                 $('.alert-info').html('Model was deleted successfully').fadeIn().delay(6000).fadeOut('slow');
                 showAllModels();
               },
               error: function()
               {
                 alert("Error delete!! this model have relationship with another field...");
               }
             });
         });

       // Update model modal pop up by ajax
       $('#model_row').on('click', '.item-edit', function()
       {
         var id = $(this).attr('dataid');
         $.ajax({
           type: 'POST',
           data: {idmodel: id},
           url: '<?php echo base_url(); ?>/models/showEditModel/<?php echo $idbrand; ?>', // url access to show edit model in controller
           async: true,
           dataType: 'json',
           success: function(data)
           {
             $('#frm_edit').html(data);
             $('#frmConfirmEdit').modal('show').on('shown.bs.modal', function()
             {
              $('input[name=update_model]').focus();
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
          var model = $('input[name=update_model]');
          var result = '';
          if(model.val()=='')
          {
            model.parent().parent().addClass('has-error');
          }else{
            model.parent().parent().removeClass('has-error');
            result +='1';
          }
          if(result=='1')
          {
            $.ajax({
             url: "<?php echo base_url(); ?>models/update", // url access to update model in controller
             type: "POST",
             data: $('#frm_edit').serialize(),
             dataType: 'json',
             success: function(data)
             {
               if(data.status)
               {
                 $('#frm_edit')[0].reset();
                 $('#frmConfirmEdit').modal('hide');
                 $('.alert-info').html('Model was updated successfully').fadeIn().delay(6000).fadeOut('slow');
                 showAllModels();
               }
             },
             error: function(){
               alert("Error edit this model have relationship with another field...");
               $('#frmConfirmEdit').modal('hide');
             }
           });
          }
        });

       });

     </script>
