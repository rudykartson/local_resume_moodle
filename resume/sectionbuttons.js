/**
 * @package     local_resume
 * @copyright   2025 Rudraksh Batra <batra.rudraksh@gmail.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require(['jquery'], function($) {
    $(document).ready(function() {
        $('[id^="section-"], .section.main, .topics .section, .weeks .section, .flexsections .section, .onetopic .section').each(function() {
            var sectionDiv = $(this);
            var sectionid = sectionDiv.attr('id');
            if (!sectionid) return;
            sectionid = sectionid.replace(/[^\d]/g,'');
            if (!sectionid) return;

            var courseid = M.cfg.courseId || $('[data-courseid]').data('courseid');
            if (!courseid) return;

            // Avoid duplicates
            if (sectionDiv.find('.resume-section-btn').length > 0) return;

            var btnholder = $('<div class="resume-section-btn" style="margin:0.5em 0;"></div>');

            // Preferred: Place just before the activities list in the section
            var modlist = sectionDiv.find('.section .activity, .activity').first();
            if (modlist.length > 0) {
                btnholder.insertBefore(modlist);
            } else if (sectionDiv.find('.summary').length > 0) {
                // Otherwise, after the summary
                sectionDiv.find('.summary').after(btnholder);
            } else {
                // Last resort: after section title
                var title = sectionDiv.find('.sectionname, .section-title, h3, h2').last();
                if (title.length > 0) {
                    title.after(btnholder);
                } else {
                    sectionDiv.append(btnholder);
                }
            }

            // AJAX call to render the button
            $.get(M.cfg.wwwroot+'/local/resume/sectionbutton_ajax.php', {
                courseid: courseid,
                sectionid: sectionid
            }, function(html) {
                btnholder.html(html);
            });
        });

        // Prevent section toggle click swallowing for Resume button
        $(document).on('click', '.resume-section-btn input[type=submit]', function(e){
            e.stopPropagation();
        });
    });

});
