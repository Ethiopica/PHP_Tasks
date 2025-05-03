<?php
session_start();

// Abstract Pet class
abstract class Pet
{
    protected string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    abstract public function speak(): string;

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return static::class;
    }
}

// Pet subclasses
class Dog extends Pet
{
    public function speak(): string
    {
        return "Woof! I'm " . $this->name;
    }
}

class Cat extends Pet
{
    public function speak(): string
    {
        return "Meow! I'm " . $this->name;
    }
}

class Bird extends Pet
{
    public function speak(): string
    {
        return "Tweet! I'm " . $this->name;
    }
}

// PetShop class
class PetShop
{
    private array $pets = [];

    public function __construct()
    {
        // Load existing pets from session if available
        if (isset($_SESSION['pets'])) {
            $this->pets = $_SESSION['pets'];
        }
    }

    public function addPet(Pet $pet): void
    {
        $this->pets[] = $pet;
        $_SESSION['pets'] = $this->pets;
    }

    public function displayPets(): void
    {
        if (empty($this->pets)) {
            echo "<p>No pets in the shop yet.</p>";
        } else {
            echo "<h3>Current Pets in Shop:</h3><ul>";
            foreach ($this->pets as $pet) {
                echo "<li><strong>" . $pet->getType() . ":</strong> " . $pet->getName() . " says \"" . $pet->speak() . "\"</li>";
            }
            echo "</ul>";
        }
    }
}

// Instantiate shop
$shop = new PetShop();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["pet_type"]) && isset($_POST["pet_name"])) {
    $type = $_POST["pet_type"];
    $name = htmlspecialchars($_POST["pet_name"]);

    switch ($type) {
        case "Dog":
            $shop->addPet(new Dog($name));
            break;
        case "Cat":
            $shop->addPet(new Cat($name));
            break;
        case "Bird":
            $shop->addPet(new Bird($name));
            break;
        default:
            echo "<p>Invalid pet type!</p>";
            break;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Pet Shop</title>
</head>

<body>
    <h2>Welcome to the Pet Shop</h2>

    <form method="post">
        <label for="pet_name">Pet Name:</label>
        <input type="text" id="pet_name" name="pet_name" required><br><br>

        <label for="pet_type">Select Pet Type:</label>
        <select name="pet_type" id="pet_type">
            <option value="Dog">Dog</option>
            <option value="Cat">Cat</option>
            <option value="Bird">Bird</option>
        </select><br><br>

        <input type="submit" value="Add Pet">
    </form>

    <hr>

    <?php
    $shop->displayPets();
    ?>

</body>

</html>