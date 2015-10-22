<?php
/**
 * Created by PhpStorm.
 * User: sunnyer
 * Date: 15-4-29
 * Time: 下午3:34
 */

?>
<div id="<?=$data['uploader']?>" class="uploader">
	<div class="queueList <?php if(isset($model[$type])):?>filled<?php endif?>">
		<div class="placeholder <?php if(isset($model[$type])):?>element-invisible<?php endif?>">
			<div id="<?=$data['filePicker']?>"></div>
			<?php if($type!='compressed_file'):?>
				<p>或将照片拖到这里，单次最多可选300张</p>
			<?php else:?>
				<p>或将压缩文件拖到这里，单次最多可选1张</p>
			<?php endif;?>
		</div>


		<?php if(isset($model[$type])):?>
			<ul class="filelist sortable">

				<?php foreach($model[$type] as $k=>$v):?>
					<?php $k+=1000?>

					<li style="height:100%" data-btn="<?=$data['filePicker']?>" data-uploader="<?=$data['uploader']?>" class="update_file ui-state-default" id="my_file_<?=$type?>_<?=$k?>" >
						<p class="title"><?=$v->file_name?></p>
						<p class="imgWrap">
							<?php if($type=='compressed_file'):?>
								<span>压缩文件不能预览</span>
							<?php else:?>
								<img class="rotation_img" src="<?=Yii::app()->params['UpYun']['visitUrl'].$v->file_url?>" onerror="this.onerror='';this.src='<?php echo Yii::app()->params['UpYun']['projectsUrl'] . $v->file_url ?>'" >
							<?php endif?>
						</p>
						<span class="savelist"><?=$v->file_desc?></span>
						<p class="progress">
							<span style="display: none; width: 0px;"></span>
						</p>
						<div class="hiddenAttachment hidden">
							<span class="my_file_<?=$type?>_<?=$k?>">
					            <input type="hidden" name="DebtInterest[<?=$type?>][<?=$k?>][file_url]" value="<?=$v->file_url?>" />
					            <input type="hidden" name="DebtInterest[<?=$type?>][<?=$k?>][file_desc]" value="<?=$v->file_desc?>" />
					            <input type="hidden" name="DebtInterest[<?=$type?>][<?=$k?>][file_name]" value="<?=$v->file_name?>" />
					            <input type="hidden" name="DebtInterest[<?=$type?>][<?=$k?>][file_ext]" value="<?=$v->file_ext?>" />
					            <input type="hidden" name="DebtInterest[<?=$type?>][<?=$k?>][file_size]" value="<?=$v->file_size?>" />
					            <input type="hidden" name="DebtInterest[<?=$type?>][<?=$k?>][file_module]" value="<?=$v->module?>" />
				            </span>
						</div>
						<div class="file-panel2" style="overflow: hidden; height: 0px;">
							<span class="cancel">删除</span>
						</div>
						<span class="success"></span>
					</li>
				<?php endforeach;?>

			</ul>
		<?php endif;?>

	</div>
	<div class="statusBar" style="display:none;">
		<div class="progress">
			<span class="text">0%</span>
			<span class="percentage"></span>
		</div>
<!--		<div class="info"></div>-->
		<div class="btns">
			<div id="<?=$data['filePicker']?>_addbtn"></div><div class="uploadBtn">开始上传</div>
		</div>
	</div>
</div>
