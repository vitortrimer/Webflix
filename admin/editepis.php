<?php
  require_once('../db/config.php');
    if( !$admin->is_logged_in_admin() ){ 
        header('Location: login.php'); 
    }

    try {
            $stmt = $db->prepare('SELECT id, titulo, img, embed, epinum, idserie FROM episodio WHERE id = :id') ;
            $stmt->execute(array(':id' => $_GET['id']));
            $row = $stmt->fetch(); 

        } 
        catch(PDOException $e) {
            echo $e->getMessage();
    }

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
	<title>Administração</title>
		<link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
	 	<link href="../css/style-admin.css" rel="stylesheet" type="text/css"/>
	  <script type="text/javascript" src="../js/jquery-3.3.1.js"></script>
	  <script type="text/javascript" src="../js/bootstrap.min.js"></script>
</head>
<body>
	<div id="wrapper">
		<header>
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
			  <a class="navbar-brand" href="#">WEBFLIX</a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>

			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">
                <?php
                echo "Bem vindo, ";
                echo $_SESSION['nomeAdmin'];
              ?>
             </a>
            </li>
          </ul>
            <button class="btn btn-outline-danger my-2 my-sm-0" onclick="window.location.href='logout.php'" type="submit">Sair</button>
        </div>
			</nav>
		</header>
		<section>
  
  
  <article id="conteudo">
    <h4>ADICIONAR EPISÓDIO</h4>
    <hr>


     <?php

  
  if(isset($_POST['submit'])){

    $_POST = array_map( 'stripslashes', $_POST );

    extract($_POST);


    if(!isset($error)){
        try {
        
        $stmt = $db->prepare('UPDATE episodio SET titulo = :titulo, img = :img, embed = :embed, epinum = :epinum, idserie = :idserie WHERE id = :id');
        $stmt->execute(array(
          ':titulo' => $titulo,
          ':img' => $img,
          ':embed' => $embed,
          ':epinum' => $epinum,
          ':idserie' => $idserie,
          ':id' => $id
        ));

        header('Location: episodios.php');
        exit;

      } catch(PDOException $e) {
          echo $e->getMessage();
      }

    }

  }

  if(isset($error)){
    foreach($error as $error){
      echo '<p class="error">'.$error.'</p>';
    }
  }
  ?>


    <form method="POST" action="">
  <div class="form-group">
    <input type='hidden' name='id' value='<?php echo $row['id'];?>'>
    <label for="titulo">Título</label>
    <input type="text" class="form-control" name="titulo" id="titulo" value='<?php echo $row['titulo'];?>'  placeholder="TITULO DA SÉRIE">
  </div>
  <div class="form-group">
    <label for="idserie">ID da série</label>
    <input type="text" class="form-control" name="idserie" id="idserie" value='<?php echo $row['idserie'];?>'  placeholder="ID">
  </div>
  <div class="form-group">
    <label for="epinum">Número do episódio</label>
    <input type="text" class="form-control" name="epinum" id="epinum" value='<?php echo $row['epinum'];?>'  placeholder="00-00">
  </div>
  <div class="form-group">
    <label for="img">Link da imagem</label>
    <input type="text" class="form-control" name="img" id="img" value='<?php echo $row['img'];?>'  placeholder="http://img.png">
  </div>
  <div class="form-group">
    <label for="embed">Embed do episódio</label>
    <textarea class="form-control" id="embed" name="embed" rows="4" cols="100"><?php echo $row['embed'];?></textarea>
  </div>
  <center>
  	<input type="submit" class="btn btn-success" name="submit" value="POSTAR!">
  </center>
</form>


  </article>
  <nav>
  	<div id="menulateral">
      <h5>RECENTES</h5>
      <hr>
    <ul>
      <li><a href="index.php">FILMES</a></li>
      <li><a href="series.php">SERIES</a></li>
      <li><a href="#">EPISÓDIOS</a></li>
    </ul>
    	<h5>ADICIONAR</h5>
    	<hr>
    <ul>
      <li><a href="addfilme.php">FILME</a></li>
      <li><a href="addserie.php">SÉRIE</a></li>
      <li><a href="#">EPISÓDIO</a></li>
     </ul>
    </div>
  </nav>
</section>

		<footer>
			
		</footer>




	</div>
</body>
</html>