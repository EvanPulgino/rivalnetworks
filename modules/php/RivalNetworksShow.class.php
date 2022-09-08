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
 * RivalNetworksShow.class.php
 * 
 *  Abstract Show object
 */

abstract class RivalNetworksShow extends APP_GameClass
{
    protected $game;

    public function __construct($game)
    {
        $this->game = $game;
    }

    protected $id = 0;
    protected $name = '';
    protected $genre = '';
    protected $season = 0;
    protected $correctTimeSlot = 0;
    protected $correctRatings = 0;
    protected $wrongRatings = 0;
    protected $cssClass = '';
    protected $cssClassBack = '';
    protected $location = '';
    protected $locationPosition = 0;

    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getGenre() { return $this->genre; }
    public function getSeason() { return $this->season; }
    public function getCorrectTimeSlot() { return $this->correctTimeSlot; }
    public function getCorrectRatings() { return $this->correctRatings; }
    public function getWrongRatings() { return $this->wrongRatings; }
    public function getCssClass() { return $this->cssClass; }
    public function getCssClassBack() { return $this->cssClassBack; }
    public function getLocation() { return $this->location; }
    public function getLocationPosition() { return $this->locationPosition; }

    /**
     * Get the UI data for a show card
     * @return array<mixed> ui data of a show card
     */
    public function getUiData()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'genre' => $this->genre,
            'season' => $this->season,
            'correctTimeSlot' => $this->correctTimeSlot,
            'correctRatings' => $this->correctRatings,
            'wrongRatings' => $this->wrongRatings,
            'cssClass' => $this->cssClass,
            'cssClassBack' => $this->cssClassBack,
            'location' => $this->location,
            'locationPosition' => $this->locationPosition,
        ];
    }

    /**
     * Abstract for triggering the genre bonus of the show
     * @return void
     */
    abstract function triggerGenreBonus();

    /**
     * Build the CSS class value based on the db record.
     * @param mixed $row Db row of show record
     * @return string CSS value of show card
     */
    protected function buildCssClass($row)
    {
        return 'rn-show-' . $row[TYPE] . '-' . $row[TYPE_ARG];
    }

    /**
     * Build the CSS class value for back of card based on the db record.
     * @param mixed $row Db row of show record
     * @return string CSS value for back of show card
     */
    protected function buildCssClassBack($season)
    {
        return 'rn-show-season-' . $season . '-back';
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
                return 3;
            case 2:
                return 5;
            case 3:
                return 7;
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
                return 1;
            case 2:
                return 3;
            case 3:
                return 5;
            default:
                return 0;
        }
    }
}