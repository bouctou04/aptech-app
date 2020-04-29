<?php
class Form{

	public function label($for, $title, $class) {
		echo '<label for='.$for.' class='.$class.'>'. $title .'</label>';
	}

	public function input($type, $name, $id, $class, $placeholder=NULL, $value='') {
		echo '<input type='.$type.' name='.$name.' id='.$id.' class='.$class.' placeholder='.$placeholder.' value='.$value.'>';
		//echo '<input type='.$type.' placeholder='.$placeholder.'>';
	}

	public function btn($type, $name, $text, $class) {
		echo '<button type='.$type.' name='.$name.' class='.$class.'>'.$text.'</button>';
	}
}
