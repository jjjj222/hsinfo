<?php
#------------------------------------------------------------------------------
#   constant
#------------------------------------------------------------------------------
$CARD_TABLE_NAME = "Card"; 
$CARD_TABLE_ATTR = array(
    "setType",
    "setSeq",
    "id",
    "name",
    "type",
    "faction",
    "rarity",
    "cost",
    "attack",
    "durability",
    "health",
    "elite",
    "race",
    "text",
    "inPlayText",
    "flavor",
    "artist",
    "collectible",
    "playerClass",
    "howToGet",
    "howToGetGold",
    "mechanics"
);
$CARD_TABLE_INPORTANT_ATTR = array(
    "setType",
    "id",
    "name",
    "type",
    "rarity",
    "playerClass",
    "cost",
    "attack",
    "durability",
    "health",
    "race",
    "text"
);

$DECK_TABLE_NAME = "Deck"; 
$DECK_TABLE_ATTR = array(
    "id",
    "name",
    "class",
    "creator",
    "num",
    "link",
    "comment"
);
$DECK_SINGLE_TABLE_ATTR = array(
    "id",
    "num",
);
?>

