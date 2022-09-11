/**
 * ------
 * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
 * DontGoInThere implementation : © Evan Pulgino <evan.pulgino@gmail.com>
 *
 * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
 * See http://en.boardgamearena.com/#!doc/Studio for more information.
 * -----
 *
 * RivalNetworksRatingsManager.js
 * 
 * Script of functions to manage ratings elements
 */

var isDebug = window.location.host == 'studio.boardgamearena.com';
var debug = isDebug ? console.info.bind(window.console) : function(){};
define([
    "dojo",
    "dojo/_base/declare",
    "ebg/core/gamegui",
    "ebg/counter",
], (dojo, declare) => {
    return declare('rn.ratingsManager', ebg.core.gamegui, {
        constructor: function(game) {
            this.game = game;

            this.playerRatingsCounters = [];
        },
 
        /**
         * Setup show elements on page load
         * @param {Object} gamedatas gamedata
         */
        setup: function (gamedatas)
        { 
            for (let playerInfoKey in gamedatas.playerInfo) {
                const player = gamedatas.playerInfo[playerInfoKey];
                this.playerRatingsCounters[player.id] = [];
                for (let time = 8; time <= 10; time++) {
                    // Create ratings counters for time slots
                    this.createRatingsCounter(player, time);
                    // Create ratings discs for time slots
                    this.createRatingsDisc(player, time);
                }
                // Create viewer chips
                if (player.activeTurnViewers > 0) {
                    const parentDiv = 'rn_active_turn_viewers_' + player.id;
                    this.game.utilities.showElement(parentDiv);
                    for (let chipNum = 1; chipNum <= player.activeTurnViewers; chipNum++) {
                        this.createViewerChip(chipNum, parentDiv);
                    }
                }
            }
        },

        /**
         * Create a ratings counter html element
         * @param @param {Object} player player object
         * @param {int} time timeslot of counter
         */
        createRatingsCounter: function (player, time)
        { 
            this.playerRatingsCounters[player.id][time] = new ebg.counter();
            this.playerRatingsCounters[player.id][time].create('rn_timeslot_' + time + 'pm_ratings_counter_' + player.id);
            
            const ratingsAttribute = this.getRatingsAttribute(time);
            this.playerRatingsCounters[player.id][time].setValue(player[ratingsAttribute]);
        },

        /**
         * Create a player ratings disc HTML element
         * @param {Object} player player object
         * @param {int} time timeslot of disc
         */
        createRatingsDisc: function (player, time)
        {
            const parentDiv = this.determineRatingsSpaceDiv(player, time);
            const plusTwenty = this.isRatingsDiscPlusTwenty(player, time);
            this.game.utilities.placeBlock(RATINGS_DISC_TEMPLATE, parentDiv,
                {
                    time: time,
                    player_id: player.id,
                    color: player.color == '029eda' ? 'blue' : 'yellow',
                    visibility: plusTwenty ? ''  : 'rn-hidden',
                }
            );
        },

        createViewerChip: function (chipNum, parentDiv)
        { 
            this.game.utilities.placeBlock(VIEWER_CHIP_TEMPLATE, parentDiv,
                {
                    num: chipNum
                }
            );
        },

        /**
         * Determine the ratings space div to place a disc on
         * @param {Object} player player object
         * @param {int} time timeslot of disc
         * @returns {string} Div to place disc on
         */
        determineRatingsSpaceDiv: function (player, time)
        { 
            const timeslot = time.toString();
            const ratingsAttribute = this.getRatingsAttribute(time);
            const ratingsValue = (player[ratingsAttribute] < 20 ? player[ratingsAttribute] : player[ratingsAttribute] - 20).toString();
            return 'rn_ratings_' + timeslot + 'pm_space_' + ratingsValue;
        },

        /**
         * Gets the player ratings attribute for a timeslot
         * @param {int} time timeslot
         * @returns 
         */
        getRatingsAttribute: function (time)
        { 
            switch (time) {
                case 8:
                    return 'eightPmRatings';
                case 9:
                    return 'ninePmRatings';
                case 10:
                    return 'tenPmRatings';
                default:
                    return '';
            }
        },

        /**
         * Determine if the ratings disc is plus 20 or not
         * @param {Object} player player object
         * @param {int} time timeslot of disc
         * @returns {boolean} True if disc value is 20 or higher, otherwise false
         */
        isRatingsDiscPlusTwenty: function (player, time)
        { 
            const ratingsAttribute = this.getRatingsAttribute(time);
            return player[ratingsAttribute] >= 20 ? true : false;
        },
    });
});