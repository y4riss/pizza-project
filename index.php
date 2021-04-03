
<?php

       require "config/dbconnection.php";
        #write query for all pizzas
        $sql = 'SELECT title,ingredients,id FROM pizzas ORDER BY created_at';
        #make query and get result :
        $result = mysqli_query($con,$sql);
        #fetch the resulting rows as an array:
        $pizzas = mysqli_fetch_all($result,MYSQLI_ASSOC);
          #freeing the memory :
          mysqli_free_result($result);

     
        $i = 1;

        // DELETE A PIZZA
        if(isset($_POST["delete"])){
           
          $id = mysqli_real_escape_string($con,$_POST["delete_id"]); 
            $sql2 = "DELETE FROM pizzas WHERE id = $id";
            $result2 = mysqli_query($con,$sql2);
            if($result2)
            {
                header("location:index.php");
            }
            mysqli_free_result($result2);

        }
         
           #closing the connection  :
           mysqli_close($con);
?>



<!DOCTYPE html>

<html>
<?php  require "templates/header.html"; ?>

            <div class="pizza_container">
         <?php foreach($pizzas as $pizza): ?>
        <div class="pizzacard">
            <div class="pizzacardimg">
                <?php if($i>4) $i=1;?>
    <img src="imgs/pizza<?php echo $i++;?>.jpg" alt="PIZZA">
            </div>
            <div class="pizzacard_content">
                <h4>PIZZA TITLE : <?php echo htmlspecialchars($pizza["title"]) ?></h4>
                <h4>Ingredients : </h4>
                <ul>
                    <?php foreach(explode(",",$pizza["ingredients"]) as $ing): ?>
                        <li><?php echo "<p>".htmlspecialchars($ing)."</p>" ?></li>
                        <?php endforeach; ?>
                </ul>
            </div>
            <div class="pizzabuttons">
                   <a class="btn indexbtn" href="details.php?id=<?php echo $pizza['id']; ?>">More info</a> 
                   <form method="POST" action="index.php">
                    <input type="hidden" name="delete_id" value="<?php echo $pizza['id']; ?>">
                   <button class="btn indexbtn" name="delete">Delete</button>
                   </form>
                  
              </div>
        </div>
                <?php endforeach; ?>
    </div>
<?php  require "templates/footer.html"; ?>



</body>
</html>