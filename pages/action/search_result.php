<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
    <style>
        .styled-table {
            border-collapse:separate; 
            border-spacing: 0 3rem;
            margin: 25px 0;
            font-family: sans-serif;
            min-width: 98%; 
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            font-size: 2.4rem;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
            text-align: center;
        }

        .styled-table tbody tr {
            cursor: pointer;
            background-color: #f3f3f3;
            color: #000;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #088F8F;
        }

        .styled-table tbody tr.active-row {
            font-weight: bold;
            color: #088F8F;
        }
    </style>
</head>
<body>

    <table class="styled-table">
        
        <tbody>
        <?php
        $host = "localhost";
        $uName = "project";
        $pass = "1223334444";
        $dbName = "web_project";

        // Create connection
        $conn = new mysqli($host, $uName, $pass, $dbName);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_POST['search'])) {
            $search = "%{$_POST['search']}%";
            $sql_syntax = "SELECT C.titre, C.categorie, C.id_formateur, F.name_formateur, C.prix, C.description FROM `cours` C
                           JOIN (SELECT id, CONCAT_WS(' ', prenom, nom) as name_formateur FROM `formateur`) F
                           ON F.id = C.id_formateur
                           WHERE titre LIKE ? OR categorie LIKE ? OR name_formateur LIKE ?";

            $stmt = $conn->prepare($sql_syntax);
            $stmt->bind_param('sss', $search, $search, $search);
            $stmt->execute();
            $resultat = $stmt->get_result();

            if ($resultat->num_rows > 0) {
                while ($row = $resultat->fetch_assoc()) { ?>
                    <tr class="infos_row"
                        data-titre="<?= $row["titre"] ?>"
                        data-prix="<?= $row["prix"] ?>"
                        data-categorie="<?= $row["categorie"] ?>"
                        data-description="<?= $row["description"] ?>"
                        data-name_formateur="<?= $row["name_formateur"] ?>"
                    >

                        <td><?= $row["titre"] ?></td>
                        <td><?= $row["categorie"] ?></td>
                        <td><?= $row["name_formateur"] ?></td>
                    </tr>
            <?php } 
            } else { ?>
                <tr><td colspan='3'>No data found 😁️</td></tr>";
            <?php }
                }

            $conn->close();
            ?>
        </tbody>
    </table>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const infos_row = document.querySelectorAll('.infos_row');

            infos_row.forEach(row => {
                row.addEventListener('click', function() {
                    const titre = row.getAttribute('data-titre');
                    const prix = row.getAttribute('data-prix');
                    const categorie = row.getAttribute('data-categorie');
                    const description = row.getAttribute('data-description');
                    const nameFormateur = row.getAttribute('data-name_formateur');

                    const queryString = `titre=${encodeURIComponent(titre)}&prix=${encodeURIComponent(prix)}&categorie=${encodeURIComponent(categorie)}&description=${encodeURIComponent(description)}&nameFormateur=${encodeURIComponent(nameFormateur)}`;

                    window.location.href = `http://localhost/web_dev_3/pages/course_detail.php?${queryString}`;
                });
            });
        });
    </script>
</body>
</html>
