<?php
	class Usuario{
	private $db;

	function __construct($db){

		$this->_db = $db;
	}


	public function is_logged_in(){
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
			return true;
		}
	}


	public function login($usuario,$senha){
		$login = $this->get_user_hash($usuario);

		    $_SESSION['loggedin'] = true;
		    $_SESSION['id'] = $login['id'];
		    $_SESSION['nome'] = $login['nome']; 
		    $_SESSION['login'] = $login['usuario'];
		    return true;
	}

	private function get_user_hash($usuario){

		try {

			$stmt = $this->_db->prepare('SELECT id, usuario, senha, email, nome FROM usuario WHERE usuario = :usuario');
			$stmt->execute(array('usuario' => $usuario));

			return $stmt->fetch();

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}
	}

	public function logout(){
		session_destroy();
	}


	}

?>