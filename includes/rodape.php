
					<!--VIDEO-->
					
					<?php 
					$videoDest = $postNeg->listar("p.status='Publicado' AND p.assunto='video'","p.data_atualizacao DESC","categoria");
					$video = $videoNeg->listar('id_post='.$videoDest[0]->id_post,'');
					?>
					<section id="video">
						<div class="row">
							<div class="medium-8 columns">
								<?php 
								echo $funcao->mostraVideo($video[0]->video,'100%','432','hide-for-small');
								echo $funcao->mostraVideo($video[0]->video,'100%','195','show-for-small-only');
								?>
							</div>
							<div class="medium-4 columns">
							<div class="text-center">
								<a href="" class="tag"><?php echo $videoDest[0]->categoria_nome?></a>
							</div>
							<h2><?php echo $videoDest[0]->titulo?></h2>							
							</div>
						</div>
					</section>
					
					<div class="row">
						<div class="medium-12 columns">
						<div class="spacer"></div>
						</div>
					</div>
					
					
					<section id="destinos" class="hide-for-small">
						<div class="row">
							<div class="medium-12 columns text-center">
								<h3>Destination Wedding</h3>
								<p class="bottom30">o dia mais importante da sua vida, no lugar mais especial da sua história.</p>
							</div>
						</div>
						<div class="row">
							<?php foreach($destino as $d):?>
							<div class="medium-3 columns">
								<a href="<?php echo URL.$d->slug?>">
									<img src="<?php echo ROOT?>img/destinos.png" alt="Nome do Destino" />
									<h2><?php echo $d->titulo?></h2>
								</a>
							</div>
							<?php endforeach;?>							
						</div>
					</section>
					
					<section id="news">
						<div class="row">
							<div class="medium-5 medium-centered columns text-center">
								<h3>Newsletter</h3>
								<p>Seja a primeira a saber sobre novidades no mundo dos casamentos e dicas para você ter a melhor experiência possível neste dia tão especial.</p>
								<input type="text" id="nome" name="nome" placeholder="nome" title="nome*">
								<input type="text" id="email" name="email" placeholder="e-mail" title="e-mail*">
								<button id="enviaContato" type="submit">enviar</button>
							</div>
						</div>
					</section>
					
					<div id="instagram">
						<!-- SnapWidget -->
						<script src="https://snapwidget.com/js/snapwidget.js"></script>
						<iframe src="https://snapwidget.com/embed/592477" class="snapwidget-widget" allowtransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:100%; "></iframe>
						<div class="row">
						<div class="medium-12 columns text-center">
							<h3>@especialistaemcasamento</h3>
							<p>acompanhe nosso instagram</p>
						</div>
					</div>
					</div>
					
					<footer>
						<?php echo $funcao->menu($menu,'rodape')?>			
						
						<div class="midias">
							<div class="row">
								<div class="medium-2 medium-centered columns">
									<ul>
										<li><a href=""><img src="<?php echo ROOT?>img/ico-youtube.png" alt="Youtube" /></a></li>
										<li><a href=""><img src="<?php echo ROOT?>img/ico-instagram.png" alt="Instagram" /></a></li>
										<li><a href=""><img src="<?php echo ROOT?>img/ico-facebook.png" alt="Facebook" /></a></li>
										<li><a href=""><img src="<?php echo ROOT?>img/ico-email.png" alt="Contato" /></a></li>
									</ul>			
								</div>
							</div>
						</div>							
						
						<div id="ideal">
						<div class="row">
							<div class="medium-12 columns text-center">
								<a href="http://www.designideal.com.br" target="_blank">Desenvolvido por Design Ideal</a>
							</div>
						</div>
						</div>
						
					</footer>