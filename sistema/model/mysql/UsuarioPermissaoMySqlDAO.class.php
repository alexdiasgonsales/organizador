<?php
/**
* Classe de operação da tabela 'usuario_permissao'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class UsuarioPermissaoMySqlDAO implements UsuarioPermissaoDAO{
        
        protected $table = 'usuario_permissao';
        
	/**
	 * Implementa o dominio chave primária na seleção de único registro
	 *
	 * @parametro String $id primary key
	 * @retorna UsuarioPermissaoMySql 
	 */
         
	public function load($id){
            $sql = "SELECT * FROM $this->table WHERE fk_usuario = :fk_usuario";
            $stmt = ConnectionFactory::prepare($sql);
            $stmt->bindParam(':fk_usuario', $id, PDO::PARAM_INT);
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
 	 * @parametro usuarioPermissao chave primária
 	 */
         
	public function delete($id){
            $sql = "DELETE FROM $this->table WHERE fk_usuario = :fk_usuario";
            $stmt = ConnectionFactory::prepare($sql);
            $stmt->bindParam(':fk_usuario', $id, PDO::PARAM_INT);
            return $stmt->execute();
	}
	
	/**
 	 * Inseri um registro na tabela
 	 *
 	 * @parametro UsuarioPermissaoMySql usuarioPermissao
 	 */
         
	public function insert(UsuarioPermissao $UsuarioPermissao){
           $sql = "INSERT INTO $this->table () VALUES ()";
  
           
           
           $stmt = ConnectionFactory::prepare($sql);
           
           
           return $stmt->execute();    
	}
	
	/**
 	 * atualiza um registro da tabela
 	 *
 	 * @parametro UsuarioPermissaoMySql usuarioPermissao
 	 */
         
	public function update(UsuarioPermissao $UsuarioPermissao){
           $sql = "UPDATE $this->table SET  WHERE fk_usuario = :id";
           $id = $UsuarioPermissao->getFkUsuario();
     
           
           
           $stmt = ConnectionFactory::prepare($sql);
           $stmt->bindParam(':id', $id);
           
           
           
           return $stmt->execute(); 
	}

}
