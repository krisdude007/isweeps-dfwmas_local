<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jquery.countdown.min.js', CClientScript::POS_END);

//$geoLocation = GeoUtility::GeoLocation();
?>
<div id="pageContainer" class="container" style="padding-left: 0px; padding-right: 0px; background-color: #303030;"><?php //if(isset($_GET['f'])){ echo $_GET['f']; } exit;  ?>
    <div class="subContainer" style="padding: 0px;">
        <?php $this->renderPartial('_sideBar', array()); ?>

        <?php
        $currentMultipleChoiceGame = GameUtility::getCurrentMultipleChoiceGame($games);
        $currentWinLooseOrDrawGame = GameUtility::getCurrentWinLooseOrDrawGame($games);

        $env = getenv('YOUTOO_ENVIRONMENT');
        if ($env == 'aws-development') {
            $url = $currentMultipleChoiceGame['url'];
        } else {
            $url = '/winlooseordraw/157';
        }
        ?>

        <?php if (Yii::app()->user->isGuest): ?>
            <a href="<?php echo $url; ?>"><img src="/webassets/images/laliga/Image_Hero_Azteca-Concursos<?php echo (Yii::app()->language == 'en') ? '_eng' : ''; ?>.png" style="position: relative; top: -28px; max-width: 102.6%; left: -7px;"/>
            </a>
            <a href="/marketingpage"><span style="position: absolute; top: 254px;right: 160px; color: #ffffff;"><?php echo Yii::t('youtoo','You want to know more?'); ?>&nbsp;&nbsp;&nbsp;<img src="/webassets/images/laliga/Button_Yellow-Arrow.png"/></span></a>
            <div style="position: relative; top: -17px;">
                <span><a href=<?php echo $url; ?>><img src="/webassets/images/laliga/Image_Banner_Juega-Ahora-Por-1<?php echo (Yii::app()->language == 'en') ? '_eng' : ''; ?>.png" style="padding-right: 0px;max-width: 398px; width:100%;"/></a></span>
                <span><a href="<?php echo $currentWinLooseOrDrawGame['url']; ?>"><img src="/webassets/images/laliga/Image_Banner_Viernes-Futbolero.png" style="padding-right: 8px;max-width: 398px; width:100%; margin-left: 9px;"/></a></span>
    <!--                <span><a href="/redeem"><img src="/webassets/images/laliga/image_redeem-points<?php echo (Yii::app()->language == 'en') ? '_eng' : ''; ?>.png" style="max-width: 249px; width:100%;"/></a></span>-->
            </div>
        <?php else: ?>
            <?php if (isset($_GET['f']) && $_GET['f'] == 'g'): ?>
                <div class='col-sm-12' style='padding-left: 12px; padding-right: 10px; clear: both;'>
                    <img src="/webassets/images/laliga/image_congrats<?php echo (Yii::app()->language == 'en') ? '_eng' : ''; ?>.png" style=" max-width: 100%; margin-bottom: 10px;"/>
                </div>
            <?php elseif (isset($_GET['f']) && $_GET['f'] == 'p'): ?>
                <div style="background-color: #f7f9fa; min-height: 235px; width: 97.4%; margin: 20px auto; padding-top: 1px;margin-left: 12px; margin-right: 10px;">
                    <h1 style="font-weight: 300; margin-bottom: 15px;"><?php echo Yii::t('youtoo', 'SUCCESS!!'); ?></h1>
                    <h4 style="margin-bottom: 10px; line-height: 2;"><?php
                        echo Yii::t('youtoo', "Your payment was processed successfully, and your funds have been<br/> deposited in your account.");
                        ?>
                    </h4>
                    <?php echo Yii::t('youtoo', 'If you have any questions, please click'); ?> <a href="<?php echo $this->createUrl('/site/faq', array()); ?>" style="color: #ea8417;"><?php echo Yii::t('youtoo', 'FAQ'); ?></a> <?php echo Yii::t('youtoo', 'and'); ?> <a href="#" data-toggle='modal' data-target ='#modalRules' style="color: #ea8417;"><?php echo Yii::t('youtoo', 'Rules'); ?></a> <?php echo Yii::t('youtoo', 'to learn how to play.'); ?>
                    <br/><br/> <?php echo Yii::t('youtoo', 'Good luck and have fun.'); ?>
                </div>
            <?php else: ?>
                <a href="<?php echo $url; ?>"><img src="/webassets/images/laliga/Image_Hero_Azteca-Concursos<?php echo (Yii::app()->language == 'en') ? '_eng' : ''; ?>.png" style="position: relative; top: -28px; max-width: 102.6%; left: -7px;"/>
                </a>
                <a href="/marketingpage"><span style="position: absolute; top: 254px;right: 160px; color: #ffffff;"><?php echo Yii::t('youtoo','You want to know more?'); ?>&nbsp;&nbsp;&nbsp;<img src="/webassets/images/laliga/Button_Yellow-Arrow.png"/></span></a>
                <div style="float: left; margin-left: 12px;margin-bottom: 10px;">
                    <span><a href="<?php echo $url; ?>"><img src="/webassets/images/laliga/Image_Banner_Juega-Ahora-Por-1<?php echo (Yii::app()->language == 'en') ? '_eng' : ''; ?>.png" style="padding-right: 15px;max-width: 398px; width:100%;"/></a></span>
                    <span><a href="<?php echo $currentWinLooseOrDrawGame['url']; ?>"><img src="/webassets/images/laliga/Image_Banner_Viernes-Futbolero<?php echo (Yii::app()->language == 'en') ? '_eng' : ''; ?>.png" style="padding-right: 13px;max-width: 398px; width:100%;"/></a></span>
                </div>
                <!--                <div style="float: left; margin-left: 12px;margin-bottom: 10px; min-height: 90px; min-width:384px; background-color: #292929;">
                                    <div><?php //echo '<a class="btn btn-default btn-md '.$playFreeButtonStatus.'" style="font-weight: 700; font-size: 15px; min-width: 150px; min-height: 37px; margin-top: 10px;" href="' . $this->createUrl($playFreeButtonURL, array()) . '">' . Yii::t('youtoo', $playFreeButtonMessage) . '</a>';  ?></div>
                                    <div style="padding: 15px; color: #ffffff;"><?php //echo Yii::t('youtoo', '¿Sabes cuál es la palabra del día?');  ?></div>
                                </div>
                                <div style="float: left; margin-left: 18px;margin-bottom: 10px; min-height: 90px; min-width:385px; background-color: #292929;">
                                    <div><?php //echo '<a class="btn btn-default btn-md '.$playButtonStatus.'" style="font-weight: 700; font-size: 15px; min-width: 150px; min-height: 37px; margin-top: 10px;" href="' . $this->createUrl($playButtonURL, array()) . '">' . Yii::t('youtoo', $playButtonMessage) . '</a>';  ?></div>
                                    <div style="padding: 15px; color: #ffffff;"><?php //echo Yii::t('youtoo', 'Ve partidos de Liga MX para ver quien gana');  ?></div>
                                </div>-->
            <?php endif; ?>
        <?php endif; ?>
        <script>
            $(document).ready(function() {
                $("#next-game-ends").countdown("<?php echo date('Y/m/d H:i:s', strtotime($currentWinLooseOrDrawGame['close_date'])); ?>", function(event) {
                    var format = "%H:%M:%S";

                    //if(event.offset.days > 0) {
                    format = '%-D <?php echo (Yii::app()->language == 'en') ? 'day' : 'día'?>%!D ' + format;
                    //}

                    $(this).text(event.strftime(format));
                });
            });
        </script>
        <div id="getting-started"></div>
        <!--        <div style='margin: 0px 0px 0px 15px; background-color: #f9cb3d; max-height: 40px; min-height: 40px; max-width: 800px; clear: both;'>
                    <div class='col-sm-8' style="padding-left: 0px; padding-right: 0px;">
                         </div>
                    <div class='col-sm-2' style='padding: 12px 0px 0px 0px; font-weight: bold; '>
        <?php //echo Yii::t('youtoo','Participate before'); ?></div>
                    <div id="next-game-ends" class='col-sm-2' style="padding: 12px 2px 0px 0px; font-weight: bold;">

                    </div>
                </div>-->
        <div class="col-xs-12 col-sm-12 col-lg-12" style="padding-left: 0px; padding-right: 0px; clear: both; margin-bottom: 55px;">
            <div class="table-responsive" style="height: 370px; overflow: auto; position: relative; left: -6px; width: 100.5%;">
                <table class="table">
                    <col width="30%">
                    <thead style="background-color: #292929; border-color: #292929;">
                        <tr>
                            <th style="color: #ffffff;"><?php echo Yii::t('youtoo', 'Game') ?></th>
                            <th style="text-align: left; color: #ffffff;"><?php echo Yii::t('youtoo', 'Entries') ?></th>
                            <th style="text-align: left; color: #ffffff;"><?php echo Yii::t('youtoo', 'Entry Fee') ?></th>
                            <th style="text-align: left; color: #ffffff;"><?php echo Yii::t('youtoo', 'Prize') ?></th>
                            <th style="text-align: left; color: #ffffff;"><?php echo Yii::t('youtoo', 'Live') ?></th>
                            <th style="text-align: left; color: #f9d83d; background-color: #1d1d1d; border-bottom: 3px solid #1d1d1d;"><?php echo Yii::t('youtoo', 'Participate before') ?>&nbsp;&nbsp;<br/><span id="next-game-ends" style="padding: 12px 2px 0px 0px; font-weight: bold; color: #ffffff;"></span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $allDisplayedGames = GameUtility::getAllDisplayedGames($games);
                        $q = 1;
                        foreach ($games as $game) {
                            if ($allDisplayedGames[$game->id]['is_show']) {
                                ?>
                            <script>
                                $(document).ready(function() {
                                    $("#countDown<?php echo $q; ?>").countdown("<?php echo date('Y/m/d H:i:s', strtotime($allDisplayedGames[$game->id]['close_date'])); ?>", function(event) {
                                        var format = "%H:%M:%S";

                                        //if(event.offset.days > 0) {
                                        format = '%-D <?php echo (Yii::app()->language == 'en') ? 'day' : 'día'?>%!D ' + format;
                                        //}

                                        $(this).text(event.strftime(format));
                                    });
                                });
                            </script>
                            <tr class="<?php echo $q % 2 == 0 ? 'even' : 'odd'; ?>" style="cursor: default; border-top: 3px solid #292929;">

                                <?php
                                if ($allDisplayedGames[$game->id]['disabled'] == "disabled") {
                                    $fontColor = "gray";
                                    $cursor = "cursor: default;";
                                } else {
                                    $fontColor = "#f9d83d";
                                    $cursor = "";
                                }
                                ?>
                                <td class="alignLeft" style="vertical-align: middle; text-align: left; color: #f9d83d; border-top: none;"><a style="color: <?php echo $fontColor; ?>; <?php echo $cursor; ?> text-decoration: none;" href="<?php echo $this->createUrl($allDisplayedGames[$game->id]['url'], array()); ?>"><?php echo $game->description; ?></a></td>
                                <td style="vertical-align: middle; border-top: none; border-right: 1px solid #424242; color: #ffffff;"><?php echo ($game->num_plays_free + $game->num_plays_paid); ?></td>
                                <td style="vertical-align: middle;border-top: none; border-right: 1px solid #424242; color: #ffffff;"><?php echo '$' . $game->price; ?></td>
                                <td style="vertical-align: middle;border-top: none; border-right: 1px solid #424242; color: #ffffff;"><?php echo $game->prize; ?></td>
                                <td id="countDown<?php echo $q; ?>" class="alignLeft" style="vertical-align: middle;border-top: none; color: #ffffff;"><?php //echo date('m/d/y <\b\\r> H:i:s', strtotime($game->close_date));  ?></td>
                                <td style='text-align: center;border-top: none;' >
                                    <?php
                                    echo '<a class="btn btn-default btn-sm ' . $allDisplayedGames[$game->id]['disabled'] . '" style="font-weight: 700; font-size: 14px; min-width: 130px; min-height: 30px;" href="' . $this->createUrl($allDisplayedGames[$game->id]['url'], array()) . '">' . Yii::t('youtoo', $allDisplayedGames[$game->id]['message']) . '</a>';
                                    ?>
                                </td>
                                <?php $q++; ?>
                            </tr>
                        <?php }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
