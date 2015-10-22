//审核视图
function seeVerify(obj)
{
    $.ajax({
        url:$(obj).attr('href'),
        type:'get',
        dataType:'json',
        success:function(data){

            if(data.msg=='login required'){
                window.location.href="/";
            }

            if(data.ok)
            {
                if(data.html.online){
                    $("#form-primary .onlineTime").remove();
                }
                $("#VerifyForm_id").val(data.html.id);
                $("#VerifyForm_sale_end_time").val(data.html.sale_end_time);
                $("#form-primary .project-push-text").html(data.name);
                $("#form-primary").niftyModal('show');
                return false;
            }else{
                $("#mod-error p").html(data.msg);
                $("#mod-error").modal();
                setTimeout("window.location.reload();",3000);
            }
        }
    });
    return false;
}

function dropSales(obj){
    if(!confirm("你确定要要撤销提前赎回？")){
        return false;
    }

    $.ajax({
        url:$(obj).attr('href'),
        type:'get',
        dataType:'json',
        success:function(data){
            if(data.msg=='login required'){
                window.location.href="/";
            }
            if(data.ok)
            {
                $("#mod-success p").html(data.msg);
                $("#mod-success").modal();
            }else{
                $("#mod-error p").html(data.msg);
                $("#mod-error").modal();
            }
            setTimeout("window.location.reload();",3000);
        }
    });
    return false;
}

function showSales(obj){
    $.ajax({
        url:$(obj).attr('href'),
        type:'get',
        dataType:'json',
        success:function(data){

            if(data.msg=='login required'){
                window.location.href="/";
            }
            if(data.ok)
            {
                $("#SalesQuotaForm_id").val(data.html.id);
                $("#SalesQuotaForm_redeem_time").val(data.html.redeem_time);
                $("#form-primary2 .sales-quota-text").html(data.name);
                $("#form-primary2").niftyModal('show');
                return false;
            }else{
                $("#mod-error p").html(data.msg);
                $("#mod-error").modal();
                setTimeout("window.location.reload();",3000);
            }
        }
    });
    return false;


}

//暂停项目
function end_project(obj){

    if(!confirm("你确定要暂停项目吗？")){
        return false;
    }
    $.ajax({
        url:$(obj).attr('href'),
        type:'get',
        dataType:'json',
        success:function(data){

            if(data.msg=='login required'){
                window.location.href="/";
            }

            if(data.ok)
            {
                $("#mod-success p").html(data.msg);
                $("#mod-success").modal();
                setTimeout("window.location.reload();",3000);
            }else{
                $("#mod-error p").html(data.msg);
                $("#mod-error").modal();
                setTimeout("window.location.reload();",3000);
            }
        }
    });
    return false;
}

//取消自动上标项目
function cancel_auto_start(obj){

    if(!confirm("你确定要取消自动上标项目吗？")){
        return false;
    }

    $.ajax({
        url:$(obj).attr('href'),
        type:'get',
        dataType:'json',
        success:function(data){

            if(data.msg=='login required'){
                window.location.href="/";
            }
            if(data.ok)
            {
                $("#mod-success p").html(data.msg);
                $("#mod-success").modal();
                setTimeout("window.location.reload();",3000);
            }else{
                $("#mod-error p").html(data.msg);
                $("#mod-error").modal();
                setTimeout("window.location.reload();",3000);
            }
        }
    });
    return false;
}

//启动项目
function start_project(obj){

    if(!confirm("你确定要启动项目吗？")){
        return false;
    }

    $.ajax({
        url:$(obj).attr('href'),
        type:'get',
        dataType:'json',
        success:function(data){

            if(data.msg=='login required'){
                window.location.href="/";
            }
            if(data.ok)
            {
                $("#mod-success p").html(data.msg);
                $("#mod-success").modal();
                setTimeout("window.location.reload();",3000);
            }else{
                $("#mod-error p").html(data.msg);
                $("#mod-error").modal();
                setTimeout("window.location.reload();",3000);
            }
        }
    });
    return false;
}


function copy_project(obj)
{
    $.ajax({
        url:$(obj).attr('href'),
        type:'get',
        dataType:'json',
        success:function(data){

            if(data.msg=='login required'){
                window.location.href="/";
            }
            if(data.ok)
            {
                $("#copy-project-id").val(data.id);
                $("#form-primary1 .copyMyProjects").html(data.title);
                $("#form-primary1").niftyModal('show');
                return false;
            }else{
                $("#mod-error p").html(data.msg);
                $("#mod-error").modal();
                setTimeout("window.location.reload();",3000);
            }
        }
    });
    return false;
}
//项目删除
function delete_project(obj)
{
    if(!confirm("你确认要删除项目吗?"))
    {
        return false;
    }
    $.ajax({
        url:$(obj).attr('href'),
        type:'get',
        dataType:'json',
        success:function(data){

            if(data.msg=='login required'){
                window.location.href="/";
            }
            if(data.ok)
            {
                $("#mod-success p").html(data.msg);
                $("#mod-success").modal();
                setTimeout("window.location.reload();",3000);
            }else{
                $("#mod-error p").html(data.msg);
                $("#mod-error").modal();
                setTimeout("window.location.reload();",3000);
            }
        }
    });
    return false;
}

function sort_project(obj){
    $.ajax({
        url:$(obj).attr('href'),
        type:'get',
        dataType:'json',
        success:function(data){

            if(data.msg=='login required'){
                window.location.href="/";
            }
            if(data.ok)
            {
                $("#SortProjectForm_id").val(data.id);
                $("#SortProjectForm_order").val(data.order);
                $("#form-primary9 .sales-quota-text").html(data.name);
                $("#form-primary9").niftyModal('show');
                return false;
            }else{
                $("#mod-error p").html(data.msg);
                $("#mod-error").modal();
                setTimeout("window.location.reload();",3000);
            }
        }
    });
}


//全选
function all_choose(p){
    $("." + p).each(function () {
        this.checked = true;
    });
}
//反选
function fan_choose(p){

    $("."+p).each(function(){
        if (this.checked) {
            this.checked = false;
        }
        else {
            this.checked = true;
        }
    });
}
//不选
function no_choose(p) {
    $("." + p).each(function () {
        this.checked = false;
    });
}



$(function(){
    $("#gotoBtn").live('click',function() {
        var url=$(this).attr('now_url');
        if(url.indexOf("?")!=-1){
            url+="&Project_page="+$("#pageNumber").val();
        }else{
            url+="Project_page="+$("#pageNumber").val();
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



    $("#Project_category1").on("change",function(){

        $("#s2id_Debt_category2 .select2-chosen").html("项目类别加载中").select2("disable");
        $("#Project_category2").parents(".col-sm-2");
        $("#Project_category3").parents(".col-sm-3").hide();
        $.ajax({
            url: $(this).attr("request_url"),
            type: "post",
            data: {code: $(this).val()},
            dataType: "html",
            success: function (data) {
                if(data.msg=='login required'){
                    window.location.href="/";
                }
                $("#Project_category2").html(data);
                $("#s2id_Project_category2 .select2-chosen").html("请选择项目所属的类别").select2("enable");
            }
        });
    });

    $("#Project_category2").on("change",function() {
        $("#s2id_Project_category3 .select2-chosen").html("项目类别加载中").select2("disable");
        $.ajax({
            url: $(this).attr("request_url"),
            type: "post",
            data: {code: $(this).val()},
            dataType: "html",
            success: function (data) {
                if(data.msg=='login required'){
                    window.location.href="/";
                }
                $("#Project_category3").html(data);
                $("#s2id_Project_category3").parents(".col-sm-3").show();
                $("#s2id_Project_category3 .select2-chosen").html("请选择项目所属的类别").select2("enable");
            }
        });
    });


});


