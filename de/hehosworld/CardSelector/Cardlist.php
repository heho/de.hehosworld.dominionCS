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
	public function deleteCardByName(string $name)
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
	public function deleteAllCardsWithType(string $type)
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
}
