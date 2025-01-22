<?php
class King extends ChessPiece
{
  protected $weight = 60000;
  function __construct(String $color, int $x, int $y)
  {
      parent::__construct($color, $x, $y);
      $this->type = 'king';

      if($color=='white'){
        $this->icon ="<img src='../images/chesspieces/white-king.png' class='chesspiece'>";
      }elseif($color=='black'){
        $this->icon ="<img src='../images/chesspieces/black-king.png' class='chesspiece'>";
      }
  }

  function check_move_legal(mixed $chessboard, int $current_x, int $current_y, int $move_to_x, int $move_to_y):bool
    {
      $distance_x = sqrt(pow(($move_to_x-$current_x),2)); 
      $distance_y = sqrt(pow(($move_to_y-$current_y),2)); 

      if($distance_x <= 1 && $distance_y <= 1){
        # check if there is a piece on the move to square and if it is opposite color
         if(is_a($chessboard[$move_to_x][$move_to_y],'Chesspiece') &&  $chessboard[$current_x][$current_y]->get_color()!=$chessboard[$move_to_x][$move_to_y]->get_color()){
          return true;
         }elseif(!is_a($chessboard[$move_to_x][$move_to_y],'Chesspiece')){
          return true;
         }
      }

      if($this->has_moved==false){
      # castling short as white
        if($this->color=='white' && $move_to_x==7 && $move_to_y==1){
            if(!is_a($chessboard[6][1], 'Chesspiece') && !is_a($chessboard[7][1],'Chesspiece')){
              if(is_a($chessboard[8][1], 'Rook') && $chessboard[8][1]->has_moved==false){
                return true;
              }
            }
        }

        # castling long as white
        if($this->color=='white' && $move_to_x==3 && $move_to_y==1){
          if(!is_a($chessboard[2][1], 'Chesspiece') && !is_a($chessboard[3][1],'Chesspiece')&& !is_a($chessboard[4][1],'Chesspiece')){
            if(is_a($chessboard[1][1], 'Rook') && $chessboard[8][1]->has_moved==false){
              return true;
            }
          }
      }

      # castling short as black
      if($this->color=='black' && $move_to_x==7 && $move_to_y==8){
        if(!is_a($chessboard[6][8], 'Chesspiece') && !is_a($chessboard[7][8],'Chesspiece')){
          if(is_a($chessboard[8][8], 'Rook') && $chessboard[8][8]->has_moved==false){
            return true;
          }
        }
      }

      # castling long as black
      if($this->color=='black' && $move_to_x==3 && $move_to_y==8){
        if(!is_a($chessboard[2][8], 'Chesspiece') && !is_a($chessboard[3][8],'Chesspiece')&& !is_a($chessboard[4][8],'Chesspiece')){
          if(is_a($chessboard[1][8], 'Rook') && $chessboard[8][8]->has_moved==false){
            return true;
          }
        }
      }
  }

        return false;
    }

    function castle_rightside(mixed $chessboard):mixed {
      #$chessboard = $chessboard[8][1]->move($chessboard,6,1);
       # Copy the piece to the new position
       $chessboard[6][1] = $chessboard[8][1];
       # Delete old piece position
       $chessboard[8][1] = "";
       # Update position vars
       $chessboard[6][1]->x = 6;
       $chessboard[6][1]->y = 1;

       return $chessboard;
    }
}
?>