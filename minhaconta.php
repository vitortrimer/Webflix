<?php
    require_once('db/config.php');
            if(!$user->is_logged_in()) {
    header('Location: login.php'); 
    }


    try {
            $stmt = $db->prepare('SELECT id, nome, usuario, email, datanasc FROM usuario WHERE id = :id') ;
            $stmt->execute(array(':id' => $_SESSION['id']));
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
					    <a class="nav-link" href="index.php">Início</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" href="filmes.php">Filmes</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" href="series.php">Séries</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" href="#">Contato</a>
					  </li>
					</ul>
				</div>
			</div>
		</header>
		<div id="content">
			<br>

            <div id="conta">
              <div class=row>
                  <div class="col-md-6">
                    <p>Usuario: <?php echo $row['usuario']; ?></p>
                    <p>Nome: <?php echo $row['nome']; ?></p>
                  </div>
                  <div class="col-md-6">
                    <p>Data de nascimento: <?php echo date('d/m/Y', strtotime($row['datanasc'])); ?></p>
                    <p>Email: <?php echo $row['email']; ?></p>
                  </div>
              </div>
            </div>

   


            <br>
            <br>
            <br>
            <br>
            <br>

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