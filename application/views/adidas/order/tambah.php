<style>
body {
  background-color: #f8f9f7;
  font-family: 'Inter', sans-serif;
}

.card {
  box-shadow: 0 1px 6px rgba(0,0,0,0.05);
  border-radius: 12px;
  border: none;
}

.card-header {
  background: linear-gradient(90deg, #2c3e50, #1c2833);
  color: #fff;
  font-weight: 500;
  font-size: 14px;
  border-top-left-radius: 12px;
  border-top-right-radius: 12px;
}

.form-control {
  border-radius: 10px;
  font-size: 13px;
  border: 1px solid #ced4da;
  padding: 8px 12px;
  transition: all 0.25s ease;
}

.form-control:focus {
  border-color: #27ae60;
  box-shadow: 0 0 0 2px rgba(39,174,96,0.15);
}

.form-label {
  font-weight: 500;
  color: #2c3e50;
  font-size: 14px;
  margin-bottom: 4px;
}

.row.g-3 {
  row-gap: 18px; /* jarak antar baris */
  column-gap: 16px; /* jarak antar kolom */
}

.card-body {
  padding: 30px 25px;
}

.btn-modern {
  border-radius: 30px;
  font-size: 13px;
  padding: 8px 18px;
  transition: all 0.25s ease;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-weight: 500;
}

.btn-back {
  background-color: #e9ecef;
  color: #2c3e50;
  border: none;
}

.btn-back:hover {
  background-color: #d6dbdf;
}

.btn-submit {
  background: linear-gradient(to right, #27ae60, #1e8449);
  color: #fff;
  border: none;
}

.btn-submit:hover {
  background: linear-gradient(to right, #229954, #196f3d);
}

.card-footer {
  background-color: #f9f9f9;
  border-top: 1px solid #e0e0e0;
  border-bottom-left-radius: 12px;
  border-bottom-right-radius: 12px;
  padding: 15px 25px;
  display: flex;
  justify-content: space-between; /* tombol kiri kanan */
  align-items: center;
}
</style>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-1">
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">Sample Monitoring</a></li>
          <li class="breadcrumb-item"><a href="<?= site_url('c_transaksi/order') ?>">Data Order</a></li>
          <li class="breadcrumb-item active">Tambah Order</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<section class="content">
  <div class="container-fluid">
    <div class="card">
      <form action="<?= site_url('c_transaksi/tambahaksi_order') ?>" method="POST">
      <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 pl-pr-1">
                                    <div class="form-group">
                                        <label>Brand</label>
                                        <input name="brand" type="text" class="form-control">
                                    </div>
                                    </div>
                                <div class="col-md-4 pl-pr-1">
                                    <div class="form-group">
                                        <label>Order Number</label>
                                        <input name="order_number" type="text" class="form-control">
                                    </div>
                                    </div>
                                <div class="col-md-4 pl-pr-1">
                                <div class="form-group">
                                        <label>Costumer Code</label>
                                        <input name="costumer_code" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4 pl-pr-1">
                                    <div class="form-group">
                                        <label>Costumer Name</label>
                                        <input name="costumer_name" type="text" class="form-control">
                                    </div>
                                    </div>
                                <div class="col-md-4 pl-pr-1">
                                    <div class="form-group">
                                        <label>Articel No</label>
                                        <input name="article_no" type="text" class="form-control">
                                    </div>
                                    </div>
                                <div class="col-md-4 pl-pr-1">
                                <div class="form-group">
                                        <label>Color</label>
                                        <input name="color" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4 pl-pr-1">
                                    <div class="form-group">
                                        <label>Age</label>
                                        <input name="age" type="text" class="form-control">
                                    </div>
                                    </div>
                                <div class="col-md-4 pl-pr-1">
                                    <div class="form-group">
                                        <label>Working Number</label>
                                        <input name="working_number" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4 pl-pr-1">
                                <div class="form-group">
                                    <label>Item #</label>
                                    <input name="item_name"  type="text" class="form-control"   >
                                </div>
                            </div>
                            <div class="col-md-4 pl-pr-1">
                                <div class="form-group">
                                    <label>Material Lifecycle Status</label>
                                    <select name="exception" type="text" class="form-control"   >
                                            <option selected disabled>--PILIH--</option>
                                            <option value="Limited Released">Limited Released</option>
                                            <option value="Released">Released</option>
                                            <option value="Restricted Released">Restricted Released</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 pl-pr-1">
                                <div class="form-group">
                                    <label>Style</label>
                                    <input name="style" type="text" class="form-control"   >
                                </div>
                            </div>
                                <div class="col-md-4 pl-pr-1">
                                <div class="form-group">
                                        <label>PODD</label>
                                        <input name="podd" type="date" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 pl-pr-1">
                                    <div class="form-group">
                                        <label>LCO</label>
                                        <input name="lco" type="date" class="form-control">
                                    </div>
                                    </div>
                                <div class="col-md-4 pl-pr-1">
                                    <div class="form-group">
                                        <label>PO Quantity</label>
                                        <input name="po_quantity" type="text" class="form-control">
                                    </div>
                                    </div>
                                <div class="col-md-4 pl-pr-1">
                                <div class="form-group">
                                        <label>Production Date</label>
                                        <input name="production_date" type="date" class="form-control">
                                    </div>
                                </div>
                        
                                <div class="col-md-4 pl-pr-1">
                                    <div class="form-group">
                                        <label>Season</label>
                                        <input name="season" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4 pl-pr-1">
                                    <div class="form-group">
                                        <label>Factory Disclaimer</label>
                                            <select name="factory_discleamer" id="factory_discleamer" class="form-control">
                                            <option selected disabled>Pilih</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 pl-pr-1">
                                    <div class="form-group">
                                        <label>Functional Fabric</label>
                                        <select name="functional" id="functional" class="form-control">
                                            <option selected disabled>Pilih</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 pl-pr-1">
                                    <div class="form-group">
                                        <label>Functional Hangtag</label>
                                        <input name="hangtag" type="hangtag" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4 pl-pr-1">
                                    <div class="form-group">
                                        <label>Line</label>
                                        <input name="line" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row" hidden>
                                <div class="update ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary btn-round" value="Tambah">Submit</button>
                                </div>
                            </div>
                        </div>

        <div class="card-footer">
          <button type="button"
              onclick="window.location.href='<?= site_url('c_transaksi/index_penerimaan') ?>'"
              class="btn-modern btn-back">
              <i class="fas fa-arrow-left"></i> Back
          </button>

          <button type="submit" class="btn-modern btn-submit" style="margin-left: 82%">
              <i class="fas fa-save"></i> Submit
          </button>
        </div>
      </form>
    </div>
  </div>
</section>
