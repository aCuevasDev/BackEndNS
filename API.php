<?php

namespace API;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \DateTime as DateTime;

class API
{

    public function __construct()
    {
        $settings = ['displayErrorDetails' => true];
        parent::__construct(['settings' => $settings]);

        // Define the ROUTES
        $this->get('/register', '\API\API::register');
        $this->get('/item/{code}/{room}/{name}/{qr}', '\API\API:tmpAddItem');
        $this->get('/hint/{hint}/{item}', '\API\API:tmpAddHint');

        $this->post('/register', '\Api\API:register');

        $this->get('/room/{code}', '\API\API:getRoom');
        $this->get('/rooms', '\API\API:getRooms');
        $this->get('/items/{room}', '\API\API:getItems');
        $this->get('/hints/{item}', '\API\API:getHints');
    }


    public static function register(Request $request, Response $response, array $args)
    {
        $paramMap = $request->getParsedBody();
        if ($paramMap['email'] == null ||
            $paramMap['username'] == null ||
            $paramMap['password'] == null) {
            return $response->withJson([], 404);
        }
        $email = $paramMap['email'];
        $username = $paramMap['username'];
        $password = $paramMap['password'];
        $user = new \API\Model\User();
        $user->setUsername($paramMap['username']);
        $user->setPassword($paramMap['password']);
        $user->setEmail($paramMap['email']);
        $dateTime = new DateTime();
        $user->setCreated($dateTime->getTimestamp());
        $user->save();
        return $response->withJson($user, 200);
    }

    public static function uploadImage(Request $request, Response $response, array $args) {
        // He cogido éste código de nuestro proyecto de fin de ciclo y lo he modificado un poco
        // por lo que pueda que se parezca al de mis compañeros

        $user = getUser($request);
        define('UPLOAD_DIR','../files/');
        $dir = exec('dir');
        $img = $request->imgBase64;
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = UPLOAD_DIR . uniqid() . '.png';
        $success = file_put_contents($file, $data);

        $user->setImage($file);
        $user->save();
        return API::generateOkResp($response, Array("user" => $dir->toArray())); // TODO Change Dir
    }

    public static function getUserFromToken(Request $request){
        $token = $request->getHeader('Authorization')[0];

        if (!isset($token) || $token == "") {
            return false;
        }

        $jwt_values = explode('.', $token);
        $signature = Token::base64url_encode(hash_hmac('sha256', $jwt_values[0]. '.'. $jwt_values[1], Token::$secret_key, true));
        if ($jwt_values[2] != $signature) {
            return false;
        }
        $user = \Model\UserQuery::create()->findPK(Token::base64url_decode($jwt_values[1]));
        if ($user->getDeletedat() != null) {
            return false;
        }
        return $user;
    }


    public static function getRoom(Request $request, Response $response, array $args)
    {
        $code = $args['code'];
        $room = \API\Model\RoomQuery::create()->filterByCode($code)->find();
        if (is_null($room) || empty($room)) {
            return $response->withJson([], 404);
        }
        return $response->withJson($room->toArray()[0]);
    }

    public static function generateOkResp(Response $response){

    }

    public static function generateErrorResp(Response $response){

    }


    /*public static function helloGET(Request $request, Response $response, array $args) {
      $name = $args['name'];
      $response->getBody()->write("Hello, $name");
      return $response;
    }

    public function jsonGET(Request $request, Response $response, array $args) {
      $data = [
        'data' => 'Hello!',
        'success' => 1
      ];
      return $response->withJson($data);
    }

    public function teachersGET(Request $request, Response $response, array $args) {
      $teachers = \API\Model\TeacherQuery::create()->find();
      $data = $teachers->toArray();
      return $response->withJson($data);
    }

    public function teacherGET(Request $request, Response $response, array $args) {
      $id = $args['id'];
      $teacher = \API\Model\TeacherQuery::create()->findPK($id);
      if (is_null($teacher)) {
        return $response->withJson([], 404);
      }
      else {
        $data = $teacher->toArray();
        $data['AssignmentCount'] = $teacher->getAssignmentCount();
        $data['TotalHours'] = $teacher->getTotalHours();
        $data['Assignments'] = $teacher->getAssignments()->toArray();
        return $response->withJson($data);
      }
    }

    public function teacherSearchGET(Request $request, Response $response, array $args) {
      $search = trim($args['search']);
      $search = empty($search) ? '%' : ('%' . $search . '%');
      $teachers = \API\Model\TeacherQuery::create()->filterByName($search, Criteria::LIKE)->orderByName()->find();
      return $response->withJson($teachers->toArray());
    }

    public function assignmentGET(Request $request, Response $response, array $args) {
      $data = [];
      $status = 200;
      if (isset($args['id'])) {
        $id = $args['id'];
        $assignment = \API\Model\AssignmentQuery::create()->findPK($id);
        if (!is_null($assignment)) $data = $assignment->toArray();
        else $status = 404;
      }
      else {
        $assignments = \API\Model\AssignmentQuery::create()->find();
        $data = [];
        foreach($assignments as $assignment) {
          $info = $assignment->toArray();
          $teacher = $assignment->getTeacher();
          if (!is_null($teacher)) {
            $info['Teacher'] = $teacher->toArray();
          }
          $data[] = $info;
        }
      }
      return $response->withJson($data, $status);
    }

    public function tableGET($request, $response, $args) {
      $loader = new \Twig_Loader_Filesystem(SRC_DIR . '/templates');
      $twig = new \Twig_Environment($loader, ['cache' => false]);
      $assignments = \API\Model\AssignmentQuery::create()->find();
      $rows = [];
      foreach($assignments as $assignment) {
        $info = $assignment->toArray();
        $teacher = $assignment->getTeacher();
        $info['Teacher'] = !is_null($teacher) ? $teacher->getName() : '-';
        $rows[] = $info;
      }
      $params = ['Assignments' => $rows];
      $html = $twig->render('table.html', $params);
      $response->getBody()->write($html);
      return $response;
    }*/
}

;
