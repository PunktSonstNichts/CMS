<?php
function translate( $text, $domain = 'default' ) {
	$translations = get_translations_for_domain( $domain );
	$translations = $translations->translate( $text );
	return apply_filters( 'gettext', $translations, $text, $domain );
}

function __( $text, $domain = 'default' ) {
	return translate( $text, $domain );
}
function _e( $text, $domain = 'default' ) {
	echo translate( $text, $domain );
}
?>