<?php 
$session = $this->request->session(); 
$is_rtl = $session->read("User.is_rtl");
$style = ($is_rtl == "1") ? "style='float:right;'":"";

?>

<style>
.sidebar-mini.sidebar-collapse .sidebar-menu>li>a {
    padding: 11px 5px 28px 15px ;  
}
</style>
<br>

  <ul class="sidebar-menu">
	<li class= "treeview <?php echo ($this->request->controller == "Dashboard") ? "active" : "";?>">
	  <a href="<?php echo $this->Gym->createurl("Dashboard","index");?>">
		<i class="icone" <?php echo $style;?>><img src="<?php echo $this->request->base ."/webroot/img/icon/dashboard.png";?>"></i>
		<span>&nbsp;<?php echo __('Painel de controle');?></span>
	  </a>             
	</li>
	<?php 
	$img_path = $this->request->base ."/webroot/img/icon/";
	foreach($menus as $menu)
	{ 
		if($menu["controller"] == "Report")
		{
		?>
		<!--	<li class="treeview <?php echo ($this->request->controller == "Reports") ? "active" : "";?>">
              <a href="<?php echo $this->Gym->createurl("Reports","monthlyworkoutreport");?>">
                <i class="icone" <?php echo $style;?>><img src="<?php echo $img_path.$menu["menu_icon"];?>"></i><span><?php echo __("Relatório");?></span> 
              </a>
			</li> -->
		<?php
		}
		else
		{
		?>
		<li class= "treeview <?php echo ($this->request->controller == $menu["controller"]) ? "active" : "";?>" >
			<a href="<?php echo $menu["page_link"]; ?>" >
				<i class="icone" <?php echo $style;?>><img src="<?php echo $img_path.$menu["menu_icon"];?>"></i>
				<span>&nbsp;<?php echo __($menu["menu_title"]);?></span> 
			</a>             
		</li>
		<?php 
		}
	} 
	?>	
  </ul>

