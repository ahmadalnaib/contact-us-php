<?php

$msg='';
$msgClass='';

if(filter_has_var(INPUT_POST,'submit')){

    $name=htmlspecialchars($_POST['name']);
    $email=htmlspecialchars($_POST['email']);
    $message=htmlspecialchars($_POST['message']);


    if(!empty($name) && !empty($email) && !empty($message))
    {

        if(filter_var($email,FILTER_VALIDATE_EMAIL)===false)
        {

            $msg="Your Email is an Valid !";
            $msgClass="alert-danger";
        }else{

            $toEmail="ahmedhabeeb@outlook.com";
            $subject="Contact Request From".$name;
            $body='
            <h2> Contact Request</h2>
            <h4>Name</h4><p> '.$name.'</p>
            <h4>Email</h4><p>'.$email.'</p>
            <h4>Message</h4><p>'.$message.'</p>  
            ';

            $headers="MIME-Version:1.0"."\r\n";
            $headers.="Content-Type:text/html:charset=UTF-8"."\r\n";
            $headers.="From:" .$name. "<" .$email.">"."\r\n";


            if(mail($toEmail,$subject,$body,$headers))
            {
                $msg="Your Email send !";
                $msgClass="alert-success";
            }else{
                $msg="Your Email is not send!";
                $msgClass="alert-danger";
            }


        }



    }else{

        $msg="please fill the fields";
        $msgClass="alert-danger";

    }

}




?>





<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Contact form</title>
</head>
<body>

<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
    <?php if($msg !=''): ?>
    <div class="<?php echo $msgClass?>">
        <?php echo $msg?>
    </div>

    <?php endif;?>
    <div>
    <label for="name">name</label>
    <input type="text" name="name" value="<?php echo isset($_POST['name']) ? $name :'' ?>">
    </div>
    <div>
        <label for="email">email</label>
        <input type="text" name="email" value="<?php echo isset($_POST['email']) ? $email :'' ?>">
    </div>
    <div>
        <label for="message">message</label>
        <textarea name="message" id="" cols="30" rows="10">
            <?php echo  isset($_POST['message'])? $message :''?>
        </textarea>
    </div>
    <button name="submit" type="submit">Send</button>
</form>



</body>
</html>