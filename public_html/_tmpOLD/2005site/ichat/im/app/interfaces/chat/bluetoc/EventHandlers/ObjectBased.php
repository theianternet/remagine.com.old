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
     * Base event handling using an object oriented approach
     *
     * @version 2.1alpha
     * @author sk89q
     * @copyright Copyright (c) 2004-2006, sk89q
     */
    class EventHandler
    {
        var $debug_mode = FALSE;
        var $event_handler_prefix = 'event_';
        
        /**
         * Prints a debug message but only if debug mode is on
         * @param string $message debug message to print
         */
        function print_debug( $message )
        {
            if( $this->debug_mode )
            {
                if( is_array( $message ) )
                {
                    print_r( $message );
                    echo "\n";
                }
                else
                {
                    echo "$message\n";
                }
            }
        }
        
        /**
         * Invokes an event by calling the method<br /><br />
         * event_handler_prefix is prefixed before the method name
         * @param string $function name of method to call
         * @param array $arguments array of arguments/data
         */
        function invoke_event( $function, $arguments )
        {
            $this->print_debug( "* Handler: <$function>" );
            $this->print_debug( $arguments );
            
            $function = $this->event_handler_prefix . $function;
            
            if( method_exists( $this, $function ) )
            {
                $this->$function( $arguments );
            }
        }
    }
?>