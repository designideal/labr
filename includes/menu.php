    <!--TOPO-->
    <?php 
	$menuSite =   array('noticias'=>'Notícias',
						'estatisticas'=>'Estatísticas',
						'elenco'=>'Elenco',
						'historia'=>'História',
						'vai_ao_staples'=>'Vai ao Staples?',
						'loja'=>'LABR');
	?>
    <div class="row">
    	<header class="hide-for-small">
        	<div class="medium-12 columns">
				<h1><a href="<?php echo URL?>"><img src="<?php echo ROOT?>img/logo.png" alt="Lakers Brasil | NBA - Tudo sobre o Los Angeles Lakers" data-pin-nopin="true"></a></h1>            	
            	<div id="placa"><img src="<?php echo ROOT?>img/placa.png" /></div>
                <div id="slogan"><img src="<?php echo ROOT?>img/slogan.png" /></div>
            </div>
            <nav>
				<div class="medium-12 columns padb20">
                    <ul>
						<?php 
						foreach($menuSite as $s=>$menu):
							if($menu!='Contato'):
							$link = ($s=='loja')?'http://www.labr.com.br/':URL.$s;
							
							$style = ($s=='loja')?'style="background-color:#ffcc02"':'';
							$style = ($s=='loja')?'target="_blank"':'';
						?>
							<li><a href="<?php echo $link?>" rel="<?php echo $menu?>" <?php echo $style?> <?php echo $target?>><?php echo $menu?></a></li>
						<?php 
							endif;
						endforeach;
						?> 
                    </ul>                             
        		</div>
        	</nav> 
        </header>
        
    </div>
    
    
    <!--FIM TOPO-->
	<?php if($pagina!='index' && $pagina!='noticias'):?>
	<!--BREADCRUMB-->
    
    <div class="row">
    	<div class="medium-12 columns">
            <ul class="breadcrumbs">
                  <li><a href="<?php echo URL ?>">Início</a></li>
                  <li class="current"><a href="<?php echo URL.array_search($menuSite[$pagina],$menuSite)?>"><?php echo $menuSite[$pagina]?></a></li>
            </ul>
    	</div>
    </div>
    <?php endif;?>