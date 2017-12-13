    <script src="<?php echo ROOT?>js/vendor/jquery.js"></script>
    <script src="<?php echo ROOT?>js/foundation.min.js"></script>
	<script src="<?php echo ROOT?>js/jquery.ajaxSubmit.js"></script>
	<script src="<?php echo ROOT?>js/valida.js"></script>
    <script>
      $(document).foundation();
		
		  var theToggle = document.getElementById('toggle');

		// based on Todd Motto functions
		// https://toddmotto.com/labs/reusable-js/

		// hasClass
		function hasClass(elem, className) {
			return new RegExp(' ' + className + ' ').test(' ' + elem.className + ' ');
		}
		// addClass
		function addClass(elem, className) {
			if (!hasClass(elem, className)) {
				elem.className += ' ' + className;
			}
		}
		// removeClass
		function removeClass(elem, className) {
			var newClass = ' ' + elem.className.replace( /[\t\r\n]/g, ' ') + ' ';
			if (hasClass(elem, className)) {
				while (newClass.indexOf(' ' + className + ' ') >= 0 ) {
					newClass = newClass.replace(' ' + className + ' ', ' ');
				}
				elem.className = newClass.replace(/^\s+|\s+$/g, '');
			}
		}
		// toggleClass
		function toggleClass(elem, className) {
			var newClass = ' ' + elem.className.replace( /[\t\r\n]/g, " " ) + ' ';
			if (hasClass(elem, className)) {
				while (newClass.indexOf(" " + className + " ") >= 0 ) {
					newClass = newClass.replace( " " + className + " " , " " );
				}
				elem.className = newClass.replace(/^\s+|\s+$/g, '');
			} else {
				elem.className += ' ' + className;
			}
		}

		theToggle.onclick = function() {
		   toggleClass(this, 'on');
		   return false;
		}		
	
    </script>     	

<!--MESSENGER-->
       
<!--<script>      window.fbMessengerPlugins = window.fbMessengerPlugins || {        init: function () {          FB.init({            appId            : '1678638095724206',            autoLogAppEvents : true,            xfbml            : true,            version          : 'v2.10'          });        }, callable: []      };      window.fbAsyncInit = window.fbAsyncInit || function () {        window.fbMessengerPlugins.callable.forEach(function (item) { item(); });        window.fbMessengerPlugins.init();      };      setTimeout(function () {        (function (d, s, id) {          var js, fjs = d.getElementsByTagName(s)[0];          if (d.getElementById(id)) { return; }          js = d.createElement(s);          js.id = id;          js.src = "//connect.facebook.net/en_US/sdk/xfbml.customerchat.js";          fjs.parentNode.insertBefore(js, fjs);        }(document, 'script', 'facebook-jssdk'));      }, 0);      </script>            <div        class="fb-customerchat"        page_id="169778796383009"        ref="">      </div>    -->



<!-- MailerLite Universal -->
<script>
(function(m,a,i,l,e,r){ m['MailerLiteObject']=e;function f(){
var c={ a:arguments,q:[]};var r=this.push(c);return "number"!=typeof r?r:f.bind(c.q);}
f.q=f.q||[];m[e]=m[e]||f.bind(f.q);m[e].q=m[e].q||f.q;r=a.createElement(i);
var _=a.getElementsByTagName(i)[0];r.async=1;r.src=l+'?v'+(~~(new Date().getTime()/1000000));
_.parentNode.insertBefore(r,_);})(window, document, 'script', 'https://static.mailerlite.com/js/universal.js', 'ml');

var ml_account = ml('accounts', '1004292', 'r5q5a1i0r9', 'load');
</script>
<!-- End MailerLite Universal -->
        
        
         <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-879149-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-879149-1');
</script>

         