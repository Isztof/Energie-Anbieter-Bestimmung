<?php

class ErmittlungEnergieanbieter {

    public static function bestimmeAnbieter($energieverbrauch) 
    {
 		DEFINE('ENERGIEANBIETER_A', "Energieanbieter A");
		DEFINE('ENERGIEANBIETER_B', "Energieanbieter B");
		DEFINE('ENERGIEANBIETER_C', "Energieanbieter C");		
		DEFINE('GRENZE_ANBIETER_A', 800);
		DEFINE('GRENZE_ANBIETER_B', 1200);
		
		$energieanbieter = "";
		
		if ($energieverbrauch>=GRENZE_ANBIETER_A && $energieverbrauch < GRENZE_ANBIETER_B)
		{
		    $energieanbieter=ENERGIEANBIETER_B;
		}
		elseif ($energieverbrauch>=GRENZE_ANBIETER_B)
		{
		    $energieanbieter=ENERGIEANBIETER_C;
		}
		else
		{
		    $energieanbieter=ENERGIEANBIETER_A;
		}
		
	
		
		return $energieanbieter;
    }
    
    public static function berechnePraemie($basisPraemie) {
        
    }
}
?>