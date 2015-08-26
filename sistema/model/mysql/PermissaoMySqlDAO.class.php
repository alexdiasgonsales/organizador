<?php
/**
* Classe de operação da tabela 'permissao'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class PermissaoMySqlDAO implements PermissaoDAO{
        
        protected $table = 'permissao';
        
	/**
	 * Implementa o dominio chave primária na seleção de único registro
	 *
	 * @parametro String $id primary key
	 * @retorna PermissaoMySql 
	 */
         
	public function load($id){
            $sql = "SELECT * FROM $this->table WHERE id_permissao = :id_permissao";
            $stmt = ConnectionFactory::prepare($sql);
            $stmt->bindParam(':id_permissao', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
	}

	/**
	 * Obtem todos o registros das Tabelas
	 */
         
	public function queryAll(){
	   $sql = "SELECT * FROM $this->table";
           $stmt = ConnectionFactory::prepare($sql);
           $stmt->execute();
           return $stmt->fetchAll();	
	}
	
	/**
 	 * Exclui um registro da tabela
 	 * @parametro permissao chave primária
 	 */
         
	public function delete($id){
            $sql = "DELETE FROM $this->table WHERE id_permissao = :id_permissao";
            $stmt = ConnectionFactory::prepare($sql);
            $stmt->bindParam(':id_permissao', $id, PDO::PARAM_INT);
            return $stmt->execute();
	}
	
	/**
 	 * Inseri um registro na tabela
 	 *
 	 * @parametro PermissaoMySql permissao
 	 */
         
	public function insert(Permissao $Permissao){
           $sql = "INSERT INTO $this->table (nome_permissao) VALUES ( :nomePermissao)";
  
           
	   $nomePermissao = $Permissao->getNomePermissao();
           
           $stmt = ConnectionFactory::prepare($sql);
           
           
	   $stmt->bindParam(':nomePermissao', $nomePermissao);
           return $stmt->execute();    
	}
	
	/**
 	 * atualiza um registro da tabela
 	 *
 	 * @parametro PermissaoMySql permissao
 	 */
         
	public function update(Permissao $Permissao){
           $sql = "UPDATE $this->table SET nome_permissao = :nome_permissao WHERE id_permissao = :id";
           $id = $Permissao->getIdPermissao();
     
           
	   $nomePermissao = $Permissao->getNomePermissao();
           
           $stmt = ConnectionFactory::prepare($sql);
           $stmt->bindParam(':id', $id);
           
           
	   $stmt->bindParam(':nomePermissao', $nomePermissao);
           
           return $stmt->execute(); 
	}

}
