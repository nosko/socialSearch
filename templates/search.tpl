{include file="header.tpl" title=foo}

<form method="POST" name="search-form">
	<input type="text" name="text">
	<input type="submit" name="submit">
</form>

{if $submit}
	<div style='float: left; margin-right: 10px;'><h2>Your key words</h2>
	{$yourWords}
	</div>
	<div style='float: left; margin-right: 10px;'><h2>Web key words</h2>
	{$webWords}
	</div>
	<div style='float: left; margin-right: 10px;'><h2>Facebook search</h2>
	{$fbWords}
	</div>
	<div style='float: left; margin-right: 20px;'><h2>Prienik</h2>
	{$intersection}
	<h2>Sortovany prienik</h2>
	{foreach from=$sortedIntersection item=item}
		[{$item[0]} : {$item[1]} : {$item[2]}] {$item[3]}<br>
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
