<?php
/**
* Classe de operação da tabela 'trabalho_autor_curso'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/

    interface TrabalhoAutorCursoDAO{

    /**
    * Implementa o dominio chave primária na seleção de único registro
    *
    * @parametro String $id primary key
    * @retorna TrabalhoAutorCurso 
    */
    public function load($id_trabalho, $id_autor);

    /**
    * Obtem todos o registros das Tabelas
    */
    public function queryAll();

    /**
    * Exclui um registro da tabela
    * @parametro trabalhoAutorCurso chave prim�ria
    */
    public function delete($id_trabalho, $id_autor);
    
    /**
    * Inseri um registro na tabela
    *
    * @parametro TrabalhoAutorCurso trabalhoAutorCurso
    */

    public function insert(TrabalhoAutorCurso $trabalhoAutorCurso);

    /**
    * Altera um registro na tabela
    *
    * @parametro TrabalhoAutorCurso trabalhoAutorCurso
    */
    public function update(TrabalhoAutorCurso $trabalhoAutorCurso);	
}


