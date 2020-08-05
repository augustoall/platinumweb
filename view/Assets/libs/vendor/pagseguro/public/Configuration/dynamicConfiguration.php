<?php

/**
 * 2007-2016 [PagSeguro Internet Ltda.]
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @author    PagSeguro Internet Ltda.
 * @copyright 2007-2016 PagSeguro Internet Ltda.
 * @license   http://www.apache.org/licenses/LICENSE-2.0
 *
 * environment: aceita os valores production e sandbox. Para utilizar o sandbox, é preciso criar uma conta em https://sandbox.pagseguro.uol.com.br.
  email: e-mail cadastrado no PagSeguro.
 * 
  token production: token gerado no PagSeguro.
 * 
  token sandbox: token gerado no Sandbox.
 * 
  appId production: aplicacao gerada no PagSeguro.
 * 
  appId sandbox: aplicacao gerada no Sandbox.
 * 
  appKey production: token da aplicacao no PagSeguro.
  appKey sandbox: token da aplicacao no Sandbox.
  charset: codificação do seu sistema (ISO-8859-1 ou UTF-8).
  log: ativa/desativa a geração de logs.
  fileLocation: local onde se deseja criar o arquivo de log. Ex.: /logs/ps.log.
 */
require_once "../../vendor/autoload.php";

\PagSeguro\Library::initialize();
\PagSeguro\Library::cmsVersion()->setName("Nome")->setRelease("1.0.0");
\PagSeguro\Library::moduleVersion()->setName("Nome")->setRelease("1.0.0");

\PagSeguro\Configuration\Configure::setEnvironment('sandbox'); //production or sandbox

\PagSeguro\Configuration\Configure::setAccountCredentials(
        'centralmetadevendas@gmail.com', 'B726F9EF02B342A2B3A1D6280DF8F7BD'
);

\PagSeguro\Configuration\Configure::setCharset('UTF-8'); // UTF-8 or ISO-8859-1
\PagSeguro\Configuration\Configure::setLog(false, '/');


\PagSeguro\Configuration\Configure::setApplicationCredentials(
        'app4458503438', 'F6E012C5B4B4D7D4441A0FB108FA4154'
);

try {
    /**
     * @todo For use with application credentials use:
     * \PagSeguro\Configuration\Configure::getApplicationCredentials()
     *  ->setAuthorizationCode("FD3AF1B214EC40F0B0A6745D041BFDDD")
     */
    $sessionCode = \PagSeguro\Services\Session::create(
                    \PagSeguro\Configuration\Configure::getAccountCredentials()
    );

    echo "<strong>ID de sess&atilde;o criado: </strong>{$sessionCode->getResult()}";
} catch (Exception $e) {
    die($e->getMessage());
}
