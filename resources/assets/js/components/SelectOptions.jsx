import React from 'react';

class SelectOptions extends React.Component {
    constructor(props) {
        super(props);

        this.createOptionItems = this.createOptionItems.bind(this);
        this.handleChange = this.handleChange.bind(this);
    }

    createOptionItems(items) {
        return items.map((item) =>
            <option key={item.value.toString()} value={item.value}>
                {item.desc.toString()}
            </option>
        );
    }

    handleChange(e) {
        this.props.onSelectChange(e);
    }

    render() {
        const listItems = this.createOptionItems(this.props.items);

        return (
            <select className="select is-multiple" name={this.props.name} multiple={this.props.multiple} onChange={this.handleChange}>
                {listItems}
            </select>
        );
    }
}

export default SelectOptions;