<div id="content">
    <div class="you">
        <?php
        $this->renderPartial('/user/_sidebar', array(
            'user' => $user,
                )
        );
        ?>
        <div class="verticalRule">
            <img src="<?php echo Yii::app()->request->baseurl; ?>/webassets/images/you/profile.divider.png" />
        </div>
        <div class="youContent">
            <div style="text-align:left;">
                <h1 style="margin-bottom:10px;"><?php echo strtoupper($user->first_name); ?>'S VIDEOS</h1>
                <div class="sorter" style="font-size:12px;margin-bottom:5px;">View By:
                    <a class="bold" href="<?php echo Yii::app()->request->baseurl; ?>/user/<?php echo $user->id; ?>/recent">Most Recent</a> |
                    <a href="<?php echo Yii::app()->request->baseurl; ?>/user/<?php echo $user->id; ?>/views">Most Viewed</a> |
                    <a href="<?php echo Yii::app()->request->baseurl; ?>/user/<?php echo $user->id; ?>/rating">Highest Rated</a>
                </div>
                <div class="videoBlocks scroll-pane jspScrollable">
                    <?php
                    $this->renderPartial('/video/_blocks', array('videos' => $videos)
                    );
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>