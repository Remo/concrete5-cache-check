function remoCacheCheckPageChanged(cID, cName) {    
    var ajaxUrl = CCM_BASE_URL + CCM_REL + CCM_DISPATCHER_FILENAME + "/dashboard/reports/page_cache_check/check_page"
    $.post(ajaxUrl, {
        "cID": cID
    }, function(data) {
        $("#remo-cache-check-result").empty();
        if (data.length == 0) {
            $("#remo-cache-check-result").append("<li class=\"remo-cache-check-text-item\">" + REMO_CACHE_CHECK_ALL_OKAY + "</li>");
        }
        else {
            $("#remo-cache-check-result").append("<li class=\"remo-cache-check-text-item\">" + REMO_CACHE_CHECK_NOT_OKAY + "</li>");
            for (id in data) {                
                $("#remo-cache-check-result").append("<li class=\"remo-cache-check-block-item\">" + data[id] + "</li>");
            }
        }
    }, "json");
}