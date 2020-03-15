<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url() . 'assets/css/general/navbar.css' ?>">
        <link rel="stylesheet" href="<?= base_url() . 'assets/css/general/jquery.loadingModal.css' ?>">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?= base_url()?>assets/js/jquery.loadingModal.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
            <div class="container">
                <a class="navbar-brand" href="<?= base_url().'catalogue' ?>">
                    <img src="<?= base_url() . '/assets/imgs/general/logo.png' ?>" alt="" class = "img-fluid">
                </a>
                <?php if ($this->session->userdata('logged_in') == 'true') { ?>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url().'catalogue' ?>">Catalogue</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url().'my_ratings' ?>">My Ratings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url().'userprofile' ?>">
                            <?= $this->session->userdata('name') ?></a>
                        </li>
                        <li class="nav-item" id="nav_profileImg">
                            <img src="<?= base_url() . 'assets/imgs/users/' . $this->session->userdata('imgName') ?>" alt="" 
                                class = "rounded-circle" width="40" height="40">
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-danger" href="<?= base_url().'login/logout' ?>">Logout</a>
                        </li>
                    </ul>
                </div>
                <?php 
                } else { ?>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="btn btn-primary" href="<?= base_url().'login' ?>">Login</a>
                        </li>
                    </ul>
                </div>
                <?php } ?>
            </div>
        </nav>
        <div class="container">