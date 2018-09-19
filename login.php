<?php 
   require_once('db/config.php');
    if( $user->is_logged_in() ){ 
        header('Location: index.php'); 
    } 
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
  <link href="css/style-login.css" rel="stylesheet" type="text/css"/>
  <script type="text/javascript" src="js/jquery-3.3.1.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body>
  <?php
                 try {

                        if(isset($_POST['submit'])){
                            $match = false;
                            $usuario = trim($_POST['usuario']);
                            $senha = trim($_POST['senha']);
                            $stmt = $db->query('SELECT id, usuario, senha, nome, email FROM usuario');
                            while($row = $stmt->fetch()){
                                if($usuario == $row['usuario'] && $senha == $row['senha'])
                                    $match = True;

                                    if($match){
                                         if($user->login($usuario,$senha) == true){ 

                                            header('Location: index.php');
                                        exit;
                                        }
                                    }
                                
                            } 
                            
                        }

                if(isset($message)){ echo $message; }


                }
                 catch(PDOException $e) {
                    echo $e->getMessage();
                }

                
            ?>
<div class="container">
  
  <div class="row" id="pwd-container">
    <div class="col-md-4"></div>
    
    <div class="col-md-4">
      <section class="login-form">
        <form method="POST" action="#">
          <img src="images/loginscreen.png" alt="" />
          <input type="label" name="usuario" placeholder="Usuário" required class="form-control input-lg" />
          
          <input type="password" class="form-control input-lg" id="password" name="senha" placeholder="Senha" required="" />
          
          
          
          
          <input type="submit" name="submit" value="Entrar" class="btn btn-lg btn-primary btn-block">
          <div>
            <center>
            <a href="cadastro.php">Novo Usuário</a>
            </center>
          </div>
          
        </form>
        
      </section>  
      </div>
      
      <div class="col-md-4"></div>
      

  </div>
  
  
  
</div>
</body>
</html>