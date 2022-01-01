<?php $session = $this->request->session()->read("User");?>
<script>
$(document).ready(function(){
	var box_height = $(".box").height();
	var box_height = box_height + 100 ;
	$(".content-wrapper").css("height",box_height+"px");
});		
</script>


<section class="content">
	<br>
	<div class="col-md-12 box box-default">		
		<div class="box-header">
			<section class="content-header">
			  <h1>
				<i class="fa fa-bars"></i>
				<?php echo __("Fichas de treino");?>
				<small><?php echo __("Atribuir treino");?></small>
			  </h1>
			   <?php 
				if($session["role_name"] == "administrator" || $session["role_name"] == "staff_member")
				{ ?>
			  <ol class="breadcrumb">
				<a href="<?php echo $this->Gym->createurl("GymAssignWorkout","assignWorkout");?>" class="btn btn-flat btn-custom"><i class="fa fa-plus"></i> <?php echo __("Fichas de treino");?></a>
			  </ol>
			  <?php } ?>
			</section>
		</div>
		<hr>
		<div class="box-body">
		<?php
		if(!empty($work_outdata))
		{
			foreach($work_outdata as $data=>$row)
			{				
				foreach($row as $r)
				{
					if(is_array($r))
					{
						$days_array[$data]["start_date"] = $row["start_date"];
						$days_array[$data]["end_date"] = $row["end_date"];
						$days_array[$data]["description"] = $row["description"];
						$days_array[$data]["sheet"] = $row["sheet"];
						$day = $r["day_name"];
						$days_array[$data][$day][] = $r;
					}
				}
			}
			foreach($days_array as $data=>$row)
			{ 
				?>
				<div class="panel panel-default workout-block" id="remove_panel_<?php echo $data;?>">
				  <div class="panel-heading" style="color:#fff;">
					<i class="fa fa-calendar"></i> <?php echo __("Start From")." <span class='work_date'>".date($this->Gym->getSettings("date_format"),strtotime($row["start_date"]))."</span> ".__("TO")." <span class='work_date'>".date($this->Gym->getSettings("date_format"),strtotime($row["end_date"]))."</span>";?>
					<span style="padding: 0 30px;"> &bull; </span>
					<?php
						$file = 'webroot/upload/'.$row["sheet"];
						// echo $file.'<br>';
						// echo '<a href="'.$file.'">dsadas</a><br>';
						if(file_exists( __DIR__ . '/../../../'.$file)){ ?>
                    		<i class="fa fa-download" aria-hidden="true"></i><a href="/painel/<?php echo $file; ?>" download>
								<strong>DOWNLOAD DA FICHA DE TREINO</strong></a>&nbsp;&nbsp;&nbsp;
                      		<i class="fa fa-eye" aria-hidden="true"></i><a href="/painel/<?php echo $file; ?>" target="_blank">
								<strong>VISUALIZAR</strong></a><br>
					<?php } ?>
				  </div>
				  <br>
				  <div class="col-lg-6 col-md-6 col-6">
					  <?php echo nl2br($row['description']); ?>
                  </div>
				<!--<?php 
				foreach($row as $day=>$value){
					if(is_array($value)){ ?> 
						<div class="work_out_datalist">
						<div class="col-md-2 col-sm-2 day_name"><?php echo __($day);?></div>
						<div class="col-md-10 col-sm-10">-->
						<?php foreach($value as $r) { ?>
							<!--<div class="col-md-12"> 
							<span class="col-md-3 col-sm-3 col-xs-12"><?php echo $this->Gym->get_activity_by_id($r["workout_name"]);?></span>
							<span class="col-md-2 col-sm-2 col-xs-6"><?php echo $r["sets"];?></span>
							<span class="col-md-2 col-sm-2 col-xs-6"><?php echo $r["reps"];?> </span>
							<span class="col-md-2 col-sm-2 col-xs-6"><?php echo $r["kg"];?> </span>
							<span class="col-md-2 col-sm-2 col-xs-6"><?php echo $r["time"];?> </span>
							</div>
						<?php } ?>
						</div>
						</div>
					<?php } 
				} ?>-->
				</div>
	  <?php } 
		}
		else{
			echo __("No Record Found");
		}?>	
		</div>
</section>