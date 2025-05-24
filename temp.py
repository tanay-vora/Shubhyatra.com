import pandas as pd
from fastapi import FastAPI, HTTPException
from fastapi.responses import FileResponse, JSONResponse
import os
from fastapi.middleware.cors import CORSMiddleware
import numpy as np


app = FastAPI()

app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],  # Change this to your frontend URL in production
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)




# ✅ Fix file path issue (use raw string r"" or double backslashes)
csv_path = r"./data.csv"
csv_path2=r"./flights.csv"
csv_path3=r"./train.csv"
csv_path4=r"./places.csv"
csv_path5=r"./bus.csv"

# ✅ Check if the file exists
if not os.path.exists(csv_path):
    raise FileNotFoundError(f"Error: File not found at {csv_path}")

# ✅ Read CSV file
df = pd.read_csv(csv_path)
df2 = pd.read_csv(csv_path2)
df3 = pd.read_csv(csv_path3)
df4 = pd.read_csv(csv_path4)
df5 = pd.read_csv(csv_path5)


@app.get("/")
def home():
    return {"message": "FastAPI is working!"}

# ✅ Endpoint to fetch all data
@app.get("/data")
def get_data():
    json_data = df.to_json(orient="records", force_ascii=False)
    return JSONResponse(content=json_data)

# ✅ Endpoint to fetch a row by index
@app.get("/data/{index}")
def get_row(index: int):
    if index < 0 or index >= len(df):
        raise HTTPException(status_code=404, detail="Index out of range")
    return df.iloc[index].to_dict()

# ✅ Endpoint to fetch specific columns
@app.get("/columns/{column_name}")
def get_column(column_name: str):
    if column_name not in df.columns:
        raise HTTPException(status_code=404, detail="Column not found")
    return df[column_name].tolist()


@app.get("/data/city/{city_name}")
def get_by_city(city_name: str):
    lower_columns = {col.lower(): col for col in df.columns}
    
    if 'city' not in lower_columns:
        raise HTTPException(status_code=404, detail="City column not found")

    city_column = lower_columns['city']
    filtered_df = df[df[city_column].str.contains(city_name, case=False, na=False)]
    
    if filtered_df.empty:
        raise HTTPException(status_code=404, detail="City not found")

    # Replace problematic values
    filtered_df = filtered_df.replace([np.inf, -np.inf], None).fillna("")  # Convert NaN and Infinity to safe values

    hotels_list = filtered_df.to_dict(orient="records")

    return JSONResponse(content=hotels_list)



@app.get("/search-flights/{from_city}/{to_city}")
def get_flights(from_city: str, to_city: str):
    lower_columns = {col.lower(): col for col in df2.columns}
    
    if 'from' not in lower_columns or 'to' not in lower_columns:
        raise HTTPException(status_code=404, detail="Required columns not found")
    
    from_column = lower_columns['from']
    to_column = lower_columns['to']
    
    filtered_df = df2[(df2[from_column].str.contains(from_city, case=False, na=False)) &
                     (df2[to_column].str.contains(to_city, case=False, na=False))]
    
    if filtered_df.empty:
        raise HTTPException(status_code=404, detail="No flights found")

    # Replace problematic values
    filtered_df = filtered_df.replace([np.inf, -np.inf], None).fillna("")
    flights_list = filtered_df.to_dict(orient="records")
    
    return JSONResponse(content=flights_list)

@app.get("/search-trains/{from_city}/{to_city}")
def get_trains(from_city: str, to_city: str):
    lower_columns = {col.lower(): col for col in df3.columns}
    
    if 'src' not in lower_columns or 'dstn' not in lower_columns:
        raise HTTPException(status_code=404, detail="Required columns not found")
    
    from_column = lower_columns['src']
    to_column = lower_columns['dstn']
    
    filtered_df = df3[(df3[from_column].str.contains(from_city, case=False, na=False)) &
                     (df3[to_column].str.contains(to_city, case=False, na=False))]
    
    if filtered_df.empty:
        raise HTTPException(status_code=404, detail="No trains found")

    # Replace problematic values
    filtered_df = filtered_df.replace([np.inf, -np.inf], None).fillna("")
    trains_list = filtered_df.to_dict(orient="records")
    
    return JSONResponse(content=trains_list)

@app.get("/tplaces/{city_name}")
def get_by_city(city_name: str):
    lower_columns = {col.lower(): col for col in df4.columns}
    
    if 'city' not in lower_columns:
        raise HTTPException(status_code=404, detail="City column not found")

    city_column = lower_columns['city']
    filtered_df = df4[df4[city_column].str.contains(city_name, case=False, na=False)]
    
    if filtered_df.empty:
        raise HTTPException(status_code=404, detail="City not found")

    # Replace problematic values
    filtered_df = filtered_df.replace([np.inf, -np.inf], None).fillna("")  # Convert NaN and Infinity to safe values

    tplaces_list = filtered_df.to_dict(orient="records")

    return JSONResponse(content=tplaces_list)

@app.get("/data/city/{hotel_id}")
def get_by_city(hotel_id: int):
    lower_columns = {col.lower(): col for col in df.columns}
    
    if 'id' not in lower_columns:
        raise HTTPException(status_code=404, detail="Hotel not found")

    city_column = lower_columns['id']
    filtered_df = df[df[city_column].str.contains(hotel_id, case=False, na=False)]
    
    if filtered_df.empty:
        raise HTTPException(status_code=404, detail="Hotel not found")

    # Replace problematic values
    filtered_df = filtered_df.replace([np.inf, -np.inf], None).fillna("")  # Convert NaN and Infinity to safe values

    hotels_list = filtered_df.to_dict(orient="records")

    return JSONResponse(content=hotels_list)


@app.get("/search-bus/{from_city}/{to_city}")
def get_flights(from_city: str, to_city: str):
    lower_columns = {col.lower(): col for col in df5.columns}
    
    if 'from' not in lower_columns or 'to' not in lower_columns:
        raise HTTPException(status_code=404, detail="Required columns not found")
    
    from_column = lower_columns['from']
    to_column = lower_columns['to']
    
    filtered_df = df5[(df5[from_column].str.contains(from_city, case=False, na=False)) &
                     (df5[to_column].str.contains(to_city, case=False, na=False))]
    
    if filtered_df.empty:
        raise HTTPException(status_code=404, detail="No Buses found")

    # Replace problematic values
    filtered_df = filtered_df.replace([np.inf, -np.inf], None).fillna("")
    bus_list = filtered_df.to_dict(orient="records")
    
    return JSONResponse(content=bus_list)