<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SkillUp') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <script>
        setTimeout(function() {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.remove();
            }
        }, 5000);

        // Function to hide error message after 5 seconds
        setTimeout(function() {
            var errorMessage = document.getElementById('error-message');
            if (errorMessage) {
                errorMessage.remove();
            }
        }, 5000);

        function closeMessage(id) {
            var message = document.getElementById(id);
            if (message) {
                message.remove();
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('#delete-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const form = this.closest('.delete-form');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });

        $(document).ready(function() {
            $('#faqTable').DataTable();
        });

        // Fungsi untuk menampilkan modal detail FAQ
        function showFAQDetailModal(question, answer) {
            // Update konten modal dengan pertanyaan dan jawaban FAQ
            document.getElementById('faqDetailModal').innerHTML = `
                <div class="flex justify-center items-center min-h-screen">
                    <div class="bg-white p-6 rounded-md shadow-lg max-w-lg w-full">
                        <h3 class="text-lg font-semibold mb-2">Detail FAQ</h3>
                        <p><span class="font-semibold">Question:</span> ${question}</p>
                        <p><span class="font-semibold">Answer:</span> ${answer}</p>
                        <div class="text-right mt-4">
                            <button onclick="closeFAQDetailModal()"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500 transition duration-300">Close</button>
                        </div>
                    </div>
                </div>
            `;
            // Tampilkan modal
            document.getElementById('faqDetailModal').classList.remove('hidden');
            document.body.classList.add('modal-open');
        }

        // Fungsi untuk menutup modal detail FAQ
        function closeFAQDetailModal() {
            // Sembunyikan modal
            document.getElementById('faqDetailModal').classList.add('hidden');
            document.body.classList.remove('modal-open');
        }
    </script>
</body> <!-- Include DataTables CSS and JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>



</html>
