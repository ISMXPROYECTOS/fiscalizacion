<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>MULTA FISCAL</title>
	<link rel="stylesheet" href="{{ asset('css/multa-oie.css') }}" />
</head>
<body>
	@foreach($multas as $multa)
	<img src="{{ asset('img/header-multa-fiscal.jpg') }}" width="100%">
	
	
	<div class="multa-header-datos-div mt-3">
		<p class="multa-header-datos mbt-0 ">MUNICIPIO DE BENITO JUÁREZ</p>
		<p class="multa-header-datos mbt-0 ">TESORERÍA MUNICIPAL</p>
		<p class="multa-header-datos mbt-0 ">DIRECCIÓN DE FISCALIZACIÓN</p>
		<p class="multa-header-datos mbt-0 ">FOLIO: <b>{{ $inspeccion->folio }}</b></p>
		<p class="multa-header-datos mbt-0 "><b>ASUNTO: RESOLUCIÓN ADMINISTRATIVA</b></p>
		<p class="multa-header-datos mbt-0" style="text-transform: uppercase;">CANCUN, QUINTANA ROO A @if($inspeccion->comercio == null) _______________________ @else {{ $fecha_hoy}} @endif </p>
	</div>

	<p class="contenido-general">Visto el estado que guarda el presente expediente, formado con motivo de la visita de verificación efectuada en el domicilio de la empresa @if(is_object($inspeccion->comercio)) {{ $inspeccion->comercio->propietarionombre }}, @else ____________________________________________, @endif esta autoridad procede a emitir la resolución en el presente asunto, en base a los siguientes:</p>

	<h1>RESULTANDO</h1>

	<p class="contenido-general">
		<b>1.-</b> Que con fecha 28 de agosto de 2019, personal adscrito a la Dirección de Fiscalización de la Tesorería Municipal, llevó a cabo visita de inspección en el domicilio de la empresa @if(is_object($inspeccion->comercio)) {{ $inspeccion->comercio->propietarionombre }}, @else ____________________________________________, @endif ubicado en @if(is_object($inspeccion->comercio)) {{ $inspeccion->comercio->domiciliofiscal }}, @else ____________________________________________, @endif, de esta Ciudad de Cancún, Quintana Roo, levantándose acta circunstanciada con el objeto de constatar que el estacionamiento visitado esté inscrito en el Padrón Municipal de Contribuyentes, que  cuente con la licencia de funcionamiento municipal para el ejercicio fiscal del año en curso para ejercer sus actividades mercantiles, que, en el caso de que el estacionamiento visitado se encuentre vinculado a establecimientos mercantiles,  cuente con la anuencia correspondiente expedida por el Secretario General del Ayuntamiento del Municipio de Benito Juárez, que cuenta con un contrato de adhesión para la prestación de servicios de estacionamiento, registrado ante la Procuraduría Federal del Consumidor, que exhiba en lugar visible  las tarifas autorizadas por el ayuntamiento y el horario de funcionamiento del establecimiento, que se respeten las tarifas autorizadas y señaladas en el Reglamento de Estacionamientos del Municipio de Benito Juárez, que tenga colocado en lugar visible los números telefónicos para quejas de los usuarios, que se le expida a los usuarios boletos debidamente marcados con reloj checador al recibir los vehículos, que se expida al usuario el comprobante de pago para que el mismo pueda solicitar el comprobante fiscal correspondiente, que el establecimiento visitado cuente con una póliza de seguro vigente al menos por la cantidad de 9,000 Unidades Medida de Actualización, para garantizar los vehículos estacionados en ellos, contra robo total y/o de autopartes, pérdida total, daño parcial, así como por siniestros que pudiera sufrir el inmueble, que en el caso de que el establecimiento visitado sea un estacionamiento al público con servicio de acomodadores, que el mismo haga del conocimiento de los usuarios en el módulo de recepción de vehículos, la obligación que tienen de informar sobre los valores y pertenencias dejados en sus vehículos y que cuente este tipo de establecimientos, con una póliza de seguros que garantice el pago del monto de los objetos listados y no devueltos en los términos de su contrato de adhesión, que se lleve un registro o bitácora de los vehículos que de acuerdo al procedimiento establecido por el propio estacionamiento, salgan del mismo con el pago de boleto extraviado, que cuando se encuentren ocupados todos los lugares autorizados de estacionamiento, se coloque un anuncio que así lo indique a la entrada del establecimiento, que en ningún caso se exceda la capacidad de cajones autorizados, que cuente con sanitarios suficientes y en condiciones higiénicas, para el servicio de los usuarios, separados para damas y caballeros, que el personal que labora para el establecimiento porte en lugar visible, una identificación que contenga: nombre completo, fotografía y cargo, razón social del estacionamiento para el que trabaja y que use uniforme distintivo de la empresa, que el personal de la empresa que conduzca un vehículo, tenga licencia de manejo vigente y cumpla con lo establecido en el Reglamento de Tránsito Municipal, que cuando se proporcionen servicios complementarios en el estacionamiento como lavado de autos, se lleve un registro del personal que labora en estas actividades, que los boletos que expida el establecimiento cuente cuando menos con la información a que se refiere el artículo 40 del Reglamento de Estacionamientos del Municipio de Benito Juárez, en el caso de los operadores de los estacionamientos al público, que se cumpla con lo señalado en el artículo 53 fracciones I al V, del Reglamento de Estacionamientos del Municipio de Benito Juárez, en el caso del servicio de acomodadores de autos, que hayan solicitado su inscripción al Padrón Municipal de contribuyentes, que cuente con la anuencia por escrito del Secretario General para prestar el servicio de acomodadores, que cuente con una póliza de seguro que garantice el robo total o de autopartes y de contenidos declarados por el usuario, de daños y por cualquier tipo de responsabilidad en que pudiera incurrir el personal que acomode o maneje los vehículos con motivo de la prestación de este servicio incluyendo la guarda hasta su devolución, que presente el contrato o comprobante de contar con un lugar donde estacionará los vehículos que le dejen en resguardo, que se emitan los boletos de resguardo del vehículo recibido con mención del costo del servicio, los datos de la empresa y los requisitos establecidos en el artículo 40 del Reglamento de Estacionamientos del Municipio de Benito Juárez, que exhiba la constancia de inscripción del contrato de adhesión ante el Registro Público de Contratos de Adhesión de la Procuraduría Federal del Consumidor para la prestación del servicio de traslado, guarda y custodia de vehículos mediante acomodadores personalizados, que expida al usuario el comprobante de pago para que el mismo pueda solicitar la emisión del comprobante fiscal correspondiente, que cuente con un módulo debidamente iluminado y con señalización clara y suficiente para el control de entrega y recepción de vehículos, que el módulo de entrega y recepción de vehículos se encuentre en un área dentro de la propiedad del establecimiento mercantil para el que prestan el servicio sin afectar el paso peatonal ni la vía de circulación,  en caso de que no se cuente con espacio para establecer el modulo y este se encuentre instalado en la vía pública, que el mismo cuente con la autorización correspondiente por parte de la autoridad competente, que el personal porte identificación con fotografía en lugar visible, con los datos de la persona, de la empresa y uniforme distintivo de la misma, que el personal cuente con licencia de manejo vigente, que el personal que recibe los vehículos, se identifiquen con gafetes que distingan claramente los datos de la persona, de la empresa y fotografía del que lo porta y en general verificar que los establecimientos visitados, cumplan con sus obligaciones señaladas en el Reglamento de Estacionamientos del Municipio de Benito Juárez.  
	</p>

	<p class="contenido-general"><b>2.-</b> En virtud de que la empresa NO presentó escrito de manifestaciones y pruebas, habiendo transcurrido el plazo de cinco días hábiles a que se refiere el artículo 69 del Código de Justicia Administrativa del Estado de Quintana Roo y 72, fracción IV del Reglamento de Estacionamientos del Municipio de Benito Juárez, esta autoridad procede a emitir resolución administrativa al tenor de los siguientes:</p>

	<h1>CONSIDERANDOS</h1>

	<p class="contenido-general"><b>I.-</b> La Dirección de Fiscalización de la Tesorería Municipal del H. Ayuntamiento de Benito Juárez, es competente para conocer la substanciación del presente procedimiento en términos de lo dispuesto por los artículos 14 y 16 de la Constitución Política de los Estados Unidos Mexicanos, 65, 66 fracción I inciso b), de la Ley de los Municipios del Estado de Quintana Roo, 71, fracción II y V del Código de Justicia Administrativa del Estado de Quintana Roo, 1, 2, 3, 479, 509 fracciones I y VII, del Bando de Gobierno y Policía del Municipio de Benito Juárez, 1, 3, fracción IV, 3 inciso D, fracción II, 71, 73, 77 y 78 fracciones  I y II, del Reglamento de Estacionamientos del Municipio de Benito Juárez,  artículos  22 fracciones II, III, V, VIII, IX, XII, XIII,  XV y XVIII del Reglamento Interior de la Tesorería del Municipio de Benito Juárez todos ordenamientos jurídicos vigentes.</p>

	<p class="contenido-general"><b>II.- </b> Como se desprende de las constancias que obran en el presente expediente, así como el acta de visita de inspección @if(is_object($multa->inspeccion)) {{ $multa->inspeccion->folio }} @else ____________________________ @endif de __________________________________, personal adscrito a la Dirección de Fiscalización de la Tesorería Municipal del Municipio de Benito Juárez, llevó a cabo visita de inspección en el domicilio de la empresa @if(is_object($multa->inspeccion)) {{ $multa->inspeccion->comercio->denominacion }}, @else __________________________________________ @endif con el objeto de constatar que en el establecimiento visitado cumpla con las obligaciones señaladas en el Reglamento de Estacionamientos del Municipio de Benito Juárez, Quintana Roo.</p>

	<p class="contenido-general"><b>III.-</b> Que del Resultado de la visita de inspección y de la documentación que se le requiriera al visitado, se desprende que la empresa @if(is_object($multa->inspeccion)) {{ $multa->inspeccion->comercio->denominacion }}, @else __________________________________________ @endif infringió los artículos 41, fracción VIII y 45 fracción V del Reglamento de Estacionamientos del Municipio de Benito Juárez, Quintana Roo, toda vez que del cuestionario que consta en el acta de inspección, no acreditó lo siguiente:</p>

	<p class="contenido-general pl-5">- Contar con la inscripción de su contrato de adhesión para la prestación del servicio de estacionamiento ante el Registro Público de Contratos de Adhesión de la Procuraduría Federal del Consumidor, estando obligado por ser un Estacionamiento vinculado a establecimientos mercantiles, mismo que es violatorio de los artículos Artículo 41 fracción VIII, y 45 fracción V del Reglamento de Estacionamientos del Municipio de Benito Juárez.</p>

	<p class="contenido-general"><b>IV.-</b> Derivado del considerando anterior, se desprende que la empresa visitada, @if(is_object($multa->inspeccion)) {{ $multa->inspeccion->comercio->denominacion }}, @else __________________________________________ @endif, ha infringido los artículos 39, fracción VII y XVII, 40 punto 4, 41, fracción VIII y 45 fracción V del Reglamento de Estacionamientos del Municipio de Benito Juárez, por lo que para dar cumplimiento a lo establecido en el artículo 74 del Código de Justicia Administrativa del Estado de Quintana Roo, procede a cuantificar la multa en base a lo siguiente:</p>

	<p class="contenido-general"><b>V.-</b> Se concluye que la contribuyente visitada se ha ubicado dentro de los supuestos previstos en el artículo 79 penúltimo párrafo del citado artículo, del Reglamento de Estacionamientos del Municipio de Benito Juárez, Quintana Roo vigente, en los siguientes términos:</p>

	<p class="contenido-general pl-5">- En cuanto a que la empresa infractora no acreditó contar con la inscripción de su contrato de adhesión para la prestación del servicio de estacionamiento ante el Registro Público de Contratos de Adhesión de la Procuraduría Federal del Consumidor, estando obligado por ser un Estacionamiento vinculado a establecimientos mercantiles, incumpliendo con lo establecido en el artículo Artículo 41 fracción VIII, y 45 fracción V del Reglamento de Estacionamientos del Municipio de Benito Juárez., dicha conducta es sancionada conforme lo establece el artículo Artículo 79 penúltimo párrafo, del Reglamento de Estacionamientos del Municipio de Benito Juárez, Quintana Roo, multa que va de 50 a 3000 Unidades Medida de Actualización,  por lo que la empresa visitada  se hace acreedora a una sanción de 200 Unidades Medida de Actualización.</p>

	<p class="contenido-general">En el caso a estudio, la aplicación de las sanciones se lleva a cabo por la cantidad de {{ $multa->total }}, esto es, {{ $multa->montoMulta }} unidades medida y actualización vigente a la fecha en la que se cometió la infracción, de acuerdo a lo establecido por el Instituto Nacional de Estadística y Geografía (INEGI), publicado en el Diario Oficial de la Federación del 10 de enero de 2019, con un monto de {{ $multa->valorUmar }}, quedando de la siguiente forma: </p>

	<table class="multa-formula">
	  <tr>
	    <td class="cons">Multa determinada en Unidad de Medida y Actualización (UMA)</td>
	    <td class="cant">{{ $multa->montoMulta }}</td>
	  </tr>
	  <tr>
	    <td>Cantidad en pesos por Unidad de Medida y Actualización</td>
	    <td>X {{ $multa->valorUma }}</td>
	  </tr>
	  <tr>
	    <td>Total determinado en pesos</td>
	    <td>{{ $multa->total }}</td>
	  </tr>
	</table>

	<p class="contenido-general">Con fundamento en el artículo 74 fracción I del Código de Justicia Administrativa del Estado de Quintana Roo, se procede a valorar los daños que se hubieren producido o puedan producirse: Al respecto, esta autoridad considera que la falta de cumplimiento a los artículos infringidos, pueden producir daños a los usuarios de estacionamientos, ya que en la medida que la empresa de cumplimiento a sus obligaciones, estos le dan mayor certeza a los derechos de los usuarios.</p>

	<p class="contenido-general">Con fundamento en el artículo 74 fracción II del Código de Justicia Administrativa del Estado de Quintana Roo, se procede a valorar el carácter intencional o no de la acción u omisión constitutiva de la infracción: La intencionalidad de la infracción de la empresa infractora se tiene por acreditada, ya que el Reglamento de Estacionamientos del Municipio de Benito Juárez, fue publicado en el Periódico Oficial del Estado de Quintana Roo desde el 26 de marzo de 2010, por lo que desde aquella fecha se hizo obligatoria para todos los establecimientos con el giro de estacionamientos, siendo evidente que la empresa de manera intencional ha estado incumpliento el Reglamento en Comento al no acreditar ante esta autoridad haber registrado su contrato de adhesión para la prestación de los servicios de estacionamiento.</p>

	<p class="contenido-general">Adicional a lo anterior, durante la secuela procedimental, la empresa infractora, no acreditó que el incumplimiento al Reglamento se debiera a caso fortuito o de fuerza mayor, razón por la cual es evidente la intencionalidad de infringir el Reglamento de Estacionamientos del Municipio de Benito Juárez.</p>
	
	<p class="contenido-general">Con fundamento en el artículo 74 fracción II del Código de Justicia Administrativa del Estado de Quintana Roo, se procede a valorar el carácter intencional o no de la acción u omisión constitutiva de la infracción: La intencionalidad de la infracción de la empresa infractora se tiene por acreditada, ya que el Reglamento de Estacionamientos del Municipio de Benito Juárez, fue publicado en el Periódico Oficial del Estado de Quintana Roo desde el 26 de marzo de 2010, por lo que desde aquella fecha se hizo obligatoria para todos los establecimientos con el giro de estacionamientos, siendo evidente que la empresa de manera intencional ha estado incumpliento el Reglamento en Comento al no acreditar ante esta autoridad haber registrado su contrato de adhesión para la prestación de los servicios de estacionamiento.</p>

	<p class="contenido-general">Con fundamento en el artículo 74 fracción IV del Código de Justicia Administrativa del Estado de Quintana Roo, se procede a valorar la reincidencia del infractor.- En cuanto a la reincidencia, esta autoridad no considera reincidente al contribuyente sancionado, ya que de los registros con que se cuenta en esta Dirección, no existen datos que lleven a concluir que la empresa haya incumplido el Reglamento de Estacionamientos del Municipio de Benito Juárez, en términos de lo señalado en el artículo 80 del propio Reglamento.</p>

	<p class="contenido-general">En cuanto a las condiciones económicas del infractor, esta autoridad considera que la empresa sancionada cuenta con los recursos económicos para cubrir la multa que aquí se le impone, ello en razón de que durante la secuela procedimental, no exhibió documentación alguna que acredite estar en estado de insolvencia, suspensión de pagos o concurso mercantil en términos de la leyes aplicables, aunado a que la empresa sancionada con la actividad mercantil de estacionamientos que ejerce, le permite obtener ganancias para poder pagar la multa aquí impuesta.</p>

	<p class="contenido-general">Por lo expuesto, fundado y motivado es de resolverse y al efecto se;</p>

	<h1>RESUELVE</h1>

	<p class="contenido-general"><b>PRIMERO.-</b> Se le impone a la sociedad  mercantil denominada @if(is_object($multa->inspeccion)) {{ $multa->inspeccion->comercio->denominacion }} @else __________________________________________ @endif, una multa por un monto de {{ $multa->montoMulta }} unidades medida de actualización vigente en la fecha en que se cometió la infracción, que representan la cantidad de {{ $multa->total }}, por los motivos y fundamentos precisados en el apartado de Considerandos de la presente resolución.</p>

	<p class="contenido-general"><b>SEGUNDO.-</b> Se hace de su conocimiento que la multa impuesta, puede ser combatida mediante el recurso de revocación en términos del artículo 84 del Código de Justicia Administrativa del Estado de Quintana.</p>

	<p class="contenido-general"><b>TERCERO.-</b> Con fundamento en el artículo 82 fracción VI del Reglamento de Estacionamientos de Benito Juárez, se apercibe a la empresa infractora, que para el caso de no pagar la multa aquí impuesta dentro del término señalado en la Ley, el establecimiento visitado, será sujeto a <b>CLAUSURA DEFINITIVA</b>.</p>

	<p class="contenido-general"><b>CUARTO.-</b> Notifíquese la presente la resolución a @if(is_object($multa->inspeccion)) {{ $multa->inspeccion->comercio->denominacion }}, @else __________________________________________ @endif en el domicilio ubicado en @if(is_object($multa->inspeccion)) {{ $multa->inspeccion->comercio->domiciliofiscal }}, @else __________________________________________ @endif, de esta Ciudad de Cancún, Quintana Roo.</p>

	<p class="contenido-general">Así lo acordó y firma el Ingeniero <b>{{ $inspeccion->formavalorada->encargado->nombre }} {{ $inspeccion->formavalorada->encargado->apellidopaterno }} {{ $inspeccion->formavalorada->encargado->apellidomaterno }},</b> {{ $inspeccion->formavalorada->encargado->puesto }}, con fundamento en los artículos los artículos 14 y 16 de la Constitución Política de los Estados Unidos Mexicanos, 65, 66 fracción I inciso b), de la Ley de los Municipios del Estado de Quintana Roo, 71, fracción II y V del Código de Justicia Administrativa del Estado de Quintana Roo, 1, 2, 3, 479, 509 fracciones I y VII, del Bando de Gobierno y Policía del Municipio de Benito Juárez, 1, 3, fracción IV, 3 inciso D, fracción II, 71, 73, 77 y 78 fracciones  I y II, del Reglamento de Estacionamientos del Municipio de Benito Juárez,  artículos  22 fracciones II, III, V, VIII, IX, XII, XIII,  XV y XVIII del Reglamento Interior de la Tesorería del Municipio de Benito Juárez, todos ordenamientos jurídicos vigentes.</p>
	
	<div class="page_break"></div>

	

	<img src="{{ asset('img/header-logo-simple.jpg') }}" width="100%">

	<h1 class="mb-0">CÉDULA NOTIFICACIÓN</h1>
	<p class="cn-subtitulo text-center mt-0"><b>(Con el directo interesado)</b></p>

	<p class="cn-header-datos"><b>PROPIETARIO, REPRESENTANTE <br> O APODERADO LEGAL <br> DE @if(is_object($multa->inspeccion)) {{ $multa->inspeccion->comercio->denominacion }}, @else __________________________________________ @endif</b></p>

	<p class="cn-contenido-general mb-0">En _________________________________________ siendo las _____ horas con ______ minutos del dia _____ del mes de __________________ del año ________, el C. ____________________________________________ notificador adscrito a la Dirección de Fiscalización de la Tesorería Municipal del Municipio de Benito Juárez, Quintana Roo identificándome con credencial No. _______________, con vigencia del _________________________ al _________________________  me constituí en el inmueble ubicado en {{ $multa->inspeccion->comercio->domiciliofiscal }} en esta ciudad de Cancún, Quintana Roo, cerciorándome por medio de ____________________________________________________________________________________________________________</p>
	<p class="cn-contenido-general mbt-0">____________________________________________________________________________________________________________</p>
	<p class="cn-contenido-general mbt-0">____________________________________________________________________________________________________________</p>

	<p class="cn-contenido-general">que es el domicilio de la persona al rubro citada, requerí la presencia del propietario, su representante o apoderado legal, entendí la presente diligencia de notificación con quien dijo llamarse _________________________________________________, identificandose con _________________________________________________ en su caracter de _________________________________________________ personalidad que acredita con _________________________________________________ a quien en este acto y con fundamento en el artículo 37 del Código de Justicia Administrativa del Estado de Quintana Roo, le notifico formalmente para todos los efectos legales a que haya lugar, original con firma autógrafa de la resolución que consta de ________fojas útiles, de fecha ______________________, con número de oficio {{ $inspeccion->folio }} emitido por el Ingeniero {{ $inspeccion->formavalorada->encargado->nombre }} {{ $inspeccion->formavalorada->encargado->apellidopaterno }} {{ $inspeccion->formavalorada->encargado->apellidomaterno }}, en su  carácter  de Director de Fiscalización de la Tesorería del Municipio de Benito Juárez, Quintana Roo, así mismo le entrego copia de la presente cédula, con lo cual se da por concluida esta diligencia siendo las ________ horas con _______ minutos del dia de su inicio, firmando el interesado al calce de recibido para constancia de todo lo anterior. Esta notificación surtirá efectos el mismo día en el que fue practicada y los términos empezarán a correr el día hábil siguiente del en que haya surtido efectos la notificación, de conformidad con lo establecido en el artículo 39, del Código de Justicia Administrativa del Estado de Quintana Roo.</p>

	<table class="firma-final mt-10">
	  <tr>
	    <td>
	    	<b>EL C. NOTIFICADOR</b>
	    	<p>_________________________________</p>
	    </td>
	    <td>
	    	<b>EL INTERESADO</b>
	    	<p>_________________________________</p>
	    </td>
	  </tr>
	</table>

	<div class="page_break"></div>
	
	<img src="{{ asset('img/header-logo-simple.jpg') }}" width="100%">

	<h1 class="mb-0">CITATORIO</h1>

	<p class="cn-header-datos"><b>PROPIETARIO, REPRESENTANTE <br> O APODERADO LEGAL <br> DE @if(is_object($multa->inspeccion)) {{ $multa->inspeccion->comercio->denominacion }}, @else __________________________________________ @endif</b></p>
	
	<p class="cn-contenido-general mb-0">En _________________________________________ siendo las _____ horas con _____ minutos del día _____ del mes de ________________________ del año, el C. ____________________________________________________ notificador-ejecutor adscrito a la Dirección de Fiscalización de la Tesorería Municipal del Municipio de Benito Juárez, Quintana Roo identificándome con credencial No. _____________, con vigencia del _________________________ al _______________________, me constituí en el inmueble ubicado en @if(is_object($multa->inspeccion)) {{ $multa->inspeccion->comercio->domiciliofiscal }} @else _______________________________________________ @endif en esta ciudad de Cancún, Quintana Roo, cerciorándome por medio de ____________________________________________________________________________________________________________</p> 
	<p class="cn-contenido-general mbt-0">_____________________________________________________________________________________________________________</p>
	<p class="cn-contenido-general mbt-0">_____________________________________________________________________________________________________________</p>
	
	<p class="cn-contenido-general">que es el domicilio de la persona al rubro citada, requerí la presencia del propietario, su representante o apoderado legal, presentándose el C.______________________________________________, en su carácter de ______________________________________________, quien se identifica con __________________________________________________ manifestando que la persona buscada no se encuentra, por lo que procedo a dejar en su poder el presente citatorio para que la persona al rubro citada espere al notificador a las ______ horas con ______ minutos, del día _____ del mes de ________________ del año ______, apercibido de que en caso de no hacerlo, la diligencia de notificación se entenderá con cualquier persona que se encuentre en el domicilio, y de negarse éstos a recibirla o en caso de encontrarse cerrado el mismo, se realizará por instructivo que se fijará en lugar visible de dicho domicilio, con fundamento en el artículo 37 segundo y tercer párrafo del Código de Justicia Administrativa del Estado de Quintana Roo.</p>
	
	<table class="firma-final mt-10">
	  <tr>
	    <td>
	    	<b>EL C. NOTIFICADOR</b>
	    	<p>_________________________________</p>
	    </td>
	    <td>
	    	<b>EL INTERESADO</b>
	    	<p>_________________________________</p>
	    </td>
	  </tr>
	</table>

	<div class="page_break"></div>

	<img src="{{ asset('img/header-logo-simple.jpg') }}" width="100%">

	

	<h1 class="mb-0">NOTIFICACIÓN PREVIO CITATORIO</h1>
	<p class="cn-subtitulo text-center mt-0"><b>(Con quien esté)</b></p>

	<p class="cn-header-datos"><b>PROPIETARIO, REPRESENTANTE <br> O APODERADO LEGAL <br> DE @if(is_object($multa->inspeccion)) {{ $multa->inspeccion->comercio->denominacion }}, @else __________________________________________ @endif</b></p>
	
	<p class="cn-contenido-general mb-0">En ____________________________________________ siendo las ______ horas con _______ minutos del dia _____ del mes de ________________ del año ______, el C. ________________________________________________________________________ notificador-ejecutor adscrito a la Dirección de Fiscalización de la Tesorería Municipal del Municipio de Benito Juárez, Quintana Roo identificándome con credencial No. ________________, con vigencia del __________________________ al __________________________ , me constituí en el inmueble ubicado en @if(is_object($multa->inspeccion)) {{ $multa->inspeccion->comercio->domiciliofiscal }} @else _______________________________________________, @endif en esta ciudad de Cancún, Quintana Roo, cerciorándome por medio de _________________________________________________________________</p> 
	<p class="cn-contenido-general mbt-0">_____________________________________________________________________________________________________________</p>
	<p class="cn-contenido-general mbt-0">_____________________________________________________________________________________________________________</p>

	<p class="cn-contenido-general">que es el domicilio de la persona al rubro citada, y considerando que el día _______ del mes de __________________ del año _____ se dejó citatorio en poder del C. _________________________________________________ en su carácter de _________________________________________________, y toda vez que ni la persona citada ni el propietario, representante o apoderado legal, atendieron el citatorio, hago efectivo el apercibimiento contenido en el citatorio aludido, y practico la diligencia con _________________________________________________ persona que encontré en el domicilio en el que actúo, quien se identifica con _____________________________________________. Con fundamento en el artículo 37 tercer párrafo del Código de Justicia Administrativa de Quintana Roo, procedo a notificar para todos los efectos legales a que haya lugar, original con firma autógrafa de la resolución de fecha _______________________ con número de oficio <b>{{ $inspeccion->folio }}</b> constante de ________fojas dictada por el Ingeniero {{ $inspeccion->formavalorada->encargado->nombre }} {{ $inspeccion->formavalorada->encargado->apellidopaterno }} {{ $inspeccion->formavalorada->encargado->apellidomaterno }}, en su  carácter  de Director de Fiscalización de la Tesorería del Municipio de Benito Juárez, Quintana Roo, asimismo hago entrega de copia de la presente cédula. Esta notificación surtirá efectos el mismo día en el que fue practicada y los términos empezarán a correr el día hábil siguiente del en que haya surtido efectos la notificación, de conformidad con lo establecido en el artículo 39, del Código de Justicia Administrativa del Estado de Quintana Roo.</p>
	
	<table class="firma-final mt-10">
	  <tr>
	    <td>
	    	<b>EL C. NOTIFICADOR</b>
	    	<p>_________________________________</p>
	    </td>
	    <td>
	    	<b>EL INTERESADO</b>
	    	<p>_________________________________</p>
	    </td>
	  </tr>
	</table>

	<div class="page_break"></div>

	<img src="{{ asset('img/header-logo-simple.jpg') }}" width="100%">

	<h1 class="mb-0">NOTIFICACIÓN PREVIO CITATORIO</h1>
	<p class="cn-subtitulo text-center mt-0"><b>(Por instructivo, previo citatorio, con quien esté y se niega a recibir)</b></p>

	<p class="cn-header-datos"><b>PROPIETARIO, REPRESENTANTE <br> O APODERADO LEGAL <br> DE @if(is_object($multa->inspeccion)) {{ $multa->inspeccion->comercio->denominacion }}, @else __________________________________________ @endif</b></p>
	
	<p class="cn-contenido-general mb-0">En _______________________________________siendo las ____ horas con _____ minutos del dia _____ del mes de _____________________ del año ______, el C. _____________________________________________________ notificador-ejecutor adscrito a la Dirección de Fiscalización de la Tesorería Municipal del Municipio de Benito Juárez, Quintana Roo identificándome con credencial No. ___________________ con vigencia del _________________________ al _________________________, me constituí en el inmueble ubicado en @if(is_object($multa->inspeccion)) {{ $multa->inspeccion->comercio->domiciliofiscal }} @else _______________________________________________, @endif en esta ciudad de Cancún, Quintana Roo, cerciorándome por medio de ____________________________________________________________________________________________________</p>
	<p class="cn-contenido-general mbt-0">_____________________________________________________________________________________________________________</p>
	<p class="cn-contenido-general mbt-0">_____________________________________________________________________________________________________________</p>

	<p class="cn-contenido-general">que es el domicilio de la persona al rubro citada, y considerando que el día _____ del mes de _______________ del año _____ se dejó citatorio en poder del C. ________________________________________________ en su carácter  de ________________________________________________, y toda vez que ni la persona citada ni el propietario, representante o apoderado legal, atendieron el citatorio, hago efectivo el apercibimiento contenido en el citatorio aludido, y practico la diligencia con ________________________________________________ en su carácter de (________________________________________________) vecino (________) persona que encontré en el domicilio en el que actúo, quien se niega a recibir la presente notificación; por lo que con fundamento en el artículo 37 segundo y tercer párrafo del Código de Justicia Administrativa del Estado de Quintana Roo, procedo a notificar al interesado o a su representante legal, por medio de instructivo, el original con firma autógrafa de la resolución de fecha _________________________, con número de oficio <b>{{ $inspeccion->folio }}</b> constante de ________fojas dictada por el Ingeniero {{ $inspeccion->formavalorada->encargado->nombre }} {{ $inspeccion->formavalorada->encargado->apellidopaterno }} {{ $inspeccion->formavalorada->encargado->apellidomaterno }}, en su  carácter  de Director de Fiscalización de la Tesorería del Municipio de Benito Juárez, Quintana Roo fijándolo en la puerta del domicilio del interesado, así como copia de la presente cédula y asentando razón de tal circunstancia. Esta notificación surtirá efectos el mismo día en el que fue practicada y los términos empezarán a correr el día hábil siguiente del en que haya surtido efectos la notificación, de conformidad con lo establecido en el artículo 39, del Código de Justicia Administrativa del Estado de Quintana Roo.</p>

	<table class="firma-final mt-10">
	  <tr>
	    <td>
	    	<b>EL C. NOTIFICADOR</b>
	    	<p>_________________________________</p>
	    </td>
	  </tr>
	</table>

	<div class="page_break"></div>

	<!-- http://localhost/fiscalizacion/public/pdf/descargar-multas/31 -->

	<img src="{{ asset('img/header-logo-simple.jpg') }}" width="100%">


	<h1 class="mb-0">NOTIFICACIÓN PREVIO CITATORIO</h1>
	<p class="cn-subtitulo text-center mt-0"><b>(Por instructivo, domicilio cerrado)</b></p>

	<p class="cn-header-datos"><b>PROPIETARIO, REPRESENTANTE <br> O APODERADO LEGAL <br> DE @if(is_object($multa->inspeccion)) {{ $multa->inspeccion->comercio->denominacion }}, @else __________________________________________ @endif</b></p>

	<p class="cn-contenido-general mb-0">En ________________________________ siendo las ____ horas con _____ minutos del día ______ del mes de ____________________ del año _____, el C. _________________________________________________ notificador-ejecutor adscrito a la Dirección de Fiscalización de la Tesorería Municipal del Municipio de Benito Juárez, Quintana Roo identificándome con credencial No. ________________ con vigencia del ________________________ al ________________________, me constituí en el inmueble ubicado en @if(is_object($multa->inspeccion)) {{ $multa->inspeccion->comercio->domiciliofiscal }} @else _______________________________________________, @endif en esta ciudad de Cancún, Quintana Roo, cerciorándome por medio de ____________________________________________________________________________________________________________</p>

	<p class="cn-contenido-general mbt-0">_____________________________________________________________________________________________________________</p>
	<p class="cn-contenido-general mbt-0">_____________________________________________________________________________________________________________</p>

	<p class=" cn-contenido-general">que es el domicilio de la persona al rubro citada, y considerando que el día _______ del mes de ______________ del año _______ se dejó citatorio en poder del C. ___________________________________________ en su carácter  de ___________________________________________, y toda vez que el domicilio se encuentra cerrado y que en forma reiterada e insistente toqué la puerta del mismo sin que haya sido atendido el llamado, hago efectivo el apercibimiento contenido en el citatorio aludido; por lo que con fundamento en el artículo 37 segundo y tercer párrafo del Código de Justicia Administrativa del Estado de Quintana Roo, procedo a notificar por instructivo al interesado o a su representante legal, por medio de instructivo, el original con firma autógrafa de la resolución de fecha _______________________ con número de oficio <b>{{ $inspeccion->folio }}</b>, constante de ________fojas, dictada por el Ingeniero {{ $inspeccion->formavalorada->encargado->nombre }} {{ $inspeccion->formavalorada->encargado->apellidopaterno }} {{ $inspeccion->formavalorada->encargado->apellidomaterno }}, en su  carácter  de Director de Fiscalización de la Tesorería del Municipio de Benito Juárez, Quintana Roo fijándolo en la puerta del domicilio del interesado, así como copia de la presente cédula y asentando razón de tal circunstancia. Esta notificación surtirá efectos el mismo día en el que fue practicada y los términos empezarán a correr el día hábil siguiente del en que haya surtido efectos la notificación, de conformidad con lo establecido en el artículo 39, del Código de Justicia Administrativa del Estado de Quintana Roo.</p>

	<table class="firma-final mt-10">
	  <tr>
	    <td>
	    	<b>EL C. NOTIFICADOR</b>
	    	<p>_________________________________</p>
	    </td>
	  </tr>
	</table>

	@endforeach
</body>
</html>