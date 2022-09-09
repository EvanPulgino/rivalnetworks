/**
 * ------
 * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
 * DontGoInThere implementation : © Evan Pulgino <evan.pulgino@gmail.com>
 *
 * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
 * See http://en.boardgamearena.com/#!doc/Studio for more information.
 * -----
 *
 * RivalNetworksStarManager.js
 * 
 * Script of functions to manage star elements
 */

var isDebug = window.location.host == 'studio.boardgamearena.com';
var debug = isDebug ? console.info.bind(window.console) : function(){};
define([
    "dojo",
    "dojo/_base/declare",
    "ebg/core/gamegui",
], (dojo, declare) => {
    return declare('rn.starManager', ebg.core.gamegui, {
        constructor: function(game) {
            this.game = game;
        },
  
        /**
         * Setup star elements on page load
         * @param {Object} gamedatas gamedata
         */
        setup: function (gamedatas)
        { 
            // Create star deck
            for (let starDeckKey in gamedatas.starDeck) {
                const star = gamedatas.starDeck[starDeckKey];
                this.createStarCard(star, 'rn_star_deck', false)
            }

            // Create star display
            for (let starDisplayKey in gamedatas.starDisplay) {
                const star = gamedatas.starDisplay[starDisplayKey];
                this.createStarCard(star, 'rn_star_display');
            }

            // Create greenroom stars
            for (let greenroomStarsKey in gamedatas.greenroomStars) {
                const star = gamedatas.greenroomStars[greenroomStarsKey];
                dojo.removeClass('rn_greenroom_stars_' + star.locationPosition, 'rn-hidden');
                this.createStarCard(star, 'rn_greenroom_stars_' + star.locationPosition);
            }

            // Create megastar deck
            for (let megastarDeckKey in gamedatas.megastarDeck) {
                const star = gamedatas.megastarDeck[megastarDeckKey];
                this.createStarCard(star, 'rn_megastar_deck', false);
            }
        },
 
 
        /**
         * Create a star HTML element
         * @param {Object} show object
         * @param {string} parentDiv div to place object in
         * @param {boolean} faceup Whether the card should be face up or face down
         */
        createStarCard: function (star, parentDiv, faceup = true)
        { 
            this.game.utilities.placeBlock(STAR_TEMPLATE, parentDiv,
                {
                    star_id: star.id,
                    star_class: faceup ? star.cssClass : star.cssClassBack,
                    star_genres: star.genres,
                    star_rating: star.rating,
                }
            );
        },
    });
});