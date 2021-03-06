<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/spectrum.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/adminTvScreenAppearSetting/index.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/spectrum.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/adminTvScreenAppearSetting/index.js', CClientScript::POS_END);
?>
<div class="tFormOverlay" id="header">
    <h2>Cloud Graphics Appearance Setting</h2>
    <div id="flashMsg" style="display: none;" class="flash-success flashes"></div>
    <ul class="tabNav">
        <li class="selected" formId='settingFormContainer'><a href="#">Settings</a></li>
        <li formId='toolsFormContainer'><a href="#" >Font Settings</a></li>
    </ul>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'ticker-appearance-form',
        'enableClientValidation' => true,
        'enableAjaxValidation' => false,
        'action' => '/adminTvScreenAppearSetting/save',
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => true,
        )
    ));
    echo CHtml::hiddenField('baseurl', Yii::app()->getBaseUrl(true));
    echo $form->hiddenField($formTvScreenSettingModel, 'entity_type');
    echo CHtml::hiddenField('definedcountOfFile', Yii::app()->params['cloudGraphicAppearanceSetting']['tvScreenImageLimit']);
    ?>
    <div class="formBox">
        <?php
        $this->renderPartial('/adminTvScreenAppearSetting/_tickerSettingForm', array('form' => $form, 'formTvScreenSettingModel' => $formTvScreenSettingModel, 'foreBgimageFile' => $foreBgimageFile, 'BgimageFile' => $BgimageFile));
        $this->renderPartial('/adminTvScreenAppearSetting/_tickerToolsForm', array('form' => $form, 'formTvScreenSettingModel' => $formTvScreenSettingModel));
        ?>
        <div class="clearfix  saveLabel">
            <div id="ajaxSpinner" style="display:none"><img style="height:20px;margin-top:-5px;" src="/core/webassets/images/socialSearch/ajaxSpinner.gif"></div>
            <div class="saveContainer">
                <?php
                echo CHtml::Button('Preview', array('id' => 'preview_button', 'alt' => 'Please save setting before preview', 'title' => 'Please save setting before preview', 'refId' => $refId));
                echo CHtml::Button('Save', array('id' => 'save_button', 'alt' => 'Save Setting', 'title' => 'Save Setting'));
                //echo CHtml::Button('Close',array('id'=>'close_button','alt'=>'Close Setting', 'title'=>'Close Setting'));
                ?>
                <div class="clearfix hintTxt preview" >Note: This is a global screen setting. Please save setting before preview</div>
            </div>
        </div>
    </div>
    <?php
    $this->endWidget();
    ?>
</div>
