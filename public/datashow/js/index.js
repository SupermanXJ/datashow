$(function () {

    DS.api({
        url: '/home/api_getCovids'
    }).done((covids) => {
        const data = {
            title: {
                text: '上海近期疫情'
            },
            subtitle: {
                text: '数据来源于国家和省市卫健委'
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: {
                    month: '%y-%m-%d'
                },
            },
            yAxis: {
                title: {
                    text: '新增无症状'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            tooltip: {
                xDateFormat: '%Y-%m-%d',
                shared: true
            },
            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    },
                    pointStart: Date.UTC(2022, 1, 1),
                    pointInterval: 24 * 3600 * 1000 // one day
                }
            },
            series: covids,
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        };

        const chart1 = Highcharts.chart('container1', data);
    });


    DS.api({
        url: '/home/api_getPops'
    }).done((pops) => {
        const data = {
            title: {
                text: '上海常住人口'
            },
            subtitle: {
                text: '数据来源于国家统计局'
            },
            yAxis: {
                title: {
                    text: '常住人口'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    },
                    pointStart: 1978
                }
            },
            series: pops,
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        };

        const chart1 = Highcharts.chart('container2', data);
    });



});