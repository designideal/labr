<?php
require_once("config/config.php");

require_once("classes/dados/estatistica.php");
require_once("classes/dados/item.php");
require_once("classes/dados/elenco.php");
require_once("classes/dados/placar.php");
require_once("classes/funcoes.php");

$funcao = new Funcoes();

$estatisticaNeg = new EstatisticaDados();
$itemNeg = new ItemDados();
$elencoNeg = new ElencoDados();
$placarNeg = new PlacarDados();

$placar = $placarNeg->listar('pontuacao_time1!=0','data DESC LIMIT 1');
$jogo = $placarNeg->listar('pontuacao_time1="0"','data ASC LIMIT 5');	
?>
		
			<div class="medium-3 columns" id="bloco-inferior">
                    <div class="box">
                    	<section id="placar">
                            <h2>Último jogo</h2>
                            <h3 class="bottom30"><?php echo $funcao->dataExtenso($placar[0]->data,'')?></h3>
                            <div class="row">
                            	<div class="small-5 columns text-center">
									<img src="<?php echo URL?>../data/time/<?php echo $placar[0]->imagem1?>" alt="<?php echo $placar[0]->time1?>">
									<h3><?php echo $placar[0]->time1?></h3>
									<h4><?php echo $placar[0]->pontuacao_time1?></h4>
                                </div>
                                <div class="small-2 columns">
                                	<span class="text-center versus">X</span>
                                </div>
                            	<div class="small-5 columns text-center">
                                	<img src="<?php echo URL?>../data/time/<?php echo $placar[0]->imagem2?>" alt="<?php echo $placar[0]->time2?>">
									<h3><?php echo $placar[0]->time2?></h3>
									<h4><?php echo $placar[0]->pontuacao_time2?></h4>
                                </div>   
                            </div>
                            <div class="row">
                                <div class="small-12 columns">
                                  <a href="<?php echo $placar[0]->link?>" class="button">Análise do jogo</a>
                                </div>                            
                            </div>
                    	</section>
                        

                        <div class="row">
                        	<div class="medium-12 columns">
                            	<div class="spacer-estrela"></div>
                            </div>
                        </div>      
      
      
					  <!--CLASSIFICAÇÃO-->
						  
						<?php include $diretorio.'/includes/classificacao.php';?>
                        
                        
                        <div class="row">
                        	<div class="small-12 columns">
                            	<div class="spacer-estrela"></div>
                            </div>
                        </div> 

						<section id="proximos-jogos">
                            <h2>Próximos Jogos</h2>
                            <h3 class="bottom30">Pré-Temporada</h3>                        
                            <div class="row">
                                <div class="small-5 columns">
                                	<ul>
                                    	<?php foreach($jogo as $j):?>
									    <li><?php echo $funcao->diaSemana($j->data).', '.$funcao->dataParte($j->data,'dia').'/'.$funcao->dataParte($j->data,'mes')?></li>   
									    <?php endforeach;?>                                        
                                    </ul>
                                </div>
                                <div class="small-4 columns">
                                	<ul>
                                    	<?php 
										foreach($jogo as $j):
										if($j->mandante=='x'):
										?>
									    <li><?php echo $j->abv2.'@'.$j->abv1?></li>  
										<?php
										else:
										?>
										<li><?php echo $j->abv1.'@'.$j->abv2?></li>  
										<?php 
										endif;
										endforeach;
										?>                                  
                                    </ul>
                                </div>              
                                <div class="small-3 columns">
                                	<ul>
                                    	<?php foreach($jogo as $j):?>
									    <li><?php echo substr($j->hora, 0, -3);?></li>   
									    <?php endforeach;?>                                
                                    </ul>
                                </div>                                          
                            </div>                            	
                        </section>
                                                
                       

                        <div class="row">
                        	<div class="medium-12 columns">
                            	<div class="spacer-estrela"></div>
                            </div>
                        </div> 


                        <section id="estatisticas">
                            <h2>Estatísticas</h2>          	
                            <div class="row">
							<?php 
							  $item = $itemNeg->listar("tipo='quesito' AND nome!='Pts Contra'",'id_item LIMIT 4');
							  foreach($item as $i):
								  $stas = $estatisticaNeg->listar("tipo='jogador' AND id_quesito='".$i->id_item."'",'score DESC LIMIT 1');
								  $jogador = $elencoNeg->ler($stas[0]->id_jogador);
							  ?>
                            	<div class="item">
                                    <div class="small-6 columns">
                                        <img src="<?php echo URL?>../data/jogador/<?php echo $jogador->imagem?>" alt="<?php echo $jogador->nome?>" />
                                    </div>
                                    <div class="small-6columns">
                                        <span><?php echo $jogador->nome?></span>
                                        <h3><?php echo $stas[0]->score?></h3>
                                        <span><?php echo $i->nome?></span>
                                    </div>
                                </div>

                                <div class="small-12 columns">
                                    <div class="spacer"></div>
                                </div>
                             <?php endforeach;?>                  
                                
                                <div class="medium-12 columns">
                                  <a href="#" class="button">Estatísticas Completas</a>
                                </div>                                                                                                    
                            </div>
                        </section>                        
                        
                        
                        
                        
          
                        <?php if($pagina!='historia' && $pagina!='elenco' && $pagina!='estatisticas' && ( $pagina!='noticias' || (count($url)<4||$url[0]=='categoria'))):?>    
<!--                        <section id="estatisticas">
                            <h2>Estatísticas</h2>          	
                            <div class="row">
							 <?php 
							  $item = $itemNeg->listar("tipo='quesito' AND nome!='Pts Contra'",'id_item LIMIT 4');
							  foreach($item as $i):
								  $stas = $estatisticaNeg->listar("tipo='jogador' AND id_quesito='".$i->id_item."'",'score DESC LIMIT 1');
								  $jogador = $elencoNeg->ler($stas[0]->id_jogador);
							  ?>
                            	<div class="item">
                                    <div class="small-6 columns">
                                        <img src="<?php echo URL?>../data/jogador/<?php echo $jogador->imagem?>" alt="<?php echo $jogador->nome?>" />
                                    </div>
                                    <div class="small-6columns">
                                        <span><?php echo $jogador->nome?></span>
                                        <h3><?php echo $stas[0]->score?></h3>
                                        <span><?php echo $i->nome?></span>
                                    </div>
                                </div>

                                <div class="small-12 columns">
                                    <div class="spacer"></div>
                                </div>
                             <?php endforeach;?>                  
                                
                                <div class="medium-12 columns">
                                  <a href="<?php echo URL?>estatisticas" class="button">Estatísticas Completas</a>
                                </div>                                                                                                    
                            </div>
                        </section>-->
						<?php endif;?> 
					</div>
					
					<?php if(count($url)>=3):?>
					<div id="links">
                    	<div class="row">
                        	<div class="medium-12 columns">
							<?php
							$postd_viu = $postNeg->listar("id_post!=".$postId->id_post,"data_atualizacao DESC,id_post DESC LIMIT 10",'');
							foreach($postd_viu as $viu):
							?>
                            	<a href="<?php echo URL.'noticias/'.$funcao->dataBr($viu->data,"mes").'/'.$funcao->retirarAcento($viu->titulo)?>">
                                    <h2><?php echo $viu->titulo?></h2>
                                    <h3><?php echo $viu->lead?></h3>
                                 </a>
                                 <div class="spacer"></div>
							<?php 
							endforeach;
							?>	 
                                                                                                                
                            </div>
                           
                        </div>
                    </div>
					<?php endif;?>
<!--					<section id="cadastro" style="margin-top:30px;">
						<a href="http://www.labr.com.br" style="background:none; padding:0; margin:0;"><img src="<?php echo ROOT ?>img/banner-labr-2.jpg" /></a>
				    </section>-->

					<!--FACEBOOK-->
				 
				    <section id="facebook">
						<div class="fb-page" data-href="https://www.facebook.com/lakersbrasil/" data-width="300" data-small-header="false" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><blockquote cite="https://www.facebook.com/lakersbrasil/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/lakersbrasil/">Lakers Brasil</a></blockquote></div>				    
					</section>    
			</div>              
      
                        
                          
      


            
    
