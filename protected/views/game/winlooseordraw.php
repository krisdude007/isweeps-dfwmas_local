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
        
        margin:20px;
        /*display:none;*/
    }

    input[type=radio] + label {
        display:inline-block;
        color: grey;
    }

    input[type=radio]:checked + label {
        background-image: none;
        background-color:#d0d0d0;
    }
    
/*    ::-webkit-scrollbar {
        -webkit-appearance: none;
        width: 7px;
        }
    ::-webkit-scrollbar-thumb {
        border-radius: 4px;
        background-color: rgba(0,0, 255,.5);
        -webkit-box-shadow: 0 0 1px rgba(255,255,255,.5);
    }*/

    .count {
        color: #00cccc;
        margin-bottom: 10px;
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
                        <div class="col-xs-11 col-sm-11 col-lg-11 col-sm-offset-1" style="padding-left: 0px; padding-right: 0px; clear: both; margin-left: 5.3%;">
                            <div class="table-responsive" style="height: 630px; overflow: auto; position: relative;  width: 98%; margin-top: 20px;">
                                <div id='resultCount' class='count'>You have : <?php echo Yii::app()->session['noOfQs']; ?> answers left.</div>
                                <table class="table">
                                    <thead style="background-color: #292929; border-color: #292929;">
                                        <tr>
                                            <th style="text-align: center; color: #ffffff; width: 40%;"><?php echo Yii::t('youtoo', 'Game Question') ?></th>
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
                                               
                                                <td class="alignLeft gamechoice-<?php echo $q; ?>" style="vertical-align: middle; text-align: left; color: #f9d83d; border-top: none; font-size: 15px;"><?php echo $game->question; ?></td>
                                                <td style="vertical-align: middle; border-top: none; border-right: 1px solid #424242; color: #ffffff;">
                                                    <?php
                                                    $form = $this->beginWidget('CActiveForm', array(
                                                        'enableAjaxValidation' => true,
                                                        'enableClientValidation' => true,
                                                        'htmlOptions' => array('onsubmit' => 'return submitChoice(this);return false;',),
                                                    ));
                                                    
                                                    $answerArray = Array();
                                                    $answerAutoArray = Array();
                                                    $i = 1;
                                                    $op = 1;
                                                    
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
                                                        echo $form->radioButtonList($response, 'game_choice_answer_id', $answerArray, array('labelOptions' =>  array('style' => "display:inline; background-color: transparent; ')",  'class' => 'form-control'),'separator' => '&nbsp&nbsp;&nbsp;', ));
                                                        echo '</div>';
                                                        echo $form->error($response, 'game_choice_answer_id');
                                                        echo $form->hiddenField($response, 'game_choice_id', array('value' => $game->id));
                                                        $op++;
                                                    } 
                                                    else {
                                                        echo $form->radioButtonList($response, 'game_choice_answer_id', $answerArray, array('labelOptions' => array('style' => "display:inline; background-color: transparent; ')", 'class' => 'form-control'), 'separator' => '&nbsp&nbsp;&nbsp;'));
                                                        echo $form->error($response, 'game_choice_answer_id');
                                                        echo $form->hiddenField($response, 'game_choice_id', array('value' => $game->id));
                                                        $op++;
                                                    }
                                                    echo $form->hiddenField($response, 'source', array('value' => $source));
                                                    echo '<br/>';
                                                    echo "<input type='submit' value='Lock-in' class='btn btn-success' onclick='countChoiceClicked();'> &nbsp; &nbsp;";
//                                                    echo "<input type='reset' value='Choose another question' class='btn btn-warning'>";
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
    
    var countChoice=<?php echo Yii::app()->session['noOfQs'];?>;
    //var countChoice= 0;
    function countChoiceClicked(){
     countChoice=parseInt(countChoice) - parseInt(1);
     //countChoice=parseInt(countChoice)+parseInt(1);
     var divData=document.getElementById("resultCount");
     if (countChoice === 1) {
         divData.innerHTML="You have : "+countChoice +" answer left.";
     } else {
         divData.innerHTML="You have : "+countChoice +" answers left.";
     }
    }
        
    function submitChoice(me) {
        var row = $(me).closest("tr");
        //console.log(me);
             $.ajax({
                type: 'post',
                url: '/game/ajaxWinLooseOrDraw',
                data: $(me).serialize(),
                dataType: 'json',
                success: function (data) {
                    if (data.completed) {
                      window.location = "/index.php?f=g";  
                    }
                        if (data.success) {
                            $(me).find('input[type="submit"]').prop( "disabled",true);
//                            $(me).find('input[type="reset"]').prop( "disabled",true);
                            row.css('background-color','#142E02');
                            }
                    if (data.error) {
                        alert(data.error);
                    }
                }
            });
        return false;
    }
</script>
