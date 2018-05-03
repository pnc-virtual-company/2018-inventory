<?php
/**
 * This view displays the list of category.
 * @copyright  Copyright (c) 2014-2018 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/skeleton
 * @since      1.0.0
 */
?>

<div id="container" class="container">
	<div class="row-fluid">
    <!-- <div class="col-2"></div> -->
    <div class="col-12">

      <h2><?php echo $title;?></h2>

      <?php echo $flashPartialView;?>

      <table id="category" cellpadding="0" cellspacing="0" class="table table-striped table-bordered" width="100%">
        <thead>
          <tr>
            <th>ID</th>
            <th>Category</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $id = 1;
          foreach ($cate as $cat):
            ?>
            <tr>
              <td class="text-right" data-order="<?php echo $cat->idcategory; ?>" data-id="<?php echo $cat->idcategory;?>">
                <a href="#" class="confirm-edit" title="edit category"><i class="mdi mdi-pencil"></i></a>
                <a href="#" class="confirm-delete" title="Delete user" ><i class="mdi mdi-delete"></i></a>
                <?php echo $id ++; ?>&nbsp;
              </td>
              <td> <?php echo $cat->category; ?> </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="row-fluid"><div class="col-12">&nbsp;</div></div>
  <!-- create new department -->
  <div class="container">
    <div class="row-fluid">
      <div class="col-12">
        <button type="button" class="btn btn-primary create-category">
          <i class="mdi mdi-plus-circle"></i>&nbsp;Create category
        </button> 
      </div>
    </div>
  </div>
  <!-- Modal create -->
  <div id="frmConfirmAdd" class="modal hide fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="frm_create">
          <div class="modal-body">
            <div class="form-inline">
              <label for="">Category</label> &nbsp;

              <input type="text" name="createCategory" class="form-control">

            </div>
          </div>
        </form>
        <div class="modal-footer">
          <a href="#" class="btn btn-primary" id="btn-create">OK</a>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <!-- delete  -->
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
          <p>Are you sure that you want to delete this category?</p>
        </div>
        <div class="modal-footer">
          <a href="#" class="btn btn-danger" id="lnkDeleteUser">Yes</a>
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
          <h5 class="modal-title">Edit Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-inline">
            <label for="">Category</label> &nbsp;
            <input type="text" name="editCategory" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <a href="#" class="btn btn-primary" data-dismiss="modal">OK</a>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  <!-- link bootstrap4 and javaScipt -->
  <link href="<?php echo base_url();?>assets/DataTable/DataTables-1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script type="text/javascript" src="<?php echo base_url();?>assets/DataTable//DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/DataTable//DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  

  <script>
    $(document).ready(function() {
      $('[data-toggle="tooltip"]').tooltip();
        //Transform the HTML table in a fancy datatable
      $("#btn-create").on('click', function(){
        // alert("It's working...");
        $.ajax({
          'url': "<?php echo base_url() ?>category/create",
          // console.log('url');
          'type': "POST",
          'data': $("#frm_create").serialize(),
          dataType: "json",
          'successs': function(data){
            alert(data.createCategory);
          },
          'error': function(){
            alert("error...");
          }
        });
      });
        
        $('#category').dataTable({
          stateSave: true,
        });

        // Create Category
        $(".create-category").click(function(){
          var id = $(this).parent().data('id');
          $('#frmConfirmAdd').modal('show');
        });

        $("#category tbody").on('click', '.confirm-delete',  function(){
          var id = $(this).parent().data('id');
          var link = "<?php echo base_url();?>category/delete/" + id;
          $("#lnkDeleteUser").attr('href', link);
          $('#frmConfirmDelete').modal('show');
        });
        // edit
        $(".confirm-edit").click(function(){
          var id = $(this).parent().data('id');
          $('#frmConfirmEdit').modal('show');
        });
        // button create OK 



      });
    </script>

