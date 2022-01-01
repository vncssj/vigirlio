<?php
echo $this->Html->css('bootstrap-multiselect');
echo $this->Html->script('bootstrap-multiselect');
?>
<script type="text/javascript">
$(document).ready(function() {	
$('.class_list').multiselect({
		includeSelectAllOption: true			
	});
});
function validate_multiselect()
	{		
			var classes = $(".class_list").val();
			var msg = "<?php echo __('Selecione a turma ou adicione a turma primeiro.') ?>";
			if(classes == null)
			{
				alert(msg);
				return false;
			}else{
				return true;
			}		
	}
	

</script>
<section class="content">
	<br>
	<div class="col-md-12 box box-default">		
		<div class="box-header">
			<section class="content-header">
			  <h1>
				<i class="fa fa-users"></i>
				<?php echo $title == 'Add Membership'? "Adicionar Plano" : "Editar Plano" ;?>
				<small><?php echo __("Filiação");?></small>
			  </h1>
			  <ol class="breadcrumb">
				<a href="<?php echo $this->Gym->createurl("Membership","membershipList");?>" class="btn btn-flat btn-custom"><i class="fa fa-bars"></i> <?php echo __("Lista de Planos");?></a>
			  </ol>
			</section>
		</div>
		<hr>
		<div class="box-body">
		<?php
			
			echo $this->Form->create($membership,["type"=>"file","class"=>"validateForm form-horizontal","onsubmit"=>"return validate_multiselect()"]);
			echo "<div class='form-group'>";
			echo "<label class='control-label col-md-3'>".__("Nome de membro")."<span class='text-danger'> *</span></label>";
			echo "<div class='col-md-8'>";
			echo $this->Form->input("",["label"=>false,"name"=>"membership_label","class"=>"form-control validate[required,custom[onlyLetterSp],maxSize[50]]","value"=>($edit)?$membership_data['membership_label']:""]);
			echo "</div>";
			echo "</div>";
			
			echo "<div class='form-group'>";
			echo "<label class='control-label col-md-3'>".__("Categoria de Sócios")."<span class='text-danger'> *</span></label>";
			echo "<div class='col-md-5 module_padding'>";
			echo $this->Form->select("membership_cat_id",$categories,["default"=>($edit)?$membership_data["membership_cat_id"]:"","empty"=>__("Selecione a Categoria"),"class"=>"form-control validate[required] cat_list"]);
			echo "</div>";			
			echo "<div class='col-md-2'>";			
			echo $this->Form->button(__("Adicionar Categoria"),["class"=>"form-control add_category btn btn-success btn-flat","type"=>"button","data-url"=>$this->Gym->createurl("GymAjax","addCategory")]);
			echo "</div>";	
			echo "</div>";
			
			echo "<div class='form-group'>";
			echo "<label class='control-label col-md-3'>".__("Período de adesão")."<span class='text-danger'> *</span></label>";
			echo "<div class='col-md-8'>";
			echo "<div class='input-group'>";	
			echo "<span class='input-group-addon'>".__('Nr. de Dias')."</span>";
			echo $this->Form->input("",["label"=>false,"name"=>"membership_length","class"=>"form-control validate[required,custom[onlyNumberSp],maxSize[4]]","value"=>($edit)?$membership_data['membership_length']:""]);
			echo "</div>";
			echo "</div>";
			echo "</div>";
				
			echo "<div class='form-group'>";
			echo "<label class='control-label col-md-3'>".__("Limite de Sócios")."<span class='text-danger'> *</span></label>";
			echo "<div class='col-md-3 module_padding'>";
			echo '<label class="radio-inline"><input type="radio" class="check_limit" name="membership_class_limit" value="Limited" '.(($edit && $membership_data['membership_class_limit'] == "Limited") ? "checked" : "") .' '.((!$edit)?"checked":"").'>'. __('Limitado') .'</label>
				  <label class="radio-inline"><input type="radio" class="check_limit" name="membership_class_limit" value="Unlimited" '.(($edit && $membership_data['membership_class_limit'] == "Unlimited") ? "checked" : "") .'>'. __("Ilimitado") .'</label>';
			echo "</div>";
			echo "<div class='col-md-2 div_limit module_padding'>";
				echo $this->Form->input("",["label"=>false,"name"=>"limit_days","placeholder"=>__('nr. de aulas'),"class"=>"form-control validate[required,custom[onlyNumberSp],maxSize[2]]","value"=>($edit)?$membership_data["limit_days"]:""]);
			echo "</div>";
			echo "<div class='col-md-3 div_limit'>";
				$limitation = ["per_week"=>__("Aula toda semana"),"per_month"=>__("Class every month")];
				echo $this->Form->select("limitation",$limitation,["default"=>($edit)?$membership_data["limitation"]:"","class"=>"form-control"]);
			echo "</div>";
			echo "</div>";
			?>
			<script>
			if($(".check_limit:checked").val() == "Unlimited")
			{ 
				$(".div_limit").hide("fast");
				
				$(".div_limit input,.div_limit select").attr("disabled", "disabled");		
			}
			</script>
			<?php
			echo "<div class='form-group'>";
			echo "<label class='control-label col-md-3'>".__("Quantidade de sócios")."<span class='text-danger'> *</span></label>";
			echo "<div class='col-md-8'>";	
			echo "<div class='input-group'>";	
			echo "<span class='input-group-addon'>".$this->Gym->get_currency_symbol()."</span>";	
			echo $this->Form->input("",["label"=>false,"name"=>"membership_amount","class"=>"form-control validate[required,custom[onlyNumberSp],maxSize[8]]","value"=>($edit)?$membership_data['membership_amount']:""]);
			echo "</div>";	
			echo "</div>";	
			echo "</div>";	
			
			echo "<div class='form-group'>";
			echo "<label class='control-label col-md-3'>".__("Selecione a classe")."<span class='text-danger'> *</span></label>";
			echo "<div class='col-md-5'>";
			echo $this->Form->select("membership_class",$classes,["default"=>($edit)?$membership_class:"","class"=>"form-control class_list","multiple"=>"multiple"]);
			echo "</div>";			
			echo "</div>";
			
			
			echo "<div class='form-group'>";
			echo "<label class='control-label col-md-3'>".__("Plano de Parcelamento")."<span class='text-danger'> *</span></label>";
			echo "<div class='col-md-2 module_padding'>";
			echo $this->Form->input("",["label"=>false,"name"=>"installment_amount","class"=>"form-control validate[required,custom[onlyNumberSp],maxSize[6]]","placeholder"=>__("Quantidade"),"value"=>($edit)?$membership_data['installment_amount']:""]);
			echo "</div>";
			
			echo "<div class='col-md-4 module_padding'>";						
			echo $this->Form->select("install_plan_id",$installment_plan,["default"=>($edit)?$membership_data["install_plan_id"]:"","empty"=>__("Selecione o plano de parcelamento"),"class"=>"form-control plan_list validate[required]"]);
			echo "</div>";			
			
			echo "<div class='col-md-2'>";			
			
			echo $this->Form->button(__("Adicionar plano de parcelamento"),["class"=>"form-control add_plan btn btn-success btn-flat","type"=>"button","data-url"=>$this->Gym->createurl("GymAjax","addInstalmentPlan")]);
			echo "</div>";
			echo "</div>";
						

			echo "<div class='form-group'>";
			echo "<label class='control-label col-md-3'>".__("Taxa de inscrição")."<span class='text-danger'> *</span></label>";
			echo "<div class='col-md-8'>";
			echo "<div class='input-group'>";	
			echo "<span class='input-group-addon'>".$this->Gym->get_currency_symbol()."</span>";
			echo $this->Form->input("",["label"=>false,"name"=>"signup_fee","class"=>"form-control validate[required,custom[onlyNumberSp],maxSize[6]]","value"=>($edit)?$membership_data['signup_fee']:""]);
			echo "</div>";
			echo "</div>";
			echo "</div>";
			
			echo "<div class='form-group'>";
			echo "<label class='control-label col-md-3'>".__("Descrição de membro")."</label>";
			echo "<div class='col-md-8'>";			
			echo $this->Form->textarea("membership_description",["rows"=>"15","class"=>"form-control textarea","value"=>($edit)?$membership_data['membership_description']:""]);
			echo "</div>";
			echo "</div>";
			
			echo "<div class='form-group'>";
			echo "<label class='control-label col-md-3'>".__("Foto de perfil")."</label>";
			echo "<div class='col-md-8'>";
			echo $this->Form->file("gmgt_membershipimage",["class"=>"form-control"]);
			echo "</div>";			
			echo "</div>";	
			
			$url =  (isset($membership_data['gmgt_membershipimage']) && $membership_data['gmgt_membershipimage'] != "") ? $this->request->webroot ."/upload/" . $membership_data['gmgt_membershipimage'] : $this->request->webroot ."/upload/Thumbnail-img.png";
			echo "<div class='col-md-offset-3'>";
			echo "<img src='{$url}' class='img-responsive' style='max-width:300px;'>";
			echo "</div>";
			echo "<br><br>";
			
			echo "<br>";
			echo "<div class='col-md-offset-3'>";
			echo $this->Form->button(__("Salvar"),['class'=>"btn btn-flat btn-success","name"=>"add_membership"]);
			echo "</div>";	
			echo $this->Form->end();
			echo "<br>";
			
		?>	
		</div>	
		<div class="overlay gym-overlay">
		  <i class="fa fa-refresh fa-spin"></i>
		</div>
	</div>
</section>
<!-- Script Start -->
<script>
// Add Category Script Start							
$("body").on("click",".add-category",function(){
	var name = $(".cat_name").val();
	var ajaxurl = $(this).attr("data-url");
	//var regex = new RegExp("^[a-zA-Z]+$");
	var regex = /^[a-zA-Z\s._-]*$/;
	if(name != "") {
		if(regex.test(name))  {
			if(name.length<=50) {
				var curr_data = { name : name};
				$.ajax({
					url : ajaxurl,
					type : "POST",
					data : curr_data,
					success : function(response) {					
						if(response) {
							$(".cat_name").val('');
							response = $.parseJSON(response);
							$("#category_list").prepend(response[0]);
							$(".cat_list").append(response[1]);
						}
					}
				});
			} else{
				var message = "<?php echo __("Insira no máximo 50 caracteres apenas."); ?>";
				alert(message);
			}
		}else {
			var  message = "<?php echo __("Por favor, digite apenas letras."); ?>";
			alert(message);
		}
	}else {
		var message = "<?php echo __("Digite o nome da categoria."); ?>";
		alert(message);
	}
	
});				
// Add Category Script End
// Delete Category Script Start
	$("body").on("click",".del-category",function(){
		var did = $(this).attr("del-id");
		var ajaxurl = $(this).attr("data-url");
		var cdata = {did:did};
		var confirmMsg = "<?php echo __("Tem certeza de que deseja excluir este registro?"); ?>";
		if(confirm(confirmMsg)) {
			$.ajax({
				url:ajaxurl,
				type : "POST",
				data : cdata,
				success : function(response) {
					if(response) {
						$("tr[id=row-"+did+"]").remove();
						$("option[value="+did+"]").remove();
					}
				}
			});
		}else {
			return false;
		}
	});

// Delete Category Script End
</script>
<script>
$(".check_limit").change(function(){
	if($(this).val() == "Limited")
	{
		$(".div_limit input,.div_limit select").removeAttr("disabled");
		$(".div_limit").show("fast");
	}else{
		$(".div_limit").hide("fast");
		
		$(".div_limit input,.div_limit select").attr("disabled", "disabled");		
	}
});
</script>