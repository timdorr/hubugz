<?php

require_once 'Bee/Controller.php';
require_once 'HTTP/Request2.php';

class App_Controller extends Bee_Controller
{
    protected $req_get  = false;
    protected $req_post = false;

    public $current_user = null;

    public function __construct( $config )
    {
        if( $_SERVER['REQUEST_METHOD'] == 'GET' )
            $this->req_get = true;

        if( $_SERVER['REQUEST_METHOD'] == 'POST' )
            $this->req_post = true;
            
        parent::__construct( $config );
    }

    public function _setup()
    {
        // Need Step 1 of OAuth
        if( ( !isset( $this->config['oauth_id'] ) || !isset( $this->config['oauth_secret'] ) ) && $this->action != 'oauth' )
            $this->redirect( 'oauth' );
            
        // Need Step 2 of OAuth
        if( !isset( $this->config['oauth_token'] ) && $this->action != 'oauth' )
            $this->redirect( 'oauth/token' );
            
        // Make it easier to access the default project
        if( isset( $this->config['default_project'] ) )
            $this->_project = $this->config['default_project'];
        elseif( isset( $this->input['project'] ) )  
            $this->_project = $this->input['project'];
            
        // Get the current user, if there is one
        $user = UserQuery::create()->findOneByID( $this->sess['user_id'] );
        if ( !is_null( $user ) )
        {
            $this->current_user = $user;
            $this->sess['user_id'] = $user->getID();
        } 
        else 
            $this->current_user = new User();
        
        // Force login
        if( $this->current_user->getID() == 0 && $this->method != 'login' )
            $this->redirect( 'login' );
    }
    
    protected function _githubCall( $url, $data = null )
    {
        $req = new HTTP_Request2( 'https://github.com/api/v2/json/' . $url . "?access_token={$this->config['oauth_token']}" );
        $req->setConfig(array('timeout' => 10));
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
            
            if( $res->getStatus() == 200 || $res->getStatus() == 201 )
                return json_decode( $res->getBody() );
            else
            {
                $this->sess['gh_lasterror'] = print_r( $res, true ) . "\n" . print_r( $req, true );
                $this->redirect( 'index/gherror' );
            }
        } 
        catch( Exception $e ) 
        {
            return $e;
        }
    }
         
}
