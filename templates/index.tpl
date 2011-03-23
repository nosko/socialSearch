{include file="header.tpl" title=foo}
<br>
{if $logged}
Verzia 0.00001 alfa RC<br><br>
Comming soon...<br><br>

Zatial velmi strucne info:<br>
V zalozke profile vygenerovat profile<br>
V zalozke My words budu nasledne dostupne slova<br>
{else}
<div class="error">Prihlaste sa prosim.</div>
{/if}
{include file="footer.tpl"}
