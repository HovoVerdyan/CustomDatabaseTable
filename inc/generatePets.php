<?php

function generatePets()
{
	$favFood = ['pizza','hot dog', 'cake', 'omlette'];
	$favColor = ['green','red','yellow','brown'];
	$favGame = ['Asphalt 9','Assasine Creed','GTA','Need for Speed'];
	$favTime = ['Morning','Daytime','Evening','Night'];
	$favHobby = ['Play','Run','Run Faster','Run a lot faster'];

	return array(
        'birthYear' => rand(1991,2056),
		'petWeight' => rand(2.5, 8.9),
		'favFood' => $favFood[array_rand($favFood, 1)],
        'favColor' => $favColor[array_rand($favColor, 1)],
        'favGame' => $favGame[array_rand($favGame, 1)],
		'favTime' => $favTime[array_rand($favTime, 1)],
        'favHobby' => $favHobby[array_rand($favHobby, 1)]
    );
}