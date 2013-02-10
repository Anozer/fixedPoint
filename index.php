<?php
	/*
	 * Sylvain MARIEL (sylvain.mariel@otmax.fr)
	 * Fixed point/floating point conversion (v1.5)
	 * 2013 February
	 */
	 
	define("PHP_INT_SIZE_OCT", PHP_INT_SIZE*8);
	define("PHP_INT_HALFSIZE_OCT", PHP_INT_SIZE_OCT/2);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"> 
	<head> 
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title></title>
		<link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
		<style>
			body {
				margin: 40px;
			}
			
			section {
				margin-bottom: 60px;				
			}
		</style>
		
		
		<script type="text/javascript" src="js/bootstrap.min.js"></script> 
		<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				function updateVal() {
					var $url = "float2fix.php?nb="+$("#nb_input").val()+"&frac_len="+$("#fracLen_input").val();
					$("#resultat").load($url);
				}
			
				$("#nb_input").keyup(function(){
					updateVal();
				});
				
				$("#fracLen_input").change(function(){
					$("#range_val").text($(this).val());
					updateVal();
				});
				
				$("#fracLen_input").keyup(function(){
					updateVal();
				});
				
				
				$("#bin_input").keyup(function(){
					var $url = "fix2float.php?nb="+$("#bin_input").val();
					$("#resultat_bin").load($url);
				});
				
			});
					
		</script>
	</head>
	<body>
		<section class="">
			<form class="form-horizontal">
				<legend>Float (decimal) => Fixed (binary)</legend>
				<div class="control-group">
					<label class="control-label" for="nb_input">Number (on <?php echo PHP_INT_SIZE_OCT; ?> bits)</label>
					<div class="controls">
						<input type="text" id="nb_input" placeholder="Ex: -42,75" />
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="fracLen_input">Fractional part size (0 to <?php echo PHP_INT_SIZE_OCT; ?>)</label>
					<div class="controls">
						<input id="fracLen_input" type="range" min="0" max="64" step="1" value="<?php echo PHP_INT_HALFSIZE_OCT; ?>" /> <span id="range_val"><?php echo PHP_INT_HALFSIZE_OCT; ?></span>
					</div>
				</div>	
			</form>
			<p class="alert alert-info">Result : <span id="resultat"></span></p>
		</section>
		
		<section class="">
			<form class="form-horizontal">
				<legend>Fiexed (binary) => Float (decimal)</legend>
				<div class="control-group">
					<label class="control-label" for="bin_input">Fixed point number</label>
					<div class="controls">
						<input type="text" id="bin_input" placeholder="Ex: 0011,01" />
					</div>
				</div>
			</form>
			<p class="alert alert-info">Result : <span id="resultat_bin"></span></p>
		</section>
		
		<footer>
			<hr />
			<p><a class="btn btn-large btn-primary" href="sources.zip"><i class="icon-download icon-white"></i> Sources</a></p>
			<p>2013 © Sylvain MARIEL & Théo MICHOT</p>
		<footer>
</body>
</html>