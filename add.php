
<?php 

require "config/dbconnection.php";
     $errors = [
        "email" => "",
        "title" =>"",
        "ingredients"=> ""
];
$email = $title = $ingredients ='';

    if(isset($_POST["submit"]))
    {
        $email = $_POST["email"];
        $title = $_POST["title"];
        $ingredients = $_POST["ingredients"];

        #check email
        if(empty($email))
        $errors["email"] = 'Please enter an email';
        else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        $errors["email"] = 'Please enter a valid email';

        #check title
        if(empty($title))
        $errors["title"] = 'Please enter a pizza title';
        else if(!preg_match('/^([a-z]{2,10})$/',$title))
        $errors["title"] = 'Please enter a valid pizza title';

        #check ingredients
        if(empty($ingredients))
        $errors["ingredients"] = 'Please enter some ingredients (between 1 and 3 )';
        else if(!preg_match('/^[a-zA-Z]+(,[a-zA-Z]+)?(,[a-zA-Z]+)?$/i',$ingredients))
        $errors["ingredients"] = 'Please respect the syntax ( comma separated ingredients )';

              
    if(!array_filter($errors))
    {
        $email = mysqli_real_escape_string($con,$email);
        $title = mysqli_real_escape_string($con,$title);
        $ingredients = mysqli_real_escape_string($con,$ingredients);

        #sql
        $sql = "INSERT INTO pizzas(title,email,ingredients) VALUES('$title','$email','$ingredients')";

        if(mysqli_query($con,$sql))
        {
            //succes
            header("location:index.php");  
        }
        else{
            //failure
            echo "error".mysqli_error($con);
        }
       
    }

    }
  
  
    

?>

<!DOCTYPE html>

<html>
<?php  require "templates/header.html"; ?>

    <div class="content">
        <div class="wrap">
        <form action="add.php" method="POST">
            <label for="email">Email</label><br>
            <input type="text" name="email" id="email" placeholder="Must be a valid email adress , e.g yassir@gmail.com" autocomplete="off" class="inputs" value="<?php echo htmlspecialchars($email) ?>"><br>
            <p ><?php echo "<span>".$errors["email"]."</span>"; ?></p>
            <label for="title">Pizza Title</label><br>
            <input type="text" name="title" id="title" placeholder="Must be an alphabetic string , between 2 and 20 characters , e.g pizzaname"autocomplete="off"class="inputs" value="<?php echo htmlspecialchars($title)?>"><br>
            <p ><?php echo "<span>".$errors["title"]."</span>"; ?></p>
            <label for="ingredients">Ingredients</label><br>
            <input type="text" name="ingredients" id="ingredients" placeholder="omma separated (max 3 ingredients), e.g ing1,ing2,ing3"autocomplete="off"class="inputs" value="<?php echo htmlspecialchars($ingredients) ?>"><br>
            <p ><?php echo "<span>".$errors["ingredients"]."</span>"; ?></p>
            <button type="submit" name="submit" class="btn addbtn .sbmt">Submit</button>
        </form>
        </div>
    </div>

<?php  require "templates/footer.html"; ?>
    <script src="myscripts/validinput.js"></script>
</body>
</html>