<?php

defined('BASEPATH') or exit('No direct script access allowed');
$title    = (isset($title)) ? $title : "Skeleton";
$langCode = (isset($langCode)) ? $langCode : "en";

?><!DOCTYPE html>
<html lang="<?php echo $langCode; ?>">
<head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
  <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/logo-img/file-icon.png" type="image/x-icon">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap-4.0.0/css/bootstrap.min.css">
  <link href="<?php echo base_url();?>assets/MDI-2.1.19/css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css" />

  <!-- Custom style //-->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/skeleton-1.0.0.css">

  <script src="<?php echo base_url();?>assets/js/jquery-3.2.1.min.js"></script>
  <script src="<?php echo base_url();?>assets/tether-1.4.3/js/tether.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/popper-1.12.9..min.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap-4.0.0/js/bootstrap.min.js"></script>

  <style type="text/css">
  * {
    font-family: verdana;
    font-size: 15px;
  }
  body {
    padding-top: 60px;
    min-height: 0rem;
  }

  #logo-menu {
    max-width: 130px;
  }
  /*.menu {
    position: relative;
    left: 50%;
    }*/
    .form {
      position: relative;
      left: 53px;
    }
  /*.body-login {
    background-image: url('<?php echo base_url()?>assets/images/logo-img/bg-in.jpg');
    background-size: cover;
    background-attachment: fixed;

    }*/
  </style>
</head>
<body>
