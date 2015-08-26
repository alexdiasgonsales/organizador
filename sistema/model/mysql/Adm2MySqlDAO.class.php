<?php
/**
* Classe de operação da tabela 'adm2'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class Adm2MySqlDAO implements Adm2DAO{
        
        protected $table = 'adm2';
        
	/**
	 * Implementa o dominio chave primária na seleção de único registro
	 *
	 * @parametro String $id primary key
	 * @retorna Adm2MySql 
	 */
         
	public function load($id){
            $sql = "SELECT * FROM $this->table WHERE id_administrador = :id_administrador";
            $stmt = ConnectionFactory::prepare($sql);
            $stmt->bindParam(':id_administrador', $id, PDO::PARAM_INT);
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
 	 * @parametro adm2 chave primária
 	 */
         
	public function delete($id){
            $sql = "DELETE FROM $this->table WHERE id_administrador = :id_administrador";
            $stmt = ConnectionFactory::prepare($sql);
            $stmt->bindParam(':id_administrador', $id, PDO::PARAM_INT);
            return $stmt->execute();
	}
	
	/**
 	 * Inseri um registro na tabela
 	 *
 	 * @parametro Adm2MySql adm2
 	 */
         
	public function insert(Adm2 $Adm2){
           $sql = "INSERT INTO $this->table (nivel, usuario, senha) VALUES ( :nivel,  :usuario,  :senha)";
  
           
	   $nivel = $Adm2->getNivel();
	   $usuario = $Adm2->getUsuario();
	   $senha = $Adm2->getSenha();
           
           $stmt = ConnectionFactory::prepare($sql);
           
           
	   $stmt->bindParam(':nivel', $nivel);
	   $stmt->bindParam(':usuario', $usuario);
	   $stmt->bindParam(':senha', $senha);
           return $stmt->execute();    
	}
	
	/**
 	 * atualiza um registro da tabela
 	 *
 	 * @parametro Adm2MySql adm2
 	 */
         
	public function update(Adm2 $Adm2){
           $sql = "UPDATE $this->table SET nivel = :nivel, usuario = :usuario, senha = :senha WHERE id_administrador = :id";
           $id = $Adm2->getIdAdministrador();
     
           
	   $nivel = $Adm2->getNivel();
	   $usuario = $Adm2->getUsuario();
	   $senha = $Adm2->getSenha();
           
           $stmt = ConnectionFactory::prepare($sql);
           $stmt->bindParam(':id', $id);
           
           
	   $stmt->bindParam(':nivel', $nivel);
	   $stmt->bindParam(':usuario', $usuario);
	   $stmt->bindParam(':senha', $senha);
           
           return $stmt->execute(); 
	}

}
