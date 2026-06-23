<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>

<!-- Highcharts -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<style>
    .dashboard-container {
        padding: 20px;
    }
    .dashboard-container .section-title {
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
        margin: 25px 0 15px 0;
        padding-bottom: 10px;
        border-bottom: 2px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .dashboard-container .section-title i {
        font-size: 20px;
        color: #2563eb;
    }
    .dashboard-container .kpi-row {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 20px;
    }
    .dashboard-container .kpi-card {
        flex: 1;
        min-width: 180px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 18px 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        transition: all 0.2s;
    }
    .dashboard-container .kpi-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }
    .dashboard-container .kpi-card .kpi-label {
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        margin-bottom: 6px;
    }
    .dashboard-container .kpi-card .kpi-value {
        font-size: 26px;
        font-weight: 800;
        color: #1e293b;
    }
    .dashboard-container .kpi-card .kpi-sub {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 4px;
    }
    .dashboard-container .kpi-card.ventas {
        border-left: 4px solid #2563eb;
    }
    .dashboard-container .kpi-card.compras {
        border-left: 4px solid #059669;
    }
    .dashboard-container .kpi-card.gastos {
        border-left: 4px solid #dc2626;
    }
    .dashboard-container .chart-row {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 25px;
    }
    .dashboard-container .chart-box {
        flex: 1;
        min-width: 350px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 15px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
    }
    .dashboard-container .chart-box .chart-title {
        font-size: 14px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 10px;
        padding-bottom: 8px;
        border-bottom: 1px solid #f1f5f9;
    }
    .dashboard-container .chart-box .chart-container {
        height: 300px;
    }
    @media (max-width: 768px) {
        .dashboard-container .kpi-card { min-width: 140px; }
        .dashboard-container .chart-box { min-width: 280px; }
    }
</style>

<div class="dashboard-container">

    <!-- ==================== VENTAS ==================== -->
    <div class="section-title">
        <i class="fa fa-shopping-cart"></i> Área de Ventas
    </div>

    <!-- KPI Ventas -->
    <div class="kpi-row">
        <?php
            $total_diario = 0;
            $cant_diario = 0;
            foreach($ventas_diarias as $v){
                $total_diario += $v['total'];
                $cant_diario += $v['cantidad'];
            }
            $total_semanal = 0;
            $cant_semanal = 0;
            foreach($ventas_semanales as $v){
                $total_semanal += $v['total'];
                $cant_semanal += $v['cantidad'];
            }
            $total_mensual = 0;
            $cant_mensual = 0;
            foreach($ventas_mensuales as $v){
                $total_mensual += $v['total'];
                $cant_mensual += $v['cantidad'];
            }
        ?>
        <div class="kpi-card ventas">
            <div class="kpi-label">Ventas Diarias (7 días)</div>
            <div class="kpi-value">S/ <?= number_format($total_diario, 2) ?></div>
            <div class="kpi-sub"><?= $cant_diario ?> transacciones</div>
        </div>
        <div class="kpi-card ventas">
            <div class="kpi-label">Ventas Semanales (8 sem.)</div>
            <div class="kpi-value">S/ <?= number_format($total_semanal, 2) ?></div>
            <div class="kpi-sub"><?= $cant_semanal ?> transacciones</div>
        </div>
        <div class="kpi-card ventas">
            <div class="kpi-label">Ventas Mensuales (6 meses)</div>
            <div class="kpi-value">S/ <?= number_format($total_mensual, 2) ?></div>
            <div class="kpi-sub"><?= $cant_mensual ?> transacciones</div>
        </div>
    </div>

    <!-- Charts Ventas -->
    <div class="chart-row">
        <div class="chart-box">
            <div class="chart-title"><i class="fa fa-bar-chart" style="color:#2563eb"></i> Ventas Diarias (Últimos 7 días)</div>
            <div class="chart-container" id="chart-ventas-diarias"></div>
        </div>
        <div class="chart-box">
            <div class="chart-title"><i class="fa fa-bar-chart" style="color:#2563eb"></i> Ventas Semanales (Últimas 8 semanas)</div>
            <div class="chart-container" id="chart-ventas-semanales"></div>
        </div>
    </div>
    <div class="chart-row">
        <div class="chart-box">
            <div class="chart-title"><i class="fa fa-bar-chart" style="color:#2563eb"></i> Ventas Mensuales (Últimos 6 meses)</div>
            <div class="chart-container" id="chart-ventas-mensuales"></div>
        </div>
    </div>

    <!-- ==================== COMPRAS ==================== -->
    <div class="section-title">
        <i class="fa fa-truck"></i> Área de Compras
    </div>

    <!-- KPI Compras -->
    <div class="kpi-row">
        <?php
            $total_comp_semanal = 0;
            $cant_comp_semanal = 0;
            foreach($compras_semanales as $v){
                $total_comp_semanal += $v['total'];
                $cant_comp_semanal += $v['cantidad'];
            }
            $total_comp_mensual = 0;
            $cant_comp_mensual = 0;
            foreach($compras_mensuales as $v){
                $total_comp_mensual += $v['total'];
                $cant_comp_mensual += $v['cantidad'];
            }
        ?>
        <div class="kpi-card compras">
            <div class="kpi-label">Compras Semanales (8 sem.)</div>
            <div class="kpi-value">S/ <?= number_format($total_comp_semanal, 2) ?></div>
            <div class="kpi-sub"><?= $cant_comp_semanal ?> compras</div>
        </div>
        <div class="kpi-card compras">
            <div class="kpi-label">Compras Mensuales (6 meses)</div>
            <div class="kpi-value">S/ <?= number_format($total_comp_mensual, 2) ?></div>
            <div class="kpi-sub"><?= $cant_comp_mensual ?> compras</div>
        </div>
    </div>

    <!-- Charts Compras -->
    <div class="chart-row">
        <div class="chart-box">
            <div class="chart-title"><i class="fa fa-bar-chart" style="color:#059669"></i> Compras Semanales (Últimas 8 semanas)</div>
            <div class="chart-container" id="chart-compras-semanales"></div>
        </div>
        <div class="chart-box">
            <div class="chart-title"><i class="fa fa-bar-chart" style="color:#059669"></i> Compras Mensuales (Últimos 6 meses)</div>
            <div class="chart-container" id="chart-compras-mensuales"></div>
        </div>
    </div>

    <!-- ==================== GASTOS ==================== -->
    <div class="section-title">
        <i class="fa fa-money"></i> Área de Gastos
    </div>

    <!-- KPI Gastos -->
    <div class="kpi-row">
        <?php
            $total_gas_semanal = 0;
            $cant_gas_semanal = 0;
            foreach($gastos_semanales as $v){
                $total_gas_semanal += $v['total'];
                $cant_gas_semanal += $v['cantidad'];
            }
            $total_gas_mensual = 0;
            $cant_gas_mensual = 0;
            foreach($gastos_mensuales as $v){
                $total_gas_mensual += $v['total'];
                $cant_gas_mensual += $v['cantidad'];
            }
        ?>
        <div class="kpi-card gastos">
            <div class="kpi-label">Gastos Semanales (8 sem.)</div>
            <div class="kpi-value">S/ <?= number_format($total_gas_semanal, 2) ?></div>
            <div class="kpi-sub"><?= $cant_gas_semanal ?> gastos</div>
        </div>
        <div class="kpi-card gastos">
            <div class="kpi-label">Gastos Mensuales (6 meses)</div>
            <div class="kpi-value">S/ <?= number_format($total_gas_mensual, 2) ?></div>
            <div class="kpi-sub"><?= $cant_gas_mensual ?> gastos</div>
        </div>
    </div>

    <!-- Charts Gastos -->
    <div class="chart-row">
        <div class="chart-box">
            <div class="chart-title"><i class="fa fa-bar-chart" style="color:#dc2626"></i> Gastos Semanales (Últimas 8 semanas)</div>
            <div class="chart-container" id="chart-gastos-semanales"></div>
        </div>
        <div class="chart-box">
            <div class="chart-title"><i class="fa fa-bar-chart" style="color:#dc2626"></i> Gastos Mensuales (Últimos 6 meses)</div>
            <div class="chart-container" id="chart-gastos-mensuales"></div>
        </div>
    </div>

</div>

<script type="text/javascript">
$(document).ready(function() {

    // ============================================================
    // VENTAS DIARIAS
    // ============================================================
    var ventasDiarias = <?= json_encode($ventas_diarias) ?>;
    var catVD = [], dataVD = [], dataVDCant = [];
    $.each(ventasDiarias, function(i, v){
        catVD.push(v.fecha);
        dataVD.push(parseFloat(v.total));
        dataVDCant.push(parseInt(v.cantidad));
    });
    Highcharts.chart('chart-ventas-diarias', {
        chart: { type: 'column', backgroundColor: 'transparent' },
        title: { text: null },
        xAxis: { categories: catVD, labels: { rotation: -45, style: { fontSize: '11px' } } },
        yAxis: [{ title: { text: 'Monto (S/)' }, labels: { format: 'S/{value}' } }],
        tooltip: { shared: true, valuePrefix: 'S/' },
        plotOptions: { column: { borderRadius: 4, dataLabels: { enabled: true, format: 'S/{point.y:.2f}', style: { fontSize: '10px' } } } },
        series: [
            { name: 'Total S/', type: 'column', data: dataVD, color: '#2563eb' }
        ],
        credits: { enabled: false }
    });

    // ============================================================
    // VENTAS SEMANALES
    // ============================================================
    var ventasSemanales = <?= json_encode($ventas_semanales) ?>;
    var catVS = [], dataVS = [], dataVSCant = [];
    $.each(ventasSemanales, function(i, v){
        catVS.push(v.semana);
        dataVS.push(parseFloat(v.total));
        dataVSCant.push(parseInt(v.cantidad));
    });
    Highcharts.chart('chart-ventas-semanales', {
        chart: { type: 'column', backgroundColor: 'transparent' },
        title: { text: null },
        xAxis: { categories: catVS, labels: { rotation: -45, style: { fontSize: '11px' } } },
        yAxis: [{ title: { text: 'Monto (S/)' }, labels: { format: 'S/{value}' } }],
        tooltip: { shared: true, valuePrefix: 'S/' },
        plotOptions: { column: { borderRadius: 4, dataLabels: { enabled: true, format: 'S/{point.y:.2f}', style: { fontSize: '10px' } } } },
        series: [
            { name: 'Total S/', type: 'column', data: dataVS, color: '#3b82f6' }
        ],
        credits: { enabled: false }
    });

    // ============================================================
    // VENTAS MENSUALES
    // ============================================================
    var ventasMensuales = <?= json_encode($ventas_mensuales) ?>;
    var catVM = [], dataVM = [], dataVMCant = [];
    $.each(ventasMensuales, function(i, v){
        catVM.push(v.mes);
        dataVM.push(parseFloat(v.total));
        dataVMCant.push(parseInt(v.cantidad));
    });
    Highcharts.chart('chart-ventas-mensuales', {
        chart: { type: 'column', backgroundColor: 'transparent' },
        title: { text: null },
        xAxis: { categories: catVM, labels: { rotation: -45, style: { fontSize: '11px' } } },
        yAxis: [{ title: { text: 'Monto (S/)' }, labels: { format: 'S/{value}' } }],
        tooltip: { shared: true, valuePrefix: 'S/' },
        plotOptions: { column: { borderRadius: 4, dataLabels: { enabled: true, format: 'S/{point.y:.2f}', style: { fontSize: '10px' } } } },
        series: [
            { name: 'Total S/', type: 'column', data: dataVM, color: '#60a5fa' }
        ],
        credits: { enabled: false }
    });

    // ============================================================
    // COMPRAS SEMANALES
    // ============================================================
    var comprasSemanales = <?= json_encode($compras_semanales) ?>;
    var catCS = [], dataCS = [], dataCSCant = [];
    $.each(comprasSemanales, function(i, v){
        catCS.push(v.semana);
        dataCS.push(parseFloat(v.total));
        dataCSCant.push(parseInt(v.cantidad));
    });
    Highcharts.chart('chart-compras-semanales', {
        chart: { type: 'column', backgroundColor: 'transparent' },
        title: { text: null },
        xAxis: { categories: catCS, labels: { rotation: -45, style: { fontSize: '11px' } } },
        yAxis: [{ title: { text: 'Monto (S/)' }, labels: { format: 'S/{value}' } }],
        tooltip: { shared: true, valuePrefix: 'S/' },
        plotOptions: { column: { borderRadius: 4, dataLabels: { enabled: true, format: 'S/{point.y:.2f}', style: { fontSize: '10px' } } } },
        series: [
            { name: 'Total S/', type: 'column', data: dataCS, color: '#059669' }
        ],
        credits: { enabled: false }
    });

    // ============================================================
    // COMPRAS MENSUALES
    // ============================================================
    var comprasMensuales = <?= json_encode($compras_mensuales) ?>;
    var catCM = [], dataCM = [], dataCMCant = [];
    $.each(comprasMensuales, function(i, v){
        catCM.push(v.mes);
        dataCM.push(parseFloat(v.total));
        dataCMCant.push(parseInt(v.cantidad));
    });
    Highcharts.chart('chart-compras-mensuales', {
        chart: { type: 'column', backgroundColor: 'transparent' },
        title: { text: null },
        xAxis: { categories: catCM, labels: { rotation: -45, style: { fontSize: '11px' } } },
        yAxis: [{ title: { text: 'Monto (S/)' }, labels: { format: 'S/{value}' } }],
        tooltip: { shared: true, valuePrefix: 'S/' },
        plotOptions: { column: { borderRadius: 4, dataLabels: { enabled: true, format: 'S/{point.y:.2f}', style: { fontSize: '10px' } } } },
        series: [
            { name: 'Total S/', type: 'column', data: dataCM, color: '#34d399' }
        ],
        credits: { enabled: false }
    });

    // ============================================================
    // GASTOS SEMANALES
    // ============================================================
    var gastosSemanales = <?= json_encode($gastos_semanales) ?>;
    var catGS = [], dataGS = [], dataGSCant = [];
    $.each(gastosSemanales, function(i, v){
        catGS.push(v.semana);
        dataGS.push(parseFloat(v.total));
        dataGSCant.push(parseInt(v.cantidad));
    });
    Highcharts.chart('chart-gastos-semanales', {
        chart: { type: 'column', backgroundColor: 'transparent' },
        title: { text: null },
        xAxis: { categories: catGS, labels: { rotation: -45, style: { fontSize: '11px' } } },
        yAxis: [{ title: { text: 'Monto (S/)' }, labels: { format: 'S/{value}' } }],
        tooltip: { shared: true, valuePrefix: 'S/' },
        plotOptions: { column: { borderRadius: 4, dataLabels: { enabled: true, format: 'S/{point.y:.2f}', style: { fontSize: '10px' } } } },
        series: [
            { name: 'Total S/', type: 'column', data: dataGS, color: '#dc2626' }
        ],
        credits: { enabled: false }
    });

    // ============================================================
    // GASTOS MENSUALES
    // ============================================================
    var gastosMensuales = <?= json_encode($gastos_mensuales) ?>;
    var catGM = [], dataGM = [], dataGMCant = [];
    $.each(gastosMensuales, function(i, v){
        catGM.push(v.mes);
        dataGM.push(parseFloat(v.total));
        dataGMCant.push(parseInt(v.cantidad));
    });
    Highcharts.chart('chart-gastos-mensuales', {
        chart: { type: 'column', backgroundColor: 'transparent' },
        title: { text: null },
        xAxis: { categories: catGM, labels: { rotation: -45, style: { fontSize: '11px' } } },
        yAxis: [{ title: { text: 'Monto (S/)' }, labels: { format: 'S/{value}' } }],
        tooltip: { shared: true, valuePrefix: 'S/' },
        plotOptions: { column: { borderRadius: 4, dataLabels: { enabled: true, format: 'S/{point.y:.2f}', style: { fontSize: '10px' } } } },
        series: [
            { name: 'Total S/', type: 'column', data: dataGM, color: '#f87171' }
        ],
        credits: { enabled: false }
    });

});
</script>
