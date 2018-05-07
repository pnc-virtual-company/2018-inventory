<?php
/**
 * This view displays the list of users.
 * @copyright  Copyright (c) 2014-2018 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/skeleton
 * @since      1.0.0
 */
?>
<div id="container">
	<div class="row-fluid">
		<div class="col-12">
            <div class="table-responsive">
                <h2><?php echo $title;?></h2>
                <div class="alert alert-success" style="display: none;"></div>
                <table id="items" cellpadding="0" cellspacing="0" class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>Identifier</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Material</th>
                            <th>Condiction</th>
                            <th>Department</th>
                            <th>Location</th>
                            <th>User</th>
                            <th>Owner</th>
                        </tr>
                    </thead>
                    <tbody id="showdata">


                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row-fluid"><div class="col-12">&nbsp;</div></div>

    <div class="row-fluid">
      <div class="col-12">
        <a href="<?php echo base_url();?>items/create" class="btn btn-primary"><i class="mdi mdi-plus-circle"></i>&nbsp;Create a new item</a>
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
    <p>Are you sure that you want to delete this item</p>
</div>
<div class="modal-footer">
    <a href="#" class="btn btn-primary" id="delete-comfirm">Yes</a>
    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
</div>
</div>
</div>
</div>

</div>

<link href="<?php echo base_url();?>assets/DataTable/DataTables-1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/DataTable//DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/DataTable//DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        var t = $('#items').DataTable();
        showAllitems();

// showAllitems function get items data to table 
function showAllitems()
{
  $.ajax({
    type: 'ajax',
    url: '<?php echo base_url();?>items/showAllitems',
    async: true,
    dataType: 'json',
    success: function(data){
      t.clear().draw();
      var n = 1;
      var i;
      for(i=0; i<data.length; i++){
        t.row.add( [
          '<a href="#" class="item-edit" dataid="'+data[i].iditem+'"><i class="mdi mdi-pencil"></i></a>'+
          '<a href="#" class="item-delete" dataid="'+data[i].iditem+'"><i class="mdi mdi-delete"></i></a>'+data[i].itemcodeid,
          data[i].item,data[i].cat,data[i].mat,data[i].condition,data[i].depat,data[i].locat,data[i].nameuser,data[i].owner
          ] ).draw( false );
        n++;
    }
},
error: function(){
  alert('Could not get Data from Database');
}
});
}
// delete material by ajax
$('#showdata').on('click', '.item-delete', function(){
  var id = $(this).attr('dataid');
  $('#deleteModal').data('id', id).modal('show');
});

// comfirm delete button
$("#delete-comfirm").on('click',function(){
  var id = $('#deleteModal').data('id');
  $.ajax({
    url: "<?php echo base_url() ?>items/deleteItems",
    type: "POST",
    data: {iditem: id},
    dataType: "json",
    success: function(data){
      $('#deleteModal').modal('hide');
      $('.alert-success').html('Item delete successfully').fadeIn().delay(4000).fadeOut('slow');
      showAllitems();
  },
  error: function(){
      $('#deleteModal').modal('hide');
      alert("Error delete! this item is has relationship with another...");
  }
});
});

});
</script>
