<?php

require_once 'Bee/Controller.php';

class App_Controller extends Bee_Controller
{

    public function _setup()
    {
        if( ( !isset( $this->config['oauth_id'] ) || !isset( $this->config['oauth_secret'] ) ) && $this->action != 'oauth' )
            $this->redirect( 'oauth' );
    }

}
