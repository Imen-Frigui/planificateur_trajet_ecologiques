<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Charging Station</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Add Charging Station</h1>
        
        <form action="{{ route('chargingStations.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="stationType" class="block text-sm font-medium text-gray-700">Station Type:</label>
                <input type="text" value="Type 2" id="stationType" name="stationType" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-green-500" placeholder="Enter station type">
            </div>

            <div class="mb-4">
                <label for="chargingSpeed" class="block text-sm font-medium text-gray-700">Charging Speed (kW):</label>
                <input type="number" id="chargingSpeed" name="chargingSpeed" step="0.1" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-green-500" placeholder="Enter charging speed">
            </div>

            <div class="mb-4">
                <label for="fastCharging" class="block text-sm font-medium text-gray-700">Fast Charging:</label>
                <select id="fastCharging" name="fastCharging" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-green-500">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition duration-200">
                Add Charging Station
            </button>
        </form>
    </div>
</body>
</html>
