<?php 


function generateNumericOTP($nx) { 
    $generator = "1357902468";
    $result = ""; 
    for ($i = 1; $i <= $nx; $i++) { 
		$result .= substr($generator, (rand()%(strlen($generator))), 1); 
	} 
    return $result; 
}  

?> 
