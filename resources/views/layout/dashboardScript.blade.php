<script>
    function prettyDate(time) {
        var date = new Date((time || "").replace(/-/g, "/").replace(/[TZ]/g, " ")),
            diff = (((new Date()).getTime() - date.getTime()) / 1000),
            day_diff = Math.floor(diff / 86400);

        if (isNaN(day_diff) || day_diff < 0 || day_diff >= 31) return;

        return day_diff == 0 && (
            diff < 60 && "just now" || diff < 120 && "1 minute ago" || diff < 3600 && Math.floor(diff / 60) + " minutes ago" || diff < 7200 && "1 hour ago" || diff < 86400 && Math.floor(diff / 3600) + " hours ago") || day_diff == 1 && "Yesterday" || day_diff < 7 && day_diff + " days ago" || day_diff < 31 && Math.ceil(day_diff / 7) + " weeks ago";
    }

    // If jQuery is included in the page, adds a jQuery plugin to handle it as well
    if (typeof jQuery != "undefined") jQuery.fn.prettyDate = function() {
        return this.each(function() {
            var date = prettyDate(this.title);
            if (date) jQuery(this).text(date);
        });
    };

    function getThisCat() {
        cat = $('#selectCat').val();
        if (cat == 0) {
            location.reload();
        } else {
            const getData = {
                'category': $('#selectCat').val(),
            };
            $.ajax({
                url: "/api/getDataAccCat",
                type: "post",
                dataType: "json",
                data: getData,
                beforeSend: function() {
                    $('#all_records').empty();
                },
                success: function(response) {
                    console.log(response['data']);
                    var trHTML = '';
                    $.each(response['data'], function(i, item) {
                        console.log(item.que_id);
                        var rDate = prettyDate(item.created_at);
                        var ques_link = "{{url('/question/')}}" + "/" + item.que_id + "/" + item.slug;
                        trHTML = '<div style="padding-top: 0rem !important; padding-bottom: 0rem !important;" class="card row-hover pos-relative py-3 px-3 mb-3 border-warning border-top-0 border-right-0 border-bottom-0 rounded-0"><div class="row align-items-center"><div class="col-md-8 mb-3 mb-sm-0"><h5> <a href="' + ques_link + '" class="text-primary" style="text-decoration: none;">' + item.add_question + '</a> </h5> <p class="text-sm"><span class="op-6">Asked</span> <a class="text-black" href="#">' + rDate + '</a> <span class="op-6">by</span> <a class="text-black" href="#">' + item.name + '</a> </p> </div> <div class="col-md-4 op-7">  <div class="row text-center op-7">  <div class="col px-1"> <i class="ion-ios-chatboxes-outline icon-1x"></i>  <span  class="d-block text-sm">' + item.que_id + ' Answered</span> </div><div class="col px-1"> <i class="ion-ios-eye-outline icon-1x"></i> <span class="d-block text-sm">' + item.views + ' Views</span> </div> </div> </div> </div> </div>';
                        $('#all_records').append(trHTML);
                    });

                }
            });
        }

    }
</script>