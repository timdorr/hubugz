<?php

require_once 'AppController.php';

class Index_Controller extends App_Controller
{
    public function main()
    {
        $user = $this->_githubCall( 'user/show' );
        $repos = $this->_githubCall( 'repos/show/'.$user->user->login );
        
        $this->repos = $repos->repositories;
    }
}