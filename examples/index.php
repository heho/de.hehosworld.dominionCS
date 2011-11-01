<?php
include '../de/hehosworld/CardSelector/CardSelector.php';
include '../de/hehosworld/CardSelector/Cardlist.php';
include '../de/hehosworld/CardSelector/Card.php';
include '../de/hehosworld/CardSelector/Exceptions/IOException.php';

use de\hehosworld\CardSelector\CardSelector;
echo "<pre>";
$selector = new CardSelector('configs/fabi.xml');
echo $selector->generateCardlist();