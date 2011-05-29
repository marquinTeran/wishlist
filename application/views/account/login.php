<p>Don't have an account? <?=anchor('account/signup', 'Sign Up')?></p>

<?=form_open(($return = $this->input->get('return')) ? "account/login?return={$return}" : 'account/login')?>
	<?php if ($validate && ! $login): ?>
	<div class="error">
		The username / email and password you entered were incorrect.
	</div>
	<?php endif; ?>

	<div>
		<label for="identifier">Username / Email</label>
		<input type="text" name="identifier" id="identifier" value="<?=set_value('identifier')?>" />
		<?=form_error('identifier')?>
	</div>

	<div>
		<label for="password">Password</label>
		<input type="password" name="password" id="password" />
		<?=form_error('password')?>
	</div>

	<div id="controls">
		<button type="submit" name="log-in" id="log-in" class="button">Log In</button>
	</div>
<?=form_close()?>