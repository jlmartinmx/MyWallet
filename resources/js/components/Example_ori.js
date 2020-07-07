
import React from 'react';
import ReactDOM from 'react-dom';

/* 
    OJO este ejemplo se crea cuando se corren los comandos para poder utilizar React dentro de laravel y se toma como plantilla
    para crear Example_ok.js donde hacemos algunas pruebas creando componentes react.
    En la definicion de este componente Example observamos q es del tipo funcion x lo q no podemos hacer uso de los estados del
    componente para resolver esto se debe declarar el componente como una clase como se muestra en Example.js.
*/ 
function Example() {
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">Example Component</div>

                        <div className="card-body">I'm an example component!. Esto fue creado con React.</div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Example;

if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
