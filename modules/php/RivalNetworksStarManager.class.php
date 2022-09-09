<?php

/**
 * ------
 * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
 * RivalNetworks implementation : © Evan Pulgino <evan.pulgino@gmail.com>
 *
 * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
 * See http://en.boardgamearena.com/#!doc/Studio for more information.
 * -----
 *
 * RivalNetworksStarManager.class.php
 * 
 * Functions to manage stars
 */

require_once('RivalNetworksStar.class.php');
require_once('stars/MegaStar.class.php');
require_once('stars/StandardStar.class.php');
require_once('stars/StarterStar.class.php');
class RivalNetworksStarManager extends APP_GameClass
{
    public $game;

    public function __construct($game)
    {
        $this->game = $game;

        $this->cards = $this->game->getNew("module.common.deck");
        $this->cards->init("stars");
    }

    public function setupNewGame($players)
    {
        // Create mega stars
        $megaStars = [];
        for ($typeArg = 1; $typeArg <= 4; $typeArg++) {
            $megaStars[] = [TYPE => MEGA, TYPE_ARG => $typeArg, 'nbr' => 1];
        }
        $this->cards->createCards($megaStars, MEGASTARS);
        $this->cards->shuffle(MEGASTARS);

        // Create standard stars and star deck
        $standardStars = [];
        for($typeArg = 1; $typeArg <= 36; $typeArg++) {
            $standardStars[] = [TYPE => STANDARD, TYPE_ARG => $typeArg, 'nbr' => 1];
        }
        $this->cards->createCards($standardStars, DECK);
        $this->cards->shuffle(DECK);

        // Create star display
        $this->cards->pickCardsForLocation(3, DECK, DISPLAY);

        // Create starter stars
        $starterStars = [];
        for($typeArg = 1; $typeArg <= 2; $typeArg++) {
            $starterStars[] = [TYPE => STARTER, TYPE_ARG => $typeArg, 'nbr' => 1];
        }
        $this->cards->createCards($starterStars, 'starter_stars');

        // Deal starter stars to players
        foreach($players as $player) {
            $starterCards = $this->cards->getCardsOfType(STARTER, $player->getNaturalOrder());
            $star = array_shift($starterCards);
            $this->cards->moveCard($star[ID], GREENROOM, $player->getId());
        }
    }

    /**
     * Map of star types to object classes
     * @var mixed
     */
    private static $starCardClasses = [
        MEGA => 'MegaStar',
        STANDARD => 'StandardStar',
        STARTER => 'StarterStar',
    ];

    /**
     * Factory to create a RivalNetworksStar object
     * @param mixed $row DB record of star
     * @throws BgaVisibleSystemException 
     * @return RivalNetworksStar Star object
     */
    public function getStar($row)
    {
        $starType = $row[TYPE];
        if(!isset(self::$starCardClasses[$starType])) {
            throw new BgaVisibleSystemException("getStar: Unknown star type");
        }
        $className = self::$starCardClasses[$starType];
        return new $className($this->game, $row);
    }

    /**
     * Get all the Star objects in a specified location
     * @param string $location Location value in db
     * @return array<RivalNetworksStar> Array of Star objects
     */
    public function getStars($location)
    {
        $stars = $this->cards->getCardsInLocation($location);
        return array_map(function($row) {
            return $this->getStar($row);
        }, $stars);
    }

     /**
     * Get the UI data of all star cards in a specified location
     * @param mixed $location Location value in db
     * @return array<mixed> Array of UI data for Stars
     */
    public function getUiData($location)
    {
        $uiData = [];
        foreach(self::getStars($location) as $star) {
            $uiData[] = $star->getUiData();
        }
        return $uiData;
    }
}