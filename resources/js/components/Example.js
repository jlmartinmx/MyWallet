
import React,{Component} from 'react';
import ReactDOM from 'react-dom';
import TransferForm from './TransferForm';
import TransferList from './TransferList';
import url from '../url';

export default class Example extends Component{

    constructor(props){
        super(props)
        // recordar q los estados de un componente nos sirven para trabajar con los atributos
        // q cambiaran de valor.
        this.state = {
            money: 0.0,
            transfers: [],
            error: null,
            form: {
                description: '',
                amount: '',
                wallet_id: 1
            }
        }

        // haciendo los binds de los metodos para poderlos pasar a los componentes como props.        
        this.handleChange = this.handleChange.bind(this)
        this.handleSubmit = this.handleSubmit.bind(this)
    }// end constructor


    // metodo para manejar el submit del boton en la forma y como haremos una peticion al API para
    // salvar datos del formulario a la base el metodo debe ser 'async' con sus 'await.'
    async handleSubmit(e){
        e.preventDefault()
        console.log('enviando peticion al API...')
        try {
            // creando este obj para enviar peticion al API, en body se envian los datos.
            let config = {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(this.state.form)
            }
            let res = await fetch(`${url}/api/transfer`,config)
            let data = await res.json()

            // una vez salvados los datos del formulario x el API a la base procedemos
            // a actualizar el listado de transferencias ingresos/gastos q se encuentra bajo
            // el formulario y tambien actualizar el wallet sumando/restando dependiendo del tipo
            // de transferencia, con parseInt() convertimos un caracter a numero.
            this.setState({
                transfers: this.state.transfers.concat(data),
                money: this.state.money + (parseInt(data.amount))
            })

        } catch (error) {
            console.log('Se genero este error:')
            this.setState({error})
        }

    }

    // funcion q escucha eventos en los campos del formulario y esta funcion se pasa a los componentes
    // mediante un prop.
    handleChange(e){
        //console.log(e.target.value)
        // con este codigo cada vez q tecleemos en campo de formulario se almacena en campo correspondiente y
        // con ... endico q mantenga cada campo donde se ingreso informacion y no lo sobreescriba con otro campo.
        this.setState({
            form: {
                ...this.state.form,
                [e.target.name]: e.target.value
            }
        })
    }

    // haciendo una peticion al API x eso es 'async' y fetch() es una funcion nativa del browser.
    // esta funcion se ejecuta una vez montado el componente y como es una consulta al API debe 
    // ir dentro de un try-catcch.    
    async componentDidMount(){
        try {
            let res = await fetch(`${url}/api/wallet`)
            let data = await  res.json()

            // actualizando el estado de nuestras propiedades.
            this.setState({
                money: data.money,
                transfers: data.transfers
            })
        } catch (error) {
            this.setState({
                // aqui error es equivalente a poner 'error: error'.
                error
            })
        }
    }


    // abajo pasamos el prop llamado transfers al componente TrasferList  
    // q es un arreglo de objs transfer.
    render(){
        return(
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-12 m-t-md"><p className="title">$ {this.state.money}</p></div>
                                        
                    <div className="col-md-12">
                        <TransferForm 
                            form={this.state.form} 
                            onChange={this.handleChange} 
                            onSubmit={this.handleSubmit}    
                        />
                    </div>

                </div>
                
                <div className="m-t-md">
                    <TransferList 
                        transfers={this.state.transfers}
                    />
                </div>
            </div>
        );
    }
}

// aqui no colocamos el export default ...  x q se coloca arriba en la definicion de la clase.
if(document.getElementById('example')){
    ReactDOM.render(<Example />,document.getElementById('example'));
}