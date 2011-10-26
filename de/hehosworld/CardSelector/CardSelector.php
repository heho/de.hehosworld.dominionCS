<?php
namespace de\hehosworld\CardSelector;

/**
 * Description of CardSelector
 *
 * @author heho
 */
class CardSelector
{
	
	private $config;
	
	/**
	 * Number of Cards to be selected
	 * 
	 * @var integer
	 */
	private $cardCount;

	/**
	 * 
	 * @var \de\hehosworld\CardSelector\CardList
	 */
	private $cardlist;
	
	
	public function __construct(string $configSource)
	{
		try
		{
			$this->config = simplexml_load_file($configSource);
		}
		catch(\Exception $e)
		{
		
		}
	}
	
	public function generateCardArray()
	{
		
	}
}
