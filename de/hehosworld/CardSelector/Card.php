<?php
namespace de\hehosworld\CardSelector;

/**
 * Description of Card
 *
 * @author heho
 */
class Card
{
	/**
	 *
	 * @var string
	 */
	private $name;
	
	/**
	 * Types of the Card
	 * 
	 * @var array of String
	 */
	private $types;
	
	/**
	 * Additional Information on Cards
	 * 
	 * @var array of array;
	 */
	private $information;
	
	/**
	 *
	 * @param string $name
	 * @param array of string $types
	 * @param array of array $information 
	 */
	function __construct($name, $types, $information = array()) 
	{
		$this->name = $name;
		$this->types = $types;
		$this->information = $information;
	}
	
	/**
	 * @param String $type
	 * @return Boolean 
	 */
	function hasType($type)
	{
		return in_array($type, $this->types);
	}
	
	/**
	 * @return array of String
	 */
	function getTypes()
	{
		return $this->types;
	}
	
	/**
	 *
	 * @return String
	 */
	function getName()
	{
		return $this->name;
	}
	
	/**
	 * @return array of arrays
	 */
	function getInformation()
	{
		return $this->information;
	}
}
