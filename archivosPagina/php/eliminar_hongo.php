<?php
	function eliminar_hongo(){
		session_start();
		
		$serverName = "35.224.8.47"; //serverName\instanceName
		$connectionInfo = array("Database" => "master", "UID" => "sqlserver", "PWD" => "honguit0s");
		$conn = sqlsrv_connect($serverName, $connectionInfo);
		if ($conn) {
		   // echo "Connection established.<br />";
		} else {
			echo "No se pudo establecer la conexión.<br />";
			die(print_r(sqlsrv_errors(), true));
		}
		
		
		$sql = "select img_sup from GestionHongos.dbo.Hongos where id_hongo = {$_POST['id_hong']}";
		$qry = sqlsrv_query($conn, $sql);
		if ($qry === false) {
			echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
		}
		$data = '';
		while ($row = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {
			$data .= $row['img_sup'];
		}
		if($data !== 'default_perfil.png'){	//Borrar la imagen anterior
			unlink('../img/UserProfile/'.$data);
		}
		
		$sql2 = "select img_inf from GestionHongos.dbo.Hongos where id_hongo = {$_POST['id_hong']}";
		$qry2 = sqlsrv_query($conn, $sql2);
		if ($qry2 === false) {
			echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
		}
		$data = '';
		while ($row = sqlsrv_fetch_array($qry2, SQLSRV_FETCH_ASSOC)) {
			$data .= $row['img_inf'];
		}
		if($data !== 'default_perfil.png'){	//Borrar la imagen anterior
			unlink('../img/UserProfile/'.$data);
		}
		
		$sql3 = "select img_lat from GestionHongos.dbo.Hongos where id_hongo = {$_POST['id_hong']}";
		$qry3 = sqlsrv_query($conn, $sql3);
		if ($qry3 === false) {
			echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
		}
		$data = '';
		while ($row = sqlsrv_fetch_array($qry3, SQLSRV_FETCH_ASSOC)) {
			$data .= $row['img_lat'];
		}
		if($data !== 'default_perfil.png'){	//Borrar la imagen anterior
			unlink('../img/UserProfile/'.$data);
		}
		
		$sql4 = "select img_mano_hongo from GestionHongos.dbo.Hongos where id_hongo = {$_POST['id_hong']}";
		$qry4 = sqlsrv_query($conn, $sql4);
		if ($qry4 === false) {
			echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
		}
		$data = '';
		while ($row = sqlsrv_fetch_array($qry4, SQLSRV_FETCH_ASSOC)) {
			$data .= $row['img_mano_hongo'];
		}
		if($data !== 'default_perfil.png'){	//Borrar la imagen anterior
			unlink('../img/UserProfile/'.$data);
		}
		
		
		$sql5 = "delete from GestionHongos.dbo.Hongos where id_hongo = {$_POST['id_hong']}";
		$qry5 = sqlsrv_query($conn, $sql5);
		if ($qry5 === false) {
			echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
		}
		
		
		header('Location: ../paginas/administracion.php');
		sqlsrv_close($conn);
		die();
	}
	
	eliminar_hongo();
?>
