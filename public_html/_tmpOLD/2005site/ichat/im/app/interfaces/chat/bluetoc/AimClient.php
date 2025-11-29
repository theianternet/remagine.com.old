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
     * <code>AimClient</code> abstracts the basic functionality of the TOC 
     * protocol. It simplifies the act of sending commands to the sever by
     * removing the need to study the protocol.
     *
     * @version 2.3.000
     * @author sk89q
     * @copyright Copyright (c) 2004-2006, sk89q
     */
    class AimClient extends TocProtocol
    {
        /**
         * Get the status of a buddy (online, idle, away status, etc.)<br /><br />
         * TOC will fire a <strong>buddy_update</strong>
         * event as a reply and it must be handled for this to be useful.
         * @since 2.2.000
         * @version 2.2.000
         * @param string $user name of buddy
         */
        function get_status($user)
        {
            $this->send_flap(SFLAP_TYPE_DATA, sprintf('toc_get_status "%s"',
                                                        $this->normalize_string($user)), true);
        }
        
        /**
         * Sets the client's buddy information profile<br /><br />
         * This information does not persist between login. Every time you login,
         * you must re-set the information with this method.
         * @param string $message info HTML
         */
        function set_info($message)
        {
            $this->send_flap(SFLAP_TYPE_DATA, sprintf('toc_set_info "%s"',
                                                        $this->normalize_string($message)), true);
        }
        
        /**
         * Changes the account password<br />
         * The old password is required. 
         * @param string $existing existing password
         * @param string $new new password to change to
         */
        function change_password($existing, $new)
        {
            $this->send_flap(SFLAP_TYPE_DATA, sprintf('toc_change_passwd "%s %s"',
                                                        $this->normalize_string($existing),
                                                        $this->normalize_string($new)), true);
        }
        
        /**
         * Sends typing notification to a buddy<br /><br />
         * Status should be one of:
         * <ul>
         * <li><strong>0</strong> (no activity)</li>
         * <li><strong>1</strong> (typing paused)</li>
         * <li><strong>2</strong> (currently typing)</li>
         * </ul>
         * @since 2.2.000
         * @version 2.2.000
         * @param string $username screen name
         * @param integer $status activity status
         */
        function client_event($username, $status)
        {
            $this->send_flap(SFLAP_TYPE_DATA, sprintf('toc2_client_event "%s" %s',
                                                        $this->normalize_string($username),
                                                        $status), true);
        }
        
        /**
         * Gets a user's info but only sends the request<br /><br />
         * You will receive the profile via a <strong>goto_url</strong> event (or an error will be received through an <strong>error</strong> event).
         * @param string $username screen name
         */
        function get_info($username)
        {
            $this->send_flap(SFLAP_TYPE_DATA, sprintf('toc_get_info "%s"',
                                                        $this->normalize_string($username)), true);
        }
        
        /**
         * Gets a user's directory info but only sends the request<br /><br />
         * You will receive the directory info via a <strong>goto_url</strong> event (or an error will be received through an <strong>error</strong> event).<br /><br />
         * Note: The directory may no longer be supported.
         * @param string $username screen name
         */
        function get_directory_info($username)
        {
            $this->send_flap(SFLAP_TYPE_DATA, sprintf('toc_get_dir "%s"',
                                                        $this->normalize_string($username)), true);
        }
        
        /**
         * Sets the account's directory info<br /><br />
         * Note: The directory may no longer be supported.
         * @param string $first_name first name (OPTIONAL)
         * @param string $middle_name middle name (OPTIONAL)
         * @param string $last_name last name (OPTIONAL)
         * @param string $maiden_name maiden name (OPTIONAL)
         * @param string $city city (OPTIONAL)
         * @param string $state state (OPTIONAL)
         * @param string $country country (OPTIONAL)
         * @param string $email email (OPTIONAL)
         * @param string $allow_web_searches whether to allow to search your profile from the web (OPTIONAL)
         */
        function set_directory_info($first_name = '', $middle_name = '', $last_name = '', $maiden_name = '', $city = '', $state = '', $country = '', $email = '', $allow_web_searches = '')
        {
            $this->send_flap(SFLAP_TYPE_DATA, sprintf('toc_set_dir "%s":"%s":"%s":"%s":"%s":"%s":"%s":"%s"',
                                                        $this->normalize_string($first_name),
                                                        $this->normalize_string($middle_name),
                                                        $this->normalize_string($last_name),
                                                        $this->normalize_string($maiden_name),
                                                        $this->normalize_string($city),
                                                        $this->normalize_string($state),
                                                        $this->normalize_string($country),
                                                        $this->normalize_string($email),
                                                        $this->normalize_string($allow_web_searches)), true);
        }
        
        /**
         * Searches the directory by info<br /><br />
         * You will receive the results via a <strong>goto_url</strong> event (or an error will be received through an <strong>error</strong> event).<br /><br />
         * Note: The directory may no longer be supported.
         * @param string $first_name first name (OPTIONAL)
         * @param string $middle_name middle name (OPTIONAL)
         * @param string $last_name last name (OPTIONAL)
         * @param string $maiden_name maiden name (OPTIONAL)
         * @param string $city city (OPTIONAL)
         * @param string $state state (OPTIONAL)
         * @param string $country country (OPTIONAL)
         * @param string $email email (OPTIONAL)
         */
        function search_directory($first_name = '', $middle_name = '', $last_name = '', $maiden_name = '', $city = '', $state = '', $country = '', $email = '')
        {
            $this->send_flap(SFLAP_TYPE_DATA, sprintf('toc_dir_search "%s":"%s":"%s":"%s":"%s":"%s":"%s":"%s"',
                                                        $this->normalize_string($first_name),
                                                        $this->normalize_string($middle_name),
                                                        $this->normalize_string($last_name),
                                                        $this->normalize_string($maiden_name),
                                                        $this->normalize_string($city),
                                                        $this->normalize_string($state),
                                                        $this->normalize_string($country),
                                                        $this->normalize_string($email)), true);
        }

        /**
         * Allows the client to set its capabilities<br /><br />
         * <b>Possible Capabilities</b> (as constants)
         * <ul>
         * <li>CAPS_VOICE_UID</li>
         * <li>CAPS_FILE_SEND_UID</li>
         * <li>CAPS_FILE_GET_UID</li>
         * <li>CAPS_IMAGE_UID</li>
         * <li>CAPS_BUDDY_ICON_UID</li>
         * <li>CAPS_STOCKS_UID</li>
         * <li>CAPS_GAMES_UID</li>
         * <li>CAPS_ICQ_RELAY_UID</li>
         * <li>CAPS_CHANNEL2_TLV_UID</li>
         * <li>CAPS_INVALID_GAMES_UID</li>
         * <li>CAPS_BLIST_TRANSFERS_UID</li>
         * <li>CAPS_AIMICQ_INTEROP_UID</li>
         * <li>CAPS_UTF8_UID</li>
         * </ul>
         * @param array $capabilities a list of capabilities
         */
        function set_capabilities($capabilities)
        {
            foreach((array) $capabilities as $item)
            {
                $capabilities_list .= ' "' . $this->normalize_string($item) . '"';
            }
            
            $this->send_flap(SFLAP_TYPE_DATA, sprintf('toc_set_caps %s',
                                                        $capabilities_list), true);
        }

        /**
         * Sets the client's away status
         * @param string $message away message
         */
        function set_away($message)
        {
            $this->send_flap(SFLAP_TYPE_DATA, sprintf('toc_set_away "%s"',
                                                        $this->normalize_string($message)), true);
        }

        /**
         * Unsets the client's away message (to go back)
         */
        function set_unaway()
        {
            $this->send_flap(SFLAP_TYPE_DATA, sprintf('toc_set_away "%s"',
                                                        ''), true);
        }

        /**
         * Sets the client's idle time
         * @param int $seconds number of seconds idle
         */
        function set_idle($seconds)
        {
            $this->send_flap(SFLAP_TYPE_DATA, sprintf('toc_set_idle %s',
                                                        $seconds), true);
        }

        /**
         * Formats a nick to change the capitalization and/or spelling<br /><br />
         * Either an <strong>nick_status</strong> event will be raised on success or an <strong>error</strong> event.
         * @param string $nickname new nickname
         */
        function format_nick($username)
        {
            $this->send_flap(SFLAP_TYPE_DATA, sprintf('toc_format_nickname "%s"',
                                                        $this->normalize_string($username)), true);
        }

        /**
         * Sets the permit/deny mode that allows you to be only available to some people<br /><br />
         * <b>Modes</b> (use the integer value)
         * <ul>
         * <li>1 - Allow all (default)</li>
         * <li>2 - Block all</li>
         * <li>3 - Allow "permit group" only</li>
         * <li>4 - Block "deny group" only</li>
         * <li>5 - Allow buddy list only </li>
         * </ul>
         * @param int $mode permit/deny mode
         */
        function set_permit_deny_mode($mode)
        {
            $this->send_flap(SFLAP_TYPE_DATA, sprintf('toc2_set_pdmode %s',
                                                        $mode), true);
        }

        /**
         * Adds a list of users to your permit mode (is persistent)<br /><br />
         * If you are in deny mode, you will be switched to permit mode first.
         * @param array $users an array for a list of users
         */
        /**
         * Adds one user to your permit mode (is persistent)<br /><br />
         * If you are in deny mode, you will be switched to permit mode first.
         * @param string $users the name of the user
         */
        function add_permit($users)
        {
            foreach((array) $users as $user)
            {
                $user_list .= ' "' . $this->normalize_string($user) . '"';
            }
            
            $this->send_flap(SFLAP_TYPE_DATA, sprintf('toc2_add_permit%s',
                                                        $user_list), true);
        }

        /**
         * Adds a user to your deny mode (is persistent)<br /><br />
         * If you are in deny mode, you will be switched to permit mode first.
         * @param string $users one user
         */
        /**
         * Adds a list of users to your deny mode (is persistent)<br /><br />
         * If you are in deny mode, you will be switched to permit mode first.
         * @param array $users a list of users
         */
        function add_deny($users)
        {
            foreach((array) $users as $user)
            {
                $user_list .= ' "' . $this->normalize_string($user) . '"';
            }
            
            $this->send_flap(SFLAP_TYPE_DATA, sprintf('toc2_add_deny%s',
                                                        $user_list), true);
        }

        /**
         * Adds a new group for users to the buddy list (is persistent)
         * @param string $group name of group
         */
        function add_buddy_group($group)
        {
            $this->send_flap(SFLAP_TYPE_DATA, sprintf('toc2_new_group "%s"',
                                                        $this->normalize_string($group)), true);
        }

        /**
         * Removes a group from your buddy list (is persistent)
         * @param string $group name of group
         */
        function remove_buddy_group($group)
        {
            $this->send_flap(SFLAP_TYPE_DATA, sprintf('toc2_del_group "%s"',
                                                        $this->normalize_string($group)), true);
        }

        /**
         * Adds new buddies using the config format (is persistent)<br /><br />
         * Please see the <a href="structures.html#config">config format</a>. Do NOT put surround braces. Do NOT put an end line feed.<br /><br />
         * Note that if the group doesn't already exist, it will be created.
         * @param string $config the config
         */
        function add_buddies($config)
        {
            // TOC 2.0: behavior changed to accept new config format
            $this->send_flap(SFLAP_TYPE_DATA, sprintf('toc2_new_buddies {%s' . "\n" . '}',
                                                        $this->normalize_string($config)), true);
        }

        /**
         * Removes a user from your buddy list (is persistent)
         * @param string $users the name of a user
         * @param string $group required group name to remove from
         * @deprecated
         */
        /**
         * Removes a user from your buddy list (is persistent)
         * @param array $users a list of users
         * @param string $group required group name to remove from
         * @deprecated
         */
        function remove_buddy($users, $group)
        {
            // TOC 2.0: behavior changed to require group
            foreach((array) $users as $user)
            {
                $user_list .= ' "' . $this->normalize_string($user) . '"';
            }
            
            $this->send_flap(SFLAP_TYPE_DATA, sprintf('toc2_remove_buddy%s "%s"',
                                                        $user_list,
                                                        $this->normalize_string($group)), true);
        }

        /**
         * Sets config information for the account (is persistent)<br /><br />
         * Setting the config allows setting the buddy list and also a number of preferences.
         * Use <a href="structures.html#config">TOC config format</a>. Config information stays between sessions.
         * @param string $config config
         */
        function set_config($config)
        {
            $this->send_flap(SFLAP_TYPE_DATA, sprintf('toc_set_config {%s}',
                                                        $this->normalize_string($config)), true);
        }

        /**
         * Warns a user<br /><br />
         * Remember that only the conversation starter can be warned.
         * @param string $username username to warn
         * @param bool $anonymous whether the warn should be anonymous (less effective)
         */
        function warn_buddy($username, $anonymous = false)
        {
            $this->send_flap(SFLAP_TYPE_DATA, sprintf('toc_evil "%s" %s',
                                                        $this->normalize_string($username),
                                                        $anonymous ? "anon" : "norm"), true);
        }

        /**
         * Sends an encoded instant message to a user<br /><br />
         * Internally, this uses the "TOC3" encoded message format<br /><br />
         * This encoded message version supports a few more variables as well as encoding
         * @version 2.3.000
         * @param string $username username to send to
         * @param string $message message
         * @param bool $auto whether the message should appear as an automatic one (OPTIONAL)
         * @param string $t UNKNOWN; keep it "F" (no quotes) (OPTIONAL)
         * @param string $encoding encoding, see <a href="structures.html#encodingident">encoding identifier format</a> (OPTIONAL)
         * @param string $language two letter language or "x-bad" (no quotes) (OPTIONAL)
         */
        function send_im($username, $message, $auto = false, $t = "F", $encoding = "U", $language = "en")
        {
            $this->send_flap(SFLAP_TYPE_DATA, sprintf('toc2_send_im_enc "%s" %s %s %s "%s"%s',
                                                        $this->normalize_string($username),
                                                        $t ? $t : "F",
                                                        $encoding ? $encoding : "U",
                                                        $language ? $language : "en",
                                                        $this->normalize_string($message),
                                                        $auto ? " auto" : ""), true);
        }

        /**
         * Joins a chatroom
         * @param string $room_title name of room
         * @param int $exchange exchange of room (OPTIONAL, default is 4)
         */
        function chat_join($room_title, $exchange = 4)
        {
            $this->send_flap(SFLAP_TYPE_DATA, sprintf('toc_chat_join %s "%s"',
                                                        $exchange,
                                                        $this->normalize_string($room_title)), true);
        }

        /**
         * Accepts a chat invitation<br /><br />
         * You must specify the ID number you got when you joined the chatroom (not the title).
         * @param int $id chatroom id
         */
        function chat_accept($id)
        {
            $this->send_flap(SFLAP_TYPE_DATA, sprintf('toc_chat_accept %s',
                                                        $id), true);
        }

        /**
         * Leaves a chatroom<br /><br />
         * You must specify the ID number you got when you joined the chatroom (not the title).
         * @param int $id chatroom id
         */
        function chat_leave($id)
        {
            $this->send_flap(SFLAP_TYPE_DATA, sprintf('toc_chat_leave %s',
                                                        $id), true);
        }

        /**
         * Sends an encoded message to a chatroom<br /><br />
         * For the chatroom ID, you must specify the ID number you got when you joined the chatroom (not the title).
         * Internally, this uses the "TOC3" encoded message format<br /><br />
         * This encoded message version supports encoding
         * @version 2.3.000
         * @param int $id chatroom id
         * @param string $message message
         * @param string $encoding (OPTIONAL) encoding, see <a href="structures.html#encodingident">encoding identifier format</a>
         */
        function chat_send($id, $message, $encoding = "U")
        {
            $this->send_flap(SFLAP_TYPE_DATA, sprintf('toc_chat_send_enc %s %s "%s"',
                                                        $id,
                                                        $encoding ? $encoding : "U",
                                                        $this->normalize_string($message)), true);
        }

        /**
         * Whispers to a user in a chatroom<br /><br />
         * For the chatroom ID, you must specify the ID number you got when you joined the chatroom (not the title).<br /><br />
         * @param int $id chatroom id
         * @param string $username user to message
         * @param string $message message
         */
        function chat_whisper($id, $username, $message)
        {
            $this->send_flap(SFLAP_TYPE_DATA, sprintf('toc_chat_whisper %s "%s" "%s"',
                                                        $id,
                                                        $this->normalize_string($username),
                                                        $this->normalize_string($message)), true);
        }

        /**
         * Invites a user to a chatroom<br /><br />
         * For the chatroom ID, you must specify the ID number you got when you joined the chatroom (not the title).
         * @param int $id chatroom id
         * @param string $message message to invite
         * @param string $users name of user
         */
        /**
         * Invites users to a chatroom<br /><br />
         * For the chatroom ID, you must specify the ID number you got when you joined the chatroom (not the title).
         * @param int $id chatroom id
         * @param string $message message to invite
         * @param array $users a list of users
         */
        function chat_invite($id, $message, $users)
        {
            foreach((array) $users as $user)
            {
                $user_list .= ' "' . $this->normalize_string($user) . '"';
            }
            
            $this->send_flap(SFLAP_TYPE_DATA, sprintf('toc_chat_invite %s "%s"%s',
                                                        $id,
                                                        $this->normalize_string($message),
                                                        $user_list), true);
        }

        /**
         * Accepts a rendezvous proposal from a user<br /><br />
         * Little is known about this.
         * @param string $user sender of proposal
         * @param string $cookie cookie from proposal
         * @param string $service UUID of service proposed
         * @param string $tlv tags followed by base64 encoded values
         */
        function rvous_accept($user, $cookie, $service, $tlvlist)
        {
            $this->send_flap(SFLAP_TYPE_DATA, sprintf('toc_rvous_accept "%s" "%s" "%s" "%s"',
                                                        $this->normalize_string($user),
                                                        $this->normalize_string($cookie),
                                                        $this->normalize_string($service),
                                                        $this->normalize_string($tlvlist)), true);
        }

        /**
         * Cancels a rendezvous proposal from a user<br /><br />
         * Little is known about this.
         * @param string $user sender of proposal
         * @param string $cookie cookie from proposal
         * @param string $service UUID of service proposed
         * @param string $tlv tags followed by base64 encoded values
         */
        function rvous_cancel($nick, $cookie, $service, $tlvlist)
        {
            $this->send_flap(SFLAP_TYPE_DATA, sprintf('toc_rvous_cancel "%s" "%s" "%s" "%s"',
                                                        $this->normalize_string($user),
                                                        $this->normalize_string($cookie),
                                                        $this->normalize_string($service),
                                                        $this->normalize_string($tlvlist)), true);
        }
    }
?>