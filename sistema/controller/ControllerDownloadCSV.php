<?php


require_once '../lib/PHPExcel/PHPExcel.php';
require_once './autoload.php';

$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);
$user_type = $_GET['user_type'];

switch ($user_type) {
    
    case 'trabalho':
        $trabalho = new TrabalhoMySqlDAO();
        $lista_trabalhos = $trabalho->queryAllTrabalhosFormatoCertificado();
        
        $objPHPExcel->getActiveSheet()->setCellValue('A1', "NOME_PARTICIPANTE");
        $objPHPExcel->getActiveSheet()->setCellValue('B1', "EMAIL_PARTICIPANTE");
        $objPHPExcel->getActiveSheet()->setCellValue('C1', "CPF_PARTICIPANTE");
        $objPHPExcel->getActiveSheet()->setCellValue('D1', "TITULO_TRABALHO");
        $objPHPExcel->getActiveSheet()->setCellValue('E1', "AUTOR_TRABALHO");
        $objPHPExcel->getActiveSheet()->setCellValue('F1', "ORIENTADOR_TRABALHO");
        
        $i = 2;
        foreach ($lista_trabalhos as $linha) {
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $linha->nome );
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $linha->email );
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $linha->cpf );
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $linha->titulo );
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $linha->autor_trabalho );
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $linha->orientador_trabalho );
        
           $i++;
        }
        
        break;
    
    case 'orientador':
        
        $orientador = new OrientadorMySqlDAO();
        $orgOrientador = $orientador->queryAllHomologacaoOrientador();
        
        $objPHPExcel->getActiveSheet()->setCellValue('A1', "ID");
        $objPHPExcel->getActiveSheet()->setCellValue('B1', "Nome");
        $objPHPExcel->getActiveSheet()->setCellValue('C1', "Email");
        $objPHPExcel->getActiveSheet()->setCellValue('D1', "Campus");
        $objPHPExcel->getActiveSheet()->setCellValue('E1', "Inst");
        $objPHPExcel->getActiveSheet()->setCellValue('F1', "Tipo de Servidor");
        $objPHPExcel->getActiveSheet()->setCellValue('G1', "Status");

        $i = 2;
        foreach ($orgOrientador as $ori) {
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $ori->usuario_id );
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $ori->usuario_nome);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $ori->usuario_email);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $ori->campus_nome);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $ori->sigla_instituicao);
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $ori->orientador_tipo_servidor_char);
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $arr_status_usuario[$ori->orientador_status][0]);
            
            
            $i++;
        }
        
        break;
    
    case 'avaliador':
        $avaliador = new AvaliadorMySqlDAO();
        $orgAvaliador = $avaliador->queryAllAvaliadores();
        
        $objPHPExcel->getActiveSheet()->setCellValue('A1',"ID");
        $objPHPExcel->getActiveSheet()->setCellValue('B1',"Nome");
        $objPHPExcel->getActiveSheet()->setCellValue('C1',"Email");
        $objPHPExcel->getActiveSheet()->setCellValue('D1',"Campus");
        $objPHPExcel->getActiveSheet()->setCellValue('E1',"Inst");
        $objPHPExcel->getActiveSheet()->setCellValue('F1',"Formação do Avaliador");
        $objPHPExcel->getActiveSheet()->setCellValue('G1',"Tipo de Avaliador");
        $objPHPExcel->getActiveSheet()->setCellValue('H1',"Área Temática");
        $objPHPExcel->getActiveSheet()->setCellValue('I1',"Status do Avaliador");
        
        $i = 2;
        foreach ($orgAvaliador as $ava) {
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $ava->usuario_id);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $ava->usuario_nome);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $ava->usuario_email);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $ava->avaliador_campus_nome);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $ava->avaliador_instituicao_sigla);
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $ava->avaliador_formacao);
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $arr_tipo_avaliador[$ava->avaliador_tipo_servidor]);
            $objPHPExcel->getActiveSheet()->setCellValue('H'.$i, OtherFuctions::lmWord($ava->area_nome, 50));
            $objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $arr_status_usuario[$ava->avaliador_status][0]);
            
            }
        break;
    
    case 'voluntario':
        $voluntarioOrg = new VoluntarioMySqlDAO();
        $orgVoluntario = $voluntarioOrg->queryAllVoluntario();
            
        $file_str = "ID,Nome,Email,Curso,Campus,Sigla Inst,Fone,Fone,Fone,Turno Manhã,Turno Tarde,Turno Noite,Status do Voluntário \n";
        
        $objPHPExcel->getActiveSheet()->setCellValue('A1', "ID");
        $objPHPExcel->getActiveSheet()->setCellValue('B1', "Nome");
        $objPHPExcel->getActiveSheet()->setCellValue('C1', "Email");
        $objPHPExcel->getActiveSheet()->setCellValue('D1', "Curso");
        $objPHPExcel->getActiveSheet()->setCellValue('E1', "Campus");
        $objPHPExcel->getActiveSheet()->setCellValue('F1', "Sigla Inst");
        $objPHPExcel->getActiveSheet()->setCellValue('G1', "Fone");
        $objPHPExcel->getActiveSheet()->setCellValue('H1', "Fone");
        $objPHPExcel->getActiveSheet()->setCellValue('I1', "Fone");
        $objPHPExcel->getActiveSheet()->setCellValue('J1', "Turno Manhã");
        $objPHPExcel->getActiveSheet()->setCellValue('K1', "Turno Tarde");
        $objPHPExcel->getActiveSheet()->setCellValue('L1', "Turno Noite");
        $objPHPExcel->getActiveSheet()->setCellValue('M1', "Status do Voluntário");
        
        $i = 2;
        foreach ($orgVoluntario as $volu) {

            $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $volu->usuario_id);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, OtherFuctions::lmWord($volu->usuario_nome, 100));
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, OtherFuctions::lmWord($volu->usuario_email, 100));
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$i, OtherFuctions::lmWord($volu->voluntario_curso_nome, 100));
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, OtherFuctions::lmWord($volu->voluntario_campus_nome, 100));
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$i, OtherFuctions::lmWord($volu->voluntario_instituicao_sigla, 20));
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$i, OtherFuctions::lmWord($volu->voluntario_fone1, 10));
            $objPHPExcel->getActiveSheet()->setCellValue('H'.$i, OtherFuctions::lmWord($volu->voluntario_fone2, 10));
            $objPHPExcel->getActiveSheet()->setCellValue('I'.$i, OtherFuctions::lmWord($volu->voluntario_fone3, 10));
            $objPHPExcel->getActiveSheet()->setCellValue('J'.$i, OtherFuctions::lmWord($volu->voluntario_manha, 1));
            $objPHPExcel->getActiveSheet()->setCellValue('K'.$i, OtherFuctions::lmWord($volu->voluntario_tarde, 1));
            $objPHPExcel->getActiveSheet()->setCellValue('L'.$i, OtherFuctions::lmWord($volu->voluntario_noite, 1));
            $objPHPExcel->getActiveSheet()->setCellValue('M'.$i, $arr_status_usuario[$volu->voluntario_status][0]);
            
        }
        break;
    
    case 'autor':
        $autor = new AutorMySqlDAO();
        $autor_list = $autor->queryAllAutor();
        
        $objPHPExcel->getActiveSheet()->setCellValue('A1',"ID");
        $objPHPExcel->getActiveSheet()->setCellValue('B1',"Nome");
        $objPHPExcel->getActiveSheet()->setCellValue('C1',"Email");
        $objPHPExcel->getActiveSheet()->setCellValue('D1',"Curso");
        $objPHPExcel->getActiveSheet()->setCellValue('E1',"Campus");
        $objPHPExcel->getActiveSheet()->setCellValue('F1',"Sigla Inst");
        $objPHPExcel->getActiveSheet()->setCellValue('G1',"Status do Autor");
        
        $i = 2;
        foreach ($autor_list as $aut) {

            $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $aut->usuario_id);
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $aut->usuario_nome);
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $aut->usuario_email);
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $aut->autor_curso_nome);
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $aut->autor_campus_nome);
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $aut->autor_instituicao_sigla);
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $arr_status_usuario[$aut->autor_status][0]);
            
        }
        break;
    
    default:
        http_response_code(500);
        die;
        break;
}

header('Content-Type: application/xls');
header('Content-Disposition: attachment;filename="' . $user_type . '.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
