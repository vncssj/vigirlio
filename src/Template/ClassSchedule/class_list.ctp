<?php $session = $this->request->session()->read("User");?>
<script>
$(document).ready(function(){		
	$(".mydataTable").DataTable({
		"responsive": true,
		"order": [[ 1, "asc" ]],
		"language" : {<?php echo $this->Gym->data_table_lang();?>}				  
	});
});		
</script>
<?php
if($session["role_name"] == "administrator" || $session["role_name"] == "staff_member")
{ ?>
	<script>
	$(document).ready(function(){
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
				<?php echo __("Lista de Classes");?>
				<small><?php echo __("Horário de aula");?></small>
			  </h1>
			  <ol class="breadcrumb">
				<?php
				if($session["role_name"] == "administrator" || $session["role_name"] == "member" || $session["role_name"] == "staff_member")
				{ ?>
					<a href="<?php echo $this->Gym->createurl("ClassSchedule","viewSchedule");?>" class="btn btn-flat btn-custom"><i class="fa fa-calendar"></i> <?php echo __("Horários das aulas");?></a>
				<?php }
				if($session["role_name"] == "administrator" || $session["role_name"] == "staff_member")
				{ ?>
				&nbsp;
					<a href="<?php echo $this->Gym->createurl("ClassSchedule","addClass");?>" class="btn btn-flat btn-custom"><i class="fa fa-plus"></i> <?php echo __("Adicionar horário de aula");?></a>
				<?php } ?>
			  </ol>
			</section>
		</div>
		<hr>
		<div class="box-body">
			<table class="mydataTable table table-striped" width="100%">
				<thead>
					<tr>
						<th><?php echo __("Nome da classe");?></th>
						<!--<th><?php echo __("Staff Name");?></th>-->
						<th><?php echo __("Hora de início");?></th>
						<th><?php echo __("Hora de término");?></th>
						<!--<th><?php echo __("Location");?></th>-->
						<th><?php echo __("Taxas de reserva de aulas")?></th>
						<?php if($session["role_name"] !="member"){ ?>
						<th><?php echo __("Ação");?></th>
						<?php } ?>
					</tr>
				</thead>
				<tbody>
				<?php
				foreach($data as $row)
				{
					substr_replace('abcd', 'x', 0, -4); 
					echo "<tr>
							<td>{$row['class_name']}</td>
							<!--<td>{$row['gym_member']['first_name']} {$row['gym_member']['last_name']}</td>-->
							<td>{$row['start_time']}</td>
							<td>{$row['end_time']}</td>
							<!--<td>{$row['location']}</td>-->
							<td>". $this->Gym->get_currency_symbol() ." {$row['class_fees']}"."</td>";
							if($session["role_name"] !="member")
							{
								$confirmMsg = __("Tem certeza de que deseja excluir este registro?");
							echo"<td>
								<a href='{$this->request->base}/ClassSchedule/editClass/{$row['id']}' title='Editar' class='btn btn-flat btn-primary'><i class='fa fa-edit'></i></a>
								<a href='{$this->request->base}/ClassSchedule/deleteClass/{$row['id']}' title='Deletar' class='btn btn-flat btn-danger' onClick=\"return confirm('$confirmMsg');\"><i class='fa fa-trash-o'></i></a>
							</td>";
							}
					echo "</tr>";
				}
				?>
				</tbody>
				<tfoot>
					<tr>
						<th><?php echo __("Nome da classe");?></th>
						<!--<th><?php echo __("SNome da Equipe");?></th>-->
						<th><?php echo __("Hora de início");?></th>
						<th><?php echo __("Hora de término");?></th>
						<!--<th><?php echo __("Localização");?></th>-->
						<th><?php echo __("Taxas de reserva de aulas ")?></th>
						<?php if($session["role_name"] !="member"){ ?>
						<th><?php echo __("Ação");?></th>
						<?php } ?>
					</tr>
				</tfoot>
			</table>
		</div>	
		<div class="overlay gym-overlay">
		  <i class="fa fa-refresh fa-spin"></i>
		</div>
	</div>
</section>