//area calculate:
<?php

$length = 20;

$width  = 10;
 
$area = $length * $width;

$perimeter = 2 * ($length + $width);
 
echo "Length of Rectangle: $length\n";

echo "Width of Rectangle: $width\n";

echo "Area of Rectangle: $area\n";

echo "Perimeter of Rectangle: $perimeter\n";

?>

//calculate vat
<?php
$amount = 5000;
 
 
$vatRate = 0.15; 
 
 
$vat = $amount * $vatRate;
 
 
$total = $amount + $vat;
 
 
echo "Original Amount: $amount\n";
echo "VAT (15%): $vat\n";
echo "Total Amount (with VAT): $total\n";
?>

//odd & even
<?php
 
$number = 13;
if ($number % 2 == 0) {
    echo "The number $number is Even\n";
} else {
    echo "The number $number is Odd\n";
}
?> 
//largest number
<?php
$a = 10;
$b = 20;
$c = 30;
 
if ($a >= $b && $a >= $c) {
    echo "The largest number is: $a\n";
} elseif ($b >= $a && $b >= $c) {
    echo "The largest number is: $b\n";
} else {
    echo "The largest number is: $c\n";
}
?>
//odd number between 10 to 100
<?php
for ($i = 10; $i <= 100; $i++) {
    if ($i % 2 != 0) {
        echo $i . "\n";
    }
}
?>
//search elements in array
<?php
$numbers = array(1, 25, 50, 85, 150);
 
$search = 85;
 
$found = false;
 
for ($i = 0; $i < count($numbers); $i++) {
    if ($numbers[$i] == $search) {
        $found = true;
        break; 
    }
}
 
if ($found) {
    echo "Element $search is found in the array.\n";
} else {
    echo "Element $search is NOT found in the array.\n";
}
?>
//print shapes
<?php
echo "Pattern 1: Triangle of *\n";
$rows = 3;
for ($i = 1; $i <= $rows; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "* ";
    }
    echo "\n";
}
 
echo "\n";
 

for ($i = 1; $i <= 3; $i++) {
    echo $i . " ";
}
echo "\n";
 

for ($i = 1; $i <= 2; $i++) {
    echo $i . " ";
}
echo "\n";
 

echo "1\n";
 
echo "\n";
 

echo "Pattern 4: Alphabet Triangle\n";
$rows = 3;
$char = 65; 
for ($i = 1; $i <= $rows; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo chr($char) . " ";
        $char++;
    }
    echo "\n";
}
?>