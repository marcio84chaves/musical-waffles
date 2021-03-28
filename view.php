<?php

require_once("model.php");
require_once("controller.php");

interface iDisplayPlayers
{
    function display($isCLI, $course, $filename = null);
}

/**
 * This abstract class implements the iDisplayPlayers (the "Displaying" Interface)
 */
abstract class clsDisplayer extends clsWriter implements iDisplayPlayers
{
    function display($isCLI, $source, $filename = null) {

        $players = $this->readPlayers($source, $filename);

        if ($isCLI) 
        {
            echo "Current Players: \n";
            foreach ($players as $player) 
            {
                echo "\tName: $player->getName()\n";
                echo "\tAge: $player->getAge()\n";
                echo "\tSalary: $player->getSalary()\n";
                echo "\tJob: $player->getJob()\n\n";
            }
        } 
        else 
        {
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <style>
                    li {
                        list-style-type: none;
                        margin-bottom: 1em;
                    }
                    span {
                        display: block;
                    }
                </style>
            </head>
            <body>
            <div>
                <span class="title">Current Players</span>
                <ul>
                    <?php foreach($players as $player) { ?>
                        <li>
                            <div>
                                <span class="player-name">Name: <?= $player->name ?></span>
                                <span class="player-age">Age: <?= $player->age ?></span>
                                <span class="player-salary">Salary: <?= $player->salary ?></span>
                                <span class="player-job">Job: <?= $player->job ?></span>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </body>
            </html>
            <?php
        }
    }
}

?>