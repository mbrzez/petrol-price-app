import React from 'react';

class PetrolPriceTable extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            sorting: {
                column: 'index',
                type: 'asc'
            }
        };

        this.updateSorting = this.updateSorting.bind(this);
    }

    addIndex(data) {
        return data.map((record, index) => {
            record['index'] = index + 1;
            return record;
        });
    }

    createTableRows(items) {
        return items.map((item) =>
            <tr key={item['index']}>
                <td>{!!(item['pb95']) ? item['pb95'].toFixed(2) : ''}</td>
                <td>{!!(item['pb98']) ? item['pb98'].toFixed(2) : ''}</td>
                <td>{!!(item['diesel']) ? item['diesel'].toFixed(2) : ''}</td>
                <td>{!!(item['lpg']) ? item['lpg'].toFixed(2) : ''}</td>
                <td>{item['created_at']}</td>
            </tr>
        );
    }

    sort(data, sorting) {
        const {type, column} = sorting;

        if (type === 'asc') {
            return data.sort((a, b) => (a[column] > b[column] ? 1 : -1));
        } else {
            return data.sort((a, b) => (a[column] < b[column] ? 1 : -1));
        }
    }

    updateSorting(column) {
        let type = 'asc';
        const sorting = this.state.sorting;

        if (sorting.column === column) {
            if (sorting.type === 'asc') {
                type = 'desc';
            }
        }

        this.setState({
            sorting: {
                column: column,
                type: type
            },
        })
    }

    render() {
        const indexedData = this.addIndex(this.props.tableData);
        const sortedData = this.sort(indexedData, this.state.sorting);
        const tableRows = this.createTableRows(sortedData);

        return (
            <table className="table is-hoverable is-fullwidth">
                <thead>
                    <tr>
                        <td onClick={() => this.updateSorting('pb95')}><abbr title="Pb 95">Pb 95</abbr></td>
                        <td onClick={() => this.updateSorting('pb98')}><abbr title="Pb 98">Pb 98</abbr></td>
                        <td onClick={() => this.updateSorting('diesel')}><abbr title="Diesel">Diesel</abbr></td>
                        <td onClick={() => this.updateSorting('lpg')}><abbr title="LPG">LPG</abbr></td>
                        <td onClick={() => this.updateSorting('created_at')}><abbr title="Datetime">Date time</abbr></td>
                    </tr>
                </thead>
                {tableRows}
            </table>
        );
    }
}

export default PetrolPriceTable;