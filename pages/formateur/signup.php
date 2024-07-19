<?php
    include '../utils/Validation.php';

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
            include '../../public/css/formateur/signup.css';
        ?>
    </style>
    <div class="container">
        <form action="../action/formateur/signup.php" method="POST" class="max-w-sm mx-auto" enctype="multipart/form-data">
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900" style="font-size: 2rem; display: flex; justify-content: center; margin-bottom: 2rem;">Devenez formateur</h2>
                <?php
                    if(isset($_GET['error'])) { ?>
                        <p class='error'><?=Validation::clean($_GET['error'])?></p>;
                <?php } ?>

                <?php
                    if(isset($_GET['success'])) { ?>
                        <p class='success'><?=Validation::clean($_GET['success'])?></p>;
                <?php } ?>
                <h2 class="text-base font-semibold leading-7 text-gray-900">Entrez vos infos</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Ces infos seront utilisés par nos équipes pour valider votre candidature.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                    <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Lien vers votre portofolio</label>
                    <div class="mt-2">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                        <input type="text" name="portofolio" id="username" autocomplete="username" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="myportofolio.com">
                        </div>
                    </div>
                    </div>

                    <div class="col-span-full">
                    <label for="about" class="block text-sm font-medium leading-6 text-gray-900">À propos</label>
                    <div class="mt-2">
                        <textarea id="about" name="bio" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                    </div>
                    <p class="mt-3 text-sm leading-6 text-gray-600">Parlez nous un peu plus de vous.</p>
                    </div>

                    <div class="col-span-full">
                    <label for="photo" class="block text-sm font-medium leading-6 text-gray-900">Photo</label>
                    <div class="mt-2 flex items-center gap-x-3">
                        <svg class="h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
                        </svg>
                        <button type="button" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Changer</button>
                    </div>
                    </div>

                    <div class="col-span-full"  style="margin-bottom: 20px;">
                        <div class="col-span-full">
                            <label for="imageUpload" class="block text-sm font-medium leading-6 text-gray-900" style="margin-bottom: 10px;">
                                Ajouter une couverture
                            </label>
                            
                            <label for="imageUpload" class="cursor-pointer">
                                <input type="file" name="pp" id="imageUpload" class="hidden" accept="image/*">
                                <div class="w-full h-10 rounded-lg border-2 border-gray-300 flex items-center justify-center hover:border-blue-500 transition duration-300">
                                    <span class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">Cliquer pour importer</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <p class="mt-1 text-sm leading-6 text-gray-600">#############################################</p>

                <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Informations Personnels</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Utiliser une adresse permanente où vous pourrais recevoir des messages.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Votre Prénom</label>
                        <div class="mt-2">
                            <input type="text" name="prenom" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Votre Nom</label>
                        <div class="mt-2">
                            <input type="text" name="nom" id="last-name" autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Votre adresse mail</label>
                        <div class="mt-2">
                            <input id="email" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Choisir un mot de passe</label>
                        <div class="mt-2">
                            <input id="password" name="password" type="password" autocomplete="password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>



                    <div class="sm:col-span-3">
                    <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Votre Pays</label>
                    <div class="mt-2">
                        <select id="country" name="country" autocomplete="country-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option>Sénégal</option>
                            <option>Côte d'Ivoire</option>
                            <option>Congo Brazaville</option>
                        </select>
                    </div>
                    </div>

                    <div class="col-span-full">
                    <label for="street-address" class="block text-sm font-medium leading-6 text-gray-900">Vote localité</label>
                    <div class="mt-2">
                        <input type="text" name="street-address" id="street-address" autocomplete="street-address" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    </div>

                </div>
                </div>

                <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Notifications</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Nous vous informerons toujours des changements importants, mais vous choisissez également ce que vous voulez entendre.</p>

                <div class="mt-10 space-y-10">
                    <fieldset>
                    <legend class="text-sm font-semibold leading-6 text-gray-900">Par Email</legend>
                    <div class="mt-6 space-y-6">
                        <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                            <input id="comments" name="comments" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                        </div>
                        <div class="text-sm leading-6">
                            <label for="comments" class="font-medium text-gray-900">Commentaires</label>
                            <p class="text-gray-500">Recevez une notification lorsque quelqu'un publie un commentaire relatif a votre cours.</p>
                        </div>
                        </div>
                        <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                            <input id="candidates" name="candidates" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                        </div>
                        <div class="text-sm leading-6">
                            <label for="candidates" class="font-medium text-gray-900">Candidature</label>
                            <p class="text-gray-500">Soyez avertie lorsque quelqu'un s'enrolle à votre cours.</p>
                        </div>
                        </div>
                        <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                            <input id="offers" name="offers" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                        </div>
                        <div class="text-sm leading-6">
                            <label for="offers" class="font-medium text-gray-900">Offres</label>
                            <p class="text-gray-500">Soyer notifier lorsque des options de primes vous sont favorables.</p>
                        </div>
                        </div>
                    </div>
                    
                    </fieldset>
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