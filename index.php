<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bitacora CRM</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 850px;
            margin: 0 auto;
            padding: 20px;
            color: #333;
            margin-top: 60px;
        }
        h1 {
            margin-bottom: 20px;
            font-size: 24px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-weight: bold;
            margin-bottom: 10px;
        }
        .radio-group {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            align-items: center;
            margin-bottom: 15px;
        }
        .radio-option {
            display: flex;
            align-items: center;
            margin-right: 10px;
        }
        .mic-button {
            background-color: #e74c3c;
            color: white;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            margin-left: 10px;
        }
        .mic-icon {
            font-size: 16px;
        }
        input[type="text"], 
        input[type="email"], 
        input[type="tel"], 
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            background-color: #f5f5f5;
        }
        textarea {
            resize: vertical;
            min-height: 80px;
        }
        .form-row {
            display: flex;
            margin-bottom: 15px;
            align-items: center;
        }
        .form-row label {
            width: 120px;
            margin-right: 10px;
        }
        .form-field {
            flex: 1;
            position: relative;
            display: flex;
            align-items: center;
        }
        .form-field-full {
            width: 100%;
            position: relative;
            margin-bottom: 15px;
        }
        .two-columns {
            display: flex;
            gap: 20px;
        }
        .column {
            flex: 1;
        }
        .file-input {
            display: flex;
            align-items: center;
        }
        .select-wrapper {
            position: relative;
            width: 100%;
        }
        .select-wrapper:after {
            content: "▼";
            font-size: 14px;
            position: absolute;
            right: 10px;
            top: 10px;
            pointer-events: none;
        }
        select {
            appearance: none;
            padding-right: 30px;
        }
        .date-time-group {
            display: flex;
            gap: 10px;
        }
        .date-picker, .time-picker {
            flex: 1;
            position: relative;
        }
        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }
        .btn-save {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        .btn-back {
            background-color: #7f8c8d;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        .calendar-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
        }
        #status {
            padding: 10px;
            border-radius: 4px;
            margin-top: 15px;
            text-align: center;
        }
        .listening {
            background-color: #ffecb3;
        }
        .error {
            background-color: #ffcdd2;
        }
        .success {
            background-color: #c8e6c9;
        }
        .status-banner {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: #333;
            color: white;
            padding: 10px;
            z-index: 1000;
            text-align: center;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div id="status" class="status-banner" style="display:none;"></div>
    <h1>Bitacora</h1>
    <div style="display: flex; justify-content: flex-end; margin-bottom: 10px;">
        <button type="button" class="btn-save" id="dictarSecuenciaBtn" style="background-color:#2196F3; margin-right:10px;">
            <i class="fas fa-microphone"></i> Dictar todo
        </button>
    </div>
    <form id="prospectForm">
        <div class="section">
            <div class="section-title">Estado</div>
            <div class="radio-group">
                <button type="button" class="mic-button" id="estadoMic">
                    <i class="fas fa-microphone mic-icon"></i>
                </button>
                
                <div class="radio-option">
                    <input type="radio" id="estado-prospecto" name="estado" value="Prospecto">
                    <label for="estado-prospecto">Prospecto</label>
                </div>
                
                <div class="radio-option">
                    <input type="radio" id="estado-contactado" name="estado" value="Contactado">
                    <label for="estado-contactado">Contactado</label>
                </div>
                
                <div class="radio-option">
                    <input type="radio" id="estado-cotizacion" name="estado" value="Cotizacion">
                    <label for="estado-cotizacion">Cotizacion</label>
                </div>
                
                <div class="radio-option">
                    <input type="radio" id="estado-negocio" name="estado" value="En negocio">
                    <label for="estado-negocio">En negocio</label>
                </div>
                
                <div class="radio-option">
                    <input type="radio" id="estado-ganado" name="estado" value="Ganado">
                    <label for="estado-ganado">Ganado</label>
                </div>
                
                <div class="radio-option">
                    <input type="radio" id="estado-aplazado" name="estado" value="Aplazado">
                    <label for="estado-aplazado">Aplazado</label>
                </div>
                
                <div class="radio-option">
                    <input type="radio" id="estado-descartado" name="estado" value="Descartado">
                    <label for="estado-descartado">Descartado</label>
                </div>
            </div>
        </div>
        
        <div class="section">
            <div class="section-title">Temperatura</div>
            <div class="radio-group">
                <button type="button" class="mic-button" id="temperaturaMic">
                    <i class="fas fa-microphone mic-icon"></i>
                </button>
                
                <div class="radio-option">
                    <input type="radio" id="temp-frio" name="temperatura" value="Frio">
                    <label for="temp-frio">Frío</label>
                </div>
                
                <div class="radio-option">
                    <input type="radio" id="temp-tibio" name="temperatura" value="Tibio">
                    <label for="temp-tibio">Tibio</label>
                </div>
                
                <div class="radio-option">
                    <input type="radio" id="temp-caliente" name="temperatura" value="Caliente">
                    <label for="temp-caliente">Caliente</label>
                </div>
            </div>
        </div>
        
        <div class="two-columns">
            <div class="column">
                <div class="form-row">
                    <label for="nombre">Nombre</label>
                    <div class="form-field">
                        <input type="text" id="nombre" name="nombre" placeholder="Nombre">
                        <button type="button" class="mic-button" id="nombreMic">
                            <i class="fas fa-microphone mic-icon"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="column">
                <div class="form-row">
                    <label for="valor">Valor</label>
                    <div class="form-field">
                        <input type="text" id="valor" name="valor" placeholder="Valor">
                        <button type="button" class="mic-button" id="valorMic">
                            <i class="fas fa-microphone mic-icon"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="form-field-full">
            <label for="descripcion">Descripcion</label>
            <div style="display: flex; align-items: flex-start;">
                <textarea id="descripcion" name="descripcion"></textarea>
                <button type="button" class="mic-button" id="descripcionMic" style="margin-top: 10px;">
                    <i class="fas fa-microphone mic-icon"></i>
                </button>
            </div>
        </div>
        
        <div class="two-columns">
            <div class="column">
                <div class="form-row">
                    <label for="adjunto">Adjunto</label>
                    <div class="form-field file-input">
                        <input type="text" id="adjunto" name="adjunto" placeholder="Seleccionar archivo" readonly>
                        <input type="file" id="adjuntoFile" style="display:none">
                    </div>
                </div>
            </div>
            
            <div class="column">
                <div class="form-row">
                    <label for="oportunidad">Oportunidad</label>
                    <div class="form-field">
                        <div class="select-wrapper">
                            <select id="oportunidad" name="oportunidad">
                                <option value="" selected disabled>Automatizar procesos varios</option>
                                <option value="opcion1">Opción 1</option>
                                <option value="opcion2">Opción 2</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="form-row">
            <label for="tarea">Tarea</label>
            <div class="form-field">
                <input type="text" id="tarea" name="tarea" placeholder="Tarea">
                <button type="button" class="mic-button" id="tareaMic">
                    <i class="fas fa-microphone mic-icon"></i>
                </button>
            </div>
        </div>
        
        <div class="form-row" style="margin-top: 10px; margin-left: 30px;">
            <input type="checkbox" id="agregarTarea" name="agregarTarea">
            <label for="agregarTarea" style="width: auto;">Agregar Tarea al Calendario</label>
        </div>
        
        <div class="two-columns">
            <div class="column">
                <div class="form-row">
                    <label for="proximaAccion">Proxima accion</label>
                    <div class="form-field">
                        <input type="text" id="proximaAccion" name="proximaAccion" placeholder="DD/MM/AAAA">
                        <span class="calendar-icon">
                            <i class="fas fa-calendar"></i>
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="column">
                <div class="form-row">
                    <label for="hora">Hora</label>
                    <div class="form-field">
                        <input type="text" id="hora" name="hora" placeholder="--:-- --">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="form-row">
            <label for="contacto">Contacto</label>
            <div class="form-field">
                <div class="select-wrapper">
                    <select id="contacto" name="contacto">
                        <option value="" selected disabled>Seleccionar contacto</option>
                        <option value="contacto1">Contacto 1</option>
                        <option value="contacto2">Contacto 2</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="action-buttons">
            <button type="submit" class="btn-save">GUARDAR</button>
            <button type="button" class="btn-back" id="backBtn">REGRESAR</button>
        </div>
    </form>

    <script src="js/voiceRecognition.js"></script>
</body>
</html> 