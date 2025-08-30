# Moodle Plugin: local_resume
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
**Resume Button for Moodle Courses and Sections**  
This plugin provides a smart "Resume" or "Start Again" button that helps learners continue from where they left off in a course or section. It supports Moodle versions **4.2 to 5.0+**.

---/**
 * @package     local_resume
 * @copyright   2025 Rudraksh Batra <batra.rudraksh@gmail.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

## ✨ Features

- ✅ Shows a **Resume** button linking to the last viewed activity (per course or section).
- ✅ Automatically switches to **Start Again** if all activities are completed.
- ✅ Works with **completion tracking** and **activity visibility**.
- ✅ Compatible with standard course formats (Topics, Weekly, etc.).
- ✅ Optional **section-level buttons** using AJAX.
- ✅ Skips empty sections with no activities.
- ✅ Can be embedded anywhere with shortcode support using the companion plugin.

---

## 🧩 Companion Plugin: `filter_resumebutton`

To use shortcodes like `[resumebutton courseid=11]` or `[resumebutton sectionid=5]` inside Moodle blocks, pages, or labels, install the companion plugin:  
👉 [filter_resumebutton](https://github.com/rudy_kartson/filter_resumebutton)

---

## 📦 Installation

1. Copy this plugin folder into your Moodle's `local/` directory:
   ```bash
   moodle/local/resume
