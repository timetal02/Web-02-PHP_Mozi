<?php

$result = "";
try {
	$dbh = new PDO('mysql:host=localhost;dbname=mozi', 'root', '',
				  array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
	$dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
	switch($_SERVER['REQUEST_METHOD']) {
		case "GET":
				$sql = "SELECT * FROM film";     
				$sth = $dbh->query($sql);
				$result .= "<table style=\"border-collapse: collapse;\"><tr><th>ID</th><th>Cím</th><th>Megjelenés</th><th>Időtartam</th></tr>";
				while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
					$result .= "<tr>";
					foreach($row as $column)
						$result .= "<td style=\"border: 1px solid black; padding: 3px;\">".$column."</td>";
					$result .= "</tr>";
				}
				$result .= "</table>";
			break;
		case "POST":
				$incoming = file_get_contents("php://input");
				parse_str($incoming, $data);
				$sql = "insert into film values (0, :cim, :ev, :hossz)";
				$sth = $dbh->prepare($sql);
				$count = $sth->execute(Array(":cim"=>$data["cim"], ":ev"=>$data["ev"], ":hossz"=>$data["hossz"]));
					
				$newid = $dbh->lastInsertId();
				$result .= $count." Hozzáadva: ".$newid;
			break;
		case "PUT":
				$data = array();
				$incoming = file_get_contents("php://input");
				parse_str($incoming, $data);
				$change = "id=id"; $params = Array(":id"=>$data["id"]);
				if($data['cim'] != "") {$change .= ", cim = :cim"; $params[":cim"] = $data["cim"];}
				if($data['ev'] != "") {$change .= ", ev = :ev"; $params[":ev"] = $data["ev"];}
				if($data['hossz'] != "") {$change .= ", hossz = :hossz"; $params[":hossz"] = $data["hossz"];}
				
				$sql = "update film set ".$change." where id=:id";
				$sth = $dbh->prepare($sql);
				$count = $sth->execute($params);
				$result .= $count." Módosításra került (ID):".$data["id"];
			break;
		case "DELETE":
				$data = array();
				$incoming = file_get_contents("php://input");
				parse_str($incoming, $data);
				$sql = "delete from film where id=:id";
				$sth = $dbh->prepare($sql);
				$count = $sth->execute(Array(":id" => $data["id"]));
				$result .= $count." Törlésre került (ID):".$data["id"];
			break;
	}
}
catch (PDOException $e) {
	$result = $e->getMessage();
}
echo $result;

?>