<?php 
require_once('Game.php');

class CadavreExquis extends Game
{
    protected $_name = 'Cadavre exquis';
    protected $_nbPlayer = 3;
    private $_gameId = 1;
    private $_subject;
    private $_verb;
    private $_complement;


    public function uncompletedPlays($playerId)
    {
        $db = $this->dbConnect();
        $uncompletedPlays = $db->prepare('SELECT ce.*, pg.* 
        FROM cadavre_exquis ce
        INNER JOIN play_game pg
        ON ce.id = pg.game_id
        WHERE (ce.subject IS NULL OR ce.verb IS NULL OR ce.complement IS NULL) 
        AND NOT (pg.player_id = ?)
        AND NOT (pg.player_id = ? AND pg.game_id = ce.id)
        ');
        $uncompletedPlays->execute(array($playerId, $playerId));
        $uncompletedPlay = $uncompletedPlays->fetch();

        return $uncompletedPlay;
    }

    public function newPlay()
    {
        $db = $this->dbConnect();
        $newPlay = $db->prepare('INSERT INTO cadavre_exquis(game_id, subject) VALUES(?, ?)');
        $newPlay->execute(array($this->_gameId, 'Un sujet'));

        return $newPlay;
    }

    public function createdPlay()
    {
        $db = $this->dbConnect();
        $createdPlays = $db->query('SELECT * 
        FROM cadavre_exquis 
        WHERE verb IS NULL AND complement IS NULL ORDER BY id DESC');
        $createdPlay = $createdPlays->fetch();
        
        return $createdPlay;
    }

    public function updateResponse($gameId, $choice, $response)
    {
        $db = $this->dbConnect();
        switch ($choice)
        {
            case 'subject' :
            $updateResponse = $db->prepare('UPDATE cadavre_exquis SET subject = ? WHERE id=?');
            $updateResponse->execute(array($response, $gameId));
            break;

            case 'verb' :
            $updateResponse = $db->prepare('UPDATE cadavre_exquis SET verb = ? WHERE id=?');
            $updateResponse->execute(array($response, $gameId));
            break;

            case 'complement' :
            $updateResponse = $db->prepare('UPDATE cadavre_exquis SET complement = ? WHERE id=?');
            $updateResponse->execute(array($response, $gameId));
            break;

        }

        return $updateResponse;
    }
}