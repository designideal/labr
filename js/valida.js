$('.popup').click(function(e){
					e.preventDefault();
					window.open($(this).attr("href"), "popupWindow", "width=600,height=600,scrollbars=yes");
				});
$(document).ready(function(){	
		//DISQUS
  	var disqusPublicKey = "3i7Mr9LZUlOuRHcBLq5rfvGzsSvSvwjeMa4tj8eBKMnvqAMl6CKXp2g3rKGg3JiM";
	var disqusShortname = "lakersbrasil"; // Replace with your own shortname

	var urlArray = [];
	//alert($('.count-comments').length);
	$('.count-comments').each(function () {
	  var url = $(this).attr('data-disqus-url');
	  urlArray.push('link:' + url);
	  //alert(urlArray);
	});

	//$('#get-counts-button').click(function () {
	  $.ajax({
		type: 'GET',
		url: "https://disqus.com/api/3.0/threads/set.jsonp",
		data: { api_key: disqusPublicKey, forum : disqusShortname, thread : urlArray },
		cache: false,
		dataType: 'jsonp',
		success: function (result) {
		  //console.log(result.response);
		  for (var i in result.response) {

			var countText = " comentários";
			var count = result.response[i].posts;

			if (count == 1)
			  countText = " comentário";

			$('span[data-disqus-url="' + result.response[i].link + '"]').html(count);

		  }
		}
	  });
	});
//===============================CEP======================================
	function buscaDadosCEP()
	{
		var cep = $(".cep").val();
		
		if(cep.length == 9)
		{
			$('dl img').ajaxStart(function() {
				$(this).removeClass('none');
			}).ajaxStop(function() {
				$(this).addClass('none');
			});
			
			var _html = false;
			
			$.ajax({
				type:"GET",
				url:'ajax/cep.xml.php?cep='+cep,
				dataType:"xml",
				async:false,
				success: function(xml){
				
					var sucesso = $(xml).find("sucesso").text();
					var _cep = $(xml).find("cep");
						
					if(sucesso == 1)
					{						
						$('#cep').remove();
	
						var logradouro = _cep.find("tipo_logradouro").text()+" "+_cep.find("logradouro").text();
		
						$("input[name='endereco']").val(logradouro);
						$("input[name='bairro']").val(_cep.find("bairro").text());
						$("input[name='cidade']").val(_cep.find("cidade").text());
						$("input[name='uf']").val(_cep.find("estado_sigla").text());
						_html=true;	
					}
					else
					{							
						criaSpan('cep',"CEP nÃ£o encontrado.");

						$("input[name='endereco']").val('');
						$("input[name='bairro']").val('');
						$("input[name='cidade']").val('');
						$("input[name='uf']").val('');	
						_html=false;
					}				
				}
			}).responseText;
		
			return _html;
			//
		}
	}
//===============================VALIDA EMAIL======================================

function validaEmail(mail){
    var er = new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/);
    
    //var msg_email = 'E-mail Incorreto!';
    	
    if(typeof(mail) == "string")
	{
    	//var email_existe = duplicidade('email',mail);
    	
        if(!er.test(mail))
		{
			//criaSpan('email',msg_email);
			return false;
		}
			
    }
	else if(typeof(mail) == "object")
	{
		//var email_existe = duplicidade('email',mail.value);
        
		if(!er.test(mail.value))
		{
			//criaSpan('email',msg_email);
			return false;
		}
    }
	else
	{
		//criaSpan('email',msg_email);
		return false;
	}
    
    //alert (email_existe);
	/*if(email_existe)
		return false;*/

}

function validaAltEmail(email)
{
	if(email!=$("input[name='email']").val())
	{
		return false
	}
	else 
	{
		return true;
	}	
}

//===============================VALIDA CPF======================================


function validaCPF(val) {

	var cpf = val.replace(/\./g,'');
	cpf = cpf.replace(/-/g,'');
	
	//var msg_cpf = 'CPF Invï¿½lido!' 
	
	if (cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999"){
		//criaSpan('cpf',msg_cpf);
		return false;
	}
	var a = [];
	var b = new Number;
	var c = 11;
	for (i=0; i<11; i++){
		a[i] = cpf.charAt(i);
		if (i < 9) b += (a[i] * --c);
	}
	if ((x = b % 11) < 2) { a[9] = 0 } else { a[9] = 11-x }
	b = 0;
	c = 11;
	for (y=0; y<10; y++) b += (a[y] * c--); 
	if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11-x; }
	if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10])){
		//criaSpan('cpf',msg_cpf);
		return false;
	}
	
	/*var cpf_existe = duplicidade('cpf',cpf);
	if(cpf_existe)
		return false;*/

}

function validaCNPJ(cnpj) {
	   // DEIXA APENAS OS Nï¿½MEROS
	   var cnpj = cnpj.replace('/','');
	   cnpj = cnpj.replace(/\./g,'');
	   cnpj = cnpj.replace('-','');
	   var msg_cnpj='CNPJ invÃ¡lido';
	   
	   var numeros, digitos, soma, i, resultado, pos, tamanho, digitos_iguais;
	   digitos_iguais = 1;
	 
	   /*if (cnpj.length < 14 && cnpj.length < 15){
	      return false;
	   }*/
	   for (i = 0; i < cnpj.length - 1; i++){
	      if (cnpj.charAt(i) != cnpj.charAt(i + 1)){
	         digitos_iguais = 0;
	         break;
	      }
	   }
	 
	   if (!digitos_iguais){
	      tamanho = cnpj.length - 2
	      numeros = cnpj.substring(0,tamanho);
	      digitos = cnpj.substring(tamanho);
	      soma = 0;
	      pos = tamanho - 7;
	 
	      for (i = tamanho; i >= 1; i--){
	         soma += numeros.charAt(tamanho - i) * pos--;
	         if (pos < 2){
	            pos = 9;
	         }
	      }
	      resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
	      if (resultado != digitos.charAt(0)){
	    	  criaSpan('cnpj',msg_cnpj); 
	         return false;
	      }
	      tamanho = tamanho + 1;
	      numeros = cnpj.substring(0,tamanho);
	      soma = 0;
	      pos = tamanho - 7;
	      for (i = tamanho; i >= 1; i--){
	         soma += numeros.charAt(tamanho - i) * pos--;
	         if (pos < 2){
	            pos = 9;
	         }
	      }
	      resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
	      if (resultado != digitos.charAt(1)){
	    	 criaSpan('cnpj',msg_cnpj); 
	         return false;
	      }
	      
	      var cnpf_existe = duplicidade('cnpj',cnpj);
	      if(!cnpf_existe)
	    	  return false;
	      
	   }else{
		   criaSpan('cnpj',msg_cnpj); 
	      return false;
	   }
	   
	}

function duplicidade(tipo,valor,name)
{

	verifica = tipo+'='+valor;
	//alert(tipo+valor);
	if ((name == "Editar_cliente") || (name == "Editar_medico"))
		verifica = verifica + "&id_pessoa=" + $('input[type="hidden"][name="id_pessoa"]').val();
	//alert (verifica);
	var html = $.ajax({
		url: root+'envios/duplicidade.php?'+verifica,
		async:false,
		success: function(data) {
			data;
		}
	}).responseText;
	if (html==0)
		return false;
	else
		return true;
}
//===============================VALIDA SENHA======================================
function validaSenha(senha)
{
		if(senha.length>8 || senha.length<6)
		{
			//criaSpan('senha','A senha deve ter 6 caracteres');
			return false
		}
		else 
		{
			//$("span[id='senha']").remove();
			return true;
		}
}
function validaAltSenha(senha)
{
	//alert (senha+$("input[name='senha']").val());
		if(senha!=$("input[name='senha']").val())
		{
			//criaSpan('alt_senha','A senha não confere.');
			return false
		}
		else 
		{
			//$("span[id='alt_senha']").remove();
			return true;
		}	
}
//===============================VALIDA FORMULï¿½RIO======================================

function envia(form,name)
{	
	//alert('aqui');
	var i=0;
	var msg = false;
	var name2 = name.split('_');

	var indice = new Array();
	
	$('#'+name).find('input[title*="*"], textarea[title*="*"], select[title*="*"]').each(function(){

		if (($(this).val()=="") || ($(this).val()==$(this).attr('title')))
		{
			i++;
		}
		else
		{
			if($(this).hasClass('email'))
			{		
				var email = validaEmail($(this).val());
				
				if(email==false) {
					msg = "E-mail inválido!";
					i++;
				}
			}
			if($(this).hasClass('email_existe'))
			{		
		    	var email_existe = duplicidade('email', $(this).val(), name	);
		    	//alert($(this).val());
				if(email_existe) {
					msg = "E-mail já cadastrado!";
					i++;
				}
			}
			
			if($(this).hasClass('alt_email'))
			{
				var alt_email = validaAltEmail($(this).val());
				if(alt_email==false)
				{
					msg = "E-mails não conferem!";
					i++;
				}
			}
			
			if($(this).hasClass('cpf'))
			{
				var cpf = validaCPF($(this).val());
				//alert (cpf);
				if(cpf==false) {
					msg = "CPF inválido!";
					i++;
				}
			}
			
			if($(this).hasClass('cpf_existe'))
			{
				var cpf_existe = duplicidade('cpf', $(this).val(), name);
				if(cpf_existe) {
					msg = "CPF já cadastrado!";
					i++;
				}
			}
			
			if($(this).hasClass('cnpj'))
			{
				var cnpj = validaCNPJ($(this).val());
				if(cnpj==false)
					i++;
			}
			
			if($(this).hasClass('senha'))
			{
				var senha = validaSenha($(this).val());
				if(senha==false) {
					msg = 'A senha deve ter de 6 a 8 caracteres!';
					i++;
				}
			}
			
			if($(this).hasClass('alt_senha'))
			{
				/*alert (senha);
				if(senha==true)*/
				var alt_senha = validaAltSenha($(this).val());
				if(alt_senha==false) {
					msg = 'Campo senha e confirmar senha não conferem!';
					i++;
				}
			}
				
		}
		
	});
	
	if($('#'+name+' input[name="arquivo"]').length >0)
	{
		if($('#'+name+' input[name="arquivo"]').val()!='')
		{
			var arquivo = $('#'+name+' input[name="arquivo"]').val();
			var ext = arquivo.split('.');
			var ult = ext.length;
			
			if(ext[ult-1] != 'pdf')
			{
				i++;
				msg = 'O arquivo deve ser pdf.';
			}
		}
	}

	if ((i>0) && (!msg))
	{
		if(name=='Form_sugestao')
			msg = 'Escreva alguma coisa.';
		else if(name=='Form_news')
			msg = 'Escreva seu nome e e-mail.';
		else
			msg = 'Preencha corretamente os campos obrigatórios!';
	}
	if (msg) {
		$('.aviso').html(msg).fadeIn();
		if(name=='Form_news')
			$('#news form').css('padding-top','10px');
		return false;
	} else {
		return true;
	}
	
}

function redirecionar(local) {
	location.href=root+local;
}
function CKupdate(){
    for ( instance in CKEDITOR.instances )
        CKEDITOR.instances[instance].updateElement();
}
function enviaForm(form)
{
	var name = $(form).attr('id');		
	var envio = envia(form, name);
	var acao = name.split('_');

	if(!envio)
		return false;
	
	//CKupdate();
	
	$('#'+name).ajaxSubmit(
	{
		target: null,
	    url:root+'envios/'+name+'.php',
	    beforeSubmit: function() {
			$('.aviso').html('Aguarde!!! Enviando...').fadeIn();
			//$('html, body').animate({scrollTop: $('body').offset().top}, 2000);
	    },
	    success:  function(data) {
	    	//alert(data);
	    	data = data.split('|');

	    	$('#'+name+' input').val('');
			$('#'+name+' textarea').val('');
			$('.aviso').html(data[1]).delay(4000).fadeOut();	
				
	    }
	 });/**/
     return false;
}

//galeria noticia
var moving = false;
