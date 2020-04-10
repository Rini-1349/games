<?php 
require_once('Game.php');

class CadavreExquis extends Game
{
    private $_name = 'Cadavre exquis';
    private $_nb_player = 3;
    private $_subject;
    private $_verb;
    private $_complement;

    public function getCadavreExquis()
    {
        $db = $this->dbConnect();
        $cadavreExquis = $db->query('SELECT * FROM cadavre_exquis');
        return $cadavreExquis;
    }
}