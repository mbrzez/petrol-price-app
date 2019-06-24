import React from 'react';
import PetrolForm from "../components/PetrolForm.jsx";
import PetrolPriceChart from "../components/PetrolPriceChart.jsx";
import PetrolPriceTable from "../components/PetrolPriceTable.jsx";

class App extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            chartData: [],
            tableData: []
        };

        this.handleSubmitForm = this.handleSubmitForm.bind(this);
    }

    handleSubmitForm(chartData, tableData) {
        console.log('Chart data: ', chartData);
        console.log('Table data: ', tableData);

        this.setState({
            chartData: chartData,
            tableData: tableData
        });
    }

    render() {
        const chartData = this.state.chartData;
        const tableData = this.state.tableData;

        return (
            <section className="section">
                <div className="container">
                    <div className="columns">
                        <div className="column is-4">
                            <h1 className="title">Petrol Price App</h1>
                            <p className="subtitle">Petrol prices on Auchan stations</p>
                            <PetrolForm onSubmitForm={this.handleSubmitForm} />
                        </div>
                        <div className="column is-8">
                            <PetrolPriceChart data={chartData}/>
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