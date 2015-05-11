<?php
class type
{	
	private $_name_table;
	private $_id;
	private $_dt;
	private $_name;
	private $_nickname;
	private $_excit_inhib;
	private $_status;
	private $_number_type;
	private $_id_array;	
	private $_position;
	private $_notes;
	private $_subregion;
	
	function __construct ($name)
	{
		$this->_name_table = $name;
	}


	public function retrive_id()   // Retrive the data from table: 'TYPE' by ID (only with STATUS = active):
    {
		$table=$this->getName_table();	
	
		$query = "SELECT id FROM $table WHERE status = 'active' ORDER BY position ASC";
		$rs = mysql_query($query);
		$n=0;
		while(list($id) = mysql_fetch_row($rs))
		{	
			$this->setID_array($id, $n);
			$n = $n + 1;
		}
		$this->setNumber_type($n);
	}	

	public function retrive_name_by_nickname()   // Retrive the data from table: 'TYPE' by ID (only with STATUS = active):
    {
		$table=$this->getName_table();	
	
		$query = "SELECT name FROM $table WHERE nickname = '$nickname'";
		$rs = mysql_query($query);
		while(list($id) = mysql_fetch_row($rs))
		{	
			$this->setName($var);
		}
	}	
	
	public function retrive_by_id($id)   // Retrive all data by ID
	{
		$table=$this->getName_table();	
		
		$query = "SELECT id, position, dt, name, nickname,excit_inhib, status, subregion FROM $table WHERE id = '$id'";
		$rs = mysql_query($query);
		while(list($id, $position, $dt, $name, $nickname,$excit_inhib, $status, $subregion) = mysql_fetch_row($rs))
		{	
			$this->setId($id);
			$this->setDt($dt);
			$this->setName($name);
			$this->setNickname($nickname);
			$this->setStatus($status);
			$this->setPosition($position);
			$this->setSubregion($subregion);
			$this->setExcit_Inhib($excit_inhib);
		}	
	}
	
	public function retrieve_by_id($id)   // Retrieve all data by ID
	{
		$table=$this->getName_table();	
		
		$query = "SELECT id, position, dt, name, nickname,excit_inhib, status, subregion FROM $table WHERE id = '$id'";
		$rs = mysql_query($query);
		$this->setStatus('');
		while(list($id, $position, $dt, $name, $nickname,$excit_inhib, $status, $subregion) = mysql_fetch_row($rs))
		{	
			$this->setId($id);
			$this->setDt($dt);
			$this->setName($name);
			$this->setNickname($nickname);
			$this->setStatus($status);
			$this->setPosition($position);
			$this->setSubregion($subregion);
			$this->setExcit_Inhib($excit_inhib);
		}	
	}

	public function retrive_by_excit_inhib($pred)   // Retrive all data by excit_inhib
	{
		$table=$this->getName_table();
	
		$query = "SELECT id FROM $table WHERE excit_inhib ='$pred'";
		$rs = mysql_query($query);
		$n=0;
		while(list($id) = mysql_fetch_row($rs))
		{	
			$this->setID_array($id, $n);		
			$n = $n +1;
		}
		$this->setNumber_type($n);
	}

	public function retrive_by_id_active($id)   // Retrive all data by ID
	{
		$table=$this->getName_table();	
		
		$query = "SELECT id, position, dt, name, nickname,excit_inhib, status, subregion FROM $table WHERE id = '$id' AND status = 'active'";
		$rs = mysql_query($query);
		while(list($id, $position, $dt, $name, $nickname,$excit_inhib, $status, $subregion) = mysql_fetch_row($rs))
		{	
			$this->setId($id);
			$this->setDt($dt);
			$this->setName($name);
			$this->setNickname($nickname);
			$this->setExcit_Inhib($excit_inhib);
			$this->setStatus($status);
			$this->setPosition($position);
			$this->setSubregion($subregion);
		}	
	}

	public function retrieve_by_id_active($id)   // Retrieve all data by ID
	{
		$table=$this->getName_table();	
		
		$query = "SELECT id, position, dt, name, nickname,excit_inhib, status, subregion FROM $table WHERE id = '$id' AND status = 'active'";
		$rs = mysql_query($query);
		$this->setStatus('');
		while(list($id, $position, $dt, $name, $nickname,$excit_inhib, $status, $subregion) = mysql_fetch_row($rs))
		{	
			$this->setId($id);
			$this->setDt($dt);
			$this->setName($name);
			$this->setNickname($nickname);
			$this->setExcit_Inhib($excit_inhib);
			$this->setStatus($status);
			$this->setPosition($position);
			$this->setSubregion($subregion);
		}	
	}

	public function retrive_notes($id)   // Retrive the data from table: 'TYPE' by ID (only with STATUS = active):
    {
		$table=$this->getName_table();	
	
		$query = "SELECT notes FROM $table WHERE id = '$id'";
		$rs = mysql_query($query);
		while(list($var) = mysql_fetch_row($rs))
		{	
			$this->setNotes($var);
		}
	}	
	
	// SET -------------------------------------
 	public function setNumber_type($n)
    {
		  $this->_number_type = $n;
    }		
	
 	public function setID_array($var, $n)
    {
		  $this->_id_array[$n] = $var;
    }	
	
	public function setNickname($var)
    {
		  $this->_nickname = $var;
	}	
	public function setExcit_Inhib($var)
    {
		  $this->_excit_inhib = $var;
    }	
		
 	public function setId($var)
    {
		  $this->_id = $var;
    }		
	
 	public function setDt($var)
    {
		  $this->_dt = $var;
    }		
	
 	public function setName($var)
    {
		  $this->_name = $var;
    }		

 	public function setStatus($var)
    {
		  $this->_status = $var;
    }	

 	public function setPosition($var)
    {
		  $this->_position = $var;
    }	

 	public function setNotes($var)
    {
		  $this->_notes = $var;
    }	
	
 	public function setSubregion($var)
    {
		  $this->_subregion = $var;
    }	
	
	// GET ++++++++++++++++++++++++++++++++++++++	  
    public function getID_array($i)
    {
    	return $this->_id_array[$i];
    }		
	
    public function getNumber_type()
    {
    	return $this->_number_type;
    }	
	
    public function getNickname()
    {
    	return $this->_nickname;
    }		

	public function getExcit_Inhib()
   	{
		return $this->_excit_inhib;
    }
    public function getId()
    {
    	return $this->_id;
    }
	
    public function getDt()
    {
    	return $this->_dt;
    }	

    public function getName()
    {
    	return $this->_name;
    }		

    public function getStatus()
    {
    	return $this->_status;
    }		

    public function getName_table()
    {
    	return $this->_name_table;
    }
	
    public function getPosition()
    {
    	return $this->_position;
    }	

    public function getNotes()
    {
    	return $this->_notes;
    }	

    public function getSubregion()
    {
    	return $this->_subregion;
    }	

}
?>
