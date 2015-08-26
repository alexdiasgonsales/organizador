<?php
session_start();

include("../conexao.php");
include("../funcoes.php");

# PARTE 01 : Verificar existência do CPF
if(isset($_POST["opcao"]) && $_POST["opcao"]=="verExistenciaCpf") {
	$cpf = inclui_zeros(mysql_real_escape_string($_POST['cpf']),11);
	$id = confereExistencia($cpf, $conexao);
    $papel = mysql_real_escape_string($_POST["papel"]);
	// Caso 01: Usuario NOVO
	if($id == 0) { 
		$ans = 10;
		$resp = "dados = {retorno:'".$ans."'}";
		echo $resp;
		exit;
	} else {
		$id2 = conferePapelId ($id, $papel, $conexao);
		// Caso 02.1: USUARIO, mas nao 'papel'
		if($id2 == 0) { 
			$ans = 20;
			$resp = "dados={retorno:'".$ans."', id_usuario:'".$id."'}";
			echo $resp;
			exit;
		// Caso 02.2: Esta cadastrado em USUARIO e PAPEL
		} else { 
			$ans = 30;
			$resp = "dados={retorno:'".$ans."'}";
			echo $resp;
			exit;
		}
	} 
	
# PARTE 02: 'Cadastrar' como novo usuario   
} else if(isset($_POST['opcao']) && $_POST['opcao']=="cadastrarUsuario") {

	$ans = 11;
	$resp = "dados={retorno:'".$ans."'}";
	echo $resp;
	exit;
    
# PARTE 03: Cadastrar novos papeis
// CADASTRO DE NOVO AUTOR
// retorno: 40 = sucesso (login) -1 = erro
}  else if(isset($_POST['opcao']) && $_POST['opcao']=="cadastrarAutor"){  
		
        
	$id_user = cadastraUsuario($conexao);
	
	$id_curso = (int)$_POST["f_curso"];
    
	$query = "INSERT INTO autor
				(fk_usuario)
			VALUES
				('$id_user')";
       
	$sql = runSQL($query);
	$confirma = recNumRows ($id_user, "fk_usuario", "autor", $conexao);
		
	//Se autor foi cadastrado: CONTINUAR cadastro
	if($confirma == 1) {
		$query2 = "INSERT INTO autor_curso
					(fk_autor, fk_curso, seq)
				VALUES
					('$id_user', '$id_curso', '1')";
	
		$result2 = runSQL($query2);
		
		$queryConfere = "SELECT *
						FROM autor_curso
						WHERE fk_autor = '".$id_user."'
						AND fk_curso = '".$id_curso."'";
		
		$sqlConfere = runSQL($queryConfere);	
		$Confere = mysql_num_Rows($sqlConfere);
			
		// Se os dados autor_curso foram cadastrados: criar sessao
		if($Confere == 1) {
			criarSessao($id_user, $conexao);
			$ans = 40;
		// Se os dados autor_curso nao foram cadastrados: ERRO
		} else {
			$ans = -1;
		}
	// Se autor nao foi cadastrado: ERRO
	} else {
		$ans = -1;
	}
	$resp = "dados={retorno:'".$ans."', id_usuario:'".$id_user."'}";
    echo $resp;
    exit;	
	
// CADASTRO DE NOVO OUVINTE
// retorno: 40 = sucesso (login) -1 = erro
} else if(isset($_POST['opcao']) && $_POST['opcao']=="cadastrarOuvinte"){ 
		
       
	$id_user = cadastraUsuario($conexao);
	if(isset($_POST["descTipoOuvinte"])) {
		$outro = mysql_real_escape_string($_POST["descTipoOuvinte"]);
	} else {
		$outro = NULL;
	}
	if(isset($_POST["empresaOuvinte"])) {
		$empresa = mysql_real_escape_string($_POST["empresaOuvinte"]);
	} else {
		$empresa = NULL;
	}
	$tipoOuvinte = (int)$_POST["tipoOuvinte"];
	if(isset($_POST["f_instituicao"]) && $_POST["f_instituicao"] != 0) {
		$id_inst = (int)$_POST["f_instituicao"];
		if(isset($_POST["f_campus"]) && $_POST["f_campus"] != 0) {
			$id_campus = (int)$_POST["f_campus"];
			if(isset($_POST["f_curso"]) && $_POST["f_curso"] != 0) {
				$id_curso = (int)$_POST["f_curso"];
				// caso 4: possui todos os valores
				$query = "INSERT INTO ouvinte
				            (fk_usuario, fk_instituicao, fk_campus, fk_curso, tipo_ouvinte, outro, empresa)
				          VALUES
				            ('$id_user', '$id_inst', '$id_campus', '$id_curso', '$tipoOuvinte', '$outro', '$empresa')";
			} else {
				// caso 2: possui INST/CAMP
				$query = "INSERT INTO ouvinte
				            (fk_usuario, fk_instituicao, fk_campus, tipo_ouvinte, outro, empresa)
				          VALUES
				            ('$id_user', '$id_inst', '$id_campus', '$tipoOuvinte', '$outro', '$empresa')";
			}
		} else {
			//  caso 3: possui somente INST 
			$query = "INSERT INTO ouvinte
				        (fk_usuario, fk_instituicao, tipo_ouvinte, outro, empresa)
				     VALUES
				        ('$id_user', '$id_inst', '$tipoOuvinte', '$outro', '$empresa')";
		}
	} else { 
		// caso 4: NAO possui nenhum dos valores inst/camp/curso
		$query = "INSERT INTO ouvinte
				     (fk_usuario, tipo_ouvinte, outro, empresa)
				  VALUES
				     ('$id_user', '$tipoOuvinte', '$outro', '$empresa')";
	}

	$sql = runSQL($query);
	$confirma = recNumRows ($id_user, "fk_usuario", "ouvinte", $conexao);
		
	//Se ouvinte foi cadastrado com sucesso: criar sessao
	if($confirma == 1) {
		criarSessao($id_user, $conexao);
		$ans = 40;
	//Se ouvinte NAO foi cadastrado com sucesso: ERRO
	} else {
		$ans = -1;
	}
	
	$resp = "dados={retorno:'".$ans."', id_usuario:'".$id_user."'}";
    echo $resp;
    exit;		
// CADASTRO DE NOVO VOLUNTARIO
// retorno: 40 = sucesso (login) -1 = erro
} else if(isset($_POST['opcao']) && $_POST['opcao']=="cadastrarVoluntario"){ 
	
        $tel1 = $tel2 = $tel3 = "";
        $tel1 = $_POST["telefone1"];
        $tel2 = $_POST["telefone2"];
        $tel3 = $_POST["telefone3"];
        $cbManha = $cbTarde = $cbNoite = 'N';
        if(isset($_POST["cbManha"])){
            $cbManha = 'S';
        }
        if(isset($_POST["cbTarde"])){
            $cbTarde = 'S';
        }
        if(isset($_POST["cbNoite"])){
            $cbNoite = 'S';
        }
        
        if(($cbManha != 'N' || $cbTarde != 'N' || $cbNoite != 'N') && ($tel1 != "")){ //pelo menos um turno deve ter sido selecionado
	
            $id_user = cadastraUsuario($conexao);
            $id_campus = (int)$_POST["f_campus"];
            $id_curso = (int)$_POST["f_curso"];
            $query = "INSERT INTO voluntario
                                    (fk_usuario, fk_curso, Manha, Tarde, Noite, Telefone1, Telefone2, Telefone3)
                              VALUES
                                    ('$id_user', '$id_curso', '$cbManha', '$cbTarde', '$cbNoite', '$tel1','$tel2','$tel3')";

            $sql = runSQL($query);
            $confirma = recNumRows ($id_user, "fk_usuario", "voluntario", $conexao);

            //Se voluntario foi cadastrado: criar sessão
            if($confirma == 1) {
                    criarSessao($id_user, $conexao);
                    $ans = 40;
            //Se voluntario nao foi cadastrado: ERRO
            } else {
                    $ans = -1;
            }
        }else{
            $id_user= 0;
            if($tel1 == ""){
                $ans = -12; //usuario não informou o telefone obrigatório
            } else {
                $ans = -11; //usuario nao selecionou turno
            }
        }
	$resp = "dados={retorno:'".$ans."', id_usuario:'".$id_user."'}";
    echo $resp;
    exit;	
	
// CADASTRO DE NOVO ORIENTADOR
// retorno: 40 = sucesso (login) -1 = erro
} else if(isset($_POST['opcao']) && $_POST['opcao']=="cadastrarOrientador"){ 
	
	$id_user = cadastraUsuario($conexao);
	$id_campus = (int)$_POST["f_campus"];
	$tipoServidor = (int)$_POST["tipoServidorOrientador"];
	
	$query = "INSERT INTO orientador
			(fk_usuario, tipo_servidor)
		VALUES
			(".$id_user.", ".$tipoServidor.")";
			
	$sql = runSQL($query);
	$confirma = recNumRows ($id_user, "fk_usuario", "orientador", $conexao);
	
	// Se cadastro do orientador foi realizado com sucesso: CONTINUAR cadastro
	if($confirma == 1) {
		$query2 = "INSERT INTO orientador_campus (fk_orientador, fk_campus, seq)
					VALUES (".$id_user.", ".$id_campus.", 1)";
	
		$result2 = runSQL($query2);
		
		$queryConfere = "SELECT *
						FROM orientador_campus
						WHERE fk_orientador = ".$id_user."
						AND fk_campus = ".$id_campus;
		
		$sqlConfere = runSQL($queryConfere);	
		$confere = mysql_num_Rows($sqlConfere);
			
		// Se os dados orientador_campus foram cadastrados: criar sessao
		if($confere == 1) {
			criarSessao($id_user, $conexao);
			$ans = 40;
		// Se os dados orientador_campus nao foram cadastrados: ERRO
		} else {
			$ans = -1;
		}
	// Se orientador nao foi cadastrado com sucesso: ERRO
	} else {
		$ans = -1;
	}
	$resp = "dados={retorno:'".$ans."', id_usuario:'".$id_user."'}";
    echo $resp;
    exit;	
	
// CADASTRO DE NOVO AVALIADOR
// retorno: 40 = sucesso (login) -1 = erro			
} else if(isset($_POST['opcao']) && $_POST['opcao']=="cadastrarAvaliador"){ 
	
	$id_user = cadastraUsuario($conexao);
	$id_campus = (int)$_POST["f_campus"];
	$tipoServidor = (int)$_POST["tipoServidorAvaliador"];
	$nivelFormacao = (int)$_POST["nivelFormacao"];
	
	$query = "INSERT INTO avaliador
			(fk_usuario, fk_campus, tipo_servidor, formacao)
		VALUES
			('$id_user', '$id_campus', '$tipoServidor', '$nivelFormacao')";
			
	$sql = runSQL($query);
	$confirma = recNumRows ($id_user, "fk_usuario", "avaliador", $conexao);
	
	// Se cadastro do avaliador foi realizado: CONTINUAR cadastro
	if($confirma == 1) {
		criarSessao($id_user, $conexao);
		$ans = 40;
	// Se cadastro do avaliador nao foi realizado: ERRO
	} else {
		$ans = -1;
	}
	$resp = "dados={retorno:'".$ans."', id_usuario:'".$id_user."'}";
    echo $resp;
    exit;
	
} else if(isset($_POST['opcao']) && $_POST['opcao']=="conferirSenha") {
    
	$id = (int)$_POST["id_usuario"];
    
	$senha = mysql_real_escape_string($_POST['senha']);
	
	$arr = recLinha ($id, "id_usuario", "usuario", $conexao);
	// CASO 01: retorna 1: senha esta correta
	$senha = MD5($senha);
	if($senha == $arr['senha']) {
	    $ans = 22;
    } else {
		$ans = 21;
	}
	$resp = "dados={retorno:'".$ans."', id_usuario: '".$id."', nome: '".$arr["nome"]."', email: '".$arr["email"]."'}";
    echo $resp;
    exit;
	
}

#
# FUNCOES ******************************************************************************
#

// Funcao efetua cadastro do usuario no bd
// Retorno: id_usuario

function cadastraUsuario($conexao) {

	// recebe os dados:
	$cpf = inclui_zeros(mysql_real_escape_string($_POST['cpf']),11);
	$nome = mysql_real_escape_string($_POST['nome']);
	$email = mysql_real_escape_string($_POST['email']);
	if (isset($_REQUEST['senha'])){
		$senha = mysql_real_escape_string($_POST['senha']);
	} else {
		$senha = "tec".rand(1,1000);
	}

	$sql = "INSERT INTO usuario
            ( cpf, nome, email, senha ) 
            VALUES
            ( '$cpf', '$nome', '$email', MD5('$senha')) ";
    
    $result = runSQL($sql);
	$cpf = stripslashes($cpf);
	$email = stripslashes($email);
	$nome = stripslashes($nome);
	$senha = stripslashes($senha);
	
	  // envio email para a mostra:
	  $sHeader = "From: mostra@poa.ifrs.edu.br\n";
	  $sTo = "mostratec@poa.ifrs.edu.br";
      $sSubject = "Inscrição Usuário";
	  $sBody  = "Nome: ".$nome."\n";
      $sBody .= "CPF:  ".$cpf."\n";
      if (CONST_TIPO_VERSAO=="PRODUCAO")
          $Envio = mail($sTo, $sSubject, $sBody, $sHeader);

	  // envio email para o usuario:
	  $sHeader = "From: mostra@poa.ifrs.edu.br\n";
      $sTo = $email;
      $sSubject = "Mostra de Pesquisa, Ensino e Extensão - IFRS - Porto Alegre";
	  
	  $sBody = $nome.",\n\n";
	  
      $sBody .= "Você efetuou inscrição na 14ª Mostra de Pesquisa, Ensino e Extensão do IFRS Câmpus Porto Alegre.\n\n";
	  
	  $sBody .= "Para entrar no sistema:\n";
      $sBody .= "CPF: ".$cpf."\n";
      $sBody .= "Senha: ".$senha."\n\n";
	  
	  $sBody .= "Sistema de Inscrição da 14ª Mostra de Pesquisa, Ensino e Extensão\n";
	  $sBody .= "IFRS - Câmpus Porto Alegre\n";
	  $sBody .= "http://mostra.poa.ifrs.edu.br/2012/sistema/index.php\n";
	  
      if (CONST_TIPO_VERSAO=="PRODUCAO")
	      $Envio = mail($sTo, $sSubject, $sBody, $sHeader);
	
	$id = confereExistencia ($cpf, $conexao);
	
	return $id;
	
}

// Funcao cria uma nova sessão
// Retorno: 1 = sucesso  0 = erro

function criarSessao($id, $conexao) {
	// recupera dados do usuario 
	$linha_login = recLinha($id, "id_usuario", "usuario", $conexao);
	
	$_SESSION["id_usuario"] = $id;
	$_SESSION['nome_usuario'] = $linha_login['nome'];
		
	$ans = 1;
	
	return $ans; 
}


?>

