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
		"aoColumns":[
					  {"bSortable": true},
	                  {"bSortable": true},
	                  {"bSortable": true},
	                  {"bSortable": true},	                                            
	                  {"bSortable": true},	                                            
	                  {"bSortable": true},	                                            
	                  {"bSortable": false}],
		"language" : {<?php echo $this->Gym->data_table_lang();?>}	
	});
});		
</script>

<section class="content">
	<br>
	<div class="col-md-12 box box-default">		
		<div class="box-header">
			<section class="content-header">
			  <h1>
				<i class="fa fa-history"></i>
				<?php echo __("Histórico de Assinaturas");?>
				<small><?php echo __("Assinaturas");?></small>
			  </h1>			 
			</section>
		</div>
		<hr>
		<div class="box-body">
			<table class="mydataTable table table-striped" width="100%">
			<thead>
				<tr>
					<th><?php echo __("Nome"); ?></th>
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
				if(!empty($data))
				{
					foreach($data as $row)
					{
						echo "<tr>
							<td>".$this->Gym->get_member_name($row['member_id'])."</td>
							<td>{$row["Membership"]["membership_label"]}</td>
							<td>€ {$row["membership_amount"]}</td>
							<td>€". ($row["membership_amount"] - $row["paid_amount"]) ."</td>
							<td>".$this->Gym->get_db_format(date($this->Gym->getSettings("date_format"),strtotime($row["start_date"])))."</td>
							<td>".$this->Gym->get_db_format(date($this->Gym->getSettings("date_format"),strtotime($row["end_date"])))."</td>
							<td><span class='bg-primary pay_status'>".$this->Gym->get_membership_paymentstatus($row["mp_id"])."</span></td>
						</tr>";
					}
				}
				?>
			</tbody>
			<tfoot>
				<tr>
					<th><?php echo __("Nome"); ?></th>
					<th><?php echo __("Plano");?></th>
					<th><?php echo __("Preço");?></th>
					<th><?php echo __("Valor pendente");?></th>
					<th><?php echo __("Data de início");?></th>
					<th><?php echo __("Data de Término");?></th>
					<th><?php echo __("Status");?></th>
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
