<?=form_open('account/settings', 'method="post" class="tabbed')?>
<fieldset>
	<legend>Account Information</legend>

	<div>
		<label for="username">Username</label>
		<input type="text" name="username" id="username" maxlength="32" value="<?=set_value('username', $user->getUsername())?>" />
		<?=form_error('username')?>
	</div>

	<div>
		<label for="email">Email Address</label>
		<input type="text" name="email" id="email" maxlength="255" value="<?=set_value('email', $user->getEmail())?>" />
		<?=form_error('email')?>
	</div>

	<div>
		<label for="country">Country</label>
		<select name="country" id="country">
			<?php foreach ($countries as $key => $country): ?>
			<option value="<?=$country->getIso()?>"<?=$country->getIso() == $user->getCountry()->getIso() ? ' selected="selected"' : ''?>><?=$country->getName()?></option>
			<?php endforeach; ?>
		</select>
		<?=form_error('country')?>
	</div>

	<div>
		<label for="language">Language</label>
		<select name="language" id="language">
			<?php foreach ($languages as $iso => $language): ?>
			<option value="<?=$iso?>"<?=$iso == $user->getLanguage() ? ' selected="selected"' : ''?>><?=$language['name']?></option>
			<?php endforeach; ?>
		</select>
		<?=form_error('country')?>
	</div>

	<div>
		<label for="post_code">Post Code</label>
		<input type="text" class="small" name="post_code" id="post_code" maxlength="15" value="<?=set_value('post_code', $user->getPostCode())?>" />
		<span class="note">Optional</span>
		<?=form_error('post_code')?>
	</div>
</fieldset>

<fieldset>
	<legend>Change Password</legend>

	<div>
		<label for="password">Current Password</label>
		<input type="password" name="password" id="password" />
		<?=form_error('password')?>
	</div>

	<div>
		<label for="new_password">New Password</label>
		<input type="new_password" name="new_password" id="new_password" />
		<?=form_error('new_password')?>
	</div>

	<div>
		<label for="password_confirm">Confirm Password</label>
		<input type="password" name="password_confirm" id="password_confirm" />
	</div>
</fieldset>

<div id="controls">
	<?=anchor('account', lang('cancel'), 'class="button"')?>
	<button type="submit" name="save_settings" id="save_settings" class="button">Save Settings</button>
</div>
<?=form_close()?>