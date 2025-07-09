<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa - CRUD App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50" x-data="studentsApp()">
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
                    <a href="students.php" class="text-blue-200">
                        <i class="fas fa-users mr-1"></i>Data Mahasiswa
                    </a>
                    <a href="test-api.php" class="hover:text-blue-200 transition duration-200">
                        <i class="fas fa-code mr-1"></i>Test API
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header Section -->
    <div class="bg-white shadow-sm border-b">
        <div class="container mx-auto px-4 py-6">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Data Mahasiswa</h2>
                    <p class="text-gray-600">Kelola informasi mahasiswa dengan mudah</p>
                </div>
                <button @click="openModal('add')" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                    <i class="fas fa-plus mr-2"></i>Tambah Mahasiswa
                </button>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" 
                           x-model="searchTerm" 
                           @input="searchStudents"
                           placeholder="Cari berdasarkan nama, NIM, atau email..." 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div class="md:w-48">
                    <select x-model="filterJurusan" @change="filterStudents" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Semua Jurusan</option>
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Teknik Komputer">Teknik Komputer</option>
                        <option value="Manajemen Informatika">Manajemen Informatika</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Loading State -->
        <div x-show="loading" class="text-center py-8">
            <i class="fas fa-spinner fa-spin text-3xl text-blue-600"></i>
            <p class="mt-2 text-gray-600">Memuat data...</p>
        </div>

        <!-- Students Table -->
        <div x-show="!loading" class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <template x-for="(student, index) in filteredStudents" :key="student.id">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" x-text="index + 1"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900" x-text="student.nim"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" x-text="student.nama"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" x-text="student.jurusan"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" x-text="student.email"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <button @click="openModal('edit', student)" class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button @click="deleteStudent(student.id)" class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
                
                <!-- Empty State -->
                <div x-show="filteredStudents.length === 0 && !loading" class="text-center py-12">
                    <i class="fas fa-users text-4xl text-gray-300 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada data mahasiswa</h3>
                    <p class="text-gray-600">Mulai dengan menambahkan mahasiswa baru</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Form -->
    <div x-show="showModal" 
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 lg:w-1/3 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900" x-text="modalMode === 'add' ? 'Tambah Mahasiswa' : 'Edit Mahasiswa'"></h3>
                    <button @click="closeModal" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form @submit.prevent="submitForm" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">NIM</label>
                        <input type="text" 
                               x-model="form.nim" 
                               required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Masukkan NIM">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" 
                               x-model="form.nama" 
                               required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Masukkan nama lengkap">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jurusan</label>
                        <select x-model="form.jurusan" 
                                required 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Pilih Jurusan</option>
                            <option value="Teknik Informatika">Teknik Informatika</option>
                            <option value="Sistem Informasi">Sistem Informasi</option>
                            <option value="Teknik Komputer">Teknik Komputer</option>
                            <option value="Manajemen Informatika">Manajemen Informatika</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" 
                               x-model="form.email" 
                               required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Masukkan email">
                    </div>
                    
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" 
                                @click="closeModal" 
                                class="px-4 py-2 text-gray-600 border border-gray-300 rounded-md hover:bg-gray-50">
                            Batal
                        </button>
                        <button type="submit" 
                                :disabled="submitting"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 disabled:opacity-50">
                            <span x-show="!submitting" x-text="modalMode === 'add' ? 'Tambah' : 'Perbarui'"></span>
                            <span x-show="submitting">
                                <i class="fas fa-spinner fa-spin mr-1"></i>Menyimpan...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function studentsApp() {
            return {
                students: [],
                filteredStudents: [],
                loading: true,
                showModal: false,
                modalMode: 'add',
                submitting: false,
                searchTerm: '',
                filterJurusan: '',
                form: {
                    id: null,
                    nim: '',
                    nama: '',
                    jurusan: '',
                    email: ''
                },

                async init() {
                    await this.loadStudents();
                },

                async loadStudents() {
                    try {
                        this.loading = true;
                        const response = await fetch('api/students.php');
                        const data = await response.json();
                        
                        if (response.ok) {
                            this.students = data;
                            this.filteredStudents = data;
                        } else {
                            this.showError(data.error || 'Gagal memuat data');
                        }
                    } catch (error) {
                        this.showError('Gagal terhubung ke server');
                    } finally {
                        this.loading = false;
                    }
                },

                openModal(mode, student = null) {
                    this.modalMode = mode;
                    this.showModal = true;
                    
                    if (mode === 'edit' && student) {
                        this.form = { ...student };
                    } else {
                        this.resetForm();
                    }
                },

                closeModal() {
                    this.showModal = false;
                    this.resetForm();
                },

                resetForm() {
                    this.form = {
                        id: null,
                        nim: '',
                        nama: '',
                        jurusan: '',
                        email: ''
                    };
                },

                async submitForm() {
                    try {
                        this.submitting = true;
                        
                        const url = this.modalMode === 'add' 
                            ? 'api/students.php' 
                            : `api/students.php?id=${this.form.id}`;
                        
                        const method = this.modalMode === 'add' ? 'POST' : 'PUT';
                        
                        const response = await fetch(url, {
                            method: method,
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(this.form)
                        });
                        
                        const data = await response.json();
                        
                        if (response.ok) {
                            this.showSuccess(data.message);
                            this.closeModal();
                            await this.loadStudents();
                        } else {
                            if (data.errors) {
                                this.showError(data.errors.join(', '));
                            } else {
                                this.showError(data.error || 'Gagal menyimpan data');
                            }
                        }
                    } catch (error) {
                        this.showError('Gagal terhubung ke server');
                    } finally {
                        this.submitting = false;
                    }
                },

                async deleteStudent(id) {
                    const result = await Swal.fire({
                        title: 'Konfirmasi Hapus',
                        text: 'Apakah Anda yakin ingin menghapus data mahasiswa ini?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    });

                    if (result.isConfirmed) {
                        try {
                            const response = await fetch(`api/students.php?id=${id}`, {
                                method: 'DELETE'
                            });
                            
                            const data = await response.json();
                            
                            if (response.ok) {
                                this.showSuccess(data.message);
                                await this.loadStudents();
                            } else {
                                this.showError(data.error || 'Gagal menghapus data');
                            }
                        } catch (error) {
                            this.showError('Gagal terhubung ke server');
                        }
                    }
                },

                searchStudents() {
                    this.filterStudents();
                },

                filterStudents() {
                    let filtered = this.students;

                    // Filter by search term
                    if (this.searchTerm) {
                        const term = this.searchTerm.toLowerCase();
                        filtered = filtered.filter(student => 
                            student.nama.toLowerCase().includes(term) ||
                            student.nim.toLowerCase().includes(term) ||
                            student.email.toLowerCase().includes(term)
                        );
                    }

                    // Filter by jurusan
                    if (this.filterJurusan) {
                        filtered = filtered.filter(student => 
                            student.jurusan === this.filterJurusan
                        );
                    }

                    this.filteredStudents = filtered;
                },

                showSuccess(message) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                },

                showError(message) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: message
                    });
                }
            }
        }
    </script>
</body>
</html>
