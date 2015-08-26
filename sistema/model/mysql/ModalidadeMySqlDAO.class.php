<?php
/**
* Classe de operação da tabela 'modalidade'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class ModalidadeMySqlDAO implements ModalidadeDAO{
        
        protected $table = 'modalidade';
        
	/**
	 * Implementa o dominio chave primária na seleção de único registro
	 *
	 * @parametro String $id primary key
	 * @retorna ModalidadeMySql 
	 */
         
	public function load($id){
            $sql = "SELECT * FROM $this->table WHERE id_modalidade = :id_modalidade";
            $stmt = ConnectionFactory::prepare($sql);
            $stmt->bindParam(':id_modalidade', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
	}

	/**
	 * Obtem todos o registros das Tabelas
	 */
         
	public function queryAll(){
	   $sql = "SELECT * FROM $this->table ORDER BY id_modalidade";
           $stmt = ConnectionFactory::prepare($sql);
           $stmt->execute();
           return $stmt->fetchAll();	
	}
	
	/**
 	 * Exclui um registro da tabela
 	 * @parametro modalidade chave primária
 	 */
         
	public function delete($id){
            $sql = "DELETE FROM $this->table WHERE id_modalidade = :id_modalidade";
            $stmt = ConnectionFactory::prepare($sql);
            $stmt->bindParam(':id_modalidade', $id, PDO::PARAM_INT);
            return $stmt->execute();
	}
	
	/**
 	 * Inseri um registro na tabela
 	 *
 	 * @parametro ModalidadeMySql modalidade
 	 */
         
	public function insert(Modalidade $Modalidade){
           $sql = "INSERT INTO $this->table (nome) VALUES ( :nome)";
  
           
	   $nome = $Modalidade->getNome();
           
           $stmt = ConnectionFactory::prepare($sql);
           
           
	   $stmt->bindParam(':nome', $nome);
           return $stmt->execute();    
	}
	
	/**
 	 * atualiza um registro da tabela
 	 *
 	 * @parametro ModalidadeMySql modalidade
 	 */
         
	public function update(Modalidade $Modalidade){
           $sql = "UPDATE $this->table SET nome = :nome WHERE id_modalidade = :id";
           $id = $Modalidade->getIdModalidade();
     
           
	   $nome = $Modalidade->getNome();
           
           $stmt = ConnectionFactory::prepare($sql);
           $stmt->bindParam(':id', $id);
           
           
	   $stmt->bindParam(':nome', $nome);
           
           return $stmt->execute(); 
	}

}
