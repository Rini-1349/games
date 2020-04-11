<?php
require_once('Manager.php');

class PlayGame extends Manager
{
    private $_choice;
    private $_score;
    private $_startDate;
    private $_endDate;

    public function enrolledInPlay($playerId)
    {
        $db = $this->dbConnect();
        $notFinishedPlays = $db->prepare(
            'SELECT * 
            FROM play_game 
            WHERE player_id=?
            AND end_date IS NULL'
        );
        $notFinishedPlays->execute(array($playerId));
        $enrolledInPlay = $notFinishedPlays->fetch();

        return $enrolledInPlay;
    }
}