<?php
include '../de/hehosworld/CardSelector/CardSelector.php';
include '../de/hehosworld/CardSelector/Cardlist.php';
include '../de/hehosworld/CardSelector/Card.php';
include '../de/hehosworld/CardSelector/Exceptions/IOException.php';

use de\hehosworld\CardSelector\CardSelector;

$selector = new CardSelector('configs/test1.xml');
echo $selector->generateCardlist();