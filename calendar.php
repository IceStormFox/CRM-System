<?php
function draw_calendar($month, $year, $work_hours, $status){
    $days_in_month = date('t', mktime(0,0,0,$month,1,$year));
    $first_day_of_month = date('w', mktime(0,0,0,$month,1,$year));
    $calendar_html = '<table border="2" style="font-size:24px; background-color:rgba(155, 192, 240, 0.35);">';

    $calendar_html .= '<tr>';
    $days_of_week = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    foreach ($days_of_week as $day) {
        $calendar_html .= '<th>' . $day . '</th>';
    }
    $calendar_html .= '</tr><tr>';

    for ($i=0; $i<$first_day_of_month; $i++) {
        $calendar_html .= '<td></td>';
    }

    for ($day=1; $day<=$days_in_month; $day++) {
        if ($first_day_of_month % 7 == 0 && $day != 1) {
            $calendar_html .= '</tr><tr >';
        }
        if(isset($status[$day]) && $status[$day] == 'Do zatwierdzenia'){
        $hours = isset($work_hours[$day]) && $work_hours[$day] > 0 ?  '<span style="font-size: 12px; color: yellow;">' . $work_hours[$day] . '</span> <font style="font-size: 12px; color: yellow;"> Hours </font>' : '';
        $calendar_html .= '<td>' . $day . '<br>' . $hours . '</td>';
        $first_day_of_month++;
        }
        else
        {
        $hours = isset($work_hours[$day]) && $work_hours[$day] > 0 ?  '<span style="font-size: 12px; color: purple;">' . $work_hours[$day] . '</span> <font style="font-size: 12px; color: purple;"> Hours </font>' : '';
        $calendar_html .= '<td>' . $day . '<br>' . $hours . '</td>';
        $first_day_of_month++;
        }
    }
    

    $calendar_html .= '</tr></table>';
    return $calendar_html;
}
?>