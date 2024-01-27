<?php
/* Smarty version 4.2.0, created on 2024-01-27 07:27:06
  from 'C:\xampp\htdocs\iksy\Seget\smarty\templates\loesung.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.0',
  'unifunc' => 'content_65b4a23a6a92b6_98067500',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c60df79588431959c7e08ee4a06a076f4150f405' => 
    array (
      0 => 'C:\\xampp\\htdocs\\iksy\\Seget\\smarty\\templates\\loesung.tpl',
      1 => 1706336813,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65b4a23a6a92b6_98067500 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE HTML>
<html>
<head>
<title>Aufgabe Umzugsunternehmen</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/style.css">


</head>
<body>
	<h2><?php echo $_smarty_tpl->tpl_vars['ueberschrift']->value;?>
</h2>

	<?php if (((isset($_smarty_tpl->tpl_vars['PHP_SELF']->value)))) {?>
		<form name="formular" action="<?php echo $_smarty_tpl->tpl_vars['PHP_SELF']->value;?>
" method="post">
			<input type="hidden" name="csrfToken" value="<?php echo $_smarty_tpl->tpl_vars['csrfToken']->value;?>
" />
			<label>Monat</label>						
			<select name="monat">	
 			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['energiedaten']->value, 'bezeichnung', false, 'monatNr');
$_smarty_tpl->tpl_vars['bezeichnung']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['monatNr']->value => $_smarty_tpl->tpl_vars['bezeichnung']->value) {
$_smarty_tpl->tpl_vars['bezeichnung']->do_else = false;
?>
    			<option value="<?php echo $_smarty_tpl->tpl_vars['monatNr']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['bezeichnung']->value;?>
</option>    
  			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>		
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
	<?php } else { ?>
		<?php if (((isset($_smarty_tpl->tpl_vars['fehler']->value)))) {?>
			Unzulässige Eingabe.
		<?php } else { ?> 
			<img src="<?php echo PATH_AND_FILENAME;?>
">
			<br>
			<br>
			 <?php echo $_smarty_tpl->tpl_vars['ausgabeText']->value;?>
 <br>
			 <?php echo $_smarty_tpl->tpl_vars['ausgabeText2']->value;?>
 <br>
			 <em><?php echo $_smarty_tpl->tpl_vars['ausgabeText3']->value;?>
 </em>
		<?php }?> 		 					
	<?php }?>
</body>
</html>
<?php }
}
