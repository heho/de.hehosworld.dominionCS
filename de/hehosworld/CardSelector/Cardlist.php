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
	
	public function __construct(array $cards)
	{
		foreach($cards as $card)
		{
			if(!($card instanceof \de\hehosworld\CardSelector\Card))
			{
				throw new \InvalidArgumentException('Parameter $cards must be array of Cards');
			}
		}
		
		$this->cards = $cards;
	}
}
