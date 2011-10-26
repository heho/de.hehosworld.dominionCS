<?php
namespace de\hehosworld\CardSelector;

/**
 * Description of CardSelector
 *
 * @author heho
 */
class CardSelector
{
	/**
	 *
	 * @var \SimpleXMLElement
	 */
	private $config;
	
	/**
	 * Number of Cards to be selected
	 * 
	 * @var integer
	 */
	private $cardCount;

	/**
	 * 
	 * @var \de\hehosworld\CardSelector\Cardlist
	 */
	private $inputCardlist;
	
	/**
	 *
	 * @var \de\hehosworld\CardSelector\Cardlist
	 */
	private $outputCardlist;
	
	/**
	 *
	 * @param string $configSource 
	 */
	public function __construct($configSource)
	{
		try
		{
			$this->config = simplexml_load_file($configSource);
		}
		catch(\Exception $e)
		{
			throw new \de\hehosworld\CardSelector\Exceptions\IOException('File '
					. 'cant be opened.');
		}
		
		echo $this->cardCount = $this->config->baseConf->numberOfCards;
	}
	
	public function generateCardArray()
	{
		
	}
}
