<?php
function draw_table($queryresult){
    $table_html = '<table border="2" style="background-color:rgba(155, 192, 240, 0.35); min-width: 683px; max-width:683px; font-size: 14px; margin-top: 40px;">';
    $table_html .= '<tr>';
    $names = ['Zaznacz', 'Użytkownik', 'Ilość godzin', 'Data', 'Status', 'Komentarz'];
    foreach ($names as $name) {
        $table_html .= '<th>' . $name . '</th>';
    }
    $table_html .= '</tr><tr>';

    while($querytoacc = mysqli_fetch_array($queryresult)) {
        $temp = $querytoacc['5'];
        if (strlen($temp) >= 35) {
            $temp = substr($querytoacc['5'], 0, 35);
            $temp .= "<br>";
            $temp .= substr($querytoacc['5'], 35, 35);
        }
        $queryelements = ["<input type='checkbox' name='checkbox' value='{$querytoacc['id']}' />", "{$querytoacc['1']}", "{$querytoacc['2']}", "{$querytoacc['3']}", "{$querytoacc['4']}", "$temp"];
        foreach ($queryelements as $element) {
            $table_html .= '<th><div class="wrap">' .$element. '</div></th>';
        }
        $table_html .= '</tr><tr>';
    }

    $table_html .= '</tr></table>';
    return $table_html;
}
function draw_usertable($queryresult){
    $table_html = '<table border="2" style="background-color:rgba(155, 192, 240, 0.35); min-width: 683px; max-width:683px; font-size: 14px; margin-top: 40px;">';
    $table_html .= '<tr>';
    $names = ['Ilość godzin', 'Data', 'Status', 'Komentarz'];
    foreach ($names as $name) {
        $table_html .= '<th>' . $name . '</th>';
    }
    $table_html .= '</tr><tr>';

    while($querytoacc = mysqli_fetch_array($queryresult)) {
        $temp = $querytoacc['5'];
        if (strlen($temp) >= 35) {
            $temp = substr($querytoacc['5'], 0, 35);
            $temp .= "<br>";
            $temp .= substr($querytoacc['5'], 35, 35);
        }
        $queryelements = ["{$querytoacc['2']}", "{$querytoacc['3']}", "{$querytoacc['4']}", "$temp"];
        foreach ($queryelements as $element) {
            $table_html .= '<th><div class="wrap">' .$element. '</div></th>';
        }
        $table_html .= '</tr><tr>';
    }

    $table_html .= '</tr></table>';
    return $table_html;
}
function draw_admintable($queryresult){
    $table_html = '<table border="2" style="background-color:rgba(155, 192, 240, 0.35); min-width: 450px; max-width:450px; font-size: 14px;">';
    $table_html .= '<tr>';
    $names = ['Zaznacz', 'Użytkownik', 'Data', 'Status'];
    foreach ($names as $name) {
        $table_html .= '<th>' . $name . '</th>';
    }
    $table_html .= '</tr><tr>';

    while($querytoacc = mysqli_fetch_array($queryresult)) {
        $temp = $querytoacc['3'];
        if (strlen($temp) >= 35) {
            $temp = substr($querytoacc['5'], 0, 35);
            $temp .= "<br>";
            $temp .= substr($querytoacc['5'], 35, 35);
        }
        $queryelements = ["<input type='checkbox' name='checkboxadmin' value='{$querytoacc['id']}' />", 
        "{$querytoacc['1']}", 
        "{$temp}", 
        "{$querytoacc['4']}"];
        foreach ($queryelements as $element) {
            $table_html .= '<th><div class="wrap">' .$element. '</div></th>';
        }
        $table_html .= '</tr><tr>';
    }

    $table_html .= '</tr></table>';
    return $table_html;
}