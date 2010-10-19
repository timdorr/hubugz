<?php

require_once 'Bee/Controller.php';
require_once 'HTTP/Request2.php';

class App_Controller extends Bee_Controller
{

    public function _setup()
    {
        // Need Step 1 of OAuth
        if( ( !isset( $this->config['oauth_id'] ) || !isset( $this->config['oauth_secret'] ) ) && $this->action != 'oauth' )
            $this->redirect( 'oauth' );
            
        // Need Step 2 of OAuth
        if( !isset( $this->config['oauth_token'] ) && $this->action != 'oauth' )
            $this->redirect( 'oauth/token' );
    }

}
