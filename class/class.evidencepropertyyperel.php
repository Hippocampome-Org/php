<?php
class evidencepropertyyperel
{
	private $_name_table;
	private $_id;
	private $_dt;
	private $_type_id_array;
	private $_Property_id;
	private $_n_type_id;
	private $_Property_id_array;
	private $_n_Property_id;
	private $_evidence_id_array;
	private $_n_evidence_id;
	private $_unvetted;
	private $_article_id;
	private $_conflict_note;
	private $_n_linking_quote_array;

	function __construct ($name)
	{
		$this->_name_table = $name;
	}

	public function retrive_Property_id_by_Type_id($id)
    {
		$table=$this->getName_table();
		
		$query = "SELECT DISTINCT Property_id FROM $table WHERE Type_id = '$id'";
		$rs = mysql_query($query);
		$n=0;
		while(list($id) = mysql_fetch_row($rs))
		{	
			$this->setProperty_id_array($id, $n);		
			$n = $n +1;
		}
		$this->setN_Property_id($n);	
	}
	
	public function retrive_Type_id_by_Property_id($Property_id)
    {
		$table=$this->getName_table();
	
		$query = "SELECT DISTINCT Type_id FROM $table WHERE Property_id = '$Property_id'";
		$rs = mysql_query($query);
		$n=0;
		while(list($id) = mysql_fetch_row($rs))
		{	
			$this->setType_id_array($id, $n);		
			$n = $n +1;
		}
		$this->setN_Type_id($n);	
	}		
	/// added for "not in" type search. Issue 151
	public function retrive_for_Not_In($flag,$Property_id,$val,$rel,$part)
    {
		$table=$this->getName_table();
		$table1 = "Property";
		$table2 = "Type";
	    if ($flag ==1 )
		$query = "SELECT DISTINCT eptr.Type_id  FROM $table eptr
                  JOIN ($table1 p, $table2 t) ON (eptr.Property_id = p.id AND eptr.Type_id = t.id)
	              WHERE p.subject = '$part'  and Property_id = '$Property_id'
				  and Type_id not in 
	             (SELECT DISTINCT eptr.Type_id
                 FROM EvidencePropertyTypeRel eptr
                 JOIN ($table1 p, $table2 t) ON (eptr.Property_id = p.id AND eptr.Type_id = t.id)
	             WHERE subject = '$part'  and predicate  = 'in' AND object = '$val')";
		else
		$query = "SELECT DISTINCT eptr.Type_id  FROM $table eptr
                  JOIN ($table1 p, $table2 t) ON (eptr.Property_id = p.id AND eptr.Type_id = t.id)
	              WHERE p.subject = '$part'  and Property_id = '$Property_id'
				  and Type_id not in 
	             (SELECT DISTINCT eptr.Type_id
                 FROM EvidencePropertyTypeRel eptr
                 JOIN ($table1 p, $table2 t) ON (eptr.Property_id = p.id AND eptr.Type_id = t.id)
	             WHERE subject = '$part'  and predicate  = 'in' AND object like '%$val%')";
					 
		$rs = mysql_query($query);
		$n=0;
		while(list($id) = mysql_fetch_row($rs))
		{	
			$this->setType_id_array($id, $n);		
			$n = $n +1;
		}
		$this->setN_Type_id($n);	
	}		

	public function retrive_evidence_id($Property_id, $type_id)
    {
		$table=$this->getName_table();
	
		$query = "SELECT DISTINCT Evidence_id,linking_quote FROM $table WHERE Property_id = '$Property_id' AND Type_id = '$type_id'";
		$rs = mysql_query($query);
		$n=0;
		while(list($id,$linking_quote) = mysql_fetch_row($rs))
		{			
			$this->setEvidence_id_array($id, $n);
			$this->setLinking_quote_array($linking_quote, $n);
			$n = $n +1;
		}
		$this->setN_evidence_id($n);	
	}	

	public function retrive_evidence_id1($Property_id)
    {
		$table=$this->getName_table();
	
		$query = "SELECT DISTINCT Evidence_id FROM $table WHERE Property_id = '$Property_id'";
		$rs = mysql_query($query);
		$n=0;
		while(list($id) = mysql_fetch_row($rs))
		{			
			$this->setEvidence_id_array($id, $n);		
			$n = $n +1;
		}
		$this->setN_evidence_id($n);	
	}	

	public function retrive_evidence_id2($type_id)
    {
		$table=$this->getName_table();
	
		$query = "SELECT DISTINCT Evidence_id FROM $table WHERE Type_id = '$type_id'";
		$rs = mysql_query($query);
		$n=0;
		while(list($id) = mysql_fetch_row($rs))
		{			
			$this->setEvidence_id_array($id, $n);		
			$n = $n +1;
		}
		$this->setN_evidence_id($n);	
	}

	public function retrive_type_id_by_evidence($evidence_id)
    {
		$table=$this->getName_table();
	
		$query = "SELECT DISTINCT Type_id FROM $table WHERE Evidence_id = '$evidence_id'";
		$rs = mysql_query($query);
		$n=0;
		while(list($id) = mysql_fetch_row($rs))
		{			
			$this->setType_id_array($id, $n);		
			$n = $n +1;
		}
		$this->setN_Type_id($n);	
	}


	public function retrive_unvetted($type_id, $property_id)
    {
		$table=$this->getName_table();
	
		$query = "SELECT unvetted FROM $table WHERE Type_id = '$type_id' AND Property_id = '$property_id'";
		$rs = mysql_query($query);
		while(list($var) = mysql_fetch_row($rs))
		{			
			$this->setUnvetted($var);		
		}	
	}


  // STM get an Article_id by specifying the other three ids
	public function retrive_article_id($Property_id, $type_id, $evidence_id)
    {
		$table=$this->getName_table();
		$query = "SELECT DISTINCT Article_id FROM $table WHERE Property_id = '$Property_id' AND Type_id = '$type_id' AND Evidence_id = '$evidence_id'";
		$rs = mysql_query($query);
    $row = mysql_fetch_row($rs);
    $article_id = $row[0];
    return $article_id;
	}	



  // STM get a conflict_note by specifying Property and Type ids
  public function retrieve_conflict_note($property_id, $type_id) 
  {
		$table=$this->getName_table();
		$query = "SELECT DISTINCT conflict_note FROM $table WHERE Property_id = '$property_id' AND Type_id = '$type_id'";
		$rs = mysql_query($query);
		while(list($var) = mysql_fetch_row($rs))
		{			
			$this->setConflict_note($var);		
		}	
  }


	
	// SET -------------------------------------
 	public function setType_id_array($val1, $n)
    {
		  $this->_type_id_array[$n] = $val1;
    }

 	public function setProperty_id_array($val1, $n)
    {
		  $this->_Property_id_array[$n] = $val1;
    }

 	public function setEvidence_id_array($val1, $n)
    {
		  $this->_evidence_id_array[$n] = $val1;
    }
		
 	public function setN_Type_id($val1)
    {
		  $this->_n_type_id = $val1;
    }	

 	public function setN_Property_id($val1)
    {
		  $this->_n_Property_id = $val1;
    }

 	public function setN_evidence_id($val1)
    {
		  $this->_n_evidence_id = $val1;
    }
	
 	public function setUnvetted($val1)
    {
		  $this->_unvetted = $val1;
    }	
	
 	public function setConflict_note($val1)
    {
		  $this->_conflict_note = $val1;
    }
    
    public function setLinking_quote_array($val1, $n)
    {
    	$this->_n_linking_quote_array[$n] = $val1;
    }
    

	
		 	
	// GET ++++++++++++++++++++++++++++++++++++++	
    public function getType_id_array($i)
    {
    	return $this->_type_id_array[$i];
    }

    public function getProperty_id_array($i)
    {
    	return $this->_Property_id_array[$i];
    }

    public function getEvidence_id_array($i)
    {
    	return $this->_evidence_id_array[$i];
    }
		
    public function getN_Type_id()
    {
    	return $this->_n_type_id;
    }	

    public function getN_Property_id()
    {
    	return $this->_n_Property_id;
    }	

    public function getN_evidence_id()
    {
    	return $this->_n_evidence_id;
    }	
		
    public function getName_table()
    {
    	return $this->_name_table;
    }	
		
    public function getUnvetted()
    {
    	return $this->_unvetted;
    }			
	
    public function getConflict_note()
    {
    	return $this->_conflict_note;
    }		
	
    public function getLinking_quote_array($i)
    {
    	return $this->_n_linking_quote_array[$i];
    }	
			
}
?>	
