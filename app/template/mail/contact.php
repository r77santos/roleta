<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body style="font-family: Arial; font-size: 12px;">
		<span>
			<strong>Nome:</strong>
			<?php $this->printVal('nome', ''); ?>
		</span>
		<?php $this->printbr(2); ?>
		<span>
			<strong>Celular:</strong> 
			<?php $this->printVal('celular', ''); ?>
		</span>
		<?php $this->printbr(2); ?>
		<span>
			<strong>E-mail:</strong> 
			<?php $this->printVal('email', ''); ?>
		</span>
	</body>
</html>