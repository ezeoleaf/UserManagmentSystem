<?php
require_once ('Session.php');
require_once ('Utils.php');
require_once ('Connection.php');

class UserApp
{
	protected $table = 'userapp';

	function set() {
		$this->user = empty($_REQUEST['user']) ? '' : $_REQUEST['user'];
		$this->pass = empty($_REQUEST['pass']) ? '' : $_REQUEST['pass'];
	}

	function checkLogin() {
		$u = new Utils();
		$con = new Connection();
		$link = $con->connect();

		$c = "SELECT id FROM $this->table WHERE username='$this->user' AND pass='$this->pass';";
		$s = mysqli_query($link,$c);
		//return $c;
		$result = false;

		if(mysqli_num_rows($s) > 0) {
			$r = mysqli_fetch_array($s);
			$ss = new Session();
			$ss->set('id',$r['id']);
			$result = true;
		}

		$con->close();

		$arr = array('success' => $result);

		return ($u->encode($arr));
	}

	function isLogged() {
		$u = new Utils();
		$s = new Session();
		
		return $u->encode($s->isLogged());
	}

	function logout() {
		$u = new Utils();
		$s = new Session();
		
		$s->destroy();

		$arr = array();
		$arr['success'] = true;

		return $u->encode($arr);
	}
}

?>