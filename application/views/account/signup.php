<p>Already have an account? <?=anchor('account/login', 'Log in')?></p>

<?=form_open('account/signup', 'method="post" class="tabbed')?>
<div>
    <label for="username">Username</label>
    <input type="text" name="username" id="username" maxlength="32" value="<?=set_value('username')?>" />
    <?=form_error('username')?>
</div>

<div>
    <label for="password">Password</label>
    <input type="password" name="password" id="password" />
    <?=form_error('password')?>
</div>

<div>
    <label for="password_confirm">Confirm Password</label>
    <input type="password" name="password_confirm" id="password_confirm" />
</div>

<div>
    <label for="email">Email Address</label>
    <input type="text" name="email" id="email" maxlength="255" value="<?=set_value('email')?>" />
    <?=form_error('email')?>
</div>

<div>
    <label for="country">Country</label>
    <select name="country" id="country">
        <?php foreach ($countries as $key => $country): ?>
        <option value="<?=$country->getIso()?>"<?=$selected_country == $country->getIso() ? ' selected="selected"' : ''?>><?=$country->getName()?></option>
        <?php endforeach; ?>
    </select>
    <?=form_error('country')?>
</div>

<div id="controls">
    <button type="submit" name="sign_up" id="sign_up" class="button">Sign Up</button>
</div>
<?=form_close()?>