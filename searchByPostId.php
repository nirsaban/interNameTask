<?php require_once 'template/header.html';?>
<?php require_once 'config/init.php';?>


<div class="container  ">
 <h2 class="display-3 text-center">Search By Post Id</h2>
    <div class="row ">
        <form style="margin-top: 3rem" class="form-inline  mx-auto">
            <input class="form-control mr-sm-2"  type="number" name="PostId" placeholder="enter post Id" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Show</button>
        </form>
    </div>
    <div id ="card" class="card center mx-auto" style="width: 18rem;margin-top: 3rem;display: none">
        <div class="card-body">
            <h5 id = "title" class="card-title"></h5>
            <p id="body" class="card-text"></p>
            <p>created at :</p>
            <a href="#" class="card-link" id="created_at"></a>

        </div>
    </div>
</div>
<script>
    $("form").submit(function(event){
        event.preventDefault()
        let formValues = $(this).serialize();
        $.post("backend/Post.php", formValues, function(data){
            if(data != 'post no found'){
                let ArrData = JSON.parse(data)
                for (const [key, postObject] of Object.entries(ArrData)) {
                        card.style.display = 'block'
                        title.textContent = postObject['title']
                        body.textContent = postObject['body']
                        created_at.textContent = postObject['created_at']
                }
            }else{
                alert('post not found')
            }
        });
    });
</script>
</body>
</html>

