<?php

/**
* @package   s9e\incode
* @copyright Copyright (c) 2015 The s9e Authors
* @license   http://www.opensource.org/licenses/mit-license.php The MIT License
*/
namespace s9e\incode;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	public static function getSubscribedEvents()
	{
		return array('core.text_formatter_s9e_configure_after' => 'onConfigure');
	}

	public function onConfigure($event)
	{
		$configurator = $event['configurator'];
		$action = $configurator->tags->onDuplicate('ignore');
		$configurator->Preg->replace(
			'/`(.*?)`/',
			'<code class="inline" style="background:#fff;border:1px solid #c9d2d8;color:#2e8b57;font-size:.9em;padding:0 3px">$1</code>',
			'C'
		);
		$configurator->tags->onDuplicate($action);
	}
}