{include file="header.tpl" title=foo}
<style>
	form input {
		font-weight: bold;
		background-color: #5B74A8; 
		color: white;
		border-width: 1px;
		border-bottom-color: #1A356E;
		border-left-color: #29447E;
		border-right-color: #29447E;
		border-top-color: #29447E;
		cursor: hand;
	

	}
</style>

<br><br>
<form name="profile-action" method="POST" action="profile.php">
	{if $hasCreateProfile eq 0}
		<div class="warning">
		Vyzera to, ze este nemate vygenerovany svoj profil. Vygenerujete ho stlacenim tlacidla Generate.
		</div>
		<input type="submit" name="generate" value="generate"> 
	{else}
		<input type="submit" name="delete" value="delete"> Vase slova z profilu si mozete prezriet na zalozke MyWords.
	{/if}
</form>
{include file="footer.tpl"}
