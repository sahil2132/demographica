<div class="search-form">
<form action="/" method="get">
    <fieldset>
        <label style="display: none;" for="search">Search in <?php echo home_url( '/' ); ?></label>
        <input type="text" name="s" id="searchinput" value="<?php the_search_query(); ?>" />
        <input type="image" alt="Search" id="searchsubmit" src="<?php bloginfo( 'template_url' ); ?>/images/search.png" />
    </fieldset>
</form>
<div style="clear: both;"></div>
</div>