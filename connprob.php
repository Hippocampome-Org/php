<?php
  include ("permission_check.php");
?>
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<!--
Probability of Connection Tool

Reference: https://stackoverflow.com/questions/7431268/how-to-read-data-from-csv-file-using-javascript
https://stackoverflow.com/questions/5316697/jquery-return-data-after-ajax-call-success
-->
<head>
    <meta charset="UTF-8">
    <title>Probability of Connection Tool</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://d3js.org/d3.v5.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.1/build/pure-min.css" integrity="sha384-oAOxQR6DkCoMliIh8yFnu25d7Eq/PHS21PClpwjOTeU2jRSq11vu66rf90/cZr47" crossorigin="anonymous">
    <link rel="stylesheet" href="function/menu_support_files/menu_main_style.css" type="text/css" />
    <script type="text/javascript" src="style/resolution.js"></script>
</head>
<body>

<?php 
include("function/title.php");
include("function/menu_main.php");  
?> 
<div id="main" class="main" style="padding-top: 1%; padding-left: 1%">
    <form id="conn_form" class="pure-form" onsubmit="return false;">
        <fieldset>
            <h2>Probability of connection</h2>
            <table>
                <tr>
                   <td>Presynaptic</td>
                    <td>
                        <?php
                            if (isset($_REQUEST["source"])) {
                                echo "<select id='source' name='source' onchange='sourceSelected()' value='".$_REQUEST["source"]."'></select>";
                            }
                            else {
                                echo "<select id='source' name='source' onchange='sourceSelected()' disabled></select>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Postsynaptic</td>
                    <td>
                        <?php
                            if (isset($_REQUEST["target"])) {
                                echo "<select id='target' name='target' onchange='targetSelected()' value='".$_REQUEST["target"]."'></select>";
                            }
                            else {
                                echo "<select id='target' name='target' onchange='targetSelected()' disabled></select>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td> Dendritic spine distance (μm)</td>
                    <td>
                        <?php
                            if (isset($_REQUEST["spine_distance"])) {
                                echo "<input id='spine_distance' name='spine_distance' type='text' value='".$_REQUEST["spine_distance"]."' />";
                            }
                            else {
                                echo "<input id='spine_distance' name='spine_distance' type='text' value='1.09' disabled />";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td> Inter-bouton distance (μm)</td>
                    <td>
                        <?php
                            if (isset($_REQUEST["bouton_distance"])) {
                                echo "<input id='bouton_distance' name='bouton_distance' type='text' value='".$_REQUEST["bouton_distance"]."' />";
                            }
                            else {
                                echo "<input id='bouton_distance' name='bouton_distance' type='text' value='6.2' disabled />";
                            }
                        ?>
                    </td>
                </tr>
                <!-- tr>
                    <td>Number of contacts</td>
                    <td> <input id="contacts" type="text" disabled></td>
                </tr -->
                <input id="contacts" type="hidden" />
                <tr>
                    <td>Radius of interaction (μm)</td>
                    <td>
                        <?php
                            if (isset($_REQUEST["interaction"])) {
                                echo "<input id='interaction' name='interaction' type='text' value='".$_REQUEST["interaction"]."' />";
                            }
                            else {
                                echo "<input id='interaction' name='interaction' type='text' value='2' disabled />";
                            }
                        ?>
                    </td>
                </tr>
            </table>
            <input type="hidden" id="source_id" name="source_id" value="" />
            <input type="hidden" id="target_id" name="target_id" value="" />
            <?php
                echo "<button id='s' name='conn_submit' class='pure-button pure-button-primary' onclick='submitClicked()' ";
                if (isset($_REQUEST["conn_submit"])) {
                    // no output
                }
                else {
                    echo "disabled";
                }
                echo " style='z-index:10;'>Submit</button>";
            ?>
        </fieldset>
    </form>
    <div id="title1" style="position:relative;top:60px;display: none;z-index:5"><center>Probability of Connection Per Neuron Pair</center></div>
    <div id="graph" style="height:300px;position:relative;top:-20px;z-index:1"></div>
    <div id="title2" style="position:relative;bottom:100px;display: none;z-index:5"><center>Number of Contacts Per Connected Neuron Pair</center></div>
    <div id="graph_noc" style="height:300px;position:relative;top:-180px;z-index:1"></div>
</div>
    <script>
        let connDic = {};
        let sourceIDDic = {};
        let targetIDDic = {};
        function calc_values(data_1,volume_data,volumes_index,columnNames_index) {
            let source = document.getElementById("source").value.trim();
            let target = document.getElementById("target").value.trim();
            let source_id = sourceIDDic[source];
            let target_id = targetIDDic[target];
            let dict = new Map();
            let vol_dict = new Map();
            let datav = data_1.split(/\r?\n|\r/);
            let vol_datav = volume_data;//.split(/\r?\n|\r/);
            let volumes = datav[volumes_index].split(",").slice(2).map(function(item) {
                    var value = parseFloat(item);
                    if(isNaN(value)) return 0;
                    return value;
            });
            let vol_volumes = vol_datav[volumes_index].split(",").slice(2).map(function(vol_item) {
                    var vol_value = parseFloat(vol_item);
                    if(isNaN(vol_value)) return 0;
                    return vol_value;
            });
            let columnNames = datav[columnNames_index].split(",").slice(1)
            let vol_columnNames = vol_datav[columnNames_index].split(",").slice(1)
            for(let count = 2; count<datav.length-1; count=count+2)
            {
                let rowData = datav[count].split(",");
                let volRowData = vol_datav[count].split(",");
                let nextRowData = datav[count+1].split(",");
                let volNextRowData = vol_datav[count+1].split(",");
                let key = rowData[1];
                let firstRowData =rowData.slice(2).map(function(item) {
                    var value = parseFloat(item);
                    if(isNaN(value)) return 0;
                    return value;
                });
                let volFirstRowData = volRowData.slice(2).map(function(vol_item) {
                    var vol_value = parseFloat(vol_item);
                    if(isNaN(vol_value)) return 0;
                    return vol_value;
                });
                let secondRowData = nextRowData.slice(2).map(function(item) {
                    var value = parseFloat(item);
                    if(isNaN(value)) return 0;
                    return value;
                });
                let volSecondRowData = volNextRowData.slice(2).map(function(vol_item) {
                    var vol_value = parseFloat(vol_item);
                    if(isNaN(vol_value)) return 0;
                    return vol_value;
                });
                if(key!=="") {
                    dict.set(key, new Neuron(firstRowData, secondRowData, volumes, columnNames));
                    vol_dict.set(key, new Neuron(volFirstRowData, volSecondRowData, vol_volumes, columnNames));
                }
            }
            let spine_distance = parseFloat(document.getElementById("spine_distance").value);
            let bouton_distance = parseFloat(document.getElementById("bouton_distance").value);
            let interaction = parseFloat(document.getElementById("interaction").value);
            let contacts = parseFloat(document.getElementById("contacts").value);       
            let vint = (4.0 / 3) * Math.PI * Math.pow(interaction, 3);
            let c = vint /(spine_distance*bouton_distance);
            dict.get(source_id).columnNames.push("Total");
            dict.get(source_id).columnNames.shift();
            let volumes_array = dict.get(source_id).volumes;
            let length_axons =  dict.get(source_id).axons;
            let length_dendrites = dict.get(target_id).dendrites;
            let volume_axons =  vol_dict.get(source_id).axons;
            let volume_dendrites = vol_dict.get(target_id).dendrites;
            let final_result = [];
            let final_result_noc = [];
            let num_contacts = [];
            let final_result_val = "";
            let noc_non_zero = 0;
            for (var i = 0; i < length_axons.length; i++) {
                if (isNaN(length_axons[i])){length_axons[i]=0;}
                if (isNaN(length_dendrites[i])){length_dendrites[i]=0;}
                if (isNaN(volume_axons[i])){volume_axons[i]=0;}
                if (isNaN(volume_dendrites[i])){volume_dendrites[i]=0;}                
                let noc = (4 * c * length_axons[i] * length_dendrites[i]) / (volume_axons[i] + volume_dendrites[i]);
                if (isNaN(noc)){noc=0;} 
                if (noc!=0) {
                    noc_non_zero = noc_non_zero + 1;
                }
            }
            for (var i = 0; i < length_axons.length; i++) {
                if (isNaN(length_axons[i])){length_axons[i]=0;}
                if (isNaN(length_dendrites[i])){length_dendrites[i]=0;}
                if (isNaN(volume_axons[i])){volume_axons[i]=0;}
                if (isNaN(volume_dendrites[i])){volume_dendrites[i]=0;}
                let noc = (4 * c * length_axons[i] * length_dendrites[i]) / (volume_axons[i] + volume_dendrites[i]);
                if (isNaN(noc)){noc=0;} 
                if (noc!=0) {
                    num_contacts[i] = (1 / noc_non_zero) + (4 * c * length_axons[i] * length_dendrites[i]) / (volume_axons[i] + volume_dendrites[i]);
                }
                if (isNaN(num_contacts[i])) {num_contacts[i] = 0;}
                if (!isFinite(num_contacts[i])) {num_contacts[i] = 0;}
                final_result_noc.push(num_contacts[i].toPrecision(3));                
                let final_result_val = (c * ((length_axons[i] * length_dendrites[i]) / volumes_array[i])) / num_contacts[i];
                if (isNaN(final_result_val)) {final_result_val = 0;}
                final_result.push(final_result_val.toPrecision(4));
            }
            /* compute totals */
            // probability
            var p_tally = 1;
            for (var pi = 0; pi < length_axons.length; pi++) {
                if (!isNaN(final_result[pi])) {
                    p_tally = p_tally * (1 - final_result[pi]);
                }
            }
            // parseFloat( .toString()) is for avoiding a trailing 0
            final_result.push(parseFloat(1 - p_tally).toPrecision(4).toString());
            // noc
            var n_tally = 0;
            for (var ni = 0; ni < length_axons.length; ni++) {
                if (!isNaN(final_result_noc[ni])) {
                    n_tally = n_tally + parseFloat(final_result_noc[ni]);
                }
            }
            //let noc_final = parseFloat(n_tally.toPrecision(3));
            //final_result_noc.push(noc_final.toString());
            final_result_noc.push(n_tally.toPrecision(3).toString());

            var value_results = new Array();
            value_results.push(dict, final_result, final_result_noc, source_id);

            return value_results;
        }
        function parse(data_1,volume_data,volumes_index,columnNames_index){
            var value_results = calc_values(data_1,volume_data,volumes_index,columnNames_index);
            dict = value_results[0];
            final_result = value_results[1];
            final_result_noc = value_results[2];
            source_id = value_results[3];

            /* generate tables */
            let cname = Array.from(dict.get(source_id).columnNames, x => [x]);
            let result = Array.from(final_result, x => [x]);
            let result_noc = Array.from(final_result_noc, x => [x]);
            document.getElementById('title1').style.display='block';
            let cp_text = "<center>Number of Contacts Per Connected Neuron Pair<table style='text-align:center;border: 1px solid black;'><tr>";
            for (let i = 0; i < cname.length; i++) {
              cp_text += "<td style='padding: 15px;'>"+cname[i]+'</td>';
            }
            cp_text += '</tr><tr>';
            for (let i = 0; i < result.length; i++) {
              cp_text += "<td style='padding: 15px;'><a title='test1' style='text-decoration:none;color:black;'>"+result[i]+'</a></td>';
            }
            cp_text += '</tr></table></center>';
            document.getElementById('title1').innerHTML = cp_text;
            document.getElementById('title2').style.display='block';
            let noc_text = "<center>Number of Contacts Per Connected Neuron Pair<table style='text-align:center;border: 1px solid black;'><tr>";
            for (let i = 0; i < cname.length; i++) {
              noc_text += "<td style='padding: 15px;'>"+cname[i]+'</td>';
            }
            noc_text += '</tr><tr>';
            for (let i = 0; i < result.length; i++) {
              noc_text += "<td style='padding: 15px;'>"+final_result_noc[i]+'</td>';
            }
            noc_text += '</tr></table></center>';
            document.getElementById('title2').innerHTML = noc_text;
        }
        function readData(url,volume_data,volumes_index,columns_index){
            $.ajax({
                url:url,
                dataType:"text",
                success:[function(data){
                   parse(data,volume_data,volumes_index,columns_index);
                }]
            });
        }
        <?php
            function get_volumes($filename) {
                $csv_file = array_map('str_getcsv', file($filename));
                for ($i = 0; $i < count($csv_file); $i++) {
                    if (count($csv_file[$i])>0) {
                        $line = $csv_file[$i][0];
                        for ($j = 1; $j < count($csv_file[$i]); $j++) {
                            $line = $line.",".$csv_file[$i][$j];
                        }
                        echo "volume_data.push(\"".$line."\");";
                    }
                }   
            }     
        ?>
        function readVolumes(url){
            var volume_data = [];
            if (url == 'data/CA1-Table-2.csv') {
                <?php get_volumes('data/CA1-Table-2.csv'); ?>
            }
            else if (url == 'data/CA2-Table-2.csv') {
                <?php get_volumes('data/CA2-Table-2.csv'); ?>
            }
            else if (url == 'data/CA3-Table-2.csv') {
                <?php get_volumes('data/CA3-Table-2.csv'); ?>
            }
            else if (url == 'data/DG-Table-2.csv') {
                <?php get_volumes('data/DG-Table-2.csv'); ?>
            }
            else if (url == 'data/EC-Table-2.csv') {
                <?php get_volumes('data/EC-Table-2.csv'); ?>
            }
            else if (url == 'data/Sub-Table-2.csv') {
                <?php get_volumes('data/Sub-Table-2.csv'); ?>
            }
            //document.getElementById("interaction").value=vol_data;
            return volume_data;
        }  
        function createTables() {
            <?php
                $axon_group = array();
                $dendrite_group = array();
                if (isset($_REQUEST["source"])) {
                    echo "document.getElementById('source').value='".$_REQUEST["source"]."';";
                    $sql_general = "SELECT unique_id, sl.sub_layer as subregion, SUBSTRING_INDEX(SUBSTRING_INDEX(neurite,':',2),':',-1) as parcel, SUBSTRING_INDEX(neurite,':',-1) as neurite, filtered_total_length as length, convexhull as volume FROM neurite_quantified as nq, SynproSubLayers as sl WHERE nq.unique_id!='' AND nq.filtered_total_length != 0 AND nq.filtered_total_length != '' AND nq.neurite not like '%:All:%' AND nq.convexhull != 0 AND nq.convexhull != '' AND nq.unique_id = sl.neuron_id";
                    $sql    = $sql_general." AND unique_id = ".$_REQUEST["source_id"];
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $entry = array();
                            array_push($entry, $row['unique_id']);
                            array_push($entry, $row['subregion']);
                            array_push($entry, $row['parcel']);
                            array_push($entry, $row['neurite']);
                            array_push($entry, $row['length']);
                            array_push($entry, $row['volume']);
                            if ($row['neurite'] == "D") {
                                array_push($dendrite_group, $entry);
                            }
                        }
                    }
                    $sql    = $sql_general." AND unique_id = ".$_REQUEST["target_id"];
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $entry = array();
                            array_push($entry, $row['unique_id']);
                            array_push($entry, $row['subregion']);
                            array_push($entry, $row['parcel']);
                            array_push($entry, $row['neurite']);
                            array_push($entry, $row['length']);
                            array_push($entry, $row['volume']);
                            if ($row['neurite'] == "A") {
                                array_push($axon_group, $entry);
                            }
                        }
                    }
                }
            ?>

            let dendrite_lengths_group = Array();
            let dendrite_volumes_group = Array();
            let axon_lengths_group = Array();
            let axon_volumes_group = Array();
            <?php
                echo "let entry = Array();";
                echo "let entry2 = Array();";
                echo "let lengths_entry;";
                echo "let lengths_entry2;";
                echo "let volumes_entry;";
                echo "let volumes_entry2;";

                foreach ($dendrite_group as $entry) {
                    echo "entry = Array();";
                    foreach ($entry as $entry_value) {
                        echo "entry.push(\"".$entry_value."\");";
                    }
                    echo "lengths_entry = Array(entry[0], entry[1], entry[2], entry[3], entry[4]);";
                    echo "volumes_entry = Array(entry[0], entry[1], entry[2], entry[3], entry[5]);";
                    echo "dendrite_lengths_group.push(lengths_entry);";
                    echo "dendrite_volumes_group.push(volumes_entry);";
                }
                foreach ($axon_group as $entry2) {
                    echo "entry2 = Array();";
                    foreach ($entry2 as $entry_value2) {
                        echo "entry2.push(\"".$entry_value2."\");";
                    }
                    echo "lengths_entry2 = Array(entry2[0], entry2[1], entry2[2], entry2[3], entry2[4]);";
                    echo "volumes_entry2 = Array(entry2[0], entry2[1], entry2[2], entry2[3], entry2[5]);";
                    echo "axon_lengths_group.push(lengths_entry2);";
                    echo "axon_volumes_group.push(volumes_entry2);";
                }
            ?>
            
            //document.write(document.getElementById("source").value);
            let name = document.getElementById("source").value.split(" ")[0];
            if(name.includes("CA1")){
                volume_data = readVolumes("data/CA1-Table-2.csv");
                readData("data/CA1-Table-1.csv",volume_data,0,1);
            }else if(name.includes("CA2")){
                volume_data = readVolumes("data/CA2-Table-2.csv");
                readData("data/CA2-Table-1.csv",volume_data,0,1);
            }else if(name.includes("CA3")){
                volume_data = readVolumes("data/CA3-Table-2.csv");
                readData("data/CA3-Table-1.csv",volume_data,0,1);
            }else if(name.includes("DG")){
                volume_data = readVolumes("data/DG-Table-2.csv");
                readData("data/DG-Table-1.csv",volume_data,0,1);
            }else if(name.includes("MEC")){
                volume_data = readVolumes("data/EC-Table-2.csv");
                readData("data/EC-Table-1.csv",volume_data,1,3);
            }else if(name.includes("LEC")){
                volume_data = readVolumes("data/EC-Table-2.csv");
                readData("data/EC-Table-1.csv",volume_data,0,3);
            }else if(name.includes("EC")){
                volume_data = readVolumes("data/EC-Table-2.csv");
                readData("data/EC-Table-1.csv",volume_data,2,3);
            }else if(name.includes("SUB")){
                volume_data = readVolumes("data/Sub-Table-2.csv");
                readData("data/Sub-Table-1.csv",volume_data,0,1);
            }
        }
        function submitClicked(){
            let source = document.getElementById("source").value.trim();
            let target = document.getElementById("target").value.trim();
            let source_id = sourceIDDic[source];
            let target_id = targetIDDic[target];
            document.getElementById("source_id").value = source_id;
            document.getElementById("target_id").value = target_id;

            document.forms["conn_form"].submit();
        }
        function targetSelected(){
            let spine_distance = document.getElementById("spine_distance");
            let bouton_distance = document.getElementById("bouton_distance");
            let interaction = document.getElementById("interaction");
            let contacts = document.getElementById("contacts");
            let submit = document.getElementById("s");
            spine_distance.disabled = true;
            bouton_distance.disabled = true;
            interaction.disabled = true;
            contacts.disabled = true;
            submit.disabled = true;
            spine_distance.innerText = null;
            bouton_distance.innerText = null;
            interaction.innerText = null;
            contacts.innerText = null;
            spine_distance.disabled = false;
            bouton_distance.disabled = false;
            interaction.disabled = false;
            contacts.disabled = false;
            submit.disabled = false;

        }
        function sourceSelected() {
            let source = document.getElementById("source").value;
            let target = document.getElementById("target");
            target.disabled = true;
            target.length = 0;
            addOption(target, "-", "-");
            for(let value in connDic[source]){
                addOption(target,connDic[source][value],connDic[source][value]);
            }
            <?php
                //if (isset($_REQUEST["target"])) {
                //    echo "document.getElementById('target').value='".$_REQUEST["target"]."';";
                //}
            ?>
            target.disabled = false;
        }
        addOption = function(selectbox, text, value) {
            let optn = document.createElement("OPTION");
            optn.text = text;
            optn.value = value;
            selectbox.options.add(optn);
        };
        function init() {
            let exclude_pre = ["CA3 Giant","CA3 Interneuron Specific Quad","CA3 Lucidum LAX","MEC LIII Multipolar Principal","LEC LIII Multipolar Interneuron","EC LIII Pyramidal-Looking Interneuron","DG Axo-Axonic", "DG Basket" ,"DG Basket CCK+", "CA3 Axo-Axonic", "CA3 Horizontal Axo-Axonic" ,"CA3 Basket","CA2 Basket" ,"CA3 Basket CCK+","CA2 Basket+","CA2 Wide-Arbor Basket"
                ,"CA1 Axo-Axonic","CA1 Horizontal Axo-Axonic","CA1 Basket","CA1 Basket CCK+","CA1 Horizontal Basket","SUB Axo-axonic","EC LII Axo-Axonic","MEC LII Basket","EC LII Basket-Multipolar"]
            let exclude_post = ["CA3 Giant", "CA3 Interneuron Specific Quad", "CA3 Lucidum LAX","MEC LIII Multipolar Principal","LEC LIII Multipolar Interneuron","EC LIII Pyramidal-Looking Interneuron"]
            $.ajax({
                url:"data/conndata.csv",
                dataType:"text",
                success:[function(data){
                    let rows = data.split(/\r?\n|\r/);
                    for(let count = 1; count<rows.length-1; count=count+1) {
                    let row = rows[count].split(",");
                    let sourceID = row[0];
                    let source = row[1];
                    let targetID = row[2];
                    let target = row[3];
                    if (target !== undefined && source !== undefined && !(exclude_pre.indexOf(source.trim()) > -1) && !(exclude_post.indexOf(target.trim()) > -1)) {
                        source = source.trim();
                        target = target.trim();
                        let sourceName = source.split(" ")[0];                        
                        let targetName = target.split(" ")[0];
                        if (sourceName === targetName || (sourceName==="EC"||sourceName==="LEC"||sourceName==="MEC")&&(targetName==="EC"||targetName==="LEC"||targetName==="MEC") || (sourceName==="CA3"&&targetName==="CA3c") || (sourceName==="CA3c"&&targetName==="CA3")) {
                            if (!connDic[source]) {
                                connDic[source] = [];
                            }
                            connDic[source].push(target);
                            sourceIDDic[source] = sourceID;
                            targetIDDic[target] = targetID;
                            //document.write(source+" "+target+"<br>");
                        }
                    }
                }
                let source_html = document.getElementById("source");
                source_html.disabled = true;
                source_html.length = 0;
                addOption(source_html, "-", "-");
                for (let key in connDic) {
                    addOption(source_html, key, key);
                }
                source_html.disabled = false;

                <?php
                if (isset($_REQUEST["source"])) {
                    echo "document.getElementById('source').value='".$_REQUEST["source"]."';";
                }
                ?>
                sourceSelected();
                /*let source = document.getElementById("source").value;
                let target = document.getElementById("target");
                target.disabled = true;
                target.length = 0;
                addOption(target, "-", "-");
                addOption(target, "test", "test");
                for(let value in connDic[source]){
                    addOption(target,connDic[source][value],connDic[source][value]);
                }
                target.disabled = false;*/


                <?php
                    if (isset($_REQUEST["target"])) {
                        echo "document.getElementById('target').value='".$_REQUEST["target"]."';";
                    }
                ?>
           }] });}

        class Neuron{
            constructor(axons,dendrites,volumes, columnNames){
                this.axons = axons
                this.dendrites = dendrites
                this.volumes = volumes
                this.columnNames = columnNames
            }
        }
        class NeuronVolumes{
            constructor(axons,dendrites,volumes, columnNames){
                this.axons = axons
                this.dendrites = dendrites
                this.volumes = volumes
                this.columnNames = columnNames
            }
        }
       init();
    </script>
    <?php
    if (isset($_REQUEST["source"])) {
        echo "<script>";
        /*echo "document.getElementById('source').value='".$_REQUEST["source"]."';";
        echo "sourceSelected();";
        echo "document.getElementById('target').value='".$_REQUEST["target"]."';";
        echo "targetSelected();";*/
        echo "setTimeout(() => {  document.getElementById('source').value='".$_REQUEST["source"]."';";
        //echo "document.write(document.getElementById('source').value);";
        echo "createTables(); }, 1000);";
        echo "</script>";
    }
    ?>
</body>
</html>