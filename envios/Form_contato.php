<?php
require_once("../../../config/config.php");
require_once("../../../classes/dados/form.php");

$contatoNeg = new FormDados();

foreach($_REQUEST as $key=>$value):
	$contato->$key=$value;
endforeach;
	$salvou = $contatoNeg->gravar($contato,'contato');
	//echo $salvou;
	if ($salvou):
		#para quem o email, 
			$para2 = "renato@lakersbrasil.com, contato@lakersbrasil.com";
			#assunto
			$subject2 = "CONTATO - LAKERS BRASIL";
			
			#corpo do e-mail
			$texto2= '
			<body>
				<table cellspacing="0" cellpadding="0">
				<tr bgcolor="#ffffff">

					<td>
					<font face="Verdana" color="#ffcc02" size="3">
					<h3>QUEM ENVIOU?</h3>
					</font>
					<font face="Verdana" size="2">
					<p>
					Nome: '.$_REQUEST['nome'].'<br/>
					E-mail: '.$_REQUEST['email'].'<br/>
					Cidade/Estado: '.$_REQUEST['cidade'].'<br/>
					</p>
					</font>
					<font face="Verdana" color="#ffcc02" size="3">
					<h3>O QUE FALOU?</h3>
					</font>
					<font face="Verdana" size="2">
					<p>
					'.$_REQUEST['mensagem'].'
					</p>	
					</font>
					</td>
				</tr>
				</table>
			</body>
			';
			
			#formato do email
			$headers2  = "MIME-Version: 1.0\r\n";
			$headers2 .= "Content-type: text/html; charset=iso-8859-1\r\n";
			#nome de quem esta enviando
			$headers2 .= "From: ".$_REQUEST['nome']." <".$_REQUEST['email'].">";
			
			#enviando o email
			mail ($para2, $subject2, $texto2, $headers2);
		echo "ok|Mensagem enviada com sucesso!";
	else:
		echo "erro|Tente novamente mais tarde!";
	endif;

?>