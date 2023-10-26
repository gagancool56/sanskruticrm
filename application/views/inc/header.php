<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?= business_info('buname') ?></title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= asset_url('imgs/theme/favicon.svg', 'assets/admin/') ?> " />
    <!-- Datatables CSS -->
    <link rel="stylesheet" href="<?= asset_url('datatables.css', 'assets/admin/datatables/') ?>">
    <link rel="stylesheet" href="<?= asset_url('buttons.dataTables.min.css', 'assets/admin/datatables/') ?>">
    <!-- Template CSS -->
    <link href="<?= asset_url('css/main.css?v=1.1', 'assets/admin/') ?>" rel="stylesheet" type="text/css" />
    <!-- summernote -->
    <link rel="stylesheet" href="<?= asset_url('plugins/summernote/summernote-lite.min.css', 'assets/admin/') ?>">
    <link rel="stylesheet" href="<?= asset_url('custom.css') ?>">

    <!-- date picker CSS -->
    <link rel="stylesheet" href="<?= asset_url('datepicker.css', 'assets/admin/datepicker/') ?>">

</head>

<body class="<?= $this->session->userdata('menu_collapsed') ? 'aside-mini' : '' ?>">
    <div class="screen-overlay"></div>
    <!-- Sidenavbar  START -->
    <?php $this->load->vpage('nav'); ?>
    <!-- Sidenavbar  END -->
    <main class="main-wrap">
        <header class="main-header navbar">
            <div class="col-search">
                <form class="searchform">
                    <div class="input-group">
                        <input list="search_terms" type="text" class="form-control" placeholder="Search term" />
                        <button class="btn btn-light bg" type="button"><i class="material-icons md-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="col-nav">
                <button class="btn btn-icon btn-mobile me-auto" data-trigger="#offcanvas_aside"><i class="material-icons md-apps"></i></button>
                <p>Welcome back, <b><?= @$this->users_auth->USERDISPLAYNAME ?></b>!</p>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link btn-icon" href="#">
                            <i class="material-icons md-notifications animation-shake"></i>
                            <span class="badge rounded-pill">3</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn-icon darkmode" href="#"> <i class="material-icons md-nights_stay"></i> </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="requestfullscreen nav-link btn-icon"><i class="material-icons md-cast"></i></a>
                    </li>
                    <li class="dropdown nav-item">
                        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownAccount" aria-expanded="false"> <img class="img-xs rounded-circle" src="<?= asset_url('imgs/people/avatar-2.png', 'assets/admin/') ?>" alt="User" /></a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAccount">
                            <a class="dropdown-item" href="#"><i class="material-icons md-perm_identity"></i>Edit Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="<?= base_url('logout'); ?>"><i class="material-icons md-exit_to_app"></i>Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </header>

        <!-- Lookup  START -->
        <?php $this->load->view('lookup/lookup'); ?>
        <!-- Lookup  END -->