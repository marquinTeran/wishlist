<?=form_open('account/settings', 'method="post" class="tabbed')?>
<fieldset>
	<legend><?=lang('account_information')?></legend>

	<div>
		<label for="username">Username</label>
		<input type="text" name="username" id="username" maxlength="32" value="<?=$user->getUsername()?>" disabled />
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
			<option value="<?=$country->getIso()?>"<?=set_select('country', $country->getIso(), $country->getIso() == $user->getCountry()->getIso())?>><?=$country->getName()?></option>
			<?php endforeach; ?>
		</select>
		<?=form_error('country')?>
	</div>

	<div>
		<label for="language">Language</label>
		<select name="language" id="language">
			<?php foreach ($languages as $iso => $language): ?>
			<option value="<?=$iso?>"<?=set_select('language', $iso, $iso == $user->getLanguage())?>><?=$language['name']?></option>
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
	<legend><?=lang('default_wishlist_settings')?></legend>

	<div>
		<label for="public">Visible t</label>
		<select name="visibility" id="visibility">
			<option value=""
		</select>
	</div>
</fieldset>

<div id="controls">
	<?=anchor('account', lang('cancel'), 'class="big negative button"')?>
	<button type="submit" name="save_settings" id="save_settings" class="big button">Save Settings</button>
</div>
<?=form_close()?>