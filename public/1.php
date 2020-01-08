<?php

echo "<table width='600' border='1' style='float: left;'>";

for ($j = 1; $j <= 9; $j++) {
    echo "<tr>";
    for ($z = 0; $z < 9 - $j; $z++) {
        echo "<td> </td>";
    }
    for ($i = $j; $i >= 1; $i--) {
        echo "<td>{$i}*{$j}=" . ($i * $j) . "</td>";
    }
    echo "</tr>";
}
echo "</table>";
echo "<table width='600' border='1'>";
for ($j = 1; $j <= 9; $j++) {
    echo "<tr>";
    for ($i = 1; $i <= $j; $i++) {
        echo "<td>{$i}*{$j}=" . ($i * $j) . "</td>";
    }
    echo "</tr>";
}
echo "</table>";

echo "<table width='600' border='1' style='float: left;'>";
for ($j = 9; $j >= 1; $j--) {
    echo "<tr>";
    for ($z = 0; $z < 9 - $j; $z++) {
        echo "<td> </td>";
    }
    for ($i = 1; $i <= $j; $i++) {
        echo "<td>{$i}*{$j}=" . ($i * $j) . "</td>";
    }
}
echo "</table>";
echo "<table width='600'  border='1'>";

for ($j = 9; $j >= 1; $j--) {
    echo "<tr>";
    for ($i = 1; $i <= $j; $i++) {
        echo "<td>{$i}*{$j}=" . ($i * $j) . "</td>";
    }
    echo "</tr>";
}
echo "</table>";
?>