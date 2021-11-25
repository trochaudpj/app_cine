<?php

ob_start();
session_start();
include "function.php";
include "db-functions.php";
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
?>
<div class="container  ">
  <div class="box main" >
    <main>
    <h1>Login</h1>
        <form action="security.php?action=login" method="post">
            <p>
                <label>
                    Nom d'utilisateur ou adresse e-mail :
                    <input type="text" name="credentials" required>
                </label>
            </p>
            <p>
                <label>
                    Mot de passe :
                    <input type="password" name="password" required>
                </label>
            </p>
            <p>
                <input type="submit" name="submit" value="Connexion">
            </p>
        </form>
    </main></div></div>
    <?php
    $result = ob_get_clean();
include 'template.php';