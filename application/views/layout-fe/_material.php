<section id="contact" class="contact">
    <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-4 d-flex" data-aos="fade-up">
            <div class="info-box">
                <center><img src="<?=base_url('images/'.$detail->gambar)?>" alt="" width="80%;">
                <br>
                <div class="row">
                    <p><h3  style="font-family: calibri;"><label >WORKING NUMBER : <?= $detail->working_number?></label></p>
                    <p><h3  style="font-family: calibri;"><label>SEASON : <?= $detail->season ?></label></p>
                    <p><h3 style="font-family: calibri;"><label>AGE : <?= $detail->age?> </label></p>
                    <p><h3  style="font-family: calibri;"><label>COLOUR : <?= $detail->color?></label></p></center>
                </div>
            </div>
            <div class="col-lg-8 d-flex" data-aos="fade-up">
                <div class="info-box">
                </div>
            </div>
          </div>
        </div>
    </div>
</section>