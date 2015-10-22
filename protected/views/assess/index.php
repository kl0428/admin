<?php
/**
 * Created by PhpStorm.
 * User: gongxiaohong
 * Date: 15-10-15
 * Time: 上午10:06
 */
?>
<div class="page-head">
    <h2>自评</h2>
    <ol class="breadcrumb">
        <li><a href="/">控制面板</a></li>
        <!-- <li><a href="/table/index">建表</a></li>-->
        <li class="active">详情</li>
    </ol>
</div>
<div class="block-flat">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>编号</th>
                <th>姓名</th>
                <th>部门</th>
                <th>考核期间</th>
                <th>考核状态</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>赵晴</td>
                <td>技术网络部</td>
                <td>2015-09</td>
                <td>建表</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="block-flat">

    <div class="content">
        <table class="table table-bordered">
        </table>
    </div>
    <div class="content">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>编号</th>
                <th>考核项目</th>
                <th>考核要点</th>
                <th>评分标准</th>
                <th>权重</th>
                <th>目标额</th>
                <th>完成额</th>
                <th>完成比例</th>
                <th>自评</th>
                <th>考核</th>
                <th>会签建议</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>忠诚度</td>
                <td>忠诚</td>
                <td></td>
                <td>0.05</td>
                <td>100%</td>
                <td>100%</td>
                <td>1:1</td>
                <td>100</td>
                <td>99</td>
                <td>优秀</td>
                <td class="button-column">
                    <a class="btn  btn-primary btn-xs J_BtnEdit" title="打分" href="javascript:;">打分</a>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>积极性</td>
                <td>积极</td>
                <td></td>
                <td>0.05</td>
                <td>100%</td>
                <td>100%</td>
                <td>1:1</td>
                <td>100</td>
                <td>99</td>
                <td>优秀</td>
                <td class="button-column">
                    <a class="btn  btn-primary btn-xs J_BtnEdit" title="打分" href="javascript:;">打分</a>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>学习与培养</td>
                <td>学习</td>
                <td></td>
                <td>0.05</td>
                <td>100%</td>
                <td>100%</td>
                <td>1:1</td>
                <td>100</td>
                <td>99</td>
                <td>优秀</td>
                <td class="button-column">
                    <a class="btn  btn-primary btn-xs J_BtnEdit" title="打分" href="javascript:;">打分</a>
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td>沟通协作</td>
                <td>沟通</td>
                <td></td>
                <td>0.5</td>
                <td>100%</td>
                <td>100%</td>
                <td>1:1</td>
                <td>100</td>
                <td>99</td>
                <td>优秀</td>
                <td class="button-column">
                    <a class="btn  btn-primary btn-xs J_BtnEdit" title="打分" href="javascript:;">打分</a>
                </td>
            </tr>

            </tbody>
        </table>
        <div style="text-align: center">
            <?php $this->renderPartial('_input_table')?>
        </div>
    </div>
</div>