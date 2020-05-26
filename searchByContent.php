<?php require_once 'template/header.html';?>
<?php require_once 'config/init.php';?>

<div class="container  ">
    <h2 class="display-3 text-center">Search By Content </h2>
        <form style="margin-top: 3rem" class="form-inline  ">
            <input class="form-control mr-sm-2" id="content"  type="text" name="content" placeholder="enter Content" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Show</button>
        </form>
        <table class="table mx-auto" style="margin-top: 3rem;display: none" id="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">title</th>
                <th scope="col">body</th>
                <th scope="col">the content search</th>
            </tr>
            </thead>
            <tbody id="bodyParent">

            </tbody>
        </table>

</div>

<script>
    $("form").submit(function(event){
        event.preventDefault()
        let formValues = $(this).serialize();
        $.post("backend/Post.php", formValues, function(data){
            if(data != 'post no found'){
                let ArrData = JSON.parse(data)
                table.style.display = 'inline-block'
                for (const [key, postObject] of Object.entries(ArrData)) {
                    let content = document.getElementById('content').value
                    bodyParent.innerHTML = '<tr>'+
                        `<th scope="row">${postObject['id']}</th>`+
                        `<th scope="row">${postObject['title']}</th>`+
                        `<td>${postObject['body']}</td>`+
                        `<td>${content}</td>`
                        '<tr>'
                }
            }else{
                alert('post no found')
            }
        });
    });
</script>
</body>
</html>


