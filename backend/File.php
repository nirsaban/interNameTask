<?php

include 'User.php';

class File extends User{

    public function getFromJsonByPostId($id){
        $posts = file_get_contents('postJson.php');
        $postsArr = json_decode($posts);
        foreach ($postsArr as $post) {
            if($post->id == $id) {
                return $post;die();
            }else{
                echo 'the post no found';
            }

        }
    }
    public function getFromJsonByUserId($userId){
        $postsUser = [];
        $posts = file_get_contents('postJson.php');
        $postsArr = json_decode($posts);
        foreach ($postsArr as $post) {
            if($post->user_id != $userId) {
                continue;
            }else{
                array_push($postsUser,$post);
            }

        }
        return $postsUser;
    }
}

$file  = new File;
$file->getFromJsonByPostId($id);
$file->getFromJsonByUserId($userId);

?>