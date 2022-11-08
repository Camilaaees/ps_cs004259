<?php

date_default_timezone_set(TIMEZONE);

/**
 * CONTROLE DE FLUXO DE LOG
 */

 error_reporting(E_ALL); //que tipo de erro deve ser exibido
 ini_set('display_errors', DISPLAY_ERRORS); //o usuário vê os erros
 ini_set('log_errors', 1); //devo logar os erros?

 //definir o arquivo que armazenará os erros de log

 ini_set('error_log', PATH_PROJETO . 'log/error-'.date('Y').'-'.date('m').'.txt');