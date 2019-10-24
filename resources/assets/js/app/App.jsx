import React from 'react';
import PetrolForm from '../components/PetrolForm.jsx';
import PetrolPriceChart from '../components/PetrolPriceChart.jsx';
import PetrolPriceTable from '../components/PetrolPriceTable.jsx';
import * as config from '../config/app.options';
import axios from 'axios';

class App extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            form: {
                stationId: 2001,
                periodInDays: 7,
                showTable: true
            },
            petrolPricesData: [],
        };

        this.handleCheckboxChange = this.handleCheckboxChange.bind(this);
        this.handleSelectChange = this.handleSelectChange.bind(this);
        this.handleFormSubmit = this.handleFormSubmit.bind(this);
    }

    handleSelectChange(e) {
        let value = e.target.value;

        if (!isNaN(e.target.value)) {
            value = Number(e.target.value);
        }

        this.setState({
            form: {
                ...this.state.form,
                [e.target.name]: value
            }
        });
    }


    handleCheckboxChange(e) {
        this.setState({
            form: {
                ...this.state.form,
                [e.target.name]: e.target.checked
            }
        });
    }

    handleFormSubmit() {
        this.callPetrolPriceService();
    }

    componentDidMount() {
        this.callPetrolPriceService();
    }

    callPetrolPriceService() {
        let url = config.getPetrolPriceServiceUrl
            .replace('{extId}', this.state.form.stationId)
            .replace('{maxResults}', this.state.form.periodInDays * 2);

        axios.get(url).then(response => {
            this.setState({
                petrolPricesData: response.data
            })
        });
    }

    render() {
        const formData = this.state.form;
        const petrolPricesData = this.state.petrolPricesData;
        const stationName = config.petrolStations.find(element =>
            element.value === this.state.form.stationId
        ).desc;

        const eventHandlers = {
            handleSelectChange: this.handleSelectChange,
            handleCheckboxChange: this.handleCheckboxChange,
            handleFormSubmit: this.handleFormSubmit
        };

        return (
            <section className="section">
                <div className="container">
                    <div className="columns">
                        <div className="column is-one-third">
                            <h1 className="title"><i className="fas fa-gas-pump"></i>&nbsp;Petrol Price App</h1>
                            <p className="subtitle">Petrol prices on Auchan stations</p>
                            <PetrolForm {...formData} {...eventHandlers} />
                        </div>
                        <div className="column">
                            <PetrolPriceChart stationName={stationName} chartData={petrolPricesData}/>
                        </div>
                    </div>
                    <div className="table-container">
                        { this.state.form.showTable &&
                            <PetrolPriceTable tableData={petrolPricesData}/>
                        }
                    </div>
                </div>
            </section>
        )
    }
}

export default App;