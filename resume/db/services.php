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



// $functions = [
//     'local_resume_render_section_button' => [
//         'classname'   => 'local_resume\external\render_section_button',
//         'methodname'  => 'execute',
//         'classpath'   => '', // Autoloaded
//         'description' => 'Return the rendered resume button for a section.',
//         'type'        => 'read',
//         'ajax'        => true,
//         'capabilities' => 'moodle/course:view',
//     ],
// ];

$functions = [
    'local_resume_get_resume_button' => [
        'classname'   => 'local_resume\external',
        'methodname'  => 'get_resume_button',
        'classpath'   => '',
        'description' => 'Get resume button HTML',
        'type'        => 'read',
        'ajax'        => true,
    ],
];


$services = [
    'Resume Button API Service' => [
        'functions' => ['local_resume_get_resume_button'],
        'enabled' => 1,
        'restrictedusers' => 0,
    ],
];