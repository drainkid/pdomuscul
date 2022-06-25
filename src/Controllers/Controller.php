<?php

namespace Controllers;
use Twig\Environment;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Controller
{
    private $twig;
    private $log;
    private $messengerHandler;
    private Database $db;

    public function __construct($twig)
    {
        $this->db=new Database();
        $this->twig = $twig;
        $this->log = new Logger('action');
        $this->messengerHandler = new StreamHandler('mes.log', Logger::INFO);
        echo $this->twig->render('main.html.twig');
    }

   
function mesform(){
    echo $this->twig->render('mesform.html.twig');
    }
    
function show_messages()
{
    $db_data = $this->db->getMessages();
    foreach ($db_data as $cur) {
        echo $cur['date_time'].' <b>'.$cur['login'].'</b><br>'.$cur['text'].'<br><br>';
    }
}

    function add_message_to_file($message, $log){
        $this ->db ->addMessage(date('d-m-y h:i:s'), $log, $message);


    }
    
}
