<div id="pageContainer">
    <div class="subContainer" style="padding: 0px;">
        <?php $this->renderPartial('_sideBar', array()); ?>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-lg-12">
                <h3 style="font-size: 22px; font-weight: 300;"><img src="/webassets/images/laliga/icon_crown.png" style="margin-right: 10px; padding-bottom: 5px;"/><?php echo Yii::t('youtoo', 'Winners') ?></h3>
                <div class="table-responsive">
                    <table class="table table-bordered" style="background-color: #eeeeee; border: 1px solid #eeeeee;">
                        <col width="30%">
                        <thead style='border: 1px solid #ffffff;'>
                            <tr style="background-color: #ffffff;">
                                <th style="border: 1px solid #ffffff;"><?php echo Yii::t('youtoo', 'First Name') ?></th>
                                <th style="border: 1px solid #ffffff;"><?php echo Yii::t('youtoo', 'Prize') ?></th>
                                <th style="border: 1px solid #ffffff;"><?php echo Yii::t('youtoo', 'Question') ?></th>
                                <th style="border: 1px solid #ffffff;"><?php echo Yii::t('youtoo', 'Answer') ?></th>
                                <th style="border: 1px solid #ffffff;"><?php echo Yii::t('youtoo', 'Date') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            <?php foreach ($winners as $winner): ?>
                                <?php
                                if ($winner->winner_username && $winner->id == 4) {
                                    $i = $i + 1;
                                    ?>
                                    <tr>
                                        <td class="alignLeft" style="border: 1px solid #eeeeee;"><?php echo $winner->winner_firstname . ' ' . $winner->winner_lastname; ?></td>
                                        <td class="alignLeft" style="border: 1px solid #eeeeee;"><?php echo $winner->prize; ?></td>
                                        <td class="alignLeft" style="border: 1px solid #eeeeee;"><?php echo $winner->question; ?></td>
                                        <td class="alignLeft" style="border: 1px solid #eeeeee;"><?php echo $winner->gameChoiceAnswers[0]->answer; ?></td>
                                        <td style='text-align: center;background-color: #e1e1e1;' ><?php echo date("M j, Y", strtotime($winner->end_date)); ?></td>
                                    </tr>
                                <?php } ?>
                            <?php endforeach; ?>
                            <?php if ($i == 0): ?>
                                <tr><td colspan="5" style="text-align: center; border: 1px solid #eeeeee;"><?php echo Yii::t('youtoo','PLEASE COME BACK TO SEE THE LALIGA.COM SWEEPSTAKES WINNERS LIST NEXT WEEK. THANKS'); ?></td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
