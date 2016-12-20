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
		$this->description = empty($_REQUEST['description']) ? '' : ucfirst(strtolower($_REQUEST['description']));
		$this->group = empty($_REQUEST['group']) ? '0' : $_REQUEST['group'];
	}

	public function get() {
		$c = "SELECT g.*,(SELECT count(ug.id) FROM userpergroup ug WHERE ug.groups=g.id) as users from $this->table g WHERE g.deletedAt IS NULL;";

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

	public function update() {
		$c = "UPDATE $this->table SET name='$this->name',description='$this->description' WHERE id=$this->id;";

		$u = new Utils();

		return ($u->encode($u->saveQuery($c)));
	}

	public function delete() {
		$con = new Connection();
		$link = $con->connect();

		$c = "SELECT count(id) as count FROM userpergroup WHERE groups=$this->id;";

		$s = mysqli_query($link,$c);

		$r = mysqli_fetch_array($s,MYSQLI_ASSOC);

		$u = new Utils();
		$arr = array();

		if($r['count'] > 0) {
			$arr['success'] = false;
		} else {

			$c = "DELETE FROM groups WHERE id=$this->id;";
			mysqli_query($link,$c);

			$arr['success'] = true;

		}

		return ($u->encode($arr));
	}

}

?>