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
				<i class="fa fa-bars"></i>
				<?php echo __("Avisos prévios");?>
				<small><?php echo __("Notificaçōes");?></small>
			  </h1>
			  <?php
			if($session["role_name"] == "administrator" || $session["role_name"] == "staff_member")
			{ ?>
			  <ol class="breadcrumb">				
				<a href="<?php echo $this->Gym->createurl("GymNotice","addNotice");?>" class="btn btn-flat btn-custom"><i class="fa fa-plus"></i> <?php echo __("Adicionar Aviso ");?></a>
			  </ol>
			<?php } ?>
			</section>
		</div>
		<hr>
		<div class="box-body">
			<table class="mydataTable table table-striped" width="100%">
			<thead>
				<tr>
							<th><?php echo __("Título");?></th>
					<th><?php echo __("Comentário");?></th>
					<th><?php echo __("Para");?></th>
					<th><?php echo __("Classe");?></th>
					<th><?php echo __("Ação");?></th>
				</tr>
			</thead>
			<tbody>
			<?php
				$confirmMsg = __("Are you sure you want to delete this product?");
			foreach($data as $row)
			{
				echo "<tr>";
				echo "<td>{$row['notice_title']}</td>
					  <td>{$row['comment']}</td>
					  <td>". str_replace('All', 'Todos', ucwords(str_replace("_"," ",$row['notice_for'])))."</td>
					  <td>".(($row['class_id']!=0)?$this->Gym->get_class_by_id($row['class_id']):'Nennhuma')."</td>
					  <td>";
				if($session["role_name"] == "administrator" || $session["role_name"] == "staff_member")
				{
					echo " <a href='".$this->request->base ."/GymNotice/editNotice/{$row['id']}' class='btn btn-flat btn-primary' title='".__('Edit')."'><i class='fa fa-edit'></i></a>
						<a href='{$this->request->base}/GymNotice/deleteNotice/{$row['id']}' class='btn btn-flat btn-danger' title='".__('Delete')."' onclick=\"return confirm('$confirmMsg')\"><i class='fa fa-trash'></i></a>";
				}
				echo  " <a href='javascript:void(0)' id='{$row['id']}' data-url='".$this->request->base ."/GymAjax/view_notice' class='view_notice btn btn-flat btn-info' title='".__('View')."' ><i class='fa fa-eye'></i></a>";    
				echo  "</td>";
				echo  "</tr>";
			}
			?>
			<tfoot>
				<tr>
					<th><?php echo __("Título");?></th>
					<th><?php echo __("Comentário");?></th>
					<th><?php echo __("Para");?></th>
					<th><?php echo __("Classe");?></th>
					<th><?php echo __("Ação");?></th>
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
