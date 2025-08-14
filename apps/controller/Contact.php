<?php

class Contact{
    use Controller;

    public function index(){
       $statusMessage = $_SESSION['status'] ?? null;
       unset($_SESSION['status']);
       
       $this->submitForm();
       // Pass result to the view
       $this->view('contact', [
        'status' => $statusMessage,
        ]);
    }
    
    public function submitForm(){
        // echo "Yeah";
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            // Process form submission
            $check = $this->handleFormSubmission();

            // Store result in session for feedback on redirect
            if ($check == true) {
                $_SESSION['status'] = 'success';
                $this->sendEmail();
            } else {
                $_SESSION['status'] = 'error';
            }
            
            header("Location: " . getURL());
            exit();
        }
    }

    private function handleFormSubmission(){
        $msgModel = new Message();

        $data['name'] = $_POST['userName'];
        $data['date_sent'] = date('Y-m-d H:i:s');
        $data['email'] = $_POST['userEmail'];
        $data['mobile'] = $_POST['userTel'];
        $data['message'] = $_POST['message'];

        return $msgModel->add($data);
    }

    private function sendEmail(){
        try{
             $email = new Email();

            $name = $_POST['userName'];
            $userEmail = $_POST['userEmail'];
            $mobile = $_POST['userTel'];
            $message = $_POST['message'];

            return $email->sendMail($name, $userEmail, $mobile, $message);
        }

        catch(Exception $err){
            error_log(''. $err->getMessage());
        }
       
    }

}