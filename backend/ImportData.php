<?php

require 'DbConnection.php';



class ImportData extends DbConnection {

     public function __construct($urlUsers,$urlPosts)
     {
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $urlUsers);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
         $output = curl_exec($ch);
         $usersArray = json_decode($output);
         foreach ($usersArray as $user) {
             $sql = "INSERT INTO users(name,email)VALUES('$user->name','$user->email')";
             mysqli_query($this->connect(),$sql);
           curl_close($ch);
        }
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $urlPosts);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
         $output = curl_exec($ch);
         $postArray = json_decode($output);
         foreach ($postArray as $post) {
             $sql = "INSERT INTO posts(user_id,title,body)VALUES('$post->userId','$post->title','$post->body')";
             mysqli_query($this->connect(),$sql);
         }
         curl_close($ch);
     }

}
$import = new importData('https://jsonplaceholder.typicode.com/users','https://jsonplaceholder.typicode.com/posts');


