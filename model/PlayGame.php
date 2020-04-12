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

    public function enrollPlayer($playerId, $gameId, $choice)
    {
        $db = $this->dbConnect();
        $enrollPlayer = $db->prepare('INSERT INTO play_game(player_id, game_id, choice, start_date) VALUES (?, ?, ?, NOW())');
        $enrollPlayer->execute(array($playerId, $gameId, $choice));

        return $enrollPlayer;
    }

    public function endGame($playerId, $gameId)
    {
        $db = $this->dbConnect();
        $endGame = $db->prepare('UPDATE play_game SET end_date = NOW() WHERE player_id = ? AND game_id = ?');
        $endGame->execute(array($playerId, $gameId));
    }
}