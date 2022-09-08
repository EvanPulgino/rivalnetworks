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
 * SeasonFinale.class.php
 * 
 * Season Finale card object
 */

class SeasonFinale extends RivalNetworksShow
{
    public function __construct($game, $row)
    {
        parent::__construct($game);
        $this->id = $row[ID];
        $this->name = clienttranslate('Season Finale');
        $this->genre = $row[TYPE];
        $this->season = $row[TYPE_ARG];
        $this->correctTimeSlot = 0;
        $this->correctRatings = 0;
        $this->wrongRatings = 0;
        $this->cssClass = self::buildCssClass($row);
        $this->cssClassBack = self::buildCssClassBack($row[TYPE_ARG]);
        $this->location = $row[LOCATION];
        $this->locationPosition = intval($row[LOCATION_ARG]);
    }

    /**
     * No Genre Bonus
     * @return void
     */
    public function triggerGenreBonus()
    {
        return;
    }
}