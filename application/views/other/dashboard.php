<!-- Modern & Clean Dashboard UI Redesign (Enhanced Darker Accent) -->
<style>
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');

  body {
    font-family: 'Inter', sans-serif;
    background-color: #f1f3f6;
  }
  .dashboard-title {
    font-weight: 600;
    font-size: 18px;
    color: #2c3e50;
  }
  .card .card-title {
    font-size: 15px;
    font-weight: 600;
    color: #2c3e50;
  }
  .info-card {
    border-left: 6px solid #007bff;
    background-color: #e9f1fa;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.03);
    transition: 0.3s ease;
  }
  .info-card.success {
    border-left-color: #28a745;
    background-color: #e9f8ef;
  }
  .info-card.warning {
    border-left-color: #ffc107;
    background-color: #fff9e6;
  }
  .info-card h3 {
    font-size: 26px;
    font-weight: 700;
    margin-bottom: 0;
    color: #2c3e50;
  }
  .info-card p {
    margin: 0;
    color: #666;
    font-weight: 500;
  }
  .card {
    border-radius: 12px;
    border: none;
    background-color: #ffffff;
    box-shadow: 0 2px 10px rgba(0,0,0,0.04);
  }
  .breadcrumb {
    background: none;
    padding: 0;
    margin-bottom: 0;
  }
  .chart-container {
    height: 350px;
    max-height: 3500px;
  }
  canvas {
    max-width: 100%;
  }
</style>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-3">
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">Sample Monitoring</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<section class="content">
  <div class="container-fluid">
    <div class="row mb-3">
      <div class="col-md-12" hidden>
        <span class="dashboard-title">Penerimaan & Pengujian Sample</span>
        <hr>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4 col-12 mb-4">
        <div class="info-card">
          <p>Sample Diterima</p>
          <h3><?php echo $total_penerimaan ?></h3>
        </div>
      </div>

      <div class="col-lg-4 col-12 mb-4">
        <div class="info-card success">
          <p>Sample Selesai Sesuai Timeline</p>
          <h3><?= $timeline_count['Sesuai Timeline'] ?></h3>
        </div>
      </div>

      <div class="col-lg-4 col-12 mb-4">
        <div class="info-card warning">
          <p>Sample Selesai Melebihi Timeline</p>
          <h3><?= $timeline_count['Melebihi Timeline'] ?></h3>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-4">
        <div class="card">
          <div class="card-header bg-white border-0">
            <h4 class="card-title">Percentage of Sample Received</h4>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body chart-container">
            <canvas id="pieChart"></canvas>
          </div>
        </div>
      </div>

      <div class="col-md-6 mb-4">
        <div class="card">
          <div class="card-header bg-white border-0">
            <h4 class="card-title">Percentage of Sample Completed On Timeline & Exceeding Timeline</h4>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body chart-container">
            <canvas id="pieTimeline"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header bg-white border-0">
            <h3 class="card-title">Pengujian Sample</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body">
            <canvas id="barChart" style="height: 250px; width: 100%;"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
