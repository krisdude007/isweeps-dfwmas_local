<?php
if (!isset($width))
    $width = '700';
if (!isset($height))
    $height = '400';
$image = Yii::app()->createAbsoluteUrl('/' . basename(Yii::app()->params['paths']['video']) . '/' . $video->thumbnail . Yii::app()->params['video']['imageExt']);
$file = Yii::app()->createAbsoluteUrl('/' . basename(Yii::app()->params['paths']['video']) . '/' . $video->filename . Yii::app()->params['video']['postExt']);
?>
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0" width="<?php echo($width) ?>" height="<?php echo($height) ?>">
    <param name="movie" value="/core/webassets/swf/StrobeMediaPlayback.swf"></param>
    <param name="FlashVars" value="src=<?php echo(rawurldecode($file)) ?>&poster=<?php echo(rawurldecode($image)) ?>&backgroundColor=FFFFFF&stretching=exactfit"></param>
    <param name="allowFullScreen" value="true"></param>
    <param name="allowscriptaccess" value="always"></param>
    <embed src="/core/webassets/swf/StrobeMediaPlayback.swf"
           type="application/x-shockwave-flash"
           allowscriptaccess="always" allowfullscreen="true"
           width="<?php echo($width) ?>" height="<?php echo($height) ?>"
           FlashVars="src=<?php echo(rawurldecode($file)) ?>&poster=<?php echo(rawurldecode($image)) ?>&backgroundColor=FFFFFF&stretching=exactfit">
    </embed>
</object>