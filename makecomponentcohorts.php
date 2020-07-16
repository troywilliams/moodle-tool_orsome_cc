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

require('../../../config.php');
require_once($CFG->dirroot . '/admin/tool/orsome_cc/locallib.php');

$PAGE->set_context(context_system::instance());
$PAGE->set_url(new moodle_url('/admin/tool/orsome_cc/makecomponentcohorts'));
tool_orsome_cc_make_component_cohorts(new html_list_progress_trace());
redirect(new moodle_url('/cohort/index.php'), 'Redirecting to system cohorts', 2);
