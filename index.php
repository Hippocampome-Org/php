<?php
include ("access_db.php");
include ("simphp-2.0.php");
$_SESSION['perm'] = 0;
$permission1 = $_SESSION['perm'];

if (array_key_exists('password', $_REQUEST))
{
  $query = "SELECT permission FROM user WHERE password = '{$_REQUEST['password']}'";
  $rs = mysql_query($query);
  while(list($permission) = mysql_fetch_row($rs))
  {
    if ($permission == 1)
    {	
      $permission1 = $permission;
      $_SESSION['perm'] = $permission1;
    }	
    else;
  }
}

// delete temporary table for the research: -----------------
include ("function/remove_table_research.php");
remove_table_by_tyme();
// ------------------------------------------------------------
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html" />
<script type="text/javascript" src="style/resolution.js"></script>
<?php include ("function/icon.html"); ?>
<title>Hippocampome</title>

</head>

<body>

  <?php include ("function/title.php"); ?>

<?php 
if ($permission1 != 0)
{
?>	
  <div id="menu_main_button_new">
  <form action="morphology.php" method="post" style='display:inline'>
  <input type="submit" name='browsing' value='Browse' class="main_button"/> 
  </form>
  <form action="search.php" method="post" style='display:inline'>	
  <input type="submit" name='searching' value='Search' class="main_button" /> 
  </form>
  <form action="help.php" method="post" style='display:inline'>	
  <input type="submit" name='help' value='Help' class="main_button"/>
  </form>
  </div>
<?php
  }
?>	


  <br /><br /><br /><br /><br /><br /><br />


  <table width="85%" border="0" class='body_table'>
  <tr height="0">
  <td></td>
  </tr>
  <tr>		
  <td width="50%">
  <!-- ****************  BODY **************** -->
  <!--						
  <script type="text/javascript">
      if ((w == 1280) && (h == 1024))
      {
        document.write("<img src='images/welcome.gif' width='450px'/>");
      }
      else if ((w == 1280) && (h == 800))
      {
        document.write("<img src='images/welcome.gif'/ width='450px'>");
      }			
      else if ((w == 1680) && (h == 1050))
      {
        document.write("<img src='images/welcome.gif' width='550px'/>");
      }				
      else if ((w == 1152) && (h == 864))
      {
        document.write("<img src='images/welcome.gif' width='500px'/>");
      }		
      else if ((w == 1024) && (h == 768))
      {
        document.write("<img src='images/welcome.gif' width='350px'/>");
      }						
      else
      {
        document.write("<img src='images/welcome.gif' />");
      }			
      </script>				
-->

      <font class='font1' color='#000000'>
      WELCOME TO THE HIPPOCAMPOME PORTAL
      </font>
      <BR>
      <font class='font2' color='#000000'>
      <br>
      The Hippocampome is a curated knowledge base of the circuitry
      of the hippocampus of normal adult, or adolescent, rodents at
      the mesoscopic level of neuronal types. Knowledge concerning
      dentate gyrus, CA3, CA2, CA1, subiculum, and entorhinal cortex
      is distilled from published evidence and is continuously updated
      as new information becomes available. Each reported neuronal
      property is documented with a pointer to, and excerpt from,
      relevant published evidence, such as citation quotes or illustrations.
      <br><br>
      The goal of the Hippocampome is dense coverage of available data
      characterizing neuronal types. The Hippocampome is a public and
      free resource for the neuroscience community, and the knowledge
      is presented for user-friendly browsing and searching and for
      machine-readable downloading.
      <br><br>
      *** Please note: This is an alpha-testing site.  The content is
      still being vetted for accuracy and has not yet undergone peer-review.
      As such, it may contain inaccuracies and should not (yet) be trusted
      as a scholarly resource.  The content does not yet appear uniformly
      across all combinations of browsers and screen resolutions.
      <br><br>
      If you have feedback on either functionality or content, or if you
      would like to be informed when the first official version is released,
      please email us at <a href="mailto:Hippocampome.org@gmail.com">Hippocampome.org@gmail.com</a>.

      </font>

      <br><br>

<?php
      if ($permission1 == 0)
      {
?>
  <form action="index.php" method="post">
  <font class='font2'> Please insert password: </font><br />
  <input type="password" size="50" name='password' class='select1'/>
  <input type="submit" name='ok' value=' OK ' />
  </form>
<?php
      }
      else;
?>
  <br>

  </td>

  <td width="50%">
  <div class='image_brain'>
  <script type="text/javascript">
      if ((w == 1280) && (h == 1024))
      {
        document.write("<img src='images/brain3.gif' width='450px'/>");
      }
      else if ((w == 1280) && (h == 800))
      {
        document.write("<img src='images/brain3.gif' width='450px'/>");  // change in future
      }		
      else if ((w == 1680) && (h == 1050))
      {
        document.write("<img src='images/brain3.gif' width='500px'/>");
      }			
      else if ((w == 1152) && (h == 864))
      {
        document.write("<img src='images/brain3.gif' width='400px'/>");
      }	
      else if ((w == 1024) && (h == 768))
      {
        document.write("<img src='images/brain3.gif' width='350px'/>");
      }					
      else
      {
        document.write("<img src='images/brain3.gif' width='500px'/>");
      }			
      </script>	

      </div>
    </td>

    </tr>

    <tr>
    <td colspan="2">
        <!--			<div class='version'> -->
        <div class='version2'>
          <!--	<a href='http://peg.gd/2yN' target="_blank">http://peg.gd/2yN</a> -->
          <br><br>
          <hr class='hr2'/>
          <font class='font3' color='#000000'>
            NOTICE: Non-licensed copyrighted content that may be incorporated into this not-for-profit, educational web portal was vetted using the "fair use" criteria defined in <a href="http://www.copyright.gov/title17/92chap1.html#107" target="_blank">Title 17 of the U.S. Code, § 107</a>. This content, cited throughout this portal, may be protected by Copyright Law and unavailable for reuse.  Except otherwise noted, this web portal is &copy; 2013 by George Mason University, under a <a href =' http://creativecommons.org/licenses/by-sa/3.0/' target="_blank">Creative Commons Attribution-ShareAlike [CC BY-SA] license</a>. 

          <br /><p><? echo $info; ?>
          <br />Last Update: 3 June 2013 (<a href="Help_Release_Notes.php">v1.0&alpha; R 3A</a>)</font>
          <br />
        </div>
    </td>		
    </tr>
  </table>

</body>
</html>
