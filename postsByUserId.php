<?php require_once 'template/header.html';?>
<?php require_once 'config/init.php';?>
<?php
$postsByUserId = new Post;
$allPosts = $postsByUserId->searchByUserId($_GET['userId']);
?>
<div class="container">
    <h2 class="text-center"><?= $_GET['name']?></h2>

<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">#</th>
        <th scope="col">title Post</th>
        <th style="width: 20%" scope="col">content</th>

    </tr>
    </thead>
    <tbody>
    <?php $count = 0?>
    <?php foreach ($allPosts as $post):?>
    <?php $count++;?>
    <tr>
        <th scope="row"><?=$count?></th>
        <td><?=$post['title']?></td>
        <td><div class="bd-example">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                   show The Content
                </button>
            </div>
        </td>
        <?php require_once 'template/modalContent.php'?>
    </tr>
    <?php endforeach;?>
    </tbody>
</table>
</div>
