<?php
require_once ('Connection.php');


class Utils
{
    public function getArrFromSql($sql) {
        $con = new Connection();
        $link = $con->connect();

        $s = mysqli_query($link,$sql);
		$arr = array();
		while($r = mysqli_fetch_array($s, MYSQL_ASSOC)) {
			$arr[] = $r;
		}

		$con->close();

		return $arr;
    }

    public function encode($arr) {
        return json_encode($arr);
    }

    public function saveQuery($sql) {
        
        $con = new Connection();
        $link = $con->connect();

        $result = true;

        $errorpg = '';

        if (!mysqli_query($link,$sql)){
            $errorpg = mysqli_error($link);
            $termino = "ROLLBACK";
            $result = false;
        }else{
            $termino = "COMMIT";
        }
        mysqli_query($link,$termino);

        $arr = array('success' => $result);
        if($errorpg != '') {
            $arr['error'] = $errorpg;
        }

        $con->close();
        
        return ($arr);
    }
}

?>