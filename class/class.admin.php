<?php
	class Admin{
	private $db;

	function __construct($db){

		$this->_db = $db;
	}


	public function is_logged_in_admin(){
		if(isset($_SESSION['loggedinAdmin']) && $_SESSION['loggedinAdmin'] == true){
			return true;
		}
	}


	public function login($usuario,$senha){
		$login = $this->get_user_hash($usuario);

		    $_SESSION['loggedinAdmin'] = true;
		    $_SESSION['idAdmin'] = $login['id'];
		    $_SESSION['nomeAdmin'] = $login['nome']; 
		    $_SESSION['loginAdmin'] = $login['usuario'];
		    return true;
	}

	private function get_user_hash($usuario){

		try {

			$stmt = $this->_db->prepare('SELECT id, usuario, senha, email, nome FROM admin WHERE usuario = :usuario');
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