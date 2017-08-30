<!DOCTYPE HTML>
<html>
<head lang="en-US">
    <meta charset="UTF-8">
    <title>Inventory</title>
    <link rel="stylesheet" href="<?php  echo base_url(); ?>font-awesome/css/font-awesome.css" type="text/css">
    <link rel="stylesheet" href="<?php  echo base_url(); ?>assets/bootstrap/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="<?php  echo base_url(); ?>assets/css/dataTables.bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<?php  echo base_url(); ?>assets/css/style1.css" type="text/css">
    <link rel="stylesheet" href="<?php  echo base_url(); ?>assets/css/style.css" type="text/css">
    <script src="<?= base_url() ?>assets/js/jquery/dist/jquery.min.js"></script>

</head>
<body>
<div id="navigation">
    <ul>
        <li><a href="<?= base_url()?>homepage">Home</a></li>
        <li><a href="<?= base_url()?>add_new_user">Add User</a></li>
        <li><a href="<?= base_url()?>product_list">Product List</a></li>
        <li><a href="<?= base_url()?>sales_form">Sell Products</a></li>
        <li><a href="<?= base_url()?>logout">Logout</a></li>
    </ul>
</div>
<div id="introduction">
    <p style="float:left">Inventory Management System:<?php /* echo " " .strtoUpper($result);  */?></p>
    <p id="date" style="float:right"></p>
</div>
