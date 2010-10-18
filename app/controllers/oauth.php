<?php

require_once 'AppController.php';

class Oauth_Controller extends App_Controller
{
    public function main()
    {
        // If we're already configured, we just need a token now.
        if( isset( $this->config['oauth_id'] ) && isset( $this->config['oauth_secret'] ) )
            $this->redirect( 'oauth/token' );
    }
    
    public function token()
    {
        // Go back if we missed a step
        if( !isset( $this->config['oauth_id'] ) || !isset( $this->config['oauth_secret'] ) )
            $this->redirect( 'oauth' );
    
    
        $this->url = $_SERVER['HTTP_HOST'].$this->baseURL;
    }
}