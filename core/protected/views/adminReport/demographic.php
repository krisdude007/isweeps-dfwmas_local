<?php
// page specific css
$cs = Yii::app()->clientScript;
$cs->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/jquery-ui-1.10.0.css');
$cs->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/adminReport/demographic.css');
$cs->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/_yttJqPlot.css');
$cs->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/js/jqplot.1.0.5/jquery.jqplot.min.css');
$cs->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/js/jqplot.1.0.5/syntaxhighlighter/styles/shCoreDefault.min.css');
$cs->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/js/jqplot.1.0.5/syntaxhighlighter/styles/shThemejqPlot.min.css');
$cs->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/iphonebuttons.css');
$cs->registerCssFile('/core/webassets/css/jquery.dataTables_themeroller.css');

// page specific js
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jquery.blockui.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/adminReport/demographic.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jqplot.1.0.5/jquery.jqplot.min.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jqplot.1.0.5/syntaxhighlighter/scripts/shCore.min.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jqplot.1.0.5/syntaxhighlighter/scripts/shBrushJScript.min.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jqplot.1.0.5/syntaxhighlighter/scripts/shBrushXml.min.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jqplot.1.0.5/plugins/jqplot.highlighter.min.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jqplot.1.0.5/plugins/jqplot.dateAxisRenderer.min.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jqplot.1.0.5/plugins/jqplot.barRenderer.min.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jqplot.1.0.5/plugins/jqplot.categoryAxisRenderer.min.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jqplot.1.0.5/plugins/jqplot.pointLabels.min.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jqplot.1.0.5/plugins/jqplot.pieRenderer.min.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jqplot.1.0.5/plugins/jqplot.donutRenderer.min.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jqplot.1.0.5/plugins/jqplot.enhancedLegendRenderer.cust.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/formater.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/iphone-style-checkboxes.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jquery.dataTables.min.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jquery.dataTables.fnDisplayRow.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jquery.dataTables.currency.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/_grapher.js', CClientScript::POS_HEAD);
?>

<script type="text/javascript">
var oTable;

// This is here because of a race condition with Google maps' call which has a document.write() kills this code if its already loaded
$(document).ready(function(){
    $('#tabs').tabs();
    lineGrapher('demographicGraph', '<?php echo $model;?>', 'ajaxGetLineGraphData', '<?php echo $startDate; ?>', '<?php echo $endDate; ?>', '<?php echo $scope;?>', <?php echo is_null($pollId) ? 'null' : $pollId;?>);
    var oTable = $('#demographicTable').dataTable( {
        "fnPreDrawCallback": function() {
        },
        "fnDrawCallback": function() {
            //alert('test');
            //$(".blockUI").hide();
            $.unblockUI({ fadeOut: 500 });
        },
//        "bJQueryUI": true,
        "bAutoWidth": false,
        "sPaginationType": "full_numbers",
        "aaSorting": [[ 8, "desc" ]],
        "bSortClasses": false,
        "aoColumns": [

            /* First Name */    { "sWidth": "10%" },
            /* Last Name */     { "sWidth": "10%" },
            /* Email */         { "sWidth": "30%" },
            /* Votes */         { "sWidth": "5%" },
            /* Videos */        { "sWidth": "5%" },
            /* Last Login */    { "sWidth": "10%" },
            /* Join Date */     { "sWidth": "10%" },
            /* Zip */           { "sWidth": "10%" },
            /* Income */        { "sWidth": "10%", "sType": "currency" }
            /* userid           { "bVisible":    false } */

        ]
    });

    markerMgr.oTable = oTable;
    $('#demographicTable_paginate').click(function(){markerMgr.updateClickFunction(); });
    $('#demographicTable_length select').change(function(){markerMgr.updateClickFunction();});
});
jQuery(window).load(function () {
    $('#mapTab').click(function(){
        markerMgr.init();

        $('#usegmm').iphoneStyle();
        $('#usegmm').parent().click(function(){
            if(this.checked){
                this.checked = false;
                markerMgr.change();
            }else{
                this.checked = true;
                markerMgr.change();
            }
        });
    });
});
</script>
<?php $this->renderPartial('/admin/_csrfToken', array()); ?>
<!-- BEGIN PAGE -->
<div class="fab-page-content">
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
    <div id="fab-top">
        <h2 class="fab-title"><img style="margin-right: 10px;float:left;" src="<?php echo Yii::app()->request->baseUrl; ?>/core/webassets/images/reports-image.png">Reports Demographics</h2>
    </div>
    <!-- END PAGE TITLE & BREADCRUMB-->
    <!-- BEGIN PAGE CONTAINER-->
    <div>
        <div class="fab-container-fluid">
            <!-- END PAGE HEADER-->
            <?php $this->renderPartial('_dateFilterLinks', array('daysBack' => $daysBack, 'request' => $_GET['request'], 'startDate' => $startDate, 'endDate' => $endDate));?>
            <div class="clearFix"></div>
            <?php
                if (sizeof($demographicData) > 0):
            ?>
<!--            <div id="tabs">
                <ul>
                    <li class="tabs"><a href="#tabs-1" id="graphTab">Graph</a></li>-->
<!--                    <li class="tabs"><a href="#tabs-2" id="mapTab">Demographic Map</a></li>-->
<!--                </ul>
                <div id="tabs-1">
                    <div id="demographicGraph" style="padding-right:104px;">
                    </div>
                </div>-->
                
<!--                <div id="tabs-2">
                    <?php   //These have to be declared here to resolve race condition brought on by google map's jsapi
//                    echo '<script type="text/javascript" src="'.Yii::app()->request->baseurl . '/core/webassets/js/fusionSrc/jsapi.js"></script>';
//                    echo '<script type="text/javascript" src="'.Yii::app()->request->baseurl . '/core/webassets/js/fusionSrc/markercluster.js"></script>';
//                    echo '<script type="text/javascript" src="'.Yii::app()->request->baseurl . '/core/webassets/js/fusionSrc/markerDropper.js"></script>';
                    ?>
                    <script type="text/javascript">

                    <?php //echo "var data = ".json_encode($records).";" ?>
                    google.load("maps", "3", {
                        other_params: "sensor=false"
                    });

                    google.setOnLoadCallback(markerMgr.init);

                    </script>
                    <div id="map" class="clearFix"></div>
                    <div class="clearFix" style="margin-top:15px; margin-bottom:24px;">
                        <div style="float:left; margin:4px;">Cluster Markers</div>
                        <div style="float:left;">
                            <input type="checkbox" checked="checked" id="usegmm" />
                        </div>
                        <div class="clearFix"></div>
                    </div>
                    <div class="data clearFix">
                        <?php //if (isset($error) && $error != ''): /// Where is this $error defined? ?>
                            <?php //echo $error; ?>
                        <?php //else: ?>
                            <?php //if (sizeof($demographicData) > 0): ?>
                            <table id="demographicTable">
                                <thead>
                                    <tr>
                                      <th class="grid_header_left">Last Name</th>
                                      <th class="grid_header_left">First Name</th>
                                      <th class="grid_header_left">Email</th>
                                      <th class="grid_header_left">Votes</th>
                                      <th class="grid_header_left">Videos</th>
                                      <th class="grid_header_left">Last Login Date</th>
                                      <th class="grid_header_left">Join Date</th>
                                      <th class="grid_header_left">Zip</th>
                                      <th style="grid_header_left">Avg. Income</th>
                                      <th>UserID</th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php //foreach ($records['records'] as $d) : ?>
                                    <tr id="<?php //echo $d['UserID']; ?>">
                                        <td><?php //echo $d['LastName']; ?></td>
                                        <td><?php //echo $d['FirstName']; ?></td>
                                        <td><?php //echo $d['Email']; ?></td>
                                        <td><?php //echo $d['Videos']; ?></td>
                                        <td><?php //echo $d['Votes']; ?></td>
                                        <td><?php //echo (($d['LastLoginDate'] == '') ? 'n/a' : date('M j, Y', strtotime($d['LastLoginDate']))); ?></td>
                                        <td><?php //echo (($d['JoinDate'] == '') ? 'n/a' : date('M j, Y', strtotime($d['JoinDate']))) ; ?></td>
                                        <td><?php //echo $d['ZipCode']; ?></td>
                                        <td><?php //echo number_format($d['AreaHouseholdIncome']); ?></td>
                                    </tr>
                             <?php //endforeach; ?>
                                <tbody>
                            </table>
                            <?php //else: ?>
                                <?php //echo 'No data available'; ?>
                            <?php //endif; ?>
                       <?php //endif;?>

                    </div>
                    <div class="clearFix"></div>
                </div>-->
<!--            </div>-->
            <img src="/core/webassets/images/demographics3.jpeg" style="width: 900px;"/>
            <?php else: ?>
<!--            <h3>No Data Available</h3>-->
            <img src="/core/webassets/images/demographics3.jpeg" style="width: 900px;"/>
            <?php endif; ?>
        </div>
    </div>
    <!-- END PAGE CONTAINER-->
</div>
<!-- END PAGE -->