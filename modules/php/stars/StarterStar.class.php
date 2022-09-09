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
 * StarterStar.class.php
 * 
 * Starter Star object
 */
class StarterStar extends RivalNetworksStar
{
    public function __construct($game, $row)
    {
        parent::__construct($game);
        $this->id = $row[ID];
        $this->name = self::determineName($row[TYPE_ARG]);
        $this->genres = [ACTION, DRAMA, REALITY, SCIFI, SITCOM, SPORTS, DOCUMENTARIES, GAME_SHOWS];
        $this->rating = intval($row[TYPE_ARG]);
        $this->cssClass = 'rn-star-starter-' . $row[TYPE_ARG];
        $this->cssClassBack = 'rn-star-starter-back';
        $this->location = $row[LOCATION];
        $this->locationPosition = intval($row[LOCATION_ARG]);
    }

    /**
     * Determine the star name based on type arg
     * @param int $season Type Arg column from db
     * @return string Translated name of star
     */
    private function determineName($typeArg)
    {
        switch($typeArg) {
            case 1:
                return clienttranslate('Local Tricycling Champion');
            case 2:
                return clienttranslate('Disgruntled Former Child Star');
            default:
                return '';
        }
    }
}