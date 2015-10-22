$(function () {
    /*
     * 表单内 点击保存按钮，判断各项是否输入正确，对输入不正确的项都标红显示
     * 文本框内光标离开，判断输入项是否正确，如果输入不正确 则标红显示
     */
    function projectAdd() {
        var $btn = $("#project .submit");
        var $parent = null;
        var $input = null;
        var count = 0;

        //必填项光标离开后判断是否有选择值

        $("#project .notNull").bind("select2-open", function () {

            $(this).parent().removeClass("has-error");

        }).on("select2-close", function () {
            var $parent = $(this).parent();
            count = judgeFormInput($(this), $parent, 1);

        }).bind("blur", function () {
            var $parent = $(this).parent();
            if ($parent.css("display") == "none") {
                $parent.removeClass("has-error");
            }else {
                count = judgeFormInput($(this), $parent, 1);
                if ($(this).hasClass("inputInvest")) {
                    count = judgeFormInput($(this), $parent, 5);
                } else if ($(this).hasClass("inputRate")) {
                    count = judgeFormInput($(this), $parent, 129);
                }else if($(this).hasClass("inputSort")) {
                    count = judgeFormInput($(this), $parent, 3);
                }
            }
        }).bind("focus", function () {

            $(this).parent().removeClass("has-error");
        })

        //点击保存按钮 判断所有表单项是否正确
        $btn.bind("click", function () {
            $("#project .inputText").blur();
            $("#project .notNull").blur();
            $("#project .inputSort").blur();
            //根据标红项的个数是否大于0 来判断表单项是否全部输入正确
            errorLen = $("#project .has-error").length;
            if (errorLen > 0) {
                alert("请检查标红项值是否正确");
                return false;
            } else {
                //执行保存的代码
                $("#add-all-form").submit();
                return false;
            }
        })
    }

    $("#Project_property").on('change',function(){

        if($(this).val()==1){
            $("#s2id_Project_unit_amount .select2-chosen").html("100");
            $("#Project_unit_amount").val("100");
            $("#baoKuan").hide();
            $("#Project_additional_rate").removeClass("notNull");
        }else if($(this).val()==9){
            $("#baoKuan").show();
            $("#Project_additional_rate").addClass("notNull");
            $("#s2id_Project_unit_amount .select2-chosen").html("2000");
            $("#Project_unit_amount").val("2000");
        }else{
            $("#s2id_Project_unit_amount .select2-chosen").html("1000");
            $("#Project_unit_amount").val("1000");
            $("#baoKuan").hide();
            $("#Project_additional_rate").removeClass("notNull");
        }
    });

    $("#Project_category1").on("change",function(){
        $("#project .ldcd").show();
        $("#s2id_Project_category2 .select2-chosen").html("项目类别加载中").select2("disable");
        $("#Project_category2").parents(".col-sm-2").addClass("has-error");
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
        $("#s2id_Project_category3").parents(".col-sm-3").addClass("has-error").show();
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
                $("#s2id_Project_category3 .select2-chosen").html("请选择项目所属的类别").select2("enable");
            }
        });
    });

    $("#Project_tpl_id").on('change',function(){
        $(".project_desc_div textarea").val('');
        $.ajax({
            url: $(this).attr("request_url"),
            type: "post",
            data: {code: $(this).val(),target_id:$(this).attr('targetId')},
            dataType: "json",
            success: function (data) {

                if(data.msg=='login required'){
                    window.location.href="/";
                }
                if(data.ok){
                    $.each(data.template, function (k, v) {
                        if(v!=''){
                            $(".t_project_"+k).show();
                            $("#ProjectDesc_"+k).val(data.data[k]);
                        }else{
                            $(".t_project_"+k).hide();
                        }
                    });
                    /*
                    if(data.template.desc) {
                        $("#ProjectDesc_desc").val(data.data.desc);
                    }else{

                    }
                    if(data.template.use) {
                        $("#ProjectDesc_use").val(data.data.use);
                    }
                    if(data.template.pledge) {
                        $("#ProjectDesc_pledge").val(data.data.pledge);
                    }
                    if(data.template.source) {
                        $("#ProjectDesc_source").val(data.data.source);
                    }
                    if(data.template.risk) {
                        $("#ProjectDesc_risk").val(data.data.risk);
                    }
                    if(data.template.advice) {
                        $("#ProjectDesc_advice").val(data.data.advice);
                    }
                    if(data.template.guarantee) {
                        $("#ProjectDesc_guarantee").val(data.data.guarantee);
                    }
                    */
                    $("#ProjectDesc_img_url").val(data.data.url);
                }else{
                    alert(data.message);
                }
            }
        });
    });

    $(".isSplit .iCheck-helper").bind('click',function(){
        if($(this).parent().find('.icheck').val()==1){
            $("#showAmount").removeClass('hidden').find("input").addClass('notNull');
        }else{
            $("#showAmount").addClass('hidden').find("input").removeClass('notNull');
        }
    });


    //$(".imgBlock .icheck").iCheck("check");
    //勾选使用复选框 显示排序字段，否则隐藏排序字段
    $(".imgBlock .icheck").bind("ifChecked", function () {
        $(this).parents(".col-sm-5").next().show();
    }).bind("ifUnchecked", function () {
        $(this).parents(".col-sm-5").next().hide();
    })

    projectAdd();
})