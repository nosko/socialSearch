{include file="header.tpl"}
<script>
{literal}
$(document).ready(function() {	
	$("input#autocomplete").autocomplete({
		source: function(request, response){
			$.get("./suggest.php?words", {word:request.term}, function(word){     
				response($.map(word, function(item) {
					return {
						label: item[0] + "  [" + item[1] + "]",
						value: item[0]
					}
					}))
			}, "json");
		},
		minLength: 1,
		dataType: "json",
		cache: false,
		focus: function(event, ui) {
			return false;
		},
		select: function(event, ui) {
			this.value = ui.item.label;
			/* Do something with user_id */
			return false;
		}
	});
	
	$("input#autocomplete").keyup(function(event){
		$.getJSON("./suggest.php?likes&word="+$("input#autocomplete").val(), function(data) {
		
			
		
		  var items = [];
			$(".results").html("<ul>");
			$(".results2").html("<ul>");
			$.map(data.name, function(item) {
				$(".results").append("<li>"+item+"</li>");
			});
			
			$.map(data.words, function(item) {
				//if ($("input#autocomplete").val().length <=2) return;
				//$(".results2").append("<li>"+item[0]+" ["+item[1]+"]</li>");
			});
			
			$(".results").append("</ul>");
			$(".results2").append("</ul>");
		});
		 
	});
	
	
});
</script>
{/literal}
<input id="autocomplete" /><br><br>
<div style="float: left;">
{$result}
</div>
<div style="float: left; margin-left: 50px;">
	<ul class="results">
	</ul>
</div>
<div style="margin-left: 150px;">
	<ul class="results2">
	</ul>
</div>
<br clear="both">
{include file="footer.tpl"}
