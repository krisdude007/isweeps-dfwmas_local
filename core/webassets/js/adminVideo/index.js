
$(document).ready(function () {
    socialHandlers();
    datePickerHandlers();
    autoCompleteHandlers();
    overlayHandlers();
    videoStatusHandlers();
    videoFilterHandlers();
    buttonHandlers();
    filmstripHandlers();
    importHandler();
    uploadHandler();
});


var uploadHandler = function() {
    
    $('#videoUploadTags').tagit({
    //availableTags: sampleTags
    });
    
    var videoUploadTrigger = $("#videoUploadOverlay").overlay({
        mask: '#000',
        effect: 'default',
        top: 25,
        closeOnClick: true,
        closeOnEsc: true,
        fixed: true,
        oneInstance: true,
        api: true
    });
    
    $('#fab-upload-video-button').off('click');
    $('#fab-upload-video-button').on('click',function(e){
        e.preventDefault();
        $("#videoUploadOverlay").overlay().load();
    });
    
    
    // hide question initially
    //$('#question_selector').attr('disabled','disabled');
    $('#question_selector').hide();
    
    if($("#FormVideoUpload_is_ad_1").length === 0)
    {
        $('#question_selector').show();
        $('#company_info').hide();
        $('#FormVideoUpload_is_ad_0').attr("disabled", true);
    }
    
    // upload question select
    $('.is_ad_selector').off('click');
    $('.is_ad_selector').on('click',function(e){

        // disable question dropdown if they select yes
       if($(this).attr('value') == '1') {
         //$('#question_selector').attr('disabled','disabled');
         $('#question_selector').hide();
         $('#company_info').show();
       } else {
         //$('#question_selector').removeAttr('disabled');
         $('#question_selector').show();
         $('#company_info').hide();
       }
       
    });

    
}


var importHandler = function(){
    
    var videoImportTrigger = $("#videoImportOverlay").overlay({
        mask: '#000',
        effect: 'default',
        top: 25,
        closeOnClick: true,
        closeOnEsc: true,
        fixed: true,
        oneInstance: true,
        api: true
    });
    
    
    
    
    $('#fab-import-button').off('click');
    $('#fab-import-button').on('click',function(e){
        e.preventDefault();
        $("#videoImportOverlay").overlay().load();
    });
    
    
    $('.fab-import-source-button').off('click');
    $('.fab-import-source-button').on('click',function(e){
        e.preventDefault();
        var source = $(this).html();
        $("#videoImportOverlay").overlay().close();

        var elem = $('#fab-import-button').replaceWith($('<img></img>').attr({
            'id':'spinner_import',
            'src':'/core/webassets/images/socialSearch/ajaxSpinner.gif'
        }).css({
            'width':'25px',
            'margin-left':'75px',
            'margin-top':'10px'
        }));                
        var request = $.ajax({
            url: '/adminVideo/ajaxVideoImport?source=' + source,
            type: 'POST',
            data:({
                'CSRF_TOKEN': getCsrfToken()
            }),
            success: function(data){
                if(data) {
                    alert(data);
                }
                window.location.reload();
            }
        });
        
    });
    
}

/**
 * Takes a status and updates all checked videos with that status
 */
function updateAllVideoStatuses(newStatus, currentStatus) {
  /*
    var id = null;
    
    $('.fab-main-videos').find('input:checkbox').each(function(){
        id = $(this).attr('value');
        
        if($(this).is(':checked')) {
            updateVideoStatus(newStatus, currentStatus, id);
        }
        
        var clickedElement = null;
        switch(newStatus) {
            case 'accepted':
                clickedElement = $("#videoAcceptAll");
                break;
            case 'denied':
                clickedElement = $("#videoDenyAll");
                break;
        }
        
        // uncheck the ALL checkboxes
        $('#fab-check_box').prop('checked', false);
        // remove greyed out button class
        clickedElement.removeClass("fab-grey");
    });
  */
 alert('This feature has been temporarily disabled.');
}


/**
 * Takes a status and video id, and updates that video with that status
 */
function updateVideoStatus(newStatus, currentStatus, videoId){
  var optSendEmail ='Y';
  var btnType = '';
  if(newStatus == 'accepted') {
    btnType = 'accept';
  } else {
    btnType = 'deny';
  }
  if($("#optSendEmail").length > 0)
  {
    optSendEmail = $("#optSendEmail :selected").val(); 
  }
  
    var elem = $("#fab-" + btnType + "-button" + videoId).replaceWith($('<img></img>').attr({
            'id':'spinner_video_status_' + videoId,
            'src':'/core/webassets/images/socialSearch/ajaxSpinner.gif'
        }).css({
            'width':'20px',
            'margin-top':'4px'
        }));         

    var request = $.ajax({
        url: '/adminVideo/ajaxVideoUpdateStatus',
        type: 'POST',
        data:({
            'status': newStatus,
            'currentStatus': currentStatus,
            'videoId': videoId,
            'CSRF_TOKEN': getCsrfToken(),
            'optSendEmail':optSendEmail
        }),
        success: function(data){
            // if current filter is all, do not hide 
            // the video
            if(currentStatus != 'all') {
                $("#video" + videoId).hide(1000);
            } else {
                if(newStatus == 'accepted') {
                    
                    $("#video" + videoId).fadeOut(500, function() {
                        $('#fab-accept-button' + videoId).hide();
                        $('#fab-deny-button' + videoId).show();
                        $("#videoIcons" + videoId).show();
                        $("#video" + videoId).fadeIn(500);
                    });
                    
                } else {
                    
                    $("#video" + videoId).fadeOut(500, function() {
                        $('#fab-deny-button' + videoId).hide();
                        $('#fab-accept-button' + videoId).show();
                        $("#videoIcons" + videoId).hide();
                        $("#video" + videoId).fadeIn(500);
                    });
                }
            }
        },
        error: function(data){
            alert('Unable to update video status.');
            return false;
        }
    });   
}

/**
 * Takes a status and video id, and updates that video with that status
 */
function videoFtp(buttonObj){
    
    var id = $(buttonObj).attr('alt');
    
    if(confirm('Are you sure you want to upload this video?')){

        var elem = $(buttonObj).replaceWith($('<img></img>').attr({
            'id':'spinner_ftp_' + id,
            'src':'/core/webassets/images/socialSearch/ajaxSpinner.gif'
        }).css({
            'width':'20px',
            'margin-top':'4px'
        }));         


        var request = $.ajax({
            url: '/adminVideo/ajaxVideoFTP',
            type: 'POST',
            data:({
                'id': id,
                'CSRF_TOKEN': getCsrfToken()
            }),
            dataType: "json",
            success: function(data){
                $('#spinner_ftp_'+id).replaceWith(elem);
                alert(data.response);
                return true;
            },
            error: function(data){
                $('#spinner_ftp_'+id).replaceWith(elem);
                //alert(data.response);
                return false;
            }
        });   
        
    }
}


/**
 * Handlers
 */
var socialHandlers = function(){ 
    $('#clientShareTwitterTrigger, #clientShareTwitterModalTrigger').off('click');
    $('#clientShareTwitterTrigger, #clientShareTwitterModalTrigger').on('click',function(e){    
        e.preventDefault();
        if(confirm('Are you sure you want to Tweet this?')){
            var video_id = $(this).attr('rev');
            var message = $('#message').val();
            var elem = $(this).replaceWith($('<img></img>').attr({
                'id':'spinner_tw_'+video_id,
                'src':'/core/webassets/images/socialSearch/ajaxSpinner.gif'
            }).css({
                'width':'25px'
            }));        
            var request = $.ajax({
                url:"/admin/ajaxClientShareTwitter",
                type:'POST',
                data:({
                    'CSRF_TOKEN':getCsrfToken(),
                    'type':'video',
                    'id':video_id,
                    'message':message,
                }),
                success: function(data){
                    alert('Twitter Says: '+data);
                    $('#spinner_tw_'+video_id).replaceWith(elem);
                    socialHandlers();
                }
            });
        }
    });
  
    $('#clientShareFacebookTrigger, #clientShareFacebookModalTrigger').off('click');
    $('#clientShareFacebookTrigger, #clientShareFacebookModalTrigger').on('click',function(e){   
        e.preventDefault();
        if(confirm('Are you sure you want to post this to facebook?')){
            var video_id = $(this).attr('rev');
            var message = $('#message').val();
            var elem = $(this).replaceWith($('<img></img>').attr({
                'id':'spinner_fb_'+video_id,
                'src':'/core/webassets/images/socialSearch/ajaxSpinner.gif'
            }).css({
                'width':'25px'
            }));
            FB.login(function(response) {
                if (response.authResponse) {            
                    var request = $.ajax({
                        url:"/user/ajaxFacebookConnect",
                        type:'POST',
                        data:({
                            'CSRF_TOKEN':getCsrfToken(),
                            'accessToken':response.authResponse.accessToken,
                            'expiresIn':response.authResponse.expiresIn,
                            'userID':response.authResponse.userID
                        }),
                        success: function(data){
                            var request = $.ajax({
                                url:"/admin/ajaxClientShareFacebook",
                                type:'POST',
                                data:({
                                    'CSRF_TOKEN':getCsrfToken(),
                                    'type':'video',
                                    'id':video_id,
                                    'message':message,
                                }),
                                success: function(data){
                                    alert('Facebook Says: '+data);
                                    $('#spinner_fb_'+video_id).replaceWith(elem);
                                    socialHandlers();
                                }
                            });
                        }
                    });
                }
            },{
                scope: 'user_location,user_birthday,email,publish_stream,publish_actions,status_update,manage_pages'
            });                                
        }
    });
}

var datePickerHandlers = function() {
    // datepickers for datestart datestop on video filters
    $( "#datepickerVideoFilterStart" ).datepicker({
        maxDate: "0"
    });
    $( "#datepickerVideoFilterStop" ).datepicker({
        maxDate: "0"
    });
    
    $( "#datepickerVideoViewsFilterStart" ).datepicker({
        maxDate: "0"
    });
    $( "#datepickerVideoViewsFilterStop" ).datepicker({
        maxDate: "0"
    });
}

var autoCompleteHandlers = function() {
    // autocomplete for user filter
    var cache = {};
    var dataCache;
    var uiItem;
    var userId;
        
    $( "#userAutoCompleter" ).autocomplete({
        minLength: 2,
        source: function( request, response ) {
            var term = request.term;
            
            if ( term in cache ) {
                response( cache[ term ] );
                return;
            }
 
            $.getJSON("/adminVideo/ajaxVideoGetUsers", request, function( data, status, xhr ) {
                cache[ term ] = data;
                dataCache = data;
                response( data );
            });
        },
        select: function( event, ui ) {
            // iterate thru cached data to find associated user id
            uiItem = ui.item.value;
            
            for(i=0; i< dataCache.length; i++) {
                if(dataCache[i].label == uiItem) {
                    userId = dataCache[i].id;
                    uiItem = userId;
                    $("#userIdAutoComplete").val(userId);
                    
                }
            }
        }
    });
}

var overlayHandlers = function() {
    /**
    * VIDEO OVERLAY
    * Provides method for showing overlay when video is clicked or when history
    * is clicked.
    */
    $("a[rel], button[rel]").overlay({
 
        mask: '#000',
        effect: 'default',
        top: 25,
        closeOnClick: true,
        closeOnEsc: true,
        fixed: true,
        oneInstance: true,
        api: true,

        onBeforeLoad: function() {
            // grab wrapper element inside content
            var wrap = this.getOverlay().find(".videoModalContent");

            // load the page specified in the trigger
            var url = this.getTrigger().attr("href");
            
            // quick hack to tack on status for video modal
            if(this.getTrigger().attr("class") == 'videoModalTrigger') {
                url = url + $('#fab-select-accept').val();
            }
      
            wrap.html('');
            wrap.load(url);
        }
    });
}

var videoStatusHandlers = function() {
    /**
    * Handle accept/deny buttons
    */
    $('.fab-accept-button, .fab-modal-accept-button').each(function(){
        status = $(this).val();
        if(status == 'all')
        {
            $(this).hide();
        }
        else if(status != 'accepted' || status == 'new') {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
    
    $('.fab-deny-button, .fab-modal-deny-button').each(function(){
        status = $(this).val();
    
        if(status == 'all')
        {
            $(this).hide();
        }
        else if(status != 'denied' || status == 'new') {
            $(this).show();
        } else {
            $(this).hide();
        }
    });

    $('#videoAcceptAll').click(function() {
        updateAllVideoStatuses('accepted');
    });
    
    $('#videoDenyAll').click(function() {
        updateAllVideoStatuses('denied');
    });
  
    /**
    * Handler for checkboxes
    */
    $('#fab-check_box').click(function () {

        var checked_status = this.checked;
        $('.fab-main-videos').find('input:checkbox').each(function(){
            this.checked = checked_status;
        });
    });

    var optionVal=$("#fab-select-accept").val();
    if (optionVal=='v1'){
        $(".fab-accepted-video").show();
        $(".fab-not-accepted-video").hide();
    } else if (optionVal=='v2'){
        $(".fab-accepted-video").hide();
        $(".fab-not-accepted-video").show();
    }

    $("#fab-select-accept").change(function(){ 
        var optionVal=$(this).val();
        if (optionVal=='v1'){
            $(".fab-accepted-video").show();
            $(".fab-not-accepted-video").hide();
        } else if (optionVal=='v2'){
            $(".fab-accepted-video").hide();
            $(".fab-not-accepted-video").show();
        }
                    
    });
}

var videoFilterHandlers = function() {
    /**
    * Handle results per page
    */
    $('#perPage').change(function() {
        //window.location = '/adminVideo/index?perPage=' + $(this).val();
        });
  
    /**
    * Advanced filtering button
    */
    $("#fab-advanced-button").click(function(){
        if($("#fab-advanced-filtering").hasClass('fab-show')){
            $("#fab-advanced-filtering").removeClass('fab-show');
            $("#fab-advanced-filtering").addClass('fab-hide');
                        
            $(".fab-form-right").css('height','115px');
        } else {
            $("#fab-advanced-filtering").removeClass('fab-hide');
            $("#fab-advanced-filtering").addClass('fab-show');
            $(".fab-form-right").css('height','144px');
        }
    });
}

var buttonHandlers = function() {
    // fb, twitter, ftp video icons
    $('.videoIconFTP').off('click');
    $('.videoIconFTP').on('click',function(e){
        e.preventDefault();
        videoFtp($(this));
    });

    
    $(".videoIcon").hover(
        function () {
            $(this).css('cursor', 'pointer');
            $(this).fadeTo('fast', 0.5, function() {
                });
        },
        function () {
            $(this).css('cursor', 'pointer');
            $(this).fadeTo('fast', 1, function() {
                });
        }
        );

    $("button").hover(
        function () {
            $(this).addClass('fab-grey');
        },
        function () {
            $(this).removeClass('fab-grey');
        }
        );
        
    $("button").click(function (e) {
        e.preventDefault();
    });
}

var filmstripHandlers = function(){
    $('.videoThumbnail').on('mouseover', function() {
        $(this).attr({
            'src':$(this).attr('src').replace('.png','.gif')
            });
    });
    
    $('.videoThumbnail').on('mouseout', function(){
        $(this).attr({
            'src':$(this).attr('src').replace('.gif','.png')
            });
    });    
}
