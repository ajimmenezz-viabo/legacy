<?php

$feedback_positive = Session::get('feedback_positive');
$feedback_negative = Session::get('feedback_negative');

if (isset($feedback_positive)) {
    foreach ($feedback_positive as $feedback) {
		echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<button aria-label="Close" class="close" data-dismiss="alert" type="button"><span aria-hidden="true"> &times;</span></button>
				' . $feedback . '
			 </div>';
    }
}

if (isset($feedback_negative)) {
    foreach ($feedback_negative as $feedback) {
		echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<button aria-label="Close" class="close" data-dismiss="alert" type="button"><span aria-hidden="true"> &times;</span></button>
				  ' . $feedback . '
			  </div>';
    }
}