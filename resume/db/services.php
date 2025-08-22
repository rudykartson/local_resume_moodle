/**
 * @package     local_resume
 * @copyright   2025 Rudraksh Batra <batra.rudraksh@gmail.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$functions = [
    'local_resume_render_section_button' => [
        'classname'   => 'local_resume\external\render_section_button',
        'methodname'  => 'execute',
        'classpath'   => '', // Autoloaded
        'description' => 'Return the rendered resume button for a section.',
        'type'        => 'read',
        'ajax'        => true,
        'capabilities' => 'moodle/course:view',
    ],
];
