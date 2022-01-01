<section class="content">
	<br>
	<div class="col-md-12 box box-default">		
		<div class="box-header">
			<section class="content-header">
			  <h1>
				<i class="fa fa-plus"></i>
				<?php	if($edit){
							echo __("Editar Produto");
						}else{
							echo __("Adicionar Produto");
						}
				?>
				
				<small><?php echo __("Produtos");?></small>
			  </h1>
			  <ol class="breadcrumb">
				<a href="<?php echo $this->Gym->createurl("GymProduct","productList");?>" class="btn btn-flat btn-custom"><i class="fa fa-bars"></i> <?php echo __("Lista de Produtos");?></a>
			 </ol>
			</section>
		</div>
		<hr>
		<div class="box-body">					
		<form class="validateForm form-horizontal" method="post" role="form" enctype="multipart/form-data">		
		<div class='form-group'>	
			<label class="control-label col-md-2" for="product_image"><?php  echo __("Imagem");?><span class="text-danger"> *</span></label>
			<div class="col-md-6">
				<input type="file" name="product_image" class="form-control <?php echo ($edit)? '':'validate[required]'; ?>">
			</div>
		</div>
		<div class='form-group'>	
			<label class="control-label col-md-2" for="product_name"><?php  echo __("Nome do Produto");?><span class="text-danger"> *</span></label>
			<div class="col-md-6">
				<input type="text" name="product_name" class="form-control validate[required]" value="<?php echo ($edit)?$data["product_name"] : "";?>" maxlength="40">
			</div>
		</div>
		<div class='form-group'>	
		<label class="control-label col-md-2" for="email"><?php  echo __("Preço do Produto");?><span class="text-danger"> *</span></label>
		<div class="col-md-6">
			<div class='input-group'>
				<span class='input-group-addon'><?php echo $this->Gym->get_currency_symbol();?></span>
				<input type="text" name="price" class="form-control validate[required,custom[integer,min[0]]]" value="<?php echo ($edit)?$data["price"] : "";?>" maxlength = "10">
			</div>	
		</div>	
		</div>
		<div class='form-group'>	
		<label class="control-label col-md-2" for="email"><?php  echo __("Link");?><span class="text-danger"> *</span></label>
		<div class="col-md-6">
			<input type="text" name="quantity" placeholder="Ex: https://linkproduto.com" class="form-control" value="<?php echo ($edit)?$data["quantity"] : "";?>">
		</div>	
		</div>
		<div class="col-md-offset-2 col-md-6 add_product_save">
			<input type="submit" value="<?php echo __("Salvar");?>" name="save_product" class="btn btn-flat btn-success">
		</div>
		</form>
		<!-- END -->
		</div>
		<div class='overlay gym-overlay'>
			<i class='fa fa-refresh fa-spin'></i>
		</div>
	</div>
</section>
