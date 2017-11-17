@extends('layouts.layout')

@section('main-content')
    <div id="about">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                    <div class="about-heading">
                        <h2>Laboratorio</h2>
                        </br>
                        <h3>Lista de precios</h3>
                      </br>
                      <table>
                      	<tbody>
                      		<tr>
                      			<td>BACTERIOSCOPIA Y CULTIVO BACTERIANO </td>
                      			<td>FUNGOSCOPIA Y CULTIVO MICOLÓGICO </td>
                      			<td>BAR</br>(baciloscopia) </td>
                      			<td>ANTIBIOGRAMA </td>
                      			<td>CULTIVO TUBERCULOSIS </td>
                      			<td>IDENTIFICACIÓN BACTERIANA Y DE LEVADURAS </br>(GALERÍA API) </td>
                      		</tr>
                      		<tr>
                      			<td>16€ </td>
                      			<td>16€ </td>
                      			<td>10€ </td>
                      			<td>16€ </td>
                      			<td>20€ </td>
                      			<td>20€ </td>
                      		</tr>
                          <tr>
                      			<td>IDENTIFICACIÓN HONGOS FILAMENTOSOS </td>
                      			<td>IDENTIFICACIÓN MYCOBACTERIAS </td>
                      			<td>ELABORACIÓN BACTERINA </td>
                      			<td>SEROLOGÍA ELISA </td>
                      			<td>CULTIVO ANIMAL DE NECROPSIA </td>
                      			<td>DESCUENTO POR MUESTRAS MÚLTIPLES </td>
                      		</tr>
                      		<tr>
                      			<td>20€ </td>
                      			<td>30€ </td>
                      			<td>48€(100ml) </td>
                      			<td>12€/animal </td>
                      			<td>30€ </td>
                        		<td>20% </td>
                      		</tr>
                      	</tbody>
                      </table>
                      </br>
                      </br>
                      <h3>Impresos</h3>
                      <div id="impr">
                        </br>
                        <a href="/files/Datos de alta para el servicio.pdf" download="/files/Datos de alta para el servicio.pdf" target="_blank">
                          Datos de alta para el servicio
                        </a>
                        </br>
                        </br>
                        <a href="/files/Datos del servicio e identificación Fundación Universitaria de Las Palmas.pdf" download="/files/Datos del servicio e identificación Fundación Universitaria de Las Palmas.pdf" target="_blank">
                          Datos del servicio e identificación Fundación Universitaria de Las Palmas
                        </a>
                        </br>
                        </br>
                        <a href="/files/Modelo solicitud de servicio.pdf" download="/files/Modelo solicitud de servicio.pdf" target="_blank">
                          Modelo solicitud de servicio
                        </a>
                        </br>
                        </br>
                        <a href="/files/Recogida de la muestra.pdf" download="/files/Recogida de la muestra.pdf" target="_blank">
                          Recogida de la muestra
                        </a>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
@stop
