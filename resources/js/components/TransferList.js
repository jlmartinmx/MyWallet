import React from 'react'

// aqui se pasa el prop llamado transfers q es un arreglo de objs transfer.
// ver abajo como determinamos en base al valor de amount q clase usar para esa celda.
// la funcion map() de react siempre necesita el 'key'.
const TransferList = ({transfers}) => (
    <table className="table">
        <tbody>

            { transfers.map((transfer) => (
                <tr key={transfer.id}>
                    <td>{transfer.id}</td>
                    <td>{transfer.description}</td>
                    <td className={transfer.amount > 0 ? 'text-success' : 'text-danger'}>{transfer.amount}</td>
                </tr>                                                                            
            ))}
            
        </tbody>
    </table>
)

export default TransferList