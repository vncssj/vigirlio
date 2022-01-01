<?php $session = $this->request->session()->read("User");?>
<section class="content">
	<br>
	<div class="col-md-12 box box-default">		
		<div class="box-header">
			<section class="content-header">
			  <h1>
				<i class="fa fa-calendar"></i>
				<?php echo __("Horários das aulas");?>
				<small><?php echo __("Horário de aula");?></small>
			  </h1>
			  <ol class="breadcrumb">
				<a href="<?php echo $this->Gym->createurl("ClassSchedule","classList");?>" class="btn btn-flat btn-custom"><i class="fa fa-bars"></i> <?php echo __("Lista de Classes");?></a>
			  </ol>
			</section>
		</div>
		<hr>
		<div class="box-body">
			<table class="table table-bordered table-hover">
				<?php
				$days = ["Sunday"=>"Domingo","Monday"=>"Segunda-Feira","Tuesday"=>"Terça-Feira","Wednesday"=>"Quarta-Feira","Thursday"=>"Quinta-Feira","Friday"=>"Sexta-Feira","Saturday"=>"Sábado"];
				foreach($days as $day)
				{
					echo "<tr><th width='50' height='50'>". __($day) ."</th><td>";
					foreach($classes as $class)
					{
						$classname=$this->Gym->get_class_by_id($class['class_id']);

						$days = json_decode($class['days']);
						if(in_array($day,$days))
						{ 
					?>					
							<div class="btn-group m-b-sm">
								<?php if($classname!="Classdeleted")
								{ ?>
								<button class="btn btn-flat btn-primary dropdown-toggle" aria-expanded="false" data-toggle="dropdown"><span class="period_box" id="<?php echo $class['id'];?>"><?php echo $this->Gym->get_class_by_id($class['class_id']);?><span class="time"> <?php echo "(".$class['start_time']." - ".$class['end_time'].")";?> </span></span><span class="caret"></span></button>
								<?php } ?>
								<?php if($classname!="Classdeleted")
								{ ?>
								
									<?php if($session["role_name"] == "administrator" || $session["role_name"] == "staff_member" )
									{ 
									?>
										<ul role="menu" class="dropdown-menu">
											<li><a href="<?php echo "{$this->request->base}/ClassSchedule/editClass/{$class['class_id']}";?>"><?php echo __("Editar");?></a></li>
									<?php  } else{
									echo "<script>$('.caret').hide();</script>"; ?>
									
										</ul> <?php }?>
								
								<?php }else{ ?>
									<ul role="menu" class="dropdown-menu">
										<li><a href="#">Esta classe foi excluída</a></li>
									</ul>
								<?php } ?>
							</div>
				<?php	}
					}	
					echo "</td></tr>";
				}
				?>
			</table>
		</div>		
	</div>
</section>