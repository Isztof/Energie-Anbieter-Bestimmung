<?php

class Sicherheit {
    
    

	static function isCorrectNumericalString($str) {
		if (is_numeric($str)) {
			return true;
		}
		return false;
	}
	
	static function istNotEmpty($str) {
	    if ($str!='') {
	        return true;
	    }
	    return false;
	}

	static function isNumericalInBoundary($str, $min, $max) {
		if (is_numeric($str) && floatval($str) >= $min && floatval($str) <= $max) {
			return true;
		}
		return false;
	}

	static function isGreaterThanMin($str, $min) {
		if (is_numeric($str) && floatval($str) > $min) {
			return true;
		}
		return false;
	}

	static function isCorrectSondertarif($str) {
	    DEFINE('ENERGIEANBIETER_A', "Energieanbieter A");
	    DEFINE('ENERGIEANBIETER_B', "Energieanbieter B");
	    DEFINE('ENERGIEANBIETER_C', "Energieanbieter C");	
	    
		if ($str == ENERGIEANBIETER_A || $str == ENERGIEANBIETER_B || $str == ENERGIEANBIETER_C) {
			return true;
		}
		return false;
	}
}
?>