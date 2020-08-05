<?php

class Util {

    static public function verifica_sessao() {
        session_start();
        $ultimo_acesso = $_SESSION["ultimoAcesso"];
        date_default_timezone_set('America/Sao_Paulo');
        $agora = date("Y-n-j H:i:s");
        $TEMPO_TRANSCORRIDO = (strtotime($agora) - strtotime($ultimo_acesso));
        if ($TEMPO_TRANSCORRIDO >= $_SESSION["TEMPO_DA_SESSAO"]) {
            unset($_SESSION["ultimoAcesso"]);
            unset($_SESSION["usu_id"]);
            unset($_SESSION["usu_nome"]);
            unset($_SESSION["usu_usuario"]);
            unset($_SESSION["usu_email"]);
            unset($_SESSION["nivel"]);
            unset($_SESSION["usu_email"]);
            unset($_SESSION["usu_data_registro"]);
            unset($_SESSION["usu_data_expira"]);
            unset($_SESSION["usu_data_cad"]);
            unset($_SESSION["days"]);
            session_destroy();
            return false;
        } else {
            return true;
            $_SESSION["ultimoAcesso"] = $agora;
        }
    }

    static public function retorna_diferenca_2_datas($data_inicial, $data_final) {
        $time_inicial = strtotime(self::format_AAAA_MM_DD($data_inicial));
        $time_final = strtotime(self::format_AAAA_MM_DD($data_final));
        $diferenca = $time_final - $time_inicial;
        $dias = (int) floor($diferenca / (60 * 60 * 24));
        return $dias;
    }

    static public function format_DD_MM_AAAA($dt_USA) {
        list($ano, $mes, $dia) = explode('-', $dt_USA);
        $data_brasil = $dia . "/" . $mes . "/" . $ano;
        return $data_brasil;
    }

    static public function format_DD_MM_AAAA_HHMMSS($dt_USA) {
        return date('d/m/Y H:i:s', strtotime($dt_USA));
    }

    static public function format_AAAA_MM_DD($dt_BR) {
        list($dia, $mes, $ano) = explode('/', $dt_BR);
        $data_americana = $ano . "-" . $mes . "-" . $dia;
        return $data_americana;
    }

    static public function getErrorPDOException(PDOException $e, $tabela, $tabela_references, $primary_key, $ID_CPF_EMPRESA, $link) {
        $log = new LogInstance();
        if (isset($e->errorInfo[1]) && $e->errorInfo[1] == '1451') {
            $log->c_inserir_log($tabela, 'ERRO AO EXCLUIR O ' . $tabela . '  [' . $primary_key . '] - [CODIGO-DO-ERRO]->' . $e->errorInfo[1] . '<br> CAUSA : outras tabelas estão usando este registro de código [' . $primary_key . '] por isso foi impossível a exclusão. <br> LINK : <a target="_blank" href="' . $link . '" > ' . $link . ' </a>', $_SESSION["usu_numerocelular"], $_SESSION["usu_codigo"], date("Y-n-j H:i:s"), $_SESSION["usu_email"], $ID_CPF_EMPRESA);
        } else {
            $log->c_inserir_log($e->getMessage(), $_SESSION["usu_numerocelular"], $_SESSION["usu_codigo"], date('Y-m-d'), $_SESSION["usu_email"], $ID_CPF_EMPRESA);
        }
    }

    static public function geraChaveDeLicenca($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false) {

        // Gera uma senha com 10 carecteres: letras (min e mai), números
        $lmin = 'abcdefghijklmnpqrstuvwxyz';
        $lmai = 'ABCDEFGHIJKLMNPQRSTUVWXYZ';
        $num = '123456789';
        $simb = '@#%';
        $retorno = '';
        $caracteres = '';
        $caracteres .= $lmin;
        if ($maiusculas)
            $caracteres .= $lmai;
        if ($numeros)
            $caracteres .= $num;
        if ($simbolos)
            $caracteres .= $simb;

        $len = strlen($caracteres);

        for ($n = 1; $n <= $tamanho; $n++) {
            $rand = mt_rand(1, $len);
            $retorno .= $caracteres[$rand - 1];
        }
        return $retorno;
    }

    static public function remover_letra_acentuada($string, $maiuscula = false) {
        $tr = strtr(
                $string, array(
            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A',
            'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E',
            'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ð' => 'D', 'Ñ' => 'N',
            'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O',
            'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Ŕ' => 'R',
            'Þ' => 's', 'ß' => 'B', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a',
            'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e',
            'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
            'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
            'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y',
            'þ' => 'b', 'ÿ' => 'y', 'ŕ' => 'r'
                )
        );

        if ($maiuscula) {
            return strtoupper($tr);
        } else {
            return strtolower($tr);
        }
    }

    static public function verifica_dias_acesso(EmpresaBean $empresa) {
        $dias = 0;
        $time_inicial = strtotime($empresa->getEmp_inicio());
        $time_final = strtotime($empresa->getEmp_fim());
        $diferenca = $time_final - $time_inicial;
        $dias = (int) floor($diferenca / (60 * 60 * 24));
        return $dias;
    }

}

?>
