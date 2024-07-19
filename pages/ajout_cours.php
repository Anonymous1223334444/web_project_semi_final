<?php
    include 'utils/Validation.php';
    $host = "localhost";
    $uName = "project";
    $pass = "1223334444";
    $dbName = "web_project";

    // Create connection
    $conn = new mysqli($host, $uName, $pass, $dbName);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Form</title>
</head>
<body>
    <style>
        <?php
            include '../public/css/formateur/signup.css'
        ?>
    </style>
    <div class="container">
        <?php
            if(isset($_GET['error'])) { ?>
                <p class='error'><?=Validation::clean($_GET['error'])?></p>;
        <?php } ?>

        <?php
            if(isset($_GET['success'])) { ?>
                <p class='success'><?=Validation::clean($_GET['success'])?></p>;
        <?php } ?>
        <form action="action/ajout_cours.php" method="POST" class="max-w-sm mx-auto" enctype="multipart/form-data">
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900" style="font-size: 2rem; display: flex; justify-content: center; margin-bottom: 2rem;">Ajout de cours</h2>
                <?php
                    if(isset($_GET['error'])) { ?>
                        <p class='error'><?=Validation::clean($_GET['error'])?></p>;
                <?php } ?>

                <?php
                    if(isset($_GET['success'])) { ?>
                        <p class='success'><?=Validation::clean($_GET['success'])?></p>;
                <?php } ?>
                <h2 class="text-base font-semibold leading-7 text-gray-900">Entrez les infos relatifs au cours</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">#############################################</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="titre" class="block text-sm font-medium leading-6 text-gray-900">Titre</label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                            <input type="text" name="titre" id="titre" autocomplete="titre" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="titre du cours">
                            </div>
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="categorie" class="block text-sm font-medium leading-6 text-gray-900">Categorie</label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                            <input type="text" name="categorie" id="categorie" autocomplete="categorie" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Categorie du cours">
                            </div>
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="id_formateur" class="block mb-2 text-sm font-medium text-gray-900 white:text-dark">Entrez l'id du formateur</label>
                        <select id="id_formateur" name="id_formateur" class="bg-white-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 white:bg-gray-700 white:border-gray-600 white:placeholder-white-400 white:text-white white:focus:ring-blue-500 white:focus:border-blue-500">
                            <option value="">Choisir un id</option>
                            <?php
                                $sql = "SELECT id, prenom FROM formateur";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row["id"] . '">' . $row["id"] . '</option>';
                                    }
                                } else {
                                    echo '<option value="">Rien a montrer</option>';
                                }
                            
                            ?>
                        </select>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="prix" class="block text-sm font-medium leading-6 text-gray-900">Proposition de coût</label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                            <input type="text" name="prix" id="prix" autocomplete="prix" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Proposition du prix de vente du cours">
                            </div>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="desc" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                        <div class="mt-2">
                            <textarea id="desc" name="desc" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                        <p class="mt-3 text-sm leading-6 text-gray-600">Donnez les objectifs pour lesquels ce cours a été fait</p>
                    </div>

                    <div class="col-span-full">
                        <label for="imageUpload" class="block text-sm font-medium leading-6 text-gray-900" style="margin-bottom: 10px;">
                            Ajouter une couverture
                        </label>
                        
                        <label for="imageUpload" class="cursor-pointer">
                            <input type="file" name="cours_img" id="imageUpload" class="hidden" accept="image/*">
                            <div class="w-full h-10 rounded-lg border-2 border-gray-300 flex items-center justify-center hover:border-blue-500 transition duration-300">
                                <span class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">Cliquer pour importer</span>
                            </div>
                        </label>
                    </div>
                </div>


            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Quitter</button>
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Soumettre</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.tailwindcss.com/">
        document.getElementById('file-upload').addEventListener('change', function() {
            var fileName = this.files[0].name;
            document.getElementById('fileName').textContent = fileName;
        });

    </script>
</body>
</html>