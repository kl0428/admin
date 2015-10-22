/**
 * Created by sunnyer on 15-5-15.
 */
//债权付息表
//$("form-primary").hide();
function interest(th) {
    var frameUrl = th;
    $.ajax({
        type: 'get',
        url: frameUrl,
        dataType: 'json',
        success: function (data) {
            $("#ajaxResult").html(data.html);
            $("#form-primary").niftyModal("show");
        }
    });
}



//债权提交审核
function submitVerify(obj) {
    if (!confirm("你确定要提交审核吗？")) {
        return false;
    }
    $.ajax({
        'type': 'get',
        'url': $(obj).attr("href"),
        'dataType': 'json',
        success: function (data) {
            if (data.ok) {
                $("#mod-success p").html(data.msg);
                $("#mod-success").modal();
                setTimeout("window.location.reload();", 3000);
            } else {
                var obj = data.data;
                var html = '<ul>';
                $("#mod-error1 p.save-error").html('');
                $.each(obj, function (k, v) {
                    html += '<li>' + v + '</li>';
                });
                html += "</ul>";
                $("#mod-error1 p.save-error").html(html);
                $("#mod-error1").modal();

                //setTimeout("window.location.reload();", 3000);
            }
        }
    });
}

$(function(){
    $("#gotoBtn").live('click',function() {
        var url=$(this).attr('now_url');
        if(url.indexOf("?")!=-1){
            url+="&Debt_page="+$("#pageNumber").val();
        }else{
            url+="Debt_page="+$("#pageNumber").val();
        }

        $.ajax({
            'type': 'get',
            'url': url,
            'dataType': 'html',
            success: function (data) {
                var $data = $("<div>" + data + "</div>");
                $("#J_Saved_info").html($("#J_Saved_info", $data).html());
            }
        })
    });
})

