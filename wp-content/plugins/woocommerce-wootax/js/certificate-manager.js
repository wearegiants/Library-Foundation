/**
 * TaxCloud exemption certificate manager
 * Part of the WooTax plugin by Brett Porcelli
 */

var certManager = {
    tcsURL: 'taxcloud.net',
    tcsProtocol: (("https:" == document.location.protocol) ? "https:" : "http:"),
    clickMe: '#'+ clickTarget,
    ajaxURL: woocommerce_params.ajax_url,
    useBlanket: window.useBlanket,
    certificates: {},

    // Determines which window we should display when the target element is clicked 
    certificateInit: function() {
        jQuery( certManager.clickMe ).click( function( e ) {
            e.preventDefault();

            jQuery.magnificPopup.open( {
                items: {
                    src: lbPath + '/manage-certificates.php?pluginPath=' + pluginPath
                },
                type: 'iframe',
                mainClass: 'mfp-fade'
            } );
        } );
    },

    // Refresh cart totals after a certificate has been applied
    applyCertificate: function() {
        // Close popup
        jQuery.magnificPopup.close();

        // Show the "applied certificate" readout
        certManager.triggerUpdateTotals();
    },

    // Stores information about the certificate to be applied to the session before calling applyCertificate
    setCertificate: function( cert ) {
        jQuery.ajax({
            type: 'POST',
            url: certManager.ajaxURL,
            data: 'action=wootax-update-certificate&act=set&cert=' + cert,
            success: function(resp) {
                if ( resp == true ) {
                    if ( cert != '' ) 
                        jQuery( '#wooTaxApplied' ).fadeIn( 'fast' );

                    certManager.applyCertificate();
                } else {
                    alert( resp );
                }
            }
        });
    },

    // Switches the lightbox that is currently being viewed
    switchView: function( lightbox ) {
        // Close current lightbox
        jQuery.magnificPopup.close();

        // If the lightbox path provided contains a URL param, change how pluginPath is added
        var separator = lightbox.indexOf('?') == -1 ? '?' : '&';

        // Open new lightbox
        jQuery.magnificPopup.open( {
            'items': {
                src: lbPath + '/' + lightbox + separator + 'pluginPath=' + pluginPath,
            },
            'type': 'iframe',
            'class': 'mfp-fade'
        } );
    },

    // Trigger update totals
    triggerUpdateTotals: function() {
        jQuery('body').trigger('update_checkout');
    },

    // Remove certificate
    removeCertificate: function() {
        // Apply empty certificate
        certManager.setCertificate( '' );

        // Hide the "applied certificate" readout
        jQuery( '#wooTaxApplied' ).fadeOut( 'fast' );
    },
};

/**
 * Remove certificate when #removeCert is clicked
 */
jQuery( '#removeCert' ).click( function( e ) {
    e.preventDefault();
    certManager.removeCertificate();
} );

/**
 * Initialize manager on page load
 */
jQuery( document ).ready( function( ) {
    certManager.certificateInit();
} );