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
 * RivalNetworksPlayerManager.class.php
 * 
 * Functions to manage players
 */

require_once('RivalNetworksPlayer.class.php');

class RivalNetworksPlayerManager extends APP_GameClass
{
    public $game;

    public function __construct($game)
    {
        $this->game = $game;
    }

    /**
     * Setup players for a new game
     * @param array<mixed> $players array of players in the game
     * @return void
     */
    public function setupNewGame($players)
    {
        $gameInfos = $this->game->getGameInfos();
        $defaultColors = $gameInfos['player_colors'];
        $order = 1;
        $sql = "INSERT INTO player (player_id, player_color, player_canal, player_name, player_avatar, player_score_aux) VALUES";
        foreach($players as $playerId => $player) {
            $color = array_shift($defaultColors);
            $values[] = "('" . $playerId . "','$color','" . $player['player_canal'] . "','" . addslashes($player['player_name']) . "','" . addslashes($player['player_avatar']) . "','$order')";
            $order++;
        }
        $sql .= implode($values, ',');
        self::DbQuery($sql);
        $this->game->reloadPlayersBasicInfos();
    }

    /**
     * Gets a player object for the active/specified playetId
     * @param int $playerId Id of player
     * @return RivalNetworksPlayer Player object
     */
    public function getPlayer($playerId = null)
    {
        $playerId = $playerId ?? $this->game->getActivePlayerId();
        $players = $this->getPlayers([$playerId]);
        return array_shift($players);
    }

    /**
     * Gets an array of player objects for all/specified playerIds
     * @param array<int> $playerIds Array of player ids
     * @return array<RivalNetworksPlayer> Array of player objects
     */
    public function getPlayers($playerIds = null)
    {
        $sql = "SELECT player_id id, player_no naturalOrder, player_name name, player_avatar avatar, player_color color, player_score viewers, eight_pm_ratings eightPmRatings, nine_pm_ratings ninePmRatings, ten_pm_ratings tenPmRatings, active_turn_viewers activeTurnViewers, player_eliminated eliminated, player_zombie zombie FROM player";
        
        if(is_array($playerIds)) {
            $sql .= " WHERE player_id IN ('" . implode("','", $playerIds) . "')";
        }
        $rows = self::getObjectListFromDb($sql);

        $players = [];
        foreach($rows as $row) {
            $player = new RivalNetworksPlayer($this->game, $row);
            $players[] = $player;
        }
        return $players;
    }

    /**
     * Get all UI data for players
     * @return array<array> Array of player UI data
     */
    public function getUiData()
    {
        $uiData = [];
        foreach($this->getPlayers() as $player) {
            $uiData[] = $player->getUiData();
        }
        return $uiData;
    }

    /**
     * Update the active turn viewers value for a player
     * @param RivalNetworksPlayer $player player object
     * @param int $delta Change in active turn viewers
     * @return void
     */
    public function updateActiveTurnViewers($player, $delta) 
    {
        $newRatingsTotal = $player->getActiveTurnViewers() + $delta > 0 ? $player->getActiveTurnViewers() + $delta : 0;
        self::DbQuery("UPDATE player SET active_turn_viewers='" . $newRatingsTotal . "' WHERE player_id='" . $player->getId() . "'");
    }

    /**
     * Update the eight pm ratings value for a player
     * @param RivalNetworksPlayer $player player object
     * @param int $delta Change in eight pm ratings
     * @return void
     */
    public function updateEightPmRatings($player, $delta) 
    {
        $newRatingsTotal = $player->getEightPmRatings() + $delta > 0 ? $player->getEightPmRatings() + $delta : 0;
        self::DbQuery("UPDATE player SET eight_pm_ratings='" . $newRatingsTotal . "' WHERE player_id='" . $player->getId() . "'");
    }

    /**
     * Update the nine pm ratings value for a player
     * @param RivalNetworksPlayer $player player object
     * @param int $delta Change in nine pm ratings
     * @return void
     */
    public function updateNinePmRatings($player, $delta) 
    {
        $newRatingsTotal = $player->getNinePmRatings() + $delta > 0 ? $player->getNinePmRatings() + $delta : 0;
        self::DbQuery("UPDATE player SET nine_pm_ratings='" . $newRatingsTotal . "' WHERE player_id='" . $player->getId() . "'");
    }

    /**
     * Update the ten pm ratings value for a player
     * @param RivalNetworksPlayer $player player object
     * @param int $delta Change in ten pm ratings
     * @return void
     */
    public function updateTenPmRatings($player, $delta) 
    {
        $newRatingsTotal = $player->getTenPmRatings() + $delta > 0 ? $player->getTenPmRatings() + $delta : 0;
        self::DbQuery("UPDATE player SET ten_pm_ratings='" . $newRatingsTotal . "' WHERE player_id='" . $player->getId() . "'");
    }
}