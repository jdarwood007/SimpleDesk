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
# File Info: SimpleDesk-LogAction.english.php / 1.0 Felidae   #
###############################################################
// Version: 1.0 Felidae; SimpleDesk action log

// Important! Before editing these language files please read the text at the top of index.english.php.

/**
 *	This file contains all of the base language strings used by the helpdesk action log.
 *	Unlike other language files, many of the strings here are parameterised, enabling them to be extended in the future.
 *	@see shd_log_action()
 *
 *	@package language
 *	@todo Document the text groups in this file.
 *	@since 1.0
 */

//! @name General strings
//@{
$txt['shd_action_log_disabled'] = '<strong>Note:</strong> Logging of actions is currently <strong>disabled</strong>, so no new log entries will be added.';
//@}

//! @name Ticket resolution
//@{
$txt['shd_log_resolve'] = '&quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={ticket}">{subject}</a>&quot; marked as <strong>resolved</strong>.';
$txt['shd_log_unresolve'] = '&quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={ticket}">{subject}</a>&quot; marked as <strong>not yet resolved</strong>.';
//@}

//! @name Ticket assignation
//@{
$txt['shd_log_assign'] = 'Assigned &quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={ticket}">{subject}</a>&quot; to {profile_link}.';
$txt['shd_log_unassign'] = 'Assigned &quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={ticket}">{subject}</a>&quot; to no-one.';
//@}

//! @name Ticket privacy
//@{
$txt['shd_log_markprivate'] = '&quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={ticket}">{subject}</a>&quot; marked as <strong>private</strong>.';
$txt['shd_log_marknotprivate'] = '&quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={ticket}">{subject}</a>&quot; marked as <strong>not private</strong>.';
//@}

//! @name Ticket urgency
//@{
$txt['shd_log_urgency_increase'] = '&quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={ticket}">{subject}</a>&quot; increased to <strong>{urgency}</strong>.';
$txt['shd_log_urgency_decrease'] = '&quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={ticket}">{subject}</a>&quot; decreased to <strong>{urgency}</strong>.';
//@}

//! @name Ticket/topic, topic/ticket moves
//@{
$txt['shd_log_tickettotopic'] = 'Moved &quot;<a href="{scripturl}?topic={ticket}.0">{subject}</a>&quot; to &quot;<strong><a href="{scripturl}?board={board_id}.0">{board_name}</a></strong>&quot; in the forum.';
$txt['shd_log_topictoticket'] = 'Moved the topic &quot;<strong><a href="{scripturl}?action=helpdesk;sa=ticket;ticket={ticket}">{subject}</a></strong>&quot; from the forum to the helpdesk.';
//@}

//! @name Ticket deletion, restoration, permadeletion
//@{
$txt['shd_log_delete'] = 'Deleted &quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={ticket}.0">{subject}</a>&quot; to the recycle bin.';
$txt['shd_log_restore'] = 'Restored &quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={ticket}.0">{subject}</a>&quot; from the recycle bin.';
$txt['shd_log_permadelete'] = '<strong>Permanently</strong> deleted &quot;{subject}&quot; (ticket {ticket}).';
$txt['shd_log_delete_reply'] = 'Deleted reply in &quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={ticket}.msg{msg}#msg{msg};recycle">{subject}</a>&quot; to the recycle bin.';
$txt['shd_log_restore_reply'] = 'Restored reply in &quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={ticket}.msg{msg}#msg{msg}">{subject}</a>&quot; from the recycle bin.';
$txt['shd_log_permadelete_reply'] = '<strong>Permanently</strong> deleted a reply from &quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={ticket}">{subject}</a>&quot;.';
//@}

//! @name Ticket relationships
//@{
$txt['shd_log_rel_linked'] = 'Marked &quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={ticket}.0">{subject}</a>&quot; as linked to &quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={otherticket}.0">{othersubject}</a>&quot;.';
$txt['shd_log_rel_duplicated'] = 'Marked &quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={ticket}.0">{subject}</a>&quot; as duplicate of &quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={otherticket}.0">{othersubject}</a>&quot;.';
$txt['shd_log_rel_parent'] = 'Marked &quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={ticket}.0">{subject}</a>&quot; as parent of &quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={otherticket}.0">{othersubject}</a>&quot;.';
$txt['shd_log_rel_child'] = 'Marked &quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={ticket}.0">{subject}</a>&quot; as child of &quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={otherticket}.0">{othersubject}</a>&quot;.';
$txt['shd_log_rel_re_linked'] = 'Updated &quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={ticket}.0">{subject}</a>&quot; as being linked to &quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={otherticket}.0">{othersubject}</a>&quot;.';
$txt['shd_log_rel_re_duplicated'] = 'Updated &quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={ticket}.0">{subject}</a>&quot; as being a duplicate of &quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={otherticket}.0">{othersubject}</a>&quot;.';
$txt['shd_log_rel_re_parent'] = 'Updated &quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={ticket}.0">{subject}</a>&quot; as being the parent of &quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={otherticket}.0">{othersubject}</a>&quot;.';
$txt['shd_log_rel_re_child'] = 'Updated &quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={ticket}.0">{subject}</a>&quot; as being a child of &quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={otherticket}.0">{othersubject}</a>&quot;.';
$txt['shd_log_rel_delete'] = 'Removed relationship between &quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={ticket}.0">{subject}</a>&quot; and &quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={otherticket}.0">{othersubject}</a>&quot;.';
//@}

//! @name Ticket merge/split
//@{
$txt['shd_log_split_origin'] = 'Split &quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={ticket}.0">{subject}</a>&quot; to create &quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={otherticket}.0">{othersubject}</a>&quot;.';
$txt['shd_log_split_new'] = '&quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={ticket}.0">{subject}</a>&quot; was split from &quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={otherticket}.0">{othersubject}</a>&quot;.';
//@}

//! @name Other ticket events
//@{
$txt['shd_log_newticket'] = '&quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={ticket}">{subject}</a>&quot; opened.';
$txt['shd_log_editticket'] = '&quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={ticket}">{subject}</a>&quot; was edited.';
$txt['shd_log_newreply'] = '<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={ticket}.msg{msg}#msg{msg}">New reply</a> to &quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={ticket}.0">{subject}</a>&quot;.';
$txt['shd_log_editreply'] = 'A <a href="{scripturl}?action=helpdesk;sa=ticket;ticket={ticket}.msg{msg}#msg{msg}">reply</a> was edited in &quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={ticket}.0">{subject}</a>&quot;.';
$txt['shd_log_newticketproxy'] = '&quot;<a href="{scripturl}?action=helpdesk;sa=ticket;ticket={ticket}">{subject}</a>&quot; opened on behalf of {profile_link}.';

$txt['shd_logpart_att_added'] = 'Files added';
$txt['shd_logpart_att_removed'] = 'Files removed';
//@}
?>