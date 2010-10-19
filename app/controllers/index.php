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
    
    public function login()
    {
        $this->page_title = 'Login';
        
        // Redirect logged-in users to tickets
        if( !empty( $this->sess['user_id'] ) )
            $this->redirect( 'tickets' ); 
        
        // If we're submitting the form
        if( $this->req_post )
        {
            // Grab a matching user
            $user = UserQuery::create()->findOneByEmail( $this->input['email'] );

            // Check they're valid
            if( is_null( $user ) )
                $this->err = "Incorrect email/password";
            elseif( $user->getPassword() == sha1( $this->input['password'] ) ) 
            {
                $this->sess['user_id'] = $user->getID();
                
                $redirect = ( !empty( $this->sess["login_redirect"] ) ? $this->sess["login_redirect"] : "" );
                unset( $this->sess["login_redirect"] );
                $this->redirect( $redirect );
            } 
            else
                $this->err = "Incorrect email/password.";
        }
    }
    
    public function logout()
    {
        // Remove the user from the session
        unset( $this->sess['user_id'] );
    
        $this->redirect( 'login' );
    }
}