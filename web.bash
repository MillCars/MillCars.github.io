$ pip install -U Flask

pip install gunicorn


from flask import Flask, request, jsonify
from werkzeug.security import generate_password_hash, check_password_hash

app = Flask(__name__)

# Пример базы данных (в реальном проекте используйте базу данных)
users = {}

@app.route('/register', methods=['POST'])
def register():
    data = request.get_json()

    username = data.get('username')
    email = data.get('email')
    password = data.get('password')

    # Генерация соли и хеширование пароля
    salt = "random_salt"  # Замените на генерацию случайной соли
    hashed_password = generate_password_hash(password + salt, method='sha256')

    # Сохранение пользователя в "базе данных"
    users[email] = {'username': username, 'email': email, 'password': hashed_password, 'salt': salt}

    return jsonify({'message': 'User registered successfully'})

@app.route('/login', methods=['POST'])
def login():
    data = request.get_json()

    email = data.get('email')
    password = data.get('password')

    user = users.get(email)

    if user and check_password_hash(user['password'], password + user['salt']):
        return jsonify({'message': 'Login successful'})
    else:
        return jsonify({'message': 'Invalid credentials'})

if __name__ == '__main__':
    app.run(debug=True)


from flask import Flask, render_template, request, jsonify

app = Flask(__name__)

# Пример базы данных (в реальном проекте используйте базу данных)
users = {}

@app.route('/register', methods=['POST'])
def register():
    data = request.form

    username = data.get('username')
    email = data.get('email')
    password = data.get('password')

    # Проверка наличия уникального адреса электронной почты
    if email in users:
        return jsonify({'error': 'Email address already registered'})

    # Другие проверки на валидность данных могут быть добавлены здесь

    # Добавление пользователя в "базу данных"
    users[email] = {'username': username, 'email': email, 'password': password}

    return jsonify({'message': 'User registered successfully'})

if __name__ == '__main__':
    app.run(debug=True)


python app.py


pip install Flask SQLAlchemy


from flask import Flask, request, jsonify
from flask_sqlalchemy import SQLAlchemy
from werkzeug.security import generate_password_hash, check_password_hash

app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///users.db'  # Используйте другую базу данных по необходимости
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False

db = SQLAlchemy(app)

class User(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    username = db.Column(db.String(80), unique=True, nullable=False)
    email = db.Column(db.String(120), unique=True, nullable=False)
    password = db.Column(db.String(200), nullable=False)
    salt = db.Column(db.String(50), nullable=False)

@app.route('/register', methods=['POST'])
def register():
    data = request.get_json()

    username = data.get('username')
    email = data.get('email')
    password = data.get('password')

    # Проверка наличия уникального адреса электронной почты
    if User.query.filter_by(email=email).first():
        return jsonify({'error': 'Email address already registered'})

    # Генерация соли и хеширование пароля
    salt = "random_salt"  # Замените на генерацию случайной соли
    hashed_password = generate_password_hash(password + salt, method='sha256')

    # Добавление пользователя в базу данных
    new_user = User(username=username, email=email, password=hashed_password, salt=salt)
    db.session.add(new_user)
    db.session.commit()

    return jsonify({'message': 'User registered successfully'})

@app.route('/login', methods=['POST'])
def login():
    data = request.get_json()

    email = data.get('email')
    password = data.get('password')

    user = User.query.filter_by(email=email).first()

    if user and check_password_hash(user.password, password + user.salt):
        return jsonify({'message': 'Login successful'})
    else:
        return jsonify({'message': 'Invalid credentials'})

if __name__ == '__main__':
    db.create_all()
    app.run(debug=True)



from flask import Flask, render_template, request, session
import os

app = Flask(__name__)
app.config['SECRET_KEY'] = os.urandom(24)  # Генерация случайного секретного ключа

@app.before_request
def csrf_protect():
    if request.method == 'POST':
        token = session.pop('_csrf_token', None)
        if not token or token != request.form.get('_csrf_token'):
            abort(403)

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/form', methods=['POST'])
def process_form():

    <form method="post" action="/form">
    <input type="hidden" name="_csrf_token" value="{{ csrf_token() }}">
    <!-- Остальные поля формы -->
    <button type="submit">Отправить</button>
</form>

    return 'Form processed successfully'



from flask_sqlalchemy import SQLAlchemy

db = SQLAlchemy()

# Небезопасно (подвержено инъекциям):
result = db.session.execute(f"SELECT * FROM users WHERE username = '{user_input}'")

# Безопасно (используйте параметризованный запрос):
result = db.session.execute("SELECT * FROM users WHERE username = :username", {'username': user_input})


from flask import Flask
from flask_bcrypt import Bcrypt

app = Flask(__name__)
bcrypt = Bcrypt(app)

password = "user_password"
hashed_password = bcrypt.generate_password_hash(password).decode('utf-8')


from flask import Flask, session
import os

app = Flask(__name__)
app.config['SECRET_KEY'] = os.urandom(24)  # Генерация случайного секретного ключа

@app.route('/')
def index():
    session['user_id'] = 1
    return 'Session set'

@app.route('/get')
def get_session():
    user_id = session.get('user_id')
    return f'User ID: {user_id}'




import logging
from flask import Flask, render_template, redirect, url_for, session, request
from flask_sqlalchemy import SQLAlchemy
from werkzeug.security import generate_password_hash, check_password_hash

app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///users.db'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
app.config['SECRET_KEY'] = 'your_secret_key'

db = SQLAlchemy(app)

# Настройка логирования
logging.basicConfig(filename='app.log', level=logging.INFO, format='%(asctime)s [%(levelname)s] %(message)s')

class User(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    username = db.Column(db.String(80), unique=True, nullable=False)
    email = db.Column(db.String(120), unique=True, nullable=False)
    password = db.Column(db.String(200), nullable=False)
    salt = db.Column(db.String(50), nullable=False)

@app.route('/register', methods=['POST'])
def register():
    data = request.get_json()

    username = data.get('username')
    email = data.get('email')
    password = data.get('password')

    # ... (код регистрации пользователя)

    logging.info(f"New user registered: {username}, {email}")

    return render_template('registration_confirmation.html')

@app.route('/login', methods=['POST'])
def login():
    data = request.get_json()

    email = data.get('email')
    password = data.get('password')

    user = User.query.filter_by(email=email).first()

    if user and check_password_hash(user.password, password + user.salt):
        session['user_id'] = user.id
        logging.info(f"User logged in: {user.username}, {user.email}")
        return render_template('login_confirmation.html')
    else:
        logging.warning(f"Failed login attempt for email: {email}")
        return jsonify({'message': 'Invalid credentials'})

if __name__ == '__main__':
    db.create_all()
    app.run(debug=True)




from flask import Flask, render_template, redirect, url_for, session, request, jsonify
from flask_sqlalchemy import SQLAlchemy
from werkzeug.security import generate_password_hash, check_password_hash
import logging

app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///users.db'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
app.config['SECRET_KEY'] = 'your_secret_key'

db = SQLAlchemy(app)

logging.basicConfig(filename='app.log', level=logging.INFO, format='%(asctime)s [%(levelname)s] %(message)s')

class User(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    username = db.Column(db.String(80), unique=True, nullable=False)
    email = db.Column(db.String(120), unique=True, nullable=False)
    password = db.Column(db.String(200), nullable=False)
    salt = db.Column(db.String(50), nullable=False)

@app.route('/register', methods=['POST'])
def register():
    try:
        data = request.get_json()

        username = data.get('username')
        email = data.get('email')
        password = data.get('password')

        # ... (код регистрации пользователя)

        logging.info(f"New user registered: {username}, {email}")

        return render_template('registration_confirmation.html')

    except Exception as e:
        logging.error(f"Error during registration: {str(e)}")
        return jsonify({'error': 'An error occurred during registration'})

@app.route('/login', methods=['POST'])
def login():
    try:
        data = request.get_json()

        email = data.get('email')
        password = data.get('password')

        user = User.query.filter_by(email=email)



        user = User.query.filter_by(email=email).first()

        if user and check_password_hash(user.password, password + user.salt):
            session['user_id'] = user.id
            logging.info(f"User logged in: {user.username}, {user.email}")
            return render_template('login_confirmation.html')
        else:
            logging.warning(f"Failed login attempt for email: {email}")
            return jsonify({'error': 'Invalid credentials'})

    except Exception as e:
        logging.error(f"Error during login: {str(e)}")
        return jsonify({'error': 'An error occurred during login'})



@app.route('/logout')
def logout():
    session.pop('user_id', None)
    return redirect(url_for('index'))



from functools import wraps

def login_required(f):
    @wraps(f)
    def decorated_function(*args, **kwargs):
        if 'user_id' not in session:
            return redirect(url_for('login'))
        return f(*args, **kwargs)
    return decorated_function

@app.route('/profile')
@login_required
def profile():
    user_id = session['user_id']
    user = User.query.get(user_id)
    return render_template('profile.html', username=user.username)


    try:
    # ваш код
except Exception as e:
    print(f"An error occurred: {str(e)}")





from flask import Flask, render_template, redirect, url_for, session, request, jsonify
from flask_sqlalchemy import SQLAlchemy
from werkzeug.security import generate_password_hash, check_password_hash
import secrets

app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///users.db'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
app.config['SECRET_KEY'] = 'your_secret_key'

db = SQLAlchemy(app)

class User(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    username = db.Column(db.String(80), unique=True, nullable=False)
    email = db.Column(db.String(120), unique=True, nullable=False)
    password = db.Column(db.String(200), nullable=False)
    salt = db.Column(db.String(50), nullable=False)

def generate_salt():
    return secrets.token_hex(16)  # Генерация случайной соли (32 символа в hex-формате)

@app.route('/register', methods=['POST'])
def register():
    if request.is_json:
        # Обработка регистрации через JSON
        data = request.get_json()
        username = data.get('username')
        email = data.get('email')
        password = data.get('password')
    else:
        # Обработка регистрации через HTML-форму
        username = request.form.get('username')
        email = request.form.get('email')
        password = request.form.get('password')

    # Проверка, существует ли пользователь с таким именем или электронной почтой
    if User.query.filter((User.username == username) | (User.email == email)).first():
        return jsonify({'error': 'Username or email already exists'})

    # Создание нового пользователя
    salt = generate_salt()
    hashed_password = generate_password_hash(password + salt, method='sha256')

    new_user = User(username=username, email=email, password=hashed_password, salt=salt)
    db.session.add(new_user)
    db.session.commit()

    return render_template('registration_confirmation.html')

@app.route('/login', methods=['POST'])
def login():
    data = request.get_json()
    email = data.get('email')
    password = data.get('password')

    user = User.query.filter_by(email=email).first()

    if user and check_password_hash(user.password, password + user.salt):
        session['user_id'] = user.id
        return render_template('login_confirmation.html')
    else:
        return jsonify({'error': 'Invalid credentials'})

# ... остальной код ...

if __name__ == '__main__':
    db.create_all()
    app.run(debug=True)



from flask import jsonify

@app.route('/register', methods=['POST'])
def register():
    data = request.get_json()
    username = data.get('username')
    email = data.get('email')
    password = data.get('password')

    # Проверка, существует ли пользователь с таким именем или электронной почтой
    if User.query.filter((User.username == username) | (User.email == email)).first():
        return jsonify({'error': 'Username or email already exists'})

    # Создание нового пользователя
    salt = generate_salt()  # Реализуйте функцию для генерации соли
    hashed_password = generate_password_hash(password + salt, method='sha256')

    new_user = User(username=username, email=email, password=hashed_password, salt=salt)
    db.session.add(new_user)
    db.session.commit()

    return render_template('registration_confirmation.html')



@app.route('/login', methods=['POST'])
def login():
    data = request.get_json()
    email = data.get('email')
    password = data.get('password')

    user = User.query.filter_by(email=email).first()

    if user and check_password_hash(user.password, password + user.salt):
        session['user_id'] = user.id
        return render_template('login_confirmation.html')
    else:
        return jsonify({'error': 'Invalid credentials'})


import secrets

def generate_salt():
    return secrets.token_hex(16)  # Генерация случайной соли (32 символа в hex-формате)


@app.errorhandler(400)
def bad_request(error):
    return jsonify({'error': 'Bad request'}), 400



from flask import flash

@app.route('/register', methods=['POST'])
def register():
    data = request.get_json()
    # ... (ваш код)

    try:
        # Ваш текущий код регистрации
        # ...

        flash('Registration successful', 'success')
        return render_template('registration_confirmation.html')

    except Exception as e:
        flash(f'Registration failed: {str(e)}', 'error')
        return render_template('registration_confirmation.html')


@app.route('/login', methods=['POST'])
def login():
    data = request.get_json()
    # ... (ваш код)

    try:
        # Ваш текущий код входа
        # ...

        flash('Login successful', 'success')
        return render_template('login_confirmation.html')

    except Exception as e:
        flash(f'Login failed: {str(e)}', 'error')
        return render_template('login_confirmation.html')


from flask import session

@app.route('/logout')
def logout():
    session.pop('user_id', None)
    return redirect(url_for('index'))



from functools import wraps
from flask import abort

def login_required(f):
    @wraps(f)
    def decorated_function(*args, **kwargs):
        if 'user_id' not in session:
            flash('You need to log in first', 'error')
            return redirect(url_for('login'))
        return f(*args, **kwargs)
    return decorated_function

@app.route('/profile')
@login_required
def profile():
    user_id = session['user_id']
    user = User.query.get(user_id)
    return render_template('profile.html', username=user.username)



from flask_bcrypt import Bcrypt

bcrypt = Bcrypt(app)

# Ваш текущий код остается без изменений

# Пример использования:
hashed_password = bcrypt.generate_password_hash(password).decode('utf-8')



@app.route('/register', methods=['POST'])
def register():
    # Логика регистрации

@app.route('/login', methods=['POST'])
def login():
    # Логика входа




server {
    listen 80;
    server_name your_domain.com www.your_domain.com;

    location / {
        proxy_pass http://127.0.0.1:5000;  # Порт, на котором работает Gunicorn
        include /etc/nginx/proxy_params;
        proxy_redirect off;
    












