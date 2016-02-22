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

}	// Fin de la classe main_listener
