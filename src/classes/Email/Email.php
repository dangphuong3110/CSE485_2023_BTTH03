<?php
namespace   BTTH03\Email;                                        

class Email {

    protected $phpmailer;                                    

    public function __construct($email_config)
    {
        $this->phpmailer = new \PHPMailer\PHPMailer\PHPMailer(true); 
        $this->phpmailer->isSMTP();                                  
        $this->phpmailer->SMTPAuth   = true;                     
        $this->phpmailer->Host       = $email_config['server'];      
        $this->phpmailer->SMTPSecure = $email_config['security'];
        $this->phpmailer->Port       = $email_config['port'];       
        $this->phpmailer->Username   = $email_config['username'];    
        $this->phpmailer->Password   = $email_config['password'];    
        $this->phpmailer->SMTPDebug  = $email_config['debug'];      
        $this->phpmailer->CharSet = 'UTF-8';                         
        $this->phpmailer->isHTML(true);                             
    }

    public function sendEmail($from, $to, $subject, $message): bool
    {
        $this->phpmailer->setFrom($from);                          
        $this->phpmailer->addAddress($to);                        
        $this->phpmailer->Subject = $subject;                       
        $this->phpmailer->Body    = '<!DOCTYPE html><html lang="en-us"><body>'
            . $message .'</body></html>';                          
        $this->phpmailer->AltBody = strip_tags($message);            
        $this->phpmailer->Send();                                   
        return true;                                                
    }
}