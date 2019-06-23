import React from 'react';

class PetrolPriceTable extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        console.log(this.props.data);

        return (
            <div>Table</div>
        );
    }
}

export default PetrolPriceTable;