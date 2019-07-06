import React from 'react';

class Checkbox extends React.Component {
    constructor(props) {
        super(props);

        this.toggleCheckboxChange = this.toggleCheckboxChange.bind(this);
    }

    toggleCheckboxChange(e) {
        this.props.onCheckboxChange(e);
    }

    render() {
        return (
            <input type="checkbox"
                   name={this.props.name}
                   checked={this.props.isChecked}
                   onChange={this.toggleCheckboxChange} />
        );
    }
}

export default Checkbox;