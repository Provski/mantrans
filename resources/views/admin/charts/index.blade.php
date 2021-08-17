@extends('blog.layouts.admin')

@section('content')

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Charts</h1>
    <p class="mb-4">The charts below data have been customized to be input according to the productivity needs in <a target="_blank" href="https://www.mantrans.id/blog/show">Mantrans Blog</p>

    <!-- Content Row -->
    <div class="row">
        <canvas id="myChart"></canvas>
@endsection

@section('scripts')
    <!-- Page level custom scripts -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.3.2/dist/chart.min.js"></script>

        <script>
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Posts', 'Authors', 'Categories', 'Quotes'],
                    datasets: [{
                        label: 'Data Mantrans CMS',
                        data: [{{ $postsCount }}, {{ $authorsCount }}, {{ $categoriesCount }}, {{ $quotesCount }}],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            </script>

@endsection