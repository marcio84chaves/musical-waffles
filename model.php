<?php

interface iReadPlayers 
{
    function readPlayers($source, $filename = null);
}

/**
 * This abstract class implements the iReadPlayers (the "Reading" Interface)
 */
abstract class clsReader implements iReadPlayers
{
    //Abstract function that gets the players from an array (will be implemented in a child class)
    abstract function getPlayerDataArray();
    //Abstract function that gets the players from a json object (will be implemented in a child class)
    abstract function getPlayerDataJson();
    //Abstract function that gets the players from a file (will be implemented in a child class)
    abstract function getPlayerDataFromFile($filename);

    /**
     * @param $source string Where we're retrieving the data from. 'json', 'array' or 'file'
     * @param $filename string Only used if we're reading players in 'file' mode.
     * @return string json
     */    
    function readPlayers($source, $filename = null) {
        $playerData = null;

        switch ($source) {
            case 'array':
                $playerData = $this->getPlayerDataArray();
                break;
            case 'json':
                $playerData = $this->getPlayerDataJson();
                break;
            case 'file':
                $playerData = $this->getPlayerDataFromFile($filename);
                break;
        }

        if (is_string($playerData)) {
            $playerData = json_decode($playerData);
        }

        return $playerData;
    }
}

/**
 * This class inherits from all 3 abstract classes and implements the abstract methods to get the players
 * from either an array, a json object, or a file 
 */
class clsPlayersObject extends clsDisplayer {

    private $playersArray;

    private $playerJsonString;

    public function __construct() {
        //We're only using this if we're storing players as an array.
        $this->playersArray = [];

        //We'll only use this one if we're storing players as a JSON string
        $this->playerJsonString = null;
    }

    function getPlayerDataArray() {

        $players = [];

        $jonas = new \stdClass();
        $jonas->name = 'Jonas Valenciunas';
        $jonas->age = 26;
        $jonas->job = 'Center';
        $jonas->salary = '4.66m';
        $players[] = $jonas;

        $kyle = new \stdClass();
        $kyle->name = 'Kyle Lowry';
        $kyle->age = 32;
        $kyle->job = 'Point Guard';
        $kyle->salary = '28.7m';
        $players[] = $kyle;

        $demar = new \stdClass();
        $demar->name = 'Demar DeRozan';
        $demar->age = 28;
        $demar->job = 'Shooting Guard';
        $demar->salary = '26.54m';
        $players[] = $demar;

        $jakob = new \stdClass();
        $jakob->name = 'Jakob Poeltl';
        $jakob->age = 22;
        $jakob->job = 'Center';
        $jakob->salary = '2.704m';
        $players[] = $jakob;

        return $players;

    }

    function getPlayerDataJson() {
        $json = '[{"name":"Jonas Valenciunas","age":26,"job":"Center","salary":"4.66m"},{"name":"Kyle Lowry","age":32,"job":"Point Guard","salary":"28.7m"},{"name":"Demar DeRozan","age":28,"job":"Shooting Guard","salary":"26.54m"},{"name":"Jakob Poeltl","age":22,"job":"Center","salary":"2.704m"}]';
        return $json;
    }

    function getPlayerDataFromFile($filename) {
        $file = file_get_contents($filename);
        return $file;
    }
}

/**
 * This class is used to create Player objects with name, age, job, and salary
 */
class clsPlayer
{
    //Attributes
    private $name, $age, $job, $salary;

    /**
     * Non-default constructor. A set of standard values are passed as parameters if the user
     * does not pass them when creating a new object
     * 
     * @param $pName string - Player's name
     * @param $pAge int - Player's age (in years)
     * @param $pJob string - Player's job
     * @param $pSalary string - Player's salary (in millions per year. Ex: 1.50m)
     */
    public function __construct($pName = "Unknown Name", 
                                $pAge = 0, 
                                $pJob = "Unknown Job", 
                                $pSalary = '0.0m')
    {
        $this->setName($pName);
        $this->setAge($pAge);
        $this->setJob($pJob);
        $this->setSalary($pSalary);
    }

    //Getters for all Player attributes
    public function getName() { return $this->name; }
    public function getAge() { return $this->age; }
    public function getJob() { return $this->job; }
    public function getSalary() { return $this->salary; }

    /**
     * Setter for Player's name. It does a basic validation of the parameter passed to this function,
     * to ensure the name is actually a string
     * 
     * @param $pName string - the desired name for the player
     */
    public function setName($pName)
    {
        if ($pName != NULL && is_string($pName))
            $this->name = $pName;
    }

    /**
     * Setter for Player's age. It does a basic validation of the parameter passed to this function,
     * to ensure the age is actually an int
     * 
     * @param $pAge int - the player's age (in years)
     */
    public function setAge($pAge)
    {
        if ($pAge != NULL && is_integer($pAge))        
            $this->age = $pAge;
    }

    /**
     * Setter for Player's job. It does a basic validation of the parameter passed to this function,
     * to ensure that job is actually a string
     * 
     * @param $pJob string - the job done by the player
     */
    public function setJob($pJob)
    {
        if ($pJob != NULL && is_string($pJob))
            $this->job = $pJob;
    }

    /**
     * Setter for Player's salary. It does a basic validation of the parameter passed to this function,
     * to ensure the salary is actually a string
     * 
     * @param $pSalary string - how much the player receives per year
     */
    public function setSalary($pSalary)
    {
        if ($pSalary != NULL && is_string($pSalary))
            $this->salary = $pSalary;
    }
}

?>