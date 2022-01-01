<?php
echo $this->Html->css('select2.css');
echo $this->Html->script('select2.min');
?>
<script>
$(document).ready(function(){
	
	$("#startDate").datepicker({
		
		dateFormat: '<?php echo $this->Gym->dateformat_PHP_to_jQueryUI($this->Gym->getSettings("date_format")); ?>',
		onSelect: function() {
			
			var date = $('#startDate').datepicker('getDate');  
			date.setDate(date.getDate());
			$("#endDate").datepicker("option","minDate", date);  
		}
	}); 
	$("#endDate").datepicker({
		
		
		dateFormat: '<?php echo $this->Gym->dateformat_PHP_to_jQueryUI($this->Gym->getSettings("date_format")); ?>',
		changeMonth: true,
		changeYear: true,
	}); 
<?php
if($edit)
{?>
$( ".date:first" ).datepicker( "setDate", new Date("<?php echo date($this->Gym->getSettings("date_format"),strtotime($data['start_date'])); ?>" ));
$( ".date:last" ).datepicker( "setDate", new Date("<?php echo date($this->Gym->getSettings("date_format"),strtotime($data['end_date'])); ?>" ));
<?php } ?>	
});  
</script>
<section class="content">
	<br>
	<div class="col-md-12 box box-default">		
		<div class="box-header">
			<section class="content-header">
			  <h1>
				<i class="fa fa-plus"></i>
				<?php if($edit){
					echo __("Editar Aviso");
				}else{
					echo __("Adicionar Aviso");
				}
				?>
				
				<small><?php echo __("Avisos");?></small>
			  </h1>
			  <ol class="breadcrumb">
				<a href="<?php echo $this->Gym->createurl("GymNotice","NoticeList");?>" class="btn btn-flat btn-custom"><i class="fa fa-bars"></i> <?php echo __("Lista de Avisos");?></a>
			 </ol>
			</section>
		</div>
		<hr>
		<div class="box-body">					
		<form class="validateForm form-horizontal" method="post" role="form">		
		<div class='form-group'>	
		<label class="control-label col-md-2" for="email"><?php  echo __("Título do Aviso");?><span class="text-danger"> *</span></label>
		<div class="col-md-6">
			<input type="text" name="notice_title" class="form-control validate[required,maxSize[50]]" value="<?php echo ($edit)?$data["notice_title"] : "";?>">
		</div>	
		</div>
		<div class='form-group'>	
		<label class="control-label col-md-2" for=""><?php  echo __("Aviso para");?></label>
		<div class="col-md-6">
		<?php 
			//$for = ["all"=>__("All"),"member"=>__("Member"),"staff_member"=>__("Staff Member"),"accountant"=>__("Accountant")];
			$for = ["all"=>__("All"),"member"=>__("Member")];
			echo $this->Form->select("notice_for",$for,["default"=>($edit)?array($data['notice_for']):"","class"=>"form-control"]);
		?>
		</div>	
		</div>
		<div class='form-group'>	
		<label class="control-label col-md-2" for="class"><?php  echo __("Classe");?></label>
		<div class="col-md-6">
		<?php 
			echo $this->Form->select("class_id",$classes,["empty"=>__("Selecione a classe"),"default"=>($edit)?array($data['class_id']):"","class"=>"form-control"]);
		?>
		</div>		
		</div>
		
		<div class='form-group'>	
		<label class="control-label col-md-2" for="startDate"><?php  echo __("Data de início");?><span class="text-danger"> *</span></label>
		<div class="col-md-6">
			<input type="text" autocomplete="off" name="start_date" id="startDate" class="form-control validate[required]" value="<?php echo ($edit)?$this->Gym->get_db_format(date($this->Gym->getSettings("date_format"),strtotime($data["start_date"]))): "";?>">
		</div>	
		</div>
		
		<div class='form-group'>	
		<label class="control-label col-md-2" for="endDate"><?php  echo __("Data final");?><span class="text-danger"> *</span></label>
		<div class="col-md-6">
			<input type="text" name="end_date" id="endDate" class="form-control validate[required]" value="<?php echo ($edit)?$this->Gym->get_db_format(date($this->Gym->getSettings("date_format"),strtotime($data["end_date"]))) : "";?>">
		</div>	
		</div>
		
		<div class='form-group'>	
		<label class="control-label col-md-2" for="comment"><?php  echo __("Comente");?></label>
		<div class="col-md-6">
			<textarea type="text" name="comment" class="form-control"><?php echo ($edit)?$data["comment"] : " ";?></textarea>
		</div>	
		</div>
		<div class="col-md-offset-2 col-md-6">
			<input type="submit" value="<?php echo __("Salvar");?>" name="save_notice" class="btn btn-flat btn-success">
		</div>
		
		<!-- END -->
		</div>
		<div class='overlay gym-overlay'>
			<i class='fa fa-refresh fa-spin'></i>
		</div>
	</div>
</section>
