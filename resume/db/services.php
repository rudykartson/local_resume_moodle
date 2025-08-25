<?php
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