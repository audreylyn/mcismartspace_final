<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MCiSmartSpace</title>

    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

    <!-- Bootstrap -->
    <link href="./vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="./vendors/fontawesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="./vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet" />

    <!-- Custom Theme Style -->
    <link href="./vendors/my-css/custom.css" rel="stylesheet">
    <link href="./vendors/my-css/custom2.css" rel="stylesheet">

</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col menu_fixed">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <div class="logo-container">
                            <a href="#" class="site-branding">
                                <img class="meyclogo" src="./logo.webp" alt="meyclogo">
                                <span class="title-text">MCiSmartSpace</span>
                            </a>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <ul class="nav side-menu" class="navbar nav_title" style="border: 0;">
                                <li class="active">
                                    <a href="tc_browse_room.php">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-building2 flex-shrink-0" data-lov-id="src/components/layout/Sidebar.tsx:89:20" data-lov-name="Icon" data-component-path="src/components/layout/Sidebar.tsx" data-component-line="89" data-component-file="Sidebar.tsx" data-component-name="Icon" data-component-content="%7B%22className%22%3A%22flex-shrink-0%22%7D">
                                                <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
                                                <path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"></path>
                                                <path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"></path>
                                                <path d="M10 6h4"></path>
                                                <path d="M10 10h4"></path>
                                                <path d="M10 14h4"></path>
                                                <path d="M10 18h4"></path>
                                            </svg>
                                        </div>
                                        <div class="menu-text">
                                            <span>Browse Room</span>
                                            <span class="fa fa-chevron-down" style="opacity: 0;"></span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="tc_room_status.php">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24" height="24" stroke-width="2">
                                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                                <path d="M8 14h3"></path>
                                                <path d="M14 14h3"></path>
                                                <path d="M8 18h3"></path>
                                                <path d="M14 18h3"></path>
                                            </svg>
                                        </div>
                                        <div class="menu-text">
                                            <span>Reservation Status</span>
                                            <span class="fa fa-chevron-down" style="opacity: 0;"></span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="tc_reservation_history.php">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M12 8v4l3 3"></path>
                                                <circle cx="12" cy="12" r="10"></circle>
                                            </svg>
                                        </div>
                                        <div class="menu-text">
                                            <span>Reservation History</span>
                                            <span class="fa fa-chevron-down" style="opacity: 0;"></span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="equipment_report_status.php">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                                            </svg>
                                        </div>
                                        <div class="menu-text">
                                            <span>Equipment Reports</span>
                                            <span class="fa fa-chevron-down" style="opacity: 0;"></span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->
                </div>
            </div>

            <?php include "./partials/topnav.php"; ?>
            <!-- Page content -->
            <div class="right_col" role="main">
                <div>
                    <div class="row">
                        <div class="col-md-12">

                        </div>
                    </div>
                </div>
            </div>



            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    Meycauayan College Incorporated - <a href="#">Mission || Vision || Values</a>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->


            <!-- Include jQuery first if not already included earlier -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <!-- jQuery -->
            <script src="./vendors/jquery/dist/jquery.min.js"></script>
            <!-- Bootstrap -->
            <script src="./vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
            <!-- FastClick -->
            <script src="./vendors/fastclick/lib/fastclick.js"></script>
            <!-- jQuery custom content scroller -->
            <script src="./vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
            <!-- Custom Theme Scripts -->
            <script src="./vendors/my-css/custom.js"></script>
</body>

</html>t>