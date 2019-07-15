<?php

function sanitizeFormPassword($inputText) {
    $inputText = strip_tags($inputText);
    return $inputText;
}

function sanitizeFormUsername($inputText) {
    $inputText= strip_tags($inputText); //discard html elems.
    $inputText = str_replace(" ","", $inputText); 
    return $inputText;

}

function sanitizeFormString($inputText) {
    $inputText= strip_tags($inputText); //discard html elems.
    $inputText = str_replace(" ","", $inputText); 
    $inputText  = ucfirst(strtolower($inputText));
    return $inputText;
}



if(isset($_POST['registerButton'])) {
    //register btm was pressed

    
    $username = sanitizeFormUsername($_POST['username']);
    $lastName = sanitizeFormString($_POST['lastName']);
    $firstName = sanitizeFormString($_POST['firstName']);  
    $email = sanitizeFormString($_POST['email']);
    $confirmEmail = sanitizeFormString($_POST['confirmEmail']);
    $password = sanitizeFormPassword($_POST['password']);
    $confirmPassword = sanitizeFormPassword($_POST['confirmPassword']); 
    
    $wasSuccessful = $account->register($username, $lastName, $firstName, $email, $confirmEmail, $password, $confirmPassword );
    echo "$wasSuccessful";

    if($wasSuccessful) {
        $_SESSION['userLogged'] = $username;
		header('location:index.php');
	}
}

?>