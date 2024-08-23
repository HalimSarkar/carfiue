<?php 

include '../extends/header.php';

include '../../public/fonts/fonts.php';


?>






<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Service Add</h4>
            </div>
            <form action="store.php" method="POST">
            <div class="card-body">
              <label for="exampleInputEmail1" class="form-label my-2">Service Title</label>
              <input name="title" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              <label for="exampleInputEmail1" class="form-label my-2">Service description</label>
              <textarea name="description" type="email" class="form-control" rows="5">  </textarea>
              <label for="exampleInputEmail1" class="form-label my-2">Icon</label>
              <input name="icon" type="text" readonly class="form-control" id="halim" aria-describedby="emailHelp">
               
              
              <div class="card my-3">
                <div class="card-body fa-2x" style="overflow-y: scroll; overflow-x: hidden; height:300px">
                 <?php foreach($fonts as $font):?>
                
                    <span>
                    <i onclick="myFun(event)" class="<?= $font?>"></i>
                    </span>
                  
                  
                <?php endforeach; ?>
              </>
                </div>
               </div>

               <button type="submit" name="insert" class="btn btn-primary mt-3"><i class="material-icons">add</i>create</button>
              </form>
            </div>

        </div>
    </div>
</div>


<script>
   $input =document.querySelector('#halim')
    function myFun(e){
   $input.value=e.target.classList.value;
    }
</script>


<?php 

include '../extends/footer.php';

?>
