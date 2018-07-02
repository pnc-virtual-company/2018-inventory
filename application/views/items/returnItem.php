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
    <form action="<?php echo base_url();?>items/returnAnItem" method="POST"  id="frm_borrow">
      <div class="col-12">
        <div class="row">
          <div class="col-2"></div>
          <div class="col-8">
            <h2>Return an Item</h2>
            <!-- borrower input -->
            <div class="form-group">
              <label class="control-label" for="borrower">Borrower</label>
              <div class="input-group mb-3">
                <!-- foreach to get the name of borrower to display into form input borrowe and disable it -->
                <?php
                foreach ($r_item as $borrower) {
                    ?>
                  <input type="text" class="form-control" aria-label="borrower" aria-describedby="basic-addon2" id="borrowName" name="nameBorrower" value="<?php echo  $borrower->borrower;?>" disabled>
                    <?php
                }
                ?>
              </div>
            </div>
            <!-- item input by foreach to get data from database to display in input tag and disable -->
            <div class="form-group" id="borrower">
              <label class="control-label" for="items">Item</label>

              <div class="input-group mb-3">
                <?php
                foreach ($borrow as $value) {
                    ?>
                  <input type="text" class="form-control" value="<?php echo $value->item ?>"   disabled >
                  <input type="hidden" id="borrowerid" value="<?php echo $value->iditem ?>"  name="itemId"  >
                    <?php
                }
                ?>
              </div>
            </div>

            <!-- get value of start date from database that store at the day when borrowed from system -->
            <div class="form-group">
              <label class="control-label" for="startDate">Start Date</label>
              <div class="input-group mb-3">
                <?php
                foreach ($r_item as $valueDate) {
                    ?>
                  <input type="date" class="form-control"  id="" name="startDate" disabled value="<?php echo $valueDate->startDate;?>">
                  <input type="hidden" name="startDate" value="<?php echo $valueDate->startDate;?>">
                    <?php
                }
                ?>
              </div>
            </div>

            <!-- get value of start date from database that store at the day that expected to return back  -->
            <div class="form-group">
              <label class="control-label" for="returnDate">Return Date</label>
              <div class="input-group mb-3">
                <?php
                foreach ($r_item as $valueDate) {
                    ?>
                  <input type="date" class="form-control" name="returnDate" disabled value="<?php echo $valueDate->returnDate; ?>">
                    <?php
                }
                ?>
              </div>
            </div>

            <!-- actual return date that get the current day to make a calculate between expected return date to make late status in table item -->
            <div class="form-group">
              <label class="control-label" for="startDate">Actual Date</label>
              <div class="input-group mb-3">
                <input type="date" class="form-control"  id="datePickerActual" name="actualDate">
              </div>
            </div>
            
            <div class="footer">
              <button class="btn btn-primary" type="submit" id="returnbtn">Return</button>
              <button type="button" class="btn btn-default" id="cancelbtn"><a href="<?php echo base_url(); ?>items" style="text-decoration: none; color: #000;"> Cancel</a></button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- link bootstrap4 and javaScipt -->
<link href="<?php echo base_url();?>assets/DataTable/DataTables-1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/DataTable//DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/DataTable//DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script>
  // use for actual date to get current date
  $(document).ready(function() {
    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();

    if (month < 10) month = "0" + month;
    if (day < 10) day = "0" + day;

    var today = year + "-" + month + "-" + day;       
    $("#datePickerActual").attr("value", today);
  });
  </script>


