<?php 

namespace Jw\RestDocBundle\Model;

use Jw\RestDocBundle\Model\ModelBaseXml;

use \SimpleXMLElement;
use \DOMDocument;
use \Exception;

/**
 * 
 * @author Jérôme Weber <jerome.weber@stadline.com>
 */
class Service extends ModelBaseXml
{
	protected $parameters;
	protected $infos;
	protected $samples;
	protected $errors;

	/**
	 * Returns a mapping to hydrate childrens
	 * 
	 * @return multitype:multitype:string
	 */
	private function getHydratorMapping()
	{
		return array(
			array(
					"tag" 	=> "INFOS",
					"model"	=> "Jw\RestDocBundle\Model\Info",
					"var"	=> "infos"
				),
			array(
					"tag" 	=> "PARAMETERS",
					"model"	=> "Jw\RestDocBundle\Model\Parameter",
					"var"	=> "parameters"
				),
			array(
					"tag" 	=> "SAMPLES",
					"model"	=> "Jw\RestDocBundle\Model\Sample",
					"var"	=> "samples"
				),
			array(
					"tag" 	=> "ERRORS",
					"model"	=> "Jw\RestDocBundle\Model\Error",
					"var"	=> "errors"
				)
		);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Jw\RestDocBundle\Model\ModelBaseXml::setXml()
	 */
	public function setXml(SimpleXMLElement $xml)
	{
		parent::setXml($xml);
		
		$this->hydrate();
	}

	/**
	 * Hydrate childrens
	 * 
	 * @return void
	 */
	private function hydrate()
	{
		foreach ($this->getHydratorMapping() as $map)
		{
			$tag 	= $map['tag'];
			$model 	= $map['model'];
			$var 	= $map['var'];

			$repository =& $this->$var;
			
			if (!is_array($repository))
			{
				$repository = array();
			}
						
			if ($this->getXml()->$tag)
			{
				foreach ($this->getXml()->$tag->children() as $element) {
					$obj = new $model;
					$obj->setXml($element);
					$repository[] = $obj;
				}
			}
		}
	}
	
	/**
	 * Gets the ressource of the service
	 * 
	 * @return string
	 */
	public function getRessource()
	{
		return (string) $this->getXml()->RESSOURCE;
	}

	/**
	 * Gets the title of the service
	 *
	 * @return string
	 */
	public function getTitle()
	{
		return (string) $this->getXml()->TITLE;
	}
	
	/**
	 * Gets the description of the service
	 *
	 * @return string
	 */
	public function getDescription()
	{
		return (string) $this->getXml()->DESCRIPTION;
	}
	
	/**
	 * Gets the url of the service
	 *
	 * @return string
	 */
	public function getUrl()
	{
		return (string) $this->getXml()->URL;
	}
	
	/**
	 * Gets the method of the service
	 *
	 * @return string
	 */
	public function getMethod()
	{
		return (string) $this->getXml()->METHOD;
	}

	/**
	 * Gets the security of the service
	 *
	 * @return boolean
	 */
	public function getSecurity()
	{
		return ((string) $this->getXml()->SECURITY == "true")?true:false;
	}

	/**
	 * Gets the availability of the service
	 *
	 * @return boolean
	 */
	public function getAvailable()
	{
		return ((string) $this->getXml()->AVAILABLE == "true")?true:false;
	}

	/**
	 * Gets the reponse format of the service
	 *
	 * @return string
	 */
	public function getFormat()
	{
		return (string) $this->getXml()->FORMAT;
	}
	
	/**
	 * Get parameters for the service
	 * 
	 * @return Array
	 */
	public function getParameters()
	{
		return $this->parameters;
	}

	/**
	 * Get infos for the service
	 *
	 * @return Array
	 */
	public function getInfos()
	{
		return $this->infos;
	}
	
	/**
	 * Get samples for the service
	 *
	 * @return Array
	 */
	public function getSamples()
	{
		return $this->samples;
	}

	/**
	 * Get errors for the service
	 *
	 * @return Array
	 */
	public function getErrors()
	{
		return $this->errors;
	}
	
	/**
	 * Validate a service XML with XSD
	 * 
	 * @param SimpleXMLElement $xml
	 * @throws Exception
	 */
	public static function validate(SimpleXMLElement $xml)
	{
		//Try to validate all the XML with XSD
		$dom = new DOMDocument();
		
		$dom->loadXML($xml->asXML());
		
		libxml_use_internal_errors(true);
		if (!$dom -> schemaValidate(dirname(__FILE__) . "/../Xsd/service.xsd")) {
		
			$message = "";
			foreach (libxml_get_errors() as $error) {
				$message .= sprintf("Ligne %d, %s", $error -> line, $error -> message);
			}
		
			libxml_use_internal_errors(false);
			throw new Exception(sprintf("%s", $message));
		}		
		libxml_use_internal_errors(false);
	}
	
}