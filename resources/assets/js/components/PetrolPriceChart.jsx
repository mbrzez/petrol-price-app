import React from 'react';
import * as echarts from 'echarts';

import {echartOptions, seriesObject} from '../config/echart.options';
import {collectSeries,  combineSeriesWithDate} from '../utils/combine';


class PetrolPriceChart extends React.Component {
    constructor(props) {
        super(props);
    }

    componentDidUpdate() {
        const chartData = this.props.chartData;

        const series = collectSeries(chartData, ['created_at', 'pb95', 'pb98', 'diesel', 'lpg']);

        const xAxis = series['created_at'].map((value) => {
            return new Date(value);
        });

        const chartSeries = [
            seriesObject('PB 95', 'line', combineSeriesWithDate(xAxis, series['pb95'])),
            seriesObject('PB 98', 'line', combineSeriesWithDate(xAxis, series['pb98'])),
            seriesObject('Diesel', 'line', combineSeriesWithDate(xAxis, series['diesel'])),
            seriesObject('LPG', 'line', combineSeriesWithDate(xAxis, series['lpg']))
        ];

        const chart = echarts.init(document.getElementById('chart'));
        chart.setOption(echartOptions(xAxis, chartSeries));
    }

    render() {
        return (
            <div>
                <h3 className="title is-4 has-text-centered">
                    Petrol station {this.props.stationName}
                </h3>
                <div id="chart" className="chart-style"></div>
            </div>
        );
    }
}

export default PetrolPriceChart;