{OVERALL_GAME_HEADER}

<!-- 
--------
-- BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
-- RivalNetworks implementation : © Evan Pulgino <evan.pulgino@gmail.com>
-- 
-- This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
-- See http://en.boardgamearena.com/#!doc/Studio for more information.
-------
-->

<div id="rn_layout">
    <!-- BEGIN playerarea -->
    <div id="rn_playerarea_{PLAYER_ID}" class="rn-playerarea rn-playerarea-{COLOR}" style="order:{ORDER};">
        <div id="rn_player_area_text_div_{PLAYER_ID}" class="rn-player-area-text-div">
            <span id="rn_player_area_text_{PLAYER_ID}" class="rn-player-area-text">{GREEN_ROOM} + {RERUNS}</span>
        </div>
        <div id="rn_house_{PLAYER_ID}" class="rn-house rn-house-{COLOR}"></div>
        <div id="rn_active_turn_viewers_{PLAYER_ID}" class="rn-active-turn-viewers rn-hidden"></div>
        <div id="rn_greenroom_stars_{PLAYER_ID}" class="rn-greenroom rn-hidden"></div>
        <div id="rn_greenroom_ads_{PLAYER_ID}" class="rn-greenroom rn-hidden"></div>
        <div id="rn_reruns_{PLAYER_ID}" class="rn-reruns rn-hidden"></div>
    </div>
    <!-- END playerarea -->
    <div id="rn_timeslots">
        <!-- BEGIN timeslot -->
        <div id="rn_timeslot_panel_{TIME}pm" class="rn-timeslot-panel">
            <div id="rn_timeslot_{TIME}pm" class="rn-timeslot" style="order:2;">
                <!-- BEGIN ratingsspace -->
                <div id="rn_ratings_{TIME}pm_space_{SPACE_NUM}" class="rn-ratings-space rn-ratings-space-{SPACE_NUM}"></div>
                <!-- END ratingsspace -->
                <!-- BEGIN playerrating -->
                <div id="rn_timeslot_{TIME}pm_ratings_{PLAYER_ID}" class="rn-timeslot-rating rn-timeslot-rating-{COLOR}">
                    <span id="rn_timeslot_{TIME}pm_ratings_counter_{PLAYER_ID}" class="rn-show-rating rn-show-rating-{COLOR}">0</span>
                </div>
                <!-- END playerrating -->
            </div>
            <!-- BEGIN playershow -->
            <div id="rn_{TIME}pm_show_{PLAYER_ID}" class="rn-show-panel" style="order:{ORDER};">
                <div id="rn_{TIME}pm_stars_{PLAYER_ID}" class="rn-stars-panel"></div>
            </div>
            <!-- END playershow -->
        </div>
        <!-- END timeslot -->
    </div>
    <div id="rn_card_display">
        <div id="rn_show_network_display">
            <div id="rn_show_row">
                <div id="rn_show_display">
                    <div id="rn_show_text_div">
                        <span id="rn_show_text">{SHOWS}</span>
                    </div>
                    <div id="rn_show_deck"></div>
                </div>
                <div id="rn_show_discard_display">
                    <div id="rn_show_discard"></div>
                </div>
            </div>
            <div id="rn_network_row">
                <div id="rn_network_display">
                    <div id="rn_network_text_div">
                        <span id="rn_network_text">{NETWORK}</span>
                    </div>
                    <div id="rn_network_deck"></div>
                </div>
                <div id="rn_network_discard_display">
                    <div id="rn_network_discard"></div>
                </div>
            </div>
        </div>
        
        <div id="rn_star_ad_display">
            <div id="rn_star_row">
                <div id="rn_star_display">
                    <div id="rn_star_text_div">
                        <span id="rn_star_text">{STARS}</span>
                    </div>
                    <div id="rn_star_deck"></div>
                </div>
                <div id="rn_star_discard_display">
                    <div id="rn_star_discard"></div>
                </div>
                <div id="rn_megastar_display">
                    <div id="rn_megastar_deck"></div>
                </div>
            </div>
            <div id="rn_ad_row">
                <div id="rn_ad_display">
                    <div id="rn_ad_text_div">
                        <span id="rn_ad_text">{ADS}</span>
                    </div>
                    <div id="rn_ad_deck"></div>
                </div>
                <div id="rn_ad_discard_display">
                    <div id="rn_ad_discard"></div>
                </div>
            </div>
        </div>
        
    </div>
</div>

<script type="text/javascript">

var jstpl_ratings_disc = '<div id="rn_ratings_disc_${time}pm_${player_id}" class="rn-ratings-disc rn-ratings-disc-${color}"><span id="rn_ratings_disc_${time}pm_${player_id}" class="rn-ratings-disc-20 ${visibility}">+20</span></div>';
var jstpl_show = '<div id="rn_show_${show_id}" class="rn-show ${show_class}" season="${show_season}" genre="${show_genre}" preftimeslot="${show_preftimeslot}" correctrating="${show_correctrating}" wrongrating="${show_wrongrating}"></div>';
var jstpl_star = '<div id="rn_star_${star_id}" class="rn-star ${star_class}" genres="${star_genres}" rating="${star_rating}"></div>';
var jstpl_viewer_chip = '<div id="rn_viewer_chip_${num} class="rn-viewer-chip"></div>'

</script>  

{OVERALL_GAME_FOOTER}
