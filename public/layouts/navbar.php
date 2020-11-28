 <!-- Main Sidebar Container -->
 <aside class="main-sidebar elevation-4 sidebar-light-primary">
     <!-- Brand Logo -->
     <a href="index3.html" class="brand-link navbar-primary">
         <img src="<?php echo public_url(); ?>storage/logo/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light">JAVAHouse</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img src="<?php echo public_url(); ?>storage/users/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
             </div>
             <div class="info">
                 <a href="#" class="d-block">Alexander Pierce</a>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                 <li class="nav-item has-treeview menu-open">
                     <a href="#" class="nav-link active">
                         <i class="nav-icon fa fa-dashboard"></i>
                         <p>
                             Dashboard
                             <i class="right fa fa-angle-left"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="<?php echo base_url(); ?>index.php" class="nav-link">
                                 <i class="fa fa-circle nav-icon"></i>
                                 <p>Dashboard</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fa fa-th"></i>
                         <p>
                             Fast Food
                             <span class="right badge badge-danger">New</span>
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fa fa-th"></i>
                         <p>
                             Breakfast
                             <span class="right badge badge-danger">New</span>
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fa fa-th"></i>
                         <p>
                             Lunch
                             <span class="right badge badge-danger">New</span>
                         </p>
                     </a>
                 </li>

                 <li class="nav-header">ORDERS</li>

                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fa fa-calendar-minus-o"></i>
                         <p>
                             Current Order
                             <span class="badge badge-info right">2</span>
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fa fa-image"></i>
                         <p>
                             My Orders
                         </p>
                     </a>
                 </li>

                 <li class="nav-header">EXIT</li>

                 <li class="nav-item">
                     <a href="<?php echo base_url(); ?>login.php" class="nav-link">
                         <i class="fa fa-circle nav-icon"></i>
                         <p>Sign Out</p>
                     </a>
                 </li>
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>