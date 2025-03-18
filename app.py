from flask import Flask, request, jsonify
import pandas as pd
import numpy as np
import pickle

app = Flask(__name__)

# Load the trained model and dataset
with open("food_recommender.pkl", "rb") as model_file:
    knn = pickle.load(model_file)

df_filtered = pd.read_csv("cleaned_food_data.csv")

# Recommendation function
def recommend_food(input_calories):
    input_array = np.array([[input_calories]])
    distances, indices = knn.kneighbors(input_array)
    recommended_products = df_filtered.iloc[indices[0]]['Product'].tolist()
    return recommended_products

@app.route('/recommend', methods=['GET'])
def recommend():
    try:
        calorie_input = float(request.args.get('calories'))
        recommendations = recommend_food(calorie_input)
        return jsonify({"recommendations": recommendations})
    except:
        return jsonify({"error": "Invalid input"}), 400

if __name__ == '__main__':
    app.run(host="0.0.0.0", port=5000, debug=True)
