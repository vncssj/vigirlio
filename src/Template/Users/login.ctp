<div class="container-gym">
	<div class="info">
		<h1><?php echo $this->Gym->getSettings("name"); ?></h1>
	</div>
</div>
<?php

$logo = $this->Gym->getSettings("gym_logo");
$logo = (!empty($logo)) ? $this->request->base . "/webroot/upload/" . $logo : $this->request->base . "/webroot/img/Thumbnail-img.png";

?>
<div class="form">
	<div class="logo"><img src="<?php echo $logo; ?>" /></div>
	<form class="register-form">
		<div class="logging"><?php echo __("Fazendo login"); ?>
			<i class="fa-li fa fa-spinner fa-spin"></i>
		</div>
	</form>
	<form class="login-form" method="post" id="login-form">
		<input type="text" placeholder="<?php echo __("Nome do usuário"); ?>" name="username" class="validate[required] " id="unm" />
		<input type="password" placeholder="<?php echo __("Senha"); ?>" name="password" class="validate[required] " />
		<button id="btn_login">Entrar</button>
		<p class="message"><a href="<?php echo $this->request->base; ?>/MemberRegistration/"><?php echo __("Registro de Membro"); ?></a></p>
		<br>
		<p class="message"><a href="<?php echo $this->request->base; ?>/ClassBooking/"><?php echo __("Reserva de aulas"); ?></a></p>
		<br>
		<p class="message"><a href="<?php echo $this->request->base; ?>/users/forgotPassword/">Esqueci a Senha</a></p>

		<!--&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#">View Plan</a></p> -->
	</form>
</div>
<script>
	$(document).load(function() {
		/* $("div.message").hide(); */
	});
	$('.message a').click(function() {
		/* $('form').animate({height: "toggle", opacity: "toggle"}, "slow"); */
	});
	$("div.message").click(function() {
		/* $(this).slideUp("slow"); */
		$(this).hide();
	});
</script>