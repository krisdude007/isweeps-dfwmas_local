<?php
$this->renderPartial('/csrf/_csrfToken');
?>
<div id="content">
    <div class="you">
        <?php
        $this->renderPartial('/user/_sidebar', array(
            'user' => $user,
        ));
        ?>
        <div class="verticalRule">
            <img src="/webassets/images/you/profile.divider.png" />
        </div>
        <div class="video playWindow">
            <div class="player videoObject" id="player">
               <?php
                $player = (isset($video->brightcoves[0]->brightcove_id) && is_numeric($video->brightcoves[0]->brightcove_id) && !empty($countAndState) && $countAndState->itemState == 'ACTIVE') ? '_brightcovePlayer' : '_fallbackPlayer';
                $this->renderPartial($player, array(
                    'video' => $video,
                    'width' => 528,
                    'height' => 297,
                ));
                ?>
            </div>
            <div class="pShare">
                <div class="fb_share"><div class="fb-like" data-send="false" data-layout="button_count" data-width="100" data-show-faces="true" data-font="arial"></div></div>
                <div class="tw_share"><a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a></div>
                <div class="g_share"><div class="g-plusone" data-size="medium" callback="gPlusOne"></div></div>
                <div>
                    <a class="addthis_counter addthis_pill_style"></a>
                    <script type="text/javascript">var addthis_config = {

                        //url_transforms : {
                        //    clean: true,
                        //    shorten: {
                        //        twitter: 'bitly',
                        //       facebook: 'bitly'
                        //   }
                        //},
                        //shorteners : {
                        //    bitly : {}
                        //},

                        services_compact: "pinterest, stumbleupon, tumblr, blogger, yahoobkm, gmail, newsvine, digg, more", "data_track_addressbar":true};
                    </script>
                    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4fedc0ec098c19ad"></script>
                </div>
                <div style="float:right">
                    <?php if (Yii::app()->user->isGuest): ?>
                        <span id="stars">
                            <a href="/login">
                                Login to Rate!
                            </a>
                        </span>
                    <?php else: ?>
                        <span id="stars">
                            <?php
                            $stars = '';
                            $starNum=0;
                            for ($i = 0; $i < $video->rating; $i++) {
                                ++$starNum;
                                $stars .= "<a href='#' class='star' rel='{$starNum}' rev='{$video->id}'><img src='/webassets/images/play/star_yellow.png' /></a>";
                            }
                            for ($t = 0; $t < 5 - $i; $t++) {
                                ++$starNum;
                                $stars .= "<a href='#' class='star' rel='{$starNum}' rev='{$video->id}'><img src='/webassets/images/play/star_white.png' /></a>";
                            }
                            echo $stars;
                            ?>
                        </span>
                        <span style="text-align:center;display:inline-block;width:34px;height:20px;background:url('/webassets/images/play/ratings.png')">
                            <span id="votes" style="padding-top:3px;display:inline-block">
                                <?php echo sizeof($video->videoRatings); ?>
                            </span>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="pInfo">
                <div class="bold" style="font-size:16px"><?php echo $video->title; ?></div>
                <div style="color:#FFF;font-size:11px;">
                    <span style="margin-right:20px;"><?php echo $video->created_on; ?></span>
                    <span>Views: <?php echo $video->views; ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="ratingType" style="display: none;">video</div>