from flask import Flask, render_template, request, jsonify
import os
from dotenv import load_dotenv
import logging

# Cargar variables de entorno
load_dotenv()
app = Flask(__name__)
app.secret_key = os.getenv('FLASK_SECRET_KEY', 'qxal_secret_key_2025')

# Configurar logging
logging.basicConfig(level=logging.INFO)
logger = logging.getLogger(__name__)

game_data = {
    "Caracteristicas": [
        {
            "title": "Memoria",
            "description": "Juegos de memoria divertidos que ayudan a los niños a recordar patrones, secuencias e información importante.",
            "icon": "brain",
            "age_group": "6-12 años"
        },
        {
            "title": "Resolución de Problemas",
            "description": "Juegos que desarrollan el pensamiento lógico y las habilidades analíticas.",
            "icon": "puzzle-piece",
            "age_group": "7-12 años"
        },
        {
            "title": "Entrenamiento de atención",
            "description": "Actividades que mejoran la concentración y reducen las distracciones.",
            "icon": "eye",
            "age_group": "6-11 años"
        },
        {
            "title": "Rapidez Mental",
            "description": "Juegos de pensamiento rápido que mejoran la agilidad mental y el tiempo de reacción.",
            "icon": "bolt-lightning",
            "age_group": "8-12 años"
        }
    ],
    "Testimonios": [
        {
            "name": "Martha",
            "role": "Madre",
            "text": "Mi hijo de 8 años ama Qxal Academy Su enfoque ha mejorado significativamente desde que comenzó a jugar.",
            "rating": 5
        },
        {
            "name": "Eliseo",
            "role": "Jefe de plaza",
            "text": "Recomiendo Qxal Academy a todos mis punteros. Siempre veo mejoras en su atención y memoria.",
            "rating": 5
        }
    ],
    "Estadisticas": {
        "jugadores": "1000+",
        "escuelas": "15+",
        "paises": "2+"
    }
}

@app.route('/')
def home():
    data = {
        "features": game_data["Caracteristicas"],
        "testimonials": game_data["Testimonios"],
        "stats": {
            "players": game_data["Estadisticas"]["jugadores"],
            "schools": game_data["Estadisticas"]["escuelas"],
            "countries": game_data["Estadisticas"]["paises"]
        }
    }
    return render_template('index.html', data=data)

@app.route('/Caracteristicas')
def features():
    return render_template('features.html', features=game_data['Caracteristicas'])

@app.route('/Acerca de')
def about():
    return render_template('about.html')

@app.route('/Contacto', methods=['GET', 'POST'])
def contact():
    if request.method == 'POST':
        data = request.get_json()
        # Conectarlo con la base de datos
        return jsonify({"Estado": "Exitoso", "mensaje": "¡Gracias por tu mensaje!"})
    return render_template('contact.html')

@app.route('/api/newsletter', methods=['POST'])
def newsletter_signup():
    """Endpoint para suscripción al newsletter"""
    email = request.json.get('email')
    # Aquí puedes agregar lógica para guardar el email
    logger.info(f"Nueva suscripción al newsletter: {email}")
    return jsonify({'success': True, 'message': 'Suscripción exitosa'})

if __name__ == '__main__':
    try:
        logger.info("Iniciando aplicación Qxal Academy...")
        app.run(
            debug=os.getenv('FLASK_ENV') == 'development',
            host='0.0.0.0',
            port=int(os.getenv('FLASK_PORT', 5000))
        )
    except Exception as e:
        logger.error(f"Error al iniciar la aplicación: {e}")
        print(f"Error crítico: {e}")