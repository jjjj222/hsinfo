<!DOCTYPE HTML> 
<html>
<head>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body> 


<?php
?>

<?php
$a = $b = $m = 0;
$x1 = $x2 = $y1 = $y2 = 0;
$aErr = $bErr = $mErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["m"])) {
        $mErr = "m is required";
    } else {
        $m = (int)$_POST["m"];
    }

    if (!isset($_POST["a"])) {
        $aErr = "a is required";
    } else {
        $a = (int)$_POST["a"];
        #var_dump($a);
    }

    if (!isset($_POST["b"])) {
        $bErr = "b is required";
    } else {
        $b = (int)$_POST["b"];
    }

    $x1 = (int)$_POST["x1"];
    $x2 = (int)$_POST["x2"];
    $y1 = (int)$_POST["y1"];
    $y2 = (int)$_POST["y2"];
}

if ($a > $m) {
    $aErr = "a must less than m";
}

if ($b > $m) {
    $bErr = "b must less than m";
}

#function test_input($data) {
#   $data = trim($data);
#   $data = stripslashes($data);
#   $data = htmlspecialchars($data);
#   return $data;
#}
?>

<h2>ECC utilities</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    a: <input type="number" name="a" min="0" value="<?php echo $a;?>">
    <span class="error">* <?php echo $aErr;?></span>
    <br>
    b: <input type="number" name="b" min="0" value="<?php echo $b;?>">
    <span class="error">* <?php echo $bErr;?></span>
    <br>
    m: <input type="number" name="m" min="2" value="<?php echo $m;?>">
    <span class="error">* <?php echo $mErr;?></span>
    <br>
    <br>
    x1: <input type="number" name="x1" min="0" value="<?php echo $x1;?>">
    y1: <input type="number" name="y1" min="0" value="<?php echo $y1;?>">
    <br>
    x2: <input type="number" name="x2" min="0" value="<?php echo $x2;?>">
    y2: <input type="number" name="y2" min="0" value="<?php echo $y2;?>">
    <br>
    <input type="submit" name="submit" value="Go"> 
</form>

<?php
echo "<h2>Input:</h2>";
echo "ECC: y<sup>2</sup> = x<sup>3</sup>";
if ($a != 0) {
    echo " + ${a}x";
}
if ($b != 0) {
    echo " + $b";
}

echo " mod $m<br>";
?>

<?php
echo "<h2>All possible points:</h2>";
$all_points = array();
for ($i = 0; $i < $m; ++$i) {
    // may overflow here...
    $right = ($i**3 + $a*$i + $b) % $m;
    for ($j = 0; $j < $m; ++$j) {
        $left = ($j**2) % $m;
        if ($left === $right) {
            echo "($i, $j) ";
            array_push($all_points, array($i, $j));
        }
    }
}
echo "<br>"
?>

<?php
echo "<h2>Check points:</h2>";
$p1 = array($x1, $y1);
$p2 = array($x2, $y2);
$is_p1_ok = in_array($p1, $all_points);
$is_p2_ok = in_array($p2, $all_points);
if (!$is_p1_ok) {
    echo "(x1, y1) is not on ECC<br>";
}
if (!$is_p2_ok) {
    echo "(x2, y2) is not on ECC<br>";
}

if ($is_p1_ok && $is_p2_ok) {
    if ($x1 === $x2 && ($y1 + $y2 === $m)) {
        echo "($x1, $y1) + ($x2, $y2) = O<br>";
    } else {
        $s = 0;
        if ($p1 === $p2) {
            $s = ( (3 * ($x1 ** 2) + $a) * mod_inv(2*$y1, $m) ) % $m;
        } else {
            $s = ( ($y2 - $y1) * mod_inv($x2 - $x1, $m) ) % $m;
        }

        #echo "DEBUG: s = $s<br>";

        $x3 = ( $s ** 2 - $x1 - $x2 ) % $m;
        $y3 = ( $s * ($x1 - $x3) - $y1 ) % $m;
        if ($x3 < 0) { $x3 += $m; }
        if ($y3 < 0) { $y3 += $m; }
        echo "($x1, $y1) + ($x2, $y2) = ($x3, $y3)<br>";
    }
}

function gcd($a, $b) {
    #echo "DEBUG: gcd($a, $b)<br>";
    # Return the GCD of a and b using Euclid's Algorithm
    while ($a != 0) {
        $n_a = $b % $a;
        $n_b = $a;
        $a = $n_a;
        $b = $n_b;
    }
    return $b;
}

function mod_inv_2($a, $m) {
    #echo "DEBUG: mod_inv($a, $m)<br>";
    # Returns the modular inverse of a % m, which is
    # the number x such that a*x % m = 1

    if (gcd($a, $m) != 1) {
        return 0;
    }

    # Calculate using the Extended Euclidean Algorithm:
    $u1 = 1;
    $u2 = 0;
    $u3 = $a;
    $v1 = 0;
    $v2 = 1;
    $v3 = $m;
    while ($v3 != 0) {
        $q = $u3 / $v3;
        $v1n = $u1 - $q * $v1;
        $v2n = $u2 - $q * $v2;
        $v3n = $u3 - $q * $v3;
        $u1 = $v1;
        $u2 = $v2;
        $u3 = $v3;
        $v1 = $v1n;
        $v2 = $v2n;
        $v3 = $v3n;
    }

    $res = $u1 % $m;
    #echo "DEBUG: mod_inv($a, $m) = $res<br>";
    return $res;
}


function mod_inv($a, $m) {
    #echo "DEBUG: mod_inv($a, $m)<br>";
    if ($a < 0) {
        $a += $m;
    }

    $r0 = $a;
    $r1 = $m;
    $s0 = 1;
    $s1 = 0;
    $t0 = 0;
    $t1 = 1;

    while (true) {
        $rn = $r0 % $r1;
        $qn = (int)($r0 / $r1);
        $sn = $s0 - $qn * $s1;
        $tn = $t0 - $qn * $t1;

        if ($rn == 0) {
            break;
        }
        $r0 = $r1;
        $s0 = $s1;
        $t0 = $t1;
        $r1 = $rn;
        $s1 = $sn;
        $t1 = $tn;
        #echo "DEBUG $qn, $rn, $sn, $tn<br>";
    }

    $res = $s1 % $m;
    #echo "DEBUG: mod_inv($a, $m) = $res<br>";
    return $res;
}
?>


</body>
</html>
