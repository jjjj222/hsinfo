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
$CARD_TABLE_IMPORTANT_ATTR = array(
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
$CARD_TABLE_SHOW_ATTR = array(
    "setType",
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
$CARD_TABLE_SELECT_ATTR = array(
    "setType",
    "type",
    "rarity",
    "playerClass",
    "cost",
    "attack",
    "durability",
    "health",
    "race"
);
$CARD_TABLE_TYPE_ATTR = array(
    "name",
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
$DECK_TABLE_SHOW_ATTR = array(
    "name",
    "class",
    "creator",
    "num",
    "link",
    "comment"
);
$DECK_TABLE_SELECT_ATTR = array(
    "class",
    "creator",
    "num"
);
$DECK_TABLE_TYPE_ATTR = array(
    "name",
);
$DECK_SINGLE_TABLE_ATTR = array(
    "id",
    "num",
);
?>

