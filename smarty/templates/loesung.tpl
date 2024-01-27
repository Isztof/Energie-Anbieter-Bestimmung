<!DOCTYPE HTML>
<html>
<head>
<title>Aufgabe Umzugsunternehmen</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/style.css">


</head>
<body>
	<h2>{$ueberschrift}</h2>

	{if (isset($PHP_SELF))}
		<form name="formular" action="{$PHP_SELF}" method="post">
			<input type="hidden" name="csrfToken" value="{$csrfToken}" />
			<label>Monat</label>						
			<select name="monat">	
 			{foreach key=monatNr item=bezeichnung from=$energiedaten}
    			<option value="{$monatNr}">{$bezeichnung}</option>    
  			{/foreach}		
			</select>
			<label>Sondertarif</label>
			<input type="text" id="teamgroesse" name="sondertarif" pattern="Energieanbieter A|Energieanbieter B|Enegieanbieter C" >
			<label>Prämie(€)</label>
			<input type="number" name="praemie" min="0"  >		
			<label>Ausgabe als PDF?</label>
			<input type="checkbox" name="pdf">
			<label>&nbsp;</label>
			<input type="submit" name="Button1" value="Abschicken">
		</form>
	{else}
		{if (isset($fehler))}
			Unzulässige Eingabe.
		{else} 
			<img src="{PATH_AND_FILENAME}">
			<br>
			<br>
			 {$ausgabeText} <br>
			 {$ausgabeText2} <br>
			 <em>{$ausgabeText3} </em>
		{/if} 		 					
	{/if}
</body>
</html>
