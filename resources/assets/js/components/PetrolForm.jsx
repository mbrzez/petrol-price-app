import React from "react";
import SelectOptions from "./SelectOptions.jsx";
import axios from 'axios';

import * as config from "../config/app.options";

class PetrolForm extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            station: 27,
            period: '-d',
            showTable: false
        };

        this.handleCheckboxChange = this.handleCheckboxChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleSelectChange = this.handleSelectChange.bind(this);
    }

    handleCheckboxChange(e) {
        const value = e.target.checked;
        const name = e.target.name;

        this.setState({
            [name]: value
        });
    }

    handleSelectChange(e) {
        const name = e.target.name;
        const value = e.target.value;
        const multiple = e.target.multiple;

        if (multiple === true) {
            const options = e.target.selectedOptions;
            const values = Array.from(options).map(option => option.value);

            this.setState({
                [name]: values
            });
        } else {
            this.setState({
                [name]: value
            });
        }
    }

    handleSubmit(e) {
        e.preventDefault();

        let url = config.getPetrolPriceServiceUrl;
        url = url.replace('{id}', this.state.station);

        axios.get(url).then(res => {
            let stationName = config.petrolStations.find(row => row.value == this.state.station).desc;
            this.props.onSubmitForm(stationName, res.data, res.data);
        });
    }

    render() {
        return (
            <form onSubmit={this.handleSubmit}>
                <div className="field">
                    <div className="field">
                        <label className="label">Petrol stations</label>
                        <div className="select">
                            <SelectOptions name="station" multiple={false} items={config.petrolStations} onSelectChange={this.handleSelectChange} />
                        </div>
                    </div>
                    <div className="field">
                        <label className="label">Period</label>
                        <div className="select">
                            <SelectOptions name="period" multiple={false} items={config.periods} onSelectChange={this.handleSelectChange} />
                        </div>
                    </div>
                    <div className="field">
                        <label className="checkbox">
                            <input name="showTable" type="checkbox" onChange={this.handleCheckboxChange} />
                            Show petrol price table
                        </label>
                    </div>
                    <div className="field">
                        <input className="button is-info" type="submit" value="Load data" />
                    </div>
                </div>
            </form>
        );
    }
}

export default PetrolForm;