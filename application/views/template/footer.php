
<!-- ======= Footer ======= -->
<footer id="footer">
  <div class="container">
    <div class="copyright">
      &copy; Copyright <strong><span>PT.KAI Divre III Palembang</span></strong>
    </div>
  </div>
</footer><!-- End  Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="<?=base_url('assets/template/')?>vendor/purecounter/purecounter.js"></script>
<script src="<?=base_url('assets/template/')?>vendor/aos/aos.js"></script>
<script src="<?=base_url('assets/template/')?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url('assets/template/')?>vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?=base_url('assets/template/')?>vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?=base_url('assets/template/')?>vendor/swiper/swiper-bundle.min.js"></script>
<script src="<?=base_url('assets/template/')?>vendor/typed.js/typed.min.js"></script>
<script src="<?=base_url('assets/template/')?>vendor/waypoints/noframework.waypoints.js"></script>
<script src="<?=base_url('assets/template/')?>vendor/php-email-form/validate.js"></script>

<!-- Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.2.0/js/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js"></script>


<script type="text/javascript">
  $(document).ready(function() {
    var table = $('#tableuser').DataTable( {
        responsive: true
    } );
 
    new $.fn.dataTable.FixedHeader( table );
} );

  var myCarousel = document.querySelector('#myCarousel')
var carousel = new bootstrap.Carousel(myCarousel)

</script>

<script type="text/javascript">
  function lihatpw(){

    var cek = document.getElementById('cek');
    var pw1 = document.getElementById('password1');
    var pw2 = document.getElementById('password2');
    if (cek.checked == true) {
      pw1.type = 'text';
      pw2.type = 'text';
    }else{
      pw1.type = 'password';
      pw2.type = 'password';
    }
  }
</script>

<!-- Template Main JS File -->
<script src="<?=base_url('assets/template/')?>js/main.js"></script>

</body>

</html>