<?php

/**
 * ------
 * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
 * DontGoInThere implementation : © Evan Pulgino <evan.pulgino@gmail.com>
 *
 * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
 * See http://en.boardgamearena.com/#!doc/Studio for more information.
 * -----
 *
 * MegaStar.class.php
 * 
 * Mega Star object
 */

class MegaStar extends RivalNetworksStar
{
    public function __construct($game, $row)
    {
        parent::__construct($game);
        $this->id = $row[ID];
        $this->name = self::determineName($row[TYPE_ARG]);
        $this->genres = [ACTION, DRAMA, REALITY, SCIFI, SITCOM, SPORTS, DOCUMENTARIES, GAME_SHOWS];
        $this->rating = 3;
        $this->cssClass = 'rn-star-mega-' . $row[TYPE_ARG];
        $this->cssClassBack = 'rn-star-mega-back';
        $this->location = $row[LOCATION];
        $this->locationPosition = intval($row[LOCATION_ARG]);
    }

    private function determineName($typeArg)
    {
        switch($typeArg) {
            case 1:
                return clienttranslate('Destination Diva');
            case 2:
                return clienttranslate('Queer Fashion Icon');
            case 3:
                return clienttranslate('Opinionated Cat');
            case 4:
                return clienttranslate('Irresistible Accent');
            default:
                return '';
        }
    }
}