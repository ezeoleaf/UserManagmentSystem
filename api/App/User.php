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
		$this->id = empty($_REQUEST['id']) ? 0 : $_REQUEST['id'];
		$this->groupsAssign = empty($_REQUEST['groupsAssign']) ? '' : $_REQUEST['groupsAssign'];
	}

	public function get() {
		//$c = "SELECT * FROM $this->table LIMIT $this->limit OFFSET $this->offset;";
		$c = "SELECT u.*,g.id as gid,g.name as groups from user u left join userpergroup ug on(u.id = ug.user) left join groups g on(g.id = ug.groups) WHERE u.deletedAt IS NULL ORDER BY u.name asc;";

		$u = new Utils();

		return ($u->encode($u->getArrFromSql($c)));
	}

	public function checkName() {
		$c = "SELECT id FROM $this->table WHERE LOWER(name)=LOWER('$this->name');";

		$u = new Utils();

		return ($u->encode($u->getArrFromSql($c)));
	}

	public function create() {
		$con = new Connection();
		$link = $con->connect();

		$c = "INSERT INTO $this->table(name,description) VALUES('$this->name','$this->description');";

		mysqli_query($link,$c);

		if($this->group != 0) {
			$c = "INSERT INTO userpergroup(user,groups) VALUES((SELECT id FROM $this->table WHERE LOWER(name)=LOWER('".$this->name."')),$this->group);";
			mysqli_real_query($link,$c);
		}

		//return mysqli_error($link);
		//return $c;
		$u = new Utils();
		$arr = array();
		$arr['success'] = true;
		return ($u->encode($arr));
	}

	public function update() {
		$con = new Connection();
		$link = $con->connect();

		$c = "UPDATE $this->table SET name='$this->name',description='$this->description' WHERE id=$this->id;";

		mysqli_query($link,$c);

		if($this->group != 0) {
			$c = "INSERT INTO userpergroup (user, groups)
					SELECT * FROM (SELECT $this->id, $this->group) AS tmp
					WHERE NOT EXISTS (
						SELECT 1 FROM userpergroup WHERE user = $this->id AND groups=$this->group
					) LIMIT 1;";
			mysqli_real_query($link,$c);
		}

		//return mysqli_error($link);
		//return $c;
		$u = new Utils();
		$arr = array();
		$arr['success'] = true;
		return ($u->encode($arr));
	}

	public function delete() {
		$con = new Connection();
		$link = $con->connect();

		$c = "DELETE FROM userpergroup WHERE user='$this->id';";

		mysqli_query($link,$c);

		$c = "DELETE FROM $this->table WHERE id='$this->id';";

		mysqli_query($link,$c);
		
		$u = new Utils();
		$arr = array();
		$arr['success'] = true;
		return ($u->encode($arr));
	}

	public function removeGroup() {
		$con = new Connection();
		$link = $con->connect();

		$c = "DELETE FROM userpergroup WHERE user='$this->id' AND groups='$this->group';";

		mysqli_query($link,$c);
		
		$u = new Utils();
		$arr = array();
		$arr['success'] = true;
		return ($u->encode($arr));
	}

	public function assignGroup() {
		$con = new Connection();
		$link = $con->connect();

		$c = "DELETE FROM userpergroup WHERE user='$this->id';";
		mysqli_query($link,$c);

		$vGroups = explode('-',$this->groupsAssign);
		for($i = 0; $i < count($vGroups); $i++) {
			$group = $vGroups[$i];
			$c = "INSERT INTO userpergroup (user, groups) VALUES($this->id, $group);";
			mysqli_query($link,$c);
		}

		$u = new Utils();
		$arr = array();
		$arr['success'] = true;
		return ($u->encode($arr));
	}

	public function usersInGroup() {
		$c = "SELECT u.* from user u inner join userpergroup ug on(u.id = ug.user) WHERE ug.groups=$this->group AND u.deletedAt IS NULL ORDER BY u.name asc;";

		$u = new Utils();

		return ($u->encode($u->getArrFromSql($c)));
	}

	public function removeAll() {
		$con = new Connection();
		$link = $con->connect();

		$c = "DELETE FROM userpergroup WHERE groups='$this->group';";
		mysqli_query($link,$c);

		$u = new Utils();
		$arr = array();
		$arr['success'] = true;
		return ($u->encode($arr));
	}
}

?>