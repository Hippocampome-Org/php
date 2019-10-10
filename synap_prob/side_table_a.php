<table border="0" cellspacing="5">
        <tr height="50" style='vertical-align:top'>
          <td colspan="2" style="text-align:center"><font class='font5'>View the entire matrix as a <a href='images/connectivity/Connectivity_Matrix.jpg' target='_blank'>.jpg image</a></font></td>        
        </tr>
        <tr height="100" style='vertical-align:top'>
          <td colspan="2" style="text-align:center">
            <script src="https://www.java.com/js/deployJava.js"></script>
              <script>
                var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
                if (isChrome) {
                  document.write("<font class='font5'>View the <a href=\"connectivity/applications/connectivity_map.jnlp\">Potential Synaptome Map</a> (Java)");
                  document.write("<br><br>(If trouble launching, view <a href=\"Help_ConnectivityJava.php\" target=\"_blank\">help</a>)</font>");
                }
                else {
                  document.write("<font class='font5'>View the Potential Synaptome Map (JAVA)");
                    
                    // use JavaScript to get location of JNLP file relative to HTML page
                    var dir = location.href.substring(0, location.href.lastIndexOf('/')+1);
                    var url = dir + "connectivity/applications/connectivity_map.jnlp";
                    deployJava.createWebStartLaunchButton(url, '1.7.0');
                    document.write("<br><br>If trouble launching, view <a href=\"Help_ConnectivityJava.php\" target=\"_blank\">help</a></font>");
                }
              </script>           
            </td>         
        </tr>
        <tr height="50">
          <td colspan="2" style="text-align:center"><font class='font7'>Download</font></td>
        </tr>
        <tr height="20">
          <td style="text-align:center"><a href="#"><img id="csvCN" src='images/ExportCSV.png' width="30px" border="0"/></a></td>
          <td><font class='font5'>Netlist</font></td>
          <td></font></td> 
          <!--td align="right"><font class='font5'><p id="cle2"></p></font></td-->
        </tr>
       
        <tr height="50">
          <td colspan="2" style="text-align:center"><font class='font7'>Legend</font></td>
        </tr>
        <tr height="20">
          <!-- <td width="10"><img src='images/connectivity/excitatory.png' width="13px" border="0"/></td>  -->
          <td bgcolor=#000000></td>
          <td><font class='font5'>Potential Excitatory Connections</font></td>
          <td align="right"><font class='font5'><p id="Potential_Excitatory_Non_PCL"></p></font></td>
          <!--td align="right"><font class='font5'><p id="cle3"></p></font></td-->
        </tr>
        <tr height="20">
          <!-- <td><img src='images/connectivity/inhibitory.png' width="13px" border="0"/></td>  -->
          <td bgcolor=#AAAAAA></td>
          <td><font class='font5'>Potential Inhibitory Connections</font></td>
          <td align="right"><font class='font5'><p id="Potential_Inhibitory_Non_PCL"></p></font></td> 
          <!--td align="right"><font class='font5'><p id="cle5"></p></font></td-->
        </tr>
        <!--
        <tr>
          < ! -- <td><img src='images/connectivity/PCL_only.png' width="13px" border="0"/></td>  -- >
          <td bgcolor=#FF8C00></td>
          <td><font class='font5'>Potential Inhibitory PCL-Only Connection</font></td>
          <td align="right"><font class='font5'><p id="PCL_Only"></p>0</font></td>
        </tr>
        -->
        <tr height="20">
          <td style="text-align:center"><img src='images/connectivity/known_connection.png' width="20px" border="0"/></td>
          <td><font class='font5'>Known Connections</font></td>
          <td align="right"><font class='font5'><p id="id_knowncount"></p></font></td>
          <!--td align="right"><font class='font5'><p id="cle"></p></font></td-->
        </tr>
        <tr height="20">
          <td style="text-align:center"><img src='images/connectivity/known_nonconnection.png' width="20px" border="0"/></td>
          <td><font class='font5'>Refuted Connections</font></td>
          <td align="right"><font class='font5'><p id="id_Unknowncount"></p></font></td> 
          <!--td align="right"><font class='font5'><p id="cle2"></p></font></td-->
        </tr>
      </table>