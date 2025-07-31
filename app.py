from flask import Flask, render_template, request, jsonify
import pyodbc
import os
from dotenv import load_dotenv
import logging
from contextlib import contextmanager

# Cargar variables de entorno
load_dotenv()
app = Flask(__name__)
app.secret_key = os.getenv('FLASK_SECRET_KEY', 'qxal_secret_key_2025')

# Configurar logging
logging.basicConfig(level=logging.INFO)
logger = logging.getLogger(__name__)

# Configuración de la base de datos SQL Server
DB_CONFIG = {
    'server': os.getenv('DB_SERVER', 'localhost'),
    'database': os.getenv('DB_DATABASE', 'qxal'),
    'username': os.getenv('DB_USERNAME', 'sa'),
    'password': os.getenv('DB_PASSWORD', 'bjs#5854261'),
    'driver': os.getenv('DB_DRIVER', 'ODBC Driver 18 for SQL Server'),
    'port': os.getenv('DB_PORT', '1433')
}

def get_connection_string():
    """Construir cadena de conexión para SQL Server"""
    return (
        f"DRIVER={{{DB_CONFIG['driver']}}};"
        f"SERVER={DB_CONFIG['server']},{DB_CONFIG['port']};"
        f"DATABASE={DB_CONFIG['database']};"
        f"UID={DB_CONFIG['username']};"
        f"PWD={DB_CONFIG['password']};"
        f"Encrypt=yes;"
        f"TrustServerCertificate=yes;"
        f"Connection Timeout=30;"
    )

@contextmanager
def get_db_connection():
    """Obtener conexión a la base de datos SQL Server"""
    conn = None
    try:
        connection_string = get_connection_string()
        conn = pyodbc.connect(connection_string)
        conn.autocommit = False
        logger.info("Conexión a base de datos establecida exitosamente")
        yield conn
    except pyodbc.Error as e:
        logger.error(f"Error de base de datos: {e}")
        if conn:
            conn.rollback()
        raise Exception(f"Error de conexión a la base de datos: {e}")
    except Exception as e:
        logger.error(f"Error inesperado: {e}")
        if conn:
            conn.rollback()
        raise
    finally:
        if conn:
            conn.close()
            logger.info("Conexión a base de datos cerrada")

def test_db_connection():
    """Probar la conexión a la base de datos"""
    try:
        with get_db_connection() as conn:
            cursor = conn.cursor()
            cursor.execute("SELECT 1")
            result = cursor.fetchone()
            return True
    except Exception as e:
        logger.error(f"Prueba de conexión falló: {e}")
        return False

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
            "text": "Mi hijo de 8 años ama Qxal Su enfoque ha mejorado significativamente desde que comenzó a jugar.",
            "rating": 5
        },
        {
            "name": "Eliseo",
            "role": "Jefe de plaza",
            "text": "Recomiendo Qxal a todos mis punteros. Siempre veo mejoras en su atención y memoria.",
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
        try:
            data = request.get_json()
            name = data.get('name')
            email = data.get('email')
            subject = data.get('subject')
            message = data.get('message')
            
            # Validar datos requeridos
            if not all([name, email, subject, message]):
                return jsonify({"Estado": "Error", "mensaje": "Todos los campos son requeridos"}), 400
            
            # Guardar en base de datos
            with get_db_connection() as conn:
                cursor = conn.cursor()
                cursor.execute('''
                    INSERT INTO contactos (nombre, email, asunto, mensaje, fecha_envio)
                    VALUES (?, ?, ?, ?, GETDATE())
                ''', (name, email, subject, message))
                conn.commit()
                logger.info(f"Mensaje de contacto guardado: {email}")
            
            return jsonify({"Estado": "Exitoso", "mensaje": "¡Gracias por tu mensaje! Te contactaremos pronto."})
            
        except Exception as e:
            logger.error(f"Error al procesar mensaje de contacto: {e}")
            return jsonify({"Estado": "Error", "mensaje": "Error interno del servidor"}), 500
    
    return render_template('contact.html')

@app.route('/api/newsletter', methods=['POST'])
def newsletter_signup():
    try:
        data = request.get_json()
        email = data.get('email')
        
        if not email:
            return jsonify({"Estado": "Error", "mensaje": "Email es requerido"}), 400
        
        # Guardar en base de datos
        with get_db_connection() as conn:
            cursor = conn.cursor()
            try:
                cursor.execute('''
                    INSERT INTO suscripciones (email, fecha_suscripcion)
                    VALUES (?, GETDATE())
                ''', (email,))
                conn.commit()
                logger.info(f"Nueva suscripción al newsletter: {email}")
                return jsonify({"Estado": "Exitoso", "mensaje": "¡Gracias por suscribirte a nuestro newsletter!"})
            
            except pyodbc.IntegrityError:
                # Email ya existe en la base de datos
                logger.warning(f"Intento de suscripción duplicada: {email}")
                return jsonify({"Estado": "Info", "mensaje": "Este email ya está suscrito a nuestro newsletter"})
                
    except Exception as e:
        logger.error(f"Error al procesar suscripción al newsletter: {e}")
        return jsonify({"Estado": "Error", "mensaje": "Error interno del servidor"}), 500
    
def init_db():
    """Inicializar la base de datos SQL Server"""
    try:
        with get_db_connection() as conn:
            cursor = conn.cursor()
            cursor.execute('''
                IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='suscripciones' AND xtype='U')
                CREATE TABLE suscripciones (
                    id INT IDENTITY(1,1) PRIMARY KEY,
                    email NVARCHAR(255) UNIQUE NOT NULL,
                    fecha_suscripcion DATETIME2 DEFAULT GETDATE(),
                    activo BIT DEFAULT 1
                )
            ''')
            cursor.execute('''
                IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='contactos' AND xtype='U')
                CREATE TABLE contactos (
                    id INT IDENTITY(1,1) PRIMARY KEY,
                    nombre NVARCHAR(100) NOT NULL,
                    email NVARCHAR(255) NOT NULL,
                    asunto NVARCHAR(200) NOT NULL,
                    mensaje NTEXT NOT NULL,
                    fecha_envio DATETIME2 DEFAULT GETDATE(),
                    leido BIT DEFAULT 0
                )
            ''')
            conn.commit()
            logger.info("Base de datos inicializada correctamente")
            
    except Exception as e:
        logger.error(f"Error al inicializar la base de datos: {e}")
        raise

if __name__ == '__main__':
    try:
        # Probar conexión a la base de datos
        logger.info("Probando conexión a la base de datos...")
        if test_db_connection():
            logger.info("Conexión a base de datos exitosa")
            
            # Inicializar tablas de base de datos
            logger.info("Inicializando tablas de base de datos...")
            init_db()
            logger.info("Tablas inicializadas correctamente")
            
            # Ejecutar aplicación
            app.run(
                debug=os.getenv('FLASK_ENV') == 'development',
                host='0.0.0.0',
                port=int(os.getenv('FLASK_PORT', 5000))
            )
        else:
            logger.error("No se pudo conectar a la base de datos. Verifica la configuración.")
            print("Error: No se pudo conectar a la base de datos SQL Server.")
            print("Verifica:")
            print("1. Que SQL Server esté ejecutándose")
            print("2. Las credenciales en el archivo .env")
            print("3. Que la base de datos exista")
            print("4. Los drivers ODBC estén instalados")
    except Exception as e:
        logger.error(f"Error al iniciar la aplicación: {e}")
        print(f"Error critico: {e}")