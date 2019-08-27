<?php
$tags = get_tags(array("get"=>"all"));
$html = '';
foreach ($tags as $tag) {
    $html .= "'{$tag->name}',";
}
?>

<script>
    jQuery(document).ready(function(){
        jQuery('#tag').tokenfield({
            autocomplete:{
                source: [<?php echo $html; ?>],
                delay:100,
            },
            showAutocompleteOnFocus: true,
        });
    });
    jQuery('#tag').on('tokenfield:createtoken', function (event) {
        var existingTokens = jQuery(this).tokenfield('getTokens');
        jQuery.each(existingTokens, function(index, token) {
            if (token.value === event.attrs.value)
                event.preventDefault();
        });
    });
    jQuery('#tag').on('tokenfield:createdtoken tokenfield:removedtoken', function (event) {
        var field = jQuery(this);
        var currentTokens = field.tokenfield('getTokens');
        var originalSource = field.data('bs.tokenfield').options.autocomplete.source;
        var newSource = originalSource.slice(); 
        for (var i = newSource.length - 1; i >= 0; i--) {
            for (var j = currentTokens.length - 1; j >= 0; j--) {
                if (JSON.stringify(currentTokens[j].label) == JSON.stringify(newSource[i]) 
                || JSON.stringify(currentTokens[j]) == JSON.stringify(newSource[i]) ) {
                var index = newSource.indexOf(newSource[i]);
                if (index > -1) 
                    newSource.splice(index, 1);
                };
            };
        };
        field.data('bs.tokenfield').$input.autocomplete({source: newSource});
        if (jQuery(".tokenfield").find(".token").lenght) {
            jQuery(this).addClass("yes");
        } else {
            jQuery(this).addClass("no");
        }
    });
</script>