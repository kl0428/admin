    //计算付息纪录表
function CreateInterest() {
    this.amount = 0;
    this.rate = 0;
    this.fee = 0;
    //this.interestForm：0--T+0, 1--T+1, 2--T+2
    this.interestForm = 1;
    //this.method: 1--按月复习 2-－按季复习 3-－到期一次性还本付息 4-－等额本息 5-－等额本金
    this.method = 1;
    this.startDate = null;
    this.endDate = null;
    //计息开始的时间
    this.interestStart = null;
    this.payDate = 0;
    //债权的收益天数
    this.payDays = 0;
    //债权的收益期数
    this.payNumber = 1;
    //单位天息
    this.unitInterest = 0;
    //付息纪录列表
    this.interestArr = [];
    //弹出框付息表body元素对象
    this.$tableBody = $("#form-primary tbody");
    //弹出框付费表body元素对象
    this.$tableBody_fwf = $("#form-primary_fwf tbody");
    this.unitInterest_fwf = 0;
    this.interestArr_fwf = [];
    this.trArr = [];
    //付息表纪录修改后是否生成成功
    this.updateFlag = true;
}

CreateInterest.prototype.setAmount = function (value) {
    this.amount = value;
}

CreateInterest.prototype.setRate = function (value) {
    this.rate = value;
}

CreateInterest.prototype.setFee = function (value) {
    this.fee = value;
}

CreateInterest.prototype.setInterestForm = function (value) {
    this.interestForm = value;
}

CreateInterest.prototype.setMethod = function (value) {
    this.method = value;
}

CreateInterest.prototype.setStartDate = function (value) {
    this.startDate = new Date(value);
}

CreateInterest.prototype.setEndDate = function (value) {
    this.endDate = new Date(value);
}

CreateInterest.prototype.setPayDate = function (value) {
    this.payDate = value;
}

//生成付息纪录
CreateInterest.prototype.create = function (createType) {
    // 重新生成付息表时，需要讲原有的数据晴空
    this.interestArr = [];
    this.trArr = [];
    if(createType) {
        this.$tableBody_fwf.html("");
    }else {
        this.$tableBody.html("");
    }
    //计算天息
    this.countUnitInterest(createType);
    //计算起息开始时间
    this.setInterestStart();
    //获取初始的付息期数
    this.setPayNum();
    //设置每一期的开始和结束时间
    this.setStagesDate();
    //生成付息纪录
    this.showInterestForm(createType);

}
//修改付息纪录:在弹出框中修改了付息时间后，重新生成付息表纪录方法
CreateInterest.prototype.update = function (sDateArr, eDateArr, createType) {
    this.interestArr = [];
    this.trArr = [];
    if(createType) {
        this.$tableBody_fwf.html("");
    }else {
        this.$tableBody.html("");
    }
    this.payNumber = sDateArr.length;

    //生成新的付息时间
    for (var index = 0; index < this.payNumber; index++) {

        tempStagesObj = new Interest();
        tempStagesObj.init(sDateArr[index], eDateArr[index], this.unitInterest);
        if(this.payNumber-index==1){
            tempStagesObj.setPayableCapital(this.amount);
        }
        this.interestArr.push(tempStagesObj);

    }
    //生成新的付息表纪录
    this.showInterestForm(createType);
}
//保存付息表纪录
CreateInterest.prototype.save = function(sDateArr, eDateArr, createType) {
    this.update(sDateArr, eDateArr,createType);

    this.updateFlag = true;
    var debt_interest_forms=$('#debt-interest-form');
    var params={debt_id:$("#Debt_id").val()};
    $.ajax({
        url:debt_interest_forms.attr('action'),
        type:"post",
        data:debt_interest_forms.serialize() + '&' + $.param(params),
        dataType:'json',
        success:function(data){
            if(data.msg == "login required") {
                window.location.href = "/";
            }
            if(data.ok){
                tableForm.change("debtInterest", true);
                if(createType) {
                    alert("付费表保存成功！");
                }else {
                    alert("付息表保存成功！");
                }

                return false;
                alert("保存成功");
            }
            alert("保存失败");
            if(createType) {
                $("#form-primary_fwf .saveBtn").addClass("btn-primary");
            }else {
                $("#form-primary .saveBtn").addClass("btn-primary");
            }

        }
    })
}

//根据起息日来设置计息开始时间
CreateInterest.prototype.setInterestStart = function () {
    var tempDate = new Date(this.startDate.getTime());
    var tempDay = parseInt(this.startDate.getDate());
    tempDay += parseInt(this.interestForm);
    tempDate.setDate(tempDay);
    this.interestStart = tempDate;
}

//根据付息方式 计算期数
CreateInterest.prototype.setPayNum = function () {
    var tempNum = 0;
    var tempMonth = 0;

    //method 为1，是按月付息； 为2 是按季付息 ； 为3 是一次性还本付息
    if (this.method == 3) {
        //如果是一次性还本付息的 分期期数为1
        tempNum = 1;
    } else if (this.method == 1) {
        /*如果是按月付息的，分期期数的计算方式为：
         *
         */
        tempNum = this.countMonths();
    } else if (this.method == 2) {
        /*如果是按季付息的，分期期数的计算方式为：
         * 间隔的总月份数 / 3
         */
        tempMonth = this.countMonths();
        if (tempMonth % 3 > 0) {
            tempNum = parseInt(tempMonth / 3) + 1;
        } else {
            tempNum = tempMonth / 3;
        }
    }
    if (tempNum == 0) {
        tempNum = 1;
    }
    this.payNumber = tempNum;
}

//根据得出的期数，选择的付息方式，设置的付息时间 来设置每一期的开始和结束时间
CreateInterest.prototype.setStagesDate = function () {
    var tempStagesObj = null;
    var tempDate = this.interestStart.getDate();
    var tempSDate = new Date(this.interestStart.getTime());
    var tempEDate = new Date(this.interestStart.getTime());
    var temp = null;
    var tempPayNumber = this.payNumber;
    var tempAddMonth = 0;
    //允许的计息天数最大值
    var allowDiff = 0;
    //允许的计息天数最小值
    var allowDiff_min =0;
    //根据计息方式这是 需要隔的月份值，如果是按月，则隔一个月，如果是按季，则隔三个月
    switch (parseInt(this.method)) {
        case 1:
            tempAddMonth = 1;
            allowDiff = 45;
	    allowDiff_min = 14;
            break;
        case 2:
            tempAddMonth = 3;
            allowDiff = 90;
	    allowDiff_min = 14;
            break;
        case 3:
            tempAddMonth = 0;
            break;
    }

    //如果是按季或按月：第一期的计算和最后一期的计算要单独拉出来
    if (this.method < 3) {
        //需要判断第一期的付息天数是否大于４５天，如果大于４５天则需要在当月付息
        tempEDate.setDate(this.payDate);
        tempEDate.setMonth(tempEDate.getMonth() + tempAddMonth);
        var timeDiff = (tempEDate.getTime() - this.interestStart.getTime()) / (1000 * 3600 * 24);
        timeDiff = parseInt(timeDiff);
        //此时算出来的tempDate有跨年的情况,需要重置一下tempEDate的年份
        tempEDate.setFullYear(this.interestStart.getFullYear());

        if(this.interestStart.getMonth() != this.startDate.getMonth()) {
            //判断计息开始日是否在下个月
            if(this.method == 2) {
                tempEDate.setMonth(this.interestStart.getMonth() + (tempAddMonth - 1));
            }else {
                tempEDate.setMonth(this.interestStart.getMonth());
            }

        }if(timeDiff < allowDiff_min) {
	    //如果当前计息天数小于指定的天数（如15天）,因为按季的时候肯定不小于15天，所以此时不需要区分是按季还是按月
	    tempEDate.setMonth(this.interestStart.getMonth() + 2);
            this.payNumber -= 1;
        }else if(timeDiff >= allowDiff){
            //如果大于指定天数（如４５天），需要判断是按月还是按季
            if(this.method == 2) {
                tempEDate.setMonth(this.interestStart.getMonth() + (tempAddMonth - 1));
            }else {
                tempEDate.setMonth(this.interestStart.getMonth());
                //需要判断最后一期的结束日期是否在付息日的前面，如果是，付息期数需要加一(但是如果第一期的月份是设置的开始付息日的第二个月时,不需要加1)
                 /*if(this.endDate.getDate() < this.payDate && (this.interestStart.getMonth() == this.startDate.getMonth())) {
	             this.payNumber += 1;
		 }
		
		 if(this.endDate.getDate() > this.payDate) {
		   this.payNumber += 1;
		 }
		 */
		this.payNumber += 1;


            }
        }else {
	    if(this.payNumber == 1) {
	      tempEDate = this.endDate;
	    }else {
              //如果当前计息天数在指定天数以内
	      tempEDate.setMonth(this.interestStart.getMonth() + tempAddMonth);
	    }
	}
/*
        if(this.interestStart.getMonth() != this.startDate.getMonth()) {
            if(this.method == 2) {
                tempEDate.setMonth(tempEDate.getMonth() + (tempAddMonth - 1));
            }
            tempEDate.setMonth(tempEDate.getMonth());
        }else if(this.interestStart.getDate() <= 5){
            //判断第一期的开始时间是否为６号之前，如果是，则这一期的结束时间为当月的日期
            if(this.method == 2) {
                tempEDate.setMonth(tempEDate.getMonth() + (tempAddMonth - 1));
            }else {
                tempEDate.setMonth(tempEDate.getMonth());
            }
            if(this.endDate.getDate() < this.payDate) {
                this.payNumber += 1;
            }
        }else {
            tempEDate.setMonth(tempEDate.getMonth() + tempAddMonth);
        }

*/

        if (tempEDate > this.endDate) {
            tempEDate = this.endDate;
        }
        tempStagesObj = new Interest();
        tempStagesObj.init(tempSDate, tempEDate, this.unitInterest);
        if(this.payNumber == 1) {
            tempStagesObj.setPayableCapital(this.amount);
        }else {
            tempStagesObj.setPayableCapital(0);
        }
        this.interestArr.push(tempStagesObj);

        //计算第一期后还可以计算
        if (tempEDate < this.endDate) {
            tempDate = this.endDate.getDate();
            //因为第一期的计算和最后一期的计算已经单独拉出来了，所以循环时的计息数要减二
            tempPayNumber = this.payNumber - 2;
            if (tempPayNumber > 0) {
                for (var index = 0; index < tempPayNumber; index++) {
                    //下一期的计息开始时间为上一期的计息结束时间的月份，日为设置的付息日 ＋ 1
                    tempSDate.setDate(1 + parseInt(this.payDate));
                    //考虑到跨年的情况
                    tempSDate.setFullYear(parseInt(tempEDate.getFullYear()));
                    tempSDate.setMonth(tempEDate.getMonth());

                    //下一期的计息结束时间为当前期的结束时间的月份 ＋ 指定的隔月数
                    tempEDate.setMonth(tempEDate.getMonth() + tempAddMonth);

                    tempStagesObj = new Interest();
                    tempStagesObj.init(tempSDate, tempEDate, this.unitInterest);
                    tempStagesObj.setPayableCapital(0);
                    this.interestArr.push(tempStagesObj);

                }
            }
            //最后一期的计息计算方式
            if (tempEDate < this.endDate) {
                //下一期的计息开始时间为上一期的计息开始时间的月份＋ 1，日为设置的付息日 ＋ 1
                tempSDate.setDate(1 + parseInt(this.payDate));
                tempSDate.setMonth(tempEDate.getMonth());
                //考虑到跨年的情况
                tempSDate.setFullYear(parseInt(tempEDate.getFullYear()));

                tempStagesObj = new Interest();
                tempStagesObj.init(tempSDate, this.endDate, this.unitInterest);
                //最后一期的付息纪录中还需要设置他的应付本金
                tempStagesObj.setPayableCapital(this.amount);
                this.interestArr.push(tempStagesObj);
            }
        }

        /*
        //计算第一期，不论计息开始的时间的天数是否大于设置的付息日，第一期的结束时间均为隔月的结束时间
        //需要判断第一期的开始时间是否为下个月的第一天，如果是，则这一期的结束时间应为当月的日期
        tempEDate.setDate(this.payDate);
        if(this.interestStart.getMonth() != this.startDate.getMonth()) {
            if(this.method == 2) {
                tempEDate.setMonth(tempEDate.getMonth() + (tempAddMonth - 1));
            }
            tempEDate.setMonth(tempEDate.getMonth());
        }else if(this.interestStart.getDate() <= 5){
            //判断第一期的开始时间是否为６号之前，如果是，则这一期的结束时间为当月的日期
            if(this.method == 2) {
                tempEDate.setMonth(tempEDate.getMonth() + (tempAddMonth - 1));
            }else {
                tempEDate.setMonth(tempEDate.getMonth());
            }
            if(this.endDate.getDate() < this.payDate) {
                this.payNumber += 1;
            }
        }else {
            tempEDate.setMonth(tempEDate.getMonth() + tempAddMonth);
        }



        if (tempEDate > this.endDate) {
            tempEDate = this.endDate;
        }
        tempStagesObj = new Interest();
        tempStagesObj.init(tempSDate, tempEDate, this.unitInterest);
        if(this.payNumber == 1) {
            tempStagesObj.setPayableCapital(this.amount);
        }else {
            tempStagesObj.setPayableCapital(0);
        }
        this.interestArr.push(tempStagesObj);

        //计算第一期后还可以计算
        if (tempEDate < this.endDate) {
            tempDate = this.endDate.getDate();
            //因为第一期的计算和最后一期的计算已经单独拉出来了，所以循环时的计息数要减二
            tempPayNumber = this.payNumber - 2;
            if (tempPayNumber > 0) {
                for (var index = 0; index < tempPayNumber; index++) {
                    //下一期的计息开始时间为上一期的计息结束时间的月份，日为设置的付息日 ＋ 1
                    tempSDate.setDate(1 + parseInt(this.payDate));
                    //考虑到跨年的情况
                    tempSDate.setFullYear(parseInt(tempEDate.getFullYear()));
                    tempSDate.setMonth(tempEDate.getMonth());

                    //下一期的计息结束时间为当前期的结束时间的月份 ＋ 指定的隔月数
                    tempEDate.setMonth(tempEDate.getMonth() + tempAddMonth);

                    tempStagesObj = new Interest();
                    tempStagesObj.init(tempSDate, tempEDate, this.unitInterest);
                    tempStagesObj.setPayableCapital(0);
                    this.interestArr.push(tempStagesObj);

                }
            }
            //最后一期的计息计算方式
            if (tempEDate < this.endDate) {
                //下一期的计息开始时间为上一期的计息开始时间的月份＋ 1，日为设置的付息日 ＋ 1
                tempSDate.setDate(1 + parseInt(this.payDate));
                tempSDate.setMonth(tempEDate.getMonth());
                //考虑到跨年的情况
                tempSDate.setFullYear(parseInt(tempEDate.getFullYear()));

                tempStagesObj = new Interest();
                tempStagesObj.init(tempSDate, this.endDate, this.unitInterest);
                //最后一期的付息纪录中还需要设置他的应付本金
                tempStagesObj.setPayableCapital(this.amount);
                this.interestArr.push(tempStagesObj);
            }
        }
        */
    } else if (this.method == 3) {
        //如果是一次性还本付息的
        tempStagesObj = new Interest();
        tempStagesObj.init(this.interestStart, this.endDate, this.unitInterest);
        tempStagesObj.setPayableCapital(this.amount);
        tempStagesObj.setPayDate(this.endDate);
        this.interestArr.push(tempStagesObj);

    }
}

//计算两个日期间隔的月份数
CreateInterest.prototype.countMonths = function () {
    var tempSYear = this.interestStart.getFullYear();
    var tempEYear = this.endDate.getFullYear();
    var tempSMonth = this.interestStart.getMonth();
    var tempEMonth = this.endDate.getMonth();
    var tempMonths = (tempEYear - tempSYear) * 12 + tempEMonth - tempSMonth;

    var tempDate = this.endDate.getDate();
    //如果还本日的日值 大于 设置的付息日 计算的计息次数要+1

    if (tempDate > this.payDate) {
        tempMonths++;
    }
    /*
    if($('#Debt_debt_type').val() == 1 && tempDate < this.startDate)
        tempMonths--;
    // console.log(tempMonths);
    */
    return tempMonths;
}

//计算单位天息
CreateInterest.prototype.countUnitInterest = function (createType) {
    //如果有值，表示是创建付费表，否则表示创建付息表
    //计算单位天息 利率 / 365 * 本金
    if(createType) {
        var tempInterest = this.amount * (this.fee / (365 * 100));
    }else {
        var tempInterest = this.amount * (this.rate / (365 * 100));
    }


    //算出来的天息 需要保留六位小数 并四舍五入
    this.unitInterest = tempInterest.toFixed(6);
}

//生成付息纪录表
CreateInterest.prototype.showInterestForm = function (createType) {
    var str = "";
    var $tr = null;
    var tdStr2 = '', tdStr3 = '', tdStr4 = '', tdStr5 = '', tdStr6 = '';
    var tempBody = null;
    if(createType) {
        tempBody = this.$tableBody_fwf;
    }else {
        tempBody = this.$tableBody;
    }
    //根据付息的期数 创建 表格行的次数
    for (var index = 0; index < this.payNumber; index++) {
        trObj = new InterestTr();
        trObj.init();
        trObj.$tr.appendTo(tempBody);
        //填充表格行里的内容
        //第一项填充的期数
        trObj.tdArr[0].html(index + 1);
        str = "<div class='col-sm-5'><div class='input-group date datetime col-md-12 col-xs-7' data-min-view='2' data-date-format='yyyy-mm-dd'><input class='form-control inputStartDate' name='DebtInterest[" + index + "][start_time]' size='16' type='text' value='" + this.interestArr[index].payStartDate + " 'placeholder='开始时间' readonly><span class='input-group-addon btn btn-primary'><span class='glyphicon glyphicon-th'></span></span></div></div>" + "<label class='col-sm-1 control-label'>至</label><div class='col-sm-5'><div class='input-group date datetime col-md-12 col-xs-7' data-min-view='2' data-date-format='yyyy-mm-dd'><input class='form-control inputEndDate' name='DebtInterest[" + index + "][end_time]' size='16' type='text' value='" + this.interestArr[index].payEndDate + "' placeholder='结束时间' readonly><span class='input-group-addon btn btn-primary'><span class='glyphicon glyphicon-th'></span></span></div></div>";
        //第二项填充的是 起息开始 和 起息结束
        trObj.tdArr[1].html(str);
        //第三项填充的是计息天数
        tdStr2 =  this.interestArr[index].payDays + '<input type="hidden" name="DebtInterest[' + index + '][days]" value="' + this.interestArr[index].payDays + '" />';
        trObj.tdArr[2].html(tdStr2);
        //第四项填充的是单位利息
        tdStr3 =  this.interestArr[index].unit + '<input type="hidden" name="DebtInterest[' + index + '][unit_interest]" value="' + this.interestArr[index].unit + '" />';
        trObj.tdArr[3].html(tdStr3);
        //第五线填充的是应付利息
        tdStr4 =  this.interestArr[index].payableInterest + '<input type="hidden" name="DebtInterest[' + index + '][payable_interest]" value="' + this.interestArr[index].payableInterest + '" />';
        trObj.tdArr[4].html(tdStr4);
        //第六项填充的是应付本金
        tdStr5 =  this.interestArr[index].payableCapital + '<input type="hidden" name="DebtInterest[' + index + '][payable_principal]" value="' + this.interestArr[index].payableCapital + '" />';
        trObj.tdArr[5].html(tdStr5);
        //第七项填充的是状态
        tdStr6 = '<input type="hidden" name="DebtInterest[' + index + '][status]" value="' + this.interestArr[index].status + '" />'+
        '<input type="hidden" name="DebtInterest[' + index + '][pay_date]" value="' + this.payDate + '" />';

        if (this.interestArr[index].status == 0) {
            tdStr6 += "<span class='label label-default'>未支付</span>";
            trObj.tdArr[6].html(tdStr6);
        } else {
            tdStr6 += "<span class='label label-success'>已支付</span>";
            trObj.tdArr[6].html(tdStr6);
        }
        this.trArr.push(trObj);


    }
    //加载弹出框中的时间选择的事件
    $("#form-primary .date").datetimepicker({autoclose: true, language: 'zh-CN'});
    //时间文本框中内容有变化时，设置付息表有变更过，但还没有保存
    $("#form-primary .datetime input").bind("change", function() {
        $("#form-primary .saveBtn").addClass("btn-primary");
        tableForm.change("debtInterest", false);
    })

}


//付息弹出框中的新增功能
CreateInterest.prototype.addInterest = function (creatType) {
    var trObj = new InterestTr();
    trObj.init();

    trObj = new InterestTr();
    trObj.init();
    if(creatType) {
        trObj.$tr.appendTo(this.$tableBody_fwf);
    }else {
        trObj.$tr.appendTo(this.$tableBody);
    }

    //填充表格行里的内容
    //第二项填充 时间选择框

    ++this.payNumber;

    str = "<div class='col-sm-5'><div class='input-group date datetime col-md-12 col-xs-7' data-min-view='2' data-date-format='yyyy-mm-dd'><input class='form-control inputStartDate' size='16' name='DebtInterest[" + this.payNumber + "][start_time]' type='text' value='' placeholder='开始时间' readonly><span class='input-group-addon btn btn-primary'><span class='glyphicon glyphicon-th'></span></span></div></div>" + "<label class='col-sm-1 control-label'>至</label><div class='col-sm-5'><div class='input-group date datetime col-md-12 col-xs-7' data-min-view='2' data-date-format='yyyy-mm-dd'><input class='form-control inputEndDate' size='16' type='text' value='' name='DebtInterest[" + this.payNumber + "][end_time]' placeholder='结束时间' readonly><span class='input-group-addon btn btn-primary'><span class='glyphicon glyphicon-th'></span></span></div></div>";
    trObj.tdArr[1].html(str);

    //加载弹出框中的时间选择的事件
    if(creatType) {
        $("#form-primary_fwf .date").datetimepicker({autoclose: true, language: 'zh-CN'});
    }else {
        $("#form-primary .date").datetimepicker({autoclose: true, language: 'zh-CN'});
    }

}


function InterestTr() {
    this.$tr = null;
    this.tdArr = [];
}
//创建复习表里的表格行
InterestTr.prototype.init = function () {
    var $trTemp = $("<tr></tr>");
    this.$tr = $trTemp;
    for (var index = 0; index < 8; index++) {
        $td = $("<td></td>");
        $td.appendTo(this.$tr);
        this.tdArr.push($td);
    }
    var updateFlagTemp = this.updateFlag
    //最后一个td添加删除按钮
    $td.html($("<a href='javascript:;' class='delInterest'>删除</a>"));
    //加载删除按钮的事件
    //点击删除时
    $td.children().bind("click", function () {
        if (confirm("确定删除吗？")) {
            //如果点击确定，则删除所在的表格行
            $(this).parents("tr").remove();
            //删除付息表里的行时，需要设置updateFlagTemp 为 flase，表示付息表有变动 还没有保存
            tableForm.change("debtInterest", false);
        }
    })
}

function Interest() {
    this.payStartDate = null;
    this.payEndDate = null;
    this.payDays = 0;
    this.unit = 0;
    this.payDate=0;
    this.payableInterest = 0;
    this.payableCapital = 0;
    //1表示已支付 0表示未支付
    this.status = 0;
}

Interest.prototype.init = function (sDate, eDate, unit) {
    this.payStartDate = new Date(sDate.getTime());
    this.payEndDate = new Date(eDate.getTime());
    this.unit = unit;
    this.payDate=0;
    this.countPayDays();
    this.countPayableInterest();
    this.setStatus();
    this.payStartDate = this.showDate(this.payStartDate);
    this.payEndDate = this.showDate(this.payEndDate);

}
//计算支付的天数
Interest.prototype.countPayDays = function () {
    //算出来的总天数需要 + 1
    var tempDays = (this.payEndDate.getTime() - this.payStartDate.getTime()) / (24 * 60 * 60 * 1000) + 1;
    this.payDays = tempDays;
}
//计算应付利息
Interest.prototype.countPayableInterest = function () {
    var tempInterest = 0;
    tempInterest = this.unit * this.payDays;
    //应付利息需要保留两位小数
    this.payableInterest = tempInterest.toFixed(2);

}

//设置该条计息的状态
Interest.prototype.setStatus = function () {
    var tempDate = new Date();
    if ((this.payEndDate - tempDate) > 0) {
        this.status = 0;
    } else {
        this.status = 1;
    }
}

//设置应付本金
Interest.prototype.setPayableCapital = function (value) {
    this.payableCapital = value;
}

//设置付息日
Interest.prototype.setPayDate = function (value) {
    this.payDate = new Date(value.getTime()).getDate();
}

//将日期格式化
Interest.prototype.showDate = function (date) {
    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var day = date.getDate();

    return year + "-" + month + "-" + day;
}
