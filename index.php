<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD App - Kelola Data Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="container mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-graduation-cap text-2xl"></i>
                    <h1 class="text-xl font-bold">Sistem Kelola Mahasiswa</h1>
                </div>
                <div class="flex space-x-4">
                    <a href="index.php" class="hover:text-blue-200 transition duration-200">
                        <i class="fas fa-home mr-1"></i>Beranda
                    </a>
                    <a href="students.php" class="hover:text-blue-200 transition duration-200">
                        <i class="fas fa-users mr-1"></i>Data Mahasiswa
                    </a>
                    <a href="test-api.php" class="hover:text-blue-200 transition duration-200">
                        <i class="fas fa-code mr-1"></i>Test API
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-4">Selamat Datang di Sistem CRUD</h2>
            <p class="text-xl mb-8">Kelola data mahasiswa dengan mudah dan efisien</p>
            <a href="students.php" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-200 inline-block">
                <i class="fas fa-arrow-right mr-2"></i>Mulai Kelola Data
            </a>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-16">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold text-center mb-12 text-gray-800">Fitur Utama</h3>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition duration-200">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-plus text-green-600 text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-semibold mb-2">Tambah Data</h4>
                    <p class="text-gray-600">Tambahkan data mahasiswa baru dengan form yang mudah digunakan</p>
                </div>
                
                <div class="text-center p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition duration-200">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-edit text-blue-600 text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-semibold mb-2">Edit Data</h4>
                    <p class="text-gray-600">Perbarui informasi mahasiswa dengan mudah dan cepat</p>
                </div>
                
                <div class="text-center p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition duration-200">
                    <div class="bg-red-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-trash text-red-600 text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-semibold mb-2">Hapus Data</h4>
                    <p class="text-gray-600">Hapus data mahasiswa yang tidak diperlukan lagi</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="bg-gray-100 py-16">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-3 gap-8 text-center">
                <div>
                    <div class="text-4xl font-bold text-blue-600 mb-2" id="total-students">0</div>
                    <div class="text-gray-600">Total Mahasiswa</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-green-600 mb-2">100%</div>
                    <div class="text-gray-600">Uptime Database</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-purple-600 mb-2">Real-time</div>
                    <div class="text-gray-600">Sinkronisasi Data</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2025 Sistem CRUD Mahasiswa. Dibuat dengan ❤️ menggunakan PHP & Supabase</p>
        </div>
    </footer>

    <script>
        // Load total students count
        fetch('api/count.php')
            .then(response => response.json())
            .then(data => {
                document.getElementById('total-students').textContent = data.count || 0;
            })
            .catch(error => {
                console.error('Error loading stats:', error);
            });
    </script>
</body>
</html>
