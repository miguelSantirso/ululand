<?php
if($type == 'filter')
{
	echo select_tag("filters[gender]", options_for_select(array(
		'' => '',
		'0' => 'Male',
		'1' => 'Female',
		'2' => 'Both',
	), isset($filters['gender']) ? $filters['gender'] : ''));
}
else if($type == 'edit')
{
	echo select_tag("item[gender]", options_for_select(array(
		'' => '',
		'male' => 'Male',
		'female' => 'Female',
		'both' => 'Both',
	), isset($item) ? $item->getGender() : ''));
}
?>
