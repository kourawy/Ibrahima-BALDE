<?php
header("Content-type: text/plain;charset=UTF-8");
require("lib/fonctionsComparaison.php");
$tab = array(6,0,-3,12,-15,25,-1,44,19,-8);
echo "tableau de nombres initial : ";
print_r($tab);
echo "tableau trié par la fonction sort : ";
sort($tab);
print_r($tab);
echo "tableau trié par la fonction usort avec la comparaison compareAbs : ";
usort($tab,'compareAbs');
print_r($tab);


$tab = array("abcd","00","bdef","efghij","z","aa","abcde","xyz");
echo "tableau de chaînes initial : ";
print_r($tab);
// à compléter
usort($tab, "strcmp");
echo "tableau trié par la fonction usort avec la comparaison strcmp : ";
print_r($tab);
echo "tableau trié par la fonction sort : ";
sort($tab);
print_r($tab);

$tab = array("kadi", "dial", "bernard", "messi", "124", "bts", "a");
echo "tableau de chaînes initial : ";
print_r($tab);
echo "tableau trié par la fonction usort avec la comparaison comparerChainesParLongueur() : ";
usort($tab, "comparerChainesParLongueur");
print_r($tab);

$tab = array("Kadi", "kial", "Bernard", "messi", "124", "bts", "A");
echo "tableau de chaînes initial : ";
print_r($tab);
echo "tableau trié par la fonction usort avec la comparaison comparerChainesParLongueurPlus() : ";
usort($tab, "comparerChainesParLongueurPlus");
print_r($tab);

?>
