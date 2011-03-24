{include file="header.tpl" title=foo}

{if isset($noProfile)}
<div class="warning">
You have to generate your profile first to use this search. Until you do this, only web and facebook will be used.
</div>
{/if}


<form method="POST" name="search-form">
	<input type="text" name="text">
	<input type="submit" name="submit">
</form>

{if $submit}
	{if isset($yourWords)}
		<div style='float: left; margin-right: 10px;'><h2>Your key words</h2>
		{$yourWords}
		</div>
	{/if}
	<div style='float: left; margin-right: 10px;'><h2>Web key words</h2>
	{$webWords}
	</div>
	<div style='float: left; margin-right: 10px;'><h2>Facebook search</h2>
	{$fbWords}
	</div>
	<div style='float: left; margin-right: 20px;'><h2>Prienik</h2>
	{foreach from=$sortedResults item=item}
		{* if we are searching with profile there will be 3 coloumns *}
		{if isset($yourWords)}
			[{$item[0]} : {$item[1]} : {$item[2]}] {$item[3]}<br>
		{else}
			[{$item[0]} : {$item[1]}] {$item[2]}<br>
		{/if}
	{/foreach}
	</div>
	<div style='float: left; margin-right: 10px;'><h2>Statistika</h2>
	Data z reference spracovane za {$reference}<br>
	Data z wikipedie spracovane za {$wikipedia}<br>
	Data z google spracovane za {$google}<br>
	Data z wordnik spracovane za {$wordnik}<br>
	Data z FB search spracovane za {$facebook}<br>
	</div>
	<br clear="both">
{/if}

{include file="footer.tpl"}
