from flask import Flask, render_template, request, jsonify
import pyodbc
import os
from dotenv import load_dotenv
import logging
from contextlib import contextmanager

# Cargar variables de entorno
load_dotenv()

# Configuración de logging
logging.basicConfig(level=logging.INFO)
logger = logging.getLogger(__name__)

app = Flask(__name__)
app.secret_key = os.getenv('FLASK_SECRET_KEY', 'qxal_secret_key_2025')

# Configuración de SQL Server
SQL_SERVER_CONFIG = {
    'server': os.getenv('DB_SERVER', 'localhost'),
    'database': os.getenv('DB_DATABASE', 'qxal'),
    'username': os.getenv('DB_USERNAME', ''),
    'password': os.getenv('DB_PASSWORD', ''),
    'driver': os.getenv('DB_DRIVER', '{ODBC Driver 17 for SQL Server}')
}

@contextmanager
def get_db_connection():
    """Context manager para conexiones a SQL Server"""
    conn = None
    try:
        # Construir cadena de conexión según si hay credenciales o no
        if SQL_SERVER_CONFIG['username'] and SQL_SERVER_CONFIG['password']:
            # Autenticación SQL Server
            connection_string = f"""DRIVER={SQL_SERVER_CONFIG['driver']};
                                  SERVER={SQL_SERVER_CONFIG['server']};
                                  DATABASE={SQL_SERVER_CONFIG['database']};
                                  UID={SQL_SERVER_CONFIG['username']};
                                  PWD={SQL_SERVER_CONFIG['password']};"""
        else:
            # Autenticación Windows
            connection_string = f"""DRIVER={SQL_SERVER_CONFIG['driver']};
                                  SERVER={SQL_SERVER_CONFIG['server']};
                                  DATABASE={SQL_SERVER_CONFIG['database']};
                                  Trusted_Connection=yes;"""
        
        logger.info(f"Intentando conectar a SQL Server: {SQL_SERVER_CONFIG['server']}")
        conn = pyodbc.connect(connection_string)
        logger.info("Conexión a SQL Server exitosa")
        yield conn
    except Exception as e:
        logger.error(f"Error de conexión a SQL Server: {e}")
        if conn:
            conn.rollback()
        raise
    finally:
        if conn:
            conn.close()

def get_caracteristicas_from_db():
    """Obtiene las características desde SQL Server"""
    try:
        with get_db_connection() as conn:
            cursor = conn.cursor()
            cursor.execute('SELECT id, title, description, icon, age_group FROM caracteristicas ORDER BY id')
            rows = cursor.fetchall()
            
            caracteristicas = []
            for row in rows:
                caracteristicas.append({
                    'id': row[0],
                    'title': row[1],
                    'description': row[2],
                    'icon': row[3],
                    'age_group': row[4]
                })
            
            logger.info(f"Características obtenidas desde SQL Server: {len(caracteristicas)}")
            return caracteristicas
            
    except Exception as e:
        logger.error(f"Error al obtener características: {e}")
        return []

def get_testimonios_from_db():
    """Obtiene los testimonios desde SQL Server"""
    try:
        with get_db_connection() as conn:
            cursor = conn.cursor()
            cursor.execute('SELECT id, name, role, text, rating FROM testimonios ORDER BY id')
            rows = cursor.fetchall()
            
            testimonios = []
            for row in rows:
                testimonios.append({
                    'id': row[0],
                    'name': row[1],
                    'role': row[2],
                    'text': row[3],
                    'rating': row[4]
                })
            
            logger.info(f"Testimonios obtenidos desde SQL Server: {len(testimonios)}")
            return testimonios
            
    except Exception as e:
        logger.error(f"Error al obtener testimonios: {e}")
        return []

def get_estadisticas_from_db():
    """Obtiene las estadísticas desde SQL Server"""
    try:
        with get_db_connection() as conn:
            cursor = conn.cursor()
            cursor.execute('SELECT jugadores, escuelas, paises FROM estadisticas')
            row = cursor.fetchone()
            
            if row:
                estadisticas = {
                    'jugadores': row[0],
                    'escuelas': row[1],
                    'paises': row[2]
                }
                logger.info("Estadísticas obtenidas desde SQL Server")
                return estadisticas
            else:
                return {'jugadores': 0, 'escuelas': 0, 'paises': 0}
            
    except Exception as e:
        logger.error(f"Error al obtener estadísticas: {e}")
        return {'jugadores': 0, 'escuelas': 0, 'paises': 0}

@app.route('/')
def home():
    data = {
        "features": get_caracteristicas_from_db(),
        "testimonials": get_testimonios_from_db(),
        "stats": get_estadisticas_from_db()
    }
    return render_template('index.html', data=data)

@app.route('/Caracteristicas')
def features():
    return render_template('features.html', features=get_caracteristicas_from_db())

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

@app.route('/api/caracteristicas', methods=['GET'])
def api_caracteristicas():
    """API endpoint para obtener características"""
    try:
        caracteristicas = get_caracteristicas_from_db()
        return jsonify({
            'success': True,
            'data': caracteristicas,
            'count': len(caracteristicas)
        })
    except Exception as e:
        logger.error(f"Error en API de características: {e}")
        return jsonify({
            'success': False,
            'error': 'Error al obtener características',
            'message': str(e)
        }), 500

@app.route('/api/testimonios', methods=['GET'])
def api_testimonios():
    """API endpoint para obtener testimonios"""
    try:
        testimonios = get_testimonios_from_db()
        return jsonify({
            'success': True,
            'data': testimonios,
            'count': len(testimonios)
        })
    except Exception as e:
        logger.error(f"Error en API de testimonios: {e}")
        return jsonify({
            'success': False,
            'error': 'Error al obtener testimonios',
            'message': str(e)
        }), 500

@app.route('/api/estadisticas', methods=['GET'])
def api_estadisticas():
    """API endpoint para obtener estadísticas"""
    try:
        estadisticas = get_estadisticas_from_db()
        return jsonify({
            'success': True,
            'data': estadisticas
        })
    except Exception as e:
        logger.error(f"Error en API de estadísticas: {e}")
        return jsonify({
            'success': False,
            'error': 'Error al obtener estadísticas',
            'message': str(e)
        }), 500

@app.route('/api/newsletter', methods=['POST'])
def newsletter_signup():
    """Endpoint para suscripción al newsletter"""
    email = request.json.get('email')
    # Aquí puedes agregar lógica para guardar el email
    logger.info(f"Nueva suscripción al newsletter: {email}")
    return jsonify({'success': True, 'message': 'Suscripción exitosa'})

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
        print(f"Error crítico: {e}")