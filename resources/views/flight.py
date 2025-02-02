from flask import Flask, jsonify
import requests

app = Flask(__name__)

@app.route('/get-flight-data', methods=['GET'])
def get_flight_data():
    api_url = "https://api.flightapi.io/schedule/your-api-key"
    params = {
        "mode": "departures",
        "iata": "DOH",
        "day": "1"
    }
    response = requests.get(api_url, params=params)
    return jsonify(response.json())

if __name__ == '__main__':
    app.run(port=5000)
