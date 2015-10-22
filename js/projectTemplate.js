$(function(){

    $(".update_file").on('mouseover', function () {
        $(this).find('.file-panel2').stop().animate({height: 30});
    }).on('mouseout', function () {
        $(this).find('.file-panel2').stop().animate({height: 0});
    });
    $(".update_file .file-panel2").on('click', 'span', function () {
        var this_id = $(this).parent().parent().attr('id');
        var num = $("#uploader1").find('.filelist li').length;
        $("#uploader1 .attachmentHide").find("." + this_id).remove();
        $("#upload_file1").val(0);
        $(this).parent().parent().remove();
        if (num == 1) {
            $(".filelist").remove();
            loadUpImage2($("#uploader1"), 'filePicker1');
            $("#uploader1").find('.placeholder').removeClass('element-invisible');
            $("#uploader1").find('.queueList').removeClass('filled');
            $("#filePicker1").removeClass('element-invisible');
        }
    });

});

function projectTemplate() {
    var $inputName = $("#projectTemplate .inputName");
    var $inputParent = null;
    var errLen = 0;
    var $btn = $("#projectTemplate .btn");

    $("#projectTemplate .select2").bind("change", function () {
        var $textarea = null;
        //选择不同的已有模版，在模版名称中显示对应的模版名称（选择的自定义的，则模版名称中显示为空）
        if ($(this).hasClass("selectTemplate")) {
            var templateName = "";
            if ($(this).select2("val") != "p1") {
                templateName = $(this).select2("data").text;
            } else {
                templateName = "";
            }

            $inputName.val(templateName).focus();
        } else {
            $textarea = $(this).parents(".form-group").next();
            $inputParent = $textarea.children();
            //其他下拉选择菜单
            if ($(this).select2("data").text == "自定义") {
                $textarea.show();
            } else {
                $textarea.hide();
                //隐藏对应的自定义文本框时，需要将对应的错误样式去处，还要重新调用一下judgeBtn
                $inputParent.removeClass("has-error");
            }
        }
    });
    //判断文本框中是否为空
    $("#projectTemplate .inputName, #projectTemplate textarea").bind("blur", function () {
        $inputParent = $(this).parent();
        //如果文本框是隐藏的，则不判断值格式是否正确
        if ($inputParent.parent().css("display") == "none") {
            $inputParent.removeClass("has-error");
        } else {
            if($(this).hasClass('template_desc_custom')||$(this).hasClass('inputName')) {
                judgeFormInput($(this), $inputParent, 1);
            }
        }
    }).bind("focus", function () {
        $(this).parent().removeClass("has-success").removeClass("has-error");
    })


    //上传项目图片


    loadUpImage2($("#uploader1"), "filePicker1");

    //点击保存按钮事件
    $btn.bind("click", function () {

        $("#projectTemplate .inputName, #projectTemplate textarea").blur();
        var errLen = $("#projectTemplate .has-error").length;
        if (errLen > 0) {
            alert("请检查标红项值是否正确")
        } else {
            if ($(".queueList .filelist .success").length > 0) {
                $("#project-template-form").submit();
            } else {
                alert("请上传项目图片");
            }
        }
        return false;

    })
}

projectTemplate();