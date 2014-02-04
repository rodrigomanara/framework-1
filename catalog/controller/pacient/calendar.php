<?php

class PacientCalendarController extends Controller {

    public function index() {
        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $this->data['menu'] = $this->load->controller('common_menu');


        $week_list = array(
            1 => "Sunday",
            2 => "Monday",
            3 => "Tuesday",
            4 => "Wednesday",
            5 => "Thursday",
            6 => "Friday",
            7 => "Saturday"
        );

        $month = isset($_POST['mes']) ? $_POST['mes'] : date('m');
        $year = isset($_POST['ano']) ? $_POST['ano'] : date('Y');
        (int) $num = cal_days_in_month(CAL_GREGORIAN, (int) $month, $year);

        $this_week = date('W');
        $checked = false;
        $calendar = array();

        for ($i = 1; $i <= $num; $i++) {
            /* make a date */
            $h = date('W', mktime(0, 0, 0, $month, $i, $year));
            $day_week = date('l', mktime(0, 0, 0, $month, $i, $year));

            /* find week */
            if ((int) $h === ((int) ($this_week - 1))) {
                $checked = 'checked';
            } else {
                $checked = '';
            }
            array_push($calendar, array('day' => $i, 'day_week' => $day_week, 'checked' => $checked, 'week' => $h));
        }

        $this->data['calendar'] = $calendar;
        $this->data['week_list'] = $week_list;
        $this->data['month'] = $month;
        $this->data['year'] = $year;

        
        
        
        $this->load->display($this->load->view('pacient/calendar_home', $this->data));
    }
    public function calendar(){
         $week_list = array(
            1 => "Sunday",
            2 => "Monday",
            3 => "Tuesday",
            4 => "Wednesday",
            5 => "Thursday",
            6 => "Friday",
            7 => "Saturday"
        );
        
         $time = 24;
        $month = isset($_POST['mes']) ? $_POST['mes'] : date('m');
        $year = isset($_POST['ano']) ? $_POST['ano'] : date('Y');
        (int) $num = cal_days_in_month(CAL_GREGORIAN, (int) $month, $year);

        $this_week = date('W');
        $checked = false;
        $calendar = array();
        

        for ($i = 1; $i <= $num; $i++) {
            /* make a date */
            $h = date('W', mktime(0, 0, 0, $month, $i, $year));
            $day_week = date('l', mktime(0, 0, 0, $month, $i, $year));

            /* find week */
            if ((int) $h === ((int) ($this_week - 1))) {
                $checked = 'checked';
            } else {
                $checked = '';
            }
            array_push($calendar, array('day' => $i, 'day_week' => $day_week, 'checked' => $checked, 'week' => $h));
        }

        $this->data['calendar'] = $calendar;
        $this->data['week_list'] = $week_list;
        $this->data['month'] = $month;
        $this->data['year'] = $year;

        
        
        
        $this->load->display($this->load->view('pacient/calendar_calendar', $this->data));
    }

}

?>
