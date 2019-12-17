<?php
/*
reference: https://stackoverflow.com/questions/8754080/how-to-get-exact-browser-name-and-version
*/
function getBrowser() { 
  $u_agent = $_SERVER['HTTP_USER_AGENT'];
  $ub = 'Unknown';
  $platform = 'Unknown';
  $version= ""; 
  $css_vertical= ""; 
  $first_cell_vert= "";
  $first_cell_horiz= "";
  $fixed_table_a_d_l = "";
  $fixed_table_s_d = "";  
  $cell_1x1_label1a = "";
  $cell_1x1_label1b = "";
  $cell_1x1_label2a = "";  
  $cell_1x1_label2b = "";  
  //First get the platform?
  if (preg_match('/linux/i', $u_agent)) {
    $platform = 'linux';
  }elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
    $platform = 'mac';
  }elseif (preg_match('/windows|win32/i', $u_agent)) {
    $platform = 'windows';
  }  
  // Next get the name of the useragent
  if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){
    $bname = 'Internet Explorer';
    $ub = "MSIE";
  }elseif(preg_match('/Firefox/i',$u_agent)){
    $bname = 'Mozilla Firefox';
    $ub = "Firefox";
  }elseif(preg_match('/OPR/i',$u_agent)){
    $bname = 'Opera';
    $ub = "Opera";
  }elseif(preg_match('/Chrome/i',$u_agent) && !preg_match('/Edg/i',$u_agent)){
    $bname = 'Google Chrome';
    $ub = "Chrome";
  }elseif(preg_match('/Safari/i',$u_agent) && !preg_match('/Edg/i',$u_agent)){
    $bname = 'Apple Safari';
    $ub = "Safari";
  }elseif(preg_match('/Netscape/i',$u_agent)){
    $bname = 'Netscape';
    $ub = "Netscape";
  }elseif(preg_match('/Edg/i',$u_agent)){
    $bname = 'Edge';
    $ub = "Edge";
  }elseif(preg_match('/Trident/i',$u_agent)){
    $bname = 'Internet Explorer';
    $ub = "MSIE";
  }else{
    $bname = 'Google Chrome';
    $ub = "Chrome";
  }  
  // finally get the correct version number
  $known = array('Version', $ub, 'other');
  $pattern = '#(?<browser>' . join('|', $known) .
')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
  if (!preg_match_all($pattern, $u_agent, $matches)) {
    // we have no matching number just continue
  }
  // see how many we have
  $i = count($matches['browser']);
  if ($i != 1) {
    //we will have two since we are not using 'other' argument yet
    //see if version is before or after the name
    if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
        $version= $matches['version'][0];
    }else {
        $version= $matches['version'][1];
    }
  }else {
    $version= $matches['version'][0];
  }

  // check if we have a number
  if ($version==null || $version=="") {$version="?";}

  if ($ub=='Chrome' || $ub=='Firefox' || $ub=='Netscape') {
  	$css_vertical = 'vertical';
  	$first_cell_vert = 'vertical_fc';
  	$first_cell_horiz = 'horizontal_fc';
    $fixed_table_a_d_l = 'fixed_table fixed_table_a_d_l_chrome';
    $fixed_table_s_d = 'fixed_table fixed_table_s_d_chrome';
    if ($platform == 'windows') {
      $fixed_table_a_d_l = 'fixed_table fixed_table_a_d_l_chrome_win';
    }
    if ($ub=='Firefox' || $ub=='Netscape') {
      $fixed_table_a_d_l = 'fixed_table fixed_table_a_d_l_Firefox';
    }   
    $cell_1x1_label1a = 'cell_1x1_label1a_chrome';
    $cell_1x1_label1b = 'cell_1x1_label1b_chrome';
    $cell_1x1_label2a = 'cell_1x1_label2a_chrome';
    $cell_1x1_label2b = 'cell_1x1_label2b_chrome';
    if ($platform == 'windows') {
      $cell_1x1_label1a = 'cell_1x1_label1a_chrome_win';
      $cell_1x1_label1b = 'cell_1x1_label1b_chrome_win';
      $cell_1x1_label2a = 'cell_1x1_label2a_chrome_win';
      $cell_1x1_label2b = 'cell_1x1_label2b_chrome_win';
    }
  }
  if ($ub=='MSIE') {
  	$css_vertical = 'verticalIE';
  	$first_cell_vert = 'vertical_fcIE';
  	$first_cell_horiz = 'horizontal_fcIE';
    $fixed_table_a_d_l = 'fixed_table fixed_table_a_d_l_MSIE';
    $fixed_table_s_d = 'fixed_table fixed_table_s_d_MSIE';    
    $cell_1x1_label1a = 'cell_1x1_label1a_MSIE';
    $cell_1x1_label1b = 'cell_1x1_label1b_MSIE';
    $cell_1x1_label2a = 'cell_1x1_label2a_MSIE';
    $cell_1x1_label2b = 'cell_1x1_label2b_MSIE';
  }
  if ($ub=='Edge') {
    $css_vertical = 'vertical';
    $first_cell_vert = 'vertical_fc';
    $first_cell_horiz = 'horizontal_fc';
    $fixed_table_a_d_l = 'fixed_table fixed_table_a_d_l_Edge';
    $fixed_table_s_d = 'fixed_table fixed_table_s_d_Edge'; 
    $cell_1x1_label1a = 'cell_1x1_label1a_Edge';
    $cell_1x1_label1b = 'cell_1x1_label1b_Edge';
    $cell_1x1_label2a = 'cell_1x1_label2a_Edge';
    $cell_1x1_label2b = 'cell_1x1_label2b_Edge';
  }
  if ($ub=='Safari') {
  	$css_vertical = 'verticalSafari';
  	$first_cell_vert = 'vertical_fcSafari';
  	$first_cell_horiz = 'horizontal_fcSafari';
    $fixed_table_a_d_l = 'fixed_table fixed_table_a_d_l_Safari';
    $fixed_table_s_d = 'fixed_table fixed_table_s_d_Safari';
    $cell_1x1_label1a = 'cell_1x1_label1a_Safari';
    $cell_1x1_label1b = 'cell_1x1_label1b_Safari';
    $cell_1x1_label2a = 'cell_1x1_label2a_Safari';
    $cell_1x1_label2b = 'cell_1x1_label2b_Safari';     
  }
  if ($ub=='Opera') {
  	$css_vertical = 'verticalOpera';
  	$first_cell_vert = 'vertical_fc';
  	$first_cell_horiz = 'horizontal_fc';
    $fixed_table_a_d_l = 'fixed_table fixed_table_a_d_l_chrome';
    $fixed_table_s_d = 'fixed_table fixed_table_s_d_chrome';    
  }      

  return array(
    'userAgent' => $u_agent,
    'name'      => $ub,
    'version'   => $version,
    'platform'  => $platform,
    'pattern'    => $pattern,
    'css_vertical' => $css_vertical,
    'first_cell_vert' => $first_cell_vert,
    'first_cell_horiz' => $first_cell_horiz,
    'fixed_table_a_d_l' => $fixed_table_a_d_l,
    'fixed_table_s_d' => $fixed_table_s_d,
    'cell_1x1_label1a' => $cell_1x1_label1a,
    'cell_1x1_label1b' => $cell_1x1_label1b,
    'cell_1x1_label2a' => $cell_1x1_label2a,
    'cell_1x1_label2b' => $cell_1x1_label2b
  );
}
/*$browser_name = getBrowser();
echo $browser_name['name'];*/
?>