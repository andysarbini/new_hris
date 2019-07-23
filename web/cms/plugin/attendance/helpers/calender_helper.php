<?php
/**
 * Returns the calendar's html for the given year and month.
 *
 * @param $year (Integer) The year, e.g. 2015.
 * @param $month (Integer) The month, e.g. 7.
 * @param $events (Array) An array of events where the key is the day's date
 * in the format "Y-m-d", the value is an array with 'text' and 'link'.
 * @return (String) The calendar's html.
 */
function build_html_calendar($year, $month, $events = null) {

  // CSS classes
  $css_cal = 'table calendar';
  $css_cal_row = 'calendar-row';
  $css_cal_day_head = 'calendar-day-head';
  $css_cal_day = 'calendar-day';
  $css_cal_day_number = 'day-number';
  $css_cal_day_blank = 'calendar-day-np';
  $css_cal_day_event = 'calendar-day-event';
  $css_cal_event = 'calendar-event';

  // Table headings
  $headings = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

  // Start: draw table
  $calendar =
    "<table class='{$css_cal}'>" .
    "<thead>".
    "<tr class='{$css_cal_row}'>" .
    "<th class='{$css_cal_day_head}'>" .
    implode("</th><th class='{$css_cal_day_head}'>", $headings) .
    "</th>" .
    "</tr>".
    "</thead>";

  // Days and weeks
  $running_day = date('N', mktime(0, 0, 0, $month, 1, $year));
  $days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));

  // Row for week one
  $calendar .= "<tr class='{$css_cal_row}'>";

  // Print "blank" days until the first of the current week
  for ($x = 1; $x < $running_day; $x++) {
    $calendar .= "<td class='{$css_cal_day_blank}'> </td>";
  }

  // Keep going with days...
  for ($day = 1; $day <= $days_in_month; $day++) {

    // Check if there is an event today
    $cur_date = date('Y-m-d', mktime(0, 0, 0, $month, $day, $year));
    $draw_event = false;
    if (isset($events) && isset($events[$cur_date])) {
      $draw_event = true;
    }

    // Day cell
    $calendar .= $draw_event ?
      "<td class='{$css_cal_day} {$css_cal_day_event}'>" :
      "<td class='{$css_cal_day}'>";

    // Add the day number
    $calendar .= "<div class='{$css_cal_day_number}'>" . $day . "</div>";

    // Insert an event for this day
    if ($draw_event) {
      $calendar .=
        "<div class='{$css_cal_event}'>" .
        $events[$cur_date]['text'] .
        "</div>";
    }

    // Close day cell
    $calendar .= "</td>";

    // New row
    if ($running_day == 7) {
      $calendar .= "</tr>";
      if (($day + 1) <= $days_in_month) {
        $calendar .= "<tr class='{$css_cal_row}'>";
      }
      $running_day = 1;
    }

    // Increment the running day
    else {
      $running_day++;
    }

  } // for $day

  // Finish the rest of the days in the week
  if ($running_day != 1) {
    for ($x = $running_day; $x <= 7; $x++) {
      $calendar .= "<td class='{$css_cal_day_blank}'> </td>";
    }
  }

  // Final row
  $calendar .= "</tr>";

  // End the table
  $calendar .= '</table>';

  // All done, return result
  return $calendar;
}

function att_btn($_att_id = ''){

	return '<a class="btn btn-white" href="'.base_url().'attendance/att/'.$_att_id.'">'.($_att_id ? 'Keluar' : 'Masuk').'</a>';
}

function build_html_calendar_vertical($year, $month, $events = null) {

	$css_cal = 'table table-striped';
	$css_cal_row = '';
	$css_cal_day_head = 'calendar-day-head';
	$css_cal_day = 'calendar-day';
	$css_cal_day_number = 'day-number';
	$css_cal_day_blank = 'calendar-day-np';
	$css_cal_day_event = 'calendar-day-event';
	$css_cal_event = 'calendar-event';

	// headings
	
	$headings = ['Tgl', 'Hari', 'In', 'Out'];
	$days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu' ];

	// draw table
	$calendar =
		"<table class='{$css_cal}'>" .
		"<thead>".
		"<tr class='{$css_cal_row}'>" .
		"<th class='{$css_cal_day_head}'>" .
		implode("</th><th class='{$css_cal_day_head}'>", $headings) .
		"</th>" .
		"</tr>".
		"</thead>";
	
	$calendar .= "<tbody>";
	
	$running_day = date('N', mktime(0, 0, 0, $month, 1, $year));
	$days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));

	$_today = date('Y-m-d');
	$_yesterday = date("Y-m-d", strtotime( '-1 days' ) );

	for ($day = 1; $day <= $days_in_month; $day++) {

		$calendar .= "<tr class='{$css_cal_row}'>";
		$cur_date = date('Y-m-d', mktime(0, 0, 0, $month, $day, $year));
		$calendar .= "<td>" . $day . "</td>";
		$calendar .= "<td>" . $days[date('w', strtotime($year.'-'.$month.'-'.$day))] . "</td>";
		
		// if time
		$_time_in  = isset($events[$cur_date]['time_in']) ? $events[$cur_date]['time_in'] : '';
		
		$_time_out = isset($events[$cur_date]['time_out']) ? $events[$cur_date]['time_out'] : '';

		// att button
		if($cur_date != $_today && $cur_date != $_yesterday ){
		
			$calendar .= "<td>". @if_empty($_time_in,'') . "</td>";
			
			$calendar .= "<td>" . @if_empty($_time_out,'') . "</td>";
		
		} else {

			if($cur_date == $_today){
				# sudah masuk belum pulang
				if( isset($events[$cur_date]['time_in']) && !isset($events[$cur_date]['time_out']) ){
		
					$calendar .= "<td>". @if_empty($_time_in,'False') . "</td>";	
		
					$calendar .= "<td>". att_btn($events[$cur_date]['id']) . "</td>";
					
				} 
				# belum masuk & belum pulang
				else if(!isset($events[$cur_date]['time_in']) && !isset($events[$cur_date]['time_out']) ){
					
					$calendar .= "<td>". att_btn() . "</td>";	
		
					$calendar .= "<td>". '' . "</td>";
				}
				else {
				
					$calendar .= "<td>". @if_empty($_time_in,'') . "</td>";
			
					$calendar .= "<td>" . @if_empty($_time_out,'') . "</td>";
				}

			} else { // $_yesterday
				# sudah masuk belum pulang
				if( isset($events[$cur_date]['time_in']) && !isset($events[$cur_date]['time_out']) ){
		
					$calendar .= "<td>". @if_empty($_time_in,'False') . "</td>";	
		
					$calendar .= "<td>". att_btn($events[$cur_date]['id']) . "</td>"; // btn out
					
				} 
				# belum masuk & belum pulang
				else if(!isset($events[$cur_date]['time_in']) && !isset($events[$cur_date]['time_out']) ){
					
					$calendar .= "<td>". '' . "</td>";	
		
					$calendar .= "<td>". '' . "</td>";
				}
				else {
				
					$calendar .= "<td>". @if_empty($_time_in,'') . "</td>";
			
					$calendar .= "<td>" . @if_empty($_time_out,'') . "</td>";
				}
			}
		}
		
		$calendar .= "</tr>";
	}

	$calendar .= "</tbody>";

	return $calendar;
}

function build_html_calendar_vertical_admin($attendance, $year, $month, $status){

	$css_cal = 'table table-striped';
	$css_cal_row = '';
	$css_cal_day_head = 'calendar-day-head';
	$css_cal_day = 'calendar-day';
	$css_cal_day_number = 'day-number';
	$css_cal_day_blank = 'calendar-day-np';
	$css_cal_day_event = 'calendar-day-event';
	$css_cal_event = 'calendar-event';

	// headings
	
	$headings = ['Tgl', 'Hari', 'in', 'out', 'status'];
	$days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu' ];

	// draw table
	$calendar =
		"<table class='{$css_cal}'>" .
		"<thead>".
		"<tr class='{$css_cal_row}'>" .
		"<th class='{$css_cal_day_head}'>" .
		implode("</th><th class='{$css_cal_day_head}'>", $headings) .
		"</th>" .
		"</tr>".
		"</thead>";
	
	$calendar .= "<tbody>";
	
	$running_day = date('N', mktime(0, 0, 0, $month, 1, $year));
	$days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));

	for ($day = 1; $day <= $days_in_month; $day++) {
	
		$tgl = $year.'-'.$month.'-'.($day > 10 ? $day : '0'.$day); 

		$calendar .= "<tr class='{$css_cal_row}'>";
		
		$calendar .= "<td>" . $day . "</td>";
		$calendar .= "<td>" . $days[date('w', strtotime($year.'-'.$month.'-'.$day))] . "</td>";
		$calendar .= "<td>" . @if_empty($attendance[$tgl]['time_in'],'') . "</td>";
		$calendar .= "<td>" . @if_empty($attendance[$tgl]['time_out'],'') . "</td>";
		$_input	= @if_empty($attendance[$tgl]['att_id'], 0).",\"".$tgl."\"";
		$calendar .= "<td>" . "<button onclick='load_form_ubah(".$_input.");false;' class='btn btn-info btn-sm'>";
		
		if(@if_empty($attendance[$tgl]['status'])) $calendar .= $status[$attendance[$tgl]['status']];
		
		else $calendar .= "ubah";
		
		$calendar .= "</button>" . "</td>";
		
		$calendar .= "</tr>";
	}

	$calendar .= "</tbody>";

	return $calendar;

}