<?php

if (isset($_POST['email']) || isset($_POST['PostId']) || isset($_POST['content'])) {
    include '../config/DbConnection.php';
}else{
    include 'config/DbConnection.php';
}
class User extends DbConnection
{

    public function create($post)
    {
        $name = $post['name'];
        $email = $post['email'];
        $con = $this->connect();
         mysqli_query($con, "INSERT INTO users(name,email) VALUES('$name','$email')");
        $id =  mysqli_insert_id($con);
        return $id;
    }
    public function AllUsers(){
        $con = $this->connect();
        $result = mysqli_query($con, "SELECT * from users");
        $users = mysqli_fetch_all($result,MYSQLI_ASSOC);
        return $users;
    }
}
$user = new User;
$allUsers = $user->AllUsers();
?>
