!function judgeDebt() {
    var $modal = $("#judgeAlert");
    var judgeFlag = false;

    $(".judge textarea").bind("focus", function() {
        $(this).parent().removeClass("has-success").removeClass("has-error");
    })
    $(".judge button").bind("click", function(e) {
        var $input = $(".judge textarea")
        var $inputParent = $input.parent();
        var $modalText = $("#judgeAlert .modal-body p");

        if(judgeFormInput($input, $inputParent, 1) > 0) {

            if($(this).hasClass("btn-danger")) {
                //执行拒绝的操作
                $modal.modal("show");
                $modalText.html("您确定要将此债权审核为不通过吗？");
                judgeFlag = false;
            }else {
                //执行审核通过的操作
                $modal.modal("show").attr("data-ok", "yes");
                $modalText.html("您确定要将此债权审核为通过吗？");
                judgeFlag = true;
            }
            return false;

        }else {
            return false;
        }

    })
    $("#judgeAlert .btn-primary").bind("click", function() {
        //将弹出框隐藏
        $(this).parents(".modal").modal("hide");
        if(judgeFlag) {
            //处理审核通过的操作
            toVerify(2);
            //alert("通过");
        }else {
            //处理审核失败的操作
            toVerify(-1);
            //alert("拒绝");
        }
    });

    $(".panel-heading .closeBody").bind("click", function() {
      var $btn = $(this);
      $panel_body = $btn.parent().nextAll();
      if($panel_body.css("display") == "none") {
        $panel_body.show();
        $btn.html("收起");
      } else {
        $panel_body.hide();
        $btn.html("展开");
      }

    })
}()


