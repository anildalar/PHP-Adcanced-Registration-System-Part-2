<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>

    <?php 
            //echo 'Good Morning Students';

            //echo md5('oklabs'); //MD5 Hashing Algorithm  32
            echo '<br>';
            //echo sha1('oklabs');

            echo '<br>';
            //echo hash('sha512','oklabs');
    ?>
    <?php 
        // check if the regisration data is comming or not
        if(isset($_GET['registration'])){
            echo 'yes';

            //1. DB Connection Open
            $conn = mysqli_connect('localhost','root','','ecom_db');


            //Always filter/Sanitize the incomming data
            $fname = mysqli_real_escape_string($conn,$_GET['fname']);
            $lname = mysqli_real_escape_string($conn,$_GET['lname']);
            $email = mysqli_real_escape_string($conn,$_GET['email']);
            $username = mysqli_real_escape_string($conn,$_GET['username']);
            $password = mysqli_real_escape_string($conn,$_GET['password']);
            $cpassword = mysqli_real_escape_string($conn,$_GET['cpassword']);
            $mobno = mysqli_real_escape_string($conn,$_GET['mobno']);

            //Hash the Password
            // Plain Text --> Hash 
            $password = hash('sha512',$password);

            //2. Build the query
            $sql = "INSERT INTO user_tbl(`fname`,`lname`,`email`,`username`,`password`,`mobno`)VALUES('$fname','$lname','$email','$username','$password','$mobno')";

            //3. Execute the query
            mysqli_query($conn,$sql);

            //4. Display the result

            //echo '<script>swal("Good job!", "User Registered Successfully!", "success");</script>';

            //Reload the current page with custom parameter

            header('Location: '.'index.php?msg=1');

            //5. DB Connection Close
            mysqli_close($conn);

        }/* else{
            echo 'no';
        } */

    ?>
    <?php 

        //check if msg = 1 then it mean our registration is successfull
        if( (isset($_GET['msg'])) && ($_GET['msg'] == 1 ) ){
            echo '<script>swal("Good job!", "User Registered Successfully!", "success");</script>';
        }
    
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="GET" class="w-50 offset-3 mt-5">
        <h1 class="text-center">Registration Form</h1>
        <div class="mb-3">
            <label for="fname" class="form-label">fname</label>
            <input type="text" name="fname" class="form-control" id="fname" aria-describedby="emailHelp" required>
            <div id="emailHelp" class="form-text"></div>
        </div>
        <div class="mb-3">
            <label for="lname" class="form-label">lname</label>
            <input type="text" name="lname" class="form-control" id="lname" aria-describedby="emailHelp" required>
            <div id="emailHelp" class="form-text"></div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">email</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" required>
            <div id="emailHelp" class="form-text"></div>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">username</label>
            <input type="text" name="username" class="form-control" id="username" aria-describedby="emailHelp" required>
            <div id="emailHelp" class="form-text"></div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" required>
        </div>
        <div class="mb-3">
            <label for="cpassword" class="form-label">cPassword</label>
            <input type="cpassword" name="cpassword" class="form-control" id="cpassword" required>
        </div>
        <div class="mb-3">
            <label for="mobno" class="form-label">mobno</label>
            <input type="number" name="mobno" class="form-control" id="mobno" required>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="agree" value="yes" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Terms and Condition</label>
        </div>
        <button type="submit" name="registration" class="btn btn-primary">Submit</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>