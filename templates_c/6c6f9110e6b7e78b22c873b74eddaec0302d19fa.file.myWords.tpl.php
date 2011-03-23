<?php /* Smarty version Smarty-3.0.7, created on 2011-03-20 23:28:32
         compiled from "./templates/myWords.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21143022294d867f9047f875-07935434%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6c6f9110e6b7e78b22c873b74eddaec0302d19fa' => 
    array (
      0 => './templates/myWords.tpl',
      1 => 1300660109,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21143022294d867f9047f875-07935434',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
<script>

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

<input id="autocomplete" /><br><br>
<div style="float: left;">
<?php echo $_smarty_tpl->getVariable('result')->value;?>

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
<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
