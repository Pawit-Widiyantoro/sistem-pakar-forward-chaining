<?php
  session_start();
  include "config.php";

  if($_SESSION['status']!='y'){
    header("Location:login.php");
  }
  ob_start();
  $page = isset($_GET['page']) ? $_GET['page'] : "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../node_modules/chosen-js/chosen.min.css">  
    <style>
        .chosen-container .chosen-single {
            height: calc(2.5rem + 2px);
            padding: 0.5rem 1rem;
            border-radius: 0.375rem; 
            border-color: #d1d5db;
            background: #ffffff !important;
            display: flex;
            align-items: center;
            margin-top: 5px;
        }
        .chosen-container .chosen-single div b {
            top: 50%;
        }
        .chosen-container-active .chosen-single {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5); 
        }
        .chosen-container .chosen-drop {
            border-color: #d1d5db;
            border-radius: 0.375rem; 
            background: #ffffff !important;
        }
        .chosen-container .chosen-results {
            background: #ffffff !important;
        }
    </style>
    <link rel="stylesheet" href="../src/output.css">
    <title>Homepage</title>
</head>
<body>
    <!-- navbar -->
  <nav class="bg-gray-800">
      <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
          <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
            <!-- Mobile menu button-->
            <button type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
              <span class="absolute -inset-0.5"></span>
              <span class="sr-only">Open main menu</span>
            </button>
          </div>
          <div class="flex-1 items-center justify-between sm:items-stretch sm:justify-start hidden sm:flex">
            <div class="flex space-x-4">
              <?php
              if($_SESSION['role']=="bidan"){
              ?>
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <a href="index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Home</a>
                <a href="?page=gejala" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Gejala</a>
                <a href="?page=penyakit" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Nutrisi</a>
                <a href="?page=aturan" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Basis Aturan</a>
                <a href="?page=konsultasi_admin" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Konsultasi</a>
              <?php
              } elseif ($_SESSION['role']=="admin"){
              ?>
                <a href="index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Home</a>
                <a href="?page=user" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">User</a>
                <a href="?page=konsultasi_admin" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Konsultasi</a>
              <?php
              } elseif ($_SESSION['role']=="pasien"){
              ?>
                <a href="index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Home</a>
                <a href="?page=konsultasi" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Konsultasi</a>
                <?php
              } 
              ?>
            </div>
          </div>
          <div class="items-center ml-auto hidden sm:flex">
            <!-- Right navigation items -->
            <a href="logout.php" class="border border-gray-300 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Logout</a>
        </div>
      </div>
      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
        <!-- <button type="button" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
          <span class="absolute -inset-1.5"></span>
          <span class="sr-only">View notifications</span>
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
          </svg>
        </button> -->

        <!-- Profile dropdown -->
        <div class="relative ml-3">
          <div>
            <!-- <button type="button" class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
              <span class="absolute -inset-1.5"></span>
              <span class="sr-only">Open user menu</span>
              <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
            </button> -->
          </div>
        </div>
      </div>
      </div>
    </div>
    
      <!-- Mobile menu, show/hide based on menu state. -->
      <div class="sm:hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pb-3 pt-2">
          <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
          <a href="index.php" class="<?php echo ($page == "") ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white'; ?> block rounded-md px-3 py-2 text-base font-medium" aria-current="page">Home</a>
          <a href="?page=user" class="<?php echo ($page == "user") ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white'; ?> block rounded-md px-3 py-2 text-base font-medium">User</a>
          <a href="?page=gejala" class="<?php echo ($page == "gejala") ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white'; ?> block rounded-md px-3 py-2 text-base font-medium">Gejala</a>
          <a href="?page=penyakit" class="<?php echo ($page == "penyakit") ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white'; ?> block rounded-md px-3 py-2 text-base font-medium">Penyakit</a>
          <a href="?page=konsultasi_admin" class="<?php echo ($page == "konsultasi_admin") ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white'; ?> block rounded-md px-3 py-2 text-base font-medium">Konsultasi</a>
          <a href="logout.php" class="border border-gray-300 text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Logout</a>
        </div>
      </div>
  </nav>
    <!-- end navbar  -->
      <div>
        <?php
        
        $page = isset($_GET['page']) ? $_GET['page'] : "";
        $action = isset($_GET['action']) ? $_GET['action'] : "";

        if($page==""){
            include "homepage.php";
        } elseif ($page=="gejala") {
            if($action==""){
                include "tampil_gejala.php";
            } else if ($action=="insert"){
                include "tambah_gejala.php";
            } else if ($action=="update"){
                include "edit_gejala.php";
            } else {
                include "hapus_gejala.php";
            }
        } elseif ($page=="penyakit") {
            if($action==""){
                include "tampil_penyakit.php";
            } else if ($action=="insert"){
                include "tambah_penyakit.php";
            } else if ($action=="update"){
                include "edit_penyakit.php";
            } else {
                include "hapus_penyakit.php";
            }
        } elseif ($page=="aturan") {
            if($action==""){
                include "tampil_aturan.php";
            } else if ($action=="detail"){
                include ('detail_aturan.php');
            } else if ($action=="insert"){
                include "tambah_aturan.php";
            } else if ($action=="update"){
                include "edit_aturan.php";
            } else if ($action=="delete_gejala"){
                include "hapus_detail_aturan.php";
            }else {
                include "hapus_aturan.php";
            }
        } elseif ($page=="konsultasi") {
            if($action==""){
                include "riwayat_konsultasi.php";
            } else if ($action=="hasil"){
                include "hasil_konsultasi.php";
            } else if ($action=="insert"){
                include "tampil_konsultasi.php";
            } else if ($action == "detail"){
                include "detail_konsultasi.php";
            }
        } elseif ($page=="user") {
            if($action==""){
                include "tampil_user.php";
            } else if ($action=="detail"){
                include ('detail_user.php');
            } else if ($action=="insert"){
                include "tambah_user.php";
            } else if ($action=="update"){
                include "edit_user.php";
            } else if ($action=="delete_gejala"){
                include "hapus_detail_user.php";
            }else {
                include "hapus_user.php";
            }
        } elseif($page=="konsultasi_admin"){
          if($action==""){
              include "tampil_konsultasi_admin.php";
          } else if ($action=="detail"){
              include ('detail_konsultasi_admin.php');
          } 
        } else {
            include "error.php";
        }
        ?>
      </div>
</body>
<script src="../node_modules/jquery/dist/jquery.min.js"></script>
<script src="../node_modules/chosen-js/chosen.jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.chosen').chosen();
    });
</script>
</html>

<?php
  ob_end_flush();
?>