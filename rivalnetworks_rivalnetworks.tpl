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

<div id="rn_timeslots">
    <!-- BEGIN timeslot -->
    <div id="rn_timeslot_panel_{TIME}pm" class="rn-timeslot-panel">
        <div id="rn_timeslot_{TIME}pm" class="rn-timeslot" style="order:2;"></div>
        <!-- BEGIN playershow -->
        <div id="rn_{TIME}pm_show_{PLAYER_ID}" style="order:{ORDER};"></div>
        <!-- END playershow -->
    </div>
    <!-- END timeslot -->
</div>

<script type="text/javascript">

var jstpl_show = '<div id="rn_show_${show_id}" class="rn-show ${show_class}" genre="${show_genre}" preftimeslot="${show_preftimeslot}" correctviewers="${show_prefviewers}" wrongviewers="${show_wrongviewers}"></div>'

</script>  

{OVERALL_GAME_FOOTER}
