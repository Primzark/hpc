<?php include_once('../../templates/head.php'); ?>
<?php include_once('../../templates/navbar.php'); ?>

<div class="custom-bg min-vh-100 py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <p class="display-6 fw-bold text-light">Trombinoscope</p>
            </div>
        </div>

        <div class="row g-4">
            <!-- Carte 1 -->
            <div class="col-12 col-sm-6 col-md-4">
                <div class="card custom-add border-0 rounded-3 shadow p-3 text-center">
                    <img src="/asset/img/cropped-pat-1.jpeg" class="mx-auto mb-3" alt="Nom du membre"
                        style="width:200px; height:200px; object-fit:cover; border-radius:50%;">
                    <p class="field-text mb-1">Patrick Piednoel</p>
                </div>
            </div>

            <!-- Carte 2 -->
            <div class="col-12 col-sm-6 col-md-4">
                <div class="card custom-add border-0 rounded-3 shadow p-3 text-center">
                    <img src="/asset/img/cropped-papy.jpeg" class="mx-auto mb-3" alt="Nom du membre"
                        style="width:200px; height:200px; object-fit:cover; border-radius:50%;">
                    <p class="field-text mb-1">Papy</p>
                </div>
            </div>

            <!-- Carte 3 -->
            <div class="col-12 col-sm-6 col-md-4">
                <div class="card custom-add border-0 rounded-3 shadow p-3 text-center">
                    <img src="/asset/img/cropped-ben.jpeg" class="mx-auto mb-3" alt="Nom du membre"
                        style="width:200px; height:200px; object-fit:cover; border-radius:50%;">
                    <p class="field-text mb-1">Ben</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once('../../templates/footer.php'); ?>