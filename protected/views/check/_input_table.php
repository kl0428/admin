<?php
/**
 * Created by PhpStorm.
 * User: gongxiaohong
 * Date: 15-10-15
 * Time: 下午2:33
 */?>
<!-- 建表基础信息start -->
<div class="block-flat" >
    <div class="content">
        <div id="debt-info" class="form-block">

            <form action=" " method="post" class="form-horizontal group-border-dashed" style="border-radius: 0px;" id="table-info-form">
                <div class="debt-info-form" >

                    <div class="form-group">
                        <label class="col-sm-1 control-label" >被考核人</label >
                        <div class="col-sm-2">
                            <?php echo CHtml::textField('serial_number','',['class'=>'form-control inputSerialNumber','placeholder'=>'请输入原始债权编号'])?>
                        </div>

                        <label class="col-sm-1 control-label" >所属部门</label >

                        <div class="col-sm-2" >
                            <?php echo CHtml::textField('serial_number','',['class'=>'form-control inputSerialNumber','placeholder'=>'请输入原始债权编号'])?>
                        </div >

                        <label class="col-sm-1 control-label" >考核期间</label >

                        <div class="col-sm-2" >
                            <div class="input-group date datetime col-md-12 col-xs-7" id="form_datetime" data-min-view="2" data-date-format="yyyy-mm" >
                                <?php echo CHtml::textField('start_time','',['class'=>'form-control','placeholder'=>'考核期间','readonly'=>'readonly'])?>
                                <span class="input-group-addon btn btn-primary" ><span class="glyphicon glyphicon-th" ></span ></span >
                            </div >
                        </div >

                        <label class="col-sm-1 control-label" >考核方式</label >

                        <div class="col-sm-2" >
                            <?php echo CHtml::dropDownList('serial_number',0,[1=>'月度考核',2=>'季度考核',3=>'年度考核'],['class'=>'form-control inputSerialNumber','placeholder'=>'请输入原始债权编号'])?>
                        </div >


                    </div>
                    <div class="form-group">
                        <label class="col-sm-1 control-label " >自评分数</label >

                        <div class="col-sm-2 control-label"  style="text-align: left; margin-bottom: inherit">89</div >
                        <label class="col-sm-1 control-label " >考核分数</label >

                        <div class="col-sm-2 control-label" style="text-align: left" >--</div >
                        <label class="col-sm-1 control-label" >总分</label >

                        <div class="col-sm-2 control-label" style="text-align: left" >--</div >
                    </div>
                    <div class="form-group">
                        <label class="col-sm-1 control-label debt_amount" >修改建议</label >

                        <div class="col-sm-2" >
                            <?php echo CHtml::textArea('advice','',['data-org'=>123,'class'=>'form-control ','min'=>4,'maxlength'=>200,'placeholder'=>'请输入建议'])?>
                        </div >

                        <label class="col-sm-3 control-label" ></label >

                        <label class="col-sm-1 control-label" >加分</label >

                        <div class="col-sm-2" style="text-align: left">
                            <?php echo CHtml::textField('serial_number','',['class'=>'form-control','placeholder'=>'加分','maxlength'=>4,'style'=>"width:45px;" ])?>
                        </div >
                        <label class="col-sm-1 control-label debt_amount" >加分理由</label >

                        <div class="col-sm-2" >
                            <?php echo CHtml::textArea('advice','',['data-org'=>123,'class'=>'form-control ','min'=>4,'maxlength'=>200,'placeholder'=>'请输入建议'])?>
                        </div >

                    </div>

                    <div class="form-group" >
                        <div class="col-sm-offset-5" >
                            <div class="col-sm-3">

                                <button class="btn btn-primary debts-info-submit submitBtn" type="button" >退回</button >

                                <button class="btn btn-primary debts-info-submit submitBtn pull-right" type="button" >确认打分</button >

                            </div >
                        </div>
                    </div >
                </div >

            </form>
        </div>
    </div>
</div>
<!-- 建表基础信息 end -->