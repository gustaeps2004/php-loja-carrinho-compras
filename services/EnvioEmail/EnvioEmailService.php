<?php namespace APP\Services\EnvioEmail;

require '../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;

class EnvioEmailService
{
  protected PHPMailer $mailer;
  private string $senha = "ktgk tbcm hcmp mfre";
  private string $username = "testephpmailer68@gmail.com";

  public function __construct()
  {
    $this->mailer = new PHPMailer(true);
  }

  public function enviar($emailDestino, $titulo, $conteudo)
  {
    $this->mailer->isSMTP();
    $this->mailer->Host       = gethostbyname('smtp.gmail.com');
    $this->mailer->SMTPAuth   = true;
    $this->mailer->Username   = $this->username;
    $this->mailer->Password   = $this->senha;
    $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $this->mailer->Port       = 587;
    $this->mailer->Timeout    = 15;

    $this->mailer->SMTPOptions = [
        'ssl' => [ // utilizar desta forma apenas em testes locais
            'verify_peer'       => false,
            'verify_peer_name'  => false,
            'allow_self_signed' => true
        ]
    ];

    $this->mailer->SMTPDebug = 3;
    $this->mailer->Debugoutput = 'html';

    $this->mailer->setFrom($this->username);
    $this->mailer->addAddress($emailDestino);

    $this->mailer->isHTML(true);
    $this->mailer->Subject = $titulo;
    $this->mailer->Body    = $conteudo;

    $this->mailer->send();
  }
}