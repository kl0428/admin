var tableForm = new TabelForm();
$(function () {
    /*
     * 功能： 选择不同的借款人类型 显示不同的表单信息
     */
    $(".type-hyn .icheck").on("ifChecked", function (event) {
        //获取搜索表单对象
        var parentID = $(this).parents(".block-flat").attr("id");
        //类似初始化的动作：将借款人表单内容隐藏；将标题处的提示文字隐藏; 表单内容清空
        $("#" + parentID + " .search-hyn").next().hide();
        $("#" + parentID + " .title-hyn .tip").addClass("hidden");

        $("#" + parentID + " .person_forms").attr("action", $("#" + parentID + " .person_forms").attr("request_url"));
        $("#" + parentID + " .company_forms").attr("action", $("#" + parentID + " .company_forms").attr("request_url"));

        //表单搜索按钮置为可点状态
        $("#" + parentID + " .search-hyn .btn").addClass("btn-primary");
        //此处还要新增 重置表单的代码
        $("#" + parentID + " .person-hyn input[type=text]").val("").parent().removeClass("has-error");
        $("#" + parentID + " .person-hyn .icheck").eq(0).iCheck("check");
        $("#" + parentID + " .company-hyn input[type=text]").val("").parent().removeClass("has-error");
        //如果点击的个人，显示个人的表单信息，否则显示企业的表单信息
        if ($(this).val() == 1) {
            $("#" + parentID + " .person-hyn").show();
            $("#" + parentID + " .company-hyn").hide();
        } else {
            $("#" + parentID + " .person-hyn").hide();
            $("#" + parentID + " .company-hyn").show();
        }

    });

    /*
     * 功能：借款人类型中 查询文本框字段校验
     */
    $(".search-hyn input").bind("blur", function () {
        var $input = $(this);
        var inputText = $input.val(), inputTextOrg = $input.attr("data-org");
        var $parent = $input.parent();
        var parentID = $(this).parents(".step-pane").attr("id");
        var count = 0;

        //如果input对象所在父节点不是隐藏的，则需要判断文本框的值是否正确
        if ($input.parents("form").children().css("display") != "none") {
            //如果文本框式身份证
            if ($input.hasClass("person")) {
                count = judgeFormInput($input, $parent, 65);
            } else {
                //如果文本框是工商营业执照注册号
                count = judgeFormInput($input, $parent, 259);
            }
            //如果值有变更，且输入的值是正确的，将原值替换为新值，并将保存按钮值为可点击状态
            if (inputText != inputTextOrg) {
                if (count > 0) {
                    $input.attr("data-org", inputText);
                    $input.next().children().addClass("btn-primary");
                    $input.parents(".form-group").next().hide();
                }
                if ($input.hasClass("person")) {
                    $("#" + parentID + " .person_forms").attr("action", $("#" + parentID + " .person_forms").attr("request_url"));
                } else {
                    $("#" + parentID + " .company_forms").attr("action", $("#" + parentID + " .company_forms").attr("request_url"));
                }
            }
        } else {
            //如果input对象所在的父节点时隐藏的，则不判断，且需要将所存在的has-error 样式去除
            $parent.removeClass("has-error");
        }
    }).bind("focus", function () {
        $(this).parent().removeClass("has-error");
    })


    /*
     * 功能：借款人类型中输入身份信息或营业执照号后，点击搜索显示对应表单信息
     */
    $(".search-hyn .input-group-btn .btn").bind("click", function () {
        //如果按钮为不可点击状态，则点击后无反应
        if (!$(this).hasClass("btn-primary")) {
            return false;
        }
        //判断文本框中的值是否正确，正确才可以继续搜索功能
        var parentID = $(this).parents(".block-flat").attr("id");
        var $searchText = $(this).parent().prev();
        $searchText.blur();
        //errLen为错误项个数
        var errLen = $("#" + parentID + " .search-hyn .has-error").length;
        if (errLen > 0) {
            alert("请检查标红框的是否正确");
            return false;
        }
        //点击搜索按钮后将按钮置为不可点状态，仅当搜索文本框内有变更时才可点击
        $(this).removeClass("btn-primary");

        //点击搜索后 需要将信息是否已存在的提示信息重置后再根据查询结果显示
        $("#" + parentID + " .tip").addClass("hidden");

        //searchValue 为 文本框中的值
        var searchValue = $searchText.val();
        // $form 为 对应的表单对象
        var $form = $(this).parents(".form-group").next();
        // formType 为 表单类型字段 如果为true 则借款人为个人 ； 否则为企业
        var formType = true;
        // result 为 调用查询接口的结果
        var result = new Array;
        // searchResult 为 查询的质是否存在
        var searchResult = false;

        //根据$form的id 来设置formType的值
        if ($form.hasClass("company-info")) {
            formType = false;
            //将表单项中的值重置
            $("#" + parentID + " .company-info input").val("").parent().removeClass("has-error");

        } else {
            $("#" + parentID + " .person-info .input").val("").parent().removeClass("has-error");

        }
        var DEBT_TYPE = 1;
        if (parentID == "creditors") {
            DEBT_TYPE = 2;
        }

        if (formType) {
            var form_obj = $("#" + parentID + " .person-hyn .search-hyn");
            var forms_obj = $("#" + parentID + " .person-hyn");
            var search_url = form_obj.attr('data-search-url');
        } else {
            var form_obj = $("#" + parentID + " .company-hyn .search-hyn");
            var forms_obj = $("#" + parentID + " .company-hyn");
            var search_url = form_obj.attr('data-search-url');
        }

        if (formType) {

            var forms = $("#" + parentID + " .person_forms");
            /*=====
             * 此处为去调用个人借款的信息
             =====*/
            $.ajax({
                url: search_url,
                type: "post",
                data: {inputIdentity: searchValue, type: DEBT_TYPE},
                dataType: "json",
                success: function (result) {

                    if (result.msg == 'login required') {
                        window.location.href = "/";
                    }
                    //显示表单
                    $form.show();
                    /*
                     * 根据返回结果来显示表单
                     * result为是否查询成功的字段
                     */
                    if (result.ok) {
                        //forms.attr('action', forms.attr('request_url') + "/id/" + result.data.id);
                        $("#" + parentID + " .person-info").html(result.data.html);
                        $("#" + parentID + " .person-info .province").select2({width: '100%'});
                        $("#" + parentID + " .person-info .city").select2({width: '100%'});
                        $("#" + parentID + " .person-info .select_credit_records").select2({width: '100%'});
                        $("#" + parentID + " .person-info .select_education").select2({width: '100%'});

                        $("#" + parentID + " .person-info .marrage_class").iCheck({
                            checkboxClass: "iradio_square-blue",
                            radioClass: 'iradio_square-blue',
                            increaseArea: '20%' // optional
                        });
                        $("#" + parentID + " .person-info .sex_class").iCheck({
                            checkboxClass: "iradio_square-blue",
                            radioClass: 'iradio_square-blue',
                            increaseArea: '20%' // optional
                        });
                        //如果查询成功，即有结果，则将表单填充，将按钮显示为“修改”；标题处显示 信息已录入可修改
                        //否则显示空表单，按钮显示为“保存”（灰显）；标题处显示 信息未录入待新增
                        $("#" + parentID + " .title-hyn .tip-yes").removeClass("hidden");
                        $("#" + parentID + " .person-info .bSubmit").addClass("btn-primary").text("保存");
                    } else {
                        $("#" + parentID + " .person-info").find("input[type=text]").val('');
                        $("#" + parentID + " .title-hyn .tip-no").removeClass("hidden");
                        $("#" + parentID + " .person-info .bSubmit").addClass("btn-primary").text("新增");

                    }
                    tableForm.change(parentID + "_p", false);
                }
            });

        } else {
            /*========
             * 此处为去调用企业借款的信息
             ==========*/

            var forms = $("#" + parentID + " .company_forms");
            $.ajax({
                url: search_url,
                type: "post",
                data: {license_number: searchValue, type: DEBT_TYPE},
                dataType: "json",
                success: function (result) {

                    if (result.msg == 'login required') {
                        window.location.href = "/";
                    }
                    //显示表单
                    $form.show();
                    /*
                     * 根据返回结果来显示表单
                     * result为是否查询成功的字段
                     */
                    if (result.ok) {
                        //forms.attr('action', forms.attr('request_url') + "/id/" + result.data.id);
                        $("#" + parentID + " .company-info").html(result.data.html);

                        //如果查询成功，即有结果，则将表单填充，将按钮显示为“修改”；标题处显示 信息已录入可修改
                        //否则显示空表单，按钮显示为“保存”（灰显）；标题处显示 信息未录入待新增
                        $("#" + parentID + " .title-hyn .tip-yes").removeClass("hidden");
                        $("#" + parentID + " .company-info .bSubmit").addClass("btn-primary").text("保存");
                    } else {
                        $("#" + parentID + " .company-info").find("input[type=text]").val('');
                        //forms.attr('action', forms.attr('request_url'));
                        $("#" + parentID + " .title-hyn .tip-no").removeClass("hidden");
                        $("#" + parentID + " .company-info .bSubmit").addClass("btn-primary").text("新增");
                    }

                    tableForm.change(parentID + "_c", false);
                }
            });
        }

    });


    /*=========================以下为质/抵押信息的js=========================*/

    //选择不同的质/抵押物类型显示对应的表单内容
    $("#category").on("change", function (e) {
        //每次进来要先解绑一下，解决表单验证通过以后，切换到另一个类型的表单再切换回来时，只输入一个文本框内就验证通过的问题
        //每次进来要先解绑一下，解决表单验证通过以后，切换到另一个类型的表单再切换回来时，只输入一个文本框内就验证通过的问题
        //$(this).parents(".form-group").next().children().remove();

        if ($(this).val() == 1) {
            $(".info-form").hide();
            $("#pledge-name").show();
        } else if ($(this).val() == 2) {
            $(".info-form").hide();
            $("#pledge-name").show();
            $(".qcb").show();
        } else if ($(this).val() == 3 || $(this).val() == 6 || $(this).val() == 10) {
            $(".info-form").hide();
            $("#pledge-name").show();
            $(".fcb").show();
        } else if ($(this).val() == 4 || $(this).val() == 5) {
            $(".info-form").hide();
            $("#pledge-name").show();
            $(".hmb").show();
        } else if ($(this).val() == 7) {
            $(".info-form").hide();
            $("#pledge-name").show();
            $(".zxb").show();
        } else if ($(this).val() == 8) {
            $(".info-form").hide();
            $("#pledge-name").show();
            $(".jbp").show();
        } else if ($(this).val() == 9) {
            $(".info-form").hide();
            $("#pledge-name").show();
            $(".ryt").show();
        }
        //切换各表单时，需要清空表单内的内容，保存按钮需要置为可点状态，下一步按钮需要置为不可点状态
        //清空表单在各表单里验证函数里操作
        $("#collateral-info .bSubmit").addClass("btn-primary");
        tableForm.change("borrow", false);
        plageForm();
    });
    //如果借款人和质押物信息都填写正确且已保存，则可以点击下一步

    /*================step2 的债权基础信息表单验证======================*/
    /*
     * 1.第一步 先验证表单内容是否填写正确，如果正确 “生成付息表”按钮才能可点击
     * 2.第二步，点击生成付息表后，在显示的弹出框中显示付息纪录信息
     * 3.点击生成付息纪录后 付息纪录生成完毕后才能将保存按钮置为可点击状态
     * 4.在已经生成付息纪录后，点击债权基本信息表单的中的任意一个文本框，当文本框里的值有改变时，“付息纪录已生成”的按钮
     * 变为“生成付息表”按钮，且 保存按钮置为不可点击状态
     */

    !function debt_info() {
        var $input = null, inputText = "", inputTextOrg = "";
        var $parent = null;
        var $btn = $(".debt-info-form .debts-info-submit");
        var $createRateBnt = $("#J_CreateTable"), $viewRateBtn = $("#J_ReadyTable");
        var count = 0;
        //生成付息纪录表对象
        var createInterestObj = new CreateInterest();

        //点击保存按钮判断各项是否输入正确
        $btn.bind("click", function () {
            if (!$(this).hasClass("btn-primary")) {
                return false;
            }
            //通过调用已绑定的文本框事件来判断文本框内的值是否正确
            $(".debt-info-form .form-control").blur();
            //检查非空的下拉菜单是否有填写
            $(".debt-info-form .notNull").blur();
            //开始时间文本框单独拎出来
            if ($(".debt-info-form .inputStartDate").val() == "") {
                $(".debt-info-form .inputStartDate").parent().addClass("has-error");
            }
            var errLen = $(".debt-info-form .has-error").length;

            if (errLen > 0) {
                alert("请检查标红项值是否正确");
            } else {
                $btn.removeClass("btn-primary");
                var debts_form = $("#debts-info-form");
                $.ajax({
                    url: debts_form.attr('action'),
                    type: "post",
                    data: debts_form.serialize(),
                    dataType: "json",
                    success: function (data) {

                        if (data.msg == 'login required') {
                            window.location.href = "/";
                        }
                        if (data.ok) {

                            debts_form.attr('action', debts_form.attr('request_url') + "/id/" + data.data.id);
                            $("#Debt_id").val(data.data.id);
                            $("#J_CreateTable").addClass('btn-primary').show();
                            tableForm.change("debtInfo", true);
                            alert(data.msg + ",请重新生成一下付息表!");
                            //基础债权信息保存成功后 必须要重新生成一下付息表
                            //将已生成的付息表隐藏
                            $("#form-primary .form-content").hide();
                            tableForm.change("debtInterest", false);
                        } else {
                            if (data.verify) {
                                var obj = data.msg;
                                var html = '<ul>';
                                $("#mod-error p.save-error").html('');
                                $.each(obj, function (k, v) {
                                    html += '<li>' + v + '</li>';
                                });
                                html += "</ul>";
                                $("#mod-error p.save-error").html(html);
                                $("#mod-error").modal();
                                $(".debt-info-form .debts-info-submit").addClass("btn-primary");
                            } else {
                                alert(data.msg);
                            }

                        }
                    }

                });
            }
        })

        $(".debt-info-form .form-control").bind("blur", function () {
            $input = $(this);
            inputText = $input.val();
            inputTextOrg = $input.attr("data-org");
            $parent = $input.parent();

            if ($input.hasClass("inputAmount")) {
                //债权总额字段校验 非空＋整数
                count = judgeFormInput($(this), $parent, 5);
            } else if ($(this).hasClass("inputRates")) {
                //年化利率位置段校验 非空 ＋ 0到100之间
                count = judgeFormInput($(this), $parent, 129);

            } else if ($(this).hasClass("inputRate")) {
                //合同利率位置段校验 非空 ＋ 0到100之间
                count = judgeFormInput($(this), $parent, 129);

            } else if ($(this).hasClass("inputFee")) {
                //手续费字段校验 非空+ 0到100之间
                count = judgeFormInput($(this), $parent, 129);

            } else if ($(this).hasClass("inputDate")) {
                if ($(this).parents(".col-sm-4").css("display") == "none") {
                    //如果这个字段是隐藏的，则不需要判断该项值，并将标红样式去除（如果有的话）
                    $(this).parent().removeClass("has-error");
                } else {
                    //到期日字段校验 非空+数字要在1～28之间+整数
                    count = judgeFormInput($(this), $parent, 133);
                }
            } else if ($(this).hasClass("inputSerialNumber")) {
                count = judgeFormInput($(this), $parent, 1025);
            }
            //如果文本框中的值有变更，则判断值输入是否正确，正确则将新值复制给原值
            //文本框中值有变更，则需要将保存按钮置为可点击状态，显示生成付息表按钮，隐藏查看付息表按钮
            if (inputText != inputTextOrg) {
                if (count > 0) {
                    $input.attr("data-org", inputText);
                }
                judgeBtn();
            }

        }).bind("focus", function () {
            count = 0;
            $(this).parent().removeClass("has-error");
        });

        //两个时间选择框的事件需要单独拎出来判断
        $(".debt-info-form .datetime").bind("hide", function () {
            $input = $(this).children("input");
            $parent = $(this);
            inputText = $input.val();
            inputTextOrg = $input.attr("data-org");
            count = judgeFormInput($input, $parent, 1);

            $sParent = $(".debt-info-form .inputStartDate").parent();
            $eParent = $(".debt-info-form .inputEndDate").parent();
            var sText = $(".debt-info-form .inputStartDate").val();
            var eText = $(".debt-info-form .inputEndDate").val();
            var sDate = new Date(sText);
            var eDate = new Date(eText);

            if (inputText != inputTextOrg) {
                if (count > 0) {
                    if (eDate >= sDate) {
                        $input.attr("data-org", inputText);
                    } else {
                        $eParent.addClass("has-error");
                    }
                }
                judgeBtn();
            }
        }).bind("show", function () {
            $(this).removeClass("has-error");
        })
        //如果选择的付息方式是按月或按季，则显示到期日字段，否则不现实到期日字段
        $(".debt-info-form .inputMethod").change(function () {
            if ($(this).select2("val") != 1 && $(this).select2("val") != 2) {
                $("#form-primary .payDate").hide();
            } else {
                $("#form-primary .payDate").show();
            }

        })

        //下拉菜单的内容变更后，需要重新生成付息表
        $(".debt-info-form .select2").bind("change", function () {

            judgeBtn();
        })

        //设置保存按钮为可点击状态，显示生成付息表按钮，隐藏查看付息表按钮
        function judgeBtn() {

            $btn.addClass("btn-primary");
            $createRateBnt.removeClass("btn-primary").show();
            $("#J_ReadyTable").hide();
            //需要点击生成付息表时，下一步按钮也需要置为不可点击，因为只有当付息表生成了，才能进入下一步
            tableForm.change("debtInfo", false);

        }

        //付息表区块中的到期日字段校验
        $("#form-primary .payDate input").bind("blur", function () {
            var $input = $(this);
            var $parent = $input.parent();
            var count = 0;
            var inputText = $input.val(), inputTextOrg = $input.attr("data-org");

            if ($(this).parents(".payDate").css("display") == "none") {
                //如果这个字段是隐藏的，则不需要判断该项值，并将标红样式去除（如果有的话）
                $(this).parent().removeClass("has-error");
            } else {
                //到期日字段校验 非空+数字要在1～28之间+整数
                count = judgeFormInput($(this), $parent, 133);
            }

            if (inputText != inputTextOrg) {
                if (count > 0) {
                    $input.attr("data-org", inputText);
                }
                $("#J_CreateTable").show();
                $("#form-primary .form-content").hide();
                tableForm.change("debtInterest", false);
            }
        }).bind("focus", function () {
            $(this).parent().removeClass("has-error");
        });

        //点击“生成付息表”按钮后，显示“付息表已生成”
        //点击生成付息表按钮后，将非文本框中的值传入到对象
        $("#J_CreateTable").bind("click", function () {
            if ($(this).hasClass("btn-primary")) {
                //如果付息日文本框是显示的，则需要判断该文本框项是否有填写正确的值
                $("#form-primary .title input").blur();
                var errLen = $("#form-primary .title .has-error").length;
                if (errLen > 0) {
                    alert("请检查标红项的值是否正确");
                    return false;
                }
                if ($(this).attr("id") == "J_CreateTable") {
                    $("#form-primary .form-content").show();
                    $("#form-primary .saveBtn").addClass("btn-primary");
                }
                createInterestObj.setAmount($(".debt-info-form .inputAmount").val());

                createInterestObj.setRate($(".debt-info-form .inputRate").val());

                createInterestObj.setFee($(".debt-info-form .inputFee").val());

                createInterestObj.setPayDate($("#form-primary .inputDate").val());
                //将时间框中的内容复制到对象中
                createInterestObj.setStartDate($(".debt-info-form .inputStartDate").val());
                createInterestObj.setEndDate($(".debt-info-form .inputEndDate").val());
                //将非文本框中的值传入到对象中
                createInterestObj.setInterestForm($(".inputInterestForm").select2("val"));
                createInterestObj.setMethod($(".inputMethod").select2("val"));
                //执行生成付息纪录方法
                createInterestObj.create();
                //付息表生成,下一步按钮可点击

                tableForm.change("debtInterest", false);
            } else {
                alert("请先保存债权信息，再生成付息表");
                return false;
            }

        });
        //修改了付息表的内容 如果没有点击“计算并保存”，或者保存失败，然后直接关闭弹出框 点击下一步时，
        //需要提示用户是否进入下一步，直接进入下一步会保存的会是修改前的付息表
        //点击新增时,将updataFlag设置为false,表示有付息表有变更过，但还没有保存
        $("#form-primary .addTr").bind("click", function () {
            createInterestObj.addInterest();
            $("#form-primary .saveBtn").addClass("btn-primary");
            tableForm.change("debtInterest", false);
        });


        //点击弹出框中的计算按钮
        $("#form-primary .acountBtn, #form-primary .saveBtn").bind("click", function () {
            if (!$(this).hasClass("btn-primary")) {
                return false;
            }
            var flage = true;
            //计算前需要验证各时间文本框的值
            /*
             * 在全部输入完成之后，点击保存按钮 进行验证
             * 1.验证第一个开始和最后一个结束时间是否等于设置的付息开始和结束时间
             * 2.第二个起的开始时间是否等于前一个的结束时间的天数＋1
             * 3.中间和前面不允许空行（这里的空行是指开始时间和结束时间为空的）
             * 4.允许新增，新增在最后一行新增
             * 5.允许删除
             * 6.如果验证的时候 中间有空行 则需要提示错误
             */
            //判断是否有空文本框，有空文本框提示错误信息
            var $inputDate_alert = $("#form-primary .date input");
            $inputDate_alert.parent().removeClass("has-success").removeClass("has-error");
            $inputDate_alert.each(function (index, element) {
                if ($(this).val() == "") {
                    $(this).parent().addClass("has-error");
                    flage = false;
                    return false;
                }
            });
            //有空行 结束
            if (!flage) {
                return false;
            }
            var $inputSDom = $("#form-primary .inputStartDate");
            var inputSDomLen = $inputSDom.length - 1;
            var $inputEDom = $("#form-primary .inputEndDate");
            var inputEDomLen = $inputEDom.length;
            //用于在验证通过后，进行重新生成付息表时传入的计息开始和结束时间
            var sDateArr = [];
            var eDateArr = [];

            //判断第一个开始时间是否等于付息时间
            var startTemp = $inputSDom.eq(0).val();
            startTemp = new Date(startTemp);
            //修改进来的页面 createInterestObj对象需要创建
            if (createInterestObj.amount == 0) {
                createInterestObj.setAmount($(".debt-info-form .inputAmount").val());

                createInterestObj.setRate($(".debt-info-form .inputRate").val());

                createInterestObj.setFee($(".debt-info-form .inputFee").val());

                createInterestObj.setPayDate($("#form-primary .inputDate").val());
                //将时间框中的内容复制到对象中
                createInterestObj.setStartDate($(".debt-info-form .inputStartDate").val());
                createInterestObj.setEndDate($(".debt-info-form .inputEndDate").val());
                //将非文本框中的值传入到对象中
                createInterestObj.setInterestForm($(".inputInterestForm").select2("val"));
                createInterestObj.setMethod($(".inputMethod").select2("val"));
                createInterestObj.setInterestStart();
            }
            if (!diffDate(startTemp, createInterestObj.interestStart, 0)) {
                $inputSDom.eq(0).parent().addClass("has-error");
                return false;
            } else {
                sDateArr.push(startTemp);
            }
            //判断最后一个结束时间是否等于债权的结束时间,如果不等于 则结束
            var endTemp = $inputEDom.eq(inputEDomLen - 1).val();
            endTemp = new Date(endTemp);
            if (!diffDate(endTemp, createInterestObj.endDate, 0)) {
                $inputEDom.eq(inputEDomLen - 1).parent().addClass("has-error");
                return false;
            } else {
                eDateArr.push(endTemp);
            }
            //判断下一个付息列表的开始时间是否与前一个的结束时间相差一天
            for (var index = 0; index < inputSDomLen; index++) {
                startTemp = $inputSDom.eq(index + 1).val();
                endTemp = $inputEDom.eq(index).val()

                startTemp = new Date(startTemp);
                endTemp = new Date(endTemp);

                if (!diffDate(endTemp, startTemp, 1)) {
                    $inputEDom.eq(index).parent().addClass("has-error");
                    return false;
                } else {
                    sDateArr.push(startTemp);
                    eDateArr.push(endTemp);
                }
            }
            //结束的日期数组 需要将第一个放置到最后一个处
            eDateArr.push(eDateArr[0]);
            eDateArr.shift();
            //验证都通过时，进行生成付息表,根据进来的按钮 来执行是仅计算还是计算并保存按钮
            if ($(this).hasClass("acountBtn")) {
                createInterestObj.update(sDateArr, eDateArr);
            } else {
                $(this).removeClass("btn-primary");
                createInterestObj.save(sDateArr, eDateArr);
            }
        })
    }();

});
//判断两个时间在是否等于指定的天数值
function diffDate(sDate, eDate, days) {
    sDate.setHours(0);
    sDate.setMinutes(0);
    sDate.setSeconds(0);
    sDate.setMilliseconds(0);
    eDate.setHours(0);
    eDate.setMinutes(0);
    eDate.setSeconds(0);
    eDate.setMilliseconds(0);
    var temp = (eDate - sDate) / (24 * 60 * 60 * 1000);
    temp = parseInt(temp);
    if (temp == days) {
        return true;
    } else {
        return false;
    }
}

/*
 *如何判断下一步是否可点击（如债权信息页面上）
 *下一步可点击的前提条件是是债权人基本信息 已保存， 债权信息 已保存
 *当点击了保存后 再去修改时，还需要将下一步的这个按钮给置为不可点
 *
 */

function TabelForm() {
    //债权人信息表单是否提交成功
    this.creditors_p = false;
    this.creditors_c = false;
    //债权基本信息的表单是否提交成功
    this.debtInfo = false;
    //借款人基本信息的表单是否提交成功
    this.borrower_p = false;
    this.borrower_c = false;
    //质/抵押物信息的表单是否提交成功
    this.borrow = false;
    this.bank_card = false;
    //付息表纪录是否提交成功
    this.debtInterest = false;
    //债权描述
    this.debtDesc = false;
}

TabelForm.prototype.change = function (type, value) {
    var changeType;
    switch (type) {
        case "creditors_p":
            this.creditors_p = value;
            break;
        case "creditors_c":
            this.creditors_c = value;
            break;
        case "debtInfo":
            this.debtInfo = value;
            break;
        case "borrower_p":
            this.borrower_p = value;
            break;
        case "borrower_c":
            this.borrower_c = value;
            break;
        case "borrow":
            this.borrow = value;
            break;
        case "debtInterest":
            this.debtInterest = value;
            break;
        case "debtDesc":
            this.debtDesc = value;
            break;
        case "bank_card":
            this.bank_card = value;
            break;
    }

}
//点击第二步的下一步按钮 加载附件上传的代码
//点击第二步的下一步按钮 加载附件上传的代码


$(function () {

    $("#DebtCreditorsPerson_province").live("change", function () {
        $.ajax({
            url: $(this).attr('get_url'),
            type: "post",
            data: {code: $(this).val()},
            dataType: "html",
            success: function (data) {
                if (data.msg == 'login required') {
                    window.location.href = "/";
                }
                $("#DebtCreditorsPerson_city").html(data);
                $("#s2id_DebtCreditorsPerson_city").select2("val", "").parents(".col-sm-2").addClass("has-error");
            }
        });
    });

    $("#DebtBorrowerPerson_province").live("change", function () {
        $.ajax({
            url: $(this).attr('get_url'),
            type: "post",
            data: {code: $(this).val()},
            dataType: "html",
            success: function (data) {
                if (data.msg == 'login required') {
                    window.location.href = "/";
                }
                $("#DebtBorrowerPerson_city").html(data);
                $("#s2id_DebtBorrowerPerson_city").select2("val", "").parents(".col-sm-2").addClass("has-error");
            }
        });
    });

    $(".endBtn .debt-my-save").on('click', function () {

        if ($(this).hasClass('submit-click')) {
            return false;
        }
        $(this).addClass('submit-click');
        //判断各区块是否保存成功
        if (!tableForm.debtInfo) {
            alert("债权基础信息未保存");
            $(this).removeClass('submit-click');
            return false;
        }
        if (!tableForm.debtInterest) {
            alert("付息表记录未保存");
            $(this).removeClass('submit-click');
            return false;
        }
        if (!tableForm.creditors_p && !tableForm.creditors_c && $("#Debt_debt_type").val() == 0) {
            alert("债权人信息未保存");
            $(this).removeClass('submit-click');
            return false;
        }
        if (!tableForm.borrower_p && !tableForm.borrower_c) {
            alert("借款人信息未保存");
            $(this).removeClass('submit-click');
            return false;
        }

        if (!tableForm.bank_card && $("#Debt_debt_type").val() == 1) {
            alert("银行卡信息未保存");
            $(this).removeClass('submit-click');
            return false;
        }

        if (!tableForm.borrow) {
            alert("抵/质押物信息未保存");
            $(this).removeClass('submit-click');
            return false;
        }

        if (!tableForm.debtDesc) {
            alert("债权描述信息未保存");
            $(this).removeClass('submit-click');
            return false;
        }
        //判断各图片是否有上传
        var $imgList = $(".queueList .filelist");
        var imgSucLen = 0;
        var imgListLen = $imgList.length;
        for (var index = 0; index < imgListLen; index++) {
            imgSucLen = $imgList.eq(index).find(".success").length;
            var debt_my_type = $("#Debt_debt_type").val();
            if (imgSucLen == 0 && debt_my_type == 0 && index != 2) {
                switch (index) {
                    case 0:
                        alert("无上传成功的法律图片");
                        break;
                    case 1:
                        alert("无上传成功的项目图片");
                        break;
                    case 2:
                        alert("无上传成功的合同图片");
                        break;
                    case 3:
                        alert("无上传成功的压缩包");
                }
                $(this).removeClass('submit-click');
                return false;
            }
        }
        var type = '';
        if ($(this).hasClass("submitBtn")) {
            type = "verify";
        } else if ($(this).hasClass("btn-default")) {
            type = "goon";
        } else if ($(this).hasClass("btn-save")) {
            type = "save";
        }
        var debts_form = $("#debt-attachment-form");
        var params = {
            debt_id: $("#Debt_id").val(),
            type: type
        };

        $.ajax({
            url: debts_form.attr('action'),
            type: "post",
            data: debts_form.serialize() + '&' + $.param(params),
            dataType: "json",
            success: function (data) {

                if (data.msg == 'login required') {
                    window.location.href = "/";
                }

                if (data.ok) {
                    window.location.href = data.url;
                } else {
                    alert(data.msg);
                    $(this).removeClass('submit-click');
                }
            }
        });

    });

    $(".update_file").on('mouseover', function () {
        $(this).find('.file-panel2').stop().animate({height: 30});
    }).on('mouseout', function () {
        $(this).find('.file-panel2').stop().animate({height: 0});
    });
    $(".update_file .file-panel2").on('click', 'span', function () {


        var data_uploader = $(this).parent().parent().attr('data-uploader');
        var data_btn = $(this).parent().parent().attr('data-btn');
        var this_id = $(this).parent().parent().attr('id');
        var num = $("#" + data_uploader).find('.filelist li').length;
        $(this).parent().parent().remove();

        var sspp = $("#" + data_uploader + " .update_file").length;

        $("." + data_uploader + "_hidden").val(sspp);
        if (sspp == 0) {
            $("#" + data_uploader).find('.filelist').remove();
            if (data_uploader != "uploader4") {
                loadUpImage($("#" + data_uploader), data_btn, false, 0, 0);
            } else {
                loadUpImage3($("#" + data_uploader), data_btn, false, 0, 0);
            }
            $("#" + data_uploader).find('.placeholder').removeClass('element-invisible');
            $("#" + data_uploader).find('.queueList').removeClass('filled');
            $("#" + data_btn).removeClass('element-invisible');

        }
    });

    $("#select_images").on('change', function () {
        $(".filelist").empty();
        $(".attachmentHide").empty();
        $(".default-display").hide();
        $("." + $(this).val()).show();
        $(".filelist").remove();
        if ($(this).val() == 'cgtz_debt_pledge') {
            loadUpImage2($("#uploader"), "filePicker1");
            $("#uploader").find('.placeholder').removeClass('element-invisible');
            $("#uploader").find('.queueList').removeClass('filled');
            $("#filePicker1").removeClass('element-invisible');
        } else if ($(this).val() == 'cgtz_debt_debtor') {
            loadUpImage2($("#uploader2"), "filePicker2");
            $("#uploader2").find('.placeholder').removeClass('element-invisible');
            $("#uploader2").find('.queueList').removeClass('filled');
            $("#filePicker2").removeClass('element-invisible');
        } else {
            loadUpImage2($("#uploader3"), "filePicker3");
            $("#uploader3").find('.placeholder').removeClass('element-invisible');
            $("#uploader3").find('.queueList').removeClass('filled');
            $("#filePicker3").removeClass('element-invisible');
        }
    });
    $(".edit-attachment-btn").on('click', function () {
        var debts_form = $("#edit-attachment");
        if ($(".queueList .filelist .success").length <= 0) {
            alert("请上传图片");
            return false;
        }
        $.ajax({
            url: debts_form.attr('action'),
            type: "post",
            data: debts_form.serialize(),
            dataType: "json",
            success: function (data) {
                if (data.msg == 'login required') {
                    window.location.href = "/";
                }
                if (data.ok) {
                    alert(data.msg);
                    window.location.href = data.url;
                } else {
                    alert(data.msg);
                }

            }
        });
        return false;
    });

    $(".delInterest").live('click', function () {
        if (confirm("确定删除吗？")) {
            //如果点击确定，则删除所在的表格行
            $(this).parents("tr").remove();
            //删除付息表里的行时，需要设置updateFlagTemp 为 flase，表示付息表有变动 还没有保存
            tableForm.change("debtInterest", false);
        }
    });


});

function request_action(debts_form, params, type) {
    $.ajax({
        url: debts_form.attr('action'),
        type: "post",
        data: debts_form.serialize() + '&' + $.param(params),
        dataType: "json",
        success: function (data) {
            if (data.msg == 'login required') {
                window.location.href = "/";
            }
            if (data.ok) {
                debts_form.attr('action', debts_form.attr('request_url') + "/id/" + data.data.id);
                if (type) {
                    tableForm.change(type, true);
                    //保存成功后，是否为新增项的提示语隐藏
                    var parentID = type.split("_")[0];
                    $("#" + parentID + " .tip").addClass("hidden");
                    if(type=='borrower_p'){
                        $("#bank_card_holder").html($("#DebtBorrowerPerson_name").val());
                        $("#debt-bank-card .iradio_square-blue").addClass('disabled');
                        $("input:radio[name='UserBankCard[card_type]']").eq(1).removeAttr('checked').parent().removeClass('checked');
                        $("input:radio[name='UserBankCard[card_type]']").eq(0).attr("checked",true).parent().addClass('checked');
                    }
                    if(type=='borrower_c'){
                        $("#bank_card_holder").html($("#DebtBorrowerCompany_name").val());
                        $("input:radio[name='UserBankCard[card_type]']").eq(0).removeAttr('disabled');
                        $("input:radio[name='UserBankCard[card_type]']").eq(1).removeAttr('disabled');
                        $("input:radio[name='UserBankCard[card_type]']").eq(0).removeAttr('checked').parent().removeClass('checked');
                        $("input:radio[name='UserBankCard[card_type]']").eq(1).attr("checked",true).parent().addClass('checked');
                        $("#debt-bank-card .iradio_square-blue").removeClass('disabled');
                    }
                    alert("保存成功");
                }
            } else {
                if (type) {
                    var parentID = type.split("_")[0];
                    tableForm.change(type, false);
                    $("#" + parentID + ".bSubmit").addClass("btn-primary");
                }
                debts_form.attr('action', debts_form.attr('request_url'));
                if (data.verify) {
                    var obj = data.msg;
                    var html = '<ul>';
                    $("#mod-error p.save-error").html('');
                    $.each(obj, function (k, v) {
                        html += '<li>' + v + '</li>';
                    });
                    html += "</ul>";
                    $("#mod-error p.save-error").html(html);
                    $("#mod-error").modal();
                } else {
                    alert(data.msg);
                }
            }
        }
    });

}


/*========质押物表单验证函数 start==================*/
//method：如果为true则是修改进来的，如果是false则是新增进来的
function plageForm(method) {
    var $parent = "";
    var inputText = "", inputTextOrg = "", $input = null;
    var $btn = $("#collateral-info .bSubmit");
    var num = 1, count = 0, countArr = [0];
    //表单初始化动作 将表单中的提交按钮解绑click事件，将表单中的文本项解绑blur事件，将表单中的文本项清空，去除标红样式
    $btn.unbind("click");
    if (!method) {
        $("#debt_pledge_hidden input").unbind("blur").val("").parent().removeClass("has-error");
    }
    //是否资金监控为是,根据分类的选中值不同显示对应的资金监控选项
    //贸易通，聚宝盆，资产宝是要选中资金监控字段
    var plageType = $("#s2id_category").select2("val");
    var $jkzj = $(".jkzj-hyn .icheck");
    switch (plageType) {
        case "1":
        case "8":
        case "10":
            $jkzj.eq(0).iCheck("check").attr("checked", "checked");
            break;
        default:
            $jkzj.eq(1).iCheck("check").attr("checked", "checked");
    }

    $("#collateral-info input").bind("focus", function () {

        $(this).parent().removeClass("has-error");

    }).bind("blur", function () {
        $input = $(this);
        inputText = $input.val();
        inputTextOrg = $input.attr("data-org");
        $parent = $input.parent();

        //如果这个字段是隐藏的，则不判断字段值是否正确，且需要将标红的样式去除
        if ($input.parents(".info-form").css("display") == "none") {
            $parent.removeClass("has-error");
        } else {
            //名称，注册时间，所在位置字段仅需验证非空
            if ($input.hasClass("notNull")) {
                //仅需校验非空字段
                count = judgeFormInput($input, $parent, 1);

            } else if ($input.hasClass("notNull_int")) {
                //需要检验非空和整数
                count = judgeFormInput($input, $parent, 3);

            } else if ($input.hasClass("notNull_num")) {
                //需要验证非空和数值
                count = judgeFormInput($input, $parent, 5);
            }
            //如果值有变更，需要判断值是否输入正确，正确则将原值变更为新值
            if (inputText != inputTextOrg) {
                if (count > 0) {
                    $input.attr("data-org", inputText);
                }
                $btn.addClass("btn-primary");
            }
        }

    });

    //汽车宝 注册时间字段校验 非空

    $("#collateral-info .datetime").bind('hide', function () {
        $input = $(this).children();
        $parent = $input;
        inputText = $input.val();
        inputTextOrg = $input.attr("data-org");
        count = judgeFormInput($input, $parent, 1);
        //如果值有变更，需要判断值是否输入正确，如果输入正确，则将原址变更为新值
        if (inputText != inputTextOrg) {
            if (count > 0) {
                $input.attr("data-org", inputText);
            }
            $btn.addClass("btn-primary");
        }
    }).bind("show", function () {
        $(this).removeClass("has-error");
        $(this).children("input").removeClass('has-error');
        $(this).children(".input-group-addon").removeClass('has-error');
    });
    //单选按钮切换勾选后 保存按钮显示为可点击状态
    $("#collateral-info .icheck").bind("ifChecked", function () {
        $btn.addClass("btn-primary");
        tableForm.change("borrow", false);
    })
    //点击提交按钮
    $btn.bind("click", function () {
        if (!$(this).hasClass("btn-primary")) {
            return false;
        }
        $("#collateral-info input").blur();
        //时间文本框单独拎出来
        var $timeInput = $("#collateral-info .datetime");
        if ($timeInput.parents(".form-group").css("display") != "none") {
            if ($timeInput.children("input").val() == "") {
                $timeInput.addClass("has-error");
            }
        }


        var errLen = $("#collateral-info .has-error").length;

        if (errLen > 0) {
            alert("请检查标红项是否正确");
            tableForm.change("borrow", false);
        } else {
            $(this).removeClass("btn-primary");
            $("#DebtPledge_capital_monitor .icheck").removeAttr('disabled');
            var debts_form = $("#debtPledge-form");
            var params = {
                debt_id: $("#Debt_id").val()
            };
            request_action(debts_form, params, 'borrow');
            $("#DebtPledge_capital_monitor .icheck").attr('disabled', 'disabled');
        }
    })


}
/*================质押物验证字段 end====================*/


/*====================新建债券 第三步========================*/
//method：true为修改进来的
function debtDescription(method) {
    var $btn = $(".debt-description .bSubmit");
    var $parent = null;
    var $input = null, inputText = "";
    inputTextOrg = ""
    var count = 0;

    $(".debt-description .notNull").bind("blur", function () {
        $input = $(this);
        $parent = $input.parent();
        if ($input.parents(".form-group").css("display") == "none") {
            $parent.remveClass("has-error");
        } else {
            judgeFormInput($input, $parent, 1);
        }
    }).bind("select2-open", function () {
        $(this).parent().removeClass("has-error");
    }).on("select2-close", function () {
        var $parent = $(this).parent();
        count = judgeFormInput($(this), $parent, 1);

    });

    $(".debt-description textarea").bind("change", function () {
        tableForm.change("debtDesc", false);
        $btn.addClass("btn-primary");
    }).bind("focus", function () {
        $(this).parent().removeClass("has-error");
    });

    $btn.bind("click", function () {
        if (!$(this).hasClass("btn-primary")) {
            return false;
        }
        $(".debt-description .notNull").blur();
        var errLen = $(".debt-description .has-error").length;

        if (errLen > 0) {
            alert("请检查标红框的值是否正确");
        } else {
            $btn.removeClass("btn-primary");
            var debts_form = $("#debt-desc-form");
            var params = {
                debt_id: $("#Debt_id").val()
            };
            request_action(debts_form, params, "debtDesc");
        }
    })
}
/*========借款人（企业）基本信息 表单验证============*/
//债权人，借款人（企业）光标离开事件
$(".company-info input").live("blur", function () {
    var $input = $(this);
    var inputText = $input.val();
    var $parent = $input.parent();
    var inputTextOrg = $input.attr("data-org");
    var count = 0;
    var parentID = $input.parents(".block-flat").attr("id");
    var $btn = $("#" + parentID + " .company-info .btn");

    if ($input.hasClass("notNull")) {
        //验证借款企业名称,非空验证
        count = judgeFormInput($(this), $parent, 1);

        if ($input.hasClass("inputCode")) {
            //组织代码证字段验证 ， 非空 ＋ 长度为9 + 数字或大写字母
            count = judgeFormInput($(this), $parent, 769);
        } else if ($input.hasClass("inputTel")) {
            //企业联系电话，非空 + 手机格式或电话格式
            count = judgeFormInput($(this), $parent, 33);
        } else if ($input.hasClass("inputIdentity")) {
            //法人身份证 ，非空 ＋ 身份证格式
            count = judgeFormInput($(this), $parent, 65);
        }
    } else {
        if (inputText != "") {
            if ($input.hasClass("inputYear")) {
                //经营年限验证，数字
                count = judgeFormInput($(this), $parent, 2);
            } else if ($input.hasClass("inputAmount")) {
                //年营业额验证，数字
                count = judgeFormInput($(this), $parent, 2);
            }
        }
    }
    //如果值输入的是正确的，则需要判断值是否有变，有变则将保存按钮置为可点击状态
    if (inputText != inputTextOrg) {
        if (count > 0) {
            $input.attr("data-org", inputText);
        }
        $btn.addClass("btn-primary");
        tableForm.change(parentID + "_c", false);
    }
})

//债权人，借款人（企业）点击保存按钮
//点击提交按钮
$(".company-info .bSubmit").live("click", function () {
    var $btn = $(this);
    if (!$btn.hasClass("btn-primary")) {
        return false;
    }
    var parentID = $btn.parents(".block-flat").attr("id");

    $("#" + parentID + " .company-info .notNull").blur();

    var errLen = $("#" + parentID + " .company-info .has-error").length;
    if (errLen > 0) {
        alert("请检查标红项值是否正确");
        tableForm.change(parentID + "_c", false);
    } else {
        //防重复提交 先把保存按钮置为不可点状态
        $btn.removeClass("btn-primary");
        var debts_form = null, params = null;
        debts_form = $("#" + parentID + "-company-form");
        params = {
            debt_id: $("#Debt_id").val(),
            company_type: $("#" + parentID + "_type_hide").val()
        };

        request_action(debts_form, params, parentID + "_c");
    }
});
/*=============借款人（个人）基本信息 表单验证==============*/
//债权人，借款人（个人）表单验证
$(".person-info input").live("blur", function () {
    var $input = $(this);
    var inputText = $input.val();
    var inputTextOrg = $input.attr("data-org");
    var $parent = $input.parent();
    var count = 0;
    var parentID = $input.parents(".block-flat").attr("id");
    var $btn = $("#" + parentID + " .person-info .btn");

    if ($input.hasClass("notNull")) {
        //验证姓名,非空验证
        count = judgeFormInput($(this), $parent, 1);
        if ($input.hasClass("inputTel")) {
            //验证联系电话，非空 ＋ 手机号码格式
            count = judgeFormInput($(this), $parent, 9);
        } else if ($input.hasClass("inputAge")) {
            //验证年龄，非空 ＋ 数字 + 18～100之间
            count = judgeFormInput($(this), $parent, 133);
        }
    }

    //如果输入的值正确，则需要判断值是否有变化，有变化则将保存按钮置为可点击状态
    if (inputText != inputTextOrg) {
        if (count > 0) {
            $input.attr("data-org", inputText);
        }
        $btn.addClass("btn-primary");
        tableForm.change(parentID + "_p", false);
    }

});


$("#debt-bank-card .icheck").on("ifChecked", function (event) {
    //获取搜索表单对象
    if ($(this).val() == 0) {
        $("#bank_card_holder").html($("#DebtBorrowerCompany_legal_person_name").val());
    } else {
        $("#bank_card_holder").html($("#DebtBorrowerCompany_name").val());
    }
});


//下拉菜单变更后 需要将保存按钮置为可点击状态,并置为未保存状态
$(".person-info .select2").live("change", function () {
    var $input = $(this);
    var parentID = $input.parents(".block-flat").attr("id");
    var $btn = $("#" + parentID + " .person-info .btn");

    $btn.addClass("btn-primary");
    tableForm.change(parentID + "_p", false);
}).live("select2-open", function () {
    $(this).parent().removeClass("has-error");
}).live("select2-close", function () {
    var $parent = $(this).parent();
    judgeFormInput($(this), $parent, 1);
}).live("blur", function () {
    var $parent = $(this).parent();
    judgeFormInput($(this), $parent, 1);
})

//单选按钮切换勾选后，需要将保存按钮置为可点击状态
$(".person-info .icheck").bind("ifChecked", function () {
    var $input = $(this);
    var parentID = $input.parents(".block-flat").attr("id");
    var $btn = $("#" + parentID + " .person-info .btn");

    $btn.addClass("btn-primary");
    tableForm.change(parentID + "_p", false);
})

//债权人，借款人（个人）保存按钮的点击事件
$(".person-info .bSubmit").live("click", function () {
    var $btn = $(this);
    if (!$btn.hasClass("btn-primary")) {
        return false;
    }
    var parentID = $btn.parents(".block-flat").attr("id");

    $("#" + parentID + " .person-info .notNull").blur();
    //errLen为出错项的个数
    var errLen = $("#" + parentID + " .has-error").length;
    if (errLen > 0) {
        alert("请检查标红项值是否正确");
        tableForm.change(parentID + "_c", false);
    } else {
        //先将保存按钮置为不可点状态，防止重复提交
        $btn.removeClass("btn-primary");
        var debts_form = null, params = null;
        debts_form = $("#" + parentID + "-person-form");
        params = {
            debt_id: $("#Debt_id").val(),
            person_type: $("#" + parentID + "_type_hide").val()
        };

        request_action(debts_form, params, parentID + "_p");
    }
})

$("#debt-bank-card .debts-bank-card-submit").on("click", function () {
    var $btn = $(this);
    if (!$btn.hasClass("btn-primary")) {
        return false;
    }
    $("#debt-bank-card-form .notNull").blur();

    var errLen = $("#debt-bank-card-form .has-error").length;
    if (errLen > 0) {
        alert("请检查标红项值是否正确");
        tableForm.change("bank_card", false);
    } else {
        //防重复提交 先把保存按钮置为不可点状态
        $btn.removeClass("btn-primary");
        var debts_form = null, params = null;
        debts_form = $("#debt-bank-card-form");
        params = {
            debt_id: $("#Debt_id").val()
        };
        $("input:radio[name='UserBankCard[card_type]']").removeAttr('disabled');

        $.ajax({
            url: debts_form.attr('action'),
            type: "post",
            data: debts_form.serialize() + '&' + $.param(params),
            dataType: "json",
            success: function (data) {
                if (data.msg == 'login required') {
                    window.location.href = "/";
                }
                if (data.ok) {
                    alert("保存成功");
                    tableForm.change("bank_card", true);
                }else{
                    alert(data.msg);
                }
            }
        });
    }
});


$("#UserBankCard_bank_province").on("change", function () {

    $("#s2id_UserBankCard_bank_city .select2-chosen").html("城市加载中").select2("disable");
    $("#UserBankCard_bank_city").parents(".col-sm-2").addClass("has-error");
    $("#s2id_UserBankCard_sub_branch_name .select2-chosen").html("请选择城市信息").select2("disable");
    $("#UserBankCard_sub_branch_name").html('<option value="">请选择</option>');
    $.ajax({
        url: $(this).attr("request_url"),
        type: "post",
        data: {province: $(this).val()},
        dataType: "html",
        success: function (data) {
            if (data.msg == 'login required') {
                window.location.href = "/";
            }
            $("#UserBankCard_bank_city").html(data);
            $("#s2id_UserBankCard_bank_city .select2-chosen").html("请选择城市").select2("enable");
        }
    });
});

$("#UserBankCard_bank_city").on("change", function () {

    $("#s2id_UserBankCard_branch_name .select2-chosen").html("支行信息加载中").select2("disable");
    $("#UserBankCard_branch_name").parents(".col-sm-2").addClass("has-error");
    $.ajax({
        url: $(this).attr("request_url"),
        type: "post",
        data: {
            city: $(this).val(),
            province: $("#UserBankCard_bank_province").val(),
            bankName: $("#UserBankCard_bank_id").find('option:selected').html()
        },
        dataType: "html",
        success: function (data) {
            if (data.msg == 'login required') {
                window.location.href = "/";
            }
            $("#UserBankCard_sub_branch_name").html(data);
            $("#s2id_UserBankCard_sub_branch_name .select2-chosen").html("请选择支行").select2("enable");
        }
    });
});

$("#debt-bank-card-form .notNull").bind("select2-open", function () {
    $(this).parent().removeClass("has-error");
}).on("select2-close", function () {
    var $parent = $(this).parent();
    count = judgeFormInput($(this), $parent, 1);

}).live('blur', function () {
    $input = $(this);
    var inputText = $input.val();
    var $parent = $input.parent();
    var inputTextOrg = $input.attr("data-org");
    var count = 0;
    var $btn = $("#debt-bank-card .debts-bank-card-submit");
    if ($input.hasClass("notNull")) {
        //非空验证
        count = judgeFormInput($(this), $parent, 1);
        if ($input.hasClass('inputNumber')) {
            count = judgeFormInput($(this), $parent, 3);
        }
    }
    //如果输入的值正确，则需要判断值是否有变化，有变化则将保存按钮置为可点击状态
    if (inputText != inputTextOrg) {
        if (count > 0) {
            $input.attr("data-org", inputText);
        }
        $btn.addClass("btn-primary");
        tableForm.change("bank_card", false);
    }
});

$(".form-control").live("focus", function () {
    $(this).parent().removeClass("has-error");
});

$("#project_category .notNull").bind("select2-open", function () {
    $(this).parent().removeClass("has-error");
}).on("select2-close", function () {
    var $parent = $(this).parent();
    count = judgeFormInput($(this), $parent, 1);

}).bind("blur", function () {
    var $parent = $(this).parent();
    if ($parent.css("display") == "none") {
        $parent.removeClass("has-error");
    } else {
        count = judgeFormInput($(this), $parent, 1);
        if ($(this).hasClass("inputInvest")) {
            count = judgeFormInput($(this), $parent, 5);
        } else if ($(this).hasClass("inputRate")) {
            count = judgeFormInput($(this), $parent, 129);
        } else if ($(this).hasClass("inputSort")) {
            count = judgeFormInput($(this), $parent, 3);
        }
    }
})


$("#Debt_category1").on("change", function () {

    $("#s2id_Debt_category2 .select2-chosen").html("项目类别加载中").select2("disable");
    $("#Debt_category2").parents(".col-sm-2").addClass("has-error");
    $("#Debt_category3").parents(".col-sm-3").hide();
    $.ajax({
        url: $(this).attr("request_url"),
        type: "post",
        data: {code: $(this).val()},
        dataType: "html",
        success: function (data) {
            if (data.msg == 'login required') {
                window.location.href = "/";
            }
            $("#Debt_category2").html(data);
            $("#project_category .ldcd").show();
            $("#s2id_Debt_category2 .select2-chosen").html("请选择项目所属的类别").select2("enable");
        }
    });
});

$("#Debt_category2").on("change", function () {
    $("#s2id_Debt_category3 .select2-chosen").html("项目类别加载中").select2("disable");
    $.ajax({
        url: $(this).attr("request_url"),
        type: "post",
        data: {code: $(this).val()},
        dataType: "html",
        success: function (data) {
            if (data.msg == 'login required') {
                window.location.href = "/";
            }
            $("#Debt_category3").html(data);
            $("#s2id_Debt_category3").parents(".col-sm-3").addClass("has-error").show();
            $("#s2id_Debt_category3 .select2-chosen").html("请选择项目所属的类别").select2("enable");
        }
    });
});


$("#DebtDesc_tpl_id").on('change', function () {
    $(".project_desc_div textarea").val('');
    $.ajax({
        url: $(this).attr("request_url"),
        type: "post",
        data: {code: $(this).val()},
        dataType: "json",
        success: function (data) {

            if (data.msg == 'login required') {
                window.location.href = "/";
            }

            if (data.ok) {
                $.each(data.template, function (k, v) {
                    if (v != '') {
                        $(".t_debt_" + k).show();
                        $("#DebtDesc_" + k).val(data.data[k]);
                        $("#DebtDesc_" + k).addClass("notNull");
                    } else {
                        $(".t_debt_" + k).hide();
                        $("#DebtDesc_" + k).removeClass("notNull");
                    }
                });
                $("#DebtDesc_img_url").val(data.data.url);
            } else {
                alert(data.message);
            }
        }
    });
});


$("#Debt_debt_type").on('change', function () {
    changeTableFormFalse();
    if ($(this).val() == 1) {
        $(".debt-zhi-tou-hide").hide().find("input").removeClass('inputRates').parent().removeClass('has-error');
        $("#Debt_interest_from").val(1);
        $("#s2id_Debt_interest_from .select2-chosen").html("T+1").select2("disable");
        $("#creditors").hide();
        $("#debt-bank-card").show();
       // $(".debt_zhi_tou_contract_img").hide(); edit by zhengfanggang 暂时不隐藏
        $(".pingtai_fuwufei").html("平台服务费");
        $(".debt_number").html("借款编号");
        $(".debt_amount").html("借款总额");
        tableForm.change("creditors_p", true);

    } else {
        $(".debt-zhi-tou-hide").show().find("input").addClass('inputRates');
        $("#creditors").show();
        $("#debt-bank-card").hide();
        $("#Debt_interest_from").val(0);
        $("#s2id_Debt_interest_from .select2-chosen").html("T+0").select2("disable");
        $(".debt_zhi_tou_contract_img").show();
        $(".pingtai_fuwufei").html("手续费");
        $(".debt_amount").html("债权总额");
        $(".debt_number").html("原始债权编号");
    }

});
function changeTableFormFalse() {
    tableForm.change("creditors_p", false);
    tableForm.change("creditors_c", false);
    tableForm.change("debtInfo", false);
    tableForm.change("borrower_p", false);
    tableForm.change("borrower_c", false);
    tableForm.change("borrow", false);
    tableForm.change("debtInterest", false);
    tableForm.change("debtDesc", false);
    tableForm.change("bank_card", false);
}

$(function () {
    $(".sortable").sortable();
    $(".sortable").disableSelection();
});
