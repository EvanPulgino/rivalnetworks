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
 * RivalNetworksShowManager.class.php
 * 
 * Functions to manage shows
 */

require_once('RivalNetworksShow.class.php');
require_once('shows/ActionShow.class.php');
require_once('shows/DramaShow.class.php');
require_once('shows/RealityShow.class.php');
require_once('shows/ScifiShow.class.php');
require_once('shows/SeasonFinale.class.php');
require_once('shows/SitcomShow.class.php');
require_once('shows/SportsShow.class.php');
 class RivalNetworksShowManager extends APP_GameClass
 {
    public $game;

    public function __construct($game)
    {
        $this->game = $game;

        $this->cards = $this->game->getNew("module.common.deck");
        $this->cards->init("shows");
    }

    public function setupNewGame($players)
    {
        $seasonFinaleCards = [];
        for($season = 0; $season <= 3; $season++) {
            $seasonShows = [];
            $seasonShows[] = [TYPE => ACTION, TYPE_ARG => $season, 'nbr' => 1];
            $seasonShows[] = [TYPE => DRAMA, TYPE_ARG => $season, 'nbr' => 1];
            $seasonShows[] = [TYPE => REALITY, TYPE_ARG => $season, 'nbr' => 1];
            $seasonShows[] = [TYPE => SCIFI, TYPE_ARG => $season, 'nbr' => 1];
            $seasonShows[] = [TYPE => SITCOM, TYPE_ARG => $season, 'nbr' => 1];
            $seasonShows[] = [TYPE => SPORTS, TYPE_ARG => $season, 'nbr' => 1];
            $this->cards->createCards($seasonShows, 'season_' . $season);
            $this->cards->shuffle('season_' . $season);
        };
        $seasonFinaleCards[] = [TYPE => SEASON_FINALE, TYPE_ARG => 4, 'nbr' => 3];
        $this->cards->createCards($seasonFinaleCards, 'season_finale_cards');

        // Deal pilot shows to player
        foreach($players as $player) {
            $this->cards->pickCardForLocation('season_0', EIGHT_PM, $player->getId());
            $this->cards->pickCardForLocation('season_0', NINE_PM, $player->getId());
            $this->cards->pickCardForLocation('season_0', TEN_PM, $player->getId());
        }

        // Create show deck
        for($season = 1; $season <= 3; $season++) {
            for($card = 1; $card <= 6; $card++) {
                $this->cards->insertCard($this->cards->getCardOnTop('season_'.$season)[ID], DECK, 0);
            }
            $this->cards->insertCard($this->cards->getCardOnTop('season_finale_cards')[ID], DECK, 0);
        }

        // Create show display
        $this->cards->pickCardsForLocation(3, DECK, DISPLAY);
    }

    /**
     * Map of show types to object classes
     * @var mixed
     */
    private static $showCardClasses = [
        ACTION => 'ActionShow',
        DRAMA => 'DramaShow',
        REALITY => 'RealityShow',
        SCIFI => 'ScifiShow',
        SEASON_FINALE => 'SeasonFinale',
        SITCOM => 'SitcomShow',
        SPORTS => 'SportsShow',
    ];

    /**
     * Factory to create a RivalNetworksShow object
     * @param mixed $row DB record of show
     * @throws BgaVisibleSystemException 
     * @return RivalNetworksShow Show object
     */
    public function getShow($row)
    {
        $showType = $row[TYPE];
        if(!isset(self::$showCardClasses[$showType])) {
            throw new BgaVisibleSystemException("getShow: Unknown show type");
        }
        $className = self::$showCardClasses[$showType];
        return new $className($this->game, $row);
    }

    /**
     * Get all the Show objects in a specified location
     * @param string $location Location value in db
     * @return array<RivalNetworksShow> Array of Show objects
     */
    public function getShows($location)
    {
        $shows = $this->cards->getCardsInLocation($location);
        return array_map(function($row) {
            return $this->getShow($row);
        }, $shows);
    }

    /**
     * Get the UI data of all show cards in a specified location
     * @param mixed $location Location value in db
     * @return array<mixed> Array of UI data for Shows
     */
    public function getUiData($location)
    {
        $uiData = [];
        foreach(self::getShows($location) as $show) {
            $uiData[] = $show->getUiData();
        }
        return $uiData;
    }
 }