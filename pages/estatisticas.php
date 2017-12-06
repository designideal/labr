<?php
require_once("config/config.php");
 
require_once("classes/dados/estatistica.php");
require_once("classes/dados/item.php");
require_once("classes/dados/elenco.php");
require_once("classes/dados/post_teste.php");

require_once("classes/funcoes.php");

$funcao = new Funcoes();

$estatisticaNeg = new EstatisticaDados();
$itemNeg = new ItemDados();
$elencoNeg = new ElencoDados();
$postNeg = new PostDados();

$titulo_pg = 'Estatísticas Lakers: análise dos números do time na temporada';
$img_pg = ROOT.'img/banner-noticia.png';
$img_mobile = ROOT.'img/noticia-vert.png';
$post = $postNeg->listar('','data_atualizacao DESC,id_post DESC','');
?>
<!doctype html>
<html class="no-js" lang="en">
  <?php include $diretorio.'/includes/header.php';?>
  <body>
  
	<!--TOP BAR  
  
	<nav class="top-bar hide-for-medium-up" data-topbar="" role="navigation">
      <ul class="title-area">
        <li class="name">
          <a href="#"></a>
        </li>
        <li class="toggle-topbar menu-icon"><a href=""><span></span></a></li>
      </ul>

      
    <section class="top-bar-section" style="left: 0%;">
        <ul class="right">
		  <li><a href="#">Notícias</a></li>
		  <li><a href="#">Stats</a></li>
		  <li><a href="#">Elenco</a></li>
		  <li><a href="#">História</a></li>
		  <li><a href="#">Vai à LA?</a></li>
		  <li><a href="#">Loja</a></li>
		  <li><a href="#">Contato</a></li>	             
        </ul>
      </section>
  </nav>
  
  FIM TOP BAR-->     
  

	  <div class="row">
		  <div class="medium-12 columns">
			  <div class="holder">
				  
				  <?php include $diretorio.'/includes/topo.php';?>
   
				  
				  <!--INICIO CONTEUDO-->
				  
				  
				  <div id="conteudo">

					  <section id="stats-interna">
						  <div class="row">
							  <?php 
								$ests = $estatisticaNeg->listar("tipo='time'",'');
								foreach($ests as $e):
									$item = $itemNeg->ler($e->id_quesito);
							  ?>
							  <div class="small-6 medium-3 columns">
								  <div class="item">
									  <span class="posicao"><?php echo $e->posicao?>º</span>
									  <span class="quesito"><?php echo $item->nome?> por jogo</span>
									  <span class="valor"><?php echo $e->score?></span>
								  </div>
							  </div>
							  <?php 
								endforeach;
							  ?> 							  							  							  
						  </div>
						  <?php 
							$item = $itemNeg->listar("tipo='quesito' AND nome!='Pts Contra'",'');
							foreach($item as $i):
								$ests = $estatisticaNeg->listar("tipo='jogador' AND id_quesito='".$i->id_item."'",'score DESC');
								if($ests[0]->id_jogador!=0):
						  ?>
						  <div class="row">
							  <div class="medium-12 columns text-center">
								  <h2><?php echo $i->nome?></h2>
							  </div>
						  </div>
						  <div class="row">
							  <?php 
								foreach($ests as $e):
									$jogador = $elencoNeg->ler($e->id_jogador);
							  ?>
							  <div class="small-6 medium-2 columns end">
								  <div class="player">
								  	  <img src="<?php echo URL?>../data/jogador/<?php echo $jogador->imagem?>" alt="<?php echo $jogador->nome?>" />
									  <h2><?php echo $jogador->nome?></h2>
									  <h3><?php echo $e->score?></h3>
								  </div>
							  </div>
							  <?php endforeach;?>						  							  							  							  					  							  							  							  							  					  							  							  							  							  					  							  							  							  							  					  							  							  							  							  					  							  							  							  							  					  							  							  							  							  
						  </div>
						  <?php 
								endif;
							endforeach;
						  ?>
						  
					  </section>
					  
						  
						  <!--INICIO TRIPA NOTICIAS
						  
					  <section class="tripa-noticias">
						  <div class="row">
							  <div class="medium-4 columns item">
							  	<a href="#">
							  		<img src="<?php echo ROOT?>img/img-noticia.png" alt="titulo noticia" />
								 	<div class="titulo"><h2>Lakers apresenta novo uniforme Nike</h2></div>
								  </a>
							  </div>
							  <div class="medium-4 columns item">
							  	<a href="#">
							  		<img src="<?php echo ROOT?>img/img-noticia.png" alt="titulo noticia" />
								 	<div class="titulo"><h2>Lakers apresenta novo uniforme Nike</h2></div>
								  </a>
							  </div>
							  <div class="medium-4 columns item">
							  	<a href="#">
							  		<img src="<?php echo ROOT?>img/img-noticia.png" alt="titulo noticia" />
								 	<div class="titulo"><h2>Lakers apresenta novo uniforme Nike</h2></div>
								  </a>
							  </div>							  
						  </div>					  	
					  </section>

					  FIM TRIPA NOTICIAS-->

					  
				  	 <!-- INICIO LISTA NOTÍCIAS-->
				  	 
					  <section id="lista-noticias">
						  <div class="row">
							  <div class="medium-4 columns">
							  <?php
								$i=0;
								for($p=0;$p<12;$p++):
								$ip=$i++;
							  ?>
								  <li><a href="<?php echo URL.'noticias/'.$funcao->dataBr($post[$p]->data,"mes").'/'.$funcao->retirarAcento($post[$p]->titulo)?>"><?php echo $post[$p]->titulo?></a></li>
							  <?php
							    if(($ip%4)==3):
							  ?>
							  </div><div class="medium-4 columns">
							  <?php
							    endif;
							    endfor;
							  ?>
							  </div>							  							  
						  </div>
					  </section>
				  	  
				  	  <!--FIM LISTA NOTÍCIAS-->
				  	  
				  	  

				  	  
				  	  <?php include $diretorio.'/includes/rodape.php';?>

					  </div>			  
				  </div>         
				  
			  </div>
		  </div>
	  

	
    
    <?php include $diretorio.'/includes/rodape-script.php';?>
  </body>
</html>
