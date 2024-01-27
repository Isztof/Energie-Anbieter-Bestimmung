<?php
/* Smarty version 4.2.0, created on 2024-01-05 16:09:17
  from '/var/www/html/iksy05/Probeklausur2/smarty/templates/loesung.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.0',
  'unifunc' => 'content_65981b9dd3e9f6_48332048',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'af129b8bd4829e25259177d1ddab712002866f55' => 
    array (
      0 => '/var/www/html/iksy05/Probeklausur2/smarty/templates/loesung.tpl',
      1 => 1704467291,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65981b9dd3e9f6_48332048 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE HTML>
<html>
<head>
<title>Aufgabe Umzugsunternehmen</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/Forms.css">
<link rel="stylesheet" type="text/css" href="css/Tables.css">

</head>
<body>
	<h2><?php echo $_smarty_tpl->tpl_vars['ueberschrift']->value;?>
</h2>

	<?php if (((isset($_smarty_tpl->tpl_vars['PHP_SELF']->value)))) {?>
		<form name="formular" action="<?php echo $_smarty_tpl->tpl_vars['PHP_SELF']->value;?>
" method="post">
			<input type="hidden" name="csrfToken" value="<?php echo $_smarty_tpl->tpl_vars['csrfToken']->value;?>
" />
			<label>Kunde</label>						
			<select name="kundennummer">	
 			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['kundendaten']->value, 'kundenname', false, 'kundennummer');
$_smarty_tpl->tpl_vars['kundenname']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['kundennummer']->value => $_smarty_tpl->tpl_vars['kundenname']->value) {
$_smarty_tpl->tpl_vars['kundenname']->do_else = false;
?>
    			<option value="<?php echo $_smarty_tpl->tpl_vars['kundennummer']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['kundenname']->value;?>
</option>    
  			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>		
			</select>
			<label>Teamgröße</label>
			<input type="text" id="teamgroesse" name="teamgroesse" pattern="groß|mittel|klein" required>
			<label>Entfernung</label>
			<input type="number" name="entfernung" min="1" max="500" required>
			<label>Arbeitszeit</label>
			<input type="number" name="arbeitszeit" min="1" max="48" required>
			<label>Lastenaufzug benötigt</label>
			<input type="checkbox" name="lastenaufzug">			
			<label>Ausgabe als PDF?</label>
			<input type="checkbox" name="pdf">
			<label>&nbsp;</label>
			<input type="submit" name="Button1" value="Abschicken">
		</form>
	<?php } else { ?>
		<?php if (((isset($_smarty_tpl->tpl_vars['fehler']->value)))) {?>
			Unzulässige Eingabe.
		<?php } else { ?> 
			<?php echo $_smarty_tpl->tpl_vars['ausgabeText']->value;?>

		<?php }?> 		 					
	<?php }?>
</body>
</html>
<?php }
}
