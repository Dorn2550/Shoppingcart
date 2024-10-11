<?php
    require 'config.php';
    $minLength = 6;

    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];
    }

    if (empty($username)) {
        $_SESSION['error'] = "Please enter your username";
        header("location : page7.php");
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Please enter a valid email address";
        header("location : page7.php");
    } else if (strlen($password) < $minLength) {
        $_SESSION['error'] = "Please enter a valid email password";
        header("location : page7.php");
    } else if ($password !== $confirmPassword) {
        $_SESSOPN['error'] = "Your password do not match";
        header("location : page7.php");

        $checkUsername = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
        $checkUsername->execute([$username]);
        $userNameExits = $checkUsername->fetchColumn();

        $checkEmail = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $checkEmail->execute([$email]);
        $userEmailExits = $checkEmail->fetchColumn();

        if ($userNameExist) {
            $_SESSOPN['error'] = "Username already exists";
            header("location : page7.php");
        } else if ($userEmailExits) {
            $_SESSOPN['error'] = "Email already exists";
            header("location : page7.php");
        } else {

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            try {

                $stmt = $pdo->prepare("INSERT INTO users(username, email,password) VALUES(?, ?, ?)");
                $stmt->execute([$username, $email, $hashedPassword]);
                
                $_SESSOPN['success'] = "Registration Successfully";
                header("location : page7.php");

            }catch (PDOException $e) {
                $_SESSOPN['error'] = "Something went wrong, please try again";
                echo "Registration failed:" . $e->getMessage();
                header("location : page7.php");
            }

        }

    }

?>