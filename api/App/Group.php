<?php
require_once ('Session.php');
require_once ('Utils.php');

class Group
{
	protected $table = 'groups';

	public function set() {
		$this->name = empty($_REQUEST['name']) ? '' : ucwords(strtolower($_REQUEST['name']));
		$this->id = empty($_REQUEST['id']) ? '' : $_REQUEST['id'];
		$this->offset = empty($_REQUEST['offset']) ? 0 : $_REQUEST['offset'];
		$this->limit = empty($_REQUEST['limit']) ? 10 : $_REQUEST['limit'];
		$this->description = empty($_REQUEST['description']) ? 'null' : ucfirst(strtolower($_REQUEST['description']));
	}

	public function get() {
		$c = "SELECT * FROM $this->table LIMIT $this->limit OFFSET $this->offset;";

		$u = new Utils();

		return ($u->encode($u->getArrFromSql($c)));
	}

	public function getCombo() {
		$c = "SELECT * FROM $this->table;";

		$u = new Utils();

		return ($u->encode($u->getArrFromSql($c)));
	}

	public function create() {
		$c = "INSERT INTO $this->table(name,description) VALUES('$this->name','$this->description');";

		$u = new Utils();

		return ($u->encode($u->saveQuery($c)));
	}

}

?>