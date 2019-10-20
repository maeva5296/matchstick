<?php

class matchstick
{
    public $player = "player1";
    public $allum;

	public function __construct()
	{
        $this->allum = 11;
    }

    public function match()
    {
        echo "Your turn : " . PHP_EOL;
        $nbr = readline("Matches : ");
        
        if(!ctype_digit($nbr))
        {
            echo "Error: invalid input (positive number expected)" . PHP_EOL;
        }
        elseif($nbr == 0)
        {
            echo "Error : you have to remove at least one match" . PHP_EOL;
        }
        elseif($nbr > 3)
        {
            echo "Error : not enough matches" . PHP_EOL;
        }
        elseif($nbr <= 3 AND $nbr > 0) 
        {
            echo "Player removed " . $nbr . " match(es)" . PHP_EOL;
            return $nbr;
        }
        return $this->match();
    }

    public function play()
    {
        for ($i = 0; $i < $this->allum; $i++) 
        {
            echo '|';
        }
        echo PHP_EOL;

        if($this->allum <= 1 )
        {
            return;
        }

        if ($this->player == "AI") 
        {
            $nbr = $this->step();
            if($nbr > 3 || $nbr <= 0)
            {
                $nbr = 1;
            }
            echo  "AI's turn ..." . PHP_EOL . "AI removed " . $nbr . " match(es)" . PHP_EOL;
        }
        else
        {
            $nbr = $this->match();
        }

        $this->allum = $this->allum - $nbr; 
        
        if($this->allum <= 1)
        {
            $this->play();
            if($this->player == "AI")
            {
                echo "You lost, too bad..." . PHP_EOL;
                return 0;
            }
            else
            {
                echo "You win" . PHP_EOL;
                return 0;
            }
        }
        $this->turn();
        $this->play();
    }

    public function turn()
    {
        if ($this->player == "player1") 
        {
            $this->player = "AI";
        }
        else
        {
            $this->player = "player1";
        }
    }

    public function step()
    {
        $lastStep = null;
        for ($i=0; $i < $this->allum ; $i++) 
        { 
            $actualStep = 1 +(4 * $i);
            if($actualStep >= $this->allum)
            {
                $lastStep = 1 +(4 * ($i-1));
                return $this->allum - $lastStep;
            }
        }
    }
}

$matchstick = new matchstick;
$matchstick->play();

?>