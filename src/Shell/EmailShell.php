<?php

namespace App\Shell;

use Cake\Console\Shell;
use Cake\I18n\Time;
use Cake\Mailer\Email;
use Cake\Routing\Router;

class EmailShell extends Shell
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('GymMember');
        $this->loadModel('GeneralSetting');
    }

    public function main()
    {
        $this->alertaSocios();
        $this->alertaRelatorio();
    }

    public function alertaSocios()
    {
        $membros = $this->GymMember->find('all')->where(['role_name' => 'member'])->toArray();
        $configs = $this->GeneralSetting->find('all')->first();

        $dias_lembrete_socios = $configs->reminder_days;

        $now = Time::now();
        $mes_atual = $now->month;
        $ano_atual = $now->year;

        foreach ($membros as $membro) {
            $data_enviado = is_null($membro->alert_send_date) ? NULL : new Time($membro->alert_send_date);
            $mes_enviado = is_null($data_enviado) ? NULL : $data_enviado->month;

            $data_criado = new Time($membro->created_date);
            $dia_criado = $data_criado->day;
            $data_referencia = new Time($ano_atual  . '-' . $mes_atual . '-' . $data_criado->day);
            $data_referencia = $data_referencia->modify('-' . $dias_lembrete_socios . 'days');

            if ($data_referencia->isToday()) {

                $url = Router::url('/', true);
                $logo = $configs->gym_logo;
                $logo = (!empty($logo)) ? "/webroot/upload/" . $logo : "Thumbnail-img.png";
                $sys_name = $configs->name;
                $sys_email = $configs->email;

                $this->loadModel('Membership');

                $membership = $this->Membership->get($membro->selected_membership);

                $pre_texto = str_replace('GYM_MEMBERNAME', $membro->first_name, $configs->reminder_message);
                $pre_texto = str_replace('GYM_MEMBERSHIP', $membership->membership_label, $pre_texto);
                $pre_texto = str_replace('GYM_STARTDATE', $membro->membership_valid_from, $pre_texto);
                $pre_texto = str_replace('GYM_ENDDATE', $membro->membership_valid_to, $pre_texto);

                $message = '<p style="vertical-align: middle;font-size: 20px;color: #fff;font-weight: 700;display:block;background: #000;font-size: 16px;">
            <img src="' . $url . $logo . '" alt="' . $sys_name . '" height="100" style="display: inline-block;vertical-align: middle;"> ' . $sys_name . '</p>';
                $message .= $pre_texto;

                $email = new Email('default');
                $email->from([$sys_email => $sys_name]);
                $email->emailFormat('html');
                $email->subject("Alerta de Sócios Mensal | " . $sys_name);
                $email->to($membro->email);
                $email->send($message); //Here

            }
        }
    }

    public function alertaRelatorio()
    {
        $membros = $this->GymMember->find('all')->where(['role_name' => 'member'])->toArray();
        $configs = $this->GeneralSetting->find('all')->first();

        $dias_lembrete_relatorio = $configs->dias_alerta;

        $now = Time::now();
        $mes_atual = $now->month;
        $ano_atual = $now->year;

        foreach ($membros as $membro) {
            $data_enviado = is_null($membro->alert_send_date) ? NULL : new Time($membro->alert_send_date);
            $mes_enviado = is_null($data_enviado) ? NULL : $data_enviado->month;

            $data_criado = new Time($membro->created_date);
            $dia_criado = $data_criado->day;
            $data_referencia = new Time($ano_atual  . '-' . $mes_atual . '-' . $data_criado->day);
            $data_referencia = $data_referencia->modify('-' . $dias_lembrete_relatorio . 'days');

            if ($data_referencia->isToday()) {

                $url = Router::url('/', true);
                $logo = $configs->gym_logo;
                $logo = (!empty($logo)) ? "/webroot/upload/" . $logo : "Thumbnail-img.png";
                $sys_name = $configs->name;
                $sys_email = $configs->email;

                $this->loadModel('Membership');


                $membership = $this->Membership->get($membro->selected_membership);

                $pre_texto = str_replace('GYM_MEMBERNAME', $membro->first_name, $configs->mensagem_alerta);
                $pre_texto = str_replace('GYM_MEMBERSHIP', $membership->membership_label, $pre_texto);
                $pre_texto = str_replace('GYM_STARTDATE', $membro->membership_valid_from, $pre_texto);
                $pre_texto = str_replace('GYM_ENDDATE', $membro->membership_valid_to, $pre_texto);

                $message = '<p style="vertical-align: middle;font-size: 20px;color: #fff;font-weight: 700;display:block;background: #000;font-size: 16px;">
            <img src="' . $url . $logo . '" alt="' . $sys_name . '" height="100" style="display: inline-block;vertical-align: middle;"> ' . $sys_name . '</p>';
                $message .= $pre_texto;

                $email = new Email('default');
                $email->from([$sys_email => $sys_name]);
                $email->emailFormat('html');
                $email->subject("Alerta de Relatório Mensal | " . $sys_name);
                $email->to($membro->email);
                $email->send($message); //Here
            }
        }
    }
}
