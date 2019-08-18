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
?>