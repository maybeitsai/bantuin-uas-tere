<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test API - CRUD App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl font-bold text-center mb-8">API Testing Tool</h1>
            
            <!-- API Endpoints Test -->
            <div class="grid md:grid-cols-2 gap-6">
                
                <!-- GET All Students -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold mb-4 text-green-600">
                        <i class="fas fa-download mr-2"></i>GET All Students
                    </h3>
                    <button onclick="testGetAllStudents()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Test GET /api/students.php
                    </button>
                    <pre id="get-all-result" class="bg-gray-100 p-3 mt-3 rounded text-sm overflow-x-auto max-h-40"></pre>
                </div>

                <!-- POST New Student -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold mb-4 text-blue-600">
                        <i class="fas fa-plus mr-2"></i>POST New Student
                    </h3>
                    <div class="space-y-2 mb-3">
                        <input type="text" id="post-nim" placeholder="NIM" class="w-full px-3 py-1 border rounded">
                        <input type="text" id="post-nama" placeholder="Nama" class="w-full px-3 py-1 border rounded">
                        <select id="post-jurusan" class="w-full px-3 py-1 border rounded">
                            <option value="">Pilih Jurusan</option>
                            <option value="Teknik Informatika">Teknik Informatika</option>
                            <option value="Sistem Informasi">Sistem Informasi</option>
                        </select>
                        <input type="email" id="post-email" placeholder="Email" class="w-full px-3 py-1 border rounded">
                    </div>
                    <button onclick="testPostStudent()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Test POST /api/students.php
                    </button>
                    <pre id="post-result" class="bg-gray-100 p-3 mt-3 rounded text-sm overflow-x-auto max-h-40"></pre>
                </div>

                <!-- PUT Update Student -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold mb-4 text-yellow-600">
                        <i class="fas fa-edit mr-2"></i>PUT Update Student
                    </h3>
                    <div class="space-y-2 mb-3">
                        <input type="number" id="put-id" placeholder="Student ID" class="w-full px-3 py-1 border rounded">
                        <input type="text" id="put-nim" placeholder="NIM" class="w-full px-3 py-1 border rounded">
                        <input type="text" id="put-nama" placeholder="Nama" class="w-full px-3 py-1 border rounded">
                        <select id="put-jurusan" class="w-full px-3 py-1 border rounded">
                            <option value="">Pilih Jurusan</option>
                            <option value="Teknik Informatika">Teknik Informatika</option>
                            <option value="Sistem Informasi">Sistem Informasi</option>
                        </select>
                        <input type="email" id="put-email" placeholder="Email" class="w-full px-3 py-1 border rounded">
                    </div>
                    <button onclick="testPutStudent()" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
                        Test PUT /api/students.php
                    </button>
                    <pre id="put-result" class="bg-gray-100 p-3 mt-3 rounded text-sm overflow-x-auto max-h-40"></pre>
                </div>

                <!-- DELETE Student -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold mb-4 text-red-600">
                        <i class="fas fa-trash mr-2"></i>DELETE Student
                    </h3>
                    <div class="space-y-2 mb-3">
                        <input type="number" id="delete-id" placeholder="Student ID to delete" class="w-full px-3 py-1 border rounded">
                    </div>
                    <button onclick="testDeleteStudent()" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        Test DELETE /api/students.php
                    </button>
                    <pre id="delete-result" class="bg-gray-100 p-3 mt-3 rounded text-sm overflow-x-auto max-h-40"></pre>
                </div>

            </div>

            <!-- Count API Test -->
            <div class="bg-white rounded-lg shadow p-6 mt-6">
                <h3 class="text-lg font-semibold mb-4 text-purple-600">
                    <i class="fas fa-calculator mr-2"></i>Count Students
                </h3>
                <button onclick="testCountStudents()" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
                    Test GET /api/count.php
                </button>
                <pre id="count-result" class="bg-gray-100 p-3 mt-3 rounded text-sm overflow-x-auto"></pre>
            </div>

            <!-- Connection Test -->
            <div class="bg-white rounded-lg shadow p-6 mt-6">
                <h3 class="text-lg font-semibold mb-4 text-indigo-600">
                    <i class="fas fa-link mr-2"></i>Test Koneksi Supabase
                </h3>
                <button onclick="testConnection()" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    Test Connection
                </button>
                <pre id="connection-result" class="bg-gray-100 p-3 mt-3 rounded text-sm overflow-x-auto"></pre>
            </div>

            <!-- Navigation -->
            <div class="text-center mt-8">
                <a href="index.php" class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 mr-4">
                    <i class="fas fa-home mr-2"></i>Kembali ke Beranda
                </a>
                <a href="students.php" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                    <i class="fas fa-users mr-2"></i>Kelola Data
                </a>
            </div>
        </div>
    </div>

    <script>
        // Test GET All Students
        async function testGetAllStudents() {
            const resultDiv = document.getElementById('get-all-result');
            resultDiv.textContent = 'Loading...';
            
            try {
                const response = await fetch('api/students.php');
                const data = await response.json();
                resultDiv.textContent = JSON.stringify(data, null, 2);
            } catch (error) {
                resultDiv.textContent = 'Error: ' + error.message;
            }
        }

        // Test POST New Student
        async function testPostStudent() {
            const resultDiv = document.getElementById('post-result');
            resultDiv.textContent = 'Loading...';
            
            const studentData = {
                nim: document.getElementById('post-nim').value,
                nama: document.getElementById('post-nama').value,
                jurusan: document.getElementById('post-jurusan').value,
                email: document.getElementById('post-email').value
            };

            try {
                const response = await fetch('api/students.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(studentData)
                });
                const data = await response.json();
                resultDiv.textContent = JSON.stringify(data, null, 2);
            } catch (error) {
                resultDiv.textContent = 'Error: ' + error.message;
            }
        }

        // Test PUT Update Student
        async function testPutStudent() {
            const resultDiv = document.getElementById('put-result');
            resultDiv.textContent = 'Loading...';
            
            const id = document.getElementById('put-id').value;
            const studentData = {
                nim: document.getElementById('put-nim').value,
                nama: document.getElementById('put-nama').value,
                jurusan: document.getElementById('put-jurusan').value,
                email: document.getElementById('put-email').value
            };

            try {
                const response = await fetch(`api/students.php?id=${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(studentData)
                });
                const data = await response.json();
                resultDiv.textContent = JSON.stringify(data, null, 2);
            } catch (error) {
                resultDiv.textContent = 'Error: ' + error.message;
            }
        }

        // Test DELETE Student
        async function testDeleteStudent() {
            const resultDiv = document.getElementById('delete-result');
            resultDiv.textContent = 'Loading...';
            
            const id = document.getElementById('delete-id').value;

            try {
                const response = await fetch(`api/students.php?id=${id}`, {
                    method: 'DELETE'
                });
                const data = await response.json();
                resultDiv.textContent = JSON.stringify(data, null, 2);
            } catch (error) {
                resultDiv.textContent = 'Error: ' + error.message;
            }
        }

        // Test Count Students
        async function testCountStudents() {
            const resultDiv = document.getElementById('count-result');
            resultDiv.textContent = 'Loading...';
            
            try {
                const response = await fetch('api/count.php');
                const data = await response.json();
                resultDiv.textContent = JSON.stringify(data, null, 2);
            } catch (error) {
                resultDiv.textContent = 'Error: ' + error.message;
            }
        }

        // Test Connection
        async function testConnection() {
            const resultDiv = document.getElementById('connection-result');
            resultDiv.textContent = 'Testing connection...';
            
            try {
                // Test basic API endpoint
                const response = await fetch('api/count.php');
                
                if (response.ok) {
                    const data = await response.json();
                    resultDiv.textContent = `✅ Connection successful!\nStatus: ${response.status}\nResponse: ${JSON.stringify(data, null, 2)}`;
                } else {
                    resultDiv.textContent = `❌ Connection failed!\nStatus: ${response.status}\nError: ${response.statusText}`;
                }
            } catch (error) {
                resultDiv.textContent = `❌ Connection error!\nError: ${error.message}`;
            }
        }

        // Auto populate sample data
        function populateSampleData() {
            // POST form
            document.getElementById('post-nim').value = '2024001';
            document.getElementById('post-nama').value = 'Test Student';
            document.getElementById('post-jurusan').value = 'Teknik Informatika';
            document.getElementById('post-email').value = 'test@example.com';
        }

        // Load sample data on page load
        window.onload = function() {
            populateSampleData();
        };
    </script>
</body>
</html>
