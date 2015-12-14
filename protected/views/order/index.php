<?php
/**
 * Created by PhpStorm.
 * User: gongxiaohong
 * Date: 15-11-20
 * Time: 上午11:20
 */
?>
<div class="page-head">
    <h2>管理</h2>
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
            <td style="text-align:right;"><label for="User_username">举报人</label></td>
            <td>
                <?php echo $form->dropDownList($model,'user_id',$users,['class'=>'select2 select-simple','id'=>'User_username','empty'=>'全部']);?>
            </td>
            <td style="text-align:right;"><label for="User_type">付款类型</label></td>
            <td>
                <?php echo $form->dropDownList($model,'channel',
                    ['alipay_wap'=>'alipay_wap','upmp_wap'=>'upmp_wap','bfb_wap'=>'bfb_wap','upacp_wap'=>'upacp_wap','wx_pub'=>'wx_pub','wx_pub_qr'=>'wx_pub_qr','yeepay_wap'=>'yeepay_wap','jdpay_wap'=>'jdpay_wap'],
                    ['class'=>'select2 select-simple','empty'=>'全部','id'=>'User_type']);?>
            </td>

            <td style="text-align:right;"><label for="User_type">是否付款</label></td>
            <td>
                <?php echo $form->dropDownList($model,'paid',['0'=>'未付','1'=>'已付'],['class'=>'select2 select-simple','empty'=>'全部','id'=>'User_type']);?>
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
                    array('name'=>'order_no','header'=>'订单号','value'=>'$data->order_no'),
                    array('name'=>'user_id','header'=>'用户','value'=>'$data->user->nickname'),
                    array('name'=>'ping_id','header'=>'ping编号','value'=>'$data->ping_id'),
                    array('name'=>'channel','header'=>'付款方式','value'=>'$data->channel'),
                    array('name'=>'subject','header'=>'标题','value'=>'$data->subject'),
                    array('name'=>'amount','header'=>'金额','value'=>'$data->amount'),
                    array('name'=>'paid','header'=>'是否付款','value'=>'$data->paid?"已付":"未付"'),
                    array('name'=>'time_paid','header'=>'付款时间','value'=>'$data->time_paid'),
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