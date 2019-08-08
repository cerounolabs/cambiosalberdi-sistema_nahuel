    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="#" style="width:100%; height:100%; border-radius:0%; padding:5px;" alt="profile"><img src="../images/logo/logo_menu.png" alt="logo" style="width:100%; height:100%; border-radius:0%;" alt="profile"/></a>
            <a class="navbar-brand brand-logo-mini" href="#" style="width:100%; height:100%; border-radius:0%; padding:5px;" alt="profile"><img src="../images/logo/logo_menu.png" alt="logo" style="width:100%; height:100%; border-radius:0%;" alt="profile"/></a>
        </div>

        <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <div class="search-field d-none d-md-block">
                <p style="font-size:2.5rem !important; font-weight:bold; margin:0px; padding:5px;">SISTEMA NAHUEL <span style="font-size:1rem !important;">v1.2<span></p>
            </div>
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                        <div class="nav-profile-img">
                            <img src="../images/favicon.png" alt="image">
                            <span class="availability-status online"></span>             
                        </div>
                        <div class="nav-profile-text">
                            <p class="mb-1 text-black"> MENU </p>
                        </div>
                    </a>
                    <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
<?php
    $result = getTablero();

    foreach($result as $data) {
        if ($data['estado_codigo'] == 'A') {
?>
                        <a class="dropdown-item" href="../pages/pizarra.php?var00=<?php echo $data['tablero_codigo']; ?>">
                            <i class="mdi mdi-cached mr-2 text-success"></i>
                            <?php echo $data['tablero_nombre']; ?>
                        </a>
                        <div class="dropdown-divider"></div>
<?php
        }
    }
?>
                    </div>
                </li>
            </ul>

            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>