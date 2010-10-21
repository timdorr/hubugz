<?php

require_once 'AppController.php';

class Tickets_Controller extends App_Controller
{
    public function main()
    {
        $this->page_title = 'Tickets';
    
        $tickets = $this->_githubCall( 'issues/list/'.$this->_project.'/open' );
        
        // Format the tickets for the page
        foreach( $tickets->issues as $t )
        {
            // Fix times
            $t->updated_at = date( 'm/d/Y g:ia', strtotime( $t->updated_at ) );
            $t->created_at = date( 'm/d/Y g:ia', strtotime( $t->created_at ) );
            
            // Find our custom owner
            foreach( $t->labels as $k => $l )
            {
                if( stristr( $l, "Owner_" ) )
                {
                    $t->user = str_replace( "Owner_", "", $l );
                    unset( $t->labels[$k] );
                }
            }
            
            $this->tickets[] = $t;
        }
        
        $this->tickets = $tickets->issues;
    }
    
    public function show( $number )
    {
        // Grab the ticket
        $issue = $this->_githubCall( 'issues/show/'.$this->_project.'/'.intval( $number ) );
        $this->ticket = $issue->issue;
        
        // Grab its comments
        $comments = $this->_githubCall( 'issues/comments/'.$this->_project.'/'.intval( $number ) );
        $this->comments = $comments->comments;
        
        $this->page_title = $this->ticket->title.' (#'.$this->ticket->number.')';
    }
    
    public function create()
    {
        $this->page_title = 'Create A New Ticket';
        
        // If we're submitting the form
        if( $this->req_post )
        {
            // Validate the input
            if( empty( $this->input['title'] ) )
            {
                $this->err = 'You must enter a ticket title';
                return true;
            }
            
            if( empty( $this->input['body'] ) )
            {
                $this->err = 'You must enter a ticket body';
                return true;
            }
            
            if( !isset( $this->input['type'] ) )
            {
                $this->err = 'You must select a type of ticket';
                return true;
            }

            // Add the ticket to the system
            $issue = $this->_githubCall( 'issues/open/'.$this->_project, 
                                          array( 'title' => $this->input['title'],
                                                 'body'  => $this->input['body'] ) );

            $labels = $this->_githubCall( 'issues/label/add/'.$this->_project.'/'.urlencode('Owner_'.$this->current_user->getEmail()).'/'.$issue->issue->number );
            if( $this->input['type'] == 'bug' )
                $labels = $this->_githubCall( 'issues/label/add/'.$this->_project.'/Bug%20Report/'.$issue->issue->number );
            if( $this->input['type'] == 'feature' )
                $labels = $this->_githubCall( 'issues/label/add/'.$this->_project.'/Feature%20Request/'.$issue->issue->number );
            
            $this->redirect( 'tickets' );
        }
    }
}