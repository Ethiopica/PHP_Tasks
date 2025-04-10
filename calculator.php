<?php
// Check if the form has been submitted
if (isset($_POST['submit'])) {
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $operator = $_POST['operator'];
    if (is_numeric($num1) && is_numeric($num2)) {
        if ($operator == 'add') {
            $result = $num1 + $num2;
        } elseif ($operator == 'subtract') {
            $result = $num1 - $num2;
        } elseif ($operator == 'multiply') {
            $result = $num1 * $num2;
        } elseif ($operator == 'divide') {
            $result = $num2 != 0 ? $num1 / $num2 : "Cannot divide by zero";
        }
    } else {
        $result = "Please enter valid numbers";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PHP Calculator</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

        body {
            background: rgb(8, 59, 31);
            font-family: "Montserrat", sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .calculator {
            background: rgb(255, 255, 255);
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            width: 320px;
        }

        .calculator h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .calculator input[type="text"],
        .calculator select {
            width: 70%;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .calculator input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;

        }

        .result {
            margin-top: 15px;
            text-align: center;
            font-weight: bold;
            font-size: 18px;
            color: #333;
        }
    </style>
</head>

<body>

    <div class="calculator">
        <h2>Simple Calculator</h2>
        <form action="calculator.php" method="post">
            <input type="text" name="num1" placeholder="Enter number">
            <select name="operator">
                <option value="add">+</option>
                <option value="subtract">-</option>
                <option value="multiply">*</option>
                <option value="divide">/</option>
            </select>
            <input type="text" name="num2" placeholder="Enter number">
            <input type="submit" name="submit" value="Calculate">
        </form>

        <?php if (isset($result)) : ?>
            <div class="result">Result : <?= $result ?></div>
        <?php endif; ?>
    </div>

</body>

</html>