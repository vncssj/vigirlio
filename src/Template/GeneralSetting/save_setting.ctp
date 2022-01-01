<script>
    $(document).ready(function(){	
    
        var box_height = $(".box").height();
        var box_height = box_height + 200 ;
        $(".content-wrapper").css("height",box_height+"px");
    });
    </script>
    <section class="content">
        <br>
        <div class="col-md-12 box box-default">		
            <div class="box-header">
                <section class="content-header">
                  <h1>
                    <?php echo __("Configurações Gerais");?>
                    <small><?php echo __("Definições");?></small>
                  </h1>			
                </section>
            </div>
            <hr>
            <div class="box-body">
            <?php
            
                echo $this->Form->create("settings",["type"=>"file","class"=>"validateForm form-horizontal"]);
                
                echo "<fieldset>";
                echo "<legend>".__('Configurações do sistema')."</legend>";
                echo "<div class='form-group'>";
                echo "<label class='control-label col-md-2'>".__("Nome")."<span class='text-danger'> *</span></label>";
                echo "<div class='col-md-8'>";			
                echo $this->Form->input("",["name"=>"name","class"=>"form-control validate[required]","label"=>false,"value"=> (($edit) ? $data['name'] : "")]);
                echo "</div>";
                echo "</div>";
                
                echo "<div class='form-group'>";
                echo "<label class='control-label col-md-2'>".__("Ano de início")."<span class='text-danger'> *</span></label>";
                echo "<div class='col-md-8'>";	
                echo $this->Form->input("",["label"=>false,"name"=>"start_year","class"=>"form-control validate[required,custom[onlyNumberSp]]","value"=> (($edit) ? $data['start_year'] : "")]);
                echo "</div>";					
                echo "</div>";					
                
                echo "<div class='form-group'>";	
                echo "<label class='control-label col-md-2'>".__("Endereço")."<span class='text-danger'> *</span></label>";
                echo "<div class='col-md-8'>";	
                echo $this->Form->input("",["label"=>false,"name"=>"address","class"=>"form-control validate[required]","label"=>false,"value"=> (($edit) ? $data['address'] : "")]);
                echo "</div>";
                echo "</div>";
                    
                echo "<div class='form-group'>";
                echo "<label class='control-label col-md-2'>".__("Número de telefone")."<span class='text-danger'>*</span></label>";
                echo "<div class='col-md-8'>";
                echo $this->Form->input("",["label"=>false,"name"=>"office_number","class"=>"form-control validate[required,custom[onlyNumberSp]]","label"=>false,"value"=> (($edit) ? $data['office_number'] : "")]);
                echo "</div>";
                echo "</div>";
                
                echo "<div class='form-group'>";
                echo "<label class='control-label col-md-2'>".__("País")."</label>";
                echo "<div class='col-md-8'>";
                ?>
                
                <select id="country" class="form-control" name="country">
                    <?php 
                    foreach($xml as $country)
                    { ?>
                        <option value="<?php echo $country->code;?>" <?php echo ($edit && $data['country'] == $country->code) ? "selected" : ""; ?>><?php echo $country->name;?></option>
              <?php } ?>	
                    </select>
                <?php
                echo "</div>";	
                echo "</div>";	
                
    // 			echo "<div class='form-group'>";
    // 			echo "<label class='control-label col-md-2'>". __("Linguagem do sistema")."</label>";
    // 			echo "<div class='col-md-8'>";
    // 			$sys_language = $this->Gym->getSettings("sys_language");
                
                ?>
                    <?php echo "<input type='hidden' id='s_lang' value='{$sys_language}'>";?>
                    <!--
                    <select id="sys_language" class="form-control" name="sys_language" id="s_lang">
                        <option value="en">English/en</option>
                        <option value="hi">Hindi/hi</option>
                        <option value="ar">Arabic/ar</option>
                        <option value="zh_CN">Chinese/zh-CN</option>
                        <option value="cs">Czech/cs</option>
                        <option value="fr">French/fr</option>
                        <option value="de">German/de</option>
                        <option value="el">Greek/el</option>					
                        <option value="it">Italian/it</option>	
                        <option value="ja">Japan/ja</option>
                        <option value="pl">Polish/pl</option>
                        <option value="pt_BR">Portuguese-BR/pt-BR</option>
                        <option value="pt_PT">Portuguese-PT/pt-PT</option>						
                        <option value="fa">Persian/fa</option>
                        <option value="ru">Russian/ru</option>
                        <option value="es">Spanish/es</option>											
                        <option value="th">Thai/th</option>
                        <option value="tr">Turkish/tr</option>
                        <option value="ca">Catalan/ca</option>
                        <option value="da">Danish/da</option>
                        <option value="et">Estonian/et</option>
                        <option value="fi">Finnish/fi</option>
                        <option value="he">Hebrew (Israel)/he</option>
                        <option value="hr">Croatian/hr</option>
                        <option value="hu">Hungarian/hu</option>
                        <option value="id">Indonesian/id</option>
                        <option value="lt">Lithuanian/lt</option>
                        <option value="nl">Dutch/nl</option>
                        <option value="no">Norwegian/no</option>
                        <option value="ro">Romanian/ro</option>
                        <option value="sv">Swadish/sv</option>
                        <option value="vi">Vietnamese/vi</option>
                    </select>
                    
                    -->
                    
                    <script>
                        var sys_lang = $("#s_lang").val();
                        $("#sys_language option[value="+sys_lang+"]").prop("selected",true);
                    </script>
                <?php
    // 			echo "</div>";
    // 			echo "</div>";
                
                echo "<div class='form-group'>";
                echo "<label class='control-label col-md-2'>".__("Definir idioma para RTL")."</label>";
                echo "<div class='col-md-8 checkbox'><label class='save_enable'>";
                echo $this->Form->checkbox("enable_rtl",["value"=>"1","checked"=>(($edit && $data['enable_rtl'] == true)? true : false)])." ".__("Habilitar");
                echo "</label></div>";
                echo "</div>";	
                
                            echo "<div class='form-group'>";
                echo "<label class='control-label col-md-2'>".__("Email")."<span class='text-danger'>*</span></label>";
                echo "<div class='col-md-8'>";
                echo $this->Form->input("",["label"=>false,"name"=>"email","class"=>"form-control validate[required,custom[email]]","label"=>false,"value"=> (($edit) ? $data['email'] : "")]);
                echo "</div>";	
                echo "</div>";	
                
                echo "<div class='form-group'>";
                echo "<label class='control-label col-md-2'>".__("Formato de data")."</label>";
                echo "<div class='col-md-8'>";				
                
                $format = ["F j, Y"=>date("F j, Y"),"Y-m-d"=>date("Y-m-d"),"m/d/Y"=>date("m/d/Y")];
                
                $default = ($edit && !empty($data['date_format'])) ? [$data['date_format']] : ['yy/mm/dd'];
                echo $this->Form->select("date_format",$format,["default"=>$default,"class"=>"form-control plan_list validate[required]"]);
                echo "</div>";	
                echo "</div>";
                
                
                #########################################################################
                echo "<div class='form-group'>";			
                echo "<label class='control-label col-md-2'>".__("Fuso horário")."</label>";
                echo "<div class='col-md-8'>";	
                $time_zone = ($edit && !empty($data['time_zone'])) ? $data['time_zone'] : date_default_timezone_get();
                ?>
                    <input type="hidden" value="<?php echo $time_zone;?>" id="timezone_val">
                    <select id="timezone-selector" name="time_zone" class="form-control">
                        <?php
                            
                            foreach(timezone_abbreviations_list() as $abbr => $timezone){
                                    foreach($timezone as $val)
                                    {
                                            if(isset($val['timezone_id']))
                                            {
                                                    
                                                $selected = ($val['timezone_id'] == $data['time_zone'])?'selected':'';
                                                echo '<option value="'.$val['timezone_id'].'" '.$selected.'>'.$val['timezone_id'].'</option>';
                                            }
                                    }
                            }
                        ?>
                    </select>
                <?php
                echo "</div>";
                echo "</div>";	
                
                echo "<div class='form-group'>";			
                echo "<label class='control-label col-md-2'>".__("Logotipo")."</label>";
                echo "<div class='col-md-6'>";			
                echo $this->Form->file("",["name"=>"gym_logo","class"=>"form-control"]);
                echo "</div>";
                echo "<div class='col-md-2'>";	
                echo __("(Máx. altura 50px.)");
                echo "</div>";		
                
                echo "</div>";		
                
                $src = ($edit && !empty($data['gym_logo'])) ? $data['gym_logo'] : "logo.png" ; 
                echo "<div class='col-md-offset-2'>";
                echo $this->Form->input("",["type" => "hidden","name"=>"old_gym_logo","class"=>"form-control","value"=>$src]);
                echo "<img src='{$this->request->webroot}webroot/upload/{$src}'><br><br><br>";
                echo "</div>";
                
                echo "<div class='form-group'>";
                echo "<label class='control-label col-md-2'>".__("Imagem de capa")."</label>";
                echo "<div class='col-md-8'>";
                echo $this->Form->file("",["name"=>"cover_image","class"=>"form-control"]);
                echo "</div>";
                echo "</div>";
                
                $src = ($edit && !empty($data['cover_image'])) ? $data['cover_image'] : "cover-image.png" ;
                echo $this->Form->input("",["type" => "hidden","name"=>"old_cover_image","class"=>"form-control","value"=>$src]);
                echo "<img src='{$this->request->webroot}webroot/upload/{$src}' style='max-width: 100%;'>";			
                echo "</fieldset><br><br>";
                
                echo "<fieldset>";
                echo "<legend>".__('Unidades de medida')."</legend>";
                echo "<div class='form-group'>";
                echo "<label class='control-label col-md-2'>".__("Peso")."<span class='text-danger'> *</span></label>";
                echo "<div class='col-md-8'>";			
                echo $this->Form->input("",["label"=>false,"name"=>"weight","class"=>"form-control validate[required,custom[onlyLetterNumber]]","label"=>false,"value"=> (($edit) ? $data['weight'] : "")]);
                echo "</div>";
                echo "</div>";
                
                echo "<div class='form-group'>";
                echo "<label class='control-label col-md-2'>".__("Altura")."<span class='text-danger'> *</span></label>";
                echo "<div class='col-md-8'>";			
                echo $this->Form->input("",["label"=>false,"name"=>"height","class"=>"form-control validate[required,custom[onlyLetterNumber]]","label"=>false,"value"=> (($edit) ? $data['height'] : "")]);
                echo "</div>";
                echo "</div>";
                
                echo "<div class='form-group'>";
                echo "<label class='control-label col-md-2'>".__("Peito")."<span class='text-danger'> *</span></label>";
                echo "<div class='col-md-8'>";				
                echo $this->Form->input("",["label"=>false,"name"=>"chest","class"=>"form-control validate[required,custom[onlyLetterNumber]]","label"=>false,"value"=> (($edit) ? $data['chest'] : "")]);
                echo "</div>";
                echo "</div>";
                
                echo "<div class='form-group'>";
                echo "<label class='control-label col-md-2'>".__("Cintura")."<span class='text-danger'> *</span></label>";
                echo "<div class='col-md-8'>";
                echo $this->Form->input("",["label"=>false,"name"=>"waist","class"=>"form-control validate[required,custom[onlyLetterNumber]]","label"=>false,"value"=> (($edit) ? $data['waist'] : "")]);
                echo "</div>";
                echo "</div>";
                
                echo "<div class='form-group'>";
                echo "<label class='control-label col-md-2'>".__("Panturrilha")."<span class='text-danger'> *</span></label>";
                echo "<div class='col-md-8'>";
                echo $this->Form->input("",["label"=>false,"name"=>"thing","class"=>"form-control validate[required,custom[onlyLetterNumber]]","label"=>false,"value"=> (($edit) ? $data['thing'] : "")]);
                echo "</div>";
                echo "</div>";
                
                echo "<div class='form-group'>";
                echo "<label class='control-label col-md-2'>".__("Braços")."<span class='text-danger'> *</span></label>";
                echo "<div class='col-md-8'>";
                echo $this->Form->input("",["label"=>false,"name"=>"arms","class"=>"form-control validate[required,custom[onlyLetterNumber]]","label"=>false,"value"=> (($edit) ? $data['arms'] : "")]);
                echo "</div>";
                echo "</div>";
                
                echo "<div class='form-group'>";
                echo "<label class='control-label col-md-2'>".__("%Gordura")."<span class='text-danger'> *</span></label>";
                echo "<div class='col-md-8'>";			
                echo $this->Form->input("",["label"=>false,"name"=>"fat","class"=>"form-control validate[required,custom[onlyLetterNumber]]","label"=>false,"value"=> (($edit) ? $data['fat'] : "")]);
                echo "</div>";
                echo "</div>";
                echo "</fieldset><br><br>";
                
                echo "<fieldset>";
                echo "<legend>".__('Configuração de privacidade do membro')."</legend>";
                echo "<div class='form-group'>";
                echo "<label class='control-label col-md-2'>".__("O membro pode ver os detalhes de outros membros")."</label>";
                echo "<div class='col-md-8 checkbox'><label class='radio-inline'>";	
                echo $this->Form->checkbox("member_can_view_other",["value"=>"1","checked"=>(($edit && $data['member_can_view_other'] == true)? true : false)]);
                echo " ". __("Habilitar");
                echo "</label></div></div>";
                
                echo "<div class='form-group'>";
                echo "<label class='control-label col-md-2'>".__("O membro da equipe pode ver os detalhes do próprio membro estagiário")."</label>";
                echo "<div class='col-md-8 checkbox'><label class='radio-inline'>";	
                echo $this->Form->checkbox("staff_can_view_own_member",["value"=>"1","checked"=>(($edit && $data['staff_can_view_own_member'] == true)? true : false)]);
                echo " ". __("Habilitar");
                echo "</label></div></div>";
                
                echo "</fieldset><br><br>";			
                
                echo "<fieldset>";
                echo "<legend>".__('Configuração Paypal')."</legend>";
                echo "<div class='form-group'>";
                echo "<label class='control-label col-md-2'>".__("Habilitar Sandbox")."</label>";
                echo "<div class='col-md-8 checkbox'><label class='radio-inline'>";			
                echo $this->Form->checkbox("enable_sandbox",["value"=>"1","checked"=>(($edit && $data['enable_sandbox'] == true)? true : false)])." ".__("Habilitar");
                echo "</label></div>";
                echo "</div>";
                
                echo "<div class='form-group'>";
                echo "<label class='control-label col-md-2'>".__("Id de Email Paypal")."<span class='text-danger'> *</span></label>";
                echo "<div class='col-md-8'>";	
                echo $this->Form->input("",["label"=>false,"name"=>"paypal_email","class"=>"form-control validate[required]","label"=>false,"value"=>(($edit) ? $data['paypal_email'] : "")]);
                echo "</div>";
                echo "</div>";
                
                echo "<div class='form-group'>";
                echo "<label class='control-label col-md-2'>".__("Escolha a moeda")."<span class='text-danger'> *</span></label>";
                echo "<div class='col-md-8'>";
                
                echo "<select class='form-control' name='currency'>";
                foreach($currency_xml as $curr)
                {?>
                    <option value='<?php echo $curr['@code'];?>' <?php echo($edit && $data['currency'] == $curr['@code']) ? "selected" : "";?>><?php echo $curr["@"];?></option>				
        <?php	}			
                echo "</select>";
                echo "</div>";
                echo "</div>";
                echo "</fieldset><br><br>";	
                
                echo "<fieldset>";
                echo "<legend>".__('Configuração de Stripe')."</legend>";
                
                echo "<div class='form-group'>";
                echo "<label class='control-label col-md-2'>".__("Chave secreta")."<span class='text-danger'> *</span></label>";
                echo "<div class='col-md-8'>";	
                echo $this->Form->input("",["label"=>false,"name"=>"stripe_secret_key","class"=>"form-control validate[required]","label"=>false,"value"=>(($edit) ? $data['stripe_secret_key'] : "")]);
                echo "</div>";
                echo "</div>";
                
                echo "<div class='form-group'>";
                echo "<label class='control-label col-md-2'>".__("Chave publicável")."<span class='text-danger'> *</span></label>";
                echo "<div class='col-md-8'>";	
                echo $this->Form->input("",["label"=>false,"name"=>"stripe_publishable_key","class"=>"form-control validate[required]","label"=>false,"value"=>(($edit) ? $data['stripe_publishable_key'] : "")]);
                echo "</div>";
                echo "</div>";
                echo "</fieldset><br><br>";
    
                echo "<fieldset>";
                echo "<legend>".__('Configuração de mensagem de alerta de sócios')."</legend>";
                echo "<div class='form-group'>";
                echo "<label class='control-label col-md-2'>".__("Habilitar e-mail de alerta")."</label>";
                echo "<div class='col-md-8 checkbox'><label class='radio-inline'>";
                echo $this->Form->checkbox("enable_alert",["value"=>"1","checked"=>(($edit && $data['enable_alert'] == true)? true : false)])." ".__("Habilitar");
                echo "</label></div>";
                echo "</div>";			
                
                echo "<div class='form-group'>";			
                echo "<label class='control-label col-md-2'>".__("Lembrete antes dos dias")."</label>";
                echo "<div class='col-md-8'>";
                echo $this->Form->input("",["label"=>false,"name"=>"reminder_days","class"=>"form-control","value"=>(($edit) ? $data['reminder_days'] : "")]);
                echo "</div>";
                echo "</div>";			
                
                
                echo "<div class='form-group'>";						
                echo "<label class='control-label col-md-2'>".__("Mensagem de Lembrete")."</label>";
                echo "<div class='col-md-8'>";
                echo $this->Form->textarea("",["name"=>"reminder_message","class"=>"form-control","value"=>(($edit) ? $data['reminder_message'] : "")]);
                echo "</div>";			
                echo "</div>";
                
                
        
                echo "<div class='form-group'>";
                echo "<label class='control-label col-md-2'>".__("ShortCodes para mensagem de correio de notificação")."</label>";
                echo "<div class='save_check col-md-8 checkbox'>
                <label class='radio-inline'>";
                echo  "<p>". __("Nome do Membro")." -> GYM_MEMBERNAME<p>";
                echo  "<p>". __("Nome de Filiação")." -> GYM_MEMBERSHIP  <p>";
                echo  "<p>". __("Data de início da associação")." -> GYM_STARTDATE <p>";
                echo  "<p>". __("Data de Término da Associação")." -> GYM_ENDDATE<p>";
                echo "</label></div>";
                echo "</div>";
                
                
                echo "<legend>".__('Configuração De Mensagem De Alerta De Relatório')."</legend>";
                echo "Obs: <p style='color: red;'>Deve ser configurando pelo menos um dia antes do fim do término da associação.</p>";
                
                echo "<div class='form-group'>";			
                echo "<label class='control-label col-md-2'>".__("Lembrar em quantos dias?")."</label>";
                echo "<div class='col-md-8'>";
                echo $this->Form->input("",["label"=>false,"name"=>"dias_alerta","class"=>"form-control","value"=>(($edit) ? $data['dias_alerta'] : "")]);
                echo "</div>";
                echo "</div>";			
                
                
                echo "<div class='form-group'>";						
                echo "<label class='control-label col-md-2'>".__("Conteúdo da mensagem")."</label>";
                echo "<div class='col-md-8'>";
                echo $this->Form->textarea("",["name"=>"mensagem_alerta","class"=>"form-control","value"=>(($edit) ? $data['mensagem_alerta'] : "")]);
                echo "</div>";			
                echo "</div>";
                
                echo "<div class='form-group'>";
                echo "<label class='control-label col-md-2'>".__("ShortCodes para mensagem de correio de notificação")."</label>";
                echo "<div class='save_check col-md-8 checkbox'>
                <label class='radio-inline'>";
                echo  "<p>". __("Nome do membro")." -> GYM_MEMBERNAME<p>";
                echo  "<p>". __("Nome da Filiação")." -> GYM_MEMBERSHIP  <p>";
                echo "</label></div>";
                echo "</div>";
                
                
                echo "</fieldset><br><br>";	
                
                echo "<fieldset>";
                echo "<legend>".__('Configuração de mensagem')."</legend>";
                echo "<div class='form-group'>";
                echo "<label class='control-label col-md-2'>".__("O membro pode enviar mensagens para outros")."</label>";
                echo "<div class='col-md-8 checkbox'><label class='radio-inline'>";			
                echo $this->Form->checkbox("enable_message",["value"=>"1","checked"=>(($edit && $data['enable_message'] == true)? true : false)])." ".__("Habilitar");
                echo "</label></div></div>";
                echo "</fieldset><br><br>";	
    
                echo "<fieldset>";
                echo "<legend>".__('Configuração de Tema')."</legend>";
                echo "<div class='form-group'>";
                echo "<label class='control-label col-md-2'>".__("Cor do menu lateral")."</label>";
                echo "<div class='col-md-8'><label class='radio-inline'>";	
                echo "<input type='color' name='sidemenu_color' value='".$data['sidemenu_color']."'>";
                echo "</label></div></div>";
                echo "<div class='form-group'>";
                echo "<label class='control-label col-md-2'>".__("Cor do cabeçalho")."</label>";
                echo "<div class='col-md-8'><label class='radio-inline'>";			
                echo "<input type='color' name='header_color' value='".$data['header_color']."'>";
                echo "</label></div></div>";
                echo "</fieldset><br><br>";
                
                echo "<fieldset>";
                echo "<legend>".__('Texto do cabeçalho e rodapé')."</legend>";
                echo "<div class='form-group'>";			
                echo "<label class='control-label col-md-2'>".__("Texto do Cabeçalho Esquerdo")."</label>";
                echo "<div class='col-md-8'>";
                echo $this->Form->input("",["label"=>false,"name"=>"left_header","class"=>"form-control","value"=>(($edit) ? $data['left_header'] : "")]);
                echo "</div>";
                echo "</div>";	
                
                echo "<div class='form-group'>";			
                echo "<label class='control-label col-md-2'>".__("Texto de rodapé")."</label>";
                echo "<div class='col-md-8'>";
                echo $this->Form->input("",["label"=>false,"name"=>"footer","class"=>"form-control","value"=>(($edit) ? $data['footer'] : "")]);
                echo "</div>";
                echo "</div>";				
                echo "</fieldset><br><br>";	
                
                echo "<div class='col-md-offset-2'>";
                echo $this->Form->button(__("Salvar configurações"),['class'=>"btn btn-flat btn-success","name"=>"save_setting"]);
                echo "</div>";
                echo $this->Form->end();
                
            ?>	
            </div>	
            <div class="overlay gym-overlay">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div>
    </section>
    