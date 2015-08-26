<?php
/**
* Classe de operação da tabela 'categoria'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class CategoriaMySqlDAO implements CategoriaDAO{
        
        protected $table = 'categoria';
        
	/**
	 * Implementa o dominio chave primária na seleção de único registro
	 *
	 * @parametro String $id primary key
	 * @retorna CategoriaMySql 
	 */
         
	public function load($id){
            $sql = "SELECT * FROM $this->table WHERE id_categoria = :id_categoria";
            $stmt = ConnectionFactory::prepare($sql);
            $stmt->bindParam(':id_categoria', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
	}

	/**
	 * Obtem todos o registros das Tabelas
	 */
         
	public function queryAll(){
	   $sql = "SELECT * FROM $this->table ORDER BY id_categoria";
           $stmt = ConnectionFactory::prepare($sql);
           $stmt->execute();
           return $stmt->fetchAll();	
	}
	
	/**
 	 * Exclui um registro da tabela
 	 * @parametro categoria chave primária
 	 */
         
	public function delete($id){
            $sql = "DELETE FROM $this->table WHERE id_categoria = :id_categoria";
            $stmt = ConnectionFactory::prepare($sql);
            $stmt->bindParam(':id_categoria', $id, PDO::PARAM_INT);
            return $stmt->execute();
	}
	
	/**
 	 * Inseri um registro na tabela
 	 *
 	 * @parametro CategoriaMySql categoria
 	 */
         
	public function insert(Categoria $Categoria){
           $sql = "INSERT INTO $this->table (nome) VALUES ( :nome)";
  
           
	   $nome = $Categoria->getNome();
           
           $stmt = ConnectionFactory::prepare($sql);
           
           
	   $stmt->bindParam(':nome', $nome);
           return $stmt->execute();    
	}
	
	/**
 	 * atualiza um registro da tabela
 	 *
 	 * @parametro CategoriaMySql categoria
 	 */
         
	public function update(Categoria $Categoria){
           $sql = "UPDATE $this->table SET nome = :nome WHERE id_categoria = :id";
           $id = $Categoria->getIdCategoria();
     
           
	   $nome = $Categoria->getNome();
           
           $stmt = ConnectionFactory::prepare($sql);
           $stmt->bindParam(':id', $id);
           
           
	   $stmt->bindParam(':nome', $nome);
           
           return $stmt->execute(); 
	}

}
