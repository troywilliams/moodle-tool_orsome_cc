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

function tool_orsome_cc_make_component_cohorts(progress_trace $trace = null) {
    global $CFG, $DB;
    require_once($CFG->dirroot . '/cohort/lib.php');
    if (is_null($trace)) {
        $trace = new null_progress_trace();
    }
    $componentcohorts = null;
    include($CFG->dirroot . '/admin/tool/orsome_cc/config/componentcohorts.php');
    if (!$componentcohorts) {
        $trace->output('No cohorts');
    } else {
        $context = context_system::instance();
        $component = 'tool_orsome_cc';
        foreach ($componentcohorts as $componentcohort) {
            $cohort = (object) $componentcohort;
            $cohort->contextid = $context->id;
            $cohort->component = $component;
            $cohort->id = $DB->get_field(
                'cohort', 'id', ['idnumber' => $cohort->idnumber, 'component' => $cohort->component]
            );
            if ($cohort->id) {
                cohort_update_cohort($cohort);
                $trace->output("Updating cohort {$cohort->idnumber}");
            } else {
                cohort_add_cohort($cohort);
                $trace->output("Adding cohort {$cohort->idnumber}");
            }
        }
    }
}