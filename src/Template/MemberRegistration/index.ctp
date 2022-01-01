<?php
echo $this->Html->script('jQuery/jQuery-2.1.4.min.js');
echo $this->Html->script('jquery-ui.min');
echo $this->Html->css('bootstrap.min');
echo $this->Html->css('jquery-ui.css');	
$is_rtl = $this->Gym->getSettings("enable_rtl");
if($is_rtl)
{
	echo $this->Html->css('bootstrap-rtl.min');
}
echo $this->Html->script('bootstrap/js/bootstrap.min.js');
echo $this->Html->css('plugins/datepicker/datepicker3');
echo $this->Html->script('datepicker/bootstrap-datepicker.js');
$dtp_lang = $this->gym->getSettings("datepicker_lang");
echo $this->Html->script("datepicker/locales/bootstrap-datepicker.{$dtp_lang}");
echo $this->Html->script("jQueryUI/ui/i18n/datepicker-{$dtp_lang}.js");
echo $this->Html->css('bootstrap-datepicker.css');
echo $this->Html->css('bootstrap-multiselect');
echo $this->Html->script('bootstrap-multiselect');
echo $this->Html->css('validationEngine/validationEngine.jquery');
echo $this->Html->script('validationEngine/languages/jquery.validationEngine-en');
echo $this->Html->script('validationEngine/jquery.validationEngine'); 
?>
<style>
.content{   
   padding-bottom: 0;
}

body *{
	    font-family: "Roboto", sans-serif;
}
.datepicker.dropdown-menu {   
    max-width: 300px;
}
.form-control {
    height: 34px !important;
	font-size: 14px !important;
}
#form-head{
	color : #eee;
}
.ui-datepicker-title select{
Padding:0;
}
</style>
<script type="text/javascript">
$(document).ready(function() {	
$(".validateForm").validationEngine();
	$('.group_list').multiselect({
		includeSelectAllOption: true	
	});
	
	var box_height = $(".box").height();
	var box_height = box_height + 500 ;
	$(".content-wrapper").css("height",box_height+"px");
	
	$('.class_list').multiselect({
		includeSelectAllOption: true	
	});
	$(".dob").datepicker({yearRange: "-100:+0",changeYear: true,changeMonth: true, dateFormat:"<?php echo $this->Gym->dateformat_PHP_to_jQueryUI($this->Gym->getSettings("date_format")); ?>" ,"language" : "<?php echo $dtp_lang;?>"});
	//$(".datepick").datepicker({format: 'yyyy-mm-dd',"language" : "<?php echo $dtp_lang;?>"});
	$(".datepick").datepicker({dateFormat:"<?php echo $this->Gym->dateformat_PHP_to_jQueryUI($this->Gym->getSettings("date_format")); ?>" ,"language" : "<?php echo $dtp_lang;?>",});
		
	$(".content-wrapper").css("height","2600px");
	
	$(".mem_valid_from").datepicker({yearRange: "-100:+0",changeYear: true,changeMonth: true,dateFormat: "<?php echo $this->Gym->dateformat_PHP_to_jQueryUI($this->Gym->getSettings("date_format")); ?>" ,"language" : "<?php echo $dtp_lang;?>"}).on("change",function(ev){
				var ajaxurl = $("#mem_date_check_path").val();
				// var date = ev.target.value;	
	
		var date = $('.mem_valid_from').datepicker('getDate');  
		date.setDate(date.getDate());
		date1=formatDate(date);
				
				var membership = $(".membership_id option:selected").val();		
				if(membership != "")
				{
				// 	var curr_data = { date : date, membership:membership};
					var curr_data = { date : date1, membership:membership};
					$(".valid_to").val("Calcunlando a data..");
					$.ajax({
							url :ajaxurl,
							type : 'POST',
							data : curr_data,
							success : function(response)
									{
									    
									    let now = new Date(date1)
console.log('De: ' + now)
let next30days = new Date(now.setDate(now.getDate() + 30))
console.log('Next 30th day: ' + next30days);
									    
									    
									    
										$(".valid_to,.check").datepicker({ language: "<?php echo $dtp_lang;?>",
											 dateFormat :"<?php echo $this->Gym->dateformat_PHP_to_jQueryUI($this->Gym->getSettings("date_format")); ?>",
											 
											}
											);
											$(".valid_to,.check").datepicker($.datepicker.regional['<?php echo $dtp_lang;?>']);
											$( ".valid_to,.check" ).datepicker( "setDate",  new Date(next30days) );
									//	$(".valid_to").val(response);
										
									},
							error: function(e){
									console.log(e.responseText);
							}
						});
				}else{
					$(".valid_to").val("Escolha o plano");
				}
			});	
});

function validate_multiselect()
{		
		var classes = $("#class_list").val();
		if(classes == null)
		{
			alert("Selecione a classe ou adicione a classe primeiro.");
			return false;
		}else{
			return true;
		}		
}

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}
</script>
<section class="content">
	<br>
	<div class="col-md-12 box box-default">		
		<div class="box-header">
			<section class="content-header">
			  <h3 id='form-head'>
				<i class="fa fa-user"></i>
				<?php echo __("Registro de Membro");?>
			  </h3>			  
			</section>
		</div>
		<div class="panel">
		<?php				
			echo $this->Form->create("addgroup",["type"=>"file","class"=>"validateForm form-horizontal","role"=>"form"]);
			echo "<fieldset><legend>". __('Informações pessoais')."</legend>";
			echo "<br>";
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="email">'. __("ID do Membro").'</label>';
			echo '<div class="col-md-6">';
			echo $this->Form->input("",["label"=>false,"name"=>"member_id","class"=>"form-control","disabled"=>"disabled","value"=>(($edit)?$data['member_id']:$member_id)]);
			echo "</div>";	
			echo "</div>";
			
			
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="email">'. __("Primeiro Nome").'<span class="text-danger"> *</span></label>';
			echo '<div class="col-md-6">';
			echo $this->Form->input("",["label"=>false,"name"=>"first_name","class"=>"form-control validate[required,custom[onlyLetterSp],maxSize[30]]","value"=>(($edit)?$data['first_name']:'')]);
			echo "</div>";	
			echo "</div>";	
			
			
			
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="email">'. __("Último nome").'<span class="text-danger"> *</span></label>';
			echo '<div class="col-md-6">';
			echo $this->Form->input("",["label"=>false,"name"=>"last_name","class"=>"form-control validate[required,custom[onlyLetterSp],maxSize[30]]]","value"=>(($edit)?$data['last_name']:'')]);
			echo "</div>";	
			echo "</div>";	
			
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="email">'. __("Gênero").'<span class="text-danger"> *</span></label>';
			echo '<div class="col-md-6 checkbox">';
			$radio = [
						['value' => 'male', 'text' => 'Masculino'],
						['value' => 'female', 'text' => 'Feminino']
					];
			echo $this->Form->radio("gender",$radio,['default'=>'male']);			
			echo "</div>";	
			echo "</div>";
			
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="email">'. __("Data de nascimento").'<span class="text-danger"> *</span></label>';
			echo '<div class="col-md-6">';
			echo $this->Form->input("",["label"=>false,"name"=>"birth_date","class"=>"form-control dob validate[required] datepick","value"=>(($edit)?date($this->Gym->getSettings("date_format"),strtotime($data['birth_date'])):''),"onkeydown"=>"return false"]);
			echo "</div>";	
			echo "</div>";		
			
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="email">'. __("Grupo").'</label>';
			echo '<div class="col-md-2">';			
			echo @$this->Form->select("assign_group",$groups,["default"=>json_decode($data['assign_group']),"multiple"=>"multiple","class"=>"form-control group_list"]);
			echo "</div>";				
			echo "</div>";
			echo "</fieldset>";
		/*		
			echo "<fieldset><legend>". __('Contact Information')."</legend>";
			echo "<br>";
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="email">'. __("Address").'<span class="text-danger"> *</span></label>';
			echo '<div class="col-md-6">';
			echo $this->Form->input("",["label"=>false,"name"=>"address","class"=>"form-control validate[required,maxSize[150]]","value"=>(($edit)?$data['address']:'')]);
			echo "</div>";	
			echo "</div>";	
			
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="email">'. __("City").'<span class="text-danger"> *</span></label>';
			echo '<div class="col-md-6">';
			echo $this->Form->input("",["label"=>false,"name"=>"city","class"=>"form-control validate[required,custom[onlyLetterSp],maxSize[20]]","value"=>(($edit)?$data['city']:'')]);
			echo "</div>";	
			echo "</div>";
			
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="email">'. __("state").'</label>';
			echo '<div class="col-md-6">';
			echo $this->Form->input("",["label"=>false,"name"=>"state","class"=>"form-control validate[custom[onlyLetterSp],maxSize[20]]","value"=>(($edit)?$data['state']:'')]);
			echo "</div>";	
			echo "</div>";
			
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="email">'. __("Zip code").'<span class="text-danger"> *</span></label>';
			echo '<div class="col-md-6">';
			echo $this->Form->input("",["label"=>false,"name"=>"zipcode","class"=>"form-control validate[required ,custom[onlyNumberSp],maxSize[10]]]","value"=>(($edit)?$data['zipcode']:'')]);
			echo "</div>";	
			echo "</div>";
			
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="email">'. __("Mobile Number").'<span class="text-danger"> *</span></label>';
			echo '<div class="col-md-6">';
			echo '<div class="input-group">';
			echo '<div class="input-group-addon">+'.$this->Gym->getCountryCode($this->Gym->getSettings("country")).'</div>';
			echo $this->Form->input("",["label"=>false,"name"=>"mobile","class"=>"form-control validate[required,custom[onlyNumberSp],maxSize[15]]","value"=>(($edit)?$data['mobile']:'')]);
			echo "</div>";	
			echo "</div>";	
			echo "</div>";	
			
			*/
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="email">'. __("Telefone").'<span class="text-danger"> *</span></label>';
			echo '<div class="col-md-6">';
			echo '<div class="input-group">';
			echo $this->Form->input("",["label"=>false,"name"=>"mobile","class"=>"form-control validate[required,custom[onlyNumberSp],maxSize[15]]","value"=>(($edit)?$data['mobile']:'')]);
			echo "</div>";	
			echo "</div>";
			echo "</div>";
			
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="email">'. __("WhatsApp").'</label>';
			echo '<div class="col-md-6">';
			echo $this->Form->input("",["label"=>false,"name"=>"phone","class"=>"form-control validate[custom[onlyNumberSp],maxSize[15]]","value"=>(($edit)?$data['phone']:'')]);
			echo "</div>";	
			echo "</div>";
			
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="email">'. __("E-mail").'<span class="text-danger"> *</span></label>';
			echo '<div class="col-md-6">';
			echo $this->Form->input("",["label"=>false,"name"=>"email","class"=>"form-control validate[required,custom[email]]","value"=>(($edit)?$data['email']:'')]);
			echo "</div>";	
			echo "</div>";			
			echo "</fieldset>";
			
			
			
			
			
			///AREA DA ANAMINESE
			echo "<fieldset><legend>". __('Ficha de Anamnese')."</legend>";
			echo "<br>";
			
			
			//peso
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="email">'. __("Qual seu peso (Kg)?").'<span class="text-danger"> *</span></label>';
			echo '<div class="col-md-6">';
			echo $this->Form->input("",["label"=>false,"name"=>"peso","class"=>"form-control validate[required]","value"=>(($edit)?$data['peso']:''),"readonly"=> (($edit)?true:false)]);
			echo "</div>";	
			echo "</div>";
			
			//altura
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="email">'. __("Qual sua altura (Metros)?").'<span class="text-danger"> *</span></label>';
			echo '<div class="col-md-6">';
			echo $this->Form->input("",["label"=>false,"name"=>"altura","class"=>"form-control validate[required]","value"=>(($edit)?$data['altura']:''),"readonly"=> (($edit)?true:false)]);
			echo "</div>";	
			echo "</div>";
			
			//doenca
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="email">'. __("Tem alguma doença ou patologia? Se sim, qual? Especifique!").'<span class="text-danger"> *</span></label>';
			echo '<div class="col-md-6">';
			echo $this->Form->textarea("",["label"=>false,"name"=>"doenca","rows"=>"6","type"=>"text_area","class"=>"validate[required]","value"=>(($edit)?$data['doenca']:''),"readonly"=> (($edit)?true:false)]);
			echo "</div>";	
			echo "</div>";
			
			//uso_sub
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="email">'. __("Faz o uso frequente de algum medicamento, bebida alcoólica, droga ou hormônios?").'<span class="text-danger"> *</span></label>';
			echo '<div class="col-md-6">';
			echo $this->Form->textarea("",["label"=>false,"name"=>"uso_sub","rows"=>"6","type"=>"text_area","class"=>"validate[required]","value"=>(($edit)?$data['uso_sub']:''),"readonly"=> (($edit)?true:false)]);
			echo "</div>";	
			echo "</div>";
			
			//uso_horm
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="email">'. __("Caso use, seja hormônio ou o que for; Especifique quantidade e período de uso.").'<span class="text-danger"> *</span></label>';
			echo '<div class="col-md-6">';
			echo $this->Form->textarea("",["label"=>false,"name"=>"uso_horm","rows"=>"6","type"=>"text_area","class"=>"validate[required]","value"=>(($edit)?$data['uso_horm']:''),"readonly"=> (($edit)?true:false)]);
			echo "</div>";	
			echo "</div>";
			
			//prob_diges
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="email">'. __("Tem algum problema de digestão?").'<span class="text-danger"> *</span></label>';
			echo '<div class="col-md-6">';
			echo $this->Form->textarea("",["label"=>false,"name"=>"prob_diges","rows"=>"6","type"=>"text_area","class"=>" validate[required]","value"=>(($edit)?$data['prob_diges']:''),"readonly"=> (($edit)?true:false)]);
			echo "</div>";	
			echo "</div>";
			
			//pra_exe
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="email">'. __("Pratica alguma atividade física? Se sim, qual e por quanto tempo?").'<span class="text-danger"> *</span></label>';
			echo '<div class="col-md-6">';
			echo $this->Form->textarea("",["label"=>false,"name"=>"pra_exe","rows"=>"6","type"=>"text_area","class"=>"validate[required]","value"=>(($edit)?$data['pra_exe']:''),"readonly"=> (($edit)?true:false)]);
			echo "</div>";	
			echo "</div>";
			
			
			//escolha
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="email">'. __("Qual sua maior facilidade; ganhar ou perder peso?").'<span class="text-danger"> *</span></label>';
			echo '<div class="col-md-6 checkbox">';
			$radio = [
						['value' => 'ganhar', 'text' => 'Ganhar'],
						['value' => 'perder', 'text' => 'Perder'],
						['value' => 'ambos', 'text' => 'Ambos']
					];
			echo $this->Form->radio("escolha",$radio,['default'=>'Ganhar']);			
			echo "</div>";	
			echo "</div>";
			
			//text_area1
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="email">'. __("O que costuma comer durante seu dia-a-dia? Conte-me detalhadamente.").'<span class="text-danger"> *</span></label>';
			echo '<div class="col-md-6">';
			echo $this->Form->textarea("",["label"=>false,"name"=>"text_area1", "rows"=>"6","type"=>"text_area","class"=>"","value"=>(($edit)?$data['text_area1']:''),"readonly"=> (($edit)?true:false)]);
			echo "</div>";	
			echo "</div>";
			
			//text_area2
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="email">'. __("Me conta detalhadamente sobre sua rotina; que horas acorda, trabalha e etc").'<span class="text-danger"> *</span></label>';
			echo '<div class="col-md-6">';
			echo $this->Form->textarea("",["label"=>false,"name"=>"text_area2","rows"=>"6","class"=>"","value"=>(($edit)?$data['text_area2']:''),"readonly"=> (($edit)?true:false)]);
			echo "</div>";	
			echo "</div>";
			
			//text_area3
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="email">'. __("Quantas vezes poderá treinar por dia? E quanto tempo disponível para isso?").'<span class="text-danger"> *</span></label>';
			echo '<div class="col-md-6">';
			echo $this->Form->textarea("",["label"=>false,"name"=>"text_area3","rows"=>"4","class"=>"","value"=>(($edit)?$data['text_area3']:''),"readonly"=> (($edit)?true:false)]);
			echo "</div>";	
			echo "</div>";
			
			//img1
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="documento">'. __("Foto de Frente").'</label>';
			echo '<div class="col-md-4">';
			echo $this->Form->file("img1",["class"=>"form-control"]);
			$sa = ($edit && !empty($data['img1']));
			$dado = $data['img1'];
			if(empty($sa)){
			    
                echo ""; //"<br><img style='width: 60px;' src='{$this->request->webroot}webroot/upload/null.png' class='img-responsive'>";
			}else{
			    
			    echo "<br><a target='_blank' href='{$this->request->webroot}webroot/upload/{$dado}'><img style='width: 60px;' src='{$this->request->webroot}webroot/upload/anamnese.png' class='img-responsive'>";
			    $arquivo = $dado;
			    
			    function somenteNomeArquivo($arquivo){
                   $ext = explode('.',$arquivo);
                   return $ext[0]; 
                }
                
                echo somenteNomeArquivo($arquivo)."</a>";
			};
			
			echo "</div>";	
			echo "</div>";
			
			//img2
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="documento">'. __("Foto de Lado").'</label>';
			echo '<div class="col-md-4">';
			echo $this->Form->file("img2",["class"=>"form-control"]);
			$sa1 = ($edit && !empty($data['img2']));
			$dado = $data['img2'];
			if(empty($sa1)){
			    
                echo ""; //"<br><img style='width: 60px;' src='{$this->request->webroot}webroot/upload/null.png' class='img-responsive'>";
			}else{
			    
			    echo "<br><a target='_blank' href='{$this->request->webroot}webroot/upload/{$dado}'><img style='width: 60px;' src='{$this->request->webroot}webroot/upload/anamnese.png' class='img-responsive'>";
			    $arquivo = $dado;
			    function somenteNomeArquivo($arquivo){
                   $ext = explode('.',$arquivo);
                   return $ext[0]; 
                }
                
                echo somenteNomeArquivo($arquivo)."</a>";
			};
			
			echo "</div>";	
			echo "</div>";
			
			//img3
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="documento">'. __("Foto de Costas").'</label>';
			echo '<div class="col-md-4">';
			echo $this->Form->file("img3",["class"=>"form-control"]);
			$sa2 = ($edit && !empty($data['img3']));
			$dado = $data['img3'];
			if(empty($sa2)){
			    
                echo ""; //"<br><img style='width: 60px;' src='{$this->request->webroot}webroot/upload/null.png' class='img-responsive'>";
			}else{
			    
			    echo "<br><a target='_blank' href='{$this->request->webroot}webroot/upload/{$dado}'><img style='width: 60px;' src='{$this->request->webroot}webroot/upload/anamnese.png' class='img-responsive'>";
			    $arquivo = $dado;
			    function somenteNomeArquivo($arquivo){
                   $ext = explode('.',$arquivo);
                   return $ext[0]; 
                }
                
                echo somenteNomeArquivo($arquivo)."</a>";
			};
			
			echo "</div>";	
			echo "</div>";
			
			//img4
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="documento">'. __("Foto do Corpo Inteiro").'</label>';
			echo '<div class="col-md-4">';
			
			echo $this->Form->file("img4",["class"=>"form-control"]);
			$image4 = ($edit && !empty($data['img4'])) ? $data['img4'] : "";
			if(!empty($image4)){
			    echo "<br><img src='{$this->request->webroot}webroot/upload/{$image4}'>";
			}
			
			
			
			
			
// 			echo $this->Form->file("img4",["class"=>"form-control"]);
// 			$sa3 = ($edit && !empty($data['img4']));
// 			$dado = $data['img4'];
// 			if(empty($sa3)){
			    
//                 echo ""; //"<br><img style='width: 60px;' src='{$this->request->webroot}webroot/upload/null.png' class='img-responsive'>";
// 			}else{
			    
// 			    echo "<br><a target='_blank' href='{$this->request->webroot}webroot/upload/{$dado}'><img style='width: 60px;' src='{$this->request->webroot}webroot/upload/anamnese.png' class='img-responsive'>";
// 			    $arquivo = $dado;
// 			    function somenteNomeArquivo($arquivo){
//                   $ext = explode('.',$arquivo);
//                   return $ext[0]; 
//                 }
                
//                 echo somenteNomeArquivo($arquivo)."</a>";
// 			};
			
			echo "</div>";	
			echo "</div>";
			///FIM DA AREA DE ANAMINESE
			
			
			
			
			
			
						
			echo "<fieldset><legend>". __('Informação de Login')."</legend>";
			echo "<br>";
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="email">'. __("Nome do usuário").'<span class="text-danger"> *</span></label>';
			echo '<div class="col-md-6">';
			echo $this->Form->input("",["label"=>false,"name"=>"username","class"=>"form-control validate[required]","value"=>(($edit)?$data['username']:''),"readonly"=> (($edit)?true:false)]);
			echo "</div>";	
			echo "</div>";
			
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="email">'. __("Senha").'<span class="text-danger"> *</span></label>';
			echo '<div class="col-md-6">';
			echo $this->Form->password("",["label"=>false,"name"=>"password","class"=>"form-control validate[required]","value"=>(($edit)?$data['password']:'')]);
			echo "</div>";	
			echo "</div>";
			
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="email">'. __("Foto do Perfil").'</label>';
			echo '<div class="col-md-4">';
			echo $this->Form->file("image",["class"=>"form-control"]);
			$image = ($edit && !empty($data['image'])) ? $data['image'] : "";
			if(!empty($image)){
			    echo "<br><img src='{$this->request->webroot}webroot/upload/{$image}'>";
			}
			echo "</div>";	
			echo "</div>";			
			echo "</fieldset>";
			
			echo "<fieldset><legend>". __('Mais Informações')."</legend>";			
			echo "<br>";
			/*
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="email">'. __("Interested Area").'</label>';
			echo '<div class="col-md-6">';			
			echo @$this->Form->select("intrested_area",$interest,["default"=>$data['intrested_area'],"empty"=>__("Select Interest"),"class"=>"form-control interest_list"]);
			echo "</div>";				
			echo "</div>";
			
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="email">'. __("Source").'</label>';
			echo '<div class="col-md-6">';			
			echo @$this->Form->select("g_source",$source,["default"=>$data['source'],"empty"=>__("Select Source"),"class"=>"form-control source_list"]);
			echo "</div>";				
			echo "</div>";
			*/
			echo "<div class='form-group class-member'>";	
			echo '<label class="control-label col-md-2" for="email">'. __("Plano de Fidelização").'<span class="text-danger"> *</span></label>';
			echo '<div class="col-md-6">';			
			echo @$this->Form->select("selected_membership",$membership,["default"=>$data['selected_membership'],"empty"=>__("Selecione um plano"),"class"=>"form-control validate[required] membership_id"]);
			echo "</div>";	
			echo "</div>";	
			
			echo "<div class='form-group'>";	
			echo '<label class="control-label col-md-2" for="email">'. __("Classe").'<span class="text-danger"> *</span></label>';
			echo '<div class="col-md-6">';			
			echo @$this->Form->select("assign_class","",["default"=>$member_class,"class"=>"class_list form-control validate[required]","multiple"=>"multiple"]);
			echo "</div>";			
			echo "</div>";
			
			echo "<div class='form-group class-member'>";	
			echo '<label class="control-label col-md-2" for="email">'. __("Selecione a data de cadastro").'<span class="text-danger"> *</span></label>';
			echo '<div class="col-md-2">';
			echo $this->Form->input("",["label"=>false,"name"=>"membership_valid_from","class"=>"form-control validate[required] mem_valid_from","value"=>(($edit && $data['membership_valid_from']!="")?$this->Gym->get_db_format(date($this->Gym->getSettings("date_format"),strtotime($data['membership_valid_from']))):'')]);
			echo "</div>";
			echo '<div class="col-md-1 no-padding text-center">';
			echo "Até";
			echo "</div>";
			echo '<div class="col-md-2">';
			echo $this->Form->input("",["type"=>"","label"=>false,"name"=>"membership_valid_to","class"=>"form-control validate[required] valid_to","value"=>(($edit && $data['membership_valid_to']!="")?date("Y-m-d",strtotime($data['membership_valid_to'])):''),"readonly"=>true]);?>
			<input type='hidden' name='membership_valid_to' class='check' value='<?php ($edit && $data['membership_valid_to']!="")?$this->Gym->get_db_format(date($this->Gym->getSettings("date_format"),strtotime($data['membership_valid_to']))):''?>'>
			<?php echo "</div>";
			echo "</div>";
			
			
			echo "</fieldset>";

				
			echo "<br>";
			echo '<div class="form-group">';
			echo '<div class="col-md-4 col-sm-6 col-xs-6">';
			echo $this->Form->button(__("Salvar"),['class'=>"col-md-offset-2 btn btn-flat btn-success","name"=>"add_member"]);
			echo "</div>";
			echo '<div class="col-md-5 col-sm-6 col-xs-6 pull-right">';
			echo "<a href='".$this->request->base ."/Users/' class='btn btn-success'>".__('Voltar')."</a>";
			echo '</div>';
			echo '</div>';
			echo $this->Form->end();
		?>
		<input type="hidden" value="<?php echo $this->request->base;?>/MemberRegistration/getMembershipEndDate/" id="mem_date_check_path">
		<input type="hidden" value="<?php echo $this->request->base;?>/MemberRegistration/getMembershipClasses" id="mem_class_url">
		</div>			
	</div>
</section>
 <script>
$(".membership_status_type").change(function(){
	if($(this).val() == "Prospect" || $(this).val() == "Alumni" )
	{
		$(".class-member").hide("SlideDown");
		$(".class-member input,.class-member select").attr("disabled", "disabled");				
	}else{
		$(".class-member").show("SlideUp");
		$(".class-member input,.class-member select").removeAttr("disabled");	
		$("#available_classes").attr("disabled", "disabled");
	}
});
if($(".membership_status_type:checked").val() == "Prospect" || $(".membership_status_type:checked").val() == "Alumni")
{ 
	$(".class-member").hide("SlideDown");
	$(".class-member input,.class-member select").attr("disabled", "disabled");		
}
$("body").on("change",".membership_id",function(){
	var m_id = $(this).val();
	var ajaxurl = $("#mem_class_url").val();
	var curr_data = { m_id : m_id};
	$(".class_list").html("");
	$.ajax({
		url : ajaxurl,
		type : "POST",
		data : curr_data,
		success : function(response){
			$(".class_list").append(response);
			$(".class_list").multiselect("rebuild");
			return false;
		},
		error : function(e){
			
			console.log(e.responseText);
		}
	});
});
</script>