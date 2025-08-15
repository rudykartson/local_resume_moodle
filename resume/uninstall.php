<?php
// This file is part of the local_resume plugin for Moodle - http://moodle.org/
//
// It removes all plugin settings on uninstall.

defined('MOODLE_INTERNAL') || die();

// Remove all plugin configuration settings.
$pluginconfigprefix = 'local_resume';
unset_all_config_for_plugin($pluginconfigprefix);