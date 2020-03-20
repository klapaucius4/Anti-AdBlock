<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://michalkowalik.pl
 * @since      1.0.0
 *
 * @package    Anti_AdBlock
 * @subpackage Anti_AdBlock/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->


<div id="anti-adblock-admin-container" class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="wrap">
                <h2 class="title"><?php echo esc_html( get_admin_page_title() ); ?></h2>
                <form action="options.php" method="post">
                    <?php
                        settings_fields( $this->plugin_name );
                        do_settings_sections( $this->plugin_name );
                        submit_button();
                    ?>
                </form>
            </div>
        </div>
    </div>

    <div class="detected-adblock">
        <div class="row">
            <div class="col-12">
                <div class="wrap">
                    <h2 class="title"><?php echo esc_html( get_admin_page_title() ); ?></h2>

                    <div class="row">
                        <div class="col-md-2">
                            <!-- SVG Start -->
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" x="0px" y="0px" viewBox="0 0 468.293 468.293" style="enable-background:new 0 0 468.293 468.293;" xml:space="preserve">
                            <path style="fill:#D15241;" d="M234.146,0C104.898,0,0,104.898,0,234.146s104.898,234.146,234.146,234.146
                                s234.146-104.898,234.146-234.146S363.395,0,234.146,0z M66.185,234.146c0-93.034,75.551-168.585,167.961-168.585
                                c34.966,0,68.059,10.615,94.907,29.346L95.532,329.054C76.8,302.205,66.185,269.112,66.185,234.146z M234.146,402.107
                                c-34.966,0-68.059-10.615-94.907-29.346l233.522-233.522c18.732,26.849,29.346,59.941,29.346,94.907
                                C402.107,327.18,327.18,402.107,234.146,402.107z"/>
                            </svg>
                            <!-- SVG End -->
                        </div>
                        <div class="col-md-10">
                            <p><?= __('You have enabled AdBlock extension in your browser.') ?></p>
                            <p><?= __('To well plugin operation you have to disable all ad blocking extensions for your entire Wordpress website (also WordPress Admin).') ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
(function( $ ) {
	'use strict';
    $( document ).ready(function() {
        if(!document.getElementById('fGheL49czm9jNWvh')){
            $('#anti-adblock-admin-container > *').hide();
            $('#anti-adblock-admin-container .detected-adblock').show();
        }
    });
})( jQuery );
</script>