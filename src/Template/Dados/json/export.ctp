<?php

	foreach ($dados as &$dado) {
	    unset($dado->generated_html);
	}
	echo json_encode(compact('dados'));

?>