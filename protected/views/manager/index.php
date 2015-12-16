<?php
/**
 * Created by PhpStorm.
 * User: gongxiaohong
 * Date: 15-10-15
 * Time: 上午10:06
 */
?>
<div class="page-head">
    <h2>人员管理</h2>
    <ol class="breadcrumb">
        <li><a href="/">控制面板</a></li>
        <li><a href="/manager/index">人员管理</a></li>
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
            <td style="text-align: right"><label for="User_username">姓名</label></td>
            <td>
                <?php echo $form->dropDownList($model,'id',$names,['class'=>'select2 select-simple','id'=>'User_username','empty'=>'全部']);?>
            </td>

            <td style="text-align: right"><label for="User_type">状态</label></td>
            <td>
                <?php echo $form->dropDownList($model,'is_quit',['0'=>'加入者','1'=>'退出者'],['class'=>'select2 select-simple','empty'=>'全部','id'=>'User_type']);?>
            </td>
            <td><input class="btn btn-primary fa-search" type="submit" name="yt0" value="点击搜索"/></td>
        </tr>
        </tbody>
        <?php $this->endWidget();?>
    </table>

    <div class="content">
        <table class="table table-bordered">
            <div class="form-group">
                <?php if(Yii::app()->user->hasFlash('setStaff')):?>
                    <div class="alert in fade alert-success">
                        <a href="#" class="close" data-dismiss="alert"></a>
                        <strong>Well done!</strong><?php echo Yii::app()->user->getFlash('setStaff');?>
                    </div>
                <?php endif;?>
            </div>
        </table>
    </div>
    <div class="content">
        <h2>人员信息</h2>
        <div class="form-group pull-left">
            <a class="btn btn-info" href="<?=$this->createUrl('manager/create')?>">新增会员</a>
        </div>
        <div class="table-responsive">
            <?php $this->widget('zii.widgets.grid.CGridView',array(
                'id' => 'staff_info',
                'dataProvider' =>$model->search(),
                'htmlOptions'=>array('class'=>'bo-border'),
                'itemsCssClass' =>'bo-border-x',
                'nullDisplay' => '-',
                'template' =>"{items}{summary}{pager}",
                'pager'=>array('class'=>'BusinessPager'),
                'pagerCssClass' =>'Business',
                'summaryText'=>'共<span style="color:red;">{count}</span>条&nbsp;&nbsp;当前:<span style="color:red;">{page}</span>-<span style="color:red;">{end}</span>条',
                'enablePagination'=>true,
                'columns'=>array(
                    array('name'=>'name','header'=>'姓名','value'=>'$data->name'),
                    array('name'=>'mobile','header'=>'手机号','value'=>'$data->mobile'),
                    array('name'=>'email','header'=>'邮箱','value'=>'$data->email'),
                    array('name'=>'is_quit','header'=>'是否退出','value'=>'$data->is_quit?"退出者":"加入者"'),
                    array('name'=>'authority','header'=>'权限','value'=>'$data->getAuthority()'),
                    array('name'=>'gmt_created','header'=>'创建日期','value'=>'date("Y-m-d",strtotime($data->gmt_created))'),
                    array(
                        'class'=>'CButtonColumn',
                        'template'=>'{update}{quit}{delete}',//{delete}
                        'buttons'=>array(
                            'update' => array(
                                'label' =>'修改',
                                'visible'=>'Yii::app()->user->getState("info")->authority >= 1',
                                'url'=>'Yii::app()->createUrl("/manager/update",array("id"=>$data->id))',
                                'imageUrl'=>false,
                                'options' =>array(
                                    'class'=>'btn btn-default btn-xs J_BtnEdit',
                                )
                            ),

                            'quit'=>array(
                                'label'=>'退出',
                                'visible'=>'Yii::app()->user->getState("info")->authority >= 1',
                                'imageUrl'=>false,
                                'url'=>'Yii::app()->createUrl("/manager/quit",array("id" => $data->id))',
                                'options'=>array(
                                    'class'=>'btn btn-default btn-xs J_BtnDelete',
                                )
                            ),
                            'delete'=>array(
                                'label'=>'删除',
                                'visible'=>'Yii::app()->user->getState("info")->authority == 2',
                                'imageUrl'=>false,
                                'url'=>'Yii::app()->createUrl("/manager/delete",array("id" => $data->id))',
                                'options'=>array(
                                    'class'=>'btn btn-default btn-xs J_BtnDelete',
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