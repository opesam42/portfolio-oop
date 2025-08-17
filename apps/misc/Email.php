<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    class Email{
        private function loadMailer(){
            require __DIR__ . '/../../vendor/autoload.php';
            return new PHPMailer(true);  
        }

        public function sendMail($name, $email, $mobile, $message){

            try{
                $mail = $this->loadMailer();
                //server setting
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 465;
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'ssl';
                $mail->Username = ADMIN_EMAIL;
                $mail->Password = ADMIN_EMAIL_PSWD;
        
                //Recipient
                $mail->setFrom(ADMIN_EMAIL, AUTHOR);
                $mail->addAddress( $email, $name );
                $mail->addAddress(ADMIN_EMAIL_BACKUP1);
                $mail->addAddress(ADMIN_EMAIL_BACKUP2);
        
                //Content
                $sanitized_message = str_replace(array("\\r", "\\n", "\r", "\n"), "<br>", $message);
                $emailMessage = stripslashes( str_replace("<br><br>", "<br>", $sanitized_message) );
                $mail->isHTML(true);
                $mail->Subject = "Your message has been received";
                $mail->Body = "
                <html>
                <head>
                    <title>Thank You for Contacting Gbenga Opeyemi</title>
                    <style>
                        body { font-family: Arial, sans-serif; color: #333; }
                        .container { padding: 20px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 5px; }
                        h2 { color: #0056b3; }
                        p { line-height: 1.5; }
                        .footer { margin-top: 20px; font-size: 0.9em; color: #777; }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <h2>Hello {$name},</h2>
                        <p>Thank you for reaching out to Gbenga Opeyemi! I have received your message and appreciate your interest.</p>
                        <p>Here’s a summary of your submission:</p>
                        <blockquote>
                            <strong>Email:</strong>" . $email . "<br>
                            <strong>Mobile:</strong>" . $mobile . "<br>
                            <strong>Your Message:</strong><br>
                            " . $emailMessage . "
                        </blockquote>
                        <p>I will review your message and get back to you as soon as possible.</p>
                        <p>If you have any urgent questions, please feel free to contact me directly at <a href='mailto:gbengaopeyemi04@gmail.com'>gbengaopeyemi04@gmail.com</a>.</p>
                        <p>Best regards,<br>Gbenga Opeyemi<br><a href='gbenga.koyeb.app'>gbenga.koyeb.app</a></p>
                    </div>
                </body>
                </html>";
                
                $mail->send();
                
        
            } catch(Exception $err){
                echo "Message cannot be sent. Mailer Error: {$mail->ErrorInfo}";
                error_log($err->getMessage());
            }
        }

    }
