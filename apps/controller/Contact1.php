<?php

class Contact extends Controller{
    public function index(){
       $statusMessage = $_SESSION['status'] ?? null;
       unset($_SESSION['status']);
       
       $result = $this->handleFormSubmission();
       // Pass result to the view
       $this->view('contact', [
        'status' => $statusMessage,
        'result' => $result
    ]);
    }
    

    private function handleFormSubmission(){
        $msgModel = new Message();

        $data['name'] = 'dele';
        $data['date_sent'] = date('Y-m-d H:i:s');
        $data['email'] = 'ayo@gmail.com';
        $data['mobile'] = '+2349057339147';
        $data['message'] = 'Hello';

        return $msgModel->add($data);
    }
}