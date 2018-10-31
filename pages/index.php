<?php 
require_once("config/config2.php");

require_once("classes/dados/post_teste.php");
require_once("classes/dados/placar.php");
require_once("classes/dados/jogo.php");
require_once("classes/dados/elenco.php");
require_once("classes/dados/imagemTeste.php");
require_once("classes/dados/estatistica.php");
require_once("classes/dados/item.php");
require_once("classes/dados/frase.php");
//require_once("classes/dados/categoria.php");

require_once("classes/funcoes.php");

$funcao = new Funcoes();

//$categoriaNeg = new CategoriaDados();
$postNeg = new PostDados();
$imgNeg = new ImagemDados();
$placarNeg = new PlacarDados();
$elencoNeg = new ElencoDados();
$estatisticaNeg = new EstatisticaDados();
$itemNeg = new ItemDados();
$jogoNeg = new JogoDados();
$fraseNeg = new FraseDados();

//echo $postId;
$postDest = $postNeg->listar('destaque="x"','','');
$dest_tit = $postDest[0]->titulo;
$dest_url = URL.'noticias/'.$funcao->dataBr($postDest[0]->data,"mes").'/'.$funcao->retirarAcento($postDest[0]->titulo);
$dest_id = $postDest[0]->id_post;
$imgDest = $imgNeg->listar('id_post='.$postDest[0]->id_post,'ordem ASC','post');
$img_mobile = URL.'../data/posts/'.$funcao->adicionar_sufixo($imgDest[1]->imagem, '_quadrada');

$post = $postNeg->listar('p.destaque!="x"','data_atualizacao DESC,p.id_post DESC LIMIT 18','relaciona','p.id_post');

$artigo = $postNeg->listar('c.slug="artigos"','data_atualizacao DESC,p.id_post DESC LIMIT 1','relaciona');
$imgArt = $imgNeg->listar('id_post='.$artigo[0]->id_post,'ordem ASC','post');

$placar = $placarNeg->listar('pontuacao_time1!="0"','data DESC LIMIT 1');
$jogo = $placarNeg->listar('pontuacao_time1="0"','data ASC LIMIT 5');
$aspas = $fraseNeg->listar('','id_frase DESC');		     
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

					  <section id="placar">
						<div class="row"> 
							  <div class="medium-4 columns text-center">
								  
								  <?php include $diretorio.'/includes/campanha.php';?>
								  <div class="row" style="padding: 24px 0;">
									  <div class="small-4 medium-4 columns">
									  	<img src="<?php echo URL.'../data/time/'.$placar[0]->imagem1?>" alt="<?php echo $placar[0]->time1?>"/>
									  </div>
									  <div class="small-4 medium-4 columns">
										  <h3><?php echo $placar[0]->pontuacao_time1?> x <?php echo $placar[0]->pontuacao_time2?></h3>
									  </div>
									  <div class="small-4 medium-4 columns">
									  	<img src="<?php echo URL.'../data/time/'.$placar[0]->imagem2?>" alt="<?php echo $placar[0]->time2?>"	/>
									  </div>
								  </div>
								  <div class="row">
									  <div class="medium-12 columns">
										  <a href="<?php echo $placar[0]->link?>">Confira os lances do jogo</a>
									  </div>
								  </div>
							  </div>
							
							<?php include $diretorio.'/includes/destaques.php';?>
							

							  <div class="medium-4 columns">
							  	<ul>
								  <li class="highlight">Próximos Jogos</li>
								  <?php foreach($jogo as $j):?>
								  <li>
									  <div class="left">
									    <?php
										if($j->mandante=='x'):
										  echo $j->abv2.' @ '.$j->abv1;
										else:
										  echo $j->abv1.' @ '.$j->abv2;
										endif;
										?>
									  </div>
									  <div class="text-right"><?php echo $funcao->diaSemana($j->data).', '.$funcao->dataParte($j->data,'dia').'/'.$funcao->dataParte($j->data,'mes').' às '.substr($j->hora, 0, -3);?></div>
								  </li>
                                  <?php endforeach;?>
								  </ul>							  
							  </div>
							</div>
						</section>
						  
						  <!--FIM PLACAR-->
						  
						  <!--INICIO TRIPA NOTICIAS-->
						  
					  <section class="tripa-noticias">
						  <div class="row">
							  <?php 
								for($p=0;$p<3;$p++):
								$img = $imgNeg->listar('id_post='.$post[$p]->id_post,'ordem DESC','post');
							  ?>
							  <div class="medium-4 columns item">
							  	  <a href="<?php echo URL.'noticias/'.$funcao->dataBr($post[$p]->data,"mes").'/'.$funcao->retirarAcento($post[$p]->titulo)?>">
							  		<img src="<?php echo URL.'../data/posts/'.$funcao->adicionar_sufixo($img[0]->imagem, '_quadrada')?>" alt="titulo noticia" />
								 	<div class="titulo"><h2><?php echo $post[$p]->titulo?></h2></div>
								  </a>
							  </div>
							  <?php
								endfor;
							  ?>
						  </div>					  	
					  </section>

					  <!--FIM TRIPA NOTICIAS-->
					  
					  <!--INICIO STATS-->
					  
					  <section id="stats">
						  <div class="row">
							  <?php 
							  $item = $itemNeg->listar("tipo='quesito' AND nome!='Pts Contra'",'id_item LIMIT 6');
							  foreach($item as $i):
								  $stas = $estatisticaNeg->listar("tipo='jogador' AND id_quesito='".$i->id_item."'",'score DESC LIMIT 1');
								  $jogador = $elencoNeg->ler($stas[0]->id_jogador);
							  ?>
							  <div class="small-6 medium-2 columns text-center">
								<img src="<?php echo URL,'../data/jogador/'.$jogador->imagem?>" alt="<?php echo $jogador->nome?>" />
								<h2><?php echo $jogador->nome?></h2>
								<h3><?php echo $stas[0]->score.' '.$i->nome?></h3>
							  </div>
                              <?php
							  endforeach;
							  ?>
						  </div>
					  	
					  </section>
					  
					  <!--FIM STATS-->
					  
					 <!-- INICIO QUOTE-->
					  
					  
					 <section id="quote">
						 <div class="row">
							 <div class="medium-8 medium-centered columns text-center">
								 <img src="<?php echo ROOT?>img/aspas.png" alt="aspas" />
								 <h2><?php echo $aspas[0]->texto;?></h2>
								 <h3><?php echo $aspas[0]->autor;?></h3>
							 </div>
						 </div>
					  </section>
					 
					  
					  <!--FIM QUOTE-->
					  
					  
					  
					  <!--INICIO ARTIGO-->
					  
					  <section id="artigo" class="hide-for-small">
					  	<a href="<?php echo URL.'noticias/'.$funcao->dataBr($artigo[0]->data,"mes").'/'.$funcao->retirarAcento($artigo[0]->titulo)?>">
							  <div class="row">
								<div class="medium-8 medium-centered  columns text-center">
									<h2><?php echo $artigo[0]->titulo?></h2>
								</div>
							  </div>
							  <img src="<?php echo URL.'../data/posts/'.$funcao->adicionar_sufixo($imgArt[0]->imagem, '_grande')?>" alt="<?php echo $artigo[0]->titulo?>" />
						  	</a>
					  </section>
					  

					  
					  <!--FIM ARTIGO-->
					  
						  <!--INICIO TRIPA NOTICIAS-->
						  
					  <section class="tripa-noticias">
						  <div class="row">
							  <?php 
								for($p=3;$p<6;$p++):
								$img = $imgNeg->listar('id_post='.$post[$p]->id_post,'ordem DESC','post');
							  ?>
							  <div class="medium-4 columns item">
							  	  <a href="<?php echo URL.'noticias/'.$funcao->dataBr($post[$p]->data,"mes").'/'.$funcao->retirarAcento($post[$p]->titulo)?>">
							  		<img src="<?php echo URL.'../data/posts/'.$funcao->adicionar_sufixo($img[0]->imagem, '_quadrada')?>" alt="titulo noticia" />
								 	<div class="titulo"><h2><?php echo $post[$p]->titulo?></h2></div>
								  </a>
							  </div>
							  <?php
								endfor;
							  ?>							  
						  </div>					  	
					  </section>

					  <!--FIM TRIPA NOTICIAS-->				
					  
				  	 <!-- INICIO LISTA NOTÍCIAS-->
				  	 
					  <section id="lista-noticias">
						  <div class="row">
							  <div class="medium-4 columns">
							  <?php
								$i=0;
								for($p=6;$p<18;$p++):
								//$img = $imgNeg->listar('id_post='.$post[$p]->id_post,'destaque DESC','post');
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
