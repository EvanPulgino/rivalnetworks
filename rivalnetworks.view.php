<?php
/**
 *------
 * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
 * RivalNetworks implementation : © Evan Pulgino <evan.pulgino@gmail.com>
 *
 * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
 * See http://en.boardgamearena.com/#!doc/Studio for more information.
 * -----
 *
 * rivalnetworks.view.php
 *
 * This is your "view" file.
 *
 * The method "build_page" below is called each time the game interface is displayed to a player, ie:
 * _ when the game starts
 * _ when a player refreshes the game page (F5)
 *
 * "build_page" method allows you to dynamically modify the HTML generated for the game interface. In
 * particular, you can set here the values of variables elements defined in rivalnetworks_rivalnetworks.tpl (elements
 * like {MY_VARIABLE_ELEMENT}), and insert HTML block elements (also defined in your HTML template file)
 *
 * Note: if the HTML of your game interface is always the same, you don't have to place anything here.
 *
 */
  
require_once( APP_BASE_PATH."view/common/game.view.php" );

class view_rivalnetworks_rivalnetworks extends game_view
{
  function getGameName() {
    return "rivalnetworks";
  }

  function build_page( $viewArgs )
  {		
    // Get template name
    $template = self::getGameName() . "_" . self::getGameName();

    // Get players
    $players = $this->game->loadPlayersBasicInfos();

    // Inflate playerareas
    $this->page->begin_block($template, 'playerarea');
    foreach($players as $player) {
      $this->page->insert_block(
        'playerarea',
        array(
          'PLAYER_ID' => $player['player_id'],
          'COLOR' => $player['player_no'] == 1 ? 'blue' : 'yellow',
          'ORDER' => $player['player_no'] == 1 ? 1 : 3,
        )
      );
    }

    // Inflate timeslots
    $this->page->begin_block($template, 'ratingsspace');
    $this->page->begin_block($template, 'playerrating');
    $this->page->begin_block($template, 'playershow');
    $this->page->begin_block($template, 'timeslot');
    for($time = EIGHT_PM; $time <= TEN_PM; $time++) {
      $this->page->reset_subblocks('ratingsspace');
      $this->page->reset_subblocks('playerrating');
      $this->page->reset_subblocks('playershow');

      for ($spaceNum = 0; $spaceNum <= 19; $spaceNum++) {
        $this->page->insert_block(
          'ratingsspace',
          array(
            'SPACE_NUM' => $spaceNum,
            'TIME' => $time,
          )
        );
      }

      foreach($players as $player) {
        $this->page->insert_block(
          'playerrating',
          array(
            'PLAYER_ID' => $player['player_id'],
            'COLOR' => $player['player_no'] == 1 ? 'blue' : 'yellow',
            'TIME' => $time,
          )
          );

        $this->page->insert_block(
          'playershow',
          array(
            'PLAYER_ID' => $player['player_id'],
            'ORDER' => $player['player_no'] == 1 ? 1 : 3,
            'TIME' => $time,
          )
        );
      }
      $this->page->insert_block(
        'timeslot',
        array(
          'TIME' => $time
        )
      );
    }

      

    /*********** Do not change anything below this line  ************/
  }
}
  

