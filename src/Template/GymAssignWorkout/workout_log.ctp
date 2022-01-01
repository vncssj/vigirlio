<?php $session = $this->request->session()->read("User");?>
<script>
$(document).ready(function(){		
	$(".mydataTable").DataTable({
		"responsive": true,
		"order": [[ 1, "asc" ]],
		"aoColumns":[
	        {"bSortable": true},
	        {"bSortable": true},
	        {"bSortable": true},
	        {"bSortable": false,"visible":false}],
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
				<?php echo __("Fichas de treinos");?>
				<small><?php echo __("Atribuir treino");?></small>
			  </h1>
			   <?php 
				if($session["role_name"] == "administrator" || $session["role_name"] == "staff_member")
				{ ?>
			  <ol class="breadcrumb">
				<a href="<?php echo $this->Gym->createurl("GymAssignWorkout","assignWorkout");?>" class="btn btn-flat btn-custom"><i class="fa fa-plus"></i> <?php echo __("Adicionar treino");?></a>
			  </ol>
			  <?php } ?>
			</section>
		</div>
		<hr>
		<div class="box-body">
		<table class="mydataTable table table-striped" width="100%">
			<thead>
				<tr>
					<th><?php echo __("Imagem");?></th>
					<th><?php echo __("Nome do membro");?></th>
					<th><?php echo __("Objetivo de Membro");?></th>
					<th><?php echo __("Ação");?></th>
				</tr>
			</thead>
			<tbody>
			<?php
			foreach($data as $row)
			{
				//var_dump($row);
				$confirmMsg = __("Tem certeza de que deseja excluir este registro?");
				 $groupview = rtrim($this->Gym->get_group_by_member($row['user_id']), ' , ');
				$groupview = str_replace('None', 'Nenhuma',$groupview);
				echo "<tr>
					<td><img src='".$this->request->webroot ."webroot/upload/{$row['gym_member']['image']}' class='membership-img img-circle'></td>
					<td>{$row['gym_member']['first_name']} {$row['gym_member']['last_name']} ({$row['gym_member']['member_id']})</td>
					<td>" . $groupview . "</td>
					<td>
						<a href='".$this->request->base ."/GymAssignWorkout/viewWorkouts/{$row['user_id']}' class='btn btn-primary btn-flat' title='Ver'><i class='fa fa-eye'></i> ".__("Ver")."</a> 
						<a href='".$this->request->base ."/GymAssignWorkout/deleteWorkout/{$row['user_id']}' class='btn btn-danger btn-flat' title='Deletar' onclick=\"return confirm('$confirmMsg');\"><i class='fa fa-trash'></i></a>
					</td>
				</tr>";
			}
			?>
			</tbody>
			<tfoot>
				<tr>
					<th><?php echo __("Imagem");?></th>
					<th><?php echo __("Nome do membro");?></th>
					<th><?php echo __("Objetivo de Membro");?></th>
					<th><?php echo __("Ação");?></th>
				</tr>
			</tfoot>
		</table>
		<br><br>
		</div>
	</div>
</section>