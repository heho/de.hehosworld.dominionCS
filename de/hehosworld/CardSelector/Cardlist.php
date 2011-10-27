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
		$this->cards[$card->getName()] = $card;
		
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
			if($card->hasType($type))
			{
				unset($this->cards[$card->getName()]);
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
			if($card->hasType($type))
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

			$this->cards[$card->getName()] = $card;
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
	
	public function chooseRandomCard($type = "")
	{
		
	}
}
