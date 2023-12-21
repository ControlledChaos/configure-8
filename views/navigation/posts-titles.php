<?php
/**
 * Titles post navigation template
 *
 * Allows users to navigate between singular posts.
 *
 * @package    Configure 8
 * @subpackage Templates
 * @category   Navigation
 * @since      1.0.0
 */

// Import namespaced functions.
use function CFE_Func\{
	plugin,
	lang,
	loop_url
};
use function CFE_Tags\{
	prev_key,
	next_key,
	icon
};

// Nav icons.
$link_class = 'posts-nav-title has-icon has-arrow-icon';
$icon_prev  = icon( 'arrow-left', true );
$icon_next  = icon( 'arrow-right', true );
if ( plugin() ) {
	if ( 'none' == plugin()->posts_nav_icon() ) {
		$link_class = 'posts-nav-title';
		$icon_prev  = '';
		$icon_next  = '';
	} elseif ( 'angle' == plugin()->posts_nav_icon() ) {
		$link_class = 'posts-nav-title has-icon has-angle-icon';
		$icon_prev  = icon( 'angle-left', true );
		$icon_next  = icon( 'angle-right', true );
	} elseif ( 'angles' == plugin()->posts_nav_icon() ) {
		$link_class = 'posts-nav-title has-icon has-angles-icon';
		$icon_prev  = icon( 'angles-left', true );
		$icon_next  = icon( 'angles-right', true );
	}
}

if ( prev_key() || next_key() ) :

?>
<nav class="page-navigation" data-page-navigation>
	<ul class="nav-list pagination-list pagination-titles">
	<?php
	if ( prev_key() ) :
		$prev_page = new \Page( prev_key() );
	?>
		<li id="prev-post">
			<a class="<?php echo $link_class; ?>" href="<?php echo $prev_page->permalink(); ?>" rel="prev"><?php echo $icon_prev; ?><?php echo $prev_page->title(); ?></a>
		</li>
	<?php
	endif;

	if ( next_key() ) :
		$next_page = new \Page( next_key() );
	?>
		<li id="next-post">
			<a class="<?php echo $link_class; ?>" href="<?php echo $next_page->permalink(); ?>" rel="next"><?php echo $next_page->title(); ?><?php echo $icon_next; ?></a>
		</li>
	<?php endif; ?>
	</ul>
</nav>
<?php endif;
