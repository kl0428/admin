/* 不为空的文本框中 光标离开事件
 $("input").bind("blur", function() {
 if($(this).attr("required") && !notNull) {
 $(this).parent().addClass("has-error");
 }
 })
 */

/*验证字段不能为空*/
function notNull(code) {
    if (code.length == 0) {
        return false;
    } else {
        return true;
    }
}

/*验证字段需为整数数字*/
function checkInteger(code) {
    if (/^\d+$/.test(code)) {
        return true;
    } else {
        return false;
    }
}

/*验证字段需为数值，保留两位小数*/
function checkNum(code) {
    if (isNaN(code)) {
        return false;
    } else {
        return true
    }

}

//四舍五入 保留两位
function toDecimal(x) {
    var f = parseFloat(x);

    f = Math.round(x * 100) / 100;
    f = f.toFixed(2);
    return f;
}

/*验证字段需为大写字母或数字*/
function checkUpper_Num(code) {
    if (/^[0-9A-Za-z-]+$/.test(code)) {
        return true;
    } else {
        return false;
    }
}

/*验证字段需为字母,数字,横杠，下划线*/
function checkChar_Num(code) {
    if (/^[0-9A-Za-z\_-]+$/.test(code)) {
        return true;
    } else {
        return false;
    }
}

/*验证数字在制定区间内*/
function checkSection(code, min, max) {
    if (code * 1 >= min * 1 && code * 1 < max * 1) {
        return true;
    } else {
        return false;
    }
}

/*验证字段的长度必须为指定的长度*/
function checkLen(code, len) {
    if (code.length == len) {
        return true;
    } else {
        return false;
    }
}

/*手机号码验证方法*/
function checkMoblie(code) {
    if (/^(13[0-9]|14[0-9]|15[0-9]|17[0-9]|18[0-9])\d{8}$/i.test(code)) {
        return true;
    } else {
        return false;
    }
}

/*电话号码验证方法*/
function checkPhone(code) {
    if (/^0\d{2,3}-?\d{7,8}$/.test(code)) {
        return true;
    } else {
        return false;
    }
}

/*身份认证方法*/
function IdentityCodeValid(code) {
    var city = {
        11: "北京",
        12: "天津",
        13: "河北",
        14: "山西",
        15: "内蒙古",
        21: "辽宁",
        22: "吉林",
        23: "黑龙江 ",
        31: "上海",
        32: "江苏",
        33: "浙江",
        34: "安徽",
        35: "福建",
        36: "江西",
        37: "山东",
        41: "河南",
        42: "湖北 ",
        43: "湖南",
        44: "广东",
        45: "广西",
        46: "海南",
        50: "重庆",
        51: "四川",
        52: "贵州",
        53: "云南",
        54: "西藏 ",
        61: "陕西",
        62: "甘肃",
        63: "青海",
        64: "宁夏",
        65: "新疆",
        71: "台湾",
        81: "香港",
        82: "澳门",
        91: "国外 "
    };
    var tip = "";
    var pass = true;

    if (!code || !/^\d{6}(18|19|20)?\d{2}(0[1-9]|1[012])(0[1-9]|[12]\d|3[01])\d{3}(\d|X)$/i.test(code)) {
        tip = "身份证号格式错误";
        pass = false;
    } else if (!city[code.substr(0, 2)]) {
        tip = "地址编码错误";
        pass = false;
    } else {
        //18位身份证需要验证最后一位校验位
        if (code.length == 18) {
            code = code.split('');
            //∑(ai×Wi)(mod 11)
            //加权因子
            var factor = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];
            //校验位
            var parity = [1, 0, 'X', 9, 8, 7, 6, 5, 4, 3, 2];
            var sum = 0;
            var ai = 0;
            var wi = 0;
            for (var i = 0; i < 17; i++) {
                ai = code[i];
                wi = factor[i];
                sum += ai * wi;
            }
            var last = parity[sum % 11];
            if (parity[sum % 11] != code[17]) {
                tip = "校验位错误";
                pass = false;
            }
        }
    }
    //if(!pass) alert(tip);
    return pass;
}


function judgeFormInput($input, $parent, judgeNum) {
    var inputText = $input.val();
    var count = 0;

    //如果是select2的下拉菜单，需要通过select2的取值方法
    if ($input.hasClass("select2")) {
        inputText = $input.select2("val");
    }

    /*
     *  文本框字段验证有：
     * 0.非空；1。数值；2.整数；3，手机号；4。电话号码；5.联系方式（电话号码或手机号码）;
     * 6.身份证号；7.数值要在一定区间内；8，指定长度；9.数字或大写字母; 10.字母
     * 采用2的几次方来判断 需要验证哪一项，即：
     * 1=2的0次，2为＝2的1次 ＋ 2的0次
     */
    switch (judgeNum) {
        case 1:
            if (notNull(inputText)) {
                count++;
            } else {
                count--;
            }
            break;
        case 2:
            if (checkInteger(inputText)) {
                count++;
            } else {
                count--;
            }
            break;
        case 3:
            if (notNull(inputText) && checkInteger(inputText)) {
                count++;
            } else {
                count--;
            }
            break;
        case 4:
            if (checkNum(inputText)) {
                count++;
                //保留两位小数，四舍五入
                if(inputText != "") {
                    inputText = toDecimal(inputText);
                    $input.val(inputText);
                }
            } else {
                count--;
            }
            break;
        case 5:
            if (notNull(inputText) && checkNum(inputText)) {
                count++;
                //保留两位小数，四舍五入
                inputText = toDecimal(inputText);
                $input.val(inputText);
            } else {
                count--;
            }
            break;
        case 8:
            if (checkMoblie(inputText)) {
                count++;
            } else {
                count--;
            }
            break;
        case 9:
            if (notNull(inputText) && checkMoblie(inputText)) {
                count++;
            } else {
                count--;
            }
            break;
        case 16:
            if (checkPhone(inputText)) {
                count++;
            } else {
                count--;
            }
            break;
        case 17:
            if (notNull(inputText) && checkPhone(inputText)) {
                count++;
            } else {
                count--;
            }
            break;
        case 32:
            if (checkPhone(inputText) || checkMoblie(inputText)) {
                count++;
            } else {
                count--;
            }
            break;
        case 33:
            if (notNull(inputText) && (checkPhone(inputText) || checkMoblie(inputText))) {
                count++;
            } else {
                count--;
            }
            break;
        case 64:
            if (IdentityCodeValid(inputText)) {
                count++;
            } else {
                count--;
            }
            break;
        case 65:
            if (notNull(inputText) && IdentityCodeValid(inputText)) {
                count++;
            } else {
                count--;
            }
            break;
        case 128:
            var min = $input.attr("data-min");
            var max = $input.attr("data-max");
            if (checkSection(inputText, min, max)) {
                count++;
            } else {
                count--;
            }
            break;
        case 129:
            var min = $input.attr("data-min");
            var max = $input.attr("data-max");
            if (notNull(inputText) && checkSection(inputText, min, max)) {
                count++;
            } else {
                count--;
            }
            break;
        case 133:
            var min = $input.attr("data-min");
            var max = $input.attr("data-max");
            if (notNull(inputText) && checkSection(inputText, min, max) && checkInteger(inputText)) {
                count++;
            } else {
                count--;
            }
            break;
        case 256:
            var len = $input.attr("data-len");
            if (checkLen(inputText, len)) {
                count++;
            } else {
                count--;
            }
            break;
        case 257:
            var len = $input.attr("data-len");
            if (notNull(inputText) && checkLen(inputText, len)) {
                count++;
            } else {
                count--;
            }
            break;
        case 259:
            var len = $input.attr("data-len");
            if (notNull(inputText) && inputText.length >= len && checkInteger(inputText)) {
                count++;
            } else {
                count--;
            }
            break;
        case 512:
            if (checkUpper_Num(inputText)) {
                count++;
            } else {
                count--;
            }
            break;
        case 513:
            if (notNull(inputText) && checkUpper_Num(inputText)) {
                count++;
            } else {
                count--;
            }
            break;
        case 769:
            var len = $input.attr("data-len");
            if (notNull(inputText) && checkLen(inputText, len) && checkUpper_Num(inputText)) {
                count++;
            } else {
                count--;
            }
            break;
        case 1024:
            if (checkChar_Num(inputText)) {
                count++;
            } else {
                count--
            }
        case 1025:
            if (notNull(inputText) && checkChar_Num(inputText)) {
                count++;
            } else {
                count--
            }
    }


    if (count < 0) {
        $parent.addClass("has-error");
    }

    return count;
}



