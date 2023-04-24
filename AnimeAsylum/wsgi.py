# the flask module's Flask class should be imported.
from flask import Flask

# construct a Flask class instance using name as the input.
app = Flask(__name__)

# To map the URL route '/hello' to the hello() function, use the app.route decorator.
@app.route('/hello')
def hello():
    return 'Hello, World!'

# Launch the Flask development server after this script has been executed.
if __name__ == '__main__':
    app.run()
