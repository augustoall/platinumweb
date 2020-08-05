<?php

class Crud {

    private $pdo = null;
    private $tabela = null;
    public static $instance;

    private function __construct($tabela = NULL) {
        $this->pdo = ConPDO::getInstance();
        if (!empty($tabela))
            $this->tabela = $tabela;
    }

    static public function getInstance($tabela = NULL) {
        if (!isset(self::$instance))
            self::$instance = new Crud($tabela);
        return self::$instance;
    }

    public function setTableName($tabela) {
        if (!empty($tabela)) {
            $this->tabela = $tabela;
        }
    }

    private function buildInsert($arrayDados) {
        $sql = "";
        $campos = "";
        $valores = "";
        foreach ($arrayDados as $chave => $valor):
            $campos .= $chave . ', ';
            $valores .= '?, ';
        endforeach;
        $campos = (substr($campos, -2) == ', ') ? trim(substr($campos, 0, (strlen($campos) - 2))) : $campos;
        $valores = (substr($valores, -2) == ', ') ? trim(substr($valores, 0, (strlen($valores) - 2))) : $valores;
        $sql .= "INSERT INTO {$this->tabela} (" . $campos . ")VALUES(" . $valores . ")";
        return trim($sql);
    }

    private function buildUpdate($arrayDados, $arrayCondicao) {

        $sql = "";
        $valCampos = "";
        $valCondicao = "";

        foreach ($arrayDados as $chave => $valor):
            $valCampos .= $chave . '=?, ';
        endforeach;

        foreach ($arrayCondicao as $chave => $valor):
            $valCondicao .= $chave . '? AND ';
        endforeach;

        $valCampos = (substr($valCampos, -2) == ', ') ? trim(substr($valCampos, 0, (strlen($valCampos) - 2))) : $valCampos;
        $valCondicao = (substr($valCondicao, -4) == 'AND ') ? trim(substr($valCondicao, 0, (strlen($valCondicao) - 4))) : $valCondicao;
        $sql .= "UPDATE {$this->tabela} SET " . $valCampos . " WHERE " . $valCondicao;
        return trim($sql);
    }
    
    

    private function buildDelete($arrayCondicao) {

        $sql = "";
        $valCampos = "";

        foreach ($arrayCondicao as $chave => $valor):
            $valCampos .= $chave . '? AND ';
        endforeach;

        $valCampos = (substr($valCampos, -4) == 'AND ') ? trim(substr($valCampos, 0, (strlen($valCampos) - 4))) : $valCampos;
        $sql .= "DELETE FROM {$this->tabela} WHERE " . $valCampos;
        return trim($sql);
    }

    public function insert($data) {
        try {
            $sql = $this->buildInsert($data);
            $stm = $this->pdo->prepare($sql);
            $cont = 1;
            foreach ($data as $valor):
                $stm->bindValue($cont, $valor);
                $cont++;
            endforeach;

            $retorno = $stm->execute();
            return $retorno;
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    public function update($data, $arrayCondicao) {
        try {

            $sql = $this->buildUpdate($data, $arrayCondicao);
            //echo $sql;
            $stm = $this->pdo->prepare($sql);
            $cont = 1;
            foreach ($data as $valor):
                $stm->bindValue($cont, $valor);
                $cont++;
            endforeach;
            foreach ($arrayCondicao as $valor):
                $stm->bindValue($cont, $valor);
                $cont++;
            endforeach;
            $retorno = $stm->execute();
            return $retorno;
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    public function delete($condicao) {
        try {
            $sql = $this->buildDelete($condicao);
            $stm = $this->pdo->prepare($sql);
            $cont = 1;
            foreach ($condicao as $valor):
                $stm->bindValue($cont, $valor);
                $cont++;
            endforeach;
            $retorno = $stm->execute();
            return $retorno;
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    public function getSQLGeneric($sql, $arrayParams = null, $fetchAll = TRUE) {
        try {
            $stm = $this->pdo->prepare($sql);
            if (!empty($arrayParams)):
                $cont = 1;
                foreach ($arrayParams as $valor):
                    $stm->bindValue($cont, $valor);
                    $cont++;
                endforeach;
            endif;
            $stm->execute();
            if ($fetchAll):
                $dados = $stm->fetchAll(PDO::FETCH_OBJ);
            else:
                $dados = $stm->fetch(PDO::FETCH_OBJ);
            endif;
            return $dados;
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

}
