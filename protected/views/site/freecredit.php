<div id="pageContainer" class="container" style="padding-left: 0px;">
    <div class="subContainer" style="padding: 0px;">
        <?php $this->renderPartial('_sideBar', array()); ?>
        <h3>Earn 1 Game Credit for watching a video.</h3>
        <div class="row">
            <div class="col-sm-12" style="background-color: #f6f6f6; margin-top: 10px; padding-left: 0px; padding-right: 0px;">
                <p class="lead" style="display: none;font-size: 13px; vertical-align: middle; padding-top: 15px; font-weight: 500;">
                    <?php echo Yii::t('youtoo', '') ?><img style="margin-left: 10px;" src='/webassets/images/laliga/icon_x.png'/>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <h4 id="total" style="font-weight: 300; cursor: default;">Total: $5 for each game choice of questions.</h4>
                    <div id="videoplayer" style="max-width:100%;margin: 0 auto;">
                        <?php
                        if (!isset($width))
                            $width = '640';
                        if (!isset($height))
                            $height = '360';
                        ?>
                        <video id="videoplay" width="480" height="320" autoplay >
                        <source src="<?php echo Yii::app()->createUrl('/webassets/videos/HollyDaze_30-SD.mp4') ?>" type="video/mp4">
                        </video>
<!--                        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" width="640" height="360" allowFullScreen="true">
                            <param name="flashvars" value="file=<?php echo Yii::app()->createUrl('/webassets/videos/HollyDaze_30-SD.mp4') ?>&autostart=true&stretching=exactfit&autoPlay=true&controlbar=none" />
                            <param name="movie" value="/webassets/swf/player.swf" />
                            <param name="wmode" value="window" />
                            <param name="autoPlay" value="true" />
                            <embed src="/webassets/swf/player.swf"
                                   width="<?php echo $width; ?>"
                                   height="<?php echo $height; ?>"
                                   wmode="window"
                                   type="application/x-shockwave-flash"
                                   pluginspage="http://www.macromedia.com/go/getflashplayer"
                                   allowFullScreen="true"
                                   autoplay="true"
                                   flashvars="file=<?php echo Yii::app()->createUrl('/webassets/videos/HollyDaze_30-SD.mp4') ?>&autostart=true&stretching=exactfit&autoPlay=true&controlbar=none" />
                        </object>-->
                    </div>
                </div>
            </div>
            <hr/>
        </div>
    </div>
</div>
<script>
    
    function oneFreeCredit() {
        var freeCredit = 1;
        $.ajax({
            type: 'post',
            url: '/game/ajaxOneFreeCredit',
            data: freeCredit,
            dataType: 'json',
            success: function (data) {
                if (data.added) {
                    window.location = "/pickgame";
                    alert('One Free Game Credit added to your account');
                }
            }
        });
    }
    
    var myVideoPlayer = document.getElementById('videoplay');
        myVideoPlayer.addEventListener('loadedmetadata', function() {
            console.log(myVideoPlayer.duration);
            myVideoPlayer.addEventListener('ended',function() {
                oneFreeCredit();
            });
        });
</script>
