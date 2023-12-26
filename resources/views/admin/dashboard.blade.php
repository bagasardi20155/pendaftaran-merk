@extends('layouts.master')

@section('title', 'Dashboard')

@push('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/jqvmap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/weather-icons/2.0.12/css/weather-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/weather-icons/2.0.12/css/weather-icons-wind.min.css">
@endpush

@section('content')
    <div class="main-content">
      <section class="section">
        <div class="section-header">
          <h1>Dashboard</h1>
        </div>
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
              <div class="card-icon bg-primary">
                <i class="far fa-user"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>Pengajuan Hari ini</h4>
                </div>
                <div class="card-body">
                  {{ $appl_daily }}
                </div>
                <div class="card-footer" style="padding: 0">
                  <div class="row">
                    <div class="col-sm-6 text-center"><span class="text-dark"><i class="fas fa-clock" title="On Process"></i> {{ $appl_daily_proc }}</span></div>
                    <div class="col-sm-6 text-center"><span class="text-success"><i class="fas fa-check" title="Finished"></i>{{ $appl_daily_fin }}</span></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
              <div class="card-icon bg-danger">
                <i class="far fa-newspaper"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>Pengajuan Bulan ini</h4>
                </div>
                <div class="card-body">
                  {{ $appl_monthly }}
                </div>
                <div class="card-footer" style="padding: 0">
                  <div class="row">
                    <div class="col-sm-6 text-center"><span class="text-dark"><i class="fas fa-clock" title="On Process"></i> {{ $appl_monthly_proc }}</span></div>
                    <div class="col-sm-6 text-center"><span class="text-success"><i class="fas fa-check" title="Finished"></i>{{ $appl_monthly_fin }}</span></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
              <div class="card-icon bg-warning">
                <i class="far fa-file"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>Pengajuan Tahun ini</h4>
                </div>
                <div class="card-body">
                  {{ $appl_annually }}
                </div>
                <div class="card-footer" style="padding: 0">
                  <div class="row">
                    <div class="col-sm-6 text-center"><span class="text-dark"><i class="fas fa-clock" title="On Process"></i> {{ $appl_annually_proc }}</span></div>
                    <div class="col-sm-6 text-center"><span class="text-success"><i class="fas fa-check" title="Finished"></i>{{ $appl_annually_fin }}</span></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-8 col-md-12 col-12 col-sm-12">
            <div class="card">
              <div class="card-header col-lg-12 mt-3" style="display: block">
                <div class="row">
                  <div class="col-lg-6">
                    <h4>Statistik Pengunjung Sistem</h4>
                  </div>
                  <div class="col-lg-6">
                    <div class="card-header-action float-right">
                      <div class="btn-group">
                        <button id="btn-month" class="btn btn-primary" onclick="showMonthlyChart()">Month</button>
                        <button id="btn-year" class="btn" onclick="showAnnuallyChart()">Year</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <canvas id="myChart" height="182"></canvas>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-12 col-12 col-sm-12">
            <div class="card">
              <div class="card-header">
                <h4>Pengumuman Terbaru</h4>
              </div>
              <div class="card-body">
                <ul class="list-unstyled list-unstyled-border">
                  @foreach ($announcements as $data)
                    @php
                        $announcement = explode("|", $data['announcement']);
                    @endphp
                    <li class="media">
                      <img class="mr-3 rounded" width="50" src="{{ asset($announcement[1]) }}" alt="avatar">
                      <div class="media-body">
                        <div class="float-right text-primary">{{ \Carbon\Carbon::parse($announcement[3])->format('d-m-Y') }}</div>
                        <div class="media-title">{{ $announcement[0] }}</div>
                        @if ($announcement[4] == "waiting" || $announcement[4] == "revision" || $announcement[4] == "revised")
                            <span class="badge badge-pill badge-warning" style="padding-top: 1px; padding-bottom: 1px">Proses Pengajuan</span><br>
                        @elseif ($announcement[4] == "rejected")
                            <span class="badge badge-pill badge-danger" style="padding-top: 1px; padding-bottom: 1px">Merk Ditolak</span><br>
                        @elseif ($announcement[4] == "accepted")
                            <span class="badge badge-pill badge-success" style="padding-top: 1px; padding-bottom: 1px">Merk Diterima</span><br>
                        @endif
                        <span class="text-small text-muted">{{ $announcement[2] }}</span>
                      </div>
                    </li>
                  @endforeach
                </ul>
                <div class="text-center pt-1 pb-1">
                  <a href="" class="btn btn-primary btn-lg btn-round">
                    That's All
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
@endsection

@push('js')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.simpleWeather/2.6.0/jquery.simpleWeather.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/jquery.vmap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/maps/jquery.vmap.world.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/chocolat/1.1.2/js/chocolat.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    const dataAnnually = @json($dataAnnually);
    const dataMonthly = @json($dataMonthly);

    // Function to show annually chart
    function showAnnuallyChart() {
      document.getElementById('btn-year').addEventListener('click', function() {
        this.classList.add('btn-primary');
        document.getElementById('btn-month').classList.remove('btn-primary');
      });
      
      const annualyLabels = [];
      renderChart(dataAnnually);
    }

    // Function to show monthly chart
    function showMonthlyChart() {
      document.getElementById('btn-month').addEventListener('click', function() {
        this.classList.add('btn-primary');
        document.getElementById('btn-year').classList.remove('btn-primary');
      });

      const monthlyLabels = [];
      renderChart(dataMonthly, monthlyLabels);
    }


    var myChart = null; // Declare a variable to hold the chart instance globally

    function renderChart(data, labels) {
        var ctx = document.getElementById('myChart').getContext('2d');

        // Destroy the existing chart if it exists
        if (myChart) {
            myChart.destroy();
        }

        myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Visitors',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
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
    }

    // Initially display the monthly chart
    showMonthlyChart();
  </script>
@endpush