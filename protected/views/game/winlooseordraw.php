<?php
$cs = Yii::app()->clientScript;
$cs->registerCoreScript('jquery', CClientScript::POS_END);
$stripe = StripeUtility::config();

?>

<?php
$anum = 0;
foreach ($game->gameChoiceAnswers as $answer) {
    if (in_array($answer->label, array('A', 'B', 'C', 'D'))) {
        $anum++;
    }
}
?>
<style>
    input[type=radio] {
        display:none;
        margin:20px;
    }

    input[type=radio] + label {
        display:inline-block;
    }

    input[type=radio]:checked + label {
        background-image: none;
        background-color:#d0d0d0;
    }

</style>

<div id="pageContainer" class="container" style='padding-right: 0px; padding-left: 0px;'>
    <div class='subContainer' style='max-height: 672px;'>
        <?php $this->renderPartial('/site/_sideBar', array()); ?>

        <div class='row' style='margin-top: -30px;'>
            <div class="col-sm-12" style="padding-right: 0px; padding-left: 0px; left: -23px;top: -50px;">
                <div class="form" style="position: relative; top: 22px; min-width: 923px; min-height: 712px; background-color:#002E42; clear: both;">
                    <!--                <div class='gameEntry' style='width: 100%; background-color: #eeeeee; min-height: 299px; min-width: 823px;'>-->
                    <div class="game" class="fab-left fab-voting-left" style='clear: both;'>
                        <div class="col-xs-11 col-sm-11 col-lg-11 col-sm-offset-1" style="padding-left: 0px; padding-right: 0px; clear: both; ">
                            <div class="table-responsive" style="height: 370px; overflow: auto; position: relative;  width: 96%; margin-top: 20px;">
                                <table class="table">
                                    <thead style="background-color: #292929; border-color: #292929;">
                                        <tr>
                                            <th style="text-align: center; color: #ffffff;"><?php echo Yii::t('youtoo', 'Game Question') ?></th>
                                            <th style="text-align: center; color: #ffffff;"><?php echo Yii::t('youtoo', 'Game Answers') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $allDisplayedGames = GameUtility::getAllDisplayedGames($games);
                                        $q = 1;
                                        ?>
                                        <?php 
                                        foreach ($games as $game) {
                                            ?>
                                            <tr class="<?php echo $q % 2 == 0 ? 'even' : 'odd'; ?>" style="cursor: default; border-top: 3px solid #292929;">
                                                <td class="alignLeft" style="vertical-align: middle; text-align: left; color: #f9d83d; border-top: none;"><?php echo $game->question; ?></td>
                                                <td style="vertical-align: middle; border-top: none; border-right: 1px solid #424242; color: #ffffff;">
                                                    <?php
                                                    $answerArray = Array();
                                                    $answerAutoArray = Array();
                                                    $i = 1;
                                                    $op = 1;
                                                    $form = $this->beginWidget('CActiveForm', array(
                                                        'id' => 'game-choice-form',
                                                        'enableAjaxValidation' => true,
                                                        'action' => Yii::app()->createUrl('/winlooseordraw/'.$game->id),
                                                        'enableClientValidation' => true,
                                                        'clientOptions' => array(
                                                            'validateOnSubmit' => true,
                                                        )
                                                    ));
                                                    if (Utility::isMobile()) {
                                                        $source = 'mobile';
                                                    } else {
                                                        $source = 'web';
                                                    }
                                                    foreach ($game->gameChoiceAnswers as $answer) {
                                                        if ($i < sizeof($game->gameChoiceAnswers) - 1) {
                                                            $answerArray[$answer->id] = $answer->answer;
                                                            $right = $answerArray[$answer->id];
                                                        }
                                                        $i++;
                                                    }
                                                    if (sizeof($game->gameChoiceAnswers) > 4) {
                                                        echo '<div class="col-sm-11 ">';
                                                        echo '<div class="options" style="text-align: left;">' . $form->radioButtonList($response, 'game_choice_answer_id', $answerArray, array('labelOptions' =>  array('style' => "display:inline; ')",  'style' => 'width: 30%; background-color: transparent; text-align: center;', 'class' => 'form-control'),'template' => "{input} {label}", 'separator' => '&nbsp&nbsp;&nbsp;', 'onchange' => "submitOption();")) . '</div>';
                                                        echo '</div>';
                                                        echo $form->error($response, 'game_choice_answer_id');
                                                        echo $form->hiddenField($response, 'game_choice_id', array('value' => $game->id));
                                                        $op++;
                                                    } 
                                                    else {
                                                        echo $form->radioButtonList($response, 'game_choice_answer_id', $answerArray, array('labelOptions' => array('style' => "display:inline;')", 'class' => 'form-control'), 'template' => "{input} {label}", 'separator' => '&nbsp&nbsp;&nbsp;', 'onclick' => "submitOption();"));
                                                        echo $form->error($response, 'game_choice_answer_id');
                                                        echo $form->hiddenField($response, 'game_choice_id', array('value' => $game->id));
                                                        $op++;
                                                    }
                                                    echo $form->hiddenField($response, 'source', array('value' => $source));
                                                    $this->endWidget();
                                                    ?></td>
                                            <?php 
                                            $q++;
                                            ?>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        function submitOption() {
            $('input[type=radio]').on('change', function () {
                $('#game-choice-form').submit(function (e) {
                });
            });
        }
    });
</script>
