<?php
// page specific css
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/jquery-ui-1.10.0.css');
Yii::app()->clientScript->registerScriptFile('http://cdn.jquerytools.org/1.2.7/all/jquery.tools.min.js', CClientScript::POS_END);
?>

<div id="pageContainer" class="container">
    <div class="subContainer" style="max-width: 800px;">
        <?php $this->renderPartial('_sidebar', array()); ?>
        <div style='margin-left: 100px;'>
        <?php
        $form = $this->beginWidget('CActiveForm', array('id' => 'user-registernew-form',
            'enableAjaxValidation' => true,
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
                ),
            'htmlOptions' => array(
            ),));
        ?>
        <h1 style="font-weight: 300; font-size: 30px;"><?php echo Yii::t('youtoo', 'Create an Account'); ?></h1>
        <br/>
        <br/>
        <div class="row">
            <div class='form group col-sm-12'>
                <div class='col-sm-6'>
                    <?php echo $form->textField($user, 'first_name', array('placeholder' => Yii::t('youtoo','First Name'), 'class' => 'form-control')); ?>
                    <?php echo $form->error($user, 'first_name'); ?>
                </div>
                <div class='col-sm-6'>
                    <?php echo $form->textField($user, 'last_name', array('placeholder' => Yii::t('youtoo','Last Name'), 'class' => 'form-control')); ?>
                    <?php echo $form->error($user, 'last_name'); ?>
                </div>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class='form group col-sm-12'>
                <div class='col-sm-6'>
                    <?php echo $form->passwordField($user, 'password', array('placeholder' => Yii::t('youtoo','Password'), 'class' => 'form-control')); ?>
                    <?php echo $form->error($user, 'password'); ?>
                </div>
                <div class='col-sm-6'>
                    <?php echo $form->passwordField($user, 'confirm_password', array('placeholder' => Yii::t('youtoo','Confirm Password'), 'class' => 'form-control')); ?>
                    <?php echo $form->error($user, 'confirm_password'); ?>
                </div>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class='form group col-sm-12'>
                <div class='col-sm-6'>
                    <?php echo $form->textField($user, 'username', array('placeholder' => Yii::t('youtoo','Email'), 'class' => 'form-control')); ?>
                    <?php echo $form->error($user, 'username'); ?>
                </div>
                <div class='col-sm-6'>
                    <?php echo $form->dropDownList($userLocation, 'state', ClientUtility::getUSStates(), array('class' => 'form-control')); ?>
                    <?php echo $form->error($userLocation, 'state'); ?>
                </div>
            </div>
        </div>
        <br/>
        <div class="row" style="margin-bottom: 10px;">
            <div class='col-sm-12'>
                <?php echo $form->checkbox($user, 'terms_accepted'); ?>
                <span class='terms'>
                    <?php echo Yii::t('youtoo','I agree to'); ?>
                    <a rel="#termsOverlayTrigger" href="#" class="fab-link" data-toggle="modal" data-target="#modalTerms" style="color: #ea8417;"><?php echo Yii::t('youtoo','Terms of Use'); ?></a>, <?php //echo Yii::t('youtoo','and the'); ?>
                    <a rel="#termsOverlayTrigger" href="#" class="fab-link" data-toggle="modal" data-target="#modalPrivacy" style="color: #ea8417;"><?php echo Yii::t('youtoo','Privacy Policy'); ?></a>,
                    <a rel="#termsOverlayTrigger" href="<?php echo Yii::app()->createUrl('user/rules'); ?>" class="fab-link" style="color: #ea8417;"><?php echo Yii::t('youtoo','General Rules and Rules of the individual competetion'); ?></a>.
                </span>
                <?php echo $form->error($user, 'terms_accepted'); ?>
            </div>
        </div>
        <div class="row">
            <div class='col-sm-12'>
                <?php echo $form->checkbox($user, 'age_accepted', '', array('checked' => '', 'value' => 1)); ?>
                <span class='over_18'>
                    <?php echo Yii::t('youtoo','I confirm that I am atleast 21 years of age.'); ?>
                </span>
                <?php echo $form->error($user, 'age_accepted'); ?>
            </div>
            <div class="row">
                <div id="states" class="col-sm-7 col-sm-offset-4" style="margin-top: 20px; text-align: left; padding-left: 0px;">
                    <span>Este juego no está disponible en:
                    California, New Mexico, <br/>Louisiana, Massachusetts, Georgia, Montana</span>
                </div>
            </div>
            <div class="row">
            <div class='col-sm-10 col-sm-offset-3' style="margin-top: 20px; text-align: left; padding-left: 0px;">
                <?php echo $form->checkbox($user, 'eligibility_accepted', '', array('checked' => '', 'value' => 1)); ?>
                <span class='eligiblity_accepted'>
                    <?php echo Yii::t('youtoo','I hereby confirm that I am not playing in one of the above mentioned states.'); ?>
                </span>
                <?php echo $form->error($user, 'eligibility_accepted'); ?>
            </div>
            </div>
        </div>
        <br/>
        <br/>
        <div class='row'>
            <div class="col-sm-12">
                <?php echo $form->hiddenField($user, 'source', array('value' => 'web')); ?>
                <input id="screen_width" type="hidden" name="screen_width" value="" />
                <input id="screen_height" type="hidden" name="screen_height" value="" />
                <?php echo CHtml::submitButton(Yii::t('youtoo', 'Sign Up'), array('class' => 'btn btn-default', 'role' => 'button', 'style' => 'width: 40%')); ?>
            </div>
        </div>
        <br/>
        <br/>
        <div class='row'>
            <div class='col-sm-12' ><a  href="/login" style='color:#ea8417;'><?php echo Yii::t('youtoo','Already have an account?'); ?></a>
            </div>
        </div>
        <br/>
        <br/>
        <?php $this->endWidget(); ?>
    </div>
    </div>
</div>
<?php $this->renderPartial('/site/modalTerms', array()); ?>
<?php $this->renderPartial('/site/modalPrivacy', array()); ?>
