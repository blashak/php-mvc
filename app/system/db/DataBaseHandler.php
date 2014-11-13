<?php

interface DataBaseHandler {
	public function connect();
	public function cleanString($data);
	public function executeQuery(Sql $sql);
	public function getLastId();
	public function disconnect();
}

?>