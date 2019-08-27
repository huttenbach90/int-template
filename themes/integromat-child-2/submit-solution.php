<?php
/*
Template Name: Submit solution
*/
?>

<?php get_header(); ?>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>

<div id="content" class="container">

	<div class="row">
        <div class="col-8 paper">
            <h1 class="display-3 mb-5"><?php the_title(); ?></h1>
            <?php echo do_shortcode('[cg-solution]'); ?>
        </div>
    </div>

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
                    delay:100
                },
                showAutocompleteOnFocus: true
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
            var newSource = originalSource.slice(); //clone original autocomplete source
            for (var i = newSource.length - 1; i >= 0; i--) {
            for (var j = currentTokens.length - 1; j >= 0; j--) {
                if (JSON.stringify(currentTokens[j].label) == JSON.stringify(newSource[i]) 
                || JSON.stringify(currentTokens[j]) == JSON.stringify(newSource[i]) ) {
                //remove the token from the newSource
                var index = newSource.indexOf(newSource[i]);
                if (index > -1) 
                    newSource.splice(index, 1);
                };
            };
            };
            //update source
            field.data('bs.tokenfield').$input.autocomplete({source: newSource})
        })
    </script>

</div>