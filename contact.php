<?php  
    define( 'MAIL_TO', /* >>>>> */'contact@dkcommunication.fr'/* <<<<< */ );  
    define( 'MAIL_FROM', '' ); 
    define( 'MAIL_OBJECT', '' ); 
    define( 'MAIL_MESSAGE', '' );  

    $mailSent = false;  
    $errors = array(); 
      
    if( filter_has_var( INPUT_POST, 'send' ) )
    {  
        $from = filter_input( INPUT_POST, 'from', FILTER_VALIDATE_EMAIL );  
        if( $from === NULL || $from === MAIL_FROM )
        {  
            $errors[] = 'Vous devez renseigner votre adresse de courrier électronique.';  
        }  
        elseif( $from === false ) 
        {  
            $errors[] = 'L\'adresse de courrier électronique n\'est pas valide.';  
            $from = filter_input( INPUT_POST, 'from', FILTER_SANITIZE_EMAIL );  
        }  

        $object = filter_input( INPUT_POST, 'object', FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_HIGH | FILTER_FLAG_ENCODE_LOW );  
        if( $object === NULL OR $object === false OR empty( $object ) OR $object === MAIL_OBJECT ) 
        {  
            $errors[] = 'Vous devez renseigner l\'objet.';  
        }  

 
        $message = filter_input( INPUT_POST, 'message', FILTER_UNSAFE_RAW );  
        if( $message === NULL OR $message === false OR empty( $message ) OR $message === MAIL_MESSAGE ) 
        {  
            $errors[] = 'Vous devez écrire un message.';  
        }  

        if( count( $errors ) === 0 )
        {  
            if( mail( MAIL_TO, $object, $message, "From: $from\nReply-to: $from\n" ) ) 
            {  
                $mailSent = true;  
            }  
            else 
            {  
                $errors[] = 'Votre message n\'a pas été envoyé.';  
            }  
        }  
    }  
    else 
    {  
        $from = MAIL_FROM;  
        $object = MAIL_OBJECT;  
        $message = MAIL_MESSAGE;  
    }  
?>
<!DOCTYPE HTML>
<html lang="fr" >
   <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	    <meta name="description" content="dk communication marketing est une agence de conseil, création de sites Internet, 
		 de graphisme tel que : logos, flyers, cartes de visites, mais aussi de marketing à Valence, Romans dans la drome, région Rhone-Alpes. "/>
	   <link rel="stylesheet" href="style.css"/>
	   <title>dk Communication &amp Marketing</title>
   </head>
   <body>
		<header>
		 
		
		<div id="date">
		<?php
		include('php\date.php')
		?>
		
		</div>
		<div id="dk">
   <img src="dk.png" alt="dk"/>	
 
   </div>
   
   
   <div id="header">
  
  </div>
  
  <div id="menu">
  <nav>
  <ul>
  <li><a href="index.php" class="index">dk Communication &amp Marketing</a></li> 
  <li><a href="">Nos services</a>

	<ul>
	<li><a href="com.php" class="com">Conseil en communication</a></li>
	<li><a href="mark.php" class="mark">Marketing</a></li>
	<li><a href="graph.php" class="graph">Graphisme</a></li>
	<li><a href="web.php" class="web">Web</a></li>
	</ul>
	</li>

  <li><a href="ref.php" class="ref">Nos references</a></li>
  <li><a href="contact.php" class="contact">Contact</a></li>
  <li><a href="cgu.php" class="cgu">Mentions legales</a></li>
  </ul>
  </nav>
  </div>
		</header>
		<article>
		
		<div id="logo">
		<p>Suivez-nous !</p>
		<a href="https://www.facebook.com/dkcommunication?ref=settings" target="_blank"><img src="images/facebooklogo.png" alt="facebook" id="face"width="75px" BORDER="0"/></a>
		<a href="https://twitter.com/dk_Com_" target="_blank"><img src="images/twitterlogo.png" alt="twitter" id="twi"width="75px" BORDER="0"/></a>
</div>	
		
  <div id="content">
  <h1>Contactez-nous :</h1>
  <p>dk Communication &amp Marketing</br>
  06 68 81 56 33</br>
  contact@dkcommunication.fr</p>
  <?php  
    if( $mailSent === true )
    {  
?>  
        <p id="success">Votre message a bien été envoyé.</p>  
        <p><strong>Courriel pour la réponse :</strong><br /><?php echo( $from ); ?></p>  
        <p><strong>Objet :</strong><br /><?php echo( $object ); ?></p>  
        <p><strong>Message :</strong><br /><?php echo( nl2br( htmlspecialchars( $message ) ) ); ?></p>  
<?php  
    }  
    else 
    {  
        if( count( $errors ) !== 0 )  
        {  
            echo( "\t\t<ul>\n" );  
            foreach( $errors as $error )  
            {  
                echo( "\t\t\t<li>$error</li>\n" );  
            }  
            echo( "\t\t</ul>\n" );  
        }  
        else  
        {  
            echo( "\t\t<p id=\"welcome\"><em>Tous les champs sont obligatoires</em></p>\n" );  
        }  
?>  
        <form id='contact' method="post" action="<?php echo( $_SERVER['REQUEST_URI'] ); ?>">  
            <p>  
                <label for="from">Votre adresse e-mail :</label>  
                <input type="text" name="from" id="from" value="<?php echo( $from ); ?>" />  
            </p>  
            <p>  
                <label for="object">Objet :</label>  
                <input type="text" name="object" id="object" value="<?php echo( $object ); ?>" />  
            </p>   
            <p>  
                <label for="message">Message :</label> </br> 
                <textarea name="message" id="message" rows="6" cols="50"><?php echo( $message ); ?></textarea>  
            </p>  
            <p>  
                <input type="reset" name="reset" value="Effacer" />  
                <input type="submit" name="send" value="Envoyer" />  
            </p>  
        </form>  
<?php  
    }  
?>  
  

		
		
		</article>
		
		<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-48466584-1', 'dkcommunication.fr');
  ga('send', 'pageview');

</script>
</body>
		<footer>

		<h2>© copyright 2014 - dk Communication &amp Marketing</h2>
		</footer>
		
		</html>