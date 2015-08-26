<?php
/**
* Classe de operação da tabela 'sessao'. Banco de Dados Mysql.
* Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
* novos templates em Persistent Data Object com definição de prepared statements contra
* sql injection, utilize para meio de testes, nunca coloque em produção, servindo
* apenas de trampolin para classe de produção
*
* @autor: Alessander Wasem
* @data: 2014-05-21 21:57
*/
class SessaoMySqlDAO implements SessaoDAO{
        
        protected $table = 'sessao';
        
	/**
	 * Implementa o dominio chave primária na seleção de único registro
	 *
	 * @parametro String $id primary key
	 * @retorna SessaoMySql 
	 */
         
	public function load($id){
            $sql = "SELECT * FROM $this->table WHERE id_sessao = :id_sessao";
            $stmt = ConnectionFactory::prepare($sql);
            $stmt->bindParam(':id_sessao', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
	}
        
        public function querySessaoByAvaliador($id_avaliador) {
            $sql =<<<SQL
                    select 

                    sessao.id_sessao,
                    sessao.numero,
                    sessao.nome,
                    sessao.sala,
                    sessao.nome_sala,
                    sessao.andar,
                    sessao.nome_andar,
                    sessao.data,
                    sessao.hora_ini,
                    sessao.hora_fim,
                    avaliador_sessao.status

                    from sessao

                    inner join avaliador_sessao on sessao.id_sessao = avaliador_sessao.fk_sessao
                    where fk_avaliador = :id_avaliador;
SQL;
            $stmt = ConnectionFactory::prepare($sql);
            $stmt->bindParam(':id_avaliador', $id_avaliador, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        
        public function updateConfirmacaoSessao($id_avaliador, $id_sessao, $status_int) {
            
            $sql =<<<SQL
                    
                    update avaliador_sessao 
                        set status = :status_int 
                        where fk_sessao = :id_sessao and fk_avaliador = :id_avaliador
SQL;
            $stmt = ConnectionFactory::prepare($sql);
            $stmt->bindParam(':id_avaliador', $id_avaliador, PDO::PARAM_INT);
            $stmt->bindParam(':id_sessao', $id_sessao, PDO::PARAM_INT);
            $stmt->bindParam(':status_int', $status_int, PDO::PARAM_INT);
            
            return $stmt->execute();
            
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
 	 * @parametro sessao chave primária
 	 */
         
	public function delete($id){
            $sql = "DELETE FROM $this->table WHERE id_sessao = :id_sessao";
            $stmt = ConnectionFactory::prepare($sql);
            $stmt->bindParam(':id_sessao', $id, PDO::PARAM_INT);
            return $stmt->execute();
	}
	
	/**
 	 * Inseri um registro na tabela
 	 *
 	 * @parametro SessaoMySql sessao
 	 */
         
	public function insert(Sessao $Sessao){
           $sql = "INSERT INTO $this->table (numero, nome, sala, nome_sala, andar, nome_andar, data, hora_ini, hora_fim, fk_modalidade, status) VALUES ( :numero,  :nome,  :sala,  :nomeSala,  :andar,  :nomeAndar,  :data,  :horaIni,  :horaFim,  :fkModalidade,  :status)";
  
           
	   $numero = $Sessao->getNumero();
	   $nome = $Sessao->getNome();
	   $sala = $Sessao->getSala();
	   $nomeSala = $Sessao->getNomeSala();
	   $andar = $Sessao->getAndar();
	   $nomeAndar = $Sessao->getNomeAndar();
	   $data = $Sessao->getData();
	   $horaIni = $Sessao->getHoraIni();
	   $horaFim = $Sessao->getHoraFim();
	   $fkModalidade = $Sessao->getFkModalidade();
	   $status = $Sessao->getStatus();
           
           $stmt = ConnectionFactory::prepare($sql);
           
           
	   $stmt->bindParam(':numero', $numero);
	   $stmt->bindParam(':nome', $nome);
	   $stmt->bindParam(':sala', $sala);
	   $stmt->bindParam(':nomeSala', $nomeSala);
	   $stmt->bindParam(':andar', $andar);
	   $stmt->bindParam(':nomeAndar', $nomeAndar);
	   $stmt->bindParam(':data', $data);
	   $stmt->bindParam(':horaIni', $horaIni);
	   $stmt->bindParam(':horaFim', $horaFim);
	   $stmt->bindParam(':fkModalidade', $fkModalidade);
	   $stmt->bindParam(':status', $status);
           return $stmt->execute();    
	}
	
	/**
 	 * atualiza um registro da tabela
 	 *
 	 * @parametro SessaoMySql sessao
 	 */
         
	public function update(Sessao $Sessao){
           $sql = "UPDATE $this->table SET numero = :numero, nome = :nome, sala = :sala, nome_sala = :nome_sala, andar = :andar, nome_andar = :nome_andar, data = :data, hora_ini = :hora_ini, hora_fim = :hora_fim, fk_modalidade = :fk_modalidade, status = :status WHERE id_sessao = :id";
           $id = $Sessao->getIdSessao();
     
           
	   $numero = $Sessao->getNumero();
	   $nome = $Sessao->getNome();
	   $sala = $Sessao->getSala();
	   $nomeSala = $Sessao->getNomeSala();
	   $andar = $Sessao->getAndar();
	   $nomeAndar = $Sessao->getNomeAndar();
	   $data = $Sessao->getData();
	   $horaIni = $Sessao->getHoraIni();
	   $horaFim = $Sessao->getHoraFim();
	   $fkModalidade = $Sessao->getFkModalidade();
	   $status = $Sessao->getStatus();
           
           $stmt = ConnectionFactory::prepare($sql);
           $stmt->bindParam(':id', $id);
           
           
	   $stmt->bindParam(':numero', $numero);
	   $stmt->bindParam(':nome', $nome);
	   $stmt->bindParam(':sala', $sala);
	   $stmt->bindParam(':nomeSala', $nomeSala);
	   $stmt->bindParam(':andar', $andar);
	   $stmt->bindParam(':nomeAndar', $nomeAndar);
	   $stmt->bindParam(':data', $data);
	   $stmt->bindParam(':horaIni', $horaIni);
	   $stmt->bindParam(':horaFim', $horaFim);
	   $stmt->bindParam(':fkModalidade', $fkModalidade);
	   $stmt->bindParam(':status', $status);
           
           return $stmt->execute(); 
	}

}
