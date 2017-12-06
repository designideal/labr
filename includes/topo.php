					<?php 
					$menuSite =   array('noticias'=>'Notícias',
										'estatisticas'=>'Estatísticas',
										'elenco'=>'Elenco',
										'historia'=>'História',
										'vai_ao_staples'=>'Vai ao Staples?',
										'loja'=>'LABR',
										'contato'=>'Contato');
					?>
	
				  <!--INICIO TOPO-->
				  
				  <header>
				  		<div id="info">
						  <div class="row">
							  <div class="small-12 medium-10 columns logo">
								<a href="<?php echo URL?>"><img src="<?php echo ROOT?>img/logo.png" /></a>
							  </div>
							  <div class="medium-2 columns text-right">
								  <ul class="hide-for-small">
									  <li><a href="https://www.facebook.com/lakersbrasil" target="_blank"><img src="<?php echo ROOT?>img/ico-face.png" /></a></li>
									  <li><a href="https://www.instagram.com/lakersbrasiloficial/" target="_blank"><img src="<?php echo ROOT?>img/ico-insta.png" /></a></li>
									  <li><a href="https://twitter.com/lakersbrasil" target="_blank"><img src="<?php echo ROOT?>img/ico-twitter.png" /></a></li>
									  <li><a href="<?php echo URL ?>contato"><img src="<?php echo ROOT?>img/ico-contato.png" /></a></li>
								  </ul>
							  </div>
						  </div>
						<div class="row">
							<div class="medium-9 medium-centered  columns text-center">
								<a href="<?php echo $dest_url?>">
								<h1><?php echo ($titulo_pg=='NOTÍCIAS'|| $pagina=='index')?$dest_tit:$titulo_pg?></h1>
								</a>
							</div>
						</div>
					  </div>
					  <a href="<?php echo $dest_url?>"><img src="<?php echo $img_mobile;?>" class="banner show-for-small-only"/></a>
					  <img src="<?php echo (!$img_pg)?URL.'../data/posts/'.$funcao->adicionar_sufixo($imgDest[0]->imagem, '_grande'):$img_pg;?>" class="banner hide-for-small"/>
					  
				  </header>
				  
				  <!--FIM TOPO-->