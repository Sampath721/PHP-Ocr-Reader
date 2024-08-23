<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OCR Result</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="card-title text-center">Extracted Passport Data</h2>

                    <?php
                    require_once 'vendor/autoload.php';
                    use Mindee\Client;
                    use Mindee\Product\Generated\GeneratedV1;
                    use Mindee\Input\PredictMethodOptions;
                    use thiagoalessio\TesseractOCR\TesseractOCR;

                    if (!empty($_GET['file'])) {
                        processPassportImage($_GET['file']);
                    } else {
                        echo "<p class='text-danger'>No file specified.</p>";
                    }

                    function processPassportImage($file)
                    {
                        if (file_exists($file)) {
                            $mindeeClient = new Client("b81a5bd74a4bf138f4d7e489499d9b6f");
                            $inputSource = $mindeeClient->sourceFromPath($file);
                            $customEndpoint = $mindeeClient->createEndpoint("indian_passport", "mindee", "1");

                            $predictOptions = new PredictMethodOptions();
                            $predictOptions->setEndpoint($customEndpoint);
                            $apiResponse = $mindeeClient->parse(GeneratedV1::class, $inputSource, $predictOptions);

                            $responseJson = json_encode($apiResponse, JSON_PRETTY_PRINT);
                            $responseArray = json_decode($responseJson, true);

                            $dateOfBirth = null;
                            $fullName = "";
                            $surname = "";
                            $passportNumber = "";
                            $nationality = "";
                            $birthPlace = "";
                            $issuancePlace = "";
                            $expiryDate = "";
                            $gender = "";

                            if (isset($responseArray['document']['inference']['prediction']['fields'])) {
                                $fields = $responseArray['document']['inference']['prediction']['fields'];

                                $dateOfBirth = $fields['birth_date']['value'] ?? null;
                                $surname = $fields['surname']['value'] ?? null;
                                $passportNumber = $fields['id_number']['value'] ?? null;
                                $nationality = $fields['country']['value'] ?? null;
                                $birthPlace = $fields['birth_place']['value'] ?? null;
                                $issuancePlace = $fields['issuance_place']['value'] ?? null;
                                $expiryDate = $fields['expiry_date']['value'] ?? null;
                                $gender = $fields['gender']['value'] ?? null;

                                if (isset($fields['given_names']['values'])) {
                                    foreach ($fields['given_names']['values'] as $nameData) {
                                        $fullName .= $nameData['value'] . " ";
                                    }
                                    $fullName = trim($fullName);
                                }
                            }

                            if (empty($surname) || empty($fullName) || empty($dateOfBirth)) {
                                echo "<p class='text-danger'>Please upload the passport image with more clarity.</p>";
                            } else {
                                echo '<table class="table table-bordered">';
                                echo '<tr><th>Full Name</th><td>' . htmlspecialchars($surname . ' ' . $fullName) . '</td></tr>';
                                echo '<tr><th>Date of Birth</th><td>' . htmlspecialchars($dateOfBirth) . '</td></tr>';
                                echo '<tr><th>Gender</th><td>' . ($gender !== null ? htmlspecialchars($gender) : "Not available") . '</td></tr>';
                                echo '<tr><th>Passport Number</th><td>' . ($passportNumber !== null ? htmlspecialchars($passportNumber) : "Not available") . '</td></tr>';
                                echo '<tr><th>Nationality</th><td>' . ($nationality !== null ? htmlspecialchars($nationality) : "Not available") . '</td></tr>';
                                echo '<tr><th>Place of Birth</th><td>' . ($birthPlace !== null ? htmlspecialchars($birthPlace) : "Not available") . '</td></tr>';
                                echo '<tr><th>Place of Issue</th><td>' . ($issuancePlace !== null ? htmlspecialchars($issuancePlace) : "Not available") . '</td></tr>';
                                echo '<tr><th>Date of Expiry</th><td>' . ($expiryDate !== null ? htmlspecialchars($expiryDate) : "Not available") . '</td></tr>';
                                echo '</table>';

                                if (isset($_GET['file'])) {
                                    echo '<div class="text-center mt-4">';
                                    echo '<img src="' . htmlspecialchars($_GET['file']) . '" class="img-fluid" style="max-width: 300px; height: auto;" />';
                                    echo '</div>';
                                }

                                echo '<div class="text-center mt-3">';
                                echo "<a href='index.php' class='btn btn-primary'>Upload another photo</a>";
                                echo '</div>';
                            }
                        } else {
                            echo "<p class='text-danger'>File not found.</p>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
