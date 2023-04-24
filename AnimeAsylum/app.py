# the flask module's Flask class should be imported.
from flask import Flask

# construct a Flask class instance using name as the input.
app = Flask(__name__)

# To map the URL route '/' to the hello() function, use the app.route decorator.
@app.route("/")
def hello():
    return 'Hello, World!'
