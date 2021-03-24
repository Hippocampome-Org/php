<?php
  $subject = 1;
  $dimension = 1;
  $property = 1;
  if ($_POST['form_submitted']=='1') {
    $subject = $_POST['subject'];
    $dimension = $_POST['dimension'];
    $property = $_POST['property'];
  }
  $dim_id = '';
  $dim_desc = '';
  $dim_relation = '';
  $article_id = 'article_id';
  switch($dimension) {
    case 1: $dim_id = 'detail_id'; 
    $dim_desc = 'Level of Detail';
    $dim_relation = 'article_has_detail'; break;
    case 2: $dim_id = 'level_id'; 
    $dim_desc = 'Level of Implementation';
    $dim_relation = 'article_has_implmnt'; break;
    case 3: $dim_id = 'theory_id';
    $dim_desc = 'Theory'; 
    $dim_relation = 'article_has_theory'; break;
    case 4: $dim_id = 'keyword_id'; 
    $dim_desc = 'Keyword';
    $dim_relation = 'article_has_keyword'; break;
    case 5: $dim_id = 'theory_id_1'; 
    $dim_desc = 'Theory Competition';
    $dim_relation = 'theory_has_competition'; break;    
  }
  switch($property) {
    case 1: $prop_id = 'id'; 
    $prop_desc = 'All';
    $prop_relation = 'articles'; break;
    case 2: $prop_id = 'authors'; 
    $prop_desc = 'Authors';
    $prop_relation = 'articles'; break;
    case 3: $prop_id = 'year';
    $prop_desc = 'Year'; 
    $prop_relation = 'articles'; break;
    case 4: $prop_id = 'title'; 
    $prop_desc = 'Title';
    $prop_relation = 'articles'; break;
    case 5: $prop_id = 'url'; 
    $prop_desc = 'Url';
    $prop_relation = 'articles'; break;  
    case 6: $prop_id = 'theory'; 
    $prop_desc = 'Theory Notes';
    $prop_relation = 'articles'; break;
    case 7: $prop_id = 'modeling_methods';
    $prop_desc = 'Modeling Methods'; 
    $prop_relation = 'articles'; break;
    case 8: $prop_id = 'journal'; 
    $prop_desc = 'Journal';
    $prop_relation = 'articles'; break;
    case 9: $prop_id = 'citation'; 
    $prop_desc = 'Citation';
    $prop_relation = 'articles'; break;       
  }  
?>