<?php
/**
 * Created by PhpStorm.
 * User: ONEST
 * Date: 9/15/2016
 * Time: 9:54 AM
 */?>

<!DOCTYPE HTML>
<html>
    <head lang="en-US">
        <meta charset="UTF-8">
        <title>Form</title>
        <link rel="stylesheet" href="<?php  echo base_url(); ?>assets/css/style.css" type="text/css">
        <link rel="stylesheet" href="<?php  echo base_url(); ?>assets/css/style1.css" type="text/css">
        <link rel="stylesheet" href="<?php  echo base_url(); ?>assets/font-awesome/css/font-awesome.css" type="text/css">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="<?php  echo base_url(); ?>assets/css/dataTables.bootstrap.min.css" type="text/css">

    </head>
    <body id="login_body">
    <div class="row">
        <div class="navbar top_nav"></div>
    </div>

    <div class="row brand-contents">
        <span><img src="assets/images/logo2.png" class="img-responsive img-thumbnail img-circle" style="height: 13vh"></span>
        <p>PHARMACY-IMS</p>
    </div>

    <div>
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form action="login" method="post">
                        <h1>Please Login</h1>
                        <div>
                            <span ><?= form_error('username');  ?></span>
                            <input type="text" class="form-control" name="username" placeholder="Username" value="<?=  set_value('username')  ?>"/>
                        </div>
                        <div>
                            <span><?= form_error('password');  ?></span>
                            <input type="password" class="form-control" placeholder="Password" name="password"/>
                        </div>
                        <div>
                            <input type="submit" class="btn btn-default submit" value="Login">
                        </div>
                        <div id="error" style="color:black;text-align: center"><?= $status; ?></div>
                        <div class="clearfix"></div>
                    </form>
                </section>
            </div>
        </div>
    </div>





    <div id="footer">
            <p>&copy <?= date('Y'). "  ";  ?>iPF-Softwares</p>
        </div>
    <script src="<?= base_url() ?>assets/js/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets/js/dataTables.bootstrap.min.js"></script>

    </body>

</html>
