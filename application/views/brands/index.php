<!-- Edit by @author Dalin LOEM <dalin.loem@student.passerellesnumeriques.org>  -->

<div id="container" class="container">
  <div class="row-fluid">
    <div class="col-12">
      <div class="row">
        <div class="col-9">
          <h2><?php echo $title; ?></h2>
        </div>
        <div class="col-3">
          <button type="button" class="btn btn-primary float-right" id="createBrand">
            <i class="mdi mdi-plus-circle"></i>&nbsp;Create brand
          </button>
        </div>
      </div>
    </div><br>
    <?php echo $flashPartialView; ?>
   <div class="alert alert-info" style="display: none;"> <!--Show exist data-->

    </div>
    <table id="brand" cellpadding="0" cellspacing="0" class="table table-striped table-bordered" width="100%">
     <thead>
      <tr>
       <th>ID</th>
       <th>Brands</th>
       <th>Models</th>
     </tr>
   </thead>
   <tbody id="brand_row"> <!--Display data all brand from controoler-->

   </tbody>
 </table>
</div>
</div>
<div class="row-fluid">
 <div class="col-12">&nbsp;</div>
</div>

<!-- Pop up modal create brand -->
<div id="frmConfirmCreate" class="modal hide fade" tabindex="-1" role="dialog">
 <div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
   <div class="modal-header">
    <h5 class="modal-title">Create new brand</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <form action="" id="frm-create">
     <div class="form-inline">
      <label for="">Brand: </label> &nbsp;<input type="text" name="brand" class="form-control">
    </div>
  </form>
</div>
<div class="modal-footer">
  <a href="#" class="btn btn-primary" id="saveBrand">OK</a>
  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
</div>
</div>
</div>
</div>

<!-- Pop up modal delete brand -->
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
    <p>Are you sure that you want to delete this brand?</p>
  </div>
  <div class="modal-footer">
    <a class="btn btn-primary" data-dismiss="modal" id="delete-comfirm" >Yes</a>
    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
  </div>
</div>
</div>
</div>

<!-- Pop up modal create brand -->
<div id="frmConfirmEdit" class="modal hide fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frm_edit">
          <div class="form-inline"> <!--Display data edit from controller-->

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
  var t = $('#brand').DataTable({order:[]});
  showAllBrand();

   // Show all brand by ajax
   function showAllBrand()
   {
      $("#brand_row").html('<tr><td class="text-center text-info" colspan="10"><i class="mdi mdi-cached mdi-spin mdi-24px"></i>Loading... </td></tr>');
      $.ajax({
       type: 'ajax',
       url: '<?php echo base_url(); ?>/brand/showAllBrand', // url access to show all brand in controller
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
          n+'&nbsp;<a href="#" class="item-edit" dataid="'+data[i].idbrand+'"><i class="mdi mdi-pencil" data-toggle="tooltip" title="Edit brand"></i></a>'+
          '<a href="#" class="item-delete text-danger" dataid="'+data[i].idbrand+'"><i class="mdi mdi-delete" data-toggle="tooltip" title="Delete brand"></i></a>',
          data[i].brand,'<a href="<?php echo base_url(); ?>models/index/'+data[i].idbrand+'" title=""><i class="mdi mdi-format-list-bulleted" data-toggle="tooltip" title="View all models"></i></a> '+ data[i].ModelCount+
          ' model (s)'
               ] ).draw( false );
         n++;
       }
    }
    });
  }
  Offline.on('up', function() {
    showAllBrand();
  });

      //  Combine btn onclick OK with key Enter when create
      $('#frmConfirmCreate').keypress(function(e)
      {
             if(e.which === 13) //Enter key pressed
             {
              e.preventDefault();
                $('#saveBrand').click();//Trigger search button click event
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

       // Ceate breand by ajax
       $("#createBrand").click( function()
       {
        $('#frmConfirmCreate').modal('show').on('shown.bs.modal', function(){
          $('input[name=brand]').focus();
        });
      });

        // Create brand by using ajax
         $('#saveBrand').on('click', function()
         {
          var brand = $('input[name=brand]');
          var result = '';
          if(brand.val()==''){
            brand.parent().parent().addClass('has-error');
          }else{
            brand.parent().parent().removeClass('has-error');
            result +='1';
          }
          if(result=='1'){
           $.ajax({
             url: "<?php echo base_url(); ?>brand/create_brand", // url access to create breand in controller
             type: "POST",
             data: $('#frm-create').serialize(),
             dataType: 'json',
             async: true
         }).always(function(data){
            $('#frm-create')[0].reset();
            $('#frmConfirmCreate').modal('hide');
            $('.alert-info').html('Brand was created  successfully').fadeIn().delay(6000).fadeOut('slow');
            showAllBrand();
         });
         }
       });

         // Delete  brand by ajax
         $('#brand_row').on('click', '.item-delete', function()
         {
           var id = $(this).attr('dataid');
           $('#frmConfirmDelete').data('id', id).modal('show');
         });

         // Confirm delete by button even
         $("#delete-comfirm").on('click',function()
         {
           var id = $('#frmConfirmDelete').data('id');
           $.ajax({
             url: "<?php echo base_url(); ?>brand/deleteBrand",  // url access to delete brand in controller
             type: "POST",
             data: {idbrand: id},
             dataType: "json",
             success: function(data)
             {
                 $('#frmConfirmDelete').modal('hide');
                 $('.alert-info').html('Brand was deleted  successfully').fadeIn().delay(6000).fadeOut('slow');
                 showAllBrand();
               },
               error: function()
               {
                 alert("Error delete!! this brand have relationship with another field...");
               }
             });
         });

         // Update brand modal pop up by ajax
         $('#brand_row').on('click', '.item-edit', function()
         {
           var id = $(this).attr('dataid');
           $.ajax({
             type: 'POST',
             data: {idbrand: id},
             url: '<?php echo base_url(); ?>/brand/showEditBrand',
             async: true,
             dataType: 'json',
             success: function(data)
             {
               $('#frm_edit').html(data);
               $('#frmConfirmEdit').modal('show').on('shown.bs.modal', function(){
                $('input[name=brand_update]').focus();
              });
             }
           });
         });

         // Save  update by button even
         $("#update").click(function(){
          var id = $('#frmConfirmEdit').data('id');
          var brand = $('input[name=brand_update]');
          var result = '';
          if(brand.val()=='')
          {
            brand.parent().parent().addClass('has-error');
          }else{
            brand.parent().parent().removeClass('has-error');
            result +='1';
          }
          if(result=='1')
          {
           $.ajax({
             url: "<?php echo base_url(); ?>brand/update",
             type: "POST",
             data: $('#frm_edit').serialize(),
             dataType: 'json',
             success: function(data)
             {
               if(data.status)
               {
                 $('#frm_edit')[0].reset();
                 $('#frmConfirmEdit').modal('hide');
                 $('.alert-info').html('Brand was updated  successfully').fadeIn().delay(6000).fadeOut('slow');
                 showAllBrand();
               }
             },
             error: function()
             {
               alert("Error edit this brand have relationship with another field...");
               $('#frmConfirmEdit').modal('hide');
             }
           });
         }
       });
       });

     </script>
