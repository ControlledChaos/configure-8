<?php
/**
 * Posts page full content template
 *
 * Used for posts loop, whether on the
 * home page or blog page when a static
 * home page is used.
 *
 * Theme config 'loop' > 'content'
 * must be set to 'full' to use this.
 *
 * @package    Configure 8
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
 */

// Import namespaced functions.
use function BSB_Func\{
	loop_data,
	get_word_count
};
use function BSB_Tags\{
	posts_loop_header,
	loop_style,
	sticky_icon,
	page_description,
	has_tags,
	get_author
};

// If no posts.
if ( empty( $content) ) {
	include( THEME_DIR . 'views/content/no-posts.php' );
	return;
}

// Get blog data.
$loop_data = loop_data();

// Schema article itemtype.
$article_type = 'BlogPosting';
if ( 'news' === THEME_CONFIG['loop']['style'] ) {
	$article_type = 'NewsArticle';
}

// User avatar.
$user = new User( Session :: get( 'username' ) );
if ( $user->profilePicture() ) {
	$avatar  = $user->profilePicture();
	$profile = sprintf(
		'%sedit-user/%s',
		DOMAIN_ADMIN,
		Session :: get( 'username' )
	);
} else {
	$avatar  = DOMAIN_THEME . 'assets/images/avatar-default.png';
	$profile = sprintf(
		'%sedit-user/%s#picture',
		DOMAIN_ADMIN,
		Session :: get( 'username' )
	);
}

echo posts_loop_header();

// If posts, print for each.
foreach ( $content as $post ) :

// Maybe a sticky icon.
$sticky = '';
if ( $post->sticky() ) {
	$sticky = sprintf(
		'%s ',
		sticky_icon(
			'false',
			'sticky-icon-heading',
			$L->get( 'Post is sticky' )
		)
	);
}

// Tags list.
$tags_list = function() use ( $post ) {

	$tags  = $post->tags( true );
	$links = [];
	$sep   = ' ';

	if ( $post->tags( true ) ) {
		$html = '<ul class="post-info-tags inline-list tags-list">';
		foreach ( $tags as $tagKey => $tagName ) {

			$links[] = sprintf(
				'<li><a href="%s" class="tag-list-entry" rel="tag">%s</a></li>',
				DOMAIN_TAGS . $tagKey,
				$tagName
			);
		}
		$html .= implode( $sep, $links );
		$html .= '</ul>';

		return $html;
	}
	return '';
};

?>
<article id="<?php echo $post->uuid(); ?>" class="site-article" role="article" itemscope="itemscope" itemtype="<?php echo 'https://schema.org/' . $article_type; ?>" data-site-article>

	<div class="post-<?php echo THEME_CONFIG['loop']['content']; ?>-content post-<?php echo loop_style(); ?>-content">

		<header class="page-header post-header" data-page-header>
			<h2 class="page-title posts-loop-title">
				<a href="<?php echo $post->permalink(); ?>"><?php echo $sticky . $post->title(); ?></a>
			</h2>
			<?php echo page_description( $post->key() ); ?>
		</header>

		<?php if ( $post->coverImage() ) : ?>
		<figure class="post-cover">
			<a href="<?php echo $post->permalink(); ?>">
				<img src="<?php echo $post->coverImage(); ?>" loading="lazy" />
			</a>
			<figcaption class="screen-reader-text"><?php echo $post->title(); ?></figcaption>
		</figure>
		<?php endif; ?>

		<div class="post-content post-content" itemprop="articleBody" data-post-content>
			<?php echo $post->content(); ?>
		</div>

		<div>
		<footer class="post-info post-<?php echo loop_style(); ?>-info">

			<?php if ( $post->category() ) : ?>
			<h3 class="post-info-category">
				<a href="<?php echo $post->categoryPermalink(); ?>"><?php echo $post->category(); ?></a>
			</h3>
			<?php endif; ?>

			<?php if ( THEME_CONFIG['loop']['byline'] ) : ?>
			<p><span class="post-info-author">
				<?php echo get_author(); ?>
			</span></p>
			<?php endif; ?>

			<?php if ( THEME_CONFIG['loop']['post_date'] ) : ?>
			<p class="post-info-date">
				<?php echo $post->date(); ?>
			</p>
			<?php endif; ?>

			<?php
			if (
				THEME_CONFIG['loop']['word_count'] ||
				THEME_CONFIG['loop']['read_time']
			) : ?>
			<p class="post-info-details">

				<?php if ( THEME_CONFIG['loop']['word_count'] ) : ?>
				<span class="post-info-word-count">
					<?php $L->p( 'page-word-count' ); echo get_word_count( $post->key() ); ?>
				</span>
				<?php endif; ?>

				<?php if ( THEME_CONFIG['loop']['read_time'] ) : ?>
				<span class="post-info-read-time">
					<?php $L->p( 'page-read-time' ); echo $post->readingTime(); ?>
				</span>
				<?php endif; ?>
			</p>
			<?php endif; ?>

			<?php if ( $post->tags( true ) ) {
				echo $tags_list();
			} ?>
		</footer></div>
	</div>

</article>
<?php endforeach; ?>

<?php

// Get page navigation.
if ( 'numerical' == THEME_CONFIG['loop']['paged'] ) {
	include( THEME_DIR . 'views/navigation/paged-numerical.php' );
} else {
	include( THEME_DIR . 'views/navigation/paged-prev-next.php' );
}
