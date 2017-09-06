<?php
function shortcode($code='coname', $show='term', $before_term='', $after_term='', $echo=true) {
	switch ( $code ) {
		case 'coname' :
			$term = 'nSiteful Web Builders, Inc.';
			$abbr = 'nWB';
			$before = '<span class="org">';
			$after = '</span>';
		break;
		
		case 'sacs' :
			$term = 'Southern Association of Colleges and Schools Council on Accreditation and School Improvement';
			$abbr = 'SACS/CASI';
		break;

		case 'serve' :
			$term = '32 countries on 4 continents';
		break;
	}
	$before_code = ( isset($before) ) ? $before : '';
	$after_code = ( isset($after) ) ? $after : '';
	$default_output = $before_code . $term . $after_code;
	switch ( $show ) {
		case 'term' :
			$output = $default_output;
		break;
		
		case 'abbr' :
			if ( isset($abbr) && !empty($abbr) ) {
				$output = '<abbr title="' . $term . '">' . $before_code .  $abbr . $after_code . '</abbr>';
			} else {
				$output = $default_output;
			}
		break;
		
		case 'both' :
			if ( isset($abbr) && !empty($abbr) ) {
				$output = $before_code . $term . $after_code . ' (<abbr title="' . $term . '">' . $abbr . '</abbr>)' ;
			} else {
				$output = $default_output;
			}
		break;
	}
	if ( !$echo ) return $output;
	echo $output;
}

shortcode('sacs', 'abbr');
?>
