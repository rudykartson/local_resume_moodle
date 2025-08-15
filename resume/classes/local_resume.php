<?php
namespace local_resume;

defined('MOODLE_INTERNAL') || die();

class local_resume {

    // Get first visible activity URL in course or section
    public static function get_first_activity_url($courseid, $sectionid = null) {
        global $CFG;
        require_once($CFG->libdir.'/completionlib.php');

        $modinfo = get_fast_modinfo($courseid);
        $cms = [];

        if ($sectionid !== null) {
            $sectioninfo = $modinfo->get_section_info_all()[$sectionid] ?? null;
            if (!$sectioninfo) return null;
            $cms = $sectioninfo->sequence ? explode(',', $sectioninfo->sequence) : [];
        } else {
            $cms = array_keys($modinfo->cms);
        }

        foreach ($cms as $cmid) {
            if (!$cmid) continue;
            $cm = $modinfo->cms[$cmid];
            if ($cm->uservisible && $cm->completion > 0) {
                return new \moodle_url('/mod/' . $cm->modname . '/view.php', ['id' => $cm->id]);
            }
        }
        return null;
    }

    // Check if visible activities exist in course or section
    public static function has_visible_activities($courseid, $sectionid = null): bool {
        $modinfo = get_fast_modinfo($courseid);
        if (!$modinfo) return false;

        foreach ($modinfo->cms as $cm) {
            if (!$cm->uservisible) continue;
            if ($sectionid !== null && $cm->sectionnum != $sectionid) continue;
            return true;
        }
        return false;
    }

    // Get user's last accessed activity in the course (course-level resume)
    public static function get_last_accessed_activity_url($courseid, $userid) {
        global $DB;

        $sql = "SELECT l.id AS uniqueid, cm.id, m.name AS modname
                  FROM {logstore_standard_log} l
                  JOIN {course_modules} cm ON l.contextinstanceid = cm.id
                  JOIN {modules} m ON cm.module = m.id
                 WHERE l.userid = :userid
                   AND l.courseid = :courseid
                   AND l.target = 'course_module'
                   AND l.action = 'viewed'
              ORDER BY l.timecreated DESC";

        $params = ['userid' => $userid, 'courseid' => $courseid];
        $records = $DB->get_records_sql($sql, $params);

        if ($records) {
            $record = reset($records);
            return new \moodle_url('/mod/' . $record->modname . '/view.php', ['id' => $record->id]);
        }
        return null;
    }

    // Get user's last accessed activity in a section (section-level resume)
    public static function get_last_accessed_activity_url_in_section($courseid, $userid, $sectionid) {
        global $DB;
        $modinfo = get_fast_modinfo($courseid, $userid);
        $sectioninfo = $modinfo->get_section_info_all()[$sectionid] ?? null;
        if (!$sectioninfo) return null;

        $cmids = $sectioninfo->sequence ? explode(',', $sectioninfo->sequence) : [];
        if (empty($cmids)) return null;

        list($insql, $inparams) = $DB->get_in_or_equal($cmids, SQL_PARAMS_NAMED);

        $sql = "SELECT l.id AS uniqueid, cm.id, m.name AS modname
                  FROM {logstore_standard_log} l
                  JOIN {course_modules} cm ON l.contextinstanceid = cm.id
                  JOIN {modules} m ON cm.module = m.id
                 WHERE l.userid = :userid
                   AND l.courseid = :courseid
                   AND l.target = 'course_module'
                   AND l.action = 'viewed'
                   AND cm.id $insql
              ORDER BY l.timecreated DESC";

        $params = ['userid' => $userid, 'courseid' => $courseid] + $inparams;
        $records = $DB->get_records_sql($sql, $params);

        if ($records) {
            $record = reset($records);
            return new \moodle_url('/mod/' . $record->modname . '/view.php', ['id' => $record->id]);
        }
        return null;
    }

    // Check if all activities are completed in course or section
    public static function all_complete($courseid, $userid, $sectionid = null): bool {
        global $CFG;
        require_once($CFG->libdir.'/completionlib.php');
        $modinfo = get_fast_modinfo($courseid, $userid);

        if ($sectionid !== null) {
            $sectioninfo = $modinfo->get_section_info_all()[$sectionid] ?? null;
            if (!$sectioninfo) return true;

            $cmids = $sectioninfo->sequence ? explode(',', $sectioninfo->sequence) : [];
            foreach ($cmids as $cmid) {
                if (isset($modinfo->cms[$cmid])) {
                    $cm = $modinfo->cms[$cmid];
                    if ($cm->uservisible && $cm->completion > 0) {
                        $completion = new \completion_info($cm->get_course());
                        $data = $completion->get_data($cm, false, $userid);
                        if ($data->completionstate == COMPLETION_INCOMPLETE) {
                            return false;
                        }
                    }
                }
            }
        } else {
            foreach ($modinfo->cms as $cm) {
                if ($cm->uservisible && $cm->completion > 0) {
                    $completion = new \completion_info($cm->get_course());
                    $data = $completion->get_data($cm, false, $userid);
                    if ($data->completionstate == COMPLETION_INCOMPLETE) {
                        return false;
                    }
                }
            }
        }
        return true;
    }
}