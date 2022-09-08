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
 * ScifiShow.class.php
 * 
 * Sci-Fi Show object
 */

class ScifiShow extends RivalNetworksShow
{
    public function __construct($game, $row)
    {
        parent::__construct($game);
        $this->id = $row[ID];
        $this->name = self::determineName($row[TYPE_ARG]);
        $this->genre = $row[TYPE];
        $this->season = $row[TYPE_ARG];
        $this->correctTimeSlot = self::determineCorrectTimeslot($row[TYPE_ARG]);
        $this->correctRatings = self::determineCorrectRatings($row[TYPE_ARG]);
        $this->wrongRatings = self::determineWrongRatings($row[TYPE_ARG]);
        $this->cssClass = self::buildCssClass($row);
        $this->cssClassBack = self::buildCssClassBack($row[TYPE_ARG]);
        $this->location = $row[LOCATION];
        $this->locationPosition = intval($row[LOCATION_ARG]);
    }

    /**
     * Determine the correct timeslot value based on the genre and season.
     * @param int $season Season value
     * @return int Correct time slot
     */
    private function determineCorrectTimeslot($season)
    {
        switch($season) {
            case 1:
                return TEN_PM;
            case 2:
                return EIGHT_PM;
            case 3:
                return NINE_PM;
            default:
                return 0;
        }   
    }

    /**
     * Determine the show name based on the genre and season.
     * @param int $season Season value
     * @return string Translated name of show
     */
    private function determineName($season)
    {
        switch($season) {
            case 0:
                return clienttranslate('Unlocking Your Cat\'s Psychic Potential');
            case 1:
                return clienttranslate('Jessica Bones');
            case 2:
                return clienttranslate('The Wilbur');
            case 3:
                return clienttranslate('The Mandoliner');
            default:
                return '';
        }
    }

    /**
     * Draw the top 2 Ads from the Ad deck.
     * Place them face-up in your Green Room
     * @return void
     */
    public function triggerGenreBonus()
    {
        // TODO: Draw 2 Ads cards
        return;
    }
}