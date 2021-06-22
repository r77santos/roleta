<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body style="font-family: Arial; font-size: 12px;">
        <h1>Ganhador da Roleta - BIOMA4ME</h1>
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
			<?php $this->printVal('mail', ''); ?>
		</span>
        <p>Parabéns você ganhou o prêmio na roleta da sorte. Em breve entraremos em contato para combinar os detalhes da entrega do seu prêmio.</p>
	</body>
</html>