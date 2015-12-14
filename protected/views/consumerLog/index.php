<?php
/**
 * Created by PhpStorm.
 * User: gongxiaohong
 * Date: 15-11-20
 * Time: 上午11:20
 */
?>
<div class="page-head">
    <h2>订单管理</h2>
    <ol class="breadcrumb">
        <li><a href="/">控制面板</a></li>
        <li><a href="/report/index">订单管理</a></li>
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
            <td style="text-align:right;"><label for="User_username">店铺</label></td>
            <td>
                <?php echo $form->dropDownList($model,'store_id',$names,['class'=>'select2 select-simple','id'=>'User_username','empty'=>'全部']);?>
            </td>
            <td style="text-align:right;"><label for="User_type">类型</label></td>
            <td>
                <?php echo $form->dropDownList($model,'flag',['0'=>'体验卡','1'=>'通卡','2'=>'课程'],['class'=>'select2 select-simple','empty'=>'全部','id'=>'User_type']);?>
            </td>
            <td>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$model,
                    'attribute'=>'time_start',
                    'language'=>'zh_cn',
                    // additional javascript options for the date picker plugin
                    'options'=>array(
                        'showAnim'=>'fold',
                    ),
                    'htmlOptions'=>array(
                        'style'=>'width:120px;',
                        'class'=>'form-control',
                        'placeholder'=>'开始时间'
                    ),
                ));
                ?>
            </td>
            <td>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$model,
                    'attribute'=>'time_end',
                    'language'=>'zh_cn',
                    // additional javascript options for the date picker plugin
                    'options'=>array(
                        'showAnim'=>'fold',
                    ),
                    'htmlOptions'=>array(
                            'style'=>'width:120px;',
                        'class'=>'form-control',
                        'placeholder'=>'结束时间'
                    ),
                ));
                ?>
            </td>

           <!-- <td style="text-align:right;"><label for="User_type">确认</label></td>
            <td>
                <?php /*echo $form->dropDownList($model,'is_used',['0'=>'未确认','1'=>'已确认'],['class'=>'select2 select-simple','empty'=>'全部','id'=>'User_type']);*/?>
            </td>-->
            <td><input class="btn btn-primary fa-search" type="submit" name="yt0" value="点击搜索"/></td>
        </tr>
        </tbody>
        <?php $this->endWidget();?>
    </table>

    <div class="content">
       <a href="<?php echo Yii::app()->createUrl('/consumerLog/create')?>"><input  type="button" class="btn btn-primary" value="验证"></a>
    </div>
    <div class="content">
        <h2>订单信息</h2>

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
                    array('name'=>'log_id','header'=>'消费号','value'=>'$data->log_id'),
                    array('name'=>'flag','header'=>'类型','value'=>'$data->getFlag()'),
                    array('name'=>'flag_content','header'=>'号码','value'=>'$data->flag_content'),
                    array('name'=>'store_id','header'=>'店铺','value'=>'$data->store->name'),
                   // array('name'=>'is_used','header'=>'确认','value'=>'$data->is_used?"已确认":"待确认"'),
                    array('name'=>'fee','header'=>'金额','value'=>'$data->fee'),
                    array('name'=>'gmt_created','header'=>'时间','value'=>'$data->gmt_created'),
                    /*array(
                        'class'=>'CButtonColumn',
                        'template'=>'{delete}',//
                        'buttons'=>array(
                            'delete'=>array(
                                'label'=>'删除',
                                'visible'=>'1',
                                'imageUrl'=>false,
                                'url'=>'Yii::app()->createUrl("/report/delete",array("id" => $data->id))',
                                'options'=>array(
                                    'class'=>'btn btn-default btn-xs J_BtnDelete',
                                    'onClick'=>'jump(this);return false;',
                                )
                            )
                        ),
                        'header'=>'操作',
                    )*/
                )

            ))?>
        </div>
    </div>
    <?php if($amount):?>
        <div class="content">
            <table class="table table-bordered">
                <span>统计金额:</span><span style="color: #408140"><?php echo $amount['total'];?></span>
            </table>
        </div>
    <?php endif;?>
</div>

<script>
    $(function(){
        $("#gotoBtn").bind('click',function(e){
            var goto_page = $(":input[name=pageNumber]").val();
            window.location.href=$(this).attr('now_url')+'ExaminationInfo_page='+goto_page+'&ExaminationUserInfo_page='+goto_page;
        })

    })

    /*$(".J_BtnDelete").bind('click',function(){
     if(confirm('你确定要进行此操作吗?')){
     return true;
     }else{
     return false;
     }
     });*/

    function jump(th){
        if(confirm('你确定要进行此操作吗?')){
            window.location.href=th;
        }else{
            return false;
        }
    }

</script>