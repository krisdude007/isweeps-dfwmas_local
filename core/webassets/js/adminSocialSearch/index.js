    var storeHandler = function(){
        $('.storeSearch').off('change');
        $('.storeSearch').on('change',function(e){
            e.preventDefault();
            $(this).attr({'disabled':'disabled'})
            var rel = $(this).attr('rel');
            if($(this).attr('value') != '')
                $("[question_rel_id="+rel+"]").attr({'src':'/core/webassets/images/lock.png', 'question_status':'lock'});
            else {
                $(this).attr({'disabled':false})
                $("[question_rel_id="+rel+"]").attr({'src':'/core/webassets/images/lock_open.png', 'question_status':'unlock'});
            }
            var data = searchObj[$(this).attr('rel')];
            data.CSRF_TOKEN = getCsrfToken();
            data.questionid = $(this).val();
            var request = $.ajax({
               url:'/adminSocialSearch/save',
               type:'POST',
               data:$.param(data),
               success:function(data){
                   var obj = $.parseJSON(data);
                   if(obj.code == 'saved'){
                       //alert('Social Search Saved!');
                   } else {
                       var errors = '';
                       $.each(obj.errors,function(k,v){
                           errors += v+"\r\n";
                       })
                       alert(obj.code+':\r\n'+errors);
                   }
               }
            });
        });
    }
    var searchHandler = function(){
        $('#search').off('reset');
        $('#search').on('reset',function(e){
            location.reload();
        });
        $('#search').off('submit');
        $('#search').on('submit',function(e){
            e.preventDefault();
            var terms = $('#terms').val().trim();
            var q = $('#q').val().trim();
            if(terms == '') {
            	alert('Searching terms can not be empty. please try it again.');
            	return false;
            }
            var terms_array = terms.split(/,+/);
            
            $('#search_terms').show();
            $('#ajaxSpinner').show();
            $('#spinnerReplace').hide();
            $('#spinnerReplace').attr("disabled", "disabled");
            var data = $(this).serializeArray();
            var csrf = new Object;
            csrf.name = 'CSRF_TOKEN';
            csrf.value = getCsrfToken();
            data.push(csrf);
             
            
            $('.wrapper_div').remove();
            $.each(terms_array, function(index, value){
            	var term = new Object;
            	term.name='terms';
            	term.value = value.trim();
            	data.push(term);
            	data.push(q);
                var request = $.ajax({
	                url:'/adminSocialSearch/ajaxSearch',
	                type:'POST',
	                data:$.param(data),
	                success:function(data){
	                	$("<div class='wrapper_div'><div class='keyword text-left'>"+value+"<button><i class='icon-caret-right'></i></button><button style='display:none;'><i class='icon-caret-up'></i></button></div><hr> <table class='resultsTable' id='resultsTable_"+index+"'><thead><tr><th>Id</th><th>Lock/Unlock Question</th><th>Questions</th><th>Avatar</th><th>From</th><th>Timestamp</th><th>Date</th><th>Content</th> <th>Category</th><th>Tweet Clean</th>   <th>Account Clean</th> <th>Media</th>  <th>Tweet Language</th> <th>Account Language</th>" +
	                			"<th>Verified</th>   <th>Has Location</th> " +
						        "<th>Place</th> <th>Place Coordinates</th> <th>Tweet Coordinates</th>" +
						        "<th>Followers</th><th>Following</th></tr></thead> <tbody></tbody></table></div>").appendTo('#resultsDiv');
	                	makeDataTable('resultsTable_'+index); 
	                	rTable.fnClearTable();
	                	
	                    searchObj = $.parseJSON(data);
	                    if(searchObj !== null){
	                        if(searchObj.errors !== null){
	                            var errorMessage = '';
	                            $.each(searchObj.errors,function(k,v){
	                                errorMessage = errorMessage+k.charAt(0).toUpperCase()+k.substr(1)+' says: '+v+'<br />';
	                            });
	                            $('.errors').show();
	                            $('.errors').html(errorMessage);
	                        }
	                        if(searchObj.rates !== null){
	                            var rateMessage = '';
	                            $.each(searchObj.rates,function(k,v){
	                                rateMessage = rateMessage+k.charAt(0).toUpperCase()+k.substr(1)+' says: '+v+'<br />';
	                            });
	                            $('.rates').html(rateMessage);
	                        }
	                        $.each(searchObj,function(i,e){
	                            if(isNaN(parseInt(i))){return true;}
	                            //console.log(e);
	                            $('#resultsTable_'+index).dataTable().fnAddData( [
	                                i,
	                                $('<div>').html('<img src="/core/webassets/images/lock.png" width="16" height="16" class="lockQuestion" style="cursor:pointer" question_status="lock" question_rel_id="'+i+'"/>').prop('outerHTML'),
	                                $(e.questions).attr({'rel':i}).prop('outerHTML'),
	                                //'n/a',
	                                $('<a>').attr({'href':e.accountLink,'target':'_blank'}).html($('<img>').attr({'src':e.avatar})).prop('outerHTML'),
	                                $('<a>').attr({'href':e.accountLink,'target':'_blank'}).html($('<div>').append($('<div>').html(e.username)).append($('<div>').html(e.accountDescription).css({'display':'none'}))).prop('outerHTML'),
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
	                            ] );
	                            //storeHandler();
	                        });
	                    } else {
	                        alert('No results for '+ value );
	                    }
	                    if(terms_array.length > 1) {
	                    	$('#resultsTable_'+index).parent().parent().hide();
	                	} else {
	                		$('#resultsTable_'+index).parent().parent().siblings('.keyword').find('button').toggle();
	                	}
	                    $('#counter').val(parseInt($('#counter').val()) + 1);
	                    if(parseInt($('#counter').val()) >= terms_array.length) {
		                    $('#ajaxSpinner').hide();
	                        $('#spinnerReplace').show();
	                    }
	                    setTimeout("$('#spinnerReplace').delay(10000).removeAttr('disabled')",15000); //timeout search for 15 sec
	                }
	            });
            });
            return false;
        });
    }
   
function makeDataTable(ele){
    rTable = $('#'+ele).dataTable({
        "aaSorting":[[5,"desc"]],
        "aoColumns": [
            {"sType":"numeric","bVisible":false},
            {"sType":"html" },
            {"sType":"null","sWidth":"50px"},
            {"sType":"null","sWidth":"50px"},
            {"sType":"html"},
            {"sType":"numeric","bVisible":false},
            {"sType":"string","sData":"datetime-us"},
            {"sType":"html","sClass": "tleft","sWidth":"800px"},
            {"sType":"string","bVisible":false},
            {"sType":"string","bVisible":false},
            {"sType":"string","bVisible":false},
            {"sType":"string","bVisible":false},
            {"sType":"string"},
            {"sType":"string"},
            {"sType":"string","bVisible":false},
            {"sType":"string","bVisible":false},
            {"sType":"string"},
            {"sType":"string","bVisible":false},
            {"sType":"string","bVisible":false},
            {"sType":"currency"},
            {"sType":"currency"},
        ], 
        "fnDrawCallback":function(oSettings){
            storeHandler();
            unlockQuestion();
            checkDisabledQuestion();
        },
        "sDom":'<flipt>',
    });

}
var unlockQuestion = function(){
        $('.lockQuestion').off('click');
        $('.lockQuestion').on('click',function(e){
            e.preventDefault();
            var rel = $(this).attr('question_rel_id'); 
            if($(this).attr('question_status') == 'lock') {
                $("[rel="+rel+"]").attr('disabled',false);
                $(this).attr({'question_status':'unlock','src':'/core/webassets/images/lock_open.png'});
            } else {
                $(this).attr({'question_status':'lock', 'src':'/core/webassets/images/lock.png'});
                $("[rel="+rel+"]").attr('disabled',true);
            } 
        });
}
var checkDisabledQuestion = function () {
     $('.storeSearch').each(function(e){  
            var rel = $(this).attr('rel');  
            
            if($("[rel="+rel+"]").attr('disabled') == 'disabled' && $("[rel="+rel+"]").attr('value') != '' ) {
                
                $("[question_rel_id="+rel+"]").attr({'src':'/core/webassets/images/lock.png', 'question_status':'lock'});
            } else {
                 
                $("[question_rel_id="+rel+"]").attr({'question_status':'unlock','src':'/core/webassets/images/lock_open.png'});
            }
        });
}

var searchTypeHandler = function () {
    $( "#searchTypeTabs" ).tabs();
}

$(document).ready(function () {
    
    searchTypeHandler();
    
    $('button[type="submit"]').click(function(e){
        var selectedTab = $("#searchTypeTabs").tabs('option', 'selected');
        if(selectedTab == 0) {
            searchHandler();
        }
        else if(selectedTab == 1) {
            userSearchHandler();
        }
    });
    
    
    $(document).on('click', '.keyword', function(){
    	$(this).find('button').toggle();
    	$(this).siblings('.dataTables_wrapper').toggle('slow');
    })
});


var userSearchHandler = function(){
        $('#searchUsers').off('reset');
        $('#searchUsers').on('reset',function(e){
            location.reload();
        });
        $('#searchUsers').off('submit');
        $('#searchUsers').on('submit',function(e){
            e.preventDefault();
            var terms = $('#terms2').val().trim();
            if(terms == '') {
            	alert('Searching terms can not be empty. please try it again.');
            	return false;
            }
            var terms_array = terms.split(/,+/);
            
            $('#search_terms').show();
            $('#ajaxSpinner2').show();
            $('#spinnerReplace2').hide();
            $('#spinnerReplace2').attr("disabled", "disabled");
            var data = $(this).serializeArray();
            var csrf = new Object;
            csrf.name = 'CSRF_TOKEN';
            csrf.value = getCsrfToken();
            data.push(csrf);
             
            
            $('.wrapper_div').remove();
            $.each(terms_array, function(index, value){
            	var term = new Object;
            	term.name='terms';
            	term.value = value.trim();
                term.value = 'from:' + term.value;
            	data.push(term);
            	
                var request = $.ajax({
	                url:'/adminSocialSearch/ajaxSearch',
	                type:'POST',
	                data:$.param(data),
	                success:function(data){
	                	$("<div class='wrapper_div'><div class='keyword text-left'>"+value+"<button><i class='icon-caret-right'></i></button><button style='display:none;'><i class='icon-caret-up'></i></button></div><hr> <table class='resultsTable' id='resultsTable_"+index+"'><thead><tr><th>Id</th><th>Lock/Unlock Question</th><th>Questions</th><th>Avatar</th><th>From</th><th>Timestamp</th><th>Date</th><th>Content</th> <th>Category</th><th>Tweet Clean</th>   <th>Account Clean</th> <th>Media</th>  <th>Tweet Language</th> <th>Account Language</th>" +
	                			"<th>Verified</th>   <th>Has Location</th> " +
						        "<th>Place</th> <th>Place Coordinates</th> <th>Tweet Coordinates</th>" +
						        "<th>Followers</th><th>Following</th></tr></thead> <tbody></tbody></table></div>").appendTo('#resultsDiv');
	                	makeDataTable('resultsTable_'+index); 
	                	rTable.fnClearTable();
	                	
	                    searchObj = $.parseJSON(data);
	                    if(searchObj !== null){
	                        if(searchObj.errors !== null){
	                            var errorMessage = '';
	                            $.each(searchObj.errors,function(k,v){
	                                errorMessage = errorMessage+k.charAt(0).toUpperCase()+k.substr(1)+' says: '+v+'<br />';
	                            });
	                            $('.errors').show();
	                            $('.errors').html(errorMessage);
	                        }
	                        if(searchObj.rates !== null){
	                            var rateMessage = '';
	                            $.each(searchObj.rates,function(k,v){
	                                rateMessage = rateMessage+k.charAt(0).toUpperCase()+k.substr(1)+' says: '+v+'<br />';
	                            });
	                            $('.rates').html(rateMessage);
	                        }
	                        $.each(searchObj,function(i,e){
	                            if(isNaN(parseInt(i))){return true;}
	                            //console.log(e);
	                            $('#resultsTable_'+index).dataTable().fnAddData( [
	                                i,
	                                $('<div>').html('<img src="/core/webassets/images/lock.png" width="16" height="16" class="lockQuestion" style="cursor:pointer" question_status="lock" question_rel_id="'+i+'"/>').prop('outerHTML'),
	                                $(e.questions).attr({'rel':i}).prop('outerHTML'),
	                                //'n/a',
	                                $('<a>').attr({'href':e.accountLink,'target':'_blank'}).html($('<img>').attr({'src':e.avatar})).prop('outerHTML'),
	                                $('<a>').attr({'href':e.accountLink,'target':'_blank'}).html($('<div>').append($('<div>').html(e.username)).append($('<div>').html(e.accountDescription).css({'display':'none'}))).prop('outerHTML'),
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
	                            ] );
	                            //storeHandler();
	                        });
	                    } else {
	                        alert('No results for '+ value );
	                    }
	                    if(terms_array.length > 1) {
	                    	$('#resultsTable_'+index).parent().parent().hide();
	                	} else {
	                		$('#resultsTable_'+index).parent().parent().siblings('.keyword').find('button').toggle();
	                	}
	                    $('#counter').val(parseInt($('#counter').val()) + 1);
	                    if(parseInt($('#counter').val()) >= terms_array.length) {
		                    $('#ajaxSpinner2').hide();
	                        $('#spinnerReplace2').show();
	                    }
	                    setTimeout("$('#spinnerReplace2').delay(10000).removeAttr('disabled')",15000); //timeout search for 15 sec
	                }
	            });
            });
            return false;
        });
    }