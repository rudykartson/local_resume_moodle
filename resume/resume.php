<?php

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
        redirect(new moodle_url('/course/view.php', ['id' => $courseid]), $customalldonemsg, null, \core\output\notification::INFO);
    }

}

