<?php
/**
 * This view allows to create a new employee
 * @copyright  Copyright (c) 2014-2017 Benjamin BALET
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @link       https://github.com/bbalet/skeleton
 * @since      0.1.0
 */
?>

<div class="container">
  <div class="row-fluid">
    <div class="col-12">

      <h2>Create a new item</h2>

      <?php echo validation_errors(); ?>

      <?php
      $attributes = array('id' => 'target', 'class' => 'form-horizontal');
      echo form_open('users/create', $attributes); ?>

      <div class="form-group">
        <label class="control-label" for="itemname">Name</label>
        <input type="text" class="form-control" name="itemname" id="itemname" placeholder="Enter Item name" required />
      </div>
      <div class="row">
        <div class="col-8">
          <div class="form-group">
            <label class="control-label" for="category">Category</label>
            <div class="input-group mb-3">
              <input id="category" type="text" class="form-control" placeholder="Air condictioner" aria-label="category" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button id="categories" class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#selectCategory">Select</button>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label" for="material">Material</label>
            <div class="input-group mb-3">
              <input id="material" type="text" class="form-control" placeholder="Iron" aria-label="material" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button id="materials" class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#selectMaterial">Select</button>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label" for="department">Department</label>
            <div class="input-group mb-3">
              <input id="department" type="text" class="form-control" placeholder="Admin/Finance" aria-label="department" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button id="departments" class="btn btn-outline-primary" type="button"  data-toggle="modal" data-target="#selectDepartment">Select</button>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label" for="location">Location</label>
            <div class="input-group mb-3">
              <input id="location" type="text" class="form-control" placeholder="A10" aria-label="location" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button id="locations" class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#selectLocation">Select</button>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label" for="user">User</label>
            <div class="input-group mb-3">
              <input id="user" type="text" class="form-control" placeholder="Benjamin BALET" aria-label="user" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button id="users" class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#selectUser">Select</button>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label" for="owner">Owner</label>
            <div class="input-group mb-3">
              <input id="owner" type="text" class="form-control" placeholder="PNC" aria-label="owner" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button id="owners" class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#selectOwner">Select</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-4">
          <div class="form-group">
            <label for="sel1">Condition:</label>
            <select class="form-control" id="sel1">
              <option>New</option>
              <option>Fair</option>
              <option>Damaged</option>
              <option>Broken</option>
            </select>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="row-fluid"><div class="col-12">&nbsp;</div></div>

 <!-- select the category -->
    <div class="row-fluid">
      <div class="col-12">
       <!-- The Modal -->
       <div class="modal fade" id="selectCategory">
           <div class="modal-dialog modal-dialog-centered">
             <div class="modal-content">
               <!-- Modal Header -->
               <div class="modal-header">
                 <h4 class="modal-title">Create new department</h4>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
             </div>          
             <!-- Modal body -->
             <div class="modal-body ">
                <div class="form-inline">
                  <label class="control-label" for="firstname">Category</label>&nbsp;
                  <input type="text" class="form-control" name="firstname" id="firstname" required />
              </div>  
          </div> 
          <!-- Modal footer -->
          <div class="modal-footer">
             <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
             <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
         </div>
     </div>
 </div>
</div>
</div>
</div>

 <!-- select the material -->
    <div class="row-fluid">
      <div class="col-12">
       <!-- The Modal -->
       <div class="modal fade" id="selectMaterial">
           <div class="modal-dialog modal-dialog-centered">
             <div class="modal-content">
               <!-- Modal Header -->
               <div class="modal-header">
                 <h4 class="modal-title">Create new department</h4>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
             </div>          
             <!-- Modal body -->
             <div class="modal-body ">
                <div class="form-inline">
                  <label class="control-label" for="firstname">Material</label>&nbsp;
                  <input type="text" class="form-control" name="firstname" id="firstname" required />
              </div>  
          </div> 
          <!-- Modal footer -->
          <div class="modal-footer">
             <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
             <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
         </div>
     </div>
 </div>
</div>
</div>
</div>


 <!-- select the Department -->
    <div class="row-fluid">
      <div class="col-12">
       <!-- The Modal -->
       <div class="modal fade" id="selectDepartment">
           <div class="modal-dialog modal-dialog-centered">
             <div class="modal-content">
               <!-- Modal Header -->
               <div class="modal-header">
                 <h4 class="modal-title">Create new department</h4>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
             </div>          
             <!-- Modal body -->
             <div class="modal-body ">
                <div class="form-inline">
                  <label class="control-label" for="firstname">Department</label>&nbsp;
                  <input type="text" class="form-control" name="firstname" id="firstname" required />
              </div>  
          </div> 
          <!-- Modal footer -->
          <div class="modal-footer">
             <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
             <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
         </div>
     </div>
 </div>
</div>
</div>
</div>



 <!-- select the location -->
    <div class="row-fluid">
      <div class="col-12">
       <!-- The Modal -->
       <div class="modal fade" id="selectLocation">
           <div class="modal-dialog modal-dialog-centered">
             <div class="modal-content">
               <!-- Modal Header -->
               <div class="modal-header">
                 <h4 class="modal-title">Create new department</h4>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
             </div>          
             <!-- Modal body -->
             <div class="modal-body ">
                <div class="form-inline">
                  <label class="control-label" for="firstname">Location</label>&nbsp;
                  <input type="text" class="form-control" name="firstname" id="firstname" required />
              </div>  
          </div> 
          <!-- Modal footer -->
          <div class="modal-footer">
             <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
             <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
         </div>
     </div>
 </div>
</div>
</div>
</div>



 <!-- select the user -->
    <div class="row-fluid">
      <div class="col-12">
       <!-- The Modal -->
       <div class="modal fade" id="selectUser">
           <div class="modal-dialog modal-dialog-centered">
             <div class="modal-content">
               <!-- Modal Header -->
               <div class="modal-header">
                 <h4 class="modal-title">Create new department</h4>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
             </div>          
             <!-- Modal body -->
             <div class="modal-body ">
                <div class="form-inline">
                  <label class="control-label" for="firstname">user</label>&nbsp;
                  <input type="text" class="form-control" name="firstname" id="firstname" required />
              </div>  
          </div> 
          <!-- Modal footer -->
          <div class="modal-footer">
             <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
             <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
         </div>
     </div>
 </div>
</div>
</div>
</div>


 <!-- select the user -->
    <div class="row-fluid">
      <div class="col-12">
       <!-- The Modal -->
       <div class="modal fade" id="selectOwner">
           <div class="modal-dialog modal-dialog-centered">
             <div class="modal-content">
               <!-- Modal Header -->
               <div class="modal-header">
                 <h4 class="modal-title">Create new department</h4>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
             </div>          
             <!-- Modal body -->
             <div class="modal-body ">
                <div class="form-inline">
                  <label class="control-label" for="firstname">owner</label>&nbsp;
                  <input type="text" class="form-control" name="firstname" id="firstname" required />
              </div>  
          </div> 
          <!-- Modal footer -->
          <div class="modal-footer">
             <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
             <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
         </div>
     </div>
 </div>
</div>
</div>
</div>


<div class="row-fluid">
  <div class="col-12">
    <button id="send" class="btn btn-primary">
      <i class="mdi mdi-check"></i> Create
    </button>
    &nbsp;
    <a href="<?php echo base_url(); ?>items" class="btn btn-danger">
      <i class="mdi mdi-close"></i>&nbsp;Cancel
    </a>
  </div>
</div>

</div>
<script src="<?php echo base_url();?>assets/js/bootbox-4.4.0.min.js"></script>
<script type="text/javascript">
  //Check for mandatory fields
  function validate_form() {
    result = false;
    var fieldname = "";
    if ($('#firstname').val() == "") fieldname = "firstname";
    if ($('#lastname').val() == "") fieldname = "lastname";
    if ($('#login').val() == "") fieldname = "login";
    if ($('#email').val() == "") fieldname = "email";
    if ($('#password').val() == "") fieldname = "password";
    if (fieldname == "") {
      return true;
    } else {
      bootbox.alert('The field ' + fieldname + ' is mandatory.');
      return false;
    }
  }
      //Check if the user creation is OK and then send it
      $('#send').click(function() {
        if (validate_form() == false) {
              //Error of validation
            } else {
              $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>users/check/login",
                data: { login: $("#login").val() }
              })
              .done(function( msg ) {
                if (msg == "true") {
                  $('#target').submit();
                } else {
                  bootbox.alert('This login name is not available');
                }
              });
            }
          });

    </script>
