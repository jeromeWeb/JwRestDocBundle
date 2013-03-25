<?php 

namespace Jw\RestDocBundle\Model;

use Symfony\Component\DependencyInjection\ContainerInterface;

class ServiceManager
{
	protected $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}
	
	public function getDocumentations()
	{
		$docs = $this->container->get("jw_rest_doc.documentation");
		
		$output = array();
		
		foreach($docs as $doc)
		{
			if (is_file($doc))
			{
				$output[] = $doc;
				continue;
			}
			
			if (is_dir($doc))
			{
				foreach (scandir($doc) as $file)
				{
					if (is_file($doc."/".$file))
					{
						$output[] = $doc."/".$file;
					}
				}
			}
		}
		
		return $output;
	}
	
	public function getResources($section = null) {

		$output = array();
		
		foreach ($this->getDocumentations() as $file) {
			
			if (is_dir($file) || !is_readable($file))
			{
				continue;
			}
	
			try {
				
				$service = $this->container->get("jw_rest_doc.service");
				$service->setXml(simplexml_load_file($file));
				$output[$service->getResource()][$service->getUrl().$service->getMethod()] = $service;
				
			} catch(Exception $e) {
				sfContext::getInstance() -> getLogger() -> log("$file is not a valid REST Documentation file : " . $e -> getMessage(), sfLogger::ALERT);
			}
		}
	
		foreach ($output as $key=>$value)
		{
			ksort($output[$key]);
		}
	
		ksort($output);
	
		return $output;
	}	
}