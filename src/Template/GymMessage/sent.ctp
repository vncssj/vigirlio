<section class="content">
	<br>
	<div class="col-md-12 box box-default">		
		<div class="box-header">
			<section class="content-header">
			  <h1>
				<i class="fa fa-plus"></i>
				<?php echo __("Mensagens enviadas ");?>
				<small><?php echo __("Mensagem");?></small>
			  </h1>
			  <ol class="breadcrumb">
				
			 </ol>
			</section>
		</div>
		<hr>
		<div class="box-body">
		<div class="row mailbox-header">
			<div class="col-md-2">
				<a class="btn btn-flat btn-success btn-block" href="<?php echo $this->request->base;?>/GymMessage/composeMessage/"><?php echo __("Compor");?></a>
			</div>
			<div class="col-md-6">
				<h2 class="no-margin"><?php echo __("Mensagens Enviadas");?></h2>
			</div>
		</div>
			
			
		<div class="col-md-2 no-padding-left">
			<ul class="list-unstyled mailbox-nav">
				<li>
				<a href="<?php echo $this->request->base;?>/GymMessage/inbox"><i class="fa fa-inbox"></i>&nbsp;<?php echo __("Caixa de entrada");?> <span class="badge badge-success pull-right"><?php echo $unread_messages;?></span></a></li>
				<li>
				<a href="<?php echo $this->request->base;?>/GymMessage/sent"><i class="fa fa-sign-out"></i>&nbsp;<?php echo __("Enviei");?></a></li>                                
			</ul>
		</div>
		<div class="col-md-10 no-padding-left">
			<div class="mailbox-content">
 	<table class="table">
 		<thead>
 			<tr> 					
				<th class="hidden-xs"><span><?php echo __("Mensagem para");?></span></th>				
				<th><?php echo __("Assunto");?></th>
				<th><?php echo __("Mensagem");?></th>
				<th>Data</th>     
 			</tr>
 		</thead>
 		<tbody> 		
 		<?php
		if(!empty($messages))
		{
			foreach($messages as $message)
			{
				echo "<tr>
					<td>{$message["GymMember"]['first_name']} {$message["GymMember"]['last_name']}</td>
					<td><a href='".$this->request->base ."/GymMessage/viewSentMessage/{$message['id']}'>{$message['subject']}</a></td>
					<td>{$message['message_body']}</td>
					<td>".$this->Gym->get_db_format(date($this->Gym->getSettings("date_format"),strtotime($message['date'])))."</td>
				</tr>";
			}
		}
		else{ ?>
			<tr>
				<td colspan='4'>
					<i>
						<?php echo __("Caixa De Mensagem Vazia"); ?>
					</i>
				</td>
			</tr>	
			
		<?php }
		?>
 		</tbody>
 	</table>
 </div>
		</div>
		
		<!-- END -->
		</div>
		<div class='overlay gym-overlay'>
			<i class='fa fa-refresh fa-spin'></i>
		</div>
	</div>
</section>