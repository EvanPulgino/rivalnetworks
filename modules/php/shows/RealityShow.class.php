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
 * RealityShow.class.php
 * 
 * Reality Show object
 */

class RealityShow extends RivalNetworksShow
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
                return clienttranslate('World Wide of Forks');
            case 1:
                return clienttranslate('The Burp');
            case 2:
                return clienttranslate('The Amazing Vase');
            case 3:
                return clienttranslate('America\'s Got Talons');
            default:
                return '';
        }
    }

    /**
     * Determine the correct ratings value based on the genre and season.
     * @param int $season Season value
     * @return int Correct ratings value
     */
    protected function determineCorrectRatings($season)
    {
        switch($season) {
            case 0:
                return 0;
            case 1:
                return 4;
            case 2:
                return 6;
            case 3:
                return 8;
            default:
                return 0;
        }
    }

    /**
     * Determine the wrong ratings value based on the genre and season.
     * @param int $season Season value
     * @return int Wrong ratings value
     */
    protected function determineWrongRatings($season)
    {
        switch($season) {
            case 0:
                return 0;
            case 1:
                return 2;
            case 2:
                return 4;
            case 3:
                return 6;
            default:
                return 0;
        }
    }

    /**
     * Add a Ratings Point to all of your current shows
     * @return void
     */
    public function triggerGenreBonus()
    {
        // TODO: Add a rating point to all current shows
        return;
    }
}