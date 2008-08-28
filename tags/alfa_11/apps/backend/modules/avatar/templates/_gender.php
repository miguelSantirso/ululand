<?php
if($type == 'filter')
{
	echo select_tag("filters[gender]", options_for_select(array(
		'' => '',
		'0' => 'Male',
		'1' => 'Female',
	), isset($filters['gender']) ? $filters['gender'] : ''));
}
else if($type == 'edit')
{
	echo select_tag("avatar[gender]", options_for_select(array(
		'' => '',
		'male' => 'Male',
		'female' => 'Female',
	), isset($avatar) ? $avatar->getGender() : ''));
}

?>