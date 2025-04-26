<?php
defined('MOODLE_INTERNAL') || die();

function block_slider2_pluginfile($course, $cm, $context, $filearea, $args,
                                  $forcedownload, array $options = array()) {
    if ($context->contextlevel !== CONTEXT_BLOCK || $filearea !== 'config_images') {
        return false;
    }
    require_login();

    $itemid = array_shift($args);
    $filename = array_pop($args);
    $filepath = $args ? '/' . implode('/', $args) . '/' : '/';

    $fs = get_file_storage();
    $file = $fs->get_file($context->id, 'block_slider2', 'config_images',
                          $itemid, $filepath, $filename);
    if (!$file) {
        return false;
    }
    send_stored_file($file, 0, 0, $forcedownload, $options);
}
