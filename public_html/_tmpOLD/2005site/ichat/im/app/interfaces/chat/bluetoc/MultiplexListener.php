<?php
    /**
    * BlueTOC 2.3.000
	* Copyright 2004-2006 sk89q
    * Written by sk89q
	* 
	* This program is free software; you can redistribute it and/or
	* modify it under the terms of the GNU General Public License
	* as published by the Free Software Foundation; either version 2
	* of the License, or (at your option) any later version.
	* 
	* This program is distributed in the hope that it will be useful,
	* but WITHOUT ANY WARRANTY; without even the implied warranty of
	* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	* GNU General Public License for more details.
	* 
	* You should have received a copy of the GNU General Public License
	* along with this program; if not, write to the Free Software
	* Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
    */
     
    /**
     * <code>MultiplexLitener</code> allows using multiple connections in the same script.<br /><br />
     * <phpsnippet>$listener = new MultiplexListener();
     * $listener->add_client(new TimeTellingBot('screenname1', 'password1'));
     * $listener->add_client(new TimeTellingBot('screenname2', 'password2'));
     * $listener->add_client(new TimeTellingBot('screenname3', 'password3'));
     * $listener->run($errno, $errstr);</phpsnippet><br /><br />
     * Note: Using this class can generate error code 0 problems
     *
     * @version 2.3.000
     * @author sk89q
     * @copyright Copyright (c) 2004-2006, sk89q
     */
    class MultiplexListener
    {
        /**
         * List of clients
         * @var array
         */
        var $clients = array();
        /**
         * Timeout until select
         * @var integer
         */
        var $select_timeout = 2;
        
        /**
         * Adds a client to the list to listen to
         * @param TocProtocol $client the client to listen to
         */
        /**
         * Adds a client to the list to listen to
         * @param AimClient $client the client to listen to
         */
        /**
         * Adds a client to the list to listen to
         * @param resource $client the client to listen to (a socket)
         */
        function add_client( &$client )
        {
            $this->clients[] = &$client;
        }
        
        /**
         * Calls a client to read data<br /><br />
         * The method will search for the right client using the socket
         * @param resource $sock socket that is used inside a client
         * @return bool whether the client was successfully called
         */
        function call_client( &$sock )
        {
            if( !is_resource( $sock ) )
            {
                return TRUE;
            }
            
            foreach( $this->clients as $client )
            {
                if( $client->socket == $sock )
                {
                    $client->listen();
                    
                    return TRUE;
                }
            }
            
            return FALSE;
        }
        
        /**
         * Sits and listens to incoming data<br /><br />
         * Only needs to be called once
         * @param int $errno optional parameter that gives the error number (if available)
         * @param string $errstr optional parameter that gives the error string (if available)
         * @return bool returns FALSE only if select fails and TRUE if there are no sockets left to listen to
         */
        function run( &$errno, &$errstr )
        {
            while( TRUE )
            {
                $read = array();
                
                foreach( $this->clients as $client )
                {
                    if( is_resource( $client->socket ) )
                    {
                        $read[] = &$client->socket;
                    }
                    else
                    {
                        unset( $client );
                    }
                }
                
                if( empty( $read ) )
                {
                    return TRUE;
                }
                
                $result = socket_select( $read, $write = NULL, $except = NULL, $this->select_timeout );
                
                if( $result === FALSE )
                {
                    $errno = socket_last_error();
                    $errstr = socket_strerror( socket_last_error() );
                    
                    return FALSE;
                }
                elseif( $result < 1 )
                {
					foreach ($this->clients AS $client) {
						$client->checkForMessages();
					}
                    continue;
                }
                
                foreach( $read as $sock )
                {
                    $this->call_client( $sock );
                }
            }
        }
    }
?>