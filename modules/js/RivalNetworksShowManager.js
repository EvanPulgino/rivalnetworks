/**
 * ------
 * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
 * DontGoInThere implementation : © Evan Pulgino <evan.pulgino@gmail.com>
 *
 * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
 * See http://en.boardgamearena.com/#!doc/Studio for more information.
 * -----
 *
 * RivalNetworksShowManager.js
 * 
 * Script of functions to manage show elements
 */

var isDebug = window.location.host == 'studio.boardgamearena.com';
var debug = isDebug ? console.info.bind(window.console) : function(){};
define([
    "dojo",
    "dojo/_base/declare",
    "ebg/core/gamegui",
], (dojo, declare) => {
    return declare('rn.showManager', ebg.core.gamegui, {
        constructor: function(game) {
            this.game = game;
        },
 
        /**
         * Setup show elements on page load
         * @param {Object} gamedatas gamedata
         */
        setup: function (gamedatas)
        { 
            // Create show deck
            const orderedShowDeck = this.game.utilities.sortObjectArrayByProperty(gamedatas.showDeck, 'locationPosition');
            for (let showDeckKey in orderedShowDeck) {
                const show = orderedShowDeck[showDeckKey];
                this.createShowCard(show, 'rn_showdeck', false);
            }

            // Create show display
            for (let showDisplayKey in gamedatas.showDisplay) {
                const show = gamedatas.showDisplay[showDisplayKey];
                this.createShowCard(show, 'rn_showdisplay');
            }

            // Create current show cards
            for (let timeSlot = EIGHT_PM; timeSlot <= TEN_PM; timeSlot++) {
                for (let currentShowsKey in gamedatas.currentShows[timeSlot]) {
                    const show = gamedatas.currentShows[timeSlot][currentShowsKey];
                    this.createShowCard(show, 'rn_' + show.location + 'pm_show_' + show.locationPosition);
                }
            }

            // TODO: Create reruns
        },


        /**
         * Create a show HTML element
         * @param {Object} show object
         * @param {string} parentDiv div to place object in
         * @param {boolean} faceup Whether the card should be face up or face down
         */
        createShowCard: function (show, parentDiv, faceup = true)
        { 
            this.game.utilities.placeBlock(SHOW_TEMPLATE, parentDiv,
                {
                    show_id: show.id,
                    show_class: faceup ? show.cssClass : show.cssClassBack,
                    show_season: show.season,
                    show_genre: show.genre,
                    show_preftimeslot: show.correctTimeSlot,
                    show_correctrating: show.correctRatings,
                    show_wrongrating: show.wrongRatings,
                }
            );
        },
    });
 });