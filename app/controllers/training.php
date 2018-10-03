<?php

class TrainingController extends BasicController
{
	public function t1 ()
	{
		$this->set ( 'printVal', 'Hello World' );
	}

	public function t2 ()
	{
		$this->view->list = array ( 'H1', 'H2' );
	}
}

?>
