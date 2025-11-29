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
    
    define( 'MAX_PACKLENGTH',       65535 );
    define( 'SFLAP_TYPE_SIGNON',    1 );
    define( 'SFLAP_TYPE_DATA',      2 );
    define( 'SFLAP_TYPE_ERROR',     3 );
    define( 'SFLAP_TYPE_SIGNOFF',   4 );
    define( 'SFLAP_TYPE_KEEPALIVE', 5 );
    define( 'SFLAP_MAX_LENGTH',     1024 );
    define( 'SFLAP_SUCCESS',        0 );
    define( 'SFLAP_ERR_UNKNOWN',    1 );
    define( 'SFLAP_ERR_ARGS',       2 );
    define( 'SFLAP_ERR_LENGTH',     3 );
    define( 'SFLAP_ERR_READ',       4 );
    define( 'SFLAP_ERR_SEND',       5 );
    define( 'SFLAP_FLAP_VERSION',   1 );
    define( 'SFLAP_TLV_TAG',        1 );
    define( 'SFLAP_HEADER_LEN',     6 );
    
    // Capability UIDs
    define( 'CAPS_VOICE_UID',           '09461341-4C7F-11D1-8222-444553540000' );
    define( 'CAPS_DIRECT_PLAY_UID',     '09461342-4C7F-11D1-8222-444553540000' );
    define( 'CAPS_FILE_SEND_UID',       '09461343-4C7F-11D1-8222-444553540000' );
    define( 'CAPS_FILE_GET_UID',        '09461348-4C7F-11D1-8222-444553540000' );
    define( 'CAPS_IMAGE_UID',           '09461345-4C7F-11D1-8222-444553540000' );
    define( 'CAPS_BUDDY_ICON_UID',      '09461346-4C7F-11D1-8222-444553540000' );
    define( 'CAPS_STOCKS_UID',          '09461347-4C7F-11D1-8222-444553540000' );
    define( 'CAPS_GAMES_UID',           '0946134a-4C7F-11D1-8222-444553540000' );
    define( 'CAPS_ICQ_RELAY_UID',       '09461344-4C7F-11D1-8222-444553540000' );
    define( 'CAPS_CHANNEL2_TLV_UID',    '09461349-4C7F-11D1-8222-444553540000' );
    define( 'CAPS_INVALID_GAMES_UID',   '0946134A-4C7F-11D1-2282-444553540000' );
    define( 'CAPS_BLIST_TRANSFERS_UID', '0946134B-4C7F-11D1-8222-444553540000' );
    define( 'CAPS_AIMICQ_INTEROP_UID',  '0946134D-4C7F-11D1-8222-444553540000' );
    define( 'CAPS_UTF8_UID',            '0946134E-4C7F-11D1-8222-444553540000' );
    
    define( 'EVENT_BEFORE_SIGNON',      'before_sign_on' );
    define( 'EVENT_SIGNON',             'sign_on' );
    define( 'EVENT_SIGNOFF',            'sign_off' );
    define( 'EVENT_ERROR',              'error' );
    define( 'EVENT_RECEIVE',            'receive_packet' );
    define( 'EVENT_SEND',               'send_packet' );
    define( 'EVENT_IM_RECV',            'im' );
    define( 'EVENT_CHAT_JOIN',          'chat_joined' );
    define( 'EVENT_CHAT_LEAVE',         'chat_left' );
    define( 'EVENT_CHAT_INVITE_RECV',   'chat_invitation' );
    define( 'EVENT_CHAT_MSG_RECV',      'chat_message');
    define( 'EVENT_CHAT_BUDDY_UPDATE',  'chat_buddy_update' );
    define( 'EVENT_BUDDY_UPDATE',       'buddy_update' );
    define( 'EVENT_WARNED',             'warned' );
    define( 'EVENT_GOTO_URL',           'goto_url' );
    define( 'EVENT_DIR_STATUS',         'dir_status' );
    define( 'EVENT_NICK_STATUS',        'nick_status' );
    define( 'EVENT_PASSWD_STATUS',      'password_status' );
    define( 'EVENT_PAUSE',              'pause' );
    define( 'EVENT_RVOUS_PROPOSE',      'rvous_proposal' );
    define( 'EVENT_CONFIG',             'config' );
    define( 'EVENT_NICK',               'nick' );
    define( 'EVENT_NEW_BUDDY_REPLY',    'new_buddy_reply' );
    define( 'EVENT_ALIAS_UPDATED',      'alias_updated' );
    define( 'EVENT_GROUP_DELETED',      'group_deleted' );
    define( 'EVENT_BUDDY_DELETED',      'buddy_deleted' );
    define( 'EVENT_DENY_DELETED',       'deny_deleted' );
    define( 'EVENT_PERMIT_DELETED',     'permit_deleted' );
    define( 'EVENT_GROUP_INSERTED',     'group_inserted' );
    define( 'EVENT_BUDDY_INSERTED',     'buddy_inserted' );
    define( 'EVENT_DENY_INSERTED',      'deny_inserted' );
    define( 'EVENT_PERMIT_INSERTED',    'permit_inserted' );
    define( 'EVENT_CLIENT_EVENT',       'client_event' );
    define( 'EVENT_CAPS',               'caps' );
    define( 'EVENT_BART',               'bart' );
    define( 'EVENT_TEST',               'test' );
            
    define( 'ERROR_CONNECTION', 0 );
    define( 'ERROR_AIM', 1 );
     
    /**
     * <code>TocProtocol</code> handles all the connection implementation and 
     * abstracts message receiving and sending.
     *
     * @version 2.3.000
     * @author sk89q
     * @copyright Copyright (c) 2004-2006, sk89q
     */
    class TocProtocol extends EventHandler
    {
        /**
         * Account username
         * @var string
         */
        var $aim_user;
        /**
         * Account password
         * @var string
         */
        var $aim_pass;
        
        /**
         * TOC server host
         * @var string
         */
        var $toc_host = 'aimexpress.oscar.aol.com';
        /**
         * TOC  server port
         * @var integer
         */
        var $toc_port = 5190;
        /**
         * Authentication server host
         * @var string
         */
        var $auth_host = 'login.oscar.aol.com';
        /**
         * Authentication server port
         * @var integer
         */
        var $auth_port = 29999;
        
        /**
         * The language (only English tested)
         * @var string
         */
        var $toc_language = 'English';
        /**
         * The client version
         * @var string
         */
        var $client_version = 'TIC:\Revision: 1.61 ';
        
        /**
         * @var string
         * @access private
         */
        var $roast = 'Tic/Toc';
        
        /**
         * Contains the format of the nickname
         * @var string
         */
        var $aim_nick;
        /**
         * Contains the buddies data received upon sign-in
         * @var string
         * @access private
         */
        var $aim_buddies_data;
            
        /**
        * The socket of the connection
         * @var resource
         */
        var $socket = null;
        /**
         * @var integer
         * @access private
         */
        var $socket_client_id = 0;
        /**
         * The current signin stage
         * @var integer
         * @access private
         */
        var $signin_stage = -1;
        
        /**
         * Normalize strings turns a string with special characters into one that
         * will be accepted by AIM
         * @param string $text original string
         * @return string transformed string
         */
        function normalize_string( $text )
        {
            $text = str_replace( "\\", "\\\\", $text );
            $text = str_replace( "$", "\$", $text );
            $text = str_replace( "\"", "\\\"", $text );
            $text = str_replace( "(", "\(", $text );
            $text = str_replace( ")", "\)", $text );
            $text = str_replace( "[", "\[", $text );
            $text = str_replace( "]", "\]", $text );
            $text = str_replace( "{", "\{", $text );
            $text = str_replace( "}", "\}", $text );
            
            return $text;
        }
        
        /**
         * Generates the special code that is used during sign in
         * @access private
         * @return int code
         */
        function get_signin_code()
        {
            // We get the ascii value of the first character of
            // the username and password and then we subtract
            // 96 from each value
            $name = ord( strtolower( str_replace( " ", "", $this->aim_user[0] ) ) ) - 96;
            $pass = ord( $this->aim_pass[0] ) - 96;
            
            // Then we do some math
            $a = $name * 7696 + 738816;
            $b = $name * 746512;
            $c = $pass * $a;
            
            // And then we have some weird signon code we need
            return $c - $a + $b + 71665152;
        }
        
        /**
         * Turns a password into a roasted one that is used by AIM
         * @access private
         * @param string $password original password
         * @return string roasted password
         */
        function roast_password( $password )
        {
            $roasted = '0x'; // Let's start the roasted password with 0x
            
            // For each letter of the password, let's "roast it"
            for( $i = 0; $i < strlen( $password ); $i++ )
            {
                $roasted .= bin2hex( $password[$i] ^ $this->roast[$i % 7] );
            }
    
            return $roasted;
        }
        
        /**
         * Signs into AIM but blocks so that only this client can be running<br /><br />
         * If you want to run multiple clients, you will have to use connect() instead and use MultiplexListener (see examples)
         */
        function sign_in()
        {
            $this->connect();
            
            while( $this->signin_stage != -1 )
            {
                $this->listen();
            }
        }
        
        /**
         * Connects to AIM and sends an initial packet. The rest of the login will be 
         * and message catching will be done in listen() which you may either call 
         * yourself in an infinite loop or use MultiplexListener
         */
        function connect()
        {
            // Let's first connect to the AIM server
            // If there's an error, we can return false and raise an
            // error
            @$this->socket = socket_create( AF_INET, SOCK_STREAM, SOL_TCP );
            
            if( !@socket_connect( $this->socket, $this->toc_host, $this->toc_port ) )
            {
                $this->invoke_event( EVENT_ERROR, array(    'type'      => ERROR_CONNECTION,
                                                            'number'    => 0, 
                                                            'text'      => '' ) );
                return FALSE;
            }
            
            $this->print_debug( "! We are connected" );
    
            // Then we send the all essential FLAPON
            // If there's an error, we return false as usual and 
            // raise an error
            if( !$this->send_raw( "FLAPON\r\n\r\n" ) )
            {
                $this->invoke_event( EVENT_ERROR, array(    'type'      => ERROR_CONNECTION,
                                                            'number'    => 200 ) );
                return FALSE;
            }
            
            $this->print_debug( "! We have sent FLAPON" );
            
            // So that we can use the multiplex thingy, we have to
            // split the signin process so that it doesn't block
            $this->signin_stage = 1;
            
            return TRUE;
        }
        
        /**
         * Manages the login procedure and also is the handler for all messages. This 
         * is usually called either in an infinite loop after connect() or automatically
         * by using MultiplexListener (recommended)
         */
        function listen()
        {
            $i = 0;
            
            // If we're signing in, we have to send the right
            // things or AIM won't like us very much =(
            switch( $this->signin_stage )
            {
                case ++$i:
                    // Read an important flap that we will check later
                    if( !$result = $this->read_flap() )
                    {
                        $this->sign_off();
                        $this->invoke_event( EVENT_ERROR, array(    'type'      => ERROR_CONNECTION,
                                                                    'number'    => 201 ) );
                        return;
                    }
                    
                    $this->print_debug( "! We have received an important FLAP" );
                    
                    // We will now read the flap we just got to see if
                    // it's what we wanted
                    // Raise an error and return false if it isn't
                    if( $result['asterisk'] != '*' && $result['frameType'] != 1 && $result['dataLength'] != 4 && $result['data'] != 1 )
                    {
                        $this->sign_off();
                        $this->invoke_event( EVENT_ERROR, array(    'type'      => ERROR_CONNECTION,
                                                                    'number'    => 202 ) );
                        return;
                    } 
                    
                    // We now send an important signon flap
                    $data = pack( "Nnna" . strlen( $this->aim_user ), 1, 1, strlen( $this->aim_user ), $this->aim_user );
                    $result = $this->send_flap( SFLAP_TYPE_SIGNON, $data, TRUE );
                    
                    $this->print_debug( "! Sent initial signon" );
                    
                    // OLD!
                    // Now we create the all important signon command
                    // We have to "roast" the password so that it's accepted by AIM
                    // The toc2_signon command changed in TOC v2.0 (it was actually
                    // toc_signon in TOC v1.0)
                    /*$send_toc_signon = sprintf( 'toc2_signon %s %s %s %s "%s" "%s" %s %s',
                                                $this->auth_host,
                                                $this->auth_port,
                                                strtolower( str_replace( ' ', '', $this->aim_user ) ),
                                                $this->roast_password( $this->aim_pass ),
                                                $this->toc_language,
                                                "TIC:TOC2:REVISION",
                                                "160",
                                                $this->get_signin_code() );*/
                    //                                      H  P  UR PS LANG VER  ??? CO ?? ?? ? ? ????? FL NO
                    $send_toc_signon = sprintf( 'toc2_login %s %s "%s" %s "%s" "%s" 160 %s "%s" "%s" 3 0 30303 %s %s',
                                                $this->auth_host,
                                                $this->auth_port,
                                                strtolower( str_replace( ' ', '', $this->aim_user ) ),
                                                $this->roast_password( $this->aim_pass ),
                                                $this->toc_language,
                                                $this->client_version,
                                                "US",
                                                "", // ??
                                                "", // ??
                                                "-kentucky -utf8 -preakness", // preakness = allows to talk to ICQ users
                                                $this->get_signin_code() );
                    // Well let's send it to AIM!
                    $result = $this->send_flap( SFLAP_TYPE_DATA, $send_toc_signon, TRUE );
                    
                    $this->print_debug( "! Send signon flap" );
                    
                    $this->signin_stage++;
                    
                    break;
                
                case ++$i:
                    // Flap reading time!
                    $result = $this->read_flap();
                    
                    $this->print_debug( "! Received sign on flap result" );
            
                    // Check the flap
                    if( $result['asterisk'] != '*' && $result['frameType'] != 2 )
                    {
                        $this->sign_off();
                        $this->invoke_event( EVENT_ERROR, array(    'type'      => ERROR_CONNECTION,
                                                                    'number'    => 203 ) );
                        return;
                    }                                   
                    
                    // If the flap we got didn't have SIGN_ON:TOC2.0, we
                    // have a problem!
                    // It was SIGN_ON:TOC1.0 in... guess what? TOC 1.0!
                    if( $result['data'] != "SIGN_ON:TOC2.0" )
                    {
                        $this->process_toc_packet( $result['data'] );
                        return;
                    }
                    
                    $this->signin_stage++;
                    
                    break;
                
                case ++$i:
                    // Let's get our nick
                    $result = $this->read_flap(); // Uneeded flap
                    $result = $this->read_flap(); // Get nickname (how the screen name is spaced and capitalized)
                    $this->aim_nick = str_replace( 'NICK:', '', $result['data'] );
                    
                    // ...and buddy list
                    $result = $this->read_flap(); // Get buddy list
                    $this->aim_buddies_data = $result['data'];
                
                    // Let's invoke the signon event
                    $this->invoke_event( EVENT_BEFORE_SIGNON, array() );
                    
                    // We're logged in now. Let's celebrate
                    // Before in TOC 1.0, we used to have to insert ourself
                    // on the buddy list so we would appear online (a bug in
                    // TOC 1.0)
                    $this->send_flap( SFLAP_TYPE_DATA, 'toc_init_done', TRUE );
                
                    // Let's invoke the signon event
                    $this->invoke_event( EVENT_SIGNON, array(   'config' => $this->aim_buddies_data) );
                    
                    $this->print_debug( "! We are signed in" );
                    
                    $this->signin_stage = 0;
                    
                    break;
                
                // So we're not signing in...
                default:
                    // This checks if there is data to read
                    // If there is, we can process it
                    if( $result = $this->read_flap() )
                    {
                        $this->process_toc_packet( $result['data'] );
                    }
            }
        }
    
        /**
         * Signs off AIM. All this does is reset the login procedure, closes
         * the socket gracefully, and then raise the sign off event
         */
        function sign_off()
        {
            // Kill process!
            $this->signin_stage != -1;
            
            // We gracefully close the socket by shutting
            // it down before we close it
            @socket_shutdown( $this->socket, 2 );
            @socket_close( $this->socket );
			
            $this->invoke_event( BLUETOC_EVENT_SIGNOFF, array() );
        }
        
        /**
         * Reads the flap (special data packet in TOC) and returns it
         * @return array flap data
         */
        function read_flap()
        {
            // Let's get the header describing the flap
            $header = @socket_read( $this->socket, SFLAP_HEADER_LEN, PHP_BINARY_READ );
    
            // The header is too short
            // Return false
            if( strlen( $header ) < SFLAP_HEADER_LEN )
            {
                return FALSE;
            }
            
            // Unpack
            $header_collection = unpack( "aasterisk/CframeType/nsequenceNumber/ndataLength", $header );
    
            // This may return 0 so a warning is suprresed
            $packet = @socket_read( $this->socket, $header_collection['dataLength'], PHP_BINARY_READ );
            
            // If the flap is a signon, the data is structured
            // differently
            if( $header_collection['frameType'] == SFLAP_TYPE_SIGNON ) 
            {
                $packet_collection = unpack( "Ndata", $packet );
            }
            else
            {
                $packet_collection = unpack( "a*data", $packet );
            }
    
            $data = array_merge( $header_collection, $packet_collection );
            
            // Raise an event that we received data
            $this->invoke_event( EVENT_RECEIVE, array(    'data'      => $data ) );
            
            $this->print_debug( "< $packet" );
    
            return $data;
        }
        
        /**
         * Sends flap data (special data packet of TOC)
         * @param string $frame_type frame type
         * @param string $data data
         * @param bool $null_end TRUE to append a null character to the end of the data (needed for many commands)
         * @return string contents of packet sent
         */
        function send_flap( $frame_type, $data, $null_end = TRUE )
        {
            // TOC requires that we end a number of our commands
            // in NULL and we will respect that
            $data .= $null_end ? chr( 0 ) : '';
            
            // Too much data?
            if( strlen($data) > SFLAP_MAX_LENGTH )
            {
                $data = substr( $data, 0, ( SFLAP_MAX_LENGTH - 2 ) );
                $data .= '"';
            }
            
            // Pack the data
            $header = pack( "aCnn", '*', $frame_type, $this->socket_client_id, strlen( $data ) );
            
            // Build the packet
            $packet = $header . $data;
            
            // Send the data
            $this->send_raw( $packet );
    
            $this->socket_client_id++;
    
            return $packet;
        }
        
        /**
         * Sends raw packet data
         * @access private
         * @param string $data data
         * @return bool whether the sending was successful or a failure
         */
        function send_raw( $data )
        {
            $this->print_debug( "> $data" );
            
            // Try to send the packet and return false and
            // raise an error if it phails!
            if( @socket_send( $this->socket, $data, strlen( $data ), NULL ) == FALSE )
            {
                $this->invoke_event( EVENT_ERROR, array(    'type'      => ERROR_CONNECTION,
                                                            'number'    => 100,
                                                            'data'      => $data ) );
                return FALSE;
            }
            else
            {
                $this->invoke_event( EVENT_SEND, array(    'data'      => $data ) );
                return TRUE;
            }
        }
        
        /**
         * Processes TOC data (such as IMs, chats, etc.) and raises events
         * @access private
         */
        function process_toc_packet( $data )
        {

            // Data from AIM is split by colons (:) so we will
            // split the data to see what they're sending us
            $data_split = explode( ":", $data );
            $command = trim( $data_split[0] );

            // Let's see what they're telling us
            switch( $command )
            {
                case 'IM_IN_ENC2':
                {
                    $message = array_slice( $data_split, 9 );
                    $message = implode( ':', $message );
                    
                    // Raise the event
                    $this->invoke_event( EVENT_IM_RECV, array(  'user'      => $data_split[1],
                                                                'is_auto'   => $data_split[2] == 'T' ? TRUE : FALSE,
                                                                'PARAM3'    => $data_split[3],
                                                                'PARAM4'    => $data_split[4],
                                                                'source'    => $data_split[4],
                                                                'buddy_status'   => $data_split[5],
                                                                'class'     => $data_split[5],
                                                                'PARAM6'    => $data_split[6],
                                                                'PARAM7'    => $data_split[7],
                                                                'encoding'  => $data_split[7],
                                                                'language'  => $data_split[8],
                                                                'message'   => $message ) );
                                                                        
                    break;
                }
                case 'IM_IN':
                case 'IM_IN2':
                {
                    // I could just set a max explode count and then
                    // get the last value... but nah...
                    // Keeping remnants of old code
                    $message = array_slice( $data_split, 4 );
                    $message = implode( ':', $message );
                    
                    // Raise the event
                    $this->invoke_event( EVENT_IM_RECV, array(  'user'      => $data_split[1],
                                                                'is_auto'   => $data_split[2] == 'T' ? TRUE : FALSE,
                                                                'PARAM3'    => $data_split[3],  // What does this do? I don't know.
                                                                                                // This is subject to change if I
                                                                                                // figure out what it does
                                                                'message'   => $message ) );
                                                                        
                    break;
                }
                case 'CHAT_JOIN':
                {
                    // Raise the event
                    $this->invoke_event( EVENT_CHAT_JOIN, array(    'chat_id'   => $data_split[1],
                                                                    'name'      => $data_split[2] ) );
                                                                        
                    break;
                }
                case 'CHAT_LEFT':
                {
                    // Raise the event
                    $this->invoke_event( EVENT_CHAT_LEAVE, array(   'chat_id'   => $data_split[1] ) );
                                                                        
                    break;
                }
                case 'CHAT_INVITE':
                {
                    // I could just set a max explode count and then
                    // get the last value... but nah...
                    // Keeping remnants of old code
                    $message = array_slice( $data_split, 4 );
                    $message = implode( ':', $message );
                    
                    // Raise the event
                    $this->invoke_event( EVENT_CHAT_INVITE_RECV, array( 'chat_name'     => $data_split[1],
                                                                        'chat_id'       => $data_split[2],
                                                                        'invite_sender' => $data_split[3],
                                                                        'message'       => $message ) );
                                                                        
                    break;
                }
                case 'CHAT_IN_ENC':
                {
                    $message = array_slice( $data_split, 6 );
                    $message = implode( ':', $message );
                    
                    // Raise the event
                    $this->invoke_event( EVENT_CHAT_MSG_RECV, array(    'chat_id'       => $data_split[1],
                                                                        'user'          => $data_split[2],
                                                                        'is_whisper'    => $data_split[3] == 'T' ? TRUE : FALSE,
                                                                        'PARAM4'        => $data_split[4],  // What does this do? I don't know.
                                                                                                            // This is subject to change if I
                                                                                                            // figure out what it does
                                                                        'language'      => $data_split[5],
                                                                        'message'       => $message ) );
                                                                        
                    break;
                }
                case 'CHAT_IN':
                {
                    // I could just set a max explode count and then
                    // get the last value... but nah...
                    // Keeping remnants of old code
                    $message = array_slice( $data_split, 4 );
                    $message = implode( ':', $message );
                    
                    // Raise the event
                    $this->invoke_event( EVENT_CHAT_MSG_RECV, array(    'chat_id'       => $data_split[1],
                                                                        'user'          => $data_split[2],
                                                                        'is_whisper'    => $data_split[3] == 'T' ? TRUE : FALSE,
                                                                        'message'       => $message ) );
                                                                        
                    break;
                }
                case 'CHAT_UPDATE_BUDDY':
                {
                    // Builds an array of the list of users
                    $users = array_slice( $data_split, 3 );
                    
                    // Raise the event
                    $this->invoke_event( EVENT_CHAT_BUDDY_UPDATE, array(    'chat_id'       => $data_split[1],
                                                                            'is_inside'     => $data_split[2] == 'T' ? TRUE : FALSE,
                                                                            'users'         => $users ) );
                                                                        
                    break;
                }
                case 'UPDATE_BUDDY':
                case 'UPDATE_BUDDY2':
                {
                    // Raise the event
                    $this->invoke_event( EVENT_BUDDY_UPDATE, array( 'user'          => $data_split[1],
                                                                    'is_online'     => $data_split[2] == 'T' ? TRUE : FALSE,
                                                                    'level'         => $data_split[3],
                                                                    'signon_time'   => $data_split[4],
                                                                    'is_idle'       => $data_split[5] ? true : false,
                                                                    'idle_time'     => $data_split[5],
                                                                    'class'         => $data_split[6],
                                                                    'PARAM7'        => $data_split[7] ,
                                                                    'status_code'   => $data_split[7] ) );
                                                                        
                    break;
                }
                case 'NEW_BUDDY_REPLY2':
                {
                    // Raise the event
                    $this->invoke_event( EVENT_NEW_BUDDY_REPLY, array(  'user'      => $data_split[1],
                                                                        'action'    => $data_split[2] ) );
                                                                        
                    break;
                }
                case 'EVILED':
                {
                    // Raise the event
                    $this->invoke_event( EVENT_WARNED, array(   'new_level'     => $data_split[1],
                                                                'user'          => $user ) );
                                                                        
                    break;
                }
                case 'GOTO_URL':
                {
                    // Raise the event
                    $this->invoke_event( EVENT_GOTO_URL, array( 'window'    => $data_split[1],
                                                                'url'       => $data_split[2] ) );
                                                                        
                    break;
                }
                case 'DIR_STATUS':
                {
                    // Raise the event
                    $this->invoke_event( EVENT_DIR_STATUS, array(   'return_code'   => $data_split[1],
                                                                    'argument'      => array_slice( $data_split, 2 ) ) );
                                                                        
                    break;
                }
                case 'ADMIN_NICK_STATUS':
                {
                    // Raise the event
                    $this->invoke_event( EVENT_NICK_STATUS, array(  'return_code'   => $data_split[1],
                                                                    'argument'      => array_slice( $data_split, 2 ) ) );
                                                                        
                    break;
                }
                case 'ADMIN_PASSWD_STATUS':
                {
                    // Raise the event
                    $this->invoke_event( EVENT_PASSWD_STATUS, array(    'return_code'   => $data_split[1],
                                                                        'argument'      => array_slice( $data_split, 2 ) ) );
                                                                        
                    break;
                }
                case 'PAUSE':
                {
                    // Raise the event
                    $this->invoke_event( EVENT_PAUSE, array() );
                                                                        
                    break;
                }
                case 'RVOUS_PROPOSE':
                {
                    // Raise the event
                    $this->invoke_event( EVENT_RVOUS_PROPOSE, array(    'user'      => $data_split[1],
                                                                        'uuid'      => $data_split[2],
                                                                        'cookie'    => $data_split[3],
                                                                        'seq'       => $data_split[4],
                                                                        'rip'       => $data_split[5],
                                                                        'pip'       => $data_split[6],
                                                                        'vip'       => $data_split[7],
                                                                        'port'      => $data_split[8],
                                                                        'tlv'       => array_slice( $data_split, 9 ) ) );
                                                                        
                    break;
                }
                case 'UPDATED2':
                {
                    // Raise the event
                    $this->invoke_event( EVENT_ALIAS_UPDATED, array(    'user'      => $data_split[1],
                                                                        'PARAM2'    => $data_split[2],  // What does this do? I don't know.
                                                                                                        // This is subject to change if I
                                                                                                        // figure out what it does
                                                                        'alias'      => $data_split[3] ) );
                                                                        
                    break;
                }
                case 'INSERTED2':
                {
                    if($data_split[1] == "g")
                    {
                        $event = EVENT_GROUP_INSERTED;
                        $alias = '';
                        $user = '';
                        $group = $data_split[2];
                    }
                    else if($data_split[1] == "b")
                    {
                        $event = EVENT_BUDDY_INSERTED;
                        $alias = $data_split[2];
                        $user = $data_split[3];
                        $group = $data_split[4];
                    }
                    else if($data_split[1] == "d")
                    {
                        $event = EVENT_DENY_INSERTED;
                        $alias = '';
                        $user = $data_split[2];
                        $group = '';
                    }
                    else if($data_split[1] == "p")
                    {
                        $event = EVENT_PERMIT_INSERTED;
                        $alias = '';
                        $user = $data_split[2];
                        $group = '';
                    }
                    
                    // Raise the event
                    $this->invoke_event( $event, array(                 'alias'     => $alias,
                                                                        'user'      => $user,
                                                                        'group'     => $group ) );
                                                                        
                    break;
                }
                case 'DELETED2':
                {
                    if($data_split[1] == "g")
                    {
                        $event = EVENT_GROUP_DELETED;
                        $user = '';
                        $group = $data_split[2];
                    }
                    else if($data_split[1] == "b")
                    {
                        $event = EVENT_BUDDY_DELETED;
                        $user = $data_split[2];
                        $group = $data_split[3];
                    }
                    else if($data_split[1] == "d")
                    {
                        $event = EVENT_DENY_DELETED;
                        $user = $data_split[2];
                        $group = '';
                    }
                    else if($data_split[1] == "p")
                    {
                        $event = EVENT_PERMIT_DELETED;
                        $user = $data_split[2];
                        $group = '';
                    }
                    
                    // Raise the event
                    $this->invoke_event( $event, array(                 'user'      => $user,
                                                                        'group'     => $group ) );
                                                                        
                    break;
                }
                case 'CLIENT_EVENT2':
                {
                    // Raise the event
                    $this->invoke_event( EVENT_CLIENT_EVENT, array(     'user'      => $data_split[1],
                                                                        'status'    => $data_split[2] ) );
                                                                        
                    break;
                }
                case 'BUDDY_CAPS2':
                {
                    // Raise the event
                    $this->invoke_event( EVENT_CAPS, array(             'user'      => $data_split[1],
                                                                        'caps'      => array_slice( $data_split, 2 ) ) );
                                                                       
                    break;
                }
                case 'BART2':
                {
                    // Raise the event
                    $this->invoke_event( EVENT_BART, array(             'user'      => $data_split[1],
                                                                        'data'      => implode( ':', array_slice( $data_split, 2 ) ) ) );
                                                                        
                    break;
                }
                case 'CONFIG':
                case 'CONFIG2':
                {
                    // Raise the event
                    $this->invoke_event( EVENT_CONFIG, array(   'config'    => $data_split[1] ) );
                                                                        
                    break;
                }
                case 'NICK':
                {
                    // Raise the event
                    $this->invoke_event( EVENT_NICK, array( 'nick'      => $data_split[1] ) );
                                                                        
                    break;
                }
                case 'ERROR':
                {
                    $this->invoke_event( EVENT_ERROR, array(    'type'      => ERROR_AIM,
                                                                'number'    => $data_split[1],
                                                                'argument'  => $data_split[2] ) );
                    break;
                }
            }
        }
    }
?>