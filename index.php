<?php
 
$pdo = new PDO('sqlite:zoo.db');
$stmnt = $pdo->query("SELECT * FROM animals");
$animals = $stmnt->fetchAll(PDO::FETCH_ASSOC);
var_dump($animals); // var dump used to check if animals are being pulled from database. print_r also works


class Zoo
{
    // list of animals in zoo
    public array $animals = [];
 
    // current time in zoo
    public DateTime $currentDate;
 
    // set the date to now
    public function __construct()
    {
        $this->currentDate = new DateTime();
    }
 
    // add an hour to current time
    public function updateCurrentDate(): void
    {
        $this->currentDate->modify("+1 hour");
    }
 
    // return a specifically formatted date
    public function showCurrentDate(): string
    {
        return $this->currentDate->format("Y-m-d H:i:s");
    }
 
    // add an animal to the current list of animals
    public function addAnimal(Animal $animal): void // void return type as we don't need to return anything from this function
    {
        // make sure the animal isn't already in the zoo
        if (in_array($animal, $this->animals)) {
            return;
        }
 
        $this->animals[] = $animal;
 
        // add animal to the database
    }
 
    // HUNGER
    // generate a random value between 0 and 20 to simulate hunger 
    // brief specified random float values but no built in function. 
    public function animalHunger(): void
    {
        $elephant = random_int(0, 20);
        $giraffe  = random_int(0, 20);
        $monkey   = random_int(0, 20);
 
        // assign different hunger values to each animal
        foreach ($this->animals as $animal) {
            if (is_a($animal, Elephant::class)) {
                $hunger = $elephant;
            } elseif (is_a($animal, Giraffe::class)) {
                $hunger = $giraffe;
            } elseif (is_a($animal, Monkey::class)) {
                $hunger = $monkey;
            }
 
            // reduce health for each animal (Animal::hunger)
            $animal->hunger($hunger);
 
        }
    }
 
    // FEED
    // Generate a random value between 10 and 25 to feed each animal 
    public function feedAnimals(): void
    {
        $elephant = random_int(10, 25);
        $giraffe  = random_int(10, 25);
        $monkey   = random_int(10, 25);
 
        // assign different food values to each animal
        foreach ($this->animals as $animal) {
            if (is_a($animal, Elephant::class)) {
                $food = $elephant;
            } elseif (is_a($animal, Giraffe::class)) {
                $food = $giraffe;
            } elseif (is_a($animal, Monkey::class)) {
                $food = $monkey;
            }
 
            $animal->feed($food);
 
            // update this animal in the database
        }
    }
}
 

abstract class Animal // abstract class as we don't want to create an instance of this class but rather extend it
// no instance of general class as no such thing as general animal, always specific
// interface could also be used here if animal didnt require any properties
{
    // setting the health property shared by all animals as a float to signify a percentage
    public float $health;
 
    public function __construct(float $health = 100.00)
    {
        $this->health = $health;
    }
 
    // reduce health by a given amount
    public function hunger(int $hunger = 0): void
    {
        $this->health -= round($this->health * $hunger, 2); // rounds to 2 decimal places giving a float
 
    }
 
    public function feed(float $food = 0): void
    {
        $this->health += round($this->health * $food, 2);
        $this->health = $this->health > 100.00 ? 100.00 : $this->health; // ternary operator to check if health is over 100 and if so set to 100
    }
}
 

class Elephant extends Animal
{
    // low health check function, under 70% health cant walk
    // if stays at less than 70% health for 1 hour, dies
public function lowHealthCheck(): void {
    foreach ($this->animals as $animal) {
        if (is_a($animal, Elephant::class) && $animal->health < 70) {
            ;
}
 
class Giraffe extends Animal
{
    // low health check function, under 50% dies
    public function lowHealthCheck(): void {
        foreach ($this->animals as $animal) {
            if (is_a($animal, Giraffe::class) && $animal->health < 50) {
                ;
}
 
class Monkey extends Animal
{
    // low health check function, under 30% dies
    public function lowHealthCheck(): void {
        foreach ($this->animals as $animal) {
            if (is_a($animal, Monkey::class) && $animal->health < 30) {
                // sql query to delete monkey from database 'DELETE FROM animals WHERE name='monkey'
                // issue with only deleting one record of Monkey
                // echo 'Monkey has died;
            }
}
 

$zoo = new Zoo();
 
// if there are no animals in the database, create them.
for ($i=0; $i<5; $i++) {
    $zoo->addAnimal(new Elephant());
    $zoo->addAnimal(new Giraffe());
    $zoo->addAnimal(new Monkey());
}

// feed the animals
if (isset($_POST['feed'])) {
    $zoo->feedAnimals();
}

// force an hour to pass and hunger to be calculated and deducted
if (isset($_POST['add hour'])) {
    $zoo->updateCurrentDate();
    $zoo->animalHunger();
}

?>

<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Lovely Zoo</title>
</head>
<body>
    <h1>My Lovely Zoo</h1>
    <p>Welcome to the zoo! Today is <?php echo $zoo->showCurrentDate(); ?></p>
    <div class="animals">
        <h2>Animals</h2>
            <?php foreach ($animals as $animal) {
                echo $animal['name'], $animal['health']; 
            } ?>
            <!-- display animal images along with health bar, potentially use <ol>, <ul>, <table>, <progress> -->
    </div>
    <form action="index.php" method="post">
        <button name="feed">Feed the Animals</button>
        <button name="add hour">Add an hour</button>
    </form>
</body>
</html>

<!--  
    NOTES
    - number of features I didnt have a chance to implement / unsure exactly how to
    - hydrator / factory pattern could also have potentially been used to create the animals - array to object
    - github copilot is amazing
    - need to add a way to delete animals from the database
    - currently not displaying the HTML on the page but will run without throwing error/exception

-->

<?php
$min = 0;
$max = 20;
$decimals = 2;

$divisor = pow(10, $decimals);
$randomFloat = mt_rand($min, $max * $divisor) / $divisor;

echo $randomFloat;
// potential use for random float for hunger and food values
?> 