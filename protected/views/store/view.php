<?php
/**
 * Created by PhpStorm.
 * User: gongxiaohong
 * Date: 15-10-15
 * Time: 上午10:06
 */
?>
<div class="page-head">
    <h2>店铺管理</h2>
    <ol class="breadcrumb">
        <li><a href="/">控制面板</a></li>
        <li><a href="/manager/index">店铺管理</a></li>
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
            <td style="text-align: right"><label for="User_username">店铺名称</label></td>
            <td>
                <?php echo $form->dropDownList($model,'id',$names,['class'=>'select2 select-simple','id'=>'User_username','empty'=>'全部']);?>
            </td>

            <td style="text-align: right"><label for="User_type">状态</label></td>
            <td>
                <?php echo $form->dropDownList($model,'is_open',['0'=>'未审核','1'=>'审核通过'],['class'=>'select2 select-simple','empty'=>'全部','id'=>'User_type']);?>
            </td>
            <td><input class="btn btn-primary fa-search" type="submit" name="yt0" value="点击搜索"/></td>
        </tr>
        </tbody>
        <?php $this->endWidget();?>
    </table>

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
            <a class="btn btn-info" href="<?=$this->createUrl('store/create')?>">新增店铺</a>
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
                    array('name'=>'name','header'=>'店铺','value'=>'$data->name'),
                    array('name'=>'image',
                        'header'=>'logo',
                        'value'=>'CHtml::image(Yii::app()->params["qiniu"]["host"].$data->image,"logo",array("width"=>"50","height"=>"50"))',
                        'type'=>'raw',   //这里是原型输出
                        'htmlOptions'=>array(
                            'width'=>'50',
                            'style'=>'text-align:center',
                        ),
                    ),
                    array('name'=>'mobile','header'=>'手机号','value'=>'$data->mobile'),
                    array('name'=>'realname','header'=>'法人','value'=>'$data->realname'),
                    array('name'=>'tel','header'=>'固话','value'=>'$data->tel'),
                    array('name'=>'address','header'=>'地址','value'=>'$data->address'),
                    array('name'=>'is_open','header'=>'状态','value'=>'$data->getOpen()',
                        'htmlOptions'=>array(
                            'width'=>'5%',
                        )
                    ),
                    array('name'=>'gmt_created','header'=>'创建日期','value'=>'date("Y-m-d",strtotime($data->gmt_created))',
                        'htmlOptions'=>array(
                        'width'=>'5%',
                        )
                    ),
                    array(
                        'class'=>'CButtonColumn',
                        'template'=>'{see}{update}{pass}{delete}',//{delete}
                        'buttons'=>array(
                            'see' => array(
                                'label' =>'查看',
                                'visible'=>'1',
                                'url'=>'Yii::app()->createUrl("/store/see",array("id"=>$data->id))',
                                'imageUrl'=>false,
                                'options' =>array(
                                    'class'=>'btn btn-default btn-xs',
                                )
                            ),
                            'update' => array(
                                'label' =>'编辑',
                                'visible'=>'Yii::app()->user->getState("info")->authority >= 1',
                                'url'=>'Yii::app()->createUrl("/store/change",array("id"=>$data->id))',
                                'imageUrl'=>false,
                                'options' =>array(
                                    'class'=>'btn btn-default btn-xs',
                                )
                            ),

                            'pass'=>array(
                                'label'=>'通过',
                                'visible'=>'Yii::app()->user->getState("info")->authority >= 1',
                                'imageUrl'=>false,
                                'url'=>'Yii::app()->createUrl("/store/pass",array("id" => $data->id))',
                                'options'=>array(
                                    'class'=>'btn btn-default btn-xs',
                                )
                            ),
                            'delete'=>array(
                                'label'=>'删除',
                                'visible'=>'Yii::app()->user->getState("info")->authority == 2',
                                'imageUrl'=>false,
                                'url'=>'Yii::app()->createUrl("/store/delete",array("id" => $data->id))',
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