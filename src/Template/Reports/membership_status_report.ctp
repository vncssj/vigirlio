<style>
.content-header>.breadcrumb{
	position: relative;
}
</style>
<section class="content">
	<br>
	<div class="col-md-12 box box-default">		
		<div class="box-header box_payment">
			<section class="content-header bread_payment">
			  <h1>
				<i class="fa fa-pie-chart"></i>
				<?php echo __("Relatório de status de membros");?>
				<small><?php echo __("Relatórios");?></small>
			  </h1>
			  <ol class="breadcrumb">
				<a href="<?php echo $this->Gym->createurl("Reports","membershipReport");?>" class="btn btn-flat btn-custom"><i class="fa fa-bar-chart"></i> <?php echo __("Relatórios de Membros");?></a>
				<!--&nbsp;
				<a href="<?php echo $this->Gym->createurl("Reports","attendanceReport");?>" class="btn btn-flat btn-custom"><i class="fa fa-bar-chart"></i> <?php echo __("Relatórios de presenças");?></a>-->
				&nbsp;
				<a href="<?php echo $this->Gym->createurl("Reports","membershipStatusReport");?>" class="btn active btn-flat btn-custom"><i class="fa fa-pie-chart"></i> <?php echo __("Relatórios de status de membros");?></a>
				&nbsp;
				<a href="<?php echo $this->Gym->createurl("Reports","paymentReport");?>" class="btn btn-flat btn-custom"><i class="fa fa-bar-chart"></i> <?php echo __("Relatórios de Pagamentos");?></a>
				<!--&nbsp;
				<a href="<?php echo $this->Gym->createurl("Reports","monthlyworkoutreport");?>" class="btn btn-flat btn-custom"><i class="fa fa-bar-chart"></i> <?php echo __("Relatórios de treino mensal dos membros");?></a>-->
			  </ol>
			</section>
		</div>
		<hr>
		<div class="box-body">
			<?php
			 $options = Array(
								'title' => __('Relatório de status de membros'),
									'titleTextStyle' => Array('color' => '#66707e','fontSize' => 14,'bold'=>true,'italic'=>false,'fontName' =>'open sans'),
					'textStyle' => Array('color' => '#66707e','fontSize' => 10),
					'maxAlternation' => 2
								);
			$GoogleCharts = new GoogleCharts;
			$chart = $GoogleCharts->load( 'PieChart' , 'chart_div' )->get( $chart_array , $options );	
			?>	
			<?php //debug($data);die;
				if(!isset($data) && empty($data)) {?>
					<div class="clear col-md-12">
						<i><?php echo __("Não há dados suficientes para gerar o relatório.");?></i>
					</div>
			<?php } ?>
			<div id="chart_div" style="width: 100%; height: 500px;"></div>		  
				<!-- Javascript --> 
			<script type="text/javascript" src="https://www.google.com/jsapi"></script> 
			<script type="text/javascript">
				<?php 
					if(!empty($data)) {
						echo $chart;
					}?>
			</script>
 		
		<!-- END -->
		</div>
	</div>
</section>