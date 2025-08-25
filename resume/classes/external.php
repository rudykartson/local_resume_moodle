<?php
/**
 * @package     local_resume
 * @copyright   2025 Rudraksh Batra <batra.rudraksh@gmail.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_resume;

defined('MOODLE_INTERNAL') || die();
// ✅ Required for external_api
require_once(__DIR__ . '/../../../lib/externallib.php');

// ✅ Required to access your plugin's function
global $CFG;
require_once($CFG->dirroot . '/local/resume/lib.php');

use external_api;
use external_function_parameters;
use external_value;
use external_single_structure;

class external extends external_api {

    public static function get_resume_button_parameters() {
        return new external_function_parameters([
            'courseid' => new external_value(PARAM_INT, 'Course ID'),
            'sectionid' => new external_value(PARAM_INT, 'Section ID'),
        ]);
    }

    public static function get_resume_button($courseid, $sectionid) {
        // ✅ Use global function
        $html = \local_resume_render_resume_button($courseid, $sectionid);
        return ['html' => $html];
    }

    public static function get_resume_button_returns() {
        return new external_single_structure([
            'html' => new external_value(PARAM_RAW, 'Rendered HTML for resume button'),
        ]);
    }
}
