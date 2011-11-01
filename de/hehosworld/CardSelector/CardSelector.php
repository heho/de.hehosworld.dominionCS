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
		
		foreach($this->config->cardlists->cardlist as $cardlist)
		{
			$this->inputCardlist->addCards(
					$this->parseCardlist($cardlist["src"])
			);
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
	
	/**
	 * Checks if maximum of one type has been exceeded. Deletes this type if that happens
	 */
	public function deleteExceededMaxTypes()
	{
		foreach($this->config->max->type as $type)
		{
			if($this->outputCardlist->hasCardsWithType((string)$type, $type["number"]))
			{
				$this->inputCardlist->deleteAllCardsWithType($type);
			}
		}
	}
	
	/**
	 *
	 * @return \de\hehosworld\CardSelector\CardList
	 */
	public function generateCardlist()
	{
		$tmp = array();
		
		foreach($this->config->includes->card as $card)
		{
			try
			{
				$chosenCard = $this->inputCardlist->getCard((string)$card);
				$this->inputCardlist->deleteCard($chosenCard);
				$this->outputCardlist->addCard($chosenCard);
				$this->cardCount = $this->cardCount - 1;
			}
			catch(\Exception $e)
			{
				echo $e;
				throw new \Exception("cant generate Cardlist of given config");
			}
		}
		
		foreach($this->config->additions->card as $card)
		{
			try
			{
				$chosenCard = $this->inputCardlist->getCard((string)$card);
				$this->inputCardlist->deleteCard($chosenCard);
				$tmp[] = $chosenCard;
			}
			catch(\Exception $e)
			{
				echo $e;
				throw new \Exception("cant generate Cardlist of given config");
			}
		}
		
		foreach($this->config->includes->type as $type)
		{
			
			try
			{
				for($i = 0; $i < $type["number"]; $i++)
				{
					if($this->outputCardlist->hasCardsWithType($type, $type["number"]))
					{
						break;
					}
					$chosenCard = $this->inputCardlist->chooseRandomCard($type);
					$this->inputCardlist->deleteCard($chosenCard);
					$this->outputCardlist->addCard($chosenCard);
					$this->cardCount = $this->cardCount - 1;
				}
			}
			catch(\Exception $e)
			{
				echo $e;
				throw new \Exception("cant generate Cardlist of given config");
			}
		}
		
		foreach($this->config->excludes->card as $card)
		{
			try
			{
				$chosenCard = $this->inputCardlist->getCard((string)$card);
				$this->inputCardlist->deleteCard($chosenCard);
			}
			catch(\Exception $e)
			{
				echo $e;
				throw new \Exception("card: " . $card . "does not exist");
			}
		}
		
		foreach($this->config->excludes->type as $type)
		{
			try
			{
				$this->inputCardlist->deleteAllCardsWithType((string)$type);
			}
			catch(\Exception $e)
			{
				echo $e;
				throw new \Exception("card: " . $card . "does not exist");
			}
		}
		
		for($i = 0; $i < $this->cardCount; $i++)
		{
			$this->deleteExceededMaxTypes();
			$chosenCard = $this->inputCardlist->chooseRandomCard();
			$this->inputCardlist->deleteCard($chosenCard);
			$this->outputCardlist->addCard($chosenCard);
		}
		
		$this->outputCardlist->addCards($tmp);
		
		return $this->outputCardlist;
	}
}
