<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Data</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50 font-sans antialiased">

    <div class="max-w-6xl mx-auto px-4 py-10">
        <!-- Header & Add Button -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-1">Book List</h2>
                <p class="text-sm text-gray-500 mb-0">Manage your library book data easily</p>
            </div>
            <a href="/create-book"
                class="bg-[#84cc16] hover:bg-[#65a30d] text-black font-medium px-4 py-2 rounded-lg shadow-sm transition flex items-center gap-2">
                <i class="fas fa-plus"></i>Add Book
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Book Data Table Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="py-3 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wider ps-6">id
                            </th>
                            <th class="py-3 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Book
                                Title</th>
                            <th class="py-3 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Author
                            </th>
                            <th class="py-3 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Year</th>
                            <th
                                class="py-3 px-4 text-xs font-semibold text-gray-600 uppercase tracking-wider text-end pe-6">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @foreach ($books as $book)
                            <tr>
                                <td class="py-3 px-4">{{ $book->id }}</td>
                                <td class="py-3 px-4">{{ $book->title }}</td>
                                <td class="py-3 px-4">{{ $book->author }}</td>
                                <td class="py-3 px-4">{{ $book->year }}</td>
                                <td class="py-3 px-4 text-end">
                                    <a href="/detail-book">Detail</a>
                                    <a href="/edit-book/{{ $book->id }}"
                                        class="text-blue-500 hover:text-blue-700">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>