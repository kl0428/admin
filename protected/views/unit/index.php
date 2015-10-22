<?php
/**
 * Created by PhpStorm.
 * User: qing.zhao
 * Date: 15-10-15
 * Time: 下午1:27
 * Desc:人事考核系统--部门管理
 */
?>
<div class="page-head">
    <h2>部门管理</h2>
    <ol class="breadcrumb">
        <li><a href="/">控制面板</a></li>
        <li class="active">部门列表</li>
    </ol>
</div>
<div class="block-flat">
    <div class="table-responsive">
        <table class="well">
            <tbody class="no-border-x no-border-y">
            <tr>
                <td>
                    <?php echo CHtml::link('添加',array("projectCategory/create"),array('class'=>'btn btn-info pull-right'));?>&nbsp;&nbsp;
                </td>
            </tr>
            </tbody>
        </table>

        <table class="table no-border hover">
            <thead class="no-border">
            <tr>
                <th style="width:20%;"><strong>编号</strong></th>
                <th><strong>分类名称</strong></th>
                <th><strong>样式类</strong></th>
                <th><strong>分类代码</strong></th>
                <th style="width:20%;"><strong>操作</strong></th>
            </tr>
            </thead>
            <tbody class="no-border-y">
            <?php /*$projectCategory=ProjectCategory::getData();*/?><!--
            <?php /*if($projectCategory):*/?>
                <?php /*foreach($projectCategory as $v):*/?>
                    <tr>
                        <td><?/*=$v['id']*/?></td>
                        <td><?/*="┠" .$v['name']*/?></td>
                        <td></td>
                        <td></td>
                        <td><a href="<?php /*echo $this->createUrl('projectCategory/update',array('id'=>$v['id']));*/?>">修改</a></td>
                    </tr>

                    <?php /*if(isset($v['items'])):*/?>
                        <?php /*foreach ($v['items'] as $kk => $vv):*/?>
                            <tr>
                                <td><?/*=$vv['id']*/?></td>
                                <td><?/*="　　　　┠" .$vv['name']*/?></td>
                                <td></td>
                                <td></td>
                                <td><a href="<?php /*echo $this->createUrl('projectCategory/update',array('id'=>$vv['id']));*/?>">修改</a></td>
                            </tr>
                            <?php /*if(isset($vv['items'])):*/?>
                                <?php /*foreach ($vv['items'] as $kk1 => $vv1):*/?>
                                    <tr>
                                        <td><?/*=$vv1['id']*/?></td>
                                        <td><?/*="　　　　　　　　┠" .$vv1['name']*/?></td>
                                        <td><?/*=$vv1['list_class']*/?></td>
                                        <td><?/*=$vv1['list_key']*/?></td>
                                        <td><a href="<?php /*echo $this->createUrl('projectCategory/update',array('id'=>$vv1['id']));*/?>">修改</a>/<a href="<?php /*echo $this->createUrl('projectCategory/delete',array('id'=>$vv1['id']));*/?>">删除</a> </td>
                                    </tr>
                                <?php /*endforeach*/?>
                            <?php /*endif;*/?>

                        <?php /*endforeach*/?>

                    <?php /*endif;*/?>

                <?php /*endforeach;*/?>
            <?php /*else:*/?>
                <tr><td colspan="3">empty.</td></tr>
            --><?php /*endif;*/?>
            <tr>
                <td>1</td>
                <td>┠ 总裁办</td>
                <td></td>
                <td></td>
                <td><a href="<?php echo $this->createUrl('projectCategory/update',array('id'=>1));?>">修改</a></td>
            </tr>
            <tr>
                <td>2</td>
                <td>　　　　┠ 技术网路部</td>
                <td></td>
                <td></td>
                <td><a href="<?php echo $this->createUrl('projectCategory/update',array('id'=>2));?>">修改</a></td>
            </tr>
            <tr>
                <td>3</td>
                <td>　　　　　　　　┠php开发组</td>
                <td></td>
                <td></td>
                <td><a href="<?php echo $this->createUrl('projectCategory/update',array('id'=>3));?>">修改</a>/<a href="<?php echo $this->createUrl('projectCategory/delete',array('id'=>3));?>">删除</a> </td>
            </tr>
            <tr>
                <td>4</td>
                <td>　　　　　　　　┠java开发组</td>
                <td></td>
                <td></td>
                <td><a href="<?php echo $this->createUrl('projectCategory/update',array('id'=>3));?>">修改</a>/<a href="<?php echo $this->createUrl('projectCategory/delete',array('id'=>3));?>">删除</a> </td>
            </tr>
            <tr>
                <td>4</td>
                <td>　　　　　　　　┠前段开发组</td>
                <td></td>
                <td></td>
                <td><a href="<?php echo $this->createUrl('projectCategory/update',array('id'=>3));?>">修改</a>/<a href="<?php echo $this->createUrl('projectCategory/delete',array('id'=>3));?>">删除</a> </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>