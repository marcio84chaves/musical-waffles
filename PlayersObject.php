<?php

//http://localhost/musical-waffles-master/PlayersObject.php

require_once("model.php");
require_once("view.php");
require_once("controller.php");

/** ********************************************************************************************************************
 * ****************************************** MARCIO CHAVES - COMMENTS *************************************************
 * *********************************************************************************************************************
 * Well, first of all, thanks for the opportunity to work on this exercise. It was really fun!                         *
 *                                                                                                                     *
 * First thing I did was to research a little bit about the SOLID design. Even though my teachers did not specifically *
 * teach us about that design, many of its principles were shown to us, so it was not that much of a strange thing to  *
 * me.                                                                                                                 *
 *                                                                                                                     *
 * So, I tried was to apply the fundamentals for single-responsibility from SOLID and separated the interface into     *
 * 3 other interfaces: one to deal with the reading, a second for the writing, and a third for displaying the players. *
 * Then, I created a class that implemented each interface.                                                            *
 *                                                                                                                     *
 * After that, I tried to apply the MVC fundamentals to the application. We first saw the MVC this semester, so I      * 
 * again did a quick research on it. I separated the interfaces and classes into how I think they should be using the  *
 * MVC model. The Model has the data, the code to get the players from the source, and the PlayersObject class. The    * 
 * View has the code to display the players to the user. And the Controller has the code to update the source with a   *
 * new player.                                                                                                         *
 *                                                                                                                     *
 * NOTES:                                                                                                              *
 * I am not a particular fan of using the \stdClass for creating a player. Therefore, I created a Player class, that   *
 * can be used to create Player objects. It is part of the Model part of the application. However, due to the short    *
 * amount of time to submit this, I did not use it instead of \stdClass because I would need to create a method that   *
 * gets that clsPlayer object and converts it to jSON so it could be properly written to the file, and after           *
 * scratching my head for a while, I realized I would need to google how to do that, or ask someone. So I left the way *
 * it was given to me, even though I realize it is not flexible and practical at all to add players this way! :)       *
 *                                                                                                                     *
 * CONSIDERATIONS:                                                                                                     *
 * If I had more time, besides the aforementioned method, I would have created:                                        *
 *                                                                                                                     *
 * 1. A form with some text explaining the purpose of the application to the user, and 2 buttons, one for displaying   *
 * the current players, and another to add a new one.                                                                  *
 * 2. A second form with fields for the name, age, job, and salary of the player, with a button to add it to the file, *
 * and another to go back to the initial page.                                                                         *
 * 3. A function (after the user pressed the button to add the player) to check if the player was not already added to *
 * the file (using the Player's name), so the file did not had any duplicates. That function would also ensures the    *
 * user could not add an empty player.                                                                                 *
 *                                                                                                                     *
 * Finally, I would like to be completely honest here and say that I think this is not a hard exercise at all, it just *
 * requires some time to perfectly understand how each part ot the application would fit in the MVC model and how to   *
 * refactor the code using the SOLID design, and I must confess I lack the ability to do all that on my own. And I am  *
 * sorry for that.                                                                                                     *
 * *********************************************************************************************************************
*/

$playersObject = new clsPlayersObject();

$marcio = new \stdClass();
        $marcio->name = 'Marcio Chaves';
        $marcio->age = 36;
        $marcio->job = 'Bench Sitter';
        $marcio->salary = '1 burger, 2 donuts';

$playersObject->writePlayer('file', $marcio, 'playerdata.json');

//$playersObject->display(php_sapi_name() === 'cli', 'array');

$playersObject->display(php_sapi_name() === 'cli', 'file', 'playerdata.json');
?>