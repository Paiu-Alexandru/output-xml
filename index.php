<?php 
//require("controller/verify.php");

?>
<html>  
    <header>
        <meta charset="utf-8">
       
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
    </header>



    <body>
        <h3>Input some data to get the result or simply press submit</h3>
        <form action="controller/verify.php" method="post">
            <input type="text" name="name">
            <input type="text" name="fName">
            <input type="text" name="phone">
            <input type="email" name="email">
            
            <input type="submit" name="submit" value="Submit">
            
        </form>
    <?php if(isset($_POST['submit'])){ $output->output();} ?>
     
    
    
    </body>
</html>