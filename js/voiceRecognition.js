document.addEventListener('DOMContentLoaded', function() {
    // Check if browser supports SpeechRecognition
    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    
    if (!SpeechRecognition) {
        alert("Tu navegador no soporta el reconocimiento de voz. Por favor, utiliza Chrome, Edge o Safari.");
        document.querySelectorAll('.mic-button').forEach(btn => btn.disabled = true);
        return;
    }
    
    const recognition = new SpeechRecognition();
    const statusDiv = document.getElementById('status');
    
    // Configure recognition
    recognition.lang = 'es-ES';
    recognition.continuous = false;
    recognition.interimResults = false;
    
    // Setup mic buttons for each field
    setupMicButton('estadoMic', procesarEstado);
    setupMicButton('temperaturaMic', procesarTemperatura);
    setupMicButton('nombreMic', function(transcript) {
        document.getElementById('nombre').value = transcript;
    });
    setupMicButton('valorMic', function(transcript) {
        document.getElementById('valor').value = transcript;
    });
    setupMicButton('descripcionMic', function(transcript) {
        document.getElementById('descripcion').value = transcript;
    });
    setupMicButton('tareaMic', function(transcript) {
        document.getElementById('tarea').value = transcript;
    });
    
    // Setup file input
    document.getElementById('adjunto').addEventListener('click', function() {
        document.getElementById('adjuntoFile').click();
    });
    
    document.getElementById('adjuntoFile').addEventListener('change', function() {
        if (this.files.length > 0) {
            document.getElementById('adjunto').value = this.files[0].name;
        }
    });
    
    // Button functionality
    document.getElementById('backBtn').addEventListener('click', function() {
        if (confirm('¿Está seguro que desea regresar sin guardar?')) {
            window.history.back();
        }
    });
    
    // Setup date and calendar fields
    document.getElementById('proximaAccion').addEventListener('focus', function() {
        // In a real implementation, would show a date picker
        console.log('Date picker would show here');
    });
    
    const dictarSecuenciaBtn = document.getElementById('dictarSecuenciaBtn');
    let secuenciaActiva = false;
    let secuenciaIndex = 0;
    const secuenciaCampos = [
        { id: 'estado', prompt: 'Diga el estado: prospecto, contactado, cotización, en negocio, ganado, aplazado o descartado', fn: procesarEstado },
        { id: 'temperatura', prompt: 'Diga la temperatura: frío, tibio o caliente', fn: procesarTemperatura },
        { id: 'nombre', prompt: 'Diga el nombre', fn: function(t) { document.getElementById('nombre').value = t; } },
        { id: 'valor', prompt: 'Diga el valor', fn: function(t) { document.getElementById('valor').value = t; } },
        { id: 'descripcion', prompt: 'Diga la descripción', fn: function(t) { document.getElementById('descripcion').value = t; } },
        { id: 'tarea', prompt: 'Diga la tarea', fn: function(t) { document.getElementById('tarea').value = t; } }
    ];

    function showStatus(msg, className) {
        statusDiv.textContent = msg;
        statusDiv.className = 'status-banner ' + (className || '');
        statusDiv.style.display = 'block';
    }
    function hideStatus() {
        statusDiv.textContent = '';
        statusDiv.style.display = 'none';
    }

    dictarSecuenciaBtn.addEventListener('click', function() {
        if (secuenciaActiva) return;
        secuenciaActiva = true;
        secuenciaIndex = 0;
        dictarSecuenciaBtn.textContent = 'Dictando...';
        dictarSecuenciaBtn.disabled = true;
        avanzarSecuencia();
    });

    function avanzarSecuencia() {
        if (secuenciaIndex >= secuenciaCampos.length) {
            secuenciaActiva = false;
            dictarSecuenciaBtn.textContent = 'Dictar todo';
            dictarSecuenciaBtn.disabled = false;
            showStatus('Dictado completado. Revise la información antes de guardar.', 'success');
            setTimeout(hideStatus, 3000);
            return;
        }
        const campo = secuenciaCampos[secuenciaIndex];
        showStatus(campo.prompt, 'listening');
        let huboResultado = false;
        setTimeout(() => {
            recognition.onresult = function(event) {
                huboResultado = true;
                const transcript = event.results[0][0].transcript;
                campo.fn(transcript);
                secuenciaIndex++;
                setTimeout(avanzarSecuencia, 800);
            };
            recognition.onerror = function(event) {
                showStatus(`Error: ${event.error}. Intente nuevamente.`, 'error');
                secuenciaActiva = false;
                dictarSecuenciaBtn.textContent = 'Dictar todo';
                dictarSecuenciaBtn.disabled = false;
            };
            recognition.onend = function() {
                if (!huboResultado && secuenciaActiva) {
                    showStatus('No se detectó audio. Intente nuevamente.', 'error');
                    secuenciaActiva = false;
                    dictarSecuenciaBtn.textContent = 'Dictar todo';
                    dictarSecuenciaBtn.disabled = false;
                }
            };
            recognition.start();
        }, 1000);
    }
    
    function setupMicButton(buttonId, processFunction) {
        const button = document.getElementById(buttonId);
        if (!button) return;
        
        button.addEventListener('click', function() {
            startListening(this, processFunction);
        });
    }
    
    function startListening(button, processFunction) {
        document.querySelectorAll('.mic-button').forEach(btn => {
            btn.style.backgroundColor = '#e74c3c';
        });
        button.style.backgroundColor = '#27ae60';
        showStatus('Hable ahora para dictar el campo seleccionado', 'listening');
        let huboResultado = false;
        recognition.onresult = function(event) {
            huboResultado = true;
            const transcript = event.results[0][0].transcript;
            processFunction(transcript);
            endListening();
        };
        recognition.onerror = function(event) {
            showStatus(`Error: ${event.error}. Intente nuevamente.`, 'error');
            endListening();
        };
        recognition.onend = function() {
            if (!huboResultado) {
                showStatus('No se detectó audio. Intente nuevamente.', 'error');
                setTimeout(hideStatus, 2500);
            } else {
                setTimeout(hideStatus, 1000);
            }
            endListening();
        };
        recognition.start();
    }
    
    function endListening() {
        document.querySelectorAll('.mic-button').forEach(btn => {
            btn.style.backgroundColor = '#e74c3c';
        });
    }
    
    function procesarEstado(transcript) {
        const lowerTranscript = transcript.toLowerCase();
        
        if (lowerTranscript.includes('prospecto')) {
            document.getElementById('estado-prospecto').checked = true;
        } else if (lowerTranscript.includes('contactado')) {
            document.getElementById('estado-contactado').checked = true;
        } else if (lowerTranscript.includes('cotizacion') || lowerTranscript.includes('cotización')) {
            document.getElementById('estado-cotizacion').checked = true;
        } else if (lowerTranscript.includes('negocio')) {
            document.getElementById('estado-negocio').checked = true;
        } else if (lowerTranscript.includes('ganado')) {
            document.getElementById('estado-ganado').checked = true;
        } else if (lowerTranscript.includes('aplazado')) {
            document.getElementById('estado-aplazado').checked = true;
        } else if (lowerTranscript.includes('descartado')) {
            document.getElementById('estado-descartado').checked = true;
        } else {
            // If no match, give feedback
            statusDiv.textContent = "No se reconoció un estado válido. Intente nuevamente.";
            statusDiv.className = 'error';
        }
    }
    
    function procesarTemperatura(transcript) {
        const lowerTranscript = transcript.toLowerCase();
        
        if (lowerTranscript.includes('frío') || lowerTranscript.includes('frio')) {
            document.getElementById('temp-frio').checked = true;
        } else if (lowerTranscript.includes('tibio')) {
            document.getElementById('temp-tibio').checked = true;
        } else if (lowerTranscript.includes('caliente')) {
            document.getElementById('temp-caliente').checked = true;
        } else {
            // If no match, give feedback
            statusDiv.textContent = "No se reconoció una temperatura válida. Intente nuevamente.";
            statusDiv.className = 'error';
        }
    }
    
    // Form submission handling
    document.getElementById('prospectForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Check if required fields are filled
        const nombre = document.getElementById('nombre').value.trim();
        if (!nombre) {
            showStatus("El nombre es obligatorio.", 'error');
            return;
        }

        // Formato de fecha: DD/MM/AAAA a YYYY-MM-DD
        const proximaAccionInput = document.getElementById('proximaAccion');
        let proximaAccion = proximaAccionInput.value.trim();
        if (proximaAccion) {
            const fechaParts = proximaAccion.split('/');
            if (fechaParts.length === 3) {
                // Si el usuario puso DD/MM/AAAA
                proximaAccion = `${fechaParts[2]}-${fechaParts[1].padStart(2, '0')}-${fechaParts[0].padStart(2, '0')}`;
            }
        } else {
            proximaAccion = '';
        }
        proximaAccionInput.value = proximaAccion;

        // Formato de hora: HH:MM AM/PM a HH:MM:SS (24h)
        const horaInput = document.getElementById('hora');
        let hora = horaInput.value.trim();
        if (hora) {
            // Si el usuario puso AM/PM
            let match = hora.match(/^(\d{1,2}):(\d{2})\s*([APap][Mm])$/);
            if (match) {
                let h = parseInt(match[1], 10);
                const m = match[2];
                const ampm = match[3].toUpperCase();
                if (ampm === 'PM' && h < 12) h += 12;
                if (ampm === 'AM' && h === 12) h = 0;
                hora = `${h.toString().padStart(2, '0')}:${m}:00`;
            } else if (/^\d{1,2}:\d{2}$/.test(hora)) {
                // Si el usuario puso solo HH:MM
                hora = `${hora}:00`;
            }
        } else {
            hora = '';
        }
        horaInput.value = hora;

        // Create FormData object
        const formData = new FormData(this);
        
        // Add the file if it exists
        const adjuntoFile = document.getElementById('adjuntoFile');
        if (adjuntoFile.files.length > 0) {
            formData.append('adjuntoFile', adjuntoFile.files[0]);
        }

        // Show loading status
        showStatus("Guardando...", 'listening');
        
        // Send AJAX request
        fetch('save_bitacora.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showStatus(data.message, 'success');
                // Clear form after successful save
                this.reset();
                // Reset all radio buttons
                document.querySelectorAll('input[type="radio"]').forEach(radio => radio.checked = false);
            } else {
                showStatus(data.message, 'error');
            }
        })
        .catch(error => {
            showStatus("Error al guardar: " + error.message, 'error');
        });
    });
}); 