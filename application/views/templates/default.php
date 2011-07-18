<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="">
	<meta name="description" content="">

	<title><?=$template->title?></title>

	<link rel="shortcut icon" href="<?=base_url()?>favicon.png">
	<link rel="stylesheet" type="text/css" media="all" href="<?=base_url()?>serve/?b=css&f=reset.css,style.css,buttons.css">
	<link href="http://fonts.googleapis.com/css?family=Nixie+One&v2" rel="stylesheet" type="text/css">
</head>
<?php flush(); ?>

<body>
<div id="wrapper">
	<?php if ($this->session->flashdata('status')): ?>
	<div id="status">
		<?=$this->session->flashdata('status')?>
	</div>
	<?php endif; ?>

	<div id="heading">
		<h1><?=anchor('/', 'Wishlist')?></h1>
	</div>

	<div id="container">
		<div id="navigation">
			<?=$navigation_menu?>
		</div>

		<div id="account-menu">
			<?=$account_menu?>
		</div>

		<div id="content">
			<h2><?=$template->long_title?></h2>
			<?=$template->content?>
		</div>
	</div>

	<div id="footer">
		<div id="benchmark">Page generated in <?=$this->benchmark->elapsed_time()?> seconds</div>

		<div id="copy-notice">Wishlist &copy; <?=date('Y')?></div>
	</div>
</div>
</body>
</html>

<script src="<?=base_url()?>serve/?b=js&f=jquery-1.6.1.min.js,common.js"></script>
<?=$template->scripts?>