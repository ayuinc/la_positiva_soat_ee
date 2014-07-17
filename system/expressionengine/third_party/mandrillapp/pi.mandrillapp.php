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
	$to= $TMPL->fetch_param('to');
	$telefono= $TMPL->fetch_param('telefono');
	$name= "La Positiva Seguros";
	$subject= "SOAT La Positiva";
	$from = "lineapositiva@lapositiva.com.pe";
	//$text = $TMPL->tagdata;
	
	$text = "
	<html>
    <head>
      <title>La Positiva</title>
      <meta charset='UTF-8'>
    </head>
    <body style='margin: 0px; background-color: #f1f1f1; font-family: Helvetica Neue, Helvetica, Arial, sans-serif; color: #898989;' bgcolor='#f1f1f1'>
      
      <table align='center' width='90%' style='width:90%; margin-left: auto; margin-right: auto;' CELLSPACING='0' CELLPADDING='0'>
        <tr style='background-color: #f1f1f1;' bgcolor='#f1f1f1'>
            <td><p><br></p>
            </td>
        </tr>
        <tr style='background-color: #F37134;' bgcolor='#F37134'>
          <td>
            <table align='center' width='90%' style='width:90%; margin-left: auto; margin-right: auto;'>
              <tr>
                <td align='right' height='40'>
                  <img src='http://54.191.133.15/img/logo-blanco-correos.png' style='width:50px; height: auto;'>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr style='background-color: #ffffff;' bgcolor='#ffffff'>
          <td>
            <table align='center' width='90%' style='width:90%; margin-left: auto; margin-right: auto;'  CELLSPACING='0' CELLPADDING='0'>
              <tr> <td><br></td></tr>
              <tr>
                <td align='left'><span style='color: #898989;'><h3>Hola ".$nombre.",</h3></span>
                  <span style='color: #898989; font-size: 14px;'>Muchas gracias por tu interés en SOAT la Positiva. En breve te estaremos contactando para completar el proceso de venta.<p>
                  Para mayor información puedes llamar a: <br>
                  Linea Positiva Informes: 211-0-212 (Lima) / 74-9001* (Provincias)<br>
                  Linea Positiva Reclamos: 211-0-211 (Lima) / 74-9000* (Provincias)<br>
                  <span style='color: #898989; font-size: 12px;'>*Desde celulares, debes marcar el código del departamento previamente.</span></span>
                  
                  <span style='color: #898989; font-size: 14px;'>Muchas gracias,</span><br>
                  <span style='color: #898989; font-size: 14px;'>La Positiva Seguros</span><br>
                  <span style='color: #898989; font-size: 14px;'><a href='http://www.lapositiva.com.pe/home' target='_blank'>www.lapositiva.com.pe</a><p></span>
                  <span style='color: #898989; font-size: 12px;'>**No responder. Correo automático mini-site SOAT La Positiva.**</span>
                  <p>
                </td>
              </tr>
            </table>  
          </td>
        </tr>
        <tr>
          <td align='center'>
              <span style='font-size: 12px;'><br>2014 La Positiva, todos los derechos reservados.</span>
          </td>
        </tr>
      </table>
    </body>
  </html>";


	/*'html' => '<p>FELICIDADES!!!</p><p>Ganaste el tema'.$topic.' ve a nuestro menú de temas y sigue participando</p>',*/
	$message = array(
	    'subject' => $subject,
	    'from_email' => $from,
	    'html' => $text,
	    'to' => array(array('email' => $to, 'name' => $name)),
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
	return '';
	}

	function send_email_admin_form(){
	global $TMPL;
	$this->EE =& get_instance(); // EEv2 syntax
	$TMPL = $this->EE->TMPL;

	require_once 'mailchimp-mandrill-api-php/src/Mandrill.php'; 
	$mandrill = new Mandrill('IUGxsICy9KnL1OiDYwd0qA');

	$nombre= $TMPL->fetch_param('nombre'); 	
	$telefono= $TMPL->fetch_param('telefono');
	$to= $TMPL->fetch_param('to');
	//$to= "jcmoron82@gmail.com";
	$email_cliente= $TMPL->fetch_param('email_cliente');
	$name= "La Positiva Seguros";
	$subject= "SOAT La Positiva";
	$from= "lineapositiva@lapositiva.com.pe";
	//$text = $TMPL->tagdata;
	
	$text = "
	<html>
    <head>
      <title>La Positiva</title>
      <meta charset='UTF-8'>
    </head>
    <body style='margin: 0px; background-color: #f1f1f1; font-family: Helvetica Neue, Helvetica, Arial, sans-serif; color: #898989;' bgcolor='#f1f1f1'>
      
      <table align='center' width='90%' style='width:90%; margin-left: auto; margin-right: auto;' CELLSPACING='0' CELLPADDING='0'>
        <tr style='background-color: #f1f1f1;' bgcolor='#f1f1f1'>
            <td><p><br></p>
            </td>
        </tr>
        <tr style='background-color: #F37134;' bgcolor='#F37134'>
          <td>
            <table align='center' width='90%' style='width:90%; margin-left: auto; margin-right: auto;'>
              <tr>
                <td align='right' height='40'>
                  <img src='http://54.191.133.15/img/logo-blanco-correos.png' style='width:50px; height: auto;'>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr style='background-color: #ffffff;' bgcolor='#ffffff'>
          <td>
            <table align='center' width='90%' style='width:90%; margin-left: auto; margin-right: auto;'  CELLSPACING='0' CELLPADDING='0'>
              <tr> <td><br></td></tr>
              <tr>
                <td align='left'><span style='color: #898989;'><h3>Estimados</h3></span>
                  <span style='color: #898989; font-size: 14px;'>
                    La siguiente persona ha solicitado ser contactada para comprar el SOAT La Positiva.
                    <br>
                    Nombre: ".$nombre."<br>
                    E-mail: ".$email_cliente."<br>
                    Teléfono: ".$telefono."<br>
                    <br>
                    Muchas gracias,
                    <br>
                    La Positiva Seguros<br>
                    <a href='http://www.lapositiva.com.pe/home' target='_blank'>www.lapositiva.com.pe</a><p></span>
                  <span style='font-size: 12px;'>**No responder. Correo automático mini-site SOAT La Positiva.**</span>
                  <p>
                </td>
              </tr>
            </table>  
          </td>
        </tr>
        <tr>
          <td align='center'>
              <span style='font-size: 12px;'><br>2014 La Positiva, todos los derechos reservados.</span>
          </td>
        </tr>
      </table>
    </body>
  </html>";

	/*'html' => '<p>FELICIDADES!!!</p><p>Ganaste el tema'.$topic.' ve a nuestro menú de temas y sigue participando</p>',*/
	$message = array(
	    'subject' => $subject,
	    'from_email' => $from,
	    'html' => $text,
	    'to' => array(array('email' => $to, 'name' => $name)),
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
	return '';
	}

}
// END CLASS