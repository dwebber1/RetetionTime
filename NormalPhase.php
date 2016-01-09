<?php

	$solvent_system = $_REQUEST['solvent_system'];
	$tlc_rf 		= $_REQUEST['tlc_rf'];
	$column_s		= $_REQUEST['column_size'];

	$run_time = 0;
	$grad_starting_time = 0;
	$grad_ending_time = 0;	
	$starting_percent = 0;
	$ending_percent = 0;
	$run_time = 0;
	$output1 = "";
	$flow_rate= 0;
	$max_loading= 0;
	
	if( ($solvent_system != "") &&
		($tlc_rf != "") )
	{
		$output = "";

		$output .= "<b>For the system:</b> <br />";
		$output .= "<b>TLC Solvent System:</b> " . $solvent_system . "<br />";
		$output .= "<b>Column:</b> " . $column_s . "<br />";
		$output .= "<b>Rf (TLC):</b> " . $tlc_rf . "<br />";
		$output .= "<br />";
		

		if( ($tlc_rf < 0.2) || ($tlc_rf > 0.6) )
		{
			//echo "Rf must fall within range: 0.2 >= Rf <= 0.6";
			

		}
		else
		{
			predict($solvent_system, $tlc_rf, $column_s, $starting_percent,$grad_starting_time,$ending_percent,$grad_ending_time,$run_time,$output1,$flow_rate,$max_loading);
			

			//echo "<br /><br />";
		}
	}

	function roundDownToAny($n,$x=5) 
	{
	    return (round($n)%$x === 0) ? round($n) : round(($n-$x/2)/$x)*$x;
	}
		
	function predict($solvent_system, $tlc_rf,$column_s, &$starting_percent,&$grad_starting_time,&$ending_percent,&$grad_ending_time,&$run_time,&$output1,&$flow_rate,&$max_loading)
	{
		$run_time = 27;
		$grad_starting_time = 3;
		$grad_ending_time = 13;

		if($column_s == "12g")
		{
			$grad_starting_time = 2;
			$grad_ending_time = 8;
			$run_time = 16;
			$flow_rate = round((-.0002*(pow(12, 2)) + .3996*(12) + 15.181));
			$output1 .=  "Flow Rate is : " . $flow_rate. " ml/min";
			$output1 .= "<br />";
			$max_loading =  round((-.0002*(pow(12, 2)) + .0481*(12) + .3251));
			$output1 .=  "Maximum loading is : " . $max_loading. "g";
		}
		if($column_s == "24g")
		{
			$flow_rate = round((-.0002*(pow(24, 2)) + .3996*(24) + 15.181));
			$output1 .=  "Flow Rate is : " . $flow_rate. " ml/min";
			$output1 .= "<br />";
			$max_loading =  round((-.0002*(pow(24, 2)) + .0481*(24) + .3251));
			$output1 .=  "Maximum loading is : " . $max_loading. " g";
		}
		if($column_s == "40g")
		{
			$flow_rate = round((-.0002*(pow(40, 2)) + .3996*(40) + 15.181));
			$output1 .=  "Flow Rate is : " . $flow_rate. " ml/min";
			$output1 .= "<br />";
			$max_loading =  round((-.0002*(pow(40, 2)) + .0481*(40) + .3251));
			$output1 .=  "Maximum loading is : " . $max_loading. " g";	
		}

		if($column_s == "120g")
		{
			$flow_rate = round((-.0002*(pow(120, 2)) + .3996*(120) + 15.181));
			$output1 .=  "Flow Rate is : " . $flow_rate. " ml/min";
			$output1 .= "<br />";
			$max_loading =  round((-.0002*(pow(120, 2)) + .0481*(120) + .3251));
			$output1 .=  "Maximum loading is : " . $max_loading. " g";
		}
		$output1 .= "<br />";
		$output1 .="Starting Time of the gradient is: "  . $grad_starting_time  ;
		$output1 .="<br />";
		$output1 .="Ending Time of the gradient is: "  . $grad_ending_time  ;
		$output1 .="<br />";
		$output1 .="The Ending Run Time is: "  . $run_time;
		$output1 .= "<br />";
		 $output1;



		//echo  "Starting Time of the gradient is: "  . $grad_starting_time  ;
		//echo  "<br />";
		//echo  "Ending Time of the gradient is: "  . $grad_ending_time  ;
		//echo  "<br />";
		//echo  "The Ending Run Time is: "  . $run_time;
		//echo   "<br />";



		$starting_percent = 0;
		$ending_percent = 0;

		if($solvent_system == "50_50_H_E" )
		{
			$starting_percent = roundDownToAny( (-13.333*(pow($tlc_rf, 2)) - 59.333*($tlc_rf) + 62.4), 5);
					
					
					$output1 .=  "Starting percent is: " . $starting_percent;

			$ending_percent = roundDownToAny((((13.333*(pow($tlc_rf, 2)) - 80.667*($tlc_rf) + 86.6)*5)/5), 5);
					$output1 .= " <br /> Ending percent is: " .$ending_percent; 
					
					
		}
		 elseif ($solvent_system == "75_25_H_E" )
		{
			$starting_percent = roundDownToAny((((36.667*(pow($tlc_rf, 2)) - 91.833*($tlc_rf) + 41.9)*5)/5), 5);
					$output1 .= "Starting percent is: " .$starting_percent;
			$ending_percent = roundDownToAny((((13.333*(pow($tlc_rf, 2)) -80.667*($tlc_rf) + 61.6)*5)/5), 5);
					$output1 .= " <br /> Ending percent is: " .$ending_percent;

		}
		elseif ($solvent_system == "5_95_M_D" )
		{
			$starting_percent = roundDownToAny((((20*(pow($tlc_rf, 2)) - 21*($tlc_rf) + 5.4)*5)/5), 5);
					$output1 .= "Starting percent is: " . $starting_percent;
			$ending_percent = roundDownToAny((((10*(pow($tlc_rf, 2)) - 30.5*($tlc_rf) + 14.7)*5)/5), 5);
					//.
					$output1 .= " <br /> Ending percent is: " .$ending_percent; 
		}
		elseif ($solvent_system == "10_90_M_D" )
		{
			$starting_percent = roundDownToAny((((43.333*(pow($tlc_rf, 2)) - 52.167*($tlc_rf) + 15.7)*5)/5), 5);
					$output1 .= "Starting percent is: " . $starting_percent;
			$ending_percent = roundDownToAny((((10*(pow($tlc_rf, 2)) - 30.5*($tlc_rf) + 19.7)*5)/5), 5);
					$output1 .= " <br /> Ending percent is: " .$ending_percent; 

		}

	
}

	
?>


<html>
<head>
	<link rel="shortcut icon" href="http://reagents.us.effector.com/elute/img/favicon.ico" type="image/x-icon">
<link rel="icon" href="http://reagents.us.effector.com/elute/img/favicon.ico" type="image/x-icon">

	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>eFFECTOR Elution Calculator</title>
	<link href="http://reagents.us.effector.com/elute/flot/examples/examples.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://reagents.us.effector.com/elute/elute.css" media="print, projection, screen">

	<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="../../excanvas.min.js"></script><![endif]-->
	<script language="javascript" type="text/javascript" src="http://reagents.us.effector.com/elute/flot/jquery.js"></script>
	<script language="javascript" type="text/javascript" src="http://reagents.us.effector.com/elute/flot/jquery.flot.js"></script>
	<script language="javascript" type="text/javascript" src="http://reagents.us.effector.com/elute/flot/jquery.flot.axislabels.js"></script> 	

	<script type="text/javascript">

	$(function() {


		var d1 = [[0, <?php echo $starting_percent; ?>], [ <?php echo $grad_starting_time; ?>,<?php echo $starting_percent; ?>], [ <?php echo $grad_ending_time; ?>,<?php echo $ending_percent; ?>], [ <?php echo $run_time; ?>,<?php echo $ending_percent; ?>]];

		
		var markings = [
			
			{ color: "#000", lineWidth: 2, xaxis: { from: <?php echo $grad_ending_time + 1; ?>, to: <?php echo $grad_ending_time + 1; ?> } },
			{ color: "#000", lineWidth: 2, xaxis: { from: <?php echo $grad_ending_time - 1; ?>, to: <?php echo $grad_ending_time - 1; ?> } }
		];
		// A null signifies separate line segments



		$.plot("#placeholder", [ d1 ], {
			grid: { markings: markings },
			xaxis: {axisLabelUseCanvas: true, axisLabelPadding: 14, axisLabelFontSizePixels: 14, axisLabel: 'Time (min)'},			
			yaxis: { axisLabelUseCanvas: true, axisLabelPadding: 4, axisLabelFontSizePixels: 14, axisLabel: '%B'}
		});

/*		var plot = $.plot(placeholder, data, {
			bars: { show: true, barWidth: 0.5, fill: 0.9 },
			xaxis: { ticks: [], autoscaleMargin: 0.02 },
			yaxis: { min: -2, max: 2 },
			grid: { markings: markings }
		});
*/

		// Add the Flot version string to the footer

		$("#footer").prepend("Flot " + $.plot.version + " &ndash; ");
	});
	</script>

</head>




<center>
	<div style =font-family: 'Tangerine', 'Inconsolata', 'Droid Sans', serif; font-size: 17px>
		<?php 
				echo  $output; 
               echo $output1;
               echo "<br />";
	?></div>
	

<form method='post'  action='./index.php' bgcolor="#a1dbff" >

<table align="center" border="2" bgcolor="#a1dbff" >
	<tr align="center">
		<td>TLC Solvent System</td>
		<td>Column Size </td>
		<td>Rf (TLC)</td>
		
	</tr>
	<tr align="center" bgcolor="#a1dbff">
		<td bgcolor="#a1dbff"> 
			<select name='solvent_system' align="center" >
				<option value='50_50_H_E' <?php echo ($solvent_system == "50_50_H_E") ? "selected" : "" ?>>50:50 Hex/EtOAc</option>
				<option value='75_25_H_E' <?php echo ($solvent_system == "75_25_H_E") ? "selected" : "" ?>>75:25 Hex/EtOAc</option>
				<option value='5_95_M_D' <?php echo ($solvent_system == "5_95_M_D") ? "selected" : "" ?>>5:95 MeOH/DCM</option>				
				<option value='10_90_M_D' <?php echo ($solvent_system == "10_90_M_D") ? "selected" : "" ?>>10:90 MeOH/DCM</option>	
			</select>
		</td>
		<td bgcolor="#a1dbff">
			<select name='column_size' bgcolor="#a1dbff" >
				<option  value='12g'<?php echo ($column_s == "12g") ? "selected" : "" ?>>12g  </option>	
				<option value='24g'<?php echo ($column_s == "24g") ? "selected" : "" ?>>24g</option>
				<option value='40g'<?php echo ($column_s == "40g") ? "selected" : "" ?>>40g</option>	
				<option value='120g'<?php echo ($column_s == "120g") ? "selected" : "" ?>>120g</option>

					
			</select>
		
		<td align="center" bgcolor="#a1dbff">
			<input type='text' id='tlc_rf' name='tlc_rf' value='<?php echo $tlc_rf; ?>'>
		</td>
	</tr>
</table>
<br />
<input type='submit' onclick="if(document.getElementById('tlc_rf').value < 0.2 || document.getElementById('tlc_rf').value > 0.6 ) {alert('Rf must fall within range: 0.2 <= Rf <= 0.6 !'); return false;}else{return true;}">
</form>
</center>



	<div id="header" align="center">
		<h2>Gradient</h2>
	</div>

	<div id="content">

		<div class="demo-container">
			<div id="placeholder" class="demo-placeholder"></div>
		</div>





		

	</div>

	<div id="footer">
		Copyright &copy; 2014 Daniel Webber
	</div>

</html>