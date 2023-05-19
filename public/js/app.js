// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs
$(document).foundation();

/*
	MOD: added forward slash
	@patrick
*/
function setSlug(source, destination){

	var str = $('#'+destination).val();
	var n = str.indexOf("-src-");
	var suffix = "";
	if(n < 0){

		var cleanUrl = ($('#'+source).val() + " ").replace(/[^a-zA-Z0-9]+/g, "-");
		if(cleanUrl != '') $('#'+destination).val(cleanUrl.slice(0, cleanUrl.length -1).toLowerCase());
	}else{
		/*suffix = str.substring(n);*/
	}
}

function checkSpecialCharacter(source, destination){
	var slug = $("#"+source).val();
	var cleanSlug = slug.replace(/[^a-zA-Z0-9]+/g,"-");
	$("#"+destination).val(cleanSlug);
}

function openMediaTool(url){
	$.colorbox(
		{
			href: url,
			fastIframe:true,
			iframe:true,
			width:"90%",
			height:"90%"
		}
	);
}

$(document).on("click", "[data-imglib-btn]", function(e){
	localStorage.clear();
    localStorage.path = "";
    var thisBtn = $(this);
    $.colorbox({
        href: "/image-library?upload=upload",
        fastIframe:true,
        iframe:true,
        width:"90%",
        height:"90%",
        maxwidth:"90%",
        maxheight:"90%",
        fixed:true,
        onCleanup: function() {
        	//console.log(localStorage);
            if(localStorage.path != "") thisBtn.parents('[data-imglib]').find('input').val(localStorage.path);

            var contributor = localStorage.contributor != "" ? localStorage.contributor : '',
                illustrator = localStorage.illustrator != "" ? localStorage.illustrator : '';
            thisBtn.parents('[data-imglib]').find('input#photographer').val(contributor);
            thisBtn.parents('[data-imglib]').find('input#illustrator').val(illustrator);

            if(localStorage.imageLibraryId != "") thisBtn.parents('[data-imglib]').find('input#image-library-id').val(localStorage.imageLibraryId);
            if(localStorage.imageLibraryPreview != "") thisBtn.parents('[data-imglib]').find("[data-imglib-prev]").attr('src', localStorage.imageLibraryPreview);
            if(localStorage.imageLibraryPreview != "") thisBtn.parents('[data-imglib]').find("[data-imglib-div]").removeClass('hide').addClass('show');
        }
    });
});


function inserToContent(param, id, idMedia){
	var str = tinyMCE.activeEditor.getContent();
        tinymce.activeEditor.execCommand('mceInsertRawHTML', false, param);
	$('#media_id').val(idMedia);
}

function parseUrl( url ) {
    var a = $('<a>', {href: url});
    return a;
}

function GetURLParameter(url,sParam)
{
    var sPageURL = url;
    var sURLVariables = sPageURL.split('&');

    if (sURLVariables.length) {
        var sURLVariables = sPageURL.split('?');
    }

    for (var i = 0; i < sURLVariables.length; i++)
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam)
        {
            return sParameterName[1];
        }
    }
}

function buttonChecker(btn, data){
    $(btn).prop('disabled', data);
}

var ajaxPartialUpdate = function(url, type, params) {
    // var data = { '_token': TOKEN };
    var data;

    if(typeof params !== 'undefined') {
        $.extend(data, params);
    }

    return $.ajax({
        type: type,
        url: url,
        data: data,
        success: function (response) {
            return response;
        }
    });
}

function isUrlValid(url) {
    return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
}

$('#provider_save').on('click', function(){
    var url = $('#url').val();

    if(url == '' || !isUrlValid(url)) {
        Swal.fire({
            title: "Invalid Provider URL",
            text: "Please check the URL you entered.",
            icon: "warning",
            confirmButtonColor: '#3085d6'
        });
        $('#url').focus();
        return false;
    }

    return true;
});