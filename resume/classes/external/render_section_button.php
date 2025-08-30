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

namespace local_resume\external;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/externallib.php');

use external_api;
use external_function_parameters;
use external_value;

class render_section_button extends \external_api {
    public static function execute_parameters() {
        return new external_function_parameters([
            'courseid' => new external_value(PARAM_INT, 'Course ID'),
            'sectionid' => new external_value(PARAM_INT, 'Section ID')
        ]);
    }

    public static function execute($courseid, $sectionid) {
        global $PAGE;

        self::validate_parameters(self::execute_parameters(), [
            'courseid' => $courseid,
            'sectionid' => $sectionid
        ]);

        // Set context.
        $context = \context_course::instance($courseid);
        self::validate_context($context);
        $PAGE->set_context($context);
        require_capability('moodle/course:view', $context);

        // Business logic.
        $html = local_resume_render_resume_button($courseid, $sectionid);

        return ['html' => $html];
    }

    public static function execute_returns() {
        return new \external_single_structure([
            'html' => new \external_value(PARAM_RAW, 'Resume button HTML')
        ]);
    }
}
