<?php
class Energiedaten
{            
    public static function holeDaten($link)
    {
      $query="Select MonatNr, Bezeichnung
                from monat";
      return DbFunctions::getHash($link, $query);
    }
    public static function holeEnergieverbrauchHash($link, $MonatNr) {
        $query="Select wohneinheit.Wohnung, energieverbrauch.Verbrauch,  energieverbrauch.MonatNr  
    	      from Energieverbrauch, wohneinheit
    	      where MonatNr=$MonatNr AND
              wohneinheit.WohneinheitNr = energieverbrauch.WohneinheitNr";
        return DbFunctions::getHash($link, $query);
    }
    
    public static function holeMonatVerbrauch($link, $monatNr, $wohneinheitNr) {
        $query="Select Verbrauch
                from energieverbrauch
                where MonatNr=$monatNr
                and WohneinheitNr=$wohneinheitNr";
        return DbFunctions::getFirstFieldOfResult($link, $query);
    }
    
    public static function bestimmeGesamtenergiebedarf($link, $monatNr)
    {   
         $energieverbrauchHash = Energiedaten::holeEnergieverbrauchHash($link, $monatNr);
         $gesamtenergieverbrauch=0;
        foreach ($energieverbrauchHash as $wohneinheit => $value) {
            $gesamtenergieverbrauch += $value;
        }
//         for($i = 0; $i <= 5; $i++) {
//             $gesamtenergieverbrauch += Energiedaten::holeMonatVerbrauch($link, $monatNr, $i);
//         }
        
        return $gesamtenergieverbrauch;
    }
}
?>