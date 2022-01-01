<?php $session = $this->request->session()->read("User"); ?>
<script>
	$(document).ready(function() {
		$(".mydataTable").DataTable({
			"responsive": true,
			"order": [
				[1, "asc"]
			],
			"aoColumns": [{
					"bSortable": true
				},
				{
					"bSortable": true
				},
				{
					"bSortable": true
				},
				{
					"bSortable": true
				},
				{
					"bSortable": false,
					"visible": false
				}
			],
			"language": [
				<?php echo $this->Gym->data_table_lang(); ?>
			]
		});
	});
</script>
<?php
if ($session["role_name"] == "administrator" || $session["role_name"] == "staff_member" || $session["role_name"] == "member") { ?>
	<script>
		$(document).ready(function() {
			var table = $(".mydataTable").DataTable();

		});
	</script>
<?php } ?>

<section class="content">
	<br>
	<div class="col-md-12 box box-default">
		<div class="box-header">
			<section class="content-header">
				<h1>
					<i class="fa fa-bars"></i>
					<?php echo __("Avaliações"); ?>
					<small><?php echo __("Medidas"); ?></small>
				</h1>
				<?php
				if ($session["role_name"] == "administrator" || $session["role_name"] == "staff_member" || $session["role_name"] == "member") { ?>
					<ol class="breadcrumb">
						&nbsp;
						<a href="<?php echo $this->Gym->createurl("GymDailyWorkout", "addMeasurment"); ?>" class="btn btn-flat btn-custom"><i class="fa fa-plus"></i> <?php echo __("Adicionar Medição"); ?></a>
					</ol>
				<?php } ?>
			</section>
		</div>
		<hr>
		<div class="box-body">
			<table class="mydataTable table table-striped" width="100%">
				<thead>
					<tr>
						<th><?php echo __("Imagem"); ?></th>
						<th><?php echo __("Nome"); ?></th>
						<th><?php echo __("Telefone"); ?></th>
						<th><?php echo __("Whatsapp"); ?></th>
						<th><?php echo __("Email"); ?></th>
						<th><?php echo __("Ação"); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($data as $row) {
						echo "<tr>
				<td><image src='" . $this->request->base . "/webroot/upload/{$row['image']}' class='membership-img img-circle'></td>
				<td>{$row["first_name"]} {$row["last_name"]}</td>
				<td>{$row["mobile"]}</td>
				<td>{$row["phone"]}</td>
				<td class='emailid'>{$row["email"]}</td>
				<td class='action'> 
				<!--<a href='" . $this->request->base . "/GymDailyWorkout/viewWorkout/{$row['id']}' 
					class='btn btn-flat btn-primary'><i class='fa fa-eye'></i> " . __("Visualizar") . "</a>-->
				<a href='javascript:void(0)' data-url='{$this->request->base}/GymAjax/GymViewMeasurment' 
					class='view_measurment btn btn-flat btn-default view-measurement-popup' 
					data-val='{$row['id']}'>" . __("Ver Medição") . "</a>      
				</td>
				</tr>";
					}
					?>
				</tbody>
				<tfoot>
					<tr>
						<th><?php echo __("Imagem"); ?></th>
						<th><?php echo __("Nome"); ?></th>
						<th><?php echo __("Telefone"); ?></th>
						<th><?php echo __("Whatsapp"); ?></th>
						<th><?php echo __("Email"); ?></th>
						<th><?php echo __("Ação"); ?></th>
					</tr>
				</tfoot>
			</table>
			<!-- END -->
		</div>
		<div class='overlay gym-overlay'>
			<i class='fa fa-refresh fa-spin'></i>
		</div>
	</div>
</section>