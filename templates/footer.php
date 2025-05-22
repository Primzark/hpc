<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="stylesheet" href="/Poker_website/asset/css/style.css">


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>

</head>

<footer class="custom-bg text-light mt-5 py-4">
    <div class="container text-center">
        <p class="mb-1 custom-text">&copy; <?= date('Y') ?> Harfleur Poker Club. Tous droits réservés.</p>
        <ul class="list-inline mb-0">
            <li class="list-inline-item">
                <a href="/Poker_website/src/Controller/ProposController.php" class="text-decoration-none login-hint">À
                    propos</a>
            </li>
            <li class="list-inline-item">
                <a href="/Poker_website/src/Controller/ContactController.php"
                    class="text-decoration-none login-hint">Contact</a>
            </li>
            <li class="list-inline-item">
                <a href="/Poker_website/src/Controller/RegleController.php"
                    class="text-decoration-none login-hint">Règles</a>
            </li>
        </ul>
    </div>
</footer>
