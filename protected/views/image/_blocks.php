<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('/webassets/js/jquery.jscrollpane.min.js', CClientScript::POS_END);
$cs->registerScriptFile('/webassets/js/jquery.mousewheel.js', CClientScript::POS_END);
$cs->registerScriptFile('/webassets/js/mwheelIntent.js', CClientScript::POS_END);
$cs->registerScriptFile('/webassets/js/jquery.oauthpopup.js', CClientScript::POS_END);
$cs->registerScript('scrollpane', "$('.scroll-pane').jScrollPane({autoReinitialise: true, hideFocus: true, contentWidth:'0px'});");
$imageFormat = '
    <div class="videoBlock">
        <div class="videoThumb"><a href="%s"><img src="%s" /></a></div>
        <div class="videoData">
            <div class="videoTitle bold">%s</div>
            <div class="videoDate">%s</div>
            <div class="videoByline" style="%s">by <a href="%s"><span class="bold">%s</span></a></div>
            <div class="videoViews">%s views</div>
            <div class="videoRate">%s</div>
        </div>
    </div>
';
$starNum=0;
if(sizeof($images) != 0){
    foreach($images as $image){
        $stars='';
        for($i=0;$i<$image->rating;$i++){
            ++$starNum;
            $stars .= "<img src='/webassets/images/play/star_yellow.png' />";
        }
        for($t=0;$t<5-$i;$t++){
            ++$starNum;
            $stars .= "<img src='/webassets/images/play/star_white.png' />";
        }
        if(isset($image->user))
        echo sprintf(
            $imageFormat,
            '/viewimage/'.$image->view_key,
            '/'.basename(Yii::app()->params['paths']['image'])."/{$image->filename}",
            $image->title,
            $image->created_on,
            (!is_null($image->user->first_name))
                ? ''
                : 'display:none',
            '/user/'.$image->user_id,
            $image->user->first_name.' '.$image->user->last_name,
            $image->views,
            $stars
        );
    }
}

