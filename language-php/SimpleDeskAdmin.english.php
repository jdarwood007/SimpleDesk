<?php
###############################################################
#         Simple Desk Project - www.simpledesk.net            #
###############################################################
#       An advanced help desk modifcation built on SMF        #
###############################################################
#                                                             #
#         * Copyright 2010 - SimpleDesk.net                   #
#                                                             #
#   This file and its contents are subject to the license     #
#   included with this distribution, license.txt, which       #
#   states that this software is New BSD Licensed.            #
#   Any questions, please contact SimpleDesk.net              #
#                                                             #
###############################################################
# SimpleDesk Version: 1.0 Felidae                             #
# File Info: SimpleDesk-Admin.english.php / 1.0 Felidae       #
###############################################################
// Version: 1.0 Felidae; SimpleDesk administration options

// Important! Before editing these language files please read the text at the top of index.english.php.

/**
 *	This file contains all of the language strings used in SimpleDesk's administration panel which is loaded throughout the SMF admin area.
 *
 *	@package language
 *	@todo Document the text groups in this file.
 *	@since 1.0
 */

//! @name The 'Core Features' page item
//@{
$txt['core_settings_item_shd'] = 'Helpdesk';
$txt['core_settings_item_shd_desc'] = 'The helpdesk allows you to expand your forum into the service industry by providing a dedicated user-staff helpdesk area.';
//@}

//! @name Items for general SMF/ACP integration
//@{
$txt['errortype_simpledesk'] = 'SimpleDesk';
$txt['errortype_simpledesk_desc'] = 'Errors most likely related to SimpleDesk. Please report any such errors on www.simpledesk.net.';
//@}

//! @name Items for the administration menu structure
//@{
// Admin menu items
$txt['shd_admin_info'] = 'Information';
$txt['shd_admin_options'] = 'Options';
$txt['shd_admin_standalone_options'] = 'Standalone Mode';
$txt['shd_admin_actionlog'] = 'Action Log';
$txt['shd_admin_support'] = 'Support';
$txt['shd_admin_helpdesklog'] = 'Helpdesk Log';
$txt['shd_admin_permissions'] = 'Permissions';

$txt['shd_admin_options_display'] = 'Display Options';
$txt['shd_admin_options_posting'] = 'Posting Options';
$txt['shd_admin_options_admin'] = 'Administrative Options';
$txt['shd_admin_options_standalone'] = 'Standalone Options';
$txt['shd_admin_options_actionlog'] = 'Action Log Options';
//@}

//! @name Descriptions for the page items.
//@{
$txt['shd_admin_info_desc'] = 'This is the information center for the helpdesk, powered by SimpleDesk. Here you can get the latest news as well as version-specific support.';
$txt['shd_admin_options_desc'] = 'This is the general configuration area for the helpdesk, where some basic options can be configured.';
$txt['shd_admin_options_display_desc'] = 'In this area you can change some settings that will edit the display of your helpdesk.';
$txt['shd_admin_options_posting_desc'] = 'Here you can edit posting settings, such as BBC, smileys, and attachments.';
$txt['shd_admin_options_admin_desc'] = 'Here you can set some general administrative options for the helpdesk.';
$txt['shd_admin_options_standalone_desc'] = 'This area manages the standalone mode for the helpdesk, that effectively disables the forum part of an SMF installation.';
$txt['shd_admin_options_actionlog_desc'] = 'This area allows you to configure what items can be logged within the helpdesk action log.';
$txt['shd_admin_actionlog_desc'] = 'This is a list of all actions, such as resolved tickets, edited tickets and more, carried out in the helpdesk.';
$txt['shd_admin_support_desc'] = 'This area will help you get through to SimpleDesk.net quickly and effectively - the post will include some information helpful for our Support team, about your installation (like SMF version and SimpleDesk version).';
$txt['shd_admin_help'] = 'This is the administration panel for the helpdesk. Here you can manage settings, get news and updates on this modification, and view helpdesk logs.';
//@}

//! @name SimpleDesk info center
//@{
$txt['shd_live_from'] = 'Live from SimpleDesk.net';
$txt['shd_no_connect'] = 'Could not retrieve news file from simpledesk.net';
$txt['shd_current_version'] = 'Current Version';
$txt['shd_your_version'] = 'Your Version';
$txt['shd_mod_information'] = 'Mod Information';
$txt['shd_admin_readmore'] = 'Read more';
$txt['shd_admin_help_live'] = 'This box displays the latest news and updates from www.simpledesk.net. Keep your eyes open for new releases and bug fixes. If a new version of this modification is released, you will also see a notification at the top of the helpdesk administration page.';
$txt['shd_admin_help_modification'] = 'This box contains various information about your installation of SimpleDesk.';
$txt['shd_admin_help_credits'] = 'This box lists all of the people that made SimpleDesk possible, from the developers of the actual code, to the support team and the beta testers.';
$txt['shd_admin_help_update'] = 'If you can see this box, you are most likely using an outdated version of SimpleDesk. Follow the guidelines in the notification in order to upgrade to the new release.';
$txt['shd_ticket_information'] = 'Ticket information';
$txt['shd_total_tickets'] = 'Total number of tickets';
$txt['shd_open_tickets'] = 'Open tickets';
$txt['shd_closed_tickets'] = 'Closed tickets';
$txt['shd_recycled_tickets'] = 'Recycled tickets';
$txt['shd_need_support'] = 'Help with SimpleDesk?';
$txt['shd_support_start_here'] = 'See our <a href="%1$s">Support Page</a>';
//@}

//! @name Translatable strings for the credits
//@{
$txt['shd_credits'] = 'SimpleDesk Credits';
$txt['shd_credits_and'] = 'and';
$txt['shd_credits_pretext'] = 'These are the persons that made SimpleDesk possible. Thank you!';
$txt['shd_credits_devs'] = 'Developers';
$txt['shd_credits_devs_desc'] = 'The developers of the actual SimpleDesk code.';
$txt['shd_credits_projectsupport'] = 'Project Support';
$txt['shd_credits_projectsupport_desc'] = 'Those managing and supporting the project in different ways.';
$txt['shd_credits_marketing'] = 'Marketing';
$txt['shd_credits_marketing_desc'] = 'Those spreading the word of SimpleDesk.';
$txt['shd_credits_globalizer'] = 'Globalization';
$txt['shd_credits_globalizer_desc'] = 'The people who make SimpleDesk spread across the world.';
$txt['shd_credits_support'] = 'Support';
$txt['shd_credits_support_desc'] = 'The people providing all the helpless souls with the support they require.';
$txt['shd_credits_qualityassurance'] = 'Quality Assurance';
$txt['shd_credits_qualityassurance_desc'] = 'The leaders of the beta testing team.';
$txt['shd_credits_beta'] = 'Beta Testers';
$txt['shd_credits_beta_desc'] = 'These persons make sure SimpleDesk lives up to the expectations.';
$txt['shd_credits_alltherest'] = 'Anyone else we might\'ve missed...';
$txt['shd_credits_icons'] = '<a href="%1$s">LED</a>, <a href="%2$s">Function</a> and <a href="%3$s">FamFamFam Flags</a> icon sets - the pretty icons used by SimpleDesk';
$txt['shd_credits_user'] = '<strong>YOU</strong>, the proud users of SimpleDesk. Thank you for choosing our software!';
$txt['shd_credits_translators'] = 'Our translators - Thanks to you, people all around the world can use SimpleDesk';
$txt['shd_former_contributors'] = 'Former contributors are highlighted with a <span class="shd_former_contributor">brighter color</span>.';
//@}

//! @name Configuration items on the Display Options page
//@{
$txt['shd_staff_badge'] = 'What style of badges to use in ticket view?';
$txt['shd_staff_badge_note'] = 'When looking at different replies, it may be helpful to display badges if you have different teams who may respond in the helpdesk. It may also be useful to display members\' own badges, or not; this option lets you select.';
$txt['shd_staff_badge_nobadge'] = 'Display no badge, just a small icon for staff';
$txt['shd_staff_badge_staffbadge'] = 'Display badges only of staff members';
$txt['shd_staff_badge_userbadge'] = 'Display badges only of non-staff/regular users';
$txt['shd_staff_badge_bothbadge'] = 'Display badges of both users and staff';
$txt['shd_display_avatar'] = 'Display avatars in replies to a ticket?';
$txt['shd_ticketnav_style'] = 'What type of navigation to use in the ticket view?';
$txt['shd_ticketnav_style_note'] = 'When looking at tickets, there may be a number of options available to users, including edit, close, and delete. This option specifies the different ways this can look.';
$txt['shd_ticketnav_style_sd'] = 'SimpleDesk style (icon with small text note)';
$txt['shd_ticketnav_style_sdcompact'] = 'SimpleDesk style (icon only)';
$txt['shd_ticketnav_style_smf'] = 'SMF style (text buttons, above the ticket)';
//@}

//! @name Configuration items on the Posting Options page
//@{
$txt['shd_thank_you_post'] = 'Display a message to users on posting a ticket';
$txt['shd_thank_you_nonstaff'] = 'Display the message only to non-staff members';
$txt['shd_allow_wikilinks'] = 'Allow use of [[ticket:123]] wiki-style links';
$txt['shd_allow_ticket_bbc'] = 'Allow tickets and replies to use bbcode';
$txt['shd_allow_ticket_smileys'] = 'Allow tickets and replies to use smileys';
$txt['shd_attachments_mode'] = 'How should attachments to tickets be treated?';
$txt['shd_attachments_mode_ticket'] = 'As attached to the ticket';
$txt['shd_attachments_mode_reply'] = 'As attached to individual replies';
$txt['shd_attachments_mode_note'] = 'If using "to ticket" mode, there is no limit on the number of attachments, while if using "to replies", the helpdesk will use the same settings as regular attachments, by default 4 to a post only. Both modes check the size per attachment and that it will not fill up your attachments folder based on the settings in your attachments panel.';
$txt['shd_bbc'] = 'Enabled BBC tags in the helpdesk';
$txt['shd_bbc_desc'] = 'What tags should be enabled for use in the helpdesk?';
//@}

//! @name Configuration items on the Admin Options page
//@{
$txt['shd_maintenance_mode'] = 'Put the helpdesk into maintenance mode';
$txt['shd_staff_ticket_self'] = 'For tickets opened by staff, should it be possible to assign them the ticket?';
$txt['shd_admins_not_assignable'] = 'Should admins be excluded from having tickets assigned to them?';
$txt['shd_privacy_display'] = 'What method to use for displaying ticket privacy?';
$txt['shd_privacy_display_smart'] = 'Display a ticket\'s privacy setting when appropriate';
$txt['shd_privacy_display_always'] = 'Always display the ticket\'s privacy setting';
$txt['shd_privacy_display_note'] = 'Normally tickets are limited to user seeing their own and staff seeing all users. There are times you might want staff to be able to create tickets only for senior staff to see - this is a "private" ticket. Since "non-private" might be confusing for regular users, this option allows you to hide the display of "non private" or "private" to only when it is appropriate on a ticket.';
$txt['shd_disable_tickettotopic'] = 'Disable "ticket to topic" options';
$txt['shd_disable_tickettotopic_note'] = 'Normally, it is possible to move tickets to topics and back again (except in Standalone mode), this option denies it for all users regardless of any permissions for it.';
$txt['shd_disable_relationships'] = 'Disable relationships';
$txt['shd_disable_relationships_note'] = 'Disable tickets from having "relationships" with each other, regardless of any permissions for it.';
//@}

//! @name Configuration items on the Standalone Options page
//@{
$txt['shd_helpdesk_only'] = 'Enable helpdesk only mode';
$txt['shd_helpdesk_only_note'] = 'This will disable access to topics and boards, as well as optionally the features below. Note that none of the data is lost, merely rendered inactive. The following options ONLY apply when this mode is active (when the forum is basically disabled outside the helpdesk)';
$txt['shd_disable_pm'] = 'Disable private messages entirely';
$txt['shd_disable_mlist'] = 'Disable the memberlist entirely';
//@}

//! @name Configuration items on the Action Log Options page
//@{
$txt['shd_disable_action_log'] = 'Disable logging of helpdesk actions?';
$txt['shd_display_ticket_logs'] = 'Display a mini action log in each ticket?';
$txt['shd_logopt_newposts'] = 'Log new tickets and their replies';
$txt['shd_logopt_editposts'] = 'Log edits to tickets and posts';
$txt['shd_logopt_resolve'] = 'Log tickets being resolved/unresolved';
$txt['shd_logopt_assign'] = 'Log tickets being assigned/reassigned/unassigned';
$txt['shd_logopt_privacy'] = 'Log ticket privacy being changed';
$txt['shd_logopt_urgency'] = 'Log ticket urgency being changed';
$txt['shd_logopt_tickettopicmove'] = 'Log tickets being moved to topics and back';
$txt['shd_logopt_delete'] = 'Log tickets and replies being deleted';
$txt['shd_logopt_restore'] = 'Log tickets and replies being restored';
$txt['shd_logopt_permadelete'] = 'Log tickets and replies being permadeleted';
$txt['shd_logopt_relationships'] = 'Log any changes in ticket relationships';
$txt['shd_logopt_split'] = 'Log splitting of a ticket into two tickets';
//@}

//! @name General language strings for the action log (entries are contained in SimpleDesk-LogAction.english.php)
//@{
$txt['shd_delete_item'] = 'Delete this log item';
$txt['shd_admin_actionlog_title'] = 'Helpdesk action log';
$txt['shd_admin_actionlog_action'] = 'Action';
$txt['shd_admin_actionlog_date'] = 'Date';
$txt['shd_admin_actionlog_member'] = 'Member';
$txt['shd_admin_actionlog_position'] = 'Position';
$txt['shd_admin_actionlog_ip'] = 'IP';
$txt['shd_admin_actionlog_none'] = 'No entries were found.';
$txt['shd_admin_actionlog_unknown'] = 'Unknown';
$txt['shd_admin_actionlog_hidden'] = 'Hidden';
$txt['shd_admin_actionlog_removeall'] = 'Empty out the entire log';
$txt['shd_admin_actionlog_removeall_confirm'] = 'This will permanently delete all entries in the action log older than %s hours. Are you sure?';
//@}

//! @name Strings for the post-to-SimpleDesk.net support page
//@{
$txt['shd_admin_support_form_title'] = 'Support form';
$txt['shd_admin_support_what_is_this'] = 'What is this?';
$txt['shd_admin_support_explanation'] = 'This simple form will allow you to send a support request directly to the SimpleDesk website so that the support team there can help you solve any issue you run in to.<br /><br />Please note that you will need an account on our website in order to post as well as replying to your topic in the future. This form will simply speed up the posting process.';
$txt['shd_admin_support_send'] = 'Send support request';
//@}

//! @name The browse-attachments integration strings
//@{
$txt['attachment_manager_shd_attach'] = 'Helpdesk attachments';
$txt['attachment_manager_shd_thumb'] = 'Helpdesk thumbnails';
$txt['attachment_manager_shd_attach_no_entries'] = 'There are currently no helpdesk attachments.';
$txt['attachment_manager_shd_thumb_no_entries'] = 'There are currently no helpdesk thumbnails.';
//@}

//! @name Custom fields stuff
//@{
$txt['shd_admin_custom_fields'] = 'Custom Fields';
$txt['shd_admin_custom_fields_long'] = 'Custom Fields for Tickets and Replies';
$txt['shd_admin_custom_fields_desc'] = 'This section allows you to create extra fields that can be added to tickets and/or their replies, to gather additional information about the ticket or to help you manage your helpdesk.';
$txt['shd_admin_custom_fields_general'] = 'General Details';


$txt['shd_admin_custom_fields_fieldname'] = 'Field Name';
$txt['shd_admin_custom_fields_fieldname_desc'] = 'The name displayed next to where the user will enter the information (required)';
$txt['shd_admin_custom_fields_icon'] = 'Field Icon';
$txt['shd_admin_custom_fields_icon_desc'] = 'An optional icon displayed next to the field name.';
$txt['shd_admin_custom_fields_fieldtype'] = 'Field Type';
$txt['shd_admin_custom_fields_fieldtype_desc'] = 'The type of field the user will complete with requested information.';
$txt['shd_admin_custom_fields_active'] = 'Active';
$txt['shd_admin_custom_fields_inactive'] = 'Not active';
$txt['shd_admin_custom_fields_active_desc'] = 'This is a master toggle for this field; if it is not active, it will not be displayed or requested from the user when posting.';
$txt['shd_admin_custom_fields_fielddesc'] = 'Field Description';
$txt['shd_admin_custom_fields_fielddesc_desc'] = 'A short description of the field you are adding.';
$txt['shd_admin_custom_fields_visible'] = 'Visible';
$txt['shd_admin_custom_fields_visible_ticket'] = 'Visible/editable for a ticket';
$txt['shd_admin_custom_fields_visible_field'] = 'Visible/editable in replies';
$txt['shd_admin_custom_fields_visible_both'] = 'Visible/editable in both tickets and replies';
$txt['shd_admin_custom_fields_visible_desc'] = 'This controls whether a given field applies to just tickets as a whole, to replies individually or both a ticket and its replies.';
$txt['shd_admin_custom_fields_none'] = '(none)';
$txt['shd_admin_no_custom_fields'] = 'There are no custom fields currently set up.';
$txt['shd_admin_custom_fields_inticket'] = 'Visible on a ticket';
$txt['shd_admin_custom_fields_inreply'] = 'Visible on a reply';
$txt['shd_admin_custom_fields_move'] = 'Move';
$txt['shd_admin_move_up'] = 'Move up';
$txt['shd_admin_move_down'] = 'Move down';
$txt['shd_admin_custom_fields_ui_text'] = 'Textbox';
$txt['shd_admin_custom_fields_ui_largetext'] = 'Large textbox';
$txt['shd_admin_custom_fields_ui_int'] = 'Integer (whole numbers)';
$txt['shd_admin_custom_fields_ui_float'] = 'Floating (fractional) numbers';
$txt['shd_admin_custom_fields_ui_select'] = 'Select from a dropdown';
$txt['shd_admin_custom_fields_ui_checkbox'] = 'Tickbox (yes/no)';
$txt['shd_admin_custom_fields_ui_radio'] = 'Select from radio buttons';
$txt['shd_admin_cannot_edit_custom_field'] = 'You cannot edit that custom field.';
$txt['shd_admin_cannot_move_custom_field'] = 'You cannot move that custom field.';
$txt['shd_admin_cannot_move_custom_field_up'] = 'You cannot move that custom field up; it is the first item already.';
$txt['shd_admin_cannot_move_custom_field_down'] = 'You cannot move that custom field down; it is the last item already.';
$txt['shd_admin_new_custom_field'] = 'Add New Field';
$txt['shd_admin_new_custom_field_desc'] = 'From this panel you can add a new custom field for your tickets and/or their replies, and specify how these should function for you.';
$txt['shd_admin_edit_custom_field'] = 'Edit Existing Field';
$txt['shd_admin_edit_custom_field_desc'] = 'From this panel you can edit an existing custom field, as set out below.';
//@}

//! Plugins
//@{
$txt['shd_admin_plugins'] = 'Plugins';
$txt['shd_admin_plugins_homedesc'] = 'This area allows you to manage any additional components for SimpleDesk. They are installed through the Package Manager as regular mods, and configured from here.';
$txt['shd_admin_plugins_none'] = 'No plugins are currently installed.';
$txt['shd_admin_plugins_writtenby'] = 'Written by';
$txt['shd_admin_plugins_website'] = 'Website';
$txt['shd_admin_plugins_wrong_version'] = 'Not supported by this version!';
$txt['shd_admin_plugins_versions_avail'] = 'Supported by the plugin';
$txt['shd_admin_plugins_languages'] = 'Available languages';
$txt['shd_admin_plugins_lang_albanian'] = 'Albanian';
$txt['shd_admin_plugins_lang_arabic'] = 'Arabic';
$txt['shd_admin_plugins_lang_bangla'] = 'Bangla';
$txt['shd_admin_plugins_lang_bulgarian'] = 'Bulgarian';
$txt['shd_admin_plugins_lang_catalan'] = 'Catalan';
$txt['shd_admin_plugins_lang_chinese_simplified'] = 'Chinese (simplified)';
$txt['shd_admin_plugins_lang_chinese_traditional'] = 'Chinese (traditional)';
$txt['shd_admin_plugins_lang_croatian'] = 'Croatian';
$txt['shd_admin_plugins_lang_czech'] = 'Czech';
$txt['shd_admin_plugins_lang_danish'] = 'Danish';
$txt['shd_admin_plugins_lang_dutch'] = 'Dutch';
$txt['shd_admin_plugins_lang_english'] = 'English (US)';
$txt['shd_admin_plugins_lang_english_british'] = 'English (UK)';
$txt['shd_admin_plugins_lang_finnish'] = 'Finnish';
$txt['shd_admin_plugins_lang_french'] = 'French';
$txt['shd_admin_plugins_lang_galician'] = 'Galician';
$txt['shd_admin_plugins_lang_german'] = 'German';
$txt['shd_admin_plugins_lang_hebrew'] = 'Hebrew';
$txt['shd_admin_plugins_lang_hindi'] = 'Hindi';
$txt['shd_admin_plugins_lang_hungarian'] = 'Hungarian';
$txt['shd_admin_plugins_lang_indonesian'] = 'Indonesian';
$txt['shd_admin_plugins_lang_italian'] = 'Italian';
$txt['shd_admin_plugins_lang_japanese'] = 'Japanese';
$txt['shd_admin_plugins_lang_kurdish_kurmanji'] = 'Kurdish (Kurmanji)';
$txt['shd_admin_plugins_lang_kurdish_sorani'] = 'Kurdish (Sorani)';
$txt['shd_admin_plugins_lang_macedonian'] = 'Macedonian';
$txt['shd_admin_plugins_lang_malay'] = 'Malay';
$txt['shd_admin_plugins_lang_norwegian'] = 'Norwegian';
$txt['shd_admin_plugins_lang_persian'] = 'Persian';
$txt['shd_admin_plugins_lang_polish'] = 'Polish';
$txt['shd_admin_plugins_lang_portuguese_brazilian'] = 'Portuguese (Brazilian)';
$txt['shd_admin_plugins_lang_portuguese_pt'] = 'Portuguese';
$txt['shd_admin_plugins_lang_romanian'] = 'Romanian';
$txt['shd_admin_plugins_lang_russian'] = 'Russian';
$txt['shd_admin_plugins_lang_serbian_cyrillic'] = 'Serbian (Cyrillic)';
$txt['shd_admin_plugins_lang_serbian_latin'] = 'Serbian (Latin)';
$txt['shd_admin_plugins_lang_slovak'] = 'Slovak';
$txt['shd_admin_plugins_lang_spanish_es'] = 'Spanish (Spain)';
$txt['shd_admin_plugins_lang_spanish_latin'] = 'Spanish (Latin)';
$txt['shd_admin_plugins_lang_swedish'] = 'Swedish';
$txt['shd_admin_plugins_lang_thai'] = 'Thai';
$txt['shd_admin_plugins_lang_turkish'] = 'Turkish';
$txt['shd_admin_plugins_lang_ukrainian'] = 'Ukrainian';
$txt['shd_admin_plugins_lang_urdu'] = 'Urdu';
$txt['shd_admin_plugins_lang_uzbek_latin'] = 'Uzbek (Latin)';
$txt['shd_admin_plugins_lang_vietnamese'] = 'Vietnamese';
//@}

/**
 *	@ignore
 *	Warning: He may bite.
*/
$txt['shd_fluffy'] = 'Guardian of the <span %s>cookies</span>';

?>