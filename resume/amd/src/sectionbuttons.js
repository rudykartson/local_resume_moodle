import $ from 'jquery';
import * as Ajax from 'core/ajax';
import * as Notification from 'core/notification';
/**
 * @package     local_resume
 * @copyright   2025 Rudraksh Batra <batra.rudraksh@gmail.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

export const init = () => {
    $('[id^=section-], .section.main, .topics .section, .weeks .section').each(function () {
        const section = $(this);
        const btnholder = section.find('.resumebutton-placeholder');

        if (!btnholder.length) return;

        const courseid = btnholder.data('courseid');
        const sectionid = btnholder.data('sectionid');

        Ajax.call([{
            methodname: 'local_resume_render_section_button',
            args: { courseid, sectionid }
        }])[0]
        .done(html => btnholder.html(html))
        .fail(Notification.exception);
    });

    $(document).on('click', '.resume-section-btn input[type=submit]', function (e) {
        e.stopPropagation();
    });
};
