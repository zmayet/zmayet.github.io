
import csv
import nltk
from nltk.tokenize import RegexpTokenizer
from nltk.corpus import stopwords
from nltk.stem import PorterStemmer
import mysql.connector



# Set up the NLTK tokenizer and stemmer
tokenizer = RegexpTokenizer(r'\w+')
stop_words = set(stopwords.words('english'))
stemmer = PorterStemmer()

# Load the anime dataset
with open('anime_dataset.csv') as f:
    reader = csv.DictReader(f)
    dataset = list(reader)


# Define a function to preprocess a message and return the stemmed words
def preprocess_message(message):
    # Tokenize the message
    tokens = tokenizer.tokenize(message.lower())
    # Remove stop words and stem the remaining words
    stemmed_tokens = [stemmer.stem(token) for token in tokens if token not in stop_words]
    return set(stemmed_tokens)

# Define a function to recommend anime based on the keywords in the messages
def recommend_anime(messages):
    recommendations = []
    
    # Extract keywords from the messages
    extracted_keywords = set()
    for message in messages:
        extracted_keywords.update(preprocess_message(message))
    print("Keywords extracted from the messages:", ", ".join(extracted_keywords))
    
    # Find matching anime
    for anime in dataset:
        anime_keywords = preprocess_message(anime['genre'])
        if any(keyword in anime_keywords for keyword in extracted_keywords):
            print("Match found for anime:", anime)
            if 'ï»¿name' in anime:
                recommendations.append(anime['ï»¿name'])
            else:
                print("Warning: anime entry has no name field:", anime)
    
    return recommendations


# Connect to the database
db = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="animeasylum"
)

# Retrieve the messages from the database
cursor = db.cursor()
cursor.execute("SELECT text FROM messages")
messages = [row[0] for row in cursor]

# Call the recommend_anime function and print the recommendations
recommendations = recommend_anime(messages)
if recommendations:
    print("Recommended anime: ", ", ".join(set(recommendations)))
else:
    print("No anime recommendations found.")
