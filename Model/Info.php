<?php 

namespace Jw\RestDocBundle\Model;

use Jw\RestDocBundle\Model\ModelBaseXml;

/**
 * 
 * @author Jérôme Weber <jerome.weber@stadline.com>
 */
class Info extends ModelBaseXml
{
	/**
	 * Gets the title of the info
	 * 
	 * @return string
	 */
	public function getTitle()
	{
		return (string) $this->getXml()->TITLE;
	}

	/**
	 * Gets the content of the info
	 *
	 * @return string
	 */
	public function getContent()
	{
		return (string) $this->getXml()->CONTENT;
	}
	
}