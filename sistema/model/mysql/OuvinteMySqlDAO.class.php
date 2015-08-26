<?php
/**
* Classe de operação da tabela 'ouvinte'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class OuvinteMySqlDAO implements OuvinteDAO{
        
        protected $table = 'ouvinte';
        
	/**
	 * Implementa o dominio chave primária na seleção de único registro
	 *
	 * @parametro String $id primary key
	 * @retorna OuvinteMySql 
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
 	 * @parametro ouvinte chave primária
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
 	 * @parametro OuvinteMySql ouvinte
 	 */
         
	public function insert(Ouvinte $Ouvinte){
           $sql = "INSERT INTO $this->table (fk_usuario, fk_instituicao, fk_campus, fk_curso, tipo_ouvinte, outro, empresa) VALUES (:fkUsuario, :fkInstituicao,  :fkCampus,  :fkCurso,  :tipoOuvinte,  :outro,  :empresa)";
  
           $fkUsuario = $Ouvinte->getFkUsuario();
	   $fkInstituicao = $Ouvinte->getFkInstituicao() == '' ? null : $Ouvinte->getFkInstituicao();
	   $fkCampus = $Ouvinte->getFkCampus() == '' ? null : $Ouvinte->getFkCampus();
	   $fkCurso = $Ouvinte->getFkCurso() == '' ? null : $Ouvinte->getFkCurso();
	   $tipoOuvinte = $Ouvinte->getTipoOuvinte();
	   $outro = $Ouvinte->getOutro();
	   $empresa = $Ouvinte->getEmpresa();
           
           $stmt = ConnectionFactory::prepare($sql);
           
           $stmt->bindParam(':fkUsuario', $fkUsuario);
	   $stmt->bindParam(':fkInstituicao', $fkInstituicao);
	   $stmt->bindParam(':fkCampus', $fkCampus);
	   $stmt->bindParam(':fkCurso', $fkCurso);
	   $stmt->bindParam(':tipoOuvinte', $tipoOuvinte);
	   $stmt->bindParam(':outro', $outro);
	   $stmt->bindParam(':empresa', $empresa);
           return $stmt->execute();    
	}
	
	/**
 	 * atualiza um registro da tabela
 	 *
 	 * @parametro OuvinteMySql ouvinte
 	 */
         
	public function update(Ouvinte $Ouvinte){
           $sql = "UPDATE $this->table SET fk_instituicao = :fk_instituicao, fk_campus = :fk_campus, fk_curso = :fk_curso, tipo_ouvinte = :tipo_ouvinte, outro = :outro, empresa = :empresa WHERE fk_usuario = :id";
           $id = $Ouvinte->getFkUsuario();
     
           
	   $fkInstituicao = $Ouvinte->getFkInstituicao();
	   $fkCampus = $Ouvinte->getFkCampus();
	   $fkCurso = $Ouvinte->getFkCurso();
	   $tipoOuvinte = $Ouvinte->getTipoOuvinte();
	   $outro = $Ouvinte->getOutro();
	   $empresa = $Ouvinte->getEmpresa();
           
           $stmt = ConnectionFactory::prepare($sql);
           $stmt->bindParam(':id', $id);
           
           
	   $stmt->bindParam(':fkInstituicao', $fkInstituicao);
	   $stmt->bindParam(':fkCampus', $fkCampus);
	   $stmt->bindParam(':fkCurso', $fkCurso);
	   $stmt->bindParam(':tipoOuvinte', $tipoOuvinte);
	   $stmt->bindParam(':outro', $outro);
	   $stmt->bindParam(':empresa', $empresa);
           
           return $stmt->execute(); 
	}
        
        public function loadOuvinteArea($id){      
            $sql = "SELECT instituicao.nome AS instituicao, instituicao.sigla AS sigla, campus.nome AS campus, ouvinte.outro AS outro, ouvinte.empresa, curso.nome AS curso, 
                    CASE ouvinte.tipo_ouvinte
                    WHEN 1 
                    THEN  ' Docente'
                    WHEN 2 
                    THEN  ' Técnico Administrativo'
                    WHEN 3 
                    THEN  ' Aluno'
                    WHEN 4 
                    THEN  ' Outro'
                    ELSE  null
                    END AS tipo,
                    CASE curso.nivel
                    WHEN 2 
                    THEN  '(Técnico) - '
                    WHEN 3 
                    THEN  '(Superior) - '
                    ELSE  null
                    END AS nivel
                    FROM ((ouvinte
                    LEFT JOIN campus ON ouvinte.fk_campus = campus.id_campus)
                    LEFT JOIN curso ON ouvinte.fk_curso = curso.id_curso)
                    LEFT JOIN instituicao ON ouvinte.fk_instituicao = instituicao.id_instituicao 
                    WHERE fk_usuario = :fk_usuario";
            $stmt = ConnectionFactory::prepare($sql);
            $stmt->bindParam(':fk_usuario', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
	}

}
