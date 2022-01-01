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
				<?php echo __("Lista de reserva de classe");?>
				<small><?php echo __("Horário de aula");?></small>
			  </h1>
			  <ol class="breadcrumb">
				<?php
				if($session["role_name"] == "administrator" || $session["role_name"] == "member" || $session["role_name"] == "staff_member")
				{ ?>
					<a href="<?php echo $this->Gym->createurl("ClassSchedule","viewSchedule");?>" class="btn btn-flat btn-custom"><i class="fa fa-calendar"></i> <?php echo __("Horários das aulas");?></a>
				<?php }
				?>
				&nbsp;
					<!-- <a href="<?php echo $this->Gym->createurl("ClassBooking","addBooking");?>" class="btn btn-flat btn-custom"><i class="fa fa-plus"></i> <?php echo __("Adicionar reserva de classe");?></a>
				 -->
			  </ol>
			</section>
		</div>
		<hr>
		<div class="box-body">
			<table class="mydataTable table table-striped" width="100%">
				<thead>
					<tr>
						<th><?php echo __("Nome da classe");?></th>
						<th><?php echo __("Nome do membro");?></th>
						<th><?php echo __("Celular");?></th>
						<th><?php echo __("Data de Reserva");?></th>
						<th><?php echo __("Tipo de reserva");?></th>
						<th><?php echo __("Preço");?></th>
						<?php if($session["role_name"] !="member"){ ?>
						<th><?php echo __("Ação");?></th>
						<?php } ?>
					</tr>
				</thead>
				<tbody>
				<?php
				foreach($data as $row)
				{	
					//debug($row);die;
					echo "<tr>
							<td>{$row['class_schedule']['class_name']}</td>
							<td>{$row['full_name']}</td>
							<th>{$row['mobile_no']}</th>
							<td>".date($this->Gym->getSettings("date_format"),strtotime($row['booking_date']))."</td>
							<td>{$row['booking_type']}</td>
							<td>".$this->Gym->get_currency_symbol().' '.(($row['booking_amount'])?$row['booking_amount']:'0')."</td>						
							";
							if($session["role_name"] !="member")
							{
							echo"<td>
								<a href='javascript:void(0)' class='btn1 btn btn-flat btn-info view_invoice' data-url='".$this->request->base ."/GymAjax/viewBooking/{$row['booking_id']}'><i class='fa fa-eye'></i></a>
								</td>";
							}
					echo "</tr>";
				}
				?>
				</tbody>
				<tfoot>
					<tr>
							<th><?php echo __("Nome da classe");?></th>
						<th><?php echo __("Nome do membro");?></th>
						<th><?php echo __("Celular");?></th>
						<th><?php echo __("Data de Reserva");?></th>
						<th><?php echo __("Tipo de reserva");?></th>
						<th><?php echo __("Preço");?></th>
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