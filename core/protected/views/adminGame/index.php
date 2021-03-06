
<?php
$cs = Yii::app()->clientScript;

$cs->registerScriptFile('/core/webassets/js/adminQuestion/index.js', CClientScript::POS_END);
$cs->registerCssFile('/core/webassets/css/adminQuestion/index.css');
$cs->registerCssFile('/core/webassets/css/adminGame/index.css');
$cs->registerScriptFile('/core/webassets/js/jquery.dataTables.min.js', CClientScript::POS_END);

$cs->registerCssFile('/core/webassets/css/jquery.dataTables_themeroller.css');
$this->renderPartial('/admin/_csrfToken');
?>

<style type="text/css">

</style>

<div class="fab-page-content">
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->

            <?php $this->renderPartial('/admin/_flashMessages', array()); ?>

    <div id="fab-top">
        <h2 class="fab-title">
            <img class="floatLeft" style="margin-right: 10px;" src="<?php echo Yii::app()->request->baseUrl; ?>/core/webassets/images/dashboard-icon.png"/>
            <div class="floatLeft">Game Editor </div>
        </h2>
    </div>
    <!-- END PAGE TITLE & BREADCRUMB-->
    <!-- BEGIN PAGE CONTAINER-->
    <div class="fab-container-fluid">
        <!-- BEGIN PAGE HEADER-->

        <!-- END PAGE HEADER-->
        <div id="fab-dashboard">
            <div style="padding:0px 20px 0px 20px; color: #000;">
                <div>
                    <?php if (in_array('HAS_GAME_MULTIPLE_CHOICE', Yii::app()->params['features'])): ?>
                        <div><a href="/admin/gamechoice/multiple" style="color: #000;">Game: Multiple Choice</a></div>
                    <?php endif; ?>

                    <?php if (in_array('HAS_GAME_HOT_OR_NOT', Yii::app()->params['features'])): ?>
                        <div><a href="/admin/gamechoice/hotornot" style="color: #000;">Game: Hot Or Not</a></div>
                    <?php endif; ?>

                    <?php if (in_array('HAS_GAME_CELEBRITY_REVEAL', Yii::app()->params['features'])): ?>
                        <div><a href="/admin/gamereveal" style="color: #000;">Game: Celebrity Reveal</a></div>
                    <?php endif; ?>
                </div>
            </div>


            <?php if (1): ?>
            <hr>
            <div style="padding:0px 20px 0px 20px; color: #000;">
                <div>
                    <div><a href="<?php echo $this->createUrl('adminGame/processtwittervotes'); ?>" style="color: #000;">Twitter: Process Votes</a></div>
                </div>
            </div>


                <?php if (isset($gamingAccountMentions) && is_array($gamingAccountMentions)): ?>
                    <hr>
                    <div style="padding:0px 20px 0px 20px; color: #000;">
                        <?php //print_r($gamingAccountMentions);?>
                        <div>
                            <?php if (count($gamingAccountMentions > 0)): ?>
                                <?php foreach ($gamingAccountMentions as $mention): ?>
                                    <div>
                                        <?php //echo print_r($mention);?>
                                        ID: <?php echo $mention->id; ?><br>
                                        TW UserID: <?php echo $mention->user->id; ?><br>
                                        Twitter Handle: <?php echo $mention->user->screen_name; ?><br>
                                        Mention: <?php echo $mention->text; ?><br>
                                        <hr>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div>Nothing to process. All up-to-date.</div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
    <!-- END PAGE CONTAINER-->
</div>
<?php $this->renderPartial('/adminQuestion/_linksOverlay'); ?>