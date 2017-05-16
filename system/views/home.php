<div class="page-title">
    <div>
        <h1><img src="assets/img/cats.jpg"/></h1>
         
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        <div class="box">
            <div class="box-content">
                <div class="toolbar pull-right clearfix">
                    <form method="post">
                        <select name="tahun" style="width: 200px" onchange="this.form.submit();">
                            <?php
                            for ($t = date('Y'); $t > (date('Y') - 5); $t--) {
                                if ($t == $tahun) {
                                    echo "<option value='$t' selected=''>$t</option>";
                                } else {
                                    echo "<option value='$t'>$t</option>";
                                }
                            }
                            ?>
                        </select>
                    </form>
                </div>
                <div class="clearfix"></div>
                <div id="chart"></div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url() ?>assets/js/chart/highcharts.js"></script>
<script src="<?= base_url() ?>assets/js/chart/modules/exporting.js"></script>
<script>
                    $(function() {
                        $('#chart').highcharts({
                            title: {
                                text: 'Statistik Data Barang <?= $tahun ?>',
                                x: -20
                            },
                            subtitle: {
                                text: '',
                                x: -20
                            },
                            xAxis: {
                                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                            },
                            yAxis: {
                                title: {
                                    text: 'Saldo'
                                },
                                plotLines: [{
                                        value: 0,
                                        width: 1,
                                        color: '#808080'
                                    }]
                            },
                            tooltip: {
                                headerFormat: '<b>{point.key}</b><br>',
                                pointFormat: '{series.name}: {point.y}'
                            },
                            credits: {
                                enabled: false
                            },
                            series: [{type: 'line',
                                    name: 'Pemasukan',
                                    data: [<?php
                            foreach ($debit->result_array() as $v) {
                                $data[$v['bulan']] = $v['debit'];
                            }
                            for ($i = 1; $i <= 12; $i++) {
                                if (isset($data[$i])) {
                                    echo "$data[$i]";
                                } else {
                                    echo "0";
                                }
                                if ($i < 12) {
                                    echo ',';
                                }
                            }
                            ?>]
                                }, {type: 'line',
                                    name: 'Pengeluaran',
                                    data: [<?php
                            foreach ($kredit->result_array() as $v) {
                                $data[$v['bulan']] = $v['kredit'];
                            }
                            for ($i = 1; $i <= 12; $i++) {
                                if (isset($data[$i])) {
                                    echo "$data[$i]";
                                } else {
                                    echo "0";
                                }
                                if ($i < 12) {
                                    echo ',';
                                }
                            }
                            ?>]
                                }, ]
                        });
                    });
</script>