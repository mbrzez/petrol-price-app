import React from 'react';

class SelectOptions extends React.Component {
    constructor(props) {
        super(props);

        this.handleSelectChange = this.handleSelectChange.bind(this);
    }

    createOptionItems(items) {
        return items.map((item) =>
            <option key={item.value.toString()} value={item.value} selected={item.value === this.props.selectedValue}>
                {item.desc.toString()}
            </option>
        );
    }

    handleSelectChange(e) {
        this.props.onSelectChange(e);
    }

    render() {
        const optionElements = this.createOptionItems(this.props.items);

        return (
            <select className="select is-multiple" name={this.props.name} onChange={this.handleSelectChange}>
                {optionElements}
            </select>
        );
    }
}

export default SelectOptions;