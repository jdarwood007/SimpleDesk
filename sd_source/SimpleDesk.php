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
# File Info: SimpleDesk.php / 1.0 Felidae                     #
###############################################################

/**
 *	This file serves as the entry point for SimpleDesk generally, as well as the home of the ticket listing
 *	code, for open, closed and deleted tickets.
 *
 *	@package source
 *	@since 1.0
 */

if (!defined('SMF'))
	die('Hacking attempt...');

/**
 *	Begins SimpleDesk general processing.
 *
 *	Several things are done here, the results of which are unilaterally assumed by all other SimpleDesk functions.
 *	- load standard constants for ticket status and urgency<
 *	- set up general navigation
 *	- see if the URL or POST data contains a ticket, if so sanitise and store that value
 *	- see if a msg was specified in the URL, if so identify the relevant ticket
 *	- add in the helpdesk CSS file
 *	- identify the sub action to direct them to, then send them on their way.
 *
 *	@since 1.0
*/
function shd_main()
{
	global $context, $txt, $settings, $sourcedir, $modSettings, $scripturl, $user_profile, $user_info, $smcFunc;

	// Basic sanity stuff
	if (!$modSettings['helpdesk_active'])
		fatal_lang_error('shd_inactive', false);

	shd_is_allowed_to('access_helpdesk');

	// Load stuff: preferences the core template - and any hook-required files
	$context['shd_preferences'] = shd_load_user_prefs();
	loadTemplate('sd_template/SimpleDesk');
	shd_load_plugin_files('helpdesk');
	shd_load_plugin_langfiles('helpdesk');

	// List of sub actions.
	$subactions = array(
		'main' => array(null, 'shd_main_helpdesk'),
		'viewblock' => array(null, 'shd_view_block'),
		'ticket' => array('SimpleDesk-Display.php', 'shd_view_ticket'),
		'newticket' => array('SimpleDesk-Post.php', 'shd_post_ticket'),
		'editticket' => array('SimpleDesk-Post.php', 'shd_post_ticket'),
		'saveticket' => array('SimpleDesk-Post.php', 'shd_save_post'), // this is the equivalent of post2
		'reply' => array('SimpleDesk-Post.php', 'shd_post_reply'),
		'savereply' => array('SimpleDesk-Post.php', 'shd_save_post'),
		'editreply' => array('SimpleDesk-Post.php', 'shd_post_reply'),
		'markunread' => array('SimpleDesk-MiscActions.php', 'shd_ticket_unread'),
		'assign' => array('SimpleDesk-Assign.php', 'shd_assign'),
		'assign2' => array('SimpleDesk-Assign.php', 'shd_assign2'),
		'resolveticket' => array('SimpleDesk-MiscActions.php', 'shd_ticket_resolve'),
		'relation' => array('SimpleDesk-MiscActions.php', 'shd_ticket_relation'),
		'ajax' => array('SimpleDesk-AjaxHandler.php', 'shd_ajax'),
		'privacychange' => array('SimpleDesk-MiscActions.php', 'shd_privacy_change_noajax'),
		'urgencychange' => array('SimpleDesk-MiscActions.php', 'shd_urgency_change_noajax'),
		'closedtickets' => array(null, 'shd_closed_tickets'),
		'recyclebin' => array(null, 'shd_recycle_bin'),
		'tickettotopic' => array('SimpleDesk-TicketTopicMove.php', 'shd_tickettotopic'),
		'tickettotopic2' => array('SimpleDesk-TicketTopicMove.php', 'shd_tickettotopic2'),
		'topictoticket' => array('SimpleDesk-TicketTopicMove.php', 'shd_topictoticket'),
		'topictoticket2' => array('SimpleDesk-TicketTopicMove.php', 'shd_topictoticket2'),
		'permadelete' => array('SimpleDesk-Delete.php', 'shd_perma_delete'),
		'deleteticket' => array('SimpleDesk-Delete.php', 'shd_ticket_delete'),
		'deletereply' => array('SimpleDesk-Delete.php', 'shd_reply_delete'),
		'restoreticket' => array('SimpleDesk-Delete.php', 'shd_ticket_restore'),
		'restorereply' => array('SimpleDesk-Delete.php', 'shd_reply_restore'),
		//'mergeticket' => array('SimpleDesk-MergeSplit.php', 'shd_merge_ticket'),
		//'mergeticket2' => array('SimpleDesk-MergeSplit.php', 'shd_merge_ticket2'),
		//'splitticket' => array('SimpleDesk-MergeSplit.php', 'shd_split_ticket'),
		//'splitticket2' => array('SimpleDesk-MergeSplit.php', 'shd_split_ticket2'),
	);

	// Navigation menu
	$context['navigation'] = array(
		'main' => array(
			'text' => 'shd_home',
			'lang' => true,
			'url' => $scripturl . '?action=helpdesk;sa=main',
		),
		'newticket' => array(
			'text' => 'shd_new_ticket',
			'test' => 'can_new_ticket',
			'lang' => true,
			'url' => $scripturl . '?action=helpdesk;sa=newticket',
		),
		'newticketproxy' => array(
			'text' => 'shd_new_ticket_proxy',
			'test' => 'can_proxy_ticket',
			'lang' => true,
			'url' => $scripturl . '?action=helpdesk;sa=newticket;proxy',
		),
		'closedtickets' => array(
			'text' => 'shd_tickets_closed',
			'test' => 'can_view_closed',
			'lang' => true,
			'url' => $scripturl . '?action=helpdesk;sa=closedtickets',
		),
		'recyclebin' => array(
			'text' => 'shd_recycle_bin',
			'test' => 'can_view_recycle',
			'lang' => true,
			'url' => $scripturl . '?action=helpdesk;sa=recyclebin',
		),
		// Only for certain sub areas.
		'back' => array(
			'text' => 'shd_back_to_hd',
			'test' => 'display_back_to_hd',
			'lang' => true,
			'url' => $scripturl . '?action=helpdesk;sa=main',
		),
	);

	// Build the link tree.
	$context['linktree'][] = array(
		'url' => $scripturl . '?action=helpdesk;sa=main',
		'name' => $txt['shd_helpdesk'],
	);

	// See if a ticket has been specified, like $topic can be.
	if (!empty($_REQUEST['ticket']))
	{
		if (strpos($_REQUEST['ticket'], '.') === false)
		{
			$context['ticket_id'] = (int) $_REQUEST['ticket'];
			$context['ticket_start'] = 0;
		}
		else
		{
			list ($context['ticket_id'], $context['ticket_start']) = explode('.', $_REQUEST['ticket']);
			$context['ticket_id'] = (int) $context['ticket_id'];
			if (!is_numeric($context['ticket_start']))
			{
				// Let's see if it's 'new' first. If it is, great, we'll figure out the new point then throw it at the next one.
				if (substr($context['ticket_start'], 0, 3) == 'new')
				{
					$query = shd_db_query('', '
						SELECT IFNULL(hdlr.id_msg, -1) + 1 AS new_from
						FROM {db_prefix}helpdesk_tickets AS hdt
							LEFT JOIN {db_prefix}helpdesk_log_read AS hdlr ON (hdlr.id_ticket = {int:ticket} AND hdlr.id_member = {int:member})
						WHERE {query_see_ticket}
							AND hdt.id_ticket = {int:ticket}
						LIMIT 1',
						array(
							'member' => $user_info['id'],
							'ticket' => $context['ticket_id'],
						)
					);
					list ($new_from) = $smcFunc['db_fetch_row']($query);
					$smcFunc['db_free_result']($query);
					$context['ticket_start'] = 'msg' . $new_from;
					$context['ticket_start_newfrom'] = $new_from;
				}

				if (substr($context['ticket_start'], 0, 3) == 'msg')
				{
					$virtual_msg = (int) substr($context['ticket_start'], 3);
					$query = shd_db_query('', '
						SELECT COUNT(hdtr.id_msg)
						FROM {db_prefix}helpdesk_ticket_replies AS hdtr
							INNER JOIN {db_prefix}helpdesk_tickets AS hdt ON (hdtr.id_ticket = hdt.id_ticket)
						WHERE {query_see_ticket}
							AND hdtr.id_ticket = {int:ticket}
							AND hdtr.id_msg > hdt.id_first_msg
							AND hdtr.id_msg < {int:virtual_msg}' . (!isset($_GET['recycle']) ? '
							AND hdtr.message_status = {int:message_notdel}' : ''),
						array(
							'ticket' => $context['ticket_id'],
							'virtual_msg' => $virtual_msg,
							'message_notdel' => MSG_STATUS_NORMAL,
						)
					);
					list ($context['ticket_start']) = $smcFunc['db_fetch_row']($query);
					$smcFunc['db_free_result']($query);
				}
			}
			else
				$context['ticket_start'] = (int) $context['ticket_start']; // it IS numeric but let's make sure it's the right kind of number
		}
	}
	if (empty($context['ticket_start_newfrom']))
		$context['ticket_start_newfrom'] = empty($context['ticket_start']) ? 0 : $context['ticket_start'];

	// Do we have just a message id? We can get the ticket from that - but only if we don't already have a ticket id!
	$_REQUEST['msg'] = !empty($_REQUEST['msg']) ? (int) $_REQUEST['msg'] : 0;
	if (!empty($_REQUEST['msg']) && empty($context['ticket_id']))
	{
		$query = shd_db_query('', '
			SELECT hdt.id_ticket, hdtr.id_msg
			FROM {db_prefix}helpdesk_ticket_replies AS hdtr
				INNER JOIN {db_prefix}helpdesk_tickets AS hdt ON (hdtr.id_ticket = hdt.id_ticket)
			WHERE {query_see_ticket}
				AND hdtr.id_msg = {int:msg}',
			array(
				'msg' => $_REQUEST['msg'],
			)
		);

		if ($row = $smcFunc['db_fetch_row']($query))
			$context['ticket_id'] = (int) $row[0];

		$smcFunc['db_free_result']($query);
	}

	$context['items_per_page'] = 10;
	$context['start'] = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;

	// Load the custom CSS.
	if (empty($context['html_headers']))
		$context['html_headers'] = '';

	$context['html_headers'] .= '
	<link rel="stylesheet" type="text/css" href="' . (file_exists($settings['theme_dir'] . '/css/helpdesk.css') ? $settings['theme_url'] . '/css/helpdesk.css' : $settings['default_theme_url'] . '/css/helpdesk.css') . '" />
	<script type="text/javascript" src="' . $settings['default_theme_url'] . '/scripts/helpdesk.js?rc2"></script>';

	// Darn IE6. Die, already :(
	if ($context['browser']['is_ie6'])
		$context['html_headers'] .= '
		<!-- Fall back, dark force, for we shall thou evil powers not endorse -->
		<link rel="stylesheet" type="text/css" href="' . $settings['default_theme_url'] . '/css/helpdesk_ie6.css" />';

	// Int hooks - after we basically set everything up (so it's manipulatable by the hook, but before we do the last bits of finalisation)
	if (!empty($modSettings['shd_hook_helpdesk']))
	{
		$functions = explode(',', $modSettings['shd_hook_helpdesk']);
		foreach ($functions as $function)
		{
			if (is_callable($function))
				$function($subactions); // this should be picked up by reference in the called function or it won't do anything! (everything else is in $context)
		}
	}

	// What are we doing?
	$_REQUEST['sa'] = (!empty($_REQUEST['sa']) && isset($subactions[$_REQUEST['sa']])) ? $_REQUEST['sa'] : 'main';
	$context['sub_action'] = $subactions[$_REQUEST['sa']];

	$context['can_new_ticket'] = shd_allowed_to('shd_new_ticket');
	$context['can_proxy_ticket'] = $context['can_new_ticket'] && shd_allowed_to('shd_post_proxy');
	$context['can_view_closed'] = shd_allowed_to('shd_resolve_ticket_own') || shd_allowed_to('shd_resolve_ticket_any');
	$context['can_view_recycle'] = shd_allowed_to('shd_access_recyclebin');
	$context['display_back_to_hd'] = !in_array($_REQUEST['sa'], array('main', 'viewblock', 'recyclebin', 'closedtickets'));

	// Highlight the correct button.
	if (isset($context['navigation'][$_REQUEST['sa']]))
		$context['navigation'][$_REQUEST['sa']]['active'] = true;

	// Send them away.
	if ($context['sub_action'][0] !== null)
		require ($sourcedir . '/sd_source/' . $context['sub_action'][0]);

	$context['sub_action'][1]();

	// Maintenance mode? If it were, the helpdesk is considered inactive for the purposes of everything to all but those without admin-helpdesk rights - but we must have them if we're here!
	if (!empty($modSettings['shd_maintenance_mode']) && $_REQUEST['sa'] != 'ajax')
		$context['template_layers'][] = 'shd_maintenance';
}

/**
 *	Display the main front page, showing tickets waiting for staff, waiting for user feedback and so on.
 *
 *	This function sets up multiple blocks to be shown to users, defines what columns these blocks should have and states
 *	the rules to be used in getting the data.
 *
 *	Each block has multiple parameters, and is stated in $context['ticket_blocks']:
 *	<ul>
 *	<li>block_icon: which image to use in Themes/default/images/simpledesk for denoting the type of block; filename plus extension</li>
 *	<li>title: the text string to use as the block's heading</li>
 *	<li>where: an SQL clause denoting the rule for obtaining the items in this block</li>
 *	<li>display: whether the block should be processed and prepared for display</li>
 *	<li>count: the number of items in this block, for pagination; generally should be a call to {@link shd_count_helpdesk_tickets()}</li>
 *	<li>columns: an array of columns to display in this block, in the order they should be displayed, using the following options, derived from {@link shd_get_block_columns()}:
 *		<ul>
 *			<li>ticket_id: the ticket's read status, privacy icon, and id</li>
 *			<li>ticket_name: name/link to the ticket</li>
 *			<li>starting_user: profile link to the user who opened the ticket</li>
 *			<li>replies: number of (visible) replies in the ticket</li>
 *			<li>allreplies: number of (all) replies in the ticket (includes deleted replies, which 'replies' does not)</li>
 *			<li>last_reply: the user who last replied</li>
 *			<li>status: the current ticket's status</li>
 *			<li>assigned: link to the profile of the user the ticket is assigned to, or 'Unassigned' if not assigned</li>
 *			<li>urgency: the current ticket's urgency</li>
 *			<li>updated: time of the last reply in the ticket; states Never if no replies</li>
 *			<li>actions: icons that may or may not relate to a given ticket; buttons for recycle, delete, unresolve live in this column</li>
 *		</ul>
 *	<li>required: whether the block is required to be displayed even if empty</li>
 *	<li>collapsed: whether the block should be compressed to a header with count of tickets or not (mostly for {@link shd_view_block()}'s benefit)</li>
 *	</ul>
 *
 *	This function declares the following blocks:
 *	<ul>
 *	<li>Assigned to me (staff only)</li>
 *	<li>New tickets (staff only)</li>
 *	<li>Pending with staff (for staff, this is just tickets with that status, for regular users this is both pending staff and new unreplied to tickets)</li>
 *	<li>Pending with user (both)</li>
 *	</ul>
 *
 *	@see shd_count_helpdesk_tickets()
 *	@since 1.0
*/
function shd_main_helpdesk()
{
	global $context, $txt, $smcFunc, $user_profile, $scripturl, $user_info;

	$is_staff = shd_allowed_to('shd_staff');
	// Stuff we need to add to $context, page title etc etc
	$context += array(
		'page_title' => $txt['shd_helpdesk'],
		'sub_template' => 'main',
		'ticket_blocks' => array( // the numbers tie back to the master status idents
			'assigned' => array(
				'block_icon' => 'assign.png',
				'title' => $txt['shd_status_assigned_heading'],
				'where' => 'hdt.id_member_assigned = ' . $user_info['id'] . ' AND hdt.status NOT IN (' . TICKET_STATUS_CLOSED . ',' . TICKET_STATUS_DELETED . ')',
				'display' => $is_staff,
				'count' => shd_count_helpdesk_tickets('assigned'),
				'columns' => shd_get_block_columns('assigned'),
				'required' => $is_staff,
				'collapsed' => false,
			),
			'new' => array(
				'block_icon' => 'status.png',
				'title' => $txt['shd_status_' . TICKET_STATUS_NEW . '_heading'],
				'where' => 'hdt.id_member_assigned != ' . $user_info['id'] . ' AND hdt.status = ' . TICKET_STATUS_NEW,
				'display' => $is_staff,
				'count' => shd_count_helpdesk_tickets('new'),
				'columns' => shd_get_block_columns('new'),
				'required' => false,
				'collapsed' => false,
			),
			'staff' => array(
				'block_icon' => 'staff.png',
				'title' => $txt['shd_status_' . TICKET_STATUS_PENDING_STAFF . '_heading'],
				'where' => $is_staff ? ('hdt.id_member_assigned != ' . $user_info['id'] . ' AND hdt.status = ' . TICKET_STATUS_PENDING_STAFF) : ('hdt.status IN (' . TICKET_STATUS_NEW . ',' . TICKET_STATUS_PENDING_STAFF . ')'), // put new and with staff together in 'waiting for staff' for end user
				'display' => true,
				'count' => shd_count_helpdesk_tickets('staff', $is_staff),
				'columns' => shd_get_block_columns('staff'),
				'required' => true,
				'collapsed' => false,
			),
			'user' => array(
				'block_icon' => 'user.png',
				'title' => $txt['shd_status_' . TICKET_STATUS_PENDING_USER . '_heading'],
				'where' => $is_staff ? ('hdt.id_member_assigned != ' . $user_info['id'] . ' AND hdt.status = ' . TICKET_STATUS_PENDING_USER) : ('hdt.status = ' . TICKET_STATUS_PENDING_USER),
				'display' => true,
				'count' => shd_count_helpdesk_tickets('with_user'),
				'columns' => shd_get_block_columns($is_staff ? 'user_staff' : 'user_user'),
				'required' => true,
				'collapsed' => false,
			),
		),
		'shd_home_view' => shd_allowed_to('shd_staff') ? 'staff' : 'user',
	);

	shd_helpdesk_listing();
}

/**
 *	Sets up viewing of a single block without any pagination.
 *
 *	This provides the ability to see all of a given type of ticket at once without paging through them, which are all sortable.
 *
 *	@see shd_main_helpdesk()
 *	@since 1.0
*/
function shd_view_block()
{
	global $context, $txt, $smcFunc, $user_profile, $scripturl, $user_info;

	$is_staff = shd_allowed_to('shd_staff');
	// Stuff we need to add to $context, page title etc etc
	$context += array(
		'page_title' => $txt['shd_helpdesk'],
		'sub_template' => 'main',
		'ticket_blocks' => array( // the numbers tie back to the master status idents
			'assigned' => array(
				'block_icon' => 'assign.png',
				'title' => $txt['shd_status_assigned_heading'],
				'where' => 'hdt.id_member_assigned = ' . $user_info['id'] . ' AND hdt.status NOT IN (' . TICKET_STATUS_CLOSED . ',' . TICKET_STATUS_DELETED . ')',
				'display' => $is_staff,
				'count' => shd_count_helpdesk_tickets('assigned'),
				'columns' => shd_get_block_columns('assigned'),
				'required' => $is_staff,
				'collapsed' => false,
			),
			'new' => array(
				'block_icon' => 'status.png',
				'title' => $txt['shd_status_' . TICKET_STATUS_NEW . '_heading'],
				'where' => 'hdt.id_member_assigned != ' . $user_info['id'] . ' AND hdt.status = ' . TICKET_STATUS_NEW,
				'display' => $is_staff,
				'count' => shd_count_helpdesk_tickets('new'),
				'columns' => shd_get_block_columns('new'),
				'required' => false,
				'collapsed' => false,
			),
			'staff' => array(
				'block_icon' => 'staff.png',
				'title' => $txt['shd_status_' . TICKET_STATUS_PENDING_STAFF . '_heading'],
				'where' => $is_staff ? ('hdt.id_member_assigned != ' . $user_info['id'] . ' AND hdt.status = ' . TICKET_STATUS_PENDING_STAFF) : ('hdt.status IN (' . TICKET_STATUS_NEW . ',' . TICKET_STATUS_PENDING_STAFF . ')'), // put new and with staff together in 'waiting for staff' for end user
				'display' => true,
				'count' => shd_count_helpdesk_tickets('staff', $is_staff),
				'columns' => shd_get_block_columns('staff'),
				'required' => true,
				'collapsed' => false,
			),
			'user' => array(
				'block_icon' => 'user.png',
				'title' => $txt['shd_status_' . TICKET_STATUS_PENDING_USER . '_heading'],
				'where' => $is_staff ? ('hdt.id_member_assigned != ' . $user_info['id'] . ' AND hdt.status = ' . TICKET_STATUS_PENDING_USER) : ('hdt.status = ' . TICKET_STATUS_PENDING_USER),
				'display' => true,
				'count' => shd_count_helpdesk_tickets('with_user'),
				'columns' => shd_get_block_columns($is_staff ? 'user_staff' : 'user_user'),
				'required' => true,
				'collapsed' => false,
			),
		),
		'shd_home_view' => shd_allowed_to('shd_staff') ? 'staff' : 'user',
	);

	if (empty($_REQUEST['block']) || empty($context['ticket_blocks'][$_REQUEST['block']]) || empty($context['ticket_blocks'][$_REQUEST['block']]['count']))
		redirectexit('action=helpdesk;sa=main');

	$context['items_per_page'] = 10;
	foreach ($context['ticket_blocks'] as $block => $details)
	{
		if ($block == $_REQUEST['block'])
			$context['items_per_page'] = $details['count'];
		else
			$context['ticket_blocks'][$block]['collapsed'] = true;
	}

	shd_helpdesk_listing();
}

/**
 *	Set up the paginated lists of closed tickets.
 *
 *	Much like the main helpdesk, this function prepares a list of all the closed/resolved tickets, with a more specific
 *	list of columns that is better suited to resolved tickets.
 *
 *	@see shd_main_helpdesk()
 *	@since 1.0
*/
function shd_closed_tickets()
{
	global $context, $txt, $smcFunc, $user_profile, $scripturl, $settings, $user_info;

	if (!shd_allowed_to('shd_resolve_ticket_own') && !shd_allowed_to('shd_resolve_ticket_any'))
		fatal_lang_error('shd_cannot_view_resolved', false);

	// Stuff we need to add to $context, the permission we want to use, page title etc etc
	$context += array(
		'page_title' => $txt['shd_helpdesk'],
		'sub_template' => 'closedtickets',
		'ticket_blocks' => array(
			'closed' => array(
				'block_icon' => 'resolved.png',
				'title' => $txt['shd_status_' . TICKET_STATUS_CLOSED . '_heading'],
				'where' => 'hdt.status = ' . TICKET_STATUS_CLOSED,
				'display' => true,
				'count' => shd_count_helpdesk_tickets('closed'),
				'columns' => shd_get_block_columns('closed'),
				'required' => true,
				'collapsed' => false,
			),
		),
		'shd_home_view' => shd_allowed_to('shd_staff') ? 'staff' : 'user', // This might be removed in the future. We do this here to be able to re-use template_ticket_block() in the template.
	);

	// Build the link tree.
	$context['linktree'][] = array(
		'url' => $scripturl . '?action=helpdesk;sa=main',
		'name' => $txt['shd_linktree_tickets'],
	);
	$context['linktree'][] = array(
		'url' => $scripturl . '?action=helpdesk;sa=closedtickets',
		'name' => $txt['shd_tickets_closed'],
	);

	shd_helpdesk_listing();
}

/**
 *	Set up the paginated lists of deleted/recyclebin tickets.
 *
 *	Much like the main helpdesk, this function prepares a list of all the deleted tickets, with a more specific
 *	list of columns that is better suited to recyclable or permadeletable tickets.
 *
 *	@see shd_main_helpdesk()
 *	@since 1.0
*/
function shd_recycle_bin()
{
	global $context, $txt, $smcFunc, $user_profile, $scripturl, $settings, $user_info;

	// Stuff we need to add to $context, the permission we want to use, page title etc etc
	$context += array(
		'shd_permission' => 'shd_access_recyclebin',
		'page_title' => $txt['shd_helpdesk'],
		'sub_template' => 'recyclebin',
		'ticket_blocks' => array(
			'recycle' => array(
				'block_icon' => 'recycle.png',
				'title' => $txt['shd_status_' . TICKET_STATUS_DELETED . '_heading'],
				'tickets' => array(),
				'where' => 'hdt.status = ' . TICKET_STATUS_DELETED,
				'display' => true,
				'count' => shd_count_helpdesk_tickets('recycled'),
				'columns' => shd_get_block_columns('recycled'),
				'required' => true,
				'collapsed' => false,
			),
			'withdeleted' => array(
				'block_icon' => 'recycle.png',
				'title' => $txt['shd_status_withdeleted_heading'],
				'tickets' => array(),
				'where' => 'hdt.status != ' . TICKET_STATUS_DELETED . ' AND hdt.deleted_replies > 0',
				'display' => true,
				'count' => shd_count_helpdesk_tickets('withdeleted'),
				'columns' => shd_get_block_columns('withdeleted'),
				'required' => true,
				'collapsed' => false,
			),
		),
	);

	// Build the link tree.
	$context['linktree'][] = array(
		'url' => $scripturl . '?action=helpdesk;sa=recyclebin',
		'name' => $txt['shd_recycle_bin'],
	);

	shd_helpdesk_listing();
}

/**
 *	Gather the data and prepare to display the ticket blocks.
 *
 *	Actually performs the queries to get data for each block, subject to the parameters specified by the calling functions.
 *
 *	It also sets up per-block pagination links, collects a variety of data (enough to populate all the columns as listed in shd_main_helpdesk,
 *	even if not entirely applicable, and populates it all into $context['ticket_blocks']['tickets'], extending the array that was
 *	already there.
 *
 *	@see shd_main_helpdesk()
 *	@see shd_closed_tickets()
 *	@see shd_recycle_bin()
 *	@since 1.0
*/
function shd_helpdesk_listing()
{
	global $context, $txt, $smcFunc, $user_profile, $scripturl, $settings, $user_info, $modSettings, $language;

	if (!empty($context['shd_permission']))
		shd_is_allowed_to($context['shd_permission']);

	// So, we want the [new] icon. Where is it?
	$newimgpaths = array(
		$settings['theme_dir'] . '/images/' . $language => $settings['lang_images_url'],
		$settings['theme_dir'] . '/images/english' => $settings['images_url'] . '/english',
		$settings['default_theme_dir'] . '/images/' . $language => $settings['default_images_url'] . '/' . $language,
	);
	$files = array('new.gif', 'new.png');
	$context['new_posts_image'] = $settings['default_images_url'] . '/english/new.gif'; // likely default, but we'll check the theme etc first just in case.
	foreach ($newimgpaths as $physicalpath => $urlpath)
	{
		foreach ($files as $file)
		{
			if (file_exists($physicalpath . '/' . $file))
			{
				$context['new_posts_image'] = $urlpath . '/' . $file;
				break 2;
			}
		}
	}

	$num_per_page = $context['items_per_page'];
	$block_list = array_keys($context['ticket_blocks']);
	$primary_url = '?action=helpdesk;sa=' . $_REQUEST['sa'];

	// First figure out the start positions of each item and sanitise them
	foreach ($context['ticket_blocks'] as $block_key => $block)
	{
		$start = empty($_REQUEST['st_' . $block_key]) ? 0 : (int) $_REQUEST['st_' . $block_key];
		$max_value = $block['count']; // easier to read

		if ($start < 0)
			$start = 0;
		elseif ($start >= $max_value)
			$start = max(0, (int) $max_value - (((int) $max_value % (int) $num_per_page) == 0 ? $num_per_page : ((int) $max_value % (int) $num_per_page)));
		else
			$start = max(0, (int) $start - ((int) $start % (int) $num_per_page));

		$context['ticket_blocks'][$block_key]['start'] = $start;
		if ($start != 0)
			$_REQUEST['st_' . $block_key] = $start; // sanitise!
		elseif (isset($_REQUEST['st_' . $block_key]))
			unset($_REQUEST['st_' . $block_key]);
	}

	// Now ordering the columns, separate loop for breaking the two processes apart
	$sort_methods = array(
		'ticketid' => array(
			'sql' => 'hdt.id_ticket',
		),
		'ticketname' => array(
			'sql' => 'hdt.subject',
		),
		'replies' => array(
			'sql' => 'hdt.num_replies',
		),
		'allreplies' => array(
			'sql' => '(hdt.num_replies + hdt.deleted_replies)',
		),
		'urgency' => array(
			'sql' => 'hdt.urgency',
		),
		'updated' => array(
			'sql' => 'hdt.id_last_msg',
		),
		'assigned' => array(
			'sql' => 'assigned_name',
			'sql_select' => 'IFNULL(mem.real_name, 0) AS assigned_name',
			'sql_join' => 'LEFT JOIN {db_prefix}members AS mem ON (hdt.id_member_assigned = mem.id_member)',
		),
		'status' => array(
			'sql' => 'hdt.status',
		),
		'starter' => array(
			'sql' => 'starter_name',
			'sql_select' => 'IFNULL(mem.real_name, 0) AS starter_name',
			'sql_join' => 'LEFT JOIN {db_prefix}members AS mem ON (hdt.id_member_started = mem.id_member)',
		),
		'lastreply' => array(
			'sql' => 'last_reply',
			'sql_select' => 'IFNULL(mem.real_name, 0) AS last_reply',
			'sql_join' => 'LEFT JOIN {db_prefix}members AS mem ON (hdtr_last.id_member = mem.id_member)',
		),
	);

	foreach ($context['ticket_blocks'] as $block_key => $block)
	{
		$sort = isset($_REQUEST['so_' . $block_key]) ? $_REQUEST['so_' . $block_key] : '';

		if (strpos($sort, '_') > 0 && substr_count($sort, '_') == 1)
		{
			list($sort_item, $sort_dir) = explode('_', $sort);

			if (empty($sort_methods[$sort_item]))
			{
				$sort_item = 'updated';
				$sort = '';
			}

			if (!in_array($sort_dir, array('asc', 'desc')))
			{
				$sort = '';
				$sort_dir = 'asc';
			}
		}
		else
		{
			$sort = '';
			$sort_item = 'updated';
			$sort_dir = $_REQUEST['sa'] == 'closedtickets' || $_REQUEST['sa'] == 'recyclebin' ? 'desc' : 'asc'; // default to newest first if on recyclebin or closed tickets, otherwise oldest first
		}

		if ($sort != '')
			$_REQUEST['so_' . $block_key] = $sort; // sanitise!
		elseif (isset($_REQUEST['so_' . $block_key]))
			unset($_REQUEST['so_' . $block_key]);

		$context['ticket_blocks'][$block_key]['sort'] = array(
			'item' => $sort_item,
			'direction' => $sort_dir,
			'add_link' => ($sort != ''),
			'sql' => array(
				'select' => !empty($sort_methods[$sort_item]['sql_select']) ? $sort_methods[$sort_item]['sql_select'] : '',
				'join' => !empty($sort_methods[$sort_item]['sql_join']) ? $sort_methods[$sort_item]['sql_join'] : '',
				'sort' => $sort_methods[$sort_item]['sql'] . ' ' . strtoupper($sort_dir),
			),
			'link_bits' => array(),
		);
	}

	// Having got all that, step through the blocks again to determine the full URL fragments
	foreach ($context['ticket_blocks'] as $block_key => $block)
		foreach ($sort_methods as $method => $sort_details)
			$context['ticket_blocks'][$block_key]['sort']['link_bits'][$method] = ';so_' . $block_key . '=' . $method . '_' . $block['sort']['direction'];

	// Now go actually do the whole block thang, setting up space for a list of users as we go along
	$users = array();

	foreach ($context['ticket_blocks'] as $block_key => $block)
	{
		if (empty($block['display']) || !empty($block['collapsed']))
			continue;

		$context['ticket_blocks'][$block_key]['tickets'] = array();

		$query = shd_db_query('', '
			SELECT hdt.id_ticket, hdt.id_last_msg, hdt.id_member_started, hdt.id_member_updated, hdt.id_member_assigned,
				hdt.subject, hdt.status, hdt.num_replies, hdt.deleted_replies, hdt.private, hdt.urgency,
				hdtr_first.poster_name AS ticket_opener, hdtr_last.poster_name AS respondent, hdtr_last.poster_time,
				IFNULL(hdlr.id_msg, 0) AS log_read' . (!empty($block['sort']['sql']['select']) ? ', ' . $block['sort']['sql']['select'] : '') . '
			FROM {db_prefix}helpdesk_tickets AS hdt
				INNER JOIN {db_prefix}helpdesk_ticket_replies AS hdtr_first ON (hdt.id_first_msg = hdtr_first.id_msg)
				INNER JOIN {db_prefix}helpdesk_ticket_replies AS hdtr_last ON (hdt.id_last_msg = hdtr_last.id_msg)
				LEFT JOIN {db_prefix}helpdesk_log_read AS hdlr ON (hdt.id_ticket = hdlr.id_ticket AND hdlr.id_member = {int:user})
				' . (!empty($block['sort']['sql']['join']) ? $block['sort']['sql']['join'] : '') . '
			WHERE {query_see_ticket}' . (!empty($block['where']) ? ' AND ' . $block['where'] : '') . '
			ORDER BY ' . (!empty($block['sort']['sql']['sort']) ? $block['sort']['sql']['sort'] : 'hdt.id_last_msg ASC') . '
			LIMIT {int:start}, {int:items_per_page}',
			array(
				'user' => $context['user']['id'],
				'start' => $block['start'],
				'items_per_page' => $context['items_per_page'],
			)
		);

		while ($row = $smcFunc['db_fetch_assoc']($query))
		{
			$is_own = $user_info['id'] == $row['id_member_started'];
			censorText($row['subject']);

			$new_block = array(
				'id' => $row['id_ticket'],
				'display_id' => str_pad($row['id_ticket'], 5, '0', STR_PAD_LEFT),
				'link' => '<a href="' . $scripturl . '?action=helpdesk;sa=ticket;ticket=' . $row['id_ticket'] . ($_REQUEST['sa'] == 'recyclebin' ? ';recycle' : '') . '">' . $row['subject'] . '</a>',
				'subject' => $row['subject'],
				'status' => array(
					'level' => $row['status'],
					'label' => $txt['shd_status_' . $row['status']],
				),
				'starter' => array(
					'id' => $row['id_member_started'],
					'name' => $row['ticket_opener'],
				),
				'last_update' => $row['status'] != TICKET_STATUS_NEW ? timeformat($row['poster_time']) : $txt['never'],
				'assigned' => array(
					'id' => $row['id_member_assigned'],
				),
				'respondent' => array(
					'id' => $row['id_member_updated'],
					'name' => $row['respondent'],
				),
				'urgency' => array(
					'level' => $row['urgency'],
					'label' => $row['urgency'] > TICKET_URGENCY_HIGH ? '<span class="error">' . $txt['shd_urgency_' . $row['urgency']] . '</span>' : $txt['shd_urgency_' . $row['urgency']],
				),
				'is_unread' => ($row['id_last_msg'] > $row['log_read']),
				'new_href' => ($row['id_last_msg'] <= $row['log_read']) ? '' : ($scripturl . '?action=helpdesk;sa=ticket;ticket=' . $row['id_ticket'] . '.new' . ($_REQUEST['sa'] == 'recyclebin' ? ';recycle' : '') . '#new'),
				'private' => $row['private'],
				'actions' => array(),
				'num_replies' => $row['num_replies'],
				'all_replies' => (int) $row['num_replies'] + (int) $row['deleted_replies'],
			);

			if ($row['status'] == TICKET_STATUS_CLOSED)
			{
				$new_block['actions'] += array(
					'resolve' => shd_allowed_to('shd_resolve_ticket_any') || ($is_own && shd_allowed_to('shd_resolve_ticket_own')) ? '<a href="' . $scripturl . '?action=helpdesk;sa=resolveticket;ticket=' . $row['id_ticket'] . ';home;' . $context['session_var'] . '=' . $context['session_id'] . '" title="' . $txt['shd_ticket_unresolved'] . '"><img src="' . $settings['default_images_url'] . '/simpledesk/unresolved.png" alt="' . $txt['shd_ticket_unresolved'] . '" /></a>' : '',
				);
			}
			elseif ($row['status'] == TICKET_STATUS_DELETED) // and thus, we're in the recycle bin
			{
				$new_block['actions'] += array(
					'restore' => shd_allowed_to('shd_restore_ticket_any') || ($is_own && shd_allowed_to('shd_restore_ticket_own')) ? '<a href="' . $scripturl . '?action=helpdesk;sa=restoreticket;ticket=' . $row['id_ticket'] . ';' . $context['session_var'] . '=' . $context['session_id'] . '" title="' . $txt['shd_ticket_restore'] . '"><img src="' . $settings['default_images_url'] . '/simpledesk/restore.png" alt="' . $txt['shd_ticket_restore'] . '" /></a>' : '',
					'permadelete' => shd_allowed_to('shd_delete_recycling') ? '<a href="' . $scripturl . '?action=helpdesk;sa=permadelete;ticket=' . $row['id_ticket'] . ';' . $context['session_var'] . '=' . $context['session_id'] . '" title="' . $txt['shd_delete_permanently'] . '" onclick="return confirm(' . JavaScriptEscape($txt['shd_delete_permanently_confirm']) . ');"><img src="' . $settings['default_images_url'] . '/simpledesk/delete.png" alt="' . $txt['shd_delete_permanently'] . '" /></a>' : '',
				);
			}
			else
			{
				$langstring = '';
				if (shd_allowed_to('shd_assign_ticket_any'))
					$langstring = empty($row['id_member_assigned']) ? $txt['shd_ticket_assign'] : $txt['shd_ticket_reassign'];
				elseif (shd_allowed_to('shd_assign_ticket_own') && (empty($row['id_member_assigned']) || $row['id_member_assigned'] == $context['user']['id']))
					$langstring = $row['id_member_assigned'] == $context['user']['id'] ? $txt['shd_ticket_unassign'] : $txt['shd_ticket_assign_self'];

				if (!empty($langstring))
					$new_block['actions']['assign'] = '<a href="' . $scripturl . '?action=helpdesk;sa=assign;ticket=' . $row['id_ticket'] . ';home;' . $context['session_var'] . '=' . $context['session_id'] . '" title="' . $langstring . '"><img src="' . $settings['default_images_url'] . '/simpledesk/assign.png" alt="' . $langstring . '" /></a>';

				$new_block['actions'] += array(
					'resolve' => shd_allowed_to('shd_resolve_ticket_any') || ($is_own && shd_allowed_to('shd_resolve_ticket_own')) ? '<a href="' . $scripturl . '?action=helpdesk;sa=resolveticket;ticket=' . $row['id_ticket'] . ';home;' . $context['session_var'] . '=' . $context['session_id'] . '" title="' . $txt['shd_ticket_resolved'] . '"><img src="' . $settings['default_images_url'] . '/simpledesk/resolved.png" alt="' . $txt['shd_ticket_resolved'] . '" /></a>' : '',
					'tickettotopic' => empty($modSettings['shd_helpdesk_only']) && shd_allowed_to('shd_ticket_to_topic') && ($row['deleted_replies'] == 0 || shd_allowed_to('shd_access_recyclebin')) ? '<a href="' . $scripturl . '?action=helpdesk;sa=tickettotopic;ticket=' . $row['id_ticket'] . ';' . $context['session_var'] . '=' . $context['session_id'] . '" title="' . $txt['shd_ticket_move_to_topic'] . '"><img src="' . $settings['default_images_url'] . '/simpledesk/tickettotopic.png" alt="' . $txt['shd_ticket_move_to_topic'] . '" /></a>' : '',
					'delete' => shd_allowed_to('shd_delete_ticket_any') || ($is_own && shd_allowed_to('shd_delete_ticket_own')) ? '<a href="' . $scripturl . '?action=helpdesk;sa=deleteticket;ticket=' . $row['id_ticket'] . ';' . $context['session_var'] . '=' . $context['session_id'] . '" title="' . $txt['shd_ticket_delete'] . '" onclick="return confirm(' . JavaScriptEscape($txt['shd_delete_confirm']) . ');"><img src="' . $settings['default_images_url'] . '/simpledesk/delete.png" alt="' . $txt['shd_ticket_delete'] . '" /></a>' : '',
				);
			}

			$context['ticket_blocks'][$block_key]['tickets'][] = $new_block;

			$users[] = $row['id_member_started'];
			$users[] = $row['id_member_updated'];
			$users[] = $row['id_member_assigned'];
		}
		$smcFunc['db_free_result']($query);
	}

	$users = array_unique($users);
	if (!empty($users))
		loadMemberData($users, false, 'minimal');

	foreach ($context['ticket_blocks'] as $block_id => $block)
	{
		if (empty($block['tickets']))
			continue;

		foreach ($block['tickets'] as $tid => $ticket)
		{
			// Set up names and profile links for topic starter
			if (!empty($user_profile[$ticket['starter']['id']]))
			{
				// We found the name, so let's use their current name and profile link
				$context['ticket_blocks'][$block_id]['tickets'][$tid]['starter']['name'] = $user_profile[$ticket['starter']['id']]['real_name'];
				$context['ticket_blocks'][$block_id]['tickets'][$tid]['starter']['link'] = shd_profile_link($user_profile[$ticket['starter']['id']]['real_name'], $ticket['starter']['id']);
			}
			else
				// We didn't, so keep using the name we found previously and don't make an actual link
				$context['ticket_blocks'][$block_id]['tickets'][$tid]['starter']['link'] = $context['ticket_blocks'][$block_id]['tickets'][$tid]['starter']['name'];

			// Set up names and profile links for assigned user
			if ($ticket['assigned']['id'] == 0 || empty($user_profile[$ticket['assigned']['id']]))
			{
				$context['ticket_blocks'][$block_id]['tickets'][$tid]['assigned']['name'] = $txt['shd_unassigned'];
				$context['ticket_blocks'][$block_id]['tickets'][$tid]['assigned']['link'] = '<span class="error">' . $txt['shd_unassigned'] . '</span>';
			}
			else
			{
				$context['ticket_blocks'][$block_id]['tickets'][$tid]['assigned']['name'] = $user_profile[$ticket['assigned']['id']]['real_name'];
				$context['ticket_blocks'][$block_id]['tickets'][$tid]['assigned']['link'] = shd_profile_link($user_profile[$ticket['assigned']['id']]['real_name'], $ticket['assigned']['id']);
			}

			// And last respondent
			if ($ticket['respondent']['id'] == 0 || empty($user_profile[$ticket['respondent']['id']]))
			{
				// Didn't find the name, so reuse what we have
				$context['ticket_blocks'][$block_id]['tickets'][$tid]['respondent']['link'] = $context['ticket_blocks'][$block_id]['tickets'][$tid]['respondent']['name'];
			}
			else
			{
				$context['ticket_blocks'][$block_id]['tickets'][$tid]['respondent']['name'] = $user_profile[$ticket['respondent']['id']]['real_name'];
				$context['ticket_blocks'][$block_id]['tickets'][$tid]['respondent']['link'] = shd_profile_link($user_profile[$ticket['respondent']['id']]['real_name'], $ticket['respondent']['id']);
			}
		}
	}

	foreach ($context['ticket_blocks'] as $block_id => $block)
	{
		if (empty($block['display']) || (empty($block['count']) && !$block['required'] && empty($block['collapsed'])))
			unset($context['ticket_blocks'][$block_id]);
	}

	$base_url = '';
	foreach ($context['ticket_blocks'] as $block_id => $block)
	{
		if ($block['sort']['add_link'])
			$base_url .= $block['sort']['link_bits'][$block['sort']['item']];
	}

	if ($_REQUEST['sa'] != 'viewblock')
	{
		foreach ($context['ticket_blocks'] as $block_id => $block)
		{
			$url_fragment = $base_url;

			foreach ($block_list as $block_item)
			{
				if ($block_item == $block_id)
					$url_fragment .= ';st_' . $block_item . '=%1$d';
				elseif (!empty($context['ticket_blocks'][$block_item]['start']))
					$url_fragment .= ';st_' . $block_item . '=' . $context['ticket_blocks'][$block_item]['start'];
			}

			$context['start'] = $context['ticket_blocks'][$block_id]['start'];
			$context['ticket_blocks'][$block_id]['page_index'] = shd_no_expand_pageindex($scripturl . $primary_url . $url_fragment . '#shd_block_' . $block_id, $context['start'], $block['count'], $context['items_per_page'], true);
		}
	}
}

/**
 *	Return the list of columns that is applicable to a given block.
 *
 *	In order to centralise the list of actions to be displayed in a block, and in its counterpart that displays all the values,
 *	the lists of columns per block is kept here.
 *
 *	@param string $block The block we are calling from:
 *	- assigned: assigned to me
 *	- new: new tickets
 *	- staff: pending staff
 *	- user_staff: pending with user (staff view)
 *	- user_user: pending with user (user view)
 *	- closed: resolved tickets
 *	- recycled: deleted tickets
 *	- withdeleted: tickets with deleted replies
 *
 *	@return array An indexed array of the columns in the order they should be displayed.
 *	@see shd_main_helpdesk()
 *	@see shd_closed_tickets()
 *	@see shd_recycle_bin()
 *	@since 1.0
*/
function shd_get_block_columns($block)
{
	switch ($block)
	{
		case 'assigned':
			return array(
					'ticket_id',
					'ticket_name',
					'starting_user',
					'replies',
					'status',
					'urgency',
					'updated',
					'actions',
				);
		case 'new':
			return array(
				'ticket_id',
				'ticket_name',
				'starting_user',
				'assigned',
				'urgency',
				'updated',
				'actions',
			);
		case 'staff':
			return array(
				'ticket_id',
				'ticket_name',
				'starting_user',
				'replies',
				'assigned',
				'urgency',
				'updated',
				'actions',
			);
		case 'user_staff':
			return array(
				'ticket_id',
				'ticket_name',
				'starting_user',
				'last_reply',
				'replies',
				'urgency',
				'updated',
				'actions',
			);
		case 'user_user':
			return array(
				'ticket_id',
				'ticket_name',
				'last_reply',
				'replies',
				'urgency',
				'updated',
				'actions',
			);
		case 'closed':
			return array(
				'ticket_id',
				'ticket_name',
				'starting_user',
				'replies',
				'updated',
				'actions',
			);
		case 'recycled':
			return array(
				'ticket_id',
				'ticket_name',
				'starting_user',
				'allreplies',
				'assigned',
				'updated',
				'actions',
			);
		case 'withdeleted':
			return array(
				'ticket_id',
				'ticket_name',
				'starting_user',
				'allreplies',
				'assigned',
				'updated',
				'actions',
			);
		default:
			return array();
	}
}
?>