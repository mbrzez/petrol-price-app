import React from 'react';
import SelectOptions from './SelectOptions.jsx';
import Checkbox from './Checkbox.jsx';

import * as config from '../config/app.options';


class PetrolForm extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        return (
            <form>
                <div className="field">
                    <div className="field">
                        <label className="label">Petrol stations</label>
                        <div className="select">
                            <SelectOptions name="stationId" items={config.petrolStations}
                                           selectedValue={this.props.stationId}
                                           onSelectChange={this.props.handleSelectChange} />
                        </div>
                    </div>
                    <div className="field">
                        <label className="label">Period</label>
                        <div className="select">
                            <SelectOptions name="periodInDays" items={config.periods}
                                           selectedValue={this.props.periodInDays}
                                           onSelectChange={this.props.handleSelectChange} />
                        </div>
                    </div>
                    <div className="field">
                        <label className="checkbox">
                            <Checkbox name="showTable" isChecked={this.props.showTable}
                                      onCheckboxChange={this.props.handleCheckboxChange} />
                            Show petrol price table
                        </label>
                    </div>
                    <div className="field">
                        <input className="button is-info" type="button" value="Load data"
                               onClick={this.props.handleFormSubmit} />
                    </div>
                </div>
            </form>
        );
    }
}

export default PetrolForm;