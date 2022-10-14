<?php
/* 3D Captcha */
 
/*
Реализация
капчи, все четко и ничего лишнего, в стиле ооп
*/
 
$capthca = new Capthca3d();
$capthca->render();
 
 
class Capthca3d{
const CHARS = 'WEafRTYIPAGHJKXBNM3479j';
protected $hypot = 8;
protected $image = null;
 
protected $text = '';
 
public function __construct()
{
$this->time = microtime(true);
$this->generateCode();
 
}
protected function generateCode()
{
$chars = self::CHARS;
for($i =0; $i<3; $i++){
$this->text .= $chars{ mt_rand(0,22)};
}
}
 
public function getText()
{
return $this->text;
}
protected function getProection($x1,$y1,$z1)
{
$x = $x1 * $this->hypot;
$y = $z1 * $this->hypot;
$z = -$y1 * $this->hypot;
 
$xx = 0.707106781187;
$xy = 0;
$xz = -0.707106781187;
 
$yx = 0.408248290464;
$yy = 0.816496580928;
$yz = 0.408248290464;
 
$cx = $xx*$x + $xy*$y + $xz*$z;
$cy = $yx*$x + $yy*$y + $yz*$z+ 20 * $this->hypot;
return array(
'x' => $cx,
'y' => $cy
);
}
 
function zFunction($x,$y){
$z = imagecolorat($this->image,$y/2,$x/2)>0?2.6:0;
if( $z != 0 ){
$z += mt_rand(0,60)/100;
}
$z += 1.4 * sin(($x+$this->startX)*3.141592654/15)*sin(($y+$this->startY)*3.141592654/15);
return $z;
}
public function render()
{
$xx =30;
$yy =60;
 
$this->image = imageCreateTrueColor($yy * $this->hypot , $xx * $this->hypot);
 
$whiteColor = imageColorAllocate($this->image,255,255,255);
imageFilledRectangle($this->image,0,0,$yy * $this->hypot , $xx * $this->hypot,$whiteColor);
 
$textColor = imageColorAllocate($this->image,0,0,0);
imageString($this->image, 5, 3, 0, $this->text, $textColor);
 
 
$this->startX = mt_rand(0,$xx);
$this->startY = mt_rand(0,$yy);
 
$coordinates = array();
 
for($x = 0; $x < $xx + 1; $x++){
for($y = 0; $y < $yy + 1; $y++){
$coordinates[$x][$y] = $this->getProection($x,$y,$this->zFunction($x,$y));
}
}
 
for($x = 0; $x < $xx; $x++){
for($y = 0; $y < $yy; $y++){
$coord = array();
$coord[] = $coordinates[$x][$y]['x'];
$coord[] = $coordinates[$x][$y]['y'];
 
$coord[] = $coordinates[$x+1][$y]['x'];
$coord[] = $coordinates[$x+1][$y]['y'];
 
$coord[] = $coordinates[$x+1][$y+1]['x'];
$coord[] = $coordinates[$x+1][$y+1]['y'];
 
$coord[] = $coordinates[$x][$y+1]['x'];
$coord[] = $coordinates[$x][$y+1]['y'];
 
$c = (int) ($this->zFunction($x,$y)*32);
$linesColor = imageColorAllocate($this->image, $c, $c, $c);
imageFilledPolygon($this->image, $coord, 4, $whiteColor);
imagePolygon($this->image, $coord, 4, $linesColor);
}
}
 
$textColor = imageColorAllocate($this->image,0,0,0);
imageString($this->image, 5, 3, 0, $this->text, $whiteColor);
imageString($this->image, 1, 3, 0, (microtime(true)-$this->time), $textColor);
header('Content-Type: image/png');
 
imagepng($this->image);
imagedestroy($this->image);
}
}
 
?>