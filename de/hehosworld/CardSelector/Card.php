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
	 * @var array of string;
	 */
	private $information;
	
	/**
	 *
	 * @param string $name
	 * @param array of string $types
	 * @param array of array $information 
	 */
	public function __construct($name, array $types = array(), array $information = array()) 
	{
		foreach($types as $type)
		{
			if(gettype($type) !== "string")
			{
				throw new \InvalidArgumentException('Parameter $types must be array of string');
			}
		}
		
		foreach($information as $information)
		{
			if(gettype($information) !== "string")
			{
				throw new \InvalidArgumentException('Parameter $information must be array of string');
			}
		}
		
		$this->name = (string)$name;
		$this->types = $types;
		$this->information = $information;
	}

	/**
	 *
	 * @param string $type 
	 */
	public function addType($type)
	{
		$this->types[] = (string)$type;
	}
	
	/**
	 * @param string $type
	 * @return Boolean 
	 */
	public function hasType($checktype)
	{
		foreach($this->types as $type)
		{
			if(strtolower((string)$type) === strtolower((string)$checktype))
			{
				return true;
			}
		}
		
		return false;
	}
	
	/**
	 * @return array of string
	 */
	public function getTypes()
	{
		return $this->types;
	}
	
	/**
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * @return array of arrays
	 */
	public function getInformation()
	{
		return $this->information;
	}
	
	/**
	 *
	 * @return string 
	 */
	public function __toString()
	{
		$string = "Card:\n";
		$string .= "Name: " . $this->name . "\n Types: ";
		
		foreach($this->types as $type)
		{
			$string .= $type . ", ";
		}
		
		return $string;
	}
}
