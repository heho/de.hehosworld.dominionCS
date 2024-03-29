<?php
namespace de\hehosworld\CardSelector;

/**
 * Description of cardlist
 *
 * @author heho
 */
class Cardlist
{
	/**
	 *
	 * @var array of de\hehosworld\Cardselector\Card
	 */
	private $cards;
	
	/**
	 *
	 * @param \de\hehosworld\CardSelector\Card $card 
	 * @return Cardlist 
	 */
	public function addCard(\de\hehosworld\CardSelector\Card $card)
	{
		$this->cards[str_replace("\"", "", $card->getName())] = $card;
		
		return $this;
	}
	
	/**
	 *
	 * @param string $name 
	 * @return Cardlist 
	 */
	public function deleteCardByName($name)
	{
		unset($this->cards[$name]);
		
		return $this;
	}
	
	/**
	 *
	 * @param \de\hehosworld\CardSelector\Card $card
	 * @return Cardlist 
	 */
	public function deleteCard(\de\hehosworld\CardSelector\Card $card)
	{
		$this->cards = array_diff($this->cards, array($card));
		
		return $this;
	}
	
	/**
	 *
	 * @param string $type
	 * @return Cardlist 
	 */
	public function deleteAllCardsWithType($type)
	{
		foreach($this->cards as $card)
		{
			if($card->hasType((string)$type))
			{
				unset($this->cards[(string)$card->getName()]);
			}
		}
		
		return $this;
	}
	
	/**
	 *
	 * @param string $type
	 * @return Cardlist 
	 */
	public function getAllCardsWithType($type)
	{
		$cards = array();
		
		foreach($this->cards as $card)
		{
			if($card->hasType((string)$type))
			{
				$cards[$card->getName()] = $this->cards[$card->getName()];
			}
		}
		
		return $cards;
	}
	
	/**
	 *
	 * @return type 
	 */
	public function getAllCards()
	{
		return $this->cards;
	}
	
	/**
	 *
	 * @param string $name
	 * @return \de\hehosworld\CardSelector\Card
	 */
	public function getCard($name)
	{
		if(!$this->hasCard($name))
		{
			throw new \DomainException("card " . $name . " is not in Cardlist");
		}
		
		return $this->cards[$name];
	}
	
	/**
	 *
	 * @param array $cards
	 * @return Cardlist 
	 */
	public function addCards(array $cards)
	{
		foreach($cards as $card)
		{
			if(!($card instanceof \de\hehosworld\CardSelector\Card))
			{
				throw new \InvalidArgumentException('Parameter $cards must be array of \de\hehosworld\CardSelector\Card');
			}
		}
		
		foreach($cards as $card)
		{
			$this->cards[str_replace("\"", "", $card->getName())] = $card;
		}
		
		return $this;
	}
	
	/**
	 * 
	 * @return string 
	 */
	public function __toString()
	{
		$string = "Cardlist: \n";
		foreach($this->cards as $card)
		{
			$string .= $card->__toString() . "\n\n";
		}
		
		return $string;
	}
	
	/**
	 *
	 * @param string $type
	 * @return \de\hehosworld\CardSelector\Card
	 */
	public function chooseRandomCard($type = "")
	{
		$cards = $this->cards;
		
		if($type != "")
		{
			$cards = $this->getAllCardsWithType((string)$type);
		}
		
		
		if(count($cards) == 0)
		{
			throw new \Exception("not enough cards of type ". $type);
		}
		
		return $cards[array_rand($cards)];
	}
	
	/**
	 *
	 * @param string $name
	 * @return boolean 
	 */
	public function hasCard($name)
	{
		return isset($this->cards[$name]);
	}
	
	/**
	 *
	 * @param string $type
	 * @param integer $times
	 * @return boolean
	 */
	public function hasCardsWithType($type, $times = 1)
	{
		if($times <= 0)
		{
			throw new \DomainException("Parameter times must not be below 1");
		}
		
		if(count($this->cards) == 0)
		{
			return false;
		}
		
		$counter = 0;
		
		foreach($this->cards as $card)
		{
			if($card->hasType((string)$type))
			{
				$counter++;
			}
		}
		
		return ($counter >= $times);
	}
}
