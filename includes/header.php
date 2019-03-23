<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
        <title>XSS EXAMPLE</title>
        <link href="<?=$DOMAIN_HOME?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?=$DOMAIN_HOME?>/assets/fontawesome/css/all.min.css" rel="stylesheet">
        <link href="<?=$DOMAIN_HOME?>/assets/css/normalize.css" rel="stylesheet">
        <link href="<?=$DOMAIN_HOME?>/assets/css/sweet-alert.css" rel="stylesheet">
        <script src="<?=$DOMAIN_HOME?>/assets/js/sweetalert2.all.min.js"></script>
        <link href="<?=$DOMAIN_HOME?>/assets/css/xss-example.css" rel="stylesheet">
        <script src="<?=$DOMAIN_HOME?>/assets/js/jquery.min.js"></script>
        <script>
        var baseURL = '<?=$DOMAIN_HOME?>';
        </script>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-inverse navbar-custom navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?=$DOMAIN_HOME?>">XSS EXAMPLE</a>
                </div>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav navbar-right">
<?php
if($id_user) {
?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$data_user['USERNAME']?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
<?php
    if ($permission == 1) {
?>
                                <li><a href="<?=$DOMAIN_HOME?>/setting">Cài đặt</a></li>
                                <li><a href="<?=$DOMAIN_HOME?>/control-panel">Bảng quản trị</a></li>
<?php } ?>
                                <li><a href="<?=$DOMAIN_HOME?>/logout/">Đăng xuất</a></li>
                            </ul>
                        </li>
<?php
}
else {
?>
                        <li><a href="<?=$DOMAIN_HOME?>/login/">Đăng nhập</a></li>
                        <li><a href="<?=$DOMAIN_HOME?>/register/">Đăng ký</a></li>
<?php
}
?>
                    </ul>
                </div>
            </div>
        </nav>