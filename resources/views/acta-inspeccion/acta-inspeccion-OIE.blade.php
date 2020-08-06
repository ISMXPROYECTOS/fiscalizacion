<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>INSPECCION 2019-2021</title>
	<link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.css') }}" />
	<style>
		body{
			font-family: Arial, Helvetica, sans-serif !important;
			max-width: 98%;
			display:block;
			margin:auto;
		}
		.page_break{
			page-break-after: always;
		}
	</style>
</head>
<body>
	@foreach($formavalorada->inspeccion as $inspeccion)
		<img src="{{ asset('img/header-orden-inspeccion-est.jpg') }}" width="100%" class="mb-3">
		<p class="mb-0 text-right">MUNICIPIO DE BENITO JUÁREZ</p>
		<p class="mb-0 text-right">TESORERÍA MUNICIPAL</p>
		<p class="mb-0 text-right">DIRECCIÓN DE FISCALIZACIÓN</p>
		<p class="mb-0 text-right">FOLIO: {{ $inspeccion->folio }}</p>
		<p class="mb-3 text-right" style="text-transform:uppercase;">CANCUN, QUINTANA ROO A @if($inspeccion->comercio == null) _______________________ @else {{ $fecha_hoy}} @endif </p>
		@if($inspeccion->comercio == null)
			<p class="mb-0 mt-0"><b>NOMBRE DEL CONTRIBUYENTE: </b>_____________________________________________________________________________________</p>
			<p class="mb-0 mt-0"><b>NOMBRE COMERCIAL DEL ESTABLECIMIENTO: </b>________________________________________________________________________</p>
			<p class="mb-3 mt-0"><b>DOMICILIO DEL ESTABLECIMIENTO: </b>__________________________________________________________________________________</p>
		@else
			<p class="mb-0 mt-0"><b>NOMBRE DEL CONTRIBUYENTE: </b>{{ $inspeccion->comercio->propietarionombre }}</p>
			<p class="mb-0 mt-0"><b>NOMBRE COMERCIAL DEL ESTABLECIMIENTO: </b>{{ $inspeccion->comercio->nombreestablecimiento }}</p>
			<p class="mb-3 mt-0"><b>DOMICILIO DEL ESTABLECIMIENTO: </b>{{ $inspeccion->comercio->domiciliofiscal }}</p>
		@endif
		<p class="text-justify">De conformidad con lo dispuesto por los artículos 14 y 16 de la Constitución Política de los Estados Unidos Mexicanos, 65, 66 fracción I inciso b), de la Ley de los Municipios del Estado de Quintana Roo, 63, 64, 65, 66, 67, 68 en todas sus fracciones, 69 y 70 del Código de Justicia Administrativa del Estado de Quintana Roo, 1, 2, 3, 479, 482, 484, 485, del Bando de Gobierno y Policía del Municipio de Benito Juárez, 1, 3, fracción IV, 3 inciso D, fracción II, 39, fracción XXI, 71, 72, fracciones I, II y III del Reglamento de Estacionamientos del Municipio de Benito Juárez, artículos 22 fracciones II, III, VIII, XII, XV y XVIII del Reglamento Interior de la Tesorería del Municipio de Benito Juárez, y considerando que el Reglamento de Estacionamientos del Municipio de Benito Juárez es de orden público e interés social, de observancia general y obligatoria y tiene por objeto regular la apertura, funcionamiento y operación de los estacionamientos en el Municipio de Benito Juárez, siendo esta Dirección de Fiscalización la facultada ejercer las funciones de verificación, fiscalización y la imposición de sanciones del citado Reglamento, se le hace saber que se le practicará visita de verificación, la cual tomando en consideración que las actividades comerciales que realiza pueden ser realizados incluso más allá de los días y horarios señalados en los artículos 29 y 31 del Código de Justicia Administrativa del Estado de Quintana Roo, ésta también podrá practicarse en días y horas inhábiles, de conformidad con el artículo 29 del Código de Justicia Administrativa del Estado de Quintana Roo, para cuyo efecto se ha comisionado al/los @if($inspeccion->inspector == null) C. ____________________________________________________________ @else <b>C. {{ $inspeccion->inspector->nombre }} {{ $inspeccion->inspector->apellidopaterno }} {{ $inspeccion->inspector->apellidomaterno }},</b> @endif quienes podrán actuar de manera conjunta o individualmente.</p>
		<p class="text-justify">El personal comisionado, está obligado a identificarse con credencial vigente expedida por autoridad competente del Municipio de Benito Juárez, que lo acredite para realizar la diligencia de verificación, a entregarle el original de la presente orden de verificación, misma que cuenta con la firma autógrafa de su emisor, así como a levantar el acta circunstanciada de la diligencia en presencia de dos testigos de asistencia que serán nombrados por la persona que atienda la visita y ante la negativa de hacerlo, el personal comisionado deberá nombrarlos, todo lo anterior, de conformidad con lo establecido en los artículos 64, 66 y 67 del Código de Justicia Administrativa del Estado de Quintana Roo.</p>
		<p class="text-justify">La visita tendrá por objeto y alcance constatar que el estacionamiento visitado esté inscrito en el Padrón Municipal de Contribuyentes, que cuente con la licencia de funcionamiento municipal para el ejercicio fiscal del año en curso para ejercer sus actividades mercantiles, que, en el caso de que el estacionamiento visitado se encuentre vinculado a establecimientos mercantiles, cuente con la anuencia correspondiente expedida por el Secretario General del Ayuntamiento del Municipio de Benito Juárez, que cuenta con un contrato de adhesión para la prestación de servicios de estacionamiento, registrado ante la Procuraduría Federal del Consumidor, que exhiba en lugar visible las tarifas autorizadas por el ayuntamiento y el horario de funcionamiento del establecimiento, que se respeten las tarifas autorizadas y señaladas en el Reglamento de Estacionamientos del Municipio de Benito Juárez, que tenga colocado en lugar visible los números telefónicos para quejas de los usuarios, que se le expida a los usuarios boletos debidamente marcados con reloj checador al recibir los vehículos, que se expida al usuario el comprobante de pago para que el mismo pueda solicitar el comprobante fiscal correspondiente, que el establecimiento visitado cuente con una póliza de seguro vigente al menos por la cantidad de 9,000 Unidades Medida de Actualización, para garantizar los vehículos estacionados en ellos, contra robo total y/o de autopartes, pérdida total, daño parcial, así como por siniestros que pudiera sufrir el inmueble, que en el caso de que el establecimiento visitado sea un estacionamiento al público con servicio de acomodadores, que el mismo haga del conocimiento de los usuarios en el módulo de recepción de vehículos, la obligación que tienen de informar sobre los valores y pertenencias dejados en sus vehículos y que cuente este tipo de establecimientos, con una póliza de seguros que garantice el pago del monto de los objetos listados y no devueltos en los términos de su contrato de adhesión, que se lleve un registro o bitácora de los vehículos que de acuerdo al procedimiento establecido por el propio estacionamiento, salgan del mismo con el pago de boleto extraviado, que cuando se encuentren ocupados todos los lugares autorizados de estacionamiento, se coloque un anuncio que así lo indique a la entrada del establecimiento, que en ningún caso se exceda la capacidad de cajones autorizados, que cuente con sanitarios suficientes y en condiciones higiénicas, para el servicio de los usuarios, separados para damas y caballeros, que el personal que labora para el establecimiento porte en lugar visible, una identificación que contenga: nombre completo, fotografía y cargo, razón social del estacionamiento para el que trabaja y que use uniforme distintivo de la empresa, que el personal de la empresa que conduzca un vehículo, tenga licencia de manejo vigente y cumpla con lo establecido en el Reglamento de Tránsito Municipal, que cuando se proporcionen servicios complementarios en el estacionamiento como lavado de autos, se lleve un registro del personal que labora en estas actividades, que los boletos que expida el establecimiento cuente cuando menos con la información a que se refiere el artículo 40 del Reglamento de Estacionamientos del Municipio de Benito Juárez, en el caso de los operadores de los estacionamientos al público, que se cumpla con lo señalado en el artículo 53 fracciones I al V, del Reglamento de Estacionamientos del Municipio de Benito Juárez, en el caso del servicio de acomodadores de autos, que hayan solicitado su inscripción al Padrón Municipal de contribuyentes, que cuente con la anuencia por escrito del Secretario General para prestar el servicio de acomodadores, que cuente con una póliza de seguro que garantice el robo total o de autopartes y de contenidos declarados por el usuario, de daños y por cualquier tipo de responsabilidad en que pudiera incurrir el personal que acomode o maneje los vehículos con motivo de la prestación de este servicio incluyendo la guarda hasta su devolución, que presente el contrato o comprobante de contar con un lugar donde estacionará los vehículos que le dejen en resguardo, que se emitan los boletos de resguardo del vehículo recibido con mención del costo del servicio, los datos de la empresa y los requisitos establecidos en el artículo 40 del Reglamento de Estacionamientos del Municipio de Benito Juárez, que exhiba la constancia de inscripción del contrato de adhesión ante el Registro Público de Contratos de Adhesión de la Procuraduría Federal del Consumidor para la prestación del servicio de traslado, guarda y custodia de vehículos mediante acomodadores personalizados, que expida al usuario el comprobante de pago para que el mismo pueda solicitar la emisión del comprobante fiscal correspondiente, que cuente con un módulo debidamente iluminado y con señalización clara y suficiente para el control de entrega y recepción de vehículos, que el módulo de entrega y recepción de vehículos se encuentre en un área dentro de la propiedad del establecimiento mercantil para el que prestan el servicio sin afectar el paso peatonal ni la vía de circulación, en caso de que no se cuente con espacio para establecer el modulo y este se encuentre instalado en la vía pública, que el mismo cuente con la autorización correspondiente por parte de la autoridad competente, que el personal porte identificación con fotografía en lugar visible, con los datos de la persona, de la empresa y uniforme distintivo de la misma, que el personal cuente con licencia de manejo vigente, que el personal que recibe los vehículos, se identifiquen con gafetes que distingan claramente los datos de la persona, de la empresa y fotografía del que lo porta y en general verificar que los establecimientos visitados, cumplan con sus obligaciones señaladas en el Reglamento de Estacionamientos del Municipio de Benito Juárez.</p>
		<p class="text-justify">Por lo anterior, usted deberá otorgar al (los) referido(s) verificador(es), todo género de facilidades e informes relacionados con la verificación, y permitirles el acceso al establecimiento, proporcionar los informes y documentos requeridos para que ellos puedan desarrollar su labor, de lo contrario se configura la infracción por parte del establecimiento a lo señalado en el artículo 79, fracción XIX, del Reglamento de estacionamientos del Municipio de Benito Juárez, mismo que es sancionado con multa que va de 100 a 1500 Unidades Medidas de Actualización, pudiendo incluso esta autoridad, independientemente de la multa impuesta, sancionar a su vez con cualquier otra sanción a que se refiere el artículo 78 del Reglamento citado en el presente párrafo, siendo una sanción de ellas la clausura temporal o definitiva, esto de conformidad con lo señalado en el artículo 79 antepenúltimo párrafo y 78 fracción II del Reglamento de estacionamientos del Municipio de Benito Juárez, sin perjuicio de las sanciones a que se pueda hacer acreedor por incurrir en el delito previsto en el artículo 213 del Código Penal para el Estado Libre y Soberano de Quintana Roo.</p>
		<p class="text-justify">Asimismo, se le apercibe al visitado, que en el caso de no contar con la licencia de funcionamiento municipal al momento de la diligencia, el establecimiento visitado podrá ser sujeto a clausura en cualquier momento, ello de conformidad con lo establecido en los artículos 32 del Reglamento de Estacionamientos del Municipio de Benito Juárez, 479 y 509, fracciones IV y VII del Bando de Gobierno y Policía del Municipio de Benito Juárez, Quintana Roo, ya que para el ejercicio de cualquier actividad comercial, industrial o de servicios por parte de los contribuyentes, previo a su apertura y operación, se requiere de licencia de funcionamiento expedido por el Ayuntamiento, entendiéndose que no cuenta con la autorización para funcionar si no exhibe la licencia de funcionamiento municipal correspondiente.</p>
		<p class="text-justify">Finalmente, se le hace saber al visitado, que el expediente administrativo abierto con motivo de la presente diligencia, se encuentra para su consulta en las oficinas de esta Dirección de Fiscalización, ubicada en la Avenida Tulum, 5, supermanzana 5, C.P. 77500, de esta Ciudad de Cancún, Municipio de Benito Juárez, Quintana Roo.</p>
		<div class="mt-5">
			@if(is_object($inspeccion->formavalorada))
			<p class="text-center"><b style="font-size:25px;">ATENTAMENTE</b></p>.
			<p class="text-center"><b style="font-size:25px;">{{ $inspeccion->formavalorada->encargado->nombre }} {{ $inspeccion->formavalorada->encargado->apellidopaterno }} {{ $inspeccion->formavalorada->encargado->apellidomaterno }}</b></p>
			<p class="text-center"><b style="font-size:25px;">{{ $inspeccion->formavalorada->encargado->puesto }}</b></p>
			@endif
		</div>
	
		<div class="page_break"></div>

		<img src="{{ asset('img/header-acta-inspeccion-est.jpg') }}" width="100%" class="mb-3">
		<p class="mb-0 mt-0">MUNICIPIO DE BENITO JUÁREZ</p>
		<p class="mb-0 mt-0">TESORERÍA MUNICIPAL</p>
		<p class="mb-0 mt-0">DIRECCIÓN DE FISCALIZACIÓN</p>
		<p class="mb-3 mt-0">FOLIO: {{ $inspeccion->folio }}</p>

		<p class="text-justify">En la ciudad de Cancún, Municipio de Benito Juárez, Quintana Roo, Quintana Roo, siendo las _______ horas del @if($inspeccion->comercio == null)día _____ de _____________ del año ______,@else {{ $fecha_hoy }} @endif en cumplimiento a la orden de visita de verificación número {{ $inspeccion->folio }} de fecha __________________________, emitida por el Ingeniero {{ $inspeccion->formavalorada->encargado->nombre }} {{ $inspeccion->formavalorada->encargado->apellidopaterno }} {{ $inspeccion->formavalorada->encargado->apellidomaterno }}, en su carácter de {{ $inspeccion->formavalorada->encargado->puesto }}, el (los) Verificador(es) _______________________________________________________________ adscrito(s) a la Dirección de Fiscalización de la Tesorería del Municipio de Benito Juárez, Quintana Roo, me constituí en el domicilio ubicado en ________________________________________________________________ en busca del propietario, representante legal, encargado o dependiente de la empresa __________________________________________________ con giro o actividades de ESTACIONAMIENTO AL PÚBLICO, cuyo Registro Federal de Contribuyentes es ________________________________ cerciorándome que es el domicilio buscado por medio de _____________________________________________________________________________________________________________ atendiendo la diligencia quien dijo llamarse _________________________________________________________ en su caracter de _______________________________________________________________________ acreditándolo con ______________________________________________________________________, y quien se identifica con ________________________________________________________________________ número ____________________________
		expedida por ___________________________________________________________.</p>
		<p class="text-justify">Acto seguido, de conformidad con los artículos 66 y 67 del Código de Justicia Administrativa del Estado de Quintana Roo, 71 y 72 fracción II y III del Reglamento de Estacionamientos del Municipio de Benito Juárez se procede al desahogo de la diligencia de verificación, identificándose el/la suscrito/a ante la persona que atiende la diligencia, con credencial(es) número(s) _______________________________________ con fotografía, vigentes del _________ al _____________________________ expedida(s), por el el Tesorero Municipal del Municipio de Benito Juárez, Quintana Roo, Lic. Marcelo José Guzmán, con fundamento en lo dispuesto en el artículo 11 fracción XI del Reglamento Interior de la Tesorería del Municipio de Benito Juárez, Quintana Roo, documentos que contiene su firma autógrafa y fotografía misma, que me(nos) acredita(n) como verificador(es) adscrito a la Dirección de Fiscalización de la Tesorería del Municipio de Benito Juárez. Exhortando al visitado para que corrobore que la(s) fotografía(s) que aparece(n) en dicha(s) credencial(es) concuerda(n) con los rasgos fisonómicos del (los) que actúa(n), procediendo en este acto a hacer entrega a la persona que atiende la diligencia, el original de la orden de verificación en términos del artículo 66 del Código de Justicia Administrativa del Estado de Quintana Roo. Acto seguido, de conformidad con lo establecido por el artículo 67 del Código de Justicia Administrativa del Estado de Quintana Roo y 72 fracción V, del Reglamento de Estacionamientos del Municipio de Benito Juárez, se le hace saber el derecho que tiene para nombrar a dos testigos de asistencia, y en caso de no hacerlo, éstos serán designados por el(los) propio(s) verificador(es), manifestando que sí (____) no (____) los designa, por lo que el visitado (____) el verificador (____) designa como: Primer testigo a: ___________________________________________________________ de ______ años de edad, quien se identifica con ___________________________________________ número ______________________ expedida por ______________________________________________________________________ con domicilio en ______________________________________________________________________________ y como segundo testigo a: ___________________________________________________________ de ______ años de edad, quien se identifica con ___________________________________________ número ______________________ expedida por ______________________________________________________________________ con domicilio en _______________________________________________________________________________________________________.</p>

		<p class="text-justify">Con la asistencia de los testigos antes mencionados, se procede a verificar al establecimiento de acuerdo al siguiente cuestionario:</p>
		@foreach($formavalorada->tipoInspeccion->documentacionPorTipoDeInspeccion as $documento)
		<table class="table table-bordered table-sm mb-3 mt-0">
			<tbody>
				<tr>
					<td style="width: 50%;">{{ $documento->documentacionRequerida->nombre }}</td>
					<td style="width: 5%;" class="text-center">SI</td>
					<td style="width: 5%;" class="text-center">NO</td>
					<td style="width: 5%;" class="text-center">N/A</td>
				</tr>
			</tbody>
		</table>
		@endforeach
		<p class="text-justify mt-3">En virtud de la presente verificación y en cuanto se infringe el Reglamento de Estacionamientos del Municipio de Benito Juárez en sus artículos _____________________________________________________________________________________, ello en razón de que el establecimiento visitado, no cumple con las preguntas números _____________________________________________________________________________________, del cuestionario asentado en la presente acta, para dar cumplimiento a lo señalado en el artículo 72, fracción III del Reglamento de Estacionamientos del Municipio de Benito Juárez, sirva la presente acta circunstanciada como notificación del resultado de la visita. Asimismo, con fundamento en el artículo 72, fracción IV del Reglamento de Estacionamientos del Municipio de Benito Juárez, una vez que ya fue notificado al establecimiento el resultado de la visita, en este acto se le hace saber al visitado que cuenta con un plazo de cinco días hábiles contados a partir del día siguiente de la presente diligencia, para inconformarse y aportar las pruebas y formular los alegatos que a su derecho convengan.</p>

		<p class="text-justify mb-0">Finalmente el suscrito, exhorta a la persona con quien se entiende la diligencia, para manifestar lo que a su derecho convenga, quien manifiesta que:</p>
		<p class="mb-0 mt-0">____________________________________________________________________________________________________________________</p>
		<p class="mb-0 mt-0">____________________________________________________________________________________________________________________</p>
		<p class="mb-3 mt-0">____________________________________________________________________________________________________________________</p>
		

		<p class="text-justify mb-0">Independientemente de lo anterior, el verificador formula las siguientes observaciones: ______________________________________________</p>
		<p class="mb-0 mt-0">____________________________________________________________________________________________________________________</p>
		<p class="mb-0 mt-0">____________________________________________________________________________________________________________________</p>
		<p class="mb-3 mt-0">____________________________________________________________________________________________________________________</p>

		<p class="text-justify">Con fundamento en el artículo 72, fracción VII del Reglamento de Estacionamientos del Municipio de Benito Juárez, se hace constar que el establecimiento visitado si (____) no (____) cuenta con libro de visitas, por lo que si (____) no (____) se anotó una síntesis de la diligencia practicada.</p>

		<p class="text-justify">Cabe señalar que con fundamento en el artículo 67 del Código de Justicia Administrativa del Estado de Quintana Roo, y 72 fracción V del Reglamento de Estacionamientos del Municipio de Benito Juárez, se hace del conocimiento del visitado que el hecho de negarse a designar testigos y/o firmar el acta, no invalida el acta.</p>

		<p class="text-justify mb-5">No habiendo más que agregar, se cierra la presente acta a las ________ horas, el @if($inspeccion->comercio == null) día _____ de ______________ del año ______, @else {{ $fecha_hoy }} @endif firmando de conformidad al margen y al calce los que en ella intervinieron y quisieron hacerlo, entregándose copia legible de la misma a la persona con quien se entendió la Diligencia misma que consta de (____) fojas útiles.</p>
		
		<table style="width: 100%;font-size:20px;">
			<tbody class="text-center">
				<tr>
					<td class="">VERIFICADOR</td>
					<td class="">EL VISITADO</td>
				</tr>
				<tr>
					<td>_____________________________</td>
					<td>_____________________________</td>
				</tr>
			</tbody>
		</table>
		<br>
		<br>
		<br>
		<table style="width: 100%;font-size:20px;">
			<tbody class="text-center">
				<tr>
					<td class="">PRIMER TESTIGO</td>
					<td class="">SEGUNDO TESTIGO</td>
				</tr>
				<tr>
					<td>_____________________________</td>
					<td>_____________________________</td>
				</tr>
			</tbody>
		</table>
		<div class="page_break"></div>
	@endforeach
</body>
</html>