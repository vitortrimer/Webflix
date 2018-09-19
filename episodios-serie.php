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
        <?php
        $favoritado = 0;
        $stmt = $db->prepare('SELECT idusuario, idserie FROM seriefavorita WHERE idserie = :id');
            $stmt->execute(array(':id' => $_GET['id']));
            while($row = $stmt->fetch()){
                if($_SESSION['id'] == $row['idusuario'])
                    $favoritado = 1;
            }
        ?>
    
        <?php

            $stmt = $db->prepare('SELECT id, titulo, img, sinopse, datapost FROM serie WHERE id = :id');
            $stmt->execute(array(':id' => $_GET['id']));
            $row = $stmt->fetch();

            if($row['id'] == ''){
                header('Location: ./');
                exit;
            }

            echo '<title>'.$row['titulo'].'</title>';
            ?>
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
            <?php
             if(isset($_POST['submit'])){

                $_POST = array_map( 'stripslashes', $_POST );

                extract($_POST);


                if(!isset($error)){
                    try {
                    if($favoritado == 0){
                    $stmt = $db->prepare('INSERT INTO seriefavorita (idusuario, idserie) VALUES (:idusuario, :idserie)') ;
                    $stmt->execute(array(
                      ':idusuario' => $_SESSION['id'],
                      ':idserie' => $_GET['id']
                    ));
                     header('Refresh:0');
                      exit;
                    }
                    else if($favoritado == 1){
                        $stmt = $db->prepare('DELETE FROM seriefavorita WHERE idusuario = :idusuario AND idserie = :idserie') ;
                        $stmt->execute(array(':idusuario' => $_SESSION['id'],
                        ':idserie' => $_GET['id']
                    ));
                      header('Refresh:0');
                      exit;
                    }


                    

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



            <div class=row>
                <div id="imgserie">
                    <?php
                    echo '<img src="'.$row['img'].'" height="280" width="220" alt="Capa">';
                    ?>
                </div>
                <div id="titulo">
                    <div class="row" style="margin-left:10px">
                    <form method="POST" action="">
                        <input type='hidden' name='id' value='<?php echo $row['id'];?>'>
                        <button type="submit" name="submit" id="fav"><?php
                        if($favoritado == 0)
                            echo'<img src="images/fav1.png" width="30" height="30">';
                        else if($favoritado == 1){
                            echo'<img src="images/fav2.png" width="30" height="30">';
                        }
                         ?></button>
                    </form>
                    <?php
                    echo '<p>'.$row['titulo'].'</p></div>';
                    echo '<hr>';
                    echo '<div id="sinopse">';
                    echo '<p>'.$row['sinopse'].'</p>';
                    ?>
                </div>
                </div>

            </div>
            <br>
            <hr>
            <h3>Episódios</h3>
            <hr>
            <div id="lista">

                <?php
                try {
                $stmt = $db->query('SELECT id, titulo, img, epinum, datapost, idserie FROM episodio WHERE idserie = '.$_GET['id'].'');
                    while($row = $stmt->fetch()){

                        echo' <div class="episodiolista row">';
                        echo'<div class="episodiofoto"><img src="'.$row['img'].'"  height="50" width="90"></div>';
                        echo'<div class="episodionumero">'.$row['epinum'].'</div>';
                        echo'<div class="separador"></div>';
                        echo'<div class="episodiotitulo"><a href="assistirserie.php?id='.$row['id'].'">'.$row['titulo'].'</a></div>';
                        echo'</div><hr>';
                    }

                 }   catch(PDOException $e) {
                    echo $e->getMessage();
                }
                ?>



            </div>




            <br><br><br>
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