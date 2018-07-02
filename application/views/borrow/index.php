<!-- this is  borrow feature layout -->
<div id="container" class="container">
  <div class="row-fluid">
   <div class="col-12">   
     <div class="row">
       <div class="col-9">
         <h2><?php echo $title;?></h2>
       </div>
     </div>
   </div><br>
   <div class="alert alert-info" style="display: none;"></div>
   <table id="borrow" cellpadding="0" cellspacing="0" class="table table-striped table-bordered" width="100%">
    <thead>
      <tr>
        <th>ID</th>
        <th>Borrower</th>
        <th>Item Borrow</th>
        <th>Start Date</th>
        <th>Return Date</th>
      </tr>
    </thead>
    <!-- show list of borrower -->
    <tbody id="showdata"> 

    </tbody>
  </table>
</div>
</div>
<div class="row-fluid"><div class="col-12">&nbsp;</div></div>

<link href="<?php echo base_url();?>assets/DataTable/DataTables-1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/DataTable//DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/DataTable//DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    var t = $('#borrow').DataTable({order:[]});
    showAllBorrow();

// show all borrow list function get from showAllBorrow controller to table 
function showAllBorrow()
{
  $("#showdata").html('<tr><td class="text-center text-info" colspan="10"><i class="mdi mdi-cached mdi-spin mdi-24px"></i>Loading... </td></tr>');
  $.ajax({
    type: 'ajax',
    url: '<?php echo base_url();?>borrow/showAllBorrow',  //url access to controller
    async: true,
    dataType: 'json',
    success: function(data){
      t.clear().draw();
      var n =1;
      var i;
      for(i=0; i<data.length; i++){
        t.row.add( [
          n,
          data[i].borrower,
          data[i].item,
          data[i].startDate,
          data[i].returnDate,
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
});
</script>
