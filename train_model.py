import pandas as pd
import numpy as np
import pickle
from sklearn.neighbors import NearestNeighbors

# Load dataset
file_path = r"C:\Users\HP\Downloads\Nutrition_Value_Dataset.csv"  # Update with your actual file path
df = pd.read_csv(file_path)

# Select relevant columns and clean data
df_filtered = df[['Product', 'Energy (kCal)']].dropna()
df_filtered.columns = df_filtered.columns.str.strip()

# Prepare feature array
calorie_values = df_filtered[['Energy (kCal)']].values

# Train KNN model
knn = NearestNeighbors(n_neighbors=5, metric='euclidean')
knn.fit(calorie_values)

# Recommendation function
def recommend_food(input_calories, model=knn, data=df_filtered):
    input_array = np.array([[input_calories]])
    distances, indices = model.kneighbors(input_array)
    recommended_products = data.iloc[indices[0]]['Product'].tolist()
    return recommended_products

# User input function
def user_input_recommendation():
    try:
        user_calories = float(input("Enter calorie amount: "))
        recommendations = recommend_food(user_calories)
        print("\nRecommended food items:")
        for i, item in enumerate(recommendations, 1):
            print(f"{i}. {item}")
    except ValueError:
        print("Please enter a valid number.")

# Run the recommendation system
user_input_recommendation()

df_filtered.to_csv(r"c:\xampp\htdocs\Mamas kitchen\cleaned_food_data.csv", index=False)
with open(r"c:\xampp\htdocs\Mamas kitchen\food_recommender.pkl", "wb") as model_file:
    pickle.dump(knn, model_file)
