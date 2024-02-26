<?php

$hotels = [
    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Hotel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="card container mt-5">
        <div class="card-body">
            <h1 class="card-title text-center text-uppercase">hotels</h1>
            <p class="card-text">

                <?php
                $keys = array_keys($hotels[0]);
                ?>

            <table class="table">
                <thead>
                    <tr>
                        <?php
                        foreach ($keys as $key) {
                            echo "<th class='text-center' scope='col'>" . ucfirst($key) . "</th>";
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php

                        foreach ($hotels as $hotel) {
                            $parking_available = $hotel['parking'] ? 'Disponibile' : 'Non disponibile';

                            echo
                            "<tr class='text-center'>
                                <th scope='row'>{$hotel['name']}</th>
                                <td>{$hotel['description']}</td>
                                <td>$parking_available</td>
                                <td>{$hotel['vote']} stelle</td>
                                <td>{$hotel['distance_to_center']} km</td>
                            </tr>";
                        }
                        ?>
                </tbody>
            </table>
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>