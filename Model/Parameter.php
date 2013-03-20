<?php 

namespace Jw\RestDocBundle\Model;

use Jw\RestDocBundle\Model\ModelBaseXml;

/**
 * 
 * @author Jérôme Weber <jerome.weber@stadline.com>
 */
class Parameter extends ModelBaseXml
{
	/**
	 * Gets the name of the parameter
	 * 
	 * @return string
	 */
	public function getName()
	{
		return (string) $this->getXml()->NAME;
	}

	/**
	 * Gets the description of the parameter
	 *
	 * @return string
	 */	
	public function getDescription()
	{
		return (string) $this->getXml()->DESCRIPTION;
	}

	/**
	 * Gets the default value of the parameter
	 *
	 * @return string
	 */
	public function getDefault()
	{
		return (string) $this->getXml()->DEFAULT;
	}

	/**
	 * Gets a sample for the parameter
	 *
	 * @return string
	 */
	public function getSample()
	{
		return (string) $this->getXml()->SAMPLE;
	}
	
	/**
	 * Gets the name of the parameter
	 *
	 * @return boolean
	 */
	public function getRequired()
	{
        return ((string) $this->getXml()->REQUIRED == "true")?true:false;
	}
}