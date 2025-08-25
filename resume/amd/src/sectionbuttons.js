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
                        // console.log('✅ Button HTML received:', response.html);
                        btnHolder.html(response.html);
                    },
                    fail: function(error) {
                        console.error('❌ Failed to load resume button:', error);
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
