<?php $session = $this->request->session()->read("User");?>
<script>
$( function() {
    $( document ).tooltip();
  } );
  </script>
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
if($session["role_name"] == "administrator" || $session["role_name"] == "staff_member" || $session["role_name"] == "accountant")
{ ?>
<script>

$(document).ready(function(){
	var table = $(".mydataTable").DataTable();
	//table.column(5).visible( true );
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
				<?php echo __("Lista de Eventos");?>
				<small><?php echo __("Evento");?></small>
			  </h1>
			   <?php
			if($session["role_name"] == "administrator" || $session["role_name"] == "staff_member" || $session["role_name"] == "accountant")
			{ ?>
			  <ol class="breadcrumb">				
				<a href="<?php echo $this->Gym->createurl("GymReservation","addReservation");?>" class="btn btn-flat btn-custom"><i class="fa fa-plus"></i> <?php echo __("Adicionar Evento");?></a>
			  </ol>
			<?php } ?>
			</section>
		</div>
		<hr>
		<div class="box-body">
			<table class="mydataTable table table-striped" width="100%">
			<thead>
				<tr>
					<th><?php echo __("Nome do Evento");?></th>
					<th><?php echo __("Data do Evento");?></th>
					<th><?php echo __("Lugar");?></th>
					<th><?php echo __("Hora de início");?></th>
					<th><?php echo __("Hora de término");?></th>
					<?php if($session["role_name"] != "member"){ ?>
					<th><?php echo __("Ação");?></th>
					<?php } ?>
				</tr>
			</thead>
			<tbody>
			<?php
			foreach($data as $row)
			{
				echo "<tr>
					<td>{$row['event_name']}</td>
					<td>".$this->Gym->get_db_format(date($this->Gym->getSettings("date_format"),strtotime($row["event_date"])))."</td>
					<td>{$row['gym_event_place']['place']}</td>
					<td>{$row['start_time']}</td>
					<td>{$row['end_time']}</td>";
				 if($session["role_name"] != "member"){ 
					$confirmMsg = __("Tem certeza de que deseja excluir este registro?");
				echo "<td>
						<a href='".$this->request->base ."/GymReservation/editReservation/{$row['id']}' class='btn btn-primary btn-flat' title='Editar'><i class='fa fa-edit'></i> </a>
						<a href='".$this->request->base ."/GymReservation/deleteReservation/{$row['id']}' class='btn btn-danger btn-flat' title='Deletar' onclick=\"return confirm('$confirmMsg')\"><i class='fa fa-trash'></i></a>
				</td>";
				} 
				echo "</tr>";
			}
			?>
			</tbody>
			<tfoot>
				<tr>
					<th><?php echo __("Nome do Evento");?></th>
					<th><?php echo __("Data do Evento");?></th>
					<th><?php echo __("Lugar");?></th>
					<th><?php echo __("Hora de início");?></th>
					<th><?php echo __("Hora de término");?></th>
					<?php if($session["role_name"] != "member"){ ?>
					<th><?php echo __("Ação");?></th>
					<?php } ?>
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
