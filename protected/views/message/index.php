<?php
/**
 * Created by PhpStorm.
 * User: gongxiaohong
 * Date: 15-10-15
 * Time: 上午10:06
 */
?>
<div class="page-head">
    <h2>消息管理</h2>
    <ol class="breadcrumb">
        <li><a href="/">控制面板</a></li>
        <li><a href="/manager/index">消息管理</a></li>
        <li class="active">详情</li>
    </ol>
</div>
<div class="block-flat">
    <!-- <table class="well">
        <?php /*$form=$this->beginWidget('CActiveForm',array(
            'action' => Yii::app()->createUrl($this->route),
            'method' => 'get',
            'htmlOptions' => array('class'=>'form-inline','role'=>'form')
        ))*/?>
        <tbody class="no-border-x no-border-y">
        <tr>
            <td style="text-align: right"><label for="User_username">店铺</label></td>
            <td>
                <?php /*echo $form->dropDownList($model,'dy_user',$names,['class'=>'select2 select-simple','id'=>'User_username','empty'=>'全部']);*/?>
            </td>
            <td><input class="btn btn-primary fa-search" type="submit" name="yt0" value="点击搜索"/></td>
        </tr>
        </tbody>
        <?php /*$this->endWidget();*/?>
    </table>-->
    <div class="content">
        <table class="table table-bordered">
            <div class="form-group">
                <?php if(Yii::app()->user->hasFlash('Message')):?>
                    <div class="alert in fade alert-success">
                        <a href="#" class="close" data-dismiss="alert"></a>
                        <strong>Well done!</strong><?php echo Yii::app()->user->getFlash('Message');?>
                    </div>
                <?php endif;?>
            </div>
        </table>
    </div>
    <div class="content">
        <h2>信息列表</h2>
        <div class="form-group pull-left">
            <a class="btn btn-info" href="<?=$this->createUrl('Message/Create')?>">新增</a>
        </div>
        <div class="table-responsive">
            <?php $this->widget('zii.widgets.grid.CGridView',array(
                'id' => 'staff_info',
                'dataProvider' =>$model->search(),
                'htmlOptions'=>array('class'=>'bo-border'),
                'itemsCssClass' =>'bo-border-x',
                'nullDisplay' => '-',
                'template' =>"{items}{summary}{pager}",
                // 'pager'=>array('class'=>'BusinessPager'),
                //'pagerCssClass' =>'Business',
                'summaryText'=>'共<span style="color:red;">{count}</span>条&nbsp;&nbsp;当前:<span style="color:red;">{page}</span>-<span style="color:red;">{end}</span>条',
                'enablePagination'=>true,
                'columns'=>array(
                    array('name'=>'id','header'=>'编号','value'=>'$data->id'),
                    array('name'=>'content','header'=>'内容','value'=>'$data->content'),
                    array('name'=>'flag','header'=>'对象类型','value'=>'$data->flag()'),
                    array('name'=>'to_user','header'=>'对象','value'=>'$data->to_user'),
                    array('name'=>'is_read','header'=>'是否停止','value'=>'$data->is_read?"停止":"进行"'),
                    array('name'=>'gmt_created','header'=>'时间','value'=>'date("Y-m-d",strtotime($data->gmt_created))'),
                    array(
                        'class'=>'CButtonColumn',
                        'template'=>'{update}{delete}',
                        'buttons'=>array(
                            'update' => array(
                                'label' =>'停止',
                                'visible'=>'1',
                                'url'=>'Yii::app()->createUrl("/message/update",array("id"=>$data->id))',
                                'imageUrl'=>false,
                                'options' =>array(
                                    'class'=>'btn btn-default btn-xs',
                                )
                            ),

                            'delete'=>array(
                                'label'=>'删除',
                                'visible'=>'Yii::app()->user->getState("info")->authority == 2',
                                'imageUrl'=>false,
                                'url'=>'Yii::app()->createUrl("/message/delete",array("id" => $data->id))',
                                'options'=>array(
                                    'class'=>'btn btn-default btn-xs J_BtnDelete',
                                )
                            )
                        ),
                        'header'=>'操作',
                        'htmlOptions'=>array(
                            'width'=>'9%'
                        ),
                    )
                )

            ))?>
        </div>
    </div>
</div>