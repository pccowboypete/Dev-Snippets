/*  WITH BULLETS
    shortcode for displaying required posting repeater field from ACF*/

add_shortcode('show_theatres', 'show_theatres_function');
function show_theatres_function()
{
    $pageID = get_the_ID(); // not required if within loop, but doesn't hurt 
    $content = '';

    if (have_rows('theatres', $pageID)) {
        
        $content .= '<h4>IN SELECT THEATRES NOW:</h4>';
        $content .= '<div><table class="level-films-theaters-table">';
        $content .= '<thead>';
            $content .= '<tr>';
                $content .= '<th>Venue</th>';
                $content .= '<th>Location</th>';
                $content .= '<th>Date</th>';
                $content .= '<th>Ticket</th>';
            $content .= '</tr>';
        $content .= '</thead>';
        $content .= '<tbody>';

        while (have_rows('theatres', $pageID)) {
            the_row();

            $content .= '<tr>';
                $content .= '<td>' . get_sub_field('venue') . '</td>';
                $content .= '<td>' . get_sub_field('location') . '</td>';
                $content .= '<td>' . get_sub_field('date') . '</td>';
			
				$ticket_link = get_sub_field('ticket');
				if(strlen($ticket_link) > 0){
					$content .= '<td><a href="'. $ticket_link .'" target="_blank">GET TICKETS</a></td>';	
				}else{
					$content .= '<td></td>';	
				}
                
            $content .= '</tr>';
        }

        $content .= '</tbody>';
        $content .= '</table></div>';
    }
	//return "IN THEATRES NOW:";
    //return "";
	return $content;
}
