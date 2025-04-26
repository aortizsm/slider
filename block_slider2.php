<?php
defined('MOODLE_INTERNAL') || die();

class block_slider2 extends block_base {

    public function init() {
        $this->title = get_string('pluginname', 'block_slider2');
    }

    public function instance_allow_config() {
        return true;
    }

    public function specialization() {
        if (empty($this->config)) {
            $this->config = new stdClass();
        }
        if (!isset($this->config->interval)) {
            $this->config->interval = 3;
        }
    }

    public function instance_config_save($data, $nolongerused = false) {
        $draftitemid = file_get_submitted_draft_itemid('config_images');
        file_save_draft_area_files(
            $draftitemid,
            $this->context->id,
            'block_slider2',
            'config_images',
            0,
            ['subdirs'=>0, 'maxfiles'=>10, 'accepted_types'=>['image']]
        );
        return parent::instance_config_save($data, $nolongerused);
    }

    public function get_content() {
        global $PAGE;

        if ($this->content !== null) {
            return $this->content;
        }
        $this->content = new stdClass();
        $this->content->text = '';

        // Load CSS
        $PAGE->requires->css(new moodle_url('/blocks/slider2/styles.css'));

        // Retrieve images
        $fs = get_file_storage();
        $files = $fs->get_area_files(
            $this->context->id,
            'block_slider2',
            'config_images',
            0,
            'filepath, filename',
            false
        );
        $images = [];
        foreach ($files as $file) {
            if ($file->is_directory() || $file->get_filename() === '.') {
                continue;
            }
            $images[] = moodle_url::make_pluginfile_url(
                $this->context->id,
                'block_slider2',
                'config_images',
                0,
                $file->get_filepath(),
                $file->get_filename()
            )->out();
        }

        if (empty($images)) {
            $this->content->text = html_writer::div(
                get_string('noimages', 'block_slider2'),
                'slider2-noimages'
            );
            return $this->content;
        }

        // Repeat images to have 10
        $count = count($images);
        for ($i = 0; $i < 10 - $count; $i++) {
            $images[] = $images[$i % $count];
        }

        // Build slider HTML
        $id = 'slider2_' . $this->instance->id;
        $html  = html_writer::start_div('slider2-container', ['id' => $id]);
        $html .= html_writer::start_div('slider2-wrapper');
        foreach ($images as $img) {
            $html .= html_writer::empty_tag('img', ['src' => $img, 'class' => 'slider2-image']);
        }
        $html .= html_writer::end_div();
        $html .= html_writer::tag('div', '&#10094;', ['class' => 'slider2-prev']);
        $html .= html_writer::tag('div', '&#10095;', ['class' => 'slider2-next']);
        $html .= html_writer::start_div('slider2-dots');
        for ($i = 0; $i < count($images); $i++) {
            $html .= html_writer::tag('span', '', ['class' => 'slider2-dot', 'data-index' => $i]);
        }
        $html .= html_writer::end_div();
        $html .= html_writer::end_div();

        $this->content->text = $html;

        // Javascript
        $interval = intval($this->config->interval) * 1000;
        $js = <<<JS
(function(){
    var slider = document.getElementById('$id');
    var wrapper = slider.querySelector('.slider2-wrapper');
    var images = wrapper.getElementsByClassName('slider2-image');
    var dots = slider.querySelectorAll('.slider2-dot');
    var prev = slider.querySelector('.slider2-prev');
    var next = slider.querySelector('.slider2-next');
    var current = 0;
    var total = images.length;
    function show(n) {
        if (n < 0) n = total - 1;
        if (n >= total) n = 0;
        wrapper.style.transform = 'translateX(' + (-n * 100) + '%)';
        dots[current].classList.remove('active');
        dots[n].classList.add('active');
        current = n;
    }
    prev.onclick = function(){ show(current - 1); };
    next.onclick = function(){ show(current + 1); };
    for (let i = 0; i < dots.length; i++) {
        dots[i].onclick = (function(index){ return function(){ show(index); }; })(i);
    }
    var auto = setInterval(function(){ show(current + 1); }, $interval);
    slider.onmouseover = function(){ clearInterval(auto); };
    slider.onmouseout = function(){ auto = setInterval(function(){ show(current + 1); }, $interval); };
    show(0);
})(); 
JS;
        $PAGE->requires->js_init_code($js);

        return $this->content;
    }

    public function instance_allow_multiple() {
        return true;
    }

    public function applicable_formats() {
        return ['all' => true];
    }
}
