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
 * RivalNetworksPlayer.class.php
 * 
 * Player object
 */

class RivalNetworksPlayer extends APP_GameClass
{
    private $game;
    private $id;
    private $naturalOrder;
    private $name;
    private $avatar;
    private $color;
    private $viewers;
    private $eightPmRatings;
    private $ninePmRatings;
    private $tenPmRatings;
    private $activeTurnViewers;
    private $eliminated = false;
    private $zombie = false;

    public function __construct($game, $row)
    {
        $this->game = $game;
        $this->id = (int)$row['id'];
        $this->naturalOrder = (int)$row['naturalOrder'];
        $this->name = $row['name'];
        $this->avatar = $row['avatar'];
        $this->color = $row['color'];
        $this->viewers = (int)$row['viewers'];
        $this->eightPmRatings = (int)$row['eightPmRatings'];
        $this->ninePmRatings = (int)$row['ninePmRatings'];
        $this->tenPmRatings = (int)$row['tenPmRatings'];
        $this->activeTurnViewers = (int)$row['activeTurnViewers'];
        $this->eliminated = $row['eliminated'] == 1;
        $this->zombie = $row['zombie'] == 1;
    }

    public function getId(){ return $this->id; }
    public function getNaturalOrder(){ return $this->naturalOrder; }
    public function getName(){ return $this->name; }
    public function getAvatar(){ return $this->avatar; }
    public function getColor(){ return $this->color; }
    public function getViewers(){ return $this->viewers; }
    public function getEightPmRatings(){ return $this->eightPmRatings; }
    public function getNinePmRatings(){ return $this->ninePmRatings; }
    public function getTenPmRatings(){ return $this->tenPmRatings; }
    public function getActiveTurnViewers(){ return $this->activeTurnViewers; }
    public function isEliminated(){ return $this->eliminated; }
    public function isZombie(){ return $this->zombie; }

    /**
     * Get player data visible in UI
     * @return array<mixed> Visible data for player
     */
    public function getUiData()
    {
        return [
            'id' => $this->id,
            'naturalOrder' => $this->naturalOrder,
            'name' => $this->name,
            'color' => $this->color,
            'eightPmRatings' => $this->eightPmRatings,
            'ninePmRatings' => $this->ninePmRatings,
            'tenPmRatings' => $this->tenPmRatings,
            'activeTurnViewers' => $this->activeTurnViewers,
        ];
    }
}