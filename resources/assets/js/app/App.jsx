import React from 'react';
import PetrolForm from "../components/PetrolForm.jsx";
import PetrolPriceChart from "../components/PetrolPriceChart.jsx";
import PetrolPriceTable from "../components/PetrolPriceTable.jsx";

class App extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            stationName: '',
            chartData: [],
            tableData: []
        };

        this.updateAfterFormSubmit = this.updateAfterFormSubmit.bind(this);
    }

    updateAfterFormSubmit(stationName, chartData, tableData, ) {
        this.setState({
            stationName: stationName,
            chartData: chartData,
            tableData: tableData
        });
    }

    render() {
        const stationName = this.state.stationName;
        const chartData = this.state.chartData;
        const tableData = this.state.tableData;

        return (
            <section className="section">
                <div className="container">
                    <div className="columns">
                        <div className="column is-4">
                            <h1 className="title">Petrol Price App</h1>
                            <p className="subtitle">Petrol prices on Auchan stations</p>
                            <PetrolForm onSubmitForm={this.updateAfterFormSubmit} />
                        </div>
                        <div className="column is-8">
                            <PetrolPriceChart stationName={stationName} data={chartData}/>
                        </div>
                    </div>
                    <div className="columns">
                        <div className="column">
                            <PetrolPriceTable data={tableData} />
                        </div>
                    </div>
                </div>
            </section>
        )
    }
}

export default App;