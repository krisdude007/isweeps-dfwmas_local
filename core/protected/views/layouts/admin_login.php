<?php
$cs = Yii::app()->clientScript;
$cs->registerCoreScript('jquery');
$cs->registerCssFile('/core/webassets/css/_flashes.css');
?>
<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html> <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8"/>
        <title>Youtoo technology</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>

        <!-- CSS Styles -->
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/core/webassets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/core/webassets/css/metro.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/core/webassets/css/style.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/core/webassets/css/font-awesome.css">

        <style type="text/css">
            .fab-container {
                width          : 100%;
                height         : 100%;
                padding        : 0;
                vertical-align : middle;
                margin         : 0;
            }

            .fab-left {
                float : left;
            }

            .fab-right {
                float : right;
            }

            .fab-clear {
                clear : both;
            }

            .fab-login-content {
                background-color : #ffffff;
                width            : 350px;
                height           : 510px;
                padding          : 0;
                position         : absolute;
                left             : 50%;
                margin-left      : -175px;
                top              : 50%;
                margin-top       : -275px;
            }

            .fab-login-content .fab-login-logo {
                padding-top : 35px;
                text-align  : center;
            }

            .fab-login-content .fab-title {
                font-size    : 24.5px;
                padding-left : 32px;
                padding-top  : 27px;
                line-height  : 32px;
            }

            .fab-login-content .fab-forms {
                padding-top : 29px;
            }

            .fab-login-content .fab-controls {
                padding-left : 32px;
            }

            .fab-login-content .fab-forgot-password {
                font-family  : "Segoe UI", Helvetica, Arial, sans-serif;
                font-size    : 17.5px;
                color        : #555555;
                line-height  : 32px;
                padding-left : 32px;
            }

            .fab-login-content .fab-create-account {
                font-family  : "Segoe UI", Helvetica, Arial, sans-serif;
                font-size    : 13px;
                color        : #555555;
                line-height  : 28px;
                padding-left : 32px;
            }

            /*footer*/
            #fab-footer {
                background : url('<?php echo Yii::app()->request->baseUrl; ?>/core/webassets/images/nav-footer.png') repeat-x;
                width      : 100%;
                height     : 76px;
                position   : absolute;
                bottom     : 0;
            }

            #fab-footer-logo {
                padding-top  : 25px;
                padding-left : 34px;
            }

            #fab-footer-nav {
                margin-right : 40px;
                margin-top   : 30px;
                list-style   : none;
            }

            #fab-footer-nav li {
                float          : left;
                padding-left   : 20px;
                text-transform : uppercase;
            }

            #fab-footer-nav li a {
                color           : #666666;
                text-decoration : none;
                font-weight     : bold;
            }

            .fab-login {
                background-color : #444 !important;
            }

            .fab-login .content h3 {
                color : #000;
            }

            .fab-login .content h4 {
                color : #555;
            }

            .fab-login .content p {
                color : #222;
            }

            .fab-login .content .fab-create-account {
                border-top  : 1px dotted #eee;
                padding-top : 10px;
                margin-top  : 15px;
            }

            .fab-login .content .fab-create-account a {
                display    : inline-block;
                margin-top : 5px;
            }

            .fab-login {
                background-color : #444 !important;
            }

            .fab-login .content h3 {
                color : #000;
            }

            .fab-login .content h4 {
                color : #555;
            }

            .fab-login .content p {
                color : #222;
            }

            .fab-login .content .fab-create-account {
                border-top  : 1px dotted #eee;
                padding-top : 10px;
                margin-top  : 15px;
            }

            .fab-login .content .fab-create-account a {
                display    : inline-block;
                margin-top : 5px;
            }
        </style>
    </head>
    <body class="fab-login">
<?php if (Yii::app()->user->hasFlash('error')): ?>
  <div class="alert alert-error" style="margin-bottom: 0px;">
    <button type="button" class="close" data-dismiss="alert"></button>
    <strong>Error:</strong> <?php echo Yii::app()->user->getFlash('error'); ?>
  </div>
<?php endif; ?>

<?php if (Yii::app()->user->hasFlash('success')): ?>
  <div class="alert alert-success" style="margin-bottom: 0px;">
    <button type="button" class="close" data-dismiss="alert"></button>
    <strong>Success:</strong> <?php echo trim(Yii::app()->user->getFlash('success')); ?>
  </div>
<?php endif; ?>

<?php if (Yii::app()->user->hasFlash('info')): ?>
  <div class="alert alert-info" style="margin-bottom: 0px;">
    <button type="button" class="close" data-dismiss="alert"></button>
    <strong>Info:</strong> <?php echo Yii::app()->user->getFlash('info'); ?>
  </div>
<?php endif; ?>

<?php if (Yii::app()->user->hasFlash('warning')): ?>
  <div class="alert" style="margin-bottom: 0px;">
    <button type="button" class="close" data-dismiss="alert"></button>
    <strong>Warning:</strong> <?php echo Yii::app()->user->getFlash('warning'); ?>
  </div>
<?php endif; ?>
        <div class="fab-container">

            <?php echo $content;?>


            <!--start footer -->
            <div id="fab-footer">
                <div id="fab-footer-logo" class="fab-left">
                    <a href="#" title="Youtoo"><img src="<?php echo Yii::app()->request->baseUrl; ?>/core/webassets/images/footer-logo.png" alt="Youtoo"></a>
                </div>
                <div class="fab-right">
                    <ul id="fab-footer-nav">
                        <li><a href="#">home</a></li>
                        <li><a href="#">about us</a></li>
                        <li><a href="#">faq</a></li>
                        <li><a href="#">policy</a></li>
                        <li><a href="#">contact us</a></li>
                        <li><a href="#">site map</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--end footer -->
        <!--</div>-->
    </body>
</html>
