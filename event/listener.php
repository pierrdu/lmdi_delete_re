<?php
/**
*
* @package phpBB Extension - LMDI Delete Re:
* @copyright (c) 2015-2016 LMDI - Pierre Duhem
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace lmdi\delre\event;

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{

	static public function getSubscribedEvents ()
	{
	return array(
		'core.posting_modify_template_vars'	=>	'delete_re',
	);
	}

	/* @var \phpbb\controller\helper */
	protected $helper;

	/* @var \phpbb\template\template */
	protected $template;


	/**
	* Constructor
	*
	* @param \phpbb\controller\helper	$helper	Controller helper object
	* @param \phpbb\template			$template	Template object
	*/
	public function __construct
		(\phpbb\controller\helper $helper,
		\phpbb\template\template $template
		)
	{
		$this->helper = $helper;
		$this->template = $template;
	}

	public function delete_re ($event)
	{
		$page_data = $event['page_data'];
		$titre = $page_data['SUBJECT'];
		$titre = preg_replace('/^Re: /', '', $titre);
		$page_data['SUBJECT'] = $titre;
		$event['page_data'] = $page_data;
	}

	/*
	Structure du rowset :
	array(1) {
		[2]=> array(29) {
			["hide_post"]=> bool(false)
			["post_id"]=> string(1) "2"
			["post_time"]=> string(10) "1426515551"
			["user_id"]=> string(1) "2"
			["username"]=> string(7) "pierred"
			["user_colour"]=> string(6) "AA0000"
			["topic_id"]=> string(1) "2"
			["forum_id"]=> string(1) "2"
			["post_subject"]=> string(17) "Essai de balisage"
			["post_edit_count"]=> string(1) "0"
			["post_edit_time"]=> string(1) "0"
			["post_edit_reason"]=> string(0) ""
			["post_edit_user"]=> string(1) "0"
			["post_edit_locked"]=> string(1) "0"
			["post_delete_time"]=> string(1) "0"
			["post_delete_reason"]=> string(0) ""
			["post_delete_user"]=> string(1) "0"
			["icon_id"]=> int(0)
			["post_attachment"]=> string(1) "0"
			["post_visibility"]=> string(1) "1"
			["post_reported"]=> string(1) "0"
			["post_username"]=> string(0) ""
			["post_text"]=> string(31) "Je cherche le terme aberration."
			["bbcode_uid"]=> string(8) "l2olxddq"
			["bbcode_bitfield"]=> string(0) ""
			["enable_smilies"]=> string(1) "1"
			["enable_sig"]=> string(1) "1"
			["friend"]=> NULL
			["foe"]=> NULL }
		}
	*/

}	// Fin de la classe main_listener

