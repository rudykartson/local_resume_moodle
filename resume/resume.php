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
require_once(__DIR__.'/../../config.php');
require_login();

$courseid = required_param('courseid', PARAM_INT);
$sectionid = optional_param('sectionid', 0, PARAM_INT);

$id = optional_param('id', 0, PARAM_INT); // activity id
$module = optional_param('module', '', PARAM_RAW); // path, e.g. /mod/quiz/view.php

if ($id && $module) {
    // Direct jump to the activity
    redirect(new moodle_url($module, ['id' => $id]));
    exit;
}

// fallback, use original logic
require_once($CFG->dirroot . '/local/resume/classes/local_resume.php');
$customalldonemsg = get_config('local_resume', 'customalldonemsg') ?: get_string('alldone', 'local_resume');

if (\local_resume\local_resume::all_complete($courseid, $USER->id, $sectionid)) {
    $msg = $customalldonemsg;
    redirect(new moodle_url('/course/view.php', ['id' => $courseid]), $msg, null, \core\output\notification::NOTIFY_INFO);
} else {
    $url = \local_resume\local_resume::get_first_activity_url($courseid, $sectionid);
    if ($url) {
        redirect($url);
    } else {
        redirect(new moodle_url('/course/view.php', ['id' => $courseid]), $customalldonemsg, null, \core\output\notification::NOTIFY_INFO);
    }
}