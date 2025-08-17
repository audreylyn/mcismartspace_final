<?php $current_page = basename($_SERVER['PHP_SELF']); ?>
<aside class="col-md-3 left_col menu_fixed">
    <div class="left_col scroll-view">
        <header class="navbar nav_title" style="border: 0;">
            <div class="logo-container">
                <a href="#" class="site-branding" aria-label="MCiSmartSpace Home">
                    <img class="meyclogo" src="../assets/images/logo.webp" alt="MCiSmartSpace Logo" width="40" height="40">
                    <span class="title-text">MCiSmartSpace</span>
                </a>
            </div>
        </header>

        <div class="clearfix"></div>

        <br />

        <!-- sidebar menu -->
        <nav id="sidebar-menu" class="main_menu_side hidden-print main_menu" role="navigation" aria-label="Main Navigation">
            <section class="menu_section">
                <ul class="nav side-menu">
                    <li class="<?php echo ($current_page == 'manage_admins.php') ? 'active' : ''; ?>">
                        <a href="./manage_admins.php" aria-label="Manage Administrators">
                            <div class="icon" aria-hidden="true">
                                <span class="mdi mdi-account-supervisor mdi-24px"></span>
                            </div>
                            <div class="menu-text">
                                <span>Manage Admins</span>
                                <span class="fa fa-chevron-down" style="opacity: 0;" aria-hidden="true"></span>
                            </div>
                        </a>
                    </li>
                    <li class="<?php echo ($current_page == 'buildings.php') ? 'active' : ''; ?>">
                        <a href="./buildings.php" aria-label="Manage Buildings">
                            <div class="icon" aria-hidden="true">
                                <i class="mdi mdi-office-building mdi-24px"></i>
                            </div>
                            <div class="menu-text">
                                <span>Buildings</span>
                                <span class="fa fa-chevron-down" style="opacity: 0;" aria-hidden="true"></span>
                            </div>
                        </a>
                    </li>
                    <li class="<?php echo ($current_page == 'manage_facilities.php') ? 'active' : ''; ?>">
                        <a href="./manage_facilities.php" aria-label="Manage Facilities">
                            <div class="icon" aria-hidden="true">
                                <i class="mdi mdi-office-building mdi-24px"></i>
                            </div>
                            <div class="menu-text">
                                <span>Manage Facilities</span>
                                <span class="fa fa-chevron-down" style="opacity: 0;" aria-hidden="true"></span>
                            </div>
                        </a>
                    </li>
                    <li class="<?php echo ($current_page == 'manage_equipments.php') ? 'active' : ''; ?>">
                        <a href="./manage_equipments.php" aria-label="Manage Equipment">
                            <div class="icon" aria-hidden="true">
                                <i class="mdi mdi-tools mdi-24px"></i>
                            </div>
                            <div class="menu-text">
                                <span>Manage Equipments</span>
                                <span class="fa fa-chevron-down" style="opacity: 0;" aria-hidden="true"></span>
                            </div>
                        </a>
                    </li>
                </ul>
            </section>
        </nav>
        <!-- /sidebar menu -->
    </div>
</aside>
