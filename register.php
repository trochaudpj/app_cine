<?php
ob_start();
session_start();
include "function.php";
include "db-functions.php";
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

?><div class="container  ">
    <div class="box main">
        <main>
        <h1>Register</h1>
            <form action="security.php?action=register" method="post">
                <p>
                    <label>
                        Nom d'utilisateur :
                        <input type="text" name="username" required>
                    </label>
                </p>
                <p>
                    <label>
                        Adresse e-mail :
                        <input type="email" name="email" required>
                    </label>
                </p>
                <p>
                    <label>
                        Mot de passe :
                        <input type="password" name="pass1" required>
                    </label>
                </p>
                <p>
                    <label>
                        Répétez le mot de passe :
                        <input type="password" name="pass2" required>
                    </label>
                </p>
                <p>
                    <input type="submit" name="submit" value="Inscription">
                </p>
            </form>
        </main>
    </div>
</div>
<?php
$result = ob_get_clean();
include 'template.php';
