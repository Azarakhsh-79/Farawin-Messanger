
<?php

class massege extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function massege(){
        $this->model->massege();
    }
    
    function get_massage(){
        $this->model->get_massage($_POST);
    }
    

}

?>