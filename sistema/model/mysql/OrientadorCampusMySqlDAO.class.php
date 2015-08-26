<?php
/**
* Classe de operação da tabela 'orientador_campus'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class OrientadorCampusMySqlDAO implements OrientadorCampusDAO{
        
        protected $table = 'orientador_campus';
        
	/**
	 * Implementa o dominio chave primária na seleção de único registro
	 *
	 * @parametro String $id primary key
	 * @retorna OrientadorCampusMySql 
	 */
         
	public function load($id){
            $sql = "SELECT * FROM $this->table WHERE fk_campus = :fk_campus";
            $stmt = ConnectionFactory::prepare($sql);
            $stmt->bindParam(':fk_campus', $id, PDO::PARAM_INT);
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
 	 * @parametro orientadorCampu chave primária
 	 */
         
	public function delete($id){
            $sql = "DELETE FROM $this->table WHERE fk_campus = :fk_campus";
            $stmt = ConnectionFactory::prepare($sql);
            $stmt->bindParam(':fk_campus', $id, PDO::PARAM_INT);
            return $stmt->execute();
	}
	
	/**
 	 * Inseri um registro na tabela
 	 *
 	 * @parametro OrientadorCampusMySql orientadorCampu
 	 */
         
	public function insert(OrientadorCampus $OrientadorCampus){
           $sql = "INSERT INTO $this->table (fk_orientador, fk_campus, seq, status) VALUES (:fk_orientador, :fk_campus, :seq,  :status)";
	   $seq = $OrientadorCampus->getSeq();
	   $status = $OrientadorCampus->getStatus();
           $fkorientador = $OrientadorCampus->getfkOrientador();
	   $fkcampus = $OrientadorCampus->getFkCampus();
           $stmt = ConnectionFactory::prepare($sql);
           $stmt->bindParam(':fk_orientador', $fkorientador);
	   $stmt->bindParam(':fk_campus', $fkcampus);
	   $stmt->bindParam(':seq', $seq);
	   $stmt->bindParam(':status', $status);
           return $stmt->execute();    
	}
	
	/**
 	 * atualiza um registro da tabela
 	 *
 	 * @parametro OrientadorCampusMySql orientadorCampu
 	 */
         
	public function update(OrientadorCampus $OrientadorCampus){
           $sql = "UPDATE $this->table SET seq = :seq, status = :status WHERE fk_campus = :id";
           $id = $OrientadorCampus->getFkCampus();
     
           
	   $seq = $OrientadorCampus->getSeq();
	   $status = $OrientadorCampus->getStatus();
           
           $stmt = ConnectionFactory::prepare($sql);
           $stmt->bindParam(':id', $id);
           
           
	   $stmt->bindParam(':seq', $seq);
	   $stmt->bindParam(':status', $status);
           
           return $stmt->execute(); 
	}

    public function loadOrientadorCampus($id_orientador, $id_campus) {
        $sql= "SELECT count(*) as count FROM `$this->table` WHERE fk_orientador = :fk_orientador  AND fk_campus = :fk_campus";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':fk_orientador', $id_orientador);
        $stmt->bindParam(':fk_campus', $id_campus);
        $stmt->execute();
        return $stmt->fetch();
    }

   
    public function load2($id_orientador, $id_campus) {
        $sql = "SELECT u.*, ca.nome as nome_campus FROM orientador o "
                . "INNER JOIN orientador_campus oc ON oc.fk_orientador = o.fk_usuario "
                . "INNER JOIN campus ca ON ca.id_campus = oc.fk_campus "
                . "INNER JOIN usuario u ON u.id_usuario = o.fk_usuario "
                . "WHERE u.id_usuario = :id_orientador AND ca.id_campus = :id_campus ";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id_orientador', $id_orientador, PDO::PARAM_INT);
        $stmt->bindParam(':id_campus', $id_campus, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    
}
