<?php
require_once ('Session.php');
require_once ('Utils.php');
require_once ('Connection.php');

class User
{
	protected $table = 'user';

	function set() {
		$this->name = empty($_REQUEST['name']) ? '' : $_REQUEST['name'];
		$this->description = empty($_REQUEST['description']) ? '' : $_REQUEST['description'];
        $this->group = empty($_REQUEST['group']) ? '' : $_REQUEST['group'];
        $this->offset = empty($_REQUEST['offset']) ? 0 : $_REQUEST['offset'];
        $this->limit = empty($_REQUEST['limit']) ? 10 : $_REQUEST['limit']; 
	}

	public function get() {
		$c = "SELECT * FROM $this->table LIMIT $this->limit OFFSET $this->offset;";

		$u = new Utils();

		return ($u->encode($u->getArrFromSql($c)));
	}
}

?>