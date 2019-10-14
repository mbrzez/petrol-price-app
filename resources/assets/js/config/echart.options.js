const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

export function seriesObject(name, type, data)  {
    return {
        name: name,
        type: type,
        data: data
    };
}

export function echartOptions(xAxis, series) {
    return {
        xAxis: {
            type: 'time',
            data: xAxis,
            axisLabel: {
                formatter: function (value) {
                    const date = new Date(value);
                    const texts = [months[(date.getMonth() + 1)], date.getDate()];

                    return texts.join('-');
                }
            }
        },
        yAxis: {
            type: 'value',
            splitNumber: 10,
            min: 1.5,
            max: 6
        },
        series: series,
        legend: {
            type: 'plain'
        },
        tooltip: {
            show: true
        }
    };
}