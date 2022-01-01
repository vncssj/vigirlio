<section class="content">
	<br>
	<div class="col-md-12 box box-default">		
		<div class="box-header">
			<section class="content-header">
			    <center>
			  <h1>
				<i class="fa fa-user"></i>
				<?php echo $title;
				
				?>
			  </h1>
			  </center>
			  <ol class="breadcrumb">
				<a href="<?php echo $this->Gym->createurl("GymMember","memberList");?>" class="btn btn-flat btn-custom"><i class="fa fa-reply"></i> <?php echo __("Voltar");?></a>
			  </ol>
			</section>
		</div>
		<hr>
		<div class="box-body">
		<?php	

			echo $this->Form->create("addgroup",["type"=>"file","class"=>"validateForm form-horizontal","role"=>"form","onsubmit"=>"return validate_multiselect()"]);
			echo "<fieldset><legend>". __('Prencha a ficha abaixo')."</legend>";
						
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="member_id">'. __("ID do Membro").'</label>';
			echo '<div class="col-md-6">';
			echo $this->Form->input("",["label"=>false,"name"=>"member_id","class"=>"form-control","disabled"=>"disabled","value"=>(($edit)?$data['member_id']:$member_id),"id"=>"member_id"]);
			echo "</div>";	
			echo "</div>";
			
			/*
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="middle_name">'. __("Middle Name").'</label>';
			echo '<div class="col-md-6">';
			echo $this->Form->input("",["label"=>false,"name"=>"middle_name","class"=>"form-control validate[custom[onlyLetterSp],maxSize[30]]","value"=>(($edit)?$data['middle_name']:''),"id"=>"middle_name"]);
			echo "</div>";	
			echo "</div>";	
			*/
			
			
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="phone">'. __("Quais as Dificuldades do Treino e Dieta?").'</label>';
			echo '<div class="col-md-6">';
			echo $this->Form->textarea("",["label"=>false,"name"=>"p_m01","class"=>"form-control","value"=>(($edit)?$data['p_m01']:''),"id"=>"phone"]);
			echo "</div>";	
			echo "</div>";
			
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="phone">'. __("Sugestão de Alteração de Refeição e Treino?").'</label>';
			echo '<div class="col-md-6">';
			echo $this->Form->textarea("",["label"=>false,"name"=>"p_m02","class"=>"form-control ","value"=>(($edit)?$data['p_m02']:''),"id"=>"phone"]);
			echo "</div>";	
			echo "</div>";
			
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="phone">'. __("Dúvidas Gerais, Sugestões, Relatos do Protocolo?").'</label>';
			echo '<div class="col-md-6">';
			echo $this->Form->textarea("",["label"=>false,"name"=>"p_m03","class"=>"form-control","value"=>(($edit)?$data['p_m03']:''),"id"=>""]);
			echo "</div>";	
			echo "</div>";
			
			
			
			
			echo "<fieldset><legend>". __('Anotações das Cargas (Não é obrigatório ser preenchido)')."</legend>";
			/*
			echo "<p><strong>MULHER</strong></p>";
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="phone">'. __("Anotações:").'</label>';
			echo '<div class="col-md-6">';
			echo $this->Form->textarea("",["label"=>false,"name"=>"p_m04","class"=>"form-control","placeholder"=>"Ex: Agachamento Hack/Livre: 30Kg","value"=>(($edit)?$data['p_m04']:''),"id"=>"p_m04"]);
			echo "</div>";	
			echo "</div>";
			*/
			echo "<p><strong>Mulheres:</strong></p>";
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="phone">Agachamento Hack/Livre:<br>LegPress:<br>Elevação Pélvica:<br>Remada:<br>Mesa Flexora:</label>';
			echo '<div class="col-md-6">';
			echo $this->Form->textarea("",["label"=>false,"name"=>"p_m05","rows"=>"7","class"=>"form-control","value"=>(($edit)?$data['p_m05']:''),"id"=>"p_m05"]);
			echo "</div>";	
			echo "</div>";
			
			echo "<p><strong>Homens:</strong></p>";
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="phone">Supino:<br>Remada:<br>LegPress:<br>Agachamento Hack/Livre:</label>';
			echo '<div class="col-md-6">';
			echo $this->Form->textarea("",["label"=>false,"name"=>"p_m04","rows"=>"7","class"=>"form-control","value"=>(($edit)?$data['p_m04']:''),"id"=>"p_m04"]);
			echo "</div>";	
			echo "</div>";
			?>
				
			<?php
			
			echo "<br>";
			echo $this->Form->button(__("Salvar"),['class'=>"col-md-offset-2 btn btn-flat btn-success","name"=>"add_member"]);
			echo $this->Form->end();
		?>
		<input type="hidden" value="<?php echo $this->request->base;?>/GymAjax/get_membership_end_date" id="mem_date_check_path">
		<input type="hidden" value="<?php echo $this->request->base;?>/GymAjax/get_membership_classes" id="mem_class_url">
		</div>	
		<div class="overlay gym-overlay">
		  <i class="fa fa-refresh fa-spin"></i>
		</div>
	</div>
</section>
 <script>
$(".membership_status_type").change(function(){
	if($(this).val() == "Prospect" || $(this).val() == "Alumni" )
	{
		$(".class-member").hide("SlideDown");
		$(".class-member input,.class-member select").attr("disabled", "disabled");				
	}else{
		$(".class-member").show("SlideUp");
		$(".class-member input,.class-member select").removeAttr("disabled");	
		$("#available_classes").attr("disabled", "disabled");
	}
});
if($(".membership_status_type:checked").val() == "Prospect" || $(".membership_status_type:checked").val() == "Alumni")
{ 
$(".class-member").hide("SlideDown");
$(".class-member input,.class-member select").attr("disabled", "disabled");		
}

	
</script>