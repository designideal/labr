<?php
require_once("config/config.php");
 
require_once("classes/dados/elenco.php");
require_once("classes/dados/post_teste.php");
require_once("classes/funcoes.php");

$funcao = new Funcoes();

$elencoNeg = new ElencoDados();
$postNeg = new PostDados();

$titulo_pg = 'Elenco Lakers: confira a lista completa de jogadores';
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

					  <section id="elenco">
						  <div class="row">
							  <div class="small-6 medium-6 columns">
								  <?php 
									$j=0;
									$pivo = $elencoNeg->listar("","nome DESC");
									$totalP = (count($pivo)/2);
									$limite = round($totalP);

									foreach($pivo as $jogador):
									$ji=$j++;
									
								  ?>
								  <div class="row item">
									  <div class="medium-4 columns">
										<img src="<?php echo URL?>../data/jogador/<?php echo $jogador->imagem?>" alt="<?php echo $jogador->nome?>" />
									  </div>
									  <div class="medium-8 columns">
										  <h2><?php echo $jogador->nome?></h2>
										  <h3><?php echo $jogador->site?></h3>
										  <h4><?php echo $jogador->posicao.','.$jogador->idade.' anos | '.$jogador->altura.'M | '.$jogador->peso.'KG'?></h4>
										  <h4><?php echo $jogador->formacao?></h4>
										  <h4>$<?php echo $jogador->salario?></h4>
									  </div>
									  
								  </div>
								  <?php if(($ji%$limite)==($limite-1)):?>
								  </div><div class="small-6 medium-6 columns">
								  <?php endif;?>
								  <?php
									endforeach;
								   ?>
							  </div>
						</div>
					  </section>
			  
						  


					  
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
