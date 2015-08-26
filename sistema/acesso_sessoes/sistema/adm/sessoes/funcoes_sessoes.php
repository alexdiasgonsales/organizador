<?php

/* ---------------------- Montar lista de autores/orientadores  ou com o e_mail dos mesmos ---------------------- */
function montar_lista($id_quest,$campo,$conexao)
{
	    $virgula="";
	    $lista_do_grupo_nome="";
		$indice=0;
        $tabela=array();
		$tabela[0]="tb_mostratec_autor";
		$tabela[1]="tb_mostratec_orientador"; //f_email f_nome
        while($indice<=1)
           {
                $sql_lista = "SELECT * FROM ".$tabela[$indice]." WHERE id_quest=".$id_quest." ";
                $result_lista = mysql_query($sql_lista,$conexao) or die(mysql_error());
                $num_reg_lista = mysql_num_rows($result_lista);
                while($linha_lista = mysql_fetch_array($result_lista))
                   {
		              if (trim($linha_lista[$campo])!="")
			             {
				            $lista_do_grupo_nome=$lista_do_grupo_nome.$virgula.$linha_lista[$campo];
							if (($campo!="f_email")&&($tabela[$indice]=="tb_mostratec_orientador"))
							   {
							       $lista_do_grupo_nome=$lista_do_grupo_nome."(orient)";
							   }
				            $virgula=", ";
				         }
	               }
				$indice++;
           }
        //mysql_close($conexao);
		return ($lista_do_grupo_nome);

 }


function unix_data($data)
{
   //$data no formato: aaaa-mm-dd hh:mm:ss
   //para segundos
   $segundo=(int)substr($data,17,2);
   $minuto=(int)substr($data,14,2);
   $hora=(int)substr($data,11,2);
   $dia=(int)substr($data,8,2);
   $mes=(int)substr($data,5,2);
   $ano=(int)substr($data,0,4);
   return mktime($hora,$minuto,$segundo,$mes,$dia,$ano);
}

function formata_data2($data_parm)
{
   $dias_semana = array('Domingo','Segunda-feira','Ter&ccedil;a-feira','Quarta-feira','Quinta-feira','Sexta-feira','S&aacute;bado');
   $mes_nome = array('janeiro','fevereiro','mar&ccedil;o','abril','maio','junho','julho','agosto','setembro','outubro','novembro','dezembro');
   $Data1 = unix_data($data_parm);
   $Data_array1=getdate($Data1);
   $mes_numero=(int)substr($data_parm,5,2);
   return $dias_semana[$Data_array1['wday']].", ".substr($data_parm,8,2)." de ".$mes_nome[$mes_numero-1]." de ".substr($data_parm,0,4).".";
}

function formata_data3($data)
{
  return substr($data, 8,2)."/".substr($data, 5,2)."/".substr($data, 0,4);
}

function formata_hora($hora)
{
  return substr($hora, 0, 2).":".substr($hora, 3,2);
}

function elDiff()
   {
	  return $strdata=str_replace(" ", "",str_replace(":", "",str_replace("-", "",date("Y-m-d H:i:s"))));
   }

function inclui_zeros($numero,$tamanho)
  {
     $numero2=trim($numero);
	 $numero2=str_replace("-", "",$numero2);
	 $numero2=str_replace(".", "",$numero2);
     $tamanho1=(int)$tamanho;
     $tamanho2=strlen($numero2);
     $contador=1;
     $numero3=$numero2;
     if ($tamanho2<$tamanho1)
        {
          for($contador=$tamanho2;$contador<$tamanho1;$contador++)
             {
                $numero3="0".$numero3;
             }
        }
     return $numero3;
  }


?>