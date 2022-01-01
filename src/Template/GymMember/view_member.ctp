
<script>
$(".content-wrapper").css("min-height","2500px");
$(document).ready(function(){	
$(".sub-history").dataTable({
		"responsive": true,
		"order": [[ 1, "asc" ]],
		"aoColumns":[	                  
	                  {"bSortable": true},
	                  {"bSortable": true},
	                  {"bSortable": true},
	                  {"bSortable": true},
	                  {"bSortable": true},
	                  {"bSortable": true}],
	"language" : {<?php echo $this->Gym->data_table_lang();?>}	
	});
	
	var box_height = $(".box").height();
	var box_height = box_height + 100 ;
	/* $(".content").css("height",box_height+"px"); */
});
</script>
<section class="content">
	<br>
	<div class="col-md-12 box box-default">		
		<div class="box-header">
			<section class="content-header">
			  <h1>
				<i class="fa fa-eye"></i> 
				<?php echo __("Ver membro");?>
				<small><?php echo __("Membro");?></small>
			  </h1>
			  <ol class="breadcrumb">
				<a href="<?php echo $this->Gym->createurl("GymMember","memberList");?>" class="btn btn-flat btn-custom"><i class="fa fa-bars"></i> <?php echo __("Lista de Membros");?></a>
			  </ol>
			</section>
		</div>
		<hr>
		<div class="box-body">
		<div class="row">
			<div class="col-md-7 col-sm-12  col-xs-12 no-padding border">
			<div class="col-md-5 col-sm-4 col-xs-12 no-padding text-center" style="margin-top: 20px;">
				<?php
					
					$logo = $data['image'];
					$logo = (!empty($logo)) ? "/webroot/upload/". $logo : "Thumbnail-img2.png";
					echo $this->Html->image($logo,["style"=>"height:140px;width:180px"]);
				
				$date = $data['birth_date'];
				$timestamp = $date->getTimestamp();
				$date->setTimestamp($timestamp);
				$birthday = $this->Gym->get_db_format($date->format($this->Gym->getSettings("date_format")));
				
				?>
				<div style="width: 80%;margin: 10px 0px 0px 20px;">
				<?php 	
				
					$parameter = array('id'=>$data['id'],'email'=>$data['email']);
					$qrcode =  $this->Qr->contact($parameter);
				?>
					<img src="<?php echo $qrcode; ?>" style="max-width:100%">
				</div>
				
				
			</div>
			
			<div class="col-md-7 col-sm-7 col-xs-12 pull-right">
				<br>
				<table class="table tbl-content">
					<tr>
						<th><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;<?php echo __(" ID do Membro");?></th>
						<td class="txt_color"><?php echo $data['member_id'];?></td>
					</tr>
					<tr>
						<th><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;<?php echo __("Nome");?></th>
						<td class="txt_color"><?php echo $data['first_name'];?></td>
					</tr>
				
					<tr>
						<th><i class="fa fa-envelope"></i>&nbsp;&nbsp;&nbsp;<?php echo __("Email");?></th>
						<td class="txt_color emailid"><?php echo $data['email'];?></td>
					</tr>
					<tr>
						<th><i class="fa fa-phone"></i>&nbsp;&nbsp;&nbsp;<?php echo __("Telefone");?></th>
						<td class="txt_color"><?php echo $data['mobile'];?></td>
					</tr>
					<tr>
						<th><i class="fa fa-whatsapp"></i>&nbsp;&nbsp;&nbsp;<?php echo __("WhatsApp");?></th>
						<td class="txt_color"><?php echo $data['phone'];?></td>
					</tr>
					<tr>
						<th><i class="fa fa-calendar"></i>&nbsp;&nbsp;&nbsp;<?php echo __("Data de nascimento");?></th>
						<td class="txt_color"><?php echo $birthday;?></td>
					</tr>
					<tr>
						<th><i class="fa fa-mars"></i>&nbsp;&nbsp;&nbsp;<?php echo __("Gênero");?></th>
						<td class="txt_color"><?php echo $data['gender'];?></td>
					</tr>									
					<tr>
						<th><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;<?php echo __("Nome do usuário");?></th>
						<td class="txt_color"><?php echo $data['username'];?></td>
					</tr>
				</table>
			</div>
			</div>
			<div class="col-md-1 space_member" style="padding-right: ">
			</div>
			<div class="col-md-4 no-padding border">	
			
					<table class="table table-margin">
					<tr>
						<th><i class="fa fa-users"></i>&nbsp;&nbsp;&nbsp;<?php echo __("Plano");?></th>
						<td class="txt_color"><?php echo $data['membership']['membership_label'];?></td>
					</tr>
					<tr>
						<th><i class="fa fa-calendar"></i>&nbsp;&nbsp;<?php echo __("Data de validade");?></th>
						<td class="txt_color"><?php echo $this->Gym->get_db_format(date($this->Gym->getSettings("date_format"),strtotime($data['membership_valid_to'])));?></td>
					</tr>
					<tr>
						<th><i class="fa fa-graduation-cap"></i>&nbsp;&nbsp;<?php echo __("Classes");?></th>
						<td class="txt_color"><?php echo $this->Gym->get_class_by_member($data["id"]);
						//echo $data['id'];?></td>
					</tr>
					
					<!--<tr>-->
					<!--	<th><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;<?php echo __("Staff Member");?></th>-->
					<!--	<td class="txt_color"><?php echo $this->Gym->get_staff_name($data['assign_staff_mem']);?></td>-->
					<!--</tr>-->
									
					<tr>
						<th><i class="fa fa-power-off"></i>&nbsp;&nbsp;&nbsp;<?php echo __("Status");?></th>
						<td class="txt_color"><?php echo __($data['membership_status']); ?></td>
					</tr>
					
					<tr>
						<th><i class="fa fa-map-marker"></i>&nbsp;&nbsp;&nbsp;<?php echo __("Grupos/Objetivos");?></th>
						<td class="txt_color">
						<?php
							$groupview = rtrim($this->Gym->get_group_by_member($data["id"]), ' , ');
							$groupview = str_replace('None', 'Nenhuma', $groupview);
							echo $groupview; ?></td>
					</tr>					
				</table>
			</div>
		</div>
		
		
		
		
		
		
		
		
		
		<hr>
		<div class="row">
		    <center>
			    <span class="report_title">
				<span class="fa-stack">
					<i class="fa fa-info fa-stack-1x"></i>
				</span> 
				<span class="shiptitle"><?php echo __("Informações sobre Anamnese");?></span>
				<br>
				<span class="shiptitle"><?php echo __("Cliente: ".$data['first_name']);?></span>
				</span>
		    </center>
				<br>
		</div>
		<form>
          <div class="form-group">
            <label for="exampleFormControlInput1"><?php echo __("Peso (Kg)");?></label>
            <input type="text" class="form-control" readonly id="staticEmail" value="<?php echo $data['peso'].' ';?>">
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1"><?php echo __("Altura (metros)");?></label>
            <input type="text" class="form-control" readonly id="staticEmail" value="<?php $valor = $data['altura']; echo number_format($valor).' '; ?>">
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1"><?php echo __("Tem alguma doença ou patologia?");?></label>
            <textarea class="form-control" readonly id="staticEmail" rows="3"> <?php echo $data['doenca'];?> </textarea>
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1"><?php echo __("Faz o uso frequente de algum medicamento, bebida alcoólica, droga ou hormônios?");?></label>
            <textarea  class="form-control" readonly id="staticEmail" rows="3"> <?php echo $data['uso_sub'];?>   </textarea>
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1"><?php echo __("Caso use, seja hormônio ou o que for; Especifique quantidade e período de uso.");?></label>
            <textarea class="form-control" readonly id="staticEmail" rows="3"> <?php echo $data['uso_horm'];?>  </textarea>
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1"><?php echo __("Qual sua maior facilidade; ganhar ou perder peso?");?></label>
            
            <?php 
						$valorp= $data['escolha'];
						if($valorp == 'perder'){
						    echo '<input type="text" class="form-control" readonly id="staticEmail" value="EM PERDER PESO">';
						}elseif($valorp == 'ganhar'){
						   echo '<input type="text" class="form-control" readonly id="staticEmail" value="EM GANHAR PESO">';
						}else{
						   echo '<input type="text" class="form-control" readonly id="staticEmail" value="EM AMBOS">';
						}
						?>
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1"><?php echo __("Pratica alguma atividade física? Se sim, qual e por quanto tempo?");?></label>
            <textarea class="form-control" readonly id="staticEmail" rows="3"> <?php echo $data['pra_exe'];?> </textarea>
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1"><?php echo __("O que costuma comer durante seu dia-a-dia?");?></label>
            <textarea class="form-control" readonly id="staticEmail" rows="3"><?php echo $data['text_area1'];?></textarea>
          </div>
          
          <div class="form-group">
            <label for="exampleFormControlInput1"><?php echo __("Detalhes sobre sua rotina; que horas acorda, trabalha e etc ");?></label>
            <textarea class="form-control" readonly id="staticEmail" rows="3"><?php echo $data['text_area2'];?></textarea>
          </div>
          
          <div class="form-group">
            <label for="exampleFormControlInput1"><?php echo __("Quantas vezes poderá treinar por dia? E quanto tempo disponível para isso?");?></label>
            <textarea class="form-control" readonly id="staticEmail" rows="3"><?php echo $data['text_area3'];?></textarea>
          </div>
          
          <hr class="mt-2 mb-5">

          <div class="row text-center text-lg-left">
        
            <div class="col-lg-3 col-md-4 col-6">
                <label for="exampleFormControlInput1"><strong>FRENTE</strong></label>
              <?php
                    $img1 = $data['img1'];
        			$img1 = (!empty($img1)) ? "/webroot/upload/".$img1 : "/webroot/upload/Thumbnail-img.png";
        			echo $this->Html->image($img1,["style"=>"height:140px;width:180px"]);
					
                  ?>
            </div>
            <div class="col-lg-3 col-md-4 col-6">
              <label for="exampleFormControlInput1"><strong>LADO</strong></label>
              <?php
                    $img2 = $data['img2'];
        			$img2 = (!empty($img2)) ? "/webroot/upload/".$img2 : "/webroot/upload/Thumbnail-img.png";
        			 echo $this->Html->image($img2,["style"=>"height:140px;width:180px"]);
					
                  ?>
            </div>
            <div class="col-lg-3 col-md-4 col-6">
              <label for="exampleFormControlInput1"><strong>COSTA</strong></label>
              <?php
                    $img3 = $data['img3'];
        			$img3 = (!empty($img3)) ? "/webroot/upload/".$img3 : "/webroot/upload/Thumbnail-img.png";
        			 echo $this->Html->image($img3,["style"=>"height:140px;width:180px"]);
					
                  ?>
            </div>
            <div class="col-lg-3 col-md-4 col-6">
              <label for="exampleFormControlInput1"><strong>CORPO INTEIRO</strong></label>
              <?php
                    $img4 = $data['img4'];
        			$img4 = (!empty($img4)) ? "/webroot/upload/".$img4 : "/webroot/upload/Thumbnail-img.png";
        			 echo $this->Html->image($img4,["style"=>"height:140px;width:180px"]);
					
                  ?>
            </div>
          </div>
          
        </form>
		<hr>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		<hr>
		<div class="row">
		    <center>
			    <span class="report_title">
				<span class="fa-stack">
					<i class="fa fa-line-chart fa-stack-1x"></i>
				</span> 
				<span class="shiptitle"><?php echo __("Relatórios de Evolução");?></span>
				<br>
				</span>
		    </center>
				<br>
		</div>
		
		<div class="row view_detail view_member_detail">
			<div class="col-md-6 col-sm-6 col-xs-12 border">
			<span class="report_title">
				<span class="fa-stack">
					<i class="fa fa-line-chart fa-stack-1x"></i>
				</span> 
				<span class="shiptitle"><?php echo __("Relatório de Peso");?></span>

				<?php $role = $this->request->session()->read('User.role_name');?>
				<?php if($role != 'accountant'){ ?>	
				<a href="<?php echo $this->request->base ."/GymDailyWorkout/add_measurment/{$data['id']}/Peso";?>" class="btn btn-flat btn-danger right"> <?php echo __("Adicionar medida");?></a>
			<?php } ?>
			</span>			
			<div id="weight_report" style="width: 100%; height: 250px;float:left;">
				<?php 
				$GoogleCharts = new GoogleCharts;
				$weight_chart = $GoogleCharts->load( 'LineChart' , 'weight_report' )->get( $weight_data["data"] , $weight_data["option"] );
			
				if(empty($weight_data["data"]) || count($weight_data["data"]) == 1)
				echo __('Não há dados suficientes para gerar relatório'); ?>
			</div>  
			<script type="text/javascript" src="https://www.google.com/jsapi"></script> 
			<script type="text/javascript">
				<?php 
				if(!empty($weight_data["data"]) && count($weight_data["data"]) > 1)
				echo $weight_chart;?>
			</script>
			</div>			
			
			<div class="col-md-6 col-sm-6 col-xs-12 border view_report_top">
			<span class="report_title">
				<span class="fa-stack cutomcircle">
					<i class="fa fa-line-chart fa-stack-1x"></i>
				</span> 
				<span class="shiptitle"><?php echo __("Relatório de cintura");?></span>

				<?php $role = $this->request->session()->read('User.role_name');?>
				<?php if($role != 'accountant'){ ?>		
				<a href="<?php echo $this->request->base ."/GymDailyWorkout/add_measurment/{$data['id']}/Cintura";?>" class="btn btn-flat btn-danger right"> <?php echo __("Adicionar medida"); ?></a>
				<?php } ?>	
			</span>
			<div id="waist_report" style="width: 100%; height: 250px;float:left;">
				<?php 
				$GoogleCharts = new GoogleCharts;
				$waist_chart = $GoogleCharts->load( 'LineChart' , 'waist_report' )->get( $waist_data["data"] , $waist_data["option"] );
			
				if(empty($waist_data["data"]) || count($waist_data["data"]) == 1)
				echo __('Não há dados suficientes para gerar relatório'); ?>
			</div>  
			<script type="text/javascript" src="https://www.google.com/jsapi"></script> 
			<script type="text/javascript">
				<?php 
				if(!empty($waist_data["data"]) && count($waist_data["data"]) > 1)
				echo $waist_chart;?>
			</script>
			</div>
		</div>	
		<br><br>
		<div class="row view_detail">
			<div class="col-md-6 col-sm-6 col-xs-12 border">
			<span class="report_title">
				<span class="fa-stack cutomcircle">
					<i class="fa fa-line-chart fa-stack-1x"></i>
				</span> 
				<span class="shiptitle"><?php echo __("Relatório de coxa ");?></span>	

				<?php $role = $this->request->session()->read('User.role_name');?>
				<?php if($role != 'accountant'){ ?>	
				<a href="<?php echo $this->request->base ."/GymDailyWorkout/add_measurment/{$data['id']}/Coxa";?>" class="btn btn-flat btn-danger right"><?php echo __("Adicionar medida"); ?></a>
				<?php } ?>	
			</span>			
			<div id="thing_report" style="width: 100%; height: 250px;float:left;">
				<?php 
				$GoogleCharts = new GoogleCharts;
				$thing_chart = $GoogleCharts->load( 'LineChart' , 'thing_report' )->get( $thigh_data["data"] , $thigh_data["option"] );
			
				if(empty($thigh_data["data"]) || count($thigh_data["data"]) == 1)
				echo __('Não há dados suficientes para gerar relatório'); ?>
			</div>  
			<script type="text/javascript" src="https://www.google.com/jsapi"></script> 
			<script type="text/javascript">
				<?php 
				if(!empty($thigh_data["data"]) && count($thigh_data["data"]) > 1)
				echo $thing_chart;?>
			</script>
			</div>			
			
			<div class="col-md-6 col-sm-6 col-xs-12 border view_report_top">
			<span class="report_title">
				<span class="fa-stack cutomcircle">
					<i class="fa fa-line-chart fa-stack-1x"></i>
				</span> 
				<span class="shiptitle"><?php echo __("Relatório de Braço");?></span>	

				<?php $role = $this->request->session()->read('User.role_name');?>
				<?php if($role != 'accountant'){ ?>	
				<a href="<?php echo $this->request->base ."/GymDailyWorkout/add_measurment/{$data['id']}/Braco";?>" class="btn btn-flat btn-danger right"><?php echo __("Adicionar medida")?></a>
				<?php } ?>	
			</span>
			<div id="arms_report" style="width: 100%; height: 250px;float:left;">
				<?php 
				$GoogleCharts = new GoogleCharts;
				$arms_chart = $GoogleCharts->load( 'LineChart' , 'arms_report' )->get( $arms_data["data"] , $arms_data["option"] );
			
				if(empty($arms_data["data"]) || count($arms_data["data"]) == 1)
				echo __('Não há dados suficientes para gerar relatório'); ?>
			</div>  
			<script type="text/javascript" src="https://www.google.com/jsapi"></script> 
			<script type="text/javascript">
				<?php 
				if(!empty($arms_data["data"]) && count($arms_data["data"]) > 1)
				echo $arms_chart;?>
			</script>
			</div>
		</div>		
		<br><br>
		<div class="row view_detail">
			<div class="col-md-6 col-sm-6 col-xs-12 border">
			<span class="report_title">
				<span class="fa-stack cutomcircle">
					<i class="fa fa-line-chart fa-stack-1x"></i>
				</span> 
				<span class="shiptitle"><?php echo __("Relatório de Panturrilha");?></span>	

				<?php $role = $this->request->session()->read('User.role_name');?>
				<?php if($role != 'accountant'){ ?>	
				<a href="<?php echo $this->request->base ."/GymDailyWorkout/add_measurment/{$data['id']}/Panturrilha";?>" class="btn btn-flat btn-danger right"><?php echo __("Adicionar medida"); ?></a>	

			<?php } ?>
			</span>			
			<div id="height_report" style="width: 100%; height: 250px;float:left;">
				<?php 
				$GoogleCharts = new GoogleCharts;
				$height_chart = $GoogleCharts->load( 'LineChart' , 'height_report' )->get( $height_data["data"] , $height_data["option"] );
			
				if(empty($height_data["data"]) || count($height_data["data"]) == 1)
				echo __('Não há dados suficientes para gerar relatório'); ?>
			</div>  
			<script type="text/javascript" src="https://www.google.com/jsapi"></script> 
			<script type="text/javascript">
				<?php 
				if(!empty($height_data["data"]) && count($height_data["data"]) > 1)
				echo $height_chart;?>
			</script>
			</div>			
			
			<div class="col-md-6 col-sm-6 col-xs-12 border view_report_top">
			<span class="report_title">
				<span class="fa-stack cutomcircle">
					<i class="fa fa-line-chart fa-stack-1x"></i>
				</span> 
				<span class="shiptitle"><?php echo __("Relatório de peito");?></span>	

				<?php $role = $this->request->session()->read('User.role_name');?>
				<?php if($role != 'accountant'){ ?>	
				<a href="<?php echo $this->request->base ."/GymDailyWorkout/add_measurment/{$data['id']}/Peito";?>" class="btn btn-flat btn-danger right"><?php echo __("Adicionar medida")?></a>	
			<?php } ?>
			</span>
			<div id="chest_report" style="width: 100%; height: 250px;float:left;">
				<?php 
				$GoogleCharts = new GoogleCharts;
				$chest_chart = $GoogleCharts->load( 'LineChart' , 'chest_report' )->get( $chest_data["data"] , $chest_data["option"] );
			
				if(empty($chest_data["data"]) || count($chest_data["data"]) == 1)
				echo __('Não há dados suficientes para gerar relatório'); ?>
			</div>  
			<script type="text/javascript" src="https://www.google.com/jsapi"></script> 
			<script type="text/javascript">
				<?php 
				if(!empty($chest_data["data"]) && count($chest_data["data"]) > 1)
				echo $chest_chart;?>
			</script>
			</div>
		</div>		
		<br><br>
		<div class="row view_detail">
			<div class="col-md-6 col-sm-6 col-xs-12 border">
			<span class="report_title">
				<span class="fa-stack cutomcircle">
					<i class="fa fa-line-chart fa-stack-1x"></i>
				</span> 
				<span class="shiptitle"><?php echo __("Relatório de %Gordura");?></span>

				<?php $role = $this->request->session()->read('User.role_name');?>
				<?php if($role != 'accountant'){ ?>		
				<a href="<?php echo $this->request->base ."/GymDailyWorkout/add_measurment/{$data['id']}/Gordura";?>" class="btn btn-flat btn-danger right"><?php echo __("Adicionar medida"); ?></a>
			<?php } ?>
			
			</span>			
			<div id="fat_report" style="width: 100%; height: 250px;float:left;">
				<?php 
				$GoogleCharts = new GoogleCharts;
				$fat_chart = $GoogleCharts->load( 'LineChart' , 'fat_report' )->get( $fat_data["data"] , $fat_data["option"] );
			
				if(empty($fat_data["data"]) || count($fat_data["data"]) == 1)
				echo __('Não há dados suficientes para gerar relatório'); ?>
			</div>  
			<script type="text/javascript" src="https://www.google.com/jsapi"></script> 
			<script type="text/javascript">
				<?php 
				if(!empty($fat_data["data"]) && count($fat_data["data"]) > 1)
				echo $fat_chart;?>
			</script>
			</div>				
	
			<div class="col-md-6 col-sm-6 col-xs-12 border view_report_top">
			<span class="report_title">
				<span class="fa-stack cutomcircle">
					<i class="fa fa-line-chart fa-stack-1x"></i>
				</span> 
				<span class="shiptitle"><?php echo __("Foto");?></span>

				<?php $role = $this->request->session()->read('User.role_name');?>
				<?php if($role != 'accountant'){ ?>		
				<a href="<?php echo $this->request->base ."/GymDailyWorkout/add_measurment/{$data['id']}/Gordura";?>" class="btn btn-flat btn-danger right"><?php echo __("Adicionar foto"); ?></a>	
			<?php } ?>
			</span>	
			<div id="fat_report" style="width: 100%; height: 250px;float:left;">
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
			  <!-- Indicators -->
			  <ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
				<li data-target="#myCarousel" data-slide-to="3"></li>
			  </ol>
			   <!-- Wrapper for slides -->
			  <div class="carousel-inner" role="listbox">
				<?php 
					if(!empty($photos))
					{  
						$active = "active";
						foreach($photos as $photo)
						{?>
							<div class="item carousel-margin <?php echo $active;?>">
							  <img src="<?php echo $this->request->base;?>/webroot/upload/<?php echo $photo["image"];?>" alt="image">
							</div>	
					<?php $active = null;
						}
					}
				?>	
				
			 </div>
					
			  <!-- Left and right controls -->
			  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Anterior</span>
			  </a>
			  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Próximo</span>
			  </a>
			</div>
			</div>
			</div>					
		</div>
		
		<div class="row">
		    <center>
			    <span class="report_title">
				<span class="fa-stack">
					<i class="fa fa-info fa-stack-1x"></i>
				</span> 
				<span class="shiptitle"><?php echo __("Relatório de acompanhamento");?></span>
				<br>
				</span>
		    </center>
				<br>
		</div>
		<center><a href='<?php echo "{$this->request->base}/GymMember/attMember/{$data['id']}" ?>' class="btn btn-flat btn-danger right"><?php echo __("Atualizar"); ?></a></center>
		<hr>
		
		<br>
		<div class="col-md-12  col-sm-12  col-xs-12" style="border:1px solid #dedede;">
		<span class="report_title">
			<span class="fa-stack cutomcircle">
				<i class="fa fa-align-left fa-stack-1x"></i>
			</span> 
			<span class="shiptitle"><?php echo __("Histórico de Assinaturas");?></span>	
		</span>
		<table class="table table-striped sub-history" width="100%">
			<thead>				
				<tr>
					<th><?php echo __("Plano");?></th>
					<th><?php echo __("Preço");?></th>
					<th><?php echo __("Valor pendente");?></th>
					<th><?php echo __("Data de início");?></th>
					<th><?php echo __("Data de Término");?></th>
					<th><?php echo __("Status");?></th>
				</tr>
			</thead>
			<tbody>
			<?php 
			if(!empty($history))
			{
				foreach($history as $row)
				{
					echo "<tr>
							<td>{$row["membership"]["membership_label"]}</td>
							<td>". $this->Gym->get_currency_symbol() ." {$row["membership_amount"]}</td>
							<td>". $this->Gym->get_currency_symbol() ." ". ($row["membership_amount"] - $row["paid_amount"]) ."</td>
							<td>".(($row['start_date'] != '')?$this->Gym->get_db_format(date($this->Gym->getSettings("date_format"),strtotime($row["start_date"]))):'Null')."</td>
							<td>".(($row['end_date'] != '')?$this->Gym->get_db_format(date($this->Gym->getSettings("date_format"),strtotime($row["end_date"]))):'Null')."</td>
							<td><span class='bg-primary pay_status'>".$this->Gym->get_membership_paymentstatus($row["mp_id"])."</span></td>
						</tr>";
				}
			}
			?>
			</tbody>
			<tfoot>
				<tr>
		<th><?php echo __("Plano");?></th>
					<th><?php echo __("Preço");?></th>
					<th><?php echo __("Valor pendente");?></th>
					<th><?php echo __("Data de início");?></th>
					<th><?php echo __("Data de Término");?></th>
					<th><?php echo __("Status");?></th>
				</tr>
			</tfoot>
		</table>
	</div>
		
		
		</div>
	</div>
</section>