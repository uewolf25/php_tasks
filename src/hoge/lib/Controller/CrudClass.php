<?php

namespace Src\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use \PDO;

class CrudClass{
  // php data object
  private $pdo;

  // public function __construct(){
    // $this->pdo = createDatabaseObject();
  // }

  /**
   * createDatabaseObject
   * PDOの初期化
   * 
   * @return $pdo
   */
  private function createDatabaseObject(){
    $dsn = 'mysql:host=mysql;dbname=task';
    $user = 'tasker';
    $pass = 'task';
    try{
      $this->pdo = new PDO($dsn, $user, $pass);
    } catch(PDOException $e){
      echo $e->getMessage() . "<br>";
    }
    return $db;
  }

  /**
   * getAllTitle
   * 全てのデータを取得する。
   *
   * @param Request $request
   * @param Response $response
   * @return Response
   */
  public function getAllTitle(Request $request, Response $response) : Response{
    $this->createDatabaseObject();

    $stmt = $this->pdo->prepare('select id, title, description from task;');
    $stmt->execute();
  
    // 全データ取得
    $taskData = $stmt->fetchAll();
    $response->getBody()->write(json_encode($taskData, JSON_UNESCAPED_UNICODE));
    return $response;
  }


  /**
   * postTitle
   * 任意のidのデータを追加する。
   *
   * @param Request $request
   * @param Response $response
   * @return Response
   */
  public function postTitle(Request $request, Response $response) : Response{
    $body = $request->getBody()->getContents();
    $input = json_decode($body);
    $title = $input->title;
    $description = $input->description;

    $this->createDatabaseObject();

    $stmt = $this->pdo->prepare('insert into task(title, description) values(?, ?)');
    $stmt->execute(array($title, $description));
    return $response;
  }

  /**
   * getTitle
   * 任意のidのデータを取得する。
   *
   * @param Request $request
   * @param Response $response
   * @param array $args プレースパラメータ{id}
   * @return Response
   */
  public function getTitle(Request $request, Response $response, array $args) : Response{
    // parameters (id)
    $id = $args['id'];

    $this->createDatabaseObject();

    $stmt = $this->pdo->prepare('select * from task where id=?');
    $stmt->execute(array($id));

    // 全データ取得
    $taskData = $stmt->fetchAll();
    $response->getBody()->write(json_encode($taskData, JSON_UNESCAPED_UNICODE));
    return $response;
  }

  /**
   * updateTitle
   * 任意のidのデータを更新する。
   *
   * @param Request $request
   * @param Response $response
   * @param array $args プレースパラメータ{id}
   * @return Response
   */
  public function updateTitle(Request $request, Response $response, array $args) : Response{
    $body = $request->getBody()->getContents();
    $input = json_decode($body);
    $id = $args['id'];
    $title = $input->title;
    $description = $input->description;

    $this->createDatabaseObject();

    $stmt = $this->pdo->prepare('update task set title=?, description=? where id=?');
    $stmt->execute(array($title, $description, $id));
    return $response;
  }

  /**
   * deleteTitle
   * 任意のidのデータを削除する。
   * 
   * @param Request $request
   * @param Response $response
   * @param array $args プレースパラメータ{id}
   * @return Response
   */
  public function deleteTitle(Request $request, Response $response, array $args) : Response{
    $id = $args['id'];

    $this->createDatabaseObject();

    $stmt = $this->pdo->prepare('delete from task where id=?');
    $stmt->execute(array($id));
    return $response;
  }
}