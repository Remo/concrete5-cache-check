$(document).ready(function () {
    Concrete.event.bind('ConcreteSitemap', function (e, instance) {
        var instance = instance;
        Concrete.event.bind('SitemapSelectPage', function (e, data) {
            if (data.instance == instance) {
                Concrete.event.unbind(e);

                var ajaxUrl = CCM_APPLICATION_URL + CCM_DISPATCHER_FILENAME + "/dashboard/reports/page_cache_check/check_page"
                $.post(ajaxUrl, {
                    "cID": data.cID
                }, function (data) {
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
        });
    });
});