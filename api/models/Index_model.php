<?php
class Index_model extends Model
{

	function __construct(){
		parent::__construct();
	}

	public function getPaises()
	{
		return $this->db->selectStrict('*','pais_un');
	}

	public function getInstituciones()
	{
		return $this->db->selectStrict('*','instituciones_un');
	}


}
?>
