<?php
/**
 * Created by PhpStorm.
 * User: gongxiaohong
 * Date: 15-11-23
 * Time: 下午2:38
 */
?>
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
        <li><a href="/report/index">用户管理</a></li>
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
            <td style="text-align:right;"><label for="User_type">类型</label></td>
            <td>
                <?php echo $form->dropDownList($model,'type',['0'=>'用户','1'=>'联盟'],['class'=>'select2 select-simple','empty'=>'全部','id'=>'User_type']);?>
            </td>
            <td style="text-align:right;"><label for="User_type">被举报人</label></td>
            <td>
                <?php echo $form->dropDownList($model,'to_report',$report,['class'=>'select2 select-simple','empty'=>'全部','id'=>'User_type']);?>
            </td>

            <td style="text-align:right;"><label for="User_type">方式</label></td>
            <td>
                <?php echo $form->dropDownList($model,'style',['0'=>'举报','1'=>'反馈'],['class'=>'select2 select-simple','empty'=>'全部','id'=>'User_type']);?>
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
        <h2>举报反馈信息</h2>

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
                    array('name'=>'user_id','header'=>'举报人','value'=>'$data->user->nickname'),
                    array('name'=>'to_report','header'=>'被举报人','value'=>'$data->type == 1?$data->alliance->name:$data->report->nickname'),
                    array('name'=>'content','header'=>'举报内容','value'=>'$data->content'),
                    array('name'=>'type','header'=>'类型','value'=>'$data->type == 1?"联盟":"用户"'),
                    array('name'=>'style','header'=>'方式','value'=>'$data->style==1?"反馈":"举报"'),
                    array('name'=>'gmt_created','header'=>'时间','value'=>'$data->gmt_created'),
                    array(
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
                    )
                )

            ))?>
        </div>
    </div>
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