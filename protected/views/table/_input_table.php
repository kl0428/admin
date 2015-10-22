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
                        <div class="input-group date datetime col-md-12 col-xs-7" id="form_datetime" data-min-view="2"  data-date-format="yyyy-mm" >
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
                    <label class="col-sm-1 control-label debt_amount" >修改建议</label >

                    <div class="col-sm-2" >
                        <?php echo CHtml::textArea('advice','',['data-org'=>123,'class'=>'form-control inputAmount','min'=>4,'maxlength'=>200,'placeholder'=>'请输入建议'])?>
                    </div >
                </div>

                <div class="form-group" >
                    <div class="col-sm-offset-5" >
                        <div class="col-sm-1">
                                <button class="btn btn-primary debts-info-submit submitBtn" type="button" >&nbsp;提&nbsp;&nbsp;交&nbsp;</button >
                        </div >
                        <div class="col-sm-3">
                            <button class="btn btn-primary debts-info-submit submitBtn" type="button" >&nbsp;保&nbsp;&nbsp;存&nbsp;</button >
                        </div >
                    </div>
                </div >
            </div >

            </form>
        </div>
    </div>
</div>
<!-- 建表基础信息 end -->