<?php
        require "config/dbconnection.php";
        #check get request id parameter
        if(isset($_GET['id'])){
                $id = mysqli_real_escape_string($con,$_GET['id']);

                $sql = "SELECT * FROM pizzas WHERE id = $id";
                $result = mysqli_query($con,$sql);

                #one result in a assoc array
                $pizza = mysqli_fetch_assoc($result);
                
                
        #freeing the memory :
        mysqli_free_result($result);
        #closing the connection  :
        mysqli_close($con);
        }
        
?>

<!DOCTYPE html>

<html>
<?php  require "templates/header.html"; ?>
                <?php if($pizza):?>
        <div class="pizza_container detailcontainer">
                <div class="pizzacard detailcard">
                <div class="pizzacardimg">
                         <img src="imgs/pizza2.jpg" alt="PIZZA">
                </div>
                <div class="pizzacard_content detailcontent">
                <br>
                      <?php echo "<span><b>Pizza title : </b>".$pizza["title"]."<br></span>"; ?><br>
                       <?php   echo "<span><b>Created by : </b>".$pizza["email"]."<br></span>";?><br>
                       <?php  echo "<span><b>Date : </b>".$pizza["created_at"]."<br></span>";?><br>
                        <span><b>Ingredients : </b></span> <br><br>
                        <ul>
                        <?php foreach(explode(",",$pizza["ingredients"]) as $ing ): ?>
                                <li><span><?php echo $ing?></span></li>
                       <?php endforeach; ?>
                       </ul>
                      
                         </div>
                </div>
        </div>
          
        <?php else: ?>
                        <?php header("location:index.php"); ?>
                    
                <?php endif; ?>

        

    
<?php  require "templates/footer.html"; ?>
</body>
</html>