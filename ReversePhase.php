<?php

$machine = "Prep_HPLC";
$LMCS_rf = $_REQUEST['LMCS_rf'];


$run_time = 0;
$run_time = 0;
$output1 = "";

$percentACN=0;

if( ($machine != "") &&
	($LMCS_rf != "") )
{
	$output = "";


	$output .= "<b>For the system:</b> <br />";
	//$output .= "<b>Machine :</b> " . $machine . "<br />";
	
	$output .= "<b>Rt (SCIEX LCMS):</b> " . $LMCS_rf . "<br />";
	
	

	if( ($LMCS_rf < 1.18) || ($LMCS_rf > 3.72) )
	{
		

		

	}
	else
	{
		predict($machine, $LMCS_rf, $percentACN,$output1);
		

			//echo "<br /><br />";
	}

}



function predict($machine, $LMCS_rf, &$percentACN,&$output1)
{
	


		



	
	

	if($machine == "Prep_HPLC" )
	{
		$percentACN =  round((5.9864*(pow($LMCS_rf, 3)) - 55.83*(pow($LMCS_rf,2))+188.76*($LMCS_rf)-137.76),1);
		
		$output1 .=  "Ending Percent ACN is: " .$percentACN ;
		$output1 .= "<br />";
		$output1 .= "<br />";
	}
	
	$output1;
	

	
}


?>


<html>

<title>eFFECTOR Reverse Phase Calculator</title>
<head>
	<link rel="shortcut icon" href="http://reagents.us.effector.com/elute/img/favicon.ico" type="image/x-icon">
	<link rel="icon" href="http://reagents.us.effector.com/elute/img/favicon.ico" type="image/x-icon">

	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>eFFECTOR Elution Calculator</title>
	<link href="http://reagents.us.effector.com/elute/flot/examples/examples.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="http://reagents.us.effector.com/elute/elute.css" media="print, projection, screen">

	<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="../../excanvas.min.js"></script><![endif]-->
	


	
</script>

</head>




<center>
	<div style =font-family: 'Tangerine', 'Inconsolata', 'Droid Sans', serif; font-size: 25px>
		
		<?php 
		echo  $output; 
		echo "<br />";
		

		
		?>
		
	</div>


	<div style =font-family: 'Tangerine', 'Inconsolata', 'Droid Sans', serif; >
		<h2>
			<?php 
			
			echo $output1; 

			
			?>
			
		</h2>    
	</div>


	

	<form method='post'  action='./ReversePhase.php' bgcolor="#a1dbff" >

		<table align="center" border="2" bgcolor="#a1dbff" >
			<tr align="center">
				
				<td>Rt (LCMS)</td>
				
			</tr>
			<!-- <tr align="center" bgcolor="#a1dbff">
				<td bgcolor="#a1dbff"> 
					<select name='machine' align="center" >
						<option value='Prep_HPLC' <?php echo ($machine == "Prep_HPLC") ? "selected" : "" ?>> Prep HPLC</option>
						<!-- <option value='Semi Prep 1' <?php echo ($machine == "Semi Prep 1") ? "selected" : "" ?>>Semi Prep HPLC 1 </option>
						<option value='Semi Prep 2' <?php echo ($machine == "Semi Prep 2") ? "selected" : "" ?>>Semi Prep HPLC 2 "Located on Prep Machine"</option>			
						
					</select>
				</td>
				
				
			</select> -->
			
			<td align="center" bgcolor="#a1dbff">
				<input type='text' id='LMCS_rf' name='LMCS_rf' value='<?php echo $LMCS_rf; ?>'>
			</td>
		</tr>
	</table>
	<br />
	<input type='submit' onclick="if(document.getElementById('LMCS_rf').value < 1.18 || document.getElementById('LMCS_rf').value > 3.71 ) {alert('Rf must fall within range: 1.18 <= Rf <= 3.71 !'); return false;}else{return true;}">
</form>
</center>













</div>

<div id="footer">
	Copyright &copy; 2014-2015 Daniel Webber
</div>

</html>