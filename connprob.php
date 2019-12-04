<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
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
    <form class="pure-form" onsubmit="return false;">
        <fieldset>
            <h2>Probability of connection</h2>
            <table>
                <tr>
                   <td>Presynaptic</td>
                    <td><select id="source" onchange="sourceSelected()" disabled></select></td>
                </tr>
                <tr>
                    <td>Postsynaptic</td>
                    <td><select id="target" onchange="targetSelected()" disabled></select></td>
                </tr>
                <tr>
                    <td> Dentritic spine distance </td>
                    <td><input id="spine_distance" type="text" disabled></td>
                </tr>
                <tr>
                    <td> Inter bouton distance</td>
                    <td><input id="bouton_distance" type="text" disabled></td>
                </tr>
                <tr>
                    <td>Number of contacts</td>
                    <td> <input id="contacts" type="text" disabled></td>
                </tr>
                <tr>
                    <td>Radius of interaction</td>
                    <td><input id="interaction" type="text" disabled></td>
                </tr>
            </table>
            <button id="s" class="pure-button pure-button-primary" onclick="submitClicked()" disabled>Submit</button>
        </fieldset>
    </form>
    <div id="graph"></div>
</div>
    <script>
        function parse(data,volumes_index,columnNames_index){
            let dict = new Map();
            let datav = data.split(/\r?\n|\r/);
            let volumes = datav[volumes_index].split(",").slice(2).map(function(item) {
                    var value = parseFloat(item);
                    if(isNaN(value)) return 0;
                    return value;
            });
            let columnNames = datav[columnNames_index].split(",").slice(1)
            for(let count = 2; count<datav.length-1; count=count+2)
            {
                let rowData = datav[count].split(",");
                let nextRowData = datav[count+1].split(",");
                let key = rowData[0];
                let firstRowData =rowData.slice(2).map(function(item) {
                    var value = parseFloat(item);
                    if(isNaN(value)) return 0;
                    return value;
                });
                let secondRowData = nextRowData.slice(2).map(function(item) {
                    var value = parseFloat(item);
                    if(isNaN(value)) return 0;
                    return value;
                });
                if(key!=="") {
                    dict.set(key, new Neuron(firstRowData, secondRowData, volumes, columnNames));
                }
            }
            let spine_distance = parseFloat(document.getElementById("spine_distance").value);
            let bouton_distance = parseFloat(document.getElementById("bouton_distance").value);
            let interaction = parseFloat(document.getElementById("interaction").value);
            let contacts = parseFloat(document.getElementById("contacts").value);
            let presynaptic_selected = document.getElementById("source").value.trim();
            let postsynaptic_selected = document.getElementById("target").value.trim();
            let vint = (4.0 / 3) * Math.PI * Math.pow(interaction, 3);
            let c = vint /(spine_distance*bouton_distance);
            dict.get(presynaptic_selected).columnNames.push("Total");
            dict.get(presynaptic_selected).columnNames.shift();
            let volumes_array = dict.get(presynaptic_selected).volumes;
            let axons =  dict.get(presynaptic_selected).axons;
            let dentrites = dict.get(postsynaptic_selected).dentrites;
            let final_result = [];
            for (var i = 0; i < axons.length; i++) {
                final_result.push((c * ((axons[i] * dentrites[i]) / volumes_array[i])) / contacts);
            }
            final_result.push(final_result.reduce((a, b) => a + b, 0));
            let cname = Array.from(dict.get(presynaptic_selected).columnNames, x => [x]);
            let result = Array.from(final_result, x => [x]);
            let graphdata = [{
                type: 'table',
                header: {
                    values: cname ,
                    align: "center",
                    line: {width: 1, color: 'black'},
                    fill: {color: "grey"},
                    font: {family: "Arial", size: 12, color: "white"}
                },
                cells: {
                    values: result,
                    align: "center",
                    line: {color: "black", width: 1},
                    font: {family: "Arial", size: 11, color: ["black"]}
                }
            }]
            Plotly.plot('graph', graphdata);
        }
        function readData(url,volumes_index,columns_index){
            $.ajax({
                url:url,
                dataType:"text",
                success:[function(data){
                   parse(data,volumes_index,columns_index);
                }]
            });
        }
        let connDic = {};
        function submitClicked(){
            let name = document.getElementById("source").value.split(" ")[0];
            if(name.includes("CA1")){
                readData("data/CA1-Table-1.csv",0,1);
            }else if(name.includes("CA2")){
                readData("data/CA2-Table-1.csv",0,1);
            }else if(name.includes("CA3")){
                readData("data/CA3-Table-1.csv",0,1);
            }else if(name.includes("DG")){
                readData("data/DG-Table-1.csv",0,1);
            }else if(name.includes("EC")){
                readData("data/EC-Table-1.csv",2,3);
            }else if(name.includes("MEC")){
                readData("data/EC-Table-1.csv",1,3);
            }else if(name.includes("LEC")){
                readData("data/EC-Table-1.csv",0,3);
            }else if(name.includes("SUB")){
                readData("data/Sub-Table-1.csv",0,1);
            }
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
            target.disabled = false;
        }
        addOption = function(selectbox, text, value) {
            let optn = document.createElement("OPTION");
            optn.text = text;
            optn.value = value;
            selectbox.options.add(optn);
        };
        function init() {
            let exclude = ["DG Axo-Axonic", "DG Basket" ,"DG Basket CCK+", "CA3 Axo-Axonic", "CA3 Horizontal Axo-Axonic" ,"CA3 Basket","CA2 Basket" ,"CA3 Basket CCK+","CA2 Basket+","CA2 Wide-Arbor Basket"
                ,"CA1 Axo-Axonic","CA1 Horizontal Axo-Axonic","CA1 Basket","CA1 Basket CCK+","CA1 Horizontal Basket","SUB Axo-axonic","EC LII Axo-Axonic","MEC LII Basket","EC LII Basket-Multipolar","CA3 Interneuron Specific Oriens","CA3 Lucidum LAX","CA3 Lucidum-Radiatum","LEC LIII Multipolar Interneuron","MEC LIII Multipolar Principal","MEC LIII Multipolar Interneuron","EC LIII Pyramidal-Looking Interneuron"]
            $.ajax({
                url:"data/conndata.csv",
                dataType:"text",
                success:[function(data){
                    let rows = data.split(/\r?\n|\r/);
                    for(let count = 1; count<rows.length-1; count=count+1) {
                    let row = rows[count].split(",");
                    let target = row[1];
                    let source = row[3];
                    if (target !== undefined && source !== undefined && !(exclude.indexOf(source.trim()) > -1)) {
                        target = target.trim();
                        source = source.trim();
                        let targetName = target.split(" ")[0];
                        let sourceName = source.split(" ")[0];
                        if (sourceName === targetName || (sourceName==="EC"||sourceName==="LEC"||sourceName==="MEC")&&(target==="EC"||sourceName==="LEC"||sourceName==="MEC")) {
                            if (!connDic[source]) {
                                connDic[source] = [];
                            }
                            connDic[source].push(target);
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
           }] });}

        class Neuron{
            constructor(axons,dentrites,volumes, columnNames){
                this.axons = axons
                this.dentrites = dentrites
                this.volumes = volumes
                this.columnNames = columnNames
            }
        }
       init();
    </script>
</body>
</html>