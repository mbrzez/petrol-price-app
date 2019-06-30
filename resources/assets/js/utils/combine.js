const collectSeries = (data, names) => {
    let obj = {};

    names.forEach((name) => {
        obj[name] = [];
    });

    data.map((row) => {
        names.forEach((name) => {
            let value = row[name];

            if (!isNaN(value)) {
                value = Number(value).toFixed(2);
            }

            obj[name].push(value);
        });
    });

    return obj;
};

const combineSeriesWithDate = (time, values) => {
    let combined = [];

    const len = time.length;

    for (let i = 0; i < len; i++) {
        combined.push([time[i], values[i]]);
    }

    return combined;
};

export {collectSeries, combineSeriesWithDate}