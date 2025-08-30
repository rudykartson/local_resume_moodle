<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.
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
