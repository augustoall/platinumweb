<?php

class VendacDao {

    public static $instance;

    public function __construct() {
        
    }

    static public function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new VendacDao ();
        return self::$instance;
    }

    function m_recebe_venda_do_android(VendacBean $vendac) {

        try {

            $sql = "INSERT INTO vendac (ID_CPF_EMPRESA, vendac_chave, vendac_datahoravenda, vendac_previsao_entrega, vendac_usu_codigo, vendac_usu_nome, vendac_cli_codigo, vendac_cli_nome, vendac_fpgto_codigo, vendac_fpgto_tipo, vendac_valor, vendac_peso_total, vendac_observacao, vendac_enviada, vendac_latitude, vendac_longitude) 
                VALUES
                (:ID_CPF_EMPRESA, :vendac_chave, :vendac_datahoravenda, :vendac_previsao_entrega, :vendac_usu_codigo, :vendac_usu_nome, :vendac_cli_codigo, :vendac_cli_nome, :vendac_fpgto_codigo, :vendac_fpgto_tipo, :vendac_valor, :vendac_peso_total, :vendac_observacao, :vendac_enviada, :vendac_latitude, :vendac_longitude);";


            $statement_sql = ConPDO::getInstance()->prepare($sql);

            $statement_sql->bindValue(":ID_CPF_EMPRESA", $vendac->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":vendac_chave", $vendac->getVendac_chave());
            $statement_sql->bindValue(":vendac_datahoravenda", $vendac->getVendac_datahoravenda());

            $statement_sql->bindValue(":vendac_previsao_entrega", $vendac->getVendac_previsao_entrega());
            $statement_sql->bindValue(":vendac_usu_codigo", $vendac->getVendac_usu_codigo());
            $statement_sql->bindValue(":vendac_usu_nome", $vendac->getVendac_usu_nome());

            $statement_sql->bindValue(":vendac_cli_codigo", $vendac->getVendac_cli_codigo());
            $statement_sql->bindValue(":vendac_cli_nome", $vendac->getVendac_cli_nome());
            $statement_sql->bindValue(":vendac_fpgto_codigo", $vendac->getVendac_fpgto_codigo());

            $statement_sql->bindValue(":vendac_fpgto_tipo", $vendac->getVendac_fpgto_tipo());
            $statement_sql->bindValue(":vendac_valor", $vendac->getVendac_valor());
            $statement_sql->bindValue(":vendac_peso_total", $vendac->getVendac_peso_total());

            $statement_sql->bindValue(":vendac_observacao", $vendac->getVendac_observacao());
            $statement_sql->bindValue(":vendac_enviada", $vendac->getVendac_enviada());
            $statement_sql->bindValue(":vendac_latitude", $vendac->getVendac_latitude());

            $statement_sql->bindValue(":vendac_longitude", $vendac->getVendac_longitude());

            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_inserir_vendac :: " . $e->getMessage();
        }
    }

    public function m_buscar_todas_vendasc(VendacBean $vendac) {

        try {


            $sql = "select * from vendac where ID_CPF_EMPRESA = :ID_CPF_EMPRESA order by vendac_datahoravenda desc,vendac_fpgto_tipo ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $vendac->getID_CPF_EMPRESA());
            $statement_sql->execute();


            if ($statement_sql) {
                $ven = array();


                while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {

                    $vendac = new VendacBean();

                    $vendac->setID_CPF_EMPRESA($linha->ID_CPF_EMPRESA);
                    $vendac->setVendac_chave($linha->vendac_chave);
                    $vendac->setVendac_datahoravenda($linha->vendac_datahoravenda);

                    $vendac->setVendac_previsao_entrega($linha->vendac_previsao_entrega);
                    $vendac->setVendac_usu_codigo($linha->vendac_usu_codigo);
                    $vendac->setVendac_usu_nome($linha->vendac_usu_nome);

                    $vendac->setVendac_cli_codigo($linha->vendac_cli_codigo);
                    $vendac->setVendac_cli_nome($linha->vendac_cli_nome);
                    $vendac->setVendac_fpgto_codigo($linha->vendac_fpgto_codigo);

                    $vendac->setVendac_fpgto_tipo($linha->vendac_fpgto_tipo);
                    $vendac->setVendac_valor($linha->vendac_valor);
                    $vendac->setVendac_peso_total($linha->vendac_peso_total);

                    $vendac->setVendac_observacao($linha->vendac_observacao);
                    $vendac->setVendac_enviada($linha->vendac_enviada);
                    $vendac->setVendac_latitude($linha->vendac_latitude);
                    $vendac->setVendac_longitude($linha->vendac_longitude);

                    $ven[] = $vendac;
                }
            }

            return $ven;
        } catch (PDOException $e) {
            print "Erro em m_buscar_todas_vendasc :: " . $e->getMessage();
        }
    }

    public function m_buscar_apenas_vendas_vendedor(VendacBean $vendac) {

        try {


            $sql = "select * from vendac where ID_CPF_EMPRESA = :ID_CPF_EMPRESA and vendac_usu_codigo= :vendac_usu_codigo   order by vendac_datahoravenda desc,vendac_fpgto_tipo ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $vendac->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":vendac_usu_codigo", $vendac->getVendac_usu_codigo());
            $statement_sql->execute();


            if ($statement_sql) {
                $ven = array();


                while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {

                    $vendac = new VendacBean();

                    $vendac->setID_CPF_EMPRESA($linha->ID_CPF_EMPRESA);
                    $vendac->setVendac_chave($linha->vendac_chave);
                    $vendac->setVendac_datahoravenda($linha->vendac_datahoravenda);

                    $vendac->setVendac_previsao_entrega($linha->vendac_previsao_entrega);
                    $vendac->setVendac_usu_codigo($linha->vendac_usu_codigo);
                    $vendac->setVendac_usu_nome($linha->vendac_usu_nome);

                    $vendac->setVendac_cli_codigo($linha->vendac_cli_codigo);
                    $vendac->setVendac_cli_nome($linha->vendac_cli_nome);
                    $vendac->setVendac_fpgto_codigo($linha->vendac_fpgto_codigo);

                    $vendac->setVendac_fpgto_tipo($linha->vendac_fpgto_tipo);
                    $vendac->setVendac_valor($linha->vendac_valor);
                    $vendac->setVendac_peso_total($linha->vendac_peso_total);

                    $vendac->setVendac_observacao($linha->vendac_observacao);
                    $vendac->setVendac_enviada($linha->vendac_enviada);
                    $vendac->setVendac_latitude($linha->vendac_latitude);
                    $vendac->setVendac_longitude($linha->vendac_longitude);

                    $ven[] = $vendac;
                }
            }

            return $ven;
        } catch (PDOException $e) {
            print "Erro em m_buscar_todas_vendasc :: " . $e->getMessage();
        }
    }

    public function m_busca_vendac_por_vendac_chave_para_diretor(VendacBean $vendac) {
        try {

            $sql = "SELECT * FROM vendac where vendac_chave = :vendac_chave";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":vendac_chave", $vendac->getVendac_chave());
            $statement_sql->execute();
            $stmt = $statement_sql->fetch(PDO::FETCH_ASSOC);
            $vendac = new VendacBean();

            $vendac->setID_CPF_EMPRESA($stmt["ID_CPF_EMPRESA"]);
            $vendac->setVendac_chave($stmt["vendac_chave"]);
            $vendac->setVendac_datahoravenda($stmt["vendac_datahoravenda"]);
            $vendac->setVendac_previsao_entrega($stmt["vendac_previsao_entrega"]);
            $vendac->setVendac_usu_codigo($stmt["vendac_usu_codigo"]);
            $vendac->setVendac_usu_nome($stmt["vendac_usu_nome"]);
            $vendac->setVendac_cli_codigo($stmt["vendac_cli_codigo"]);
            $vendac->setVendac_cli_nome($stmt["vendac_cli_nome"]);
            $vendac->setVendac_fpgto_codigo($stmt["vendac_fpgto_codigo"]);
            $vendac->setVendac_fpgto_tipo($stmt["vendac_fpgto_tipo"]);
            $vendac->setVendac_valor($stmt["vendac_valor"]);
            $vendac->setVendac_peso_total($stmt["vendac_peso_total"]);
            $vendac->setVendac_observacao($stmt["vendac_observacao"]);
            $vendac->setVendac_enviada($stmt["vendac_enviada"]);
            $vendac->setVendac_latitude($stmt["vendac_latitude"]);
            $vendac->setVendac_longitude($stmt["vendac_longitude"]);
            return $vendac;
        } catch (PDOException $e) {
            print "[[[   Erro em m_busca_cheque_por_vendac_chave :: " . $e->getMessage() . "   ]]]";
        }
    }

    public function m_busca_vendac_por_vendac_chave(VendacBean $vendac) {
        try {

            $sql = "SELECT 
                    vnc.vendac_id,
                    vnc.ID_CPF_EMPRESA,
                    vnc.vendac_chave, 
                    vnc.vendac_datahoravenda, 
                    vnc.vendac_previsao_entrega, 
                    vnc.vendac_usu_codigo, 
                    user.usu_nome as vendac_usu_nome,
                    vnc.vendac_cli_codigo, 
                    vnc.vendac_cli_nome, 
                    vnc.vendac_fpgto_codigo, 
                    vnc.vendac_fpgto_tipo, 
                    vnc.vendac_valor, 
                    vnc.vendac_peso_total, 
                    vnc.vendac_observacao, 
                    vnc.vendac_enviada, 
                    vnc.vendac_latitude, 
                    vnc.vendac_longitude
                    FROM vendac vnc
                    left outer join usuarios user
                    on user.usu_codigo =  vnc.vendac_usu_codigo where vnc.ID_CPF_EMPRESA=:ID_CPF_EMPRESA and vnc.vendac_chave = :vendac_chave";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $vendac->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":vendac_chave", $vendac->getVendac_chave());
            $statement_sql->execute();
            $stmt = $statement_sql->fetch(PDO::FETCH_ASSOC);
            $vendac = new VendacBean();

            $vendac->setID_CPF_EMPRESA($stmt["ID_CPF_EMPRESA"]);
            $vendac->setVendac_chave($stmt["vendac_chave"]);
            $vendac->setVendac_datahoravenda($stmt["vendac_datahoravenda"]);
            $vendac->setVendac_previsao_entrega($stmt["vendac_previsao_entrega"]);
            $vendac->setVendac_usu_codigo($stmt["vendac_usu_codigo"]);
            $vendac->setVendac_usu_nome($stmt["vendac_usu_nome"]);
            $vendac->setVendac_cli_codigo($stmt["vendac_cli_codigo"]);
            $vendac->setVendac_cli_nome($stmt["vendac_cli_nome"]);
            $vendac->setVendac_fpgto_codigo($stmt["vendac_fpgto_codigo"]);
            $vendac->setVendac_fpgto_tipo($stmt["vendac_fpgto_tipo"]);
            $vendac->setVendac_valor($stmt["vendac_valor"]);
            $vendac->setVendac_peso_total($stmt["vendac_peso_total"]);
            $vendac->setVendac_observacao($stmt["vendac_observacao"]);
            $vendac->setVendac_enviada($stmt["vendac_enviada"]);
            $vendac->setVendac_latitude($stmt["vendac_latitude"]);
            $vendac->setVendac_longitude($stmt["vendac_longitude"]);
            return $vendac;
        } catch (PDOException $e) {
            print "[[[   Erro em m_busca_cheque_por_vendac_chave :: " . $e->getMessage() . "   ]]]";
        }
    }

    // BUSCA VENDAS POR CLIENTE
    public function m_busca_vendac_por_cli_codigo_e_data_between(VendacBean $vendac, $data_inicial, $datafinal) {
        try {

            $sql = "SELECT * FROM vendac where ID_CPF_EMPRESA=:ID_CPF_EMPRESA and vendac_cli_codigo = :vendac_cli_codigo and vendac_datahoravenda between  '$data_inicial' and '$datafinal' ";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $vendac->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":vendac_cli_codigo", $vendac->getVendac_cli_codigo());
            $statement_sql->execute();

            if ($statement_sql) {
                $ven = array();
                while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                    $vendac = new VendacBean();
                    $vendac->setID_CPF_EMPRESA($linha->ID_CPF_EMPRESA);
                    $vendac->setVendac_chave($linha->vendac_chave);
                    $vendac->setVendac_datahoravenda($linha->vendac_datahoravenda);
                    $vendac->setVendac_previsao_entrega($linha->vendac_previsao_entrega);
                    $vendac->setVendac_usu_codigo($linha->vendac_usu_codigo);
                    $vendac->setVendac_usu_nome($linha->vendac_usu_nome);
                    $vendac->setVendac_cli_codigo($linha->vendac_cli_codigo);
                    $vendac->setVendac_cli_nome($linha->vendac_cli_nome);
                    $vendac->setVendac_fpgto_codigo($linha->vendac_fpgto_codigo);
                    $vendac->setVendac_fpgto_tipo($linha->vendac_fpgto_tipo);
                    $vendac->setVendac_valor($linha->vendac_valor);
                    $vendac->setVendac_peso_total($linha->vendac_peso_total);
                    $vendac->setVendac_observacao($linha->vendac_observacao);
                    $vendac->setVendac_enviada($linha->vendac_enviada);
                    $vendac->setVendac_latitude($linha->vendac_latitude);
                    $vendac->setVendac_longitude($linha->vendac_longitude);
                    $ven[] = $vendac;
                }
            }

            return $ven;
        } catch (PDOException $e) {
            print "[[[   Erro em m_busca_vendac_por_cli_codigo :: " . $e->getMessage() . "   ]]]";
        }
    }

    // BUSCA VENDAS POR VENDEDOR
    public function m_busca_vendac_por_usu_codigo_e_data_between(VendacBean $vendac, $data_inicial, $datafinal) {
        try {

            $sql = "SELECT * FROM vendac where ID_CPF_EMPRESA=:ID_CPF_EMPRESA and vendac_usu_codigo = :vendac_usu_codigo and vendac_datahoravenda between  '$data_inicial' and '$datafinal' order by vendac_datahoravenda DESC ";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $vendac->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":vendac_usu_codigo", $vendac->getVendac_usu_codigo());
            $statement_sql->execute();

            if ($statement_sql) {
                $ven = array();
                while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                    $vendac = new VendacBean();
                    $vendac->setID_CPF_EMPRESA($linha->ID_CPF_EMPRESA);
                    $vendac->setVendac_chave($linha->vendac_chave);
                    $vendac->setVendac_datahoravenda($linha->vendac_datahoravenda);
                    $vendac->setVendac_previsao_entrega($linha->vendac_previsao_entrega);
                    $vendac->setVendac_usu_codigo($linha->vendac_usu_codigo);
                    $vendac->setVendac_usu_nome($linha->vendac_usu_nome);
                    $vendac->setVendac_cli_codigo($linha->vendac_cli_codigo);
                    $vendac->setVendac_cli_nome($linha->vendac_cli_nome);
                    $vendac->setVendac_fpgto_codigo($linha->vendac_fpgto_codigo);
                    $vendac->setVendac_fpgto_tipo($linha->vendac_fpgto_tipo);
                    $vendac->setVendac_valor($linha->vendac_valor);
                    $vendac->setVendac_peso_total($linha->vendac_peso_total);
                    $vendac->setVendac_observacao($linha->vendac_observacao);
                    $vendac->setVendac_enviada($linha->vendac_enviada);
                    $vendac->setVendac_latitude($linha->vendac_latitude);
                    $vendac->setVendac_longitude($linha->vendac_longitude);
                    $ven[] = $vendac;
                }
            }

            return $ven;
        } catch (PDOException $e) {
            print "[[[   Erro em m_busca_vendac_por_usu_codigo_e_data_between :: " . $e->getMessage() . "   ]]]";
        }
    }

    public function m_conta_vendas_do_dia($ID_CPF_EMPRESA, $data_inicial, $datafinal) {
        try {

            $sql = "SELECT * FROM vendac where ID_CPF_EMPRESA=:ID_CPF_EMPRESA and vendac_datahoravenda between  '$data_inicial 00:00:00' and '$datafinal 23:59:00' ";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $ID_CPF_EMPRESA);

            // echo $sql;

            $statement_sql->execute();

            if ($statement_sql) {
                $ven = array();
                while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                    $vendac = new VendacBean();
                    $vendac->setID_CPF_EMPRESA($linha->ID_CPF_EMPRESA);
                    $vendac->setVendac_chave($linha->vendac_chave);
                    $vendac->setVendac_datahoravenda($linha->vendac_datahoravenda);
                    $vendac->setVendac_previsao_entrega($linha->vendac_previsao_entrega);
                    $vendac->setVendac_usu_codigo($linha->vendac_usu_codigo);
                    $vendac->setVendac_usu_nome($linha->vendac_usu_nome);
                    $vendac->setVendac_cli_codigo($linha->vendac_cli_codigo);
                    $vendac->setVendac_cli_nome($linha->vendac_cli_nome);
                    $vendac->setVendac_fpgto_codigo($linha->vendac_fpgto_codigo);
                    $vendac->setVendac_fpgto_tipo($linha->vendac_fpgto_tipo);
                    $vendac->setVendac_valor($linha->vendac_valor);
                    $vendac->setVendac_peso_total($linha->vendac_peso_total);
                    $vendac->setVendac_observacao($linha->vendac_observacao);
                    $vendac->setVendac_enviada($linha->vendac_enviada);
                    $vendac->setVendac_latitude($linha->vendac_latitude);
                    $vendac->setVendac_longitude($linha->vendac_longitude);
                    $ven[] = $vendac;
                }
            }

            return $ven;
        } catch (PDOException $e) {
            print "[[[   Erro em m_busca_vendac_por_cli_codigo :: " . $e->getMessage() . "   ]]]";
        }
    }

    public function m_busca_vendac_por_periodo($ID_CPF_EMPRESA, $data_inicial, $datafinal) {
        try {

            $sql = "SELECT * FROM vendac where ID_CPF_EMPRESA=:ID_CPF_EMPRESA and vendac_datahoravenda between  '$data_inicial' and '$datafinal' order by vendac_datahoravenda DESC ";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $ID_CPF_EMPRESA);

            //echo $sql;

            $statement_sql->execute();

            if ($statement_sql) {
                $ven = array();
                while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                    $vendac = new VendacBean();
                    $vendac->setID_CPF_EMPRESA($linha->ID_CPF_EMPRESA);
                    $vendac->setVendac_chave($linha->vendac_chave);
                    $vendac->setVendac_datahoravenda($linha->vendac_datahoravenda);
                    $vendac->setVendac_previsao_entrega($linha->vendac_previsao_entrega);
                    $vendac->setVendac_usu_codigo($linha->vendac_usu_codigo);
                    $vendac->setVendac_usu_nome($linha->vendac_usu_nome);
                    $vendac->setVendac_cli_codigo($linha->vendac_cli_codigo);
                    $vendac->setVendac_cli_nome($linha->vendac_cli_nome);
                    $vendac->setVendac_fpgto_codigo($linha->vendac_fpgto_codigo);
                    $vendac->setVendac_fpgto_tipo($linha->vendac_fpgto_tipo);
                    $vendac->setVendac_valor($linha->vendac_valor);
                    $vendac->setVendac_peso_total($linha->vendac_peso_total);
                    $vendac->setVendac_observacao($linha->vendac_observacao);
                    $vendac->setVendac_enviada($linha->vendac_enviada);
                    $vendac->setVendac_latitude($linha->vendac_latitude);
                    $vendac->setVendac_longitude($linha->vendac_longitude);
                    $ven[] = $vendac;
                }
            }

            return $ven;
        } catch (PDOException $e) {
            print "[[[   Erro em m_busca_vendac_por_cli_codigo :: " . $e->getMessage() . "   ]]]";
        }
    }

    public function m_busca_vendas_do_vendedor_por_periodo(VendacBean $vendac, $data_inicial, $datafinal) {
        try {

            $sql = "SELECT * FROM vendac where ID_CPF_EMPRESA=:ID_CPF_EMPRESA and vendac_usu_codigo = :vendac_usu_codigo and vendac_datahoravenda between  '$data_inicial' and '$datafinal' order by vendac_datahoravenda DESC ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $vendac->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":vendac_usu_codigo", $vendac->getVendac_usu_codigo());
            $statement_sql->execute();

            if ($statement_sql) {
                $ven = array();
                while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                    $vendac = new VendacBean();
                    $vendac->setID_CPF_EMPRESA($linha->ID_CPF_EMPRESA);
                    $vendac->setVendac_chave($linha->vendac_chave);
                    $vendac->setVendac_datahoravenda($linha->vendac_datahoravenda);
                    $vendac->setVendac_previsao_entrega($linha->vendac_previsao_entrega);
                    $vendac->setVendac_usu_codigo($linha->vendac_usu_codigo);
                    $vendac->setVendac_usu_nome($linha->vendac_usu_nome);
                    $vendac->setVendac_cli_codigo($linha->vendac_cli_codigo);
                    $vendac->setVendac_cli_nome($linha->vendac_cli_nome);
                    $vendac->setVendac_fpgto_codigo($linha->vendac_fpgto_codigo);
                    $vendac->setVendac_fpgto_tipo($linha->vendac_fpgto_tipo);
                    $vendac->setVendac_valor($linha->vendac_valor);
                    $vendac->setVendac_peso_total($linha->vendac_peso_total);
                    $vendac->setVendac_observacao($linha->vendac_observacao);
                    $vendac->setVendac_enviada($linha->vendac_enviada);
                    $vendac->setVendac_latitude($linha->vendac_latitude);
                    $vendac->setVendac_longitude($linha->vendac_longitude);
                    $ven[] = $vendac;
                }
            }

            return $ven;
        } catch (PDOException $e) {
            print "[[[   Erro em m_busca_vendas_do_vendedor_por_periodo :: " . $e->getMessage() . "   ]]]";
        }
    }

    public function m_busca_vendas_do_vendedor_por_cli_codigo_e_data_between(VendacBean $vendac, $data_inicial, $datafinal) {
        try {

            $sql = "SELECT * FROM vendac where ID_CPF_EMPRESA=:ID_CPF_EMPRESA and vendac_cli_codigo = :vendac_cli_codigo and vendac_usu_codigo = :vendac_usu_codigo    and vendac_datahoravenda between  '$data_inicial' and '$datafinal'  ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $vendac->getID_CPF_EMPRESA());
            $statement_sql->bindValue(":vendac_cli_codigo", $vendac->getVendac_cli_codigo());
            $statement_sql->bindValue(":vendac_usu_codigo", $vendac->getVendac_usu_codigo());
            $statement_sql->execute();

            if ($statement_sql) {
                $ven = array();
                while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                    $vendac = new VendacBean();
                    $vendac->setID_CPF_EMPRESA($linha->ID_CPF_EMPRESA);
                    $vendac->setVendac_chave($linha->vendac_chave);
                    $vendac->setVendac_datahoravenda($linha->vendac_datahoravenda);
                    $vendac->setVendac_previsao_entrega($linha->vendac_previsao_entrega);
                    $vendac->setVendac_usu_codigo($linha->vendac_usu_codigo);
                    $vendac->setVendac_usu_nome($linha->vendac_usu_nome);
                    $vendac->setVendac_cli_codigo($linha->vendac_cli_codigo);
                    $vendac->setVendac_cli_nome($linha->vendac_cli_nome);
                    $vendac->setVendac_fpgto_codigo($linha->vendac_fpgto_codigo);
                    $vendac->setVendac_fpgto_tipo($linha->vendac_fpgto_tipo);
                    $vendac->setVendac_valor($linha->vendac_valor);
                    $vendac->setVendac_peso_total($linha->vendac_peso_total);
                    $vendac->setVendac_observacao($linha->vendac_observacao);
                    $vendac->setVendac_enviada($linha->vendac_enviada);
                    $vendac->setVendac_latitude($linha->vendac_latitude);
                    $vendac->setVendac_longitude($linha->vendac_longitude);
                    $ven[] = $vendac;
                }
            }

            return $ven;
        } catch (PDOException $e) {
            print "[[[   Erro em m_busca_vendac_por_cli_codigo :: " . $e->getMessage() . "   ]]]";
        }
    }

    public function m_busca_vendas_DIRETOR_data_betweenCLIENTE(VendacBean $vendac, $data_inicial, $datafinal) {
        try {

            $sql = "SELECT * FROM vendac where vendac_cli_codigo = :vendac_cli_codigo and vendac_datahoravenda between  '$data_inicial' and '$datafinal'  ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":vendac_cli_codigo", $vendac->getVendac_cli_codigo());
            $statement_sql->execute();

            if ($statement_sql) {
                $ven = array();
                while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                    $vendac = new VendacBean();
                    $vendac->setID_CPF_EMPRESA($linha->ID_CPF_EMPRESA);
                    $vendac->setVendac_chave($linha->vendac_chave);
                    $vendac->setVendac_datahoravenda($linha->vendac_datahoravenda);
                    $vendac->setVendac_previsao_entrega($linha->vendac_previsao_entrega);
                    $vendac->setVendac_usu_codigo($linha->vendac_usu_codigo);
                    $vendac->setVendac_usu_nome($linha->vendac_usu_nome);
                    $vendac->setVendac_cli_codigo($linha->vendac_cli_codigo);
                    $vendac->setVendac_cli_nome($linha->vendac_cli_nome);
                    $vendac->setVendac_fpgto_codigo($linha->vendac_fpgto_codigo);
                    $vendac->setVendac_fpgto_tipo($linha->vendac_fpgto_tipo);
                    $vendac->setVendac_valor($linha->vendac_valor);
                    $vendac->setVendac_peso_total($linha->vendac_peso_total);
                    $vendac->setVendac_observacao($linha->vendac_observacao);
                    $vendac->setVendac_enviada($linha->vendac_enviada);
                    $vendac->setVendac_latitude($linha->vendac_latitude);
                    $vendac->setVendac_longitude($linha->vendac_longitude);
                    $ven[] = $vendac;
                }
            }

            return $ven;
        } catch (PDOException $e) {
            print "[[[   Erro em m_busca_vendac_por_cli_codigo :: " . $e->getMessage() . "   ]]]";
        }
    }

    public function m_busca_vendas_DIRETOR_data_betweenVENDEDOR(VendacBean $vendac, $data_inicial, $datafinal) {

        try {

            $sql = "SELECT * FROM vendac where vendac_usu_codigo = :vendac_usu_codigo and vendac_datahoravenda between  '$data_inicial' and '$datafinal' order by vendac_datahoravenda DESC ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":vendac_usu_codigo", $vendac->getVendac_usu_codigo());
            $statement_sql->execute();

            if ($statement_sql) {
                $ven = array();
                while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                    $vendac = new VendacBean();
                    $vendac->setID_CPF_EMPRESA($linha->ID_CPF_EMPRESA);
                    $vendac->setVendac_chave($linha->vendac_chave);
                    $vendac->setVendac_datahoravenda($linha->vendac_datahoravenda);
                    $vendac->setVendac_previsao_entrega($linha->vendac_previsao_entrega);
                    $vendac->setVendac_usu_codigo($linha->vendac_usu_codigo);
                    $vendac->setVendac_usu_nome($linha->vendac_usu_nome);
                    $vendac->setVendac_cli_codigo($linha->vendac_cli_codigo);
                    $vendac->setVendac_cli_nome($linha->vendac_cli_nome);
                    $vendac->setVendac_fpgto_codigo($linha->vendac_fpgto_codigo);
                    $vendac->setVendac_fpgto_tipo($linha->vendac_fpgto_tipo);
                    $vendac->setVendac_valor($linha->vendac_valor);
                    $vendac->setVendac_peso_total($linha->vendac_peso_total);
                    $vendac->setVendac_observacao($linha->vendac_observacao);
                    $vendac->setVendac_enviada($linha->vendac_enviada);
                    $vendac->setVendac_latitude($linha->vendac_latitude);
                    $vendac->setVendac_longitude($linha->vendac_longitude);
                    $ven[] = $vendac;
                }
            }

            return $ven;
        } catch (PDOException $e) {
            print "[[[   Erro em m_busca_vendac_por_cli_codigo :: " . $e->getMessage() . "   ]]]";
        }
    }

    public function m_busca_vendas_DIRETOR_por_periodo($data_inicial, $datafinal) {
        try {

            $sql = "SELECT * FROM vendac where vendac_datahoravenda between  '$data_inicial' and '$datafinal' order by vendac_datahoravenda DESC  ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->execute();

            if ($statement_sql) {
                $ven = array();
                while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                    $vendac = new VendacBean();
                    $vendac->setID_CPF_EMPRESA($linha->ID_CPF_EMPRESA);
                    $vendac->setVendac_chave($linha->vendac_chave);
                    $vendac->setVendac_datahoravenda($linha->vendac_datahoravenda);
                    $vendac->setVendac_previsao_entrega($linha->vendac_previsao_entrega);
                    $vendac->setVendac_usu_codigo($linha->vendac_usu_codigo);
                    $vendac->setVendac_usu_nome($linha->vendac_usu_nome);
                    $vendac->setVendac_cli_codigo($linha->vendac_cli_codigo);
                    $vendac->setVendac_cli_nome($linha->vendac_cli_nome);
                    $vendac->setVendac_fpgto_codigo($linha->vendac_fpgto_codigo);
                    $vendac->setVendac_fpgto_tipo($linha->vendac_fpgto_tipo);
                    $vendac->setVendac_valor($linha->vendac_valor);
                    $vendac->setVendac_peso_total($linha->vendac_peso_total);
                    $vendac->setVendac_observacao($linha->vendac_observacao);
                    $vendac->setVendac_enviada($linha->vendac_enviada);
                    $vendac->setVendac_latitude($linha->vendac_latitude);
                    $vendac->setVendac_longitude($linha->vendac_longitude);
                    $ven[] = $vendac;
                }
            }

            return $ven;
        } catch (PDOException $e) {
            print "[[[   Erro em m_busca_vendac_por_cli_codigo :: " . $e->getMessage() . "   ]]]";
        }
    }

    public function m_listar_todas_vendasc_para_diretor() {

        try {
            $sql = "select * from vendac ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->execute();
            if ($statement_sql) {
                $ven = array();
                while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                    $vendac = new VendacBean();
                    $vendac->setID_CPF_EMPRESA($linha->ID_CPF_EMPRESA);
                    $vendac->setVendac_chave($linha->vendac_chave);
                    $vendac->setVendac_datahoravenda($linha->vendac_datahoravenda);
                    $vendac->setVendac_previsao_entrega($linha->vendac_previsao_entrega);
                    $vendac->setVendac_usu_codigo($linha->vendac_usu_codigo);
                    $vendac->setVendac_usu_nome($linha->vendac_usu_nome);
                    $vendac->setVendac_cli_codigo($linha->vendac_cli_codigo);
                    $vendac->setVendac_cli_nome($linha->vendac_cli_nome);
                    $vendac->setVendac_fpgto_codigo($linha->vendac_fpgto_codigo);
                    $vendac->setVendac_fpgto_tipo($linha->vendac_fpgto_tipo);
                    $vendac->setVendac_valor($linha->vendac_valor);
                    $vendac->setVendac_peso_total($linha->vendac_peso_total);
                    $vendac->setVendac_observacao($linha->vendac_observacao);
                    $vendac->setVendac_enviada($linha->vendac_enviada);
                    $vendac->setVendac_latitude($linha->vendac_latitude);
                    $vendac->setVendac_longitude($linha->vendac_longitude);
                    $ven[] = $vendac;
                }
            }

            return $ven;
        } catch (PDOException $e) {
            print "Erro em m_buscar_todas_vendasc :: " . $e->getMessage();
        }
    }

    public function m_busca_produtos_mais_vendidos_POR_PERIODO($data_ini, $data_fim, $ID_CPF_EMPRESA) {
        try {
            $sql = "select sum(i.vendad_quantidade) as qtd, i.vendad_codigo_produto as cod, pr.prd_descricao as descr,pr.prd_quant as estoq , pr.prd_EAN as ean, p.ID_CPF_EMPRESA from vendac p left outer join vendad i on p.vendac_chave = i.vendac_chave left outer join produtos pr on pr.prd_codigo = i.vendad_codigo_produto where p.vendac_datahoravenda between '$data_ini' and '$data_fim' AND i.ID_CPF_EMPRESA = '$ID_CPF_EMPRESA' group by i.vendad_codigo_produto order by qtd desc";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->execute();

            if ($statement_sql) {
                $ven = array();
                while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                    $prd = array();
                    $prd["qtd"] = $linha->qtd;
                    $prd["cod"] = $linha->cod;
                    $prd["descr"] = $linha->descr;
                    $prd["estoq"] = $linha->estoq;
                    $prd["ean"] = $linha->ean;
                    $ven[] = $prd;
                }
            }

            return $ven;
        } catch (PDOException $e) {
            print "Erro em m_busca_produtos_mais_vendidos_POR_PERIODO :: " . $e->getMessage();
        }
    }

    // GERACAO DE GRAFICOS

    public function m_grafico_de_vendas_por_vendedor(VendacBean $venda) {
        try {
            $sql = "SELECT 
                    usu.usu_nome AS vendedor,
                    COUNT( * ) AS vendas
                    FROM vendac vnc 
                    left outer join usuarios usu 
                    on usu.usu_codigo = vnc.vendac_usu_codigo
                    WHERE vnc.ID_CPF_EMPRESA =  :ID_CPF_EMPRESA
                    GROUP BY vnc.vendac_usu_codigo
                    ORDER BY vendas DESC";

            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $venda->getID_CPF_EMPRESA());

            $statement_sql->execute();
            if ($statement_sql) {
                $ven = array();
                while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                    $vendac = array();
                    $vendac['vendedor'] = $linha->vendedor;
                    $vendac['vendas'] = $linha->vendas;
                    $ven[] = $vendac;
                }
            }

            return $ven;
        } catch (PDOException $e) {
            print " Erro em m_grafico_de_vendas_por_vendedor " . $e->getMessage();
        }
    }

    public function m_EXCLUIR_VENDAC_ID_CPF_EMPRESA($ID_CPF_EMPRESA) {
        try {
            $sql = "delete from vendac where ID_CPF_EMPRESA=:ID_CPF_EMPRESA";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(":ID_CPF_EMPRESA", $ID_CPF_EMPRESA);
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_EXCLUIR_VENDAC_ID_CPF_EMPRESA :: " . $e->getMessage();
        }
    }

    public function m_buscar_vendas_paginacao($inicio, $limitpage, $ID_CPF_EMPRESA) {
        try {
            $sql = "select * from vendac where ID_CPF_EMPRESA = '$ID_CPF_EMPRESA'  limit $inicio,$limitpage";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->execute();
            if ($statement_sql) {
                $ven = array();
                while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                    $vendac = new VendacBean();
                    $vendac->setID_CPF_EMPRESA($linha->ID_CPF_EMPRESA);
                    $vendac->setVendac_chave($linha->vendac_chave);
                    $vendac->setVendac_datahoravenda($linha->vendac_datahoravenda);
                    $vendac->setVendac_previsao_entrega($linha->vendac_previsao_entrega);
                    $vendac->setVendac_usu_codigo($linha->vendac_usu_codigo);
                    $vendac->setVendac_usu_nome($linha->vendac_usu_nome);
                    $vendac->setVendac_cli_codigo($linha->vendac_cli_codigo);
                    $vendac->setVendac_cli_nome($linha->vendac_cli_nome);
                    $vendac->setVendac_fpgto_codigo($linha->vendac_fpgto_codigo);
                    $vendac->setVendac_fpgto_tipo($linha->vendac_fpgto_tipo);
                    $vendac->setVendac_valor($linha->vendac_valor);
                    $vendac->setVendac_peso_total($linha->vendac_peso_total);
                    $vendac->setVendac_observacao($linha->vendac_observacao);
                    $vendac->setVendac_enviada($linha->vendac_enviada);
                    $vendac->setVendac_latitude($linha->vendac_latitude);
                    $vendac->setVendac_longitude($linha->vendac_longitude);
                    $ven[] = $vendac;
                }
            }

            return $ven;
        } catch (PDOException $e) {
            print "Erro em m_buscar_todas_vendasc :: " . $e->getMessage();
        }
    }

    public function m_busca_clientes_que_compram_mais($ID_CPF_EMPRESA) {
        try {
            $sql = "select vendac_cli_codigo ,vendac_cli_nome , count( vendac_cli_codigo ) compras, sum( vendac_valor ) total from vendac where ID_CPF_EMPRESA = '" . $ID_CPF_EMPRESA . "' group by vendac_cli_codigo ORDER by compras DESC";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->execute();

            if ($statement_sql) {
                $ven = array();
                while ($linha = $statement_sql->fetch(PDO::FETCH_OBJ)) {
                    $prd = array();
                    $prd["vendac_cli_codigo"] = $linha->vendac_cli_codigo;
                    $prd["vendac_cli_nome"] = $linha->vendac_cli_nome;
                    $prd["compras"] = $linha->compras;
                    $prd["total"] = $linha->total;
                    $ven[] = $prd;
                }
            }
            return $ven;
        } catch (PDOException $e) {
            print "Erro em m_busca_clientes_que_compram_mais :: " . $e->getMessage();
        }
    }

    public function m_atualiza_nome_vendedor_vendac($vendac_usu_nome, $vendac_usu_codigo, $ID_CPF_EMPRESA) {
        try {
            $sql = "update vendac set vendac_usu_nome = ? where vendac_usu_codigo = ? and ID_CPF_EMPRESA = ? ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $vendac_usu_nome);
            $statement_sql->bindValue(2, $vendac_usu_codigo);
            $statement_sql->bindValue(3, $ID_CPF_EMPRESA);
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_atualiza_nome_vendedor_vendac :: " . $e->getMessage();
        }
    }

    public function m_atualiza_codigo_cliente_offline_vendac($new_codigo, $old_codigo, $ID_CPF_EMPRESA) {
        try {
            $sql = "update vendac set vendac_cli_codigo = ? where vendac_cli_codigo = ? and ID_CPF_EMPRESA = ? ";
            $statement_sql = ConPDO::getInstance()->prepare($sql);
            $statement_sql->bindValue(1, $new_codigo);
            $statement_sql->bindValue(2, $old_codigo);
            $statement_sql->bindValue(3, $ID_CPF_EMPRESA);
            return $statement_sql->execute();
        } catch (PDOException $e) {
            print "Erro em m_atualiza_codigo_cliente_offline_vendac :: " . $e->getMessage();
        }
    }

}
?>

