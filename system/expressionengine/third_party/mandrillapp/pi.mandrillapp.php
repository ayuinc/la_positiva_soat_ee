<?php 

$plugin_info = array(
						'pi_name'			=> 'Mandrillapp',
						'pi_version'		=> '1.0',
						'pi_author'			=> 'Gianfranco Montoya',
						'pi_author_url'		=> 'http://ayuinc.com',
						'pi_description'	=> 'Envia mensajes usando el API de Mandrillapp - https://mandrillapp.com',
						'pi_usage'			=> Mandrillapp::usage()
					);

/**
 * Send_email class
 *
 * @package			ExpressionEngine
 * @category		Plugin
 * @author			Gianfranco Montoya
 * @copyright		Copyright (c) 2014 Engaging.net
 * @link			--
 */

class Mandrillapp {

	function usage()
	{
		ob_start(); 
		?>
			See the documentation at http://www.engaging.net/docs/send-email
		<?php
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	}

	function send_email_fulfill_form(){
	global $TMPL;
	$this->EE =& get_instance(); // EEv2 syntax
	$TMPL = $this->EE->TMPL;

	require_once 'mailchimp-mandrill-api-php/src/Mandrill.php'; 
	$mandrill = new Mandrill('IUGxsICy9KnL1OiDYwd0qA');

	$nombre= $TMPL->fetch_param('nombre');
	$email_cliente= $TMPL->fetch_param('to');
	$email_cliente= "gms122@gmail.com";
	$telefono= $TMPL->fetch_param('telefono');
	$name= "La Positiva Seguros";
	$subject= "SOAT La Positiva";
	$from = "lineapositiva@lapositiva.com.pe";
	//$text = $TMPL->tagdata;
	
	$text = "Hola ".$nombre."<br>
	Muchas gracias por tu interés en SOAT la Positiva. En breve te estaremos contactando para completar el proceso de venta.<p>
	La Positiva Seguros<br>www.lapositiva.com.pe
	";

	/*'html' => '<p>FELICIDADES!!!</p><p>Ganaste el tema'.$topic.' ve a nuestro menú de temas y sigue participando</p>',*/
	$message = array(
	    'subject' => $subject,
	    'from_email' => $from,
	    'html' => $text,
	    'to' => array(array('email' => $mail_cliente, 'name' => $name)),
	    'merge_vars' => array(array(
		        'rcpt' => 'recipient1@domain.com',
		        'vars' =>
		        array(
		            array(
		                'name' => 'FIRSTNAME',
		                'content' => 'Recipient 1 first name'),
		            array(
		                'name' => 'LASTNAME',
		                'content' => 'Last name')
		    ))));

	$template_name = 'test';

	$template_content = array(
	    array(
	        'name' => 'main',
	        'content' => 'Hi *|FIRSTNAME|* *|LASTNAME|*, thanks for signing up.'),
	    array(
	        'name' => 'footer',
	        'content' => 'Copyright 2012.')

	);
	$mandrill->messages->sendTemplate($template_name, $template_content, $message);
	return 'exito a';
	}

	function send_email_admin_form(){
	global $TMPL;
	$this->EE =& get_instance(); // EEv2 syntax
	$TMPL = $this->EE->TMPL;

	require_once 'mailchimp-mandrill-api-php/src/Mandrill.php'; 
	$mandrill = new Mandrill('IUGxsICy9KnL1OiDYwd0qA');

	$nombre= $TMPL->fetch_param('nombre'); 	
	$telefono= $TMPL->fetch_param('telefono');
	$email_cliente= $TMPL->fetch_param('email_cliente');
	$email_cliente= $TMPL->fetch_param('to');
	$email_cliente= "gms122@gmail.com";
	$name= "La Positiva Seguros";
	$subject= "SOAT La Positiva";
	$from= "lineapositiva@lapositiva.com.pe";
	//$text = $TMPL->tagdata;
	
	echo $text = "Estimados<br>
	La siguiente persona a solicitado ser contactada para comprar el SOAT La Positiva.
	<br>
	Nombre: ".$nombre."<br>
	E-mail: ".$email_cliente."<br>
	Teléfono: ".$telefono."<br>
	<br>
	Muchas gracias,
	<br>
	Correo automático mini-site SOAT La Positiva.
	www.lapositiva.com.pe";

	/*'html' => '<p>FELICIDADES!!!</p><p>Ganaste el tema'.$topic.' ve a nuestro menú de temas y sigue participando</p>',*/
	$message = array(
	    'subject' => $subject,
	    'from_email' => $from,
	    'html' => $text,
	    'to' => array(array('email' => $mail_cliente, 'name' => $name)),
	    'merge_vars' => array(array(
		        'rcpt' => 'recipient1@domain.com',
		        'vars' =>
		        array(
		            array(
		                'name' => 'FIRSTNAME',
		                'content' => 'Recipient 1 first name'),
		            array(
		                'name' => 'LASTNAME',
		                'content' => 'Last name')
		    ))));

	$template_name = 'test';

	$template_content = array(
	    array(
	        'name' => 'main',
	        'content' => 'Hi *|FIRSTNAME|* *|LASTNAME|*, thanks for signing up.'),
	    array(
	        'name' => 'footer',
	        'content' => 'Copyright 2012.')

	);
	$mandrill->messages->sendTemplate($template_name, $template_content, $message);
	return 'exito b';
	}

}
// END CLASS