<?php

require_once 'AppController.php';

class Oauth_Controller extends App_Controller
{
    public function main()
    {
        // Skip everything if we're already set up
        if( isset( $this->config['oauth_id'] ) && isset( $this->config['oauth_secret'] ) && isset( $this->config['oauth_token'] ) )
            $this->redirect( '' );
    
        // If we're already configured, we just need a token now.
        if( isset( $this->config['oauth_id'] ) && isset( $this->config['oauth_secret'] ) )
            $this->redirect( 'oauth/token' );
    }
    
    public function token()
    {
        // Go back if we missed a step
        if( !isset( $this->config['oauth_id'] ) || !isset( $this->config['oauth_secret'] ) )
            $this->redirect( 'oauth' );

        // Skip if we're already set up
        if( isset( $this->config['oauth_id'] ) && isset( $this->config['oauth_secret'] ) && isset( $this->config['oauth_token'] ) )
            $this->redirect( '' );
    
    
        $this->url = $_SERVER['HTTP_HOST'].$this->baseURL;
    }
    
    public function callback()
    {
        // Skip if we're already set up
        if( isset( $this->config['oauth_id'] ) && isset( $this->config['oauth_secret'] ) && isset( $this->config['oauth_token'] ) )
            $this->redirect( '' );
    
        // Make sure we got our auth code
        if( !isset( $this->input['code'] ) )
            $this->redirect( 'oauth/token' );
            
        // Exchange for a token
        $req = new HTTP_Request2( "https://github.com/login/oauth/access_token?client_id={$this->config['oauth_id']}&redirect_uri=http://".$_SERVER['HTTP_HOST'].$this->baseURL."oauth/callback&client_secret={$this->config['oauth_secret']}&code={$this->input['code']}" );
        $req->setConfig( 'ssl_verify_peer', false );
        $req->setMethod( HTTP_Request2::METHOD_POST );
        
        try 
        {
            $res = $req->send();
            
            if( 200 == $res->getStatus() )
                $response = $res->getBody();       
        } 
        catch( Exception $e ) 
        {
            $this->err = $e;
        }
        
        // Got a valid response
        if( strstr( $response, 'access_token=' ) )
        {
            $this->token = str_replace( 'access_token=', '', $response );
        }
        else
            $this->err = "Something went wrong";
    }
}