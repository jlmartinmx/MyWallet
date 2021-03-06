
import React from 'react';
import ReactDOM from 'react-dom';
import TransferForm from './TransferForm';
import TransferList from './TransferList';

// para poder uso de los estados del componente se debe declarar como clase, ver Example.js
function Example() {
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-12 m-t-md"><p className="title">$ 1000</p></div>
                                    
                <div className="col-md-12">
                    <TransferForm />
                </div>

            </div>
            
            <div className="m-t-md">
                <TransferList />
            </div>
        </div>
    );
}

export default Example;

if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}

