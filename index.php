<?php
session_start();

if (!isset($_SESSION['history'])) {
    $_SESSION['history'] = [];
}

$result = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $operation = $_POST['operation'];
    
    switch ($operation) {
        case "add":
            $result = $num1 + $num2;
            break;
        case "subtract":
            $result = $num1 - $num2;
            break;
        case "multiply":
            $result = $num1 * $num2;
            break;
        case "divide":
            $result = ($num2 != 0) ? $num1 / $num2 : "Error: Division by zero";
            break;
        case "sqrt":
            $result = sqrt($num1);
            break;
        case "log":
            $result = log($num1);
            break;
        case "power":
            $result = pow($num1, $num2);
            break;
        default:
            $result = "Invalid operation";
    }
    
    $_SESSION['history'][] = "$num1 $operation $num2 = $result";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Calculator</title>
    <style>
        body { font-family: Arial, sans-serif; background: #ffedd5; text-align: center; }
        .calculator { background: white; padding: 20px; border-radius: 10px; width: 300px; margin: auto; }
        input, select, button { margin: 5px; padding: 10px; width: 80%; border-radius: 5px; border: none; }
        button { background: #ff007f; color: white; cursor: pointer; }
        .history { margin-top: 20px; }
    </style>
</head>
<body>
    <div class="calculator">
        <h2>Smart Calculator</h2>
        <form method="POST">
            <input type="number" name="num1" required placeholder="Enter first number">
            <input type="number" name="num2" required placeholder="Enter second number">
            <select name="operation">
                <option value="add">Addition</option>
                <option value="subtract">Subtraction</option>
                <option value="multiply">Multiplication</option>
                <option value="divide">Division</option>
                <option value="sqrt">Square Root (First Number Only)</option>
                <option value="log">Logarithm (First Number Only)</option>
                <option value="power">Exponentiation</option>
            </select>
            <button type="submit">Calculate</button>
        </form>
        <h3>Result: <?php echo $result; ?></h3>
        <div class="history">
            <h4>Calculation History</h4>
            <ul>
                <?php foreach ($_SESSION['history'] as $calc) { echo "<li>$calc</li>"; } ?>
            </ul>
        </div>
    </div>
</body>
</html>
