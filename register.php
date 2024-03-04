<?php

    include 'Config/Database.php';

    global $message;

    // verifie si le formulaire est soumis
    if(isset($_POST['pseudo']) && isset($_POST['email']) && 
    isset($_POST['password']) && isset($_POST['birth_date'])){
        // je recupere les donnees du formulaire dans des variables
        $pseudo = $_POST['pseudo'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $birth_date = $_POST['birth_date'];

        // je verifie si l'email existe deja dans la base de donnees    
        $sql = "SELECT email FROM user WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute(
            [
                'email' => $email
            ]
        );

        $user = $stmt->fetch();

        if($user){
            $message = "Cet email existe deja";
        } else {
            // j'insere les donnees dans la base de donnees
            $sql = "INSERT INTO user (`pseudo`,`email`,`password`,`birth_date`,`is_valide`,`created_at`,`role`)
                    VALUES (:pseudo, :email, :password, :birth_date, :is_valide, :created_at , :role)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                'pseudo' => $pseudo,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'birth_date' => $birth_date,
                'is_valide' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'role' => '["ROLE_USER"]'
            ]);

            $message = "Vous etes inscrit";
        }
    } else {
        $message = "Veuillez remplir tous les champs";}

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
    </head>
    <body>
        <h1>Register</h1>
        <p><?= $message ?></p>
        <form action="register.php" method="post">
            <input type="text" name="pseudo">
            <input type="email" name="email">
            <input type="password" name="password">
            <input type="date" name="birth_date">
            <input type="submit" value="register">
        </form>
    </body>
</html>