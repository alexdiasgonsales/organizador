<?php
/**
* Classe de operação da tabela 'orientador'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/

    interface OrientadorDAO{

    /**
    * Implementa o dominio chave primária na seleção de único registro
    *
    * @parametro String $id primary key
    * @retorna Orientador 
    */
    public function load($id);

    /**
    * Obtem todos o registros das Tabelas
    */
    public function queryAll();

    /**
    * Exclui um registro da tabela
    * @parametro orientador chave prim�ria
    */
    public function delete($id);
    
    /**
    * Inseri um registro na tabela
    *
    * @parametro Orientador orientador
    */

    public function insert(Orientador $Orientador);

    /**
    * Altera um registro na tabela
    *
    * @parametro Orientador orientador
    */
    public function update(Orientador $Orientador);	
}


