<?php $currentPage = basename($_SERVER['PHP_SELF']);
include 'conexion/conexion.php'; 
?>
<style>
        @media only screen and (min-width: 576px) {
            /* Estilos aplicados solo en dispositivos con un ancho de pantalla de 768 píxeles o más */
            .boton-oculto {
                display: none;
            }
        }
    </style>
<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="home.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="logout.php" class="nav-link">Logout</a>
      </li>
    </ul>

  
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="home.php" class="brand-link">
      <img src="./img/product/logoFinal_blanco.svg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8; width:50px; height:50px">
      <span class="brand-text font-weight-light">Elizabeth Rom</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
       
        <div class="info">
    
          <a href="#" class="d-block"><?php echo $_SESSION['user_name'];?></a>
         
        </div>
       
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        
          
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                 
                 <li class="nav-header">DASHBOARD</li>
                
             <li class="nav-item">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-solid fa-home"></i>
              <p>
                 Home
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item <?php if ($currentPage == 'category.php') { echo 'active'; } ?>">
                <a href="instagram.php" class="nav-link">
                  <i class="far fa-regular fa-eye"></i>
                  <p>Instagram</p>
                </a>
              </li>
              
              <li class="nav-item <?php if ($currentPage == 'subCategory.php') { echo 'active'; } ?>">
                <a href="destacado.php" class="nav-link">
                  <i class="far fa-regular fa-eye"></i>
                  <p>Destacados</p>
                </a>
              </li>
            </ul>
          </li>
              
              
              <li class="nav-item">
                <a href="product.php" class="nav-link <?php if ($currentPage == 'product.php') { echo 'active'; } ?>">
                  <i class="far fa-circle nav-icon text-maroon"></i>
                  <p>Productos</p>
                </a>
              </li>
              
              
              <li class="nav-item">
                <a href="product-add.php" class="nav-link  <?php if ($currentPage == 'product-add.php') { echo 'active'; } ?>">
                  <i class="far fa-circle nav-icon text-warning"></i>
                  <p>Añadir Productos</p>
                </a>
              </li>
              <li class="nav-item">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-solid fa-list-ol"></i>
              <p>
                 Categoría
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item <?php if ($currentPage == 'category.php') { echo 'active'; } ?>">
                <a href="category.php" class="nav-link">
                  <i class="far fa-regular fa-eye"></i>
                  <p>Ver Categoría</p>
                </a>
              </li>
              
              <li class="nav-item <?php if ($currentPage == 'subCategory.php') { echo 'active'; } ?>">
                <a href="subCategory.php" class="nav-link">
                  <i class="far fa-regular fa-eye"></i>
                  <p>Ver SubCategoría</p>
                </a>
              </li>
              
              
              <li class="nav-item <?php if ($currentPage == 'category.php') { echo 'active'; } ?>">
                <a href="category-add.php" class="nav-link">
                  <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" fill="#c2c7d0"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg>
                  <p>Añadir Categoría</p>
                </a>
              </li>
              <li class="nav-item <?php if ($currentPage == 'subCategory.php') { echo 'active'; } ?>">
                <a href="subCategory-add.php" class="nav-link">
                  <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" fill="#c2c7d0"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg>
                  <p>Añadir SubCategoría</p>
                </a>
              </li>
              
              
            </ul>
          </li>
                </a>
              </li>
           
          </li>
        
          <li class="nav-header">CLIENTES</li>
          <li class="nav-item">
            <a href="users.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              
              <p>
                Clientes 
              </p>
            </a>
          </li>
         
          
        
          
          <li class="nav-item">
            <a href="#" class="nav-link <?php if ($currentPage == 'mail.php') { echo 'active'; } ?>">
              <i class="nav-icon far fa-regular fa-folder-open"></i>
              <p>
                PEDIDOS
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item <?php if ($currentPage == 'orders.php') { echo 'active'; } ?>">
                <a href="orders.php" class="nav-link">
                  <i class="fas fa-solid fa-clipboard-list"></i>
                  <p>TODOS LOS PEDIDOS</p>
                </a>
              </li>
              <li class="nav-item <?php if ($currentPage == 'send.php') { echo 'active'; } ?>">
                <a href="validate.php" class="nav-link">
                  <i class="fas fa-solid fa-check text-warning"></i>
                  <p>PEDIDOS RECIBIDOS</p>
                </a>
              </li>
				<li class="nav-item <?php if ($currentPage == 'send.php') { echo 'active'; } ?>">
                <a href="send.php" class="nav-link">
                  <i class="fas fa-solid fa-plane text-success"></i>
                  <p>PEDIDOS ENVIADOS</p>
                </a>
              </li>
              <li class="nav-item <?php if ($currentPage == 'send.php') { echo 'active'; } ?>">
                <a href="delivered.php" class="nav-link">
                  <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" fill="#17a2b8"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M448 160H320V128H448v32zM48 64C21.5 64 0 85.5 0 112v64c0 26.5 21.5 48 48 48H464c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48H48zM448 352v32H192V352H448zM48 288c-26.5 0-48 21.5-48 48v64c0 26.5 21.5 48 48 48H464c26.5 0 48-21.5 48-48V336c0-26.5-21.5-48-48-48H48z"/></svg>
                  <p>PEDIDOS ENTREGADOS</p>
                </a>
              </li>
            </ul>
          </li>
        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>