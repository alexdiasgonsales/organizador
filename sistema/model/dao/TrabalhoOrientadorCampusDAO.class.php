<?php
/**
* Classe de operação da tabela 'trabalho_orientador_campus'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/

    interface TrabalhoOrientadorCampusDAO{

    /**
    * Implementa o dominio chave primária na seleção de único registro
    *
    * @parametro String $id primary key
    * @retorna TrabalhoOrientadorCampus 
    */
    public function load($id_trabalho, $id_orientador);

    /**
    * Obtem todos o registros das Tabelas
    */
    public function queryAll();

    /**
    * Exclui um registro da tabela
    * @parametro trabalhoOrientadorCampu chave prim�ria
    */
    public function delete($id_trabalho, $id_orientador);
    
    /**
    * Inseri um registro na tabela
    *
    * @parametro TrabalhoOrientadorCampus trabalhoOrientadorCampu
    */

    public function insert(TrabalhoOrientadorCampus $trabalhoOrientadorCampus);

    /**
    * Altera um registro na tabela
    *
    * @parametro TrabalhoOrientadorCampus trabalhoOrientadorCampu
    */
    public function update(TrabalhoOrientadorCampus $trabalhoOrientadorCampus);	
}


