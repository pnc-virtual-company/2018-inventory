<style>
body {
    background: #f8f9fa;
}
</style>

<br><br><br>
<div class="container ">
    <div class="row">
        <div class="col-lg-3 col-md-3"></div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="card text-center"><br>
                <div class="logo">
                    <img id="pn-logo" src="<?php echo base_url()?>assets/images/logo-img/logo.png" style="width: 250px;" alt="">
                </div>
                <div class="card-body"> 
                    <?php echo $flashPartialView;?>
                    <?php
                    $attributes = array('id' => 'formLogin', 'class' => 'form-signin');
                    echo form_open('connection/login', $attributes); ?>
                    <h2 class="form-signin-heading">Please sign in</h2><br>
                    <div class="login-form form">
                        <div class="form-group form-inline">
                            <label for="login">Username</label>&nbsp;
                            <input type="text" name="login" class="form-control" required autofocus>
                        </div>
                        <div class="form-group form-inline">
                            <label for="password" >Password</label>&nbsp;&nbsp;
                            <input type="password" name="password" class="form-control" required>
                        </div>
                    </div>
                    <button class="btn btn-info" type="submit">Sign in</button>&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php echo validation_errors() ?>
                    <a href="#">Forgot password?</a>
                </form> 
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3"></div>
</div>
</div> <!-- /container -->

<script>
  $(function(){
    $('.form-control').keypress(function(event) {
      if (event.keyCode == 13 || event.which == 13) {
        $('#formLogin').submit();
    }
});
});
</script>
