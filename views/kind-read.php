<?php
/*
 * Read Template
 *
 */

$mf2_post = new MF2_Post( get_the_ID() );
$cite     = $mf2_post->fetch( 'read-of' );
if ( ! $cite ) {
	return;
}
$author = Kind_View::get_hcard( ifset( $cite['author'] ) );
$url    = ifset( $cite['url'] );
$embed  = self::get_embed( $url );
$read = $mf2_post->get( 'read-status', true );

?>

<section class="response u-read-of h-cite">
<header>
<?php
echo Kind_Taxonomy::get_before_kind( 'read' );
if ( ! $embed ) {
	if ( ! array_key_exists( 'name', $cite ) ) {
		$cite['name'] = self::get_post_type_string( $url );
	}
	if ( $read ) {
		echo sprintf( ' - <span class="p-read-status">%1s</span>', Kind_View::read_text( $read ) );
	}
	if ( isset( $url ) ) {
		echo sprintf( '<a href="%1s" class="p-name u-url">%2s</a>', $url, $cite['name'] );
	} else {
		echo sprintf( '<span class="p-name">%1s</span>', $cite['name'] );
	}
	if ( $author ) {
		echo ' ' . __( 'by', 'indieweb-post-kinds' ) . ' ' . $author;
	}
	if ( array_key_exists( 'publication', $cite ) ) {
		echo sprintf( ' <em>(<span class="p-publication">%1s</span>)</em>', $cite['publication'] );
	}
}
?>
</header>
<?php
if ( $cite ) {
	if ( $embed ) {
		echo sprintf( '<blockquote class="e-summary">%1s</blockquote>', $embed );
	} elseif ( array_key_exists( 'summary', $cite ) ) {
		echo sprintf( '<blockquote class="e-summary">%1s</blockquote>', $cite['summary'] );
	}
}

// Close Response
?>
</section>

<?php
