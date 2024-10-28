<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Traffic Condition</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Add Traffic Condition</h1>
        
        <form action="{{ route('trafficConditions.store') }}" method="POST">
            @csrf
            
           
            <div class="mb-4">
                <label for="trafficLevel" class="block text-sm font-medium text-gray-700">trafficLevel:</label>
                <select id="trafficLevel" name="trafficLevel" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-green-500">
                    <option value="high">High</option>
                    <option value="moderate">Moderate</option>
                    <option value="low">Low</option>
                </select>
            </div>


            <div class="mb-4">
                <label for="averageDelay" class="block text-sm font-medium text-gray-700">Average Delay (minutes):</label>
                <input type="number" id="averageDelay" name="averageDelay" step="1" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-green-500" placeholder="Enter average delay in minutes">
            </div>

           
            <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition duration-200">
                Add Traffic Condition
            </button>
        </form>
    </div>
</body>
</html>
