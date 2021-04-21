<?php

include 'essentials/header.php';
include 'essentials/menu.php';
$total_spend = get_the_total_spend();
$total_recipe = get_the_total_recipe();

?>


<main id="flex-container">
    <div>
        <h1>Bienvenue Utilisateur.</h1>
        <div class="chart-container">
            <canvas data-spend="<?= $total_spend[0][0] ?>" data-recipe="<?= $total_recipe[0][0] ?>" id="myChart"></canvas>
        </div>
    </div>
    <footer>
        <p> CONTROL€ est une application Koffi Cup, fabriqué au sein de La Manu. Merci à Becris pour les icônes, stories pour les illustrations.</p>
    </footer>
</main>
<!-- Script qui ne sert qu'ici je le charge que dans cette page -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.0/chart.min.js" integrity="sha512-RGbSeD/jDcZBWNsI1VCvdjcDULuSfWTtIva2ek5FtteXeSjLfXac4kqkDRHVGf1TwsXCAqPTF7/EYITD0/CTqw==" crossorigin="anonymous"></script>
<script src="assets\js\camembert.js"></script>

<?php

include 'essentials/footer.php';


?>