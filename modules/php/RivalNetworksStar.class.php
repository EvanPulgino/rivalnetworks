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
 * RivalNetworksStar.class.php
 * 
 *  Abstract Star object
 */

abstract class RivalNetworksStar extends APP_GameClass
{
    protected $game;

    public function __construct($game)
    {
        $this->game = $game;
    }

    protected $id = 0;
    protected $name = '';
    protected $genres = [];
    protected $rating = 0;
    protected $cssClass = '';
    protected $cssClassBack = '';
    protected $location = '';
    protected $locationPosition = '';

    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getGenres() { return $this->genres; }
    public function getRating() { return $this->rating; }
    public function getCssClass() { return $this->cssClass; }
    public function getCssClassBack() { return $this->cssClassBack; }
    public function getLocation() { return $this->location; }
    public function getLocationPosition() { return $this->locationPosition; }

    public function getUiData()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'genres' => $this->genres,
            'rating' => $this->rating,
            'cssClass' => $this->cssClass,
            'cssClassBack' => $this->cssClassBack,
            'location' => $this->location,
            'locationPosition' => $this->locationPosition,
        ];
    }
}
