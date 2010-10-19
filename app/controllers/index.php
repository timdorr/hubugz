<?php

require_once 'AppController.php';

class Index_Controller extends App_Controller
{
    public function main()
    {
        // If we've got a default project, go there now instead
        if( isset( $this->config['default_project'] ) )
            $this->redirect( 'tickets' );
    
        // Grab the data for the project list
        $user = $this->_githubCall( 'user/show' );
        $repos = $this->_githubCall( 'repos/show/'.$user->user->login );
        
        $this->repos = $repos->repositories;
    }
}