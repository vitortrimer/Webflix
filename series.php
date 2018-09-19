<?php
	require_once('db/config.php');
	            if(!$user->is_logged_in()) {
    header('Location: login.php'); 
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Séries</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet" type="text/css"/>

</head>
<body>
	<wrapper>
			
		<header>
			<nav class="navbar navbar-dark " style="background-color: #171717;">
			  <a class="navbar-brand" href="#">Olá, <?php echo $_SESSION['nome']; ?></a>
			  	<right>
				<button type="button" class="btn btn-outline-success" onclick="window.location.href='minhaconta.php'">Minha conta</button>
				<button type="button" class="btn btn-outline-success" onclick="window.location.href='logout.php'">Sair</button>
			</right>
			</nav>
			<div id="topo">
				<div id="menu">
					<ul class="nav">
					  <li class="nav-item">
					    <a class="nav-link" href="index.php">Início</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" href="filmes.php">Filmes</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" href="series.php">Séries</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" href="contato.php">Contato</a>
					  </li>
					</ul>
				</div>
			</div>
		</header>
		<div id="content">
			

		<div id="pesquisa">
			<div  class="row mt-5 justify-content-center">
			<div class="btn-group">
			  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Gêneros
			  </button>
			  <div class="dropdown-menu dropdown-menu-right">
			    <a href="series.php?genero=acao" class="dropdown-item">Ação</a>
			    <a href="series.php?genero=comedia" class="dropdown-item">Comédia</a>
			    <a href="series.php?genero=ficcao" class="dropdown-item">Ficção Cientifica</a>
			    <a href="series.php?genero=terror" class="dropdown-item">Terror</a>
			    <a href="series.php?genero=policial" class="dropdown-item">Policial</a>
			    <a href="series.php?genero=animacao" class="dropdown-item">Animação</a>
			    <a href="series.php?genero=drama" class="dropdown-item">Drama</a>
			    <a href="series.php?genero=romance" class="dropdown-item">Romance</a>
			    <a href="series.php?genero=infantil" class="dropdown-item">Infantil</a>
			  </div>
			</div>
			<div style="margin-left: 60px;">
			 <form method=GET class="form-inline my-2 my-lg-0">
			      <input class="form-control mr-sm-2" type="search" name="pesquisa" placeholder="Pesquisa por título" aria-label="Search">
			      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
			  </form>
			</div>
		</div>
		</div>
		<br><br>




			<div class="row mt-5 justify-content-center">

			<?php
          	
          	if(isset($_GET['pag'])){
          	try {
          		$pagina = $_GET['pag'];
          		$postnum = (9 * ($pagina-1));
          		$multiplicador = $pagina;
          		$aux = 0;
             	 $stmt = $db->query('SELECT id, titulo, sinopse, img, acao, comedia, ficcao, terror, policial, animacao, drama, romance, infantil FROM serie ORDER BY id DESC');
             	 while($row = $stmt->fetch()){
                  if($aux >= $postnum && $aux < $multiplicador*9){
                  	echo '<div class="card filmlista" style="width: 18rem; ">';
                    echo '<img class="card-img-top" src="'.$row['img'].'" alt="'.$row['titulo'].'" height="200" width="286">';
                  	echo '<div class="card-body"><center>';
                    echo '<h5 class="card-title">'.$row['titulo'].'</h5>';
                    echo '<p class="card-text">'.$row['sinopse'].'</p>';                
                    echo '<a href="episodios-serie.php?id='.$row['id'].'" class="btn btn-success">Entrar</a>';                
                  echo ' </center>';
                  echo '</div>';
                  echo '</div>';
                  $aux++;
                  }
                  if($aux <= $postnum){
                  	$aux++;
                  }
              }

	          } catch(PDOException $e) {
	              echo $e->getMessage();
	          }

					
	        echo '</div>';
	      	echo'<nav aria-label="Paginas">';
			echo'<ul class="pagination justify-content-center ">';
			echo'<li class="page-item  paginas"><a class="page-link paginas" href="series.php?pag='.($pagina-1).'" tabindex="-1">Anterior</a></li>';
			echo'<li class="page-item paginas"><a class="page-link paginas" href="series.php?pag='.($pagina-1).'">'.($pagina-1).'</a></li>';
			echo'<li class="page-item paginas"><a class="page-link paginas" href="#">'.($pagina).'</a></li>';
			echo'<li class="page-item paginas"><a class="page-link paginas" href="series.php?pag='.($pagina+1).'">'.($pagina+1).'</a></li>';
			echo'<li class="page-item paginas"><a class="page-link paginas" href="series.php?pag='.($pagina+1).'">Próxima</a></li>';
			echo'</ul>';
			echo'</nav>';
		}

		else if(isset($_GET['genero'])){
			if(isset($_GET['pag'])){
          	try {
          		$pagina = $_GET['pag'];
          		$postnum = (9 * ($pagina-1));
          		$multiplicador = $pagina;
          		$genero = $_GET['genero'];
          		$aux = 0;
             	 $stmt = $db->query('SELECT id, titulo, sinopse, img, acao, comedia, ficcao, terror, policial, animacao, drama, romance, infantil FROM serie WHERE '.$_GET['genero'].' = true ORDER BY id DESC');
             	 while($row = $stmt->fetch()){
                  if($aux >= $postnum && $aux < $multiplicador*9){
                  	echo '<div class="card filmlista" style="width: 18rem; ">';
                    echo '<img class="card-img-top" src="'.$row['img'].'" alt="'.$row['titulo'].'" height="200" width="286">';
                  	echo '<div class="card-body"><center>';
                    echo '<h5 class="card-title">'.$row['titulo'].'</h5>';
                    echo '<p class="card-text">'.$row['sinopse'].'</p>';                
                    echo '<a href="episodios-serie.php?id='.$row['id'].'" class="btn btn-success">Entrar</a>';                
                  echo ' </center>';
                  echo '</div>';
                  echo '</div>';
                  $aux++;
                  }
                  if($aux <= $postnum){
                  	$aux++;
                  }
              }

	          } catch(PDOException $e) {
	              echo $e->getMessage();
	          }

					
	        echo '</div>';
	      	echo'<nav aria-label="Paginas">';
			echo'<ul class="pagination justify-content-center ">';
			echo'<li class="page-item  paginas"><a class="page-link paginas" href="series.php?genero='.$genero.'&pag='.($pagina-1).'" tabindex="-1">Anterior</a></li>';
			echo'<li class="page-item paginas"><a class="page-link paginas" href="series.php?genero='.$genero.'&pag='.($pagina-1).'">'.($pagina-1).'</a></li>';
			echo'<li class="page-item paginas"><a class="page-link paginas" href="#">'.($pagina).'</a></li>';
			echo'<li class="page-item paginas"><a class="page-link paginas" href="series.php?genero='.$genero.'&pag='.($pagina+1).'">'.($pagina+1).'</a></li>';
			echo'<li class="page-item paginas"><a class="page-link paginas" href="series.php?genero='.$genero.'&pag='.($pagina+1).'">Próxima</a></li>';
			echo'</ul>';
			echo'</nav>';
		}
		else {
          	try {
          		 $postnum = 0;
          		 $multiplicador = 1;
          		 $genero = $_GET['genero'];
             	 $stmt = $db->query('SELECT id, titulo, sinopse, img, acao, comedia, ficcao, terror, policial, animacao, drama, romance, infantil FROM serie WHERE '.$_GET['genero'].' = true ORDER BY id DESC');
             	 while($row = $stmt->fetch()){
                  if($postnum < 9){
                  	echo '<div class="card filmlista" style="width: 18rem; ">';
                    echo '<img class="card-img-top" src="'.$row['img'].'" alt="'.$row['titulo'].'" height="200" width="286">';
                  	echo '<div class="card-body"><center>';
                    echo '<h5 class="card-title">'.$row['titulo'].'</h5>';
                    echo '<p class="card-text">'.$row['sinopse'].'</p>';                
                    echo '<a href="episodios-serie.php?id='.$row['id'].'" class="btn btn-success">Entrar</a>';                
                  echo ' </center>';
                  echo '</div>';
                  echo '</div>';
                  $postnum++;
                  }
              }

	          } catch(PDOException $e) {
	              echo $e->getMessage();
	          }

					
	        echo '</div>';
	      	echo'<nav aria-label="Paginas">';
			echo'<ul class="pagination justify-content-center ">';
			echo'<li class="page-item  paginas"><a class="page-link paginas" href="#">Anterior</a></li>';
			echo'<li class="page-item paginas"><a class="page-link paginas" href="#">1</a></li>';
			echo'<li class="page-item paginas"><a class="page-link paginas" href="series.php?genero='.$genero.'&pag=2">2</a></li>';
			echo'<li class="page-item paginas"><a class="page-link paginas" href="series.php?genero='.$genero.'&pag=3">3</a></li>';
			echo'<li class="page-item paginas"><a class="page-link paginas" href="series.php?genero='.$genero.'&pag=2">Próxima</a></li>';
			echo'</ul>';
			echo'</nav>';
			}
		}
		else if (isset($_GET['pesquisa'])){
          	try {
          		$postnum = 0;
          		$multiplicador = 1;
              $stmt = $db->query('SELECT id, titulo, sinopse, img, acao, comedia, ficcao, terror, policial, animacao, drama, romance, infantil FROM serie WHERE titulo LIKE "%'.$_GET['pesquisa'].'%" ORDER BY id DESC');
              while($row = $stmt->fetch()){
                  if($postnum < 9){
                  
                  	echo '<div class="card filmlista" style="width: 18rem; ">';
                    echo '<img class="card-img-top" src="'.$row['img'].'" alt="'.$row['titulo'].'" height="200" width="286">';
                  	echo '<div class="card-body"><center>';
                    echo '<h5 class="card-title">'.$row['titulo'].'</h5>';
                    echo '<p class="card-text">'.$row['sinopse'].'</p>';                
                    echo '<a href="episodios-serie.php?id='.$row['id'].'" class="btn btn-success">Entrar</a>';                
                  echo ' </center>';
                  echo '</div>';
                  echo '</div>';
                  	$postnum++;
                  }

              }

	          } catch(PDOException $e) {
	              echo $e->getMessage();
	          }
      		

	      	echo '</div>';
	      	echo'<nav aria-label="Paginas">';
			echo'<ul class="pagination justify-content-center ">';
			echo'<li class="page-item  paginas"><a class="page-link paginas" href="#">Anterior</a></li>';
			echo'<li class="page-item paginas"><a class="page-link paginas" href="#">1</a></li>';
			echo'<li class="page-item paginas"><a class="page-link paginas" href="series.php?pag=2">2</a></li>';
			echo'<li class="page-item paginas"><a class="page-link paginas" href="series.php?pag=3">3</a></li>';
			echo'<li class="page-item paginas"><a class="page-link paginas" href="series.php?pag=2">Próxima</a></li>';
			echo'</ul>';
			echo'</nav>';


		}


		else{
			try {
          		$postnum = 0;
          		$multiplicador = 1;
              $stmt = $db->query('SELECT id, titulo, sinopse, img, acao, comedia, ficcao, terror, policial, animacao, drama, romance, infantil FROM serie ORDER BY id DESC');
              while($row = $stmt->fetch()){
                  if($postnum < 9){
                  
                  	echo '<div class="card filmlista" style="width: 18rem; ">';
                    echo '<img class="card-img-top" src="'.$row['img'].'" alt="'.$row['titulo'].'" height="200" width="286">';
                  	echo '<div class="card-body"><center>';
                    echo '<h5 class="card-title">'.$row['titulo'].'</h5>';
                    echo '<p class="card-text">'.$row['sinopse'].'</p>';                
                    echo '<a href="episodios-serie.php?id='.$row['id'].'" class="btn btn-success">Entrar</a>';                
                  echo ' </center>';
                  echo '</div>';
                  echo '</div>';
                  	$postnum++;
                  }

              }

	          } catch(PDOException $e) {
	              echo $e->getMessage();
	          }
      		

	      	echo '</div>';
	      	echo'<nav aria-label="Paginas">';
			echo'<ul class="pagination justify-content-center ">';
			echo'<li class="page-item  paginas"><a class="page-link paginas" href="#">Anterior</a></li>';
			echo'<li class="page-item paginas"><a class="page-link paginas" href="#">1</a></li>';
			echo'<li class="page-item paginas"><a class="page-link paginas" href="series.php?pag=2">2</a></li>';
			echo'<li class="page-item paginas"><a class="page-link paginas" href="series.php?pag=3">3</a></li>';
			echo'<li class="page-item paginas"><a class="page-link paginas" href="series.php?pag=2">Próxima</a></li>';
			echo'</ul>';
			echo'</nav>';


		}
		?>

			<br><br><br>
		</div>
		<footer>
			<div id="bottom">
			</div>
		</footer>


	</wrapper>






<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!-- Main -->
<script src="js/main.js"></script>

</body>
</html>