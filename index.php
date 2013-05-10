<?php
error_reporting(E_ALL);
require('Source/UserAgentParser.php');

$data = json_decode(file_get_contents('Tests/user_agents.json'), true);
// print_r(json_encode($data)); die();

echo '<h1>Test Suite</h1>';

$result = array('fail' => array(), 'pass' => array());

foreach( $data as $agent => &$row ) {

	$x = parse_user_agent($agent);
	$row = array('expected' => $row, 'received' => $x, 'agent' => $agent);
	
	if($row['expected'] != $row['received']) {
		$result['fail'][] = $row;
	}else{
		$result['pass'][] = $row;
	}
}

foreach( $result['fail'] as $row ) {

	echo '<div class="row fail">';
	echo '<div class="aspects incorrect">';
	aspects( $row['received'] );
	echo '</div>';

	echo '<div class="aspects">';
	aspects( $row['expected'] );
	echo '</div>';

	echo '<small>'. $row['agent'] .'</small><br />';

	echo '</div>';

}

foreach( $result['pass'] as $row ) {
	
	echo '<div class="row">';

	echo '<div class="aspects">';
	aspects( $row['received'] );
	echo '</div>';

	echo '<small>'. $row['agent'] .'</small><br />';

	echo '</div>';

}

function aspects($aspect) {
	echo '<div class="version">' .  $aspect['version'] .  '</div>';
	echo '<div class="browser">' .  $aspect['browser'] .  '</div>';
	if( $aspect['platform'] ) {
		echo '<div class="platform">' . $aspect['platform'] . '</div>';
	}
}

?>
<style type="text/css">

div.row {
	background: #a0b96a;
	border-bottom: 1px solid #eee;
	font-size: 10px;
}

div.row.fail {
	background: #b96a6a;
	font-size: 12px;
}

div.row br {
	clear: both;
}

div.row small {
	display: block;
	font-size: .9em;
	padding: 8px 0 0 8px;
}

div.aspects {
	float: right;
	clear: right;
}

div.aspects div {
	float: right;
	color: white;
	padding: 4px;
	text-align: center;
	min-width: 100px;
	margin: 1px;
	border-radius: 3px;
}

div.platform {
	background: #3693c1;	
}

div.version {
	background: #c080e5;	
}

div.browser{
	background: #ed4f23;	
}

div.aspects.incorrect div {
	background: red;
}

body {
	margin: 0; 
	padding: 0;	
	font-size: 11px;
	font-family: Helvetica, Arial;
}

h1 {
	text-align: center;	
}


</style>