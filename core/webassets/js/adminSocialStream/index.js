var customTrack = '';
var tweets = new Array;
var streaming = null;

var searchHandler = function() {
    $('#stream').off('submit');
    $('#stream').on('submit', function(e) {
        e.preventDefault();
        if (streaming) {
            clearTimeout(streaming);
            streaming = null;
        }
        paused = true;
        $('#ret').html('Stream Paused...');
        $('#toggleStream').html('Start Stream');
        var request = $.ajax({
            url: '/adminSocialStream/ajaxStartStream',
            type: 'POST',
            data: ({
                'CSRF_TOKEN': getCsrfToken(),
                'track': $('#track').val(),
            }),
            success: function(data) {
                customTrack = $('#track').val();
                pos = 0;
                paused = false;
                $('#toggleStream').html('Pause Stream');
                timer = 1000;
                readStream();
            }
        });
        return false;
    });
}


var storeHandler = function(e) {
    $('.storeSearch').off('change');
    $('.storeSearch').on('change', function(e) {
        e.preventDefault();
        $(this).attr({'disabled': 'disabled'})
        var data = tweets[$(this).attr('rel')];
        data.CSRF_TOKEN = getCsrfToken();
        data.questionid = $(this).val();
        var request = $.ajax({
            url: '/adminSocialSearch/save',
            type: 'POST',
            data: $.param(data),
            success: function(data) {
                var obj = $.parseJSON(data);
                if (obj.code == 'saved') {
                    //alert('Social Search Saved!');
                } else {
                    var errors = '';
                    $.each(obj.errors, function(k, v) {
                        errors += v + "\r\n";
                    })
                    alert(obj.code + ':\r\n' + errors);
                }
            }
        });
    });
}

var toggleStream = function() {
    if (paused) {
        paused = false;
        $('#toggleStream').html('Pause Stream');
        timer = 1000;
        readStream();
    } else {
        if (streaming) {
            clearTimeout(streaming);
            streaming = null;
        }
        paused = true;
        $('#ret').html('Stream Paused...');
        $('#toggleStream').html('Start Stream');
    }
}

var startStream = function() {
    var request = $.ajax({
        url: '/adminSocialStream/ajaxStartStream',
        type: 'POST',
        data: ({
            'CSRF_TOKEN': getCsrfToken()
        }),
        success: function(data) {
            $('#stopStream').attr('disabled', false);
            $('#startStream').attr('disabled', 'disabled');
            $('#ret').html('Stream Started...');
            pos = 0;
            timer = 1000;
            objNum = 0;
            paused = false;
            tweets = new Array();
            readStream();
        }
    });
}

var readStream = function() {
    $('#ret').html('Reading Stream...');
    var request = $.ajax({
        url: '/adminSocialStream/ajaxReadStream',
        type: 'POST',
        data: ({
            'CSRF_TOKEN': getCsrfToken(),
            'position': pos,
            'track': customTrack,
        }),
        success: function(data) {
            if (!paused) {
                streamObj = $.parseJSON(data);
                
                if(streamObj.error != 'undefined') {
                    alert(streamObj.error);
                } else {

                    if (typeof(streamObj.tweets) != 'undefined') {
                        $('#ret').html('Loading Results...');
                        $.each(streamObj.tweets, function(i, e) {
                            $('#resultsTable').dataTable().fnAddData([
                                objNum,
                                $(e.questions).attr({'rel': objNum}).prop('outerHTML'),
                                $('<a>').attr({'href': e.accountLink, 'target': '_blank'}).html($('<img>').attr({'src': e.avatar})).prop('outerHTML'),
                                $('<a>').attr({'href': e.accountLink, 'target': '_blank'}).html($('<div>').append($('<div>').html(e.username)).append($('<div>').html(e.accountDescription).css({'display': 'none'}))).prop('outerHTML'),
                                e.timestamp,
                                $('<div>').html(e.date).prop('outerHTML'),
                                $('<div>').html(e.content).prop('outerHTML'),
                                $('<div>').html(e.hashtag).prop('outerHTML'),
                                $('<div>').html(e.clean.pass.toString()).prop('outerHTML'),
                                $('<div>').html(e.accountClean.pass.toString()).prop('outerHTML'),
                                $('<div>').html(e.media.toString()).prop('outerHTML'),
                                $('<div>').html(e.language).prop('outerHTML'),
                                $('<div>').html(e.accountLanguage).prop('outerHTML'),
                                $('<div>').html(e.verified.toString()).prop('outerHTML'),
                                $('<div>').html(e.hasLocation.toString()).prop('outerHTML'),
                                $('<div>').html(e.place).prop('outerHTML'),
                                e.placeCoordinates.toString(),
                                e.tweetCoordinates.toString(),
                                e.followers,
                                e.following,
                            ]);
                            storeHandler();
                            tweets[objNum] = e;
                            objNum++;
                        });
                    }
                    pos = streamObj.endPos;
                    if (parseInt(streamObj.endPos) > parseInt(streamObj.beginPos)) {
                        timer = 1000;
                    } else {
                        timer = timer * 2;
                        if (timer > 60000) {
                            timer = 60000;
                        }
                        secs = timer / 1000
                        $('#ret').html('End of Stream, Pausing for ' + secs + ' seconds.');
                    }
                    if (!paused) {
                        streaming = setTimeout('readStream()', timer);
                    }
                }
            }
        }
    });

}

function makeDataTable() {
    rTable = $("#resultsTable").dataTable({
        "aaSorting": [[5, "desc"]],
        "aoColumns": [
            {"sType": "numeric", "bVisible": false},
            {"sType": "null", "sWidth": "50px"},
            {"sType": "null", "sWidth": "50px"},
            {"sType": "html"},
            {"sType": "numeric", "bVisible": false},
            {"sType": "string"},
            {"sType": "html", "sClass": "tleft", "sWidth": "800px"},
            {"sType": "string", "bVisible": false},
            {"sType": "string", "bVisible": false},
            {"sType": "string", "bVisible": false},
            {"sType": "string", "bVisible": false},
            {"sType": "string"},
            {"sType": "string"},
            {"sType": "string", "bVisible": false},
            {"sType": "string", "bVisible": false},
            {"sType": "string"},
            {"sType": "string", "bVisible": false},
            {"sType": "string", "bVisible": false},
            {"sType": "currency"},
            {"sType": "currency"},
        ],
        "fnDrawCallback": function(oSettings) {
            storeHandler();
        },
        "sDom": '<flipt>',
    });
}