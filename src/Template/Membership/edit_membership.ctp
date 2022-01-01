<section class="content">
	<br>
	<div class="col-md-12 box box-default">		
		<div class="box-header">
			<section class="content-header">
			  <h1>
				<?php echo __("Adicionar inscrição");?>
				<small><?php echo __("Filiação");?></small>
			  </h1>
			  <ol class="breadcrumb">
				<a href="<?php echo $this->Gym->createurl("Membership","membershipList");?>" class="btn btn-flat btn-custom"><i class="fa fa-bars"></i> <?php echo __("Lista de Sócios");?></a>
			  </ol>
			</section>
		</div>
		<hr>
		<div class="box-body">
		<?php
			
			echo $this->Form->create($membership,["type"=>"file","class"=>"validateForm"]);
			echo "<div class='form-group'>";			
			echo $this->Form->input(__("Nome de membro"),["name"=>"membership_label","class"=>"form-control validate[required]","value"=>$membership_data['membership_label']]);
			echo "</div>";
			
			echo "<div class='form-group col-md-10 no-padding' >";			
			echo $this->Form->label(__("Categoria de Sócios"));				
			echo $this->Form->select("membership_cat_id",$categories,["default"=>$membership_data["membership_cat_id"],"empty"=>__("Escolhaa categoria"),"class"=>"form-control validate[required] cat_list"]);
			echo "</div>";	
									
			echo "<div class='form-group col-md-2'>";
			echo $this->Form->label(" ");
			echo $this->Form->button(__("Adicionar Categoria"),["class"=>"form-control add_category btn btn-success btn-flat","type"=>"button","data-url"=>$this->Gym->createurl("GymAjax","addCategory")]);
			echo "</div>";				
			
			echo "<div class='form-group'>";	
			echo $this->Form->input(__("Período de adesão"),["name"=>"membership_length","class"=>"form-control validate[required]","value"=>$membership_data['membership_length']]);
			echo "</div>";
				
			echo "<div class='form-group'>";
			echo $this->Form->label(__("Limite de Sócios"));
			// $checked = (;
			echo '<br><label class="radio-inline"><input type="radio" name="membership_class_limit" value="Limited" '.(($membership_data['membership_class_limit'] == "Limited") ? "checked" : "") .'>Limitado</label>
				  <label class="radio-inline"><input type="radio" name="membership_class_limit" value="Unlimited" '.(($membership_data['membership_class_limit'] == "Unlimited") ? "checked" : "") .'>Ilimitado</label>';
			echo "</div>";
			
			echo "<div class='form-group'>";
			echo $this->Form->input(__("Quantidade de sócios"),["name"=>"membership_amount","class"=>"form-control validate[required]","value"=>$membership_data['membership_amount']]);
			echo "</div>";	
			
			
			echo "<div class='form-group col-md-4 no-padding'>";
			echo $this->Form->input(__("Valor da Parcela"),["name"=>"installment_amount","class"=>"form-control validate[required]","value"=>$membership_data['installment_amount']]);
			echo "</div>";			
			
			echo "<div class='form-group col-md-4'>";
			echo $this->Form->label(__("Período de Parcelamento"));								
			echo $this->Form->select("install_plan_id",$installment_plan,["default"=>$membership_data["install_plan_id"],"empty"=>__("Select Installment Plan"),"class"=>"form-control plan_list validate[required]"]);
			echo "</div>";			
			
			echo "<div class='form-group col-md-4'>";
			echo $this->Form->label(" ");
			
			echo $this->Form->button(__("Adicionar plano de parcelamento"),["class"=>"form-control add_plan btn btn-success btn-flat","type"=>"button","data-url"=>$this->Gym->createurl("GymAjax","addInstalmentPlan")]);
			echo "</div>";
						

			echo "<div class='form-group'>";
			echo $this->Form->input(__("Signup Fee"),["name"=>"signup_fee","class"=>"form-control validate[required]","value"=>$membership_data['signup_fee']]);
			echo "</div>";	
			
			echo "<div class='form-group'>";
			echo $this->Form->label(__("Descrição de membro"));
			echo $this->Form->textarea("membership_description",["rows"=>"15","class"=>"form-control textarea","value"=>$membership_data['membership_description']]);
			echo "</div>";
			
			echo "<div class='form-group'>";
			echo $this->Form->label(__("Imagem"));
			echo $this->Form->file("gmgt_membershipimage",["class"=>"form-control"]);
			echo "</div>";			
			
			$url =  (isset($membership_data['gmgt_membershipimage']) && $membership_data['gmgt_membershipimage'] != "") ? $this->request->webroot ."/upload/" . $membership_data['gmgt_membershipimage'] : $this->request->webroot ."/upload/Thumbnail-img.png";
			echo "<img src='{$url}' class='img-responsive'>";
			echo "<br><br>";
			
			echo $this->Form->button("Salvar",['class'=>"btn btn-primary","name"=>"add_membership"]);
			echo $this->Form->end();
			
		?>
	
		</div>	
		<div class="overlay gym-overlay">
		  <i class="fa fa-refresh fa-spin"></i>
		</div>
	</div>
</section>