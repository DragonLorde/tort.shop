<?php

require_once("core/bd.php");
require_once("food.php");
require_once("ussers.php");
require_once("errorHandler.php");

class API {
    private $q;
    private $params;
    public $base;
    private $data;


    function __construct($base)
    {
        $this->base = $base;
        $this->q = $_GET['q'];
        $this->params = explode('/' , $_GET['q']);
        if($_POST) {
            $this->data = $_POST;
        } else {
            $this->data = json_decode(file_get_contents("php://input"), true);
        }
    }

    private function Register() {
        if($this->data['login'] && $this->data['pass']) {
           if(!$this->ChekUser($this->data['login'], $this->data['pass'])) {
                $login = $this->data['login'];
                $pass = $this->data['pass'];

                $stmt = $this->base->prepare("INSERT INTO `users`(`uuid`, `login`, `pass`) VALUES (?, ?, ?)");
                $uuid = uniqid();
                
                $stmt->execute( array( $uuid, $login, $pass,  ) );
                if($stmt) {
                    
                    http_response_code(201);
                    echo json_encode( array(
                        "uuid" => $uuid,
                        "code" => 201,
                    )); 
                } else {
                    ErrorHandler::MakeError("bad request" , "not params" , 401);
                }
           } else {
               ErrorHandler::MakeError("not create" , "user already exists ", 401);
           }
        }
    }
 
    private function ChekUser($login, $pass) {
        $stmt = $this->base->prepare("SELECT * FROM `users` WHERE `login` = ? AND `pass` = ?");
        $stmt->execute( array( $login, $pass ) );
        $res = $stmt->fetch();
        if($res) {
            return true;
        }
            return false;
    }
    
    private function Login() {

        if($this->data['login'] && $this->data['pass']) {
                $login = $this->data['login'];
                $pass = $this->data['pass'];
                $stmt = $this->base->prepare("SELECT * FROM `users` WHERE `login` = ? AND `pass` = ?");
                $stmt->execute( array( $login, $pass ) );
                $res = $stmt->fetch();
                if($res) {
                    $uuid = $this->UpdateUuid($res['id']);
                    http_response_code(201);
                    echo json_encode( array(
                        "uuid" => $uuid,
                        "code" => 201
                    ));
                    exit();
                    return;
                }
                    ErrorHandler::MakeError( "bad request" , "incorect params" , 401 );
        }
    }

    private function UpdateUuid($id) {
        $uuid = uniqid();
        $stmt = $this->base->prepare("UPDATE `users` SET `uuid`= ? WHERE `id` = ?");
        $stmt->execute( array( $uuid, $id ) );
        return $uuid;
    }

    private function GetUserInfo($uuid) {
       
        $res = $this->GetId($uuid);
        echo json_encode( $res, JSON_UNESCAPED_UNICODE );
    }

    private function GetId($uuid) {
        $stmt = $this->base->prepare("SELECT * FROM `users` WHERE `uuid` = ?");
        $stmt->execute( array( $uuid ) );
        $res = $stmt->fetch();
        return $res;
    }

    function start() {
        switch ($this->params[0]) {
            case 'getfoods':
                Food::GetFoods($this->bbased);
                break;
            
            case 'getfood':
                Food::GetFood($this->base , $this->params[1]);
                break;
            case 'getcom':
                Users::GetComments($this->base, $this->params[1]);
                break;
            case 'setcom':
                Users::SetComment($this->base, $this->params[1], $this->params[2], $this->params[3]);
                break;
            case 'srch':
                Food::Search($this->base, $this->params[1]);
                break;
            case 'getfoodfilter':
                Food::GetFoodFilter($this->base);
                break;
            case 'login':
                $this->Login();
                break;
            case 'register':
                $this->Register();
                break;
            case 'getuser':
                $this->GetUserInfo($this->params[1]);
                break;
            default:
                echo "defalut";
                exit();
                break;
        }
    }
}


$app = new API($conn);

$app->start();