<?php
require_once('Manager.php');

class PlayGame extends Manager
{
    private $_choice;
    private $_score;
    private $_startDate;
    private $_endDate;

    public function lastPlay($playerId)
    {
        $db = $this->dbConnect();
        $lastPlay = $db->prepare(
            'SELECT * 
            FROM play_game 
            WHERE player_id= ?
            LIMIT O,1'
        );
        $lastPlay->execute(array($playerId));
        return $lastPlay;
    }
}