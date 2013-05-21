<?php

function result_set_to_array($result_set, $field="all") {
  $records = array();
  while($record = mysql_fetch_assoc($result_set)) {
    if ($field == "all") {  // extract a particular field
      $records[] = $record;
    } else {
      $records[] = $record[$field];
    }
  }
  return $records;
}

function to_name($record) {
  $name = $record["subregion"] . ' ' . $record["nickname"];
  return $name;
}

function quote_for_mysql($str) {
  $quoted = "'$str'";
  return $quoted;
}

// takes a set of type_ids and returns their records sorted by position
function get_sorted_records($type_ids) {  // used to sort type records
        $quoted_ids = array_map("quote_for_mysql", $type_ids);
        $query = "SELECT * FROM Type WHERE id IN (" . implode(', ', $quoted_ids) . ') ORDER BY position';
        $result = mysql_query($query);
        $records = result_set_to_array($result);
        //$names = array_map("to_name", $records);
        return $records;
      }

// returns a set of type_ids that have either axons or dendrites in an array of parcels
function filter_types_by_morph_property($axon_dendrite, $parcel_array) {
  global $morphology_properties_query;
  $quoted_parcels = array_map("quote_for_mysql", $parcel_array);
  $query = $morphology_properties_query . " AND status = 'active' AND subject = '$axon_dendrite'" . " AND object IN " . '(' . implode(', ', $quoted_parcels) . ')';
  //print "<br><br>TYPE FILTERING QUERY:<br>"; print_r($query);
  $result = mysql_query($query);
  $ids = result_set_to_array($result, "Type_id");
  return $ids;
}

?>
