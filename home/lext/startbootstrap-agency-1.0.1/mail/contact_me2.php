<?php

/* apenas dispara o envio da mensagem caso houver/existir $_POST['enviar'] */
if (isset($_POST)) 
{
    /* #### ALTERE OS CAMPOS ENTRE ASPAS SIMPLES DESTACADOS ABAIXO #### */

    /* ## CAMPO 1 ## Informe o e-mail que receberá o formulário */
    $destinatarios = 'info@lext.com.br';

    /* ## CAMPO 2 ## Informe o nome que será exibido no e-mail do formulário */
    $nomeDestinatario = 'Lext';

    /* ## CAMPO 3 ## Informe o endereço de e-mail completo criado em sua hospedagem, que será o remetente da mensagem. Como por exemplo teste@seudominio */
    $usuario = 'info@lext.com.br';

    /* ## CAMPO 4 ## Informe a senha do endereço de e-mail acima */
    $senha = 'lu5661';



    /* abaixo as veriaveis principais, que devem conter em seu formulario */
    $name    = $_POST['name'];
  
    $email    = $_POST['email'];
    $phone   = $_POST['phone'];
 
    $message = $_POST['message'];
    
	$mensagem = "<b>E-mail: </b> $email<br/>
            <b>Menssagem: </b><br/> 
             $message <br/>
            <b>Phone: $phone<br/>
            ";


    /*     * ********************************* A PARTIR DAQUI NAO ALTERAR *********************************** */

    require "PHPMailerAutoload.php";

    $To = $destinatarios;
    $Subject = 'Contato - '. $name;
    $Message = $mensagem;

    $Host = 'smtp.' . substr(strstr($usuario, '@'), 1);
    $Username = $usuario;
    $Password = $senha;
    $Port = "587";

    $mail = new PHPMailer();
    $body = $Message;
    $mail->IsSMTP(); // telling the class to use SMTP
    $mail->IsHTML(true);
    $mail->Host = $Host; // SMTP server
    $mail->SMTPDebug = 0; // enables SMTP debug information (for testing)
// 1 = errors and messages
// 2 = messages only
    $mail->SMTPAuth = true; // enable SMTP authentication
    $mail->Port     = $Port; // set the SMTP port for the service server
    $mail->Username = $Username; // account username
    $mail->Password = $Password; // account password

    $mail->SetFrom($usuario, $nomeDestinatario);
    $mail->Subject = $Subject;
    $mail->MsgHTML($body);
    $mail->AddAddress($To, "");
    //$mail->AddAddress('ctec.php@gmail.com'); 
    

  $enviado = $mail->Send();
// Limpa os destinatários e os anexos
  $mail->ClearAllRecipients();
// Exibe uma mensagem de resultado
if ($enviado) {

echo "E-mail enviado com sucesso!";
} 
else 
    {

echo "Não foi possível enviar o e-mail.<br /><br />";

echo "<b>Informações do erro:</b> <br />" . $mail->ErrorInfo;

}

}
?>