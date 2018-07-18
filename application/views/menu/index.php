<?php
defined('BASEPATH') or exit('No direct script access allowed');
$activeLink = (isset($activeLink)) ? $activeLink : "";?>
<style>
.nav-item{
    cursor: pointer;
}

.btn-new-container .btn-new{
  padding: 0;
}
</style>
<nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">

    <a class="navbar-brand" href="<?php echo base_url();?>items"><img id="logo-menu" src="<?php echo base_url() ?>assets/images/logo-img/logo.png" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
    aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse menu navbar-right" id="navbarsExampleDefault">
      <ul class="navbar-nav ml-auto ">
      <?php $role = $this->session->Role; if ($role == 1 || $role == 8) {
    ?>
          <li class="nav-item btn-new-container">
              <a class="nav-link text-primary btn-new" href="<?php echo base_url(); ?>items/create" data-toggle="tooltip" title="Create new item">
                  <button class="btn btn-primary" type="button" name="button">
                    <i class="mdi mdi-plus-circle "></i> New
                  </button>
              </a>
        </li>
    <?php
} ?>
        <li class="nav-item <?php echo($activeLink == 'items' ? 'active' : '');?>">
            <a class="nav-link" href="<?php echo base_url();?>items">Items</a>
        </li>
    <?php $role = $this->session->Role; if ($role == 1 || $role == 8) {
        ?>
            <div class="nav-link navbar dropdown <?php echo($activeLink == 'others' ? 'active' : ''); ?> ">
                <li class="nav-item dropdown-toggle " data-toggle="dropdown">
                    Settings
                    <li class="nav-item dropdown-menu">
                        <a class="dropdown-item" href="<?php echo base_url(); ?>category">Categories</a>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>materials">Materials</a>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>status">Status</a>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>departments">Departments</a>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>Borrow">Borrow</a>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>brand">Brands</a>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>locations">Locations</a>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>owner">Owners</a>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>reports">Reports</a>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>users">Admin</a>
                    </li>
                </li>
            </div>
        <?php
    }
?>
    <?php if ($this->session->loggedIn === true) {
    ?>
        <!-- <div class="navbar-collapse collapse navbar-right"> -->
            <!--   <ul class="navbar-nav ml-auto"> -->
                <li class="nav-item">
                    <a class="nav-link text-success" href="#" style="cursor: context-menu;">
        <?php echo $this->session->fullname; ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-success" href="<?php echo base_url(); ?>connection/logout" data-toggle="tooltip" title="Logout">
                        <i class="mdi mdi-logout"></i>
                    </a>
                </li>
            </ul>
        </div>
    <?php
} ?>
    </nav>
    <br>
