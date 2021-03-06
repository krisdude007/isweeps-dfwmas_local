<?php

// page specific css
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/jquery-ui-1.10.0.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/jquery.rating.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/tag-it/jquery.tagit.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/tag-it/tagit.ui-zendesk.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/adminImage/index.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/adminImage/imageModal.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/adminImage/imageImportModal.css');

// page specific js
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/adminImage/index.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/tag-it/tag-it.min.js', CClientScript::POS_HEAD);
?>

<!-- BEGIN PAGE -->
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'image-filter-form',
    'enableAjaxValidation' => true,
    'method' => 'get',
    'action' => Yii::app()->createUrl('/admin/image'),
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => true,
        'validateOnType' => false,
    )
        ));

?>

<?php $this->renderPartial('/admin/_csrfToken', array()); ?>
<div class="fab-page-content">

    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
    <div id="fab-top" style="background:#E02222;margin-bottom:0px;">
        <h2 class="fab-title" style="color:white"><img class="floatLeft marginRight10" src="<?php echo Yii::app()->request->baseUrl; ?>/core/webassets/images/video-admin-image.jpg"/>Image Admin</h2>
    </div>

    <!-- flash messages -->
    <?php $this->renderPartial('/admin/_flashMessages', array()); ?>
    <!-- flash messages -->
    <!-- END PAGE TITLE & BREADCRUMB-->
    <!-- BEGIN PAGE CONTAINER-->
    <div class="fab-container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <!-- END PAGE HEADER-->
        <div class="fab-row-fluid">
            <div class="fab-tab-content">
                <div class="fab-main-images">
                    <div class="fab-form-horizontal">
                        <div class="fab-control-group">
                            <div id="fab-image-filter-form">

                                <div class="fab-form-left">

                                    <div class="fab-clear" style="height:6px;"></div>

                                    <div class="fab-box fab-left" style="margin-left:0px;">
                                        <label class="fab-left">Status:</label>
                                        <?php echo $form->dropDownList($filterImageModel, 'status', $statuses, array('class' => 'fab-select-accept', 'id' => 'fab-select-accept')); ?>
                                    </div>
                                    <div class="fab-clear"></div>
                                    <div class="fab-box fab-left" style="margin-left:0px;">
                                        <label class="fab-left">Type:</label>
                                        <?php echo $form->dropDownList($filterImageModel, 'type', $types, array('class' => 'fab-select-accept')); ?>
                                        <!--If any value are add please also add in index.js [$("#fab-select-accept").change]-->
                                    </div>
                                    <div class="fab-clear"></div>
                                    <div id="fab-advanced-filtering" class="fab-left fab-hide">

                                        <div class="fab-box fab-left" style="margin-left:0px">
                                            <label class="fab-left">From: </label>
                                            <?php echo $form->textField($filterImageModel, 'dateStart', array('id' => 'datepickerVideoFilterStart', 'style' => 'width: 70px;', 'class' => 'fab-small-input fab-left datepicker')); ?>

                                            <label class="fab-left">To: </label>
                                            <?php echo $form->textField($filterImageModel, 'dateStop', array('id' => 'datepickerVideoFilterStop', 'style' => 'width: 70px;', 'class' => 'fab-small-input fab-left datepicker')); ?>

                                            <label class="fab-left">User: </label>
                                            <input id="userAutoCompleter" type="text" name="userPlaceholder" class="fab-user-input fab-left" style="width: 130px;" />
                                            <?php echo $form->hiddenField($filterImageModel, 'user_id', array('id' => 'userIdAutoComplete')); ?>

                                            <label class="fab-left">Tags: </label>
 		                                            <?php echo $form->textField($filterImageModel, 'tags', array('class' => 'fab-user-input fab-left', 'style' => 'width: 150px;')); ?>
                                        </div>

                                        <div class="fab-clear"></div>
                                    </div>

                                </div>
                                <div class="fab-form-right">
                                    <div class="fab-b-left">
                                        <input type="submit" class="fab-right-filter" style="margin-top: 0px;" value="Submit">
                                        <div class="fab-clear"></div>
                                        <button class="fab-right-filter" id="fab-advanced-button" style="margin-top:8px;padding-top:0"><i>Advanced Filtering</i></button>
                                        <?php if (Yii::app()->params['video']['allow3rdPartyImport']): ?>
                                            <div class="fab-clear"></div>
                                            <button type="button" class="fab-right-filter" id="fab-import-button" style="margin-top:8px;padding-top:0"><i>Import Images</i></button>
                                        <?php endif; ?>
                                        <div class="fab-clear"></div>
                                        <!--<button rel="#imageOverlay" type="button" class="fab-right-filter" id="fab-import-button" style="margin-top:8px;padding-top:0" href="<?php echo Yii::app()->request->baseUrl; ?>/adminImages/imageImportModal"><i>Import Images</i></button>-->
                                    </div>
                                </div>

                                <div style="clear: both"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="fab-row-fluid">
            <div class="fab-main-images">

                <?php
                $showAcceptAll = false;
                $showDenyAll = false;
                switch ($filterImageModel->status) {
                    case "new":
                    case "newtv":
                    case "newsup1":
                    case "newsup2":
                        $showAcceptAll = true;
                        $showDenyAll = true;
                        $tempStatus = 'new';
                        break;
                    case "accepted":
                    case "acceptedtv":
                        $showDenyAll = true;
                        $tempStatus = 'accepted';
                        break;
                    case "denied":
                    case "deniedtv":
                        $showAcceptAll = true;
                        $tempStatus = 'denied';
                        break;
                    case "all":
                    case "statustv":
                        $tempStatus = 'all';
                    default:
                        break;
                }
                ?>

                <?php if ($showAcceptAll || $showDenyAll): ?>
                    <div class="fab-left" style="margin-top:3px;">
                        <label class="floatLeft marginRight10">Select All</label>
                        <div class="fab-left" style="margin-top:2px">
                            <input id="fab-check_box" class="fab-chk" type="checkbox"  name="select-check" value="a"><label for="fab-check_box"></label>
                        </div>

                        <div class="fab-left" style="margin-left:7px;margin-top:-3px;">
                            <?php if ($showAcceptAll): ?>
                                <button id="imageAcceptAll" class="fab-accept-button" onclick="updateAllImageStatuses('accepted', $('#fab-select-accept').val())">Accept</button>
                            <?php endif; ?>
                            <?php if ($showDenyAll): ?>
                                <button id="imageDenyAll" class="fab-deny-button" onclick="updateAllImageStatuses('denied', $('#fab-select-accept').val())">Deny</button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="fab-left" style="margin-left: 26px;margin-top:2px">
                    <label class="fab-left">Items per page</label>
                    <?php echo $form->dropDownList($filterImageModel, 'perPage', $perPageOptions, array('id' => 'perPage', 'class' => 'fab-left', 'style' => 'font-size: 12px;height: 23px;margin-left: 3px;width:50px')); ?>
                </div>
                <div class="fab-left" style="margin-left: 26px;margin-top:3px">
                    <label class="fab-left">Showing <?php echo count($images); ?> of <?php echo $imagesTotal; ?> images</label>
                </div>
                <div class="fab-right" style="margin-top:-3px; margin-left:26px;">
                    <?php $this->widget('CLinkPager', array('pages' => $pages, 'header' => '')); ?>
                </div>

            </div>
        </div>
        <div class="fab-row-fluid" style="margin-top:10px">
            <div class="fab-main-images">
                <div class="fab-tiles">

                    <?php if (!is_null($images)): ?>
                        <?php $i = 1; ?>
                        <?php foreach ($images as $image): ?>
                            <div id="image<?php echo $image->id; ?>" class="fab-tile">
                                <div class="fab-tile-body">
                                    <div class="fab-image-holder">
                                        <div class="fab-left" style="width: 150px;">
                                            <h3 style="width: 150px; overflow: hidden; white-space: nowrap; line-height: 18px;"><?php echo CHtml::decode($image->title); ?></h3>
                                            <p>&nbsp;</p>
                                        </div>

                                        <?php if ($showAcceptAll || $showDenyAll): ?>
                                            <div class="fab-right"><input type="checkbox" value="<?php echo $image->id; ?>" name="select-check" class="fab-chk" id="fab-check_box<?php echo $image->id; ?>">
                                                <label for="fab-check_box<?php echo $image->id; ?>" ></label>
                                            </div>
                                        <?php endif; ?>
                                        <div style="clear:right"></div>
                                        <div class="fab-clear"></div>
                                        <!-- currentStatus val is tacked on via jquery -->
                                        <a rel="#imageOverlay" href="<?php echo Yii::app()->request->baseUrl; ?>/adminImage/imageModal/id/<?php echo $image->id; ?>/currentStatus/" class="imageModalTrigger" id="img_<?php echo $image->id; ?>">
                                            <div class="imageThumb">
                                                <img id="img<?php echo $image->id; ?>" class="imageThumbFile" alt="image" src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo basename(Yii::app()->params['paths']['image']); ?>/<?php echo $image->filename; ?>">
                                            </div>
                                        </a>

                                        <div class="fab-clear"></div>

                                        <div class="fab-left">
                                            <div class="fab-<?php //echo VideoUtility::getIndicatorColor($image->duration); ?>-button"></div>
                                        </div>

                                        <div class="fab-accepted-image">
                                            <div class="fab-right">
                                                <button id="fab-accept-button<?php echo $image->id; ?>" value="<?php echo $tempStatus; ?>" class="fab-accept-button" onclick="updateImageStatus('accepted', $('#fab-select-accept').val(), <?php echo $image->id; ?>);">Accept</button>
                                                <button id="fab-deny-button<?php echo $image->id; ?>" value="<?php echo $tempStatus; ?>" class="fab-deny-button" onclick="updateImageStatus('denied', $('#fab-select-accept').val(), <?php echo $image->id; ?>);">Deny</button>
                                            </div>
                                        </div>

                                        <?php
                                        $style = '';
                                        if($filterImageModel->status == 'accepted' || $filterImageModel->status == 'acceptedtv')
                                        {
                                            $style = 'display:block';
                                        }
                                        else
                                        {
                                            $style = 'display:none';
                                        }
                                        ?>
                                        <div id="imageIcons<?php echo $image->id; ?>" style="<?php echo $style; ?>" class="fab-not-accepted-image">
                                            <div class="fab-right">
                                                <?php if(Yii::app()->params['image']['useExtendedFilters'] && $filterImageModel->status == 'acceptedtv' || !Yii::app()->params['image']['useExtendedFilters'] && $filterImageModel->status == 'accepted'): ?>
                                                        <img alt="<?php echo $image->id; ?>" class="imageIcon imageIconFTP" src="<?php echo Yii::app()->request->baseUrl; ?>/core/webassets/images/video-show-white.png" />
                                                <?php endif; ?>

                                                <a rev="<?php echo $image->id; ?>" href="#" id="clientShareFacebookTrigger"><img alt="<?php echo $image->id; ?>" class="imageIcon imageIconFacebook" src="<?php echo Yii::app()->request->baseUrl; ?>/core/webassets/images/facebook-transparent.png" /></a>
                                                <a rev="<?php echo $image->id; ?>" href="#" id="clientShareTwitterTrigger"><img alt="<?php echo $image->id; ?>" class="imageIcon imageIconTwitter" src="<?php echo Yii::app()->request->baseUrl; ?>/core/webassets/images/twitter-transparent.png" /></a>
                                            </div>
                                        </div>
                                        <div style="clear: right"></div>
                                        <div style="height: 12px"></div>

                                        <?php
                                        if($filterImageModel->status == 'statustv')
                                        {
                                            //will need to make a utility function for this for this
                                            $extendedLabels = Yii::app()->params['image']['extendedFilterLabels'];

                                            echo '<div style="font-size: 10px;">';

                                            unset($extendedLabels[0]);
                                            unset($extendedLabels[1]);

                                            $i = 1;
                                            foreach($extendedLabels as &$value)
                                            {
                                                if($image->extendedStatus['accepted_sup'.$i])
                                                {
                                                    echo '<span title="approved" style="color: green">'.$value[key($value)].'</span> - ';
                                                }
                                                else
                                                {
                                                    echo '<span title="no action taken" style="color: orange">'.$value[key($value)].'</span> - ';
                                                }
                                                $i++;
                                            }

                                            if($image->extendedStatus['denied_tv'])
                                            {
                                                echo '<span title="denied" style="color: red">DenyTV</span> - ';
                                            }
                                            else
                                            {
                                                echo '<span title="no action taken" style="color: orange">DenyTV</span> - ';
                                            }

                                            if($image->extendedStatus['denied'])
                                            {
                                                echo '<span title="denied" style="color: red">DenyWeb</span>';
                                            }
                                            else
                                            {
                                                echo '<span title="no action taken" style="color: orange">DenyWeb</span>';
                                            }
                                            echo '</div>';
                                        }
                                        ?>
                                        <?php $username = CHtml::encode(isset($image->user) ? Utility::concatFirstLastName($image->user): 'Entity');?>
                                        <?php $username = eImage::getExternalSourceUsername($image, $username);?>
                                        <h3><?php echo $username;?></h3>
                                        <div><?php echo DateTimeUtility::convertTimestampToDate($image->created_on); ?> @ <?php echo DateTimeUtility::convertTimestampToTime($image->created_on); ?> <?php echo date("T"); ?></div>
                                        <div>Uploaded via <?php echo CHtml::encode(ucfirst($image->source)); ?></div>

                                    </div>
                                </div>
                            </div>
                            <?php ++$i; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <div class="fab-clear"></div>

                    <div class="fab-right" style="margin-top:-3px; margin-left:26px;">
                        <?php $this->widget('CLinkPager', array('pages' => $pages, 'header' => '')); ?>
                    </div>
                    <!--end tiles-->
                </div>
            </div>

        </div>
    </div>
    <!-- END PAGE CONTAINER-->
</div>
<?php $this->endWidget(); ?>
<!-- END PAGE -->

<!-- VIDEO MODAL -->
<div class="imageModal" id="imageOverlay">
    <div class="imageModalContent" ></div>
</div>
<!-- VIDEO MODAL -->

<?php if (Yii::app()->params['video']['allow3rdPartyImport']): ?>
    <!-- IMAGE IMPORT OVERLAY //using video params for time being -->
    <div style="display: none;" id="imageImportOverlay">
        <div id="imageImportOverlayContent">
            <h2 style="font-size: 18px;">Image Import:</h2>
            <hr/>
            <div>
                Enter Hashtag: <br><input type="text" id="imageHashtag" />
            </div>
            <div>
                Select source:<br>
            <?php if (Yii::app()->params['video']['allowImportInstagram']): ?><button type="button" class="fab-right-filter fab-import-source-button" style="margin-top:8px;padding-top:0">Instagram</button><?php endif; ?>
            </div>
            
        </div>
    </div>
    <!-- IMAGE IMPORT OVERLAY -->
<?php endif; ?>

<div id="fb-root">
</div>