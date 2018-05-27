<style>
.highlight { background-color: #007bff; color:#fff; font-weight: bold;}
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
</style>

<div class="container bg-light">
  <div class="row-fluid">
    <form action="<?php echo base_url();?>items/insertBorrower" method="POST"  id="frm_borrow">
      <div class="col-12">

        <div class="row">
          <div class="col-2"></div>
          <div class="col-8">
            <div class="alert alert-info" style="display: none;"></div>
            <h2>Borrow an Item</h2>
            <!-- borrower input -->
            <div class="form-group">
              <label class="control-label" for="borrower">Borrower</label>
              <div class="input-group mb-3">
                <input type="text" class="form-control" aria-label="borrower" aria-describedby="basic-addon2" id="borrowName" name="nameBorrower" value="<?php echo $this->session->firstname.' '.$this->session->lastname; ?>">
                <div class="input-group-append">
                  <button id="select_borrower" class="btn btn-outline-primary" type="button" >Select</button>
                </div>
              </div>
            </div>

            <!-- item input -->
            <div class="form-group" id="borrower">
              <label class="control-label" for="items">Item</label>

              <div class="input-group mb-3">
                <?php 
                foreach ($borrow as $value) {
                  ?>
                  <input type="text" class="form-control" value="<?php echo $value->item ?>"   disabled >
                  <input type="hidden" id="borrowerid" value="<?php echo $value->iditem ?>"  name="itemName"  >
                  <?php 
                }
                ?>
              </div>
            </div>
            
            <div class="form-group">
              <label class="control-label" for="startDate">Borrow Date</label>
              <div class="input-group mb-3">
                <input type="date" class="form-control"  id="datePicker" name="startDate">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label" for="returnDate">Return Date</label>
              <div class="input-group mb-3">
                <input type="date" class="form-control" name="returnDate" id="EndDate">
              </div>
            </div>
            
            <div class="footer"><!-- 
              <a href="#" class="btn btn-primary" id="saveBorrow">OK</a> -->
              <button class="btn btn-primary" type="submit">Borrow</button>
              <button type="button" class="btn btn-default" ><a href="<?php echo base_url(); ?>items" style="text-decoration: none; color: #000;"> Cancel</a></button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>


<!-- select the owner modal -->
<div class="modal  fade hide" id="selectBorrower">
 <div class="modal-dialog modal-lg modal-dialog-centered">
   <div class="modal-content">
     <!-- Modal Header -->
     <div class="modal-header">
       <h4 class="modal-title">Select Borrower</h4>
       <button type="button" class="close" data-dismiss="modal">&times;</button>
     </div>          
     <!-- Modal body -->
     <div class="modal-body ">
      <div class="borrowerlist">
        <table id="borrow" cellpadding="0" cellspacing="0" class="table table-bordered" width="100%">
          <thead>
            <tr>
              <!-- <th>ID</th> -->
              <th>User</th>
            </tr>
          </thead>
          <tbody id="displayBorrower">

          </tbody>
        </table>
      </div>  
    </div> 
    <!-- Modal footer -->
    <div class="modal-footer">
     <button type="button" class="btn btn-primary" id="borrowerset">OK</button>
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
  // use for get current date
  $(document).ready(function() {
    var date = new Date();

    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();

    if (month < 10) month = "0" + month;
    if (day < 10) day = "0" + day;

    var today = year + "-" + month + "-" + day;       
    $("#datePicker").attr("value", today);

$("#EndDate").change(function () {
    var startDate = document.getElementById("datePicker").value;
    var endDate = document.getElementById("EndDate").value;

    if ((Date.parse(startDate) >= Date.parse(endDate))) {
        $('.alert-info').html("Return date should be greater than Borrow date.").fadeIn().delay(6000).fadeOut();
        document.getElementById("EndDate").value = "";
    }
});

+
      // Select borrower 
      $("#select_borrower").click(function(){
        $.ajax({
          type: 'POST',
          url: '<?php echo base_url();?>/items/borrowerName',
          async: true,
          dataType: 'json',
          success: function(data){
            $('#selectBorrower').modal('show');
            var c = $('#borrow').DataTable();
            c.clear().draw();
            var i;
            var n = 1;
            for(i=0; i<data.length; i++){
              c.row.add ( [
                // data[i].id,
                data[i].borrower
                ] ).draw( false );
              n++;    
            }
          },
          error: function(){
            alert('Could not get Data from Database');
          }
      });
        });
      var borrow ='';
      $(document).on("click", "#borrow tbody tr", function() {
        $('#borrow tbody tr').removeClass("highlight");
        $(this).addClass("highlight");
      var borrow =$(this).find("td:eq(0)").html();
        $("#borrowerset").click(function(){
          $('#borrowName').val('');
          $('#borrowName').val(borrow);
          $("#selectBorrower").modal("hide");
        });
      });

    });
  </script>


