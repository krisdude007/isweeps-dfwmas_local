<?php
$cs->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/_twitterFilters.css');
$cs->registerScriptFile('https://maps.googleapis.com/maps/api/js?libraries=drawing&sensor=false',CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/_twitterFilters.js', CClientScript::POS_END);
$cs->registerScript('twitter-filters',"filterHandler()",CClientScript::POS_READY);
$cs->registerScript('twitter-filter-tabs','$("#twitterFilterTabs").tabs({activate:function(ev,ui){var center = map.getCenter();google.maps.event.trigger(map, "resize");map.setCenter(center);}});',CClientScript::POS_READY);
$cs->registerScript('twitter-filter-map',"google.maps.event.addDomListener(window, 'load', initialize(".Yii::app()->twitter->filterLatitude.", ".Yii::app()->twitter->filterLongitide."))",CClientScript::POS_END);
?>

<label>Current Filters:</label>
<div id="currentFilters" /></div>
<div style="clear:both;padding-top:10px"></div>
<button id="clearFilters" type="button" onclick="clearFilters(false);">Clear All Filters</button>
<div id="twitterFilterTabs">
    <ul>
        <li><a href="#twitterFilterTab1">Application Filters</a></li>
        <li><a href="#twitterFilterTab2">Location Filters</a></li>
        <li><a href="#twitterFilterTab3">User Filters</a></li>
        <li><a href="#twitterFilterTab4">Tweet Filters</a></li>
    </ul>
    <div id="twitterFilterTab1" style="min-height:120px">
        <div class="floatLeft" style="margin-right:30px">
            <label>Category</label>
            <select class="Category twitterFilter categoryFilter">
                <option value="" selected="selected">Show All</option>
                <?php foreach ($questions as $question): ?>
                    <option value="<?php echo $question->hashtag; ?>"><?php echo $question->question ?> (#<?php echo $question->hashtag; ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div id="twitterFilterTab2" style="min-height:120px">
        <div style="float:left;margin-right:30px">
            <label>Location</label>
            <input type="radio" name="location" class="HasLocation twitterFilter locationFilter" value="" checked="checked"/>
            <span>Show All Tweets</span>
            <br/>
            <input type="radio" name="location" class="HasLocation twitterFilter locationFilter" value="true"/>
            <span>Show Tweets With Locations</span>
            <br/>
            <input type="radio" name="location" class="HasLocation twitterFilter locationFilter" value="false"/>
            <span>Show Tweets Without Locations</span>
        </div>
        <div style="float:left;margin-right:30px">
            <label>Places (space delimited, phrases encapsulated in quotes)</label>
            <span style="display:inline-block;min-width:150px">Include the following:</span>
            <input type="text" id="placesInclude" class="Place twitterFilter" value="" />
            <br/>
            <span style="display:inline-block;min-width:150px">Exclude the following:</span>
            <input type="text" id="placesExclude" class="Place twitterFilter" value="" />
            <br/>
            <button type="button" class="placeFilter">Filter By Place</button>
        </div>
        <div style="clear:both;margin-right:30px">
            <label>Area (Draw Shapes on Map)</label>
            <div><button type='button' onclick='removeFilter(15)'>Clear Shapes</button></div>
            <div id="map-canvas" style="height:400px;width:1200px;"></div>
        </div>
    </div>
    <div id="twitterFilterTab3" style="min-height:120px">
        <div style="float:left;margin-right:30px">
            <label>Language</label>
            <?php
            $languages = TwitterUtility::getLanguages();
            usort($languages,function($a,$b){return strcmp($a->name, $b->name);});
            ?>
            <input type="radio" name="accountLanguageInclusion" class="AccountLanguage twitterFilter accountLanguageInclusion" value="include" checked="checked"/> Include
            <input type="radio" name="accountLanguageInclusion" class="AccountLanguage twitterFilter accountLanguageInclusion" value=""/> Exclude
            <button type="button" onclick="resetAccountLanguage();">Reset Filter</button>
            <br/><br/>
            <select multiple class="AccountLanguage twitterFilter accountLanguageFilter" style="height:120px">
                <?php foreach ($languages as $language): ?>
                    <option value="<?php echo $language->code; ?>"> <?php echo $language->name ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div style="float:left;margin-right:30px">
            <label>Verification</label>
            <input type="radio" name="verified" class="Verified twitterFilter verifiedFilter" value="" checked="checked"/>
            <span>Show All Accounts</span>
            <br/>
            <input type="radio" name="verified" class="Verified twitterFilter verifiedFilter" value="true"/>
            <span>Show Verified Accounts</span>
            <br/>
            <input type="radio" name="verified" class="Verified twitterFilter verifiedFilter" value="false"/>
            <span>Show Unverified Accounts</span>
        </div>
        <div style="float:left;margin-right:30px">
            <label>Profanity</label>
            <input type="radio" name="accountProfanity" class="AccountClean twitterFilter accountProfanityFilter" value="" checked="checked"/>
            <span>Show All Accounts</span>
            <br/>
            <input type="radio" name="accountProfanity" class="AccountClean twitterFilter accountProfanityFilter" value="true"/>
            <span>Show Clean Accounts</span>
            <br/>
            <input type="radio" name="accountProfanity" class="AccountClean twitterFilter accountProfanityFilter" value="false"/>
            <span>Show Profane Accounts</span>
        </div>
        <div style="float:left;margin-right:30px">
            <label>Search (space delimited, phrases encapsulated in quotes)</label>
            <span style="display:inline-block;min-width:150px">Include the following:</span>
            <input type="text" id="accountsInclude" class="From twitterFilter" value="" />
            <br/>
            <span style="display:inline-block;min-width:150px">Exclude the following:</span>
            <input type="text" id="accountsExclude" class="From twitterFilter" value="" />
            <br/>
            <span style="display:inline-block;min-width:150px">Starts with the following:</span>
            <input type="text" id="accountsStartsWith" class="From twitterFilter" value="" />
            <br/>
            <span style="display:inline-block;min-width:150px">Ends with the following:</span>
            <input type="text" id="accountsEndsWith" class="From twitterFilter" value="" />
            <br/>
            <button type="button" class="accountFilter">Filter By Account</button>
        </div>
    </div>
    <div id="twitterFilterTab4" style="min-height:120px">
        <div style="float:left;margin-right:30px">
            <label>Language</label>
            <input type="radio" name="languageInclusion" class="TweetLanguage twitterFilter languageInclusion" value="include" checked="checked"/> Include
            <input type="radio" name="languageInclusion" class="TweetLanguage twitterFilter languageInclusion" value=""/> Exclude
            <button type="button" onclick="resetLanguage();">Reset Filter</button>
            <br/><br/>
            <select multiple class="TweetLanguage languageFilter" style="height:120px">
                <?php foreach ($languages as $language): ?>
                    <option value="<?php echo $language->code; ?>"> <?php echo $language->name ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div style="float:left;margin-right:30px">
            <label>Media</label>
            <input type="radio" name="media" class="Media twitterFilter mediaFilter" value="" checked="checked"/>
            <span>Show All Tweets</span>
            <br/>
            <input type="radio" name="media" class="Media twitterFilter mediaFilter" value="false"/>
            <span>Show Tweets Without Media</span>
            <br/>
            <input type="radio" name="media" class="Media twitterFilter mediaFilter" value="true"/>
            <span>Show Tweets With Media</span>
        </div>
        <div style="float:left;margin-right:30px">
            <label>Profanity</label>
            <input type="radio" name="profanity" class="TweetClean twitterFilter profanityFilter" value="" checked="checked"/>
            <span>Show All Tweets</span>
            <br/>
            <input type="radio" name="profanity" class="TweetClean twitterFilter profanityFilter" value="true"/>
            <span>Show Clean Tweets</span>
            <br/>
            <input type="radio" name="profanity" class="TweetClean twitterFilter profanityFilter" value="false"/>
            <span>Show Profane Tweets</span>
        </div>
        <div style="float:left;margin-right:30px">
            <label>Search (space delimited, phrases encapsulated in quotes)</label>
            <span style="display:inline-block;min-width:150px">Include the following:</span>
            <input type="text" id="keywordsInclude" class="Content twitterFilter" value="" />
            <br/>
            <span style="display:inline-block;min-width:150px">Exclude the following:</span>
            <input type="text" id="keywordsExclude" class="Content twitterFilter" value="" />
            <br/>
            <span style="display:inline-block;min-width:150px">Starts with the following:</span>
            <input type="text" id="keywordsStartsWith" class="Content twitterFilter" value="" />
            <br/>
            <span style="display:inline-block;min-width:150px">Ends with the following:</span>
            <input type="text" id="keywordsEndsWith" class="Content twitterFilter" value="" />
            <br/>
            <button type="button" class="keywordFilter">Filter By Keywords</button>
        </div>
    </div>
</div>
