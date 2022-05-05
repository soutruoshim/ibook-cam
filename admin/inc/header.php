<?php
    // session_start();
    // if (!isset($_SESSION['id']) && !isset($_SESSION['email'])) {
    //      header("Location: ../index.php");
    // }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Ebook</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="../libs/main.css" rel="stylesheet">
    
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body>
    <?php
      $active = $_SERVER['REQUEST_URI'];
    ?>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>    <div class="app-header__content">
                <div class="app-header-left">
                    <div class="search-wrapper">
                        <div class="input-holder">
                            <input type="text" class="search-input" placeholder="Type to search">
                            <button class="search-icon"><span></span></button>
                        </div>
                        <button class="close"></button>
                    </div>
                </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                            <img width="42" class="rounded-circle" src="assets/images/avatars/1.jpg" alt="">
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                            <a href="../admin/edit_user.php?id=<?= $_SESSION['id'] ?>" type="button" tabindex="0" class="dropdown-item">User Account</a>
                                            <a href="../config/logout.php" type="button" tabindex="0" class="dropdown-item">Logout</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        <?= isset($_SESSION['name'])? strtoupper($_SESSION['name']):'' ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>        </div>
            </div>
        </div>        
             
        <div class="app-main">
                <div class="app-sidebar sidebar-shadow">
                    <div class="app-header__logo">
                        <div class="logo-src"></div>
                        <div class="header__pane ml-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="app-header__mobile-menu">
                        <div>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="app-header__menu">
                        <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
                    </div>    <div class="scrollbar-sidebar">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                        
                                <li class="app-sidebar__heading">Dashboards</li>
                                <li>
                                    <a href="../index.php" class="<?= $active == '/ibook-cambodia/admin/dashboard/dashboard.php'?'mm-active':''?>">
                                        <i class="metismenu-icon pe-7s-rocket"></i>
                                        Dashboard
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Libraries</li>
                                <li>
                                    <a href="../slide/slides.php" class="<?= $active == '/ibook-cambodia/admin/slide/slides.php'?'mm-active':''?>">
                                        <i class="metismenu-icon pe-7s-photo"></i>
                                        Slide
                                    </a>
                                </li>
                                <li class="app-sidebar__heading"></li>
                                <li>
                                    <a href="../category/categories.php" class="<?= $active == '/ibook-cambodia/admin/category/categories.php'?'mm-active':''?>">
                                        <i class="metismenu-icon pe-7s-note2"></i>
                                        Categories
                                    </a>
                                </li>
                                <li class="app-sidebar__heading"></li>
                                <li>
                                    <a href="../author/authors.php" class="<?= $active == '/ibook-cambodia/admin/author/authors.php'?'mm-active':''?>">
                                        <i class="metismenu-icon pe-7s-study"></i>
                                        Authors
                                    </a>
                                </li>
                                <li class="app-sidebar__heading"></li>
                                <li>
                                    <a href="../publisher/publishers.php" class="<?= $active == '/ibook-cambodia/admin/publisher/publishers.php'?'mm-active':''?>">
                                        <i class="metismenu-icon pe-7s-compass"></i>
                                        Publishers
                                    </a>
                                </li>
                                <li class="app-sidebar__heading"></li>
                                <li>
                                    <a href="../ebook/ebook.php" class="<?= $active == '/ebook-php/admin/ebook/ebook.php'?'mm-active':''?>">
                                        <i class="metismenu-icon pe-7s-notebook"></i>
                                        E-books
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Users</li>
                                <li>
                                    <a href="../user/user.php" class="<?= $active == '/ebook-php/admin/user/user.php'?'mm-active':''?>">
                                        <i class="metismenu-icon pe-7s-users"></i>
                                        Users
                                    </a>
                                </li>
                            
                            </ul>
                        </div>
                    </div>
                </div>    <div class="app-main__outer">
                    <div class="app-main__inner">