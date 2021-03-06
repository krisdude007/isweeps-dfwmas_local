<?php
// page specific css
$cs = Yii::app()->clientScript;
$cs->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/adminSocialSearch/index.css');
$cs->registerCssFile('/core/webassets/css/jquery.dataTables_themeroller.css');

// page specific js
$cs->registerScriptFile('/core/webassets/js/jquery.dataTables.min.js', CClientScript::POS_END);
$cs->registerScriptFile('/core/webassets/js/jquery.dataTables.dateFormat.js', CClientScript::POS_END);
$cs->registerScriptFile('/core/webassets/js/jquery.dataTables.currency.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/adminSocialSearch/index.js', CClientScript::POS_END);
if (Yii::app()->request->getParam('hashtag') != '') {
    $cs->registerScript('lazyClient', '$("#spinnerReplace").trigger("click")', CClientScript::POS_READY);
}
$this->renderPartial('/admin/_csrfToken');
?>


<!-- BEGIN PAGE -->
<div class="fab-page-content">
    <!-- BEGIN PAGE CONTAINER-->
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
    <div style="background:#4bb55a" id="fab-top">
        <h2 style="color:white" class="fab-title"><img class="floatLeft" style="margin-right: 10px;" src="<?php echo Yii::app()->request->baseUrl; ?>/core/webassets/images/social-image.png">Social Search</h2>
    </div>
    <!-- END PAGE TITLE & BREADCRUMB-->
    <div class="fab-container-fluid">
        <div style="padding:0 20px;">
            <h2>Social Searching (Twitter)</h2>
            <div>


                <div id="searchTypeTabs">
                    <ul>
                        <li><a href="#searchTypeTabs-1">Search by Terms</a></li>
                        <li><a href="#searchTypeTabs-2">Search by Username</a></li>
                    </ul>
                    <div id="searchTypeTabs-1">



                        <form id="search">
                            <div class="floatLeft">
                                <label for="terms">Search Terms:<span style='color:#8B8686;font-size:12px;padding-left:20px;'>* type your search terms here, separated by comma</span></label>
                            </div>
                            <div style="clear:both;">
                            </div>
                            <div class="row search">
                                <?php $purifier = new CHtmlPurifier(); ?>
                                <span class='span2'>
                                    <textarea  id="terms" rows='5' cols='60' name="terms" ><?php echo (Yii::app()->request->getParam('hashtag') != '') ? $purifier->purify(Yii::app()->request->getParam('hashtag')) : Yii::app()->params['ticker']['defaultHashtag']; ?></textarea>
                                </span>
                                <span class='span1'>
                                    <select name="boolean">
                                        <option>AND</option>
                                        <option selected="selected">OR</option>
                                        <option>NOT</option>
                                    </select>
                                </span>
                                <span class='span2'>
                                    <input type="text" id="filters" name="filters" value="<?php echo!empty(Yii::app()->twitter->accountName) ? Yii::app()->twitter->accountName : NULL; ?>"/>
                                    <input type="hidden" id="q" name="q" value="<?php echo (int)Yii::app()->request->getParam('q'); ?>"/>
                                </span>
                                <span class='span1 text-center'>
                                    <button id="spinnerReplace" type="submit" class='fab-btn'>Submit</button>
                                    <div id="ajaxSpinner" class="" style="display:none;">
                                        <center>
                                            <img style="height:40px" src="/core/webassets/images/socialSearch/ajaxSpinner.gif" />
                                        </center>
                                        <button class='fab-btn' type="reset"/>Stop</button>
                                    </div>
                                </span>
                            </div>

                        </form>





                    </div>
                    <div id="searchTypeTabs-2">
                        
                        
                        
                        
                        <form id="searchUsers">
                            <div class="floatLeft">
                                <label for="terms">Search Users:<span style='color:#8B8686;font-size:12px;padding-left:20px;'>* type your usernames (Twitter handles) here, separated by comma</span></label>
                            </div>
                            <div style="clear:both;">
                            </div>
                            <div class="row search">
                                <?php $purifier = new CHtmlPurifier(); ?>
                                <span class='span2'>
                                    <textarea  id="terms2" rows='5' cols='60' name="terms" ></textarea>
                                </span>
                                <span class='span1'>
                                    <input type='hidden' name='boolean' value='OR' />
                                </span>
                                <span class='span2'>
                                    <input id='filters2' type='hidden' name='filters' value='' />
                                </span>
                                <span class='span1 text-center'>
                                    <button id="spinnerReplace2" type="submit" class='fab-btn'>Submit</button>
                                    <div id="ajaxSpinner2" class="" style="display:none;">
                                        <center>
                                            <img style="height:40px" src="/core/webassets/images/socialSearch/ajaxSpinner.gif" />
                                        </center>
                                        <button class='fab-btn' type="reset"/>Stop</button>
                                    </div>
                                </span>
                            </div>

                        </form>
                        
                        
                        
                        
                        
                    </div>
                </div>





            </div>
            <div style="clear:both;">
            </div>
            <div style="margin-top:20px;margin-bottom:20px">
                <div class="rates" style="margin-top:20px;"></div>
                <div class="errors" style="margin-top:20px;"></div>
            </div>
            <div id="resultsDiv">
                <?php
                if (Yii::app()->twitter->advancedFilters === true) {
                    $this->renderPartial('/admin/_twitterFilters', array('questions' => $questions, 'cs' => $cs));
                }
                ?>
                <div class='clearfix'></div>
                <hr>
                <input type='hidden' id='counter' value='0'/>
                <div id='search_terms' style='display:none;'>
                    <h2>Search terms:</h2>
                    <div class='hint'>* Click the terms to show the results.</div>
                    <hr>

                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE -->
</div>
