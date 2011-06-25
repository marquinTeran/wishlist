<ul>
	<li><?=$user->getUsername()?> (<?=anchor('account/logout', lang('log_out'))?>)</li>
	<li><?=anchor('account', lang('dashboard'))?></li>
	<li><?=anchor('account/settings', lang('settings'))?></li>
</ul>