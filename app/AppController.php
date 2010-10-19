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
    
    protected function _githubCall( $url, $data = null )
    {
        $req = new HTTP_Request2( 'https://github.com/api/v2/json/' . $url . "?access_token={$this->config['oauth_token']}" );
        $req->setConfig( 'ssl_verify_peer', false );
        
        // If we have POST data, add it
        if( $data != null )
        {
            $req->setMethod( HTTP_Request2::METHOD_POST );
            $req->addPostParameter( $data );
        }
        
        try 
        {
            $res = $req->send();
            
            if( 200 == $res->getStatus() )
                return json_decode( $res->getBody() );
            else
                return false;        
        } 
        catch( Exception $e ) 
        {
            return $e;
        }
    }
         
}
