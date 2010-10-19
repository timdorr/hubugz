<?php

require_once 'AppController.php';

class Tickets_Controller extends App_Controller
{
    public function main()
    {
        $tickets = $this->_githubCall( 'issues/list/'.$this->_project.'/open' );
        
        // Format the tickets for the page
        foreach( $tickets->issues as $t )
        {
            // Fix times
            $t->updated_at = date( 'm/d/Y g:ia', strtotime( $t->updated_at ) );
            $t->created_at = date( 'm/d/Y g:ia', strtotime( $t->created_at ) );
            
            $this->tickets[] = $t;
        }
        
        $this->tickets = $tickets->issues;
    }
    
    public function show()
    {
    
    }
    
    public function create()
    {
    
    }
}