<?php
/**
 * @package     local_resume
 * @copyright   2025 Rudraksh Batra <batra.rudraksh@gmail.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $settings = new admin_settingpage('local_resume', get_string('settings', 'local_resume'));
    $settings->add(new admin_setting_configcheckbox('local_resume/enablecourse',
        get_string('enablecourse', 'local_resume'), '', 1));
    $settings->add(new admin_setting_configcheckbox('local_resume/enablesection',
        get_string('enablesection', 'local_resume'), '', 1));
    $settings->add(new admin_setting_configtext('local_resume/customresumetext',
        get_string('customresumetext', 'local_resume'), '', get_string('resume', 'local_resume')));
    $settings->add(new admin_setting_configtext('local_resume/customstarttext',
        get_string('customstarttext', 'local_resume'), '', get_string('start', 'local_resume')));
    $settings->add(new admin_setting_configtext('local_resume/customalldonemsg',
        get_string('customalldonemsg', 'local_resume'), '', get_string('alldone', 'local_resume')));
    $settings->add(new admin_setting_configselect('local_resume/position',
        get_string('position', 'local_resume'), '', 'top',
        [
            'top' => get_string('top', 'local_resume'),
            'side' => get_string('side', 'local_resume'),
            'inside' => get_string('inside', 'local_resume')
        ]));
    $settings->add(new admin_setting_configcheckbox('local_resume/hideifcomplete',
        get_string('hideifcomplete', 'local_resume'), '', 0));
    $ADMIN->add('localplugins', $settings);
	$settings->add(new admin_setting_configtext(
    'local_resume/customstartagaintext',
    get_string('startagain', 'local_resume'),
    get_string('startagain_desc', 'local_resume'),
    'Start Again'
));

}