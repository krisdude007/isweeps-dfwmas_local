<?php
/* @var $this Controller */
$cs = Yii::app()->getClientScript();
$cs->registerCoreScript('jquery', CClientScript::POS_END);
$cs->registerCoreScript('jquery.ui', CClientScript::POS_END);
Yii::app()->facebook->initJs($output);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional/EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang='<?php echo Yii::app()->language ?>'>
    <head>
        <meta charset="utf-8"/>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        <!--        <meta name="blitz" content="mu-551e693b-63f1ac84-c7a038fa-fe9b389b">-->
        <link rel="icon"  type="image/png"  href="/webassets/images/logo.png" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
        <link rel="stylesheet" type="text/css" href="/webassets/css/client.css" />
        <link  rel="stylesheet" type="text/css" href="/webassets/css/simple-sidebar.css"/>
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script>
            (function(i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function() {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-25950024-9', 'auto');
            ga('send', 'pageview');

        </script>
        <script>
            var trackOutboundLink = function(url, new_window) {
                ga('send', 'event', 'outside_link', 'click', url, {'hitCallback':
                            function() {
                                if (!new_window) {
                                    document.location = url;
                                }
                            }
                });
                if (new_window) {
                    window.open(url);
                }
            }

            $(document).ready(function() {
                // set google analytics onclick link event on each link with class track
                $('a.track').each(function(index, element) {
                    element = $(element);
                    var link = element.attr('href');
                    var new_window = element.attr('target') == '_blank' ? true : false;
                    element.click(function() {
                        trackOutboundLink(link, new_window);
                        return false;
                    });
                });
            });
        </script>
        <!--        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>-->
    </head>
    <?php echo (isset(Yii::app()->controller->action->id) && in_array(Yii::app()->controller->action->id, array('marketingpage', 'marketingpage2'))) ? '<body>' : '<body>'; ?>
    <div class="main">
        <div id="popupWrap2">
            <div style="display: table-cell;padding-top: 200px;">
                <div class="flashMobile2">
                    <div class="flashMobileContents2">
                    </div>
                </div>
            </div>
        </div>
        <div id="popupWrap">
            <div style="display: table-cell;padding-top: 200px;">
                <div class="flashMobile">
                    <div class="flashMobileContents">
                    </div>
                    <p id="fabmob_login-divider" style="border-bottom:grey solid 1px;"></p>
                    <div class="flashMobileButton">
                        <div class='okButton' onclick="$('#popupWrap').toggle();"><?php echo Yii::t('youtoo', 'Ok') ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="pageHeader">
            <div class="row">
                <div class="col-xs-12" style="overflow:hidden;">
                    <span class="pull-left pageHeaderContent" style="margin: 10px 20px 0px 20px;">
                    </span>
                </div>
            </div>
        </div>
        <?php echo (Yii::app()->controller->action->id == 'marketingpage' || Yii::app()->controller->action->id == 'marketingpage2') ? '<div id="pageNavigation" class="navbar navbar-inverse" role="navigation" >' : '<div id="pageNavigation" class="navbar navbar-inverse" role="navigation">'; ?>
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-left">
                <li class="logo"><a target="_blank" href="http://us.azteca.com/"><img src="/webassets/images/laliga/logo_Azteca.png" style="height: 43px; position: relative; top: -12px; margin-right: 100px;"/></a></li>
                <li style="display: none;"><a target="_blank" href="http://us.azteca.com/"><?php echo Yii::t('youtoo', 'SHOWS') ?></a></li>
                <li style="display: none;" class="active"><a target="_blank" href="http://us.azteca.com/mas"><?php echo Yii::t('youtoo', 'MÁS') ?></a></li>
                <li style="display: none;"><a target="_blank" href="http://us.azteca.com/"><?php echo Yii::t('youtoo', 'VIDEOS') ?></a></li>
                <li style="display: none;"><a target="_blank" href="http://us.azteca.com/programacion/index"><?php echo Yii::t('youtoo', 'HORARIOS') ?></a></li>
            </ul>
        </div>
    </div>

    <?php if (in_array($this->action->id, array('index', 'geocoordinates', 'geocoordinatesshare')) || $this->id == 'game' && in_array($this->action->id, array('multiple4', 'thankyou', 'paidthankyou'))): ?>
        <div id="wrapper" style="background-color: #303030;">
        <?php elseif ($this->action->id == 'marketingpage' || $this->action->id == 'marketingpage2'): ?>
            <div id="wrapper" style="background-color: #0b1112;">
            <?php else: ?>
                <?php echo (in_array(Yii::app()->controller->id, array('site')) || in_array(Yii::app()->controller->action->id, array('faq', 'confirmation', 'redeem', 'winners', 'playnow', 'winlooseordraw', 'payment', 'multiple4', 'thankyou', 'paidthankyou'))) ? '<div id="wrapper">' : ''; ?>
            <?php endif; ?>
            <?php echo ((in_array(Yii::app()->controller->action->id, array('redeem', 'winners', 'winlooseordraw', 'multiple4', 'thankyou', 'paidthankyou')))) ? '<div id="page-content-wrapper" style="padding: 20px; background-color: #ffffff;">' : '<div id="page-content-wrapper">'; ?>
            <div class="container-fluid">
                <?php echo $content; ?>
            </div>
        </div>
        <?php echo (in_array(Yii::app()->controller->id, array('site')) || in_array(Yii::app()->controller->action->id, array('playnow', 'winlooseordraw', 'index2', 'multiple4', 'thankyou', 'paidthankyou'))) ? '</div>' : ''; ?>
        <div id="pageFooterDrop">
            <div  class="row col-sm-10 col-sm-offset-2" style='padding-left: 50px;'>
                <div class="col-sm-3" id="aboutDrop">
                    <div class="dropHead"><?php echo Yii::t('youtoo', 'ABOUT'); ?></div>
                    <div><a target="_blank" href="http://us.azteca.com/"><?php echo Yii::t('youtoo', 'Azteca'); ?></a></div>
                    <div><a target="_blank" href="http://us.azteca.com/concursos"><?php echo Yii::t('youtoo', 'Sweepstakes'); ?></a></div>
    <!--                <div><a data-toggle="modal" data-target="#modalLaIsla" href="#"><?php //echo Yii::t('youtoo', 'La Isla Rules');     ?></a></div>-->
                    <!--<div><a href="#"><?php echo Yii::t('youtoo', 'Press and Media'); ?></a></div>-->
                </div>
                <div class="col-sm-3" id="helpDrop">
                    <div class="dropHead"><?php echo Yii::t('youtoo', 'HELP'); ?></div>
                    <div><a href="/contact"><?php echo Yii::t('youtoo', 'Support'); ?></a></div>
    <!--                <div><a href="#"><?php echo Yii::t('youtoo', 'How it works'); ?></a></div>
                    <div><a href="#"><?php echo Yii::t('youtoo', 'Rules & Scoring'); ?></a></div>-->
                    <div><a href="https://laliga.youtoo.com/faq"><?php echo Yii::t('youtoo', 'FAQ'); ?></a></div>
                </div>
                <div class="col-sm-3" id="legalDrop">
                    <div class="dropHead"><?php echo Yii::t('youtoo', 'LEGAL'); ?></div>
                    <div><a href="/user/rules" target="_blank"><?php echo Yii::t('youtoo', 'Rules of the competition'); ?></a></div>
    <!--                <div><a href="#"><?php echo Yii::t('youtoo', 'Sweepstakes Regs'); ?></a></div>-->
                    <div><a data-toggle="modal" data-target="#modalTerms" href="#"><?php echo Yii::t('youtoo', 'Terms'); ?></a></div>
                    <div><a data-toggle="modal" data-target="#modalPrivacy" href="#"><?php echo Yii::t('youtoo', 'Privacy Policy'); ?></a></div>
                    <div><a href="#" data-toggle='modal' data-target='#modalFreePlay'><?php echo Yii::t('youtoo', "Free method of play") ?></a></div>
                </div>
            </div>
        </div>
        <div id="sponsorLogo">
            <img src="/webassets/images/laliga/footer_paypal.png" style="margin-right: 17px;"/>
            <img src="/webassets/images/laliga/footer_visa.png" style="margin-right: 17px;"/>
            <img src="/webassets/images/laliga/footer_mastercard.png" style="margin-right: 17px;"/>
    <!--        <img src="/webassets/images/laliga/footer_discover.png" style="margin-right: 25px;"/>-->
            <img src="/webassets/images/laliga/footer_twitter.png" style="margin-right: 5px;"/>
    <!--        <img src="/webassets/images/laliga/footer_instagram.png" style="margin-right: 5px;"/>-->
    <!--        <img src="/webassets/images/laliga/footer_facebook.png" style="margin-right: 5px;"/>-->
        </div>
        <div id="pageHeader"></div>
        <?php echo in_array(Yii::app()->controller->action->id, array('marketingpage', 'marketingpage2')) ? '<div id="pageFooter" style="color: #707070; width: 648px; padding: 2px 12px; height: 30px; display: none;">' : '<div id="pageFooter" style="color: #707070;">'; ?>
    <!--    <?php //echo CHtml::link(Yii::t('youtoo', 'Terms of Use'), array('#'), array('data-toggle' => 'modal', 'data-target' => '#modalTerms'));       ?> &amp;-->
    <!--    <?php //echo CHtml::link(Yii::t('youtoo', 'Privacy Policy'), array('#'), array('data-toggle' => 'modal', 'data-target' => '#modalPrivacy'));       ?> &nbsp;|&nbsp;-->
    <!--    <?php //echo CHtml::link(Yii::t('youtoo', 'Rules'), array('#'), array('data-toggle' => 'modal', 'data-target' => '#modalRules'));       ?> &nbsp;|&nbsp;-->
    <!--    <?php //echo CHtml::link(Yii::t('youtoo', 'FAQ'), array('#'), array('data-toggle' => 'modal', 'data-target' => '#modalFaq'));       ?> &nbsp;|&nbsp;-->
        Copyright <?php echo date('Y'); ?> <a href="http://www.youtootech.com/patents" target="_blank"><?php echo Yii::t('youtoo', 'Youtootech.com/patents') ?></a>
    </div>

    <?php $this->renderPartial('/site/modalTerms', array()); ?>
    <?php $this->renderPartial('/site/modalPrivacy', array()); ?>
    <?php $this->renderPartial('/site/modalRules', array()); ?>
    <?php $this->renderPartial('/site/modalFaq', array()); ?>
    <?php $this->renderPartial('/site/modalMessage', array()); ?>
    <?php $this->renderPartial('/site/modalFreePlay', array()); ?>

    <?php $this->renderPartial('/csrf/_csrfToken'); ?>
    <script type="text/javascript" src="/webassets/js/client.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
    <script>
            window.onload = function() {
                if ($('#modalMessage .modal-body').html().trim())
                    $('#modalMessage').modal('show');

                $("#menu-toggle").click(function(e) {
                    e.preventDefault();
                    $("#wrapper").toggleClass("toggled");
                });
            }
    </script>
</div>
</body>
</html>
