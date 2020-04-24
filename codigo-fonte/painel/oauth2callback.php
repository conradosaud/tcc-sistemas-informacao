<?php
    if(isset($_POST['senha'])){
        if($_POST['senha']=='passCD00'){
            header('Location: http://localhost/Projeto02Painel/php/oauth2/oauth2.php?pass=1');
        }
    }
?>

<html>
    <body>
        <h3>Oauth2callback</h3>
        <form method="POST">
            Senha: <input type="password" name="senha">
            <button type="submit">Enviar</button>
        </form>
    </body>
</html>

