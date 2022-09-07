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
 * states.inc.php
 *
 * RivalNetworks game states description
 *
 */

/*
   Game state machine is a tool used to facilitate game developpement by doing common stuff that can be set up
   in a very easy way from this configuration file.

   Please check the BGA Studio presentation about game state to understand this, and associated documentation.

   Summary:

   States types:
   _ activeplayer: in this type of state, we expect some action from the active player.
   _ multipleactiveplayer: in this type of state, we expect some action from multiple players (the active players)
   _ game: this is an intermediary state where we don't expect any actions from players. Your game logic must decide what is the next game state.
   _ manager: special type for initial and final state

   Arguments of game states:
   _ name: the name of the GameState, in order you can recognize it on your own code.
   _ description: the description of the current game state is always displayed in the action status bar on
                  the top of the game. Most of the time this is useless for game state with "game" type.
   _ descriptionmyturn: the description of the current game state when it's your turn.
   _ type: defines the type of game states (activeplayer / multipleactiveplayer / game / manager)
   _ action: name of the method to call when this game state become the current game state. Usually, the
             action method is prefixed by "st" (ex: "stMyGameStateName").
   _ possibleactions: array that specify possible player actions on this step. It allows you to use "checkAction"
                      method on both client side (Javacript: this.checkAction) and server side (PHP: self::checkAction).
   _ transitions: the transitions are the possible paths to go from a game state to another. You must name
                  transitions in order to use transition names in "nextState" PHP method, and use IDs to
                  specify the next game state for each transition.
   _ args: name of the method to call to retrieve arguments for this gamestate. Arguments are sent to the
           client side to be used on "onEnteringState" or to set arguments in the gamestate description.
   _ updateGameProgression: when specified, the game progression is updated (=> call to your getGameProgression
                            method).
*/

//    !! It is not a good idea to modify this file when a game is running !!

if ( !defined('STATE_END_GAME') ) {
    define("STATE_PLAYER_SELECT_SHOW", 10);
    define("STATE_PLAYER_SELECT_TIMESLOT", 11);
    define("STATE_PLAYER_SIGN_STAR_AD", 12);
    define("STATE_PLAYER_SELECT_STAR", 13);
    define("STATE_PLAYER_ATTACH_STAR", 14);
    define("STATE_PLAYER_SELECT_STAR_FOR_SHOW", 15);
    define("STATE_GAME_NEXT_PLAYER", 20);
    define("STATE_END_GAME", 99);
}

 
$machinestates = array(

    // The initial state. Please do not modify.
    1 => array(
        "name" => "gameSetup",
        "description" => "",
        "type" => "manager",
        "action" => "stGameSetup",
        "transitions" => array( "" => STATE_PLAYER_SELECT_SHOW )
    ),

    // Player turn -- Select a new show
    STATE_PLAYER_SELECT_SHOW => array(
        "name" => "playerSelectShow",
        "description" => clienttranslate('${actplayer} MUST select a new show'),
        "descriptionmyturn" => clienttranslate('${you} MUST select a new show'),
        "type" => "activeplayer",
        "possibleactions" => array( "selectShow" ),
        "transitions" => array( "selectTimeslot" => STATE_PLAYER_SELECT_TIMESLOT )
    ),
    // Player turn -- Place show in a timeslot
    STATE_PLAYER_SELECT_TIMESLOT => array(
        "name" => "playerSelectTimeslot",
        "description" => clienttranslate('${actplayer} MUST select a timeslot for ${show}'),
        "descriptionmyturn" => clienttranslate('${you} MUST select a timeslot for ${show}'),
        "type" => "activeplayer",
        "args" => "argsSelectTimeslot",
        "possibleactions" => array( "selectTimeslot" ),
        "transitions" => array( "signStar" => STATE_PLAYER_SIGN_STAR_AD )
    ),
    // Player turn -- Sign a star and an ad
    STATE_PLAYER_SIGN_STAR_AD => array(
        "name" => "playerSignStarAd",
        "description" => clienttranslate('${actplayer} MUST sign a star and an ad'),
        "descriptionmyturn" => clienttranslate('${you} MUST sign a star and an ad'),
        "type" => "activeplayer",
        "possibleactions" => array( "signStarAd" ),
        "transitions" => array( "selectStar" => STATE_PLAYER_SELECT_STAR )
    ),
    // Player turn -- Select Star to Attach to a Show
    STATE_PLAYER_SELECT_STAR => array(
        "name" => "playerSelectStar",
        "description" => clienttranslate('${actplayer} MAY select a star to attach to a show'),
        "descriptionmyturn" => clienttranslate('${you} MAY select a star to attach to a show'),
        "type" => "activeplayer",
        "args" => "argsSelectStar",
        "possibleactions" => array( "selectStar", "endTurn" ),
        "transitions" => array( "attachStar" => STATE_PLAYER_ATTACH_STAR, "endTurn" => STATE_GAME_NEXT_PLAYER )
    ),
    // Player turn -- Attach selected star to a show
    STATE_PLAYER_ATTACH_STAR => array(
        "name" => "playerAttachStar",
        "description" => clienttranslate('${actplayer} MUST attach ${star} to a show'),
        "descriptionmyturn" => clienttranslate('${you} MUST attach ${star} to a show'),
        "type" => "activeplayer",
        "args" => "argsAttachStar",
        "possibleactions" => array( "attachStar" ),
        "transitions" => array( "selectStar" => STATE_PLAYER_SELECT_STAR_FOR_SHOW )
    ),
    // Player turn -- Attach star to previously selected show
    STATE_PLAYER_SELECT_STAR_FOR_SHOW => array(
        "name" => "playerSelectStarForShow",
        "description" => clienttranslate('${actplayer} MAY select a star to attach to ${show}'),
        "descriptionmyturn" => clienttranslate('${you} MAY select a star to attach to ${show}'),
        "type" => "activeplayer",
        "args" => "argsSelectStarForShow",
        "possibleactions" => array( "selectStarForShow", "endTurn"),
        "transitions" => array( "selectStar" => STATE_PLAYER_SELECT_STAR_FOR_SHOW, "endTurn" => STATE_GAME_NEXT_PLAYER)
    ),

    // End current turn then go to next player or Awards season
    STATE_GAME_NEXT_PLAYER => array(
        "name" => "gameNextPlayer",
        "description" => "",
        "type" => "game",
        "action" => "stNextPlayer",
        "transitions" => array("nextTurn" => STATE_PLAYER_SELECT_SHOW)
    ),
   
    // Final state.
    // Please do not modify (and do not overload action/args methods).
    STATE_END_GAME => array(
        "name" => "gameEnd",
        "description" => clienttranslate("End of game"),
        "type" => "manager",
        "action" => "stGameEnd",
        "args" => "argGameEnd"
    )

);



