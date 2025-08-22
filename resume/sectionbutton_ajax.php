<?php

/**
 * @package     local_resume
 * @copyright   2025 Rudraksh Batra <batra.rudraksh@gmail.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__.'/../../config.php');
require_login();
header('Content-Type: text/html; charset=utf-8');

$courseid = required_param('courseid', PARAM_INT);
$sectionid = required_param('sectionid', PARAM_INT);

require_once($CFG->dirroot . '/local/resume/lib.php');
echo local_resume_render_resume_button($courseid, $sectionid);

exit;
