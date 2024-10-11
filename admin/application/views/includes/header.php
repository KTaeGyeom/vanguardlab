<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Homepage Manager">
  <meta name="author" content="VanguardLab">

  <title>VanguardLab Homepage Data Manager</title>
  <link rel="shortcut icon" href="/img/favicon.ico">

  <!-- Custom styles for this template-->
  <link href="/admin/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="/admin/assets/vendor/jquery-ui/jquery-ui.min.css"></script>
  <link href="/admin/assets/vendor/bootstrap/js/bootstrap.min.css"></script>
  <link href="/admin/assets/css/sb-admin-2.css" rel="stylesheet" type="text/css">
  <link href="/admin/assets/vendor/datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css">
  <link href="/admin/assets/css/custom.css" rel="stylesheet" type="text/css">

  <!-- Bootstrap core JavaScript-->
	<script src="/admin/assets/vendor/jquery/jquery-3.5.0.min.js"></script>
	<script src="/admin/assets/vendor/jquery-ui/jquery-ui.min.js"></script>
	<script src="/admin/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="/admin/assets/vendor/datepicker/js/bootstrap-datepicker.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="/admin/assets/vendor/ag-grid/ag-grid-community.min.js"></script>

  <!-- Dropzone -->
  <script src="/admin/assets/vendor/dropzone/dropzone.min.js"></script>
  <link rel="stylesheet" href="/admin/assets/vendor/dropzone/dropzone.min.css" type="text/css" />
  <!-- <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script> -->
  <!-- <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" /> -->

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
  
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-download"></i></div>
        <div class="sidebar-brand-text mx-3">Homepage</div>
      </a>

      <?php 
        $CI =& get_instance();
        $CI->load->library('view_library');

        // Home Menu
        echo $CI->view_library->menu_divider();
        echo $CI->view_library->menu_item($this->uri->segment(1), 'home', 'Home', 'Home', 'home'); // $currentPage, $link, $title, $description, $icon

        // Data
        echo $CI->view_library->menu_divider();
        echo $CI->view_library->menu_group('Data');
        echo $CI->view_library->menu_item($this->uri->segment(1), 'party', 'Party', 'Party lists', 'building');
        //echo $CI->view_library->menu_item($this->uri->segment(1), 'client', 'Client', 'Client lists', 'building');
        //echo $CI->view_library->menu_item($this->uri->segment(1), 'partner', 'Partner', 'Partner lists', 'building');
        echo $CI->view_library->menu_item($this->uri->segment(1), 'reference', 'Reference', 'Reference lists', 'building');
        echo $CI->view_library->menu_item($this->uri->segment(1), 'image', 'Image', 'Image lists', 'building');

        // Setup Menu
        echo $CI->view_library->menu_divider();
        echo $CI->view_library->menu_group('Setup');
        echo $CI->view_library->menu_item($this->uri->segment(1), 'setting', 'General', 'Common Setup', 'cog'); // $currentPage, $link, $title, $description, $icon
        echo $CI->view_library->menu_item($this->uri->segment(1), 'users', 'Users', 'Setup users', 'user');
        
        // System
        echo $CI->view_library->menu_divider();
        echo $CI->view_library->menu_group('System');
        // echo $CI->view_library->menu_item($this->uri->segment(1), 'test', 'Test', 'Test', 'test');
        echo $CI->view_library->menu_item($this->uri->segment(1), 'systemlog', 'System Log', 'View server logs', 'archive');

        // Etcs
        echo $CI->view_library->menu_divider();
        echo $CI->view_library->menu_item($this->uri->segment(1) . '/' . $this->uri->segment(2), 'home/info', 'Information', 'Information', 'info');
        echo $CI->view_library->menu_item($this->uri->segment(1), 'logout', 'Logout', 'System logout', 'sign-out-alt');

      ?>

    </ul>
    <!-- End of Sidebar -->


    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <!-- <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow"> -->
        <nav class="navbar navbar-expand topbar mb-4 static-top" style="background-color: #2b2f3a; ">

          <!-- System Name -->
          <b>VanguardLab Homepage Data Manager</b>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <div>
              <!-- Nav Item - User Information -->
              <div class="input-group row">
                <div class="input-group-prepend"><span class="input-group-text" title="User"><i class="fas fa-fw fa-user"></i></span></div>
                <input type="text" class="form-control form-control-sm" title="Logon User" value=<?php echo $this->session->userdata('username'); ?> readonly>
              </div>

              <!-- Theme -->
              <?php
                $themeArray = array('alpine', 'alpine-dark', 'balham', 'balham-dark', 'base', 'blue', 'bootstrap', 'classic', 'dark', 'fresh', 'material');

                $arrayLength = count($themeArray);
                $arrayString = "";
                for ($row = 0; $row < $arrayLength; $row ++) {
                  $arrayString = $arrayString . "
                    <option value='" . $themeArray[$row] . "' " . 
                    ($this->session->userdata('theme') == $themeArray[$row] ? "selected" : "") .">" . $themeArray[$row] . "</option>";
                }
              ?>

              <form id="formTheme" action="#" method="post" accept-charset="utf-8" onsubmit="return false;">
              <div class="input-group row">
                <div class="input-group-prepend"><span class="input-group-text" title="Theme"><i class="fas fa-fw fa-fill"></i></span></div>
                <select class="form-control form-control-select form-control-sm" name="theme" title="Select theme" onchange="changeTheme();">
                  <?php echo $arrayString; ?>
                </select>
              </div>
              </form>

              <script>
                // Change theme
                function changeTheme() {
                  var params = jQuery("#formTheme").serialize(); // serialize()
                  $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>users/theme",
                    data: params,
                    dataType: 'json',
                    success: function(data) {
                      //alert('Success');
                      location.reload();
                    },
                    error: function(xhr, status, error) {
                      alert("Error:" + error + " / Status:" + status);
                      return;
                    }
                  });
                }
              </script>

            </div>
          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
