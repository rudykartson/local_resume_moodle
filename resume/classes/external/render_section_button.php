<?php

/**
 * @package     local_resume
 * @copyright   2025 Rudraksh Batra <batra.rudraksh@gmail.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_resume\external;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/externallib.php');

use external_api;
use external_function_parameters;
use external_value;

class render_section_button extends external_api {
    public static function execute_parameters() {
        return new external_function_parameters([
            'courseid' => new external_value(PARAM_INT, 'Course ID'),
            'sectionid' => new external_value(PARAM_INT, 'Section ID')
        ]);
    }

    public static function execute($courseid, $sectionid) {
        global $PAGE;
        require_login($courseid);

        $output = local_resume_render_resume_button($courseid, $sectionid);
        return $output;
    }

    public static function execute_returns() {
        return new external_value(PARAM_RAW, 'HTML of resume button');
    }
}
