<?php
defined('MOODLE_INTERNAL') || die();
require_once($CFG->libdir . '/formslib.php');
require_once($CFG->dirroot . '/blocks/edit_form.php');

class block_slider2_edit_form extends block_edit_form {

    protected function specific_definition($mform) {
        $mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));
        $mform->addElement('text', 'config_interval', get_string('configinterval', 'block_slider2'));
        $mform->setType('config_interval', PARAM_INT);
        $mform->setDefault('config_interval', 3);

        $opts = [
            'subdirs' => 0,
            'maxfiles' => 10,
            'maxbytes' => get_config('moodle', 'maxbytes'),
            'accepted_types' => ['image']
        ];
        $mform->addElement('filemanager', 'config_images', get_string('configimages', 'block_slider2'), null, $opts);
        $mform->setType('config_images', PARAM_RAW);
    }

    public function set_data($defaults) {
        $context = $this->block->context;
        $draftitemid = file_get_submitted_draft_itemid('config_images');
        file_prepare_draft_area($draftitemid, $context->id, 'block_slider2', 'config_images', 0, [
            'subdirs' => 0,
            'maxfiles' => 10,
            'accepted_types' => ['image']
        ]);
        $defaults->config_images = $draftitemid;
        parent::set_data($defaults);
    }
}
