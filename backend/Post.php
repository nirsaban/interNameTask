<?php

include 'User.php';

class Post extends User {

    public function validateForm($post)
    {

        $email = trim($post['email']);
        $name = trim($post['name']);
        $title = trim($post['title']);
        $body = trim($post['body']);
        if (empty($email)) {
            $this->error['email'] = 'the email is required';
            $jsonError = json_encode($this->error);
            print_r($jsonError);
            die();
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->error['email'] = 'the email no valid';
                $jsonError = json_encode($this->error);
                print_r($jsonError);
                die();
            }
        }
        $sql = "SELECT email FROM `users` WHERE email = '$email' LIMIT  1 ";
        $result = mysqli_query($this->connect(), $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $this->error['email'] = 'the email already exist';
            $jsonError = json_encode($this->error);
            print_r($jsonError);
            die();
        }
        if (empty($name)) {
            $this->error['name'] = 'name cannot be empty';
            $jsonError = json_encode($this->error);
            print_r($jsonError);
            die();
        } else {
            if (strlen($name) < 2 || strlen($name) > 20) {
                $this->error['name'] = 'name must be between 2-20 chars only ';
                $jsonError = json_encode($this->error);
                print_r($jsonError);
                die();
            }
        }
        if (empty($title)) {
            $this->error['title'] = 'title cannot be empty';
            $jsonError = json_encode($this->error);
            print_r($jsonError);
            die();
        } else {
            if (strlen($title) < 2 || strlen($title) > 20) {
                $this->error['title'] = 'title must be between 2-20 chars only ';
                $jsonError = json_encode($this->error);
                print_r($jsonError);
                die();
            }
        }
        if (empty($body)) {
            $this->error['body'] = 'body cannot be empty';
            $jsonError = json_encode($this->error);
            print_r($jsonError);
            die();
        } else {
            if (strlen($body) < 20 ) {
                $this->error['body'] = 'Post body  must min 20 chars  ';
                $jsonError = json_encode($this->error);
                print_r($jsonError);
                die();
            }
        }
        $this->create($post);
    }

    public function create($post){
        $userId = parent::create($post);
        $title = $post['title'];
        $body = $post['body'];
        $title = trim(filter_input(INPUT_POST, 'title',FILTER_SANITIZE_STRING));
        $body = trim(filter_input(INPUT_POST, 'body',FILTER_SANITIZE_STRING));
        $con = $this->connect();
        $title = mysqli_real_escape_string($con,$title);
        $post = mysqli_real_escape_string($con,$body);
       $result =  mysqli_query($con, "INSERT INTO posts(user_id,title,body) VALUES('$userId','$title','$body')");
       if(mysqli_affected_rows($con) > 0 ){
          echo 'post and User created successfully';die();
       }else{
           echo 'something faild';die();
       }
    }
    public function searchById($id){
        $con = $this->connect();
        $result =  mysqli_query($con, "SELECT * from posts WHERE id = '$id'");
        if($result && mysqli_num_rows($result) > 0 ){
            $postById = mysqli_fetch_all($result,MYSQLI_ASSOC);
            print_r(json_encode($postById));die();
        }else{
            echo 'post no found';die();
        }
    }
    public function searchByUserId($userId){
        $con = $this->connect();
        $result =  mysqli_query($con, "SELECT * from posts WHERE user_id = '$userId'");
        if($result && mysqli_num_rows($result) > 0 ){
            $postByUserId = mysqli_fetch_all($result,MYSQLI_ASSOC);
           return $postByUserId;
        }else{
            echo 'something faild';die();
        }
    }
    public function searchByContent($str){
        $con = $this->connect();
        $result =  mysqli_query($con, "  SELECT * FROM posts WHERE body LIKE '%$str%' OR title LIKE '%$str%'");
        if($result  && mysqli_num_rows($result) > 0 ){
            $postByContent = mysqli_fetch_all($result,MYSQLI_ASSOC);
            print_r(json_encode($postByContent));die();
        }else{
            echo 'post no found';die();
        }
    }
    public function InsertPostsToFile(){
        $con = $this->connect();
        $result = mysqli_query($con, "SELECT * from posts");
        $posts = mysqli_fetch_all($result,MYSQLI_ASSOC);
        file_put_contents('postJson.php',json_encode($posts));
    }
}

if(isset($_POST['email'])){
  $postObj = new Post;
  $postObj->validateForm($_POST);
}
if (isset($_POST['PostId'])){
    $postObj = new Post;
    $postObj->searchById($_POST['PostId']);
}
if (isset($_POST['content'])){
    $postObj = new Post;
    $postObj->searchByContent($_POST['content']);
}

