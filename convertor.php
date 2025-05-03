<?php
$result = "";

if (isset($_POST['submit'])) {
    $value = $_POST['value'];
    $from = $_POST['from'];
    $to = $_POST['to'];

    if (is_numeric($value)) {
        function convert($value, $from, $to)
        {
            $speedUnits = ['kilometer-per-hour', 'meter-per-second', 'knots'];
            $massUnits = ['kilogram', 'gram'];
            $tempUnits = ['celsius', 'fahrenheit', 'kelvin'];

            $speedConversions = [
                'kilometer-per-hour' => 1,
                'meter-per-second' => 0.2777777778,
                'knots' => 0.5399568035,
            ];

            $massConversions = [
                'kilogram' => 1,
                'gram' => 1000,
            ];

            // Temperature conversion
            if (in_array($from, $tempUnits) && in_array($to, $tempUnits)) {
                if ($from == $to) return $value;

                // Convert to Celsius
                if ($from == 'fahrenheit') $value = ($value - 32) * 5 / 9;
                elseif ($from == 'kelvin') $value = $value - 273.15;

                // Convert from Celsius to target
                if ($to == 'fahrenheit') return ($value * 9 / 5) + 32;
                elseif ($to == 'kelvin') return $value + 273.15;
                else return $value;
            }

            // Length conversion
            if (in_array($from, $speedUnits) && in_array($to, $speedUnits)) {
                return $value / $speedConversions[$from] * $speedConversions[$to];
            }

            // Mass conversion
            if (in_array($from, $massUnits) && in_array($to, $massUnits)) {
                return $value / $massConversions[$from] * $massConversions[$to];
            }

            return "Conversion between selected units is not supported.";
        }

        $converted = convert($value, $from, $to);
        if (is_numeric($converted)) {
            $result = "$value $from = " . round($converted, 4) . " $to";
        } else {
            $result = $converted;
        }
    } else {
        $result = "Please enter a valid number.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PHP Unit Converter</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

        body {
            background-color: #eef3f7;
            font-family: "Montserrat", sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #327444, #a6e0a5);
        }

        .converter {
            background: white;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 360px;
        }

        .converter h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .converter input,
        .converter select,
        .converter button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .converter button {
            background-color: #2196F3;
            background: linear-gradient(135deg, #327444, #a6e0a5);
            color: white;
            border: none;
            cursor: pointer;
        }

        .converter button:hover {
            background-color: #1976D2;
        }

        .result {
            margin-top: 15px;
            text-align: center;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>

<body>

    <div class="converter">
        <h2>Unit Converter</h2>
        <form method="post">
            <input type="text" name="value" placeholder="Enter value" required>

            <label>From:</label>
            <select name="from" required>
                <optgroup label="speed">
                    <option value="kilometer-per-hour">Kilometer Perhour</option>
                    <option value="meter-per-second">Meter Per second</option>
                    <option value="knots">Knots</option>
                </optgroup>
                <optgroup label="Mass">
                    <option value="kilogram">Kilogram</option>
                    <option value="gram">Gram</option>
                </optgroup>
                <optgroup label="Temperature">
                    <option value="celsius">Celsius</option>
                    <option value="fahrenheit">Fahrenheit</option>
                    <option value="kelvin">Kelvin</option>
                </optgroup>
            </select>

            <label>To:</label>
            <select name="to" required>
                <optgroup label="speed">
                    <option value="kilometer-per-hour">Kilometer Perhour</option>
                    <option value="meter-per-second">Meter Per second</option>
                    <option value="Kilometer-per-second">Knots</option>
                </optgroup>
                <optgroup label="Mass">
                    <option value="kilogram">Kilogram</option>
                    <option value="gram">Gram</option>
                </optgroup>
                <optgroup label="Temperature">
                    <option value="celsius">Celsius</option>
                    <option value="fahrenheit">Fahrenheit</option>
                    <option value="kelvin">Kelvin</option>
                </optgroup>
            </select>

            <button type="submit" name="submit">Convert</button>
        </form>

        <?php if ($result): ?>
            <div class="result"><?= $result ?></div>
        <?php endif; ?>
    </div>

</body>

</html>