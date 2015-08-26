<?php
/**
* Classe de operação da tabela 'avaliador_sessao'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class AvaliadorSessaoMySqlDAO implements AvaliadorSessaoDAO{
        
        protected $table = 'avaliador_sessao';
        
	/**
	 * Implementa o dominio chave primária na seleção de único registro
	 *
	 * @parametro String $id primary key
	 * @retorna AvaliadorSessaoMySql 
	 */
         
	public function load($id){
            $sql = "SELECT * FROM $this->table WHERE fk_avaliador = :fk_avaliador";
            $stmt = ConnectionFactory::prepare($sql);
            $stmt->bindParam(':fk_avaliador', $id, PDO::PARAM_INT);
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
 	 * @parametro avaliadorSessao chave primária
 	 */
         
	public function delete($id){
            $sql = "DELETE FROM $this->table WHERE fk_avaliador = :fk_avaliador";
            $stmt = ConnectionFactory::prepare($sql);
            $stmt->bindParam(':fk_avaliador', $id, PDO::PARAM_INT);
            return $stmt->execute();
	}
	
	/**
 	 * Inseri um registro na tabela
 	 *
 	 * @parametro AvaliadorSessaoMySql avaliadorSessao
 	 */
         
	public function insert(AvaliadorSessao $AvaliadorSessao){
           $sql = "INSERT INTO $this->table (seq, status) VALUES ( :seq,  :status)";
  
           
	   $seq = $AvaliadorSessao->getSeq();
	   $status = $AvaliadorSessao->getStatus();
           
           $stmt = ConnectionFactory::prepare($sql);
           
           
	   $stmt->bindParam(':seq', $seq);
	   $stmt->bindParam(':status', $status);
           return $stmt->execute();    
	}
	
	/**
 	 * atualiza um registro da tabela
 	 *
 	 * @parametro AvaliadorSessaoMySql avaliadorSessao
 	 */
         
	public function update(AvaliadorSessao $AvaliadorSessao){
           $sql = "UPDATE $this->table SET seq = :seq, status = :status WHERE fk_avaliador = :id";
           $id = $AvaliadorSessao->getFkAvaliador();
     
           
	   $seq = $AvaliadorSessao->getSeq();
	   $status = $AvaliadorSessao->getStatus();
           
           $stmt = ConnectionFactory::prepare($sql);
           $stmt->bindParam(':id', $id);
           
           
	   $stmt->bindParam(':seq', $seq);
	   $stmt->bindParam(':status', $status);
           
           return $stmt->execute(); 
	}

}
