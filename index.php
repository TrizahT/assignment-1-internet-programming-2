<?php

session_start();
if (!isset($_SESSION['history'])) {
    $_SESSION['history'] = [];
}


if (isset($_POST['calculate'])) {
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'] ?? null;
    $operation = $_POST['operation'];
    $result = "";

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
            $result = ($num2 != 0) ? $num1 / $num2 : "Error (Cannot divide by zero)";
            break;
        case "power":
            $result = pow($num1, $num2);
            break;
        case "sqrt":
            $result = sqrt($num1);
            break;
        case "log":
            $result = ($num1 > 0) ? log($num1) : "Error (Logarithm of non-positive number)";
            break;
        default:
            $result = "Invalid operation";
            break;
    }

    
    $calculation = "$num1 " . strtoupper($operation) . " " . ($num2 ?? "") . " = $result";
    array_unshift($_SESSION['history'], $calculation);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VibeCalc</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f0fc; 
            text-align: center;
        }
        .container {
            width: 40%;
            margin: auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.2);
        }
        h2 {
            color: #8e44ad; 
        }
        input, select, button {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 2px solid #8e44ad;
            border-radius: 8px;
        }
        button {
            background-color: #8e44ad;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #5e3370; 
        }
        .history {
            margin-top: 20px;
            text-align: left;
            background: #f4d3ff; 
            padding: 10px;
            border-radius: 8px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>VibeCalc</h2>
        <form method="POST">
            <input type="number" name="num1" step="any" placeholder="Enter first number" required>
            <input type="number" name="num2" step="any" placeholder="Enter second number (if needed)">
            <select name="operation" required>
                <option value="add">Addition (+)</option>
                <option value="subtract">Subtraction (-)</option>
                <option value="multiply">Multiplication (×)</option>
                <option value="divide">Division (÷)</option>
                <option value="power">Exponentiation (^)</option>
                <option value="sqrt">Square Root (√)</option>
                <option value="log">Logarithm (log)</option>
            </select>
            <button type="submit" name="calculate">Calculate</button>
        </form>

        <?php if (isset($result)): ?>
            <h3>Result: <?php echo $result; ?></h3>
        <?php endif; ?>

        <div class="history">
            <h4>Previous Calculations:</h4>
            <ul>
                <?php
                foreach (array_slice($_SESSION['history'], 0, 5) as $calc) {
                    echo "<li>$calc</li>";
                }
                ?>
            </ul>
        </div>
    </div>

</body>
</html>
