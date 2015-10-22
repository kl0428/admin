<?php
/**
 * Created by PhpStorm.
 * User: gongxiaohong
 * Date: 15-10-15
 * Time: 上午10:06
 */
?>
<div class="page-head">
    <h2>员工管理</h2>
    <ol class="breadcrumb">
        <li><a href="/">控制面板</a></li>
        <li><a href="/staff/index">员工管理</a></li>
        <li class="active">详情</li>
    </ol>
</div>
<div class="block-flat">
    <table class="well">
        <form class="form-inline" role="form" id="yw0" action="/staff/index" method="post">
            <tbody class="no-border-x no-border-y">
                <tr>
                    <td><label for="User_username">姓名</label></td>
                    <td><input class="form-control input-large" placeholder="输入用户名" type="tel" name="User[username]" id="User_username"/></td>
                    <td><label for="User_name">部门</label></td>
                    <td><input class="form-control input-large" placeholder="输入部门名称" type="tel" name="User[name]" id="User_name"/></td>
                    <td><label for="User_mobile_number">考核方式</label></td>
                    <td>
                        <?php echo CHtml::dropDownList('User[check_type]','0', [0=>'月度',1=>'季度',3=>'年度'], ['class' => "form-control input-large", 'data-placeholder' => "请选择考核状态", 'empty' => '所有']);?>
                    </td>
                    <td><label for="User_identity_number">状态</label></td>
                    <td>
                        <?php echo CHtml::dropDownList('User[status]','1',[0=>'离职',1=>'在职'],['class'=>'form-control input-large','empty'=>'所有']);?>
                    </td>
                    <td><input class="btn btn-primary fa-search" type="submit" name="yt0" value="点击搜索"/></td>
                        <!--<input type="hidden" value="1" name="id" id="id"/>
                        <input type="hidden" value="1" name="type" id="type"/></td>-->
                </tr>
            </tbody>
        </form>
    </table>

    <div class="content">
        <table class="table table-bordered">
        </table>
    </div>
    <div class="content">
        <h2>人员信息</h2>
        <div class="form-group pull-left">
            <a class="btn btn-info" href="<?=$this->createUrl('staff/create')?>">新增员工</a>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>姓名</th>
                <th>登录名</th>
                <th>员工编号</th>
                <th>所属部门</th>
                <th>部门编号</th>
                <th>上级领导</th>
                <th>考核方式</th>
                <th>自评权重</th>
                <th>考核权重</th>
                <th>等级</th>
                <th>入职时间</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>张柏芝</td>
                <td>0001zbz</td>
                <td>0001</td>
                <td>总裁办</td>
                <td>1</td>
                <td>黄渤</td>
                <td>月度</td>
                <td>0.4</td>
                <td>0.6</td>
                <td>P3</td>
                <td>2015.09.12</td>
                <td>在职</td>
                <td class="button-column">
                    <a class="btn  btn-primary btn-xs J_BtnEdit" title="修改" href="javascript:;">修改</a>
                    <a class="btn  btn-primary btn-xs J_BtnDelete" title="删除" href="javascript:;">删除</a>
                </td>
            </tr>
            <tr>
                <td>何炅</td>
                <td>0002zbz</td>
                <td>0002</td>
                <td>网络技术部</td>
                <td>2</td>
                <td>徐峥黄渤</td>
                <td>季度</td>
                <td>0.4</td>
                <td>0.6</td>
                <td>P5</td>
                <td>2013.09.12</td>
                <td>在职</td>
                <td class="button-column">
                    <a class="btn  btn-primary btn-xs J_BtnEdit" title="修改" href="javascript:;">修改</a>
                    <a class="btn  btn-primary btn-xs J_BtnDelete" title="删除" href="javascript:;">删除</a>
                </td>
            </tr>

            </tbody>
        </table>
        <div id="pager" style="text-align: center">
            <?php
            $this->widget('CLinkPager',array(
                'header'         =>'',
                'firstPageLabel' => '首页',
                'lastPageLabel'  => '末页',
                'prevPageLabel'  => '上一页',
                'nextPageLabel'  => '下一页',
                'pages'          => $pager,
                'maxButtonCount' =>10
            ));
            ?></div>
    </div>
</div>