<?php
/**
 * Created by PhpStorm.
 * User: gongxiaohong
 * Date: 15-10-15
 * Time: 上午10:06
 */
?>
<div class="page-head">
    <h2>课程管理</h2>
    <ol class="breadcrumb">
        <li><a href="/">控制面板</a></li>
        <li><a href="/manager/index">课程管理</a></li>
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
            <td style="text-align: right"><label for="User_username">课程</label></td>
            <td>
                <?php echo $form->dropDownList($model,'id',$lessons,['class'=>'select2 select-simple','id'=>'User_username','empty'=>'全部']);?>
            </td>

            <td style="text-align: right"><label for="User_type">状态</label></td>
            <td>
                <?php echo $form->dropDownList($model,'is_check',['0'=>'未审核','1'=>'通过','2'=>'失败','3'=>'删除'],['class'=>'select2 select-simple','empty'=>'全部','id'=>'User_type']);?>
            </td>
            <td><input class="btn btn-primary fa-search" type="submit" name="yt0" value="点击搜索"/></td>
        </tr>
        </tbody>
        <?php $this->endWidget();?>
    </table>
    <div class="content">
        <table class="table table-bordered">
            <div class="form-group">
                <?php if(Yii::app()->user->hasFlash('course')):?>
                    <div class="alert in fade alert-success">
                        <a href="#" class="close" data-dismiss="alert"></a>
                        <strong>Well done!</strong><?php echo Yii::app()->user->getFlash('course');?>
                    </div>
                <?php endif;?>
            </div>
        </table>
    </div>

    <div class="content">
        <table class="table table-bordered">
            <div class="form-group">
                <?php if(Yii::app()->user->hasFlash('delete')):?>
                    <div class="alert in fade alert-success">
                        <a href="#" class="close" data-dismiss="alert"></a>
                        <strong>Well done!</strong><?php echo Yii::app()->user->getFlash('delete');?>
                    </div>
                <?php endif;?>
            </div>
        </table>
    </div>
    <div class="content">
        <h2>店铺信息</h2>
        <div class="form-group pull-left">
            <a class="btn btn-info" href="<?=$this->createUrl('course/create')?>">新增课程</a>
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
                    array('name'=>'name','header'=>'课程','value'=>'$data->name'),
                    array('name'=>'store_id','header'=>'店铺','value'=>'$data->store->name'),
                    array('name'=>'start_time','header'=>'开始结束时间','value'=>'date("Y/m/d",strtotime($data->start_time))."--".date("Y/m/d",strtotime($data->end_time))',
                         'htmlOptions'=>array(
                                'width'=>'15%',
                        )
                    ),
                    array('name'=>'sale_time','header'=>'开售时间','value'=>'date("Y/m/d",strtotime($data->sale_time))."--".date("Y/m/d",strtotime($data->esale_time))',
                        'htmlOptions'=>array(
                                'width'=>'15%',
                        )
                    ),
                    array('name'=>'sale_price','header'=>'价格','value'=>'$data->sale_price',
                        'htmlOptions'=>array(
                            'width'=>'8%',
                        )
                    ),
                    array('name'=>'is_check','header'=>'状态','value'=>'$data->getCheck()',
                        'htmlOptions'=>array(
                            'width'=>'5%',
                        )
                    ),
                    array('name'=>'gmt_created','header'=>'创建日期','value'=>'date("Y-m-d",strtotime($data->gmt_created))',
                        'htmlOptions'=>array(
                            'width'=>'10%',
                        )
                    ),
                    array(
                        'class'=>'CButtonColumn',
                        'template'=>'{see}{update}{pass}{delete}',//{delete}
                        'buttons'=>array(
                            'see' => array(
                                'label' =>'查看',
                                'visible'=>'1',
                                'url'=>'Yii::app()->createUrl("/course/view",array("id"=>$data->id))',
                                'imageUrl'=>false,
                                'options' =>array(
                                    'class'=>'btn btn-default btn-xs',
                                )
                            ),
                            'update' => array(
                                'label' =>'编辑',
                                'visible'=>'1',
                                'url'=>'Yii::app()->createUrl("/course/change",array("id"=>$data->id))',
                                'imageUrl'=>false,
                                'options' =>array(
                                    'class'=>'btn btn-default btn-xs',
                                )
                            ),

                            'pass'=>array(
                                'label'=>'通过',
                                'visible'=>'Yii::app()->user->getState("info")->authority >= 1',
                                'imageUrl'=>false,
                                'url'=>'Yii::app()->createUrl("/course/pass",array("id" => $data->id))',
                                'options'=>array(
                                    'class'=>'btn btn-default btn-xs',
                                )
                            ),
                            'delete'=>array(
                                'label'=>'删除',
                                'visible'=>'Yii::app()->user->getState("info")->authority == 2',
                                'imageUrl'=>false,
                                'url'=>'Yii::app()->createUrl("/course/delete",array("id" => $data->id))',
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