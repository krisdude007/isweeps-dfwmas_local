<?php
// page specific css
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/jquery.gritter.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/chosen.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/jquery.tagsinput.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/bootstrap-toggle-buttons.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/DT_bootstrap.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/jquery-ui-1.10.0.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/_faq.css');

// page specific js
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jquery.blockui.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/app.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/_faq.js', CClientScript::POS_END);
?>

<!-- BEGIN PAGE -->
<div class="fab-page-content">
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
    <div id="fab-top">
        <h2 style="color: rgb(4, 4, 4);" class="fab-title"><img class="floatLeft marginRight10" style="margin-top:5px;" src="<?php echo Yii::app()->request->baseUrl; ?>/core/webassets/images/support-center-image.png">Frequently Asked Questions</h2>
    </div>
    <!-- END PAGE TITLE & BREADCRUMB-->
    <!-- BEGIN PAGE CONTAINER-->
    <div style="max-width: 1000px">
        <div class="fab-container-fluid">
            <!-- END PAGE HEADER-->
            <div class="fab-clear"></div>
        </div>
    </div>
    <!-- END PAGE CONTAINER-->
</div>
<!-- END PAGE -->
