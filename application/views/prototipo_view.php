<?php $this->load->view('head/headers'); ?>
<?php $this->load->view('head/nav'); ?>

<meta charset="utf-8">

<!--hoja de estilos para los procesos.-->
<link rel="stylesheet" href="/ProyectoMerlin/assets/css/style_prototipos.css" type="text/css">
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/2.7.94/css/materialdesignicons.min.css">

<div id="container" style="width: 100%; padding: 1%;">
    <h4>
        <p class="text-center">
            Prototipado para el proceso <?php echo($proceso->nombre);?>
        </p>
    </h4>
    <div id="prototipo_container">
        <div class="left-bar">
            <div class="text-center">
                <span class="mdi mdi-checkbox-blank-circle-outline" style="font-size: 2.5em;">
                </span>
            </div>
            <div class="text-center">
                <span class="mdi mdi-border-all-variant" style="font-size: 2.5em;">
                </span>
            </div>
            <div class="text-center">
                <span class="mdi mdi-image" style="font-size: 2.5em;">
                </span>
            </div>
            <div class="text-center">
                <span class="mdi mdi-table" style="font-size: 2.5em;">
                </span>
            </div>
            <div class="text-center">
                <span class="mdi mdi-pencil" style="font-size: 2.5em;">
                </span>
            </div>
            <div class="text-center">
                <span class="mdi mdi-chart-pie" style="font-size: 2.5em;">
                </span>
            </div>
        </div>
    </div>
</div>