<!DOCTYPE html>
<html>
	<head>
            <title>DB</title>
	</head>
	<body>
            <?php

                class Game {
                   var $position;
                   
                   function __construct($squares) {
                       $this->position = str_split($squares);
                   }
                   
                   function winner($token) {
                       // check horizontal winners
                       for ($row=0; $row < 3; $row++) {
                           $result = true;
                           for ($col = 0; $col < 3; $col++) {
                            if ($this->position[3*$row+$col] != $token) {
                                $result = false;
                            }                            
                           }
                           if ($result == true) {
                                echo 'Horizontal win';
                                return true;
                            }
                       }
                       // check vertical winners
                       for ($col=0; $col < 3; $col++) {
                           $result = true;
                           for ($row = 0; $row < 3; $row++) {
                            if ($this->position[3*$row+$col] != $token) {
                                $result = false;
                            }                            
                            }
                            if ($result == true) {
                                echo 'Vertical win';
                                return true;
                           }
                       }                       
                       if (($this->position[0] == $token) 
                           && ($this->position[4] == $token)
                           && ($this->position[8] == $token)) {
                            $result = true;
                        }   else if (($this->position[2] == $token) 
                                    && ($this->position[4] == $token)
                                    && ($this->position[6] == $token)) {
                            $result = true;
                            }
                       return $result;
                   }
                   
                   function show_cell($which) {
                       $token = $this->position[$which];
                       if ($token <> '-') return '<td>'.$token.'</td>';
                       $this->newposition = $this->position;
                       $this->newposition[$which] = 'x';
                       $move = implode($this->newposition);
                       $link = '/comp4711lab1/index.php?board='.$move;
                       return '<td><a href="'.$link.'">-</a></td>';
                   }
                   
                   function display() {
                       echo '<table cols="3" style="font-size:large; font-weight:bold">';
                       echo '<tr>'; // open the first row
                       for ($pos=0; $pos<9;$pos++) {
                           echo $this->show_cell($pos);
                           if ($pos %3 == 2) {
                               echo '</tr><tr>'; // start a new row for the next square
                           }
                       }
                       echo '</tr>';
                       echo '</table>';
                   }
                   
                    function pick_move() {
                        if ($this->winner('x')) {
                           echo 'You win!';
                           return;
                        }
                        if ($this->winner('o')) {
                           echo 'I win!';
                           return;
                        }
                        else {
                           $move = rand(0, 8);
                           while ($this->position[$move] != '-') {
                               $move = rand(0, 8);
                           }
                           $this->position[$move] = 'o';
                        }
                        if ($this->winner('o')) {
                            echo 'I win!';
                            return;
                        } else {
                           echo 'No one has won yet.';
                           return;
                        }
                    }
                   
                   function check_winner() {
                       
                   }
               }
       
               if (isset($_GET['board'])) {
                   $board = $_GET['board'];
               }
               else {
                   $board = '---------';
               }
                $game = new Game($board);
                
                $game->pick_move();
                $game->display();

		?>
	</body>
</html>

