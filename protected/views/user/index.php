<?php
/**
 * Created by PhpStorm.
 * User: gongxiaohong
 * Date: 15-11-20
 * Time: 上午11:20
 */
?>
<div class="page-head">
    <h2>用户管理</h2>
    <ol class="breadcrumb">
        <li><a href="/">控制面板</a></li>
        <li><a href="/user/index">用户管理</a></li>
        <li class="active">详情</li>
    </ol>
</div>
<div class="block-flat">
    <table class="well">
        <?php $form=$this->beginWidget('CActiveForm',array(
            'action' => Yii::app()->createUrl($this->route),
            'method' => 'get',
            'htmlOptions' => array('class'=>'form-inline','role'=>'form')
        ))?>
        <tbody class="no-border-x no-border-y">
        <tr>
            <td style="text-align:right;"><label for="User_username">登录名</label></td>
            <td>
                <?php echo $form->dropDownList($model,'id',$names,['class'=>'select2 select-simple','id'=>'User_username','empty'=>'全部']);?>
            </td>
            <!--<td style="text-align:right;"><label for="User_department">时间</label></td>
            <td>
                <?php /*echo $form->dropDownList($model,'gmt_created',$times,['class'=>'select2 select-simple','id'=>'User_department','empty'=>'全部']);*/?>
            </td>-->
            <td style="text-align:right;"><label for="User_type">手机号</label></td>
            <td>
                <?php echo $form->dropDownList($model,'mobile',$mobiles,['class'=>'select2 select-simple','empty'=>'全部','id'=>'User_type']);?>
            </td>
            <td><input class="btn btn-primary fa-search" type="submit" name="yt0" value="点击搜索"/></td>
        </tr>
        </tbody>
        <?php $this->endWidget();?>
    </table>

    <div class="content">
        <table class="table table-bordered">
        </table>
    </div>
    <div class="content">
        <h2>用户信息</h2>

        <div class="table table-bordered">
            <?php $this->widget('zii.widgets.grid.CGridView',array(
                'id' => 'staff_info',
                'dataProvider' =>$model->search(),
                'htmlOptions'=>array('class'=>'bo-border'),
                'itemsCssClass' =>'bo-border-x',
                'nullDisplay' => '-',
                'template' =>"{items}{summary}{pager}",
                'pager'  =>array('class'=>'BusinessPager'),
                'pagerCssClass' =>'Business',
                'enablePagination'=>true,
                'columns'=>array(
                    array('name'=>'username','header'=>'姓名','value'=>'$data->username'),
                    array('name'=>'nickname','header'=>'登录名','value'=>'$data->nickname'),
                    array('name'=>'mobile','header'=>'手机号码','value'=>'$data->mobile'),
                    array('name'=>'email','header'=>'邮箱','value'=>'$data->email'),
                    array('name'=>'sex','header'=>'性别','value'=>'$data->sex==1?"男":"女"'),
                    array('name'=>'image','header'=>'图片名称','value'=>'$data->image'),
                    array('name'=>'city','header'=>'城市','value'=>'$data->cityInfo->class_name'),
                    array('name'=>'gmt_created','header'=>'加入时间','value'=>'$data->gmt_created'),
                    array(
                        'class'=>'CButtonColumn',
                        'template'=>'{update}{delete}',//
                        'buttons'=>array(
                            'update' => array(
                                'label' =>'修改',
                                'visible'=>'1',
                                'url'=>'Yii::app()->createUrl("/user/update",array("id"=>$data->id))',
                                'imageUrl'=>false,
                                'options' =>array(
                                    'class'=>'btn btn-default btn-xs J_BtnEdit',
                                )
                            ),

                            'delete'=>array(
                                'label'=>'删除',
                                'visible'=>'1',
                                'imageUrl'=>false,
                                'url'=>'Yii::app()->createUrl("/user/quit",array("id" => $data->id))',
                                'options'=>array(
                                    'class'=>'btn btn-default btn-xs J_BtnDelete',
                                    'onClick'=>'jump(this);return false;',
                                )
                            )
                        ),
                        'header'=>'操作',
                    )
                )

            ))?>
        </div>
    </div>
</div>