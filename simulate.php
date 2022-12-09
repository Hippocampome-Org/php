<?php


  include ("permission_check.php");


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<head>
<link rel="shortcut icon" href="#">
<meta http-equiv="Content-Type" content="text/html" />
<script type="text/javascript" src="plotlyjs/plotly-latest.min.js"></script>
</head>


<body>

<?php

try {
  
  $jsonStr = $_SESSION['Izhikevich_model'];
  $output = json_decode($jsonStr, true);
 
  
  echo '<b>Neuron Types:</b>&nbsp;&nbsp;<select name="modelIz" id="modelIz" onchange="modelSelected()">';
  //$output2 = $output["rows"];
  foreach($output["rows"] as $obj){
	   
       $name = $obj['cell'][0];
	   $name = trim(strip_tags($name));
	
	
	   $type = $obj['cell']['1'];
	   preg_match('/>[^<>]+<\/font>/', $type, $matches);
	   $type = trim(str_replace(">","",$matches[0]));
	   $type = str_replace("</font","",$type);
	   
	   $k=$obj['cell']['2'];
	   $k=strip_tags($k);
	   $k = explode("(",$k);
	   $k = trim($k[0]);

		
	   $a=$obj['cell']['3'];
	   $a=strip_tags($a);
	   $a = explode("(",$a);
	   $a = trim($a[0]);

		
		
	   $b=$obj['cell']['4'];
	   $b=strip_tags($b);
	   $b = explode("(",$b);
	   $b = trim($b[0]);

		
		
	   $d=$obj['cell']['5'];
	   $d=strip_tags($d);
	   $d = explode("(",$d);
	   $d = trim($d[0]);

		
		
	   $C=$obj['cell']['6'];
	   $C=strip_tags($C);
	   $C = explode("(",$C);
	   $C = trim($C[0]);

		
	   $Vr=$obj['cell']['7'];
	   $Vr=strip_tags($Vr);
	   $Vr = explode("(",$Vr);
	   $Vr = trim($Vr[0]);

		
	   $Vt=$obj['cell']['8'];
	   $Vt=strip_tags($Vt);
	   $Vt = explode("(",$Vt);
	   $Vt = trim($Vt[0]);

		
		
	   $Vpeak=$obj['cell']['9'];
	   $Vpeak=strip_tags($Vpeak);
	   $Vpeak = explode("(",$Vpeak);
	   $Vpeak = trim($Vpeak[0]);

		
		
		
	   $Vmin=$obj['cell']['10'];
	   $Vmin=strip_tags($Vmin);
	   $Vmin = explode("(",$Vmin);
	   $Vmin = trim($Vmin[0]);

	    
	   $tmp = "$name $type";
	   $tmp = preg_replace("/&#?[a-z0-9]{2,8};/i","",$tmp); 

	   $cleaneduprow =  trim(preg_replace('/\s\s+/', '', $tmp));
	   
	   $values = "$k $a $b $d $C $Vr $Vt $Vpeak $Vmin";
	   $values = strip_tags($values);
	   $values = trim(preg_replace("/&#?[a-z0-9]+;/i","",$values));
	   
	   
	   //echo $values;
	   if( strcmp("", trim($obj['cell']['2'])) !== 0 && strcmp("", trim($obj['cell']['3'])) !== 0 && strcmp("", trim($obj['cell']['4'])) !== 0 &&
		strcmp("", trim($obj['cell']['5'])) !== 0 && strcmp("", trim($obj['cell']['6'])) !== 0 && strcmp("", trim($obj['cell']['7'])) !== 0 &&
		strcmp("", trim($obj['cell']['8'])) !== 0 && strcmp("", trim($obj['cell']['9'])) !== 0) {
		   echo '<option value="'.$values.'">';
		   echo  $name." ".$type;
		   echo  '</option>';
	   }
	    
	   //echo '<br/>';
  }
  
  
  echo '</select>';
  //echo '</pre>';


  } catch (Exception $e) {
		echo 'Caught exception: ',  $e->getMessage(), "\n";
  }
?>


<table>
<tr><td><b>Input Current (pA):</b></td><td><input type="text" id="inputCurrentText" /></td><tr>
<tr><td><b>Start time (ms):</b></td><td><input type="text" id="inputStartTimeText" /></td><tr>
<tr><td><b>End time (ms):</b></td><td><input type="text" id="inputEndTimeText" /></td><tr>
<tr><td></td><td></td><tr>
<tr><td></td><td></td><tr>
<tr><td><b>Model Parameters:</b></td><td></td><tr>
<tr><td><b>Parameter k</b></td><td><input value="<?php echo $_GET["paramK"]; ?>" id="input_k" type="text"/></tr>
<tr><td><b>Parameter a</b></td><td><input value="<?php echo $_GET["paramA"]; ?>" id="input_a" type="text"/></tr>
<tr><td><b>Parameter b</b></td><td><input value="<?php echo $_GET["paramB"]; ?>" id="input_b" type="text"/></tr>
<tr><td><b>Parameter d</b></td><td><input value="<?php echo $_GET["paramD"]; ?>" id="input_d" type="text"/></tr>
<tr><td><b>Parameter Cm</b></td><td><input value="<?php echo $_GET["paramC"]; ?>" id="input_Cm" type="text"/></tr>
<tr><td><b>Parameter vr</b></td><td><input value="<?php echo $_GET["paramVr"]; ?>" id="input_vr" type="text"/></tr>
<tr><td><b>Parameter vt</b></td><td><input value="<?php echo $_GET["paramVt"]; ?>" id="input_vt" type="text"/></tr>
<tr><td><b>Parameter vmin</b></td><td><input value="<?php echo $_GET["paramVmin"]; ?>" id="input_vmin" type="text"/></tr>
<tr><td><b>Parameter vpeak</b></td><td><input value="<?php echo $_GET["paramVpeak"]; ?>" id="input_vpeak" type="text"/></tr>
<tr><td></td><td></td><tr>
<tr><td></td><td></td><tr>
<tr><td><b>Refractory Period Parameters:</b></td><td></td><tr>
<tr><td><b>refrac</b></td><td><input value="2000" id="input_refrac" type="text"/></tr>
<tr><td><b>refrac_c</b></td><td><input value="0" id="input_refrac_c" type="text"/></tr>
</table>
<button type="button" id="simulateButton"  onclick="runPLOT();">Simulate Model</button>&nbsp;
<button type="button" id="clearButton"  onclick="clearPLOT();">Clear</button>&nbsp;
<button type="button" id="dataButton" style="visibility:hidden;" onclick="downloadData();">Download Data</button>
 
<br/>

<div id="plotlyDiv" style="width:800px;height:550px;"></div>

<br/>
 

<br/>	

 

<br/>

<script type="text/javascript">
 
var dropDownValues;


var k=<?php echo $_GET["paramK"]; ?>;//1.2833102565689956;
var a=<?php echo $_GET["paramA"]; ?>;//0.006380990562354527;
var b=<?php echo $_GET["paramB"]; ?>;//57.941038132372135;
var d=<?php echo $_GET["paramD"]; ?>;//-58.0;
var Cm=<?php echo $_GET["paramC"]; ?>;//74.0;
var vr=<?php echo $_GET["paramVr"]; ?>;//-59.006040705399336;
var vt=<?php echo $_GET["paramVt"]; ?>;//-50.53342176093605;
var vmin=<?php echo $_GET["paramVmin"]; ?>;//-56.97945472527379;
var vpeak=<?php echo $_GET["paramVpeak"]; ?>;//0.5706428111684687;


function modelSelected() {
 clearPLOT();
 var fromDropDown=true;
 var val=document.getElementById("modelIz").value;
 dropDownValues = val.split(" ");
 
 document.getElementById("input_k").value=dropDownValues[0];
 document.getElementById("input_a").value=dropDownValues[1];
 document.getElementById("input_b").value=dropDownValues[2];
 document.getElementById("input_d").value=dropDownValues[3];
 document.getElementById("input_Cm").value=dropDownValues[4];
 document.getElementById("input_vr").value=dropDownValues[5];
 document.getElementById("input_vt").value=dropDownValues[6];
 document.getElementById("input_vmin").value=dropDownValues[7];
 document.getElementById("input_vpeak").value=dropDownValues[8];
 
//# input current
 
 k=document.getElementById("input_k").value;
 a=document.getElementById("input_a").value;
 b=document.getElementById("input_b").value;
 d=document.getElementById("input_d").value;
 Cm=document.getElementById("input_Cm").value;
 vr=document.getElementById("input_vr").value;
 vt=document.getElementById("input_vt").value;
 vmin=document.getElementById("input_vmin").value;
 vpeak=document.getElementById("input_vpeak").value;
}


var xs = new Array();
var ys = new Array();
var global = new Array();
var data = new Array();



//# model definition

 

//# initial condition
var v0=vr;
var u0=0;

function rk4(index,x, y, dx, derivs, inputCurrent) {
 
		
		//console.log("<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>x="+x+"|y="+y);
		if(index===0) {
			return yStart;
		}
		var dimension = yStart.length;//derivs.length;
		var i, _y = [];
		var _k1,_k2,_k3,_k4;
		
		_k1 = derivs(x, y, inputCurrent);
        for (i = 0; i < dimension; i++) {
            _y[i] = y[i] + dx * 0.5 * _k1[i];
        }
		
        _k2 = derivs(x + dx * 0.5, _y, inputCurrent);
        for (i = 0; i < dimension; i++) {
            _y[i] = y[i] + dx * 0.5 * _k2[i];
        }
        _k3 = derivs(x + dx * 0.5, _y, inputCurrent);

        for (i = 0; i < dimension; i++) {
            _y[i] = y[i] + dx * _k3[i];
        }
        _k4 = derivs(x + dx, _y, inputCurrent);

        for (i = 0; i < dimension; i++) {
            y[i] += dx / 6 * (_k1[i] + 2 * _k2[i] + 2 * _k3[i] + _k4[i]);
        }
		x += dx;

        return y;
}

var derives2 = function(x, y, inputCurrent) {
    var dydx = [];

	
	//console.log("INPUT CURRENT>>>>>>>"+inputCurrent);
 
	dydx[0] = (k*(y[0]-vr)*(y[0]-vt)-y[1]+inputCurrent)/Cm;
	
	
	dydx[1] = a*(b*(y[0]-vr) - y[1]);
	
	if(y[0]>vpeak) {
		//console.log("WARNING"+y[0]);
		// y[0]=vmin;
		y[1]+=d;
	}

	//console.log("returned============================>"+dydx);

    return dydx;
}

var xStart = 0.0;
var yStart = [v0, u0];
 
var   x1 = 0.0;
var    step = 0.001;
var    steps = 0;
var    maxSteps = 1000001;

var init_refrac = 2000;
var init_refrac_c = 0;

function calculate(inputCurrent,startIndex,endIndex) {
	//console.log("TEST RANDOM="+inputCurrent);
	
	refrac = document.getElementById("input_refrac").value;//2000;
	refrac_c = document.getElementById("input_refrac_c").value;//0;
	
	if(!refrac) {
		refrac = init_refrac;
	}
	
	if(!refrac_c) {
		refrac_c = init_refrac_c;
	}
	
	var savedInputCurrent = inputCurrent;
	
	var endTimeIndex =parseFloat(document.getElementById("inputEndTimeText").value);
	
	maxSteps=Math.ceil((endTimeIndex/step)+100001);
	
	
	
	while (steps < maxSteps) {

		//TODO:Uncomment this
		/*if(steps<=1000 || steps >=5000) {
			I=0;
		} else {
			I=-274.0;
		}*/
		
		
		
		if(steps<=startIndex || steps >=endIndex) {
			inputCurrent=0;
		} else {
			inputCurrent=savedInputCurrent;
		}
		
		
		if(steps===100) {
			//console.log("HERE");
		}
		
		//console.log("STEP+++++++>>"+steps);
	 
		var returnedVal = rk4(steps,xStart, yStart, step, derives2, inputCurrent);

		if (returnedVal[0] >= vpeak) {
			refrac_c = refrac;
		}
		if (refrac_c > 0) {
			refrac_c -= 1;
			returnedVal[0] = vmin;
		}

		//y=v_prev;
	 
		//console.log("END=============================== y(" + x1 + ") =  \t" + JSON.stringify(returnedVal)  );
	 
		xs.push(x1);
		ys.push(returnedVal[0]);
		
		//global.push(x+"|"+y+"|"+u_prev);
		

		// using integer math for the step addition
		// to prevent floating point errors as 0.2 + 0.1 != 0.3
		//x = x+step;
		x1=((x1 * 10) + (step * 10)) / 10;
		

		
		steps += 1;
		

	}

}



function runPLOT() {
	clearPLOT();
	
	 k=document.getElementById("input_k").value;
	 a=document.getElementById("input_a").value;
	 b=document.getElementById("input_b").value;
	 d=document.getElementById("input_d").value;
	 Cm=document.getElementById("input_Cm").value;
	 vr=document.getElementById("input_vr").value;
	 vt=document.getElementById("input_vt").value;
	 vmin=document.getElementById("input_vmin").value;
	 vpeak=document.getElementById("input_vpeak").value;
	
	TESTER = document.getElementById("plotlyDiv");
	
	//alert(document.getElementById("toto").value);
	document.getElementById("plotlyDiv").innerHTML="";
	var  I2 = parseFloat(document.getElementById("inputCurrentText").value);
	var startTimeIndex =parseFloat(document.getElementById("inputStartTimeText").value);
	var endTimeIndex =parseFloat(document.getElementById("inputEndTimeText").value);
	
	startStepIndex = startTimeIndex/step;
	endStepIndex = endTimeIndex/step;
	
	calculate(I2,startStepIndex,endStepIndex);

	var x = [];
	var y = [];
	
	////console.log(JSON.stringify(xs));
	////console.log(JSON.stringify(ys));
	
	data = [{ x: xs, y: ys }];
	
	var layout = {
	  title: {
		text:'Voltage vs Time',
		font: {
		  family: 'Courier New, monospace',
		  size: 24
		},
		xref: 'paper',
		x: 0.05,
	  },
	  xaxis: {
		title: {
		  text: 'Time (ms)',
		  font: {
			family: 'Courier New, monospace',
			size: 18,
			color: '#7f7f7f'
		  }
		},
	  },
	  yaxis: {
		title: {
		  text: 'Voltage(mV)',
		  font: {
			family: 'Courier New, monospace',
			size: 18,
			color: '#7f7f7f'
		  }
		}
	  }
	  ,
	  margin: { t: 0 }
	  
	};
	
	
	Plotly.plot( TESTER, data, layout);
	document.getElementById("dataButton").style.visibility = "visible";
}

function clearPLOT() {
	x1 = 0.0;
	step = 0.001;
	steps = 0;
	//maxSteps = 10001;

	xStart = 0.0;
	yStart = [v0, u0];
	
	xs = [];
	ys = [];
	
	xs = new Array();
	ys = new Array();
	
	data = new Array();
	
	TESTER2 = document.getElementById("plotlyDiv");
	
	Plotly.purge(TESTER2);
	TESTER2.innerHTML="";
	
}


 

function downloadData() {
	var csvContent = "";

	csvContent += "time,voltage,\r\n";
	
	for(i=0;i<data[0].x.length;i++) {
		csvContent+=data[0].x[i]+","+data[0].y[i]+"\r\n";
	}
	
	
	csvData = new Blob([csvContent], { type: 'text/csv' }); 
	var csvUrl = URL.createObjectURL(csvData);

 
	var link = document.createElement("a");
	link.setAttribute("href", csvUrl);
	link.setAttribute("download", "export.csv");
	document.body.appendChild(link); // Required for FF

	link.click();
	
}

 
</script>

 


</body>
</html>
 
