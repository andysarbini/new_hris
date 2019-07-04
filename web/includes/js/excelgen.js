var __tgl = window.location+ ''; 
var _a_tgl = __tgl.split("/");
var _b_tgl = _a_tgl.slice(-3); 
var _tgl_excell = _b_tgl.join("-");

function CetakExcel(idnya, name){
	var data = $(idnya).html();
    
	excel_ajax_download(base_url+'excelgen', 
		{
			"html":data,
			"name":name+'-'+_tgl_excell,
			"stream":false
		}
	);
}

function excel_ajax_download(url, data) {
	
    var $iframe,
        iframe_doc,
        iframe_html;

    if (($iframe = $('#download_iframe')).length === 0) {
        $iframe = $("<iframe id='download_iframe'" +
                    " style='display: none' src='about:blank'></iframe>"
                   ).appendTo("body");
    }

    iframe_doc = $iframe[0].contentWindow || $iframe[0].contentDocument;
    if (iframe_doc.document) {
        iframe_doc = iframe_doc.document;
    }

    iframe_html = "<html><head></head><body><form method='POST' action='" +
                  url +"'>" +
                  "<textarea name='html' style='display:none;'>" + data.html +"</textarea>"+
                  "<input type='hidden' name='name' value='" +data.name+"' />"+
                  "</form>" +
                  "</body></html>";
    iframe_doc.open();
    iframe_doc.write(iframe_html);
    $(iframe_doc).find('form').submit();
    /**/ 
   }
