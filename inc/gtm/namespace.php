<?php
/**
 * Altis Consent Google Tag Manager Integration
 *
 * @package altis/privacy
 */

namespace Altis\Privacy\GTM;

use Altis;

/**
 * Kick it off.
 */
function bootstrap() {
	$consent = Altis\get_config()['modules']['privacy']['consent'];
	$gtm     = Altis\get_config()['modules']['analytics']['google-tag-manager'];

	// Bail if we aren't using the Consent API or GTM.
	if ( ! $consent || ! $gtm ) {
		return;
	}

	add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\enqueue_scripts' );
}

/**
 * Enqueue the GTM consent script and pass through any variables we need on the client side.
 */
function enqueue_scripts() {
	wp_enqueue_script( 'gtm-consent', plugins_url( '/assets/gtm-consent.js', dirname( __FILE__, 2 ) ), [], '6.0', true );

	wp_localize_script( 'gtm-consent', 'altisConsentGtm', [
		// Pass the dataLayer variable name to the javascript.
		'dataLayer' => apply_filters( 'hm_gtm_data_layer_var', 'dataLayer' ),
	] );
}
