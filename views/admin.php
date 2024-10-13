<?php

/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   OpenPress
 * @author    OpenPress Foundation
 * @license   GPL-2.0+
 * @link      http://openpress.org
 * @copyright 2014 OpenPress Foundation
 */
?>
<div class="wrap" id="openpress">
    <h2 class="title"><?php echo esc_html(get_admin_page_title()); ?></h2>

    <p>Hey there! We’re excited to help you migrate WordPress content over to OpenPress, and this plugin is designed to help with that process by exporting your WP content into a set of files which OpenPress should be able to import cleanly.</p>

    <h3>Things to keep in mind</h3>

    <ol>
        <li>Tags will be migrated, but not categories. If needed, you can <a href="https://wordpress.org/plugins/wpcat2tag-importer/" target="_blank">convert your categories to tags</a> before exporting.</li>
        <li>OpenPress does not have built-in comments, but it does integrate with <a href="https://openpress.org/integrations/?tag=community" target="_blank">many comment platforms</a> if you want to migrate your comments there.</li>
        <li>No custom fields, meta, shortcodes, post types, taxonomies or binary files will be migrated. Just regular <strong>posts</strong>, <strong>pages</strong>, <strong>tags</strong> and <strong>images</strong>.</li>
    </ol>

    <h3>Steps to follow</h3>

    <ol>
        <li>Click the "Download OpenPress file" button. You will receive an import file for OpenPress.</li>
        <li>Log into your OpenPress site, and head to the “Labs” section in admin and import the file.</li>
        <li>Verify that everything is working as expected, and make any manual adjustments.</li>
    </ol>

    <hr>

    <p>Download JSON and Images as a zip file</p>

    <?php
    if (class_exists('ZipArchive')) {
        echo '<form id="wp-2-openpress" method="get">';
        echo '<input type="hidden" name="openpressexport" value="true">';
        submit_button(__('Download OpenPress File'));
        echo '</form>';
    } else {
        echo '<form id="wp-2-openpress" method="get">';
        submit_button(__('Download OpenPress File'), 'primary', 'submit', true, array('disabled' => 'disabled'));
        echo '<p class="description" style="font-style: italic; margin-top: -1.5em;">Cannot create ZIP files. Please enable <code>ZipArchive</code></p>';
        echo '</form>';
    }
    ?>

    <p>Struggling with the zip file? Download the <code>.json</code> instead.<br>Find out how to move your images in the <a href="https://openpress.org/docs/migration/wordpress/#troubleshooting?utm_source=wp-openpress-plugin" target="_blank">WordPress migration guide</a>.</p>

    <form id="wp-2-openpress-json" method="get">
        <input type="hidden" name="openpressjsonexport" value="true">
        <?php submit_button(__('Download JSON'), 'secondary'); ?>
    </form>

    <hr />

    <div id="openpress-diagnostics">
        <?php
        // Set diagnostic variables
        $gMaxExecutionTime = ini_get('max_execution_time');
        $gMemoryLimit = ini_get('memory_limit');
        $openpressMigrator = new openpress();
        $zipArchiveInstalled = (class_exists('ZipArchive')) ? 'Yes' : 'No';
        $wp_upload_dir = wp_upload_dir();
        $wp_upload_basedir = $wp_upload_dir['basedir'];
        ?>

        <h4>OpenPress Migrator <?php echo $openpressMigrator->getopenpressmigratorversion(); ?> - Diagnostics</h4>
        <p>PHP version: <?php echo phpversion(); ?></p>
        <p>PHP ZipArchive Installed: <?php echo $zipArchiveInstalled; ?></p>
        <p>Memory Limit: <?php echo $gMemoryLimit; ?></p>
        <p>Max Execution Time: <?php echo $gMaxExecutionTime; ?></p>
        <p>Media file size: <?php echo size_format(recurse_dirsize($wp_upload_basedir)); ?></p>
    </div>
</div>
