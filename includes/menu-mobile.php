  	<!--TOP BAR-->
	<?php 
	$menuMob =   array('noticias'=>'Notícias',
						'estatisticas'=>'Estatísticas',
						'elenco'=>'Elenco',
						'historia'=>'História',
						'vai_ao_staples'=>'Vai ao Staples?',
						'loja'=>'LABR');
	?>
	<nav class="top-bar hide-for-medium-up" data-topbar="" role="navigation">
      <ul class="title-area">
        <li class="name">
          <h1><a href="http://www.lakersbrasil.com">Lakers Brasil</a></h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href=""><span></span></a></li>
      </ul>

      
    <section class="top-bar-section" style="left: 0%;">
        <ul class="right">
						<?php 
						foreach($menuMob as $s=>$menu):
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
      </section>
    </nav>
  
    <!--FIM TOP BAR-->    
 