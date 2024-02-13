<?php

require_once 'connec.php';
$pdo = new \PDO(DSN, USER, PASS);

$query = "SELECT * FROM friend";

$statement = $pdo->query($query);


$friends = $statement->fetchAll(PDO::FETCH_ASSOC); // same as $statement->fetchAll()
?>

<?php
if (isset($_POST)) {
    if (isset($_POST['firstname']) && isset($_POST['lastname'])) {
        $firstname = trim($_POST['firstname']);
        $lastname = trim($_POST['lastname']);

        $query = 'INSERT into friend (firstname, lastname) VALUES (:firstname, :lastname)';
        $statement = $pdo->prepare($query);
        $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
        $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);

        $statement->execute();
    }
}
?>


<ul>
    <?php
    foreach ($friends as $friend) {
        echo "<li>" . $friend['firstname'] . ' ' . $friend['lastname'] . "</li>";
    }
    ?>
</ul>

<form method="post">
    <label for="firstname">
        Prénom
    </label>
    <input type="text" name="firstname" id="firstname"/>
    <label for="lastname">
        Nom
    </label>
    <input type="text" name="lastname" id="lastname"/>
    <input type="submit" value="envoyer">
</form>

