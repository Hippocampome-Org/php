<?php
class fragment
{
	private $_name_table;
	private $_id;
	private $_quote;
	private $_original_id;
	private $_page_location;	
	private $_type;	
	private $_attachment;
	private $_attachment_type;
	private $_attachment_array;
	private $_attachment_type_array;
	private $_number_attachment;
	
	function __construct ($name)
	{
		$this->_name_table = $name;
	}
	
	public function retrive_by_id($id) 
    {
		$table=$this->getName_table();
		
		$query = "SELECT id, original_id, quote, page_location, type, attachment, attachment_type  FROM $table WHERE id = '$id'";
		$rs = mysql_query($query);
		while(list($id, $original_id, $quote, $page_location, $type, $attachment, $attachment_type) = mysql_fetch_row($rs))
		{	
			$this->setID($id);
			$this->setOriginal_id($original_id);			
			$this->setQuote($quote);
			$this->setPage_location($page_location);		
			$this->setType($type);	
			$this->setAttachment($attachment);	
			$this->setAttachment_type($attachment_type);	
		}
	}

	public function retrive_attachment_array_by_original_id($id)
	{
		$table=$this->getName_table();
		
		$query = "SELECT attachment FROM $table WHERE fragment_id = '$id'";
		$rs = mysql_query($query);
		$n=0;
		while(list($attachment) = mysql_fetch_row($rs))
		{	
			$this->setAttachment_array($attachment, $n);	
			$n = $n + 1;
		}		
		$this->setNumber_attachment($n);
	}
	 
	public function retrive_attachment_type_array_by_original_id($id)
	{
		$table=$this->getName_table();
		
		$query = "SELECT attachment_type FROM $table WHERE original_id = '$id'";
		$rs = mysql_query($query);
		$n=0;
		while(list($attachment_type) = mysql_fetch_row($rs))
		{	
			$this->setAttachment_type_array($attachment_type, $n);
			$n = $n + 1;
		}		
		$this->setNumber_attachment($n);
	}
	 
	public function retrive_attachment_by_original_id($id)
	{
		$table=$this->getName_table();
		
		$query = "SELECT attachment, attachment_type FROM $table WHERE original_id = '$id'";
		$rs = mysql_query($query);
		while(list($attachment, $attachment_type) = mysql_fetch_row($rs))
		{	
			$this->setAttachment($attachment);	
			$this->setAttachment_type($attachment_type);	
		}		
	}
	 
	// SET -------------------------------------
 	public function setID($val)
    {
		  $this->_id = $val;
    }
			
 	public function setQuote($val)
    {
		  $this->_quote = $val;
    }
	
 	public function setPage_location($val)
    {
		  $this->_page_location = $val;
    }

 	public function setOriginal_id($val)
    {
		  $this->_original_id = $val;
    }

 	public function setType($val)
    {
		  $this->_type = $val;
    }

 	public function setAttachment($val)
    {
		  $this->_attachment = $val;
    }

 	public function setAttachment_type($val)
    {
		  $this->_attachment_type = $val;
    }
		
 	public function setAttachment_array($val, $n)
    {
		  $this->_attachment_array[$n] = $val;
    }

 	public function setAttachment_type_array($val)
    {
		  $this->_attachment_type_array = $val;
    }
		
 	public function setNumber_attachment($n)
    {
		  $this->_number_attachment = $n;
    }		
	
			
 	// GET ++++++++++++++++++++++++++++++++++++++	
    public function getID()
    {
    	return $this->_id;
    }	
			
    public function getQuote()
    {
    	return $this->_quote;
    }	

    public function getPage_Location()
    {
    	return $this->_page_location;
    }

    public function getOriginal_id()
    {
    	return $this->_original_id;
    }

    public function getType()
    {
    	return $this->_type;
    }
				
    public function getName_table()
    {
    	return $this->_name_table;
    }	
	
    public function getAttachment()
    {
    	return $this->_attachment;
    }		

    public function getAttachment_type()
    {
    	return $this->_attachment_type;
    }
		
    public function getAttachment_array($n)
    {
    	return $this->_attachment_array[$n];
    }		

    public function getAttachment_type_array()
    {
    	return $this->_attachment_type_array;
    }
		
    public function getNumber_attachment()
    {
    	return $this->_number_attachment;
    }	
	
}

?>