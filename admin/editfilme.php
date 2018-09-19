<?php
  require_once('../db/config.php');
    if( !$admin->is_logged_in_admin() ){ 
        header('Location: login.php'); 
    }

  try {
            $stmt = $db->prepare('SELECT id, titulo, sinopse, embed, img, acao, comedia, ficcao, terror, policial, animacao, drama, romance, infantil FROM filme WHERE id = :id') ;
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
    <h4>ADICIONAR FILME</h4>
    <hr>

    <?php

  
  if(isset($_POST['submit'])){

    $_POST = array_map( 'stripslashes', $_POST );

    extract($_POST);


    if(!isset($error)){
        try {

          if (isset($_POST['acao'])){ $acao = true; } else { $acao = false; }
          if (isset($_POST['comedia'])){ $comedia = true; } else { $comedia = false; }
          if (isset($_POST['ficcao'])){ $ficcao = true; } else { $ficcao = false; }
          if (isset($_POST['terror'])){ $terror = true; } else { $terror = false; }
          if (isset($_POST['policial'])){ $policial = true; } else { $policial = false; }
          if (isset($_POST['animacao'])){ $animacao = true; } else { $animacao = false; }
          if (isset($_POST['drama'])){ $drama = true; } else { $drama = false; }
          if (isset($_POST['romance'])){ $romance = true; } else { $romance = false; }
          if (isset($_POST['infantil'])){ $infantil = true; } else { $infantil = false; }

        $stmt = $db->prepare('UPDATE filme SET titulo = :titulo, img = :img, sinopse = :sinopse, embed = :embed, acao = :acao, comedia = :comedia, ficcao = :ficcao, terror = :terror, policial = :policial, animacao = :animacao, drama = :drama, romance = :romance, infantil = :infantil WHERE id = :id') ;
        $stmt->execute(array(
          ':titulo' => $titulo,
          ':img' => $img,
          ':sinopse' => $sinopse,
          ':embed' => $embed,
          ':acao' => $acao,
          ':comedia' => $comedia,
          ':ficcao' => $ficcao,
          ':terror' => $terror,
          ':policial' => $policial,
          ':animacao' =>  $animacao,
          ':drama' => $drama,
          ':romance' => $romance,
          ':infantil' => $infantil,
          ':id' => $id
        ));

        header('Location: index.php');
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
    <input type="text" class="form-control" name="titulo" id="titulo" value='<?php echo $row['titulo'];?>' placeholder="TITULO DO FILME">
  </div>
  <div class="form-group">
    <label>Generos: </label><br>
  <div class="form-check form-check-inline">
    <?php 
      if($row['acao'])
        echo'<input class="form-check-input" type="checkbox" id="acao" name="acao" value="acao" checked>';
      else
        echo'<input class="form-check-input" type="checkbox" id="acao" name="acao" value="acao">';
    ?>
  <label class="form-check-label" for="acao">Ação</label>
</div>
<div class="form-check form-check-inline">
  <?php 
    if($row['comedia'])
      echo'<input class="form-check-input" type="checkbox" id="comedia" name="comedia" value="comedia" checked>';
    else
      echo'<input class="form-check-input" type="checkbox" id="comedia" name="comedia" value="comedia">';
  ?>
  <label class="form-check-label" for="comedia">Comédia</label>
</div>
<div class="form-check form-check-inline">
  <?php 
    if($row['ficcao'])
      echo'<input class="form-check-input" type="checkbox" name="ficcao" id="ficcao" value="ficcao" checked>';
    else
      echo'<input class="form-check-input" type="checkbox" name="ficcao" id="ficcao" value="ficcao">';
    ?>
  <label class="form-check-label" for="ficcao">Ficção cientifica</label>
</div>
<div class="form-check form-check-inline">
  <?php 
    if($row['terror'])
      echo'<input class="form-check-input" type="checkbox" id="terror" name="terror" value="terror" checked>';
    else
      echo'<input class="form-check-input" type="checkbox" id="terror" name="terror" value="terror">';
  ?>
  <label class="form-check-label" for="terror">Terror</label>
</div>
<div class="form-check form-check-inline">
    <?php 
    if($row['policial'])
      echo'<input class="form-check-input" type="checkbox" id="policial" name="policial" value="policial" checked>';
    else
      echo'<input class="form-check-input" type="checkbox" id="policial" name="policial" value="policial">';
  ?>
  <label class="form-check-label" for="policial">Policial</label>
</div>
<div class="form-check form-check-inline">
    <?php 
    if($row['animacao'])
      echo'<input class="form-check-input" type="checkbox" id="animacao" name="animacao" value="animacao" checked>';
    else
      echo'<input class="form-check-input" type="checkbox" id="animacao" name="animacao" value="animacao">';
  ?>
  <label class="form-check-label" for="animacao">Animação</label>
</div>
<div class="form-check form-check-inline">
  <?php 
    if($row['drama'])
      echo'<input class="form-check-input" type="checkbox" id="drama" name="drama" value="drama" checked>';
    else
      echo'<input class="form-check-input" type="checkbox" id="drama" name="drama" value="drama">';
  ?>
  <label class="form-check-label" for="drama">Drama</label>
</div>
<div class="form-check form-check-inline">
    <?php 
    if($row['romance'])
      echo'<input class="form-check-input" type="checkbox" id="romance" name="romance" value="romance" checked>';
    else
      echo'<input class="form-check-input" type="checkbox" id="romance" name="romance" value="romance">';
  ?>
  <label class="form-check-label" for="romance">Romance</label>
</div>
<div class="form-check form-check-inline">
   <?php 
    if($row['infantil'])
      echo'<input class="form-check-input" type="checkbox" id="infantil" name="infantil" value="infantil" checked>';
    else
      echo'<input class="form-check-input" type="checkbox" id="infantil" name="infantil" value="infantil">';
  ?>
  <label class="form-check-label" for="infantil">Infantil</label>
</div>
</div>
  <div class="form-group">
    <label for="img">Link da imagem</label>
    <input type="text" class="form-control" name="img" id="img" value='<?php echo $row['img'];?>' placeholder="http://img.png">
  </div>
  <div class="form-group">
    <label for="sinopse">Sinopse</label>
    <textarea class="form-control" id="sinopse" name="sinopse" rows="15" cols="100"><?php echo $row['sinopse'];?></textarea>
  </div>
  <div class="form-group">
    <label for="embed">Embed do filme</label>
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
      <li><a href="#">FILME</a></li>
      <li><a href="addserie.php">SÉRIE</a></li>
      <li><a href="addepis.php">EPISÓDIO</a></li>
     </ul>
    </div>
  </nav>
</section>

		<footer>
			
		</footer>




	</div>
</body>
</html>