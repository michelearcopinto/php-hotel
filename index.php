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

$selected_star_number = $_POST['star_select'];
$checked_parking_status = $_POST['parking_status'];
$filtered_hotels = [];

var_dump($selected_star_number, $checked_parking_status);

if ($checked_parking_status === 'all_hotels' || $checked_parking_status === null) {
    $filtered_hotels = $hotels;
} elseif ($checked_parking_status === 'no_parking') {
    $filtered_hotels = array_filter($hotels, function ($hotel) {
        return $hotel['parking'] === false;
    });
} elseif ($checked_parking_status === 'yes_parking') {
    $filtered_hotels = array_filter($hotels, function ($hotel) {
        return $hotel['parking'] === true;
    });
}

if ($selected_star_number !== 'Numero stelle' && $selected_star_number !== null) {
    $filtered_hotels = array_filter($filtered_hotels, function ($hotel) use ($selected_star_number) {
        return $hotel['vote'] == $selected_star_number;
    });
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Hotel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .form-select {
            width: fit-content
        }
    </style>
</head>

<body>
    <div class="card container mt-5">
        <div class="card-body">
            <h1 class="card-title text-center text-uppercase">hotels</h1>

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
            <hr class="my-5">
            <h2 class="card-title text-center text-uppercase">risultati</h2>
            <form action="index.php" method="POST" class="d-flex gap-2 align-items-center justify-content-center my-4">
                <select name="star_select" class="form-select" aria-label="Default select example">
                    <option selected hidden>Numero stelle</option>
                    <option value="1" <?php if ($selected_star_number === '1') echo 'selected' ?>>1 stella</option>
                    <option value="2" <?php if ($selected_star_number === '2') echo 'selected' ?>>2 stelle</option>
                    <option value="3" <?php if ($selected_star_number === '3') echo 'selected' ?>>3 stelle</option>
                    <option value="4" <?php if ($selected_star_number === '4') echo 'selected' ?>>4 stelle</option>
                    <option value="5" <?php if ($selected_star_number === '5') echo 'selected' ?>>5 stelle</option>
                </select>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="parking_status" id="all_hotels" value="all_hotels" <?php if ($checked_parking_status === 'all_hotels') echo 'checked' ?>>
                    <label class="form-check-label" for="all_hotels">
                        Con e senza parcheggio
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="parking_status" id="yes_parking" value="yes_parking" <?php if ($checked_parking_status === 'yes_parking') echo 'checked' ?>>
                    <label class="form-check-label" for="yes_parking">
                        Con parcheggio
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="parking_status" id="no_parking" value="no_parking" <?php if ($checked_parking_status === 'no_parking') echo 'checked' ?>>
                    <label class="form-check-label" for="no_parking">
                        Senza parcheggio
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Cerca</button>
            </form>
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

                        foreach ($filtered_hotels as $hotel) {
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

                        $message = (count($filtered_hotels) === 0) ? '<tr><td colspan="5" class="text-center text-uppercase"><h1>Non ci sono hotel da mostrare</h1></td></tr>' : '';

                        echo $message;
                        ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>