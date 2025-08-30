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

define(['jquery', 'core/ajax'], function($, Ajax) {
    const SELECTOR = '[id^="section-"], .section.main, .topics .section, .weeks .section, .flexsections .section, .onetopic .section';

    const init = () => {
        $(document).ready(() => {
            $(SELECTOR).each(function() { 
                const sectionDiv = $(this);
                let sectionid = sectionDiv.attr('id');
                if (!sectionid) return;

                sectionid = sectionid.replace(/[^\d]/g, '');
                if (!sectionid) return;

                const courseid = M.cfg.courseId || $('[data-courseid]').data('courseid');
                if (!courseid) return;

                if (sectionDiv.find('.resume-section-btn').length > 0) return;

                const btnHolder = $('<div class="resume-section-btn" style="margin:0.5em 0;"></div>');

                const modList = sectionDiv.find('.section .activity, .activity').first();
                if (modList.length > 0) {
                    btnHolder.insertBefore(modList);
                } else if (sectionDiv.find('.summary').length > 0) {
                    sectionDiv.find('.summary').after(btnHolder);
                } else {
                    const title = sectionDiv.find('.sectionname, .section-title, h3, h2').last();
                    if (title.length > 0) {
                        title.after(btnHolder);
                    } else {
                        sectionDiv.append(btnHolder);
                    }
                }

                Ajax.call([{
                    methodname: 'local_resume_get_resume_button',
                    args: {
                        courseid: courseid,
                        sectionid: sectionid
                    },
                    done: function(response) {
                        // console.log('Button HTML received:', response.html);
                        btnHolder.html(response.html);
                    },
                    fail: function(error) {
                        console.error('Failed to load resume button:', error);
                    }
                }]);


            });

            // Prevent button click from toggling sections
            $(document).on('click', '.resume-section-btn input[type=submit]', function(e) {
                e.stopPropagation();
            });
        });
    };

    return {
        init
    };
});
