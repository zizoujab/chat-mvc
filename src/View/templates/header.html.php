<!doctype html>
<html class="no-js" lang="" style="height: 100%">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/chat.css">
    <script src="js/jquery-3.2.1.min.js"></script>


</head>
<body style="height: 100%">
<?php if (isset($_SESSION['user'])): ?>
<div class="row">
    <div class="col-lg-2"> <?php if (isset($_SESSION['user'])) echo $_SESSION['user']->getUsername() ?> </div>
    <div class="col-lg-8"></div>
    <div class="col-lg-2">  <a href="/logout" > logout </a> </div>
</div>
<?php endif ?>

