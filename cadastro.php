<?php
	require_once('db/config.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Novo Usuário WEBFLIX</title>


	<link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
  <link href="css/style-login.css" rel="stylesheet" type="text/css"/>
  <script type="text/javascript" src="js/jquery-3.3.1.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript">
  	    function validarSenha(){
   senha = document.getElementByName('senha').value;
   confsenha = document.getElementByName('confsenha').value;
   if (senha != confsenha) {
      alert("SENHAS DIFERENTES!\nFAVOR DIGITAR SENHAS IGUAIS"); 
   }else{
      document.submit.submit();
   }
}
  </script>

</head>
<body>
	
	<div class="container">
		<div class="row">
		    
		    <div class="col-md-12">
		      <section id="cadastro" class="login-form">
		        <form method="POST"  id="submit" name="submit" onsubmit="return validarSenha();">
		        	<img src="images/loginscreen.png" alt="" />
		        	<?php

	if(isset($_POST['submit'])){
		extract($_POST);
		try {
			if($nome == "" || $usuario == "" || $senha == "" || $confsenha == "" || $email == "" || $datanasc == ""){
				echo '<h6><b>Erro: Você deve preencher todos os campos!</b></h6><br>';
			}
			else if($senha == $confsenha){
		    $stmt = $db->prepare('INSERT INTO usuario (nome, usuario, senha, email, datanasc) VALUES (:nome, :usuario, :senha, :email, :datanasc)') ;
		    $stmt->execute(array(
		    	':nome' => $nome,
		        ':usuario' => $usuario,
		        ':senha' => $senha,
		        ':email' => $email,
		        ':datanasc' => $datanasc
		    ));

		    
		    header('Location: index.php?');
		    exit;
			}
			else{
				echo '<h6><b>Erro: Sua senha deve ser igual a confirmação de senha!</b></h6><br>';
			}
		    

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}

			}

			if(isset($error)){
				foreach($error as $error){
					echo '<p class="error">'.$error.'</p>';
				}
			}
	?>
		        	<div class=row>
		        	<div class="col-md-6">
		        		<div class="form-group">
						    <label for="usuario">Usuário</label>
						    <input type="text" name="usuario" class="form-control" id="usuario" placeholder="Usuário">
						</div>
		          		<div class="form-group">
						    <label for="senha">Senha</label>
						    <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha">
						</div>
						<div class="form-group">
						    <label for="confsenha">Confirmar senha</label>
						    <input type="password" class="form-control" name="confsenha" id="confsenha" placeholder="Confirmar Senha">
						</div>
		        	</div>
		          
		          <div class="col-md-6">
		          		<div class="form-group">
						    <label for="email">Nome</label>
						    <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome">
						</div>
		        		<div class="form-group">
						    <label for="email">Email</label>
						    <input type="email" name="email" class="form-control" id="email" placeholder="Email">
						</div>
		          		<div class="form-group">
						    <label for="datanasc">Data de nascimento</label>
						    <input type="date" class="form-control" name="datanasc" id="datanasc" placeholder="DD/MM/YYYY">
						</div>
		          </div>
		          

		          </div>
		          <br>
		          <div class="row">
		         
		          <div class="col-md-6">
		          <input type="submit" name="submit" class="btn btn-lg btn-success btn-block" value="Cadastrar" >
		          </div>
		          <div class="col-md-6">
		          <button type="reset" class="btn btn-lg btn-warning btn-block">Limpar</button>
		          </div>
		          <br>
		          
		      
		      	</div>
		     	 </center>
		     	 
		     		<br>  
		          <center><a href="login.php">Voltar</a></center>
		     


		        </form>

		        
		      </section>  
		      </div>
		      
      

  </div>

	</div>

</body>
</html>