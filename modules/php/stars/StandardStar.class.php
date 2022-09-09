<?php

/**
 * ------
 * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
 * DontGoInThere implementation : © Evan Pulgino <evan.pulgino@gmail.com>
 *
 * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
 * See http://en.boardgamearena.com/#!doc/Studio for more information.
 * -----
 *
 * StandardStar.class.php
 * 
 * Standard Star object
 */

class StandardStar extends RivalNetworksStar
{
    public function __construct($game, $row)
    {
        parent::__construct($game);
        $this->id = $row[ID];
        $this->name = self::determineName($row[TYPE_ARG]);
        $this->genres = self::determineGenres($row[TYPE_ARG]);
        $this->rating = self::determineRating(count($this->genres));
        $this->cssClass = 'rn-star-standard-' . $row[TYPE_ARG];
        $this->cssClassBack = 'rn-star-standard-back';
        $this->location = $row[LOCATION];
        $this->locationPosition = intval($row[LOCATION_ARG]);
    }

    private function determineGenres($typeArg)
    {
        switch($typeArg) {
            case 1:
                return [ACTION];
            case 2:
                return [DRAMA, SCIFI];
            case 3:
                return [ACTION, REALITY];
            case 4:
                return [DRAMA];
            case 5:
                return [ACTION, DRAMA];
            case 6:
                return [ACTION, DRAMA];
            case 7:
                return [DRAMA];
            case 8:
                return [DRAMA, SCIFI];
            case 9:
                return [ACTION, SPORTS];
            case 10:
                return [REALITY];
            case 11:
                return [ACTION, SCIFI];
            case 12:
                return [ACTION, SITCOM];
            case 13:
                return [SCIFI];
            case 14:
                return [DRAMA, SITCOM];
            case 15:
                return [DRAMA, REALITY];
            case 16:
                return [SCIFI];
            case 17:
                return [SITCOM];
            case 18:
                return [ACTION, SCIFI];
            case 19:
                return [DRAMA, SPORTS];
            case 20:
                return [SITCOM];
            case 21:
                return [ACTION];
            case 22:
                return [DRAMA];
            case 23:
                return [SCIFI];
            case 24:
                return [SITCOM];
            case 25:
                return [REALITY, SCIFI];
            case 26:
                return [SPORTS];
            case 27:
                return [ACTION, SITCOM];
            case 28:
                return [DRAMA, SITCOM];
            case 29:
                return [SCIFI, SITCOM];
            case 30:
                return [SCIFI, SITCOM];
            case 31:
                return [SCIFI, SPORTS];
            case 32:
                return [REALITY, SITCOM];
            case 33:
                return [SITCOM, SPORTS];
            case 34:
                return [REALITY];
            case 35:
                return [SPORTS];
            case 36:
                return [ACTION];
            default:
                return [];
        }
    }

    private function determineName($typeArg)
    {
        switch($typeArg) {
            case 1:
                return clienttranslate('Grizzled Action Hero');
            case 2:
                return clienttranslate('Shakespearean Star');
            case 3:
                return clienttranslate('Celebrity Chef');
            case 4:
                return clienttranslate('Serial Award Winner');
            case 5:
                return clienttranslate('Ubiquitous Character Actor');
            case 6:
                return clienttranslate('Soap Opera Star');
            case 7:
                return clienttranslate('Square-Jawed Actor');
            case 8:
                return clienttranslate('Creepy Vampire');
            case 9:
                return clienttranslate('Career Stuntman');
            case 10:
                return clienttranslate('Insulting Game Show Host');
            case 11:
                return clienttranslate('Femme Fatale');
            case 12:
                return clienttranslate('Police Procedural Mainstay');
            case 13:
                return clienttranslate('Science Fiction Legend');
            case 14:
                return clienttranslate('Comedian Your Parents Like');
            case 15:
                return clienttranslate('Loveable Game Show Host');
            case 16:
                return clienttranslate('Uncannily Talented Hacker');
            case 17:
                return clienttranslate('Adorable Hipster');
            case 18:
                return clienttranslate('Anime Hero');
            case 19:
                return clienttranslate('Morning Show Host');
            case 20:
                return clienttranslate('Quiry Bandleader');
            case 21:
                return clienttranslate('Always Dies in Everything');
            case 22:
                return clienttranslate('Demanding Doctor');
            case 23:
                return clienttranslate('Dashing Lead');
            case 24:
                return clienttranslate('Physical Comedy Master');
            case 25:
                return clienttranslate('Public Television Mainstay');
            case 26:
                return clienttranslate('Influential Party Thrower');
            case 27:
                return clienttranslate('New Year\'s Host');
            case 28:
                return clienttranslate('Former Comedian Gone Dramatic');
            case 29:
                return clienttranslate('Charity Infomercial Mainstay');
            case 30:
                return clienttranslate('That Kid From The Commercial');
            case 31:
                return clienttranslate('Cult Sci-Fi Hero');
            case 32:
                return clienttranslate('Children\'s Show Host');
            case 33:
                return clienttranslate('Wily Weathersperson');
            case 34:
                return clienttranslate('Reality TV Judge');
            case 35:
                return clienttranslate('Retired Athlete');
            case 36:
                return clienttranslate('Dog-Loving Detective');
            default:
                return '';
        }
    }

    private function determineRating($genreCount)
    {
        return $genreCount == 1 ? 3 : 2;
    }
}