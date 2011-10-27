<?php
namespace de\hehosworld\CardSelector;

use de\hehosworld\CardSelector\Cardlist;
use de\hehosworld\CardSelector\Card;

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
		
		$this->cardCount = $this->config->baseConf->numberOfCards;
		
		$this->inputCardlist = new Cardlist();
		$this->outputCardlist = new Cardlist();
		
		foreach($this->config->cardlists as $cardlist)
		{
			echo $this->inputCardlist->addCards(($this->parseCardlist($cardlist->cardlist["src"])));
		}
	}
	
	/**
	 *
	 * @param string $cardlistSource
	 * @return array
	 */
	public function parseCardlist($cardlistSource)
	{
		try
		{
			$cardlist = simplexml_load_file($cardlistSource);
		}
		catch(\Exception $e)
		{
			throw new \de\hehosworld\CardSelector\Exceptions\IOException('File '
					. 'cant be opened.');
		}
		
		$cards = array();
		$overallType = $cardlist["overallType"];
		
		foreach($cardlist->card as $rawCard)
		{
			$card = new Card($rawCard["name"]);
			$card->addType($overallType);
			
			foreach ($rawCard->type as $type)
			{
				$card->addType($type);
			}
			
			$cards[] = $card;
		}
		
		return $cards;
	}
	
	public function generateCardArray()
	{
		
	}
}
