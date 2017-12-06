<?php
$titulo_pg = 'Fala aí! Críticas, dúvidas, sugestões, nos mande uma mensagem';
$img_pg = ROOT.'img/banner-noticia.png';
$img_mobile = ROOT.'img/noticia-vert.png';
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

					  
					  <section id="contato">
						  <div class="row">
							  <div class="medium-5 medium-centered columns text-center">
							  <form id="Form_contato" name="contato" method="post" onsubmit="return enviaForm(this)" action="">
								  <span class="aviso"></span>
								  <input type="text" id="nome" name="nome" title="nome*" placeholder="Nome">
								  <input type="text" id="email" name="email" title="email*" placeholder="E-Mail">
								  <input type="text" id="cidade" name="cidade" title="cidade" placeholder="Cidade / Estado">
								  <textarea name="mensagem" title="mensagem" placeholder="Mensagem" style="height: 200px;"></textarea>
								  <button id="enviaContato" type="submit">enviar</button>
							  </form>
							  </div>
						  </div>
					  
					  </section>

				  	  
				  	  <?php include $diretorio.'/includes/rodape.php';?>

					  </div>			  
				  </div>         
				  
			  </div>
		  </div>
	
    
    <?php include $diretorio.'/includes/rodape-script.php';?>
    
  </body>
</html>
