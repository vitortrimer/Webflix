<?php
    require_once('db/config.php');
            if(!$user->is_logged_in()) {
    header('Location: login.php'); 
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Início</title>
	<link href="css/media_query.css" rel="stylesheet" type="text/css"/>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="css/animate.css" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="css/owl.carousel.css" rel="stylesheet" type="text/css"/>
    <link href="css/owl.theme.default.css" rel="stylesheet" type="text/css"/>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <!-- Modernizr JS -->
    <script src="js/modernizr-3.5.0.min.js"></script>
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
					    <a class="nav-link" href="#">Início</a>
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


<div class="container-fluid pb-4 pt-5">

    <div class="container animate-box">
        <div>
            <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Filmes Recentes</div>
        </div>
        <div class="owl-carousel owl-theme" id="slider2">
            <?php
            try {
                 $postnum = 0;
                 $multiplicador = 1;
                 $stmt = $db->query('SELECT id, titulo, img, datapost FROM filme ORDER BY id DESC');
                 while($row = $stmt->fetch()){
                  if($postnum < 6){
                    echo '<div class="item px-2">';
                    echo '<div class="fh5co_hover_news_img">';
                    echo '<div ><img src="'.$row['img'].'" alt="'.$row['titulo'].'"  height="235" widht="324" /></div>';
                    echo '<div>';
                    echo '<a href="assistir.php?id='.$row['id'].'" class="d-block fh5co_small_post_heading"><span class="">'.$row['titulo'].'</span></a>';
                    echo '<div class="c_g"><i class="fa fa-clock-o"></i> '.date('d, M, Y', strtotime($row['datapost'])).'</div>';
                    echo '</div>';
                    echo' </div></div>';
                  $postnum++;
                  }
              }

              } catch(PDOException $e) {
                  echo $e->getMessage();
              }
              ?>



        </div>
    </div>
</div><br>


<div class="container-fluid pb-4 pt-5">
    <div class="container animate-box">
        <div>
            <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Séries Recentes</div>
        </div>
        <div class="owl-carousel owl-theme" id="slider3">
            <?php
            try {
                 $postnum = 0;
                 $multiplicador = 1;
                 $stmt = $db->query('SELECT id, titulo, img, datapost FROM serie ORDER BY id DESC');
                 while($row = $stmt->fetch()){
                  if($postnum < 6){
                    echo '<div class="item px-2">';
                    echo '<div class="fh5co_hover_news_img">';
                    echo '<div ><img src="'.$row['img'].'" alt="'.$row['titulo'].'"  height="235" widht="324" /></div>';
                    echo '<div>';
                    echo '<a href="episodios-serie.php?id='.$row['id'].'" class="d-block fh5co_small_post_heading"><span class="">'.$row['titulo'].'</span></a>';
                    echo '<div class="c_g"><i class="fa fa-clock-o"></i> '.date('d, M, Y', strtotime($row['datapost'])).'</div>';
                    echo '</div>';
                    echo' </div></div>';
                  $postnum++;
                  }
              }

              } catch(PDOException $e) {
                  echo $e->getMessage();
              }
              ?>

        </div>
    </div>
</div><br>

<hr>
<center><h5>Favoritos</h5></center>


<div class="container-fluid pb-4 pt-5">
    <div class="container animate-box">
        <div>
            <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Seus filmes favoritos</div>
        </div>
        <div class="owl-carousel owl-theme" id="slider1">
            <?php
            try {
                 $postnum = 0;
                 $found = 0;
                 $multiplicador = 1;
                 $stmt = $db->query('SELECT f.id, f.titulo, f.img, f.datapost, ff.idusuario  FROM filme f JOIN filmefavorito ff ON f.id = ff.idfilme  ORDER BY id DESC');
                 while($row = $stmt->fetch()){
                    if($row['idusuario'] == $_SESSION['id']){
                      if($postnum < 6){
                        echo '<div class="item px-2">';
                        echo '<div class="fh5co_hover_news_img">';
                        echo '<div ><img src="'.$row['img'].'" alt="'.$row['titulo'].'"  height="235" widht="324" /></div>';
                        echo '<div>';
                        echo '<a href="assistir.php?id='.$row['id'].'" class="d-block fh5co_small_post_heading"><span class="">'.$row['titulo'].'</span></a>';
                        echo '<div class="c_g"><i class="fa fa-clock-o"></i> '.date('d, M, Y', strtotime($row['datapost'])).'</div>';
                        echo '</div>';
                        echo' </div></div>';
                      $postnum++;
                      }
                      $found = 1;
                  }

              }

              if($found == 0){
                echo '<h5>Você ainda não tem filmes favoritos.<h5>
                <h7>Clique na estrela do lado do título de um filme para começar<h7>';
              }


              } catch(PDOException $e) {
                  echo $e->getMessage();
              }
              ?>

        </div>
    </div>
</div><br>


<div class="container-fluid pb-4 pt-5">
    <div class="container animate-box">
        <div>
            <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Suas séries favoritas</div>
        </div>
        <div class="owl-carousel owl-theme seriefav" id="slider4">
            <?php
            try {
                 $postnum = 0;
                 $found = 0;
                 $multiplicador = 1;
                 $stmt = $db->query('SELECT s.id, s.titulo, s.img, s.datapost, sf.idusuario  FROM serie s JOIN seriefavorita sf ON s.id = sf.idserie  ORDER BY id DESC');
                 while($row = $stmt->fetch()){
                    if($row['idusuario'] == $_SESSION['id']){
                      if($postnum < 6){
                        echo '<div class="item px-2">';
                        echo '<div class="fh5co_hover_news_img">';
                        echo '<div ><img src="'.$row['img'].'" alt="'.$row['titulo'].'"  height="235" widht="324" /></div>';
                        echo '<div>';
                        echo '<a href="episodios-serie.php?id='.$row['id'].'" class="d-block fh5co_small_post_heading"><span class="">'.$row['titulo'].'</span></a>';
                        echo '<div class="c_g"><i class="fa fa-clock-o"></i> '.date('d, M, Y', strtotime($row['datapost'])).'</div>';
                        echo '</div>';
                        echo' </div></div>';
                      $postnum++;
                      }
                      $found = 1;
                  }

              }

              if($found == 0){
                echo '<h5>Você ainda não tem séries favoritos.<h5>
                <h7>Clique na estrela do lado do título de uma série para começar<h7>';
              }


              } catch(PDOException $e) {
                  echo $e->getMessage();
              }
              ?>

        </div>
    </div>
</div><br>





		</div>
		<footer>
			<div id="bottom">
			</div>
		</footer>


	</wrapper>






<script type="text/javascript" src="js/jquery-3.3.1.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
        integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
        crossorigin="anonymous"></script>
<!-- Waypoints -->
<script src="js/jquery.waypoints.min.js"></script>
<!-- Main -->
<script src="js/main.js"></script>

</body>
</html>