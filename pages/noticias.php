<?php 
require_once("config/config.php");

require_once("classes/dados/post_teste.php");
require_once("classes/dados/imagemTeste.php");
require_once("classes/dados/categoria.php");
require_once("classes/dados/item.php");

require_once("classes/funcoes.php");

$funcao = new Funcoes();

$postNeg = new PostDados();
$imgNeg = new ImagemDados();
$categoriaNeg = new CategoriaDados();
$itemNeg = new ItemDados();

if(count($url)<3||$url[0]=='categoria'):
	//echo 'aqui';
	//listagem
	//Pegar a página atual por GET 
	//echo "p.id_sessao='".$_sessao[0]->id_sessao."' AND c.nome LIKE '".$url[0]."'";
	$pg = ($url[0]!='categoria')?$url[1]:$url[3]; 
	//echo $pg;
	//Verifica se a variável tá declarada, senão deixa na primeira página como padrão 
	if(isset($pg)) { $pg = $pg; } else { $pg = 1; } 
	
	//Defina aqui a quantidade máxima de registros por página. 
	$qnt = 33; 
	//O sistema calcula o início da seleção calculando: 
	//(página atual * quantidade por página) - quantidade por página 
	$comeco = ($pg*$qnt) - $qnt;
	
	$query = ($url[0]!='categoria')?"destaque!='x'":"c.slug='".$url[1]."'";
	$ordem = ($url[0]!='categoria')?",id_post DESC":",p.id_post DESC";
	$tipo = ($url[0]!='categoria')?"":"relaciona";
	//echo $query;
	$postTotal = $postNeg->listar($query ,"data_atualizacao DESC",$tipo);
	$total = count($postTotal);

	$postviu = $postNeg->listar($query ,"data_atualizacao DESC".$ordem." LIMIT ".$comeco.", ".$qnt,$tipo);
	
	if($url[0]!='categoria'):
		$postDest = $postNeg->listar('destaque="x"','','');
		$dest_tit = $postDest[0]->titulo;
		$dest_url = URL.'noticias/'.$funcao->dataBr($postDest[0]->data,"mes").'/'.$funcao->retirarAcento($postDest[0]->titulo);
		$dest_id = $postDest[0]->id_post;
	else:
		$dest_tit = $postviu[0]->titulo;
		$dest_url = URL.'noticias/'.$funcao->dataBr($postviu[0]->data,"mes").'/'.$funcao->retirarAcento($postviu[0]->titulo);
		$dest_id = $postviu[0]->id_post;
	endif;
	
	$imgDest = $imgNeg->listar('id_post='.$dest_id,'ordem ASC','post');
	$img_mobile = URL.'../data/posts/'.$funcao->adicionar_sufixo($imgDest[1]->imagem, '_quadrada');
	$titulo_pg='NOTÍCIAS';
else:
	//notícia detalhe
	$urlnova=str_replace(" ", "", $url);
	$postId = $postNeg->ler_id($urlnova);
	//echo $postId;
	$post = $postNeg->ler($postId->id_post);
	$titulo_pg=$post->titulo;
	$lead_pg=$post->lead;
	$url_pg=URL.'noticias/'.$funcao->dataBr($post->data,"mes").'/'.$funcao->retirarAcento($post->titulo);

	$img = $imgNeg->listar('id_post='.$postId->id_post,'ordem ASC','post');
	
	$img_pg = URL.'../data/posts/'.$funcao->adicionar_sufixo($img[0]->imagem, '_grande');
	$img_mobile = URL.'../data/posts/'.$funcao->adicionar_sufixo($img[1]->imagem, '_quadrada');
	//viu isso?
	$postviu = $postNeg->listar("id_post!=".$postId->id_post." AND titulo!=''","destaque,data_atualizacao DESC LIMIT 21",'');
endif;		     
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
					  <?php if(count($url)>=3):?>
					  <article>
						<div class="row">
							<div class="small-12 medium-1 columns" id="compartilhe">
								<span>Espalhe!</span>
								<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url_pg?>" class="popup"><img src="<?php echo ROOT?>img/ico-face.png" /></a></li>
								<li><a href="http://twitter.com/home?status=<?php echo $titulo_pg?> by @lakersbrasil <?php echo $url_pg?>" class="popup"><img src="<?php echo ROOT?>img/ico-twitter.png" /></a></li>
								<li><a href="whatsapp://send?text=Leia: <?php echo urlencode($url_pg)?>" rel="nofollow"><img src="<?php echo ROOT?>img/ico-whatsapp.png" /></a></li>
							</div>
						</div>	
						<div class="row">
							<div class="small-3 medium-1 columns text-center" id="contador">
								<span class="hide-for-small">Bate Papo</span>
								<a href="#comentarios">
								<span class="counter count-comments" data-disqus-url="<?php echo $url_pg?>">0</span>
								</a>
							</div>
						</div>
						  <?php $autor = $itemNeg->listar('p.id_post='.$post->id_post,'','relaciona');?>
						  <div class="row" id="autor">
							  <div class="medium-8 medium-centered columns text-center">
								<?php if($autor[0]->id_item!=0):?>
								<img src="<?php echo URL.'../data/autor/'.$autor[0]->imagem?>" alt="<?php echo $autor[0]->nome?>" />
								<h3><?php echo $funcao->dataExtenso($post->data,'noweek').' por '.$autor[0]->nome?></h3>
								<?php endif;?>
							  </div>	
						  </div>
						  <div class="row" id="bloco-txt">
							  <div class="medium-9 medium-centered columns">
								  <?php
									if($post->id_post>3297):  
										$texto = explode('[video]',$post->texto);
										if(count($texto)>1):
											foreach($texto as $t):
												if(strpos($t,".youtube")!=0)
													echo $funcao->mostraVideo($t,'100%','480');
												else
													echo $t;
											endforeach;
										else:
											echo $post->texto;
										endif;
									else:
										echo $post->texto;
									endif;
								  ?>
								  <div class="spacer"></div>
								  <div class="row">
								  	<div class="medium-12 columns">
										  <?php $tag = $categoriaNeg->listar('f.id_post='.$post->id_post,'','relaciona','post');?>
											<ul>
												<?php foreach($tag as $t):?>
												<li><a href="<?php echo URL.'noticias/categoria/'.$t->slug?>"><?php echo $t->nome;?></a></li>
												<?php endforeach;?>
											</ul>
									  </div>
								  </div>
							  </div>
						  </div>
					  </article>
					  <?php endif;?>
						  
					  <!--INICIO TRIPA NOTICIAS-->
						  
					  <section id="listagem" class="tripa-noticias">
						  <div class="row">
							  <?php 
							    $in = ($url[0]!='categoria')?0:1;
								$tot = ($url[0]!='categoria')?3:4;
								for($pv=$in;$pv<$tot;$pv++):
								$img = $imgNeg->listar('id_post='.$postviu[$pv]->id_post,'ordem DESC','post');

							  ?>
							  <div class="medium-4 columns item">
							  	  <a href="<?php echo URL.'noticias/'.$funcao->dataBr($postviu[$pv]->data,"mes").'/'.$funcao->retirarAcento($postviu[$pv]->titulo)?>">
							  		<img src="<?php echo URL?>../data/posts/<?php echo $funcao->adicionar_sufixo($img[0]->imagem, '_quadrada')?>" alt="titulo noticia" />
								 	<div class="titulo"><h2><?php echo $postviu[$pv]->titulo?></h2></div>
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
						  <div class="row pagina">
							  <div class="medium-4 columns">
							  <?php
								$i=0;
								$in = (count($url)>=3)?3:4;
								$totalLista = count($postviu)-3;
								
								if(($totalLista<30)&&(count($url)<3)):
									$tot = $totalLista;
								else:
									$tot = (count($url)>=3)?15:33;
								endif;

								$aqui = (count($url)>=3)?4:round($totalLista/3);
								//echo 10/3;
								for($pv=3;$pv<$tot;$pv++):
								$img = $imgNeg->listar('id_post='.$postviu[$pv]->id_post,'destaque DESC','post');
								$ip=$i++;
								//echo $ip%$aqui;
							  ?>
								  <li class="item"><a href="<?php echo URL.'noticias/'.$funcao->dataBr($postviu[$pv]->data,"mes").'/'.$funcao->retirarAcento($postviu[$pv]->titulo)?>"><?php echo $postviu[$pv]->titulo?></a></li>
							  <?php
							    if(($ip%$aqui)==($aqui-1)):
							  ?>
							  </div><div class="medium-4 columns">
							  <?php
							    endif;
							    endfor;
							  ?>
							  </div>							  							  
						  </div>
						  <div class="row">
						  		<div id="paginacao">
									<div class="large-12 columns">
										<div class="pagination-centered top60">
										  <ul class="pagination">
												<?php 
												$extra = ($url[0]!='categoria')?'':'/categoria/'.$url[1];
												echo $funcao->paginacao($total,$qnt,$pg,URL.$pagina.$extra);
												?>
										  </ul>
										</div>                  
									</div>
							  </div>
						  </div>
					  </section>
				  	  
				  	  <!--FIM LISTA NOTÍCIAS-->
				  	  
				  	  <?php if(count($url)>=3):?>
					  <section id="comentarios">
						  <div class="row">
							  <div class="medium-12 columns text-center">
								  <h2>Fala aí!</h2>
							  </div>
						  </div>
						  <div class="row">
							  <div class="medium-8 medium-centered columns">

						<div id="disqus_thread"></div>
							<script type="text/javascript">
								/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
								var disqus_shortname = 'lakersbrasil'; // required: replace example with your forum shortname

								/* * * DON'T EDIT BELOW THIS LINE * * */
								(function() {
									var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
									dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
									(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
								})();
							</script>

                            
                            
							  </div>
						  </div>
					  </section>
				  	  <?php endif;?>
				  	  <?php include $diretorio.'/includes/rodape.php';?>

					  </div>			  
				  </div>         
				  
			  </div>
		  </div>
	  
	<?php include $diretorio.'/includes/rodape-script.php';?>
  </body>
</html>
