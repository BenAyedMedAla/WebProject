<?php
$asba=0;
$terma=0;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $host = "localhost";
    $dbname = "khedma";
    $username = "root";
    $password = "";

    $email = $_POST['email'];
    $pass = $_POST['password'];

    $conn = mysqli_connect($host, $username, $password, $dbname);

    if(mysqli_connect_errno()){
        die("Connection error: " . mysqli_connect_errno());
    }
    
    $query = "SELECT * FROM registration WHERE email='$email' AND mot_de_passe='$pass'";

    $result = $conn->query($query);
    $row_count = mysqli_num_rows($result);

    if($result->num_rows == 1){
        // L'utilisateur est authentifié avec succès
        // Vous pouvez ajouter ici le code pour rediriger l'utilisateur vers une autre page, par exemple :
        $row = $result->fetch_assoc();
    
        $_SESSION["first_name"] = $row['first_name'];
        $firstname=$row['first_name'];
        $lastname=$row['last_name'];
        $managercinimg=$row['cin_image'];
        $data = array(
            'first-name' => $firstname,
            'last-name' => $lastname,
            'cin-img' => $cinimg
        );
        $jsonData = json_encode($data);
        setcookie('personData', $jsonData, time() + (86400 * 30), "/");
      
        header('Location: /webproject/dashboard1/index.html');
        exit();
    } else {
        // Échec de l'authentification
        header('Location: 404.html');
        exit();
    }

    $conn->close();
}
?>
