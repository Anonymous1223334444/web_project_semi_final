<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <style>
        table thead tr ,
        table tbody tr {
            text-align: center;
        }

        .container-teacher{
            display: none;
        }

        .nav_admin {
            margin-top: 1rem;
            display: flex;
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);   
            border-radius: 3rem;
        }

        .learner, .teacher, .course {
            border: none;
            padding: 1rem;
            width: 50%;
            font-size: 2rem;
        }

        .learner {
            color: #000000;
            border-bottom: 5px solid #007bff;
            background-color: #ffffff;
        }

        .teacher, .course {
            color: #000000;
            background-color: #ffffff;
        }

    </style>
    <div class="nav_admin">
        <button class="learner" value="learner">Learners</button>
        <button class="teacher" value="teacher">Instructors</button>
        <button class="course" value="teacher">Courses</button>
    </div>
    <?php
        $db_username = 'project';
        $db_password = '1223334444';
        $conn = new PDO( 'mysql:host=localhost;dbname=web_project', $db_username, $db_password );
        if(!$conn){
            die("Fatal Error: Connection Failed!");
        }
        $sql_syntax = "SELECT * FROM apprenant ORDER BY id ASC";
        $sql_syntax2 = "SELECT * FROM formateur ORDER BY id ASC";
        $sql_syntax3 = "SELECT * FROM cours ORDER BY id ASC";

        // Prepare and execute the SQL statement
        $stmt = $conn->prepare($sql_syntax);
        $stmt->execute();

        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt2 = $conn->prepare($sql_syntax2);
        $stmt2->execute();

        $resultat2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        $stmt3 = $conn->prepare($sql_syntax3);
        $stmt3->execute();

        $resultat3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="container my-5 container-learner">
        <h2>List of Learners on the Platform (<?= count($resultat) ?>)</h2>
        <a href="Admin/create.php" class="btn btn-primary" style="margin: 1rem 0; padding: 0.5rem 1rem; font-size: 2rem;" role="button">Add</a>
        <br><br>
        <?php
            if (count($resultat) > 0) {
                echo '<table class="table">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Name</th>
                                <th>Surname</th>
                                <th>Email</th>
                                <th>Number of Courses Followed</th>
                                <th>Join Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>';
            
                // Loop through each row and output the data
                foreach ($resultat as $row) {
                    echo "
                        <tr>
                            <td>".$row["id"]."</td>
                            <td>".$row["nom"]."</td>
                            <td>".$row["prenom"]."</td>
                            <td>".$row["email"]."</td>
                            <td>".$row["nbr_cours_suivi"]."</td>
                            <td>".$row["Join date"]."</td>
                            <td>
                                <a href='Admin/edit.php' class='btn btn-primary btn-sm' style='padding: 0.5rem 1rem; font-size: 1.5rem;'>Edit</a>
                                <a href='Admin/delete.php' class='btn btn-danger btn-sm' style='padding: 0.5rem 1rem; font-size: 1.5rem;'>Delete</a>
                            </td>
                        </tr>";
                }
            
                echo '</tbody>
                    </table>';
            } else {
                echo "No data found";
            }
            
        ?>
    </div>

    <div class="container my-5 container-teacher">
        <h2>List of Instructors on the Platform (<?= count($resultat2) ?>)</h2>
        <a href="Admin/create_prof.php" class="btn btn-primary" role="button" style="margin: 1rem 0; padding: 0.5rem 1rem; font-size: 2rem;">Add</a>
        <br><br>
        <?php
            if (count($resultat2) > 0) {
                echo '<table class="table">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Name</th>
                                <th>Surname</th>
                                <th>Email</th>
                                <th>Portfolio</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>';
            
                // Loop through each row and output the data
                foreach ($resultat2 as $row2) {
                    echo "
                        <tr>
                            <td>".$row2["id"]."</td>
                            <td>".$row2["nom"]."</td>
                            <td>".$row2["prenom"]."</td>
                            <td>".$row2["email"]."</td>
                            <td>".$row2["portofolio"]."</td>
                            <td>
                                <a href='Admin/edit.php' class='btn btn-primary btn-sm' style='padding: 0.5rem 1rem; font-size: 1.5rem;'>Edit</a>
                                <a href='Admin/delete.php' class='btn btn-danger btn-sm' style='padding: 0.5rem 1rem; font-size: 1.5rem;'>Delete</a>
                            </td>
                        </tr>";
                }
            
                echo '</tbody>
                    </table>';
            } else {
                echo "No data found";
            }
            
        ?>
    </div>

    <div class="container my-5 container-course">
        <h2>List of Courses on the Platform (<?= count($resultat3) ?>)</h2>
        <a href="ajout_cours.php" class="btn btn-primary" role="button" style="margin: 1rem 0; padding: 0.5rem 1rem; font-size: 2rem;">Add</a>
        <br><br>
        <?php
            if (count($resultat3) > 0) {
                echo '<table class="table">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Title</th>
                                <th>Categorie</th>
                                <th>Price</th>
                                <th>Id Instructor</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>';
            
                // Loop through each row and output the data
                foreach ($resultat3 as $row3) {
                    echo "
                        <tr>
                            <td>".$row3["id"]."</td>
                            <td>".$row3["titre"]."</td>
                            <td>".$row3["categorie"]."</td>
                            <td>".$row3["prix"]."</td>  
                            <td>".$row3["id_formateur"]."</td>
                            <td>
                                <a href='Admin/edit.php' class='btn btn-primary btn-sm' style='padding: 0.5rem 1rem; font-size: 1.5rem;'>Edit</a>
                                <a href='Admin/delete.php' class='btn btn-danger btn-sm' style='padding: 0.5rem 1rem; font-size: 1.5rem;'>Delete</a>
                            </td>
                        </tr>";
                }
            
                echo '</tbody>
                    </table>';
            } else {
                echo "No data found";
            }
            
        ?>
    </div>

    <script>
        const learner = document.querySelector(".learner");
        const teacher = document.querySelector(".teacher");
        const course = document.querySelector(".course");
        const cont_learner = document.querySelector(".container-learner");
        const cont_teacher = document.querySelector(".container-teacher");
        const cont_course = document.querySelector(".container-course");

        teacher.addEventListener("click", function() {
            cont_learner.style.display = "none";
            cont_course.style.display = "none";
            teacher.style.borderBottom = "5px solid #007bff";
            learner.style.borderBottom = "none";
            course.style.borderBottom = "none";
            cont_teacher.style.display = "block";
        })

        learner.addEventListener("click", function() {
            cont_learner.style.display = "block";
            cont_course.style.display = "none";
            cont_teacher.style.display = "none";
            teacher.style.borderBottom = "none";
            learner.style.borderBottom = "5px solid #007bff";
            course.style.borderBottom = "none";
        })
        course.addEventListener("click", function() {
            cont_course.style.display = "block";            
            cont_teacher.style.display = "none";
            cont_learner.style.display  = "none";            
            teacher.style.borderBottom = "none";
            learner.style.borderBottom = "none";
            course.style.borderBottom = "5px solid #007bff";

        })
    </script>
</body>
</html>
