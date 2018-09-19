<?php
	require_once('../db/config.php');
    if( !$admin->is_logged_in_admin() ){ 
        header('Location: login.php'); 
    }

	if(isset($_GET['deletaserie'])){ 
	        $stmt = $db->prepare('DELETE FROM serie WHERE id = :id') ;
	        $stmt->execute(array(':id' => $_GET['deletaserie']));
	        header('Location: series.php');
	        exit;

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

	<script language="JavaScript" type="text/javascript">
		function deletaserie(id, titulo)
		{
		  if (confirm("Deletar série " + titulo + "?"))
		  {
		      window.location.href = 'series.php?deletaserie=' + id;
		  }
		}
	</script>

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
    <h4>FILMES RECENTES</h4>
    <hr>

    <table class="table table-hover">
		  	<thead class="thead-dark">
		    <tr>
		      <th scope="col">ID</th>
		      <th scope="col">Nome</th>
		      <th scope="col"><center>Data de Postagem</center></th>
		      <th scope="col"><center>Ações</center></th>
		    </tr>
			</thead>
		  <tbody>
		    <?php
			    try {

			        $stmt = $db->query('SELECT id, titulo, datapost FROM serie ORDER BY id DESC');
			        while($row = $stmt->fetch()){
			            
			            echo '<tr>';
			            echo '<th scope="row">'.$row['id'].'</th>';
			            echo '<td>'.$row['titulo'].'</td>';
			            echo '<td> <center>'.date('d/m/Y', strtotime($row['datapost'])).'</center></td>';
			            ?>
			            <td>
			            	<center>
			            	<a href="editserie.php?id=<?php echo $row['id'];?>">Editar</a> |
			                <a href="javascript:deletaserie('<?php echo $row['id'];?>','<?php echo $row['titulo'];?>')">Deletar</a>
			                </center>
			            </td>
			            
			            <?php 
			            echo '</tr>';

			        }

			    } catch(PDOException $e) {
			        echo $e->getMessage();
			    }
			?>
		  </tbody>
	</table>


  </article>
  <nav>
  	<div id="menulateral">
  		<h5>RECENTES</h5>
  		<hr>
    <ul>
      <li><a href="index.php">FILMES</a></li>
      <li><a href="#">SERIES</a></li>
      <li><a href="episodios.php">EPISÓDIOS</a></li>
    </ul>
    	<h5>ADICIONAR</h5>
    	<hr>
    <ul>
      <li><a href="addfilme.php">FILME</a></li>
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