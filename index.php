
<?php require_once 'template/header.html';?>

<?php require_once 'config/init.php';?>

<?php
$post = new Post;
$post->InsertPostsToFile();
?>
<div class="container border" style="margin-top: 5rem">
    <h1 class="display-4 text-center">
        add New post
    </h1>
    <div class="row ">
        <form class="col-md-10  mx-auto">
            <div class="form-group ">
                <label for="exampleInputEmail1">Name</label>
                <input type="text"  name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Name">
                <small id="nameHelp" class="form-text text-muted">must be  min 2 chars.</small>
                <span id = 'nameError' style="color: red"></span>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email </label>
                <input type="email"  name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">must be valid email and unique.</small>
                <span id = 'emailError' style="color: red"></span>
            </div>

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title"  class="form-control" id="title" placeholder="Post Title">
                <small id="titleHelp" class="form-text text-muted">must be min 2 chars and max 15 chars.</small>
                <span id = 'titleError' style="color: red"></span>
            </div>
            <label for="body">Post body</label>
            <div class="form-group">
                <textarea id="body" name="body" cols="130" rows="10"></textarea>
                <small id="bodyHelp" class="form-text text-muted">must be min 10 chars .</small>
                <span id = 'bodyError' style="color: red"></span>
            </div>
            <div class="form-group col-md-12 text-center">
                <button type="submit" class="btn btn-primary ">Submit</button>
            </div>
        </form>
    </div>
</div>
<script>
    $("form").submit(function(event){
        event.preventDefault();
        let formValues = $(this).serialize();
        $.post("backend/Post.php", formValues, function(data){
            if(data != 'post and User created successfully'){
                let ArrData = JSON.parse(data)
                for (const [key, value] of Object.entries(ArrData)) {
                    if(key == 'email'){
                        document.getElementById('emailError').innerText = value;
                    }else if(key == 'name'){
                        document.getElementById('nameError').innerText = value;
                    }else if(key == 'title'){
                        document.getElementById('titleError').innerText = value;
                    }else if(key == 'body'){
                        document.getElementById('bodyError').innerText = value;
                    }
                }
            }else{
                alert('post and User created successfully')
            }
        });
    });
</script>
</body>
</html>
