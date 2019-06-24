import React from 'react';
import * as echarts from 'echarts';


class PetrolPriceChart extends React.Component {
    constructor(props) {
        super(props);
    }

    componentDidUpdate() {
        const chartData = this.props.data;
        const reversedChartData = chartData.reverse();

        const chartsHandle = echarts.init(document.getElementById('chart'));

        const collectSeries = (data, names) => {
            let obj = {};

            names.forEach((name) => {
                obj[name] = [];
            });

            data.map((row) => {
                names.forEach((name) => {
                    obj[name].push(row[name]);
                });
            });

            return obj;
        };

        const series = collectSeries(reversedChartData, ['created_at', 'pb95', 'pb98', 'diesel', 'lpg']);


        const xAxis = series['created_at'].map((value) => {
            return new Date(value);
        });

        const combineSeries = (time, values) => {
            let combined = [];

            const len = time.length;

            for (let i = 0; i < len; i++) {
                combined.push([time[i], values[i]]);
            }

            console.log(combined);
            return combined;
        };

        const options = {
            xAxis: {
                type: 'time',
                data: xAxis
            },
            yAxis: {
                type: 'value',
                splitNumber: 10,
                min: 1.5,
                max: 6
            },
            series: [{
                name: 'PB 95',
                type: 'line',
                data: combineSeries(xAxis, series['pb95'])
            }, {
                name: 'PB 98',
                type: 'line',
                data: combineSeries(xAxis, series['pb98'])
            }, {
                name: 'Diesel',
                type: 'line',
                data: combineSeries(xAxis, series['diesel'])
            }, {
                name: 'LPG',
                type: 'line',
                data: combineSeries(xAxis, series['lpg'])
            }],
            legend: {
                type: 'plain'
            },
            tooltip: {
                show: true
            }
        };

        chartsHandle.setOption(options);
    }

    render() {
        const chartStyle = {
            minWidth: '400px',
            width: '100%',
            minHeight: '400px',
            height: '100%'
        };

        return (
            <div>
                <div id="chart" style={chartStyle}></div>
            </div>
        );
    }
}

export default PetrolPriceChart;