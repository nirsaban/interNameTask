
<?php require_once 'template/header.html';?>
<?php require_once 'config/init.php';?>
<?php

$user = new User;
$allUsers = $user->AllUsers();



?>

<div class="container">
    <h2 class="display-4 text-center">Search User By ID</h2>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">email</th>
            <th scope="col">allPost</th>
        </tr>
        </thead>
        <tbody>
        <?php $count = 0 ?>
        <?php foreach ($allUsers as $user):?>
        <?php $count++ ?>
        <tr>
            <th scope="row"><?= $count ?></th>
            <td><?= $user['name'] ?></td>
            <td><?= $user['email'] ?></td>
            <?php
            $keyValue = array(
                'userId' => $user['id'],
                'name' => $user['name'],);
            $query = http_build_query($keyValue)
            ?>
            <td><a href = "postsByUserId.php/?<?php print_r($query)?>">GO To My Posts</a></td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>

</div>
</body>
</html>