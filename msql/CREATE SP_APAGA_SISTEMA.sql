

CREATE PROCEDURE SP_APAGA_SISTEMA
     (
        IN  CPF  INT(11) 
     )
BEGIN 

delete from receber  where ID_CPF_EMPRESA = CPF;
delete from imagensprd  where ID_CPF_EMPRESA = CPF;
delete from entrada_produtos_d  where ID_CPF_EMPRESA = CPF;
delete from vendad  where ID_CPF_EMPRESA = CPF;
delete from produtos  where ID_CPF_EMPRESA = CPF;
delete from fornecedores  where ID_CPF_EMPRESA = CPF;
delete from cheques where ID_CPF_EMPRESA = CPF;
delete from vendac  where ID_CPF_EMPRESA = CPF;
delete from entrada_produtos  where ID_CPF_EMPRESA = CPF;
delete from usuarios  where ID_CPF_EMPRESA = CPF;
delete from categorias where ID_CPF_EMPRESA = CPF;
delete from clientes where ID_CPF_EMPRESA = CPF;
delete from conf_pagamento where ID_CPF_EMPRESA = CPF;
delete from empresa  where emp_cpf = CPF;
delete from empresa_config  where ID_CPF_EMPRESA = CPF;
delete from firebase_devices  where ID_CPF_EMPRESA = CPF;
delete from historico_pagamento  where ID_CPF_EMPRESA = CPF;
delete from log  where ID_CPF_EMPRESA = CPF;
delete from logomarcas  where ID_CPF_EMPRESA = CPF;
delete from permissoes  where ID_CPF_EMPRESA = CPF;
delete from produtos  where ID_CPF_EMPRESA = CPF;
delete from receber  where ID_CPF_EMPRESA = CPF;; 

END 

GO