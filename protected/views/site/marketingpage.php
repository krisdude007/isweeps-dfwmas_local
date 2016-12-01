<div id="pageContainer" class="container" style="padding-left: 0px; padding-right: 0px; background-color: #0b1112; "><?php //if(isset($_GET['f'])){ echo $_GET['f']; } exit;        ?>
    <div class="subContainer" style="padding: 0px;">
        <?php $this->renderPartial('_sideBar', array()); ?>
        <a href="/"><img src="/webassets/images/laliga/image_web_azteca-concursos_background.png" style="position: relative; max-width: 102.6%; left: -7px;"/>
        </a>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2" style="background-color: #2a3335; position: relative; top: -356px; margin-left: 14.9333%; min-width: 660px; min-height: 200px;">
                <div style="float: left; max-width: 350px;">
                    <h3 style="text-align: left; color: #edbc5a;font-weight: 300;">New Sweepstakes at Baldini’s</h3>
                    <p style="text-align: left; color: #ffffff; font-size: 12px;">
                        Every week this December, Baldini’s is having a sweepstakes where you can answer questions correctly to enter a random drawing for a valuable prize.  It only costs $1 per question.  Players choose their selection from a possible list of answers.
                    </p>

<!--                    <p style="text-align: left; color: #ffffff; font-size: 12px;">Los participantes podrán elegir una opción relacionada a los
                        equipos jugadores. Por ejemplo:<br/>
                        Seleccionar el Equipo A, Equipo B ó Empate.</p>-->
                </div>
                <div style="float: right; margin-top: 20px;">
                    <?php
                    if (!isset($width))
                        $width = '258';
                    if (!isset($height))
                        $height = '158';
                    ?>
                    <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" width="328" height="197" allowFullScreen="true">
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
                                   autoplay="false"
                                   flashvars="file=<?php echo Yii::app()->createUrl('/webassets/videos/HollyDaze_30-SD.mp4') ?>&autostart=true&stretching=exactfit&autoPlay=true&controlbar=none" />
                         </object>
                </div>
            </div>
        </div>
        <div class="row">
            <img src="/webassets/images/laliga/image_divider.png" style="position: relative; top: -325px;"/>
            <a href="/pickgame"><img src="/webassets/images/laliga/Button_juega-ahora.png" style="position: absolute; top: 465px; right: 365px"/></a>
        </div>
        <div class="row">
            <div class="col-sm-4 col-sm-offset-2" style="background-color: #2a3335; position: relative; top: -294px; margin-left: 14.9333%; min-width: 329px; min-height: 604px; margin-bottom: -200px;">
                <h3 style="text-align: left; color: #edbc5a;font-weight: 300;">How to play.</h3>
                <p style="text-align: left; color: #ffffff; font-size: 12px;">
                    The draw for the sweepstakes winner will be held at the close
                    of the entry period during the month of December.
                    All entries to the drawing must be received before the close of a game.
                    Users can participate in the randomized sweepstakes through the website
                    or mobile platform by paying a dollar ($ 1.00) and selecting the correct
                    answers to the question. There is also a free method to participate,
                    check the website for more information and requirements.</p>
                <p style="text-align: left; color: #ffffff; font-size: 12px;">
                      After registering your account and adding credits through a valid credit card,
                      select the number of questions you would like to answer.
                      Multiple correct answers, will receive the cooresponding
                      entries to the winning entry charts.
                      Winners will be announced at the end of the game in the winners section of the website.
                    Users can participate in the randomized sweepstakes 
                    through the website or mobile platform by paying a dollar
                    ($ 1.00) and selecting the correct answers to the question.
                </p>
                <p style="text-align: left; color: #ffffff; font-size: 12px;">
                   There is also a free method to participate, 
                    check the website for more information and requirements.
                    After registering your account and adding credits through
                    a valid credit card, select the number of questions you would like to answer.
                    Multiple correct answers, will receive the cooresponding entries to the winning entry charts.
                    Winners will be announced at the end of the game in the winners section of the website.
                </p>
            </div>
            <div class="col-sm-4" style="background-color: #2a3335; position: relative; top: -294px; margin-left: 0.9633%; min-width: 321px; min-height: 201px;">
                <h3 style="text-align: left; color: #edbc5a;font-weight: 300;">Prizes.</h3>
                <p style="text-align: left; color: #ffffff; font-size: 12px;">
                    There are several prizes to win throughout the month of December. 
                    A luxury trip.  A Gucci Purse. A VIP Superbowl party for 50 people. 
                    Check the rules for the terms and values associated with each prize.
                </p>
            </div>
            <div class="col-sm-4" style="background-color: #2a3335; position: relative; top: -324px; margin-left: 0.9633%; min-width: 321px; min-height: 211px; margin-top: 10px;">
                <h3 style="text-align: left; color: #edbc5a;font-weight: 300;">The Winners</h3>
                <p style="text-align: left; color: #ffffff; font-size: 12px;">
                    The winners of each draw will be selected by a random drawing
                    of all participants who selected the correct answers during
                    the entry period associated with the prize. The prize draw will take
                    place during or after the close of the official close of the submission window.
                    There will only be one winner selected for each prize.
                </p>
            </div>
        </div>
    </div>
</div>